-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 29, 2018 at 04:48 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_model`
--

DROP TABLE IF EXISTS `car_model`;
CREATE TABLE IF NOT EXISTS `car_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `st_model_name` varchar(160) NOT NULL COMMENT 'Model Name',
  `st_color` varchar(160) NOT NULL COMMENT 'Model Color',
  `st_reg_no` varchar(160) NOT NULL COMMENT 'Models Registration Number',
  `dt_manu_year` datetime NOT NULL,
  `st_note` mediumtext NOT NULL,
  `st_image` mediumtext,
  `int_manu_id` int(11) NOT NULL COMMENT 'manufactures id',
  `dt_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `st_reg_no` (`st_reg_no`),
  KEY `foreign_key` (`int_manu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manufacture_data`
--

DROP TABLE IF EXISTS `manufacture_data`;
CREATE TABLE IF NOT EXISTS `manufacture_data` (
  `int_man_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'manufacture id',
  `st_manu_name` varchar(160) COLLATE utf8_bin NOT NULL COMMENT 'manufactures name',
  `dt_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date_created',
  PRIMARY KEY (`int_man_id`),
  UNIQUE KEY `st_manu_name` (`st_manu_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
