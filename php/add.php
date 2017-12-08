<?php
include_once('connections/connect.inc.php');

//-------------------------------------------------------------------------------
//Now finally move everything into the database	
//-------------------------------------------------------------------------------

//Query to create table:
$query = "CREATE TABLE tblSubmissions(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstName VARCHAR(30),
lastName VARCHAR(30),
email VARCHAR(50),
password VARCHAR(55),
birthdate DATE,
ml VARCHAR(5)
)";

mysqli_query($link, $query);

//query to double check that the UN doesn't already exist	
	$emailCheck = trim($_POST['email']);
	
	$queryCheck = 
	"SELECT * 
	FROM tblsubmissions 
	WHERE email='" . $emailCheck . "'";
	
	$checkResult = mysqli_query($link, $queryCheck);
	
	if(mysqli_num_rows($checkResult) > 0){
			//Error message & instructions								
			echo "<p class=\"err\">Your username already exists. 
			Please <a href=\"showentry.php\">login here</a>!!!";
	}
	else {
			//Query to insert values into table:
			$query = "INSERT INTO 
			tblSubmissions VALUES 
			(0, 
			'$firstName', 
			'$lastName', 
			'$email', 
			'$pw', 
			'$bday', 
			'$ml')";
				
			mysqli_query($link, $query);
			
			//Success message & instructions								
			echo "<p class=\"success\">Your entry has been submitted. 
			Your user name is: $email. Please <a href=\"showentry.php\">login here!!</a>";
			
			mysqli_close($link);
		}
?>