<?php 

session_start();
$errors = [];
$user_id = "";
// connect to database
include 'dbconnect.php';
require 'PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->Port=587;
$mail->SMTPAuth=true;
$mail->SMTPSecure='tls';

$mail->Username='ezsystem.developer@gmail.com';
$mail->Password='Ezsystem1!';
// LOG USER IN
if (isset($_POST['login_user'])) {
  // Get username and password from login form
  $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  // validate form
  if (empty($user_id)) array_push($errors, "Username or Email is required");
  if (empty($password)) array_push($errors, "Password is required");

  // if no error in form, log user in
  if (count($errors) == 0) {
    $password = md5($password);
    $sql = "SELECT * FROM participant WHERE email='$user_id' AND password='$password'";
    $results = mysqli_query($conn, $sql);

    if (mysqli_num_rows($results) == 1) {
      $_SESSION['email'] = $user_id;
      $_SESSION['success'] = "You are now logged in";
      header('location: homepage-participant.php');
    }else {
      array_push($errors, "Wrong credentials");
    }
  }
}

/*
  Accept email of user whose password is to be reset
  Send email to user to reset their password
*/
if (isset($_POST['reset-password'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  // ensure that the user exists on our system
  $query = "SELECT * FROM participant WHERE email='$email'";
  $results = mysqli_query($conn, $query);
  $who = mysqli_fetch_array($results, MYSQLI_ASSOC);
  $siapa = $who['username'];

  if (empty($email)) {
    array_push($errors, "Your email is required");
  }else if(mysqli_num_rows($results) <= 0) {
    array_push($errors, "Sorry, no user exists on our system with that email :(");
  }
  // generate a unique random token of length 100
  $token = bin2hex(random_bytes(50));

  if (count($errors) == 0) {
    // store token in the password-reset database table against the user's email
    $sql = "INSERT INTO password_resets(email, token) VALUES ('$email', '$token')";
    $results = mysqli_query($conn, $sql);

    // Send email to user with the token in a link they can click on
    $mail->addAddress($email);
    $mail->setFrom('ezsystem.developer@gmail.com','Reset Password EZSYSTEM');
    $mail->addReplyTo('noreply@ezsystem.com');
    $mail->isHTML(true);
    $mail->Subject='Reset your password on EZSYSTEM';
    $mail->Body="
                    <h3>Hi $siapa! We are here to help you recover your password.</h3> 
                    <p>Click on this <a href=\"http://34.126.78.192/EZSYSTEM/new_password1.php?token=" . $token . "\">link</a> to reset your password on our site </p> 
                ";
    $mail->send();
    header('location: pending.php?email=' . $email);
  }
}

// ENTER A NEW PASSWORD
if (isset($_POST['new_password'])) {
  $new_pass = mysqli_real_escape_string($conn, $_POST['new_pass']);
  $new_pass_c = mysqli_real_escape_string($conn, $_POST['new_pass_c']);

  // Grab to token that came from the email link
  //$token = $_SESSION['token'];
  if (isset($_GET['token']))
            $token = $_GET['token'];
  else
    $token = 0;

  if (empty($new_pass) || empty($new_pass_c)) array_push($errors, "Password is required");
  if ($new_pass !== $new_pass_c) array_push($errors, "Password do not match");
  if (count($errors) == 0) {
    // select email address of user from the password_reset table 
    $sql = "SELECT email FROM password_resets WHERE token='$token' LIMIT 1";
    $results = mysqli_query($conn, $sql);
    $email = mysqli_fetch_assoc($results)['email'];

    if ($email) {
      $new_pass = md5($new_pass);
      $sql = "UPDATE participant SET password='$new_pass' WHERE email='$email'";
      $results = mysqli_query($conn, $sql);
      header('location: login-participant.php');
    }
  }
}
?>