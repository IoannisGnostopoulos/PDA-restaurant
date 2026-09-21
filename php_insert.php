<!DOCTYPE html>
<html>

<head>
<title>Insert</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<style>
body {
overflow: scroll;
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
	
	}
	
#rol	{
	position:relative;
	top:-150px;
	left:600px;
}	
</style>

<body>

<div id="log">
<h4>Εισαγωγή χρήστη</h4>
</div>

<form method="POST" action="php_insert.php" onsubmit="checkDropDownList()">

<table id="tab" cellpadding="5">
<tr>
<td>Όνομα:<input type="text" name="name" "text-align:left" maxlength="20"  size="20" pattern="[a-z|A-Z]+" required autofocus><br></td>
<td>Επίθετο:<input type="text" name="surname" "text-align:left" maxlength="20" size="20" pattern="[a-z|A-Z]+" required></td>
</tr>
<tr>
<td>Username:<input type="text" name="username" "text-align:left" maxlength="20" size="20" required></td>
<td>Password:<input type="password" name="password" "text-align:left" maxlength="20" size="20" title="max 20 characters" required></td>
</tr>
<tr>
<td>Κωδικός χρήστη<input type="text" name="usercode" "text-align:left" maxlength="2" size="20" pattern="[0-9]+" required></td>
</tr>
<tr>
<td><select name="rolecode" required>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select></td>
</tr>
<tr>
<td><input type="submit"  value="Εισαγωγή" ></td>
<td><input type="reset"></td>
</tr>
</table>

</form>

<table id="rol" cellpadding="3">
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

</body>

</html>