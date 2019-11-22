<?php
	session_destroy();
	session_start();
	include_once 'connect.php';
	$error = array();
	
	if (!empty($_POST)) {
		// collects the fields
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
		
		// checks for empty fields first
		if (empty($username) || $username == "") {
			$error[] = "Username field can't be empty!";
		}
		if (empty($password) || $password == "") {
			$error[] = "Password field can't be empty!";
		}
		
		
		// checks for no errors before then doing a duplicate username check
		if (empty($error)) {
			if (!empty($_POST['studentLogin'])) {
				$tableName = "Student";
			} elseif (!empty($_POST['professorLogin'])) {
				$tableName = "Professor";
			}
			
			$query = "SELECT fname, id, password FROM $tableName WHERE username='$username'";
			$sql = $conn->prepare($query);
			$sql->execute();
			$user = $sql->fetchAll();
			
			
			if(empty($user)) {
				$error[] = "$tableName username not in database";
			} else {
				// handles the code for an actually existing user
				if($user[0]['password'] == sha1($password)) {
					// sets the session variable to contain their id and first name
					if ($tableName == "Student") {
						$_SESSION['studentID'] = $user[0]['id'];
					} elseif ($tableName == "Professor") {
						$_SESSION['professorID'] = $user[0]['id'];
					}
					$_SESSION['fName']  = $user[0]['fname'];
					
					// then redirects them to their proper home page
					header('Location: '.(strtolower($tableName)).'-home.php');
				} else {
					$error[] = "Username and password do not match";
				}
			}
		}
	}
?>


<html>
  <head>
	<title>SRS - Login</title>
	<link rel="stylesheet" href="SRS_StyleSheet.css">
  </head>
  <body>
	<section class="login">
		<h1>Student Retention Service</h1>
		<h1>Login</h1>
		
		<form action="" method="post">
			<section class="fields">
				<label for="username">Username: </label>
				<input type="text" name="username" required value="<?php if(!empty($_POST['username'])){ echo $username; } else { echo ''; } ?>"/><br><br>
				<label for="password">Password: </label>
				<input type="password" name="password" required />
			</section>
			<br><br>
			
			<section class="horizontalsection">
				<button type="submit" name="studentLogin" value="✓">Student Login</button>
				<button type="submit" name="professorLogin" value="✓">Professor Login</button>
			</section>
			<br><br>
			
			<span class="error"><?php if(!empty($error)) foreach($error as $e) echo $e . "<br>"; ?></span>
		</form>
		
		<span class="error"><?php if(!empty($error)) foreach($error as $e) echo $e . "<br>"; ?></span>
		<br><br>
		<div style="text-align: center;">
			<button style="position:relative" onclick="window.location.href = 'register-page.php';">Register a New User</button>
		</div>
	</section>
  </body>
</html>














