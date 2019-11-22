<?php
	session_start();
	
	//This makes sure that a student is logged in
	if(empty($_SESSION['studentID'])) {
		//This will send the user away if there's no student login info
		header('Location: login-page.php');
	}
?>
<html>
  <head>
	<title>SRS - Student Home</title>
	<link rel="stylesheet" href="SRS_StyleSheet.css">
  </head>
  <body>
	<section class="homepagesection">
		<h1>Student Retention Service</h1>
		<h1>Student Homepage</h1>
		<section class="appsection">
			<section class="studentapp">
				<?php include_once('student-chat.html'); ?>
			</section>
			<section class="studentapp">
				<?php include_once('student-addCourse.php'); ?>
			</section>
		</section>
	</section>
	<br><br>
	<div style="text-align: center;">
		<button style="position:relative" onclick="window.location.href = 'logout-page.php';">Logout</button>
	</div>
  </body>
</html>