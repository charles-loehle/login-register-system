<?php 

$username = '';
$email = '';
$password = '';
$confirmPass = '';

// check if submit button was clicked
if(isset($_POST['submit'])) {
  require 'database.php';

  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPass = $_POST['confirmPassword'];

  // var_dump($email); exit;

// if any field is empty, redirect to register page 
if(empty($username) || empty($email) || empty($password) || empty($confirmPass)) {
    header('Location: ../register.php?error=emptyfields&email='.$email.'&username='.$username);
    exit();

  // if all fields are completed, validate username and password
  } else if(!preg_match('/^[a-zA-Z0-9]*/', $username)){
    header('Location: ../register.php?error=invalidusername&username='.$username);
    exit();
  } else if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', $email)){
    header('Location: ../register.php?error=invalidemail&email='.$email);
    exit();
  } else if($password !== $confirmPass){
    header('Location: ../register.php?error=passwordsdonotmatch&username='.$username);
    exit();

  // if username, email and password are validated, run the query 
  } else {
    // get the user by username  
    $sql = "SELECT username FROM users WHERE username = ?";

    // prepared statement 
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
      header('Location: ../register.php?error=sqlerror');
      exit();
    } else {
      // bind parameters then run the statement
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result();

      // assign query results to a variable
      $rowCount = mysqli_stmt_num_rows($stmt);

      // if the username is taken, redirect to register page
      if($rowCount > 0) {
        header('Location: ../register.php?error=usernametaken');
        exit();
      } else {
        // if username is not taken, save the new user 
        $sql = 'INSERT INTO users (username, email, password) VALUES (?, ?, ?)';
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header('Location: ../register.php?error=sqlerror');
          exit();
        } else {
          // hash the password 
          // PASSWORD_DEFAULT - Use the bcrypt algorithm (default as of PHP 5.5.0). Note that this constant is designed to change over time as new and stronger algorithms are added to PHP. For that reason, the length of the result from using this identifier can change over time. 
          $hashedPass = password_hash($password, PASSWORD_DEFAULT);
          // bind parameters then run the statement
          mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPass);
          mysqli_stmt_execute($stmt);
          header('Location: ../register.php?success=registered');
          exit();
        }
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}