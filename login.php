
<?php
$servername = "dbs2.eecs.utk.edu";
$username = "zdong7";
$password = "abcde12345";
$dbname = "cosc465_zdong7";

$conn = @new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_GET["email"];
$passwd = $_GET["password"];



$sql = "SELECT s.instructorId, s.sectionId, s.courseId,  com.major, s.semester, s.year FROM Sections s, Instructors i, CourseOutcomeMapping com
WHERE i.email = '{$email}' AND i.instructorId = s.instructorId  AND i.password = PASSWORD('{$passwd}') AND s.courseId=com.courseId
ORDER BY year DESC, semester ASC;";
/*
$result = $conn->query($sql);
if ($result > 0) {
    while($row = $result->fetch_assoc()) {
        foreach($row as $key => $value){
            echo "$key->$value    ";
            header("Location: abet.html");
        }
        echo "\n";
        echo("Password or Email address is not correct??");
    }
} else {
    
        echo("Password or Email address is not correct!");
     //   header("Location: login.html");
}
$conn->close();
*/

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
	if(count($data) > 0) {header("Location: abet.html");}
    else {header("Location: login.html?failed=true");}
    
?> 
