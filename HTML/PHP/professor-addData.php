<?php
	session_start();
	
	if (!empty($_POST))
	{
		$question = $_POST['questionText'];
		$answer = $_POST['answerText'];
			
		//$query = "select Password, Userid from User where Username=:username";
		//$sql = $conn->prepare($query);
		//$sql->bindValue("username", $username);
		//$sql->execute();
		//$user = $sql->fetchAll();
		
		echo $question." -- ".$answer;
	}
?>
<html>
  <head>
  </head>
  <body>
	<h2>Add Data</h2>
	<form action="" method="post">
		Question: <input type="text" name="questionText" required /><br><br>
		Answer: <input type="text" name="answerText" required /><br><br>
		<button type="submit" value="Submit">Submit Data</button>
	</form>
  </body>
</html>