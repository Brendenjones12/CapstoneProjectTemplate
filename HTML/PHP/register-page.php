<?php
	session_destroy();
	include_once 'connect.php';
	$error = array();
	$success = array();
	
	if (!empty($_POST)) {
		// collects the fields
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$password2 = trim($_POST['password2']);
		$fName = trim($_POST['fname']);
		$lName = trim($_POST['lname']);
		
		
		// checks for empty fields first
		if (empty($username) || $username == "") {
			$error[] = "Username field can't be empty!";
		}
		if (empty($fName) || $fName == "") {
			$error[] = "First Name field can't be empty!";
		}
		if (empty($lName) || $lName == "") {
			$error[] = "First Name field can't be empty!";
		}
		
		// then checks for empty password fields AND for non-matching password fields
		if ((empty($password) || $password == "") || (empty($password2) || $password2 == "")) {
			$error[] = "Password fields can't be empty!";
		} elseif ($password != $password2) {
			$error[] = "Password fields don't match!";
		} else {
			$password = sha1($password);
		}
		
		
		// checks for no errors before then doing a duplicate username check
		if (empty($error)) {
			if (!empty($_POST['createStudent'])) {
				$tableName = "Student";
			} elseif (!empty($_POST['createProfessor'])) {
				$tableName = "Professor";
			}
			
			$query = "SELECT username FROM $tableName";
			$sql = $conn->prepare($query);
			$sql->execute();
			$userList = $sql->fetchAll();
			foreach ($userList as $u) {
				if ($u['username'] == $username) {
					$error[] = "$tableName username is already taken!";
					break;
				}
			}
		}
		
		
		// once again checks for no errors before inserting the data into the database
		if (empty($error) && !empty($tableName)) {
			$query = "INSERT INTO $tableName VALUES (NULL, '$username', '$password', '$fName', '$lName')";
			$sql = $conn->prepare($query);
			$sql->execute();
			
			// alerts the user they did it right before sending them to the login page
			$message = "Congrats! A $tableName was created! Sending you back to the login page to login!";
			echo "<script type='text/javascript'>alert('$message');</script>";
			header('Location: login-page.php');
		}
	}
?>



<html>
  <head>
	<title>SRS - Register User</title>
	<link rel="stylesheet" href="SRS_StyleSheet.css">
  </head>
  <body>
  <body>
	<section class="login">
		<h1>Student Retention Service</h1>
		<h1>Register</h1>
		<form action="" method="post">
			<section class="fields">
				<label for="username">Username: </label>
				<input type="text" name="username" required value="<?php if(!empty($_POST['username'])){ echo $username; } else { echo ''; } ?>"/><br><br>
				<label for="password">Password: </label>
				<input type="password" name="password" required /><br><br>
				<label for="password2">Re-enter Password: </label>
				<input type="password" name="password2" required /><br><br>
				<br><br>
				<label for="fname">First Name: </label>
				<input type="text" name="fname" required /><br><br>
				<label for="lname">Last Name: </label>
				<input type="text" name="lname" required /><br><br>
			</section>
			<span class="error"><?php if(!empty($error)) foreach($error as $e) echo $e . "<br>"; ?></span>
			<br><br>
			<section class="horizontalsection">
				<button type="submit" name="createStudent" value="✓">Create Student</button>
				<button type="submit" name="createProfessor" value="✓">Create Professor</button>
			</section>
		</form>
	</section>
  </body>
</html>