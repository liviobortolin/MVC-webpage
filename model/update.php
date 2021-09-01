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
// Define variables and initialize with empty values
$firstname = $lastname = $email = $admin = $birth_date = "";
$firstname_err = $lastname_err = $email_err = $admin_err = $birth_date_err ="";
 
// Processing form data when form is submitted
if(isset($_POST["user_id"]) && !empty($_POST["user_id"])){
    // Get hidden input value
    $user_id = $_POST["user_id"];
    
    // Validate firstname
    $input_firstname = trim($_POST["firstname"]);
    if(empty($input_firstname)){
        $firstname_err = "Please enter a firstname.";
    } elseif(!filter_var($input_firstname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $firstname_err = "Please enter a valid firstname.";
    } else{
        $firstname = $input_firstname;
    }
    
    // Validate lastname
    $input_lastname = trim($_POST["lastname"]);
    if(empty($input_lastname)){
        $lastname_err = "Please enter an address.";     
    } elseif(!filter_var($input_lastname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $lastname_err = "Please enter a valid firstname.";
    } else{
        $lastname = $input_lastname;
    }
    
    // Validate email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter an email.";     
    } else{
        $stmt = $pdo->prepare("SELECT * FROM accounts WHERE email = :email"); //Username überprüfen
        $stmt->bindParam(":email", $_POST["email"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 0){
            $email = $input_email;
        }else{
            $email_err = "Email already exist.";     
        }
    }

    // Validate admin
    $input_admin = $_POST["admin"];
    if($input_admin == "0"){
        $admin = "0";
    }elseif(empty($input_admin)){
        $admin_err = "Please enter an 1 for true and 0 for false.";     
    } else{
        $admin = $input_admin;
    }

    // Validate birth date
    $input_birth_date = $_POST["birth_date"];
    if($input_birth_date == "0"){
        $birth_date = "0";
    }elseif(empty($input_birth_date)){
        $birth_date_err = "Birth date";     
    } else{
        $birth_date = $input_birth_date;
    }
    // Check input errors before inserting in database
    if(empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($admin_err)){
        // Prepare an update statement
        $sql = "UPDATE accounts SET firstname=:firstname, lastname=:lastname, birth_date=:birth_date, email=:email, admin=:admin WHERE user_id=:user_id";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":firstname", $param_firstname);
            $stmt->bindParam(":lastname", $param_lastname);
            $stmt->bindParam(":birth_date", $param_birth_date);
            $stmt->bindParam(":email", $param_email);
            $stmt->bindParam(":admin", $param_admin);
            $stmt->bindParam(":user_id", $param__user_id);
            
            // Set parameters
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_birth_date = $birth_date;
            $param_email = $email;
            $param_admin = $admin;
            $param__user_id = $user_id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: ../dbzugriffe.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["user_id"]) && !empty(trim($_GET["user_id"]))){
        // Get URL parameter
        $user_id =  trim($_GET["user_id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM accounts WHERE user_id = :user_id";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":user_id", $param__user_id);
            
            // Set parameters
            $param__user_id = $user_id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    // Retrieve individual field value
                    $firstname = $row["firstname"];
                    $lastname = $row["lastname"];
                    $birth_date = $row["birth_date"];
                    $email = $row["email"];
                    $admin = $row["admin"];

                } else{
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>g.k.d.s. - Dashboard</title>
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
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the email record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Firstname</label>
                            <input type="text" name="firstname" class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstname; ?>">
                            <span class="invalid-feedback"><?php echo $firstname_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Lastname</label>
                            <input type="text" name="lastname" class="form-control <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastname; ?>">
                            <span class="invalid-feedback"><?php echo $lastname_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Birth Date</label>
                            <input type="date" name="birth_date" class="form-control <?php echo (!empty($birth_date_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $birth_date; ?>">
                            <span class="invalid-feedback"><?php echo $birth_date_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>E-Mail</label>
                            <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Admin Rights</label>
                            <input type="text" name="admin" class="form-control <?php echo (!empty($admin_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $admin; ?>">
                            <span class="invalid-feedback"><?php echo $admin_err;?></span>
                        </div>
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../dbzugriffe.php" class="btn btn-secondary ml-2">Cancel</a>
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