<?php 

// check if submit button was clicked
if(isset($_POST['submit'])) {
  require 'database.php';

  // get username and password from the form 
  $username = $_POST['username'];
  $password = $_POST['password'];

  // echo '<pre>';
  // var_dump($username, $password);
  // echo '</pre>';
  // exit();

  // echo '<pre>';
  // var_dump(empty($username), empty($password));
  // echo '</pre>';
  // exit();

  // if any form fields are empty, redirect 
  if(empty($username) || empty($password)) {
    header('Location: ../index.php?error=emptyfields');
    exit('ERRRROOOOOOOOOOOORRRRRRRR!!!!!!!');
  } else {
    // if all fields are filled out, execute the query 
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_stmt_init($conn);
    // if the query doesn't find a match, exit 
    if(!mysqli_stmt_prepare($stmt, $sql)) {
      header('Location: ../index.php?error=sqlerror');
      exit();
    } else {
      // if the query finds a match, bind params
      mysqli_stmt_bind_param($stmt, "s", $username);
      // execute the query 
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      echo '<pre>';
      var_dump($result);
      echo '</pre>';

      if($row = mysqli_fetch_assoc($result)) {
        $passCheck = password_verify($password, $row['password']);
        if($passCheck == false) {
          header('Location: ../login.php?error=wrongpass');
          exit();
        } else if($passCheck == true) {
          session_start();
          $_SESSION['sessionId'] = $row['id'];
          $_SESSION['sessionUser'] = $row['username'];
          header('Location: ../index.php?success=loggedin');
          exit();
        } else {

        }
      } else {
        header('Location: ../index.php?error=nouser');
        exit();
      }
    }
  }

} else {
  header('Location: ../index.php?error=accessforbidden');
  exit();
}