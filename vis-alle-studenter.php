<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="no">
<head>
<meta charset="UTF-8"><title>Alle studenter</title>
<style>
  :root{--bg:#f7f7f8;--card:#fff;--border:#e5e7eb;--text:#111;--muted:#6b7280;--link:#2563eb;}
  *{box-sizing:border-box} body{font-family:system-ui;margin:0;background:var(--bg);color:var(--text)}
  .wrap{max-width:900px;margin:40px auto;padding:0 16px}
  .card{background:var(--card);border:1px solid var(--border);border-radius:14px;padding:18px;box-shadow:0 1px 2px rgba(0,0,0,.05)}
  h2{margin:0 0 12px}
  table{width:100%;border-collapse:collapse;border:1px solid var(--border);border-radius:12px;overflow:hidden;background:#fff}
  th,td{padding:10px 12px;border-bottom:1px solid var(--border);text-align:left}
  th{background:#f3f4f6}
  .back{display:inline-block;margin-top:12px;color:var(--link);text-decoration:none}
  .muted{color:var(--muted);font-size:.9rem;margin:6px 0 0}
</style>
</head>
<body>
<div class="wrap">
  <div class="card">
    <h2>Registrerte studenter</h2>
    <table>
      <thead><tr><th>Brukernavn</th><th>Fornavn</th><th>Etternavn</th><th>Klassekode</th></tr></thead>
      <tbody>
      <?php
        $res = $conn->query("SELECT brukernavn, fornavn, etternavn, klassekode FROM student ORDER BY brukernavn");
        while($r = $res->fetch_assoc()){
          echo "<tr>
                  <td>".htmlspecialchars($r['brukernavn'])."</td>
                  <td>".htmlspecialchars($r['fornavn'])."</td>
                  <td>".htmlspecialchars($r['etternavn'])."</td>
                  <td>".htmlspecialchars($r['klassekode'])."</td>
                </tr>";
        }
      ?>
      </tbody>
    </table>
    <a class="back" href="index.php">← Tilbake</a>
    <p class="muted">Enkel oversikt sortert på brukernavn.</p>
  </div>
</div>
</body>
</html>

