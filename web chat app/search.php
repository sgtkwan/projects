<?php
require 'connect.php';
$topic = $_POST['topic']; 



function insert($conn, $topic, $status, $latitude, $longitude)
{
	$sql = "INSERT INTO requestTable (userID, topics, status, latitude, longitude) VALUES ( '$userID', '$topic', 1, 0.0, 0.0)";
	if (mysqli_query($conn, $sql)) 
	{
		//echo "Request is sucessfully inserted! <br>";
	} 
	else 
	{
		//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}

function search($conn, $userID, $topic)
{	
	$sql = "SELECT userID FROM requestTable where topics = '$topic' ";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) 
	{
		return true;
	} 
	else 
	{
		return false;
	}
}

function searchDistance($conn, $userID, $latitude, $longitude)
{
	$sql = "SELECT userID FROM requestTable where latitude = '$latitude' AND longitude = '$longitude'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) 
	{
		return true;
	} 
	else 
	{
		return false;
	}
}


mysqli_close($conn);
?>