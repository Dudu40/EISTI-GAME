<?php
require('fonctionsbdd.php');
$search = $_POST['search'];
$db = connect();
$req = "SELECT * FROM Utilisateur WHERE (pseudo LIKE '".$search."%')";
// On cherche tous les pseudos correspondant au mot clé.
$res = execReq($db,$req);
if (mysqli_num_rows($res) > 0) {
  while ($row = mysqli_fetch_assoc($res)) {
    echo "<option onclick='getLogs(this.value)'>".$row['pseudo']."</option>";
    // On renvoie une liste d'option à placer dans la liste déroulante.
  }
}
deconnect($db);
?>
