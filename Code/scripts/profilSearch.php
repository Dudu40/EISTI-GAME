<?php
require('fonctionsbdd.php');
// On récupère la variable.
$search = $_POST['search'];
$db = connect();
// On cherche tous les pseudos comportenant le string en recherche.
$req = "SELECT * FROM Utilisateur WHERE (pseudo LIKE '".$search."%')";
$res = execReq($db,$req);
if (mysqli_num_rows($res) > 0) {
  while ($row = mysqli_fetch_assoc($res)) {
    echo "<option onclick='gotoProfil(this)'>".$row['pseudo']."</option>";
    // On renvoie tous les pseudos obtenus sous forme d'option pour être mis dans la liste déroulante.
  }
}
deconnect($db);
?>
