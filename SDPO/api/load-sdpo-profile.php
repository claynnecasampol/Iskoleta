<?php
header('Content-Type: application/json');
include '../../config.php';

// Check DB connection
if (!$conn) {
  echo json_encode(['error' => 'Database connection failed']);
  exit;
}

// Run query
$query = "SELECT * FROM sdpo_profile WHERE id = 1";
$result = mysqli_query($conn, $query);

// Check query result
if (!$result) {
  echo json_encode(['error' => 'Query failed: ' . mysqli_error($conn)]);
  exit;
}

// Fetch data
$sdpo = mysqli_fetch_assoc($result);

// Return JSON
if ($sdpo) {
  echo json_encode($sdpo);
} else {
  echo json_encode(['error' => 'No profile found']);
}
?>
