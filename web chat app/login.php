<?php
require 'connect.php';
$username = $_POST['userName']; 
$password = $_POST['passWord'];
session_start();


if($username == NULL)
{
	echo "The username cannot be empty";
}
elseif ($password == NULL){
	echo "The password cannot be empty";
}
else
{
if(password_matches($conn, $username, $password))
{
	$_SESSION["loggedIn"] = true;
	$_SESSION["username"]=$username;
	get_userID($conn, $username);
	echo '<script type="text/javascript"> window.location = "http://babbletxt.com/homepage.html" </script>';
}
else
{
	echo "Username and Password does not match!";
}
}

function password_matches($conn, $username, $password)
{
	$sql = "SELECT password FROM usersTable where userName = '$username' ";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) 
	{
		while($row = mysqli_fetch_assoc($result)) 
		{
		 
			if ($row["password"] === $password)
			{
				//echo "Case 1";
				return true;
			}
			else
			{
				//echo "Case 2";
				return false;
			}
		}
	} 
	else 
	{
		//echo "Case 3";
		return false;
	}
}

function get_userID($conn, $username)
{
	$sql = "SELECT userID FROM usersTable where userName = '$username' ";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) 
	{
		while($row = mysqli_fetch_assoc($result)) 
		{
			$_SESSION["userID"] = $row["userID"];
		}
	} 
	else 
	{
		//echo "Case 3";
		return false;
	}
}

mysqli_close($conn);
?>