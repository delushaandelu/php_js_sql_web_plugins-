-- phpMyAdmin SQL Dump
-- version 4.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 09, 2016 at 07:27 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `poll_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE IF NOT EXISTS `polls` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `subject`, `created`, `modified`, `status`) VALUES
(1, 'Which is Your Favorite Website for PHP Programming?', '2016-11-07 04:13:13', '2016-11-07 04:13:13', '1');

-- --------------------------------------------------------

--
-- Table structure for table `poll_options`
--

CREATE TABLE IF NOT EXISTS `poll_options` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `poll_options`
--

INSERT INTO `poll_options` (`id`, `poll_id`, `name`, `created`, `modified`, `status`) VALUES
(1, 1, 'CodexWorld', '2016-11-07 11:29:31', '2016-11-07 11:29:31', '1'),
(2, 1, 'SitePoint', '2016-11-07 11:29:31', '2016-11-07 11:29:31', '1'),
(3, 1, 'Envato Tuts+', '2016-11-07 11:29:31', '2016-11-07 11:29:31', '1'),
(4, 1, 'Others', '2016-11-08 08:20:25', '2016-11-08 08:20:25', '1');

-- --------------------------------------------------------

--
-- Table structure for table `poll_votes`
--

CREATE TABLE IF NOT EXISTS `poll_votes` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `poll_option_id` int(11) NOT NULL,
  `vote_count` bigint(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `poll_votes`
--

INSERT INTO `poll_votes` (`id`, `poll_id`, `poll_option_id`, `vote_count`) VALUES
(1, 1, 2, 13),
(2, 1, 1, 14),
(3, 1, 3, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_options`
--
ALTER TABLE `poll_options`
  ADD PRIMARY KEY (`id`), ADD KEY `poll_id` (`poll_id`);

--
-- Indexes for table `poll_votes`
--
ALTER TABLE `poll_votes`
  ADD PRIMARY KEY (`id`), ADD KEY `poll_id` (`poll_id`), ADD KEY `poll_option_id` (`poll_option_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `poll_options`
--
ALTER TABLE `poll_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `poll_votes`
--
ALTER TABLE `poll_votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `poll_options`
--
ALTER TABLE `poll_options`
ADD CONSTRAINT `poll_options_ibfk_1` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `poll_votes`
--
ALTER TABLE `poll_votes`
ADD CONSTRAINT `poll_votes_ibfk_1` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `poll_votes_ibfk_2` FOREIGN KEY (`poll_option_id`) REFERENCES `poll_options` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
