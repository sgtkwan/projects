<?php
require 'connect.php';
session_start();

$userid = $_SESSION["userID"];
$name = $_POST["name"];
$about = $_POST["about"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$pictureURL = $_POST["pictureURL"];

$sql = "UPDATE profileTable SET name = '$name', about = '$about', phone = '$phone', email = '$email', pictureURL = '$pictureURL' WHERE userID = '$userid' ";

if (mysqli_query($conn, $sql)) 
{
	echo "Record Updated! <br>";	
} 
else 
{
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}



?>