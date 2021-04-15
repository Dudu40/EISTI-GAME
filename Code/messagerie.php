<?php session_start(); ?>
<!DOCTYPE html>
<html lang ="fr">
  	<head>
	  	<meta charset="utf-8">
	  	<title>EISTI-GAME</title>
	  	<link rel="stylesheet" type="text/css" href="general.css"/>
	  	<link rel="stylesheet" type="text/css" href="messagerie.css"/>
	  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  	<script type="text/javascript" src="./scripts/fonctionsAJAX.js"></script>
  	</head>
	<body>
	<div class="entete">
	<ul class="listefixe">
    <!-- Entête -->
		<li><a href="jeu.php" class="head">Jouer</a></li>
		<li><a href="profil.php" class="head">profil</a></li>
		<li><a href="messagerie.php" class="head" id="messagerie">messagerie</a></li>
		<li><a href="joueurs.php" class="head">Joueurs</a></li>
		<?php
    // Si l'utilisateur est un visiteur, on affiche "connexion" au lieu de "déconnexion"
  if ($_SESSION['droits'] == 'visiteur'){
    echo "<li><a href='connexion.php' class='head'>Connexion</a></li>";
  }
  else{
    echo "<li><a href='connexion.php' class='head'>Déconnexion</a></li>";
  }
  ?>
	</ul>
	</div>
	<div class="liste">
    <?php
    // Si l'utilisateur est un visiteur, on ne l'autorise pas à envoyer ou recevoir des messages.
      if ($_SESSION['droits']=='visiteur') {
        echo "<h1>Connectez vous pour échanger avec d'autres utilisateurs!</h1>";
      }
      else {

		echo "<p>Liste des joueurs</p>";
    // Barre de recherche des joueurs.
	    echo "<input type='text' id='search' placeholder='Search..' name='search'>";
	    echo "<button class='fa fa-search' onclick='messagerieUpdate()'></button>";
	    echo "<p>Déroulez la liste pour le sélectionner</p>";
	    echo "<br>";
		echo "<div class='customselect'>";

		echo "<label for='mon_select' ></label>

		<div class='customselect-container'>
    	<select id='listeProfils'>";
		require('./scripts/fonctionsbdd.php');
		$db = connect();
		$req = "SELECT * FROM Utilisateur";
		$res = execReq($db,$req);
		if (mysqli_num_rows($res) > 0) {
			echo "<option>Liste de joueurs</option>";
		  while ($row = mysqli_fetch_assoc($res)) {
		    $pseudo = $row['pseudo'];
		    echo "<option value='".$pseudo."' onclick='getLogs(this.value)'>".$pseudo."</option>";
        // On génère la liste de joueurs qu'on met en option pour la liste déroulante.
		  }
		}
		echo "</select>
		</div>
		</div>
		</div>
	<div class='liste2'>
	<p>Messages reçus</p>";
  // On cherche à générer des boutons pour accéder plus facilement aux utilisateurs qui nous ont déjà envoyé un message.
		$pseudo = $_SESSION['pseudo'];
		$req = "SELECT * FROM Utilisateur WHERE (pseudo = '".$pseudo."')";
		$res = execReq($db,$req);
		if (mysqli_num_rows($res) > 0) {
		  while ($row = mysqli_fetch_assoc($res)) {
		    $idUser = $row['idUser'];
        // ON récupère notre ID.

		}
		}
		$req = "SELECT DISTINCT pseudo FROM Utilisateur u, Messages m WHERE (m.idRecu = '".$idUser."') AND (u.idUser = m.idSend)";
		$res = execReq($db,$req);
		if (mysqli_num_rows($res) > 0) {
		  while ($row = mysqli_fetch_assoc($res)) {
		    $pseudo = $row['pseudo'];
		    echo "<button class='btnlist' value='".$pseudo."' onclick='getLogs(this.value)'>".$pseudo."</button><br><br>";
        // Liste des utilisateurs qui nous ont déjà envoyé un message.
		  }
		}
		deconnect($db);
	echo "</div>

	<div class='page' id='logs'>
	<p>Messages</p><br/><p>Cliquez sur un joueur pour afficher votre conversation</p>";}
  // Div vide pour pouvoir afficher les logs après.?>
	</div>
</body>
</html>
