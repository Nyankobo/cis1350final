<?php
//PHP FORM HANDLING -----------------------------------------------
//set variables from form
	$firstName = $_POST['first_name'];
	$lastName = $_POST['last_name'];
	$email = $_POST['email'];
		
		if(isset($_POST['joinML']))
		{  $ml = 'Yes';  	}
		else { $ml = 'No'; 	}
	
	$p1 = trim($_POST['password1']);
	$p2 = trim($_POST['password2']);
	
	$birthDay =  $_POST['birthDay'];
	$birthYear = $_POST['birthYear'];
	$birthMonth = $_POST['birthMonth'];
	
	$problem = false;		//problem flag
	
//ERROR HANDLING ------------------------------------------------	
	//MISSING or INVALID VALUES:	
		//NAME:
		if(empty($_POST['first_name']))
		{
			$problem = true;
			print '<div class="err">Please enter your first name.</div>';
		}
		if(empty($_POST['last_name']))
		{
			$problem = true;
			print '<div class="err">Please enter your last name.</div>';
		}

		//EMAIL:
		if(empty($_POST['email']) || (substr_count($_POST['email'], '@') != 1))
		{
			$problem = true;
			print '<div class="err">Please enter your email address.</div>';
		}
		if((filter_var($email,FILTER_VALIDATE_EMAIL) == false) )
		{
			$problem = true;
			print '<div class="err">Please enter a valid email address.</div>';
		}
	
	//DATE
		if(is_numeric($birthMonth) && is_numeric($birthDay) && is_numeric($birthYear)) //IF ARE NUMBERS
			{
					if(!checkdate($birthMonth, $birthDay, $birthYear) ) //VALID DATE?
					{		
						$problem = true;
						print '<div class="err">The date selected is not correct. 
						Please review and reselect.</div>';
					}
			}
		if(!is_numeric($birthMonth) && !is_numeric($birthDay) && !is_numeric($birthYear)) //IF ARE NOT NUMBERS		
			{
				$problem = true;
				//reset values
				$birthDay = 0;
				$birthMonth = 0;
				$birthYear = 0;
					print '<div class="err">Please select your birth date.</div>';
			}
	
	//PASSWORDS SET
		if(empty($_POST['password1']) || empty($_POST['password2']) )
		{
				$problem = true;
				print '<div class="err">Please enter your password in both fields.</div>';
		}
	//COMPARE PASSWORDS
		if (strcmp($p1,$p2) != 0 )
		{
			$problem = true;
			print '<div class="err">Please re-enter your password in both fields.</div>';
		}
		
//.......................................................................	
//....................................if NO problems.....................
//.......................................................................
if(!$problem)
	{
//CREATE DB & GO TO SUBMIT DATA PAGE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

//INITIAL CONNECTION [assuming database not created yet]
$host = 'localhost';
$user = 'root';
$password ='';
		
//Connect to SQL server
$link = mysqli_connect($host, $user, $password) 
or die("Could not connect!");

//DATA HANDLING & FORMATTING---------------------------------------
	$pw = trim($_POST['password1']);	
	
	$bday = "$birthYear" . "-" . "$birthMonth" . "-" . "$birthDay";
	
//CHECK FOR DATABASE:---------------------------------------------
   
//SEE IF DATABASE EXISTS:
$checkForDB = mysqli_select_db($link, 'mars_db');

if (!$checkForDB) //If not, create
{
	$query = "CREATE DATABASE mars_db";
	
	mysqli_query($link, $query);
	
	include_once('add.php');

}
else {		//If it does, add user
	include_once('add.php');
	}

} //There were no problems, so all done
	
else {//If there were any problems, please try again
	print '<div class="err">Please try again!</div>';
	}
?>	
			