<?php require_once 'includes/header.php'; ?>

<?php 

  if(isset($_SESSION['sessionId'])) {
    echo '<h1>Welcome ' . $_SESSION['sessionUser'] . ', you are logged in</h1>';
  } 
  else {
    echo '<h1>You are logged out</h1>';
    echo '<h1>Click here to log in</h1></br><a href="login.php" class="btn">Login</a>'; 
  }


?>

<?php require_once 'includes/footer.php'; ?>