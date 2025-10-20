<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="no">
<head>
  <meta charset="UTF-8">
  <title>Registrer klasse</title>
</head>
<body>
<h2>Registrer ny klasse</h2>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $kode = $_POST["klassekode"];
  $navn = $_POST["klassenavn"];
  $studium = $_POST["studiumkode"];

  if (!$kode || !$navn || !$studium) {
    echo "<p style='color:red;'>Fyll ut alle felt!</p>";
  } else {
    $sjekk = $conn->prepare("SELECT 1 FROM klasse WHERE klassekode=?");
    $sjekk->bind_param("s", $kode);
    $sjekk->execute(); $sjekk->store_result();
    if ($sjekk->num_rows > 0) {
      echo "<p style='color:orange;'>Denne klassen finnes allerede.</p>";
    } else {
      $stmt = $conn->prepare("INSERT INTO klasse VALUES (?,?,?)");
      $stmt->bind_param("sss", $kode, $navn, $studium);
      $stmt->execute();
      echo "<p style='color:green;'>Klassen ble registrert!</p>";
    }
  }
}
?>
<form method="post">
  Klassekode: <input type="text" name="klassekode"><br>
  Klassenavn: <input type="text" name="klassenavn"><br>
  Studiumkode: <input type="text" name="studiumkode"><br>
  <button type="submit">Registrer</button>
</form>
<p><a href="index.php">Tilbake</a></p>
</body>
</html>
