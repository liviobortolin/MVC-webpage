<?php
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

?>

