<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
<script language="javascript" type="text/javascript">
</script>

  <!-- äüöß-->

	<title></title>
	<link href="stylesheet.css" rel="stylesheet">
</head>
<body>
<!-- Header -->
	<div id="headeradmin">
<a href="index.html"><img src="images/logo_loca_mole.png" id="logo"/></a>
	</div>
	<div id="menue">
		<span class="menue"> <a href="katalog.php" class="index">Produkte</a></span>
		<span class="bullet"> &bull;</span>
		<span class="menue"><a href="impressum.html" class="index">Impressum</a></span></div>
		<div><form method="post" action="admin.php" id="searchform">
		<input type="text" name="searchString" placeholder="Suche">
		<button type="submit" name="searchButton">Suche</button>
		</form>
		</div>



<?php
session_start();
$verbindung="";
$verbindung=getDb();	//Stellt eine Datenbank-Verbindung her

// Values für Formular werden initialisiert
$button="Hinzuf&uuml;gen";
$varname="";
$varpreis="";
$varbild="";
$varmenge="";
$varzutaten="";
$varbeschreibung="";
$varid="";

if (!isset($_SESSION['visited'])) { //Wenn nicht eingeloggt (Session inaktiv), dann einloggen
	login();	
} 

if (isset($_POST['loschen'])){	//wenn der Button "Löschen" geklickt wurde
	button_loeschen();
}
else if (isset($_POST['bearbeiten'])){	//wenn der Button "Bearbeiten" geklickt wurde
	button_bearbeiten();
}

create_editform(); //Erstellt das Formular zum Hinzufügen/Bearbeiten der Einträge

if(isset($_POST["Hinzufügen"])){	//Button "Hinzufügen" wurde gedrückt
	add_item();
}
else if(isset($_POST["Ändern"])){ 	//Button "Ändern" wurde gedrückt
	edit_item();	
}

if(isset($_POST['searchButton'])) {
	searchAndShow_itemlist();	//zeige Suchergebnisse an (Wenn "Suche" gedrückt wurde)
}else {
	show_itemlist();	//...oder zeige alle Datenbankeinträge an
}

mysqli_close($verbindung);	//schließt die Datenbank-Verbindung


function getDb(){
	global $verbindung;	//Variablen müssen als global deklariert werden, damit man in der Funktion Zugriff hat

	if($verbindung==""){	//Wenn es noch keine Verbindung gibt...
		try{				//...versuche eine herzustellen
			$a= @mysqli_connect("localhost", "root", "");	
			mysqli_select_db($a, "locamole");
			return $a;		//gib die Datenbank zurück an $verbindung

		}catch(mysqli_error $e){	//Fehlerhandling
			echo "Fehler: ".$e($a);
		}
	}else{
		return $verbindung;	//Wenn schon eine Verbindung existiert, gib sie einfach zurück
	}
}

function button_loeschen(){

	global $verbindung;

	$sql="DELETE FROM produkte WHERE id = '{$_POST['loschen']}'";	//Lösche das Item mit der ID xy
	mysqli_query($verbindung, $sql);
}

function button_bearbeiten(){

	global $button;
	global $varname;
	global $varpreis;
	global $varbild;
	global $varmenge;
	global $varzutaten;
	global $varbeschreibung;
	global $varid;
	global $verbindung;

	$button="&Auml;ndern";		//Umbennenung des Buttons
	$sql="SELECT * FROM produkte WHERE id='{$_POST['bearbeiten']}'";	//Gib mir alle Infos des items mit der id xy
	$abfrage=mysqli_query($verbindung, $sql);
	$infos = mysqli_fetch_assoc($abfrage);

	$varname= $infos['name'];			//Ändern Textfeld-Values (werden vorausgefüllt)
	$varpreis= $infos['preis'];
	$varbild= $infos['bild'];
	$varmenge= $infos['menge'];
	$varzutaten= $infos['zutaten'];
	$varbeschreibung= $infos['beschreibung'];
	$varid = $infos['id'];

	mysqli_free_result($abfrage);	//gibt den annektierten Speicher frei
}

function create_editform(){	//generiert die Eingabe-Felder (bei Bearbeiten vorausgefüllt)

	global $button;
	global $varname;
	global $varpreis;
	global $varbild;
	global $varmenge;
	global $varzutaten;
	global $varbeschreibung;
	global $varid;

	echo '<form class="dazu" method="post" action="admin.php">';    
	echo '<div class="formdazu">';
	echo '<input type="text" name="name" value="'.$varname.'" placeholder="Produktname"/>';
	echo '<input type="text" name="preis" value="'.$varpreis.'" placeholder="Preis"/>';
	echo '<input type="text" name="bild" value="'.$varbild.'" placeholder="Bild-URL"/>';
	echo '<input type="text" name="menge" value="'.$varmenge.'" placeholder="Menge"/>';
	echo '<input type="text" name="zutaten" value="'.$varzutaten.'" placeholder="Zutaten"/>';
	echo '<input type="text" name="beschreibung" value="'.$varbeschreibung.'" placeholder="Beschreibung"/>';
	echo '<button type="submit" name="'.$button.'"" value="'.$varid.'" id="dazu" class="button">'.$button.'</button>';
	echo '</div>';
	echo '</form>';
	echo '<hr>';

}

function login(){

	global $verbindung;

    $query="SELECT * FROM login";	//holt sich die Login-Daten von der DB
	$abfrage=mysqli_query($verbindung, $query);
	$login=mysqli_fetch_assoc($abfrage);

	$hashed_psw=psw_hash($_POST['psw']);	//verschlüsselt das eingegebene psw (steht in der DB auch verschlüsselt)
	
	if ($hashed_psw==$login['password'] && $_POST['user']==$login['user']) { 	//vergleicht die Eingabe mit den Daten in der DB
		   $_SESSION['visited'] = true;											// wenn login erfolgreich, Session aktiv
	}
	else{
		echo "<script language=\"JavaScript\">
		<!--
		alert(\"Bitte überprüfen sie ihre Daten!\");
		//-->
		location.href = 'login.php';	
		</script>";						//User wird bei falscher Eingabe zurück auf die Login-Seite geschickt
	}
	mysqli_free_result($abfrage);
}

function add_item(){	//Hinzufügen von DB-Einträgen
	global $verbindung;

	//Wenn keines der Eingabe-Felder leer ist..
	if(!(empty($_POST["name"])) && !(empty($_POST["preis"])) && !(empty($_POST["beschreibung"])) && !(empty($_POST["bild"])) && !(empty($_POST["zutaten"])) && !(empty($_POST["menge"]))){
			//...füge das Item der Datenbank hinzu
			$sql="INSERT INTO produkte (name, preis, beschreibung, bild, zutaten, menge) VALUES ('{$_POST["name"]}', '{$_POST["preis"]}', '{$_POST["beschreibung"]}', '{$_POST["bild"]}', '{$_POST["zutaten"]}', '{$_POST["menge"]}')";
			mysqli_query($verbindung, $sql);

	}else if (isset($_POST['Hinzufügen'])){		//Wenn "Hinzufügen" geklickt wurde, aber ein Feld noch leer ist
	echo "<script language=\"JavaScript\">
			<!--
			alert(\"Bitte alle Felder ausfüllen!\");
			//-->
			</script>";		//Fehlermeldung
	} 
}

function edit_item(){	//Bearbeiten von DB-Einträgen
	global $verbindung;
	
	//Alle Felder müssen ausgefüllt sein
	if(!(empty($_POST["name"])) && !(empty($_POST["preis"])) && !(empty($_POST["beschreibung"])) && !(empty($_POST["bild"])) && !(empty($_POST["zutaten"])) && !(empty($_POST["menge"]))){

			//Item wird geupdatet
			$sql="UPDATE produkte SET name='{$_POST["name"]}', preis='{$_POST["preis"]}', beschreibung='{$_POST["beschreibung"]}', bild='{$_POST["bild"]}', zutaten='{$_POST["zutaten"]}', menge='{$_POST["menge"]}' WHERE id='{$_POST["Ändern"]}'";
			mysqli_query($verbindung, $sql);
		}
		else if (isset($_POST['Ändern'])){
			echo "<script language=\"JavaScript\">
					<!--
					alert(\"Bitte alle Felder ausfüllen!\");
					//-->
					</script>";
	}
}

function show_itemlist(){	//Zeigt alle Items der DB an
	global $verbindung;

	$sql="SELECT * FROM produkte ORDER BY id";
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
		echo "<td class='leer'><form class='dazu' method='post' action='admin.php'>";
		echo "<button type='submit' name='bearbeiten' value='{$produkte['id']}' class='button' id='ed'>Bearbeiten</button><br/>";
	    echo "<button type='submit' name='loschen' value='{$produkte['id']}' onclick=\"return confirm('Wirklich löschen?')\" class='button' id='del'>L&ouml;schen</button></form></td>";
		echo "</tr>";
	}

	echo'</table>';
	mysqli_free_result($abfrage);
}

function psw_hash($Input) {
  $Input=iconv('UTF-8','UTF-16LE',$Input);	 //konvertivert das psw von UTF8 zu UTF16
  $MD4Hash=bin2hex(mhash(MHASH_MD4,$Input)); //Verschlüsselt mit MD4 hash
  $upperHash=strtoupper($MD4Hash);	//alles in Großbuchstaben

  return($upperHash);
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
			echo "<td class='leer'><form class='dazu' method='post' action='admin.php'>";
			echo "<button type='submit' name='bearbeiten' value='{$produkte['id']}' class='button' id='ed'>Bearbeiten</button><br/>";
		    echo "<button type='submit' name='loschen' value='{$produkte['id']}' onclick=\"return confirm('Wirklich löschen?')\" class='button' id='del'>L&ouml;schen</button></form></td>";
			echo "</tr>";
		}

		echo'</table>';
		mysqli_free_result($abfrage);
		
	}else{
		echo "<h2>Die Suche hat keine Treffer ergeben</h2>";
	}
}


?>
<footer>

  <span class="footer"><form method=post action="katalog.php"> <button type="submit" class="index" name="logout" id="logout">Logout</button></form></span>

</footer>

</body>
</html>