<?php
// Connect to database
$conn = mysqli_connect('localhost', 'test_user', 'Password@123', 'ProjectQTM');

// Check connection
if (!$conn) {
  echo "Connection error: " . mysqli_connect_error();
}
?>