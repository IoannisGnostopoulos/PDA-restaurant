<?php
session_start();

// Αν ο χρήστης είναι ήδη συνδεδεμένος, τον ανακατευθύνουμε ανάλογα με τον ρόλο του
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'owner') {
        header("Location: owner.php");
        exit();
    } elseif ($_SESSION['role'] === 'serbitoros') {
        header("Location: serbitoros.php");
        exit();
    } elseif ($_SESSION['role'] === 'kouzina') {
        header("Location: kouzina.php");
        exit();
    } elseif ($_SESSION['role'] === 'marka') {
        header("Location: marka.php");
        exit();
    }
}

// Αν δεν είναι συνδεδεμένος (ή αν ο ρόλος δεν αναγνωρίζεται), τον στέλνουμε στο login1.php
header("Location: login1.php");
exit();
?>