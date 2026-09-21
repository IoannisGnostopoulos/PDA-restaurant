<html>
<head> 
<title>Αλλαγή καταστάσης</title>
<style>
body	
	{
	color: black;
	font-size:12pt;
	background-color: #DCDCDC;
	line-height:auto;
	font-family: Arial;
	}

#logo{
	color: black;
	position: relative ;
	top: 30px;
	left: auto;
	heigh: 20px;
	line-height : 10px;
	letter-spacing: 3px;
	 font-size: 30px;
	font-family: "Arial"
	}
</style>

</head>

<body>

<div id="logo">
	<h1>Αλλαγή Καταστάσεων </h1>
</div><br>
	<b>ΑΠΟ READY to SERVING</b>
<table border=1 id="table">
<tr>
<td>A/A</td>
<td>Κωδικός<br> Παραγγελίας</td>
<td>Κατάσταση</td>
<td>CHECK</td>


<?php 

	$servername = "localhost";
	$username = "root";
	$password = "";  
	$i=0;
	$conn = new mysqli($servername, $username, $password);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	mysqli_select_db($conn,'tes1');
	$sql= "SELECT kwdikos_paragellias,katastash_paragelias FROM  header WHERE katastash_paragelias='READY' ";
	$result= mysqli_query($conn,$sql);
	if(mysqli_num_rows($result) >  0 )
	{
	while($row=mysqli_fetch_assoc($result)){
		$i=$i+1;
		$id=$i;	
?>
<form  method="POST">
<?php
	echo "<tr><td>".$i."</td><td>".$row["kwdikos_paragellias"]."
	</td><td>".$row["katastash_paragelias"]."</td><td>".'
	<input type="checkbox" name="timi[]" value='.$row["kwdikos_paragellias"].' /> '."</td></tr>";
	}
	}
?>
<p><input type="submit" name="submit" value="submit"/></p>
</form>
</table>

<b>Επιλογή</b>
<?php
	if (isset($_POST["submit"])){
		if(!empty($_POST["timi"])){
			$dt=date("Y/m/d h:i:sa");
			foreach($_POST["timi"]as $value){
			echo $value;
			$sql2= "UPDATE header SET katastash_paragelias='SERVING',hmeromhnia_kai_ora_paradwshs='$dt' WHERE kwdikos_paragellias=$value  ";
			$result= mysqli_query($conn,$sql2);
			header("Refresh:0; url=close_situation.php");
		}	
	}
	else{
		echo'you must select first';
		}
	}
?>

<p><b>ΑΠΟ SERVING to DELIVERD</b></p>
<table border=1 id="table">
<tr>
<td>A/A</td>
<td>Κωδικός<br> Παραγγελίας</td>
<td>Κατάσταση</td>
<td>CHECK</td>
<?php 

	$servername = "localhost";
	$username = "root";
	$password = "";  
	$i=0;
	$conn = new mysqli($servername, $username, $password);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	mysqli_select_db($conn,'tes1');
	$sql= "SELECT kwdikos_paragellias,katastash_paragelias FROM  header WHERE katastash_paragelias='SERVING' ";
	$result= mysqli_query($conn,$sql);
	
	if(mysqli_num_rows($result) >  0 )
	{
		while($row=mysqli_fetch_assoc($result)){
		$i=$i+1;
		$id=$i;
	?>
<form  method="POST">
<?php
	echo "<tr><td>".$i."</td><td>".$row["kwdikos_paragellias"]."
	</td><td>".$row["katastash_paragelias"]."</td><td>".'
	<input type="checkbox" name="timi1[]" value='.$row["kwdikos_paragellias"].' /> '."</td></tr>";
	}
	}
?>
<p><input type="submit" name="submit1" value="submit1"/></p>
</form>
</table>
<b>Επιλογή</b>
<?php
	if (isset($_POST["submit1"])){
		if(!empty($_POST["timi1"])){
			foreach($_POST["timi1"]as $value){	
				echo $value;
				$sql2= "UPDATE header SET katastash_paragelias='DELIVERD' WHERE kwdikos_paragellias=$value  ";
				$result= mysqli_query($conn,$sql2);
				header("Refresh:0; url=close_situation.php");
		}	
	}
	else{
		echo'you must select first';
		
		}
	}
?>
<br>
<a  href="serbitoros.php"><font color="blue">BACK</font></a></div>

</body>
</html>


