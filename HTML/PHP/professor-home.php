<?php
	session_start();
	
	//This makes sure that a professor is logged in
	if(empty($_SESSION['professorID'])) {
		//This will send the user away if there's no professor login info
		$message = "You're not currently logged in as a Professor! Redirecting you to the login page...";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header('Location: login-page.php');
	}
	
	// try naming the posts
	// look into ajax
	
?>
<html>
  <head>
	<title>SRS - Professor Home</title>
	<link rel="stylesheet" href="SRS_StyleSheet.css">
  </head>
  <body>
	<section class="homepagesection">
		<h1>Student Retention Service</h1>
		<h1>Professor Homepage</h1>
		<section class="appsection">
			<section class="studentapp">
				<?php include_once('professor-createCourse.php'); ?>
			</section>
			<section class="studentapp">
				<?php include_once('professor-addData.php'); ?>
			</section>
		</section>
	</section>
	<br><br>
	<div style="text-align: center;">
		<button style="position:relative" onclick="window.location.href = 'logout-page.php';">Logout</button>
	</div>
  </body>
</html>