<?php
/* registrer-student.php */
/*
   Programmet viser et skjema for å registrere en student
   og lagrer data (brukernavn, fornavn, etternavn, klassekode) i databasen.
*/

include("db.php"); 
include("dynamiske-funksjoner.php");
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Registrer student</title>
</head>
<body>
    <h2>Registrer ny student</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $brukernavn = trim($_POST["brukernavn"]);
        $fornavn = trim($_POST["fornavn"]);
        $etternavn = trim($_POST["etternavn"]);
        $klassekode = $_POST["klassekode"];

        if (!$brukernavn || !$fornavn || !$etternavn || !$klassekode) {
            echo "<p style='color:red;'>⚠️ Alle felt må fylles ut.</p>";
        } else {
            // sjekk om brukernavn allerede finnes
            $sjekk = $conn->prepare("SELECT * FROM student WHERE brukernavn = ?");
            $sjekk->bind_param("s", $brukernavn);
            $sjekk->execute();
            $resultat = $sjekk->get_result();

            if ($resultat->num_rows > 0) {
                echo "<p style='color:red;'>⚠️ Studenten er allerede registrert.</p>";
            } else {
                // legg til ny student
                $stmt = $conn->prepare("INSERT INTO student (brukernavn, fornavn, etternavn, klassekode) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $brukernavn, $fornavn, $etternavn, $klassekode);

                if ($stmt->execute()) {
                    echo "<p style='color:green;'>✅ Studenten ble registrert: $brukernavn $fornavn $etternavn ($klassekode)</p>";
                } else {
                    echo "<p style='color:red;'>⚠️ Feil ved registrering: " . htmlspecialchars($stmt->error) . "</p>";
                }

                $stmt->close();
            }

            $sjekk->close();
        }
    }
    ?>

    <form method="post" id="registrerStudentSkjema">
        <label>Brukernavn:</label><br>
        <input type="text" id="brukernavn" name="brukernavn" maxlength="30" required><br><br>

        <label>Fornavn:</label><br>
        <input type="text" id="fornavn" name="fornavn" maxlength="50" required><br><br>

        <label>Etternavn:</label><br>
        <input type="text" id="etternavn" name="etternavn" maxlength="50" required><br><br>

        <label>Klasse:</label><br>
        <select name="klassekode" id="klassekode" required>
            <option value="">Velg klasse</option>
            <?php listeboksklassekode(); ?>
        </select><br><br>

        <input type="submit" value="Registrer student">
        <input type="reset" value="Nullstill">
    </form>

    <p><a href="index.php">Tilbake til hovedsiden</a></p>
</body>
</html>
