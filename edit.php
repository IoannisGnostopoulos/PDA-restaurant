<html>
<head>
<title>Edit</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



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

$sql2="SELECT * FROM users WHERE kwdikos_xrhsth = ".$q." ";

$result3 = mysqli_query($conn,$sql2);
?>

<?php

if(mysqli_num_rows($result3) >  0){
	
while($row=mysqli_fetch_assoc($result3))
{
?>


<form method="POST">

<table id="tab">

<tr><th>Όνομα:<input type="text" name="name" value="<?php echo $row["onoma"]; ?>" </th>
<th>Επίθετο:<input type="text" name="surname" value="<?php echo $row["epitheto"]; ?>""text-align:left"></th></tr>
<tr><th>Username:<input type="text" name="username"value="<?php echo $row["Username"]; ?>" "text-align:left"></th>
<th>Password:<input type="password" name="password" value="<?php echo $row["Password"]; ?>""text-align:left"></th></tr>
<tr><th>Κωδικός Ρόλου<input type="text" name="rolecode"value="<?php echo $row["kwdikos_rolou"]; ?>" "text-align:left"></th>
<th>Ταμείο<input type="text" name="register"value="<?php echo $row["tameio"]; ?>" "text-align:left"></th></tr>
<th>KWDIKOS XRISTH<input type="text" name="ids" value="<?php echo $q; ?>" "text-align:left"></th></tr>
<tr><th></th>
</tr>

</table>

<input type="submit"  value="INSERT" id="INSERT "name="INSERT" >

</form>

<?php
}}
?>


</body>

</html>