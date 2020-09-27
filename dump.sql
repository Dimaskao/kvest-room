-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: localhost    Database: kvest-room
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `room_id` int NOT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526C54177093` (`room_id`),
  KEY `IDX_9474526CA76ED395` (`user_id`),
  CONSTRAINT `FK_9474526C54177093` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`),
  CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=493 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (453,210,'dolore consequuntur sed aut quis enim in','2020-09-27 08:31:42',117),(454,213,'sit earum corrupti aspernatur nesciunt','2020-09-27 08:31:42',119),(455,214,'corporis voluptatem rerum est culpa','2020-09-27 08:31:42',119),(456,217,'illum tempora non eos','2020-09-27 08:31:42',120),(457,218,'adipisci beatae ut voluptas recusandae quod asperiores','2020-09-27 08:31:42',123),(458,213,'quam doloribus praesentium','2020-09-27 08:31:42',122),(459,216,'eaque aut aperiam','2020-09-27 08:31:42',119),(460,210,'nisi reiciendis aut nisi','2020-09-27 08:31:42',121),(461,211,'in consequatur atque vitae','2020-09-27 08:31:42',122),(462,211,'quo ab tempora dolorum ut pariatur alias','2020-09-27 08:31:42',123),(463,215,'sed sit magni','2020-09-27 08:31:42',120),(464,215,'doloribus voluptas vitae deserunt','2020-09-27 08:31:42',123),(465,219,'natus tempora ex explicabo veniam soluta','2020-09-27 08:31:42',117),(466,216,'eaque perferendis nulla','2020-09-27 08:31:42',123),(467,214,'veritatis fuga dolor quo distinctio','2020-09-27 08:31:42',120),(468,216,'eos illo ex','2020-09-27 08:31:42',119),(469,212,'aut est non doloremque ut suscipit','2020-09-27 08:31:42',121),(470,219,'odit deleniti at dolores possimus est non','2020-09-27 08:31:42',124),(471,210,'sapiente voluptatem praesentium rerum','2020-09-27 08:31:42',125),(472,210,'optio quaerat incidunt','2020-09-27 08:31:42',121),(473,212,'consequatur rem quasi doloribus aliquid','2020-09-27 08:31:42',121),(474,213,'mollitia atque consequatur','2020-09-27 08:31:42',121),(475,213,'dolores repellendus delectus','2020-09-27 08:31:42',119),(476,216,'est suscipit nihil aut','2020-09-27 08:31:42',120),(477,211,'illo neque odio perspiciatis sapiente','2020-09-27 08:31:42',119),(478,219,'sit minima exercitationem nobis mollitia incidunt atque','2020-09-27 08:31:42',118),(479,218,'aliquam odit repellendus','2020-09-27 08:31:42',121),(480,213,'eaque et totam beatae voluptatem sit ut','2020-09-27 08:31:42',116),(481,212,'eveniet ipsum eum qui','2020-09-27 08:31:42',123),(482,215,'placeat ut cum sapiente voluptate','2020-09-27 08:31:42',124),(483,211,'vitae voluptas facilis maiores facere','2020-09-27 08:31:42',121),(484,212,'exercitationem quod placeat fugiat sequi architecto','2020-09-27 08:31:42',124),(485,215,'necessitatibus atque magnam corrupti quia et sed','2020-09-27 08:31:42',125),(486,215,'quia est perferendis rerum id','2020-09-27 08:31:42',118),(487,210,'non qui sed veniam labore et','2020-09-27 08:31:42',120),(488,214,'et blanditiis odit','2020-09-27 08:31:42',123),(489,215,'libero temporibus et autem et','2020-09-27 08:31:42',117),(490,212,'ducimus labore reprehenderit vero ut sequi sed','2020-09-27 08:31:42',120),(491,217,'aut autem laudantium dolores','2020-09-27 08:31:42',120),(492,214,'et nostrum dolore laudantium et voluptate','2020-09-27 08:31:42',121);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20200913115801','2020-09-18 11:29:35',184),('DoctrineMigrations\\Version20200914074836','2020-09-18 11:29:35',11),('DoctrineMigrations\\Version20200920113003','2020-09-20 11:30:36',290),('DoctrineMigrations\\Version20200920172113','2020-09-20 17:22:04',243),('DoctrineMigrations\\Version20200920180711','2020-09-20 18:07:56',161),('DoctrineMigrations\\Version20200921195259','2020-09-21 19:53:14',225),('DoctrineMigrations\\Version20200922155834','2020-09-26 15:54:53',281),('DoctrineMigrations\\Version20200926154537','2020-09-26 15:57:47',201),('DoctrineMigrations\\Version20200926181249','2020-09-26 18:14:14',225);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `room` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `people_count` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `available` tinyint(1) NOT NULL,
  `time_count` int NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (210,'et laudantium','https://lorempixel.com/640/480/?44101','Quia laudantium harum sint ratione ea officia. At dicta dolorum voluptatem enim. Nobis porro pariatur voluptas natus ut ut. Reprehenderit ut similique et minima voluptas illum iure. Deserunt nisi sint eos quasi. A officia facilis est a nesciunt omnis sint ea. Voluptatem nulla aliquam eos officiis. Aut eum nihil omnis iste delectus dolores.','2-4',1,60,'et-laudantium'),(211,'natus id non enim','https://lorempixel.com/640/480/?11751','Consequatur id eos aut. Fuga quaerat aut vitae ullam error eos in maxime. Corporis consequuntur distinctio quis voluptatibus ut aut est. Optio debitis est voluptatem magnam consectetur officia quia. Repellat laborum in est itaque sint. Dicta et exercitationem quia est. Sit ea esse molestias officia ullam. Voluptatem et sit qui optio iste beatae magnam quidem.','2-4',1,60,'natus-id-non-enim'),(212,'fugiat consequatur quam','https://lorempixel.com/640/480/?54057','Impedit labore libero repudiandae. Omnis soluta ipsa doloremque rerum a. Voluptas fugiat qui ea sint autem exercitationem maiores. Quia error et assumenda incidunt consectetur rerum. Similique voluptatum quidem libero sed ipsum. Culpa aut commodi doloribus velit voluptatem est. Voluptas dolore est quia optio. Architecto enim odio dolores ratione et.','2-4',1,60,'fugiat-consequatur-quam'),(213,'dignissimos','https://lorempixel.com/640/480/?90511','Est iste nihil perspiciatis excepturi maxime ullam voluptatibus sapiente. Aut voluptas repellat odio fugit dolores in reiciendis deserunt. Magnam et autem dolores est officia aut eos. Cum corporis aut porro esse quam. Quia corporis cumque veniam molestias fuga minus sit. Cumque veritatis facilis commodi. Nulla fugit modi quibusdam et est voluptatum incidunt. Qui quis hic aliquam veritatis debitis et eos.','2-4',1,60,'dignissimos'),(214,'dolorem sunt','https://lorempixel.com/640/480/?86773','Doloremque officia quod dicta eveniet suscipit aut. Sunt illo non maiores. Veniam sed reiciendis asperiores accusantium exercitationem aut architecto. In eveniet hic asperiores molestiae. Laudantium repellat animi officia. Ullam et cumque maxime ut quaerat officiis cumque. Distinctio possimus illo aut veniam tempora veritatis voluptatem. Cupiditate sed quis porro fugiat quidem.','2-4',1,60,'dolorem-sunt'),(215,'qui','https://lorempixel.com/640/480/?28803','Vel ut sunt eos nihil et. Ad tenetur culpa ut ut corrupti. Eius nobis veniam tempora debitis est assumenda. Tempora et voluptatem dolorum quidem quaerat ipsam. Ut nesciunt sed totam nihil hic aut voluptatem. Omnis illo ipsum similique non. Totam dolores quas debitis alias accusamus enim id. Nihil consequatur ex officia in.','2-4',0,60,NULL),(216,'ut voluptas','https://lorempixel.com/640/480/?29675','Est facere rem quo aut optio sunt. Autem recusandae ipsa ea laudantium praesentium cum qui dolorum. Temporibus aliquid veritatis sunt molestiae voluptatem exercitationem rerum. Sit et est qui alias non. Neque dignissimos facilis quia eos ex non sed. Ab accusamus magni ipsa labore ex occaecati laboriosam pariatur. Minus quaerat reprehenderit quaerat enim nam neque incidunt. Quas ut unde reprehenderit repellendus dolores molestiae tempore.','2-4',0,60,NULL),(217,'totam et cupiditate nihil','https://lorempixel.com/640/480/?28385','Exercitationem aut minima qui placeat molestiae dolor ut. Consequatur minus id atque totam reiciendis. Voluptatem pariatur voluptas cupiditate delectus. Soluta aliquam sed ea minus. Minima voluptatem odit ea laudantium excepturi. Architecto officia amet doloremque cupiditate adipisci ducimus. Non unde voluptas excepturi iure itaque illo. Voluptate id eos et non est tempore numquam.','2-4',1,60,'totam-et-cupiditate-nihil'),(218,'provident mollitia','https://lorempixel.com/640/480/?24096','Veritatis voluptate et cum facilis quidem ab voluptatem. Eos nihil fugit repellendus perferendis. Voluptatum corrupti possimus id itaque distinctio magnam occaecati. Molestiae excepturi ea enim omnis. Corrupti delectus fugit ad voluptas molestiae. Quia veniam cupiditate alias voluptatibus. Nam dolore sed est sunt aut aliquid explicabo earum. Qui atque omnis voluptatem nam dolor.','2-4',1,60,'provident-mollitia'),(219,'illo rerum','https://lorempixel.com/640/480/?47548','Sint qui molestias ut eos. Itaque reiciendis ad vitae ut ipsum soluta. Quaerat consequatur distinctio vel ducimus. Ut laudantium sequi aut laborum. Tempora qui velit sint voluptatem et perferendis. Voluptas et in repudiandae excepturi reprehenderit. Et aspernatur laudantium odit aspernatur sequi libero aliquam. Perspiciatis vitae quisquam unde rerum ullam.','2-4',0,60,NULL);
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (116,'0@mail','[]','$argon2id$v=19$m=65536,t=4,p=1$kYBU8iTCJy5QK+V+bp4/wA$ssCAtH2uzbTDPqTovpNoYWPo+cMstGVp+Eas8QE6yQk','Stephon Cartwright','https://lorempixel.com/640/480/?69386'),(117,'1@mail','[]','$argon2id$v=19$m=65536,t=4,p=1$sDTkc9T/V/XJWF4vmS3qVg$/FzrQsBx7DUzwrSPaKumRNMNFM4WQHs6klyQMP7AHCg','Dr. Jamarcus Hintz','https://lorempixel.com/640/480/?21756'),(118,'2@mail','[]','$argon2id$v=19$m=65536,t=4,p=1$eaYeYBqHQEPLqN8VnxmiAQ$7RJhPB1f6o8FrDuJrxtNTcWN8L7oHpAKv/3+JmqHng4','Mrs. Cleora Stroman V','https://lorempixel.com/640/480/?88696'),(119,'3@mail','[]','$argon2id$v=19$m=65536,t=4,p=1$UU4ZWFt4+EG3oqcpSfwp0Q$caCe6zvR23vjtXsMki3bG4aiyD6Sq4/uTP31IbhsIkQ','Jayme Lehner','https://lorempixel.com/640/480/?18450'),(120,'4@mail','[]','$argon2id$v=19$m=65536,t=4,p=1$1pOqnP7YFRJUVmwdIpFd9Q$cyX1rrCQpPrmhSx0XyDuCzHpjzBIjkD+tvNrabwYPh0','Jeremie Walsh','https://lorempixel.com/640/480/?65355'),(121,'5@mail','[]','$argon2id$v=19$m=65536,t=4,p=1$q0ZNr0zDEfCWSlSaJBiR1A$Sw9EirukL2dB7sBdRZ740swo6I+Xhnn9mE/m1xk5RsI','Kaylee Kertzmann','https://lorempixel.com/640/480/?99445'),(122,'6@mail','[]','$argon2id$v=19$m=65536,t=4,p=1$VxJjWqoswNC1E8MjbF+F3Q$KrIoWGhiUff8gDsjGAx+CyFMS5onTq8ko7oUwgKOSJs','Melody Macejkovic V','https://lorempixel.com/640/480/?26803'),(123,'7@mail','[]','$argon2id$v=19$m=65536,t=4,p=1$UWRIItZOUlp6mzhRSr5neg$BJffX9q5HSe86YTZcNryRLBfvUbT4fDdXR4O0KrD/ng','Clarissa Cummings','https://lorempixel.com/640/480/?89499'),(124,'8@mail','[]','$argon2id$v=19$m=65536,t=4,p=1$dHJh1r/ZIqNcmKF6y4bKuw$RSqaR8ZGZzxP2tJZSRJfPK8H5IgIzpRZ7sLoQmjwULA','Miss Rosalinda Hoeger DDS','https://lorempixel.com/640/480/?68880'),(125,'9@mail','[]','$argon2id$v=19$m=65536,t=4,p=1$XXbxUEVAoTlqGLUyynZzwA$d6pBlVBODJTpk6iOafqZFgVPLhaZaWv7BtrWIImACes','Cecile Pagac PhD','https://lorempixel.com/640/480/?44235'),(126,'admin@dev.com','[\"ROLE_ADMIN\"]','$argon2id$v=19$m=65536,t=4,p=1$IGaz99t+1b4cJCB/a7NWKQ$mKz02x1mTTv5C6hUgvCqbib9ZNShu98H4vmsVLr4W3E','admin','images/defaultUser.png');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-27  9:49:00
