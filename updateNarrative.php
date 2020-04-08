<?php
$servername = "dbs2.eecs.utk.edu";
$username = "zdong7";
$password = "abcde12345";
$dbname = "cosc465_zdong7";

$sectionId = $_GET["sectionId"];
$strengths = $_GET["strengths"];
$major = $_GET["major"];
$outcomeId = $_GET["outcomeId"];
$weaknesses = $_GET["weaknesses"];
$actions = $_GET["actions"];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Narratives(sectionId, major, outcomeId, strengths, weaknesses, actions) VALUES
($sectionId, $major, $outcomeId, $strengths, $weaknesses, $actions)
ON DUPLICATE KEY UPDATE
sectionId = $sectionId,
major = $major,
outcomeId = $outcomeId,
strengths = $strengths,
weaknesses = $weaknesses,
actions = $actions;";

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
