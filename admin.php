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

<form class="dazu" method="post" action="admin.php">
      

       <div class="formdazu">
       <input type="text" name="name" placeholder="Produktname"/>
      <input type="text" name="preis" placeholder="Preis"/>
      <input type="text" name="bild" placeholder="Bild-URL"/>
      <input type="text" name="menge" placeholder="Menge"/>
      <input type="text" name="zutaten" placeholder="Zutaten"/>
      <input type="text" name="beschreibung" placeholder="Beschreibung"/>
      <button type="submit" id="dazu">Hinzuf&uuml;gen</button>
      </div>




    </form>

<?php
 function login($psw, $user){
    	 if ($psw==$login['password'] AND $user==$login['user'])
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



    }}








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

    
    $passwort=$_POST["psw"];
    $user=$_POST["user"];

        login($passwort, $user);


   

     
			//header('Location: login.php');


		
	}
}

if(isset($_POST["name"]) && isset($_POST["preis"]) && isset($_POST["beschreibung"]) && isset($_POST["bild"]) && isset($_POST["zutaten"]) && isset($_POST["menge"])){

		$sql="INSERT INTO produkte ('name', 'preis', 'beschreibung', 'bild', 'zutaten', 'menge') VALUES ('name', 'preis', 'beschreibung', 'bild', 'zutaten', 'menge')";
		mysqli_query($verbindung, $sql);



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