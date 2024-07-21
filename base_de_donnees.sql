-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum`;

-- Listage de la structure de table forum. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `nameCategory` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.category : ~6 rows (environ)
INSERT INTO `category` (`id_category`, `nameCategory`) VALUES
	(16, 'Technologie'),
	(17, 'Santé et Bien-être'),
	(18, 'Voyage'),
	(19, 'Loisirs et Hobbies'),
	(20, 'Éducation et Carrière');

-- Listage de la structure de table forum. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  `topic_id` int DEFAULT NULL,
  PRIMARY KEY (`id_post`) USING BTREE,
  KEY `id_topic` (`topic_id`) USING BTREE,
  KEY `id_users` (`user_id`) USING BTREE,
  CONSTRAINT `FK_message_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE,
  CONSTRAINT `FK_message_users` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.post : ~4 rows (environ)
INSERT INTO `post` (`id_post`, `content`, `creationDate`, `user_id`, `topic_id`) VALUES
	(39, 'J\'ai remarqué une tendance croissante vers les régimes à base de plantes. J\'ai commencé à incorporer plus de légumes dans mes repas et je me sens beaucoup mieux. Avez-vous essayé le régime flexitarien ?', '2024-07-21 22:04:27', 8, 16),
	(40, 'Je rêve de visiter le Japon cette année, surtout pendant la saison des cerisiers en fleurs. Les paysages sont magnifiques et la culture est fascinante. Quelle destination recommandez-vous pour 2024 ?', '2024-07-21 22:05:10', 10, 17),
	(41, 'Pour maintenir l\'équilibre, je me fixe des horaires stricts et je m\'accorde du temps pour des activités relaxantes. La clé est de savoir dire non quand c\'est nécessaire. Comment gérez-vous cet équilibre ?', '2024-07-21 22:05:54', 10, 18),
	(53, 'Je viens d\'acheter l\'iPhone 15 et je suis impressionné par la caméra améliorée et l\'autonomie de la batterie. Qu\'en pensez-vous ? Avez-vous testé le mode nocturne ?', '2024-07-22 00:33:45', 16, 24),
	(54, 'La méditation m\'aide à réduire le stress et à améliorer ma concentration. J\'utilise l\'application Headspace chaque matin pendant 10 minutes. Quelles applications ou techniques utilisez-vous ?', '2024-07-22 00:35:09', 16, 25),
	(55, 'Voyager seul peut être une expérience incroyablement enrichissante. J\'ai voyagé en Thaïlande seul l\'année dernière et j\'ai fait des rencontres inoubliables. Mon conseil : restez ouvert et prudent. Quels sont vos conseils pour les voyageurs solitaires ?', '2024-07-22 00:36:00', 8, 26);

-- Listage de la structure de table forum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `users_id` (`user_id`) USING BTREE,
  KEY `FK_topic_category` (`category_id`),
  CONSTRAINT `FK_topic_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE CASCADE,
  CONSTRAINT `FK_topic_users` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.topic : ~4 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `creationDate`, `user_id`, `category_id`) VALUES
	(16, 'Alimentation saine en 2024', '2024-07-21 22:00:23', 8, 17),
	(17, 'Destinations de rêve 2024', '2024-07-21 22:00:54', 10, 18),
	(18, 'Équilibre vie pro-vie perso', '2024-07-21 22:02:35', 10, 20),
	(24, 'Nouveautés iPhone 15', '2024-07-22 00:33:21', 16, 16),
	(25, 'Méditation quotidienne', '2024-07-22 00:34:49', 16, 17),
	(26, 'Voyager en solo', '2024-07-22 00:35:38', 8, 18);

-- Listage de la structure de table forum. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `nickName` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateRegistration` datetime DEFAULT CURRENT_TIMESTAMP,
  `role` json DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.user : ~3 rows (environ)
INSERT INTO `user` (`id_user`, `email`, `nickName`, `password`, `dateRegistration`, `role`) VALUES
	(8, 'kenza@test.fr', 'Kenza', '$2y$10$LkJfPse6y4DpQVc3sjsV8uN1oNvyp9u/3JyqsHf/qJ457wmoGzY.S', '2024-07-21 21:58:07', '"ROLE_ADMIN"'),
	(10, 'pauline@test.fr', 'Pauline', '$2y$10$4GGUr6DJiq0r.akub2ypx.n/nNh0/mjx7Ku3KJdnIxQP/IsmT/P36', '2024-07-21 21:58:45', '"ROLE_USER"'),
	(16, 'gogo@test.fr', 'Goego', '$2y$10$s4uFFICldskO6AuUdQoAp.OeJoEF5v.vvQ0b3UXBI6nXacE7VrpM.', '2024-07-22 00:32:41', '"ROLE_USER"');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
