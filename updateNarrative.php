  GNU nano 2.3.1                                                       File: results.php                                                                                                                    

<?php
$servername = "dbs2.eecs.utk.edu";
$username = "zlu21";
$password = "";
$dbname = "cosc465_zlu21";

$assessmentId=$_GET["assessmentId"];
$sectionId= $_GET["sectionId"];
$major=$_GET["major"];
$outcomeId=$_GET["outcomeId"];
$weight=$_GET["weight"];
$assessmentDescription=$_GET["assessmentDescription"];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Assessments(assessmentId, sectionId, assessmentDescription, weight, outcomeId, major) VALUES
($assessmentId, $sectionId, $assessmentDescription, $weight, $outcomeId, $major)
ON DUPLICATE KEY UPDATE
assessmentId = $assessmentId,
sectionId = $sectionId,
assessmentDescription = $assessmentDescription,
weight = $weight,
outcomeId = $outcomeId,
major = $major;";


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






