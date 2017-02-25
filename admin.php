<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <!-- äüöß-->


	<title></title>
	<link href="stylesheet.css" rel="stylesheet">
</head>
<body>
<div id="headeradmin">
<img src="images/logo_loca_mole.png" id="logo"/>
</div>
<div id="footer">
<span class="footer"> <a href="katalog.php" class="index">Produkte</a></span>
<span class="bullet"> &bull;</span>
<span class="footer"> <a href="login.php" class="index">Admin-Login</a></span>
<span class="bullet"> &bull;</span>
<span class="footer"><a href="impressum.html" class="index">Impressum</a></span>
</div>

<?php
session_start();
$verbindung="";
$verbindung = getDb($verbindung);

echo '<form class="dazu" method="post" action="admin.php">';
      
echo '<div class="formdazu">';
echo '<input type="text" name="name" placeholder="Produktname"/>';
echo '<input type="text" name="preis" placeholder="Preis"/>';
echo '<input type="text" name="bild" placeholder="Bild-URL"/>';
echo '<input type="text" name="menge" placeholder="Menge"/>';
echo '<input type="text" name="zutaten" placeholder="Zutaten"/>';
echo '<input type="text" name="beschreibung" placeholder="Beschreibung"/>';
echo '<button type="submit" name="dazu" id="dazu">Hinzuf&uuml;gen</button>';
echo '</div>';
echo '</form>';


if (isset($_POST['loschen'])){
	$sql="DELETE FROM produkte WHERE id = '{$_POST['loschen']}'";
	mysqli_query($verbindung, $sql);
	//header("Refresh:0");

}else if (isset($_POST['bearbeiten'])){
	$sql="SELECT name FROM produkte WHERE id='{$_POST['bearbeiten']}'";
	$abfrage=mysqli_query($verbindung, $sql);

	$produktname = mysqli_fetch_assoc($abfrage);
	$_POST["name"]= $produktname['name'];

}

if (!isset($_SESSION['visited'])) {
   //echo "Du hast diese Seite noch nicht besucht";
	    $query="SELECT * FROM login";
		$abfrage=mysqli_query($verbindung, $query);
		$login=mysqli_fetch_assoc($abfrage);

	if ($_POST['psw']!=$login['password'] && $_POST['user']!=$login['user']) {
		echo "<script language=\"JavaScript\">
		<!--
		alert(\"Bitte überprüfen sie ihre Daten!\");
		//-->
		location.href = 'login.php';
		</script>";
		// else $_SESSION["loginok"] = true;
	}else{
		   $_SESSION['visited'] = true;

	}
} else {
   //echo "Du hast diese Seite zuvor schon aufgerufen";
}


//wenn alles ausgefüllt ist, füge es in die Datenbank ein



if(!(empty($_POST["name"])) && !(empty($_POST["preis"])) && !(empty($_POST["beschreibung"])) && !(empty($_POST["bild"])) && !(empty($_POST["zutaten"])) && !(empty($_POST["menge"]))){

		$sql="INSERT INTO produkte (name, preis, beschreibung, bild, zutaten, menge) VALUES ('{$_POST["name"]}', '{$_POST["preis"]}', '{$_POST["beschreibung"]}', '{$_POST["bild"]}', '{$_POST["zutaten"]}', '{$_POST["menge"]}')";
		mysqli_query($verbindung, $sql);

}else if (isset($_POST['dazu'])){
echo "<script language=\"JavaScript\">
		<!--
		alert(\"Bitte alle Felder ausfüllen!\");
		//-->
		</script>";
}


$sql="SELECT * FROM produkte ORDER BY id";
$abfrage=mysqli_query($verbindung, $sql);

echo'<table class="katalog">';
		
while ($produkte = mysqli_fetch_assoc($abfrage)){

	echo"<tr>";
	echo "<td> <img src='{$produkte ['bild']}' class='bild'/></td>";
	echo "<td> {$produkte ['id']}</td>";
	echo "<td> {$produkte ['name']}</td>";
	echo "<td> {$produkte ['preis']}";
	echo "<td> {$produkte ['beschreibung']}";
	echo "<td class='leer'><form class='dazu' method='post' action='admin.php'>";
	echo "<button type='submit' name='bearbeiten' value='{$produkte['id']}' id='dazu'>Bearbeiten</button>";
    echo "<button type='submit' name='loschen' value='{$produkte['id']}' id='dazu'>L&ouml;schen</button>";
    echo "</form></td>";
	echo "</tr>";

}

echo'</table>';

function getDb($db_verbindung){
	if($db_verbindung==""){
		try{
			$a= @mysqli_connect("localhost", "root", "");
			mysqli_select_db($a, "locamole");
			return $a;

		}catch(mysqli_error $e){
			echo "Fehler: ".$e($a);
		}
	}else{
		return $db_verbindung;
	}
}

mysqli_free_result($abfrage);
mysqli_close($verbindung);

?>
</body>
</html>