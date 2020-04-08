
<?php
$servername = "dbs2.eecs.utk.edu";
$username = "zlu21";
$password = "";
$dbname = "cosc465_zlu21";

$email= $_GET["email"];
$passwd=$_GET["password"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT s.instructorId, s.sectionId, s.courseId,  com.major, s.semester, s.year FROM Sections s, Instructors i, CourseOutcomeMapping com
WHERE i.email = '{$email}' AND i.instructorId = s.instructorId  AND i.password = PASSWORD('{$passwd}') AND s.courseId=com.courseId
ORDER BY year DESC, semester ASC;";


echo $sql;



$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        foreach($row as $cname => $cvalue){
        print "$cname: $cvalue    ";
    }
    print "\n";
    }
} else {
    echo "0 results";
}

$conn->close();
?>





