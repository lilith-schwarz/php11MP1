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
<div><form method="post" action="katalog.php" id="searchform">
		<input type="text" name="searchString" placeholder="Suche">
		<button type="submit" name="searchButton">Suche</button>
		</form>
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

if(isset($_POST['searchButton'])) {
	searchAndShow_itemlist();	//zeige Suchergebnisse an (Wenn "Suche" gedrückt wurde)
}else {
	show_itemlist();	//...oder zeige alle Datenbankeinträge an
}

function show_itemlist(){	//Zeigt alle Items der DB an
	global $verbindung;

	$sql="SELECT * FROM produkte ORDER BY name";
	$abfrage=mysqli_query($verbindung, $sql);

	echo'<table class="katalog">';

	while ($produkte = mysqli_fetch_assoc($abfrage)){

		echo"<tr>";
		echo "<td id='tbild'> <img src='{$produkte ['bild']}' class='bild'/></td>";
		echo "<td><h2 id='th2'> {$produkte ['name']}</h2></td>";
		echo "<td id='tp'> {$produkte ['preis']} &euro; </td>";
		echo "<td id='tm'> {$produkte ['menge']}</td>";
		echo "<td id='tb'> {$produkte ['beschreibung']} </td>";
		echo "<td id='tz'><strong>Zutaten: </strong> {$produkte ['zutaten']}</td>";
		echo "<td class='leer'></td>";
		echo "</tr>";
	}

	echo'</table>';
	mysqli_free_result($abfrage);
}

function searchAndShow_itemlist(){
	global $verbindung;

	$insertString=$_POST['searchString'];
	$insertArray=explode(" ", $insertString);		//Teilt Suchstring in einzelne Begriffe nach Leerzeichen
	$wordCount=count($insertArray);					//Zählt, wieviele einzelne Suchbegriffe es gibt

	$sql = "SELECT * FROM produkte WHERE ";			//SQL Befehl wird in for-Schleife fertig definiert		

	for ($i=0; $i < $wordCount; $i++) { 			

		if($i==0){		//Wenn es der 1. Suchbegriff ist
			$sql .= "name LIKE '%".$insertArray[$i]."%' OR zutaten LIKE '%".$insertArray[$i]."%'";	

		}else{			//Für alle weiteren muss ein OR davor...
			$sql.=" OR name LIKE '%".$insertArray[$i]."%' OR zutaten LIKE '%".$insertArray[$i]."%'";

		}
	}
	$sql.=" ORDER BY name";
	$abfrage=mysqli_query($verbindung, $sql);

	if	(mysqli_num_rows($abfrage)>0){
		
		echo'<table class="katalog">';
		while ($produkte = mysqli_fetch_assoc($abfrage)){

			echo"<tr>";
			echo "<td id='tbild'> <img src='{$produkte ['bild']}' class='bild'/></td>";
			echo "<td><h2 id='th2'> {$produkte ['name']}</h2></td>";
			echo "<td id='tp'> {$produkte ['preis']} &euro; </td>";
			echo "<td id='tm'> {$produkte ['menge']}</td>";
			echo "<td id='tb'> {$produkte ['beschreibung']} </td>";
			echo "<td id='tz'><strong>Zutaten: </strong> {$produkte ['zutaten']}</td>";
			echo "<td class='leer'></td>";
			echo "</tr>";
		}

		echo'</table>';
		mysqli_free_result($abfrage);

	}else{
		echo "<h2>Die Suche hat keine Treffer ergeben</h2>";
	}
}

mysqli_close($verbindung);
?>
<footer>
  <span class="footer"> <a href="login.php" class="index">Admin-Login</a></span>

</footer>
</body>
</html>