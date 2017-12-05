/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.13-MariaDB : Database - project
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`project` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `project`;

/*Table structure for table `tickets` */

DROP TABLE IF EXISTS `tickets`;

CREATE TABLE `tickets` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `ticket_owner` int(11) NOT NULL,
  `ticket_registrant` int(11) NOT NULL,
  `ticket_origin` int(11) NOT NULL,
  `ticket_origin_city` int(11) NOT NULL,
  `ticket_destination` int(11) NOT NULL,
  `ticket_destination_city` int(11) NOT NULL,
  `ticket_date` datetime NOT NULL,
  `ticket_issue_date` datetime NOT NULL,
  `ticket_cost` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tickets` */

insert  into `tickets`(`id`,`ticket_owner`,`ticket_registrant`,`ticket_origin`,`ticket_origin_city`,`ticket_destination`,`ticket_destination_city`,`ticket_date`,`ticket_issue_date`,`ticket_cost`) values (1,2,1,17,16,7,8,'2017-10-31 00:00:00','2017-10-30 19:45:15',0),(2,3,1,5,3,8,4,'2017-10-31 00:00:00','2017-10-30 20:07:32',0),(3,3,1,5,3,8,4,'2017-10-31 00:00:00','2017-10-30 20:07:53',0),(4,3,1,5,3,8,4,'2017-10-31 00:00:00','2017-10-30 20:08:12',0),(5,3,1,5,3,8,4,'2017-10-31 00:00:00','2017-10-30 20:10:54',0),(6,3,1,5,3,8,4,'2017-10-31 00:00:00','2017-10-30 20:11:21',0),(7,2,1,4,1,8,7,'2017-10-31 00:00:00','2017-10-30 20:15:21',0);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_lname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_rank` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`user_fname`,`user_lname`,`user_email`,`user_password`,`user_rank`) values (1,'Reza','Zare','rezaabilita@gmail.com','Reza0098',5),(2,'Ehsan','Zare','tiger.champ@yahoo.com','ehsannoob',5),(3,'Mehdi','Mohajer','mj@gmail.com','mehdimj',4),(4,'Aaron','Riley','aDdD@gmail.com','1234567',1),(5,'sama','man','saman@man.com','666666',5);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
