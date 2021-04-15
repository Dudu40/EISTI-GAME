<?php
session_start();
include "fonctionsbdd.php";
  $pseudo = $_POST['pseudo'];
	$mdp = $_POST['mdp'];

	$db = connect();
  // vérifie si les logins entrés dans le formdata sont corrects,
	// si les logins sont bons, enregistre les infos dans une session et renvoie TRUE
	// si les logins sont faux, n'enregistre rien dans la session et renvoie FALSE
	$query = "SELECT * FROM Utilisateur WHERE (pseudo ='".$pseudo."') AND (mdp = '".$mdp."')";
	$res = execReq($db,$query);

	if (mysqli_num_rows($res) > 0) { // Est ce qu'on a eu un résultat?
		// oui, on a un résultat -> on enregistre les données dans la variable $_SESSION et on renvoie 'true'
		$row = mysqli_fetch_assoc($res); // On peut ne pas faire de while car il n'y aura qu'un seul résultat
		$_SESSION['pseudo'] = $row['pseudo'];
		$_SESSION['droits'] = $row['droits']; // admin ou inscrit?
    // L'utilisateur est-il banni?
    $query = "SELECT * FROM Bannis b, Utilisateur u WHERE (u.pseudo = '".$_SESSION['pseudo']."') AND (b.idBanni = u.idUser)";
    $res = execReq($db,$query);
    if (mysqli_num_rows($res) > 0) {
      // oui, il est banni -> on renvoie une chaîne de caractères qui n'est pas 'true' ou 'false', dans ce cas, 'banni'
        echo "banni";
    }
    else {
      // non, il n'est pas banni -> on renvoie 'true'
      echo "true";
    }
  }
	else {
		// non, on n'a pas eu de résultat -> on ne fait rien et on renvoie 'false'
		echo "false";
	}
?>
