<?php
session_start();

// Έλεγχος αν ο χρήστης είναι συνδεδεμένος ΚΑΙ αν είναι Owner
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'owner') {
    header("Location: login1.php");
    exit();
}

$username = $_SESSION['username'] ?? 'Διαχειριστής';
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Πάνελ Διαχειριστή - Owner</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #DCDCDC; padding: 40px; text-align: center; }
        .box { max-width: 450px; margin: 0 auto; background: white; padding: 25px; border-radius: 8px; border: 1px solid #000; }
        .btn { display: block; width: 100%; padding: 12px; margin: 10px 0; background-color: #008CBA; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; box-sizing: border-box; }
        .btn-red { background-color: #f44336; }
    </style>
</head>
<body>

<div class="box">
    <h2>Πάνελ Διαχείρισης (Owner)</h2>
    <p>Καλώς ήρθατε, <strong><?php echo htmlspecialchars($username); ?></strong></p>
    
    <a href="kouzina.php" class="btn">🍳 Οθόνη Κουζίνας</a>
    <a href="episkopisi_poson.php" class="btn">📊 Επισκόπηση Εσόδων</a>
    <a href="marka.php" class="btn">📦 Προϊόντα ανά Κατηγορία</a>
    <a href="logout.php" class="btn btn-red">🚪 Αποσύνδεση</a>
</div>

</body>
</html>