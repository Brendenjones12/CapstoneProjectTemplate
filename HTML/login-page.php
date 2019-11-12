<?php
	session_destroy();
	session_start();
	//include_once 'connect.php';
	$error = array();
	
	if (!empty($_POST))
	{
		//student login code
		if (!empty($_POST['studentLogin']))
		{
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);
			//$query = "select Password, Userid from Student where Username=:username";
			//$sql = $conn->prepare($query);
			//$sql->bindValue("username", $username);
			//$sql->execute();
			//$user = $sql->fetchAll();
			if (empty($user))
			{
				$error[] = "Student username does not exist";
			}
			else
			{
				if ($user[0]['Password'] == sha1($password))
				{
					$_SESSION['studentID'] = $user[0]['Userid'];
					header('Location: student-home.php');
				}
				else
				{
					$error[] = "Username and password do not match";
				}
			}
		} 
		//professor login code
		elseif (!empty($_POST['professorLogin']))
		{
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);
			//$query = "select Password, Userid from User where Username=:username";
			//$sql = $conn->prepare($query);
			//$sql->bindValue("username", $username);
			//$sql->execute();
			//$user = $sql->fetchAll();
			if(empty($user))
			{
				$error[] = "Professor username does not exist";
			} 
			else
			{
				if($user[0]['Password'] == sha1($password))
				{
					$_SESSION['professorID'] = $user[0]['Userid'];
					header('Location: professor-home.php');
				}
				else
				{
					$error[] = "Username and password do not match";
				}
			}
		}
	}
?>
<html>
<head>
<style> .error {color: blue;} </style>
</head>
<body>
	<form action="" method="post">
		Username: <input type="text" name="username" required value="<?php if(!empty($_POST['username'])){ echo $username; } else { echo ''; } ?>"/><br><br>
		Password: <input type="password" name="password" required /><br><br>
		<section style="display:flex; flex-direction:row;">
			<button type="submit" name="studentLogin" value="✓">Student Login</button>
			<button type="submit" name="professorLogin" value="✓">Professor Login</button>
		</section>
		<br>
		<span class="error"><?php if(!empty($error)) foreach($error as $e) echo $e . "<br>"; ?></span>
	</form>
	<br>
	<button onclick="window.location.href = 'register-page.php';">Register New User</button>
</body>
</html>














