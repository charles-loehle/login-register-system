<?php require_once "includes/header.php" ?>

<?php echo "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER["PHP_SELF"]) . "/resetPassword.php?code=12341234"; ?>
<!-- http://localhost/CodeWithDary/login-register-system/resetPassword.php?code=12341234 -->

<?php 
  if (isset($_GET['error'])) {
    echo '<h1>Your password is incorrect</h1>';
}

?>

<div class="container">

  <div class="form-container">
    <form class="login-form" action="includes/login-inc.php" method="post">
    <h1>Log In</h1>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
      <input class="login-form-input" type="text" name="username" placeholder="Username">
      <input class="login-form-input" type="password" name="password" placeholder="Password">
      <button class="btn" type="submit" name="submit">Log In</button>
      <br>
      <p><a href="requestReset.php">forgot your password?</a></p>
    </form>
  </div>

</div>