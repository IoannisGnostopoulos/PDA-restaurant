<?php
session_start();

// Καθαρισμός όλων των μεταβλητών session
$_SESSION = array();

// Διαγραφή του cookie της συνεδρίας
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Καταστροφή του session
session_destroy();

// Ανακατεύθυνση στο login1.php
header("Location: login1.php");
exit();
?>