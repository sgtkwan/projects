<?php
require 'connect.php';
session_start();

$userid = $_SESSION["userID"];

$sql =  "DELETE FROM chatTable WHERE id1 = '$userid' OR id2 = '$userid' AND status = 1";
if (mysqli_query($conn, $sql)) 
{
	//echo "ChatID entry is deleted";
} 
else 
{
	//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}