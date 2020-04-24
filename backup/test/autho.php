<?php
	$servername = "dbs2.eecs.utk.edu";
	$username = "zdong7";
	$password = "abcde12345";
	$dbname = "cosc465_zdong7";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$email = $conn->real_escape_string($_GET["email"]);
	$pass = $conn->real_escape_string($_GET["password"]);

	$sql = ("SELECT DISTINCT s.instructorId, s.sectionId, s.courseId, c.major, s.semester, s.year
	FROM Sections s, CourseOutcomeMapping c
		WHERE s.instructorId = (SELECT instructorId FROM Instructors 
				WHERE email='$email' AND password = PASSWORD('$pass'))
				AND s.courseId = c.courseId
						AND s.semester = c.semester
								AND s.year = c.year
									ORDER BY s.year DESC, s.semester ASC;");

	$result = $conn->query($sql);
	$data = array();

	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
	}
	$conn->close();
	session_start();
	$_SESSION['user_data'] = json_encode($data);
	if(count($data) > 0) {header("Location: abet.php");}
	else {header("Location: login.php?failed=true");}
