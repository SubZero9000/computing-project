-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 18, 2016 at 02:47 PM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `brent_athletics`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(20) NOT NULL,
  `event_time` time NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `event_name`, `event_time`) VALUES
(1, '100m', '13:00:00'),
(2, '800m', '13:30:00'),
(3, 'Long Jump', '14:00:00'),
(4, 'Triple Jump ', '14:30:00'),
(5, '200m', '14:30:00'),
(6, '1500m', '14:40:00'),
(7, '400m', '14:50:00'),
(8, '300m', '14:55:00'),
(9, 'Relay', '15:00:00'),
(10, 'High Jump', '11:00:00'),
(11, 'Shot Putt', '11:10:00'),
(12, 'Discus', '12:00:00'),
(13, 'Javelin', '12:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE IF NOT EXISTS `result` (
  `result_id` int(11) NOT NULL AUTO_INCREMENT,
  `result_studpoints` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `studevent_result` varchar(11) NOT NULL,
  `result_position` int(2) NOT NULL,
  PRIMARY KEY (`result_id`),
  KEY `stud_id` (`stud_id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`result_id`, `result_studpoints`, `event_id`, `stud_id`, `studevent_result`, `result_position`) VALUES
(5, 10, 1, 1, '00:10:24', 0),
(6, 7, 2, 4, '02:10:03', 0),
(7, 1, 3, 3, '1.50', 1),
(8, 9, 1, 5, '00:09:62', 0),
(9, 10, 5, 6, '00:19:19', 0),
(10, 8, 4, 7, '6.27', 0),
(11, 8, 1, 8, '00:09:63', 0),
(12, 7, 1, 10, '00:10:53', 0),
(13, 5, 1, 9, '00:12:63', 0),
(14, 2, 1, 11, '00:13:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `stud_id` int(11) NOT NULL AUTO_INCREMENT,
  `stud_fname` varchar(30) NOT NULL,
  `stud_sname` varchar(30) NOT NULL,
  `stud_yrgroup` int(11) NOT NULL,
  `stud_school` varchar(60) NOT NULL,
  `stud_gender` char(1) NOT NULL,
  PRIMARY KEY (`stud_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stud_id`, `stud_fname`, `stud_sname`, `stud_yrgroup`, `stud_school`, `stud_gender`) VALUES
(1, 'Bob', 'Smith', 7, 'Preston Manor', 'M'),
(3, 'Sam', 'Cro', 9, 'Ark', 'M'),
(4, 'Emily', 'Davis', 10, 'CCA', 'F'),
(5, 'Dave', 'Jackson', 9, 'CCA', 'M'),
(6, 'Eden', 'Hazard', 10, 'Preston Manor', 'M'),
(7, 'Jessica', 'Richards', 7, 'Ark', 'F'),
(8, 'Bobby', 'Brown', 9, 'Ark', 'M'),
(9, 'Richard', 'Green', 9, 'CCA', 'M'),
(10, 'Daniel', 'Grey', 9, 'Preston Manor', 'M'),
(11, 'David', 'Bolt', 9, 'Ark', 'M');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`),
  ADD CONSTRAINT `result_ibfk_2` FOREIGN KEY (`stud_id`) REFERENCES `students` (`stud_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
