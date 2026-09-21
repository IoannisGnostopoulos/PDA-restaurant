<html>
<head>
<title>Edit</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script>

function user(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
           
            xmlhttp = new XMLHttpRequest();
        } 
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
		
		
		
        xmlhttp.open("GET","edit.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>


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

#tab {
	position:relative;
	top:50px;
	left:160px;
	}
	
#us {
	position:relative;
	top:70px;
}
	
#rol	{
	position:relative;
	top:-50px;
	left:800px;
}	

</style>

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
?>
<div id="log">
<h4>Τροποποίηση</h4>
</div>

<div id="us">
Επιλογή χρήστη
<?php
$sql="SELECT * FROM users";
	$result = mysqli_query($conn, $sql);
	?>
	
	 <select name="user"  onchange="user(this.value)" >
	<?php

	while($row1 = mysqli_fetch_array($result)) {
    echo "<option value='" . $row1["kwdikos_xrhsth"] ." '>" . $row1["onoma"] . $row1["epitheto"] . "</option>";
	
	
	

	
	
	}

	?> 
	</select>	
 </div>


<?php
if(isset($_POST['INSERT'])){
	
	$name= $_POST['name'];
	$surname= $_POST['surname'];
	$user= $_POST['username'];
	$passw= $_POST['password'];
	$kwd_xri= $_POST['rolecode'];
	$price= $_POST['register'];
	$id=$_POST['ids'];
	if(mysqli_query($conn,"UPDATE users SET onoma='$name' ,epitheto='$surname',Username='$user',Password='$passw', kwdikos_rolou='$kwd_xri',tameio='$price' WHERE kwdikos_xrhsth='$id' "))
		echo"Successfully Inserted";
	else echo "Insertion Failed";

	}

?>




<table id="rol">
<tr>
<th>Κωδικός ρόλου</th>
<th>Όνομα ρόλου</th>
</tr>
<tr>
<th>1</th>
<th>Ιδιοκτήτης</th>
</tr>
<tr>
<th>2</th>
<th>Σερβιτόρος</th>
</tr>
<tr>
<th>3</th>
<th>Κουζίνα</th>
</tr>
<tr>
<th>4</th>
<th>Μάρκα</th>
</tr>
</table>


<div id="txtHint"><b>Person info will be listed here...</b></div>
<a  href="owner.html"><font color="blue">BACK</font></a></body>

</html>