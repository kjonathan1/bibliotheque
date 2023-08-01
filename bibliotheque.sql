-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 31 juil. 2023 à 11:18
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bibliotheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `resume` varchar(255) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `fichier` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id`, `titre`, `auteur`, `resume`, `categorie`, `fichier`) VALUES
(1, 'L\'enfant noir', 'Camara Laye', 'Ce roman raconte la vie d\'un jeune africain', 'Fiction', ''),
(2, 'Reflechissez et devener riche', 'Napoleon', '-', 'Drame', ''),
(3, 'Candide', 'Voltaire', '-', 'Bande dessinée', ''),
(4, 'Sous l\'orage', 'Seydou Badian Kouyaté', '-', 'Fiction', ''),
(5, 'rrr', 'rrr', 'rrr', 'gggg', ''),
(6, 'tests titre', 'teste auteur', 'test resumé', 'Bande dessinée', ''),
(7, 'tests titre', 'teste auteur', 'test resumé', 'Bande dessinée', ''),
(8, 'tests titre', 'teste auteur', 'test resumé', 'Bande dessinée', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
