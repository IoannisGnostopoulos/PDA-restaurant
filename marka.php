<?php
session_start();

// Ενεργοποίηση εμφάνισης σφαλμάτων για εντοπισμό προβλημάτων
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tes1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ΕρώτημαSQL: Χρησιμοποιούμε τη στήλη onoma_proiontos αντί για perigrafh_proiontos
$sql = "SELECT kathgoria_proiontos, kwdikos_proiontos, onomasia_proiontos, timh_proiontos 
        FROM timokatalogos 
        ORDER BY kathgoria_proiontos ASC, onomasia_proiontos ASC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Προϊόντα ανά Κατηγορία / Μάρκα</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #DCDCDC; padding: 20px; color: #000; }
        .container { max-width: 750px; margin: 0 auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 10px; text-align: left; }
        th { background-color: #f0f0f0; }
        .cat-header { background-color: #d9d9d9; font-weight: bold; font-size: 11pt; }
        .back-btn { display: inline-block; margin-top: 20px; color: #0066cc; text-decoration: none; font-weight: bold; }
        .back-btn:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="container">
    <h2>Κατάλογος Προϊόντων ανά Κατηγορία</h2>

    <table>
        <tr>
            <th>Κωδικός</th>
            <th>Όνομα Προϊόντος</th>
            <th>Τιμή (€)</th>
        </tr>
        <?php
        $current_cat = "";
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Ομαδοποίηση ανά κατηγορία
                if ($current_cat != $row['kathgoria_proiontos']) {
                    $current_cat = $row['kathgoria_proiontos'];
                    echo "<tr class='cat-header'><td colspan='3'>📦 Κατηγορία: " . htmlspecialchars($current_cat) . "</td></tr>";
                }
                echo "<tr>";
                echo "<td>" . $row['kwdikos_proiontos'] . "</td>";
                echo "<td>" . htmlspecialchars($row['onomasia_proiontos']) . "</td>";
                echo "<td>" . number_format($row['timh_proiontos'], 2) . " €</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3' style='text-align:center;'>Δεν βρέθηκαν καταχωρημένα προϊόντα.</td></tr>";
        }
        ?>
    </table>

    <a href="owner.html" class="back-btn">← Πίσω στο Μενού Διαχειριστή</a>
</div>

</body>
</html>