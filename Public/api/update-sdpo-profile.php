<?php
include '../../config.php';

$fullname  = $_POST['fullname'];
$position  = $_POST['designation'];
$email     = $_POST['email'];
$contact   = $_POST['contact'];
$password  = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

if ($password) {
  $sql = "UPDATE sdpo_profile SET fullname='$fullname', position='$position', email='$email', contact='$contact', password='$password' WHERE id = 1";
} else {
  $sql = "UPDATE sdpo_profile SET fullname='$fullname', position='$position', email='$email', contact='$contact' WHERE id = 1";
}

if (mysqli_query($conn, $sql)) {
  header("Location: ../ProfileSDPO.html");
  exit();
} else {
  echo "Error updating profile: " . mysqli_error($conn);
}
?>