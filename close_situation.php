<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tes1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ενημέρωση κατάστασης παραγγελίας
if (isset($_POST['UPDATE_STATUS'])) {
    $order_id = intval($_POST['order_id']);
    $new_status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE header SET katastash_paragelias = ? WHERE kwdikos_paragellias = ?");
    $stmt->bind_param("si", $new_status, $order_id);
    
    if ($stmt->execute()) {
        echo "<p style='color:green; font-weight:bold;'>Η κατάσταση ενημερώθηκε επιτυχώς!</p>";
    } else {
        echo "<p style='color:red;'>Σφάλμα ενημέρωσης.</p>";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="el">
<head>
<meta charset="UTF-8">
<title>Αλλαγή Κατάστασης Παραγγελίας</title>
<style>
body {
    background-color: #DCDCDC;
    font-family: Arial, sans-serif;
    font-size: 12pt;
    padding: 20px 40px;
    color: #000000;
}

table {
    border-collapse: collapse;
    width: 100%;
    background-color: #ffffff;
    margin-bottom: 20px;
}

th, td {
    border: 1px solid #000000;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f0f0f0;
}

.box {
    background-color: #e6e6e6;
    border: 1px solid #000000;
    padding: 15px;
    margin-bottom: 20px;
}

.btn {
    padding: 8px 15px;
    background-color: #2196F3;
    color: white;
    border: none;
    cursor: pointer;
    font-weight: bold;
}
</style>
</head>
<body>

<h2>Διαχείριση Κατάστασης Παραγγελιών</h2>

<!-- Φόρμα Αλλαγής Κατάστασης -->
<div class="box">
    <h3>Αλλαγή Κατάστασης</h3>
    <form method="POST" action="close_situation.php">
        <p>
            <b>Επιλογή Παραγγελίας (#ID):</b>
            <select name="order_id" required>
                <option value="">-- Επιλέξτε Παραγγελία --</option>
                <?php
                $sql = "SELECT kwdikos_paragellias, kwdikos_trapeziou, katastash_paragelias FROM header WHERE katastash_paragelias != 'DELIVERED'";
                $res = $conn->query($sql);
                while ($row = $res->fetch_assoc()) {
                    echo "<option value='" . $row['kwdikos_paragellias'] . "'># " . $row['kwdikos_paragellias'] . " (Τραπέζι " . $row['kwdikos_trapeziou'] . " - " . $row['katastash_paragelias'] . ")</option>";
                }
                ?>
            </select>
        </p>
        <p>
            <b>Νέα Κατάσταση:</b>
            <select name="status" required>
                <option value="PREPARATION">PREPARATION (Προετοιμασία)</option>
                <option value="READY">READY (Έτοιμη)</option>
                <option value="SERVING">SERVING (Σερβίρεται)</option>
                <option value="DELIVERED">DELIVERED (Ολοκληρώθηκε)</option>
            </select>
            
            <input type="submit" name="UPDATE_STATUS" value="Ενημέρωση" class="btn">
        </p>
    </form>
</div>

<!-- Πίνακας Ενεργών Παραγγελιών -->
<h3>Ενεργές Παραγγελίες</h3>
<table>
    <tr>
        <th>ID Παραγγελίας</th>
        <th>Τραπέζι</th>
        <th>Σερβιτόρος</th>
        <th>Σύνολο</th>
        <th>Κατάσταση</th>
    </tr>
    <?php
    $sql_all = "SELECT * FROM header ORDER BY kwdikos_paragellias DESC";
    $res_all = $conn->query($sql_all);

    if ($res_all && $res_all->num_rows > 0) {
        while ($r = $res_all->fetch_assoc()) {
            echo "<tr>";
            echo "<td><b>#" . $r['kwdikos_paragellias'] . "</b></td>";
            echo "<td>" . $r['kwdikos_trapeziou'] . "</td>";
            echo "<td>" . $r['kwdikos_servitorou'] . "</td>";
            echo "<td>" . number_format($r['synolo_paragelias'], 2) . " €</td>";
            echo "<td><b>" . $r['katastash_paragelias'] . "</b></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5' style='text-align:center;'>Δεν υπάρχουν παραγγελίες.</td></tr>";
    }
    ?>
</table>

<br>
<a href="serbitoros.php" style="color: blue;">← Πίσω στο Μενού Σερβιτόρου</a>

</body>
</html>