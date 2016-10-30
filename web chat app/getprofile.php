<?php
require 'connect.php';
session_start();

$otherid = $_GET["userID"];
$same = $_GET["same"];

//echo $otherid;

$sql = "SELECT name, about, phone, email, pictureURL FROM profileTable where userID = '$otherid' ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) 
{
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) 
	{
		echo "<h1 id='change'> Profile </h1>";
		if($same == "true")
		{
			echo "<a id='change' href='profile.html' class='btn btn-info btn-lg' role='button'>Edit Profile</a>";
		} 
		echo "<br><img class='img-responsive' src=".$row["pictureURL"]. " alt='profile picture' height='500' width='500'>";
		echo "<h2> Name: </h2> <span id='info'>"  . $row["name"]. "</span>";
		echo "<h2> About: </h2> <p>" . $row["about"]. "</p>";
		echo "<h2> Phone: </h2> <span id='info'>" . $row["phone"]. "</span>";
		echo "<h2> Email: </h2> <span id='info'>" . $row["email"]. "</span> <br> <br>";
	}
} 
else 
{
    echo "0 results";
}	
	
?>