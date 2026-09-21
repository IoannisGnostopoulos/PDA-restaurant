<html>

<head>
<title>Delete</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

#us {
	position:relative;
	top:70px;
}

#del {
	position:relative;
	top:20px;
	left:200px;
}

</style>

<body>

<div id="log">
<h4>Διαγραφή</h4>
</div>

<form method="POST" action="">

<div id="del">
<button type="button"  name="delete_user" id="delete_user"> DELETE</button>
</div>



<?php
$servername = "localhost";
$username = "root";
$password = "";  

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

mysqli_select_db($conn,'tes1');
	
	$sql="SELECT  kwdikos_xrhsth,onoma, epitheto FROM users";
	$result = mysqli_query($conn, $sql);
	echo "<form method='POST' action=''>";
	echo "<select name='ng' > " ;
	echo "<option value='0'>".select_user."</option>";
	while($row1 = mysqli_fetch_array($result)) {
    echo "<option value='" . $row1["kwdikos_xrhsth"] ." '>" . $row1["onoma"] . $row1["epitheto"] . "</option>";
		
        }

echo "</select>";
echo "</form>";



?>

<table border='1'>
<tr>
<th>ΚΩΔΙΚΟΣ ΧΡΗΣΤΗ</th>
<th>ΟΝΟΜΑ</th>
<th>ΕΠΙΘΕΤΟ</th>
</tr>

<?php
$sql1="SELECT  kwdikos_xrhsth,onoma, epitheto FROM users";
	$result1 = mysqli_query($conn, $sql1);

while($row2=mysqli_fetch_array($result1)){

echo "<tr><td>" .$row2["kwdikos_xrhsth"]."</td><td>". $row2["onoma"]. "</td><td>" .$row2["epitheto"]."</td></tr>";


}
?>

</table>
</form>
<a  href="owner.html"><font color="blue">BACK</font></a></body>

</html>

<script>

$(document).ready(function(){

$('#delete_user').click(function(){	
	if(confirm("Are you sure you want to delete the user?"))
	{
		var id=[];
	}
	else
	{
		return false;
	}
	
	
	
});



</script>