# Source Code

#### node.js mysql config ####

```javascript

  // configures connection to mysql database
  function connectToDatabase () {
	  
	// information for secure login to database
  	const connection = mysql.createConnection({
    	host: 'remotemysql.com',
      	user: 'd7kUqaJghf',
      	password: 'JqRZrvNDMi',
      	database: 'd7kUqaJghf'
    });
    
    return new Promise((resolve, reject) => {
    	connection.connect();
    	resolve(connection);
    });
  }
```

This block of code handles the configuration of the connection to the mysql database. The 'connection' const contains the needed information for a secure login to the database, and it includes information like the server's hostname, username for login, password for login, and the database name.

```javascript
  // Handles the content of the mysql query, using parameters given by the user
  function queryDatabase (connection) {
  	return new Promise((resolve, reject) => {
		// This query finds the answer to a question matching the user given value for a course with matching id
      	var sql1 = 'SELECT quesAns FROM ClassQuestions WHERE classID = ' + agent.parameters.ClassID + ' AND quesText = "' + agent.parameters.ClassQuestion + '"';
      	console.log(sql1);
      	connection.query(sql1, (error, results) => {
			// results will either be undefined if there is no existing question that meets the needs of the query
			// or it will be the answer to a question
    		resolve(results);
    	});
    });
  }
```



```javascript
  // calls on methods to connect to a mysql database and to submit a query base on user responses
  // the returned response is then sent to the user by the chatbot
  function handleReadFromMySQL (agent) {
  	return connectToDatabase().then(connection => {
    	return queryDatabase(connection).then(result => {
        	console.log(result);
          	result.map(user => {
				// creates a message that is sent to the user by the chatbot
          		agent.add(user.quesAns);
            });
          	connection.end();
        });
    });
  }
```