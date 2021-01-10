-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 12, 2015 at 05:03 AM
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
-- Table structure for table `member_signup`
--

CREATE TABLE IF NOT EXISTS `member_signup` (
  `mid` int(20) NOT NULL AUTO_INCREMENT,
  `category` varchar(25) NOT NULL,
  `product` varchar(25) NOT NULL,
  `seats` int(5) NOT NULL,
  `ac` varchar(8) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `laguage` varchar(5) NOT NULL,
  `colour` varchar(7) NOT NULL,
  `weekdays` varchar(10) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `member_signup`
--

INSERT INTO `member_signup` (`mid`, `category`, `product`, `seats`, `ac`, `gender`, `laguage`, `colour`, `weekdays`) VALUES
(43, 'bmw', 'i10', 1, 'AC', 'male', 'yes', 'red', 'friday'),
(44, 'bmw', 'i10', 1, 'AC', 'male', 'yes', 'red', 'friday'),
(45, 'bmw', 'i10', 1, 'AC', 'male', 'yes', 'red', 'friday'),
(46, 'bmw', 'i10', 1, 'AC', 'male', 'yes', 'red', 'friday'),
(47, 'bmw', 'i10', 3, 'AC', 'male', 'yes', 'red', 'Monday');
