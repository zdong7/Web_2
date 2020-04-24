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

// sectionId, outcomeId, major, performanceLevel, and numberOfStudents
$major = $conn->real_escape_string($_GET["major"]);
$outcome = $conn->real_escape_string($_GET["outcomeId"]);
$section = $conn->real_escape_string($_GET["sectionId"]); 
$strengths = $conn->real_escape_string($_GET["strengths"]);
$weak =  $conn->real_escape_string($_GET["weaknesses"]);
$actions =  $conn->real_escape_string($_GET["actions"]);
$sql = ("
		INSERT INTO Narratives (sectionId, major, outcomeId, strengths, weaknesses, actions)
		        VALUES ('$section', '$major', '$outcome', '$strengths', '$weak', '$actions')
				ON DUPLICATE KEY UPDATE
				        strengths='$strengths',
						weaknesses='$weak',
						actions='$actions'
		;");

$result = $conn->query($sql);
echo json_encode($result);
$out = [];

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
			array_push($out, $row);
	}
}

$conn->close();
//$sql = ("
//	UPDATE OutcomeResults 
//	WHERE performanceLevel = '$performanceLvl'
//			AND outcomeId = '$outcome'
//					AND sectionId = '$section'
//	SET
//	    major = '$major', 
//		numberOfStudents = '$studentsN'
//	IF ROW_COUNT() = 0
//		INSERT INTO OutcomeResults
//		VALUES (
//			sectionId = '$section',
//			outcomeId = '$outcome',
//			major = '$major', 
//			performanceLevel = '$performanceLvl',
//			numberOfStudents = '$studentsN'
//		)
//		;");
?>
