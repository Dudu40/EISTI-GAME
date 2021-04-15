<?php
// A chaque fois qu'on revient sur connexion.php, et qu'on était connecté, on supprime les valeurs associées dans la session pour signifer la déconnexion
session_start();
if (isset($_SESSION['pseudo'])) {
  unset($_SESSION['pseudo']);
  unset($_SESSION['droits']);
} ?>

<!DOCTYPE html>
<html lang ="fr">
  	<head>
	  	<meta charset="utf-8">
	  	<title>EISTI-GAME</title>
	  	<link rel="stylesheet" type="text/css" href="general.css"/>
	  	<link rel="stylesheet" type="text/css" href="connexion.css"/>
      <script type="text/javascript" src="./scripts/fonctionsAJAX.js"></script>
  	</head>
	<body>


	<div class="entete">
	<ul class="listefixe">
    <!-- Entête, on garde tout en transparent à part pour connexion car l'utilisateur ne doit pas pouvoir accéder aux autres pages avant de de s'y être connecté -->
    <li><a class="headisable">Jouer</a></li>
		<li><a class="headisable">profil</a></li>
		<li><a class="headisable">messagerie</a></li>
		<li><a class="headisable">Joueurs</a></li>
		<li><a href="connexion.php" class="head">Connexion</a></li>
	</ul>
	</div>
	<div class="basediv" id="connexion">
			<input required type="text" name="pseudo" id="pseudo" placeholder="pseudo">
			<input required type="password" name="mdpasse" id="mdp" placeholder="mot de passe"><br><br>
			<button class="btn" onclick="tryLogin()">Me connecter</button><br/><br/>
      <br><div id="erreur"></div>
		<a id="leftlink" href="inscription.php" class="link">Pas encore inscrit?</a>
		<a id="rightlink" href="jeu.php" class="link">Se connecter en tant que visiteur</a>
	</div>
	</body>
</html>
