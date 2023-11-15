/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.27-MariaDB : Database - absensi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`absensi` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `absensi`;

/*Table structure for table `absensi` */

DROP TABLE IF EXISTS `absensi`;

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT curdate(),
  `jam_masuk` time NOT NULL DEFAULT curtime(),
  `jam_pulang` time NOT NULL DEFAULT curtime(),
  `keterangan_izin` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_karyawan` (`id_karyawan`),
  CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `absensi` */

insert  into `absensi`(`id`,`id_karyawan`,`kegiatan`,`date`,`jam_masuk`,`jam_pulang`,`keterangan_izin`,`status`) values 
(2,1,'-','2023-10-14','00:00:00','00:00:00','Dispen','true'),
(3,1,'Upacara','2023-10-16','08:50:51','16:14:42','masuk','true'),
(4,1,'mengaji','2023-10-12','08:50:51','16:34:42','masuk','true'),
(12,1,'-','2023-10-17','00:00:00','00:00:00','Cikumunya','true'),
(14,1,'Berdoa','2023-10-19','08:23:33','08:41:38','masuk','true'),
(15,1,'upacara','2023-10-20','09:55:38','09:56:46','masuk','true'),
(16,11,'ngaji','2023-10-23','11:11:38','00:00:00','masuk','false'),
(17,1,'coding','2023-10-24','11:47:34','11:48:16','masuk','true');

/*Table structure for table `organisasi` */

DROP TABLE IF EXISTS `organisasi`;

CREATE TABLE `organisasi` (
  `id_organisasi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_organisasi` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nomor_telepon` varchar(15) NOT NULL,
  `email_organisasi` varchar(255) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kabupaten` varchar(100) NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  PRIMARY KEY (`id_organisasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `organisasi` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama_depan` varchar(50) NOT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`email`,`nama_depan`,`nama_belakang`,`password`,`image`,`role`) values 
(1,'dewipsari15','dewi@gmail.com','dewi','sari','c30b831b248007b68280876bc2394931','dewi-formal.png','karyawan'),
(2,'pulungsari','pulung@gmail.com','sari','pulung','c30b831b248007b68280876bc2394931','IMG_08901.JPG','admin'),
(9,'aruna123','aruna@gmail.com','aruna','ninda','25d55ad283aa400af464c76d713c07ad','User.png','karyawan'),
(10,'mala18','mala@gmail.com','mala','filla','25d55ad283aa400af464c76d713c07ad','User.png','admin'),
(11,'tsania','tsania@gmail.com','faza','tsania','5e8667a439c68f5145dd2fcbecf02209','User.png','karyawan'),
(12,'ming','ming@gmail.com','aveceena','ming','25d55ad283aa400af464c76d713c07ad','User.png','admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
