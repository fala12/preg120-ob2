<?php
/* slett-student.php */
/* Programmet viser et skjema for å slette en student og utfører sletting */
include("db.php"); // kobler til databasen
include("dynamiske-funksjoner.php"); // for sjekkbokserbrukernavn()
?>
<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Slett student</title>
    <script src="funksjoner.js"></script> <!-- for bekreft() -->
</head>
<body>
    <h2>Slett student</h2>

    <form method="post" id="slettStudentSkjema" name="slettStudentSkjema" onsubmit="return bekreft()">
        <label for="brukernavn">Velg student:</label><br>
        <select name="brukernavn" id="brukernavn" required>
            <option value="">-- Velg student --</option>
            <?php
            // Lager liste med studenter fra databasen
            sjekkbokserbrukernavn(); // pass på at funksjonsnavnet stemmer med dynamiske-funksjoner.php
            ?>
        </select><br><br>

        <input type="submit" value="Slett student" name="slettStudentKnapp" id="slettStudentKnapp" />
    </form>

    <?php
    if (isset($_POST["slettStudentKnapp"])) {
        $brukernavn = mysqli_real_escape_string($connection, $_POST["brukernavn"]);

        if (empty($brukernavn)) {
            echo "<p style='color:red;'>⚠️ Du må velge en student.</p>";
        } else {
            $sql = "DELETE FROM student WHERE brukernavn='$brukernavn'";

            if (mysqli_query($connection, $sql)) {
                echo "<p style='color:green;'>✅ Studenten med brukernavn <strong>$brukernavn</strong> er slettet.</p>";
            } else {
                echo "<p style='color:red;'>❌ Feil ved sletting: " . mysqli_error($connection) . "</p>";
            }
        }
    }
    ?>
    <p><a href="index.php">Tilbake til hovedsiden</a></p>
</body>
</html>