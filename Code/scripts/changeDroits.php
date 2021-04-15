<?php
$pseudo = $_POST['pseudo'];
$droits = $_POST['droits'];

require('fonctionsbdd.php');
$db = connect();

// Si l'utilisateur est un admin, on le démote en inscrit.
if ($droits=="admin") {
  $req = "UPDATE Utilisateur SET droits = 'inscrit' WHERE (pseudo = '".$pseudo."')";
}
else {
  // Vice versa, on promouvoie l'utilisateur en admin.
  $req = "UPDATE Utilisateur SET droits = 'admin' WHERE (pseudo = '".$pseudo."')";
}

$res = execReq($db,$req);
?>
