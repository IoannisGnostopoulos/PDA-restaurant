<html>
<head> 
<title>Επισκόπηση Ποσών</title>
<style>

body	
	{
padding-left: 50px;
	color: black;
	font-size:12pt;
	width:100%;
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
	
	
#filtra{

	color: black;
	position: relative  ;
	background: light_grey  ;
	height: 260px;
	width: 120px; 
	margin:10px -58px;
	margin-top:150px;
	padding: 12px 18px;


}
#tableorder{

position: absolute;
top:200px;
left: 250px;
text-decoration: none;
list-style-type: none;
}
	
	</style>
	</head>
	
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
	<h1>Επισκόπηση Ποσών </h1>
	</div>
<form  method="POST"  >	
	<div id="filtra" >
	<p>Επελεξε φιλτρο αναζητησης</p>
<select name="katastash_paragelias">
<option value="0">READY</option>
<option value="1">PREPARATION</option>
<option value="2">SERVING</option>
<option value="3">DELIVERED</option>
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
<td > <b>Σύνολο παραγκελίας  </b></td>
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

$sql= "SELECT kwdikos_paragellias,synolo_paragelias,katastash_paragelias FROM  header ";
$result= mysqli_query($conn,$sql);
if(mysqli_num_rows($result) >  0 )
	{
	while($row=mysqli_fetch_assoc($result)){
	$i=$i+1;
	echo" <tr><td>".$i."</td><td>".$row["kwdikos_paragellias"]."</td><td>".$row["synolo_paragelias"]."</td><td>".$row["katastash_paragelias"]."</td></tr>";
	
	}
	}


}
else  if(isset($_POST['submit'])){


	if($_POST['katastash_paragelias']=="0"){
	$sql2="SELECT kwdikos_paragellias,synolo_paragelias,katastash_paragelias FROM  header WHERE header.katastash_paragelias='READY' ";
	$result= mysqli_query($conn,$sql2);
	if(mysqli_num_rows($result) >  0 )
	{
	while($row=mysqli_fetch_assoc($result)){
	$i=$i+1;
	echo" <tr><td>".$i."</td><td>".$row["kwdikos_paragellias"]."</td><td>".$row["synolo_paragelias"]."</td><td>".$row["katastash_paragelias"]."</td></tr>";
	
	}
	}
	
	}
	
if($_POST['katastash_paragelias']=="1"){

$sql2="SELECT kwdikos_paragellias,synolo_paragelias,katastash_paragelias FROM  header WHERE header.katastash_paragelias='PREPARATION' ";
	$result= mysqli_query($conn,$sql2);
	if(mysqli_num_rows($result) >  0 )
	{
	while($row=mysqli_fetch_assoc($result)){
	$i=$i+1;
	echo" <tr><td>".$i."</td><td>".$row["kwdikos_paragellias"]."</td><td>".$row["synolo_paragelias"]."</td><td>".$row["katastash_paragelias"]."</td></tr>";
	
	}
	}
}
	
if($_POST['katastash_paragelias']=="2"){

$sql2="SELECT kwdikos_paragellias,synolo_paragelias,katastash_paragelias FROM  header WHERE header.katastash_paragelias='SERVING' ";
	$result= mysqli_query($conn,$sql2);
	if(mysqli_num_rows($result) >  0 )
	{
	while($row=mysqli_fetch_assoc($result)){
	$i=$i+1;
	echo" <tr><td>".$i."</td><td>".$row["kwdikos_paragellias"]."</td><td>".$row["synolo_paragelias"]."</td><td>".$row["katastash_paragelias"]."</td></tr>";
	
	}
	}
}
	if($_POST['katastash_paragelias']=="3"){

$sql2="SELECT kwdikos_paragellias,synolo_paragelias,katastash_paragelias FROM  header WHERE header.katastash_paragelias='DELIVERED' ";
	$result= mysqli_query($conn,$sql2);
	if(mysqli_num_rows($result) >  0 )
	{
	while($row=mysqli_fetch_assoc($result)){
	$i=$i+1;
	echo" <tr><td>".$i."</td><td>".$row["kwdikos_paragellias"]."</td><td>".$row["synolo_paragelias"]."</td><td>".$row["katastash_paragelias"]."</td></tr>";
	
	}
	}
}

	
	}
	
	?>
		
</table>

</div>

	
	
	</body>
	
<a  href="serbitoros.php"><font color="blue">BACK</font></a></div>
	</html>