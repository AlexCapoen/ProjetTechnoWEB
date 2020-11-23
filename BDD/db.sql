-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 23 nov. 2020 à 16:03
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quizzdb`
--
CREATE DATABASE IF NOT EXISTS `quizzdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `quizzdb`;

-- --------------------------------------------------------

--
-- Structure de la table `answer`
--

DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'answer identifier',
  `answer_text` varchar(255) NOT NULL COMMENT 'text of the answer',
  `is_valid_answer` tinyint(1) NOT NULL COMMENT 'valid answer for question',
  `answer_question_id` int(11) NOT NULL COMMENT 'question related',
  PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29502 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `answer`
--

INSERT INTO `answer` (`answer_id`, `answer_text`, `is_valid_answer`, `answer_question_id`) VALUES
(1, 'Le requin mako', 0, 1),
(2, 'Le requin fouet', 0, 1),
(3, 'Le requin renard', 1, 1),
(4, 'Le requin lame', 0, 1),
(5, '4', 1, 2),
(6, '6', 1, 2),
(7, '8', 1, 2),
(8, '10', 1, 2),
(9, '12', 1, 2),
(11, '900 000', 0, 4),
(12, '750 000', 1, 4),
(13, '500 000', 0, 4),
(14, '250 000', 0, 4),
(15, 'Le roi des rats', 0, 5),
(16, 'Le roi Soleil', 1, 5),
(17, 'Le roi FullStack', 0, 5),
(18, 'L\'ami des bêtes', 0, 5),
(19, 'Les conflits dans les balkans', 0, 6),
(20, 'La France veut reconquérir l\'Alsace et la Lorraine', 0, 6),
(21, 'Un dérapage de l\'empereur allemand sur les réseaux sociaux', 0, 6),
(22, 'L\'assassinat de l\'archiduc François Ferdinand à Sarajevo', 1, 6),
(24, 'Royaume-Uni', 1, 8),
(25, 'Italie', 0, 8),
(26, 'Japon', 0, 8),
(27, 'France', 1, 8),
(28, 'Etats-unis', 1, 8),
(29, 'Le Vatican', 0, 8),
(1515, '1515', 1, 7),
(29500, '29 500', 1, 3),
(29501, 'FAKE ANSWER', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'question_identification',
  `question_title` varchar(255) NOT NULL COMMENT 'title of the question',
  `question_quizz_id` int(11) NOT NULL COMMENT 'link question quizz',
  `question_input_type` varchar(255) NOT NULL COMMENT 'input of the question',
  PRIMARY KEY (`question_id`),
  KEY `question_quizz_id_fk` (`question_quizz_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`question_id`, `question_title`, `question_quizz_id`, `question_input_type`) VALUES
(1, 'Comment s\'appelle cette espèce de requin ?', 1, 'carform'),
(2, 'Combien d\'yeux peuvent avoir les araignées ?', 1, 'checkbox'),
(3, 'Combien de rhinocéros restent-ils en vie ?', 1, 'input'),
(4, 'De combien de mort sont responsables les moustiques chaque année ?', 1, 'radio'),
(5, 'Quel était le surnom de Louis XIV ?', 2, 'carform'),
(6, 'Quel est l\'évènement déclencheur de la 1ère guerre mondiale ?', 2, 'radio'),
(7, 'En quelle année s\'est déroulée la bataille de Marignan ?', 2, 'input'),
(8, 'Parmi ces pays lesquels sont considérés comme vainqueur de la seconde guerre mondiale ?', 2, 'checkbox');

-- --------------------------------------------------------

--
-- Structure de la table `quizz`
--

DROP TABLE IF EXISTS `quizz`;
CREATE TABLE IF NOT EXISTS `quizz` (
  `quizz_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Quizz Identifiant',
  `quizz_name` varchar(255) NOT NULL COMMENT 'Quizz name',
  PRIMARY KEY (`quizz_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `quizz`
--

INSERT INTO `quizz` (`quizz_id`, `quizz_name`) VALUES
(1, 'Animaux'),
(2, 'Histoire De France');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'user identifiant',
  `user_last_name` varchar(255) NOT NULL COMMENT 'user last name',
  `user_first_name` varchar(255) NOT NULL COMMENT 'user first name',
  `user_adress` longtext COMMENT 'user physical adress',
  `user_phone` varchar(255) DEFAULT NULL COMMENT 'user phone',
  `user_birthdate` datetime DEFAULT NULL,
  `user_password` varchar(255) NOT NULL COMMENT 'User Password',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `user_last_name`, `user_first_name`, `user_adress`, `user_phone`, `user_birthdate`, `user_password`) VALUES
(1, 'ROUX', 'Johan', 'jojo@yopmail.com', '0690546589', '2020-11-27 00:00:00', '$2y$10$mzxrR6EVfIs3tVIRANbVP.zK7JKLaqhsfCMEjNvgalT7qaWahQcaO'),
(2, 'yjyh', 'yhyèh', 'jpo@yopmail.com', '852', '2020-11-19 00:00:00', '$2y$10$hWvOq.rU3nEJS2co9K7tIeRSFleueWCU4PCg7dxs6LiKmGFN93Sta'),
(3, 'kjhgfd', 'lhhgr', 'yopam@yopmail.com', '21266', '2020-11-25 00:00:00', '$2y$10$mMslIMgoOL/Tta..llJUTePFJlnhlGayjfMzxxr7bMdfNLINhn/im');

-- --------------------------------------------------------

--
-- Structure de la table `user_answer`
--

DROP TABLE IF EXISTS `user_answer`;
CREATE TABLE IF NOT EXISTS `user_answer` (
  `user_answer_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User answer identifiant',
  `user_id` int(11) NOT NULL COMMENT 'user identifiant',
  `answer_id` int(11) NOT NULL COMMENT 'answer_id',
  `user_answer_date` timestamp NULL DEFAULT NULL COMMENT 'date of answer user',
  `user_answer_input` text COMMENT 'value to text and number input',
  PRIMARY KEY (`user_answer_id`),
  KEY `user_id_fk` (`user_id`),
  KEY `answer_id_fk` (`answer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_answer`
--

INSERT INTO `user_answer` (`user_answer_id`, `user_id`, `answer_id`, `user_answer_date`, `user_answer_input`) VALUES
(1, 1, 16, '2020-11-22 21:31:48', NULL),
(2, 1, 21, '2020-11-22 21:31:48', NULL),
(3, 1, 29501, '2020-11-22 21:31:48', '2000'),
(4, 1, 26, '2020-11-22 21:31:48', NULL),
(5, 1, 27, '2020-11-22 21:31:48', NULL),
(6, 1, 28, '2020-11-22 21:31:48', NULL),
(7, 1, 29, '2020-11-22 21:31:48', NULL),
(8, 1, 1, '2020-11-22 21:32:58', NULL),
(9, 1, 6, '2020-11-22 21:32:58', NULL),
(10, 1, 8, '2020-11-22 21:32:58', NULL),
(11, 1, 9, '2020-11-22 21:32:58', NULL),
(12, 1, 29501, '2020-11-22 21:32:58', '24769'),
(13, 1, 13, '2020-11-22 21:32:58', NULL),
(14, 1, 1, '2020-11-22 21:33:39', NULL),
(15, 1, 6, '2020-11-22 21:33:39', NULL),
(16, 1, 7, '2020-11-22 21:33:39', NULL),
(17, 1, 29501, '2020-11-22 21:33:39', '4222'),
(18, 1, 13, '2020-11-22 21:33:39', NULL),
(19, 1, 1, '2020-11-22 21:48:47', NULL),
(20, 1, 6, '2020-11-22 21:48:47', NULL),
(21, 1, 7, '2020-11-22 21:48:47', NULL),
(22, 1, 8, '2020-11-22 21:48:47', NULL),
(23, 1, 29501, '2020-11-22 21:48:47', '2555'),
(24, 1, 13, '2020-11-22 21:48:47', NULL),
(25, 3, 1, '2020-11-22 22:16:36', NULL),
(26, 3, 6, '2020-11-22 22:16:36', NULL),
(27, 3, 29501, '2020-11-22 22:16:36', '5'),
(28, 3, 13, '2020-11-22 22:16:36', NULL),
(29, 3, 3, '2020-11-22 23:25:57', NULL),
(30, 3, 5, '2020-11-22 23:25:57', NULL),
(31, 3, 6, '2020-11-22 23:25:57', NULL),
(32, 3, 7, '2020-11-22 23:25:57', NULL),
(33, 3, 8, '2020-11-22 23:25:57', NULL),
(34, 3, 9, '2020-11-22 23:25:57', NULL),
(35, 3, 29501, '2020-11-22 23:25:57', '9999'),
(36, 3, 13, '2020-11-22 23:25:57', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_quizz_id_fk` FOREIGN KEY (`question_quizz_id`) REFERENCES `quizz` (`quizz_id`);

--
-- Contraintes pour la table `user_answer`
--
ALTER TABLE `user_answer`
  ADD CONSTRAINT `answer_id_fk` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`answer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
