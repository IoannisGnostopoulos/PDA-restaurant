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

// Αρχικοποίηση προσωρινού καλαθιού
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// 1. ΠΡΟΣΘΗΚΗ ΠΡΟΪΟΝΤΟΣ ΣΤΗΝ ΠΡΟΣΩΡΙΝΗ ΛΙΣΤΑ
if (isset($_POST["ADD_ITEM"])) {
    $item_id = intval($_POST['pass']);
    $quantity = intval($_POST['quantity']);
    $sxolia = trim($_POST['sxol']);

    if (!empty($_POST['tabl'])) {
        $_SESSION['current_table'] = intval($_POST['tabl']);
    }

    // Αναζήτηση προϊόντος στον τιμοκατάλογο
    $stmt = $conn->prepare("SELECT onomasia_proiontos, timh_proiontos FROM timokatalogos WHERE kwdikos_proiontos = ?");
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($res) {
        $_SESSION['cart'][] = array(
            'item_id' => $item_id,
            'name' => $res['onomasia_proiontos'],
            'qty' => $quantity,
            'price' => $res['timh_proiontos'] * $quantity,
            'comments' => $sxolia
        );
    } else {
        $error_msg = "Ο κωδικός προϊόντος δεν υπάρχει στον τιμοκατάλογο!";
    }
}

// 2. ΔΙΑΓΡΑΦΗ ΠΡΟΪΟΝΤΟΣ ΑΠΟ ΤΗΝ ΠΡΟΣΩΡΙΝΗ ΛΙΣΤΑ
if (isset($_GET['del_index'])) {
    $index = intval($_GET['del_index']);
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
    header("Location: kataxwrhsh.php");
    exit();
}

// 3. ΟΛΟΚΛΗΡΩΣΗ ΠΑΡΑΓΓΕΛΙΑΣ & ΚΑΘΑΡΙΣΜΟΣ
if (isset($_POST["FINISH_ORDER"])) {
    $trapezi = intval($_POST['tabl'] ?? $_SESSION['current_table'] ?? 0);

    if ($trapezi > 0 && !empty($_SESSION['cart'])) {
        $id_serb = $_SESSION['kwdikos_rolou'] ?? 2;
        $day = date("Y/m/d");
        $dt = date("Y/m/d H:i:s");

        // Υπολογισμός νέου ID παραγγελίας
        $res_id = $conn->query("SELECT COALESCE(MAX(kwdikos_paragellias), 0) + 1 AS next_id FROM header");
        $row_id = $res_id->fetch_assoc();
        $new_order_id = intval($row_id['next_id']);

        // Υπολογισμός συνολικού ποσού
        $total_sum = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total_sum += $item['price'];
        }

        // Εισαγωγή στον πίνακα header
        $stmt_h = $conn->prepare("INSERT INTO header (kwdikos_paragellias, kwdikos_trapeziou, hmeromhnia, kwdikos_servitorou, synolo_paragelias, katastash_paragelias, hmeromhnia_kai_ora_anaxwrhshs) VALUES (?, ?, ?, ?, ?, 'PREPARATION', ?)");
        $stmt_h->bind_param("iisids", $new_order_id, $trapezi, $day, $id_serb, $total_sum, $dt);
        $stmt_h->execute();
        $stmt_h->close();

        // Εισαγωγή στον πίνακα details
        $stmt_d = $conn->prepare("INSERT INTO details (kwdikos_paragellias, kwdikos_proiontos, temaxia, timh_proiontos, sxolia) VALUES (?, ?, ?, ?, ?)");
        foreach ($_SESSION['cart'] as $item) {
            $stmt_d->bind_param("iiids", $new_order_id, $item['item_id'], $item['qty'], $item['price'], $item['comments']);
            $stmt_d->execute();
        }
        $stmt_d->close();

        // ΠΛΗΡΗΣ ΚΑΘΑΡΙΣΜΟΣ
        unset($_SESSION['cart']);
        unset($_SESSION['current_table']);

        echo "<script>alert('Η παραγγελία #' + $new_order_id + ' καταχωρήθηκε επιτυχώς!'); window.location.href='kataxwrhsh.php';</script>";
        exit();
    } else {
        $error_msg = "Παρακαλώ συμπληρώστε αριθμό τραπεζιού και προσθέστε τουλάχιστον ένα προϊόν.";
    }
}
?>
<!DOCTYPE html>
<html lang="el">
<head>
<meta charset="UTF-8">
<title>Καταχώρηση Παραγγελίας</title>
<style>
body {
    padding-left: 50px;
    font-family: Arial, sans-serif;
    color: black;
    font-size: 12pt;
    width: 900px;
    background-color: #DCDCDC;
    line-height: 25px;
}

h2, h3 {
    margin-top: 25px;
    margin-bottom: 10px;
}

table {
    border-collapse: collapse;
    background-color: #ffffff;
    width: 100%;
    margin-bottom: 15px;
}

th, td {
    border: 1px solid #000;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

.form-box {
    background-color: #eaeaea;
    padding: 15px;
    border: 1px solid #ccc;
    margin: 20px 0;
}

.form-box input[type="text"], 
.form-box input[type="number"] {
    padding: 5px;
    margin-right: 10px;
}

.btn-add {
    background-color: #4CAF50;
    color: white;
    padding: 7px 15px;
    border: none;
    cursor: pointer;
    font-weight: bold;
}

.btn-finish {
    background-color: #2196F3;
    color: white;
    padding: 10px 20px;
    font-size: 14pt;
    border: none;
    cursor: pointer;
    font-weight: bold;
    margin-top: 10px;
}

.error {
    color: red;
    font-weight: bold;
}
</style>
</head>

<body>

<h2>Μενού & Καταχώρηση Παραγγελίας</h2>

<?php if (isset($error_msg)): ?>
    <p class="error"><?php echo $error_msg; ?></p>
<?php endif; ?>

<!-- 1. ΠΙΝΑΚΑΣ ΤΙΜΟΚΑΤΑΛΟΓΟΥ -->
<h3>1. Τιμοκατάλογος Προϊόντων</h3>
<table>
    <tr>
        <th>Κωδικός Προϊόντος</th>
        <th>Ονομασία Προϊόντος</th>
        <th>Τιμή Προϊόντος</th>
        <th>Κατηγορία Προϊόντος</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM timokatalogos");
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td><b>" . $row["kwdikos_proiontos"] . "</b></td>
                    <td>" . htmlspecialchars($row["onomasia_proiontos"]) . "</td>
                    <td>" . number_format($row["timh_proiontos"], 2) . " €</td>
                    <td>" . htmlspecialchars($row["kathgoria_proiontos"]) . "</td>
                  </tr>";
        }
    }
    ?>
</table>

<!-- 2. ΦΟΡΜΑ ΕΙΣΑΓΩΓΗΣ -->
<div class="form-box">
    <h3>2. Στοιχεία Παραγγελίας</h3>
    <form method="POST">
        <p>
            <b>Τραπέζι:</b> 
            <input type="number" name="tabl" value="<?php echo $_SESSION['current_table'] ?? ''; ?>" placeholder="π.χ. 5" required>
        </p>
        <p>
            <b>Κωδικός Προϊόντος:</b> 
            <input type="number" name="pass" required style="width: 80px;">

            <b>Ποσότητα:</b> 
            <input type="number" name="quantity" value="1" min="1" max="20" required style="width: 60px;">

            <b>Σχόλια:</b> 
            <input type="text" name="sxol" placeholder="π.χ. χωρίς πάγο" style="width: 200px;">

            <input type="submit" name="ADD_ITEM" value="Προσθήκη" class="btn-add">
        </p>
    </form>
</div>

<!-- 3. ΠΡΟΣΩΡΙΝΟΣ ΠΙΝΑΚΑΣ ΠΑΡΑΓΓΕΛΙΑΣ -->
<h3>3. Προσωρινή Λίστα Παραγγελίας</h3>
<p><b>Επιλεγμένο Τραπέζι:</b> <?php echo $_SESSION['current_table'] ?? '<i>Δεν συμπληρώθηκε</i>'; ?></p>

<table>
    <tr>
        <th>Κωδικός Προϊόντος</th>
        <th>Ονομασία Προϊόντος</th>
        <th>Ποσότητα</th>
        <th>Τιμή</th>
        <th>Σχόλια</th>
        <th>Aκύρωση</th>
    </tr>
    <?php
    $grand_total = 0;
    if (!empty($_SESSION['cart'])):
        foreach ($_SESSION['cart'] as $index => $item):
            $grand_total += $item['price'];
    ?>
    <tr>
        <td><?php echo $item['item_id']; ?></td>
        <td><?php echo htmlspecialchars($item['name']); ?></td>
        <td><?php echo $item['qty']; ?></td>
        <td><?php echo number_format($item['price'], 2); ?> €</td>
        <td><?php echo htmlspecialchars($item['comments'] ?? ''); ?></td>
        <td><a href="kataxwrhsh.php?del_index=<?php echo $index; ?>" style="color:red; font-weight:bold;">Διαγραφή</a></td>
    </tr>
    <?php 
        endforeach;
    else:
    ?>
    <tr>
        <td colspan="6" style="text-align:center; color:#666;">Δεν έχουν προστεθεί προϊόντα ακόμα.</td>
    </tr>
    <?php endif; ?>
</table>

<h3>Σύνολο: <?php echo number_format($grand_total, 2); ?> €</h3>

<form method="POST">
    <input type="submit" name="FINISH_ORDER" value="Ολοκλήρωση Παραγγελίας" class="btn-finish">
</form>

<br><br>
<a href="serbitoros.php" style="color: blue;">← Πίσω στο Μενού Σερβιτόρου</a>

</body>
</html>