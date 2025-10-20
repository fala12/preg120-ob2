
<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="no">
<head>
  <meta charset="UTF-8">
  <title>Registrer student</title>
</head>
<body>
<h2>Registrer ny student</h2>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $bn = $_POST["brukernavn"];
  $fn = $_POST["fornavn"];
  $en = $_POST["etternavn"];
  $kk = $_POST["klassekode"];

  if (!$bn || !$fn || !$en || !$kk) {
    echo "<p style='color:red;'>Fyll ut alle felt!</p>";
  } else {
    $sjekk = $conn->prepare("SELECT 1 FROM student WHERE brukernavn=?");
    $sjekk->bind_param("s", $bn);
    $sjekk->execute(); $sjekk->store_result();
    if ($sjekk->num_rows > 0) {
      echo "<p style='color:orange;'>Denne studenten finnes allerede.</p>";
    } else {
      $stmt = $conn->prepare("INSERT INTO student VALUES (?,?,?,?)");
      $stmt->bind_param("ssss", $bn, $fn, $en, $kk);
      $stmt->execute();
      echo "<p style='color:green;'>Studenten ble registrert!</p>";
    }
  }
}
?>
<form method="post">
  Brukernavn: <input type="text" name="brukernavn"><br>
  Fornavn: <input type="text" name="fornavn"><br>
  Etternavn: <input type="text" name="etternavn"><br>
  Klassekode: <input type="text" name="klassekode"><br>
  <button type="submit">Registrer</button>
</form>
<p><a href="index.php">Tilbake</a></p>
</body>
</html>
