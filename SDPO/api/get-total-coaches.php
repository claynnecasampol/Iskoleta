<?php
include '../../config.php'; // Correct path from /api/ to root

$sql = "SELECT COUNT(*) AS count FROM coaches"; // Adjust table name if needed
$result = mysqli_query($conn, $sql);

if (!$result) {
  echo json_encode(['count' => 0, 'error' => mysqli_error($conn)]);
  exit;
}

$row = mysqli_fetch_assoc($result);
echo json_encode(['count' => $row['count']]);
?>
