-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2015 at 03:55 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `exforum`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(8) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `cat_description` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name_unique` (`cat_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_description`) VALUES
(1, 'Dive News', 'Dive News'),
(3, 'Second Cat', 'This is the second cat');

-- --------------------------------------------------------

--
-- Table structure for table `divelog`
--

CREATE TABLE IF NOT EXISTS `divelog` (
  `user_id` int(8) NOT NULL,
  `subSiteNum` int(11) NOT NULL,
  `logNumber` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `temperature` int(11) NOT NULL,
  `maxDepth` int(11) NOT NULL,
  `current` varchar(25) NOT NULL,
  `visibility` varchar(25) NOT NULL,
  PRIMARY KEY (`logNumber`),
  KEY `subSiteNum` (`subSiteNum`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `divelog`
--

INSERT INTO `divelog` (`user_id`, `subSiteNum`, `logNumber`, `date`, `temperature`, `maxDepth`, `current`, `visibility`) VALUES
(1, 1, 1, '2015-03-28', 72, 22, 'moderate', 'low');

-- --------------------------------------------------------

--
-- Table structure for table `divesite`
--

CREATE TABLE IF NOT EXISTS `divesite` (
  `diveSiteNum` int(11) NOT NULL AUTO_INCREMENT,
  `diveSite` varchar(100) NOT NULL,
  `addressNumber` int(11) NOT NULL,
  `zipCode` int(11) NOT NULL,
  PRIMARY KEY (`diveSiteNum`),
  KEY `diveSite` (`diveSite`),
  KEY `addressNumber` (`addressNumber`),
  KEY `zipCode` (`zipCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `divesite`
--

INSERT INTO `divesite` (`diveSiteNum`, `diveSite`, `addressNumber`, `zipCode`) VALUES
(1, 'Paradise Spring', 1, 34480);

-- --------------------------------------------------------

--
-- Table structure for table `divesitedetails`
--

CREATE TABLE IF NOT EXISTS `divesitedetails` (
  `diveSiteNum` int(11) NOT NULL,
  `subSiteNum` int(11) NOT NULL AUTO_INCREMENT,
  `subSiteName` varchar(100) DEFAULT NULL,
  `siteInstruction` varchar(25) DEFAULT NULL,
  `siteDetails` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`subSiteNum`),
  KEY `diveSiteNum` (`diveSiteNum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `divesitedetails`
--

INSERT INTO `divesitedetails` (`diveSiteNum`, `subSiteNum`, `subSiteName`, `siteInstruction`, `siteDetails`) VALUES
(1, 1, 'Sink Hole Dive', NULL, 'Natural Sink hole with wide open spaces. Basic cavern environment');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(8) NOT NULL AUTO_INCREMENT,
  `post_content` text NOT NULL,
  `post_date` datetime NOT NULL,
  `post_topic` int(8) NOT NULL,
  `post_by` int(8) NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `post_topic` (`post_topic`),
  KEY `post_by` (`post_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_content`, `post_date`, `post_topic`, `post_by`) VALUES
(1, 'A Discussion', '2015-04-08 20:54:13', 2, 1),
(2, 'This is a discussion', '2015-04-08 21:44:36', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sitelocation`
--

CREATE TABLE IF NOT EXISTS `sitelocation` (
  `zipCode` int(11) NOT NULL,
  `addressNumber` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(150) NOT NULL,
  PRIMARY KEY (`addressNumber`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sitelocation`
--

INSERT INTO `sitelocation` (`zipCode`, `addressNumber`, `address`) VALUES
(34480, 1, '4040 SE 84th Lane Rd');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `topic_id` int(8) NOT NULL AUTO_INCREMENT,
  `topic_subject` varchar(255) NOT NULL,
  `topic_date` datetime NOT NULL,
  `topic_cat` int(8) NOT NULL,
  `topic_by` int(8) NOT NULL,
  PRIMARY KEY (`topic_id`),
  KEY `topic_cat` (`topic_cat`),
  KEY `topic_by` (`topic_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_subject`, `topic_date`, `topic_cat`, `topic_by`) VALUES
(2, 'First Post', '2015-04-08 20:54:13', 1, 1),
(3, 'First Post', '2015-04-08 21:44:36', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(8) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_date` datetime NOT NULL,
  `user_level` int(8) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name_unique` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_date`, `user_level`) VALUES
(1, 'testShawn', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'ssuit41@gmail.com', '2015-04-08 16:28:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zipcode`
--

CREATE TABLE IF NOT EXISTS `zipcode` (
  `zipCode` int(11) NOT NULL,
  `city` varchar(40) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  PRIMARY KEY (`zipCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zipcode`
--

INSERT INTO `zipcode` (`zipCode`, `city`, `state`, `latitude`, `longitude`) VALUES
(34480, 'Ocala', 'FL', 29.12, 82.09);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_topic`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`post_by`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`topic_cat`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`topic_by`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
