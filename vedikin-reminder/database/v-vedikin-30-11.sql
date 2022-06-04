-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Nov 30, 2021 at 07:42 AM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `v-vedikin`
--

-- --------------------------------------------------------

--
-- Table structure for table `vdkn_configuration`
--

DROP TABLE IF EXISTS `vdkn_configuration`;
CREATE TABLE IF NOT EXISTS `vdkn_configuration` (
  `configuration_id` int(11) NOT NULL AUTO_INCREMENT,
  `configuration_type` varchar(255) NOT NULL,
  `configuration_name` varchar(255) NOT NULL,
  `configuration_value` varchar(255) NOT NULL,
  `is_active` varchar(1) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_datetime` datetime NOT NULL,
  PRIMARY KEY (`configuration_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vdkn_configuration`
--

INSERT INTO `vdkn_configuration` (`configuration_id`, `configuration_type`, `configuration_name`, `configuration_value`, `is_active`, `created_datetime`, `modified_datetime`) VALUES
(30, 'vbnbn', 'hmgh', '               vbnvbnvbn                                     ', '', '2021-11-27 11:26:03', '0000-00-00 00:00:00'),
(31, 'erwer', 'erwrw', '                dfgdfggfdg                                    ', '', '2021-11-27 11:26:03', '0000-00-00 00:00:00'),
(32, 'test', 'test', 'test                                                    ', 'Y', '2021-11-27 11:26:03', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vdkn_menu`
--

DROP TABLE IF EXISTS `vdkn_menu`;
CREATE TABLE IF NOT EXISTS `vdkn_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) NOT NULL,
  `listing_page` varchar(255) NOT NULL,
  `menu_icon` varchar(255) NOT NULL,
  `site_icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `menu_order` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_datetime` datetime NOT NULL,
  `is_active` varchar(5) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vdkn_menu`
--

INSERT INTO `vdkn_menu` (`menu_id`, `menu_name`, `listing_page`, `menu_icon`, `site_icon`, `menu_order`, `created_datetime`, `modified_datetime`, `is_active`) VALUES
(1, 'User Role', 'user-role-list', 'user.png', 'fa-users', 2, '2021-02-26 02:22:36', '0000-00-00 00:00:00', 'Y'),
(2, 'Menu', 'menu-list', 'menu.png', 'fa-users', 4, '2021-02-26 02:22:36', '0000-00-00 00:00:00', 'Y'),
(3, 'User Rights', 'user-right-list', 'user.png', 'fa-users', 3, '2021-02-26 02:28:09', '0000-00-00 00:00:00', 'Y'),
(4, 'User', 'user-list', 'user.png', 'fa-users', 1, '2021-02-26 02:28:41', '0000-00-00 00:00:00', 'Y'),
(28, 'Configuration', 'configuration-list', 'user.png', 'fa-users', 5, '2021-09-11 15:39:33', '0000-00-00 00:00:00', 'Y'),
(57, 'order', 'order-master-list', 'user.png', 'fa-users', 0, '2021-11-30 10:50:59', '0000-00-00 00:00:00', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `vdkn_order_master`
--

DROP TABLE IF EXISTS `vdkn_order_master`;
CREATE TABLE IF NOT EXISTS `vdkn_order_master` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `order_amount` float NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `order_status_id` int(11) DEFAULT NULL,
  `payment_receipt` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL,
  `modified_datetime` datetime NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vdkn_order_product`
--

DROP TABLE IF EXISTS `vdkn_order_product`;
CREATE TABLE IF NOT EXISTS `vdkn_order_product` (
  `order_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL,
  PRIMARY KEY (`order_product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vdkn_order_product`
--

INSERT INTO `vdkn_order_product` (`order_product_id`, `order_id`, `product_id`, `product_qty`) VALUES
(88, 1, 3, 1),
(68, 3, 2, 1),
(15, 4, 2, 20),
(87, 1, 1, 10),
(86, 1, 1, 1),
(85, 1, 2, 100),
(14, 4, 1, 100),
(13, 4, 2, 10),
(16, 7, 1, 1000),
(105, 8, 1, 10),
(18, 9, 1, 1),
(84, 1, 2, 220),
(24, 10, 1, 1),
(104, 8, 2, 2),
(103, 8, 3, 3),
(102, 8, 1, 1),
(101, 8, 3, 15);

-- --------------------------------------------------------

--
-- Table structure for table `vdkn_order_status`
--

DROP TABLE IF EXISTS `vdkn_order_status`;
CREATE TABLE IF NOT EXISTS `vdkn_order_status` (
  `order_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_status_name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`order_status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vdkn_order_status`
--

INSERT INTO `vdkn_order_status` (`order_status_id`, `order_status_name`, `created_by`) VALUES
(1, 'New', 73),
(2, 'Processed', 0),
(3, 'Completed', 0),
(4, 'Cancelled', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vdkn_user_master`
--

DROP TABLE IF EXISTS `vdkn_user_master`;
CREATE TABLE IF NOT EXISTS `vdkn_user_master` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_datetime` datetime NOT NULL,
  `is_active` varchar(5) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vdkn_user_master`
--

INSERT INTO `vdkn_user_master` (`user_id`, `user_role_id`, `subscription_id`, `user_name`, `email`, `password`, `phone`, `created_datetime`, `modified_datetime`, `is_active`, `created_by`) VALUES
(1, 1, 0, 'developer', 'admin@vedikin.com', 'developer', '123', '2021-02-26 01:58:31', '2021-11-30 07:06:40', 'Y', 0),
(73, 2, 0, 'master', 'subadmin@gmail.com', 'master', '789', '2021-09-13 13:10:07', '2021-11-30 06:58:21', 'Y', 0),
(74, 3, 74, 'admin', 'client@gmail.com', 'admin', '456', '2021-09-13 13:10:35', '2021-11-30 05:46:12', 'Y', 73);

-- --------------------------------------------------------

--
-- Table structure for table `vdkn_user_right`
--

DROP TABLE IF EXISTS `vdkn_user_right`;
CREATE TABLE IF NOT EXISTS `vdkn_user_right` (
  `user_right_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `user_rights` int(11) NOT NULL COMMENT '1=view,2=add,3=edit,4=delete',
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_datetime` datetime NOT NULL,
  `is_active` varchar(5) NOT NULL,
  PRIMARY KEY (`user_right_id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vdkn_user_right`
--

INSERT INTO `vdkn_user_right` (`user_right_id`, `user_role_id`, `menu_id`, `user_rights`, `created_datetime`, `modified_datetime`, `is_active`) VALUES
(1, 1, 3, 2, '2021-11-22 10:55:19', '0000-00-00 00:00:00', 'Y'),
(2, 1, 3, 3, '2021-11-22 10:55:23', '0000-00-00 00:00:00', 'Y'),
(3, 1, 3, 4, '2021-11-22 10:55:29', '0000-00-00 00:00:00', 'Y'),
(54, 13, 57, 1, '2021-11-30 10:50:59', '0000-00-00 00:00:00', 'Y'),
(53, 3, 57, 2, '2021-11-30 10:50:59', '0000-00-00 00:00:00', 'Y'),
(52, 2, 57, 4, '2021-11-30 10:50:59', '0000-00-00 00:00:00', 'Y'),
(51, 2, 57, 3, '2021-11-30 10:50:59', '0000-00-00 00:00:00', 'Y'),
(10, 2, 28, 2, '2021-11-27 05:00:02', '0000-00-00 00:00:00', 'Y'),
(11, 2, 28, 3, '2021-11-27 05:00:02', '0000-00-00 00:00:00', 'Y'),
(12, 2, 28, 4, '2021-11-27 05:00:02', '0000-00-00 00:00:00', 'Y'),
(50, 1, 57, 4, '2021-11-30 10:50:59', '0000-00-00 00:00:00', 'Y'),
(49, 1, 57, 3, '2021-11-30 10:50:59', '0000-00-00 00:00:00', 'Y'),
(48, 1, 57, 2, '2021-11-30 10:50:59', '0000-00-00 00:00:00', 'Y'),
(16, 1, 1, 2, '2021-11-27 10:49:52', '0000-00-00 00:00:00', 'Y'),
(17, 1, 1, 3, '2021-11-27 10:49:52', '0000-00-00 00:00:00', 'Y'),
(18, 1, 1, 4, '2021-11-27 10:49:52', '0000-00-00 00:00:00', 'Y'),
(19, 1, 2, 2, '2021-11-27 10:50:03', '0000-00-00 00:00:00', 'Y'),
(20, 1, 2, 3, '2021-11-27 10:50:03', '0000-00-00 00:00:00', 'Y'),
(21, 1, 2, 4, '2021-11-27 10:50:03', '0000-00-00 00:00:00', 'Y'),
(22, 1, 4, 2, '2021-11-27 10:50:11', '0000-00-00 00:00:00', 'Y'),
(23, 1, 4, 3, '2021-11-27 10:50:11', '0000-00-00 00:00:00', 'Y'),
(24, 1, 4, 4, '2021-11-27 10:50:11', '0000-00-00 00:00:00', 'Y'),
(25, 1, 28, 2, '2021-11-27 10:50:19', '0000-00-00 00:00:00', 'Y'),
(26, 1, 28, 3, '2021-11-27 10:50:19', '0000-00-00 00:00:00', 'Y'),
(27, 1, 28, 4, '2021-11-27 10:50:19', '0000-00-00 00:00:00', 'Y'),
(46, 3, 4, 2, '2021-11-27 12:34:30', '0000-00-00 00:00:00', 'Y'),
(47, 3, 4, 3, '2021-11-27 12:34:30', '0000-00-00 00:00:00', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `vdkn_user_role`
--

DROP TABLE IF EXISTS `vdkn_user_role`;
CREATE TABLE IF NOT EXISTS `vdkn_user_role` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_name` varchar(255) NOT NULL,
  `is_active` varchar(1) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `modified_datetime` datetime NOT NULL,
  PRIMARY KEY (`user_role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vdkn_user_role`
--

INSERT INTO `vdkn_user_role` (`user_role_id`, `user_role_name`, `is_active`, `created_datetime`, `modified_datetime`) VALUES
(1, 'Developer Admin', 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Master Admin', 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Admin', 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'DO', 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
