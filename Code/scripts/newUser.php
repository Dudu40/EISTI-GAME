<?php
require('fonctionsbdd.php');
// On récupère toutes les variables données.
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$pseudo = $_POST['pseudo'];
$email = $_POST['email'];
$mdp = $_POST['mdp'];
$adresse = $_POST['adresse'];

$db = connect();

// On vérifie que les variables essentielles à l'inscription on bien été données.
if (($pseudo != "")&&($mdp != "")) {
// On vérifie que le pseudo n'a pas encore été pris.
$req = "SELECT * FROM Utilisateur WHERE (pseudo='".$pseudo."')";
$res = execReq($db,$req);
if (mysqli_num_rows($res) == 0) {

  // Si le pseudo n'est pas pris, on commence l'inscription.

  $reqins = "INSERT INTO Utilisateur(pseudo,mdp,droits) VALUES ('".$pseudo."','".$mdp."','inscrit')";
  $resultins = execReq($db,$reqins);

  // On inscrit l'utilisateur sur la BDD, on génère ainsi son id

  $reqid = "SELECT idUser FROM Utilisateur WHERE (pseudo = '".$pseudo."') AND (mdp = '".$mdp."')";
  $resultid = execReq($db,$reqid);
  if (mysqli_num_rows($resultid) > 0) {
    while ($row = mysqli_fetch_assoc($resultid)) {
      $id = $row['idUser'];
    }
  }
  // On récupère l'id du nouvel utilisateur

  $reqprof = "INSERT INTO Profil(idUser,nom,prenom,mail,adresse) VALUES ('".$id."','".$nom."','".$prenom."','".$email."','".$adresse."')";
  $resultprof = execReq($db,$reqprof);
  // On entre les données de l'utilisateur dans Profil, avec l'id correspondante.
  echo "Bien inscrit!";}
else {
  // Si le pseudo est déjà pris, on renvoie un message d'échec sans faire d'opérations.
  echo "Le pseudonyme est déjà pris!";
}}
else {
  // Si l'utilisateur n'a pas donné de pseudo ou de mot de passe, on renvoie un message d'échec sans faire d'opérations.
  echo "Entrez au moins un pseudo et un mot de passe!";
}
?>
