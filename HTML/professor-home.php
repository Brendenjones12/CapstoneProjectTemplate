<?php
	session_start();
	/*
	if (empty($_SESSION['professorLogin']))
	{
		//This will send the user away if there's no student login info
		header('Location: http://www.google.com/');
	}
	*/
	
?>
<html>
  <head>
	<title>Professor Homepage</title>
  </head>
  <body>
	<h1>Professor Homepage</h1>
	<section style="display:flex; flex-direction:row; justify-content:space-around;">
		<section style="border: 5px solid blue; border-radius: 25px; width:30%">
			<?php include_once('professor-addCourse.php'); ?>
		</section>
		<section style="border: 5px solid yellow; border-radius: 25px; width:30%">
			<?php include_once('professor-addData.php'); ?>
		</section>
		<section style="border: 5px solid red; border-radius: 25px; width:30%">
			<?php include_once('professor-viewData.php'); ?>
		</section>
	</section>
	
	<br><br>
	<button onclick="window.location.href = 'logout-page.php';">Logout</button>
  </body>
</html>