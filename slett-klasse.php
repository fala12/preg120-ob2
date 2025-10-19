<?php
/* slett-klasse.php */
/* Programmet viser et skjema for å slette en klasse og utfører sletting */
?>
<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Slett klasse</title>
    <script src="funksjoner.js"></script>
</head>
<body>
    <h3>Slett klasse</h3>

    <form method="post" id="slettKlasseSkjema" name="slettKlasseSkjema" onsubmit="return bekreft()">
        <label for="klassekode">Velg klasse:</label><br>
        <select name="klassekode" id="klassekode" required>
            <option value="">-- Velg klasse --</option>
            <?php
            include("dynamiske-funksjoner.php");
            listeboksklassekode(); // sørg for at funksjonsnavnet matcher nøyaktig
            ?>
        </select><br><br>

        <input type="submit" value="Slett klasse" name="slettKlasseKnapp" id="slettKlasseKnapp" />
    </form>

    <?php
    if (isset($_POST["slettKlasseKnapp"])) {
        include("db.php"); // bruk samme navn som i de andre filene

        $klassekode = mysqli_real_escape_string($connection, $_POST["klassekode"]);

        if (empty($klassekode)) {
            echo "<p>⚠️ Du må velge en klasse.</p>";
        } else {
            $sql = "DELETE FROM klasse WHERE klassekode='$klassekode'";

            if (mysqli_query($connection, $sql)) {
                echo "<p>✅ Klassen med kode <strong>$klassekode</strong> er slettet.</p>";
            } else {
                echo "<p>❌ Feil ved sletting: " . mysqli_error($connection) . "</p>";
            }
        }

        mysqli_close($connection);
    }
    ?>
</body>
</html>


Slett-klasse.php

<?php
/* slett-klasse.php */
/* Programmet viser et skjema for å slette en klasse og utfører sletting */
include("db.php"); // kobler til databasen
include("dynamiske-funksjoner.php"); // for listeboksklassekode()
?>
<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Slett klasse</title>
    <script src="funksjoner.js"></script> <!-- for bekreft() -->
</head>
<body>
    <h2>Slett klasse</h2>

    <form method="post" id="slettKlasseSkjema" name="slettKlasseSkjema" onsubmit="return bekreft()">
        <label for="klassekode">Velg klasse:</label><br>
        <select name="klassekode" id="klassekode" required>
            <option value="">-- Velg klasse --</option>
            <?php
            // Lager liste med klasser fra databasen
            listeboksklassekode();
            ?>
        </select><br><br>

        <input type="submit" value="Slett klasse" name="slettKlasseKnapp" id="slettKlasseKnapp" />
    </form>

    <?php
    if (isset($_POST["slettKlasseKnapp"])) {
        $klassekode = mysqli_real_escape_string($connection, $_POST["klassekode"]);

        if (empty($klassekode)) {
            echo "<p style='color:red;'>⚠️ Du må velge en klasse.</p>";
        } else {
            $sql = "DELETE FROM klasse WHERE klassekode='$klassekode'";

            if (mysqli_query($connection, $sql)) {
                echo "<p style='color:green;'>✅ Klassen med kode <strong>$klassekode</strong> er slettet.</p>";
            } else {
                echo "<p style='color:red;'>❌ Feil ved sletting: " . mysqli_error($connection) . "</p>";
            }
        }
    }
    ?>

    <p><a href="index.php">Tilbake til hovedsiden</a></p>
</body>
</html>


