<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "tes1";

 $conn = new mysqli($servername, $username, $password, $dbname);
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
    }
   
    // Get the waiter ID from the AJAX request
    $q = isset($_GET['q']) ? intval($_GET['q']) : 0;
   
    $sql = "SELECT * FROM header WHERE kwdikos_servitorou = $q";
    $result = mysqli_query($conn, $sql);
   
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%; background: white;'>";
        echo "<tr style='background: #eee;'>
                <th>Κωδικός Παρ.</th>
                <th>Τραπέζι</th>
                <th>Ημερομηνία</th>
                <th>Σερβιτόρος</th>
                <th>Σύνολο</th>
                <th>Κατάσταση</th>
                <th>Ώρα Έναρξης</th>
                <th>Ώρα Παράδοσης</th>
              </tr>";
   
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>".$row["kwdikos_paragellias"]."</td>
                    <td>".$row["kwdikos_trapeziou"]."</td>
                    <td>".$row["hmeromhnia"]."</td>
                    <td>".$row["kwdikos_servitorou"]."</td>
                    <td>".$row["synolo_paragelias"]."€</td>
                    <td>".$row["katastash_paragelias"]."</td>
                    <td>".$row["hmeromhnia_kai_ora_anaxwrhshs"]."</td>
                    <td>".$row["hmeromhnia_kai_ora_paradwshs"]."</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<b>Δεν βρέθηκαν παραγγελίες για αυτόν τον σερβιτόρο.</b>";
    }
   
    mysqli_close($conn);
    ?>