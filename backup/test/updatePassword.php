<?php
$servername = "dbs2.eecs.utk.edu";
$username = "dmw131";
$password = "respectMyAuthority";
$dbname = "cosc465_dmw131";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn,"utf8");


$email = $conn->real_escape_string($_GET["email"]);
$password = $conn->real_escape_string($_GET["password"]);
$sql = ("
	UPDATE Instructors
	SET password = PASSWORD('$password')
	WHERE email = '$email'
;");

$result = $conn->query($sql);
var_dump($result);

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo json_encode($row);
	}
}

$conn->close();
?>
