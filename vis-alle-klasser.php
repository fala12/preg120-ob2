<?php
/* vis-alle-klasser.php */
/* Programmet skriver ut alle registrerte klasser */

include("db-tilkobling.php"); // kobler til databasen

$sqlSetning = "SELECT * FROM klasse ORDER BY klassekode";
$sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Alle klasser</title>
</head>
<body>
    <h3>Registrerte klasser</h3>
    <table border="1">
        <tr>
            <th align="left">Klassekode</th>
            <th align="left">Klassenavn</th>
            <th align="left">Studiumkode</th>
        </tr>
        <?php while ($rad = mysqli_fetch_assoc($sqlResultat)) : ?>
            <tr>
                <td><?php echo htmlspecialchars($rad["klassekode"]); ?></td>
                <td><?php echo htmlspecialchars($rad["klassenavn"]); ?></td>
                <td><?php echo htmlspecialchars($rad["studiumkode"]); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>