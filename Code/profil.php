<?php session_start(); ?>

<!DOCTYPE html>
<html lang ="fr">
    <head>
      <meta charset="utf-8">
      <title>EISTI-GAME</title>
      <link rel="stylesheet" type="text/css" href="general.css"/>
      <link rel="stylesheet" type="text/css" href="profil.css"/>
      <script type="text/javascript" src="./scripts/fonctionsAJAX.js"></script>
    </head>
  <body>
  <div class="entete">
  <ul class="listefixe">
  <!-- Entête -->
    <li><a href="jeu.php" class="head">Jouer</a></li>
    <li><a href="profil.php" class="head" id="profil">profil</a></li>
    <li><a href="messagerie.php" class="head">messagerie</a></li>
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
  <div class="page">
    <?php
    if ($_SESSION['droits']=='visiteur') {
      // Si l'utilisateur est un visiteur, on ne l'autorise pas à regarder son profil, ou le profil des autres.
      echo "<h1> Inscrivez vous pour avoir un profil et voir le profil des autres! </h1>";
    }
    else {
      require("./scripts/fonctionsbdd.php");
      $db = connect();
      if (isset($_GET['pseudo'])) {// Est-ce qu'on regarde le profil d'un autre ou le sien?
        $pseudo = $_GET['pseudo']; // Oui -> On prend le pseudo reçu en POST

        // On regarde si l'utilisateur est bloqué / a bloqué
        $req = "SELECT * FROM Utilisateur WHERE (pseudo = '".$pseudo."')";
        $res = execReq($db,$req);
        $row = mysqli_fetch_assoc($res);
        $idbloque = $row['idUser'];
        $req = "SELECT * FROM Utilisateur WHERE (pseudo = '".$_SESSION['pseudo']."')";
        $res = execReq($db,$req);
        $row = mysqli_fetch_assoc($res);
        $idbloqueur = $row['idUser'];
        $req = "SELECT * FROM Bloques WHERE (idBloqueur = '".$idbloqueur."') AND (idBloque = '".$idbloque."')";
        $res = execReq($db,$req);
        if (mysqli_num_rows($res) > 0) {
          // L'utilisateur a bloqué
          $bloqueur = true;
        }
        else {
          $req = "SELECT * FROM Bloques WHERE (idBloque = '".$idbloqueur."') AND (idBloqueur = '".$idbloque."')";
          $res = execReq($db,$req);
          if (mysqli_num_rows($res) > 0) {
            // L'utilisateur est bloqué
            $bloque = true;
        }}
        $req = "SELECT * FROM Bannis WHERE (idBanni = '".$idbloque."')";
        $res = execReq($db,$req);
        if (mysqli_num_rows($res) > 0) {
          // L'utilisateur est banni
          $banni = true;
        }}
      else {
        $pseudo = $_SESSION['pseudo']; // Non -> On regarde son propre profil, sachant que notre pseudo est stocké en SESSION
      }
      $req = "SELECT * FROM Utilisateur u, Profil p WHERE (u.pseudo = '".$pseudo."') AND (u.idUser = p.idUser)";
      $res = execReq($db,$req);
      $row = mysqli_fetch_assoc($res);

      if (isset($_POST['new_pseudo'])) {
        // Si la condition est vérifiée, alors l'utilisateur est en train de modifier son propre profil.

        $id = $row['idUser'];
        $pseudo = $_POST['new_pseudo'];
        $_SESSION['pseudo'] = $pseudo;
        // On met à jour les variables et la session, et on récupère l'id

        $reqmodif1 = "UPDATE Utilisateur SET pseudo = '".$_POST['new_pseudo']."', mdp = '".$_POST['new_password']."' WHERE idUser ='".$id."'";
        $reqmodif2 = "UPDATE Profil SET nom = '".$_POST['new_nom']."', prenom = '".$_POST['new_prenom']."', mail = '".$_POST['new_email']."', adresse = '".$_POST['new_adresse']."', accueil = '".$_POST['new_accueil']."', citation = '".$_POST['new_citation']."', interet = '".$_POST['new_interet']."', sexe = '".$_POST['new_sexe']."' WHERE idUser = '".$id."'";
        $resmodif1 = execReq($db,$reqmodif1);
        $resmodif2 = execReq($db,$reqmodif2);
        // Changement des données

        $req = "SELECT * FROM Utilisateur u, Profil p WHERE (u.pseudo = '".$pseudo."') AND (u.idUser = p.idUser)";
        $res = execReq($db,$req);
        $row = mysqli_fetch_assoc($res);}
        // On refait une nouvelle recherche dans la base de données pour mettre à jour $row

    // On affiche ou pas le profil si l'utilisateur est bloqué/a bloqué ou pas.
    if (isset($banni)) {
      echo "<h1> L'utilisateur a été banni! </h1>";
      if ($_SESSION['droits']=='admin') {
        // Les admins peuvent débannir l'utilisateur.
        echo "<button value='".$pseudo."' class='btn' onclick='debanUser(this.value)'> Débannir l'utilisateur? </button>";}
    }
    else {
    if (isset($bloqueur)) {
      // Le bloqueur peut débloquer l'utilisateur.
      echo "<h1> Vous avez bloqué l'utilisateur! </h1>";
      echo "<button value='".$pseudo."' class='btn' onclick='debloqueUtilisateur(this.value)'> Débloquer l'utilisateur? </button>";
    }
    else {
      if ((isset($bloque))&&($_SESSION['droits']!=='admin')) {
        // Si l'utilisateur est bloqué, alors il ne peut pas voir le profil, sauf s'il est admin, dans ce cas il aura toujours accès au profil.
        echo "<h1> Vous avez été bloqué par l'utilisateur! </h1>";
      }
      else {
        // Affichage du pseudo.
    echo "<h2> Profil de ".$pseudo."</h2>";
    echo "<p id='msgaccueil'> Message d'accueil : ".$row['accueil']." </p>
    <p> Nom : ".$row['nom']." </p>
    <p> Prenom : ".$row['prenom']." </p>
    <p> E-mail : ".$row['mail']." </p>
    <p> Citation : ".$row['citation']." </p>
    <p> Centres d'intérets : ".$row['interet']." </p>
    <p> Sexe : ".$row['sexe']." </p>";
    ?>
   <!-- informations personelles, visible seulement par user + admin -->
   <?php if (($pseudo == $_SESSION['pseudo']) || ($_SESSION['droits'] == 'admin')) {
     echo "<p> Adresse : ".$row['adresse']." </p>";
     echo "<p> Mot de Passe : ".$row['mdp']." </p>";}
     echo "<input type='hidden' id='supp' value='".$pseudo."'>"; ?>

     

   <?php
   if ($pseudo !== $_SESSION['pseudo']) {
        echo "<button value='".$pseudo."' class='btn' onclick='bloqueUtilisateur(this.value)'> Bloquer l'utilisateur </button><br/><br>";}
   if (($pseudo == $_SESSION['pseudo']) || ($_SESSION['droits'] == 'admin')) { // Les boutons suivants sont seulement visibles par l'utilisateur du profil ou par l'admin
   echo "<button class='btn' onclick='Modif()'> Modifier le profil </button><br/><br>";
   echo "<button class='btn' onclick='supprimerProfil()'> Supprimer le profil </button><br/><br>";}

   // Les boutons suivants ne sont visibles que par les admins et s'ils s'ont sur un profil autre que le leur
   if ((isset($_GET['pseudo']))&&($_SESSION['droits'] == 'admin')) {
     echo "<button class='btn' value = '".$pseudo."' onclick='banUser(this.value)'> Bannir </button><br/><br>";
     $db = connect();
     $req = "SELECT droits FROM Utilisateur WHERE (pseudo = '".$pseudo."')";
     $res = execReq($db,$req);
     $row = mysqli_fetch_assoc($res);
     $droits = $row['droits'];
     echo "<button class='btn' value = '".$pseudo." ".$droits."' onclick='changeDroits(this.value)'>";
     if ($droits=='inscrit') {
       echo "Promouvoir en administrateur </button><br/><br>";
     }
     else {
       echo "Destituer en inscrit </button>";
     }
     }


   echo "<div id='modif'></div>
   </div>
   <div class='table'>
   <table>
     <thead>
       <tr>
         <th colspan = '2'> Meilleurs Scores </th>
       </tr>
     </thead>
     <tbody>";
         $query = "SELECT score FROM Score s, Utilisateur u WHERE (u.pseudo = '".$pseudo."') AND (u.idUser = s.idUser) ORDER BY score DESC";
         $resscore = execReq($db,$query);
         if (mysqli_num_rows($resscore) > 0) {
           $i = 0;
           while (($row = mysqli_fetch_assoc($resscore))&&($i < 10)) {
            // On affiche les 10 premiers meilleurs scores du joueur, ou on s'arrête plus tôt si le joueur en a moins de 10.
             $i = $i + 1;
             echo "<tr><td>".$i."</td><td>".$row['score']."</td></tr>";}}
         deconnect($db);
          }}}}
         ?>
     </tbody>
   </table>
   </div>

 </body>
 </html>
