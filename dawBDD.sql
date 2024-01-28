-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 09 mai 2023 à 05:45
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `daw`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_cours`
--

CREATE TABLE `t_cours` (
  `id_cours` int(11) NOT NULL,
  `groupe` int(11) NOT NULL,
  `nom_cours` varchar(200) NOT NULL,
  `difficulte` varchar(200) NOT NULL,
  `contenu_cours` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_cours`
--

INSERT INTO `t_cours` (`id_cours`, `groupe`, `nom_cours`, `difficulte`, `contenu_cours`) VALUES
(3, 2, 'PDO', 'intermédiaire', 'Bien pour manipuler les BDD et faire le Model'),
(4, 3, 'Pointeurs', 'difficile', 'Pas facile, j\'ai pas raison ??? '),
(14, 1, 'Variables', 'facile', 'Les variables sont les suivantes\r\n\r\n\r\n-int\r\n-float\r\n-boolean\r\n-char\r\n-String\r\n\r\n\r\nVoila vous savez tout'),
(25, 4, 'Bases', 'facile', 'Nouveau cours');

-- --------------------------------------------------------

--
-- Structure de la table `t_groupe_cours`
--

CREATE TABLE `t_groupe_cours` (
  `id_groupe` int(11) NOT NULL,
  `nom_groupe` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_groupe_cours`
--

INSERT INTO `t_groupe_cours` (`id_groupe`, `nom_groupe`) VALUES
(1, 'Java'),
(2, 'PHP'),
(3, 'C++'),
(4, 'C');

-- --------------------------------------------------------

--
-- Structure de la table `t_media`
--

CREATE TABLE `t_media` (
  `id_media` int(11) NOT NULL,
  `lien` varchar(255) DEFAULT NULL,
  `id_cours` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_message`
--

CREATE TABLE `t_message` (
  `id_message` int(11) NOT NULL,
  `user_source` int(11) DEFAULT NULL,
  `user_target` int(11) DEFAULT NULL,
  `citation` int(11) DEFAULT NULL,
  `topic` int(11) NOT NULL,
  `contenu_mess` text NOT NULL,
  `date_poste` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_message`
--

INSERT INTO `t_message` (`id_message`, `user_source`, `user_target`, `citation`, `topic`, `contenu_mess`, `date_poste`) VALUES
(13, 2, NULL, NULL, 9, 'Salut, ça va ?', '2023-04-16 20:13:19'),
(14, 1, 2, 13, 9, 'Salut, comment ça va ?', '2023-04-16 20:44:20'),
(15, 2, 1, 14, 9, 'Ça va bien, merci ! Et toi ?', '2023-04-16 20:44:21'),
(16, 1, 2, 13, 9, 'Moi aussi ça va bien', '2023-04-16 20:44:22'),
(17, 3, 1, 14, 10, 'Bonjour tout le monde !', '2023-04-16 20:44:23'),
(18, 1, 3, 17, 10, 'Salut, bienvenue sur le forum !', '2023-04-16 20:44:34'),
(19, 1, NULL, NULL, 11, 'test m', '2023-05-01 14:14:42'),
(20, 1, NULL, NULL, 11, 'stp', '2023-05-01 14:34:18'),
(21, 1, NULL, NULL, 11, 'encore une fois \r\navec tab\r\n', '2023-05-01 14:34:32'),
(22, 1, NULL, NULL, 11, 'saut<br />\r\nde <br />\r\nligne', '2023-05-01 14:35:53'),
(23, 1, NULL, NULL, 13, 'ihuoi', '2023-05-05 00:40:54'),
(25, 1, NULL, NULL, 15, 'oui', '2023-05-05 01:02:18'),
(28, 1, NULL, NULL, 15, 'vas', '2023-05-05 01:12:27'),
(29, 1, NULL, NULL, 9, 'Salut !', '2023-05-05 01:27:34'),
(34, 6, NULL, NULL, 19, 'Le match de fou', '2023-05-05 01:48:24'),
(36, 6, NULL, NULL, 19, '????', '2023-05-05 01:48:47'),
(38, 4, NULL, NULL, 11, 'Mais ça marche là ?', '2023-05-08 20:53:57');

-- --------------------------------------------------------

--
-- Structure de la table `t_niveau`
--

CREATE TABLE `t_niveau` (
  `id_niveau` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `cours` int(11) NOT NULL,
  `niveau` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_niveau`
--

INSERT INTO `t_niveau` (`id_niveau`, `user`, `cours`, `niveau`) VALUES
(14, 1, 4, 'facile'),
(15, 4, 4, 'intermédiaire');

-- --------------------------------------------------------

--
-- Structure de la table `t_qcm`
--

CREATE TABLE `t_qcm` (
  `id_qcm` int(11) NOT NULL,
  `diffi` varchar(200) NOT NULL,
  `cours` int(11) NOT NULL,
  `nom_fichier` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_qcm`
--

INSERT INTO `t_qcm` (`id_qcm`, `diffi`, `cours`, `nom_fichier`) VALUES
(3, 'difficile', 3, 'qcm3.xml'),
(4, 'facile', 4, 'qcm4.xml'),
(5, 'facile', 14, 'qcm14.xml'),
(6, 'facile', 24, 'qcm24.xml'),
(7, 'intermédiaire', 25, 'qcm25.xml');

-- --------------------------------------------------------

--
-- Structure de la table `t_role`
--

CREATE TABLE `t_role` (
  `id_role` int(11) NOT NULL,
  `nom_role` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_role`
--

INSERT INTO `t_role` (`id_role`, `nom_role`) VALUES
(1, 'administrateur'),
(2, 'étudiant');

-- --------------------------------------------------------

--
-- Structure de la table `t_topic`
--

CREATE TABLE `t_topic` (
  `id_topic` int(11) NOT NULL,
  `titre_topic` varchar(200) NOT NULL,
  `etat` varchar(200) NOT NULL,
  `date_derniere_maj` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_topic`
--

INSERT INTO `t_topic` (`id_topic`, `titre_topic`, `etat`, `date_derniere_maj`, `date_creation`) VALUES
(9, 'Questions sur les boucles en Python', 'ouvert', '2023-04-16 20:44:05', '2023-04-16 21:55:17'),
(10, 'Problèmes de compréhension sur l\'héritage', 'ouvert', '2023-04-16 20:44:05', '2023-04-16 21:55:17'),
(11, 'Pourquoi les pointeurs ça marche jamais ?', 'ferme', '2023-04-16 20:44:05', '2023-04-16 21:55:17'),
(15, 'test', 'ouvert', '2023-05-05 01:02:18', '2023-05-05 01:02:18'),
(17, 'Salut çava la team ????', 'ouvert', '2023-05-05 01:47:25', '2023-05-05 01:47:25'),
(19, 'ça bug ici nan ?', 'ouvert', '2023-05-05 01:48:24', '2023-05-05 01:48:24');

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

CREATE TABLE `t_user` (
  `id_user` int(11) NOT NULL,
  `mail` varchar(200) NOT NULL,
  `id_role` int(11) NOT NULL,
  `mdp` varchar(200) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `anniv` varchar(12) NOT NULL,
  `age` int(3) NOT NULL,
  `bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_user`
--

INSERT INTO `t_user` (`id_user`, `mail`, `id_role`, `mdp`, `pseudo`, `anniv`, `age`, `bio`) VALUES
(1, 'admin@example.com', 1, 'motdepasse', 'Adminio', '23/07', 31, 'Je suis l\'admin ici ok ?'),
(2, 'johndoe@example.com', 1, 'motdepasse', 'pseudo2', '', 0, ''),
(3, 'janedoe@example.com', 1, 'motdepasse', 'pseudo3', '', 0, ''),
(4, 'bob@example.com', 2, 'motdepasse', 'pseudo4', '', 0, ''),
(5, 'alice@example.com', 2, 'motdepasse', 'pseudo5', '', 0, ''),
(6, 'ronanleconqueran@mail.ru', 1, 'mdp', 'Ronandinio', '', 0, '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_cours`
--
ALTER TABLE `t_cours`
  ADD PRIMARY KEY (`id_cours`),
  ADD KEY `fk_T_groupe_cours` (`groupe`);

--
-- Index pour la table `t_groupe_cours`
--
ALTER TABLE `t_groupe_cours`
  ADD PRIMARY KEY (`id_groupe`);

--
-- Index pour la table `t_media`
--
ALTER TABLE `t_media`
  ADD PRIMARY KEY (`id_media`),
  ADD KEY `id_cours` (`id_cours`);

--
-- Index pour la table `t_message`
--
ALTER TABLE `t_message`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `fk_T_message_user_soucre` (`user_source`),
  ADD KEY `fk_T_message_user_target` (`user_target`),
  ADD KEY `fk_T_message_citation` (`citation`),
  ADD KEY `fk_T_message_topic` (`topic`);

--
-- Index pour la table `t_niveau`
--
ALTER TABLE `t_niveau`
  ADD PRIMARY KEY (`id_niveau`),
  ADD KEY `fk_T_niveau_user` (`user`),
  ADD KEY `fk_T_niveau_cours` (`cours`);

--
-- Index pour la table `t_qcm`
--
ALTER TABLE `t_qcm`
  ADD PRIMARY KEY (`id_qcm`);

--
-- Index pour la table `t_role`
--
ALTER TABLE `t_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Index pour la table `t_topic`
--
ALTER TABLE `t_topic`
  ADD PRIMARY KEY (`id_topic`);

--
-- Index pour la table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `uc_T_user_mail` (`mail`),
  ADD KEY `fk_T_user_id_role` (`id_role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_cours`
--
ALTER TABLE `t_cours`
  MODIFY `id_cours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `t_groupe_cours`
--
ALTER TABLE `t_groupe_cours`
  MODIFY `id_groupe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `t_media`
--
ALTER TABLE `t_media`
  MODIFY `id_media` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_message`
--
ALTER TABLE `t_message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `t_niveau`
--
ALTER TABLE `t_niveau`
  MODIFY `id_niveau` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `t_qcm`
--
ALTER TABLE `t_qcm`
  MODIFY `id_qcm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `t_role`
--
ALTER TABLE `t_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `t_topic`
--
ALTER TABLE `t_topic`
  MODIFY `id_topic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_media`
--
ALTER TABLE `t_media`
  ADD CONSTRAINT `t_media_ibfk_1` FOREIGN KEY (`id_cours`) REFERENCES `t_cours` (`id_cours`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
