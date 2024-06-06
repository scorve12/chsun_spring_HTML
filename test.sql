-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: hacker_test
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.22.04.1

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
-- Table structure for table `free_board_comment_table`
--

DROP TABLE IF EXISTS `free_board_comment_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `free_board_comment_table` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `board_idx` int NOT NULL,
  `mb_id` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `content` varchar(300) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `free_board_comment_table`
--

LOCK TABLES `free_board_comment_table` WRITE;
/*!40000 ALTER TABLE `free_board_comment_table` DISABLE KEYS */;
INSERT INTO `free_board_comment_table` VALUES (1,6,'gunner0705','삭제된 댓글입니다'),(2,7,'123','야이녀'),(3,2,'gunner0705','병신 ㅋㅋ'),(4,2,'gunner0705','ㄴ 진짜 병신임'),(5,2,'gunner0705','미친련아\r\n');
/*!40000 ALTER TABLE `free_board_comment_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `free_board_table`
--

DROP TABLE IF EXISTS `free_board_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `free_board_table` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` varchar(300) NOT NULL,
  `like_count` int NOT NULL DEFAULT '0',
  `view` int NOT NULL DEFAULT '0',
  `name` varchar(200) NOT NULL,
  `file` varchar(200) NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `free_board_table`
--

LOCK TABLES `free_board_table` WRITE;
/*!40000 ALTER TABLE `free_board_table` DISABLE KEYS */;
INSERT INTO `free_board_table` VALUES (2,'1','2',0,21,'juneun','webshell.php',NULL);
/*!40000 ALTER TABLE `free_board_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inform_board_table`
--

DROP TABLE IF EXISTS `inform_board_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inform_board_table` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` varchar(300) NOT NULL,
  `view` int NOT NULL DEFAULT '0',
  `name` varchar(200) NOT NULL,
  `file` varchar(200) NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inform_board_table`
--

LOCK TABLES `inform_board_table` WRITE;
/*!40000 ALTER TABLE `inform_board_table` DISABLE KEYS */;
INSERT INTO `inform_board_table` VALUES (11,'test','AhAHAHAHAHAH\r\n<script><!-- -->\r\n   alert(document.cookie);<!-- -->\r\n</script><!-- -->',17,'jeon','',NULL),(13,'notice','notice11',4,'lee','',NULL),(14,'admin','test',3,'lee','',NULL),(15,'asdf','asdfasdf',4,'eee','',NULL),(18,'admin','admins',21,'juneun','',NULL),(21,'123','123',6,'','',NULL),(22,'afsd','fsaf',12,'gunner0705','','2024-06-05 18:07:43'),(23,'ㅁㄴㄹ','ㅁㄴㅇㄹ',13,'gunner0705','','2024-06-05 19:33:33');
/*!40000 ALTER TABLE `inform_board_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `liked_table`
--

DROP TABLE IF EXISTS `liked_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `liked_table` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `liked_table`
--

LOCK TABLES `liked_table` WRITE;
/*!40000 ALTER TABLE `liked_table` DISABLE KEYS */;
INSERT INTO `liked_table` VALUES (9,15,6),(10,15,7),(6,18,29),(7,18,46),(8,25,49);
/*!40000 ALTER TABLE `liked_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_table`
--

DROP TABLE IF EXISTS `member_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member_table` (
  `seq` int NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL,
  `mb_pw` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `mb_nickname` varchar(20) NOT NULL,
  `mb_email` varchar(30) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'USER',
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_table`
--

LOCK TABLES `member_table` WRITE;
/*!40000 ALTER TABLE `member_table` DISABLE KEYS */;
INSERT INTO `member_table` VALUES (15,'gunner0705','$2y$10$S0Wmg9ZBGhI8bCTMCMcdR.GPv1tGSneWroqks6eN1519d3xDAzQAS','gunner','gunner0705@naver.com','ADMIN'),(16,'jeon','$2y$10$W7hgzPbiinU7XYes2uocveZuBVv6tDkngBjXZ9DePRCroiY3Sw.nS','jeon','shjeon0126@gmail.com','ADMIN'),(17,'admin','$2y$10$xZ6T5I5vgjRolYURLnHavuna9gUIAJN6Cwli2AQLzfFnRhzsiuPiS','admin','wjdwlgns394@naver.com','USER'),(18,'test','$2y$10$uJUMyCOnJvOFlduO2/iVP.h69K.6C3N7.FEAia6UoGIGo5nwTLZAe','test','wjdwlgns394@naver.com','USER'),(19,'test2','$2y$10$yxONmjAt4kvwCJTryKThXuI6AV.deoGGaXDSTm7VdGC/3URqd/zYO','test','seonseon933@gmail.com','USER'),(20,'eee','$2y$10$3nR7ABAg9XM29qBYUmpca.hvTUAdb8Ead54rNClS0AdtdE0XWJ/d2','jjj','ejimail0103@gmail.com','USER'),(21,'lee','$2y$10$nvGA0XPrlu2UFA2jsnkBGO9r/6l/YX7WQkxoXVr/bJOhZczIDxlbK','lee','wolee1807@gmail.com','USER'),(22,'test','$2y$10$Xo/tHwZSOYWmmN7GsVwLzObzKhsrht6rWO/tApc5DyXGCHZjNXpG2','test','wjdwlgns394@naver.com','USER'),(23,'admin','$2y$10$MaBuR0wHKuHe7EdLgrUxV.dCPYaivLVqmj47x1oRvF/VqMaCv19F6','admin','pppp6626@naver.com','USER'),(24,'test','$2y$10$dKUJZ4TH/AjpaXbuCZ.68efOC.w20P23CuKZIHqcjnEK3iprIBZXy','test','pppp6626@naver.com','USER'),(25,'juneun','$2y$10$YNT.5bloep2vUtYEH2skcOzs3SdUi7vrrGUOXIBYbgcKLqQqd7RFm','juneun','pppp6626@naver.com','USER'),(26,'11','$2y$10$F/iBD1SAIDpsItWa0z0t3eg4DZKM3MbI4iFBUXBq7T3BM53ksyV3e','11','ledain5094@gmail.com','USER'),(27,'asd','$2y$10$BxKBjxwmZ7IoiMymg00gMufHqWaxC2ICPPcXjvT5ZsZhXOdVGu6BK','asd','seonseon933@gmail.com','USER'),(28,'12345','$2y$10$e9iRonUmVmIGC561bO.D3ubEG/UuZfG0U/5e8E41U5841yYLhE7xa','12345','gunner0705@naver.com','USER'),(29,'123','$2y$10$17kc5AflWJAEVihQXuhg4.LPgdRyOGZHu90kVsG/7onQL2rJAlCV.','123','gunner0705@naver.com','USER');
/*!40000 ALTER TABLE `member_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qna_board_comment_table`
--

DROP TABLE IF EXISTS `qna_board_comment_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qna_board_comment_table` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `board_idx` int NOT NULL,
  `mb_id` varchar(200) NOT NULL,
  `content` varchar(300) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qna_board_comment_table`
--

LOCK TABLES `qna_board_comment_table` WRITE;
/*!40000 ALTER TABLE `qna_board_comment_table` DISABLE KEYS */;
INSERT INTO `qna_board_comment_table` VALUES (3,1,'gunner0705','좋아요!\r\nd');
/*!40000 ALTER TABLE `qna_board_comment_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qna_board_table`
--

DROP TABLE IF EXISTS `qna_board_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qna_board_table` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` varchar(300) NOT NULL,
  `view` int NOT NULL DEFAULT '0',
  `name` varchar(200) NOT NULL,
  `file` varchar(200) NOT NULL,
  `lock_post` int NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qna_board_table`
--

LOCK TABLES `qna_board_table` WRITE;
/*!40000 ALTER TABLE `qna_board_table` DISABLE KEYS */;
INSERT INTO `qna_board_table` VALUES (1,'질문!','질문이 있습니다.',45,'123','',1,NULL);
/*!40000 ALTER TABLE `qna_board_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recommendations`
--

DROP TABLE IF EXISTS `recommendations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recommendations`
--

LOCK TABLES `recommendations` WRITE;
/*!40000 ALTER TABLE `recommendations` DISABLE KEYS */;
/*!40000 ALTER TABLE `recommendations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-07  1:19:08
