<?php
require 'connect.php';
session_start();

$id1= $_SESSION["userID"]; 
$id2 = $_SESSION["requestedBy"];

$sql = "INSERT INTO chatTable (id1, id2) VALUES ('$id1', '$id2')";

if (mysqli_query($conn, $sql)) 
{
	//echo "New record created successfully for chat table";
} 
else 
{
	//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


?>