-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2016 at 07:27 AM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `aid` int(2) NOT NULL,
  `sid` int(2) NOT NULL,
  `cid` int(2) NOT NULL,
  `area_name` varchar(30) NOT NULL,
  PRIMARY KEY (`area_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`aid`, `sid`, `cid`, `area_name`) VALUES
(2, 1, 1, 'Naranpura'),
(1, 1, 1, 'Paldi');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `cid` int(2) NOT NULL,
  `sid` int(2) NOT NULL,
  `city_name` varchar(20) NOT NULL,
  PRIMARY KEY (`city_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`cid`, `sid`, `city_name`) VALUES
(26, 4, 'AfzalGunj'),
(1, 1, 'Ahmedabad'),
(27, 4, 'AhmedNagar'),
(47, 3, 'Ajmer'),
(42, 2, 'Akola'),
(48, 3, 'Alwar'),
(28, 4, 'Amberpet'),
(40, 2, 'Amravati'),
(19, 1, 'Anand'),
(29, 4, 'AshokNagar'),
(30, 4, 'Barkatpura'),
(31, 4, 'Beerappagadda'),
(32, 4, 'Begumpet'),
(33, 4, 'Bellavista'),
(49, 3, 'Bharatpur'),
(18, 1, 'Bharuch'),
(8, 1, 'Bhavnagar'),
(34, 4, 'BhawaniNagar'),
(50, 3, 'Bhilwara'),
(35, 4, 'Bhoiguda'),
(51, 3, 'Bikaner'),
(24, 1, 'Botad'),
(45, 2, 'Chandrapur'),
(52, 3, 'Chittorgarh'),
(23, 1, 'Dahod'),
(44, 2, 'Dhule'),
(53, 3, 'Dungrapur'),
(15, 1, 'Gandhidham'),
(10, 1, 'Gandhinagar'),
(17, 1, 'Ghatlodiya'),
(21, 1, 'Godhra'),
(3, 3, 'Jaipur'),
(54, 3, 'Jaisalmer'),
(41, 2, 'Jalgaon'),
(9, 1, 'Jamnagar'),
(14, 1, 'Junagadh'),
(25, 1, 'Kapadwanj'),
(43, 2, 'Lonavala'),
(12, 1, 'Morvi'),
(4, 2, 'Mumbai'),
(11, 1, 'Nadiad'),
(38, 2, 'Nashik'),
(22, 1, 'Navsari'),
(55, 3, 'Pali'),
(46, 2, 'Parbhani'),
(20, 1, 'Porbandar'),
(36, 2, 'pune'),
(7, 1, 'Rajkot'),
(56, 3, 'Rajsamand'),
(57, 3, 'Sikar'),
(58, 3, 'Sirohi'),
(39, 2, 'Solapur'),
(5, 1, 'Surat'),
(13, 1, 'Surendranagar'),
(37, 2, 'Thane'),
(6, 1, 'Vadodra'),
(16, 1, 'Veraval');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `reg_id` int(2) NOT NULL,
  `cmid` int(4) NOT NULL,
  `commentofuser` text NOT NULL,
  PRIMARY KEY (`cmid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--


-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `coid` int(2) NOT NULL,
  `company_name` varchar(25) NOT NULL,
  PRIMARY KEY (`company_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`coid`, `company_name`) VALUES
(1, 'CHEVROLET'),
(2, 'FORD'),
(3, 'TOYOTA'),
(4, 'HYUNDAI'),
(5, 'TATA'),
(6, 'MARUTI SUZUKI'),
(7, 'HONDA'),
(8, 'RENAULT'),
(9, 'AUDI'),
(10, 'BMW'),
(11, 'NISSAN'),
(12, 'MAHINDRA');

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE IF NOT EXISTS `counter` (
  `cnid` int(4) NOT NULL,
  `reg_id` int(2) NOT NULL,
  `counter` int(4) NOT NULL,
  PRIMARY KEY (`cnid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `counter`
--


-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `reg_id` int(2) NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY (`reg_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`reg_id`, `name`) VALUES
(4, 'IMG_3029.JPG'),
(1, 'IMG_7973.JPG'),
(2, 'IMG_8241.JPG'),
(3, 'IMG_5588.JPG'),
(5, 'DELL - WIN_20150810_135258.JPG'),
(6, 'DELL - WIN_20150810_142550.JPG'),
(7, 'IMG_7148.JPG'),
(10, 'IMG_8149.JPG'),
(9, 'IMG_7990.JPG'),
(11, 'IMG_7974.JPG'),
(12, 'IMG_7973.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `reg_id` int(2) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `reg_id` (`reg_id`),
  KEY `reg_id_2` (`reg_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`reg_id`, `email`, `password`) VALUES
(1, 'parshwa@gmail.com', '123456'),
(2, 'nirmit@gmail.com', '123456'),
(3, 'mohitvyas@gmail.com', '123456'),
(4, 'rushabh@gmail.com', '123456'),
(5, 'dnt@gmail.com', '123456'),
(6, 'keyur@gmail.com', '123456'),
(7, 'virag@gmail.com', '123456'),
(8, 'parth@gmail.com', '123456'),
(9, 'bhuvnesh@gmail.com', '123456'),
(10, 'poojan@gmail.com', '123456'),
(11, 'jaynil@gmail.com', '123456'),
(12, 'dhruvin@gmail.com', '123456'),
(13, 'devdutjoshi@gmail.com', '123456'),
(14, 'purvang@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `logincount`
--

CREATE TABLE IF NOT EXISTS `logincount` (
  `dt_id` int(2) NOT NULL,
  `reg_id` int(2) NOT NULL,
  `logincounter` int(4) NOT NULL,
  `date` varchar(15) NOT NULL,
  PRIMARY KEY (`dt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `logincount`
--

INSERT INTO `logincount` (`dt_id`, `reg_id`, `logincounter`, `date`) VALUES
(1, 1, 1, '2016-01-29'),
(2, 3, 1, '2016-01-29'),
(3, 4, 2, '2016-01-29'),
(4, 5, 1, '2016-01-29'),
(5, 6, 2, '2016-01-29'),
(6, 7, 2, '2016-01-29'),
(7, 10, 1, '2016-01-29'),
(8, 9, 1, '2016-01-29'),
(9, 11, 1, '2016-01-30'),
(10, 1, 11, '2016-01-30'),
(11, 2, 17, '2016-01-30'),
(12, 8, 2, '2016-01-30'),
(13, 4, 1, '2016-01-30'),
(14, 2, 3, '2016-01-31'),
(15, 2, 4, '2016-02-03'),
(16, 2, 4, '2016-02-05'),
(17, 3, 1, '2016-02-05'),
(18, 1, 2, '2016-02-05'),
(19, 4, 1, '2016-02-11'),
(20, 2, 3, '2016-02-12'),
(21, 1, 1, '2016-02-25'),
(22, 2, 1, '2016-03-02'),
(23, 2, 1, '2016-03-03'),
(24, 1, 3, '2016-03-03'),
(25, 2, 10, '2016-03-04'),
(26, 1, 4, '2016-03-04'),
(27, 11, 1, '2016-03-04'),
(28, 3, 3, '2016-03-04'),
(29, 2, 2, '2016-03-05'),
(30, 2, 3, '2016-03-06'),
(31, 2, 2, '2016-03-08'),
(32, 2, 1, '2016-03-09'),
(33, 1, 2, '2016-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `membertravellingdetails`
--

CREATE TABLE IF NOT EXISTS `membertravellingdetails` (
  `reg_id` int(2) NOT NULL,
  `mid` int(2) NOT NULL,
  `pricepertraveler` int(5) NOT NULL,
  `seatsavail` int(2) NOT NULL,
  `luggage` varchar(8) NOT NULL,
  `leave` varchar(25) NOT NULL,
  `detour` varchar(35) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membertravellingdetails`
--

INSERT INTO `membertravellingdetails` (`reg_id`, `mid`, `pricepertraveler`, `seatsavail`, `luggage`, `leave`, `detour`) VALUES
(1, 1, 40, 4, 'small', 'Fifteen minutes', 'Fifteen minutes detour max.'),
(1, 2, 40, 4, 'small', 'Fifteen minutes', 'Fifteen minutes detour max.'),
(1, 3, 40, 4, 'small', 'Fifteen minutes', 'Fifteen minutes detour max.'),
(1, 4, 40, 4, 'small', 'Fifteen minutes', 'Fifteen minutes detour max.'),
(1, 5, 40, 4, 'small', 'Fifteen minutes', 'Fifteen minutes detour max.'),
(1, 6, 30, 1, 'Big', 'THIRTY_MINUTES', 'NO detours'),
(2, 7, 40, 3, 'Medium', 'TWO_HOURS', 'Thirty minutes detour max.'),
(2, 8, 40, 3, 'Medium', 'TWO_HOURS', 'Thirty minutes detour max.'),
(2, 9, 40, 3, 'Medium', 'TWO_HOURS', 'Thirty minutes detour max.'),
(2, 10, 40, 3, 'Medium', 'TWO_HOURS', 'Thirty minutes detour max.'),
(2, 11, 40, 3, 'Medium', 'TWO_HOURS', 'Thirty minutes detour max.'),
(3, 12, 60, 3, 'Big', 'TWO_HOURS', 'Whatever it takes'),
(3, 13, 60, 3, 'Big', 'TWO_HOURS', 'Whatever it takes'),
(3, 14, 60, 3, 'Big', 'TWO_HOURS', 'Whatever it takes'),
(4, 15, 70, 2, 'small', 'On time', 'NO detours'),
(4, 16, 70, 2, 'small', 'On time', 'NO detours'),
(4, 17, 70, 2, 'small', 'On time', 'NO detours'),
(5, 18, 10, 2, 'Medium', 'On time', 'Fifteen minutes detour max.'),
(6, 19, 30, 5, 'small', 'THIRTY_MINUTES', 'NO detours'),
(6, 20, 30, 5, 'small', 'THIRTY_MINUTES', 'NO detours'),
(7, 21, 50, 3, 'small', 'On time', 'NO detours'),
(7, 22, 50, 3, 'small', 'On time', 'NO detours'),
(7, 23, 50, 3, 'small', 'On time', 'NO detours'),
(7, 24, 50, 3, 'small', 'On time', 'NO detours'),
(7, 25, 50, 3, 'small', 'On time', 'NO detours'),
(10, 26, 10, 2, 'Medium', 'On time', 'Fifteen minutes detour max.'),
(10, 27, 10, 2, 'Medium', 'On time', 'Fifteen minutes detour max.'),
(10, 28, 10, 2, 'Medium', 'On time', 'Fifteen minutes detour max.'),
(10, 29, 10, 2, 'Medium', 'On time', 'Fifteen minutes detour max.'),
(10, 30, 10, 2, 'Medium', 'On time', 'Fifteen minutes detour max.'),
(9, 31, 20, 2, 'Medium', 'THIRTY_MINUTES', 'Fifteen minutes detour max.'),
(11, 32, 30, 2, 'Big', 'THIRTY_MINUTES', 'Fifteen minutes detour max.'),
(1, 33, 30, 3, 'Medium', 'On time', 'Fifteen minutes detour max.'),
(13, 34, 20, 3, 'small', 'Fifteen minutes', 'Fifteen minutes detour max.'),
(1, 35, 30, 3, 'Big', 'On time', 'Thirty minutes detour max.'),
(1, 36, 30, 3, 'Big', 'On time', 'Thirty minutes detour max.'),
(1, 37, 30, 3, 'Big', 'On time', 'Thirty minutes detour max.'),
(1, 38, 30, 3, 'Big', 'On time', 'Thirty minutes detour max.'),
(1, 39, 30, 3, 'Big', 'On time', 'Thirty minutes detour max.'),
(1, 40, 30, 3, 'Big', 'On time', 'Thirty minutes detour max.'),
(2, 41, 20, 2, 'Medium', 'On time', 'Fifteen minutes detour max.'),
(2, 42, 20, 2, 'Medium', 'On time', 'Fifteen minutes detour max.'),
(2, 43, 20, 2, 'Medium', 'On time', 'Fifteen minutes detour max.'),
(2, 44, 30, 4, 'small', 'On time', 'Fifteen minutes detour max.'),
(2, 45, 20, 4, 'small', 'On time', 'NO detours'),
(2, 46, 20, 4, 'small', 'On time', 'NO detours'),
(2, 47, 20, 4, 'small', 'On time', 'NO detours'),
(2, 48, 20, 4, 'small', 'On time', 'NO detours'),
(2, 49, 30, 4, 'small', 'On time', 'Fifteen minutes detour max.'),
(2, 50, 10, 3, 'small', 'On time', 'Fifteen minutes detour max.'),
(2, 51, 10, 3, 'small', 'On time', 'Fifteen minutes detour max.'),
(2, 52, 10, 3, 'small', 'On time', 'Fifteen minutes detour max.'),
(2, 53, 10, 3, 'small', 'On time', 'Fifteen minutes detour max.'),
(2, 54, 30, 3, 'small', 'Fifteen minutes', 'Fifteen minutes detour max.'),
(2, 55, 30, 2, 'Big', 'On time', 'Fifteen minutes detour max.'),
(2, 56, 30, 2, 'Big', 'On time', 'Fifteen minutes detour max.'),
(2, 57, 30, 2, 'Big', 'On time', 'Fifteen minutes detour max.'),
(2, 58, 30, 2, 'Big', 'On time', 'Fifteen minutes detour max.'),
(2, 59, 30, 2, 'Big', 'On time', 'Fifteen minutes detour max.'),
(1, 60, 30, 3, 'small', 'On time', 'Fifteen minutes detour max.'),
(1, 61, 30, 2, 'Medium', 'On time', 'Fifteen minutes detour max.'),
(2, 62, 20, 3, 'small', 'On time', 'Fifteen minutes detour max.'),
(1, 63, 30, 4, 'Medium', 'On time', 'Fifteen minutes detour max.'),
(1, 64, 30, 4, 'Medium', 'On time', 'Fifteen minutes detour max.'),
(1, 65, 30, 4, 'Medium', 'On time', 'Fifteen minutes detour max.'),
(1, 66, 30, 4, 'Medium', 'On time', 'Fifteen minutes detour max.'),
(1, 67, 30, 4, 'Medium', 'On time', 'Fifteen minutes detour max.'),
(1, 68, 30, 4, 'Medium', 'On time', 'Fifteen minutes detour max.'),
(2, 69, 10, 2, 'Medium', 'On time', 'Fifteen minutes detour max.'),
(2, 70, 20, 3, 'small', 'Fifteen minutes', 'Thirty minutes detour max.'),
(4, 71, 10, 2, 'Medium', 'On time', 'Thirty minutes detour max.'),
(2, 72, 40, 2, 'Medium', 'On time', 'Fifteen minutes detour max.');

-- --------------------------------------------------------

--
-- Table structure for table `member_signup`
--

CREATE TABLE IF NOT EXISTS `member_signup` (
  `reg_id` int(20) NOT NULL,
  `category` varchar(25) NOT NULL,
  `product` varchar(25) NOT NULL,
  `seats` int(5) NOT NULL,
  `ac` varchar(8) NOT NULL,
  `colour` varchar(7) NOT NULL,
  PRIMARY KEY (`reg_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_signup`
--

INSERT INTO `member_signup` (`reg_id`, `category`, `product`, `seats`, `ac`, `colour`) VALUES
(1, '1', '', 3, 'AC', 'silver'),
(2, '9', '', 2, 'AC', 'black'),
(3, '4', '', 3, 'AC', 'white'),
(4, '8', '', 3, 'Non-AC', 'grey'),
(7, '9', '', 3, 'Non-AC', 'white'),
(11, '2', '', 3, 'Non-AC', 'grey'),
(0, '', '2', 4, 'AC', 'green');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE IF NOT EXISTS `model` (
  `coid` int(10) NOT NULL,
  `moid` int(10) NOT NULL,
  `model_name` varchar(20) NOT NULL,
  PRIMARY KEY (`model_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`coid`, `moid`, `model_name`) VALUES
(1, 3, 'TAVERA'),
(1, 2, 'UVA'),
(1, 1, 'SPARK'),
(11, 4, 'MICRA'),
(11, 5, 'SUNNY'),
(1, 6, 'CRUZE'),
(4, 7, 'I20'),
(4, 8, 'I10'),
(4, 9, 'ELANTRA'),
(4, 10, 'VERNA'),
(4, 11, 'EON'),
(4, 12, 'SANTAFE'),
(4, 13, 'SANTRO'),
(8, 14, 'KWID'),
(12, 15, 'XUV'),
(12, 16, 'KUV'),
(12, 17, 'TUV'),
(12, 18, 'SCORPIO'),
(12, 19, 'BOLLERO'),
(11, 20, 'TERRANO'),
(11, 21, 'EVALIA'),
(3, 22, 'ETIOS LIVA'),
(3, 23, 'ETIOS'),
(3, 24, 'INNOVA'),
(3, 25, 'COROLLA'),
(3, 26, 'LANDCRUISER'),
(3, 27, 'CAMRY'),
(2, 28, 'ECOSPORT'),
(2, 29, 'ENDEAVOUR'),
(2, 30, 'FIESTA'),
(2, 31, 'FIGO ASPIRE'),
(2, 32, 'FIGO'),
(3, 33, 'FORTUNER'),
(5, 34, 'NANO'),
(5, 35, 'INDICA'),
(5, 36, 'BOIT'),
(5, 37, 'ZEST'),
(5, 38, 'SUMO GOLD'),
(5, 39, 'SAFARI'),
(5, 40, 'ARIA'),
(5, 41, 'SAFARI STORM'),
(7, 42, 'HONDA CITY'),
(7, 43, 'ACCORD'),
(7, 44, 'AMAZE'),
(7, 45, 'CRV'),
(7, 46, 'BRIO'),
(7, 47, 'CIVIC'),
(6, 48, 'BALENO'),
(6, 49, 'SWIFT DZIRE'),
(6, 50, 'SWIFT'),
(6, 51, 'ALTO'),
(6, 52, 'CELERIO'),
(6, 53, 'RITZ'),
(6, 54, 'ERTIGA'),
(6, 55, 'S-CROSS'),
(8, 56, 'DUSTER'),
(9, 57, 'Q3'),
(9, 58, 'Q7'),
(9, 59, 'A4'),
(9, 60, 'A3'),
(9, 61, 'A6'),
(9, 62, 'A8'),
(9, 63, 'A8L'),
(9, 64, 'AUDITT'),
(10, 65, '320D'),
(10, 66, '520D'),
(10, 67, '720D'),
(10, 68, 'X5'),
(10, 69, 'X3'),
(8, 70, 'LODGY'),
(8, 71, 'PULSE'),
(8, 72, 'FLUENCE'),
(8, 73, 'scala');

-- --------------------------------------------------------

--
-- Table structure for table `postal`
--

CREATE TABLE IF NOT EXISTS `postal` (
  `reg_id` int(2) NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `postalcode` int(8) NOT NULL,
  `state` int(2) NOT NULL,
  PRIMARY KEY (`reg_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postal`
--

INSERT INTO `postal` (`reg_id`, `address1`, `address2`, `postalcode`, `state`) VALUES
(1, '23,husmukh colony,vijaynagar road', 'naranpura', 380013, 1),
(2, '11b nirant park soc.', 'thaltej', 380054, 1),
(3, 'c69 Mangalam Society', 'Ghodasar', 380050, 1),
(4, 'E8 Siddhi Darshan', 'Satellite', 380051, 1),
(6, '10,tulip bunglows', 'sarkhej', 380012, 4),
(7, '36,deepkung society', 'paldi', 38006, 4),
(10, 'tulip soc.', 'gathlodia', 380053, 1);

-- --------------------------------------------------------

--
-- Table structure for table `prating`
--

CREATE TABLE IF NOT EXISTS `prating` (
  `rateid` int(2) NOT NULL,
  `pid` int(2) NOT NULL,
  `did` int(2) NOT NULL,
  `rate` varchar(25) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`rateid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prating`
--

INSERT INTO `prating` (`rateid`, `pid`, `did`, `rate`, `comment`) VALUES
(1, 1, 2, '3.5', 'hello'),
(2, 1, 7, ' ', ' '),
(3, 2, 1, ' ', ' '),
(4, 2, 5, ' ', ' '),
(5, 3, 1, '2.5', ''),
(6, 2, 4, ' ', ' '),
(7, 2, 7, ' ', ' '),
(8, 2, 9, ' ', ' '),
(9, 2, 3, '3.5', ''),
(10, 2, 6, ' ', ' '),
(11, 2, 11, ' ', ' '),
(12, 3, 4, ' ', ' '),
(13, 3, 2, ' ', ' '),
(14, 3, 7, ' ', ' '),
(15, 3, 9, ' ', ' '),
(16, 3, 6, ' ', ' '),
(17, 3, 11, ' ', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `privatemessage`
--

CREATE TABLE IF NOT EXISTS `privatemessage` (
  `messageid` int(2) NOT NULL,
  `senderid` int(2) NOT NULL,
  `receiverid` int(2) NOT NULL,
  `message` varchar(300) NOT NULL,
  `counter` int(2) NOT NULL,
  PRIMARY KEY (`messageid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privatemessage`
--

INSERT INTO `privatemessage` (`messageid`, `senderid`, `receiverid`, `message`, `counter`) VALUES
(1, 2, 1, 'i would like your ride', 0),
(2, 1, 2, 'yes you can join me', 0),
(3, 5, 4, 'hiii', 0),
(4, 5, 2, 'I want to join you if you have naot any problem.', 0),
(5, 6, 3, 'hello please contact me...', 1),
(6, 2, 5, 'ok!!!', 1),
(7, 13, 1, 'hi', 0),
(8, 1, 13, 'hello', 1),
(9, 2, 1, 'hello\r\n', 0),
(10, 2, 1, 'hello', 0),
(11, 1, 2, 'hidss', 0),
(12, 2, 3, 'hello', 0),
(13, 2, 3, 'hello', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `rateid` int(2) NOT NULL,
  `pid` int(2) NOT NULL DEFAULT '0',
  `did` int(2) NOT NULL,
  `rate` varchar(25) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`rateid`),
  UNIQUE KEY `rateid` (`rateid`),
  KEY `rateid_2` (`rateid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rateid`, `pid`, `did`, `rate`, `comment`) VALUES
(4, 2, 5, '0.5', ''),
(3, 2, 1, '2', ''),
(2, 1, 7, ' 3.5', ' '),
(1, 1, 2, '3.5', ''),
(12, 3, 4, '2.5', ''),
(5, 3, 1, '1.5', ''),
(6, 2, 4, '3', ''),
(7, 2, 7, '2.5', ''),
(8, 2, 9, '3.5', ''),
(9, 2, 3, ' 4', ' '),
(10, 2, 6, '1', ''),
(11, 2, 11, '2.5', ''),
(13, 3, 2, '3.5', ''),
(14, 3, 7, '2.5', ''),
(15, 3, 9, '4.5', ''),
(16, 3, 6, '3', ''),
(17, 3, 11, '2.5', '');

-- --------------------------------------------------------

--
-- Table structure for table `routedetails`
--

CREATE TABLE IF NOT EXISTS `routedetails` (
  `reg_id` int(2) NOT NULL,
  `mid` int(2) NOT NULL,
  `source` text NOT NULL,
  `destination` text NOT NULL,
  `intermediatedestination1` text NOT NULL,
  `intermediatedestination2` text NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routedetails`
--

INSERT INTO `routedetails` (`reg_id`, `mid`, `source`, `destination`, `intermediatedestination1`, `intermediatedestination2`) VALUES
(1, 1, 'Navrangpura, Ahmedabad, Gujarat, India', 'Thaltej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(1, 2, 'Navrangpura, Ahmedabad, Gujarat, India', 'Thaltej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(1, 3, 'Navrangpura, Ahmedabad, Gujarat, India', 'Thaltej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(1, 4, 'Navrangpura, Ahmedabad, Gujarat, India', 'Thaltej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(1, 5, 'Navrangpura, Ahmedabad, Gujarat, India', 'Thaltej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(1, 6, 'Navrangpura, Ahmedabad, Gujarat, India', 'Thaltej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(2, 7, 'Nirant Park Society Part 1, Ahmedabad, Gujarat, India', 'LJ Campus, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India', 'Acropolis Mall, Sarkhej - Gandhinagar Highway, Thaltej, Ahmedabad, Gujarat, India'),
(2, 8, 'Nirant Park Society Part 1, Ahmedabad, Gujarat, India', 'LJ Campus, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India', 'Acropolis Mall, Sarkhej - Gandhinagar Highway, Thaltej, Ahmedabad, Gujarat, India'),
(2, 9, 'Nirant Park Society Part 1, Ahmedabad, Gujarat, India', 'LJ Campus, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India', 'Acropolis Mall, Sarkhej - Gandhinagar Highway, Thaltej, Ahmedabad, Gujarat, India'),
(2, 10, 'Nirant Park Society Part 1, Ahmedabad, Gujarat, India', 'LJ Campus, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India', 'Acropolis Mall, Sarkhej - Gandhinagar Highway, Thaltej, Ahmedabad, Gujarat, India'),
(2, 11, 'Nirant Park Society Part 1, Ahmedabad, Gujarat, India', 'LJ Campus, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India', 'Acropolis Mall, Sarkhej - Gandhinagar Highway, Thaltej, Ahmedabad, Gujarat, India'),
(3, 12, 'Navrangpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shyamal, Ahmedabad, Gujarat, India', 'Prahlad Nagar, Ahmedabad, Gujarat, India'),
(3, 13, 'Navrangpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shyamal, Ahmedabad, Gujarat, India', 'Prahlad Nagar, Ahmedabad, Gujarat, India'),
(3, 14, 'Navrangpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shyamal, Ahmedabad, Gujarat, India', 'Prahlad Nagar, Ahmedabad, Gujarat, India'),
(4, 15, 'SiddhiDarshan Apartments, Anandnagar Road, Jodhpur, Ahmedabad, Gujarat, India', 'LJ Campus, Ahmedabad, Gujarat, India', 'Seema Hall, Ahmedabad, Gujarat, India', 'Prahalad Nagar Garden, Prahlad Nagar, Ahmedabad, Gujarat, India'),
(4, 16, 'SiddhiDarshan Apartments, Anandnagar Road, Jodhpur, Ahmedabad, Gujarat, India', 'LJ Campus, Ahmedabad, Gujarat, India', 'Seema Hall, Ahmedabad, Gujarat, India', 'Prahalad Nagar Garden, Prahlad Nagar, Ahmedabad, Gujarat, India'),
(4, 17, 'SiddhiDarshan Apartments, Anandnagar Road, Jodhpur, Ahmedabad, Gujarat, India', 'LJ Campus, Ahmedabad, Gujarat, India', 'Seema Hall, Ahmedabad, Gujarat, India', 'Prahalad Nagar Garden, Prahlad Nagar, Ahmedabad, Gujarat, India'),
(5, 18, 'Navrangpura, Ahmedabad, Gujarat, India', 'Thaltej, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India'),
(6, 19, 'Navrangpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(6, 20, 'Navrangpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(7, 21, 'Nirant Park Society Part 1, Ahmedabad, Gujarat, India', 'LJ Campus, Ahmedabad, Gujarat, India', 'Iscon House, Chimanlal Girdharlal Road, Panchavati Society, India', 'Acropolis Mall, Sarkhej - Gandhinagar Highway, Thaltej, Ahmedabad, Gujarat, India'),
(7, 22, 'Nirant Park Society Part 1, Ahmedabad, Gujarat, India', 'LJ Campus, Ahmedabad, Gujarat, India', 'Iscon House, Chimanlal Girdharlal Road, Panchavati Society, India', 'Acropolis Mall, Sarkhej - Gandhinagar Highway, Thaltej, Ahmedabad, Gujarat, India'),
(7, 23, 'Nirant Park Society Part 1, Ahmedabad, Gujarat, India', 'LJ Campus, Ahmedabad, Gujarat, India', 'Iscon House, Chimanlal Girdharlal Road, Panchavati Society, India', 'Acropolis Mall, Sarkhej - Gandhinagar Highway, Thaltej, Ahmedabad, Gujarat, India'),
(7, 24, 'Nirant Park Society Part 1, Ahmedabad, Gujarat, India', 'LJ Campus, Ahmedabad, Gujarat, India', 'Iscon House, Chimanlal Girdharlal Road, Panchavati Society, India', 'Acropolis Mall, Sarkhej - Gandhinagar Highway, Thaltej, Ahmedabad, Gujarat, India'),
(7, 25, 'Nirant Park Society Part 1, Ahmedabad, Gujarat, India', 'LJ Campus, Ahmedabad, Gujarat, India', 'Iscon House, Chimanlal Girdharlal Road, Panchavati Society, India', 'Acropolis Mall, Sarkhej - Gandhinagar Highway, Thaltej, Ahmedabad, Gujarat, India'),
(10, 26, 'naranpura', 'thaltej', 'shiverejni', 'shyamal'),
(10, 27, 'naranpura', 'thaltej', 'shiverejni', 'shyamal'),
(10, 28, 'naranpura', 'thaltej', 'shiverejni', 'shyamal'),
(10, 29, 'naranpura', 'thaltej', 'shiverejni', 'shyamal'),
(10, 30, 'naranpura', 'thaltej', 'shiverejni', 'shyamal'),
(9, 31, 'Nirant Park Society Part 1, Ahmedabad, Gujarat, India', 'LJ Campus, Ahmedabad, Gujarat, India', 'shyamal', 'shyamal'),
(11, 32, 'Navrangpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Shyamal, Ahmedabad, Gujarat, India'),
(1, 33, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(13, 34, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon House, Chimanlal Girdharlal Road, Panchavati Society, India'),
(1, 35, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Paldi, Ahmedabad, Gujarat, India', 'Karnavati Club, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(1, 36, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Paldi, Ahmedabad, Gujarat, India', 'Karnavati Club, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(1, 37, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Paldi, Ahmedabad, Gujarat, India', 'Karnavati Club, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(1, 38, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Paldi, Ahmedabad, Gujarat, India', 'Karnavati Club, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(1, 39, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Paldi, Ahmedabad, Gujarat, India', 'Karnavati Club, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(1, 40, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Paldi, Ahmedabad, Gujarat, India', 'Karnavati Club, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(2, 41, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(2, 42, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(2, 43, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(2, 44, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(2, 45, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani BRTS, Surendra Mangaldas Road, Ambawadi, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(2, 46, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani BRTS, Surendra Mangaldas Road, Ambawadi, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(2, 47, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani BRTS, Surendra Mangaldas Road, Ambawadi, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(2, 48, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani BRTS, Surendra Mangaldas Road, Ambawadi, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(2, 49, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon House, Chimanlal Girdharlal Road, Panchavati Society, India'),
(2, 50, 'Naranpura, Ahmedabad, Gujarat, India', 'Thaltej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Shyamal, Ahmedabad, Gujarat, India'),
(2, 51, 'Naranpura, Ahmedabad, Gujarat, India', 'Thaltej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Shyamal, Ahmedabad, Gujarat, India'),
(2, 52, 'Naranpura, Ahmedabad, Gujarat, India', 'Thaltej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Shyamal, Ahmedabad, Gujarat, India'),
(2, 53, 'Naranpura, Ahmedabad, Gujarat, India', 'Thaltej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Shyamal, Ahmedabad, Gujarat, India'),
(2, 54, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon House, SV Desai Marg, Panchavati Society, Ahmedabad, Gujarat, India'),
(2, 55, 'Navrangpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India'),
(2, 56, 'Navrangpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India'),
(2, 57, 'Navrangpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India'),
(2, 58, 'Navrangpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India'),
(2, 59, 'Navrangpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India'),
(1, 60, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(1, 61, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(2, 62, 'Naranpura, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India', 'Sivaranjani Hotel, Hosur, Tamil Nadu, India', 'Andhariya, Vadgam, Gujarat, India'),
(1, 63, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(1, 64, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(1, 65, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(1, 66, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(1, 67, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(1, 68, 'Naranpura, Ahmedabad, Gujarat, India', 'Sarkhej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Iscon Mega Mall, Ahmedabad, Gujarat, India'),
(2, 69, 'Naranpura, Ahmedabad, Gujarat, India', 'Thaltej, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India', 'Shyamal, Ahmedabad, Gujarat, India'),
(2, 70, 'Narveer Tanaji Wadi, Pune, Maharashtra, India', 'thaltej', 'Shivajinagar, Pune, Maharashtra, India', 'Shukrawar Peth, Pune, Maharashtra, India'),
(4, 71, 'Navrangpura, Ahmedabad, Gujarat, India', 'Thaltej, Ahmedabad, Gujarat, India', 'Nirma House Office, Ashram Road, Navrangpura, Ahmedabad, Gujarat, India', 'Shivranjani, Ahmedabad, Gujarat, India'),
(2, 72, 'naranpura', 'thaltej', 'shiverejni', 'shyamal');

-- --------------------------------------------------------

--
-- Table structure for table `securityquestion`
--

CREATE TABLE IF NOT EXISTS `securityquestion` (
  `qid` int(4) NOT NULL,
  `question` text NOT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `securityquestion`
--

INSERT INTO `securityquestion` (`qid`, `question`) VALUES
(1, 'what is your favorite food?'),
(2, 'what is your hobby?'),
(3, 'what is your nickname?'),
(4, 'what is your favorite color');

-- --------------------------------------------------------

--
-- Table structure for table `signup_details`
--

CREATE TABLE IF NOT EXISTS `signup_details` (
  `reg_id` int(2) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `contactno` bigint(11) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `bio` varchar(100) DEFAULT NULL,
  `date` varchar(25) NOT NULL,
  PRIMARY KEY (`contactno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signup_details`
--

INSERT INTO `signup_details` (`reg_id`, `firstname`, `lastname`, `contactno`, `gender`, `bio`, `date`) VALUES
(1, 'parshwa', 'shah', 9157578750, 'male', 'I am a commuter and would like to share a ride with other people', '16-01-29'),
(2, 'nirmit', 'shah', 9687610106, 'male', 'I am studying in college and would to share a ride.', '16-01-29'),
(3, 'mohit', 'vyas', 9574029743, 'male', '', '16-01-29'),
(4, 'rushabh', 'shah', 8511446105, 'male', '', '16-01-29'),
(5, 'dhruv', 'thakkar', 9408641641, 'male', '', '16-01-29'),
(6, 'keyur', 'Mackwan', 7600200401, 'male', '', '16-01-29'),
(7, 'virag', 'shah', 9974935925, 'male', 'i am an diplomatic eng\r\n', '16-01-29'),
(8, 'parth', 'patel', 8153939965, 'male', '', '16-01-29'),
(9, 'bhuvnesh', 'patel', 8153935526, 'male', 'i would like to take ride', '16-01-29'),
(10, 'poojan', 'fumkiya', 9601400703, 'male', '', '16-01-29'),
(11, 'jaynil', 'shah', 7405852849, 'male', 'i would like to take a ride', '16-01-30'),
(12, 'dhruvin', 'maniar', 8511677172, 'male', '', '16-01-30'),
(13, 'Devdutt', 'Joshi', 8264747832, 'male', '', '16-01-30'),
(14, 'purvang', 'shah', 8866185459, 'male', '', '16-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `sid` int(11) NOT NULL,
  `state_name` varchar(20) NOT NULL,
  PRIMARY KEY (`state_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`sid`, `state_name`) VALUES
(1, 'Gujarat'),
(4, 'hyderabad'),
(2, 'Maharastra'),
(3, 'Rajasthan');

-- --------------------------------------------------------

--
-- Table structure for table `typeoftrip`
--

CREATE TABLE IF NOT EXISTS `typeoftrip` (
  `reg_id` int(2) NOT NULL,
  `mid` int(2) NOT NULL,
  `triptype` varchar(15) NOT NULL,
  `departuredate` varchar(10) NOT NULL,
  `departuretime` varchar(5) NOT NULL,
  `rid` int(4) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `typeoftrip`
--

INSERT INTO `typeoftrip` (`reg_id`, `mid`, `triptype`, `departuredate`, `departuretime`, `rid`) VALUES
(1, 1, 'multipleday', '2016-02-28', '16 30', 1),
(1, 2, 'multipleday', '2016-02-29', '16 30', 1),
(1, 3, 'multipleday', '2016-03-01', '16 30', 1),
(1, 4, 'multipleday', '2016-03-02', '16 30', 1),
(1, 5, 'multipleday', '2016-03-03', '16 30', 1),
(1, 6, 'oneday', '2016-03-18', '04 20', 2),
(2, 7, 'multipleday', '2016-03-07', '16 10', 3),
(2, 8, 'multipleday', '2016-03-08', '16 10', 3),
(2, 9, 'multipleday', '2016-03-09', '16 10', 3),
(2, 10, 'multipleday', '2016-03-10', '16 10', 3),
(2, 11, 'multipleday', '2016-04-08', '16 10', 3),
(3, 12, 'multipleday', '2016-04-28', '04 20', 4),
(3, 13, 'multipleday', '2016-04-29', '04 20', 4),
(3, 14, 'multipleday', '2016-04-30', '04 20', 4),
(4, 15, 'multipleday', '2016-04-03', '06 10', 5),
(4, 16, 'multipleday', '2016-04-04', '06 10', 5),
(4, 17, 'multipleday', '2016-04-05', '06 10', 5),
(5, 18, 'oneday', '2016-03-04', '08 30', 6),
(6, 19, 'multipleday', '2016-03-24', '03 20', 7),
(6, 20, 'multipleday', '2016-03-25', '03 20', 7),
(7, 21, 'multipleday', '2016-03-19', '02 20', 8),
(7, 22, 'multipleday', '2016-03-20', '02 20', 8),
(7, 23, 'multipleday', '2016-03-21', '02 20', 8),
(7, 24, 'multipleday', '2016-03-22', '02 20', 8),
(7, 25, 'multipleday', '2016-03-23', '02 20', 8),
(10, 26, 'multipleday', '2016-03-02', '18 30', 9),
(10, 27, 'multipleday', '2016-03-03', '18 30', 9),
(10, 28, 'multipleday', '2016-03-04', '18 30', 9),
(10, 29, 'multipleday', '2016-03-05', '18 30', 9),
(10, 30, 'multipleday', '2016-03-06', '18 30', 9),
(9, 31, 'oneday', '2016-02-11', '16 10', 10),
(11, 32, 'oneday', '2016-03-04', '13 10', 11),
(1, 33, 'oneday', '2016-01-31', '16 20', 12),
(13, 34, 'oneday', '2016-02-19', '17 10', 13),
(1, 35, 'multipleday', '2016-02-19', '13 10', 14),
(1, 36, 'multipleday', '2016-02-20', '13 10', 14),
(1, 37, 'multipleday', '2016-02-21', '13 10', 14),
(1, 38, 'multipleday', '2016-02-22', '13 10', 14),
(1, 39, 'multipleday', '2016-02-23', '13 10', 14),
(1, 40, 'multipleday', '2016-02-24', '13 10', 14),
(2, 41, 'multipleday', '2016-01-31', '15 10', 15),
(2, 42, 'multipleday', '2016-02-01', '15 10', 15),
(2, 43, 'multipleday', '2016-02-02', '15 10', 15),
(2, 44, 'oneday', '2016-01-31', '15 20', 16),
(2, 45, 'multipleday', '2016-01-31', '15 10', 17),
(2, 46, 'multipleday', '2016-02-01', '15 10', 17),
(2, 47, 'multipleday', '2016-02-02', '15 10', 17),
(2, 48, 'multipleday', '2016-02-03', '15 10', 17),
(2, 49, 'oneday', '2016-03-31', '02 20', 18),
(2, 50, 'multipleday', '2016-02-01', '03 20', 19),
(2, 51, 'multipleday', '2016-02-02', '03 20', 19),
(2, 52, 'multipleday', '2016-02-03', '03 20', 19),
(2, 53, 'multipleday', '2016-02-04', '03 20', 19),
(2, 54, 'oneday', '2016-01-31', '07 20', 20),
(2, 55, 'multipleday', '2016-01-31', '16 10', 21),
(2, 56, 'multipleday', '2016-02-01', '16 10', 21),
(2, 57, 'multipleday', '2016-02-02', '16 10', 21),
(2, 58, 'multipleday', '2016-02-03', '16 10', 21),
(2, 59, 'multipleday', '2016-02-04', '16 10', 21),
(1, 60, 'oneday', '2016-01-31', '17 10', 22),
(1, 61, 'oneday', '2016-01-31', '15 20', 23),
(2, 62, 'oneday', '2016-04-29', '15 00', 24),
(1, 63, 'multipleday', '2016-01-31', '04 20', 25),
(1, 64, 'multipleday', '2016-02-01', '04 20', 25),
(1, 65, 'multipleday', '2016-02-02', '04 20', 25),
(1, 66, 'multipleday', '2016-02-03', '04 20', 25),
(1, 67, 'multipleday', '2016-02-04', '04 20', 25),
(1, 68, 'multipleday', '2016-02-05', '04 20', 25),
(2, 69, 'oneday', '2016-03-06', '00 10', 26),
(2, 70, 'oneday', '2016-03-05', '16 00', 27),
(4, 71, 'oneday', '2016-03-08', '07 40', 28),
(2, 72, 'oneday', '2016-03-02', '15 20', 29);

-- --------------------------------------------------------

--
-- Table structure for table `usersecurityquestion`
--

CREATE TABLE IF NOT EXISTS `usersecurityquestion` (
  `reg_id` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`reg_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usersecurityquestion`
--

INSERT INTO `usersecurityquestion` (`reg_id`, `qid`, `answer`) VALUES
(14, 1, 'panipuri');
