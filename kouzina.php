<html>

<head>
<title>Kouzina</title>
<style>
body{
	padding-left: 50px;
	color: black;
	font-size:12pt;
	width:1180px;
	background-color: #DCDCDC;
	line-height:25px;
	font-family: Arial;
}

#logo{
	color: black;
	position: relative ;
	top: 30px;
	left: 700px;
	heigh: 20px;
	line-height : 10px;
	letter-spacing: 3px;
	 font-size: 30px;
	font-family: "Arial"
}
#nav {
	position:absolute;
	top:50px;
	left: 1695px;
	font-size:30px;
	list-style-type: none;	
}
#nav a:hover, .dropdown:hover .dropbtn {
  background-color:#000080;
}

#tab {
	position: absolute;
	top:200px;
	left:750px;
	heigh:20px;
	line-height:50px;
	font-size:20px;
}



</style>
</head>

<body>

<div id="logo">
<h3>ΚΟΥΖΙΝΑ</h3>
</div>



<form method="POST" action="askisi.php">
<div id ="nav">
  
  <a  href="login1.php"><font color="white">LOGOUT</font></a>
</div>




</form>

<br>
<table border=1>
<tr>
<tr>
<td>A/A</td>
<td>Κωδικός Παραγγελίας</td>
<td>Κωδικός τραπεζιού</td>
<td>ημερομηνία</td>
<td>κωδικός χρήστη</td>
<td>σύνολο παραγγελίας</td>
<td>κατάσταση παραγγελίας</td>
<td>ημερομηνία και ώρα αναχώρησης</td>
<td>ημερομηνία και ώρα παράδοσης</td>
<td>CHECK</td>
</tr>

<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";  
	$conn = new mysqli($servername, $username, $password);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	mysqli_select_db($conn,'tes1');
	$i=0;
	$sql= "SELECT kwdikos_paragellias,kwdikos_trapeziou, hmeromhnia , kwdikos_servitorou , synolo_paragelias, katastash_paragelias,hmeromhnia_kai_ora_anaxwrhshs,hmeromhnia_kai_ora_paradwshs FROM  header  WHERE  katastash_paragelias='PREPARATION' ";
	$result= mysqli_query($conn,$sql);
	
	if(mysqli_num_rows($result) >  0 )
	{
		while($row=mysqli_fetch_assoc($result)){
		$i=$i+1;
		$id=$i;
	?>
	<form  method="POST">
	<?php
		echo "<tr><td>".$i."</td><td>".$row["kwdikos_paragellias"]."</td><td>".
		$row["kwdikos_trapeziou"]."</td><td>".$row["hmeromhnia"]."</td><td>".
		$row["kwdikos_servitorou"]."</td><td>".$row["synolo_paragelias"]."</td><td>".
		$row["katastash_paragelias"]."</td><td>".$row["hmeromhnia_kai_ora_anaxwrhshs"].
		"</td><td>".$row["hmeromhnia_kai_ora_paradwshs"]."</td><td>".'
		<input type="checkbox" name="timi1[]" value='.$row["kwdikos_paragellias"].
		' /> '."</td></tr>";
		}
	}
?>
</tr>
<tr><td><p><input type="submit" name="submit1" value="READY"/></p></td></tr>
</form>

</table>
<b>Επιλογή</b>
<?php
	if (isset($_POST["submit1"])){
	if(!empty($_POST["timi1"])){
		foreach($_POST["timi1"]as $value){
			echo $value;
			$sql2= "UPDATE header SET katastash_paragelias='READY' WHERE kwdikos_paragellias=$value  ";
			$result= mysqli_query($conn,$sql2);
			header("Refresh:0; url=kouzina.php");
		}	
	}
	else{
		echo'you must select first';
		
	}
	}
?>


</body>
</html>
