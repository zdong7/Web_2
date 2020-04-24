<?php
$servername = "dbs2.eecs.utk.edu";
$username = "zdong7";
$password = "abcde12345";
$dbname = "cosc465_zdong7";

$conn = @new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $conn->real_escape_string($_GET["email"]);
$passwd = $conn->real_escape_string($_GET["password"]);


$sql = "SELECT s.instructorId, s.sectionId, s.courseId,  com.major, s.semester, s.year FROM Sections s, Instructors i, CourseOutcomeMapping com
WHERE i.email = '{$email}' AND i.instructorId = s.instructorId  AND i.password = PASSWORD('{$passwd}') AND s.courseId=com.courseId
ORDER BY year DESC, semester ASC;";

$result = $conn->query($sql);

if ($result->num_row > 0) {
    $data = array();
    while($row = $result->fetch_assoc()) {
        foreach($row as $key => $value){
            echo "$key->$value    ";
            $data[]= $row;
        }
        echo "\n";
    }
} else {
        /*echo "Succeed! But no output available!";*/
        header("Location: login.html?failed=true");
        echo "invalid e-mail or password";
}
$conn->close();
session_start();
$_SESSION['user_data'] = json_encode($data);
	if(count($data) > 0){
        header("Location: abet.php");
    }
	else{
        header("Location: login.php?failed=true");
    }
?> 
