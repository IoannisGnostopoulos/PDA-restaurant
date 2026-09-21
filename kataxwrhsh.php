<html>

<head>
<title>Μενού</title>

<style>


body	
	{
padding-left: 50px;
font-family: Arial;
color: black;
font-size:12pt;
width:1180px;
background-color: #DCDCDC;
line-height:25px;
	}
	
#table_duo{
position:relative;
	color:black;
	top:-400px;
	left:700px;
	heigh:20px;
	line-height:10px;
	letter-spacing:3px;
	font-size:30px;
	font-family:"Arial";


}


#options {
	position:relative ;
	top:50px;
	left: 1500px;
	font-size:30px;
	list-style-type: none;	
}

#options a:hover, .dropdown:hover .dropbtn {
  background-color:#000080;
}



#navbar a:hover, .dropdown:hover .dropbtn {
  background-color:#6495ED;
}

#menou{
	position:relative;
	color:black;
	top:30px;
	left:700px;
	heigh:20px;
	line-height:10px;
	letter-spacing:3px;
	font-size:30px;
	font-family:"Arial";
}

#back{
position:absolute;
top:900;


}
</style>
	
</head>	
<body>

<br>
<div id="menou">
<h1>MENU</h1><br><br>
</div>

<form method="POST" >

 </form>
 
<table border=1>
<tr>
<td > <b>Κωδικός<br> Προϊόντος </b></td>
<td > <b>Ονομασία Προϊόντος</b></td>
<td > <b>Τιμή Προϊόντος</b></td>
<td > <b>Κατηγορία <br> Προϊόντος</b></td>
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
	$sql = "SELECT kwdikos_proiontos,onomasia_proiontos, kathgoria_proiontos,timh_proiontos FROM timokatalogos";
	$result = $conn->query($sql);

	if(mysqli_num_rows($result) >  0 )
	{
		while($row=mysqli_fetch_assoc($result)){
		echo"<tr><td>".$row["kwdikos_proiontos"]."</td><td>".$row["onomasia_proiontos"]."</td><td>".$row["timh_proiontos"]."</td><td>".$row["kathgoria_proiontos"]."</td></tr>";
		} 
	}



session_start();

if(isset($_SESSION['kwdikos_rolou'])) {
echo "Your are  " . $_SESSION['kwdikos_rolou'];
$id_serb=$_SESSION['kwdikos_rolou'];
}

?>

</table>

<form method="POST" >
<div class="tab" >
<table>
<td>
	Κωδικός Προϊόντος: <input type="text" name="pass" id="pass" /input>
	Ποσότητα:<input type="number" name="quantity" id="quantity" min="0" max="20">
	Σχόλια: <input type="textbox" name="sxol" id="sxol" /input>
	<input type="submit" value=" KATAXORISI" name="KATAXORISI"  >
	<input type="submit" value=" oloklirosi" name="oloklirosi"  >
	<br>Τραπέζι: <input type="textbox" name="tabl" id="tabl" /input>
</td>
</table>
</div>
</form>
<form method="POST">

<div id="button">

</div>

</form>

 <?php
	$i=0;
	$kod = "SELECT MAX(kwdikos_paragellias) As max_k FROM details ";
	$row1=mysqli_query($conn,$kod);
	$result1=mysqli_fetch_array($row1);
	$result2=$result1["max_k"] ;
?>
 
 

 
 
<div id="table_duo">
 
<table  id="table1" border='1' >
<tr>
	<td>Κωδικός<br> Παραγκελίας</td>
	<td><b>Κωδικός<br> Προϊόντος</b></td>
	<td><b>Ποσότητα Προϊόντος</b></td>
	<td><b>Τιμή</b></td>
	<td><b>Σχόλια</b></td>
	<td> <b>Delete</b></td>
</tr>

<br>

<?php
	
	//SUBMIT KATAXORISI
	
	$teliki=0;
	if(isset($_POST["KATAXORISI"])){ 	
	$price=0;
		$pass = $_POST['pass'];
		$quantity = $_POST['quantity'];
		$sxolia = $_POST['sxol'];
		
		


	$sq="SELECT timh_proiontos ,kwdikos_proiontos FROM timokatalogos WHERE kwdikos_proiontos=$pass ";
	
	$result5=mysqli_query($conn,$sq);

	while($row5=mysqli_fetch_assoc($result5)){
			$timi=$row5["timh_proiontos"]*$quantity;
			$teliki=$timi+$teliki;
			$price=$teliki;
	}
	$sql1="INSERT INTO details (kwdikos_paragellias,kwdikos_proiontos,temaxia,timh_proiontos,sxolia) VALUES ('$result2','$pass','$quantity','$timi','$sxolia')"; 
	mysqli_query($conn,$sql1);
	header("Refresh:0; url=kataxwrhsh.php");
	}

?>

<?php

if(isset($_POST["oloklirosi"])){
		$trapezi = $_POST['tabl'];
	     $day=date("Y/m/d");
		$dt=date("Y/m/d h:i:sa");
		$result2=$result1["max_k"] +1;
		$sql2="INSERT INTO details (kwdikos_paragellias) VALUES ('$result2')";
		$sql4="INSERT INTO header(kwdikos_paragellias,kwdikos_trapeziou,hmeromhnia,kwdikos_servitorou,synolo_paragelias,katastash_paragelias,hmeromhnia_kai_ora_anaxwrhshs)
				VALUES('$result2','$trapezi','$day','$id_serb','$price','PREPARATION','$dt')";
		mysqli_query($conn,$sql2);
		mysqli_query($conn,$sql4);
	
		
	}
?>

<?php
	$sql4="SELECT * FROM details WHERE kwdikos_paragellias=$result2";
	$result4=$conn-> query($sql4);
	if ($result4-> num_rows > 0){
	while($row4 = $result4-> fetch_assoc()){
		echo"<tr><td>".$result2."</td><td>".$row4["kwdikos_proiontos"]."</td><td>".$row4["temaxia"]."</td><td>".$row4["timh_proiontos"]."</td><td>".$row4["sxolia"]."</td>";
		$teliki=$row4["timh_proiontos"]+$teliki;

?>
<td> 
<form method="POST">
<input type="submit" value="delete" name="delete">
</form>
<?php
	if(isset($_POST["delete"])){
		echo"<td><a href=kataxwrhsh.php?id=".$result2."> Delete</a></td>";
		$sql5="DELETE FROM details WHERE kwdikos_paragellias='$_GET[$result2]'";	
	}
?>
</td></tr>
	
<?php
	}
	}
?>

</table>

</div>
<table border=1>

<tr><td>TOTAL</td></tr>
<tr><td><?php echo "<br> to synolo einai ".$teliki; ?></td></tr>



<div id="back">
<a  href="serbitoros.php"><font color="blue">BACK</font></a></div>
 
</body>
</html>