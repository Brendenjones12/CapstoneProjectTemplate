<?php
	session_start();
	include_once 'connect.php';
	$error = array();
	$success = array();
	$studID = $_SESSION['studentID'];
	
	if (!empty($_POST)) {
		// collects the fields
		$courseNum = trim($_POST['courseNumber']);
		
		
		// checks for an empty field first
		if (empty($courseNum) || $courseNum == "") {
			$error[] = "The Course Number field can't be empty!";
		} else {
			// then checks to make sure the class exists
			$query = "SELECT id FROM Class WHERE id=$courseNum";
			$sql = $conn->prepare($query);
			$sql->execute();
			$class = $sql->fetchAll();
			if (empty($class)) {
				$error[] = "That class code doesn't exist!";
			}
		}
		
		
		// checks for no errors before then doing a duplicate class ID non-existant class check
		if (empty($error)) {
			$query = "SELECT * FROM ClassStudent WHERE studID=$studID";
			$sql = $conn->prepare($query);
			$sql->execute();
			$classStudList = $sql->fetchAll();
			
			foreach ($classStudList as $cs) {
				if ($cs['classID'] == $courseNum) {
					$error[] = "You're already signed up for that class!";
					break;
				}
			}
		}
		
		
		// does one final error check before finaly inserting the data into the database
		if (empty($error)) {
			$query = "INSERT INTO ClassStudent VALUES ($courseNum, $studID)";
			$sql = $conn->prepare($query);
			$sql->execute();
			
			$success[] = "You're now successfully signed up for that class!";
		}
	}
?>


<html>
  <head>
  </head>
  <body>
	<h2>Add Course</h2>
	<form action="" method="post">
		<label for="courseNumber">Course Number: </label><br>
		<input type="number" name="courseNumber" required min=1 max=99999999999 value="<?php if(!empty($_POST['courseNum'])){ echo $classNum; } else { echo ''; } ?>"/><br><br>
		<button type="submit" name="submit" value="✓">Submit</button>
		<br><br>
		<span class="error"><?php if(!empty($error)) foreach($error as $e) echo $e . "<br>"; ?></span>
		<span class="success"><?php if(!empty($success)) foreach($success as $s) echo $s . "<br>"; ?></span>
	</form>
  </body>
</html>