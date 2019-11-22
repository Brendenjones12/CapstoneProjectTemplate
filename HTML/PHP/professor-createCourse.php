<?php
	session_start();
	include_once 'connect.php';
	$error = array();
	$success = array();
	$profID = $_SESSION['professorID'];
	
	// This handles the "submit new class" button being hit
	if (!empty($_POST) && !empty($_POST['submitClass'])) {
		// collects the fields
		$classNum  = $_POST['newCourseNumber'];
		$className = $_POST['newCourseName'];
		$classSec  = $_POST['newCourseSection'];
		
		
		// checks for empty fields first
		if (empty($classNum) || $classNum == "") {
			$error[] = "The Class Number field can't be empty!";
		}
		if (empty($className) || $className == "") {
			$error[] = "The Class Name field can't be empty!";
		}
		if (empty($classSec) || $classSec == "") {
			$error[] = "The Class Section field can't be empty!";
		}
		
		
		// checks for no errors before then doing a duplicate classNum & classSec check
		if (empty($error)) {
			$query = "SELECT * FROM Class";
			$sql = $conn->prepare($query);
			$sql->execute();
			$classList = $sql->fetchAll();
			
			foreach ($classList as $c) {
				if ($c['courseNum'] == $classNum) {
					$error[] = "There's already a class with that class number!";
					break;
				}
			}
		}
		
		// does one final error check before finaly inserting the data into the database
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
	}
?>


<html>
  <head>
  </head>
  <body>
	<h2>Create a Course</h2>
	
	<form action="" method="post">
		<label for="newCourseNumber">New Course Number: </label>
		<input type="number" name="newCourseNumber" required min=1 max=99999999999 value="<?php if(!empty($_POST['newCourseNumber'])){ echo $classNum; } else { echo ''; } ?>"/>
		<br><br>
		
		<label for="newCourseName">New Course Name: </label>
		<input type="text" name="newCourseName" required value="<?php if(!empty($_POST['newCourseName'])){ echo $className; } else { echo ''; } ?>"/>
		<br><br>
		
		<label for="newCourseSection">New Course Section: </label>
		<input type="number" name="newCourseSection" required min=1 max=255 value="<?php if(!empty($_POST['newCourseSection'])){ echo $classSec; } else { echo ''; } ?>"/>
		<br><br>
		
		<button type="submit" name="submitClass" value="✓">Submit New Class</button>
		<br><br>
	</form>
	
	<span class="error"><?php if(!empty($error)) foreach($error as $e) echo $e . "<br>"; ?></span>
	<span class="success"><?php if(!empty($success)) foreach($success as $s) echo $s . "<br>"; ?></span>
  </body>
</html>