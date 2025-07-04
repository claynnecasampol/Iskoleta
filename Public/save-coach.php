<?php
$mysqli = new mysqli("localhost", "root", "", "iskoleta");

if ($mysqli->connect_error) {
  die("Database connection failed: " . $mysqli->connect_error);
}

$name     = $_POST['name'];
$email    = $_POST['email'];
$sport    = $_POST['sport'];
$org_id   = $_POST['org_id'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$contact  = $_POST['contact'];
$address  = $_POST['address'];

$stmt = $mysqli->prepare("INSERT INTO coaches (name, email, sport, org_id, password, contact, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $name, $email, $sport, $org_id, $password, $contact, $address);

if ($stmt->execute()) {
  echo "✅ Coach registered successfully!";
} else {
  echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
?>
