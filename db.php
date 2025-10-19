
<?php
/* db.php – kobler til databasen */

$host = "b-studentsql-1.usn.no";
$username = "faala0678";  // brukernavn
$password = "23aafaala0678";  // passord
$database = "faala0678";  // databasenavn

$conn = new mysqli($host, $username, $password, $database);

// sjekk tilkobling
if ($conn->connect_error) {
    die("Tilkoblingsfeil: " . $conn->connect_error);
}

// valgfritt – for å teste at alt virker
// echo "Koblet til databasen";



