<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Έλεγχος Ασφαλείας: Μόνο ο Owner έχει πρόσβαση
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Πάνελ Διαχειριστή - Owner</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body { 
            font-family: 'Inter', system-ui, -apple-system, sans-serif; 
            background: #f0f2f5; 
            color: #1c1e21;
            padding: 40px 15px; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container { 
            width: 100%;
            max-width: 520px; 
            background: #ffffff; 
            padding: 32px 28px; 
            border-radius: 16px; 
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05), 0 2px 6px rgba(0, 0, 0, 0.04);
            border: 1px solid #e4e6eb;
        }

        .header {
            text-align: center;
            margin-bottom: 28px;
        }

        .header h1 { 
            color: #1a202c; 
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        .user-badge {
            display: inline-block;
            background: #eef2ff;
            color: #4f46e5;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .section-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #8a94a6;
            margin-top: 22px;
            margin-bottom: 10px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #edf2f7;
        }

        .btn-grid {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .nav-btn { 
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 12px;
            width: 100%; 
            padding: 12px 16px; 
            background: #ffffff; 
            color: #2d3748; 
            text-decoration: none; 
            border-radius: 10px; 
            font-size: 14px; 
            font-weight: 600; 
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
            transition: all 0.18s ease-in-out;
        }

        .nav-btn svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            transition: transform 0.18s ease;
        }

        .nav-btn:hover { 
            background: #f8fafc;
            border-color: #cbd5e1;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            color: #0f172a;
        }

        .nav-btn:hover svg {
            transform: scale(1.1);
        }

        .nav-btn:active {
            transform: translateY(0);
        }

        /* Θεματικές Χρωματικές Πινελιές στα Icons */
        .btn-add svg { color: #16a34a; }
        .btn-edit svg { color: #d97706; }
        .btn-delete svg { color: #dc2626; }
        .btn-menu svg { color: #2563eb; }
        .btn-stats svg { color: #0284c7; }
        .btn-kitchen svg { color: #ea580c; }

        /* Κουμπί Αποσύνδεσης */
        .logout-btn { 
            margin-top: 28px;
            background: #fef2f2;
            color: #dc2626;
            border-color: #fecaca;
            justify-content: center;
        }

        .logout-btn svg { color: #dc2626; }

        .logout-btn:hover { 
            background: #dc2626; 
            color: #ffffff;
            border-color: #dc2626;
        }

        .logout-btn:hover svg {
            color: #ffffff;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Πάνελ Διαχείρισης</h1>
        <div class="user-badge">👋 <?php echo htmlspecialchars($username); ?> (Owner)</div>
    </div>

    <!-- ΔΙΑΧΕΙΡΙΣΗ ΧΡΗΣΤΩΝ -->
    <div class="section-title">Διαχείριση Χρηστών</div>
    <div class="btn-grid">
        <a href="php_insert.php" class="nav-btn btn-add">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            Εισαγωγή Νέου Χρήστη
        </a>
        <a href="edit1.php" class="nav-btn btn-edit">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            Τροποποίηση Χρήστη
        </a>
        <a href="delete.php" class="nav-btn btn-delete">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            Διαγραφή Χρήστη
        </a>
    </div>

    <!-- ΔΙΑΧΕΙΡΙΣΗ ΜΕΝΟΥ & ΠΑΡΑΓΓΕΛΙΩΝ -->
    <div class="section-title">Μενού & Παραγγελίες</div>
    <div class="btn-grid">
        <a href="menuedit.php" class="nav-btn btn-menu">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            Διαμόρφωση Κατηγοριών & Μενού
        </a>
        <a href="kataxwrhsh.php" class="nav-btn btn-add">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            Καταχώρηση Παραγγελίας
        </a>
    </div>

    <!-- ΕΠΙΣΚΟΠΗΣΗ & ΑΝΑΦΟΡΕΣ -->
    <div class="section-title">Επισκόπηση & Οθόνες</div>
    <div class="btn-grid">
        <a href="indi1.php" class="nav-btn btn-stats">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            Επισκόπηση ανά Σερβιτόρο
        </a>
        <a href="episkopisi_poson.php" class="nav-btn btn-stats">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Επισκόπηση Εσόδων
        </a>
        <a href="marka.php" class="nav-btn btn-stats">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            Προϊόντα ανά Κατηγορία (Μάρκα)
        </a>
        <a href="kouzina.php" class="nav-btn btn-kitchen">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path></svg>
            Οθόνη Κουζίνας
        </a>
    </div>

    <!-- ΑΠΟΣΥΝΔΕΣΗ -->
    <a href="logout.php" class="nav-btn logout-btn">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
        Αποσύνδεση
    </a>
</div>

</body>
</html>
