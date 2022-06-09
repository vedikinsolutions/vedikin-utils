-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 09, 2022 at 01:37 PM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vedikin-reminder`
--

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
  `site_icon` varchar(255) DEFAULT NULL,
  `menu_order` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_datetime` datetime NOT NULL,
  `is_active` varchar(5) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vdkn_menu`
--

INSERT INTO `vdkn_menu` (`menu_id`, `menu_name`, `listing_page`, `menu_icon`, `site_icon`, `menu_order`, `created_datetime`, `modified_datetime`, `is_active`) VALUES
(1, 'User Role', 'user-role-list', 'user.png', 'fa-users', 2, '2021-02-26 02:22:36', '0000-00-00 00:00:00', 'Y'),
(2, 'Menu', 'menu-list', 'menu.png', 'fa-users', 4, '2021-02-26 02:22:36', '0000-00-00 00:00:00', 'Y'),
(3, 'User Rights', 'user-right-list', 'user.png', 'fa-users', 3, '2021-02-26 02:28:09', '0000-00-00 00:00:00', 'Y'),
(4, 'User', 'user-list', 'user.png', 'fa-users', 1, '2021-02-26 02:28:41', '0000-00-00 00:00:00', 'Y'),
(65, 'Points', 'points-list', '', 'fa fa-users', 14, '2022-06-09 15:24:01', '0000-00-00 00:00:00', 'Y'),
(64, 'Point Category', 'point-category-list', '', 'fa fa-users', 13, '2022-06-09 15:21:01', '0000-00-00 00:00:00', 'Y'),
(63, 'Update History', 'update-history-list', '', 'fa fa-users', 12, '2022-06-04 11:26:40', '0000-00-00 00:00:00', 'Y'),
(62, 'Reminders', 'reminder-list', '', 'fa fa-users', 10, '2022-06-04 11:26:22', '0000-00-00 00:00:00', 'Y'),
(66, 'Point Report', 'point-report-list', '', 'fa fa-users', 15, '2022-06-09 15:30:19', '0000-00-00 00:00:00', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `vdkn_points`
--

DROP TABLE IF EXISTS `vdkn_points`;
CREATE TABLE IF NOT EXISTS `vdkn_points` (
  `points_id` int(11) NOT NULL AUTO_INCREMENT,
  `point_category_id` int(11) NOT NULL,
  `user` varchar(200) NOT NULL,
  `points` int(11) NOT NULL,
  `date` date NOT NULL,
  `remarks` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `modified_datetime` datetime NOT NULL,
  `is_active` varchar(10) NOT NULL,
  PRIMARY KEY (`points_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vdkn_points`
--

INSERT INTO `vdkn_points` (`points_id`, `point_category_id`, `user`, `points`, `date`, `remarks`, `created_by`, `modified_by`, `created_datetime`, `modified_datetime`, `is_active`) VALUES
(1, 1, 'aaa', 200, '2022-06-03', 'aaa', 74, 74, '2022-06-09 13:01:40', '2022-06-09 13:01:40', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `vdkn_point_category`
--

DROP TABLE IF EXISTS `vdkn_point_category`;
CREATE TABLE IF NOT EXISTS `vdkn_point_category` (
  `point_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `point_category_name` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `modified_datetime` datetime NOT NULL,
  `is_active` varchar(11) NOT NULL,
  PRIMARY KEY (`point_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vdkn_point_category`
--

INSERT INTO `vdkn_point_category` (`point_category_id`, `point_category_name`, `created_by`, `modified_by`, `created_datetime`, `modified_datetime`, `is_active`) VALUES
(1, 'category1', 74, 74, '2022-06-09 10:50:55', '2022-06-09 10:50:55', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `vdkn_reminder`
--

DROP TABLE IF EXISTS `vdkn_reminder`;
CREATE TABLE IF NOT EXISTS `vdkn_reminder` (
  `reminder_id` int(11) NOT NULL AUTO_INCREMENT,
  `reminder_title` varchar(200) NOT NULL,
  `reminder_type` varchar(200) NOT NULL,
  `reminder_date` datetime NOT NULL,
  `remarks` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `modified_datetime` datetime NOT NULL,
  `is_active` varchar(10) NOT NULL,
  PRIMARY KEY (`reminder_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vdkn_reminder`
--

INSERT INTO `vdkn_reminder` (`reminder_id`, `reminder_title`, `reminder_type`, `reminder_date`, `remarks`, `created_by`, `modified_by`, `created_datetime`, `modified_datetime`, `is_active`) VALUES
(1, 'title11', 'ssl', '2022-06-09 00:00:00', 'remarks1', 85, 74, '2022-06-04 07:19:28', '2022-06-06 05:51:05', 'Y'),
(2, 'title2', 'ssl', '2022-06-09 00:00:00', 'remarks', 85, 74, '2022-06-04 07:22:02', '2022-06-06 05:51:15', 'Y'),
(5, 'demo', 'ssl', '2022-06-09 00:00:00', 'yy', 74, 74, '2022-06-06 05:24:59', '2022-06-06 05:51:23', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `vdkn_update_history`
--

DROP TABLE IF EXISTS `vdkn_update_history`;
CREATE TABLE IF NOT EXISTS `vdkn_update_history` (
  `update_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `reminder_id` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `next_reminder_date` datetime NOT NULL,
  `remarks` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `modified_datetime` datetime NOT NULL,
  `is_active` varchar(10) NOT NULL,
  PRIMARY KEY (`update_history_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vdkn_update_history`
--

INSERT INTO `vdkn_update_history` (`update_history_id`, `reminder_id`, `updated_date`, `next_reminder_date`, `remarks`, `created_by`, `modified_by`, `created_datetime`, `modified_datetime`, `is_active`) VALUES
(1, 1, '0000-00-00 00:00:00', '2022-06-07 00:00:00', 'remarks', 85, 85, '2022-06-04 09:30:44', '2022-06-04 11:43:43', 'Y');

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
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vdkn_user_master`
--

INSERT INTO `vdkn_user_master` (`user_id`, `user_role_id`, `subscription_id`, `user_name`, `email`, `password`, `phone`, `created_datetime`, `modified_datetime`, `is_active`, `created_by`) VALUES
(1, 1, 0, 'developer', 'admin@vedikin.com', 'developer', '123', '2021-02-26 01:58:31', '2022-06-09 11:53:23', 'Y', 0),
(73, 2, 0, 'master', 'subadmin@gmail.com', 'master', '789', '2021-09-13 13:10:07', '2022-02-22 13:49:40', 'Y', 0),
(74, 3, 74, 'admin', 'client@gmail.com', 'admin', '456', '2021-09-13 13:10:35', '2022-06-09 11:52:48', 'Y', 73),
(85, 13, 0, 'user', 'user@gmail.com', 'user', '0000000000', '2022-02-22 08:47:16', '2022-06-04 10:08:51', 'Y', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vdkn_user_right`
--

INSERT INTO `vdkn_user_right` (`user_right_id`, `user_role_id`, `menu_id`, `user_rights`, `created_datetime`, `modified_datetime`, `is_active`) VALUES
(1, 1, 1, 1, '2022-06-04 11:24:11', '2022-06-04 05:51:41', ''),
(2, 1, 1, 2, '2022-06-04 11:24:11', '2022-06-04 05:51:41', ''),
(3, 1, 1, 3, '2022-06-04 11:24:11', '2022-06-04 05:51:41', ''),
(4, 1, 1, 4, '2022-06-04 11:24:11', '2022-06-04 05:51:41', ''),
(5, 1, 2, 1, '2022-06-04 11:24:11', '2022-06-04 05:51:41', ''),
(6, 1, 2, 2, '2022-06-04 11:24:11', '2022-06-04 05:51:41', ''),
(7, 1, 2, 3, '2022-06-04 11:24:11', '2022-06-04 05:51:41', ''),
(8, 1, 2, 4, '2022-06-04 11:24:11', '2022-06-04 05:51:41', ''),
(9, 1, 3, 1, '2022-06-04 11:24:11', '2022-06-04 05:51:41', ''),
(10, 1, 3, 2, '2022-06-04 11:24:11', '2022-06-04 05:51:41', ''),
(11, 1, 3, 3, '2022-06-04 11:24:11', '2022-06-04 05:51:41', ''),
(12, 1, 3, 4, '2022-06-04 11:24:11', '2022-06-04 05:51:41', ''),
(13, 1, 4, 1, '2022-06-04 11:24:11', '2022-06-04 05:51:41', ''),
(14, 1, 4, 2, '2022-06-04 11:24:11', '2022-06-04 05:51:41', ''),
(15, 1, 4, 3, '2022-06-04 11:24:11', '2022-06-04 05:51:41', ''),
(16, 1, 4, 4, '2022-06-04 11:24:11', '2022-06-04 05:51:41', ''),
(17, 3, 63, 1, '2022-06-04 05:56:59', '0000-00-00 00:00:00', 'Y'),
(18, 3, 63, 2, '2022-06-04 05:56:59', '0000-00-00 00:00:00', 'Y'),
(19, 3, 63, 3, '2022-06-04 05:56:59', '0000-00-00 00:00:00', 'Y'),
(20, 3, 63, 4, '2022-06-04 05:56:59', '0000-00-00 00:00:00', 'Y'),
(21, 3, 62, 1, '2022-06-04 05:57:13', '0000-00-00 00:00:00', 'Y'),
(22, 3, 62, 2, '2022-06-04 05:57:13', '0000-00-00 00:00:00', 'Y'),
(23, 3, 62, 3, '2022-06-04 05:57:13', '0000-00-00 00:00:00', 'Y'),
(24, 3, 62, 4, '2022-06-04 05:57:13', '0000-00-00 00:00:00', 'Y'),
(25, 13, 63, 1, '2022-06-04 05:57:27', '0000-00-00 00:00:00', 'Y'),
(26, 13, 63, 2, '2022-06-04 05:57:27', '0000-00-00 00:00:00', 'Y'),
(27, 13, 63, 3, '2022-06-04 05:57:27', '0000-00-00 00:00:00', 'Y'),
(28, 13, 63, 4, '2022-06-04 05:57:27', '0000-00-00 00:00:00', 'Y'),
(29, 13, 62, 1, '2022-06-04 05:57:39', '0000-00-00 00:00:00', 'Y'),
(30, 13, 62, 2, '2022-06-04 05:57:39', '0000-00-00 00:00:00', 'Y'),
(31, 13, 62, 3, '2022-06-04 05:57:39', '0000-00-00 00:00:00', 'Y'),
(32, 13, 62, 4, '2022-06-04 05:57:39', '0000-00-00 00:00:00', 'Y'),
(33, 1, 64, 1, '2022-06-09 09:51:37', '0000-00-00 00:00:00', 'Y'),
(34, 1, 64, 2, '2022-06-09 09:51:37', '0000-00-00 00:00:00', 'Y'),
(35, 1, 64, 3, '2022-06-09 09:51:37', '0000-00-00 00:00:00', 'Y'),
(36, 1, 64, 4, '2022-06-09 09:51:37', '0000-00-00 00:00:00', 'Y'),
(37, 2, 64, 1, '2022-06-09 09:52:15', '0000-00-00 00:00:00', 'Y'),
(38, 2, 64, 2, '2022-06-09 09:52:15', '0000-00-00 00:00:00', 'Y'),
(39, 2, 64, 3, '2022-06-09 09:52:15', '0000-00-00 00:00:00', 'Y'),
(40, 2, 64, 4, '2022-06-09 09:52:15', '0000-00-00 00:00:00', 'Y'),
(41, 3, 64, 1, '2022-06-09 09:52:31', '0000-00-00 00:00:00', 'Y'),
(42, 3, 64, 2, '2022-06-09 09:52:31', '0000-00-00 00:00:00', 'Y'),
(43, 3, 64, 3, '2022-06-09 09:52:31', '0000-00-00 00:00:00', 'Y'),
(44, 3, 64, 4, '2022-06-09 09:52:31', '0000-00-00 00:00:00', 'Y'),
(45, 13, 64, 1, '2022-06-09 09:52:51', '0000-00-00 00:00:00', 'Y'),
(46, 13, 64, 2, '2022-06-09 09:52:51', '0000-00-00 00:00:00', 'Y'),
(47, 13, 64, 3, '2022-06-09 09:52:51', '0000-00-00 00:00:00', 'Y'),
(48, 13, 64, 4, '2022-06-09 09:52:51', '0000-00-00 00:00:00', 'Y'),
(49, 1, 65, 1, '2022-06-09 09:56:17', '0000-00-00 00:00:00', 'Y'),
(50, 1, 65, 2, '2022-06-09 09:56:17', '0000-00-00 00:00:00', 'Y'),
(51, 1, 65, 3, '2022-06-09 09:56:17', '0000-00-00 00:00:00', 'Y'),
(52, 1, 65, 4, '2022-06-09 09:56:17', '0000-00-00 00:00:00', 'Y'),
(53, 2, 65, 1, '2022-06-09 09:56:37', '0000-00-00 00:00:00', 'Y'),
(54, 2, 65, 2, '2022-06-09 09:56:37', '0000-00-00 00:00:00', 'Y'),
(55, 2, 65, 3, '2022-06-09 09:56:37', '0000-00-00 00:00:00', 'Y'),
(56, 2, 65, 4, '2022-06-09 09:56:37', '0000-00-00 00:00:00', 'Y'),
(57, 3, 65, 1, '2022-06-09 09:56:52', '0000-00-00 00:00:00', 'Y'),
(58, 3, 65, 2, '2022-06-09 09:56:52', '0000-00-00 00:00:00', 'Y'),
(59, 3, 65, 3, '2022-06-09 09:56:52', '0000-00-00 00:00:00', 'Y'),
(60, 3, 65, 4, '2022-06-09 09:56:52', '0000-00-00 00:00:00', 'Y'),
(61, 13, 65, 1, '2022-06-09 09:57:10', '0000-00-00 00:00:00', 'Y'),
(62, 13, 65, 2, '2022-06-09 09:57:10', '0000-00-00 00:00:00', 'Y'),
(63, 13, 65, 3, '2022-06-09 09:57:10', '0000-00-00 00:00:00', 'Y'),
(64, 13, 65, 4, '2022-06-09 09:57:10', '0000-00-00 00:00:00', 'Y'),
(65, 1, 66, 1, '2022-06-09 10:01:10', '0000-00-00 00:00:00', 'Y'),
(66, 1, 66, 2, '2022-06-09 10:01:10', '0000-00-00 00:00:00', 'Y'),
(67, 1, 66, 3, '2022-06-09 10:01:10', '0000-00-00 00:00:00', 'Y'),
(68, 1, 66, 4, '2022-06-09 10:01:10', '0000-00-00 00:00:00', 'Y'),
(69, 2, 66, 1, '2022-06-09 10:01:24', '0000-00-00 00:00:00', 'Y'),
(70, 2, 66, 2, '2022-06-09 10:01:24', '0000-00-00 00:00:00', 'Y'),
(71, 2, 66, 3, '2022-06-09 10:01:24', '0000-00-00 00:00:00', 'Y'),
(72, 2, 66, 4, '2022-06-09 10:01:24', '0000-00-00 00:00:00', 'Y'),
(73, 3, 66, 1, '2022-06-09 10:01:39', '0000-00-00 00:00:00', 'Y'),
(74, 3, 66, 2, '2022-06-09 10:01:39', '0000-00-00 00:00:00', 'Y'),
(75, 3, 66, 3, '2022-06-09 10:01:39', '0000-00-00 00:00:00', 'Y'),
(76, 3, 66, 4, '2022-06-09 10:01:39', '0000-00-00 00:00:00', 'Y'),
(77, 13, 66, 1, '2022-06-09 10:01:53', '0000-00-00 00:00:00', 'Y'),
(78, 13, 66, 2, '2022-06-09 10:01:53', '0000-00-00 00:00:00', 'Y'),
(79, 13, 66, 3, '2022-06-09 10:01:53', '0000-00-00 00:00:00', 'Y'),
(80, 13, 66, 4, '2022-06-09 10:01:53', '0000-00-00 00:00:00', 'Y');

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vdkn_user_role`
--

INSERT INTO `vdkn_user_role` (`user_role_id`, `user_role_name`, `is_active`, `created_datetime`, `modified_datetime`) VALUES
(1, 'Developer Admin', 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Master Admin', 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Admin', 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'User', 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
