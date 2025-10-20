
<?php include "db.php"; ?>
<!doctype html><meta charset="utf-8"><title>Registrer student</title>
<h2>Registrer student</h2>

<?php
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $bn = trim($_POST['brukernavn'] ?? '');
  $fn = trim($_POST['fornavn'] ?? '');
  $en = trim($_POST['etternavn'] ?? '');
  $kk = trim($_POST['klassekode'] ?? '');

  if ($bn==='' || $fn==='' || $en==='' || $kk==='') {
    echo "<p style='color:red'>Fyll ut alle felt.</p>";
  } else {
    $s=$conn->prepare("SELECT 1 FROM student WHERE brukernavn=?");
    $s->bind_param("s",$bn); $s->execute(); $s->store_result();
    if ($s->num_rows>0) {
      echo "<p style='color:orange'>Studenten finnes allerede.</p>";
    } else {
      // valgfritt: sjekk at klasse eksisterer
      $k=$conn->prepare("SELECT 1 FROM klasse WHERE klassekode=?");
      $k->bind_param("s",$kk); $k->execute(); $k->store_result();
      if ($k->num_rows===0) {
        echo "<p style='color:red'>Klassen finnes ikke.</p>";
      } else {
        $i=$conn->prepare("INSERT INTO student(brukernavn,fornavn,etternavn,klassekode) VALUES(?,?,?,?)");
        $i->bind_param("ssss",$bn,$fn,$en,$kk); $i->execute();
        echo "<p style='color:green'>Studenten ble registrert.</p>";
      }
    }
  }
}
?>

<form method="post">
  Brukernavn: <input name="brukernavn"><br>
  Fornavn: <input name="fornavn"><br>
  Etternavn: <input name="etternavn"><br>
  Klassekode: <input name="klassekode"><br>
  <button>Registrer</button>
</form>

<p><a href="index.php">Tilbake</a></p>
