 <!DOCTYPE html>
 <html>
 <head>
     <title>Ατομική Εικόνα Παραγγελιών</title>
     <meta charset="UTF-8">
     <style>
         body { background-color:#DCDCDC; font-family: Arial; padding: 40px; }
         .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);
 }
         select { padding: 8px; margin: 10px 0; width: 300px; font-size: 16px; }
            #txtHint { margin-top: 20px; }
            .back-link { display: inline-block; margin-top: 20px; color: blue; text-decoration: none; font-weight:
 bold; }
        </style>
        <script>
        function show(str) {
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            }
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            // Sends the User ID to indi.php
            xmlhttp.open("GET", "indi.php?q=" + str, true);
            xmlhttp.send();
        }
        </script>
    </head>
    <body>
   
    <div class="container">
        <h2>Επισκόπηση ανά Σερβιτόρο</h2>
   
        <b>Επιλέξτε Σερβιτόρο:</b><br>
        <select name="serbitoros" onchange="show(this.value)">
            <option value="">-- Επιλογή Ονόματος --</option>
            <?php
            $conn = new mysqli("localhost", "root", "", "tes1");
            if ($conn->connect_error) { die("Conn failed"); }
   
            // Fetch users who are Waiters (Role 2)
            $sql = "SELECT kwdikos_xrhsth, onoma, epitheto FROM users WHERE kwdikos_rolou = 2";
            $result = mysqli_query($conn, $sql);
   
            while($row = mysqli_fetch_array($result)) {
                // value is the ID (for the query), text is the Name
                echo "<option value='" . $row["kwdikos_xrhsth"] . "'>" . $row["onoma"] . " " . $row["epitheto"] . "
 (ID: " . $row["kwdikos_xrhsth"] . ")</option>";
            }
            $conn->close();
            ?>
        </select>
   
        <div id="txtHint"><i>Τα στοιχεία θα εμφανιστούν εδώ...</i></div>
   
        <a href="owner.html" class="back-link">[ ΠΙΣΩ ]</a>
    </div>
   
    </body>
    </html>