<!DOCTYPE html>
 <?php
     // 1. Database Connection
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "tes1";
    
     $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
   
    // 2. Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
       $user = $_POST['username'];
       $pass = $_POST['password'];
        $usercode = $_POST['usercode'];
        $rolecode = $_POST['rolecode'];
   
        // 3. Insert the user into the database
        $sql = "INSERT INTO users (kwdikos_xrhsth, Username, Password, onoma, epitheto, kwdikos_rolou, tameio)
                VALUES ('$usercode', '$user', '$pass', '$name', '$surname', '$rolecode', 0.00)";
   
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Ο χρήστης προστέθηκε επιτυχώς!'); window.location.href='owner.html';</script>";
        } else {
           echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
 $conn->close();
    ?>
   
    <!DOCTYPE html>
    <html>
    <head>
        <title>Insert User</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>
           body { background-color:#DCDCDC; font-family: Arial; padding-left: 50px; }
           #tab { margin-top: 50px; }
            #rol { margin-top: 20px; border-collapse: collapse; }
            #rol th, #rol td { border: 1px solid black; padding: 5px; }
       </style>
    </head>
    <body>
    <h4>Εισαγωγή νέου χρήστη</h4>
   
    <form method="POST" action="php_insert.php">
        <table id="tab" cellpadding="5">
            <tr>
                <td>Όνομα:</td>
                <td><input type="text" name="name" required></td>
                <td>Επίθετο:</td>
                <td><input type="text" name="surname" required></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" required></td>
                <td>Password:</td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td>Κωδικός χρήστη (ID):</td>
                <td><input type="text" name="usercode" required></td>
                <td>Ρόλος:</td>
                <td>
                    <select name="rolecode" required>
                        <option value="1">1 (Ιδιοκτήτης)</option>
                        <option value="2">2 (Σερβιτόρος)</option>
                        <option value="3">3 (Κουζίνα)</option>
                        <option value="4">4 (Μάρκα)</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <input type="submit" value="Εισαγωγή">
                    <a href="owner.html" style="margin-left:20px;">Πίσω</a>
                </td>
            </tr>
        </table>
    </form>
   
    <br>
    <table id="rol">
        <tr><th>Κωδικός ρόλου</th><th>Όνομα ρόλου</th></tr>
        <tr><td>1</td><td>Ιδιοκτήτης</td></tr>
        <tr><td>2</td><td>Σερβιτόρος</td></tr>
        <tr><td>3</td><td>Κουζίνα</td></tr>
        <tr><td>4</td><td>Μάρκα</td></tr>
    </table>
   
    </body>
    </html>