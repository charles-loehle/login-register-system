<?php 

$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'phptutorial';

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if($conn) {
  // echo "Connected";
} else {
  die("Connection Error");
}

?>