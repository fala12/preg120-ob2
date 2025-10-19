<?php
/* vis-alle-studenter.php */
/* Programmet skriver ut alle registrerte studenter */

include("db-tilkobling.php"); // kobler til databasen

$sqlSetning = "SELECT * FROM student ORDER BY brukernavn";
$sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Alle studenter</title>
</head>
<body>
    <h3>Registrerte studenter</h3>
    <table border="1">
        <tr>
            <th align="left">Brukernavn</th>
            <th align="left">Fornavn</th>
            <th align="left">Etternavn</th>
            <th align="left">Klassekode</th>
        </tr>
        <?php while ($rad = mysqli_fetch_assoc($sqlResultat)) : ?>
            <tr>
                <td><?php echo htmlspecialchars($rad["brukernavn"]); ?></td>
                <td><?php echo htmlspecialchars($rad["fornavn"]); ?></td>
                <td><?php echo htmlspecialchars($rad["etternavn"]); ?></td>
                <td><?php echo htmlspecialchars($rad["klassekode"]); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>


Funksjoner.js 
/* funksjoner.js */

function bekreft() {
    return confirm("Er du sikker ?");
}