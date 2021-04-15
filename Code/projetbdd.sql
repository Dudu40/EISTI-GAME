--- On supprime les tables si elles existent déjà. Pour éviter les conflits, on supprime toutes les tables utilisant une clé étrangère d'abord, puis les tables possédant la clé primaire

DROP TABLE IF EXISTS Bannis;
DROP TABLE IF EXISTS Bloques;
DROP TABLE IF EXISTS Messages;
DROP TABLE IF EXISTS Profil;
DROP TABLE IF EXISTS Score;
DROP TABLE IF EXISTS Utilisateur;

--
-- Structure de la table 'Utilisateurs'
-- idUser : clé primaire utilisée dans les autres tables pour référencer l'utilisateur
-- Pseudo : Pseudo de l'user
-- mdp : Mot de passe de l'user
-- droits : Inscrit, ou admin? L'admin possède plus d'autorisations que l'inscrit
--

CREATE TABLE  Utilisateur (
  idUser int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  pseudo varchar(30) NOT NULL,
  mdp varchar(30) NOT NULL,
  droits varchar(20) NOT NULL);

  --
  -- Structure de la table 'Bannis'
  -- idBanni : id de l'user banni, il ne pourra plus se connecter avant d'être débanni par un admin
  --

CREATE TABLE Bannis (
  idBanni int(11),
  CONSTRAINT pk_Banni FOREIGN KEY (idBanni) REFERENCES Utilisateur(idUser)
);

--
-- Structure de la table 'Bloques'
-- idBloqueur : L'id de l'user qui a bloqué l'autre.
-- idBloque : L'id de l'user qui a été bloqué par l'autre.
--

CREATE TABLE  Bloques` (
  `idBloqueur` int(11) DEFAULT NULL,
  `idBloque` int(11) DEFAULT NULL,
  CONSTRAINT `pk_Blo_Use_Bloqueur` FOREIGN KEY (`idBloqueur`) REFERENCES `Utilisateur` (`idUser`),
  CONSTRAINT `pk_Blo_Use_Bloque` FOREIGN KEY (`idBloque`) REFERENCES `Utilisateur` (`idUser`));


  --
  -- Structure de la table 'Bloques'
  -- idSend : L'id de l'user qui a envoyé le message.
  -- idRecu : L'id de l'user qui a reçu le message.
  -- texte : Le contenu du message.
  -- datesend : L'heure et la date à laquelle le message a été envoyé.
  --

CREATE TABLE  `Messages` (
  `idSend` int(11) DEFAULT NULL,
  `idRecu` int(11) DEFAULT NULL,
  `texte` varchar(240) DEFAULT NULL,
  `datesend` varchar(20) DEFAULT NULL,
  CONSTRAINT `pk_Mes_Use_Send` FOREIGN KEY (`idSend`) REFERENCES `Utilisateur` (`idUser`),
  CONSTRAINT `pk_Mes_Use_Recu` FOREIGN KEY (`idRecu`) REFERENCES `Utilisateur` (`idUser`));

  --
  -- Structure de la table 'Profil'
  -- idUser : L'id de l'user a qui appartient le profil.
  -- nom, prenom, ..., sexe : Variables explicites.
  --

CREATE TABLE  `Profil` (
  `idUser` int(11) DEFAULT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `mail` varchar(30) DEFAULT NULL,
  `accueil` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `citation` varchar(50) DEFAULT NULL,
  `interet` varchar(30) DEFAULT NULL,
  `sexe` varchar(20) DEFAULT NULL,
  CONSTRAINT `pk_Pro_Use` FOREIGN KEY (`idUser`) REFERENCES `Utilisateur` (`idUser`));

  --
  -- Structure de la table 'Profil'
  -- idUser : L'id de l'user qui a obtenu le score.
  -- score : Explicite.
  --

CREATE TABLE  `Score` (
  `idUser` int(11) DEFAULT NULL,
  `score` int(30) DEFAULT NULL,
  CONSTRAINT `pk_Sco_Use` FOREIGN KEY (`idUser`) REFERENCES `Utilisateur` (`idUser`));

  --
  -- On génère un admin par défaut, avec pour pseudo et mot de passe "test", on génère aussi son profil pour éviter les conflits, car à l'inscription, un utilisateur est crée avec un profil.
  --

INSERT INTO Utilisateur(idUser,pseudo,mdp,droits) VALUES ('1','test','test','admin');
INSERT INTO Profil(idUser) VALUES ('1');
