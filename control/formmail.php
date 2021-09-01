<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
//$empfaenger = "livio.bortolin@edu.tbz.ch";
$info = "";
//$text = "Hier lernt Ihr, wie man mit PHP Mails verschickt";
//$info = [];

if(isset($_POST['submit'])){

  //$empfaenger = "livio.bortolin@edu.tbz.ch";
  $headers = "From: lbo <mail@lbo.ch>";
  //$text = "Hier lernt Ihr, wie man mit PHP Mails verschickt";

  $info = [];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $to = $_POST['email'];
  $message = $_POST['message'];
  $robotest = $_POST['robotest'];
  $headers = "";

  if (empty($firstname)) {
    $info[] = 'firstname is empty';
    $_SESSION['forminfo'] = $info;
  }

  if (empty($lastname)) {
    $info[] = 'lastname is empty';
    $_SESSION['forminfo'] = $info;
  }

  if (empty($email)) {
    $info[] = 'Email is empty';
    $_SESSION['forminfo'] = $info;
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $info[] = 'Email is invalid';
    $_SESSION['forminfo'] = $info;
  }

  if (empty($message)) {
    $info[] = 'Message is empty';
    $_SESSION['forminfo'] = $info;
  }elseif(empty($robotest)){
    $subject = "Contact Form send from $firstname $lastname";
    $headers = 'From: lbo <mail@lbo.ch>' . "\r\n";
    mail($to, $subject, $message, $headers);
    $info = "Form sent successfully";
    $_SESSION['forminfo'] = $info;
    if ($_SERVER["SERVER_NAME"] == "localhost") {
      header("Location: ../index.php");
      exit;
    } elseif ($_SERVER["SERVER_NAME"] == "liviobortolin.bplaced.net") {
      if (!headers_sent()) {
        header_remove();
        header("Location: ../index.php");
        exit;
      }
    }
  }else{
    $info = "Robotest success! Form not sent!";
    $_SESSION['forminfo'] = $info;
  }
}
?>