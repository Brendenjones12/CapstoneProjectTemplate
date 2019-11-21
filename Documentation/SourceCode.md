# Source Code

> ### node.js mysql config ####
##### Location: /Dialogflow/index.js, line 33

This block of code handles the configuration of the connection to the mysql database. The 'connection' const contains the needed information for a secure login to the database, and it includes information like the server's hostname, username for login, password for login, and the database name.

```javascript

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
```



> #### node.js mysql query ####
##### Location: /Dialogflow/index.js, line 47
This function handles the mysql query to the database. When the user prompts the chatbot to answer a question about the class, it will also ask the user to give some details about the class to narrow down the answer that the user is looking for

```javascript
// Handles the content of the mysql query, using parameters given by the user
function queryDatabase (connection) {

	const classID = agent.parameters.ClassID;

	const classQues = agent.parameters.ClassQuestion;

	return new Promise((resolve, reject) => {

		// This query finds the answer to a question matching the user given value for a course with matching id
		var sql1 = 'SELECT quesAns FROM ClassQuestions WHERE classID = ' + classID + ' AND quesText = "' + classQues + '"';

		console.log(sql1);

		connection.query(sql1, (error, results) => {

			// results will either be undefined if there is no existing question that meets the needs of the query
			// or it will be the answer to a question
			resolve(results);
		});
	});
}
```



> #### Dialogflow agent handling ####
##### Location: /Dialogflow/index.js, line 59
This function utilizes the previous two functions, both of which return promises. After the both promises are resolved, the 'result' from the queryDatabase function, which is also the answer to the user's question, is then added to the chatbot's feed to be passed onto the user.

```javascript
function handleReadFromMySQL (agent) {

	// unique identifier for Class in mysql database
	const class_id = agent.parameters.ClassID;

	// the question being asked by the user
	const class_question = agent.parameters.ClassQuestion;

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
```


