
<?php include "db.php"; ?>
<!doctype html>
<html lang="no">
<head>
<meta charset="utf-8"><title>Registrer student</title>
<style>
  body{font-family:system-ui,Arial;margin:0;background:#f5f6fa;color:#222;padding:30px}
  .form{max-width:420px;margin:auto;background:#fff;border:1px solid #e6e8ec;border-radius:10px;padding:20px 24px;box-shadow:0 2px 5px rgba(0,0,0,.06)}
  h2{margin:0 0 14px;text-align:center}
  label{display:block;font-weight:600;margin-top:10px}
  input,select{width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;margin-top:6px;font:inherit}
  input:focus,select:focus{outline:none;border-color:#2563eb}
  button{width:100%;margin-top:14px;background:#2563eb;color:#fff;border:0;border-radius:8px;padding:10px;font:inherit;cursor:pointer}
  .msg{margin:10px 0;padding:8px;border-radius:6px;text-align:center}
  .ok{background:#e8f5e9;color:#2e7d32}
  .warn{background:#fff3cd;color:#856404}
  .err{background:#fdecea;color:#c62828}
  p.link{text-align:center;margin-top:10px}
  a{color:#2563eb;text-decoration:none}
</style>
</head>
<body>
<div class="form">
  <h2>Registrer student</h2>
  <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $bn = trim($_POST["brukernavn"] ?? "");
      $fn = trim($_POST["fornavn"] ?? "");
      $en = trim($_POST["etternavn"] ?? "");
      $kk = $_POST["klassekode"] ?? "";

      if ($bn === "" || $fn === "" || $en === "" || $kk === "") {
        echo "<div class='msg err'>Alle felt må fylles ut.</div>";
      } else {
        // finnes student?
        $s = $conn->prepare("SELECT 1 FROM student WHERE brukernavn=?");
        $s->bind_param("s", $bn); $s->execute(); $s->store_result();
        if ($s->num_rows > 0) {
          echo "<div class='msg warn'>Studenten finnes allerede.</div>";
        } else {
          // finnes klasse?
          $k = $conn->prepare("SELECT 1 FROM klasse WHERE klassekode=?");
          $k->bind_param("s", $kk); $k->execute(); $k->store_result();
          if ($k->num_rows === 0) {
            echo "<div class='msg err'>Klassen finnes ikke. Registrer klassen først.</div>";
          } else {
            $i = $conn->prepare("INSERT INTO student(brukernavn,fornavn,etternavn,klassekode) VALUES(?,?,?,?)");
            $i->bind_param("ssss", $bn, $fn, $en, $kk); $i->execute();
            echo "<div class='msg ok'>Studenten ble registrert.</div>";
          }
          $k->close();
        }
        $s->close();
      }
    }
  ?>
  <form method="post" autocomplete="off">
    <label for="brukernavn">Brukernavn</label>
    <input id="brukernavn" name="brukernavn" required>
    <label for="fornavn">Fornavn</label>
    <input id="fornavn" name="fornavn" required>
    <label for="etternavn">Etternavn</label>
    <input id="etternavn" name="etternavn" required>
    <label for="klassekode">Klasse</label>
    <select id="klassekode" name="klassekode" required>
      <option value="">Velg klasse</option>
      <?php
        $r = $conn->query("SELECT klassekode, klassenavn FROM klasse ORDER BY klassekode");
        while ($x = $r->fetch_assoc()) {
          $k = htmlspecialchars($x['klassekode']);
          $n = htmlspecialchars($x['klassenavn']);
          echo "<option value=\"$k\">$k – $n</option>";
        }
      ?>
    </select>
    <button>Registrer</button>
  </form>
  <p class="link"><a href="index.php">← Tilbake</a></p>
</div>
</body>
</html>
