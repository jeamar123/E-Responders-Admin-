-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 06, 2015 at 10:12 AM
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
-- Table structure for table `activity_sessions`
--

CREATE TABLE IF NOT EXISTS `activity_sessions` (
  `session_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `action` int(11) NOT NULL,
  `date_session` datetime NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `alert_info`
--

CREATE TABLE IF NOT EXISTS `alert_info` (
  `alert_id` int(11) NOT NULL AUTO_INCREMENT,
  `mobile_id` varchar(100) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lng` varchar(100) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'request_for_respond',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_responded` datetime NOT NULL,
  `redirected_by` varchar(150) NOT NULL,
  `alert_type` varchar(100) NOT NULL,
  `time_id` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`alert_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=249 ;

--
-- Dumping data for table `alert_info`
--

INSERT INTO `alert_info` (`alert_id`, `mobile_id`, `dept_id`, `lat`, `lng`, `msg`, `status`, `date`, `date_responded`, `redirected_by`, `alert_type`, `time_id`) VALUES
(247, 'AtpNG075pm', 2, '8.496143129105', '124.61572135705', 'Subscriber 2 : Hospital', 'redirected', '2015-03-06 00:45:52', '0000-00-00 00:00:00', 'San Ignacio Fundacion De Salud, Inc.', 'redirected', '0000-00-00 00:00:00'),
(248, 'AtpNG075pm', 11, '8.496143129105', '124.61572135705', 'Subscriber 2 : Hospital', 'request_for_respond', '2015-03-06 00:45:52', '0000-00-00 00:00:00', 'Maria Reyna Hospital', 'redirected', '0000-00-00 00:00:00'),
(242, 'AtpNG075pm', 11, '8.496143129105', '124.61572135705', 'Subscriber 2 : Hospital', 'request_for_respond', '2015-03-06 00:41:36', '0000-00-00 00:00:00', 'Maria Reyna Hospital', 'redirected', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `cmnt_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cmnt_content` int(11) NOT NULL,
  `post_date` datetime NOT NULL,
  PRIMARY KEY (`cmnt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(500) NOT NULL,
  `dept_desc` varchar(2000) NOT NULL,
  `category` varchar(100) NOT NULL,
  `hotline_no` bigint(50) NOT NULL,
  `mobile_no` bigint(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `features` varchar(500) DEFAULT 'none',
  `email` varchar(150) DEFAULT 'none',
  `website` varchar(50) DEFAULT 'none',
  `dept_image` varchar(100) NOT NULL DEFAULT 'default_dept_img.jpg',
  PRIMARY KEY (`dept_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `dept_desc`, `category`, `hotline_no`, `mobile_no`, `address`, `features`, `email`, `website`, `dept_image`) VALUES
(1, 'CDO - Responders Admin', 'This place is where Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut al.', 'Police', 123123, 234242, 'Claro M. Recto Avenue, Cagayan de Oro, 9000 Misamis Oriental, Philippines', 'samoka', 'cdorepsonder@gmail.com', 'cdoresponders.TK', 'building_cartoon_images_Hanapin_sa_Google1.png'),
(2, 'Maria Reyna Hospital', 'Maria Reyna Hospital is one of the leading hospitals in Cagayan de Oro', 'Hospital', 8822712628, 0, 'Hayes Street, CDO', 'Offers free dental check up', 'mariareyna@gmail.com', 'cdoresponders.tk', 'maria-reyna-hospital.jpg'),
(3, 'JR Borja Memorial City Hospital', 'JR Borja Memorial City Hospital in CDO', 'Hospital', 888582932, 0, 'Ilaya, Carmen', 'nothing', 'jrborja@gmail.com', 'cdoresponders.tk', 'J.R_.Borja_Hospital2_.jpg'),
(4, 'Polymedic General Hospital', 'Polymedic General Hospital in Velez St.', 'Hospital', 808088080, 9888776616, 'Don Apolinar Velez St.', 'many', 'pgh@gmail.com', 'pgh.com', 'default_dept_img.jpg'),
(5, 'Capitol University Medical City', 'Capitol University Medical City in C.M. Recto', 'Hospital', 889009668, 977780, 'C.M. Recto Avenue', 'Provides free medicines', 'capitol@gmail.com', 'capitol.com', 'capitol.jpg'),
(6, 'Cagayan de Oro Medical Center', 'Cagayan de Oro Medical Center in M.H. Del Pilar', 'Hospital', 9890908907, 0, 'M.H. Del Pilar', 'none', 'medical@gmail.com', 'medical.com', 'NMMC.jpg'),
(7, 'Intellicare', 'Intellicare in Vamenta Blvd.', 'Hospital', 1380983, 9267669874, 'Vamenta Blvd.', 'Free Check up every sunday', 'intellicare@gmail.com', 'Intellicare.com', 'default_dept_img.jpg'),
(8, 'Thera Links Asia', 'Thera Links Asia in J.R Borja Street', 'Hospital', 31731983, 98873213128, 'J.R. Borja Street', 'Free Checkup', 'thera@gmail.com', 'thera.com', 'default_dept_img.jpg'),
(9, 'Sabal Hospital', 'Sabal Hospital Don Apolinar Street', 'Hospital', 312317897987, 8989008800, 'Don Apolinar Velez Street', 'Daily Checkup', 'sabal@gmail.com', 'sabal.com', 'sabalclinic.jpg'),
(10, 'Madonna & Child Hospital', 'Madonna & Child Hospital at J. Serina St.', 'Hospital', 3219789, 89789879879, '78978783271897', 'Madonna & Child Hospital Free Dental Clinic', 'madonna@gmail.com', 'madonna.com', 'madonna.jpg'),
(11, 'San Ignacio Fundacion De Salud, Inc.', 'San Ignacio Fundacion De Salud, Inc. at Masterson Ave.', 'Hospital', 318171897897, 92312312, 'Masterson Ave.,', 'Free dental check ups every month', 'ignacio@gmail.com', 'ignacio.com', 'default_dept_img.jpg'),
(16, 'Bulua Police Precinct', 'Bulua Police Precinct in CDO', 'Police', 883105577, 0, 'Bulua, CDO', 'none', 'bulua@gmail.com', 'http://pnp.gov.ph/portal/', 'default_dept_img.jpg'),
(13, 'MUST Clinic', 'MUST Clinic', 'Hospital', 0, 0, '', 'none', 'wwqqwq@gmaill.com', 'none', 'MUST-Science-Complex.jpg'),
(14, '', '', 'Fire Station', 0, 0, '', 'none', 'none', 'none', 'default_dept_img.jpg'),
(15, 'Van Dave Maternity Clinic and Lying In', 'Van Dave Maternity Clinic and Lying In is found at Barangay 22', 'Hospital', 0, 0, '', 'none', 'vandave@gmail.com', 'none', 'default_dept_img.jpg'),
(17, 'Cagayan de Oro Police Station 7', 'Near in Memorial Park', 'Police', 0, 0, '', 'none', 'station7@gmail.com', 'none', 'default_dept_img.jpg'),
(18, 'Divisoria Police Precinct', 'Divisoria Police Precint', 'Police', 0, 0, '', 'none', 'precinct@gmail.com', 'none', 'default_dept_img.jpg'),
(34, 'sample hospital', 'sample hospital', 'Hospital', 0, 0, '', 'none', 'sa@d.c', 'none', 'default_dept_img.jpg'),
(20, 'Macasandig Police Precinct', 'Macasandig Police Precinct near Corpus High School', 'Police', 883105578, 0, 'Macasandig, CDO', 'none', 'macasandig@gmail.com', 'pnp.gov.ph', 'default_dept_img.jpg'),
(21, 'DILG Office X', 'DILG Office X in Cagayan de Oro City', 'Police', 0, 0, '', 'none', 'dilg@gmail.com', 'none', 'default_dept_img.jpg'),
(22, 'Police Regional Office 10', 'Police Regional Office 10 near Lim Ket Kai', 'Police', 0, 0, '', 'none', 'pnp@gmail.com', 'none', 'default_dept_img.jpg'),
(23, 'Cugman Police Precinct', 'Cugman Police Precinct in Cugman', 'Police', 0, 0, '', 'none', 'cugman@gmail.com', 'none', 'default_dept_img.jpg'),
(24, 'Puerto Police Precinct', 'Puerto Police Precinct in Butuan-Cagayan de Oro-Iligan Road', 'Police', 0, 0, '', 'none', 'puerto@gmail.com', 'none', 'default_dept_img.jpg'),
(25, 'Lumbia Police Precinct', 'Lumbia Police Precinct near Lumbia airport', 'Police', 0, 0, '', 'none', 'lumbia@gmail.com', 'none', 'default_dept_img.jpg'),
(26, 'Macabalan Fire Station', 'Macabalan Fire Station in Julio Pacana Street\nCagayan de Oro', 'Fire Station', 888560164, 0, 'Julio Pacana Street Cagayan de Oro', 'none', 'macabalan@gmail.com', 'none', 'default_dept_img.jpg'),
(27, 'Sun Star', 'Sun Star in CDO', 'Fire Station', 0, 0, '', 'none', 'sunstar@gmail.com', 'none', 'default_dept_img.jpg'),
(28, 'Cagayan de Oro Water District', 'Cagayan de Oro Water District in CDO', 'Fire Station', 0, 0, '', 'none', 'cdowaterdistrict@gmail.com', 'none', 'default_dept_img.jpg'),
(29, 'Cagayan de Oro Fire Station', 'Cagayan de Oro Fire Station in Capt. Vicente Roa\nCagayan de Oro', 'Fire Station', 0, 0, '', 'none', 'cdofirestation@gmail.com', 'none', 'default_dept_img.jpg'),
(30, 'The Executive Building', 'The Executive Building in CDO', 'Fire Station', 0, 0, '', 'none', 'executivebuilding@gmail.com', 'none', 'default_dept_img.jpg'),
(31, '', '', 'Fire Station', 0, 0, '', 'none', 'none', 'none', 'default_dept_img.jpg'),
(32, '', '', 'Fire Station', 0, 0, '', 'none', 'none', 'none', 'default_dept_img.jpg'),
(12, '', '', '', 0, 0, '', 'none', 'none', 'none', 'default_dept_img.jpg'),
(33, '', '', 'Police', 0, 0, '', 'none', 'none', 'none', 'default_dept_img.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `department_branches`
--

CREATE TABLE IF NOT EXISTS `department_branches` (
  `branch_id` varchar(100) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `branch_name` varchar(75) NOT NULL,
  `description` varchar(500) NOT NULL,
  `category` varchar(50) NOT NULL,
  `marker_status` varchar(50) NOT NULL,
  `hotline_no` varchar(25) NOT NULL,
  `mobile_no` varchar(25) NOT NULL,
  `address` varchar(500) NOT NULL,
  `features` varchar(500) DEFAULT 'none',
  `email` varchar(150) NOT NULL DEFAULT 'none',
  `website` varchar(150) DEFAULT 'none',
  `branch_img` varchar(150) NOT NULL DEFAULT 'default_dept_img.jpg',
  PRIMARY KEY (`branch_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_branches`
--

INSERT INTO `department_branches` (`branch_id`, `dept_id`, `branch_name`, `description`, `category`, `marker_status`, `hotline_no`, `mobile_no`, `address`, `features`, `email`, `website`, `branch_img`) VALUES
('1', 1, 'CDO - Responders Admin', 'This place is where Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut al.', 'Police', 'none', '123123', '234242', 'Claro M. Recto Avenue, Cagayan de Oro, 9000 Misamis Oriental, Philippines', 'samoka', 'cdorepsonder@gmail.com', 'cdoresponders.TK', 'building_cartoon_images_Hanapin_sa_Google1.png'),
('10', 10, 'Madonna & Child Hospital', 'Madonna & Child Hospital at J. Serina St.', 'Hospital', 'none', '3219789', '89789879879', '78978783271897', 'Madonna & Child Hospital Free Dental Clinic', 'madonna@gmail.com', 'madonna.com', 'madonna.jpg'),
('11', 11, 'San Ignacio Fundacion De Salud, Inc.', 'San Ignacio Fundacion De Salud, Inc. at Masterson Ave.', 'Hospital', 'none', '318171897897', '92312312', 'Masterson Ave.,', 'Free dental check ups every month', 'ignacio@gmail.com', 'ignacio.com', 'default_dept_img.jpg'),
('13', 13, 'MUST Clinic', 'MUST Clinic', 'Hospital', '', '', '', '', 'none', 'wwqqwq@gmaill.com', 'none', 'MUST-Science-Complex.jpg'),
('14', 14, '', '', 'Fire Station', '', '', '', '', 'none', 'none', 'none', 'default_dept_img.jpg'),
('15', 15, 'Van Dave Maternity Clinic and Lying In', 'Van Dave Maternity Clinic and Lying In is found at Barangay 22', 'Hospital', '', '', '', '', 'none', 'vandave@gmail.com', 'none', 'default_dept_img.jpg'),
('2', 2, 'Maria Reyna Hospital', 'Maria Reyna Hospital is one of the leading hospitals in Cagayan de Oro', 'Hospital', 'none', '123331', '212121', 'camaman-an', '', 'mariareyna@gmail.com', 'cdoresponders.tk', 'maria-reyna-hospital.jpg'),
('3', 3, 'JR Borja Memorial City Hospital', 'JR Borja Memorial City Hospital in CDO', 'Hospital', 'none', '0998800800080', '08080880980', 'Ilaya, Carmen', 'nothing', 'jrborja@gmail.com', 'cdoresponders.tk', 'J.R_.Borja_Hospital2_.jpg'),
('4', 4, 'Polymedic General Hospital', 'Polymedic General Hospital in Velez St.', 'Hospital', 'none', '808088080', '9888776616', 'Don Apolinar Velez St.', 'many', 'pgh@gmail.com', 'pgh.com', 'default_dept_img.jpg'),
('5', 5, 'Capitol University Medical City', 'Capitol University Medical City in C.M. Recto', 'Hospital', 'none', '889009668', '977780', 'C.M. Recto Avenue', 'Provides free medicines', 'capitol@gmail.com', 'capitol.com', 'capitol.jpg'),
('6', 6, 'Cagayan de Oro Medical Center', 'Cagayan de Oro Medical Center in M.H. Del Pilar', 'Hospital', 'none', '9890908907', '9899890887', 'M.H. Del Pilar', 'none', 'medical@gmail.com', 'medical.com', 'NMMC.jpg'),
('7', 7, 'Intellicare', 'Intellicare in Vamenta Blvd.', 'Hospital', 'none', '1380983', '9267669874', 'Vamenta Blvd.', 'Free Check up every sunday', 'intellicare@gmail.com', 'Intellicare.com', 'default_dept_img.jpg'),
('8', 8, 'Thera Links Asia', 'Thera Links Asia in J.R Borja Street', 'Hospital', 'none', '31731983', '98873213128', 'J.R. Borja Street', 'Free Checkup', 'thera@gmail.com', 'thera.com', 'default_dept_img.jpg'),
('9', 9, 'Sabal Hospital', 'Sabal Hospital Don Apolinar Street', 'Hospital', 'none', '312317897987', '8989008800', 'Don Apolinar Velez Street', 'Daily Checkup', 'sabal@gmail.com', 'sabal.com', 'sabalclinic.jpg'),
('16', 16, 'Bulua Police Precinct', 'Bulua Police Precinct in CDO', 'Police', '', '', '', '', 'none', 'bulua@gmail.com', 'none', 'default_dept_img.jpg'),
('17', 17, 'Cagayan de Oro Police Station 7', 'Near in Memorial Park', 'Police', '', '', '', '', 'none', 'station7@gmail.com', 'none', 'default_dept_img.jpg'),
('18', 18, 'Divisoria Police Precinct', 'Divisoria Police Precint', 'Police', '', '', '', '', 'none', 'precinct@gmail.com', 'none', 'default_dept_img.jpg'),
('34', 34, 'sample hospital', 'sample hospital', 'Hospital', '', '', '', '', 'none', 'sa@d.c', 'none', 'default_dept_img.jpg'),
('20', 20, 'Macasandig Police Precinct', 'Macasandig Police Precinct near Corpus High School', 'Police', '', '', '', '', 'none', 'macasandig@gmail.com', 'none', 'default_dept_img.jpg'),
('21', 21, 'DILG Office X', 'DILG Office X in Cagayan de Oro City', 'Police', '', '', '', '', 'none', 'dilg@gmail.com', 'none', 'default_dept_img.jpg'),
('22', 22, 'Police Regional Office 10', 'Police Regional Office 10 near Lim Ket Kai', 'Police', '', '', '', '', 'none', 'pnp@gmail.com', 'none', 'default_dept_img.jpg'),
('23', 23, 'Cugman Police Precinct', 'Cugman Police Precinct in Cugman', 'Police', '', '', '', '', 'none', 'cugman@gmail.com', 'none', 'default_dept_img.jpg'),
('24', 24, 'Puerto Police Precinct', 'Puerto Police Precinct in Butuan-Cagayan de Oro-Iligan Road', 'Police', '', '', '', '', 'none', 'puerto@gmail.com', 'none', 'default_dept_img.jpg'),
('25', 25, 'Lumbia Police Precinct', 'Lumbia Police Precinct near Lumbia airport', 'Police', '', '', '', '', 'none', 'lumbia@gmail.com', 'none', 'default_dept_img.jpg'),
('26', 26, 'Macabalan Fire Station', 'Macabalan Fire Station in Julio Pacana Street\nCagayan de Oro', 'Fire Station', '', '', '', '', 'none', 'macabalan@gmail.com', 'none', 'default_dept_img.jpg'),
('27', 27, 'Sun Star', 'Sun Star in CDO', 'Fire Station', '', '', '', '', 'none', 'sunstar@gmail.com', 'none', 'default_dept_img.jpg'),
('28', 28, 'Cagayan de Oro Water District', 'Cagayan de Oro Water District in CDO', 'Fire Station', '', '', '', '', 'none', 'cdowaterdistrict@gmail.com', 'none', 'default_dept_img.jpg'),
('29', 29, 'Cagayan de Oro Fire Station', 'Cagayan de Oro Fire Station in Capt. Vicente Roa\nCagayan de Oro', 'Fire Station', '', '', '', '', 'none', 'cdofirestation@gmail.com', 'none', 'default_dept_img.jpg'),
('30', 30, 'The Executive Building', 'The Executive Building in CDO', 'Fire Station', '', '', '', '', 'none', 'executivebuilding@gmail.com', 'none', 'default_dept_img.jpg'),
('31', 31, '', '', 'Fire Station', '', '', '', '', 'none', 'none', 'none', 'default_dept_img.jpg'),
('32', 32, '', '', 'Fire Station', '', '', '', '', 'none', 'none', 'none', 'default_dept_img.jpg'),
('12', 12, '', '', '', '', '', '', '', 'none', 'none', 'none', 'default_dept_img.jpg'),
('33', 33, '', '', 'Police', '', '', '', '', 'none', 'none', 'none', 'default_dept_img.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `map_location`
--

CREATE TABLE IF NOT EXISTS `map_location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `lat` varchar(50) NOT NULL,
  `lng` varchar(50) NOT NULL,
  `dept_id` varchar(100) NOT NULL,
  `main_dept_id` int(11) NOT NULL,
  `map_name` varchar(250) NOT NULL,
  `map_type` varchar(50) NOT NULL DEFAULT 'ROADMAP',
  `map_description` varchar(1000) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'not_focused',
  `zoom` int(11) NOT NULL DEFAULT '16',
  PRIMARY KEY (`location_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123 ;

--
-- Dumping data for table `map_location`
--

INSERT INTO `map_location` (`location_id`, `lat`, `lng`, `dept_id`, `main_dept_id`, `map_name`, `map_type`, `map_description`, `status`, `zoom`) VALUES
(21, '8.4846723631161', '124.65017164965', '1', 1, 'Bill''s Map', 'ROADMAP', 'MApa nako', 'focus', 17),
(79, '8.475956978198', '124.65500358955', '2', 2, 'Maria Reyna-Xavier University Hospital', 'ROADMAP', 'Maria Reyna here', 'focus', 16),
(88, '8.4984656256621', '124.63030446785', '3', 3, 'Polymedic Medical Plaza map', 'ROADMAP', 'Polymedic Medical Plaza location', 'focus', 17),
(92, '8.4824638564538', '124.64559305923', '4', 4, 'Polymedic General Hospital Map', 'ROADMAP', 'Polymedic General Hospital Map in Velez', 'focus', 16),
(93, '8.4791318391943', '124.6725117089', '5', 5, 'Capitol University Medical City Map', 'ROADMAP', 'Capitol University Medical City Map in C.M. Recto', 'focus', 17),
(94, '8.4856366740536', '124.64945544021', '6', 6, 'Cagayan de Oro Medical Center MAp', 'ROADMAP', 'Cagayan de Oro Medical Center Map in M.H. Del Pilar', 'focus', 16),
(96, '8.4773278687511', '124.63607658165', '7', 7, 'Intellicare Map', 'ROADMAP', 'Intellicare Map in Vamenta', 'focus', 17),
(97, '8.4796438469098', '124.64800972955', '8', 8, 'Thera Links Asia Map', 'ROADMAP', 'Thera Links Asia Map in J.R. Borja', 'focus', 17),
(98, '8.4857719692048', '124.64779247062', '9', 9, 'Sabal Hospital Map', 'ROADMAP', 'Sabal Hospital in Don Apolinar Street', 'focus', 17),
(99, '8.4773172571352', '124.63519681709', '10', 10, 'Madonna & Child Hospital Map', 'ROADMAP', 'Madonna & Child Hospital Serina', 'focus', 17),
(100, '8.4728232114798', '124.63662107008', '11', 11, 'San Ignacio Fundacion De Salud, Inc. Map', 'ROADMAP', 'San Ignacio Fundacion De Salud, Inc. Map at Masterson Ave.,', 'focus', 16),
(104, '8.4824533057371', '124.64560572883', '12', 12, 'PGH Map', 'ROADMAP', 'PGH Map in CDO', 'focus', 18),
(105, '8.4855411715653', '124.65593565719', '13', 13, 'MUST Clinic Map', 'ROADMAP', 'MUST Clinic Map in CDO', 'focus', 18),
(106, '8.49237484521', '124.653564584', '15', 15, 'Van Dave Maternity Clinic and Lying In Map', 'ROADMAP', 'Van Dave Maternity Clinic and Lying In Map at Brgy 22', 'focus', 17),
(107, '8.50424866523', '124.615358458', '16', 16, 'Bulua Police Precinct Map', 'ROADMAP', 'Found in bulua', 'focus', 16),
(108, '8.49678907902', '124.613653314', '17', 17, 'Cagayan de Oro Police Station 7 Map', 'ROADMAP', 'Cagayan de Oro Police Station 7 in Terry Hills', 'focus', 10),
(109, '8.47846330996', '124.641913068', '18', 18, 'divisoria police precinct map', 'ROADMAP', 'divisoria police precinct map in cdo', 'focus', 10),
(110, '8.45979708009', '124.624982965', '21', 21, 'DILG Office X Map', 'ROADMAP', 'DILG Office X Map in CDO', 'focus', 16),
(122, '8.48562606267', '124.655935657', '34', 34, 'sas', 'ROADMAP', 'sas', 'focus', 16),
(112, '8.46525166045', '124.645174635', '20', 20, 'Macasandig Police Precinct Map', 'ROADMAP', 'Macasandig Police Precinct Map in CDO', 'focus', 16),
(113, '8.48104191632', '124.660967481', '22', 22, 'Police Regional Office 10 Map', 'ROADMAP', 'Police Regional Office 10 Map location', 'focus', 16),
(114, '8.46975110047', '124.70383991', '23', 23, 'Cugman Police Precinct Map', 'ROADMAP', 'Cugman Police Precinct in Cugman', 'focus', 16),
(115, '8.49950550534', '124.748783004', '24', 24, 'Puerto Police Precinct Map', 'ROADMAP', 'Puerto Police Precinct Map in Butuan-Cagayan de Oro-Iligan Road', 'focus', 16),
(116, '8.42496659822', '124.607988489', '25', 25, 'Lumbia Police Precinct Map', 'ROADMAP', 'Lumbia Police Precinct in CDO', 'focus', 16),
(117, '8.50415309637', '124.659089935', '26', 26, 'Macabalan Fire Station Map', 'ROADMAP', 'Macabalan Fire Station in CDO', 'focus', 16),
(118, '8.48931880743', '124.650002611', '27', 27, 'Sun Star Map', 'ROADMAP', 'Sun Star Map in CDO', 'focus', 16),
(119, '8.4828246464', '124.636098039', '28', 28, 'Cagayan de Oro Water District Map', 'ROADMAP', 'Cagayan de Oro Water District', 'focus', 16),
(120, '8.47928040109', '124.651231063', '29', 29, 'Cagayan de Oro Fire Station Map', 'ROADMAP', 'Cagayan de Oro Fire Station Map in CDO', 'focus', 16),
(121, '8.47917428546', '124.628244531', '30', 30, 'The Executive Building Map', 'ROADMAP', 'The Executive Building Map in CDO', 'focus', 16);

-- --------------------------------------------------------

--
-- Table structure for table `messaging`
--

CREATE TABLE IF NOT EXISTS `messaging` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `msg_content` varchar(5000) NOT NULL,
  `file` varchar(250) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `notif_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`notif_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_content` varchar(2500) NOT NULL,
  `post_file` varchar(100) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dept_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `user_id`, `post_content`, `post_file`, `post_date`, `dept_id`) VALUES
(2, 2014002, 'Maria Reyna', '', '2015-02-13 23:51:38', 2),
(3, 2014003, 'hey', '', '2015-02-14 08:24:47', 4),
(7, 2014015, '<b>Hello World!</b>', 'DIY_room_decor.JPG', '2015-02-24 05:33:21', 13),
(8, 2014002, 'free check-up', '', '2015-02-26 19:30:23', 2),
(9, 2014019, 'test', '', '2015-03-05 23:07:19', 17),
(13, 2014019, '123', '', '2015-03-05 23:10:22', 17),
(14, 2014002, '1213', '', '2015-03-05 23:10:31', 2),
(15, 2014019, 'www', '', '2015-03-05 23:11:06', 17),
(17, 2014022, 'sss', '', '2015-03-05 23:15:09', 20),
(26, 2014002, 'dasasa', '', '2015-03-05 23:26:40', 2),
(23, 2014031, 'wqwq', '', '2015-03-05 23:25:38', 29);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(75) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(75) NOT NULL,
  `password` varchar(75) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `user_id`, `username`, `password`) VALUES
(1, 'Superadmin', 2014001, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(16, 'Administrator', 2014002, 'maria', '21e80009107a6f9cdc927c2bcd34905d'),
(29, 'Administrator', 2014003, 'jrborja', 'f64a99cb8bf64e38e1d7b8518acd11a3'),
(30, 'Administrator', 2014004, 'pmp', '458d8aab000e42e82040abeadd25172c'),
(33, 'Administrator', 2014007, 'capitol', 'f7410f2693864b4116877b16adc957ca'),
(34, 'Administrator', 2014008, 'medical', '7cbdd4e997c3b8e759f8d579bb30f6f1'),
(35, 'Administrator', 2014009, 'intellicare', 'd34268809a093705e61e499c208544bf'),
(36, 'Administrator', 2014010, 'thera', 'ce59cb72dfdd17ec0061aceb5dd7dc55'),
(37, 'Administrator', 2014011, 'sabal', 'b47dac70aec53d5e0e061ff912cfeadb'),
(38, 'Administrator', 2014012, 'madonna', '6ecc0500d10ea0a41cba814ce259ef75'),
(39, 'Administrator', 2014013, 'ignacio', '5e612fbcf98d8452ce474c972941439d'),
(46, 'Administrator', 2014014, 'pgh', '0db0fa9dc3e5c61eb40c71d157ea9625'),
(47, 'Administrator', 2014015, 'nazareth', 'edb3caab5a3203f463bed4309441c4f2'),
(48, 'Administrator', 2014016, 'rr', '514f1b439f404f86f77090fa9edc96ce'),
(50, 'Administrator', 2014017, 'vandave', '07d1ff851341d41b3f9185d23032fc14'),
(51, 'Administrator', 2014018, 'bulua', 'd74152bd3944dc49667ace315face08c'),
(52, 'Administrator', 2014019, 'station7', 'cdd531a412a19a17cbd4822950ea47d4'),
(53, 'Administrator', 2014020, 'divisoria', '219ced37467d20e7a538f45afc623d4a'),
(68, 'Administrator', 2014035, 'mseder', '52f6beef51ed4168826f4e2c92608d57'),
(55, 'Administrator', 2014022, 'macasandig', '1ebf8605cf774e380208adbdc04ecf8d'),
(56, 'Administrator', 2014023, 'dilg', '55a26706c23e5863360d14bd59631fce'),
(57, 'Administrator', 2014024, 'office10', 'c5761e4bdb5a48cb5ff9192353d0b528'),
(58, 'Administrator', 2014025, 'cugman', '5ee3adb68a0e2f452d2f40520bd078ae'),
(59, 'Administrator', 2014026, 'puerto', '086ff137f78b3660079e101db54faae2'),
(60, 'Administrator', 2014027, 'lumbia', '227a33b0c6b132310881fe94b3a7b1be'),
(61, 'Administrator', 2014028, 'macabalan', '91272a346aa4d5f66e57358e19de5b07'),
(62, 'Administrator', 2014029, 'sunstar', '02207a805c71356a9616cf0fe0ed7193'),
(63, 'Administrator', 2014030, 'waterdistrict', 'e0d35d658024dc1e0003f562dfc68b7a'),
(64, 'Administrator', 2014031, 'cdofirestation', 'e245372ba2d87d27c303749f49657a8c'),
(65, 'Administrator', 2014032, 'executivebuilding', '889080273022e01ccb2ad7103893400a'),
(66, 'Administrator', 2014033, 'viewhomes', '2c18246cb51c5888906f6c572f2b857b'),
(67, 'Administrator', 2014034, 'lumbiaairport', '5b8a057085a9055416f9fcef38c3ed88'),
(69, 'Administrator', 2014036, 'qwe', '76d80224611fc919a5d54f0ff9fba446');

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
  `profile_pic` varchar(150) NOT NULL DEFAULT 'default_image.png',
  `contact_no` bigint(100) NOT NULL,
  `position` varchar(75) NOT NULL,
  `dept_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2014037 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `fname`, `mname`, `lname`, `bday`, `age`, `gender`, `barangay`, `city`, `province`, `postal_code`, `profile_pic`, `contact_no`, `position`, `dept_id`) VALUES
(2014001, 'Billy Joel', 'Loyola', 'Ranario', '1994-08-14', 20, 'Male', 'Carmen', 'Cagayan de Oro', 'Misamis Oriental', 9000, 'default_image.png', 9358994227, 'CEO', 1),
(2014002, 'Maria Reyna', '', 'Admin', '1994-06-24', 20, 'Female', 'Iponan', 'Cagayan de Oro City', 'Misamis Oriental', 9000, 'default_image.png', 0, 'Doctor', 2),
(2014003, 'JR Borja', '', '', '1990-02-13', 25, 'Female', '', '', '', 0, 'default_image.png', 0, '', 3),
(2014004, 'user', 'user', 'user', '0000-00-00', 0, 'Male', '', '', '', 0, 'default_image.png', 0, '', 4),
(2014007, 'Capitol Admin', '', '', '0000-00-00', 0, 'Female', '', '', '', 0, 'default_image.png', 0, '', 5),
(2014008, 'medical admin', '', '', '0000-00-00', 0, 'Female', '', '', '', 0, 'default_image.png', 0, '', 6),
(2014009, 'Intellicare Admin', '', '', '0000-00-00', 0, 'Female', '', '', '', 0, 'default_image.png', 0, '', 7),
(2014010, 'Thera Admin', '', '', '0000-00-00', 0, 'Female', '', '', '', 0, 'default_image.png', 0, '', 8),
(2014011, 'user8', 'user8', 'user8', '0000-00-00', 0, 'Female', '', '', '', 0, 'default_image.png', 0, '', 9),
(2014012, 'madonna', 'madonna', 'madonna', '0000-00-00', 0, 'Female', '', '', '', 0, 'default_image.png', 0, '', 10),
(2014013, 'ignacio', 'ignacio', 'ignacio', '0000-00-00', 0, 'Male', '', '', '', 0, 'default_image.png', 0, '', 11),
(2014014, 'Polymedic', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 12),
(2014015, 'Richard', 'Mercado', 'del Rosario', '0970-02-17', 1045, 'Male', 'Nazareth', 'Cagayan de Oro', 'Misamis Oriental', 9000, 'default_image.png', 0, 'Director', 13),
(2014016, 'Admin', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 14),
(2014017, 'vandave Admin', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 15),
(2014018, 'Bulua Admin', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 16),
(2014019, 'Station7 Admin', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 17),
(2014020, 'Admin', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 18),
(2014021, 'Admin', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 19),
(2014022, 'Macasandig Admin', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 20),
(2014023, 'Admin', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 21),
(2014024, 'Admin', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 22),
(2014025, 'Admin', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 23),
(2014026, 'Admin', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 24),
(2014027, 'Admin', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 25),
(2014028, 'Admin', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 26),
(2014029, 'Admin', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 27),
(2014030, 'Admin', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 28),
(2014031, 'Admin', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 29),
(2014032, 'Admin', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 30),
(2014033, 'Admin', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 31),
(2014034, 'Admin', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 32),
(2014035, 'Admin', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 33),
(2014036, 'Admin', '', '', '0000-00-00', 0, '', '', '', '', 0, 'default_image.png', 0, '', 34);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
