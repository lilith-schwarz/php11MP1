<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title></title>
  
      <link rel="stylesheet" href="stylesheet.css">
  
</head>

<body>
<div class="logo">
<a href="index.html"><img src="images/logo_loca_mole.png" id="logo"/></a>
</div>
  <div class="login-page">
  <div class="form">
    <form class="login-form" method="post" action="admin.php">
      <input type="text" name="user" placeholder="Benutzername"/>
      <input type="password" name="psw" placeholder="Passwort"/>
      <button type="submit" id="login">admin-login</button>
      <div class="back">
      <a href="index.html" class="back"> Kein Admin? Zurück</a>
      </div>
<?php
session_start();

if (isset($_SESSION['visited'])) {  //wenn schon eingeloggt, dann direkt weiter zur admin.php
    echo "<script language=\"JavaScript\">   
    location.href = 'admin.php';
    </script>";
}

?>
    </form>
  </div>
</div>

</body>
</html>
