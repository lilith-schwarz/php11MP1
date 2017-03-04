<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <!-- äüöß-->


	<title></title>
	<link href="stylesheet.css" rel="stylesheet">
</head>
<body>
<div id="header">
<a href="index.html"><img src="images/logo_loca_mole_weiss.png" id="logo"/></a>
</div>
<div id="menue">
<span class="menue"> <a href="katalog.php" class="index">Produkte</a></span>
<span class="bullet"> &bull;</span>
<span class="menue"><a href="impressum.html" class="index">Impressum</a></span>
</div>

<?php
session_start();
$verbindung="";

if(isset($_POST["logout"]))
{	
	session_destroy();
}

try{				//versuche eine Verbindung herzustellen
	$verbindung= @mysqli_connect("localhost", "root", "");	
	mysqli_select_db($verbindung, "locamole");

}catch(mysqli_error $e){	//Fehlerhandling
	echo "Fehler: ".$e($a);
}

$sql="SELECT * FROM produkte ORDER BY id";
$abfrage=mysqli_query($verbindung, $sql);

echo'<table class="katalog">';

while ($produkte = mysqli_fetch_assoc($abfrage)){
	echo"<tr>";
	echo "<td id='tbild'> <img src='{$produkte ['bild']}' class='bild'/></td>";
	echo "<td><h2 id='th2'> {$produkte ['name']}</h2></td>";
	echo "<td id='tp'> {$produkte ['preis']} &euro; </td>";
	echo "<td id='tm'> {$produkte ['menge']} &euro; </td>";
	echo "<td id='tb'> {$produkte ['beschreibung']} </td>";
	echo "<td id='tz'> {$produkte ['zutaten']}</td>";
	echo "<td class='leer'></td>";
	echo"</tr>";
}

echo'</table>';

mysqli_free_result($abfrage);
mysqli_close($verbindung);

?>
<footer>
  <span class="footer"> <a href="login.php" class="index">Admin-Login</a></span>

</footer>
</body>
</html>