<?php
session_start();
$pseudorecu = $_POST['pseudo'];
$msg = $_POST['msg'];
$date = $_POST['date'];
$pseudosend = $_SESSION['pseudo'];

require('fonctionsbdd.php');
$db = connect();

$req = "SELECT idUser FROM Utilisateur WHERE (pseudo = '".$pseudorecu."')";
$res = execReq($db,$req);
if (mysqli_num_rows($res) > 0) {
  while ($row = mysqli_fetch_assoc($res)) {
    $idrecu = $row['idUser'];
  }
}

$req = "SELECT idUser FROM Utilisateur WHERE (pseudo = '".$pseudosend."')";
$res = execReq($db,$req);
if (mysqli_num_rows($res) > 0) {
  while ($row = mysqli_fetch_assoc($res)) {
    $idsend = $row['idUser'];
  }
}

// On récupère l'id de l'utilisateur, qui envoie le message, et l'id de l'utilisateur qui va le recevoir

echo $date;
$req = "INSERT INTO Messages (idSend,idRecu,texte,datesend) VALUES ('".$idsend."','".$idrecu."','".$msg."','".$date."')";
$res = execReq($db,$req);
deconnect($db);
// On rajoute le message à la BDD avec le contenu et la date.
?>
