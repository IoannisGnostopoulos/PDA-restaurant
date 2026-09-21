
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ΜΑΡΚΑ</title>

</head>

<style>
body {
	background-color:#DCDCDC;
	font-size: 12pt;
	padding-left: 50px;
	color: 	#000000;
	width : 1180px;
	line-height: 25px;
}

#logo {
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

p { font:bold 12pt arial;}


#filtra{

	color: black;
	position: relative  ;
	background: #FFF8DC  ;
	height: 260px;
	width: 120px; 
	margin:10px -58px;
	margin-top:150px;
	padding: 12px 18px;


}

#options {
	position:absolute;
	top:50px;
	left: 1695px;
	font-size:30px;
	list-style-type: none;	
}
#options a:hover, .dropdown:hover .dropbtn {
  background-color: #000080;
}


#tableorder{

position: absolute;
top:200px;
left: 250px;
text-decoration: none;
list-style-type: none;
}

#tab {
	position: absolute;
	top:200px;
	left:870px;
	heigh:20px;
	line-height:50px;
	font-size:20px;
}

#table2{
	position: relative;
	top:300px;
	left:48px;
	padding: 0px 180px;

	
	
}



</style>

<body>

<script>
var i=0;

function addRow() {
i++;
var table = document.getElementById("table_order");
var newRow=table.insertRow(table.lenght);
var a1=newRow.insertCell(0);
var a2=newRow.insertCell(1);
var kodikos=document.getElementById("kod").value;
var katastasi=document.getElementById("kat").value;

 a1.innerHTML = kodikos;
 a2.innerHTML = katastasi;

}


function filtro() {
  var a=document.getElementById("filtra");
  if (this.a==0){
 
  }
  
}

</script>

	<div id="logo">
	<h1>ΜΑΡΚΑ</h1>
	</div>

<div id="options">
  
  <a  href="login1.php"><font color="white">LOGOUT</font></a>
</div>

<form id="m1" method="POST"  >

	
	<div id="filtra" >
	<p>Επελεξε φιλτρο αναζητησης</p>
<select name="status">
<option value="1">Ready</option>
<option value="0">Preparation</option>
<option value="2">Serving</option>
<option value="3">Delivered</option>
</select>
</option>
	
	<p><input type="submit"  value="submit" name="submit"/></p>
	</div>
	</form>	
	
<div id="tableorder" >
<b>Επισκόπηση όλων των παραγγελιών </b><br>

<table border="1" id=table_order>
<tr>
<td > <b>A/A </b></td>
<td > <b>Κωδικός παραγκελίας  </b></td>
<td > <b>Κατάσταση</b></td>
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
 




if (!isset($_POST['submit']))
{

$sql= "SELECT kwdikos_paragellias,katastash_paragelias FROM  header ";
$result= mysqli_query($conn,$sql);
if(mysqli_num_rows($result) >  0 )
	{
	while($row=mysqli_fetch_assoc($result)){
	$i=$i+1;
	echo" <tr><td>".$i."</td><td>".$row["kwdikos_paragellias"]."</td><td>".$row["katastash_paragelias"]."</td></tr>";
	
	}
	}


}
else  if(isset($_POST['submit'])){


	if($_POST['status']=="0"){
	$sql2="SELECT kwdikos_paragellias,katastash_paragelias FROM  header WHERE header.katastash_paragelias='PREPARATION' ";
	$result= mysqli_query($conn,$sql2);
	if(mysqli_num_rows($result) >  0 )
	{
	while($row=mysqli_fetch_assoc($result)){
	$i=$i+1;
	echo" <tr><td>".$i."</td><td>".$row["kwdikos_paragellias"]."</td><td>".$row["katastash_paragelias"]."</td></tr>";
	
	}
	}
	
	}
	
if($_POST['status']=="1"){

$sql2="SELECT kwdikos_paragellias,katastash_paragelias FROM  header WHERE header.katastash_paragelias='READY' ";
	$result= mysqli_query($conn,$sql2);
	if(mysqli_num_rows($result) >  0 )
	{
	while($row=mysqli_fetch_assoc($result)){
	$i=$i+1;
	echo" <tr><td>".$i."</td><td>".$row["kwdikos_paragellias"]."</td><td>".$row["katastash_paragelias"]."</td></tr>";
	
	}
	}
}
	
	if($_POST['status']=="2"){
	$sql2="SELECT kwdikos_paragellias,katastash_paragelias FROM header WHERE header.katastash_paragelias='SERVING' ";
	$result= mysqli_query($conn,$sql2);
	if(mysqli_num_rows($result) >  0 )
	{
	while($row=mysqli_fetch_assoc($result)){
	$i=$i+1;
	echo" <tr><td>".$i."</td><td>".$row["kwdikos_paragellias"]."</td><td>".$row["katastash_paragelias"]."</td></tr>";
	
	}
	}
	
	}
	if($_POST['status']=="3"){
	$sql2="SELECT kwdikos_paragellias,katastash_paragelias FROM  header WHERE header.katastash_paragelias='DELIVERD' ";
	$result= mysqli_query($conn,$sql2);
	if(mysqli_num_rows($result) >  0 )
	{
	while($row=mysqli_fetch_assoc($result)){
	$i=$i+1;
	echo" <tr><td>".$i."</td><td>".$row["kwdikos_paragellias"]."</td><td>".$row["katastash_paragelias"]."</td></tr>";
	
	}
	}
	
	}
	
	}
	
	?>
		
</table>

</div>


<div id="tab">

 <form action="" method = "POST">
<b>Αρχικοποίηση ταμείου επιχείρησης : </b> <input  type="text" name="timi"><br>
<p><button type ="submit" name="tameio" value="send to database"> SEND TO DATABASE </button>
</p>
<b>Αρχικοποίηση ταμείου κάθε σερβιτόρου: </b><input type="text" name="serb"><br>
<p><input type="submit"  name ="serbitoros" value="submit" action="buttom"/></p>

</form>

<?php


if (isset($_POST['tameio']))
{
  $poso=$_POST['timi'];
$sql3="UPDATE users SET tameio='$poso' WHERE kwdikos_rolou= 4 ";
	mysqli_query($conn,$sql3);
 	mysqli_close($conn);
 }
?>

<?php

$servername = "localhost";
$username = "root";
$password = "";  

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

mysqli_select_db($conn,'tes1');
 
if (isset($_POST['serbitoros']))
{
  $poso=$_POST['serb'];
$sql4="UPDATE users SET tameio='$poso' WHERE 	kwdikos_rolou= 2 ";
	mysqli_query($conn,$sql4);
 	mysqli_close($conn);
 }
?>


<b>Εμφάνηση ταμείου σερβιτόρου : </b> 


<p><button type ="submit" name="printtamio" value="send to database"> print</button>


<?php 
$servername = "localhost";
$username = "root";
$password = "";  

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

mysqli_select_db($conn,'tes1');


 $sql6="SELECT onoma FROM users WHERE kwdikos_rolou='2' ";
 $result = mysqli_query($conn, $sql6);
 echo "<select name='timi' > " ;
  while($row1 = mysqli_fetch_array($result)) {
            //Take in all the classes from the database
            echo "<option value='" . $row1["onoma"] ." '>" . $row1["onoma"] . "</option>";
        
		$sql5="SELECT tameio FROM users WHERE onoma='$row1' ";
		$result1 = mysqli_query($conn, $sql5);
	if (isset($_POST['printtamio'])){
	if(mysqli_num_rows($result1) >  0 )
	{
	while($row=mysqli_fetch_assoc($result1)){
	
	echo" <tr><td>".$row["tameio"]."</td></tr>";
	
	}
	}
	}
		
		
		}
        
    
echo "</select>";

	

	
	
?>
</div>
  
  <br>
  <br>

 <div id= "table2"> 
<table border=1>
<tr>
<td><b>Επισκόπηση ποσό στο ταμείο :</b></td>
<td><b>Επισκόπηση ποσό στις ανοικτές παραγγελίες -SERVING</td>
<td><b>Επισκόπηση ποσό στις ανοικτές παραγγελίες -PREPARATION:</b></td> 
<td><b>Επισκόπηση ποσό στις ανοικτές παραγγελίες -READY: </b></td>
<td><b>Επισκόπηση συνολικό ποσό στις κλειστές παραγγελίες -DELIEVERD :</b></td>
</tr>

<tr>
<td>
<?php
$sql5="SELECT onoma ,tameio FROM users WHERE kwdikos_rolou='1' ";
 $result = mysqli_query($conn, $sql5);

if(mysqli_num_rows($result) >  0 )
	{
	while($row=mysqli_fetch_assoc($result)){
	
	echo$row["onoma"].$row["tameio"]."<br>";
	
	}
	}

?>
</td>

<td>
<?php
$sql7="SELECT synolo_paragelias FROM header WHERE katastash_paragelias='SERVING'  ";
 $result3 = mysqli_query($conn, $sql7);

if(mysqli_num_rows($result) >  0 )
	{
	while($row=mysqli_fetch_assoc($result3)){
	
	echo $row["synolo_paragelias"];
	
	}
	}

?>
</td>
<td>
<?php
$sql7="SELECT synolo_paragelias FROM header WHERE katastash_paragelias='PREPARATION'  ";
 $result3 = mysqli_query($conn, $sql7);

if(mysqli_num_rows($result) >  0 )
	{
	while($row=mysqli_fetch_assoc($result3)){
	
	echo $row["synolo_paragelias"];
	
	}
	}

?>
</td>
<td>
<?php
$sql7="SELECT synolo_paragelias FROM header WHERE katastash_paragelias='READY'  ";
 $result3 = mysqli_query($conn, $sql7);

if(mysqli_num_rows($result) >  0 )
	{
	while($row=mysqli_fetch_assoc($result3)){
	
	echo $row["synolo_paragelias"];
	
	}
	}

?>
</td>

<td>
<?php
$sql8="SELECT synolo_paragelias FROM header WHERE katastash_paragelias='DELIVERD'  ";
 $result3 = mysqli_query($conn, $sql8);

if(mysqli_num_rows($result) >  0 )
	{
	while($row=mysqli_fetch_assoc($result3)){
	
	echo $row["synolo_paragelias"];
	
	}
	}

?>
</td>
</tr>
</table> 
</div>


</body>

</html>

