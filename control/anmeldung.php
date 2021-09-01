<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
  $info ="";
  $code = "";
  $host = "localhost";
  $dbname = "liviobortolin";
  $user = "root";
  $pass = "";

if ($_SERVER["SERVER_NAME"] == "localhost") {
  $host = "localhost";
  $user = "root";
  $pass = "";
  $database = "liviobortolin";
} elseif ($_SERVER["SERVER_NAME"] == "liviobortolin.bplaced.net") {
  $host = "localhost";
  $user = "liviobortolin";
  $pass = "1234567890";
  $database = "liviobortolin";
}

try {
  $conn = new PDO("mysql:host=$host", $user, $pass);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
  // use exec() because no results are returned
  $conn->exec($sql);
  //$info = "Database $dbname created successfully<br>";
  try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS `accounts` (
      `user_id` int(11) NOT NULL AUTO_INCREMENT,
      `firstname` varchar(50) NOT NULL,
      `lastname` varchar(50) NOT NULL,
      `email` varchar(255) NOT NULL,
      `password` varchar(255) NOT NULL,
      `token` varchar(255) DEFAULT NULL,
      `admin` tinyint(1) DEFAULT NULL,
      `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
      PRIMARY KEY (`user_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;";
      
    // use exec() because no results are returned
    $conn->exec($sql);
    //$info = "Table accounts created successfully";
  } catch(PDOException $e) {
    $info = $sql . "<br>" . $e->getMessage();
  }
  } catch(PDOException $e) {
    $info = $sql . "<br>" . $e->getMessage();
}
$conn = null;
try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $e){
    $info = "SQL Error: ".$e->getMessage();
    $_SESSION['logininfo'] = $info;
}
  $rowCount = $pdo->prepare("SELECT * From accounts");
  $rowCount->execute();
  $infoCount = $rowCount->rowCount();
  if($infoCount >= 1){
  }else{
    if ($_SERVER["SERVER_NAME"] == "localhost") {
      header("Location: ../register.php");
      exit;
    } elseif ($_SERVER["SERVER_NAME"] == "liviobortolin.bplaced.net") {
      if (!headers_sent()) {
        header_remove();
        $info = "no user exist yet";
        $_SESSION['logininfo'] = $info;
        header("Location: ../register.php");
        exit;
      }
    }
  }   
  if(isset($_POST["submit"])){
    $stmt = $pdo->prepare("SELECT * FROM accounts WHERE email = :email"); //Username überprüfen
    $stmt->bindParam(":email", $_POST["email"]);
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 1){
  //Username ist frei
      $row = $stmt->fetch();
      if(password_verify($_POST["password"], $row["password"])){
        $_SESSION["email"] = $row["email"];
        $_SESSION["coolio"] = $row["admin"];
        if($_SESSION["coolio"] == 1){
          $code = generateRandomString(25);
          $_SESSION['theytryingtochase'] = $code;
          //$admin = "coolio";
          //$_SESSION['coolio'] = $admin;
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
      }
      } else {
        $info = "username or password failed";
        $_SESSION['logininfo'] = $info;
        header("Location: ../login.php");
      }
    } else {
      $info = "The login has failed";
      $_SESSION['logininfo'] = $info;
      header("Location: ../login.php");
    }
  }
  function generateRandomString($length = 50) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
?>