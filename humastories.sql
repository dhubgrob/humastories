-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 09 nov. 2020 à 18:07
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `humastories`
--

-- --------------------------------------------------------

--
-- Structure de la table `stories`
--

CREATE TABLE `stories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `linked_content_title` varchar(255) NOT NULL,
  `linked_content_url` varchar(255) NOT NULL,
  `linked_content_img` varchar(255) NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `stories`
--

INSERT INTO `stories` (`id`, `title`, `heading`, `linked_content_title`, `linked_content_url`, `linked_content_img`, `id_user`, `created_at`) VALUES
(54, 'Les chiens', 'sciences', 'Chiens article', 'www.chiens.com', '', 14, '2020-10-28 17:18:11'),
(60, 'Le Front Populaire en 36', 'sciences', 'Une victoire historique ?', 'google.com', 'phppR86sn.jpeg', 15, '2020-11-05 08:06:29'),
(61, 'La fÃªte de l&#39;Huma', 'histoire', 'Site officiel de la fÃªte de l&#39;Huma', 'https://fete.humanite.fr/', 'phpD1hN04.jpeg', 16, '2020-11-05 08:32:44');

-- --------------------------------------------------------

--
-- Structure de la table `story_pages`
--

CREATE TABLE `story_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_story` int(10) UNSIGNED NOT NULL,
  `sub_id` int(10) UNSIGNED NOT NULL,
  `cover` tinyint(1) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` varchar(500) NOT NULL,
  `filename_background_img` varchar(255) NOT NULL,
  `size_background_img` varchar(100) NOT NULL,
  `credits_background_img` varchar(255) NOT NULL,
  `animation_background_img` varchar(100) NOT NULL,
  `animation_background_img_duration` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `size_position_text_block` varchar(100) NOT NULL,
  `animation_text_block` varchar(100) NOT NULL,
  `animation_text_block_duration` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `id_user` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `story_pages`
--

INSERT INTO `story_pages` (`id`, `id_story`, `sub_id`, `cover`, `title`, `body`, `filename_background_img`, `size_background_img`, `credits_background_img`, `animation_background_img`, `animation_background_img_duration`, `size_position_text_block`, `animation_text_block`, `animation_text_block_duration`, `id_user`) VALUES
(153, 54, 1, 0, 'Chien Page 1', 'Ouaf !', 'phpP8MpBq.jpg', 'cover', '', 'pan-left', 8, 'third-top', '', 1, 14),
(156, 54, 3, 0, 'Chien page 2', 'fghdfghdf', '', 'cover', '', '', 1, 'full-size', '', 1, 14),
(157, 54, 4, 0, 'Chien Page 3', '', '', 'cover', '', '', 1, 'full-size', '', 1, 14),
(158, 54, 5, 0, 'Chien Page 4', '', '', 'cover', '', '', 1, 'full-size', '', 1, 14),
(159, 54, 6, 0, 'Chien Page 5', '', '', 'cover', '', '', 1, 'full-size', '', 1, 14),
(160, 60, 1, 0, 'Le Front Populaire', 'Une victoire historique ??', 'phpSjBeSs.jpeg', 'contain', 'AFP', '', 10, 'third-top', '', 6, 15),
(161, 60, 2, 0, '36, accords Matignon', '', 'phpxgB1ls.jpeg', 'cover', '', '', 1, 'half-top', '', 1, 15),
(162, 60, 3, 0, 'et les occupations...', '', 'php65COVo.jpeg', 'cover', '', '', 1, 'third-bottom', 'fly-in-top', 10, 15),
(163, 60, 4, 0, 'Des temps troublÃ©s', 'Les ligues prospÃ¨rent.', 'php5Tgdut.jpeg', 'contain', '', '', 1, 'full-size', '', 1, 15),
(164, 61, 1, 0, 'La fÃªte de l&#39;Huma', 'Un Ã©vÃ©nement unique !', 'php5nVntc.jpeg', 'contain', '', 'rotate-in-right', 6, 'third-top', 'whoosh-in-left', 6, 16),
(165, 61, 2, 0, ' ', '', 'phpiFcyhB.png', 'cover', '', 'zoom-out', 10, 'full-size', '', 1, 16);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `hashed_password`, `created_at`) VALUES
(5, 'fchaillou', '$2y$10$x98slcfpT08IxEin8MJKOOL.SSN/BveFm.Bo2dyJ9IX6zKdhhxQ.S', '2020-10-22 13:43:45'),
(14, 'Nicolas', '$2y$10$Pdxl.FnFPylOIStZbnCHPeuJwGYPhDdOfONAqxCWgTATmeZh46Vw6', '2020-10-28 12:18:38'),
(15, 'John', '$2y$10$Z2k0gBcQ7D8cB5DGf6J54.n7WC3fDcS6/gpQVdTQCL.psh7YruJAW', '2020-11-05 08:04:49'),
(16, 'Audrey', '$2y$10$CW76emofvbXPFpHHTZ.B5OoeKieCuBaziZ1r0u5zEy62IgEJbiqzW', '2020-11-05 08:28:01');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `story_pages`
--
ALTER TABLE `story_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_story` (`id_story`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT pour la table `story_pages`
--
ALTER TABLE `story_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `stories_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `story_pages`
--
ALTER TABLE `story_pages`
  ADD CONSTRAINT `story_pages_ibfk_1` FOREIGN KEY (`id_story`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `story_pages_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
