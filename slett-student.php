<?php include "db.php"; ?>
<!doctype html>
<html lang="no">
<head>
<meta charset="utf-8"><title>Slett student</title>
<style>
  body{font-family:system-ui,Arial;margin:0;background:#f5f6fa;color:#222;padding:30px}
  .form{max-width:420px;margin:auto;background:#fff;border:1px solid #e6e8ec;border-radius:10px;padding:20px 24px;box-shadow:0 2px 5px rgba(0,0,0,.06)}
  h2{margin:0 0 14px;text-align:center}
  label{display:block;font-weight:600;margin-top:10px}
  select{width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;margin-top:6px;font:inherit}
  button{width:100%;margin-top:14px;background:#111;color:#fff;border:0;border-radius:8px;padding:10px;font:inherit;cursor:pointer}
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
  <h2>Slett student</h2>
  <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $bn = $_POST["brukernavn"] ?? "";
      if ($bn === "") {
        echo "<div class='msg err'>Velg en student.</div>";
      } else {
        $d = $conn->prepare("DELETE FROM student WHERE brukernavn=?");
        $d->bind_param("s", $bn); $d->execute();
        echo ($d->affected_rows > 0)
          ? "<div class='msg ok'>Studenten er slettet.</div>"
          : "<div class='msg warn'>Fant ingen slik student.</div>";
      }
    }
  ?>
  <form method="post" onsubmit="return confirm('Slette valgt student?')">
    <label for="brukernavn">Velg student</label>
    <select id="brukernavn" name="brukernavn" required>
      <option value="">Velg student</option>
      <?php
        $r = $conn->query("SELECT brukernavn, fornavn, etternavn FROM student ORDER BY brukernavn");
        while ($x = $r->fetch_assoc()) {
          $bn = htmlspecialchars($x['brukernavn']);
          $label = htmlspecialchars($x['brukernavn']." – ".$x['fornavn']." ".$x['etternavn']);
          echo "<option value=\"$bn\">$label</option>";
        }
      ?>
    </select>
    <button>Slett</button>
  </form>
  <p class="link"><a href="index.php">← Tilbake</a></p>
</div>
</body>
</html>
