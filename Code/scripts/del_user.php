<?php
session_start();
include "fonctionsbdd.php";

$db = connect();
$query = "SELECT * FROM Utilisateur WHERE (pseudo ='".$_POST['pseudo']."')";
$res = execReq($db,$query);
$row = mysqli_fetch_assoc($res);
$id = $row['idUser'];
// On prend l'id de l'utilisateur à supprimer

$query = "DELETE FROM Profil WHERE idUser = ".$id."";
$res = execReq($db,$query);
// On supprime le profil de l'utilisateur

$query = "DELETE FROM Score WHERE idUser = ".$id."";
$res = execReq($db,$query);
// On supprime les scores de l'utilisateur

$query = "DELETE FROM Utilisateur WHERE idUser = ".$id."";
$res = execReq($db,$query);
// On supprime les parametres de connexion de l'utilisateur
?>
