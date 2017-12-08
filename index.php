<?php 
session_start();
define('TITLE', 'MARS 2045  --  Register for Sweepstakes:  --');  
include('templates/header.html');
?>		
	
<!-- HEADER -->			
	<header>Want to win an exclusive trip to Mars?<br/>Sign up here!</header>		
<!-- end HEADER -->

<div class="overall">		

<p>The grand prize winner will receive two tickets on the first space mission to colonize Mars, taking off on June 24th, 2045.</p>
<p> The trip includes complementary breakfast every day of the 4 year trip (that's 1,460 breakfasts per passenger!), a complementary tour of the space shuttle, and an exclusive guided Mars walk upon arrival. Don't miss out! Submit your entry below!
</p>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{include_once('handler.php');} 

else print '<p>Already have an entry? <a href="showentry.php">Login here</a> to view your information.</p>'; 
?>

<h2>Submission Form:</h2>	

<form id="form" name="form" method="post" action="index.php" enctype="multipart/form-data">
	
<fieldset>
	<legend>Personal Information:</legend>
	<input type="hidden" name="source" value="from-form">
	
	<label for="first_name">First Name:</label>
		<input type="text" name="first_name" id="first_name" size="20" maxlength="55" 
		value="<?php if (isset($_POST['first_name']) && $problem) { print htmlspecialchars($_POST['first_name']); }	else {print "";}?>" />
		<br />
	<label for="last_name">Last Name:</label>
	<input type="text" name="last_name" id="last_name" size="20" maxlength="55" 
	value="<?php if (isset($_POST['last_name']) && $problem) { print htmlspecialchars($_POST['last_name']); }	?>"   />
	<br />
	<label for="email">Email Address:</label>
		<input type="text" name="email" id="email" size="25" placeholder="email@domain.com" 
		value="<?php if (isset($_POST['email']) && $problem) { print htmlspecialchars($_POST['email']); }	?>" />
		
	<br/>Birth date:
		<select name="birthMonth" id="month" size="1">
		<option>Month:</option>
		
		<?php
//MONTH
for ($birthMonth = 1; $birthMonth <= 12; $birthMonth++)
		{print '<option value="' . $birthMonth . '">' 
		. $birthMonth . '</option>';
				}
		print "</select>";		
		
//DAY
		print '<select name="birthDay" id="day" size="1">
		<option>Day:</option>';

		for ($birthDay = 1; $birthDay <= 31; $birthDay++)
		{
			print '<option value="' . $birthDay . '">' 
			.  $birthDay . '</option>';
		}		
		print '</select>';
		
//YEAR
		print '<select name="birthYear" id="year" size="1" >
		<option>Year:</option>';
		
		FOREACH (range(2017,1900) AS $birthYear)
		{
			print '<option value="' . $birthYear . '">' 
			.  $birthYear . '</option>';
		}
		print '</select>';
		?>
	
</fieldset>
<fieldset><legend>Account Creation:</legend>
		<label for="password1">Create a Password:</label>
	<input type="password" name="password1" id="password1" size="20" maxlength="55"  />
	<br />
		<label for="password2">Re-type Password:</label>
	<input type="password" name="password2" id="password2" size="20" maxlength="55"  />
	<br />	
	
</fieldset>
	
<fieldset><legend>Other Info:</legend>
	<label for="joinML">Join the MARS 2045 Mailing list? (optional)</label>
		<input type="checkbox" name="joinML" id="joinML" checked="checked" /></fieldset>

<input class="btn" type="submit" value="CLICK TO SUBMIT ENTRY"/>
		
</form>

<?php include('templates/footer.html'); ?>