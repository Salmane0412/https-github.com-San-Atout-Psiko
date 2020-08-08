-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 18 avr. 2020 à 21:04
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `psiko`
--
CREATE DATABASE IF NOT EXISTS `psiko` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `psiko`;

-- --------------------------------------------------------

--
-- Structure de la table `ecole`
--

CREATE TABLE `ecole` (
  `ecoleId` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `typeEcole` varchar(45) NOT NULL,
  `adminId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE `faq` (
  `idQuestion` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `reponse` text NOT NULL,
  `idRepondeur` int(11) NOT NULL,
  `langue` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`idQuestion`, `question`, `reponse`, `idRepondeur`, `langue`) VALUES
(7, 'Le gestionnaire ou l’administrateur auront-ils accès à toutes mes informations ?', 'Les gestionnaires et administrateurs auront accès aux données nécessaires pour le bon fonctionnement du site. Ils n\'auront par exemple pas accès à votre mot de passe en claire ni à votre mot de passe hashé.   ', -1, 'fr'),
(8, 'Comment choisir l’ordre des tests?', 'Non, pour l\'instant ce n\'est pas possible', -1, 'fr');

-- --------------------------------------------------------

--
-- Structure de la table `resultat_examen`
--

CREATE TABLE `resultat_examen` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `gestionnaireId` int(11) NOT NULL,
  `dateExamen` datetime NOT NULL,
  `freqCardiaque` float NOT NULL,
  `temperature` float NOT NULL,
  `memorisation` float NOT NULL,
  `reflexe` float NOT NULL,
  `tonalite` float NOT NULL,
  `boitierId` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE `ticket` (
  `idTicket` int(11) NOT NULL,
  `demandeurId` int(11) NOT NULL,
  `destinataireId` int(11) NOT NULL DEFAULT -1,
  `niveauProblem` varchar(45) NOT NULL DEFAULT 'Inconnu',
  `etatTicket` varchar(45) NOT NULL DEFAULT 'CREER',
  `Titre` varchar(255) NOT NULL,
  `contenue` varchar(45) NOT NULL,
  `reponse` longtext NOT NULL DEFAULT '',
  `dateEmission` datetime NOT NULL,
  `dateModification` datetime NOT NULL DEFAULT '1900-01-01 01:01:01',
  `cible` varchar(45) NOT NULL,
  `fichierSupplementaireLink` mediumtext NOT NULL DEFAULT '',
  `isArchive` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ticket`
--

INSERT INTO `ticket` (`idTicket`, `demandeurId`, `destinataireId`, `niveauProblem`, `etatTicket`, `Titre`, `contenue`, `reponse`, `dateEmission`, `dateModification`, `cible`, `fichierSupplementaireLink`, `isArchive`) VALUES
(7, 1, 1, 'Critique', 'Cloturé par l\'admin', 'cv wxc qsdffv', 'erffefzaerzaefazerrfazerfazeferaz', ' ##################################################################\r\n                        Réponse ajouter par ROUSSET-ROUVIERE Augustin\r\n                        Le : 2020-03-28 18:20:35\r\n                        ##################################################################\r\nFermerture du ticket par un administrateur\r\n ##################################################################\r\n                        Réponse ajouter par ROUSSET-ROUVIERE Augustin\r\n                        Le : 2020-03-28 18:24:26\r\n                        ##################################################################\r\nTicket rouvert\r\n ##################################################################\r\n                        Réponse ajouter par ROUSSET-ROUVIERE Augustin\r\n                        Le : 2020-03-28 18:43:29\r\n                        ##################################################################\r\nArray\r\n ##################################################################\r\n                        Réponse ajouter par ROUSSET-ROUVIERE Augustin\r\n                        Le : 2020-03-28 18:56:08\r\n                        ##################################################################\ntest 2\n ##################################################################\r\n                        Réponse ajouter par ROUSSET-ROUVIERE Augustin\r\n                        Le : 2020-03-28 18:56:33\r\n                        ##################################################################\n cvbnb,;:\n ##################################################################\r\n                        Réponse ajouter par ROUSSET-ROUVIERE Augustin\r\n                        Le : 2020-03-30 13:13:35\r\n                        ##################################################################\ntests de changement de niveau\n ##################################################################\r\n                        Réponse ajouter par ROUSSET-ROUVIERE Augustin\r\n                        Le : 2020-04-16 13:33:33\r\n                        ##################################################################\nFermerture du ticket par un administrateur\n ##################################################################\r\n                        Réponse ajouter par ROUSSET-ROUVIERE Augustin\r\n                        Le : 2020-04-18 01:18:36\r\n                        ##################################################################\nTicket rouvert\n ##################################################################\r\n                        Réponse ajouter par ROUSSET-ROUVIERE Augustin\r\n                        Le : 2020-04-18 01:18:37\r\n                        ##################################################################\nFermerture du ticket par un administrateur\n ##################################################################\r\n                        Réponse ajouter par ROUSSET-ROUVIERE Augustin\r\n                        Le : 2020-04-18 01:18:38\r\n                        ##################################################################\nTicket rouvert\n ##################################################################\r\n                        Réponse ajouter par ROUSSET-ROUVIERE Augustin\r\n                        Le : 2020-04-18 01:18:38\r\n                        ##################################################################\nFermerture du ticket par un administrateur\n ##################################################################\r\n                        Réponse ajouter par ROUSSET-ROUVIERE Augustin\r\n                        Le : 2020-04-18 01:18:39\r\n                        ##################################################################\nTicket rouvert\n ##################################################################\r\n                        Réponse ajouter par ROUSSET-ROUVIERE Augustin\r\n                        Le : 2020-04-18 01:18:40\r\n                        ##################################################################\nFermerture du ticket par un administrateur\n', '2020-03-26 19:53:18', '2020-04-18 01:18:40', 'admin', 'files-admin-tickets/Xf0OlDXmJOgMGbJ6ivSH.png files-admin-tickets/8nNgRxMMljBdk5tq6XMc.png   ', 1),
(8, 1, 1, 'Inconnu', 'Cloturé par l\'admin', 'iosdcjicoqsdjzsdpj', 'zdfazojfdlizejalkmfjzeklajfklzeajklfjazekljfn', ' ##################################################################\r\n                        Réponse ajouter par ROUSSET-ROUVIERE Augustin\r\n                        Le : 2020-04-18 01:18:42\r\n                        ##################################################################\nTicket rouvert\n ##################################################################\r\n                        Réponse ajouter par ROUSSET-ROUVIERE Augustin\r\n                        Le : 2020-04-18 01:18:42\r\n                        ##################################################################\nFermerture du ticket par un administrateur\n', '2020-03-26 19:54:37', '2020-04-18 01:18:42', 'admin', 'files-admin-tickets/jZ2scPkkP6piUAacxR9F.pdf ', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adresse` tinytext NOT NULL,
  `telephone` varchar(45) NOT NULL,
  `sexe` varchar(2) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateInscription` date NOT NULL,
  `birthday` date NOT NULL,
  `ecoleId` int(11) NOT NULL,
  `rang` varchar(45) NOT NULL,
  `valider` tinyint(1) DEFAULT NULL,
  `photoPicture` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `prenom`, `nom`, `email`, `adresse`, `telephone`, `sexe`, `password`, `dateInscription`, `birthday`, `ecoleId`, `rang`, `valider`, `photoPicture`) VALUES
(1, 'ROUSSET-ROUVIERE', 'Augustin', 'kagamijunichiro@vivaldi.net', '43 rue de verdun', '0768535491', 'H', '$2y$10$9pMIrG/2zDG/0mxF.3BnKOSAmZ3KkHrMjNHc6jdagCxd1jdUaR1Ua', '2020-03-24', '1999-07-04', 1, 'administrateur', 1, 'default'),
(2, 'Admin', 'AdminISEP', 'adminISEP@isep.fr', '43 rue de verdun', '0768535491', 'H', '$2y$10$RYTRh1it7tL2UZm9jRUUfe3qANoh.dnnCLIEFAPI4PaaV.n7wJr36', '2020-03-27', '1988-04-08', 1, 'utilisateur', 0, 'default');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ecole`
--
ALTER TABLE `ecole`
  ADD PRIMARY KEY (`ecoleId`);

--
-- Index pour la table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`idQuestion`);

--
-- Index pour la table `resultat_examen`
--
ALTER TABLE `resultat_examen`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`idTicket`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `faq`
--
ALTER TABLE `faq`
  MODIFY `idQuestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `resultat_examen`
--
ALTER TABLE `resultat_examen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `idTicket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
GRANT ALL PRIVILEGES ON *.* TO 'JunichiroKagami'@'%' IDENTIFIED BY PASSWORD '*D89149F6E9065E7F24BDED8A80CD9916C2997EAD' WITH GRANT OPTION;