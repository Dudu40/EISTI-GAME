function getXhr(){
var xhr = null;
if (window.XMLHttpRequest) // Firefox et autres
           xhr = new XMLHttpRequest();
else if(window.ActiveXObject){ // Internet Explorer< 7
        try {
      xhr = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
      xhr = new ActiveXObject("Microsoft.XMLHTTP") ;
        }
}
else{
    alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
          xhr = false;
}
return xhr;
}

// Fonctions pour connexion.php --------------------------------------------------------------------

// Vérifie si les identifiants entrés dans connexion.php sont les bons
function tryLogin() {
  var xhr = getXhr();
  // On récupère les identifiants entrés
  var pseudo = document.getElementById('pseudo').value;
  var mdp = document.getElementById('mdp').value;
  xhr.onreadystatechange = function() {
  if (xhr.readyState == 4 && xhr.status == 200){
     var reponse = xhr.responseText;
     if (reponse == "true") {
       // Les identifiants ont été confirmés, on renvoie vers le jeu.
       location.href = "jeu.php";
     }
     else { if (reponse == "false") {
              // L'utilisateur n'a pas donné les bons identifiants.
              document.getElementById('erreur').innerHTML = "Erreur de connexion! Vérifiez votre pseudo/mot de passe.";
     }
            else {
              // L'utilisateur a donné les bons identifiants, mais il est banni.
              document.getElementById('erreur').innerHTML = "Vous avez été banni! Contactez un admin pour être réintégré.";

     }}
  }
}
 xhr.open("POST","./scripts/login.php",true);
 xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
 xhr.send("pseudo="+pseudo+"&mdp="+mdp);
}

// Fonctions pour inscription.php --------------------------------------------------------------------

// Inscrit un nouvel utilisateur dans la BDD.
function newUser() {
  var xhr = getXhr();
  xhr.onreadystatechange = function() {
  if (xhr.readyState == 4 && xhr.status == 200){
    // Succès ou échéc?
     var reponse = xhr.responseText;
     // On donne le résultat dans le div dédié.
     document.getElementById('res').innerHTML = reponse;
     }}
 xhr.open("POST","./scripts/newUser.php",true);
 xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
 // On envoie toutes les variables données à newUser.php
 xhr.send("pseudo="+document.getElementById('pseudo').value+"&mdp="+document.getElementById('mdp').value+"&nom="+document.getElementById('nom').value+"&prenom="+document.getElementById('prenom').value+"&email="+document.getElementById('email').value+"&adresse="+document.getElementById('adresse').value);
}

// Fonctions pour profil.php --------------------------------------------------------------------

// Génère un fenêtre d'inputs pour permettre à l'utilisateur de changer ses infos.
function Modif() {
  document.getElementById('modif').innerHTML = "<br><form class='myform' method=post action=profil.php><div class='profilmodif'><p><label>Nouveau Nom :</label><input required type='text' name='new_nom' placeholder='nom'><br></p><p><label>Nouveau Prenom :</label><input required type='text' name='new_prenom' placeholder='prenom'><br></p><p><label>Nouveau Pseudo :</label><input required type='text' name='new_pseudo' placeholder='pseudo'><br></p><p><label>Nouveau Mot de passe :</label><input required type='password' name='new_password' placeholder='mot de passe'><br></p><p><label>Nouvel Email :</label><input required type='email' name='new_email' placeholder='exemple@email.com'><br></p><p><label>Nouvelle Adresse :</label><input required type='text' name='new_adresse' placeholder='adresse'><br></p><p><label>Nouveau accueil :</label><input required type='text' name='new_accueil' placeholder='accueil'><br></p><p><label>Nouvelle Citation :</label><input required type='text' name='new_citation' placeholder='citation'><br></p><p><label>Nouveaux intérets :</label><input required type='text' name='new_interet' placeholder='interet'><br></p><p><label>Nouveau sexe :</label><input required type='text' name='new_sexe' placeholder='sexe'><br></p><input type='submit' class='btn' value='Modifier mon compte'></form></div>"  
}

// Supprime le profil sur lequel on est.
function supprimerProfil() {
  var xhr = getXhr();
  var pseudo = document.getElementById('supp').value;
  // On récupère le pseudo en question.
  xhr.onreadystatechange = function() {
  if (xhr.readyState == 4 && xhr.status == 200){
    location.href = "connexion.php";
  }
}
 xhr.open("POST","./scripts/del_user.php",true);
 xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
 // On renvoie les données vers del_user.php.
 xhr.send("pseudo="+pseudo);
}

// Promouvoie en utilisateur en admin, ou le démote en inscrit.
// str : string contenant le pseudo et les droits de l'utilisateur, séparés par un espace.
function changeDroits(str) {
  var pseudo = (str.split(' '))[0];
  var droits = (str.split(' '))[1];
  // On récupère le pseudo et les droits de l'utilisateur depuis la variable en entrée.
  var xhr = getXhr();
  xhr.onreadystatechange = function() {
  if (xhr.readyState == 4 && xhr.status == 200){
    location.href = "profil.php?pseudo="+pseudo;
    // On recharge la page après l'opération.
  }
}
  xhr.open("POST","./scripts/changeDroits.php",true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
   // On renvoie les données vers changeDroits.php
  xhr.send("pseudo="+pseudo+"&droits="+droits);
}

// Bloque l'utilisateur
// pseudo : pseudo de l'utilisateur bloqué
function bloqueUtilisateur(pseudo) {
  var xhr = getXhr();
  xhr.onreadystatechange = function() {
  if (xhr.readyState == 4 && xhr.status == 200){
    location.href = "profil.php?pseudo="+pseudo;
    // On recharge la page après l'opération.
  }
}
  xhr.open("POST","./scripts/bloqueUtilisateur.php",true);
     // On renvoie les données vers bloqueUtilisateur.php
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
  xhr.send("pseudo="+pseudo);
}

// Débloque l'utilisateur
// pseudo : pseudo de l'utilisateur débloqué
function debloqueUtilisateur(pseudo) {
  var xhr = getXhr();
  xhr.onreadystatechange = function() {
  if (xhr.readyState == 4 && xhr.status == 200){
    location.href = "profil.php?pseudo="+pseudo;
    // On recharge la page après l'opération.
  }
}
  xhr.open("POST","./scripts/debloqueUtilisateur.php",true);
  // On renvoie les données vers debloqueUtilisateur.php
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
  xhr.send("pseudo="+pseudo);
}

// Bannit l'Utilisateur
// pseudo : pseudo de l'utilisateur à bannir.
function banUser(pseudo) {
  var xhr = getXhr();
  xhr.onreadystatechange = function() {
  if (xhr.readyState == 4 && xhr.status == 200){
    location.href = "profil.php?pseudo="+pseudo;
    // On recharge la page après l'opération.
  }
}
  xhr.open("POST","./scripts/banUser.php",true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
  xhr.send("pseudo="+pseudo);
}

// Débannit l'Utilisateur
// pseudo : pseudo de l'utilisateur à débannir.
function debanUser(pseudo) {
  var xhr = getXhr();
  xhr.onreadystatechange = function() {
  if (xhr.readyState == 4 && xhr.status == 200){
    location.href = "profil.php?pseudo="+pseudo;
    // On recharge la page après l'opération.
  }
}
  xhr.open("POST","./scripts/debanUser.php",true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
  xhr.send("pseudo="+pseudo);
}

// Fonctions pour joueurs.php --------------------------------------------------------------------

// Change la liste déroulante de joueurs en fonction de la recherche.
function profilUpdate() {
  var xhr = getXhr();
  var search = document.getElementById('search').value;
  xhr.onreadystatechange = function() {
  if (xhr.readyState == 4 && xhr.status == 200){
    var reponse = xhr.responseText;
    // On alimente la liste déroulante avec les noms obtenus en réponse.
    document.getElementById('listeProfils').innerHTML = reponse;}
  }
 xhr.open("POST","./scripts/profilSearch.php",true);
 xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
 xhr.send("search="+search);
}

// On renvoie vers le profil sélectionné en forcant une variable GET.
function gotoProfil(tempo){
  var pseudo = tempo.value;
  location.href = "profil.php?pseudo="+pseudo;
}

// Fonctions pour messagerie.php --------------------------------------------------------------------

// Fonction pour récupérer les messages échangés avec un utilisateur.
// pseudo : Pseudo du joueur avec lequel on voudrait vérifier les messages et communiquer.
function getLogs(pseudo) {
  var xhr = getXhr();
  xhr.onreadystatechange = function() {
  if (xhr.readyState == 4 && xhr.status == 200){
    var reponse = xhr.responseText;
    document.getElementById('logs').innerHTML = reponse;}
    // On remplit le div dédiée aux logs avec la réponse reçue.
  }
  xhr.open("POST","./scripts/getLogs.php",true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
  xhr.send("pseudo="+pseudo);
}

// Fonction pour envoyer un message.
function sendMsg(pseudo) {
  var msg = document.getElementById('message').value;
  var today = new Date();
  var date = today.getDate()+'/'+(today.getMonth()+1)+'/'+today.getFullYear()+" "+today.getHours() + ":" + today.getMinutes();
  // On récupère le contenu du message et la date.
  var xhr = getXhr();
  xhr.onreadystatechange = function() {
  if (xhr.readyState == 4 && xhr.status == 200){
    var reponse = xhr.responseText;
    getLogs(pseudo);}
    // On met à jour les logs pour que le message qu'on vient d'envoyer apparaisse
  }
  xhr.open("POST","./scripts/sendMsg.php",true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
  xhr.send("pseudo="+pseudo+"&msg="+msg+"&date="+date);
}

// Fonction pour la barre de recherche dans messagerie.php.
function messagerieUpdate() {
  var xhr = getXhr();
  var search = document.getElementById('search').value;
  // On récupère le mot clé que l'utilisateur cherche.
  xhr.onreadystatechange = function() {
  if (xhr.readyState == 4 && xhr.status == 200){
    var reponse = xhr.responseText;
    document.getElementById('listeProfils').innerHTML = reponse;}
    // On modifie la liste déroulante avec les utilisateurs correspondant au mot clé cherché.
  }
 xhr.open("POST","./scripts/messagerieSearch.php",true);
 xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
 xhr.send("search="+search);
}
