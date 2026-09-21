
<?php
session_unset(); 
session_start();
?>

<html>


<head>

<style>

body {
background-color:#D3D3D3;
 font-size: 10pt;
padding-left: 450px;
color: 	black;
width : 900px;
line-height: 25px;
 margin-top: 100px;
}

#center{
position:relative;
 margin-left: 180px;

}

input[type=text], input[type=password] {
  width: 50%;
  padding: 12px 20px;
  margin: 10px 10px;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 50%;
  position:relative;
 margin-left: 67px;

}

#img {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

#text {
  padding: 60px;
}
</style>
</head>
<body>


<form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
  <div id="img">
    <img src="a1.jpg"  class="avatar">
  </div>

<div id="center">
  <div id="text">
    <label for="username"><b>Username</b></label>
    <input type="text" id="username" placeholder="Enter Username" name="username" required>

   <br> <label for="passwprd"><b>Password</b></label>
    <input type="password" id="password" placeholder="Enter Password" name="password" required>
	
	
	
	<div>
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
if(empty($_POST['username']) && empty($_POST['password'])) {

}
else if(empty($_POST['username']) || empty($_POST['password'])){
	
}
else{
$querry1=mysqli_query($conn,"SELECT Username,kwdikos_rolou,kwdikos_xrhsth FROM users");
while($row1=$querry1->fetch_assoc()){
	if($_POST['username']==$row1['Username']){
		$use=$row1['Username'];
		$rol=$row1['kwdikos_rolou'];
		$ui=$row1['kwdikos_xrhsth'];
	}
}
$querry2=mysqli_query($conn,"SELECT Password FROM users");
while($row2=$querry2->fetch_assoc()){
	if($_POST['password']==$row2['Password']){
		$pas=$row2['Password'];
	}
}
if(!empty($use) && !empty($pas)){

	$_SESSION['kwdikos_rolou']=$ui;
	$_SESSION['username']=$use;
	$_SESSION['password']=$pass;
	$_SESSION['role']=$rol;
	if($rol==1){
		header("Location: owner.html");
		die();
	}
	else if($rol==3){
		header("Location:kouzina.php");
		die();
	}
	else if($rol==4){
		header("Location: marka.php");
		die();
	}
	else if($rol==2){
		header("Location: serbitoros.php");
		
		
		die();
		
	}
}
else{
	echo"<script > alert('Λάθος Στοιχεία');</script>";
}
}
?>
   </div>     
    <button type="submit">Login</button>
    
  </div>
  </div>

</form>

</body>
</html>