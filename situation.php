<html>
<head>
<title> Καταστάσεις</title>
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
	</style>

</head>
<body>
<div id="logo">
	<h1>Επισκόπηση Καταστάσεων</h1>
	</div><br><br><br>

<table border=1 id="table">
<tr>
<td>A/A</td>
<td>Κωδικός Παραγγελίας</td>
<td>Κωδικός Τραπεζιού</td>
<td>Ημερομηνία</td>
<td>Κωδικός Χρήστη(σερβιτόρου)</td>
<td>Σύνολο Παραγγελίας</td>
<td>Καταστάση Παραγγελίας</td>
<td>Ημερομηνία Και Ωρα Αναχώρησης</td>
<td>Ημερομηνία Και Ωρα Παράδοσης</td>

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

	$sql= "SELECT kwdikos_paragellias,kwdikos_trapeziou, hmeromhnia , kwdikos_servitorou , synolo_paragelias, katastash_paragelias,hmeromhnia_kai_ora_anaxwrhshs,hmeromhnia_kai_ora_paradwshs FROM  header ";
	$result= mysqli_query($conn,$sql);

	if(mysqli_num_rows($result) >  0 )
	{
		while($row=mysqli_fetch_assoc($result)){
		$i=$i+1;
		echo "<tr><td>".$i.
		"</td><td>".$row["kwdikos_paragellias"].
		"</td><td>".$row["kwdikos_trapeziou"].
		"</td><td>".$row["hmeromhnia"].
		"</td><td>".$row["kwdikos_servitorou"].
		"</td><td>".$row["synolo_paragelias"].
		"</td><td>".$row["katastash_paragelias"].
		"</td><td>".$row["hmeromhnia_kai_ora_anaxwrhshs"].
		"</td><td>".$row["hmeromhnia_kai_ora_paradwshs"]."</td></tr>";
	}
	}	
?>
</table>


<script type="text/javascript">
    function play_sound() {
        var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', '\xampp\htdocs\pro\alarm.mp3');
        audioElement.setAttribute('autoplay', 'autoplay');
        audioElement.load();
        audioElement.play();
    }
</script>

</body>
<a  href="serbitoros.php"><font color="blue">BACK</font></a></div>

</html>