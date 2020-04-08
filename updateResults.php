  GNU nano 2.3.1                                                       File: results.php                                                                                                                    

<?php
$servername = "dbs2.eecs.utk.edu";
$username = "zlu21";
$password = "";
$dbname = "cosc465_zlu21";

$sectionId= $_GET["sectionId"];
$major=$_GET["major"];
$outcomeId=$_GET["outcomeId"];
$performanceLevel=$_GET["performanceLevel"];
$numberOfStudents=$_GET["numberOfStudents"];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO OutcomeResults(sectionId, outcomeId, major, performanceLevel, numberOfStudents) VALUES
($sectionId, $outcomeId, $major, $performanceLevel, $numberOfStudents)
ON DUPLICATE KEY UPDATE
sectionId = $sectionId,
outcomeId = $outcomeId,
major = $major,
performanceLevel = $performanceLevel,
numberOfStudents = $numberOfStudents;";


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






