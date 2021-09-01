<?php if (!isset($_SESSION)){session_start();}?>
<?php
if(!isset($_SESSION["email"])){
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
}else{
    if(empty($_SESSION["theytryingtochase"])){
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>LBO Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="All Rights reserved">
    <meta name="author" content="Livio Bortolin">
    
    <!-- Favicons -->
    <link href="view/images/logo.ico" rel="icon">
    <link href="view/images/apple-touch-icon.png" rel="apple-touch-icon">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Main Stylesheet File -->
    <link rel="stylesheet" href="view/css/dashboard.css">
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a href="#" class="navbar-brand"><img src="view/images/favicon.png" height="28" alt="LBO"></a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="userlist.php" class="nav-item nav-link active">database</a>
            </div>
            <div class="navbar-nav ml-auto">
                <a href="register.php" class="nav-item nav-link">Add User</a>
                <a href="control/abmeldung.php" class="nav-item nav-link">Logout</a>
            </div>
        </div>
    </nav>
<div class="dashboard-container">
<div class="content-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    require_once("model/mysql.php");
                    $sql = "SELECT * FROM accounts";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Firstname</th>";
                                        echo "<th>Lastname</th>";
                                        echo "<th>Birth date</th>";
                                        echo "<th>E-Mail</th>";
                                        echo "<th>Password</th>";
                                        echo "<th>Admin Rigths</th>";
                                        echo "<th>Created On</th>";
                                        echo "<th>CDR</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['user_id'] . "</td>";
                                        echo "<td>" . $row['firstname'] . "</td>";
                                        echo "<td>" . $row['lastname'] . "</td>";
                                        echo "<td>" . $row['birth_date'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['password'] . "</td>";
                                        echo "<td>" . $row['admin'] . "</td>";
                                        echo "<td>" . $row['reg_date'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="model/read.php?user_id='. $row['user_id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="model/update.php?user_id='. $row['user_id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="model/delete.php?user_id='. $row['user_id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    
                    // Close connection
                    unset($pdo);
                    ?>
                </div>
            </div>        
        </div>
    </div>
<footer class="footer">
  <p>&copy; Copyright <strong>LBO</strong></p>
</footer>
</div>
</body>
</html>