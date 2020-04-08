  GNU nano 2.3.1                                                       File: results.php                                                                                                                    

<?php
$servername = "dbs2.eecs.utk.edu";
$username = "zlu21";
$password = "";
$dbname = "cosc465_zlu21";

$sectionId=$_GET["sectionId"];
$strengths= $_GET["strengths"];
$major=$_GET["major"];
$outcomeId=$_GET["outcomeId"];
$weaknesses=$_GET["weaknesses"];
$actions=$_GET["actions"];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Narratives(sectionId, major, outcomeId, strengths, weaknesses, actions) VALUES
($sectionId, $major, $outcomeId, $strengths, $weaknesses, $actions)
ON DUPLICATE KEY UPDATE
sectionId = $sectionId,
major = $major,
outcomeId = $outcomeId,
strengths = $strengths,
weaknesses = $weaknesses,
actions = $actions;";


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






