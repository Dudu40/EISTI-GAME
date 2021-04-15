// longueur du terrain de jeu
var L=750;

// largeur du terrain de jeu
var l=750;

// cote du monstre (carre jaune)
var c=30;



// compteur
var compteur=0;

// score
var score=0;

// nombre total de monstre apparus
var nbTues=0;

// nombre de monstres qui apparaissent en meme temps
var nbSpawn=2;

// intervalle de temps entre chaque vagues d'ennemis
var tempsSpawn=150;

// deplacement de x tout les 10ms
var dx=0.9;
// deplacement de y tout les 10 ms
var dy=0.9;

// initialisation du tableau contenant chaque monstre
var tab= [];

var elements=[];

var finbool = false;

var boolMeilleurScore =false;

// classe monstre contenant la position du monstre et son nom

class Monstre {
  constructor(x,y,nom,color) {
    this.x = x;
    this.y = y;
    this.nom=nom;
    this.color=color;
  }
}

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

// on cache le plateau de jeu et l'affichage des stats pour affciher le bouton play
function cache () {
    document.getElementById('block').style.display="none";
    document.getElementById('stat').style.display="none";
    document.getElementById('Pause').style.display="none";
    document.getElementById('depassement').style.display="none";


}

// on initialise le plateau de jeu
function initialise() {

// on initalise la taille du plateau de jeu et on dessine le plateau
    canvas=document.getElementById("mycanvas");
    canvas.setAttribute("width",L);
    canvas.setAttribute("height",l);

     canvas=document.getElementById("mycanvas2");
    canvas.setAttribute("width",L);
    canvas.setAttribute("height",l);

    // on affiche la partie jeu avec le meilleur score
     document.getElementById('Pause').style.display="block";
    document.getElementById('block').style.display="block";

    // on desactive l'affichage du boutton play
    document.getElementById('intro').style.display="none";
}



// dessine l'element central (boulle rouge)
function drawElement () {

canvas=document.getElementById("mycanvas");

ctxFruit=canvas.getContext("2d");

ctxFruit.lineWidth="3";
ctxFruit.strokeStyle="black";

ctxFruit.beginPath();
    // cree une boulle de centre (x,y) de rayon 5
    ctxFruit.arc(L/2, l/2, 10, 0, Math.PI*2);
    // stock la couleur bleu
    ctxFruit.fillStyle = "red";
    // rempli de bleu
    ctxFruit.stroke();
    ctxFruit.fill();
// en instruction
ctxFruit.closePath();

}

// genere des coordonnées x et y aleatoirement sur la bordure du haut.
function genereCoordHaut () {

    monstre= new Monstre();

    // creer une coordonnée aleatoire
    monstre.x=Math.floor(Math.random() * (L-4*c))+2*c;
    monstre.y=0;
    return (monstre);

}

// genere des coordonnées x et y aleatoirement sur la bordure du bas.
function genereCoordBas () {
    monstre= new Monstre();

    // creer une coordonnée aleatoire en colonne
    monstre.x=Math.floor(Math.random() * (L-4*c))+2*c;
    monstre.y=l-c;


    return (monstre);

}

// genere des coordonnées x et y aleatoirement sur la bordure de Gauche.
function genereCoordGauche () {

    monstre= new Monstre();

    // creer une coordonnée aleatoire en colonne
    monstre.x=0;
    monstre.y=Math.floor(Math.random() * (l-4*c))+2*c;


    return (monstre);

}

// genere des coordonnées x et y aleatoirement sur la bordure de droite     .
function genereCoordDroite () {
    monstre= new Monstre();

    // creer une coordonnée aleatoire en colonne
    monstre.x=L-c;
    monstre.y=Math.floor(Math.random() * (l-4*c))+2*c;


    return (monstre);

}


// genere aleatoirement des coordonnées x et y en haut en bas a droite ou a gauche .
// les apparitions apparaissent a n'importe quel endroit sur les bords.
function genereCoord () {
    monstre= new Monstre();

    // on genere un nombre aleatoire entre 1 et 4
    nb=Math.floor(Math.random() * 4);

    // a chaque numero on definit une apparition de monstre differente
    switch (nb) {
        case 0 :
            monstre=genereCoordHaut();
        break;

        case 1 :
            monstre=genereCoordBas();
        break;

        case 2 :
            monstre=genereCoordDroite();
        break;

        case 3 :
            monstre=genereCoordGauche();
        break;
    }
    return (monstre);
}


// Initialise un monstre
function spawnMonstre () {

// on creer un nouveau monstre
monstre= new Monstre();

// On lui attribut des coordonnée aleatoire sur les bords
monstre=genereCoord();

// on lui donne un nom unique en accolant a son nom son numero d'apparition
monstre.nom="ctxMonstre"+nbTues;

nb=Math.floor(Math.random() * 8);

// attribut une couleur alatoire a un monstre
switch (nb) {
        case 0 :
            monstre.color = "orange";

        break;

        case 1 :
            monstre.color= "#ff7f50";

        break;

        case 2 :
            monstre.color = "pink";
        break;

        case 3 :
            monstre.color = "yellow";
        break;

         case 4 :
           monstre.color = "purple";
        break;

         case 5 :
            monstre.color= "#7CFC00";
        break;

         case 6 :
            monstre.color = "blue";
        break;

          case 7 :
            monstre.color = "aqua";
        break;
    }

return(monstre);

}

// ajoute un nombre definit de monstres dans le tableau
function spawnMonstres(){

    // on parcourt le tableau de monstres
    for (i=1;i<=nbSpawn;i++){

        // on initialise un monstre
        monstre=spawnMonstre();

        // on l'insere dans le tableau
        tab.length=tab.push(monstre);

    }
}
// on efface tout le plateau de jeu
function clear() {

canvas=document.getElementById("mycanvas");

ctxClear=canvas.getContext("2d");

ctxClear.clearRect(0, 0, L, l);

 }



// On dessine 1 monstre au cooordonne x et y du monstre
function drawMonstre (monstre) {

// on recupere l'id du plateau de jeu
canvas=document.getElementById("mycanvas");

// on cree un contexte2D  de non monstre.nom
monstre.nom=canvas.getContext("2d");

// on dessine le contour du monstre en noir
 monstre.nom.lineWidth="10";
monstre.nom.strokeStyle="black";

monstre.nom.beginPath();

    // on dessine le rectangle de cote c
    monstre.nom.rect(monstre.x,monstre.y,c,c);

    // on le colore en jaune

     monstre.nom.fillStyle =monstre.color;
    // rempli de bleu
    monstre.nom.stroke();
    monstre.nom.fill();
    monstre.nom.save();
// en instruction


}

// dessine tout les monstres tu tableau
function drawAllMonstre(tab){
    for (i=0;i<=tab.length-1;i++){
        drawMonstre(tab[i]);
    }

}

// gere les deplacements du monstre
function deplacement (monstre){

// si le monstre est du coté gauche de l'ecran on le rapproche du centre d'une distance dx
    if (monstre.x+c/2<=L/2) {
        monstre.x=monstre.x+dx;
    }

// si le monstre est du coté droit de l'ecran on le rapproche du centre d'une distance dx
    if (monstre.x+c/2>=L/2) {
        monstre.x=monstre.x-dx;
    }

// si le monstre est du coté haut de l'ecran on le rapproche du centre d'une distance dy
    if (monstre.y+c/2<=l/2) {

        monstre.y=monstre.y+dy;
    }

// si le monstre est du coté bas de l'ecran on le rapproche du centre d'une distance dy
    if (monstre.y+c/2>=l/2) {
        monstre.y=monstre.y-dy;
    }
    return(monstre);
}

// gere le deplacement de touts les monstres du tableau
function deplacementAllMonstre(tab){
    for (i=0;i<=tab.length-1;i++){
        tab[i]=deplacement(tab[i]);
    }
    return(tab);

}

// affiche le nombre de point gagne lorsqu'on tue un monstre sur un canvas transparent superposé
function affichePointPositif(x,y){

  var ctxPt = document.getElementById('mycanvas2').getContext('2d');

  ctxPt.font = '48px serif';
  ctxPt.fillStyle = "white";
  ctxPt.fillText('+100', x, y);
  setTimeout(function(){
        ctxPt.clearRect(0, 0, L, l);

  },200);
}

// affiche le nombre de point perdu lorsqu'on rate un monstre sur un canvas transparent superposé
function afficherPointNegatif(x,y){

    var ctxPt = document.getElementById('mycanvas2').getContext('2d');

  ctxPt.font = '48px serif';
  ctxPt.fillStyle = "red";
  ctxPt.fillText('- 50 ', x, y);
  setTimeout(function(){
        ctxPt.clearRect(0, 0, L, l);

  },200);

}

function depassementMeilleurScore(){
if (boolMeilleurScore==false){

  boolMeilleurScore=true;
  document.getElementById('depassement').style.display="block";

  setTimeout(function(){
  
          document.getElementById('depassement').style.display="none";

  },2000);

}

}


// lorsqu'on clique supprime le monstre selctionné et affiche les points gagne ou perdu
function actionClick(sourisX,sourisY){
    var val=true;
    var dessus=false;

    // on parcourt le tableau de monstres
   for (i=tab.length-1;i>=0;i--){

        // si la souris se situe pas sur un carre jaune
        if (!((sourisX<=tab[i].x+c) && (sourisX>=tab[i].x-c) && (sourisY<=tab[i].y+c) && (sourisY>=tab[i].y-c)) || ((tab[i].x+c/2>=L/2-c/2) && (tab[i].x+c/2<=L/2+c/2) && (tab[i].y+c/2>=l/2-c/2) && (tab[i].y+c/2<=l/2+c/2))){


          }
        else{
              dessus=true;
                if (val){
                    // on affiche les points positifs
                    affichePointPositif(sourisX,sourisY);
                    score=score+100;
                    // le nombre total de monstre augmente de 1 car un noveau monstre est apparu
                    nbTues=nbTues+1;
                    // on supprime le monstre a la bonne position du tableau
                    tab.splice(i,1);
                    val=false;
                }
            }

        }
       if (!dessus){
        // on affiche les points negatifs
        afficherPointNegatif(sourisX,sourisY);
        score=score-50;}
       }


// attribut une coordonnée a la position exacte cliquée si on est pas en pause
function Click(event){


    canvas=document.getElementById('mycanvas');

    canvas.onclick=function(event){

if (document.getElementById("Pause").name=="Pause"){
    sourisX = event.offsetX;
    sourisY = event.offsetY;
    actionClick(sourisX,sourisY);
    }
    else{
    alert("Reappuyez sur le bouton pause pour continuer");
    }
}

}

// requete ajax qui lis le score inscrit dans le fichier bestscore.txt
function updateScore() {
  var xhr = getXhr();
  xhr.onreadystatechange = function() {
  if (xhr.readyState == 4 && xhr.status == 200){
    document.getElementById('score2').innerHTML= xhr.responseText;
  }
}
 xhr.open("POST","./scripts/updateScore.php",true);
 xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
 xhr.send("score="+score);
 console.log('test');
}

// arrete le jeu lorqu'on perd
function fin (){

    // on parcourt le tableau de monstres
    for (i=0;i<=tab.length-1;i++){
        // si un monstre se trouve au centre
        if (((tab[i].x+c/2>=L/2-1) && (tab[i].x+c/2<=L/2) && (tab[i].y+c/2>=l/2-1) && (tab[i].y+c/2<=l/2))&&(finbool==false)){
            finbool = true;
            // on arrete le jeu
            clearInterval(time);

            // On update la BDD en fonction du score obtenu
            updateScore();

            // on desactive l'affichage du jeu
            // on affcihe les stats c'est a dire le  score et le nombre de monstres tués

             document.getElementById('block').style.display="none";
             document.getElementById('nbTotal2').innerHTML=nbTues;
             document.getElementById('stat').style.display="block";

        }


        }
}

// gere l'evolution de la difficulté du jeu

function modifConst(){

  // arrive a  10 monstres ca augmente de 1 monstre (ca apparait par 3)
    if ((nbTues==10) && (nbSpawn==2)){
    nbSpawn=nbSpawn+1;
        console.log("niveau 1");
           dx=dx+0.2;
        dy=dy+0.2;

    }

    // arrive a 20 monstres ca augmente de 1 monstre (ca apparait par 4)
    if ((nbTues>=20) && (nbSpawn==3)){
           nbSpawn=nbSpawn+1;
            dx=dx+0.2;
        dy=dy+0.2;
           console.log("niveau 2");
     }

// arrive a  50 monstres ca augmente de 1 monstre (ca apparait par 5)
     if ((nbTues>=40) && (nbSpawn==4)){
        nbSpawn=nbSpawn+1;
         dx=dx+0.2;
        dy=dy+0.2;
        console.log("niveau 3");
     }


// arrive a  100 monstres le temps d'apparition diminue de 50ms

     if ((nbTues>=60) && (nbSpawn==5) && (tempsSpawn>=449)){
        tempsSpawn=tempsSpawn-50;
        dx=dx+0.2;
        dy=dy+0.2;
        nbSpawn=nbSpawn+1;
        console.log("niveau 4 accecleration");
     }

// arrive a  200 monstres le temps d'apparition diminue de 50ms

     if ((nbTues>=80) && (nbSpawn==5) && (tempsSpawn>=399)){
        tempsSpawn=tempsSpawn-20;
        dx=dx+0.2;
        dy=dy+0.2;
        nbSpawn=nbSpawn+1;
        console.log("niveau 5");
     }

// arrive a  300 monstres le temps d'apparition diminue de 50ms
       if ((nbTues>=100) && (nbSpawn==5) && (tempsSpawn>=349)){
        tempsSpawn=tempsSpawn-20;
        nbSpawn=nbSpawn+1;
          console.log("niveau 6");
      }

        if ((nbTues>=120) && (nbSpawn==5) && (tempsSpawn>=299)){
        tempsSpawn=tempsSpawn-20;
        nbspawn=nbSpawn+1;
        console.log("niveau 7");}


}


function checkMeilleurScore(){


  var xhr = getXhr();
  xhr.onreadystatechange = function() {
  if (xhr.readyState == 4 && xhr.status == 200){ 
    res=xhr.responseText;
    document.getElementById("bestScore").innerHTML=res; 
    if ((score>res) && (res>0)){
      depassementMeilleurScore();
    }
  }
}
 xhr.open("POST","./scripts/checkMeilleurScore.php",true);
 xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
 xhr.send("score="+"A");
}



// echaine toutes les actions precdemments decrites
function draw (){

// si le score est divisble par le temps de spaw
    if (compteur%tempsSpawn==0){

        // on creer un nombre definit de monstre (2 au depart) dans un tableau
        spawnMonstres();

    }

    // on check si on doit augmenter le nombre d'apparition ou le temps d'apparition
        modifConst();

// on nettoite le plateau
        clear();

        // on dessine tout les monstres
        drawAllMonstre(tab);

        // on gere le deplacement de tout les monstres
        tab=deplacementAllMonstre(tab);

// on dessine l'element central
        drawElement();
        fin();

        // on augmente le score de 1 a chaque tour de boucle
        compteur=compteur+1;
        score=score+1;

           checkMeilleurScore();

       

// on affiche le score le meilleur score ainsi que le nombre de monstres tués
        document.getElementById('score1').innerHTML=score;
        // document.getElementById('bestScore').innerHTML=bestScore;

}




// lance le jeu
function jeu() {

    // initialise le jeu
    initialise();

    // lance la simulation en boucle toute mes 15ms
    draw();
    time =setInterval(draw,15);
}



// mets en pause le jeu lorqu'on clique sur le bouton pause

function pause(){

  currentvalue = document.getElementById('Pause').name;

  // mets en pause
  if(currentvalue == "Pause"){
    document.getElementById("Pause").name="Go";
    document.getElementById("Pause").src="./image/go.png"
    clearInterval(time);
  }
 else{
    // relance
    document.getElementById("Pause").name="Pause";
    document.getElementById("Pause").src="./image/pause.png"
    time =setInterval(draw,15);
  }
}
