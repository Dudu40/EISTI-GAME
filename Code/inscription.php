<!DOCTYPE html>
<html lang ="fr">
  	<head>
	  	<meta charset="utf-8">
	  	<title>Inscription</title>
	  	<link rel="stylesheet" type="text/css" href="general.css"/>
	  	<link rel="stylesheet" type="text/css" href="inscription.css"/>
      <script type="text/javascript" src="./scripts/fonctionsAJAX.js"></script>
  	</head>
	<body>
	<h1>Inscription</h1>

	<div class="basediv">
    <!-- On génère plusieurs input pour l'utilisateur. -->
		<p>
		<label>Nom : </label>
			<input required type="text" name="nom" id="nom" placeholder="nom"><br/><br>
		</p>
		<p>
		<label>prenom : </label>
			<input required type="text" name="prenom" id="prenom" placeholder="prenom"><br/><br>
		</p>
		<p>
		<label>Pseudo : </label>
			<input required type="text" id="pseudo" name="pseudo" placeholder="pseudo"><br/><br>
		</p>
		<p>
		<label>Mot de passe :</label>
			<input required type="password" id="mdp" name="password" placeholder="mot de passe"><br/><br>
		</p>
		<p>
		<label>Email : </label>
			<input required type="email" id="email" name="email" placeholder="exemple@exmail.com"><br/><br>
		</p>
		<p>
		<label>Adresse : </label>
			<input required type="text" id="adresse" class="ok" name="adresse" placeholder="adresse"><br/><br>
		</p>
    <!-- Bouton de confirmation, déclenche la fonction newUser() dans ./scripts/fonctionsAJAX.js -->
			<button onclick='newUser()' class="btn" id="btncreation" name='connexion'> Créer mon compte </button>
		</form>
		<a href="connexion.php" class="link" id="retour">retour</a>
    <!-- Affiche le résultat de l'inscription, succès ou échéc. -->
    <div id='res'>
    </div>
	</div>

	</body>
</html>
