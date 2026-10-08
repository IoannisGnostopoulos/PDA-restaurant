 <?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "tes1";

 $conn = new mysqli($servername, $username, $password, $dbname);
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
    }
   
    // Check if a delete request was sent
    if (isset($_POST['delete_user_btn']) && !empty($_POST['user_to_delete'])) {
        $id = $_POST['user_to_delete'];
        // Using a prepared statement for safety
        $stmt = $conn->prepare("DELETE FROM users WHERE kwdikos_xrhsth = ?");
        $stmt->bind_param("s", $id);
        if ($stmt->execute()) {
            echo "<script>alert('Ο χρήστης διαγράφηκε επιτυχώς!');</script>";
        } else {
            echo "<script>alert('Σφάλμα κατά τη διαγραφή.');</script>";
        }
        $stmt->close();
    }
    ?>
   
    <html>
    <head>
        <title>Delete User</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>
            body { background-color:#DCDCDC; font-family: Arial; padding-left: 50px; }
            table { margin-top: 20px; border-collapse: collapse; }
            table, th, td { border: 1px solid black; padding: 8px; }
        </style>
    </head>
    <body>
        <h4>Διαγραφή Χρήστη</h4>
   
        <form method="POST" action="" onsubmit="return confirm('Είστε σίγουροι ότι θέλετε να διαγράψετε τον
 χρήστη;');">
            <label>Επιλέξτε χρήστη:</label>
            <select name="user_to_delete" required>
                <option value="">-- Επιλογή --</option>
                <?php
                $sql = "SELECT kwdikos_xrhsth, onoma, epitheto FROM users";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["kwdikos_xrhsth"] . "'>" . $row["onoma"] . " " . $row["epitheto"] .
 "</option>";
                }
                ?>
            </select>
            <button type="submit" name="delete_user_btn">DELETE</button>
        </form>
   
        <table>
            <tr>
                <th>ΚΩΔΙΚΟΣ ΧΡΗΣΤΗ</th>
                <th>ΟΝΟΜΑ</th>
                <th>ΕΠΙΘΕΤΟ</th>
            </tr>
            <?php
            $result = $conn->query("SELECT kwdikos_xrhsth, onoma, epitheto FROM users");
            while($row = $result->fetch_assoc()){
                echo "<tr><td>" .$row["kwdikos_xrhsth"]."</td><td>". $row["onoma"]. "</td><td>"
 .$row["epitheto"]."</td></tr>";
            }
            ?>
        </table>
        <br>
        <a href="owner.html" style="color: blue;">BACK</a>
    </body>
    </html>