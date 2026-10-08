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

// Ορισμός ημερομηνίας αναζήτησης (προεπιλογή η σημερινή)
$selected_date = $_POST['search_date'] ?? date("Y-m-d");
$formatted_date = date("Y/m/d", strtotime($selected_date));
?>
<!DOCTYPE html>
<html lang="el">
<head>
<meta charset="UTF-8">
<title>Επισκόπηση Ποσών & Εσόδων</title>
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
    margin-bottom: 25px;
}

th, td {
    border: 1px solid #000000;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f0f0f0;
}

.box {
    background-color: #e6e6e6;
    border: 1px solid #000000;
    padding: 15px;
    margin-bottom: 25px;
}

.btn {
    padding: 8px 16px;
    background-color: #2196F3;
    color: white;
    border: none;
    cursor: pointer;
    font-weight: bold;
}
</style>
</head>
<body>

<h2>Επισκόπηση Εσόδων & Πωλήσεων</h2>

<!-- Φόρμα Φιλτραρίσματος Ημερομηνίας -->
<div class="box">
    <form method="POST" action="episkopisi_poson.php">
        <b>Επιλογή Ημερομηνίας:</b>
        <input type="date" name="search_date" value="<?php echo $selected_date; ?>" required>
        <input type="submit" value="Αναζήτηση" class="btn">
    </form>
</div>

<!-- 1. ΣΥΝΟΛΙΚΑ ΕΣΟΔΑ -->
<h3>1. Συνολικά Έσοδα Ημέρας (<?php echo $selected_date; ?>)</h3>
<?php
$stmt_tot = $conn->prepare("SELECT SUM(synolo_paragelias) AS total_day, COUNT(kwdikos_paragellias) AS total_orders FROM header WHERE hmeromhnia = ?");
$stmt_tot->bind_param("s", $formatted_date);
$stmt_tot->execute();
$res_tot = $stmt_tot->get_result()->fetch_assoc();
$stmt_tot->close();

$day_total = $res_tot['total_day'] ?? 0;
$day_orders = $res_tot['total_orders'] ?? 0;
?>
<div class="box">
    <p><b>Συνολικές Παραγγελίες:</b> <?php echo $day_orders; ?></p>
    <p><b>Συνολικά Έσοδα:</b> <span style="font-size: 16pt; color: green;"><b><?php echo number_format($day_total, 2); ?> €</b></span></p>
</div>

<!-- 2. ΠΩΛΗΣΕΙΣ ΑΝΑ ΣΕΡΒΙΤΟΡΟ -->
<h3>2. Πωλήσεις ανά Σερβιτόρο</h3>
<table>
    <tr>
        <th>Κωδικός Σερβιτόρου</th>
        <th>Πλήθος Παραγγελιών</th>
        <th>Συνολικές Πωλήσεις (€)</th>
    </tr>
    <?php
    $stmt_serb = $conn->prepare("SELECT kwdikos_servitorou, COUNT(kwdikos_paragellias) AS count_orders, SUM(synolo_paragelias) AS total_sales 
                                 FROM header 
                                 WHERE hmeromhnia = ? 
                                 GROUP BY kwdikos_servitorou");
    $stmt_serb->bind_param("s", $formatted_date);
    $stmt_serb->execute();
    $res_serb = $stmt_serb->get_result();

    if ($res_serb && $res_serb->num_rows > 0) {
        while ($row_s = $res_serb->fetch_assoc()) {
            echo "<tr>";
            echo "<td><b>Σερβιτόρος #" . $row_s['kwdikos_servitorou'] . "</b></td>";
            echo "<td>" . $row_s['count_orders'] . "</td>";
            echo "<td>" . number_format($row_s['total_sales'], 2) . " €</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3' style='text-align:center;'>Δεν υπάρχουν καταχωρημένες πωλήσεις.</td></tr>";
    }
    $stmt_serb->close();
    ?>
</table>

<!-- 3. ΕΣΟΔΑ ΑΝΑ ΚΑΤΗΓΟΡΙΑ ΠΡΟΪΟΝΤΟΣ -->
<h3>3. Έσοδα ανά Κατηγορία Προϊόντος</h3>
<table>
    <tr>
        <th>Κατηγορία</th>
        <th>Τεμάχια</th>
        <th>Συνολικά Έσοδα (€)</th>
    </tr>
    <?php
    $stmt_cat = $conn->prepare("SELECT t.kathgoria_proiontos, SUM(d.temaxia) AS total_qty, SUM(d.timh_proiontos) AS total_cat_sales 
                                FROM details d 
                                JOIN header h ON d.kwdikos_paragellias = h.kwdikos_paragellias 
                                JOIN timokatalogos t ON d.kwdikos_proiontos = t.kwdikos_proiontos 
                                WHERE h.hmeromhnia = ? 
                                GROUP BY t.kathgoria_proiontos");
    $stmt_cat->bind_param("s", $formatted_date);
    $stmt_cat->execute();
    $res_cat = $stmt_cat->get_result();

    if ($res_cat && $res_cat->num_rows > 0) {
        while ($row_c = $res_cat->fetch_assoc()) {
            echo "<tr>";
            echo "<td><b>" . htmlspecialchars($row_c['kathgoria_proiontos']) . "</b></td>";
            echo "<td>" . $row_c['total_qty'] . "</td>";
            echo "<td>" . number_format($row_c['total_cat_sales'], 2) . " €</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3' style='text-align:center;'>Δεν υπάρχουν δεδομένα.</td></tr>";
    }
    $stmt_cat->close();
    ?>
</table>

<!-- 4. ΕΣΟΔΑ ΑΝΑ ΤΡΑΠΕΖΙ -->
<h3>4. Έσοδα ανά Τραπέζι</h3>
<table>
    <tr>
        <th>Αριθμός Τραπεζιού</th>
        <th>Αριθμός Παραγγελιών</th>
        <th>Συνολικές Εισπράξεις (€)</th>
    </tr>
    <?php
    $stmt_tab = $conn->prepare("SELECT kwdikos_trapeziou, COUNT(kwdikos_paragellias) AS num_orders, SUM(synolo_paragelias) AS table_total 
                                FROM header 
                                WHERE hmeromhnia = ? 
                                GROUP BY kwdikos_trapeziou 
                                ORDER BY kwdikos_trapeziou ASC");
    $stmt_tab->bind_param("s", $formatted_date);
    $stmt_tab->execute();
    $res_tab = $stmt_tab->get_result();

    if ($res_tab && $res_tab->num_rows > 0) {
        while ($row_t = $res_tab->fetch_assoc()) {
            echo "<tr>";
            echo "<td><b>Τραπέζι " . $row_t['kwdikos_trapeziou'] . "</b></td>";
            echo "<td>" . $row_t['num_orders'] . "</td>";
            echo "<td>" . number_format($row_t['table_total'], 2) . " €</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3' style='text-align:center;'>Δεν υπάρχουν δεδομένα.</td></tr>";
    }
    $stmt_tab->close();
    ?>
</table>

<br>
<a href="owner.html" style="color: blue;">← Πίσω στο Μενού Διαχειριστή</a>

</body>
</html>