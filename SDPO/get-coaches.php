<?php
$mysqli = new mysqli("localhost", "root", "", "iskoleta");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT * FROM coaches");
$coaches = [];

while ($row = $result->fetch_assoc()) {
    $coaches[] = $row;
}

echo json_encode($coaches);
?>