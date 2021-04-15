<?php session_start(); ?>
<!DOCTYPE html>
<html lang ="fr">
  	<head>
	  	<meta charset="utf-8">
	  	<title>EISTI-GAME</title>
	  	<link rel="stylesheet" type="text/css" href="general.css"/>
	  	<link rel="stylesheet" type="text/css" href="joueurs.css"/>
	  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script type="text/javascript" src="./scripts/fonctionsAJAX.js"></script>
  	</head>
	<body>
	<div class="entete">
	<ul class="listefixe">
    <!-- Entête -->
    	<li><a href="jeu.php" class="head">Jouer</a></li>
		<li><a href="profil.php" class="head">profil</a></li>
		<li><a href="messagerie.php" class="head">messagerie</a></li>
		<li><a href="joueurs.php" class="head" id="joueurs">Joueurs</a></li>
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
	<div class="basediv">
	<p>Entrez le nom d'un joueur!</p>
  <!-- Barre de recherche des joueurs. -->
    <input type="text" id="search" placeholder="Search.." name="search">
    <button class="fa fa-search" onclick="profilUpdate()"></button>
    <p>Déroulez la liste pour le sélectionner</p>
    <br>
    <div class="customselect">

	<label for="mon_select" ></label>

  <!-- La liste déroulante dynamique qui changera en fonction de la recherche de joueurs. -->
	<div class="customselect-container">
    <select id="listeProfils">
      <?php
      require('./scripts/fonctionsbdd.php');
      $db = connect();
      $req = "SELECT * FROM Utilisateur";
      $res = execReq($db,$req);
      if (mysqli_num_rows($res) > 0) {
      	echo "<option>Liste de joueurs</option>";
  			while ($row = mysqli_fetch_assoc($res)) {
  				$pseudotemp = $row['pseudo'];
          // Si on clique sur un nom, on est transporté à la page de profil du joueur en question.
  				echo "<option value='".$pseudotemp."' onclick='gotoProfil(this)'>".$pseudotemp."</option>";
  			}
  		}
      deconnect($db);
       ?>
    </select>
   	</div>
   	</div>
   	</div>
  </body>
  </html>
