
<?php include "db.php"; ?>
<!doctype html><meta charset="utf-8"><title>Registrer klasse</title>
<h2>Registrer klasse</h2>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $kode = trim($_POST['klassekode'] ?? '');
  $navn = trim($_POST['klassenavn'] ?? '');
  $stud = trim($_POST['studiumkode'] ?? '');

  if ($kode==='' || $navn==='' || $stud==='') {
    echo "<p style='color:red'>Fyll ut alle felt.</p>";
  } else {
    $s = $conn->prepare("SELECT 1 FROM klasse WHERE klassekode=?");
    $s->bind_param("s", $kode);
    $s->execute(); $s->store_result();
    if ($s->num_rows > 0) {
      echo "<p style='color:orange'>Klassen finnes allerede.</p>";
    } else {
      $i = $conn->prepare("INSERT INTO klasse (klassekode, klassenavn, studiumkode) VALUES (?,?,?)");
      $i->bind_param("sss", $kode, $navn, $stud);
      $i->execute();
      echo "<p style='color:green'>Klassen ble registrert.</p>";
    }
  }
}
?>
<form method="post">
  Klassekode: <input name="klassekode"><br>
  Klassenavn: <input name="klassenavn"><br>
  Studiumkode: <input name="studiumkode"><br>
  <button>Registrer</button>
</form>
<p><a href="index.php">Tilbake</a></p>
