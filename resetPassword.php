<?php 
include("includes/database.php");

if(!isset($_GET['code'])) {
  exit("Can't find the page");
}

// get cold from url 
$code = $_GET['code'];

// compare it with the code in the database
$getEmailQuery = mysqli_query($conn, "SELECT email FROM resetPasswords WHERE code='$code'");
if(mysqli_num_rows($getEmailQuery) == 0) {
  exit("Can't find page");
}

if(isset($_POST['password'])) {
  $pw = $_POST['password'];
  // $pw = md5($pw);
  $pw = password_hash($pw, PASSWORD_DEFAULT); 

  // get the email 
  $row = mysqli_fetch_array($getEmailQuery);
  $email = $row['email'];

  // update the user's password that has a matching email 
  $query = mysqli_query($conn, "UPDATE users SET password='$pw' WHERE email='$email'");

  // if password is updated, delete the reset code 
  if($query) {
    $query = mysqli_query($conn, "DELETE FROM resetPasswords WHERE code='$code'");
    echo '<h1>Click here to log in</h1></br><a href="login.php" class="btn">Login</a>'; 
    exit('Password updated!');
  } else {
    exit('Something went wrong');
  }
}
?>

<form action="" method="post">
  <input type="password" name="password">
  <input type="submit" name="submit" value="Update password">
</form>