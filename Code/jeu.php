<?php
session_start();

if (!(isset($_SESSION['pseudo']))) {
  $_SESSION['droits'] = 'visiteur';
}

?>
<!DOCTYPE html>
<html lang ="fr">
  	<head>
	  	<meta charset="utf-8">
	  	<title>survive</title>
	  	<link rel="stylesheet" type="text/css" href="general.css"/>
      <link rel="stylesheet" type="text/css" href="jeu.css"/>
      <script type="text/javascript" src="./scripts/fonctionsAJAX.js"></script>
      <script type="text/javascript" src="./scripts/jeu.js"></script>
    	<div class="entete">
    	<ul class="listefixe">
        <li><a href="jeu.php" class="head" id="jeu">Jouer</a></li>
    		<li><a href="profil.php" class="head">profil</a></li>
    		<li><a href="messagerie.php" class="head">messagerie</a></li>
    		<li><a href="joueurs.php" class="head">Joueurs</a></li>
    		<?php
  if ($_SESSION['droits'] == 'visiteur'){
    echo "<li><a href='connexion.php' class='head'>Connexion</a></li>";
  }
  else{
    echo "<li><a href='connexion.php' class='head'>Déconnexion</a></li>";
  }
  ?>
    	</ul>
    	</div>
  	</head>
    <!-- -cache le plateau et les stats  -->
    <body onload="cache()">

    <!-- -div affichage scores / stat en jeu -->
    <div id="block">

    	<!-- affiche score en jeu -->

       <div id="bestScoreTxt">Best Score: <span id="bestScore"> </span></div>

        <div id="scoreTxt1">Score: <span id="score1"> </span></div>

        

    	 <img src="./image/pause.png"  width="100" height="100" id="Pause" name="Pause"  onclick="pause()"></img>


    <!-- -plateau de jeu -->
    	<canvas id="mycanvas" onclick="Click()" ></canvas>
    	<canvas id="mycanvas2" ></canvas>
    </div>

    <!-- -stat lorsqu'on a perdu  -->
    <div id="stat">

       <div id="tabscore" style="margin-top : 30%;">
      <table class="latable">
        <tr>Meilleurs Scores<tr>
        <?php
        require('./scripts/fonctionsbdd.php');
        $db = connect();
        $req = "SELECT pseudo,score FROM Score s, Utilisateur u WHERE (u.idUser = s.idUser) ORDER BY score DESC";
        $res = execReq($db,$req);
        if (mysqli_num_rows($res) > 0) {
          $i = 0;
          while (($row = mysqli_fetch_assoc($res))&&($i < 10)) {
            $i = $i + 1;
            echo "<tr><td>".$i."</td><td>".$row['pseudo']."</td><td>".$row['score']."</td></tr>";}}
        deconnect($db);
        ?>

      </table>
   </div>

    	<!-- bouton restart -->
    	<input type="submit" id="restart" value="Restart" onclick="window.location.reload()">	</input>

    	<!-- affiche score apres avoir perdu -->
    	<div id="scoreTxt2">Score: <span id="score2"> </span></div>

    	<!-- affiche nombre total de mosntre tue apres avoir perdu -->
    	<div id="nbTotalTxt2">Monstres tués: <span id="nbTotal2"> </span></div>

    	<div id="medaille">  <img src="./image/medaille.png">
    	</div>
    </div>

    <!-- le bloc de la page d'intro -->
    <div id="intro">

      <div id="title"> EISTI-GAME</div>

      <!-- texte de présentation -->
      <div id= "presentation">
        Bonjour jeune aventurier !
        Vous êtes sur le point de commencer une bataille contre l'horrible armée de l'empereur ZERG.
        Je sais que cela peut effrayer, mais vous êtes notre seul espoir...
        D'après nos informations, ces saletés de Vouzours arrivent litteralement de partout !!
        Ils ont l'air inoffensifs et peut-être que seul il ne pourra vous faire aucun mal,
        mais ces sbires puisent leur force par leur nombre ... ZERG n'a pas l'habitude de n'en déployer qu'un seul...
        Survivez le plus longtemps possible afin que nos armées puissent se retirer pour préparer la contre attaque !
        Merci soldat et courage, votre mémoire sera glorifiée.

        APPUYEZ SUR "PLAY" POUR COMMENCER LA BATAILLE.


        </div>

    <!-- affiche bouton play -->

    <input type="button" id="play" value="Play" onclick="jeu()">
  </div>



    <div id="depassement">Vous avez dépassé votre meilleur score ! </div>
  </body>
