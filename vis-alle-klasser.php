<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="no">
<head>
<meta charset="UTF-8"><title>Alle klasser</title>
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
    <h2>Registrerte klasser</h2>
    <table>
      <thead><tr><th>Klassekode</th><th>Klassenavn</th><th>Studiumkode</th></tr></thead>
      <tbody>
      <?php
        $res = $conn->query("SELECT klassekode, klassenavn, studiumkode FROM klasse ORDER BY klassekode");
        while($r = $res->fetch_assoc()){
          echo "<tr>
                  <td>".htmlspecialchars($r['klassekode'])."</td>
                  <td>".htmlspecialchars($r['klassenavn'])."</td>
                  <td>".htmlspecialchars($r['studiumkode'])."</td>
                </tr>";
        }
      ?>
      </tbody>
    </table>
    <a class="back" href="index.php">← Tilbake</a>
    <p class="muted">Enkel oversikt med sortering på klassekode.</p>
  </div>
</div>
</body>
</html>
