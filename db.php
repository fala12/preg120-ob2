<?php
// Enkel database-tilkobling (brukes av alle sider)
$host = "b-studentsql-1.usn.no";
$username = "faala0678";
$password = "23aafaala0678";
$database = "faala0678";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
  die("Tilkoblingsfeil: " . htmlspecialchars($conn->connect_error));
}
?>

