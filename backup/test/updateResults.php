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
$performanceLvl = $conn->real_escape_string($_GET["performanceLevel"]);
$studentsN =  $conn->real_escape_string($_GET["numberOfStudents"]);
$sql = ("
		INSERT INTO OutcomeResults (sectionId, outcomeId, major, performanceLevel, numberOfStudents)
		        VALUES ('$section', '$outcome', '$major', '$performanceLvl', '$studentsN')
				ON DUPLICATE KEY UPDATE
				        numberOfStudents = '$studentsN'
		;");

$result = $conn->query($sql);
$data = array();
echo( json_encode($result));

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$data[] = $row;
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
