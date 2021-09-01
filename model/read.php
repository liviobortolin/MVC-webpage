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
// Check existence of id parameter before processing further
if(isset($_GET["user_id"]) && !empty(trim($_GET["user_id"]))){
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
    }    // Prepare a select statement
    $sql = "SELECT * FROM accounts WHERE user_id = :user_id";
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":user_id", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["user_id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Retrieve individual field value
                $firstname = $row["firstname"];
                $lastname = $row["lastname"];
                $email = $row["email"];
                $password = $row["password"];
                $admin = $row["admin"];
                $reg_date = $row["reg_date"];
                $birth_date = $row["birth_date"];

            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>LBO Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="All Rights Reserved">
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
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>Firstname</label>
                        <p><b><?php echo $row["firstname"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Lastname</label>
                        <p><b><?php echo $row["lastname"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Birth date</label>
                        <p><b><?php echo $row["birth_date"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p><b><?php echo $row["email"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <p><b><?php echo $row["password"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Token</label>
                        <p><b><?php echo $row["token"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Admin</label>
                        <p><b><?php echo $row["admin"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Created On</label>
                        <p><b><?php echo $row["reg_date"]; ?></b></p>
                    </div>
                    <p><a href="../dbzugriffe.php" class="btn btn-primary">Back</a></p>
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