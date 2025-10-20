
<?php /* Forside */ ?>
<!DOCTYPE html>
<html lang="no">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Obligatorisk oppgave 2 – Programmering</title>
  <style>
    :root{
      --bg:#f7f7f8; --card:#fff; --text:#111; --muted:#6b7280;
      --border:#e5e7eb; --link:#2563eb;
    }
    *{box-sizing:border-box}
    body{
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
      background:var(--bg); color:var(--text);
      margin:0; padding:2rem;
    }
    .container{max-width:900px; margin:0 auto;}
    .card{
      background:var(--card); border:1px solid var(--border);
      border-radius:14px; padding:1.25rem;
      box-shadow:0 1px 2px rgba(0,0,0,.04);
    }
    h2{margin:0 0 .75rem}
    nav ul{list-style:none; padding:0; margin:.5rem 0 0}
    nav li{margin:.5rem 0}
    a{color:var(--link); text-decoration:none; font-weight:500}
    a:hover{text-decoration:underline}
    .small{color:var(--muted); font-size:.9rem; margin-top:.75rem}
  </style>
</head>
<body>
<div class="container">
  <div class="card">
    <h2>Brukerfunksjoner</h2>
    <nav>
      <ul>
        <li><a href="registrer-klasse.php" target="_blank">Registrer klasse</a></li>
        <li><a href="vis-alle-klasser.php" target="_blank">Vis alle klasser</a></li>
        <li><a href="slett-klasse.php" target="_blank">Slett klasse</a></li>
        <li><a href="registrer-student.php" target="_blank">Registrer student</a></li>
        <li><a href="vis-alle-studenter.php" target="_blank">Vis alle studenter</a></li>
        <li><a href="slett-student.php" target="_blank">Slett student</a></li>
      </ul>
    </nav>
    <p class="small">Enkel og ryddig løsning med tydelige feilmeldinger og bekreftelser.</p>
  </div>
</div>
</body>
</html>
