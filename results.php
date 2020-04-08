<?php
$servername = "dbs2.eecs.utk.edu";
$username = "zlu21";
$password = "";
$dbname = "cosc465_zlu21";

$sectionId= $_GET["sectionId"];
$major=$_GET["major"];
$outcome=$_GET["outcome"];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT sectionId, outcomeId, major, numberofStudents, description
FROM OutcomeResults
NATURAL JOIN Outcomes
NATURAL JOIN PerformanceLevels
WHERE major = '{$major}' AND sectionId = '{$sectionId}' AND outcomeId = '{$outcome}'
ORDER BY OutcomeResults.performanceLevel;";


//echo $sql;



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


