# Source Code

> ### node.js mysql config ####
##### Location: \Dialogflow\index.js, line 33
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
##### Location: \Dialogflow\index.js, line 47
This function handles the mysql query to the database. When the user prompts the chatbot to answer a question about the class, it will also ask the user to give some details about the class to narrow down the answer that the user is looking for

```javascript
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
```



> #### Dialogflow agent handling ####
##### Location: \Dialogflow\index.js, line 59
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



> #### Inserting a Class Entity into the Database ####
##### Location: \HTML\PHP\professor-createCourse.php, line 44
This if statement is used at the tailend of the POST method in the createCourse php file. It is used to first create a MySQL query to insert the given class values into the server, before then collected the automatically generated class ID from said created class entity. It then uses that to also update the "ClassProfessor" table to include a relationship of the professor (using the currently logged in professor's unique id) and the newly created class (using said class's just created class id). Finally, it just clears all the fields so that the process can be done again easily.

```php
if (empty($error)) {
	// This creates the class in the class table
	$query = "INSERT INTO Class VALUES (NULL, '$classNum', '$className', $classSec)";
	$sql = $conn->prepare($query);
	$sql->execute();
	
	
	// this then collects the classID from Class
	$query = "SELECT id FROM Class WHERE courseNum='$classNum'";
	$sql = $conn->prepare($query);
	$sql->execute();
	$class = $sql->fetchAll();
	$classID = $class[0]['id'];
	
	
	// then, it adds the appropriate relationship entity into the database
	$query = "INSERT INTO ClassProfessor VALUES($classID, $profID)";
	$sql = $conn->prepare($query);
	$sql->execute();
	
	// finally, there's a success statement given and all the values are cleared
	$success[] = "Class successfully created! Give your student the class number '$classID' so they can sign up for it!";
	$classNum  = "";
	$className = "";
	$classSec  = "";
}
```



> #### Requesting Specific Classes from Database ####
##### Location: \HTML\PHP\professor-addData.php, line 9
These few lines of code include a MySQL query saved as a PHP variable so that PHP can use some built in functions to poll a server for the information it wants. The MySQL query is specifically asking for classes' ids and names from them "Class" table that match the class ids from the "ClassProfessor" table and the professor id from the logged in professor.

```php
$query = "SELECT Class.id, Class.name FROM Class, ClassProfessor WHERE Class.id = ClassProfessor.classID AND ClassProfessor.profID = $profID ORDER BY Class.id";
$sql = $conn->prepare($query);
$sql->execute();
$classList = $sql->fetchAll();
```
