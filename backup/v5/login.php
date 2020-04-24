<?php
$servername = "dbs2.eecs.utk.edu";
$username = "zdong7";
$password = "abcde12345";
$dbname = "cosc465_zdong7";

$email = $_GET["email"];
$passwd = $_GET["password"];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT s.instructorId, s.sectionId, s.courseId,  com.major, s.semester, s.year FROM Sections s, Instructors i, CourseOutcomeMapping com
WHERE i.email = '{$email}' AND i.instructorId = s.instructorId  AND i.password = PASSWORD('{$passwd}') AND s.courseId=com.courseId
ORDER BY year DESC, semester ASC;";

$result = $conn->query($sql);
if ($result > 0) {
    while($row = $result->fetch_assoc()) {
        foreach($row as $key => $value){
            echo "$key->$value    ";
        }
        echo "\n";
    }
} else {
        echo "Succeed! But no output available!";
}
$conn->close();
?> 
