-- MySQL dump 10.16  Distrib 10.1.13-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: web1709
-- ------------------------------------------------------
-- Server version	10.1.13-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webname` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `copy` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friendlink`
--

DROP TABLE IF EXISTS `friendlink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friendlink` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `linkname` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `logo` varchar(255) NOT NULL,
  `content` text,
  `ordernum` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `linkname` (`linkname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friendlink`
--

LOCK TABLES `friendlink` WRITE;
/*!40000 ALTER TABLE `friendlink` DISABLE KEYS */;
/*!40000 ALTER TABLE `friendlink` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `title` char(255) NOT NULL,
  `content` text NOT NULL,
  `ctime` varchar(50) NOT NULL,
  `count` int(11) DEFAULT '0',
  `elite` tinyint(4) DEFAULT '0',
  `top` tinyint(4) DEFAULT '0',
  `recycle` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (6,3,31,'你好哇','你好','2018/01/07 22:09:44',0,1,0,0),(8,3,31,'求php 前辈指导建议','本人是2017届护理本科毕业生，软妹子一枚，之前因为家里原因选择了护理行业','2018/01/07 22:09:56',0,0,0,0),(9,3,31,'期末作业就一个小时的时间，紧急求助','期末作业就一个小时的时间，紧急求助','2018/01/07 22:09:47',0,0,0,0),(10,3,31,'用PHP玩跳一跳，切记不要刷太高分','用PHP玩跳一跳，切记不要刷太高分','2018/01/07 22:33:44',0,1,0,0),(11,3,31,'离职了，混口饭吃','离职了，混口饭吃','2018/01/07 22:09:48',0,0,0,0),(12,3,6,'第一条标题','第一条内容','2018/01/07 22:22:48',0,0,0,0),(13,3,32,'111','111','2018/01/07 22:09:36',0,0,0,0),(14,3,7,'aaa','bbb','2018/01/07 22:09:44',0,0,0,0),(15,3,6,'555','555','2018/01/08 09:47:05',0,0,0,0),(16,3,31,'555','555','2018/01/08 16:55:17',0,0,0,0),(17,3,31,'999','999','2018/01/08 16:56:47',0,0,0,0),(18,3,31,'88','88','2018/01/08 17:02:55',0,0,0,0),(19,3,35,'66','66','2018/01/08 17:03:23',0,0,0,0),(20,3,31,'test','test','2018/01/08 17:08:42',0,0,0,0),(21,3,6,'test','test','2018/01/08 17:08:57',0,0,0,0),(22,3,31,'999','999','2018/01/08 17:09:31',0,0,0,0),(23,3,6,'pp','pp','2018/01/08 17:30:05',0,0,0,0),(29,3,6,'888','888','2018/03/19 16:51:19',0,0,0,0),(25,3,6,'php2','php2','2018/01/10 11:03:01',0,0,0,0),(30,3,6,'测试','测试','2018/03/20 14:37:39',0,0,0,0),(28,3,31,'00','00','2018/01/10 11:08:30',0,0,0,0);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reply`
--

DROP TABLE IF EXISTS `reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `content` text NOT NULL,
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reply`
--

LOCK TABLES `reply` WRITE;
/*!40000 ALTER TABLE `reply` DISABLE KEYS */;
/*!40000 ALTER TABLE `reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  `pid` int(11) NOT NULL DEFAULT '0',
  `path` char(255) NOT NULL DEFAULT '0',
  `blogo` varchar(255) NOT NULL DEFAULT 'default.jpg',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
INSERT INTO `type` VALUES (1,'技术交流',1,0,'0','default.jpg'),(35,'培训教程',1,33,'0-33','201801092005001904419945.png'),(36,'兄弟会',1,33,'0-33','201801092003461152297122.png'),(6,'PHP技术',1,1,'0-1','20180109195259441601352.png'),(7,'Java/Android技术交流',1,1,'0-1','20180109195505982527436.png'),(8,'前端（HTML5）技术',1,1,'0-1','20180109195650131492058.png'),(9,'Linux',1,1,'0-1','201801091959441202721906.png'),(37,'战地日记',1,33,'0-33','20180109200046700785988.png'),(33,'兄弟连',1,0,'0','default.jpg'),(32,'资源分享',0,1,'0-1','201801101431581533513484.png'),(30,'test',1,0,'0','default.jpg'),(31,'test1',1,30,'0-30','20180109200441451223925.jpg'),(34,'视频教程',1,33,'0-33','201801092001011125491382.png'),(39,'《细说PHP》',1,33,'0-33','20180109200116166295780.png'),(38,'兄弟连小电影',1,33,'0-33','201801092001441027391122.png'),(46,'99',1,30,'0-30','20180109194457302323976.gif'),(47,'66',1,30,'0-30','20180109194533915044455.jpg');
/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userName` char(20) NOT NULL,
  `password` char(33) NOT NULL,
  `auth` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `lastlogin` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `userName` (`userName`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (3,'pan','123',1,1,'2018/03/20 14:38:54'),(6,'yang','123',0,1,'2018/03/20 14:38:39'),(9,'admin','123',1,1,'2018/03/20 14:38:10');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userdetail`
--

DROP TABLE IF EXISTS `userdetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userdetail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `userName` varchar(255) NOT NULL,
  `nickName` char(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` char(50) DEFAULT NULL,
  `qq` char(15) DEFAULT NULL,
  `sex` enum('女','男') NOT NULL DEFAULT '男',
  `photo` char(255) NOT NULL DEFAULT 'photo',
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userdetail`
--

LOCK TABLES `userdetail` WRITE;
/*!40000 ALTER TABLE `userdetail` DISABLE KEYS */;
INSERT INTO `userdetail` VALUES (3,0,'yangpan','钢笔','623007','1170078140@qq.com','1170078140','女','20180106163147383615975.jpg','上海,浦东,张江'),(12,0,'小明','小明','666','123@163.com','6','男','20180108164400401986342.jpg','上海,浦东,张江'),(15,0,'小花','小花','333','333@qq.com','333','女','20180108164453848248800.jpg','上海,浦东,张江'),(16,0,'test','test','test','test@qq.com','123','女','201803201435582033012516.jpg','上海,浦东,张江');
/*!40000 ALTER TABLE `userdetail` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-20 14:40:56
