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
    $idbloque = $row['idUser'];
  }
}

$req = "SELECT idUser FROM Utilisateur WHERE (pseudo = '".$pseudobloque."')";
$res = execReq($db,$req);
if (mysqli_num_rows($res) > 0) {
  while ($row = mysqli_fetch_assoc($res)) {
    $idbloqueur = $row['idUser'];
  }
}

// On récupère les id du bloqueur et du bloqué.

$req = "INSERT INTO Bloques (idBloqueur,idBloque) VALUES ('".$idbloqueur."','".$idbloque."')";
$res = execReq($db,$req);

// Puis on les aujoute à la table Bloques.

deconnect($db);

?>
