<html>

<head><title>Επισκόπιση ατομικής εικόνας παραγγελιών</title>

</head>

<body>

<?php 

$servername = "localhost";
$username = "root";
$password = "";  

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

mysqli_select_db($conn,'tes1');

 
$q = intval($_GET['q']);

$sql2="SELECT *FROM header WHERE kwdikos_servitorou = ".$q." ";

 $result3 = mysqli_query($conn,$sql2);

echo"<table border=1>";
echo "<tr>";
echo"<td>Ημερομηνία</td>
<td>Κωδικός σερβιτόρου</td>
<td>Ημ. και ώρα καταχώρησης</td>
<td>Ημ. και ώρα ολοκλήρωσης</td>
<td>Κωδικός παραγγελίας</td>
<td>Κωδικος τραπεζιού</td>
<td>Κατάσταση παραγκελίας</td>
<td>Συνολο παραγγελίας</td>";
echo"</tr>";
	while($row=mysqli_fetch_assoc($result3)){
	
	echo" <tr><td>".$row["kwdikos_paragellias"]."</td><td>".
	$row["kwdikos_trapeziou"]."</td><td>".$row["hmeromhnia"]."</td><td>".
	$row["kwdikos_servitorou"]."</td><td>".$row["synolo_paragelias"]."</td><td>".
	$row["katastash_paragelias"]."</td><td>".$row["hmeromhnia_kai_ora_anaxwrhshs"]."</td><td>".
	$row["hmeromhnia_kai_ora_paradwshs"]."</td></tr>";
	
	}
	echo"</table>";
	mysqli_close($conn);


?>



</body>
</html>