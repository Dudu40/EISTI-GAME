<?php

session_start();
$pseudo = $_POST['pseudo'];
$pseudobloque = $_SESSION['pseudo'];

require('fonctionsbdd.php');
$db = connect();

$req = "SELECT idUser FROM Utilisateur WHERE (pseudo = '".$pseudo."')";
$res = execReq($db,$req);
if (mysqli_num_rows($res) > 0) {
  while ($row = mysqli_fetch_assoc($res)) {
    $idbanni = $row['idUser'];
  }
}

// On récupère l'id de l'utilisateur à bannir

$req = "INSERT INTO Bannis (idBanni) VALUES ('".$idbanni."')";
$res = execReq($db,$req);

// Et on le rajoute à la table des bannis.

deconnect($db);

?>
