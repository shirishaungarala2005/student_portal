<?php
$servername = "localhost";
$username = "root";  // default MySQL user for XAMPP
$password = "";      // default blank password for XAMPP MySQL
$dbname = "student_portal";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>