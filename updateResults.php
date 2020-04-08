<?php
$servername = "dbs2.eecs.utk.edu";
$username = "zdong7";
$password = "abcde12345";
$dbname = "cosc465_zdong7";

$sectionId = $_GET["sectionId"];
$major = $_GET["major"];
$outcomeId = $_GET["outcomeId"];
$performanceLevel = $_GET["performanceLevel"];
$numberOfStudents = $_GET["numberOfStudents"];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO OutcomeResults(sectionId, outcomeId, major, performanceLevel, numberOfStudents) VALUES
($sectionId, $outcomeId, $major, $performanceLevel, $numberOfStudents)
ON DUPLICATE KEY UPDATE
sectionId = $sectionId,
outcomeId = $outcomeId,
major = $major,
performanceLevel = $performanceLevel,
numberOfStudents = $numberOfStudents;";

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
