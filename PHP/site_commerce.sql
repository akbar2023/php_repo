-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 29 août 2018 à 16:49
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `site_commerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(3) NOT NULL,
  `id_membre` int(3) DEFAULT NULL,
  `montant` int(3) NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  `etat` enum('en cours de traitement','envoyé','livré') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

CREATE TABLE `details_commande` (
  `id_details_commande` int(3) NOT NULL,
  `id_commande` int(3) DEFAULT NULL,
  `id_produit` int(3) DEFAULT NULL,
  `quantite` int(3) NOT NULL,
  `prix` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(3) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(32) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` enum('m','f') NOT NULL,
  `ville` varchar(20) NOT NULL,
  `code_postal` int(5) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `statut` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `ville`, `code_postal`, `adresse`, `statut`) VALUES
(1, 'akbar', '23', 'KHAN', 'akbar', 'akbar.khan@lepoles.com', 'm', 'Bondy', 93140, '211  av Gallieni ', 1),
(2, 'akbar2', '22', 'KHAN', 'akbar', 'akbar.khan@lepoles.com', 'm', 'Bondy', 93140, '12 av mlk', 0),
(3, 'akbar20', 'aaaaaaaaaa0', 'KHAN', 'akbar', 'akbar.khan@lepoles.com', 'm', 'Bondy', 93140, '22 av j jaurs', 0),
(4, 'abdul latif', 'aaaaaaaaaa', 'KHAN', 'kkhan', 'akbar.khan@lepoles.com', 'm', 'Bondy', 93140, 'sylhet bahdqx', 0);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(3) NOT NULL,
  `reference` varchar(20) NOT NULL,
  `categorie` varchar(20) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `couleur` varchar(20) NOT NULL,
  `taille` varchar(5) NOT NULL,
  `public` enum('m','f','mixte') NOT NULL,
  `photo` varchar(250) NOT NULL,
  `prix` float NOT NULL,
  `stock` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `reference`, `categorie`, `titre`, `description`, `couleur`, `taille`, `public`, `photo`, `prix`, `stock`) VALUES
(1, 'Pantalon', 'jean', 'pantalon blanc', 'jean', 'blanc', 'S', 'm', 'photo/Pantalon_pantalon2.jpg', 50, 20),
(2, 'pull', 'pull', 'pull blanc', 'pull blanc', 'blanc', 'S', 'm', 'photo/pull_pull1.jpg', 30, 200),
(3, 'robe', 'femme', 'robe', 'robe orange', 'orange', 'S', 'f', 'photo/robe_robe2.jpg', 20, 200),
(4, 'Pantalon', 'jean', 'kaporal jeans', 'blanc', 'blanc', 'S', 'm', 'photo/Pantalon_pantalon2.jpg', 100, 20),
(5, 'Pantalon', 'jean', 'kaporal jeans', 'blanc', 'blanc', 'S', 'm', 'photo/Pantalon_pantalon2.jpg', 100, 20),
(6, 'pull', 'pull', 'pull blanc', 'pull blanc', 'blanc', 'S', 'm', 'photo/pull_pull1.jpg', 30, 200),
(7, 'robe', 'femme', 'robe', 'robe orange', 'orange', 'S', 'f', 'photo/robe_robe2.jpg', 20, 200),
(8, 'Pantalon', 'jean', 'pantalon blanc', 'jean', 'blanc', 'S', 'm', 'photo/Pantalon_pantalon2.jpg', 50, 20),
(9, 'pull', 'pull', 'pull blanc', 'pull blanc', 'blanc', 'S', 'm', 'photo/pull_pull1.jpg', 30, 200),
(10, 'robe', 'femme', 'robe', 'robe orange', 'orange', 'S', 'f', 'photo/robe_robe2.jpg', 20, 200),
(11, 'Pantalon', 'jean', 'kaporal jeans', 'blanc', 'blanc', 'S', 'm', 'photo/Pantalon_pantalon2.jpg', 100, 20),
(12, 'Pantalon', 'jean', 'kaporal jeans', 'blanc', 'blanc', 'S', 'm', 'photo/Pantalon_pantalon2.jpg', 100, 20),
(13, 'pull', 'pull', 'pull blanc', 'pull blanc', 'blanc', 'S', 'm', 'photo/pull_pull1.jpg', 30, 200),
(14, 'robe', 'femme', 'robe', 'robe orange', 'orange', 'S', 'f', 'photo/robe_robe2.jpg', 20, 200);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`);

--
-- Index pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD PRIMARY KEY (`id_details_commande`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD UNIQUE KEY `id_produit` (`id_produit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `details_commande`
--
ALTER TABLE `details_commande`
  MODIFY `id_details_commande` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
