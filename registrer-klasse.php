<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="no">

<head>
    <meta charset="UTF-8">
    <title>Registrer klasse</title>
</head>

<body>
    <h2>Registrer ny klasse</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $klassekode = trim($_POST["klassekode"]);
        $klassenavn = trim($_POST["klassenavn"]);
        $studiumkode = trim($_POST["studiumkode"]);

        if ($klassekode && $klassenavn && $studiumkode) {
            // bruk forberedt spørring for sikkerhet
            $stmt = $conn->prepare("INSERT INTO klasse (klassekode, klassenavn, studiumkode) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $klassekode, $klassenavn, $studiumkode);

            if ($stmt->execute()) {
                echo "<p style='color:green;'>✅ Klassen ble registrert!</p>";
            } else {
                echo "<p style='color:red;'>⚠️ Feil ved registrering: " . htmlspecialchars($stmt->error) . "</p>";
            }

            $stmt->close();
        } else {
            echo "<p style='color:red;'>⚠️ Fyll ut alle felt!</p>";
        }
    }
    ?>

    <form method="post">
        <label>Klassekode:</label><br>
        <input type="text" name="klassekode" maxlength="5" required><br><br>

        <label>Klassenavn:</label><br>
        <input type="text" name="klassenavn" maxlength="50" required><br><br>

        <label>Studiumkode:</label><br>
        <input type="text" name="studiumkode" maxlength="50" required><br><br>

        <button type="submit">Registrer</button>
    </form>

    <p><a href="index.php">Tilbake til hovedsiden</a></p>
</body>

</html>
