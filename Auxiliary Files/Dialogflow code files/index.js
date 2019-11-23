'use strict';
 



const functions = require('firebase-functions');
const {WebhookClient} = require('dialogflow-fulfillment');
const {Card, Suggestion} = require('dialogflow-fulfillment');
const mysql = require('mysql');

var admin = require("firebase-admin");

admin.initializeApp();

process.env.DEBUG = 'dialogflow:debug'; // enables lib debugging statements
 
exports.dialogflowFirebaseFulfillment = functions.https.onRequest((request, response) => {
  const agent = new WebhookClient({ request, response });
  console.log('Dialogflow Request headers: ' + JSON.stringify(request.headers));
  console.log('Dialogflow Request body: ' + JSON.stringify(request.body));
 
  function welcome(agent) {
    agent.add(`Welcome to my agent!`);
  }
 
  function fallback(agent) {
    agent.add(`I didn't understand`);
    agent.add(`I'm sorry, can you try again?`);
  }
  
  // Handles connection to mysql database
  function connectToDatabase () {

      const connection = mysql.createConnection({

          // information for secure login to database
          host: 'remotemysql.com',
          user: 'd7kUqaJghf',
          password: 'JqRZrvNDMi',
          database: 'd7kUqaJghf'
      });

      return new Promise((resolve, reject) => {
          connection.connect();

          //returns the connection to the mysql server
          resolve(connection);
      });
  }
  
  // Handles the content of the mysql query, using parameters given by the user
  function queryDatabase (connection) {

      // user-given unique identifier for a class
      const userClassID = agent.request_.body.queryResult.outputContexts[0].parameters['ClassID.original'].toString();

      // user-given question about a class
      const userQuestion = agent.request_.body.queryResult.outputContexts[0].parameters['ClassQuestion.original'].toString();

      return new Promise((resolve, reject) => {

          // This query finds the answer to a question matching the user given value for a course with matching id
          var sql = 'SELECT quesAns FROM ClassQuestions WHERE classID = ' + userClassID + ' AND quesText = "' + userQuestion + '"';

          console.log(sql);

          connection.query(sql, (error, results) => {

              // results will either be undefined if there is no existing question that meets the needs of the query
              // or it will be the answer to a question
              resolve(results);
          });
      });
  }
  
  function handleReadFromMySQL (agent) {

      return connectToDatabase().then(connection => {

          return queryDatabase(connection).then(result => {

              console.log(result);

              result.map(user => {

                  // creates a message containing the asnwer to the question that is sent to the user by the chatbot
                  agent.add(user.quesAns);
              });

              connection.end();
          });
      });
  }


  // Run the proper function handler based on the matched Dialogflow intent name
  let intentMap = new Map();
  intentMap.set('Default Welcome Intent', welcome);
  intentMap.set('Default Fallback Intent', fallback);
  intentMap.set('class_question', handleReadFromMySQL);
  agent.handleRequest(intentMap);
});