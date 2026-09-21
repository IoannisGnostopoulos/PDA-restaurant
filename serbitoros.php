<html>

<head>
<title>ΣΕΡΒΙΤΟΡΟΣ</title>

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
	
	
.button {
  background-color: red; 
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 12px 2px;
  cursor: pointer;
}

.button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #4CAF50;
}

.button1:hover {
  background-color: blue;
  color: white;
}

.button2 {
  background-color: white; 
  color: black; 
  border: 2px solid #008CBA;
}

.button2:hover {
  background-color: red;
  color: white;
}

.button3 {
  background-color: white; 
  color: black; 
  border: 2px solid #008CBA;
}

.button3:hover {
  background-color: black;
  color: white;
}

.button4 {
  background-color: white; 
  color: black; 
  border: 2px solid #008CBA;
}

.button4:hover {
  background-color: purple;
  color: white;
}
#move {
position:absolute;
top: 200px;

}

</style>
</head>

<body>


<div id="logo">
	<h1>ΣΕΡΒΙΤΟΡΟΣ</h1>
	</div>

<div id ="nav">

<a href="login1.php">Logout</a>
</div>

<div id="move">
<button class="button button1" onclick="window.location.href='kataxwrhsh.php'">Καταχώρηση παραγγελίας</button><br>
<button class="button button2" onclick="window.location.href='situation.php'">Επισόπηση Καταστάσεων</button><br>
<button class="button button3" onclick="window.location.href='close_situation.php'">Αλλαγή Καταστάσεων</button><br>
<button class="button button4" onclick="window.location.href='episkopisi_poson.php'">Επισκόπηση Ποσών</button><br>
</div>
<br>

<script>
var today = new Date();
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
document.write(time);
</script>
	</body>
	</html>
