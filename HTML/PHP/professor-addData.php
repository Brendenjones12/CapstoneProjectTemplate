<?php
	session_start();
	include_once 'connect.php';
	$error = array();
	$success = array();
	$profID = $_SESSION['professorID'];
	
	// this is so the section object can be created
	$query = "SELECT Class.id, Class.name FROM Class, ClassProfessor WHERE Class.id = ClassProfessor.classID AND ClassProfessor.profID = $profID ORDER BY Class.id";
	$sql = $conn->prepare($query);
	$sql->execute();
	$classList = $sql->fetchAll();
	
	
	// This handles the "Submit New Question" button being hit
	if (!empty($_POST) && !empty($_POST['submitData'])){
		$question = $_POST['dataQuestion'];
		$question = trim($question);
		$answer = $_POST['dataAnswer'];
		$answer = trim($answer);
		$selectedClass = $_POST['dataClassID'];
		
		
		// checks for empty fields first
		if (empty($question) || $question == "") {
			$error[] = "The Question field can't be empty!";
		}
		if (empty($answer) || $answer == "") {
			$error[] = "The Answer field can't be empty!";
		}
		
		// checks for no errors before then doing a duplicate question and answer check
		if (empty($error)) {
			$query = "SELECT classID, quesText, quesAns FROM ClassQuestions WHERE classID=$selectedClass";
			$sql = $conn->prepare($query);
			$sql->execute();
			$copyCheck = $sql->fetchAll();
			
			foreach ($copyCheck as $c) {
				if ($c['quesText'] == $question) {
					$error[] = "That question already exists!";
					break;
				}
			}
		}
		
		
		// does one final error check before finaly inserting the data into the database
		if (empty($error)) {
			// This creates the class in the class table
			$query = "INSERT INTO ClassQuestions VALUES ($selectedClass, 2, '$question', '$answer', $profID)";
			$sql = $conn->prepare($query);
			$sql->execute();
			
			// finally, there's a success statement given and all the values are cleared
			$success[] = "Question successfully added to that class!";
			$question  = "";
			$answer = "";
			$selectedClass = "";
		}
	}
?>


<html>
  <head>
  </head>
  <body>
	<h2>Add Data</h2>
	
	<form action="" method="post">
		<select name="dataClassID">
			<?php
				if (!empty($classList)) {
					foreach($classList as $c) {
						echo '<option value="'.$c['id'].'"';
						if ($selectedClass == $c['id'])
							echo " selected";
						echo '>'.$c['name'].'</option>';
					}
				}
			?>
		</select>
		<br><br>
		
		<label for="dataQuestion">Question: </label>
		<textarea name="dataQuestion" required value="<?php if(!empty($_POST['dataQuestion'])){ echo $question; } else { echo ''; } ?>"></textarea>
		<br><br>
		
		<label for="dataAnswer">Answer: </label>
		<textarea name="dataAnswer" required rows="" cols="" value="<?php if(!empty($_POST['dataAnswer'])){ echo $answer; } else { echo ''; } ?>"/></textarea>
		<br><br>
		
		<button type="submit" name="submitData" value="✓">Submit New Question</button>
		<br><br>
	</form>
	
	<span class="error"><?php if(!empty($error)) foreach($error as $e) echo $e . "<br>"; ?></span>
	<span class="success"><?php if(!empty($success)) foreach($success as $s) echo $s . "<br>"; ?></span>
  </body>
</html>