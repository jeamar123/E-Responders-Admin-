-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2014 at 12:35 AM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_responder`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `bday` date NOT NULL,
  `gender` varchar(15) NOT NULL,
  `barangay` varchar(75) NOT NULL,
  `city` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `profile_pic` varchar(150) NOT NULL DEFAULT 'default_image.jpg',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20140002 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `fname`, `mname`, `lname`, `bday`, `gender`, `barangay`, `city`, `province`, `postal_code`, `profile_pic`) VALUES
(20140001, 'Billy Joel', 'Loyola', 'Ranario', '1994-08-14', 'Male', 'Carmen', 'CDO', 'Misamis Oriental', 9000, 'default_image.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(75) NOT NULL,
  `password` varchar(75) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `username`, `password`) VALUES
(1, 20140001, 'admin', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
