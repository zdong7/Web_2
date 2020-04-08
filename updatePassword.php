<?php
$servername = "dbs2.eecs.utk.edu";
$username = "zlu21";
$password = "";
$dbname = "cosc465_zlu21";

$pswrd= $_GET["password"];
$email= $_GET["email"];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE Instructors SET password = PASSWORD('{$pswrd}') WHERE email='{$email}';";


//echo $sql;



$result = $conn->query($sql);


$conn->close();
?>

