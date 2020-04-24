<?php
$servername = "dbs2.eecs.utk.edu";
$username = "dmw131";
$password = "respectMyAuthority";
$dbname = "cosc465_dmw131";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn,"utf8");

$major = $conn->real_escape_string($_GET["major"]);
$outcome = $conn->real_escape_string($_GET["outcomeId"]);
$section = $conn->real_escape_string($_GET["sectionId"]); 
$assessment = $conn->real_escape_string($_GET["assessmentId"]);
$desc = $conn->real_escape_string($_GET["assessmentDesc"]);
$weight =  $conn->real_escape_string($_GET["weight"]);
$sql = ("
	INSERT INTO Assessments (assessmentId, sectionId, assessmentDescription, weight, outcomeId, major)
		VALUES ('$assessment', '$section', '$desc', '$weight', '$outcome', '$major')
	ON DUPLICATE KEY UPDATE
			sectionId = '$section',
			assessmentDescription = '$desc',
			weight = '$weight',
			outcomeId = '$outcome', 
			major = '$major'

;");



$result = $conn->query($sql);
$data = [];
echo(json_encode($result));

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$data[] = $row;
	}
}

$conn->close();
?>
