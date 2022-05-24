-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 16 sep. 2021 à 02:16
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `faso_chat`
--

-- --------------------------------------------------------

--
-- Structure de la table `amis`
--

CREATE TABLE `amis` (
  `id` int(255) NOT NULL,
  `id_amis` int(11) NOT NULL,
  `id_moi` int(11) NOT NULL,
  `nom_amis` varchar(255) NOT NULL,
  `prenom_amis` varchar(255) NOT NULL,
  `username_amis` varchar(255) NOT NULL,
  `staut_amis` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `amis`
--

INSERT INTO `amis` (`id`, `id_amis`, `id_moi`, `nom_amis`, `prenom_amis`, `username_amis`, `staut_amis`) VALUES
(4, 4, 1, 'zougrama', 'ali', 'ali', NULL),
(7, 2, 4, 'lompo', 'laurent', 'laurent', NULL),
(9, 2, 4, 'lompo', 'laurent', 'laurent', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `amis_confirmer`
--

CREATE TABLE `amis_confirmer` (
  `id` int(255) NOT NULL,
  `id_amis_confir` int(255) NOT NULL,
  `id_amis_avec` int(255) NOT NULL,
  `nom_amis_confir` varchar(255) NOT NULL,
  `prenom_amis_confir` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `amis_confirmer`
--

INSERT INTO `amis_confirmer` (`id`, `id_amis_confir`, `id_amis_avec`, `nom_amis_confir`, `prenom_amis_confir`) VALUES
(1, 1, 7, 'nikiema', 'marius'),
(2, 3, 1, 'zongo ', 'souleymane'),
(3, 2, 1, 'lompo', 'laurent'),
(4, 1, 4, 'nikiema', 'marius'),
(5, 7, 4, 'oueadraogo', 'ali'),
(6, 3, 4, 'zongo ', 'souleymane'),
(7, 6, 4, 'traore', 'mama'),
(8, 5, 1, 'ali', 'baba');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_personne` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `date_commentaire` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `id_article`, `id_personne`, `commentaire`, `date_commentaire`) VALUES
(1, 1, 1, 'oui tu a rasison merci a lui\r\n', '2021-09-15 23:25:06'),
(2, 1, 3, 'oui sa va ', '2021-09-15 23:27:18');

-- --------------------------------------------------------

--
-- Structure de la table `galerie`
--

CREATE TABLE `galerie` (
  `id` int(11) NOT NULL,
  `id_pers` int(11) NOT NULL,
  `image` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `galerie`
--

INSERT INTO `galerie` (`id`, `id_pers`, `image`) VALUES
(6, 3, 'IMG_20170626_183507.jpg'),
(7, 3, 'IMG__201709261__065844.jpg'),
(8, 3, 'IMG_20170304_222605.jpg'),
(9, 3, 'IMG_20170613_140127.jpg'),
(10, 1, 'dons-tissus.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE `messagerie` (
  `id` int(255) NOT NULL,
  `id_envoyeur` int(255) NOT NULL,
  `id_moi` int(255) NOT NULL,
  `message` text NOT NULL,
  `date_message` datetime NOT NULL,
  `lu` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `messagerie`
--

INSERT INTO `messagerie` (`id`, `id_envoyeur`, `id_moi`, `message`, `date_message`, `lu`) VALUES
(1, 1, 7, 'salut comment va tu marius', '2021-09-16 01:09:34', 0),
(2, 7, 1, 'oui ouedrago je vais tres bien', '2021-09-16 01:09:20', 0),
(3, 1, 3, 'salut a toi souley', '2021-09-16 01:09:03', 0),
(4, 1, 4, 'salut', '2021-09-16 01:09:13', 0),
(5, 3, 4, 'salut comment va tu', '2021-09-16 01:09:35', 0),
(6, 3, 4, 'salut', '2021-09-16 01:09:04', 0),
(7, 7, 1, 'coucou', '2021-09-16 01:09:27', 0),
(8, 1, 2, 'salut', '2021-09-16 01:09:53', 0),
(9, 6, 4, 'salut', '2021-09-16 01:09:29', 0),
(10, 5, 1, 'eqdfzers', '2021-09-16 01:09:07', 0),
(11, 5, 1, 'dsgrdf', '2021-09-16 01:09:51', 0);

-- --------------------------------------------------------

--
-- Structure de la table `mon_mur`
--

CREATE TABLE `mon_mur` (
  `id` int(255) NOT NULL,
  `mon_id` int(255) NOT NULL,
  `per_id` int(255) NOT NULL,
  `le_mur` text NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `mon_mur`
--

INSERT INTO `mon_mur` (`id`, `mon_id`, `per_id`, `le_mur`, `date`) VALUES
(1, 1, 7, 'le grand marius comment va tu', '2021-09-15'),
(2, 1, 5, 'salut', '2021-09-15');

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

CREATE TABLE `publication` (
  `id` int(11) NOT NULL,
  `nom_auteur` varchar(255) NOT NULL,
  `contenue` text NOT NULL,
  `illustration` varchar(255) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `publication`
--

INSERT INTO `publication` (`id`, `nom_auteur`, `contenue`, `illustration`, `date`) VALUES
(1, 'oueadraogo', 'merci a vous barak obama pour votre soutien a l\'afrique', 'obama.jpg', '2021-09-15'),
(2, 'souley', 'oui', '20180308_221244.jpg', '2021-09-15'),
(5, 'ali', 'souvenir de la premiere annee', 'IMG_20170724_094948.jpg', '2021-09-15'),
(6, 'baba', '\"rtgetdhfv', 'IMG_20170714_080205.jpg', '2021-09-15');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ville` varchar(60) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `jour` int(11) NOT NULL,
  `mois` varchar(10) NOT NULL,
  `annee` int(5) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmed_at` date DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `numero` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `username`, `email`, `ville`, `pays`, `jour`, `mois`, `annee`, `password`, `confirmed_at`, `images`, `numero`) VALUES
(1, 'nikiema', 'marius', 'marius', 'nikiemamarius1996@gmail.com', 'ouaga', 'burkina', 1, 'Janvier', 2000, '$2y$10$7QVtTaNRgpgFvZsri2fJ/O0PU2.nw9w5iBcKXmjX9KNdZ5r8431lC', '2021-09-15', '20180308_215816.jpg', 0),
(2, 'lompo', 'laurent', 'laurent', 'laurent@gmail.com', 'ouaga', 'burkina', 1, 'Janvier', 2011, '$2y$10$WEDfJrAHPiKRhwUimgXl1OlTQU6i.zVKUTg4ax7qxRey8mMsIgnfG', '2021-09-15', '20180308_225641.jpg', 0),
(3, 'zongo ', 'souleymane', 'souley', 'souley@gmail.com', 'ouaga', 'burkina', 1, 'Janvier', 2011, '$2y$10$40snF/ka1kKj90PMLAkcTebMrkgXUz6B8eG.EHAG9Hr7sX0qbahBS', '2021-09-15', 'IMG_20170724_094948.jpg', 0),
(4, 'zougrama', 'ali', 'ali', 'ali@gmail.com', 'ouaga', 'burkina', 1, 'Janvier', 2003, '$2y$10$FeOK67zYy29PUGC4A98f4.1JB62L.kfXQbbsVps8VhWjCzaVT6VVO', '2021-09-15', NULL, 0),
(5, 'ali', 'baba', 'baba', 'baba@gmail.com', 'dsezfc', 'burkina', 1, 'Janvier', 2011, '$2y$10$Ify3QJJiY.tG/6eYYsp44ev0l8IdaKoJIo/EeABZXr..zHdCdnCh2', '2021-09-15', 'IMG_20170628_110207.jpg', 0),
(6, 'traore', 'mama', 'mama', 'mama@gmail.com', 'ouaga', 'burkina', 1, 'Janvier', 2011, '$2y$10$eUnXv6ctIg.rKHm/NgQA4OKFeFyZQcqPyP863eqUXB4hFqUhYa95.', '2021-09-15', 'IMG__201709260__032815.jpg', 0),
(7, 'oueadraogo', 'ali', 'oueadraogo', 'oueadraogo@gmail.com', 'ouaga', 'burkina', 1, 'Avril', 1991, '$2y$10$9GrYdIGXE0lQtamAfJb13OvvHrRUantdce6ZKuJBssvRNzU04wlWO', '2021-09-15', 'IMG_20170613_140127.jpg', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `amis`
--
ALTER TABLE `amis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `amis_confirmer`
--
ALTER TABLE `amis_confirmer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `galerie`
--
ALTER TABLE `galerie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messagerie`
--
ALTER TABLE `messagerie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mon_mur`
--
ALTER TABLE `mon_mur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `amis`
--
ALTER TABLE `amis`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `amis_confirmer`
--
ALTER TABLE `amis_confirmer`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `galerie`
--
ALTER TABLE `galerie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `messagerie`
--
ALTER TABLE `messagerie`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `mon_mur`
--
ALTER TABLE `mon_mur`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `publication`
--
ALTER TABLE `publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
