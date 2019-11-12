<?php
	// include_once 'connect.php';
	$error = array();
	if (!empty($_POST))
	{
		if (!empty($_POST['createStudent']))
		{
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);
			$password2 = trim($_POST['password2']);
			
			// checks for empty passwords
			if ((empty($password) || $password == "") || (empty($password2) || $password2 == "")){
				$error[] ="Password fields can't be empty";
			}
			
			//checks for non-matching password
			if ($password != $password2)
			{
				$error[] ="Password fields don't match";
			}
			
			// Check for duplicate username user
			/*
			$query = "select Username from Student";
			$sql = $conn->prepare($query);
			$sql->execute();
			$userList = $sql->fetchAll();
			foreach($userList as $u)
			{
				if ($u['Username'] == $username)
				{
					$error[] = "Username already taken";
					break;
				}
			}
			*/
			
			// Inserts the Student if there's no issues
			/*
			if (empty($error))
			{
				$query = "INSERT INTO Student (`Username`, `Password`) VALUES(:username, :password)";
				$sql = $conn->prepare($query);
				$sql->bindValue("username", $username);
				$sql->bindValue("password", sha1($password));
				$sql->execute();
			}
			*/
		}
		
		elseif (!empty($_POST['createProfessor']))
		{
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);
			$password2 = trim($_POST['password2']);
			
			// checks for empty passwords
			if ((empty($password) || $password == "") || (empty($password2) || $password2 == "")){
				$error[] ="Password fields can't be empty";
			}
			
			//checks for non-matching password
			if ($password != $password2)
			{
				$error[] ="Password does not match";
			}
			
			// Check for duplicate username user
			/*
			$query = "select Username from Student";
			$sql = $conn->prepare($query);
			$sql->execute();
			$userList = $sql->fetchAll();
			foreach($userList as $u)
			{
				if ($u['Username'] == $username)
				{
					$error[] = "Username already taken";
					break;
				}
			}
			*/
			
			// Inserts the Student if there's no issues
			/*
			if (empty($error))
			{
				$query = "INSERT INTO Student (`Username`, `Password`) VALUES(:username, :password)";
				$sql = $conn->prepare($query);
				$sql->bindValue("username", $username);
				$sql->bindValue("password", sha1($password));
				$sql->execute();
			}
			*/
		}
	}
	
?>
<html>
  <head>
	<title>Register User</title>
	<style> .error {color: blue;} </style>
  </head>
  <body>
<body>
	<form action="" method="post">
		Username: <input type="text" name="username" required value="<?php if(!empty($_POST['username'])){ echo $username; } else { echo ''; } ?>"/><br><br>
		Password: <input type="password" name="password" required /><br><br>
		Reenter Password: <input type="password" name="password2" required /><br><br>
		<section style="display:flex; flex-direction:row;">
			<button type="submit" name="createStudent" value="✓">Create Student</button>
			<button type="submit" name="createProfessor" value="✓">Create Professor</button>
		</section>
		<br>
		<span class="error"><?php if(!empty($error)) foreach($error as $e) echo $e . "<br>"; ?></span>
	</form>	
  </body>
</html>