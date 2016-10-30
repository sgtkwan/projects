<?php
require 'connect.php';

session_start();

$userid = $_SESSION["userID"];
$topic = $_SESSION["topic"];

$sql = "SELECT userID FROM requestTable where userID <> '$userid' AND topics = '$topic' AND requestedBy = 0 AND status IS NULL";

$result = mysqli_query($conn, $sql);

echo "
<div id='matchtb' class='container'>
  <h2>List of matches</h2>
  <div class='table-responsive'>      
   Expanding Search...<span class='glyphicon glyphicon-refresh spinning'></span><br>  
  <table class='table table-striped'>
    <thead>
      <tr>
        <th><br>Username</br></th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>";

if (mysqli_num_rows($result) > 0) 
{
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) 
	{
		echo "<tr>";
		echo "<td>" .  getUserName($conn, $row["userID"]) . "</td>";
		echo "<td><button id = \"" . $row["userID"] . "\" class = \"selectUser\">Select</button></td>";
		echo "</tr>";
	}
} 
else 
{
    echo "No matches found. Please wait while we exhaust all our efforts to expand our search.<span class='glyphicon glyphicon-refresh spinning'></span><br>";
}

echo "</tbody>
  </table>
  </div>
</div>";

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