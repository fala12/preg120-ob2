

<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="no">
<head>
<meta charset="UTF-8"><title>Slett klasse</title>
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
    <h2>Slett klasse</h2>
    <?php
      $msg="";
      if($_SERVER["REQUEST_METHOD"]==="POST"){
        $kode = $_POST["klassekode"] ?? "";
        if($kode===""){
          $msg = "<div class='msg err'>⚠️ Du må velge en klasse.</div>";
        }else{
          // valgfri sikkerhet: sjekk om det finnes studenter i klassen
          $chk=$conn->prepare("SELECT COUNT(*) FROM student WHERE klassekode=?");
          $chk->bind_param("s",$kode); $chk->execute(); $chk->bind_result($ant); $chk->fetch(); $chk->close();
          if($ant>0){
            $msg = "<div class='msg warn'>ℹ️ Kan ikke slette <b>".htmlspecialchars($kode)."</b> fordi det finnes $ant student(er) i klassen.</div>";
          }else{
            $stmt=$conn->prepare("DELETE FROM klasse WHERE klassekode=?");
            $stmt->bind_param("s",$kode); $stmt->execute();
            $msg = $stmt->affected_rows>0
              ? "<div class='msg ok'>✅ Klassen <b>".htmlspecialchars($kode)."</b> er slettet.</div>"
              : "<div class='msg warn'>ℹ️ Fant ingen klasse med kode <b>".htmlspecialchars($kode)."</b>.</div>";
            $stmt->close();
          }
        }
      }
      echo $msg;
    ?>
    <form method="post" onsubmit="return confirm('Slette valgt klasse?')">
      <label for="klassekode">Velg klasse</label>
      <select name="klassekode" id="klassekode" required>
        <option value="">-- Velg klasse --</option>
        <?php
          $res=$conn->query("SELECT klassekode, klassenavn FROM klasse ORDER BY klassekode");
          while($r=$res->fetch_assoc()){
            $kode=htmlspecialchars($r['klassekode']);
            $navn=htmlspecialchars($r['klassenavn']);
            echo "<option value=\"$kode\">$kode – $navn</option>";
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

