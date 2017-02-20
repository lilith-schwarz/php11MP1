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
  $server="localhost";
  $benutzer="root";
  $passwort="";
  $datenbank="locamole";

$verbindung= @mysqli_connect($server, $benutzer, $passwort);


if($verbindung){

  mysqli_select_db($verbindung, $datenbank);
  if (mysqli_error($verbindung))
  {
    echo "Fehler: ".mysqli_error($verbindung);
  }else
  {
    $sql="SELECT * FROM login";
    $abfrage=mysqli_query($verbindung, $sql);
    $login=mysqli_fetch_assoc($abfrage);

    


      if ($_POST["psw"]==$login['password'] AND $_POST["user"]==$login['user'])
      {

      }
      else{



			 echo "<script language=\"JavaScript\">
			<!--
			alert(\"Bitte überprüfen sie ihre Daten!\");
			//-->
			location.href = 'login.php';
			</script>
			";

			//header('Location: login.php');


		}
	}
}

$server="localhost";
$benutzer="root";
$passwort="";
$datenbank="locamole";

$verbindung= @mysqli_connect($server, $benutzer, $passwort);

if($verbindung)
{
	mysqli_select_db($verbindung, $datenbank);
	if (mysqli_error($verbindung))
	{
		echo "Fehler: ".mysqli_error($verbindung);
	}else
	{
		
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
			echo "<td class='leer'></td>";
			echo"</tr>";


		}
				echo'</table>';
				mysqli_free_result($abfrage);

		
	
	
	}
}
else
{
	echo "Verbindungsfehler: ".mysqli_connect_error($verbindung);
}

mysqli_close($verbindung);

?>


</body>
</html>