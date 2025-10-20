<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="no">
<head>
<meta charset="UTF-8"><title>Slett student</title>
<style>
  :root{--bg:#f7f7f8;--card:#fff;--border:#e5e7eb;--link:#2563eb;
        --okbg:#ecfdf5;--okbd:#a7f3d0;--oktx:#166534;
        --wrnbg:#fffbeb;--wrnbd:#fde68a;--wrntx:#92400e;
        --errbg:#fef2f2;--errbd:#fecaca;--errtx:#b91c1c;}
  *{box-sizing:border-box} body{font-family:system-ui;margin:0;background:var(--bg)}
  .wrap{max-width:640px;margin:40px auto;padding:0 16px}
  .card{background:var(--card);border:1px solid var(--border);border-radius:14px;padding:18px;box-shadow:0 1px 2px rgba(0,0,0,.05)}
  h2{margin:0 0 12px}
  label{font-weight:600}
  select{width:100%;padding:.6rem;border:1px solid var(--border);border-radius:10px;margin:.3rem 0 .9rem;background:#fff}
  button{background:#111;color:#fff;border:0;border-radius:10px;padding:.6rem .9rem;cursor:pointer}
  a{color:var(--link);text-decoration:none}
  .msg{margin:10px 0;padding:.7rem .9rem;border-radius:12px;border:1px solid}
  .ok{background:var(--okbg);border-color:var(--okbd);color:var(--oktx)}
  .warn{background:var(--wrnbg);border-color:var(--wrnbd);color:var(--wrntx)}
  .err{background:var(--errbg);border-color:var(--errbd);color:var(--errtx)}
</style>
</head>
<body>
<div class="wrap">
  <div class="card">
    <h2>Slett student</h2>
    <?php
      $msg="";
      if($_SERVER["REQUEST_METHOD"]==="POST"){
        $bn = $_POST["brukernavn"] ?? "";
        if($bn===""){
          $msg = "<div class='msg err'>⚠️ Du må velge en student.</div>";
        }else{
          $stmt=$conn->prepare("DELETE FROM student WHERE brukernavn=?");
          $stmt->bind_param("s",$bn); $stmt->execute();
          $msg = $stmt->affected_rows>0
            ? "<div class='msg ok'>✅ Studenten <b>".htmlspecialchars($bn)."</b> er slettet.</div>"
            : "<div class='msg warn'>ℹ️ Fant ingen student med brukernavn <b>".htmlspecialchars($bn)."</b>.</div>";
          $stmt->close();
        }
      }
      echo $msg;
    ?>
    <form method="post" onsubmit="return confirm('Slette valgt student?')">
      <label for="brukernavn">Velg student</label>
      <select name="brukernavn" id="brukernavn" required>
        <option value="">-- Velg student --</option>
        <?php
          $res=$conn->query("SELECT brukernavn, fornavn, etternavn FROM student ORDER BY brukernavn");
          while($r=$res->fetch_assoc()){
            $bn=htmlspecialchars($r['brukernavn']);
            $label=htmlspecialchars($r['brukernavn']." – ".$r['fornavn']." ".$r['etternavn']);
            echo "<option value=\"$bn\">$label</option>";
          }
        ?>
      </select>
      <button type="submit">Slett</button>
    </form>
    <p><a href="index.php">← Tilbake</a></p>
  </div>
</div>
</body>
</html>
