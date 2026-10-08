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

// Αλλαγή κατάστασης παραγγελίας σε READY
if (isset($_POST['mark_ready'])) {
    $order_id = intval($_POST['order_id']);
    
    $stmt = $conn->prepare("UPDATE header SET katastash_paragelias = 'READY' WHERE kwdikos_paragellias = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $stmt->close();
    
    header("Location: kouzina.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="el">
<head>
<meta charset="UTF-8">
<!-- Αυτόματη ανανέωση κάθε 10 δευτερόλεπτα -->
<meta http-equiv="refresh" content="10"> 
<title>Οθόνη Κουζίνας</title>
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

.order-box {
    background-color: #ffffff;
    border: 2px solid #333;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
}

.btn-ready {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-size: 11pt;
    font-weight: bold;
}
</style>
</head>
<body>

<h2>Παραγγελίες Κουζίνας (Προς Ετοιμασία)</h2>

<?php
// Παίρνουμε όλες τις παραγγελίες που είναι σε PREPARATION
$sql_orders = "SELECT h.kwdikos_paragellias, h.kwdikos_trapeziou, h.hmeromhnia_kai_ora_anaxwrhshs 
                FROM header h 
                WHERE h.katastash_paragelias = 'PREPARATION' 
                ORDER BY h.kwdikos_paragellias ASC";

$res_orders = $conn->query($sql_orders);

if ($res_orders && $res_orders->num_rows > 0) {
    while ($order = $res_orders->fetch_assoc()) {
        $ord_id = $order['kwdikos_paragellias'];
        ?>
        <div class="order-box">
            <h3>Παραγγελία #<?php echo $ord_id; ?> — Τραπέζι: <?php echo $order['kwdikos_trapeziou']; ?></h3>
            <p><small>Ώρα Καταχώρησης: <?php echo $order['hmeromhnia_kai_ora_anaxwrhshs']; ?></small></p>
            
            <table>
                <tr>
                    <th>Προϊόν</th>
                    <th>Ποσότητα</th>
                    <th>Σχόλια</th>
                </tr>
                <?php
                $stmt_items = $conn->prepare("SELECT t.onomasia_proiontos, d.temaxia, d.sxolia 
                                              FROM details d 
                                              JOIN timokatalogos t ON d.kwdikos_proiontos = t.kwdikos_proiontos 
                                              WHERE d.kwdikos_paragellias = ?");
                $stmt_items->bind_param("i", $ord_id);
                $stmt_items->execute();
                $res_items = $stmt_items->get_result();

                while ($item = $res_items->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><b>" . htmlspecialchars($item['onomasia_proiontos']) . "</b></td>";
                    echo "<td>" . $item['temaxia'] . "</td>";
                    echo "<td>" . htmlspecialchars($item['sxolia'] ?? '') . "</td>";
                    echo "</tr>";
                }
                $stmt_items->close();
                ?>
            </table>

            <form method="POST" action="kouzina.php">
                <input type="hidden" name="order_id" value="<?php echo $ord_id; ?>">
                <input type="submit" name="mark_ready" value="✔ ΕΤΟΙΜΗ ΠΑΡΑΓΓΕΛΙΑ" class="btn-ready">
            </form>
        </div>
        <?php
    }
} else {
    echo "<p><i>Δεν υπάρχουν εκκρεμείς παραγγελίες στην κουζίνα.</i></p>";
}
?>

<br>
<a href="owner.html" style="color: blue;">BACK</a>

</body>
</html>