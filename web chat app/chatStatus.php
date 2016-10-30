<?php
require 'connect.php';
session_start();
$cID=$_SESSION["chatID"];


$sql =  "SELECT status FROM chatTable WHERE chatID= '$cID'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) 
{

	while($row = mysqli_fetch_assoc($result)) 
	{
		echo $row["status"] ;
	}
} 
else 
{
	//echo "0 Results for chatStatus";
}


?>