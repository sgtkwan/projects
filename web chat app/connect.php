<?php
$servername = "localhost";
$username = "cps630user";
$password = "cps630dailos";
$databaseName = "cps630db";
// Create connection to db
$conn = new mysqli($servername, $username, $password, $databaseName);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}
else
{
    //echo "Database $databaseName connected successfully! <br>";
}
?>