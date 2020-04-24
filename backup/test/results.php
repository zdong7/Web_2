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
$outcome = $conn->real_escape_string($_GET["outcome"]);
$section = $conn->real_escape_string($_GET["sectionId"]);
$sql = ("SELECT p.description, r.numberOfStudents FROM OutcomeResults r, PerformanceLevels p
	WHERE r.performanceLevel = p.performanceLevel
			AND major = '$major'
					AND r.outcomeId = '$outcome'
							AND r.sectionId = '$section'
								ORDER BY r.performanceLevel;");
$result = $conn->query($sql);
$data = array();

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$data[] = $row;
	}
}
echo(json_encode($data));

$conn->close();
?>
