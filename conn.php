<?php
 
//MySQLi Procedural
$conn = mysqli_connect("localhost","root","","testing");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
 
?>