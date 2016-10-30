<?php
require 'connect.php';
session_start();

$cID=$_SESSION["chatID"];

$sql =  "UPDATE chatTable SET status = 1 WHERE chatID= '$cID'";
if (mysqli_query($conn, $sql)) 
{
	//echo "Chat has been sucessfully closed.";
} 
else 
{
	//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


?>