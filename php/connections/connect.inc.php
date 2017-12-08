<?php

	//Connection
		$host = 'localhost';
		$user = 'root';
		$password ='';
		$database = 'mars_db';
		
		//Connect to DB or die
		$link = mysqli_connect($host, $user, $password, $database) 
		or die("Could not connect to database");


?>