<?php
require 'connect.php';
session_start();

$userid = $_SESSION["userID"];
$sql = "SELECT userID FROM requestTable WHERE userID = '$userid' AND requestedBy <> 0 AND status = 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) 
{
	$sql = "SELECT requestedBy FROM requestTable WHERE userID = '$userid' AND requestedBy <> 0 AND status = 1";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) 
	{
		while($row = mysqli_fetch_assoc($result)) 
		{
			echo "You have been matched user: " . $row["requestedBy"] . "<br>";
			$requestedBy = $row["requestedBy"];
			$_SESSION["requestedBy"] = $requestedBy;
		}
		$_SESSION["matched"] = "true"; 
		
		$sql =  "UPDATE requestTable SET requestedBy = '$userid', status = 1 WHERE userID = '$requestedBy' AND requestedBy = 0 AND status IS NULL";
		if (mysqli_query($conn, $sql)) 
		{
			//echo "Matched User Record Updated! <br>";
	
		} 
		else 
		{
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
	}
	else 
	{
		//echo "Error: 0 requested match";
	}
}
else 
{
    //echo "No one matched you";
    $_SESSION["matched"] = "false"; 
}



?>