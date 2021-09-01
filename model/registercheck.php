<?php if (!isset($_SESSION)){session_start();}?>
<?php
  if (!isset($_SESSION['registerinfo'])){
    $info = "";
  }else{
    $info = $_SESSION['registerinfo'];
  }
  $info ="";
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
try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $e){
    $info = "SQL Error: ".$e->getMessage();
}
    if(isset($_POST["submit"])){
      $stmt = $pdo->prepare("SELECT * FROM accounts WHERE email = :email"); //Username überprüfen
      $stmt->bindParam(":email", $_POST["email"]);
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count == 0){
        //Username ist frei
        $stmt = $pdo->prepare("SELECT * FROM accounts WHERE email = :email"); //Username überprüfen
        $stmt->bindParam(":email", $_POST["email"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 0){
          if($_POST["pw"] == $_POST["pw2"]){
            //User anlegen
            $stmt = $pdo->prepare("INSERT INTO accounts (firstname, lastname, birth_date, email, password, admin) VALUES (:firstname, :lastname, :birth_date, :email, :pw, false)");
            $stmt->bindParam(":email", $_POST["email"]);
            $stmt->bindParam(":firstname", $_POST["firstname"]);
            $stmt->bindParam(":lastname", $_POST["lastname"]);
            $stmt->bindParam(":birth_date", $_POST["birth_date"]);
            $hash = password_hash($_POST["pw"], PASSWORD_BCRYPT);
            $stmt->bindParam(":pw", $hash);
            $stmt->execute();
            $info = "Your account has been created";
            $_SESSION['logininfo'] = $info;
            if ($_SERVER["SERVER_NAME"] == "localhost") {
              header("Location: ../login.php");
              exit;
            } elseif ($_SERVER["SERVER_NAME"] == "liviobortolin.bplaced.net") {
              if (!headers_sent()) {
                header_remove(); 
                header("Location: ../login.php");
                exit;
              }
            }
          } else {
            $info = "The passwords do not match";
            $_SESSION['registerinfo'] = $info;
            if ($_SERVER["SERVER_NAME"] == "localhost") {
              header("Location: ../register.php");
              exit;
            } elseif ($_SERVER["SERVER_NAME"] == "liviobortolin.bplaced.net") {
              if (!headers_sent()) {
                header_remove(); 
                header("Location: ../register.php");
                exit;
              }
            }            
          }
        } else {
          $info = "E-mail have already been used";
          $_SESSION['registerinfo'] = $info;
          if ($_SERVER["SERVER_NAME"] == "localhost") {
            header("Location: ../register.php");
            exit;
          } elseif ($_SERVER["SERVER_NAME"] == "liviobortolin.bplaced.net") {
            if (!headers_sent()) {
              header_remove(); 
              header("Location: ../register.php");
              exit;
            }
          }
        }
      }else {
        $info = "The username is already taken";
        $_SESSION['registerinfo'] = $info;
        if ($_SERVER["SERVER_NAME"] == "localhost") {
          header("Location: ../register.php");
          exit;
        } elseif ($_SERVER["SERVER_NAME"] == "liviobortolin.bplaced.net") {
          if (!headers_sent()) {
            header_remove(); 
            header("Location: ../register.php");
            exit;
          }
      }
    }
    }
?>