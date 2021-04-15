<?php
session_start();
include "fonctionsbdd.php";
	// vérifie si les logins entrés dans le formdata sont corrects,
	// si les logins sont bons, enregistre les infos dans une session et renvoie TRUE
	// si les logins sont faux, n'enregistre rien dans la session et renvoie FALSE
  $pseudo = $_POST['pseudo'];
	$mdp = $_POST['mdp'];

	$db = connect();
	$query = "SELECT * FROM Utilisateur WHERE (pseudo ='".$pseudo."') AND (mdp = '".$mdp."')";
	$res = execReq($db,$query);

	if (mysqli_num_rows($res) > 0) { // Est ce qu'on a eu un résultat?
		// oui -> on enregistre les données dans la variable $_SESSION et on renvoie TRUE
		$row = mysqli_fetch_assoc($res); // On peut ne pas faire de while car il n'aura qu'un seul résultat (normalement)
		$_SESSION['pseudo'] = $row['pseudo'];
		$_SESSION['droits'] = $row['droits']; //admin ou inscrit?
    // L'utilisateur est-il banni?
    $query = "SELECT * FROM Bannis b, Utilisateur u WHERE (u.pseudo = '".$_SESSION['pseudo']."') AND (b.idBanni = u.idUser)";
    $res = execReq($db,$query);
    if (mysqli_num_rows($res) > 0) {
        echo "banni";
    }
    else {
      echo "true";
    }
  }
	else {
		// non -> on ne fait rien et on renvoie FALSE
		echo "false";
	}

//  si vous utilisez ces fonctions, n'oubliez pas de rajouter 'include("fonctionsbdd.php")' en php au début du fichier;
?>
