<?php 

include_once 'config.php';

$conn = mysqli_connect(URL, USER, PASS, DB);

if($conn) {
  // echo "Connected";
} else {
  die("Connection Error");
}

?>