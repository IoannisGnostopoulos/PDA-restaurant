<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>
</title>
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

#log {
	position:relative;
	color:black;
	top:30px;
	heigh:20px;
	line-height:10px;
	letter-spacing:3px;
	font-size:30px;
	font-family:"Arial";
}

#cat	{
	position:relative;
	top:50px;
}

#cate	{
	position:relative;
	top:100px;
}

#menu	{
	position:relative;
	top:74px;
	left:500px;
}

#incat	{
	position:relative;
	top:30px;
	left:200px;
}

#inmenu	{
	position:relative;
	top:40px;
	left:400px;
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

</style>

<body>

<div id="log">
<h4>Διαμόρφωση κατηγοριών και τιμοκαταλόγου</h4>
</div>

<form method="GET" action="in">

</form>
<div id="cat">
<?php 


$servername = "localhost";
$username = "root";
$password = "";  

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

mysqli_select_db($conn,'tes1');


 $sql5="SELECT Onomasia_kathgorias FROM categories_products  ";
 $result3 = mysqli_query($conn, $sql5);
 echo "<select > " ;
  while($row2 = mysqli_fetch_array($result3)) {
            
            echo "<option value='" . $row2["Onomasia_kathgorias"] ." '>" . $row2["Onomasia_kathgorias"] . "</option>";
        }
        
    
echo "</select>";
	
?>

</div> 

<form method ="POST">

<div id="incat">
<button type="submit"  name ="proi"  />Εισαγωγή προϊόντος </button> 
Κωδικός προϊόντος :<input  type="text" name="kodikos">
Ονομασία προϊόντος : <input  type="text" name="name">
Κατηγορία προϊόντος : <input  type="text" name="katig"><br>
Τιμή προϊόντος : <input  type="text" name="price">
</div>

<div id="inmenu">
<button type="submit"  name ="eisagogi"  />Εισαγωγή κατηγορίας </button> 
Kατηγορία :<input  type="text" name="katigoria">
Κωδικός κατηγορίας : <input  type="text" name="kodikos_katig"><br>
</div>

</form>


<table id="cate" border="1">
<tr>
<th>Κωδικός κατηγορίας</th>
<th>Ονομασία κατηγορίας</th>

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
 
$sql1= "SELECT kwdikos_kathgorias,Onomasia_kathgorias FROM  categories_products ";
$result= mysqli_query($conn,$sql1);
if(mysqli_num_rows($result) >  0 )
	{
	while($row=mysqli_fetch_assoc($result)){
	$i=$i+1;
	echo" <tr><td>".$row["kwdikos_kathgorias"]."</td><td>".$row["Onomasia_kathgorias"]."</td></tr>";
	
	}
	}


	if(isset($_POST['eisagogi']))
	{

	$kati=$_POST['katigoria'];
	$kodi=$_POST['kodikos_katig'];
	
	$sql5="INSERT INTO categories_products (kwdikos_kathgorias,Onomasia_kathgorias) VALUES ('$kati','$kodi')";
	$result= mysqli_query($conn,$sql5);
	
	echo ("<script>window.location.href='menuedit.php'</script>");
	
	}
	
	if(isset($_POST['proi']))
	{

	$kodikos=$_POST['kodikos'];
	$onoma=$_POST['name'];
	$katigoria=$_POST['katig'];
	$timi=$_POST['price'];
	
	$sql5="INSERT INTO timokatalogos (kwdikos_proiontos,onomasia_proiontos,kathgoria_proiontos,timh_proiontos) VALUES ('$kodikos','$onoma','$katigoria','$timi')";
	$result= mysqli_query($conn,$sql5);
	
	echo ("<script>window.location.href='menuedit.php'</script>");
	
	}

	?>
	
	
</table>




<table id="menu" border="1">
<tr>
<th>Κωδικός προϊόντος</th>
<th>Ονομασία προϊόντος</th>
<th>Κατηγορία προϊόντος</th>
<th>Τιμή προϊόντος</th>

</tr>
<?php

mysqli_select_db($conn,'tes1');
 
$sql3= "SELECT kwdikos_proiontos,onomasia_proiontos,kathgoria_proiontos,timh_proiontos FROM  timokatalogos ";
$result2= mysqli_query($conn,$sql3);
if(mysqli_num_rows($result2) >  0 )
	{
	while($row=mysqli_fetch_assoc($result2)){
	$i=$i+1;
	echo" <tr><td>".$row["kwdikos_proiontos"]."</td><td>".$row["onomasia_proiontos"]."</td><td>".$row["kathgoria_proiontos"]."</td><td>".$row["timh_proiontos"]."</td></tr>";
	
	}
	}

	?>
</table>

<a  href="owner.html"><font color="blue">BACK</font></a>
</body>

</html>