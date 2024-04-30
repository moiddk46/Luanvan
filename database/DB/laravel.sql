-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: laravel
-- ------------------------------------------------------
-- Server version	8.0.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `assign_master`
--

DROP TABLE IF EXISTS `assign_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assign_master` (
  `idassign_master_id` bigint NOT NULL AUTO_INCREMENT,
  `staff_id` bigint NOT NULL,
  `order_id` bigint NOT NULL,
  `status` bigint NOT NULL,
  PRIMARY KEY (`idassign_master_id`),
  KEY `order_id_idx` (`order_id`),
  KEY `staff_id_idx` (`staff_id`),
  KEY `status` (`status`),
  CONSTRAINT `assign_master_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`),
  CONSTRAINT `assign_master_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order_master` (`order_id`),
  CONSTRAINT `assign_master_ibfk_3` FOREIGN KEY (`status`) REFERENCES `status_master` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assign_master`
--

LOCK TABLES `assign_master` WRITE;
/*!40000 ALTER TABLE `assign_master` DISABLE KEYS */;
INSERT INTO `assign_master` VALUES (10,8,80,2);
/*!40000 ALTER TABLE `assign_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notice`
--

DROP TABLE IF EXISTS `notice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notice` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `type_id` bigint NOT NULL,
  `id_user` bigint NOT NULL,
  `detail` text COLLATE utf8mb4_general_ci NOT NULL,
  `flash_order` enum('0','1') COLLATE utf8mb4_general_ci NOT NULL,
  `click` enum('0','1') COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `notice_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notice`
--

LOCK TABLES `notice` WRITE;
/*!40000 ALTER TABLE `notice` DISABLE KEYS */;
INSERT INTO `notice` VALUES (11,23,4,'Yêu cầu báo giá có mã 23 của bạn đang ở trạng thái Đã trả lời','0','1'),(13,77,4,'Đơn hàng có mã 77 của bạn đang ở trạng thái Đang xử lý','1','1'),(14,78,4,'Đơn hàng có mã 78 của bạn đang ở trạng thái Đang xử lý','1','1'),(15,79,4,'Đơn hàng có mã 79 của bạn đang ở trạng thái Đang xử lý','1','1'),(16,80,4,'Đơn hàng có mã 80 của bạn đang ở trạng thái Đã xác nhận','1','1'),(17,81,4,'Đơn hàng có mã 81 của bạn đang ở trạng thái Đang xử lý','1','1'),(18,82,4,'Đơn hàng có mã 82 của bạn đang ở trạng thái Đang xử lý','1','1'),(19,24,7,'Yêu cầu báo giá có mã 24 của bạn đang ở trạng thái Chưa trả lời','0','0'),(20,83,7,'Đơn hàng có mã 83 của bạn đang ở trạng thái Đang xử lý','1','0'),(21,84,7,'Đơn hàng có mã 84 của bạn đang ở trạng thái Đang xử lý','1','0'),(22,25,4,'Yêu cầu báo giá có mã 25 của bạn đang ở trạng thái Đã trả lời','0','1'),(23,85,4,'Đơn hàng có mã 85 của bạn đang ở trạng thái Đang xử lý','1','1'),(24,26,4,'Yêu cầu báo giá có mã 26 của bạn đang ở trạng thái Chưa trả lời','0','0');
/*!40000 ALTER TABLE `notice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_detail` (
  `order_detail_id` bigint NOT NULL AUTO_INCREMENT,
  `order_id` bigint NOT NULL,
  `service_type_code` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `order_file_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `page` int DEFAULT NULL,
  `complete_time` date DEFAULT NULL,
  PRIMARY KEY (`order_detail_id`),
  KEY `order_id` (`order_id`),
  KEY `service_type_code` (`service_type_code`),
  CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_master` (`order_id`),
  CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`service_type_code`) REFERENCES `service_type` (`service_type_code`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_detail`
--

LOCK TABLES `order_detail` WRITE;
/*!40000 ALTER TABLE `order_detail` DISABLE KEYS */;
INSERT INTO `order_detail` VALUES (31,77,'inantrangden',1,'5000','BaoCaoTTTT_B2014760_TranThanhMoi.doc',1,'2024-05-01'),(32,78,'inantrangden',1,'5000','BaoCaoTTTT_B2014760_TranThanhMoi.doc',1,'2024-05-01'),(33,79,'inantrangden',1,'25000','BaoCaoTTTT_B2014760_TranThanhMoi.doc',5,'2024-05-01'),(34,80,'dichthuatcongchung',1,'300000','BaoCaoTTTT_B2014760_TranThanhMoi.doc',3,'2024-05-05'),(35,81,'dichthuatcongchung',1,'300000','BaoCaoTTTT_B2014760_TranThanhMoi.doc',1,'2024-05-05'),(36,82,'dichthuatcongchung',1,'300000','BaoCaoTTTT_B2014760_TranThanhMoi.doc',1,'2024-05-05'),(37,83,'dichthuatthongthuong',2,'200000','04-Phiếu nhận SV.doc',1,'2024-05-05'),(38,84,'inantrangden',5,'25000','CV_Lập trình viên website_Tran Thanh Moi.pdf',1,'2024-05-03'),(39,85,'dichvideo',1,'300000','Bosch Global Software Technologies Company Limited tuyển dụng việc làm IT mới và tốt nhất _ TopDev - Google Chrome 2024-04-01 23-02-46.mp4',1,'2024-05-03');
/*!40000 ALTER TABLE `order_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_master`
--

DROP TABLE IF EXISTS `order_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_master` (
  `order_id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(11) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `order_date` date NOT NULL,
  `id_user` bigint NOT NULL,
  `service_type_code` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` bigint NOT NULL,
  `give_flag` enum('0','1') COLLATE utf8mb4_general_ci NOT NULL,
  `delivery` enum('0','1') COLLATE utf8mb4_general_ci NOT NULL,
  `comfirm_user` enum('1','0') COLLATE utf8mb4_general_ci NOT NULL,
  `check_page` enum('0','1') COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `status` (`status`),
  KEY `service_type_code` (`service_type_code`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `order_master_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status_master` (`status_id`),
  CONSTRAINT `order_master_ibfk_2` FOREIGN KEY (`service_type_code`) REFERENCES `service_type` (`service_type_code`),
  CONSTRAINT `order_master_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_master`
--

LOCK TABLES `order_master` WRITE;
/*!40000 ALTER TABLE `order_master` DISABLE KEYS */;
INSERT INTO `order_master` VALUES (77,NULL,NULL,NULL,'2024-04-29',4,'inantrangden',1,'0','1','1','0'),(78,NULL,NULL,NULL,'2024-04-29',4,'inantrangden',1,'0','1','1','0'),(79,NULL,NULL,NULL,'2024-04-29',4,'inantrangden',1,'0','1','1','0'),(80,'Trần Thanh Mới','Hẻm 51, Hưng Lợi, Ninh Kiều, Cần Thơ','0854172887','2024-04-29',4,'dichthuatcongchung',2,'0','1','1','1'),(81,'Trần Thanh Mới','Hẻm 51, Hưng Lợi, Ninh Kiều, Cần Thơ','0854172887','2024-04-29',4,'dichthuatcongchung',1,'0','1','1','0'),(82,'Trần Thanh Mới','Hẻm 51, Hưng Lợi, Ninh Kiều, Cần Thơ','0854172887','2024-04-29',4,'dichthuatcongchung',1,'0','0','1','0'),(83,'Trần Thanh Mới','Hẻm 51, Hưng Lợi, Ninh Kiều, Cần Thơ','0854172887','2024-04-30',7,'dichthuatthongthuong',1,'0','0','1','1'),(84,'Trần Thanh Mới','Hẻm 51, Hưng Lợi, Ninh Kiều, Cần Thơ','0854172887','2024-04-30',7,'inantrangden',1,'0','0','0','1'),(85,'Trần Thanh Mới','Hẻm 51, Hưng Lợi, Ninh Kiều, Cần Thơ','0854172887','2024-04-30',4,'dichvideo',1,'0','0','1','1');
/*!40000 ALTER TABLE `order_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `position-info`
--

DROP TABLE IF EXISTS `position-info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `position-info` (
  `position_id` bigint NOT NULL AUTO_INCREMENT,
  `position` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `position-info`
--

LOCK TABLES `position-info` WRITE;
/*!40000 ALTER TABLE `position-info` DISABLE KEYS */;
INSERT INTO `position-info` VALUES (1,'Quản trị viên'),(2,'Nhân viên'),(3,'Khách hàng\r\n');
/*!40000 ALTER TABLE `position-info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price_request`
--

DROP TABLE IF EXISTS `price_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `price_request` (
  `request_id` bigint NOT NULL AUTO_INCREMENT,
  `request_date` date NOT NULL,
  `request_comment` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `service_type_code` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_user` bigint NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `price` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `request_file` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` bigint NOT NULL,
  `price_letter` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `complete_time` int DEFAULT NULL,
  `page` int DEFAULT NULL,
  `check_page` enum('0','1') COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`request_id`),
  KEY `service_type_code` (`service_type_code`),
  KEY `id_user` (`id_user`),
  KEY `price_request_ibfk_3` (`status`),
  CONSTRAINT `price_request_ibfk_1` FOREIGN KEY (`service_type_code`) REFERENCES `service_type` (`service_type_code`),
  CONSTRAINT `price_request_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  CONSTRAINT `price_request_ibfk_3` FOREIGN KEY (`status`) REFERENCES `status_reply` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_request`
--

LOCK TABLES `price_request` WRITE;
/*!40000 ALTER TABLE `price_request` DISABLE KEYS */;
INSERT INTO `price_request` VALUES (24,'2024-04-29','Hãy báo giá dịch thuật tài liệu bên dưới','dichthuatthongthuong',7,'Trần Thanh Mới','Hẻm 51, Hưng Lợi, Ninh Kiều, Cần Thơ','0854172887',NULL,'BaoCaoTTTT_B2014760_TranThanhMoi.doc',2,NULL,NULL,1,'0'),(25,'2024-04-30','Hãy báo giá dịch thuật này giúp tôi','dichvideo',4,'Trần Thanh Mới','Hẻm 51, Hưng Lợi, Ninh Kiều, Cần Thơ','0854172887','300000','Bosch Global Software Technologies Company Limited tuyển dụng việc làm IT mới và tốt nhất _ TopDev - Google Chrome 2024-04-01 23-02-46.mp4',1,'<p>Xin ch&agrave;o Trần Thanh Mới! C&ocirc;ng ty TranslateGroup xin gửi b&aacute;o gi&aacute; Dịch thuật video với tệp t&agrave;i liệu bạn đ&atilde; gửi l&agrave; 300.000&nbsp;₫ ạ.</p>',3,1,'1'),(26,'2024-05-01','Hãy báo giá dịch thuật tài liệu bên dưới giúp tôi','dichvideo',4,'Trần Thanh Mới','Hẻm 51, Hưng Lợi, Ninh Kiều, Cần Thơ','0854172887',NULL,'Bosch Global Software Technologies Company Limited tuyển dụng việc làm IT mới và tốt nhất _ TopDev - Google Chrome 2024-04-01 23-02-46.mp4',2,NULL,NULL,1,'0');
/*!40000 ALTER TABLE `price_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price_service_type`
--

DROP TABLE IF EXISTS `price_service_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `price_service_type` (
  `price_id` bigint NOT NULL AUTO_INCREMENT,
  `service_type_code` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `price` float NOT NULL,
  `detail_price` longtext COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`price_id`),
  KEY `service_type_code` (`service_type_code`),
  CONSTRAINT `price_service_type_ibfk_1` FOREIGN KEY (`service_type_code`) REFERENCES `service_type` (`service_type_code`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_service_type`
--

LOCK TABLES `price_service_type` WRITE;
/*!40000 ALTER TABLE `price_service_type` DISABLE KEYS */;
INSERT INTO `price_service_type` VALUES (2,'dichthuatcongchung',200000,'<p>B&aacute;o gi&aacute; dịch thuật c&ocirc;ng chứng:</p>\r\n<p>1. Phí sao y:&nbsp;</p>\r\n<ul style=\"list-style-type: disc;\">\r\n<li>Tài li&ecirc;̣u có bản g&ocirc;́c: 7.000đ/trang</li>\r\n<li>Tài li&ecirc;̣u kh&ocirc;ng có bản g&ocirc;́c: 10.000đ/trang</li>\r\n</ul>\r\n<p>2. Dấu của c&ocirc;ng ty dịch thuật: 20.000đ/bản/15 trang.</p>\r\n<p>3. Dấu của ph&ograve;ng c&ocirc;ng chứng tư nh&acirc;n: 30.000đ/bản/15 trang.</p>\r\n<p>4. Dấu của ph&ograve;ng tư ph&aacute;p nhà nước: 60.000đ/bản/15 trang.</p>\r\n<p>5. Hợp ph&aacute;p h&oacute;a l&atilde;nh sự: 350.000đ/tem.</p>\r\n<ul style=\"list-style-type: disc;\">\r\n<li>Đối với t&agrave;i liệu chuy&ecirc;n ng&agrave;nh như hợp đồng kinh tế, kỹ thuật, thương mại, t&agrave;i ch&iacute;nh&hellip; th&igrave; ngo&agrave;i tiền dịch phụ thu th&ecirc;m 10% tiền dịch chuy&ecirc;n ng&agrave;nh.</li>\r\n<li>Chi ph&iacute; hiệu đ&iacute;nh văn bản bằng 50% tiền dịch. Nếu phần hiệu đ&iacute;nh nhiều hơn phần nội dung 10% th&igrave; ph&iacute; bản hiệu đ&iacute;nh đ&oacute; bằng ph&iacute; dịch.</li>\r\n</ul>'),(3,'dichthuatthongthuong',100000,'<p>Bảng gi&aacute; dịch văn bản ti&ecirc;́ng Vi&ecirc;̣t sang ng&ocirc;n ngữ khác và ngược lại</p>\r\n<div>\r\n<table id=\"wpdtSimpleTable-2\" style=\"width: max-content;\" data-has-header=\"0\" data-responsive=\"0\" data-wpid=\"2\" data-rows=\"19\" data-column=\"3\">\r\n<tbody>\r\n<tr>\r\n<td style=\"height: 22px; width: 197px;\" data-row-index=\"0\" data-col-index=\"0\" data-cell-id=\"A1\">Ng&ocirc;n ngữ (2 chi&ecirc;̀u)</td>\r\n<td style=\"height: 22px; width: 162px;\" data-row-index=\"0\" data-col-index=\"1\" data-cell-id=\"B1\">Tài li&ecirc;̣u đơn giản</td>\r\n<td style=\"height: 22px; width: 172px;\" data-row-index=\"0\" data-col-index=\"2\" data-cell-id=\"C1\">Tài li&ecirc;̣u chuy&ecirc;n ngành</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"1\" data-col-index=\"0\" data-cell-id=\"A2\">Tiếng Anh</td>\r\n<td style=\"height: 22px;\" data-row-index=\"1\" data-col-index=\"1\" data-cell-id=\"B2\">60.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"1\" data-col-index=\"2\" data-cell-id=\"C2\">100.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"2\" data-col-index=\"0\" data-cell-id=\"A3\">Tiếng Trung</td>\r\n<td style=\"height: 22px;\" data-row-index=\"2\" data-col-index=\"1\" data-cell-id=\"B3\">100.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"2\" data-col-index=\"2\" data-cell-id=\"C3\">150.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"3\" data-col-index=\"0\" data-cell-id=\"A4\">Tiếng Nhật</td>\r\n<td style=\"height: 22px;\" data-row-index=\"3\" data-col-index=\"1\" data-cell-id=\"B4\">100.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"3\" data-col-index=\"2\" data-cell-id=\"C4\">150.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"4\" data-col-index=\"0\" data-cell-id=\"A5\">Tiếng H&agrave;n</td>\r\n<td style=\"height: 22px;\" data-row-index=\"4\" data-col-index=\"1\" data-cell-id=\"B5\">100.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"4\" data-col-index=\"2\" data-cell-id=\"C5\">150.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"5\" data-col-index=\"0\" data-cell-id=\"A6\">Tiếng Nga</td>\r\n<td style=\"height: 22px;\" data-row-index=\"5\" data-col-index=\"1\" data-cell-id=\"B6\">100.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"5\" data-col-index=\"2\" data-cell-id=\"C6\">150.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"6\" data-col-index=\"0\" data-cell-id=\"A7\">Tiếng Ph&aacute;p</td>\r\n<td style=\"height: 22px;\" data-row-index=\"6\" data-col-index=\"1\" data-cell-id=\"B7\">100.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"6\" data-col-index=\"2\" data-cell-id=\"C7\">150.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"7\" data-col-index=\"0\" data-cell-id=\"A8\">Tiếng Đức</td>\r\n<td style=\"height: 22px;\" data-row-index=\"7\" data-col-index=\"1\" data-cell-id=\"B8\">100.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"7\" data-col-index=\"2\" data-cell-id=\"C8\">150.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"8\" data-col-index=\"0\" data-cell-id=\"A9\">Tiếng S&eacute;c</td>\r\n<td style=\"height: 22px;\" data-row-index=\"8\" data-col-index=\"1\" data-cell-id=\"B9\">200.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"8\" data-col-index=\"2\" data-cell-id=\"C9\">250.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"9\" data-col-index=\"0\" data-cell-id=\"A10\">Ti&ecirc;́ng Ukraina</td>\r\n<td style=\"height: 22px;\" data-row-index=\"9\" data-col-index=\"1\" data-cell-id=\"B10\">200.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"9\" data-col-index=\"2\" data-cell-id=\"C10\">250.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"10\" data-col-index=\"0\" data-cell-id=\"A11\">Tiếng Italia</td>\r\n<td style=\"height: 22px;\" data-row-index=\"10\" data-col-index=\"1\" data-cell-id=\"B11\">200.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"10\" data-col-index=\"2\" data-cell-id=\"C11\">250.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"11\" data-col-index=\"0\" data-cell-id=\"A12\">Tiếng T&acirc;y Ban Nha</td>\r\n<td style=\"height: 22px;\" data-row-index=\"11\" data-col-index=\"1\" data-cell-id=\"B12\">300.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"11\" data-col-index=\"2\" data-cell-id=\"C12\">400.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"12\" data-col-index=\"0\" data-cell-id=\"A13\">Tiếng Th&aacute;i Lan</td>\r\n<td style=\"height: 22px;\" data-row-index=\"12\" data-col-index=\"1\" data-cell-id=\"B13\">200.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"12\" data-col-index=\"2\" data-cell-id=\"C13\">250.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"13\" data-col-index=\"0\" data-cell-id=\"A14\">Tiếng Campuchia</td>\r\n<td style=\"height: 22px;\" data-row-index=\"13\" data-col-index=\"1\" data-cell-id=\"B14\">300.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"13\" data-col-index=\"2\" data-cell-id=\"C14\">400.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"14\" data-col-index=\"0\" data-cell-id=\"A15\">Tiếng L&agrave;o</td>\r\n<td style=\"height: 22px;\" data-row-index=\"14\" data-col-index=\"1\" data-cell-id=\"B15\">300.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"14\" data-col-index=\"2\" data-cell-id=\"C15\">400.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"15\" data-col-index=\"0\" data-cell-id=\"A16\">Tiếng H&agrave; Lan</td>\r\n<td style=\"height: 22px;\" data-row-index=\"15\" data-col-index=\"1\" data-cell-id=\"B16\">(li&ecirc;n h&ecirc;̣)</td>\r\n<td style=\"height: 22px;\" data-row-index=\"15\" data-col-index=\"2\" data-cell-id=\"C16\">(li&ecirc;n h&ecirc;̣)</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"16\" data-col-index=\"0\" data-cell-id=\"A17\">Tiếng Ba Lan</td>\r\n<td style=\"height: 22px;\" data-row-index=\"16\" data-col-index=\"1\" data-cell-id=\"B17\">(li&ecirc;n h&ecirc;̣)</td>\r\n<td style=\"height: 22px;\" data-row-index=\"16\" data-col-index=\"2\" data-cell-id=\"C17\">(li&ecirc;n h&ecirc;̣)</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"17\" data-col-index=\"0\" data-cell-id=\"A18\">Tiếng Bồ Đ&agrave;o Nha</td>\r\n<td style=\"height: 22px;\" data-row-index=\"17\" data-col-index=\"1\" data-cell-id=\"B18\">(li&ecirc;n h&ecirc;̣)</td>\r\n<td style=\"height: 22px;\" data-row-index=\"17\" data-col-index=\"2\" data-cell-id=\"C18\">(li&ecirc;n h&ecirc;̣)</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" colspan=\"3\" rowspan=\"1\" data-row-index=\"18\" data-col-index=\"0\" data-cell-id=\"A19\">Và các ng&ocirc;n ngữ khác</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<p><strong>Ghi Ch&uacute;:</strong></p>\r\n<p>1. Gi&aacute; dịch thu&acirc;̣t chưa bao gồm VAT.</p>\r\n<p>2. Qu&yacute; kh&aacute;ch cần thanh toán trước 70% gi&aacute; trị với hợp đ&ocirc;̀ng tr&ecirc;n 1.000.000 đ&ocirc;̀ng và 100% giá trị với hợp đ&ocirc;̀ng dưới 1.000.000 đ&ocirc;̀ng.</p>\r\n<p>3. C&oacute; ch&iacute;nh s&aacute;ch ưu đ&atilde;i đặc biệt về gi&aacute; với kh&aacute;ch h&agrave;ng thường xuy&ecirc;n sử dụng dịch vụ của Dịch thuật 24h.</p>\r\n<p>4. Ưu ti&ecirc;n đặc biệt đối với kh&aacute;ch h&agrave;ng dịch số lượng lớn:</p>\r\n<ul style=\"list-style-type: disc;\">\r\n<li>Giảm 5% đối với hợp đồng c&oacute; số lượng từ: 100 &ndash; 400 trang.</li>\r\n<li>Giảm 10% đối với hợp đồng c&oacute; số lượng từ: 400 &ndash; 1000 trang.</li>\r\n<li>Giảm 15% đối với hợp đồng c&oacute; số lượng tr&ecirc;n 1000 trang.</li>\r\n</ul>'),(4,'dichvideo',250000,'<h2><strong>Bảng gi&aacute; dịch văn bản ti&ecirc;́ng Vi&ecirc;̣t sang ng&ocirc;n ngữ khác và ngược lại</strong></h2>\r\n<div>\r\n<table id=\"wpdtSimpleTable-2\" style=\"width: max-content;\" data-has-header=\"0\" data-responsive=\"0\" data-wpid=\"2\" data-rows=\"19\" data-column=\"3\">\r\n<tbody>\r\n<tr>\r\n<td style=\"height: 22px; width: 197px;\" data-row-index=\"0\" data-col-index=\"0\" data-cell-id=\"A1\">Ng&ocirc;n ngữ (2 chi&ecirc;̀u)</td>\r\n<td style=\"height: 22px; width: 162px;\" data-row-index=\"0\" data-col-index=\"1\" data-cell-id=\"B1\">Tài li&ecirc;̣u đơn giản</td>\r\n<td style=\"height: 22px; width: 172px;\" data-row-index=\"0\" data-col-index=\"2\" data-cell-id=\"C1\">Tài li&ecirc;̣u chuy&ecirc;n ngành</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"1\" data-col-index=\"0\" data-cell-id=\"A2\">Tiếng Anh</td>\r\n<td style=\"height: 22px;\" data-row-index=\"1\" data-col-index=\"1\" data-cell-id=\"B2\">60.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"1\" data-col-index=\"2\" data-cell-id=\"C2\">100.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"2\" data-col-index=\"0\" data-cell-id=\"A3\">Tiếng Trung</td>\r\n<td style=\"height: 22px;\" data-row-index=\"2\" data-col-index=\"1\" data-cell-id=\"B3\">100.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"2\" data-col-index=\"2\" data-cell-id=\"C3\">150.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"3\" data-col-index=\"0\" data-cell-id=\"A4\">Tiếng Nhật</td>\r\n<td style=\"height: 22px;\" data-row-index=\"3\" data-col-index=\"1\" data-cell-id=\"B4\">100.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"3\" data-col-index=\"2\" data-cell-id=\"C4\">150.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"4\" data-col-index=\"0\" data-cell-id=\"A5\">Tiếng H&agrave;n</td>\r\n<td style=\"height: 22px;\" data-row-index=\"4\" data-col-index=\"1\" data-cell-id=\"B5\">100.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"4\" data-col-index=\"2\" data-cell-id=\"C5\">150.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"5\" data-col-index=\"0\" data-cell-id=\"A6\">Tiếng Nga</td>\r\n<td style=\"height: 22px;\" data-row-index=\"5\" data-col-index=\"1\" data-cell-id=\"B6\">100.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"5\" data-col-index=\"2\" data-cell-id=\"C6\">150.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"6\" data-col-index=\"0\" data-cell-id=\"A7\">Tiếng Ph&aacute;p</td>\r\n<td style=\"height: 22px;\" data-row-index=\"6\" data-col-index=\"1\" data-cell-id=\"B7\">100.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"6\" data-col-index=\"2\" data-cell-id=\"C7\">150.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"7\" data-col-index=\"0\" data-cell-id=\"A8\">Tiếng Đức</td>\r\n<td style=\"height: 22px;\" data-row-index=\"7\" data-col-index=\"1\" data-cell-id=\"B8\">100.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"7\" data-col-index=\"2\" data-cell-id=\"C8\">150.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"8\" data-col-index=\"0\" data-cell-id=\"A9\">Tiếng S&eacute;c</td>\r\n<td style=\"height: 22px;\" data-row-index=\"8\" data-col-index=\"1\" data-cell-id=\"B9\">200.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"8\" data-col-index=\"2\" data-cell-id=\"C9\">250.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"9\" data-col-index=\"0\" data-cell-id=\"A10\">Ti&ecirc;́ng Ukraina</td>\r\n<td style=\"height: 22px;\" data-row-index=\"9\" data-col-index=\"1\" data-cell-id=\"B10\">200.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"9\" data-col-index=\"2\" data-cell-id=\"C10\">250.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"10\" data-col-index=\"0\" data-cell-id=\"A11\">Tiếng Italia</td>\r\n<td style=\"height: 22px;\" data-row-index=\"10\" data-col-index=\"1\" data-cell-id=\"B11\">200.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"10\" data-col-index=\"2\" data-cell-id=\"C11\">250.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"11\" data-col-index=\"0\" data-cell-id=\"A12\">Tiếng T&acirc;y Ban Nha</td>\r\n<td style=\"height: 22px;\" data-row-index=\"11\" data-col-index=\"1\" data-cell-id=\"B12\">300.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"11\" data-col-index=\"2\" data-cell-id=\"C12\">400.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"12\" data-col-index=\"0\" data-cell-id=\"A13\">Tiếng Th&aacute;i Lan</td>\r\n<td style=\"height: 22px;\" data-row-index=\"12\" data-col-index=\"1\" data-cell-id=\"B13\">200.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"12\" data-col-index=\"2\" data-cell-id=\"C13\">250.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"13\" data-col-index=\"0\" data-cell-id=\"A14\">Tiếng Campuchia</td>\r\n<td style=\"height: 22px;\" data-row-index=\"13\" data-col-index=\"1\" data-cell-id=\"B14\">300.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"13\" data-col-index=\"2\" data-cell-id=\"C14\">400.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"14\" data-col-index=\"0\" data-cell-id=\"A15\">Tiếng L&agrave;o</td>\r\n<td style=\"height: 22px;\" data-row-index=\"14\" data-col-index=\"1\" data-cell-id=\"B15\">300.000</td>\r\n<td style=\"height: 22px;\" data-row-index=\"14\" data-col-index=\"2\" data-cell-id=\"C15\">400.000</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"15\" data-col-index=\"0\" data-cell-id=\"A16\">Tiếng H&agrave; Lan</td>\r\n<td style=\"height: 22px;\" data-row-index=\"15\" data-col-index=\"1\" data-cell-id=\"B16\">(li&ecirc;n h&ecirc;̣)</td>\r\n<td style=\"height: 22px;\" data-row-index=\"15\" data-col-index=\"2\" data-cell-id=\"C16\">(li&ecirc;n h&ecirc;̣)</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"16\" data-col-index=\"0\" data-cell-id=\"A17\">Tiếng Ba Lan</td>\r\n<td style=\"height: 22px;\" data-row-index=\"16\" data-col-index=\"1\" data-cell-id=\"B17\">(li&ecirc;n h&ecirc;̣)</td>\r\n<td style=\"height: 22px;\" data-row-index=\"16\" data-col-index=\"2\" data-cell-id=\"C17\">(li&ecirc;n h&ecirc;̣)</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" data-row-index=\"17\" data-col-index=\"0\" data-cell-id=\"A18\">Tiếng Bồ Đ&agrave;o Nha</td>\r\n<td style=\"height: 22px;\" data-row-index=\"17\" data-col-index=\"1\" data-cell-id=\"B18\">(li&ecirc;n h&ecirc;̣)</td>\r\n<td style=\"height: 22px;\" data-row-index=\"17\" data-col-index=\"2\" data-cell-id=\"C18\">(li&ecirc;n h&ecirc;̣)</td>\r\n</tr>\r\n<tr>\r\n<td style=\"height: 22px;\" colspan=\"3\" rowspan=\"1\" data-row-index=\"18\" data-col-index=\"0\" data-cell-id=\"A19\">Và các ng&ocirc;n ngữ khác</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<p><strong>Ghi Ch&uacute;:</strong></p>\r\n<p>1. Gi&aacute; dịch thu&acirc;̣t chưa bao gồm VAT.</p>\r\n<p>3. C&oacute; ch&iacute;nh s&aacute;ch ưu đ&atilde;i đặc biệt về gi&aacute; với kh&aacute;ch h&agrave;ng thường xuy&ecirc;n sử dụng dịch vụ của TranslateGroup</p>'),(16,'photocopytrangden(A4)',1000,'<p>Bảng gi&aacute; dịch vụ photo t&agrave;i liệu trắng đen</p>\r\n<ul>\r\n<li>Một mặt : 200 VNĐ&nbsp;&nbsp;</li>\r\n<li>Hai mặt : 220 VNĐ</li>\r\n</ul>\r\n<p>Khi in với số lượng lớn:</p>\r\n<ul>\r\n<li>Số lượng 1000 bản: 150 VNĐ</li>\r\n<li>Số lượng 3000 bản: 100 VNĐ</li>\r\n</ul>'),(18,'inantrangden',5000,'<p>Bảng gi&aacute; in ấn trắng đen:</p>\r\n<ul>\r\n<li>Giấy b&igrave;a cứng:&nbsp; 5000 VNĐ/ bản</li>\r\n</ul>\r\n<p>Với số lượng lớn:</p>\r\n<ul>\r\n<li>1000 bản: 4000 VNĐ/ bản</li>\r\n<li>3000 bản: 3500 VNĐ/ bản</li>\r\n</ul>');
/*!40000 ALTER TABLE `price_service_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receipts`
--

DROP TABLE IF EXISTS `receipts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `receipts` (
  `id_ receipts` bigint NOT NULL AUTO_INCREMENT,
  `id_order` bigint NOT NULL,
  `id_user` bigint NOT NULL,
  `sum_price` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` bigint NOT NULL,
  `method` bigint NOT NULL,
  `receipt_date` date DEFAULT NULL,
  PRIMARY KEY (`id_ receipts`),
  KEY `receipts_ibfk_1` (`status`),
  KEY `method` (`method`),
  KEY `id_user` (`id_user`),
  KEY `id_order` (`id_order`),
  CONSTRAINT `receipts_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status_receipt` (`status_id`),
  CONSTRAINT `receipts_ibfk_2` FOREIGN KEY (`method`) REFERENCES `status_method` (`status_id`),
  CONSTRAINT `receipts_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  CONSTRAINT `receipts_ibfk_4` FOREIGN KEY (`id_order`) REFERENCES `order_master` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receipts`
--

LOCK TABLES `receipts` WRITE;
/*!40000 ALTER TABLE `receipts` DISABLE KEYS */;
INSERT INTO `receipts` VALUES (10,77,4,'5000',1,1,'2024-04-29'),(11,78,4,'5000',1,1,'2024-04-29'),(12,79,4,'25000',2,2,'2024-04-29'),(13,80,4,'300000',1,1,'2024-04-29'),(14,81,4,'300000',1,1,'2024-04-29'),(15,82,4,'300000',1,1,'2024-04-29'),(16,83,7,'200000',2,1,'2024-05-02'),(17,84,7,'25000',2,2,'2024-04-30'),(18,85,4,'300000',1,1,'2024-04-30');
/*!40000 ALTER TABLE `receipts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_master`
--

DROP TABLE IF EXISTS `service_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_master` (
  `service_code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`service_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_master`
--

LOCK TABLES `service_master` WRITE;
/*!40000 ALTER TABLE `service_master` DISABLE KEYS */;
INSERT INTO `service_master` VALUES ('dichthuat','Dịch thuật'),('inan, photocopy','In ấn, photocopy');
/*!40000 ALTER TABLE `service_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_type`
--

DROP TABLE IF EXISTS `service_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_type` (
  `service_type_code` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `service_type_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `service_code` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `service_type_detail` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`service_type_code`),
  KEY `service_code` (`service_code`),
  CONSTRAINT `service_type_ibfk_1` FOREIGN KEY (`service_code`) REFERENCES `service_master` (`service_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_type`
--

LOCK TABLES `service_type` WRITE;
/*!40000 ALTER TABLE `service_type` DISABLE KEYS */;
INSERT INTO `service_type` VALUES ('dichthuatcongchung','Dịch thuật công chứng','dichthuat','<p>Dịch t&agrave;i liệu từ tiếng Việt sang ng&ocirc;n ngữ kh&aacute;c hoặc ngược lại c&oacute; c&ocirc;ng chứng trong thời gian nhanh nhất. Dịch thuật 24h tự h&agrave;o lu&ocirc;n nắm kịp thời những quy định mới nhất của c&aacute;c l&atilde;nh sự qu&aacute;n, cơ quan nh&agrave; nước.</p>'),('dichthuatthongthuong','Dịch thuật thông thường','dichthuat','<p>Dịch thuật tới gần 100 ng&ocirc;n ngữ tr&ecirc;n khắp thế giới. Tất cả quy tr&igrave;nh c&oacute; thể xử l&yacute; online m&agrave; kh&ocirc;ng cần phải tới văn ph&ograve;ng.</p>'),('dichvideo','Dịch thuật video','dichthuat','<p>Ch&uacute;ng t&ocirc;i đ&atilde; c&oacute; nhiều năm kinh nghiệm trong lĩnh vực dịch phim v&agrave; truyền h&igrave;nh, dịch phụ đề v&agrave; lồng tiếng cho c&aacute;c chương tr&igrave;nh truyền h&igrave;nh cũng như c&aacute;c video đ&agrave;o tạo nội bộ trong doanh nghiệp. Ch&uacute;ng t&ocirc;i c&oacute; thể xử l&yacute; nhiều loại định dạng tệp tin đa phương tiện để cung cấp dịch vụ dịch thuật, lồng tiếng v&agrave; phụ đề</p>'),('inantrangden','In ấn trắng đen','inan, photocopy','<p>Dịch vụ in ấn trắng đen cung cấp cho kh&aacute;ch h&agrave;ng in ấn t&agrave;i liệu quan trọng cần thiết khi cần sử dụng giấy b&igrave;a cứng. H&atilde;y đến với ch&uacute;ng t&ocirc;i để được trải nghiệm dịch vụ.</p>'),('phiendich','Phiên dịch','dichthuat','Cung cấp dịch vụ phiên dịch đáp ứng nhu cầu của khách hàng như dịch song song, dịch cabin, dịch ứng đoạn, dịch thầm cho một buổi nói chuyện, gặp mặt, hội nghị,… Dịch thuật 24h có lợi thế cực lớn khi có sẵn đội ngũ phiên dịch viên giỏi, nhiều năm kinh nghiệm tại công ty Cổ phần Giáo dục Quốc tế Trí Tài.'),('photocopytrangden(A4)','Photocopy trắng đen (A4)','inan, photocopy','<p>Dịch vụ photocopy của ch&uacute;ng t&ocirc;i thường được sử dụng để photocopy t&agrave;i liệu với khổ A4. H&atilde;y đến với ch&uacute;ng t&ocirc;i để được trải nghiệm dịch vụ với mức gi&aacute; ưu đ&atilde;i, hấp dẫn</p>');
/*!40000 ALTER TABLE `service_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_type_img`
--

DROP TABLE IF EXISTS `service_type_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_type_img` (
  `service_type_code` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `img` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`service_type_code`),
  CONSTRAINT `service_type_code` FOREIGN KEY (`service_type_code`) REFERENCES `service_type` (`service_type_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_type_img`
--

LOCK TABLES `service_type_img` WRITE;
/*!40000 ALTER TABLE `service_type_img` DISABLE KEYS */;
INSERT INTO `service_type_img` VALUES ('dichthuatcongchung','1714371516_1713952388_CONG-CHUNG.png'),('dichthuatthongthuong','1714371918_dich-thuat-da-ngon-ngu.png'),('dichvideo','1714371906_dichvideo.png'),('inantrangden','1714370933_inantrangden.jpeg'),('photocopytrangden(A4)','1714371201_photocopy.jpg');
/*!40000 ALTER TABLE `service_type_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_master`
--

DROP TABLE IF EXISTS `status_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status_master` (
  `status_id` bigint NOT NULL AUTO_INCREMENT,
  `status` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_master`
--

LOCK TABLES `status_master` WRITE;
/*!40000 ALTER TABLE `status_master` DISABLE KEYS */;
INSERT INTO `status_master` VALUES (1,'Đang xử lý'),(2,'Đã xác nhận'),(3,'Đang hoàn thành'),(4,'Đã hoàn thành');
/*!40000 ALTER TABLE `status_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_method`
--

DROP TABLE IF EXISTS `status_method`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status_method` (
  `status_id` bigint NOT NULL AUTO_INCREMENT,
  `status` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_method`
--

LOCK TABLES `status_method` WRITE;
/*!40000 ALTER TABLE `status_method` DISABLE KEYS */;
INSERT INTO `status_method` VALUES (1,'Thanh toán khi nhận hàng'),(2,'Thanh toán online');
/*!40000 ALTER TABLE `status_method` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_receipt`
--

DROP TABLE IF EXISTS `status_receipt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status_receipt` (
  `status_id` bigint NOT NULL AUTO_INCREMENT,
  `status` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_receipt`
--

LOCK TABLES `status_receipt` WRITE;
/*!40000 ALTER TABLE `status_receipt` DISABLE KEYS */;
INSERT INTO `status_receipt` VALUES (1,'Chưa thanh toán '),(2,'Đã thanh toán');
/*!40000 ALTER TABLE `status_receipt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_reply`
--

DROP TABLE IF EXISTS `status_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status_reply` (
  `status_id` bigint NOT NULL AUTO_INCREMENT,
  `status` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_reply`
--

LOCK TABLES `status_reply` WRITE;
/*!40000 ALTER TABLE `status_reply` DISABLE KEYS */;
INSERT INTO `status_reply` VALUES (1,'Đã trả lời'),(2,'Chưa trả lời');
/*!40000 ALTER TABLE `status_reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `position` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `position` (`position`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`position`) REFERENCES `position-info` (`position_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'Trần Thanh Mới','thanhmoivip123456@gmail.com','$2y$12$iLn5rOyFu9mgN7CArhC/B.A3/TjiLQ9A/0XWciGLUo5bxJeL.YMZ2',3,'2024-03-10 07:08:58','2024-03-10 07:08:58'),(5,'Trần Trung Tính','tinh@gmail.com','$2y$12$hqSByHxcbLdCO1hjApEjjualhIq.8OKuxUuP64oPXps4MX5tYYPne',3,'2024-03-16 21:29:06','2024-03-16 21:29:06'),(6,'Dương Hãi Băng','bang123@gmail.com','$2y$12$noFcOCqXGtqiX3wL7PD4O.KgFlB3nrBfVVFhqCW3V4negaQvT4Xoa',3,'2024-03-19 09:59:34','2024-03-19 09:59:34'),(7,'Trần Thanh Mới','moi123@gmail.com','$2y$12$Oqv5gx68FfgR.u3OKOQlLORoOd0yhBL/03QeNsFBnQ0P6QPWLVsWa',1,'2024-03-19 10:04:41','2024-03-19 10:04:41'),(8,'Phan Anh Quân','thanh@gmail.com','$2y$12$fFp0uJc/OtgevjwZqsEuTukBsnW4qUPA65BtejubzC1islEOEtONW',2,'2024-03-19 10:05:19','2024-04-30 13:27:32'),(9,'Lê Hữu Đức','duc@gmail.com','$2y$12$MVjzmCd58hLH8GVzO8GE/u3z2MiFg0n88JI9.K.xqkfNRAbU8bbDC',3,'2024-04-30 07:51:07','2024-04-30 07:51:07');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-01  1:15:12
