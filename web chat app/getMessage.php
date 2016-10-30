<style>
.msgContainer{
	position: relative;
	left: 50%;
	width: 45%;
	margin:20px;
	padding: 25px;
	border-radius: 40px 15px 5px 15px;
	border: 1px solid black;
	background-image: -webkit-linear-gradient(bottom, rgb(26,214,253) 25%, rgb(29,98,240) 100%);
	background-image: -o-linear-gradient(bottom, rgb(26,214,253) 25%, rgb(29,98,240) 100%);
	background-image: -moz-linear-gradient(bottom, rgb(26,214,253) 25%, rgb(29,98,240) 100%);	
	background-image: -ms-linear-gradient(bottom, rgb(26,214,253) 25%, rgb(29,98,240) 100%);
	background-image: -webkit-gradient(
	linear,
	left bottom,
	left top,
	color-stop(0.25, rgb((26,214,253)),
	color-stop(1, rgb(29,98,240))
);
}

</style>
<?php
require 'connect.php';
session_start();
$userid = $_SESSION["userID"];
$chatID;
$sql = "SELECT chatID FROM chatTable WHERE id1 = '$userid' OR id2 = '$userid'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) 
{
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) 
    {
	$chatID = $row["chatID"]; 
        $_SESSION["chatID"] = $row["chatID"];
    }
} 
else 
{
    //echo "0 results";
}

$sql = "SELECT message, senderID, reg_date FROM messageTable WHERE chatID = '$chatID' AND senderID <> '$userid'  AND status IS NULL";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) 
{
    
    while($row = mysqli_fetch_assoc($result)) 
    {
	$msg = $row["message"];
	$senderID = $row["senderID"];
	$timestamp = $row["reg_date"];
	$userName = getUserName($conn, $senderID);
	
	$userprofile="http://babbletxt.com/profile.html?userID=".$senderID ;
	$getprofileicon= "SELECT pictureURL FROM profileTable WHERE userID ='$senderID'";
	$result2 = mysqli_query($conn, $getprofileicon);
	$row2=mysqli_fetch_assoc($result2);
	$profileicon=$row2["pictureURL"];
	echo "<div class ='msgContainer'>
		<div class='userName'>
		<span class='glyphicon glyphicon-hand-right'></span>
		<img src='$profileicon' style='width:50px;height:50px;'>
		<b> <a href=$userprofile target='_blank'>$userName</a></b> says: 
		</div>
		<div  class='msg'> $msg </div><br>
		<div class='timeOfMSG' style='color:grey;font-size:8px'> sent at: <b><i> $timestamp</i> PST</b></div>
		<br>
		</div> ";
	echo '<script type="text/javascript">'
	   , 'ScrollToBottom();'
	   , '</script>';
		
	$sql = "UPDATE messageTable SET status = 1 WHERE chatID = '$chatID' AND senderID = '$senderID' AND reg_date = '$timestamp' AND status IS NULL";
    	if (mysqli_query($conn, $sql)) 
    	{ 
    	} 
    	else 
    	{
		//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    	}
    }
   
} 
else 
{
}

function getUserName($conn, $userID)
{

$sql = "SELECT userName FROM usersTable WHERE userID = '$userID'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) 
{
    // output data of each row
	while($row = mysqli_fetch_assoc($result)) 
	{
		return $row["userName"];
	}
} 
else 
{
	return "0 results";
}

}



?>