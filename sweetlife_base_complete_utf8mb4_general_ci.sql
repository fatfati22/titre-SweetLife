-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2026 at 01:05 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 COLLATE utf8mb4_general_ci */;

--
-- Database: `sweetlife`
--

CREATE DATABASE IF NOT EXISTS `sweetlife` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sweetlife`;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `user_humeur`;
DROP TABLE IF EXISTS `repas`;
DROP TABLE IF EXISTS `note`;
DROP TABLE IF EXISTS `exercice`;
DROP TABLE IF EXISTS `citation`;
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `humeur`;
DROP TABLE IF EXISTS `type_repas`;
DROP TABLE IF EXISTS `categorie`;
SET FOREIGN_KEY_CHECKS = 1;

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Entrée'),
(2, 'Plat principal'),
(3, 'Dessert'),
(4, 'Boisson'),
(5, 'Snack');

-- --------------------------------------------------------

--
-- Table structure for table `citation`
--

CREATE TABLE `citation` (
  `id` int NOT NULL,
  `texte` text NOT NULL,
  `auteur` varchar(100) DEFAULT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_humeur` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exercice`
--

CREATE TABLE `exercice` (
  `id` int NOT NULL,
  `video` varchar(255) DEFAULT NULL,
  `titre` varchar(150) NOT NULL,
  `description` text,
  `duree` int DEFAULT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_humeur` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercice`
--

INSERT INTO `exercice` (`id`, `video`, `titre`, `description`, `duree`, `date_creation`, `id_humeur`) VALUES
(1, 'respiration_5min.mp4', 'Respiration profonde', 'Exercice simple de respiration pour se calmer et réduire le stress.', 5, '2026-06-26 09:00:00', 5),
(2, 'marche_active.mp4', 'Marche active', 'Marche dynamique pour retrouver de l’énergie sans matériel.', 20, '2026-06-26 09:10:00', 2),
(3, 'etirement_dos.mp4', 'Étirement du dos', 'Séance douce pour détendre le dos et les épaules.', 10, '2026-06-26 09:20:00', 7),
(4, 'yoga_calme.mp4', 'Yoga calme', 'Postures faciles pour relâcher les tensions et améliorer la respiration.', 15, '2026-06-26 09:30:00', 5),
(5, 'hiit_debutant.mp4', 'HIIT débutant', 'Petite séance cardio avec mouvements simples et pauses régulières.', 12, '2026-06-26 09:40:00', 2),
(6, 'gainage.mp4', 'Gainage express', 'Renforcement du centre du corps avec planche et variantes faciles.', 8, '2026-06-26 09:50:00', 6),
(7, 'danse_joie.mp4', 'Danse bonne humeur', 'Enchaînement léger et amusant pour améliorer l’humeur.', 10, '2026-06-26 10:00:00', 2),
(8, 'relaxation_soir.mp4', 'Relaxation du soir', 'Routine lente pour se détendre avant de dormir.', 12, '2026-06-26 10:10:00', 7),
(9, 'boxe_colere.mp4', 'Boxe anti-colère', 'Mouvements de boxe sans contact pour évacuer la colère.', 15, '2026-06-26 10:20:00', 4),
(10, 'mobilite_matin.mp4', 'Mobilité du matin', 'Réveil articulaire doux pour commencer la journée.', 7, '2026-06-26 10:30:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `humeur`
--

CREATE TABLE `humeur` (
  `id` int NOT NULL,
  `icone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nom` varchar(50) NOT NULL,
  `theme` varchar(200) NOT NULL,
  `couleur_haut` varchar(50) NOT NULL,
  `couleur_bas` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `humeur`
--

INSERT INTO `humeur` (`id`, `icone`, `nom`, `theme`, `couleur_haut`, `couleur_bas`) VALUES
(1, '🗣️', 'Bavard', 'bavard', '#f8e8f0', '#bc375e'),
(2, '😊', 'Heureux', 'joie', '#fff9e6', '#ffb347'),
(3, '😢', 'Triste', 'tristesse', '#e8ecf0', '#7096b8'),
(4, '😡', 'En colère', 'colere', '#f5e8e8', '#b22222'),
(5, '😌', 'Calme', 'calme', '#e8f5f0', '#5aaa8a'),
(6, '😰', 'Stressé', 'stress', '#e0f0ff', '#3a86ff'),
(7, '😴', 'Fatigué', 'fatigue', '#eeeeee', '#aaaaaa');

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `id` int NOT NULL,
  `description` text NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`id`, `description`, `date_creation`, `id_user`) VALUES
(1, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', '2026-06-16 10:35:34', 7),
(2, 'xccvccccccccccccccc', '2026-06-16 10:36:42', 11),
(3, 'xccvccccccccccccccc', '2026-06-16 10:37:14', 11),
(4, 'ccccccccccccccccccccccccccccccccccc', '2026-06-16 10:37:21', 11),
(5, '\"test\"', '2026-06-16 10:38:24', 10),
(6, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', '2026-06-16 10:39:28', 7),
(7, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', '2026-06-16 10:40:29', 7),
(8, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', '2026-06-16 10:40:55', 7),
(9, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', '2026-06-16 10:41:01', 7),
(10, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', '2026-06-16 10:41:19', 7),
(11, 'bonjouur', '2026-06-16 10:41:50', 7),
(12, 'test', '2026-06-16 10:42:19', 7),
(13, 'ccccccccccccccccccccccccccccccccccc', '2026-06-16 10:45:17', 11),
(14, 'ccccccccccccccccccccccccccccccccccc', '2026-06-16 10:46:37', 11),
(15, 'je suis en colère', '2026-06-16 10:48:13', 11),
(16, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbb', '2026-06-16 12:06:59', 7),
(17, 'cccccccccccccccc', '2026-06-16 12:16:01', 7),
(18, 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '2026-06-16 12:18:10', 7),
(19, 'dddddddddddddddddddddddddddddddd', '2026-06-16 12:28:21', 10),
(20, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2026-06-16 12:35:27', 7),
(21, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2026-06-16 12:35:34', 7),
(22, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbb', '2026-06-17 10:17:22', 7),
(23, 'ddddddddddddddddddddd', '2026-06-24 23:47:29', 11),
(24, 'ffffffffffffffffffffffffff', '2026-06-24 23:58:53', 11),
(25, 'ffffffffffffffffffffffffffffffffffffffffff', '2026-06-24 23:59:57', 11),
(26, 'dddddddddddddd', '2026-06-25 00:02:31', 11),
(27, 'vvvvvvvvvvvv', '2026-06-25 00:21:43', 11),
(28, 'fffffffffffffffffffffffffff', '2026-06-25 00:21:51', 11),
(29, 'dddddddddddd', '2026-06-25 00:24:01', 11),
(30, 'juhiuuio', '2026-06-25 00:28:25', 11),
(31, 'knjjnoi,', '2026-06-25 00:28:29', 11),
(32, 'ccccc', '2026-06-25 00:29:37', 11),
(33, 'fffffffffffffffffffff', '2026-06-25 00:32:39', 11),
(34, 'ffffffffffffffffffffff', '2026-06-25 00:32:44', 11),
(35, 'ddddddddddddd', '2026-06-25 00:33:13', 11),
(36, 'dddddddddd', '2026-06-25 00:33:16', 11),
(37, 'ffffffffff', '2026-06-25 00:33:19', 11),
(38, 'jnhjihinih', '2026-06-25 00:46:02', 11),
(39, 'ffffffffffffff', '2026-06-25 01:40:20', 11),
(40, 'ffffffffffffffffff', '2026-06-25 01:42:49', 11),
(41, 'dddddddddddd', '2026-06-25 14:55:38', 11),
(42, 'vvvvvvvvvvvvvvvvvvvvv', '2026-06-25 16:10:08', 11),
(43, 'vvvvvvvvvvvvvvvvvvvvvvvv', '2026-06-25 16:10:11', 11),
(44, 'ddddddddddddddddd', '2026-06-26 12:32:12', 11),
(45, 'ddddddddddddddddddddddddd', '2026-06-26 12:32:35', 11),
(46, 'dddddddddddddddddddddd', '2026-06-26 12:32:41', 11),
(47, 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', '2026-06-26 12:33:28', 11),
(48, 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', '2026-06-26 12:34:37', 11),
(49, 'wwwwwwwwwwwwwwwwwwwwwwwww', '2026-06-26 12:34:54', 11),
(50, 'xxxxxxxxxxxxxx', '2026-06-26 12:37:17', 11),
(51, 'aaaaaaaaaaaaaaaaaaaaaa', '2026-06-26 14:52:11', 11),
(52, 'ddddddddddddd', '2026-06-26 15:04:14', 11);

-- --------------------------------------------------------

--
-- Table structure for table `repas`
--

CREATE TABLE `repas` (
  `id` int NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `titre` varchar(150) NOT NULL,
  `description` text,
  `duree` int DEFAULT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_humeur` int NOT NULL,
  `id_type` int NOT NULL,
  `id_categorie` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `repas`
--

INSERT INTO `repas` (`id`, `photo`, `titre`, `description`, `duree`, `date_creation`, `id_humeur`, `id_type`, `id_categorie`) VALUES
(15, 'salade.jpg', 'Salade de quinoa', 'Salade fraîche au quinoa, légumes croquants et citron.', 20, '2026-06-11 13:59:13', 5, 2, 2),
(32, 'omelette_epinards.jpg', 'Omelette aux épinards', 'Omelette légère aux épinards frais et fromage.', 15, '2026-06-11 14:01:17', 2, 1, 2),
(34, 'photo.png', 'Smoothie banane fraise', 'Boisson fraîche avec banane, fraise et lait.', 8, '2026-06-16 08:22:43', 2, 1, 4),
(35, 'toast_avocat.jpg', 'Toast avocat', 'Pain complet avec avocat, citron et graines.', 10, '2026-06-16 08:30:00', 5, 1, 1),
(36, 'soupe_legumes.jpg', 'Soupe de légumes', 'Soupe chaude aux carottes, courgettes et pommes de terre.', 30, '2026-06-26 11:00:00', 3, 3, 1),
(37, 'poulet_riz.jpg', 'Poulet au riz', 'Plat équilibré avec poulet grillé, riz et légumes.', 35, '2026-06-26 11:10:00', 2, 2, 2),
(38, 'pates_tomate.jpg', 'Pâtes sauce tomate', 'Pâtes simples avec sauce tomate maison et basilic.', 25, '2026-06-26 11:20:00', 5, 3, 2),
(39, 'yaourt_fruits.jpg', 'Yaourt aux fruits', 'Yaourt nature avec fruits frais et miel.', 5, '2026-06-26 11:30:00', 7, 4, 5),
(40, 'salade_poulet.jpg', 'Salade de poulet', 'Salade complète avec poulet, laitue, tomate et maïs.', 18, '2026-06-26 11:40:00', 6, 2, 2),
(41, 'riz_legumes.jpg', 'Riz aux légumes', 'Riz sauté avec légumes colorés et sauce légère.', 22, '2026-06-26 11:50:00', 5, 7, 2),
(42, 'crepes.jpg', 'Crêpes légères', 'Crêpes simples à servir avec fruits ou miel.', 20, '2026-06-26 12:00:00', 2, 5, 3),
(43, 'infusion_camomille.jpg', 'Infusion camomille', 'Boisson chaude relaxante pour le soir.', 5, '2026-06-26 12:10:00', 5, 4, 4),
(44, 'wrap_thon.jpg', 'Wrap au thon', 'Wrap rapide avec thon, salade, tomate et fromage frais.', 12, '2026-06-26 12:20:00', 6, 2, 2),
(45, 'bol_proteine.jpg', 'Bol riche en protéines', 'Bol avec œufs, quinoa, légumes et sauce yaourt.', 20, '2026-06-26 12:30:00', 2, 10, 2),
(46, 'pommes_cannelle.jpg', 'Pommes à la cannelle', 'Dessert doux avec pommes chaudes et cannelle.', 15, '2026-06-26 12:40:00', 3, 5, 3);


-- --------------------------------------------------------

--
-- Table structure for table `type_repas`
--

CREATE TABLE `type_repas` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type_repas`
--

INSERT INTO `type_repas` (`id`, `nom`) VALUES
(1, 'Petit déjeuner'),
(2, 'Déjeuner'),
(3, 'Dîner'),
(4, 'Collation'),
(5, 'Dessert'),
(6, 'Végétarien'),
(7, 'Végétalien'),
(8, 'Sans gluten'),
(9, 'Faible en glucides'),
(10, 'Riche en protéines');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `naissance` date NOT NULL,
  `mail` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_inscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `naissance`, `mail`, `password`, `date_inscription`, `role`) VALUES
(1, 'boudabbous', 'fatma', '2000-09-13', 'bdbbs2000@gmail.com', '$2y$10$NgFOF/69rX/BIASO2ip42eTsHtNoinWtqJoAuAHWGWyC80ikl6hAK', '2026-05-27 11:45:44', 'admin'),
(2, 'fatma', 'fati', '2000-09-13', 'fati25ans@gmail.com', '$2y$10$DCyQk1ybrQ39QkrqKlOFQepxLJHZnLgKuf3da46e.blzRk5pEwXTq', '2026-05-28 07:36:03', 'utilisateur'),
(4, 'fatma', 'fati', '2000-09-13', 'admin@gmail.com', '$2y$10$taJLKYs9KGQ1icrwMWVi3O4fjf7oqQmWjUife1wfOmd3TSw7CvOTK', '2026-05-28 07:38:00', 'admin'),
(6, 'cyprien', 'cyprien', '2000-09-13', 'adminc@gmail.com', '$2y$10$EsPmDoooDy9iVg8UjMsQSOmOqbG8fom5ljXBQLWXwY1heBVWh1Dky', '2026-06-01 12:53:12', 'admin'),
(7, 'amdouni ', 'soumaya ', '2000-09-13', 'soumi@gmail.com', '$2y$10$e49c.6QI8JU4AnqGh5eGUuovGZUXiOlqpl5X6O0uWHVEkONk9qkCu', '2026-06-04 11:45:41', 'admin'),
(9, 'fatma', 'fati', '2000-06-09', 'fati25ansss@gmail.com', '$2y$10$dTIyx/LoaSWAdWj0S96CXOW/BWLT3LoTnJOd4hL6Ptv.onvkFybyC', '2026-06-09 10:39:06', 'admin'),
(10, 'boudabbous', 'fatma', '2000-06-09', 'admin@aaa.com', '$2y$10$ozY5dmSOcb0YMUkcMvIVN.Nf0fqQFdYu/2RupLHH/qTD5Uo0.FAWi', '2026-06-15 11:59:14', 'admin'),
(11, 'boudabbous', 'fatma', '2000-06-09', 'b@b.com', '$2y$10$HDBIcot8cdMnnVHfOoY88.kkkOgr5gY2hGU6gqIoWWo1Xq20YYGDe', '2026-06-15 12:14:38', 'utilisateur');

-- --------------------------------------------------------

--
-- Table structure for table `user_humeur`
--

CREATE TABLE `user_humeur` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_humeur` int NOT NULL,
  `date_enregistrement` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_humeur`
--

INSERT INTO `user_humeur` (`id`, `id_user`, `id_humeur`, `date_enregistrement`) VALUES
(1, 1, 1, '2026-06-11 08:00:00'),
(2, 2, 2, '2026-06-11 09:00:00'),
(3, 4, 3, '2026-06-11 10:00:00'),
(4, 6, 4, '2026-06-11 11:00:00'),
(5, 7, 5, '2026-06-11 12:00:00'),
(6, 9, 6, '2026-06-11 13:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `citation`
--
ALTER TABLE `citation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_humeur` (`id_humeur`);

--
-- Indexes for table `exercice`
--
ALTER TABLE `exercice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_humeur` (`id_humeur`);

--
-- Indexes for table `humeur`
--
ALTER TABLE `humeur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `note_ibfk_1` (`id_user`);

--
-- Indexes for table `repas`
--
ALTER TABLE `repas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_humeur` (`id_humeur`),
  ADD KEY `id_type` (`id_type`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- Indexes for table `type_repas`
--
ALTER TABLE `type_repas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indexes for table `user_humeur`
--
ALTER TABLE `user_humeur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_humeur` (`id_humeur`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `citation`
--
ALTER TABLE `citation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exercice`
--
ALTER TABLE `exercice`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `humeur`
--
ALTER TABLE `humeur`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `repas`
--
ALTER TABLE `repas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `type_repas`
--
ALTER TABLE `type_repas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_humeur`
--
ALTER TABLE `user_humeur`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `citation`
--
ALTER TABLE `citation`
  ADD CONSTRAINT `citation_ibfk_1` FOREIGN KEY (`id_humeur`) REFERENCES `humeur` (`id`);

--
-- Constraints for table `exercice`
--
ALTER TABLE `exercice`
  ADD CONSTRAINT `exercice_ibfk_1` FOREIGN KEY (`id_humeur`) REFERENCES `humeur` (`id`);

--
-- Constraints for table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `repas`
--
ALTER TABLE `repas`
  ADD CONSTRAINT `repas_ibfk_1` FOREIGN KEY (`id_humeur`) REFERENCES `humeur` (`id`),
  ADD CONSTRAINT `repas_ibfk_2` FOREIGN KEY (`id_type`) REFERENCES `type_repas` (`id`),
  ADD CONSTRAINT `repas_ibfk_3` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`);

--
-- Constraints for table `user_humeur`
--
ALTER TABLE `user_humeur`
  ADD CONSTRAINT `user_humeur_ibfk_2` FOREIGN KEY (`id_humeur`) REFERENCES `humeur` (`id`),
  ADD CONSTRAINT `user_humeur_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
