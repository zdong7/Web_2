<?php
$servername = "dbs2.eecs.utk.edu";
$username = "zdong7";
$password = "abcde12345";
$dbname = "cosc465_zdong7";

$assessmentId = $_GET["assessmentId"];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM Assessments WHERE assessmentId='{$assessmentId}';";

$conn->close();
?>

