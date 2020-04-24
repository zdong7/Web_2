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
$sql = ("SELECT a.sectionId, i.email, a.outcomeId, major, sum(a.weight) as weightTotal  FROM Assessments a, Sections s, Instructors i
	WHERE major = '$major'
			AND outcomeId = '$outcome'
					AND a.sectionId = '$section'
					AND a.sectionId = s.sectionId
					AND a.weight != 100
					AND s.instructorId = i.instructorId
					ORDER BY email ASC, major ASC, a.outcomeId ASC ;");

$result = $conn->query($sql);

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo json_encode($row);
	}
}

$conn->close();
?>
