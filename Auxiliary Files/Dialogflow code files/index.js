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
        user: '3ISdS27gPP',
        password: 'dEnOlOyyio',
        database: '3ISdS27gPP'
          
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
      const userQuestion = agent.parameters.SYL_Question;

      return new Promise((resolve, reject) => {

      	// This query finds the answer to a question matching the user given value for a course with matching id
        var sql = 'SELECT quesAns FROM ClassQuestions WHERE syllabusID = ' + userClassID;

        //console.log(sql);

        connection.query(sql, (error, results) => {

        	// results will either be undefined if there is no existing question that meets the needs of the query
            // or it will be the answer to a question
            resolve(results);
          
        });
        
      });
      
  	}
  
    // function to be used for custom professor questions
    /* NOT CURRENTLY IMPLEMENTED */
    function enterCustomQuery (connection) {
  	
      // user-given question about a class
      const userQuestion = agent.request_.body.queryResult.outputContexts[0].parameters['SYL_Question.original'].toString();

      // user-given unique identifier for a class
      const userClassID = agent.request_.body.queryResult.outputContexts[0].parameters['ClassID.original'].toString();

      var sql = "SELECT quesID FROM ClassQuestions WHERE classID = " + userClassID;

      return new Promise ((resolve, reject) => {

          connection.query(sql, (error, results) => {

            // results will either be undefined if there is no existing question that meets the needs of the query
            // or it will be the answer to a question
            resolve(results);

          });

      });
      
  	}
  	
  	// creates sql query for picking the answer to a question involving the syllabus
	function enterSyllabusQuery (connection, sylID) {
  	
      // user-given unique identifier for a class
      const userClassID = agent.request_.body.queryResult.outputContexts[0].parameters['ClassID.original'].toString();

      // This query finds the answer to a question matching the user given value for a course with matching id
      // user-given question about a class
      const userQuestion = agent.request_.body.queryResult.outputContexts[0].parameters.SYL_Question;
    
    	return new Promise((resolve, reject) => {

      		var sql = 'SELECT ' + userQuestion + ' FROM Syllabus WHERE syllabusID = ' + sylID;

          	connection.query(sql, (error, results) => {

              	// results will either be undefined if there is no existing question that meets the criteria of the query
              	// or it will be the answer to a question
              	resolve(results);
              
          	});
          
		});
      
  	}
  
  	// creates sql query for retrieving syllabus id for a class
	function getSyllabusForClass (connection) {
  	
      // user-given unique identifier for a class
      const userClassID = agent.request_.body.queryResult.outputContexts[0].parameters['ClassID.original'].toString();

      return new Promise((resolve, reject) => {

          var sql = 'SELECT syllabusID FROM ClassSyllabus WHERE classID = ' + userClassID;

          connection.query(sql, (error, results) => {

              // results will either be undefined if there is no existing syllabus for the class id given
              // or the unique id for a syllabus
              resolve(results);

          });

      });
    
  	}
  
  function handleReadFromMySQL (agent) {
	
    var syllabusIDn;
    
    const userQuestionContent = agent.request_.body.queryResult.outputContexts[0].parameters.SYL_Question;
    const userQuestionContentOriginal = agent.request_.body.queryResult.outputContexts[0].parameters['ClassID.original'].toString();
    
  	if (userQuestionContent != 'customInput') {
    
      return connectToDatabase().then(connection => {
		
        return getSyllabusForClass(connection).then(sID => {
        
          sID.map(ansr => {
            
            syllabusIDn = ansr.syllabusID;
            
          });
          
          return enterSyllabusQuery(connection, syllabusIDn).then(result => {

			  result.map(ansr => {
                
                if (ansr[userQuestionContent] != undefined) {
                  
                	agent.add(ansr[userQuestionContent]);
                  
                }
                else {
                  
                	agent.add("I'm sorry, there is no answer available for your question.");
                  
                }
                
              });
            
              connection.end();

          });
          
      	});
        
      });
      
  	}
    
    else {
    	
    	return connectToDatabase().then(connection => {
          
          return enterCustomQuery(connection).then(result => {

			result.map(ansr => {
				console.log(ansr);
                
                /*if (ansr[userQuestion]) {
                	agent.add(ansr[userQuestion]);
                }
                else {
                	agent.add("I'm sorry, there is no answer available for your question.");
                }*/
                
              });
            	connection.end();
       
          		});
      	
      		});
    	}
    
  }

  function handleCustomQuestion (agent) {
  	console.log(agent.request_.body.queryResult);
  }

  // Run the proper function handler based on the matched Dialogflow intent name
  let intentMap = new Map();
  intentMap.set('Default Welcome Intent', welcome);
  intentMap.set('Default Fallback Intent', fallback);
  intentMap.set('class_question', handleReadFromMySQL);
  intentMap.set('question_fallback', handleCustomQuestion);
  agent.handleRequest(intentMap);
});
