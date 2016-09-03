-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 14, 2015 at 05:35 AM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

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
  `age` int(11) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `barangay` varchar(75) NOT NULL,
  `city` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `profile_pic` varchar(150) NOT NULL DEFAULT 'default_image.jpg',
  `contact_no` bigint(100) NOT NULL,
  `position` varchar(75) NOT NULL,
  `dept_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2014010 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `fname`, `mname`, `lname`, `bday`, `age`, `gender`, `barangay`, `city`, `province`, `postal_code`, `profile_pic`, `contact_no`, `position`, `dept_id`) VALUES
(2014001, 'Billy Joel', 'Loyola', 'Ranario', '1994-08-14', 20, 'Male', 'Camrne', 'Cagayan de Oro', 'Misamis Oriental', 9000, 'default_image.png', 9358994227, 'CEO', 1),
(2014002, 'Matt Kynnpearl', 'Batbat', 'Ranario', '0000-00-00', 0, 'Male', '', '', '', 0, 'default_image.png', 0, '', 2),
(2014003, 'amaw', 'amaw', 'amaw', '0000-00-00', 0, 'Female', '', '', '', 0, 'default_image.png', 0, '', 3),
(2014004, 'test', 'test', 'test', '0000-00-00', 0, 'Male', '', '', '', 0, 'default_image.jpg', 0, '', 4),
(2014005, 'test2', 'test', 'test', '0000-00-00', 0, 'Male', '', '', '', 0, 'default_image.png', 0, '', 4),
(2014006, 'test', 'test', 'test', '0000-00-00', 0, 'Male', '', '', '', 0, 'default_image.png', 0, '', 3),
(2014007, 'test4', 'test4', 'test4', '0000-00-00', 0, 'Male', '', '', '', 0, 'default_image.png', 0, '', 5),
(2014008, 'New user', 'Test', 'MatestNga', '0000-00-00', 0, 'Undecided', '', '', '', 0, 'default_image.png', 0, '', 6),
(2014009, 'qwer', 'qwer', 'qwer', '0000-00-00', 0, 'Female', '', '', '', 0, 'default_image.png', 0, '', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
