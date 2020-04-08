<?php
$servername = "dbs2.eecs.utk.edu";
$username = "zdong7";
$password = "abcde12345";
$dbname = "cosc465_zdong7";

$sectionId = $_GET["sectionId"];
$major = $_GET["major"];
$outcome = $_GET["outcome"];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT sectionId, outcomeId, major, numberofStudents, description
FROM OutcomeResults
NATURAL JOIN Outcomes
NATURAL JOIN PerformanceLevels
WHERE major = '{$major}' AND sectionId = '{$sectionId}' AND outcomeId = '{$outcome}'
ORDER BY OutcomeResults.performanceLevel;";

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
