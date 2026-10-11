 <html>
 <head>
 <title>Edit User Form</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 </head>
 <body>
 <?php
 $servername = "localhost";
 $username = "root";
    $password = "";
    $dbname = "tes1";
   
    $conn = new mysqli($servername, $username, $password, $dbname);
   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
   
    // --- THIS PART HANDLES THE SAVE (UPDATE) ---
    if(isset($_POST['INSERT'])){
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $user = $_POST['username'];
        $passw = $_POST['password'];
        $role = $_POST['rolecode'];
        $tameio = $_POST['register'];
        $id = $_POST['ids'];
   
        $updateSql = "UPDATE users SET onoma='$name', epitheto='$surname', Username='$user', Password='$passw',
 kwdikos_rolou='$role', tameio='$tameio' WHERE kwdikos_xrhsth='$id'";
   
        if(mysqli_query($conn, $updateSql)) {
            echo "<p style='color:green;'>Η αλλαγή έγινε επιτυχώς! Ανανεώστε τη σελίδα.</p>";
        } else {
            echo "<p style='color:red;'>Σφάλμα: " . mysqli_error($conn) . "</p>";
        }
    }
   
    // --- THIS PART FETCHES THE USER DATA ---
    if(isset($_GET['q'])){
        $q = intval($_GET['q']);
        $sql2 = "SELECT * FROM users WHERE kwdikos_xrhsth = $q";
        $result3 = mysqli_query($conn, $sql2);
   
        if($row = mysqli_fetch_assoc($result3)) {
    ?>
            <form method="POST" action="edit.php?q=<?php echo $q; ?>">
                <table id="tab">
                    <tr>
                        <td>Όνομα: <input type="text" name="name" value="<?php echo $row["onoma"]; ?>"></td>
                        <td>Επίθετο: <input type="text" name="surname" value="<?php echo $row["epitheto"]; ?>"></td>
                    </tr>
                    <tr>
                        <td>Username: <input type="text" name="username" value="<?php echo $row["Username"]; ?>"></td>
                        <td>Password: <input type="text" name="password" value="<?php echo $row["Password"]; ?>"></td>
                    </tr>
                    <tr>
                        <td>Κωδικός Ρόλου: <input type="text" name="rolecode" value="<?php echo $row["kwdikos_rolou"];
 ?>"></td>
                        <td>Ταμείο: <input type="text" name="register" value="<?php echo $row["tameio"]; ?>"></td>
                    </tr>
                    <input type="hidden" name="ids" value="<?php echo $q; ?>">
                </table>
                <br>
                <input type="submit" name="INSERT" value="Αποθήκευση Αλλαγών">
            </form>
    <?php
        }
    }
    $conn->close();
    ?>
    </body>
    </html>