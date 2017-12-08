<?php
session_start();
define('TITLE', 'MARS 2045  --  View Your Entry:  --');  
include('templates/header.html');

print "
<!-- HEADER -->	<header>View Your Entry</header> <!-- end HEADER -->
<!-- Display details from database -->";

/*---------------------------------------------------------------*/
/*FUNCTIONS*/
/*---------------------------------------------------------------*/
	//Function to print the form:~~~~~~~~~~~~~
	function login(){
		echo '<div class="overall">';	
		echo '<p>Enter your username and password to view your submission.</p>';
		echo '<form id="login-form" name="form" method="post" action="showentry.php" enctype="multipart/form-data">';		
		echo '<fieldset>';
		echo '<legend>Login:</legend>';
		echo '<label for="email">Login:</label>';
		echo '<input type="text" name="email" id="email" size="25" placeholder="email@emaildomain.com"/><br/>';
		echo '<label for="pw">Password:</label>';
		echo '<input type="password" name="pw" id="pw" size="25" maxlength="55" placeholder="*****" /><br/>';
		echo '<input class="btn" type="submit" value="LOG IN"/>';
		echo '</fieldset></form>';
		}
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	
	//Function to show entry:~~~~~~~~~~~~~~~~~~~~~~
	function showEntry (){
		
	include_once('connections/connect.inc.php');	

	//If session is NOT set, login
if(!isset($_SESSION['userID']))
	{		
			$email = mysqli_real_escape_string($link, $_POST['email']);
			$psswd = mysqli_real_escape_string($link, $_POST['pw']);
			
			$queryFirstLogin = 
			"SELECT * FROM tblsubmissions 
			WHERE email='" . $email . 
			"' AND password='" . $psswd . "'";
			
			$result = mysqli_query($link, $queryFirstLogin);

				if (mysqli_num_rows($result) > 0)	//Testing if any records exist	
				{
				echo '<div class="overall"><table>';
				echo '<th>Entry Details:</th>';
				
					while ($row = mysqli_fetch_array($result) )		
					{
						echo '<tr>';
						echo '<td>';
						
						print "Name: " . $row['lastName'] . ", " . $row['firstName'] . "<br/>" . 
							"Email: " . $row['email'] . "<br/>" .
							"Birthdate: " . $row['birthdate'] . "<br/>" .
							"On Mailing List: " .  $row['ml'];							
							
				//Assigning your SESSION data				
				$_SESSION['userID'] = $row['id'];
				$_SESSION['userName'] = $row['firstName'];	
						
						echo '</tr>';
						echo '</td>';
					}	
				echo '</table>';
				
				echo '<form name="logout" action="logout.php">
				<input class="btn" type="submit" value="LOGOUT"/>
				</form>';	

				}
				
				else 
				{//If no submissions found, show form & error:
				print '<div class="overall"><p class="err">Your email and/or password do not match, 
				or you have no entries. Please try again. </p></div>';		
				login();
				}

	}//END IF SESSION NOT SET handler
	
else {//If session IS set
		$queryLoggedIn = "SELECT * FROM tblsubmissions
							WHERE id='" . $_SESSION['userID'] . "'";
							
		$result = mysqli_query($link, $queryLoggedIn);

			if (mysqli_num_rows($result) > 0)	//Testing if any records exist	
				{
				echo '<div class="overall"><table>';
				echo '<th>Entry Details:</th>';
				
					while ($row = mysqli_fetch_array($result) )		
					{
						echo '<tr>';
						echo '<td>';
						
						print "Name: " . $row['lastName'] . ", " . $row['firstName'] . "<br/>" . 
							"Email: " . $row['email'] . "<br/>" .
							"Birthdate: " . $row['birthdate'] . "<br/>" .
							"On Mailing List: " .  $row['ml'];
						
						echo '</tr>';
						echo '</td>';
					}
	
				echo '</table>';	
														
				echo '<form name="logout" action="logout.php">
				<input class="btn" type="submit" value="LOGOUT"/>
				</form>';
				}
				
	}//END IF SESSION IS SET handler
	
				mysqli_close($link);
				
}/*---------------------------------------------------------------*/
	/*END OF FUNCTIONS*/
/*---------------------------------------------------------------*/
/*
/*Login Form Handler:*/
//If FORM submitted:*/	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{	
		showEntry();	
	}
	
	else if (isset($_SESSION['userName']))
	{
		echo '<p class="overall">Hello <em>' . $_SESSION['userName'] . '</em>. 
		Please logout when you are finished.</p>';
		
		showEntry();		
	}

	else {//If not post, they're probably just accessing the form, so show it:					
		login();	
		}
	
include('templates/footer.html'); 
?>