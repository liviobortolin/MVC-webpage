<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
$info ="";
$host = "localhost";
$dbname = "liviobortolin";
$user = "root";
$pass = "";
$headers = "";

if ($_SERVER["SERVER_NAME"] == "localhost") {
  $host = "localhost";
  $user = "root";
  $pass = "";
  $database = "db_m133";
} elseif ($_SERVER["SERVER_NAME"] == "liviobortolin.bplaced.net") {
  $host = "localhost";
  $user = "liviobortolin";
  $pass = "1234567890";
  $database = "liviobortolin";
}
try{
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $e){
  $info = "SQL Error: ".$e->getMessage();
  $_SESSION['passwordinfo'] = $info;
}
if (isset($_POST["submit"])) {
  $stmt = $pdo->prepare("SELECT * FROM accounts WHERE EMAIL = :email"); //Username überprüfen
  $stmt->bindParam(":email", $_POST["email"]);
  $stmt->execute();
  $count = $stmt->rowCount();
  if($count != 0){
    $token = generateRandomString(25);
    $stmt = $pdo->prepare("UPDATE accounts SET TOKEN = :token WHERE EMAIL = :email");
    $stmt->bindParam(":token", $token);
    $stmt->bindParam(":email", $_POST["email"]);
    $stmt->execute();
    if ($_SERVER["SERVER_NAME"] == "localhost") {
      $url = "http://localhost/liviobortolin.bplaced.net/setpassword.php?token=$token";
    } elseif ($_SERVER["SERVER_NAME"] == "liviobortolin.bplaced.net") {
      $url = "http://liviobortolin.bplaced.net/setpassword.php?token=$token";
    }
    $message = "<!DOCTYPE html>
    <html lang='en'>
    <head>
      <meta charset='utf-8'>
      <title>g.k.d.s. - records</title>
      <meta content='width=device-width, initial-scale=1.0' name='viewport'>
      <meta name='description' content='© Powered by Gotta keep my distance, they surroundin' me Records'>
      <meta name='author' content='g.k.d.s. - records'>
    </head>
      <style type='text/css'>
    
      @media screen {
        @font-face {
          font-family: Source Sans Pro;
          font-style: normal;
          font-weight: 400;
          src: local(Source Sans Pro Regular), local(SourceSansPro-Regular), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format(woff);
        }
    
        @font-face {
          font-family: Source Sans Pro;
          font-style: normal;
          font-weight: 700;
          src: local(Source Sans Pro Bold), local(SourceSansPro-Bold), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format(woff);
        }
      }
    
      body,
      table,
      td,
      a {
        -ms-text-size-adjust: 100%; /* 1 */
        -webkit-text-size-adjust: 100%; /* 2 */
      }
    
      table,
      td {
        mso-table-rspace: 0pt;
        mso-table-lspace: 0pt;
      }
    
      img {
        -ms-interpolation-mode: bicubic;
      }
    
      a[x-apple-data-detectors] {
        font-family: inherit !important;
        font-size: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
        color: inherit !important;
        text-decoration: none !important;
      }
    
      div[style*='margin: 16px 0;'] {
        margin: 0 !important;
      }
    
      body {
        width: 100% !important;
        height: 100% !important;
        padding: 0 !important;
        margin: 0 !important;
        font-family: Source Sans Pro, Helvetica, Arial, sans-serif;
      }
    
      table {
        border-collapse: collapse !important;
      }
    
      a {
        color: #1a82e2;
      }
    
      img {
        height: auto;
        line-height: 100%;
        text-decoration: none;
        border: 0;
        outline: none;
      }
      </style>
    </head>
    <body style='background-color: #e9ecef;'>
    
      <div class='preheader' style='display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;'>
        Password Reset Request from your g.k.d.s account
      </div>
    
      <table border='0' cellpadding='0' cellspacing='0' width='100%'>
          <td align='center' bgcolor='#e9ecef'>
    
            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
              <tr>
    <td align='left' bgcolor='#ffffff' style='padding: 36px 24px 0;  border-top: 3px solid #d4dadf;'>
      <h1 style='margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>Reset Your Password</h1>
    </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td align='center' bgcolor='#e9ecef'>
            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
    
              <tr>
    <td align='left' bgcolor='#ffffff' style='padding: 24px;  font-size: 16px; line-height: 24px;'>
      <p style='margin: 0;'>If you click this button, it will be redirected to reset the password portal for your g.k.d.s account.</p>
    </td>
              </tr>
    
              <tr>
    <td align='left' bgcolor='#ffffff'>
      <table border='0' cellpadding='0' cellspacing='0' width='100%'>
        <tr>
          <td align='center' bgcolor='#ffffff' style='padding: 12px;'>
            <table border='0' cellpadding='0' cellspacing='0'>
              <tr>
    <td align='center' bgcolor='#DB1F24' style='border-radius: 6px;'>
      <a href='$url' style='display: inline-block; padding: 16px 36px;  font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;'>Click to Reset this Password!</a>
    </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
              </tr>
    
              <tr>
    <td align='left' bgcolor='#ffffff' style='padding: 24px;  font-size: 16px; line-height: 24px;'>
      <p style='margin: 0;'></p>
    </td>
              </tr>
    
              <tr>
    <td align='left' bgcolor='#ffffff' style='padding: 24px;  font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf'>
      <p style='margin: 0;'>Cheers,<br> Gotta keep my distance, they surroundin' me Records</p>
    </td>
              </tr>
    
            </table>
    
          </td>
        </tr>
    
        <tr>
          <td align='center' bgcolor='#e9ecef' style='padding: 24px;'>
    
            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
    
              <tr>
    <td align='center' bgcolor='#e9ecef' style='padding: 12px 24px;  font-size: 14px; line-height: 20px; color: #666;'>
      <p style='margin: 0;'>You received this email because we received a request for your account. If you didn't request you can safely delete this email.</p>
    </td>
              </tr>
    
              <tr>
    <td align='center' bgcolor='#e9ecef' style='padding: 12px 24px;  font-size: 14px; line-height: 20px; color: #666;'>
      <p style='margin: 0;'> &copy; Copyright <strong>g.k.d.s records</strong>. All Rights Reserved</p>
    </td>
              </tr>
    
            </table>
    
          </td>
        </tr>
    
      </table>
    
    </body>
    </html>";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: LBO - Records <no-reply@lbo.ch>" . "\r\n";    if (empty($message)) {
    $to = $_POST['email'];
    $info[] = 'Message is empty';
    $_SESSION['passwordinfo'] = $info;
    }else{
      $subject = "Request for Password Reset" ;
      mail($to, $subject, $message, $headers);
      $info = "Form sent successfully";
      $_SESSION['passwordinfo'] = $info;
      if ($_SERVER["SERVER_NAME"] == "localhost") {
        header("Location: ../passwordreset.php");
        exit;
      } elseif ($_SERVER["SERVER_NAME"] == "liviobortolin.bplaced.net") {
        header_remove();
        header("Location: ../passwordreset.php");
      }
    }
  }
}
function generateRandomString($length = 20) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}
?>