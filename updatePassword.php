<?php
$servername = "dbs2.eecs.utk.edu";
$username = "zdong7";
$password = "abcde12345";
$dbname = "cosc465_zdong7";

$Password = $_GET["password"];
$email = $_GET["email"];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE Instructors SET password = PASSWORD('{$Password}') WHERE email='{$email}';";

$result = $conn->query($sql);
$conn->close();
?> 
