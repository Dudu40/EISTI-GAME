<?php
session_start();
$pseudorecu = $_POST['pseudo'];
$pseudosend = $_SESSION['pseudo'];
// On récupère notre pseudo, stocké dans la session, et le pseudo de l'utilisateur avec lequel on veut communiquer.

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

// On récupère notre id et l'id du joueur associé à $pseudo.

$req = "SELECT * FROM Messages WHERE ((idSend = '".$idsend."') AND (idRecu = '".$idrecu."')) OR ((idSend = '".$idrecu."') AND (idRecu = '".$idsend."'))";
$res = execReq($db,$req);
// On récupère tous les messages que les deux joueurs ont échangés.
if (mysqli_num_rows($res) > 0) {
  while ($row = mysqli_fetch_assoc($res)) {
    $date = explode(" ",$row['datesend'])[0];
    $heure = explode(" ",$row['datesend'])[1];
    // On sépare la date et l'heure.
    if ($row['idSend']==$idsend) {
      $send = $pseudosend;
      $recu = $pseudorecu;
      $status = 'envoye';
      // Si on a envoyé le message, il apparait en vert et à droite de la fenêtre.
    }
    else {
      $send = $pseudorecu;
      $recu = $pseudosend;
      $status = 'recu';
      // Si on a recu le message, il apparait en bleu et à gauche de la fenêtre.
    }
    echo "<div class='message' name=$status>";
    if ($status=='envoye'){
      echo "<p class='user' name=$status>".$send."</p>";
    }
    else{
      echo "<p class='user' name=$status>".$send."</p>";
    }
    // On associe soit envoyé, soit recu au nom de chaque message pour le CSS.

    echo "<span class='msg' name=$status>".$row['texte']."</span>";
    // On renvoie le contenu du message.
    echo "<p class='heure' name=$status> le ".$date." à ".$heure."</p>";
    // Et la date à laquelle il a été envoyé.
    echo "</div>";

  }
}

echo "<div class='champtxt'><input type='text' id='message' placeholder='Message à envoyer...'> <button class='btn' id='msgbtn' value='".$pseudorecu."' onclick='sendMsg(this.value)'>Envoyer</button></div>";
// On génère une barre d'input pour que l'utilisateur puisse envoyer des messages, cliquer sur le bouton renvoie vers la fonction sendMsg() de fonctionsAJAX.js

deconnect($db);

?>
