<?php require_once "includes/header.php" ?>

<?php require_once 'includes/register-inc.php'; ?>

<div class="container">

  <div class="form-container">
    <form class="register-form" action="includes/register-inc.php" method="post">
      <h1>Register</h1>
      <p>Already have an account? <a href="login.php">Log in here</a></p>
      <input class="register-form-input" type="text" name="username" placeholder="Username">
      <input class="register-form-input" type="email" name="email" placeholder="Email">
      <input class="register-form-input" type="password" name="password" placeholder="Password">
      <input class="register-form-input" type="password" name="confirmPassword" placeholder="Confirm Password">
      <button class="btn" type="submit" name="submit">Register</button>
    </form>
  </div>

</div>