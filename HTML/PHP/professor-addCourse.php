<?php
	session_start();
	
	//$query = "select Password, Userid from User where Username=:username";
	//$sql = $conn->prepare($query);
	//$sql->bindValue("username", $username);
	//$sql->execute();
	//$user = $sql->fetchAll();
?>
<html>
  <head>
  </head>
  <body>
	<h2>Add Course</h2>
	<form action="" method="post">
		Course Number: <input type="number" name="courseNumber">
		<br><br>
		<button type="submit" name="submit" value="✓">Submit</button>
	</form>
  </body>
</html>