<?php if (!isset($_SESSION)){session_start();}?>
<?php
if(!isset($_SESSION["email"])){
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
    if(empty($_SESSION["theytryingtochase"])){
        header("Location: ../index.php");
        exit;
    }
}
?>
<?php
// Process delete operation after confirmation
if(isset($_POST["user_id"]) && !empty($_POST["user_id"])){
    // Include config file
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
    // Prepare a delete statement
    $sql = "DELETE FROM accounts WHERE user_id = :user_id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":user_id", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["user_id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Records deleted successfully. Redirect to landing page
            header("location: ../dbzugriffe.php");
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["user_id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>LBO Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="© Powered by Gotta keep my distance, they surroundin' me Records">
    <meta name="author" content="Livio Bortolin">
    
    <!-- Favicons -->
    <link href="../view/images/logo.svg" rel="icon">
    <link href="../view/images/apple-touch-icon.png" rel="apple-touch-icon">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../view/css/dashboard.css">
</head>
<body>
<div class="page-container">
<div class="content-wrap">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Delete Record</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="user_id" value="<?php echo trim($_GET["user_id"]); ?>"/>
                            <p>Are you sure you want to delete this user record?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="../dbzugriffe.php" class="btn btn-secondary ml-2">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</div>
</div>
<footer class="footer">
  <p>&copy; Copyright <strong>LBO</strong></p>
</footer>
</body>
</html>