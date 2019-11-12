<?php
	session_start();
	/*
	if(empty($_SESSION['studentID']))
	{
		//This will send the user away if there's no student login info
		header('Location: http://www.google.com/');
	}
	*/
	
?>
<html>
  <head>
	<title>Student Homepage</title>
  </head>
  <body>
	<h1>Student Homepage</h1>
	<section style="display:flex; flex-direction:row; justify-content:space-around;">
		<section style="border: 5px solid yellow; border-radius: 25px; width:45%">
			<?php include_once('student-chat.php'); ?>
		</section>
		<section style="border: 5px solid blue; border-radius: 25px; width:45%">
			<?php include_once('student-addCourse.php'); ?>
		</section>
	</section>
	
	<br><br>
	<button onclick="window.location.href = 'logout-page.php';">Logout</button>
  </body>
</html>