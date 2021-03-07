<?php require_once "includes/header.php" ?>

<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'includes/database.php';

if(isset($_POST['email'])) {
  $emailTo = $_POST['email'];

  // echo '<pre>';
  // var_dump($emailTo);
  // echo '</pre>';

  $code = uniqid(true);
  // echo '<pre>';
  // var_dump($code);
  // echo '</pre>';
  $query = mysqli_query($conn, "INSERT INTO resetPasswords (code, email) VALUES ('$code', '$emailTo')");
  if(!$query) {
    exit('Error');
  }

  //Instantiation and passing `true` enables exceptions
  $mail = new PHPMailer(true);

  try {
      //Server settings
      $mail->isSMTP();                                            //Send using SMTP
      // $mail->SMTPDebug = 2; // Very helpful!!!!

      // mailtrap settings are working
      $mail->Host       = 'smtp.mailtrap.io';  //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'f89e63b7d47ea7'; 
                  //SMTP username
      $mail->Password   = '7558e7aac2af37';  //SMTP password
      
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
      $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

      //Recipients
      $mail->setFrom('loginRegisterSystemapp@example.com', 'TestApp');
      $mail->addAddress($emailTo);     //Add a recipient
      $mail->addReplyTo('no-reply@loginRegisterSystem.com', 'No reply');

      // //Attachments
      // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

      //Content
      $url = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER["PHP_SELF"]) . "/resetPassword.php?code=$code";
      // http://localhost/CodeWithDary/login-register-system/resetPassword.php?code=12341234

      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Reset Password Link from CodeWithDary login-register-system app';
      $mail->Body    = "<p>To reset your password  <a href='$url'>click here</a></p>";
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $mail->send();
      echo 'Reset password link has been sent to your email';
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
  exit();
}
?>

<div action="" class="form-container">
  <!-- password reset request form -->
  <form class="request-reset-form" action="" method="post">
    <input class="request-reset-form-input" type="text" name="email" placeholder="Email" autocomplete="on">
    <br>
    <input class="request-reset-form-input btn" type="submit" name="submit" value="Password reset email">
  </form>
</div>