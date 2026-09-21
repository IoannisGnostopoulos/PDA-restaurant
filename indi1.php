<html>

<head><title>Επισκόπιση ατομικής εικόνας παραγγελιών</title>
<meta charset="UTF-8">


<script>
function show(str) {
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
        xmlhttp.open("GET","indi.php?q="+str,true);
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

#partial {
	position:relative;
	top:20px;
	left:200px;
	}
	
#ser 	 {
	position:relative;
	top:40px;
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
#print{
	position:relative;
	top:100px;
	
}


</style>

<body>

<div id="log">
<h4>Επισκόπιση ατομικής εικόνας παραγγελιών</h4>
</div>

<div id="ser">

<form method="GET" action="in">
<b>Επιλογή σερβιτόρου </b>

<?php 

$servername = "localhost";
$username = "root";
$password = "";  

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

mysqli_select_db($conn,'tes1');

 $sql="SELECT kwdikos_servitorou FROM header ";
 $result = mysqli_query($conn,$sql);
?>


 <select name="serbitoros" onchange="show(this.value)" >
 
 <?php
  while($row = mysqli_fetch_array($result)) {
            
 echo "<option value='" . $row["kwdikos_servitorou"] ." '>" .$row["kwdikos_servitorou"] . "</option>";
        }
    

	
?>
</select>
<br>
</div>

<br>

<div id="txtHint"><b>Person info will be listed here...</b></div>


<a  href="owner.html"><font color="blue">BACK</font></a>
</body>
</form>
</html>