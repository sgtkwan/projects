<?php
require 'connect.php';
session_start();

$userid = $_SESSION["userID"];
$topic = $_SESSION["topic"];

$otheruserid = $_POST["id"];

$sql = "UPDATE requestTable SET requestedBy = '$userid', status = 1 WHERE userID = '$otheruserid' AND topics = '$topic' AND requestedBy = 0 AND status IS NULL";

if (mysqli_query($conn, $sql)) 
{
	//echo "Record Updated! <br>";
	
} 
else 
{
	//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}



?>