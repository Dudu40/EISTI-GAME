<?php
session_start();
$score = $_POST['score'];

if ($_SESSION['droits'] != 'visiteur') {
	require('fonctionsbdd.php');
	$db = connect();

	$req = "SELECT idUser FROM Utilisateur WHERE (pseudo = '".$_SESSION['pseudo']."')";
	$res = execReq($db,$req);
	$row = mysqli_fetch_assoc($res);
	$id = $row['idUser'];

	$req = "INSERT INTO Score (idUser,score) VALUES ('".$id."','".$score."')";
	$res = execReq($db,$req);
	deconnect($db);
}

echo $score;

?>
