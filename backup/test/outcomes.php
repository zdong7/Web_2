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

// Print the outcomeIds and outcomeDescriptions of all outcomes 
//	assessed for a major by sectionId. Order the output by outcomeIds.

$major = $conn->real_escape_string($_GET["major"]);
$section = $conn->real_escape_string($_GET["sectionId"]);
$sql = ("SELECT o.outcomeId, o.outcomeDescription FROM Outcomes o, Sections s, CourseOutcomeMapping c
	WHERE s.sectionId = '$section'
		AND s.year = c.year
		AND s.semester = c.semester
		AND s.courseId = c.courseId
		AND c.major = '$major'
		AND o.major = '$major'
		AND o.outcomeId = c.outcomeId
	ORDER BY outcomeId ;");

$result = $conn->query($sql);
$out = [];

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
			array_push($out, $row);
	}
}
echo json_encode($out);

$conn->close();
?>
