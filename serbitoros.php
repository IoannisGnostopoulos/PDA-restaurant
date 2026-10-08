<?php
session_start();

// Έλεγχος αν ο χρήστης είναι συνδεδεμένος ΚΑΙ αν είναι Σερβιτόρος
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'serbitoros') {
    header("Location: login1.php");
    exit();
}

$username = $_SESSION['username'] ?? 'Σερβιτόρος';
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Πάνελ Σερβιτόρου</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #DCDCDC; padding: 40px; text-align: center; }
        .box { max-width: 450px; margin: 0 auto; background: white; padding: 25px; border-radius: 8px; border: 1px solid #000; }
        .btn { display: block; width: 100%; padding: 12px; margin: 10px 0; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; box-sizing: border-box; }
        .btn-red { background-color: #f44336; }
    </style>
</head>
<body>

<div class="box">
    <h2>Πάνελ Σερβιτόρου</h2>
    <p>Καλώς ήρθατε, <strong><?php echo htmlspecialchars($username); ?></strong></p>
    
    <a href="kataxwrhsh.php" class="btn">➕ Καταχώρηση Παραγγελίας</a>
    <a href="close_situation.php" class="btn">📋 Διαχείριση Παραγγελιών</a>
    <a href="logout.php" class="btn btn-red">🚪 Αποσύνδεση</a>
</div>

</body>
</html>