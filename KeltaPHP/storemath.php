<?php

$servername = "localhost";
$password_db = "";
$username = "root";
$database = "test";

$conn = new mysqli($servername, $username, $password_db, $database);

if($conn->connect_error){
	die("something went wrong:$conn->connect_error");
}

$data = $_REQUEST['data'];

$query = "INSERT INTO math_data (math) VALUES (?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $data);
$stmt->execute();

echo "Done";

$conn->close();

?>