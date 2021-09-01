<?php if (!isset($_SESSION)){session_start();}?>
<?php 
  if(isset($_SESSION["email"])){
    if ($_SERVER["SERVER_NAME"] == "localhost") {
      header("Location: index.php");
      exit;
  } elseif ($_SERVER["SERVER_NAME"] == "liviobortolin.bplaced.net") {
    if (!headers_sent()) {
      header_remove(); 
      header("Location: index.php");
      exit;
    }
  }
}
$info = "";
if (empty($_SESSION['logininfo'])){
  $info = "";
}else{
  $info = $_SESSION['logininfo'];
  $_SESSION['logininfo'] = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>LBO login</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="description" content="All Rights Reserved">
  <meta name="author" content="Livio Bortolin">

  <!-- Favicons -->
  <link href="view/images/logo.ico" rel="icon">
  <link href="view/images/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Libraries CSS Files -->
  
  <!-- Main Stylesheet File -->
  <link rel="stylesheet" href="view/css/login.css">
  
</head>
<body>
<div class="login_bg_img"></div>
<div class="form_wrapper">
  <div class="form_container">
    <div class="title_container">
      <h2>Login</h2>
    </div>
    <form action="model/logincheck.php" method="post">
      <div class="row clearfix">
        <div>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
            <input type="email" name="email" placeholder="Email" required/>
          </div>
        </div>
        <div>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
            <input type="password" name="password" placeholder="Password" required/>
          </div>
        </div>
      </div>
      <?php printf("<p>$info</p>") ?>
      <input class="button" type="submit" name="submit" value="Sign in"/>
      <input class="button" type="button" onclick="window.location.href='register.php';" name="register"  value="Sign Up">
      <input class="button" type="button" onclick="window.location.href='passwordreset.php';" name="forgotpassword"  value="Forgot Password">
      <input class="button" type="button" onclick="window.location.href='index.php';" name="homepage"  value="Back to Homepage">
    </form>
  </div>
</div>
<footer class="fixedfooter">
    <p>&copy; Copyright <strong>LBO</strong></p>
</footer>
</body>
</html>