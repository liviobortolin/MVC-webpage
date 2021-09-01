<?php if (!isset($_SESSION)){session_start();}?>
<?php 
$info = "";
if (!isset($_SESSION['passwordinfo'])){
  $info = "";
}else{
  $info = $_SESSION['passwordinfo'];
  $_SESSION['passwordinfo'] = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>LBO password reset</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="description" content="All right Reserved">
  <meta name="author" content="Livio Bortolin">

  <!-- Favicons -->
  <link href="view/images/logo.ico" rel="icon">
  <link href="view/images/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Libraries CSS Files -->
  
  <!-- Main Stylesheet File -->
  <link rel="stylesheet" href="view/css/login.css">
  
</head>
<body>
<div class="passwordreset_bg_img"></div>
<div class="form_wrapper">
  <div class="form_container">
    <div class="title_container">
      <h2>Forgot Password?</h2>
    </div>
    <form action="model/passwordresetcheck.php" method="post">
      <div class="row clearfix">
        <div>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
            <input type="email" name="email" placeholder="Email" required/>
          </div>
        </div>
      <?php printf("<p>$info</p>")?>
      <input class="button" type="submit" name="submit" value="Reset"/>
      <input class="button" type="button" onclick="window.location.href='index.php';" name="homepage"  value="Back to Homepage">
    </form>
  </div>
</div>
<footer class="fixedfooter">
    <p>&copy; Copyright <strong>LBO</strong></p>
</footer>
</body>
</html>