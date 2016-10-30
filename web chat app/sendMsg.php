<style>
.msgContainerReciever {
	position: relative;
	width:45%;
	left 25%;
	padding: 25px;
	margin:20px;
	border-radius: 15px 50px 15px 5px;
	border: 1px solid black;
	background-image: -webkit-linear-gradient(bottom, rgb(135,252,112) 25%, rgb(11,211,24) 100%);
	background-image: -o-linear-gradient(bottom, rgb(135,252,112) 25%, rgb(11,211,24) 100%);
	background-image: -moz-linear-gradient(bottom, rgb(135,252,112) 25%, rgb(11,211,24) 100%);	
	background-image: -ms-linear-gradient(bottom, rgb(135,252,112) 25%, rgb(11,211,24) 100%);
	background-image: -webkit-gradient(
	linear,
	left bottom,
	left top,
	color-stop(0.25, rgb((135,252,112)),
	color-stop(1, rgb(11,211,24))
);

}
</style>
<?php
require 'connect.php';
session_start();

$chatID = $_SESSION["chatID"];
$userID = $_SESSION["userID"];
$msg = $_POST["message"];
$userprofile="http://babbletxt.com/profile.html?userID=".$userID;
$sql = "INSERT INTO messageTable (chatID, senderID, message) VALUES ('$chatID', '$userID', '$msg')";


if (mysqli_query($conn, $sql)) 
{
	$id = mysqli_insert_id($conn);
	$sql = "SELECT message, senderID, reg_date FROM messageTable WHERE messageID = '$id'";
	$result = mysqli_query($conn, $sql);
	$getprofileicon= "SELECT pictureURL FROM profileTable WHERE userID ='$userID'";
	$result2 = mysqli_query($conn, $getprofileicon);
	if (mysqli_num_rows($result) > 0) 
	{
	    // output data of each row
	    $row2=mysqli_fetch_assoc($result2);
	    while($row = mysqli_fetch_assoc($result)) 
	    {
		    	$msg = $row["message"];
			$senderID = $row["senderID"];
			$timestamp = $row["reg_date"];
			$profileicon=$row2["pictureURL"];
			$userName = getUserName($conn, $senderID);
			
		echo "<div class='msgContainerReciever '>
			<div class='userName' style='color:blue'>
			<img src='$profileicon' style='width:50px;height:50px;'>
			<span class='glyphicon glyphicon-hand-left'></span> <b><a href=$userprofile target='_blank'>$userName</a></b> says:
			</div>
			
			<div  class='msg'> $msg </div>	<br>
			<div class='timeOfMSG' style='color:grey;font-size:8px'> sent at: <b><i> $timestamp</i> PST</b> </div>
			<br>
			</div> ";
		echo '<script type="text/javascript">'
		   , 'ScrollToBottom();'
		   , '</script>';
	    }
	} 
	else 
	{
		//echo "Unable to print your own msg.";
	}
} 
else 
{
    //echo "sendMSG.php: Error: " . $sql . "<br>" . mysqli_error($conn);
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