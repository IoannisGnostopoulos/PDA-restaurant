<?php
session_start();

// Αν ο χρήστης είναι ήδη συνδεδεμένος, ανακατεύθυνση στο αντίστοιχο πάνελ
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'serbitoros') {
        header("Location: serbitoros.php");
        exit();
    } elseif ($_SESSION['role'] === 'owner') {
        header("Location: owner.php");
        exit();
    }
}

// Αν δεν είναι συνδεδεμένος, μεταφορά στη σελίδα login1.php
header("Location: login1.php");
exit();
?>