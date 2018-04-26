-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 01, 2017 at 06:16 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `softwaretesting`
--
CREATE DATABASE IF NOT EXISTS `softwaretesting` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `softwaretesting`;

-- --------------------------------------------------------

--
-- Table structure for table `actor_complexity`
--

CREATE TABLE IF NOT EXISTS `actor_complexity` (
  `serial_no` int(3) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  `min_value` int(3) NOT NULL,
  `max_value` int(3) NOT NULL,
  `weight` int(3) NOT NULL,
  PRIMARY KEY (`serial_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `actor_complexity`
--

INSERT INTO `actor_complexity` (`serial_no`, `type`, `min_value`, `max_value`, `weight`) VALUES
(1, 'Simple', 1, 5, 2),
(2, 'Medium', 6, 10, 3),
(3, 'Complex', 11, 99, 5);

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

CREATE TABLE IF NOT EXISTS `actors` (
  `actor_id` int(10) NOT NULL AUTO_INCREMENT,
  `actor_name` varchar(32) NOT NULL,
  PRIMARY KEY (`actor_id`),
  UNIQUE KEY `actor_id` (`actor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `actors`
--

INSERT INTO `actors` (`actor_id`, `actor_name`) VALUES
(1, 'User'),
(2, 'Admin'),
(3, 'Customer'),
(4, 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `productivity_factor`
--

CREATE TABLE IF NOT EXISTS `productivity_factor` (
  `pid` int(3) NOT NULL,
  `productivity_factor` int(4) NOT NULL,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `pid` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productivity_factor`
--

INSERT INTO `productivity_factor` (`pid`, `productivity_factor`) VALUES
(1, 3),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `project_tef_mapping`
--

CREATE TABLE IF NOT EXISTS `project_tef_mapping` (
  `serial_no` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(3) NOT NULL,
  `factor_id` int(3) NOT NULL,
  `value` int(2) NOT NULL,
  PRIMARY KEY (`serial_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `project_tef_mapping`
--

INSERT INTO `project_tef_mapping` (`serial_no`, `pid`, `factor_id`, `value`) VALUES
(1, 1, 1, 3),
(2, 1, 2, 2),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 2),
(6, 1, 6, 2),
(7, 1, 7, 0),
(8, 1, 8, 2),
(9, 1, 9, 3),
(10, 2, 1, 2),
(11, 2, 2, 2),
(12, 2, 3, 2),
(13, 2, 4, 1),
(14, 2, 5, 3),
(15, 2, 6, 5),
(16, 2, 7, 1),
(17, 2, 8, 2),
(18, 2, 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `project_ucd_mapping`
--

CREATE TABLE IF NOT EXISTS `project_ucd_mapping` (
  `serial_no` int(3) NOT NULL AUTO_INCREMENT,
  `pid` int(3) NOT NULL,
  `ucd_id` int(3) NOT NULL,
  PRIMARY KEY (`serial_no`),
  KEY `pid` (`pid`),
  KEY `pid_2` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `project_ucd_mapping`
--

INSERT INTO `project_ucd_mapping` (`serial_no`, `pid`, `ucd_id`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `pid` (`pid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`pid`, `name`) VALUES
(2, 'DVD Rental System'),
(1, 'Online Book Pubishing and Purchasing');

-- --------------------------------------------------------

--
-- Table structure for table `technical_and_environmental_factors`
--

CREATE TABLE IF NOT EXISTS `technical_and_environmental_factors` (
  `factor_id` int(3) NOT NULL AUTO_INCREMENT,
  `factor_name` varchar(4) NOT NULL,
  `description` varchar(64) NOT NULL,
  `weight` float NOT NULL,
  PRIMARY KEY (`factor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `technical_and_environmental_factors`
--

INSERT INTO `technical_and_environmental_factors` (`factor_id`, `factor_name`, `description`, `weight`) VALUES
(1, 'E1', 'Familiarity and Experience on OOM', 0.5),
(2, 'E2', 'Training level of the Test team on used tools', 2),
(3, 'E3', 'Motiavtion level of the test team', 0.5),
(4, 'T1', 'Extent of Reusability', 2),
(5, 'T2', 'Complexity of Processing', 1),
(6, 'T3', 'Extent of Testing tools used', 3),
(7, 'T4', 'Extent of Performance Requirements', 1),
(8, 'T5', 'Extenet of Data Communication', 2),
(9, 'T6', 'Level of Security features used', 3);

-- --------------------------------------------------------

--
-- Table structure for table `uaw`
--

CREATE TABLE IF NOT EXISTS `uaw` (
  `serial_no` int(3) NOT NULL AUTO_INCREMENT,
  `actor_id` int(3) NOT NULL,
  `number_of_interaction` int(3) NOT NULL,
  `actor_complexity` varchar(8) NOT NULL,
  `multiplying_factor` int(3) NOT NULL,
  `uaw` int(3) NOT NULL,
  PRIMARY KEY (`serial_no`),
  UNIQUE KEY `serial_no` (`serial_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `uaw`
--

INSERT INTO `uaw` (`serial_no`, `actor_id`, `number_of_interaction`, `actor_complexity`, `multiplying_factor`, `uaw`) VALUES
(1, 1, 8, 'Medium', 3, 24),
(2, 2, 13, 'Complex', 5, 65),
(3, 3, 2, 'Simple', 2, 4),
(4, 4, 3, 'Simple', 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `uc_ucd_mapping`
--

CREATE TABLE IF NOT EXISTS `uc_ucd_mapping` (
  `serial_no` int(3) NOT NULL AUTO_INCREMENT,
  `uc_id` int(3) NOT NULL,
  `ucd_id` int(3) NOT NULL,
  PRIMARY KEY (`serial_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `uc_ucd_mapping`
--

INSERT INTO `uc_ucd_mapping` (`serial_no`, `uc_id`, `ucd_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 11, 1),
(12, 12, 1),
(13, 13, 1),
(14, 14, 1),
(15, 15, 1),
(16, 16, 1),
(17, 17, 1),
(18, 18, 1),
(19, 19, 1),
(20, 20, 2),
(21, 21, 2),
(22, 22, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ucd_actor_mapping`
--

CREATE TABLE IF NOT EXISTS `ucd_actor_mapping` (
  `serial_no` int(3) NOT NULL AUTO_INCREMENT,
  `ucd_id` int(3) NOT NULL,
  `actor_id` int(3) NOT NULL,
  PRIMARY KEY (`serial_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ucd_actor_mapping`
--

INSERT INTO `ucd_actor_mapping` (`serial_no`, `ucd_id`, `actor_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(5, 2, 3),
(6, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ucp_calculation`
--

CREATE TABLE IF NOT EXISTS `ucp_calculation` (
  `pid` int(3) NOT NULL,
  `uucw` float NOT NULL,
  `uaw` int(6) NOT NULL,
  `aucp` float NOT NULL,
  `tef` float NOT NULL,
  `ucp` float NOT NULL,
  `productivity_factor` int(3) NOT NULL,
  `effort` float NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ucp_calculation`
--

INSERT INTO `ucp_calculation` (`pid`, `uucw`, `uaw`, `aucp`, `tef`, `ucp`, `productivity_factor`, `effort`) VALUES
(1, 99.6, 89, 188.6, 0.89, 167.854, 3, 503.562),
(2, 32.4, 10, 42.4, 0.97, 41.128, 2, 82.256);

-- --------------------------------------------------------

--
-- Table structure for table `use_case_complexity`
--

CREATE TABLE IF NOT EXISTS `use_case_complexity` (
  `serial_no` int(3) NOT NULL AUTO_INCREMENT,
  `uc_complexity` varchar(32) NOT NULL,
  `min_value` int(3) NOT NULL,
  `max_value` int(4) NOT NULL,
  `weight` int(3) NOT NULL,
  PRIMARY KEY (`serial_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `use_case_complexity`
--

INSERT INTO `use_case_complexity` (`serial_no`, `uc_complexity`, `min_value`, `max_value`, `weight`) VALUES
(1, 'simple', 1, 5, 2),
(2, 'medium', 6, 10, 3),
(3, 'complex', 11, 99, 5);

-- --------------------------------------------------------

--
-- Table structure for table `use_case_diagrams`
--

CREATE TABLE IF NOT EXISTS `use_case_diagrams` (
  `ucd_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`ucd_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `use_case_diagrams`
--

INSERT INTO `use_case_diagrams` (`ucd_id`, `name`) VALUES
(1, 'Online Book Management system'),
(2, 'DVD rental management system');

-- --------------------------------------------------------

--
-- Table structure for table `use_case_scenario_weight`
--

CREATE TABLE IF NOT EXISTS `use_case_scenario_weight` (
  `serial_no` int(3) NOT NULL AUTO_INCREMENT,
  `type_of_scenario` varchar(32) NOT NULL,
  `weight` float NOT NULL,
  PRIMARY KEY (`serial_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `use_case_scenario_weight`
--

INSERT INTO `use_case_scenario_weight` (`serial_no`, `type_of_scenario`, `weight`) VALUES
(1, 'Normal', 1),
(2, 'Exceptional', 0.4);

-- --------------------------------------------------------

--
-- Table structure for table `use_cases`
--

CREATE TABLE IF NOT EXISTS `use_cases` (
  `uc_id` int(3) NOT NULL AUTO_INCREMENT,
  `uc_name` varchar(32) NOT NULL,
  PRIMARY KEY (`uc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `use_cases`
--

INSERT INTO `use_cases` (`uc_id`, `uc_name`) VALUES
(1, 'User Info'),
(2, 'User Registration'),
(3, 'Add book'),
(4, 'Add Bill'),
(5, 'Manage Book'),
(6, 'Manage Bill'),
(7, 'Add Customer'),
(8, 'Manage Customer'),
(9, 'Add invoice'),
(10, 'Manage Invoice'),
(11, 'Add Shopping Cart'),
(12, 'Add Category'),
(13, 'Manage Category'),
(14, 'Add Publisher'),
(15, 'Manage Publisher'),
(16, 'Manage Shopping Cart'),
(17, 'Add File'),
(18, 'Manage File'),
(19, 'Add Merchant'),
(20, 'Register Customers'),
(21, 'Rent Tape'),
(22, 'Return Tape');

-- --------------------------------------------------------

--
-- Table structure for table `uucw`
--

CREATE TABLE IF NOT EXISTS `uucw` (
  `serial_no` int(3) NOT NULL AUTO_INCREMENT,
  `uc_id` int(3) NOT NULL,
  `normal_scenarios` int(3) NOT NULL,
  `exceptional_scenarios` int(3) NOT NULL,
  `complexity` varchar(10) NOT NULL,
  `multiplying_factor` int(4) NOT NULL,
  `uc_weight` float NOT NULL,
  PRIMARY KEY (`serial_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `uucw`
--

INSERT INTO `uucw` (`serial_no`, `uc_id`, `normal_scenarios`, `exceptional_scenarios`, `complexity`, `multiplying_factor`, `uc_weight`) VALUES
(1, 1, 1, 2, 'simple', 2, 3.6),
(2, 2, 1, 3, 'simple', 2, 4.4),
(3, 3, 3, 3, 'medium', 3, 12.6),
(5, 4, 2, 2, 'simple', 2, 5.6),
(6, 5, 3, 3, 'medium', 3, 12.6),
(7, 6, 1, 2, 'simple', 2, 3.6),
(8, 7, 1, 1, 'simple', 2, 2.8),
(9, 8, 2, 3, 'simple', 2, 6.4),
(10, 9, 1, 1, 'simple', 2, 2.8),
(11, 10, 1, 1, 'simple', 2, 2.8),
(12, 11, 1, 1, 'simple', 2, 2.8),
(13, 12, 1, 1, 'simple', 2, 2.8),
(14, 13, 2, 2, 'simple', 2, 5.6),
(15, 14, 1, 1, 'simple', 2, 2.8),
(16, 15, 1, 1, 'simple', 2, 2.8),
(17, 16, 2, 2, 'simple', 2, 5.6),
(18, 17, 2, 3, 'simple', 2, 6.4),
(19, 18, 2, 4, 'medium', 3, 10.8),
(20, 19, 1, 1, 'simple', 2, 2.8),
(21, 20, 1, 2, 'simple', 2, 3.6),
(22, 21, 3, 6, 'medium', 3, 16.2),
(23, 22, 3, 3, 'medium', 3, 12.6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
