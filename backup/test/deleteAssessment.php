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


$assessmentId = $conn->real_escape_string($_GET["assessmentId"]);
$sql = ("
	DELETE FROM Assessments
	WHERE assessmentId = $assessmentId
;");

$result = $conn->query($sql);
$data = [];

echo (json_encode($result));

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$data[] = $row;
	}
}

$conn->close();
?>
