<?php
$host="localhost";
$user="root";
$password="";
$db="sia";

$connection = mysqli_connect($host,$user,$password,$db);
if (!$connection){
	  die("Database tidak tersambung!:".mysqli_connect_error());
} 
?>
