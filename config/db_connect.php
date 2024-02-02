<?php

// connect to database
$conn=mysqli_connect('localhost', 'aki', '115116Ay', 'ramen_hunter');
  
//check connection  ( **NOT WORKING!**)
	if(!$conn){
		echo 'Connection error'.mysqli_connect_error();
	}


?>