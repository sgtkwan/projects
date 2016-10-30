<?php
$servername = "localhost";
$username = "cps630user";
$password = "cps630dailos";
$databaseName = "cps630db";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully <br>";

//Create db is not exists:
$sql = "CREATE DATABASE IF NOT EXISTS $databaseName";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
else
{
echo "Database $databaseName created successfully! <br>";
}

// Create connection to db
$conn = new mysqli($servername, $username, $password, $databaseName);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}
else
{
echo "Database $databaseName connected successfully! <br>";
}

// sql to create usersTable
$sql = "CREATE TABLE IF NOT EXISTS usersTable (
userID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
userName VARCHAR(30) NOT NULL,
password VARCHAR(30) NOT NULL,
reg_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) 
{
    echo "Table usersTable created successfully! <br>";
} else {
    echo "Error creating usersTable: " . $conn->error;
}

//Create request table
$sql = "CREATE TABLE IF NOT EXISTS requestTable (
requestID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
userID INT(6) NOT NULL,
topics VARCHAR(50) NOT NULL,
requestedBy INT(11),
status INT(1) NOT NULL,
latitude FLOAT NOT NULL,
longitude FLOAT NOT NULL,
reg_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) 
{
    echo "Table requestTable created successfully! <br>";
} else {
    echo "Error creating requestTable: " . $conn->error;
}

//Create chat table
$sql = "CREATE TABLE IF NOT EXISTS chatTable (
chatID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
id1 INT(11) NOT NULL,
id2 INT(11) NOT NULL,
status INT(1) NOT NULL,
reg_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) 
{
    echo "Table chatTable created successfully! <br>";
} else {
    echo "Error creating chatTable: " . $conn->error;
}

//Create message table
$sql = "CREATE TABLE IF NOT EXISTS messageTable (
messageID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
chatID INT(6) NOT NULL,
senderID INT(6) NOT NULL,
status INT(1) NOT NULL,
message VARCHAR(100) NOT NULL,
reg_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) 
{
    echo "Table messageTable created successfully! <br>";
} else {
    echo "Error creating messageTable: " . $conn->error;
}






?>