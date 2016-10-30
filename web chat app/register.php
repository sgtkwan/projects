<?php
require 'connect.php';
$username = $_POST['rUserName']; 

$password = $_POST['rPassword'];

$rePassword = $_POST['rePassword'];


if(user_exists($conn, $username))
{
	echo "The username that you have chosen is already taken, please try a different username!";
}
else
{
	if ($password != $rePassword)
	{
		echo "The two passwords are not the same.";
	}
	else if(($password == NULL) && ($rePassword == NULL))
	{
		echo "The passwords cannot be empty";
	}
	else
	{
	
		$sql = "INSERT INTO usersTable (userName, password) VALUES ('$username', '$password')";

		if (mysqli_query($conn, $sql)) 
		{
			echo "An account has been created successfully! Please login to proceed!";
			$id = mysqli_insert_id($conn);
		} 
		else 
		{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
		$sql = "INSERT INTO profileTable (userID, name, about, phone, email, pictureURL) VALUES ('$id', 'N/A', 'N/A', 'XXX-XXX-XXXX', 'xxxx@email.com', 'http://orig11.deviantart.net/f861/f/2015/105/3/1/gohan_facebook_profil_by_mjd360-d8ps1w3.jpg')";

		if (mysqli_query($conn, $sql)) 
		{
			//echo " A default profile has been created for you!";
		} 
		else 
		{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
}


function user_exists($conn, $username)
{
	$sql = "SELECT userName FROM usersTable where userName = '$username' ";

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