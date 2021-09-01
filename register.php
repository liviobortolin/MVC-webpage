<?php if (!isset($_SESSION)){session_start();}?>
<?php 
$reginfo = "";
if (!isset($_SESSION['registerinfo'])){
  $reginfo = "";
}else{
  $reginfo = $_SESSION['registerinfo'];
  $_SESSION['registerinfo'] = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>LBO register</title>
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
<div class="register_bg_img"></div>
<div class="form_wrapper">
  <div class="form_container">
    <div class="title_container">
      <h2>Register</h2>
    </div>
    <form action="model/registercheck.php" method="post">
      <div class="row clearfix">
        <div>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
            <input type="text" name="firstname" placeholder="Firstname"/>
          </div>
        </div>
        <div>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
            <input type="text" name="lastname" placeholder="Lastname"/>
          </div>
        </div>
        <div>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-calendar"></i></span>
            <input type="date" name="birth_date" placeholder="Birth date"/>
          </div>
        </div>
        <div>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
            <input type="email" name="email" placeholder="Email" required/>
          </div>
        </div>
        <div>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
            <input type="password" name="pw" placeholder="Password" required/>
          </div>
        </div>
        <div>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
            <input type="password" name="pw2" placeholder="Confirm password" required/>
          </div>
        </div>
      </div>
      <?php printf("<p>$reginfo</p>") ?>
      <input class="button" type="submit" name="submit" value="Register"/>
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