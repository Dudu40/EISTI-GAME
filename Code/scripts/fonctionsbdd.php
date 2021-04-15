<?php

$HOTE = 'localhost';
$USER = 'ducasseque';
$PASS = 'azerty';
$BASE = 'Game';

//connexion à la bdd
function connect(){
	global $HOTE, $USER, $PASS, $BASE;

	$maCnx = mysqli_connect($HOTE, $USER, $PASS) or die('Erreur Connexion MySQL: '.mysqli_error());
	//on choisi la base sur laquelle on se connecte (le nom de leur bdd phpmyadmin)
	mysqli_select_db($maCnx,$BASE) or die('Erreur sélection de base: '.$BASE.' - '.mysqli_error());
	return $maCnx;
}

//deconnexion de la bdd
function deconnect($cnx){
	mysqli_close($cnx) or die('Erreur Déconnexion: '.mysqli_error());
}

//requete à la bdd
function execReq($maCnx,$req){
	$res = mysqli_query($maCnx,$req);
	if(!$res){
		echo 'Erreur requête: '.$req.' - '.mysqli_error($maCnx);
	 	die('Erreur requête: '.$req.' - '.mysqli_error($maCnx));
	}
	return $res;
}
?>
