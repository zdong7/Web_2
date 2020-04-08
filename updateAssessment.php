<?php
$servername = "dbs2.eecs.utk.edu";
$username = "zdong7";
$password = "abcde12345";
$dbname = "cosc465_zdong7";

$assessmentId = $_GET["assessmentId"];
$sectionId = $_GET["sectionId"];
$major = $_GET["major"];
$outcomeId = $_GET["outcomeId"];
$weight = $_GET["weight"];
$assessmentDescription = $_GET["assessmentDescription"];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Assessments(assessmentId, sectionId, assessmentDescription, weight, outcomeId, major) VALUES
($assessmentId, $sectionId, $assessmentDescription, $weight, $outcomeId, $major)
ON DUPLICATE KEY UPDATE
assessmentId = $assessmentId,
sectionId = $sectionId,
assessmentDescription = $assessmentDescription,
weight = $weight,
outcomeId = $outcomeId,
major = $major;";

$result = $conn->query($sql);
if ($result > 0) {
    while($row = $result->fetch_assoc()) {
        foreach($row as $key => $value){
            echo "$key->$value    ";
        }
        echo "\n";
    }
} else {
        echo "Succeed! But no output available!";
}
$conn->close();
?> 
