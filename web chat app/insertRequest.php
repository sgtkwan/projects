<?php
require 'connect.php';
session_start();
$topics = $_POST["topic"];
$userid = $_SESSION["userID"];

$_SESSION["topic"] = $topics;

$sql = "SELECT userID FROM requestTable where userID = '$userid'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) 
{
	$sql = "DELETE FROM requestTable WHERE userID = '$userid'";
	if (mysqli_query($conn, $sql)) 
	{
		//echo "Old record deleted! <br>";	
	}
	else 
	{
		//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}



$sql = "INSERT INTO requestTable (userID, topics) VALUES ('$userid', '$topics')";

if (mysqli_query($conn, $sql)) 
{
	//echo "New record created successfully <br>";
	$id = mysqli_insert_id($conn);
	$_SESSION["requestID"] = $id; 
} 
else 
{
	//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>