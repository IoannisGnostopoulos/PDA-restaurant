 <!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <title>Διαμόρφωση Κατηγοριών & Μενού</title>
     <style>
         body { background-color:#DCDCDC; font-family: Arial, sans-serif; padding: 40px; }
         .container { max-width: 1000px; margin: auto; }
         .section { background: white; padding: 25px; border-radius: 10px; margin-bottom: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
         h2 { color: #2c3e50; border-bottom: 2px solid #eee; padding-bottom: 10px; }
         table { border-collapse: collapse; width: 100%; margin-top: 15px; background: #fff; }
         th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
         th { background-color: #f8f9fa; font-weight: bold; }
         .form-group { margin-bottom: 15px; background: #f9f9f9; padding: 15px; border-radius: 5px; border: 1px solid #eee; }
         input[type="text"], select { padding: 10px; border: 1px solid #ccc; border-radius: 4px; margin-right: 10px; }
         button { padding: 10px 20px; cursor: pointer; background: #27ae60; color: white; border: none; border-radius: 4px; font-weight: bold; }
         .back-link { display: inline-block; margin-top: 20px; color: #2980b9; text-decoration: none; font-weight: bold; }
     </style>
 </head>
 <body>

 <?php
 $conn = new mysqli("localhost", "root", "", "tes1");
 if ($conn->connect_error) { die("Database connection failed."); }

 // 1. Handle Category Insertion (Fixed Variable Swap)
 if (isset($_POST['eisagogi'])) {
     $onoma_kat = $_POST['katigoria'];
     $kod_kat = $_POST['kodikos_katig'];
     $sql_cat = "INSERT INTO categories_products (kwdikos_kathgorias, Onomasia_kathgorias) VALUES ('$kod_kat', '$onoma_kat')";
     if ($conn->query($sql_cat)) {
         echo "<script>alert('Η κατηγορία προστέθηκε!'); window.location.href='menuedit.php';</script>";
     }
 }

 // 2. Handle Product Insertion (Fixed: Now sending the ID, not the Name)
 if (isset($_POST['proi'])) {
     $kod_pro = $_POST['kodikos'];
     $onoma_pro = $_POST['name'];
     $kat_id = $_POST['katig']; // This will now be a NUMBER (the ID)
     $timi_pro = $_POST['price'];

     $sql_pro = "INSERT INTO timokatalogos (kwdikos_proiontos, onomasia_proiontos, kathgoria_proiontos, timh_proiontos)
                 VALUES ('$kod_pro', '$onoma_pro', '$kat_id', '$timi_pro')";

     if ($conn->query($sql_pro)) {
         echo "<script>alert('Το προϊόν προστέθηκε!'); window.location.href='menuedit.php';</script>";
     } else {
         echo "<script>alert('Σφάλμα: " . $conn->error . "');</script>";
     }
 }
 ?>

 <div class="container">

     <!-- CATEGORY SECTION -->
     <div class="section">
         <h2>1. Διαχείριση Κατηγοριών</h2>
         <div class="form-group">
             <form method="POST">
                 Όνομα: <input type="text" name="katigoria" placeholder="π.χ. Καφέδες" required>
                 Κωδικός ID: <input type="text" name="kodikos_katig" placeholder="π.χ. 1" required style="width:80px;">
                 <button type="submit" name="eisagogi">Προσθήκη Κατηγορίας</button>
             </form>
         </div>
         <table>
             <tr><th>Κωδικός (ID)</th><th>Όνομα Κατηγορίας</th></tr>
             <?php
             $res1 = $conn->query("SELECT * FROM categories_products");
             while($row = $res1->fetch_assoc()) {
                 echo "<tr><td>" . $row['kwdikos_kathgorias'] . "</td><td>" . $row['Onomasia_kathgorias'] . "</td></tr>";
             }
             ?>
         </table>
     </div>

     <!-- PRODUCT SECTION -->
     <div class="section">
         <h2>2. Διαχείριση Τιμοκαταλόγου</h2>
         <div class="form-group">
             <form method="POST">
                 Κωδικός: <input type="text" name="kodikos" placeholder="101" required style="width:60px;">
                 Όνομα: <input type="text" name="name" placeholder="π.χ. Φρέντο" required>

                 Κατηγορία:
                 <select name="katig" required>
                     <option value="">-- Επιλογή --</option>
                     <?php
                     $res_cat = $conn->query("SELECT kwdikos_kathgorias, Onomasia_kathgorias FROM categories_products");
                     while($c = $res_cat->fetch_assoc()) {
                         // IMPORTANT: value is the ID, display is the Name
                         echo "<option value='".$c['kwdikos_kathgorias']."'>".$c['Onomasia_kathgorias']."</option>";
                     }
                     ?>
                 </select>

                 Τιμή (€): <input type="text" name="price" placeholder="3.50" required style="width:70px;">
                 <button type="submit" name="proi">Προσθήκη Προϊόντος</button>
             </form>
            </div>
   
            <table>
                <tr>
                    <th>Κωδικός</th>
                    <th>Όνομα Προϊόντος</th>
                    <th>ID Κατηγορίας</th>
                    <th>Τιμή</th>
                </tr>
                <?php
                $res2 = $conn->query("SELECT * FROM timokatalogos");
                while($p = $res2->fetch_assoc()) {
                    echo "<tr>
                            <td>".$p['kwdikos_proiontos']."</td>
                            <td>".$p['onomasia_proiontos']."</td>
                            <td>".$p['kathgoria_proiontos']."</td>
                            <td>".$p['timh_proiontos']."€</td>
                          </tr>";
                }
                ?>
            </table>
        </div>
   
        <a href="owner.html" class="back-link">← Πίσω στο Μενού Ιδιοκτήτη</a>
    </div>
   
    </body>
    </html>