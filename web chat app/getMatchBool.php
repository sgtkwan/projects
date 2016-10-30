<?php
require 'connect.php';
session_start();

$match = $_SESSION["matched"];

if ($match == "true")
{
	echo "1";
}
else
{
	echo "0";
} 

?>