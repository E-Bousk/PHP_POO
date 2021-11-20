-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 20 nov. 2021 à 14:53
-- Version du serveur :  5.7.33
-- Version de PHP : 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `demo_poo`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

CREATE TABLE `annonces` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actif` tinyint(1) NOT NULL DEFAULT '0',
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`id`, `titre`, `description`, `created_at`, `actif`, `users_id`) VALUES
(1, 'Titre de l\'annonce', 'Description de l\'annonce', '2021-11-01 00:00:00', 1, 2),
(2, 'Titre lorem', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum, nulla itaque! Repellat ipsa, cumque soluta asperiores quaerat doloribus non eum saepe voluptates reiciendis illo architecto dolorem obcaecati illum? Nisi, praesentium?', '2021-11-05 00:00:00', 1, 1),
(3, 'Nouannonce', 'Doloribus nemo laboriosam quibusdam ipsa natus, totam alias reiciendis adipisci, qui modi earum minus! Nulla excepturi, distinctio aliquam consequuntur magnam non, doloribus aliquid illo modi deserunt suscipit nisi. Labore, non.', '2021-11-15 13:51:29', 1, 1),
(4, 'Velle anno', 'Sit repellendus quidem doloribus assumenda architecto eius sapiente? Praesentium modi ea nisi quae cumque, in nostrum molestiae, fugit a non quia architecto facere perspiciatis commodi fuga temporibus nulla reiciendis! Ab!', '2021-11-15 13:52:01', 1, 1),
(5, 'Ngfle anigce', 'Tempore, fugit recusandae. Iusto minima distinctio tempora deserunt odit nihil, perferendis quam explicabo sint natus consequuntur, itaque corrupti rerum tenetur ducimus nam laboriosam a veniam. Quis quod harum incidunt porro.', '2021-11-15 13:52:02', 1, 1),
(6, 'ProblÃ¨me d\'apostrophe rÃ©solu', 'Maiores, explica\'bo reiciendis quas officiis obcaecati vitae perferendis? Omnis optio officiis nulla porro voluptatibus cumque laudantium totam accusamus?', '2021-11-15 13:54:33', 1, 1),
(7, 'Nouvelle annonce 2', 'Dignissimos numquam quibusdam eveniet pariatur unde tempore, temporibus quod ipsum molestias quos inventore, modi cum earum officia doloribus, fuga alias eaque. Praesentium odit inventore quis ratione commodi voluptatibus voluptates architecto?', '2021-11-15 13:58:37', 1, 1),
(8, 'Ajout par hydratation', 'On insert par une mÃ©thode d\'hydratation', '2021-11-15 14:34:32', 1, 1),
(9, 'Update', 'On modifie par la mÃ©thode UPDATE', '2021-11-15 14:34:45', 1, 2),
(10, 'Update 2', 'On modifie par la mÃ©thode UPDATE', '2021-11-15 14:35:12', 1, 2),
(11, 'Annonce modifiÃ©e', 'On modifie encore par la mÃ©thode UPDATE', '2021-11-15 14:35:14', 1, 2),
(14, 'Ajout par hydratation', 'On insert par une mÃ©thode d\'hydratation', '2021-11-15 15:15:12', 1, 2),
(15, 'Ajout par hydratation', 'On insert par une mÃ©thode d\'hydratation', '2021-11-15 15:15:25', 1, 2),
(16, 'Ajout par hydratation', 'On insert par une mÃ©thode d\'hydratation', '2021-11-15 15:15:25', 1, 2),
(17, 'Test titre annonce', ',hj,h,j;jh;hj;', '2021-11-19 19:38:07', 0, 1),
(18, 'Test titre annonce', 'dcscsdcdscds', '2021-11-19 19:40:55', 0, 1),
(19, 'Un titre de l\'annonce', 'dfffqsfqffqff', '2021-11-19 19:54:54', 0, 1),
(20, 'Un titre de l\'annonce', 'dsvdvsvqsdvdqsvvsq', '2021-11-19 20:00:11', 0, 1),
(21, 'Test titre annonce', 'dvsvqsv', '2021-11-19 20:00:40', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'email@email.com', '$argon2i$v=19$m=65536,t=4,p=1$ZlBYUmFhQURxWTNxMGU4eQ$EB3P608zVz4H3DxKRJyo9WatQcN6+3DlJhAZn273Nlk'),
(2, 'another_email@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$OWFjUC4zMGpRYjRtdTFyZg$Qd5J1ujtPgQxi122WXwd82NcMlcJHHDNnUAoUF2sgsg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `annonces_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
