<?php
session_start();
require_once 'db.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_input = trim($_POST['username'] ?? $_POST['txtuser'] ?? '');
    $pass_input = trim($_POST['password'] ?? $_POST['txtpass'] ?? '');

    if (!empty($user_input) && !empty($pass_input)) {
        // Αναζήτηση στη βάση tes1 στον πίνακα users
        $stmt = $pdo->prepare("SELECT * FROM users WHERE Username = :user AND Password = :pass LIMIT 1");
        $stmt->execute([
            'user' => $user_input,
            'pass' => $pass_input
        ]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['user_id'] = $user['kwdikos_xrhsth'];
            $_SESSION['username'] = $user['Username'];
            $_SESSION['role_id'] = $user['kwdikos_rolou'];

            // Ρόλος 1 = Owner / Admin, Ρόλος 2 = Σερβιτόρος
            if ($user['kwdikos_rolou'] == 1) {
                $_SESSION['role'] = "owner";
                header("Location: owner.php");
                exit();
            } else {
                $_SESSION['role'] = "serbitoros";
                header("Location: serbitoros.php");
                exit();
            }
        } else {
            $error_msg = "Λάθος Όνομα Χρήστη ή Κωδικός!";
        }
    } else {
        $error_msg = "Παρακαλώ συμπληρώστε όλα τα πεδία!";
    }
}
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Σύνδεση - Login</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #DCDCDC; 
            padding: 50px 20px; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            margin: 0;
        }
        
        .login-box { 
            width: 100%;
            max-width: 280px; 
            background: white; 
            padding: 25px; 
            border-radius: 8px; 
            border: 1px solid #000; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.1); 
            text-align: center;
        }

        .logo-img {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        h2 { 
            margin-top: 0; 
            color: #333; 
            font-size: 20px;
            margin-bottom: 20px;
        }

        .form-group { 
            margin-bottom: 15px; 
            text-align: left; 
        }

        label { 
            display: block; 
            margin-bottom: 5px; 
            font-weight: bold; 
            font-size: 14px;
        }

        input[type="text"], 
        input[type="password"] { 
            width: 100%; 
            padding: 10px; 
            border: 1px solid #ccc; 
            border-radius: 4px; 
            box-sizing: border-box; 
            font-size: 14px;
        }

        .btn-submit { 
            width: 100%; 
            padding: 10px; 
            background-color: #008CBA; 
            color: white; 
            border: none; 
            border-radius: 4px; 
            font-size: 16px; 
            font-weight: bold; 
            cursor: pointer; 
            margin-top: 10px;
        }

        .btn-submit:hover { 
            background-color: #005f73; 
        }

        .error { 
            color: red; 
            margin-bottom: 15px; 
            font-weight: bold; 
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <img src="a1.jpg" alt="Logo" class="logo-img">
    
    <h2>Σύνδεση</h2>
    
    <?php if (!empty($error_msg)): ?>
        <p class="error"><?php echo htmlspecialchars($error_msg); ?></p>
    <?php endif; ?>

    <form action="login1.php" method="POST">
        <div class="form-group">
            <label for="username">Όνομα Χρήστη:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Κωδικός Πρόσβασης:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn-submit">Είσοδος</button>
    </form>
</div>

</body>
</html>