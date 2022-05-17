/*
SQLyog Ultimate v12.5.1 (32 bit)
MySQL - 10.1.38-MariaDB : Database - deposit
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`deposit` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `deposit`;

/*Table structure for table `account` */

DROP TABLE IF EXISTS `account`;

CREATE TABLE `account` (
  `pkey` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`pkey`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `account` */

insert  into `account`(`pkey`,`username`,`name`,`password`,`role`,`img`) values 
(1,'admin','yayan','0192023a7bbd73250516f069df18b500',1,''),
(5,'yayan1','Guru','0192023a7bbd73250516f069df18b500',2,''),
(8,'adminn2','test','d41d8cd98f00b204e9800998ecf8427e',2,'');

/*Table structure for table `banner` */

DROP TABLE IF EXISTS `banner`;

CREATE TABLE `banner` (
  `pkey` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `createon` int(11) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  KEY `pkey` (`pkey`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `banner` */

insert  into `banner`(`pkey`,`name`,`img`,`createon`,`time`,`status`) values 
(1,'Laskar Point Reward','1648440151.jpg',1,'1648440151',1),
(4,'aaaaaaaa','1648449418.jpg',1,'1648449418',1);

/*Table structure for table `claim` */

DROP TABLE IF EXISTS `claim`;

CREATE TABLE `claim` (
  `pkey` int(11) NOT NULL AUTO_INCREMENT,
  `time` varchar(255) DEFAULT NULL,
  `createon` int(11) DEFAULT NULL,
  `customerkey` int(11) DEFAULT NULL,
  `rewardkey` int(11) DEFAULT NULL,
  `rewardpoint` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  KEY `pkey` (`pkey`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `claim` */

insert  into `claim`(`pkey`,`time`,`createon`,`customerkey`,`rewardkey`,`rewardpoint`,`note`) values 
(1,'1650863932',1,23,2,'111','asac');

/*Table structure for table `class` */

DROP TABLE IF EXISTS `class`;

CREATE TABLE `class` (
  `pkey` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  KEY `pkey` (`pkey`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `class` */

insert  into `class`(`pkey`,`name`) values 
(2,'2.a'),
(3,'3.a'),
(4,'1.a');

/*Table structure for table `content` */

DROP TABLE IF EXISTS `content`;

CREATE TABLE `content` (
  `pkey` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `createon` int(11) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `content` longtext,
  KEY `pkey` (`pkey`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `content` */

insert  into `content`(`pkey`,`name`,`status`,`createon`,`time`,`content`) values 
(3,'bodynya',1,1,'1648456979','<h2 style=\"text-align: center;\"><span style=\"color: #ff0000;\"><strong>LASKAR138 Point Reward</strong></span></h2>\r\n<p style=\"text-align: center;\"><strong>Seluruh member LASKAR138 akan mendapatkan Point Reward sebagai Loyalty apresiasi dari LASKAR138</strong> <strong>Dengan Minimal Deposit 100rb Rupiah Pemain akan mendapatkan Point Reward yang dapat ditukar dengan Hadiah</strong></p>\r\n<div class=\"elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-3c53e48 animated-fast animated fadeInUp\" data-id=\"3c53e48\" data-element_type=\"column\" data-settings=\"{&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;animation_delay&quot;:1000}\">\r\n<div class=\"elementor-widget-wrap elementor-element-populated\">\r\n<div class=\"elementor-element elementor-element-689e4fe elementor-widget elementor-widget-image\" data-id=\"689e4fe\" data-element_type=\"widget\" data-widget_type=\"image.default\">\r\n<div class=\"elementor-widget-container\"><strong><img class=\" lazyloaded\" title=\"\" src=\"https://bookingmarketplace.getdokan.com/wp-content/uploads/2019/08/icon3.png\" alt=\"\" data-src=\"https://bookingmarketplace.getdokan.com/wp-content/uploads/2019/08/icon3.png\" /></strong></div>\r\n</div>\r\n<div class=\"elementor-element elementor-element-0ed1b4b elementor-widget elementor-widget-heading\" data-id=\"0ed1b4b\" data-element_type=\"widget\" data-widget_type=\"heading.default\">\r\n<div class=\"elementor-widget-container\">\r\n<div class=\"elementor-heading-title elementor-size-default\" style=\"text-align: center;\"><strong>Pemain juga mendapatkan akses Deposit dan Withdraw yang khusus dengan VIP Laskar138</strong></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<p>&nbsp;</p>\r\n<p><strong>LASKAR POINT REWARD</strong>&nbsp;adalah Point Royalti yang diberikan untuk para pemain&nbsp;<strong>LASKAR138</strong>&nbsp;yang setia. Yang selalu mendapatkan Point Reward Dari setiap deposit Minimal 100.000,- Rupiah.&nbsp;<strong>LASKAR POINT REWARD</strong>&nbsp;dapat ditukarkan dengan Hadiah hadiah yang menarik yang ditawarkan oleh&nbsp;<strong>LASKAR138</strong>. Oleh sebab itu seluruh pemain di&nbsp;<strong>LASKAR138</strong>&nbsp;dapat menukarkan Point Tersebut dengan Hadiah hadiah yang ditawarkan TANPA HARUS DIUNDI</p>\r\n<p>Dengan melakukan deposit minimal 100.000 Pemain akan dilayani secara VIP oleh Costumer Service&nbsp;<strong>LASKAR138</strong>&nbsp;yang memiliki keuntungan Prioritas dalam Deposit, Withdraw maupun gangguan dalam permaianan. Nikmatilah Prioritas dalam bermain di situs&nbsp;<strong>LASKAR138</strong></p>\r\n<ul>\r\n<li>Deposit Rp 100.000,-&nbsp; mendapatkan Point&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<span style=\"color: #ff0000;\"><strong>25 POINT&nbsp;</strong></span></li>\r\n<li>Deposit Rp 500.000,- mendapatkan Point&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<span style=\"color: #ff0000;\"><strong>150 POINT</strong></span></li>\r\n<li>Deposit Rp 1.000.000,- mendapatkan Point &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style=\"color: #ff0000;\"><strong>350 POINT</strong></span></li>\r\n</ul>\r\n<div>\r\n<p><em>Syarat Dan Ketentuan sebagai berikut :</em></p>\r\n<ol>\r\n<li>Deposit untuk mendapatkan point</li>\r\n<li>Hanya cukup melakukan deposit dengan nominal yang sesuai dan VIP chat akan membantu anda dalam mendapatkan Point LASKAR138 Reward</li>\r\n<li>Deposit Via Pulsa tidak bisa klaim Point Reward</li>\r\n<li>Untuk penukaran POINT REWARD harap Klaim melalui Livechat VIP kami</li>\r\n<li>Untuk pengiriman hadiah paling lamban 3 x 24 jam ( Hari Kerja )</li>\r\n<li>Untuk pengklaiman Wajib mengisi Formulir Data diri</li>\r\n<li>Promo ini dapat berubah kapan saja tanpa pemberitahuan terlebih dahulu</li>\r\n<li>Semua keputusan LASKAR138 bersifat mutlak dan tidak bisa diganggu gugat</li>\r\n</ol>\r\n</div>');

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `pkey` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `createon` int(11) DEFAULT NULL,
  `createtimestamp` varchar(255) DEFAULT NULL,
  `modifby` int(11) DEFAULT NULL,
  `modiftimestamp` varchar(255) DEFAULT NULL,
  `temppoint` int(11) DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `levelkey` int(11) DEFAULT NULL,
  KEY `pkey` (`pkey`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `customer` */

insert  into `customer`(`pkey`,`name`,`createon`,`createtimestamp`,`modifby`,`modiftimestamp`,`temppoint`,`point`,`levelkey`) values 
(23,'yayan',1,'1648358889',NULL,NULL,2389,2500,4);

/*Table structure for table `deposit` */

DROP TABLE IF EXISTS `deposit`;

CREATE TABLE `deposit` (
  `pkey` int(11) NOT NULL AUTO_INCREMENT,
  `createon` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  KEY `pkey` (`pkey`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `deposit` */

insert  into `deposit`(`pkey`,`createon`,`name`,`point`) values 
(2,1,'100k',25),
(3,1,'500k',150),
(4,1,'1m',350);

/*Table structure for table `deposit_transaction` */

DROP TABLE IF EXISTS `deposit_transaction`;

CREATE TABLE `deposit_transaction` (
  `pkey` int(11) NOT NULL AUTO_INCREMENT,
  `customerkey` int(11) DEFAULT NULL,
  `createon` int(11) DEFAULT NULL,
  `depositkey` int(11) DEFAULT NULL,
  `calculate` int(11) DEFAULT NULL,
  `totalpoint` int(11) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  KEY `pkey` (`pkey`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

/*Data for the table `deposit_transaction` */

insert  into `deposit_transaction`(`pkey`,`customerkey`,`createon`,`depositkey`,`calculate`,`totalpoint`,`time`,`note`) values 
(42,23,1,2,100,2500,'1648358993','ascasc');

/*Table structure for table `head` */

DROP TABLE IF EXISTS `head`;

CREATE TABLE `head` (
  `pkey` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `createon` int(11) DEFAULT NULL,
  `html` longtext,
  `status` int(11) DEFAULT '0',
  KEY `pkey` (`pkey`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `head` */

insert  into `head`(`pkey`,`name`,`time`,`createon`,`html`,`status`) values 
(1,'nama head','1648457125',1,'<style>\r\n        body {\r\n            background-color: #FFA20B;\r\n        }\r\n    </style>\r\n\r\n<!-- Start of LiveChat (www.livechatinc.com) code -->\r\n<script>\r\n    window.__lc = window.__lc || {};\r\n    window.__lc.license = 13477266;\r\n    ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:\"2.0\",on:function(){i([\"on\",c.call(arguments)])},once:function(){i([\"once\",c.call(arguments)])},off:function(){i([\"off\",c.call(arguments)])},get:function(){if(!e._h)throw new Error(\"[LiveChatWidget] You can\'t use getters before load.\");return i([\"get\",c.call(arguments)])},call:function(){i([\"call\",c.call(arguments)])},init:function(){var n=t.createElement(\"script\");n.async=!0,n.type=\"text/javascript\",n.src=\"https://cdn.livechatinc.com/tracking.js\",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))\r\n</script>\r\n<noscript><a href=\"https://www.livechatinc.com/chat-with/13477266/\" rel=\"nofollow\">Chat with us</a>, powered by <a href=\"https://www.livechatinc.com/?welcome\" rel=\"noopener nofollow\" target=\"_blank\">LiveChat</a></noscript>\r\n<!-- End of LiveChat code -->',1),
(2,'scasc','1648199521',1,'ascascasc',0);

/*Table structure for table `level` */

DROP TABLE IF EXISTS `level`;

CREATE TABLE `level` (
  `pkey` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `rankpoint` int(11) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  KEY `pkey` (`pkey`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `level` */

insert  into `level`(`pkey`,`name`,`rankpoint`,`img`) values 
(2,'Bronze',10,'1648451619.png'),
(1,'silver',100,'1648451684.png'),
(3,'Gold',500,'1648451700.png'),
(4,'Platinum',1000,'1648451711.png');

/*Table structure for table `link` */

DROP TABLE IF EXISTS `link`;

CREATE TABLE `link` (
  `pkey` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `createon` int(11) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `wa` varchar(255) DEFAULT NULL,
  `in` varchar(255) DEFAULT NULL,
  `register` varchar(255) DEFAULT NULL,
  `claim` varchar(255) DEFAULT NULL,
  KEY `pkey` (`pkey`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `link` */

insert  into `link`(`pkey`,`name`,`status`,`createon`,`time`,`wa`,`in`,`register`,`claim`) values 
(1,'testing',0,1,'1648352850','2555454541','https://www.youtube.com/watch?v=-kNdjdxQ-pc','https://www.youtube.com/watch?v=-kNdjdxQ-pc','https://www.facebook.com/'),
(2,'yang benar',1,1,'1648353155','https://wa.me/6281532380661','https://94.237.75.152/account/register','https://94.237.75.152/account/register','https://www.youtube.com/');

/*Table structure for table `memori` */

DROP TABLE IF EXISTS `memori`;

CREATE TABLE `memori` (
  `pkey` int(11) NOT NULL AUTO_INCREMENT,
  `classkey` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  KEY `pkey` (`pkey`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `memori` */

insert  into `memori`(`pkey`,`classkey`,`name`) values 
(1,2,'Tahfidz Juz 30'),
(3,2,'Bab shalat'),
(4,NULL,'2');

/*Table structure for table `memori_detail` */

DROP TABLE IF EXISTS `memori_detail`;

CREATE TABLE `memori_detail` (
  `pkey` int(11) NOT NULL AUTO_INCREMENT,
  `memorikey` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  KEY `pkey` (`pkey`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `memori_detail` */

insert  into `memori_detail`(`pkey`,`memorikey`,`name`) values 
(1,1,'S.Al-Fatihah'),
(2,1,'S.Al-Ikhlas'),
(8,2,'asdsasd'),
(9,2,'3456'),
(10,2,'fghfgh'),
(11,3,'Niat shalat'),
(12,3,'Doa iftitah'),
(13,3,'Doa qunut'),
(14,3,'Tahiyat awal'),
(15,3,'Tahiyat akhir'),
(16,1,'S.Al-Falaq'),
(17,4,'cobasaja'),
(18,4,'coba123');

/*Table structure for table `profile_company` */

DROP TABLE IF EXISTS `profile_company`;

CREATE TABLE `profile_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `titlelogin` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `profile_company` */

insert  into `profile_company`(`id`,`name`,`alamat`,`telepon`,`phone`,`titlelogin`,`logo`,`title`) values 
(1,'LASKAR 138','testing','2345423','234532','Deposit','logo.png','');

/*Table structure for table `reward` */

DROP TABLE IF EXISTS `reward`;

CREATE TABLE `reward` (
  `pkey` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `createon` int(11) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `point` varchar(255) DEFAULT NULL,
  KEY `pkey` (`pkey`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `reward` */

insert  into `reward`(`pkey`,`title`,`name`,`img`,`createon`,`time`,`point`) values 
(2,'NEW PAJERO GR-SPORT','KENDARAAN','1648466070.png',1,'1648466070','111'),
(3,'NEW AGYA GR-SPORT','KENDARAAN','1648466099.png',1,'1648466099','56000'),
(4,'CBR 250-RR','KENDARAAN','1648466123.png',1,'1648466123','12300'),
(5,'EMAS BATANGAN 50GRAM','PERHIASAN','1648466187.png',1,'1648466187','308000');

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `pkey` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  KEY `pkey` (`pkey`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `role` */

insert  into `role`(`pkey`,`name`) values 
(1,'Super Admin'),
(2,'Admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
