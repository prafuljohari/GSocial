-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2013 at 01:44 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gsocial`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `userid` varchar(40) NOT NULL DEFAULT '',
  `groupid` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`userid`,`groupid`),
  KEY `FK_admin_groups` (`groupid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`userid`, `groupid`) VALUES
('praful', 'IITG-2014'),
('praful', 'Kameng'),
('anuj', 'Kapili'),
('a.kanetkar@iitg.ernet.in', 'Manas'),
('shivangi@iitg.ernet.in', 'Subansiri'),
('kashish@iitg.ernet.in', 'Umiam');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `commentid` int(11) NOT NULL AUTO_INCREMENT,
  `file_pointer` varchar(255) DEFAULT NULL,
  `comment_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `postid` int(11) NOT NULL DEFAULT '0',
  `sender_userid` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`commentid`,`postid`),
  KEY `postid` (`postid`),
  KEY `comments_ibfk_2` (`sender_userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentid`, `file_pointer`, `comment_time`, `postid`, `sender_userid`) VALUES
(16, 'second comment on second post', NULL, 61, 'anuj'),
(17, 'first comment on first post', NULL, 60, 'praful'),
(18, 'third comment on second post', NULL, 61, 'praful'),
(19, 'first comment on fifth post', NULL, 64, 'praful'),
(20, 'comment', NULL, 65, 'praful'),
(22, 'Comment 2', '2013-04-13 09:48:44', 67, 'anuj'),
(23, 'comment 3', '2013-04-13 09:49:16', 67, 'praful'),
(24, 'Test comment 1', '2013-04-13 15:13:43', 69, 'praful'),
(25, 'Test comment 2', '2013-04-13 15:13:49', 69, 'praful'),
(26, 'So? :/', '2013-04-13 15:14:25', 70, 's.achal@iitg.ernet.in');

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE IF NOT EXISTS `conversation` (
  `convid` int(11) NOT NULL AUTO_INCREMENT,
  `sender_userid` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`convid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`convid`, `sender_userid`) VALUES
(1, 'praful'),
(2, 'praful'),
(3, 'praful'),
(4, 'praful'),
(5, 'praful'),
(6, 'praful'),
(7, 'praful'),
(8, 'praful'),
(9, 'praful'),
(10, 'praful'),
(11, 'praful'),
(12, 'praful'),
(13, 'praful'),
(14, 'praful'),
(15, 'anuj'),
(16, 'praful'),
(17, 'praful'),
(18, 'praful'),
(19, 'praful'),
(20, 'praful'),
(21, 'praful'),
(22, 'praful'),
(23, 'kashish@iitg.ernet.in');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `groupid` varchar(60) NOT NULL DEFAULT '',
  `description` text,
  PRIMARY KEY (`groupid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupid`, `description`) VALUES
('Barak', 'Hostel'),
('Brahmaputra', 'Hostel'),
('Dihing', 'Hostel'),
('IITG-2014', 'Batch'),
('Kameng', 'Hostel'),
('Kapili', 'Hostel'),
('Manas', 'Hostel'),
('Married Scholars', 'Hostel'),
('Subansiri', 'Hostel'),
('Umiam', 'Hostel');

-- --------------------------------------------------------

--
-- Table structure for table `has_msgs`
--

CREATE TABLE IF NOT EXISTS `has_msgs` (
  `convid` int(11) NOT NULL DEFAULT '0',
  `messageid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`convid`,`messageid`),
  KEY `messageid` (`messageid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `has_msgs`
--

INSERT INTO `has_msgs` (`convid`, `messageid`) VALUES
(1, 1),
(3, 5),
(5, 21),
(5, 29),
(4, 31),
(6, 32),
(15, 34),
(5, 38),
(16, 39),
(18, 40),
(17, 41),
(23, 42);

-- --------------------------------------------------------

--
-- Table structure for table `has_posts`
--

CREATE TABLE IF NOT EXISTS `has_posts` (
  `postid` int(11) NOT NULL DEFAULT '0',
  `groupid` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`postid`,`groupid`),
  KEY `groupid` (`groupid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `has_posts`
--

INSERT INTO `has_posts` (`postid`, `groupid`) VALUES
(60, 'Kameng'),
(61, 'Kameng'),
(62, 'Kameng'),
(63, 'Kameng'),
(64, 'Kameng'),
(65, 'Kameng'),
(67, 'Kameng'),
(68, 'Kameng'),
(69, 'Kameng'),
(70, 'Kameng'),
(71, 'Manas');

-- --------------------------------------------------------

--
-- Table structure for table `is_in`
--

CREATE TABLE IF NOT EXISTS `is_in` (
  `userid` varchar(40) NOT NULL DEFAULT '',
  `groupid` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`userid`,`groupid`),
  KEY `groupid` (`groupid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `is_in`
--

INSERT INTO `is_in` (`userid`, `groupid`) VALUES
('praful', 'Kameng'),
('s.achal@iitg.ernet.in', 'Kameng'),
('praful', 'Kapili'),
('a.kanetkar@iitg.ernet.in', 'Manas');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `userid` varchar(40) NOT NULL DEFAULT '',
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`userid`, `password`) VALUES
('a.kanetkar@iitg.ernet.in', 'aditya'),
('anuj', 'a'),
('g.neha@iitg.ernet.in', 'neha'),
('kashish@iitg.ernet.in', 'kashish'),
('praful', 'a'),
('s.achal@iitg.ernet.in', 'achal'),
('sejal@iitg.ernet.in', 'sejal'),
('shivangi@iitg.ernet.in', 'shivangi');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `convid` int(11) NOT NULL DEFAULT '0',
  `userid` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`convid`,`userid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`convid`, `userid`) VALUES
(1, 'anuj'),
(3, 'anuj'),
(5, 'anuj'),
(8, 'anuj'),
(9, 'anuj'),
(10, 'anuj'),
(11, 'anuj'),
(12, 'anuj'),
(14, 'anuj'),
(15, 'anuj'),
(17, 'anuj'),
(18, 'anuj'),
(23, 'kashish@iitg.ernet.in'),
(1, 'praful'),
(3, 'praful'),
(4, 'praful'),
(5, 'praful'),
(6, 'praful'),
(7, 'praful'),
(8, 'praful'),
(9, 'praful'),
(10, 'praful'),
(11, 'praful'),
(12, 'praful'),
(13, 'praful'),
(14, 'praful'),
(15, 'praful'),
(16, 'praful'),
(17, 'praful'),
(18, 'praful'),
(19, 'praful'),
(20, 'praful'),
(21, 'praful'),
(22, 'praful'),
(23, 'praful'),
(23, 's.achal@iitg.ernet.in'),
(1, 'shivangi@iitg.ernet.in'),
(3, 'shivangi@iitg.ernet.in'),
(4, 'shivangi@iitg.ernet.in'),
(6, 'shivangi@iitg.ernet.in'),
(7, 'shivangi@iitg.ernet.in'),
(8, 'shivangi@iitg.ernet.in'),
(11, 'shivangi@iitg.ernet.in'),
(13, 'shivangi@iitg.ernet.in'),
(16, 'shivangi@iitg.ernet.in'),
(18, 'shivangi@iitg.ernet.in'),
(19, 'shivangi@iitg.ernet.in'),
(20, 'shivangi@iitg.ernet.in'),
(23, 'shivangi@iitg.ernet.in');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `messageid` int(11) NOT NULL AUTO_INCREMENT,
  `file_pointer` varchar(255) DEFAULT NULL,
  `sender_userid` varchar(255) DEFAULT NULL,
  `msg_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`messageid`),
  KEY `FK_messages_profile` (`sender_userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageid`, `file_pointer`, `sender_userid`, `msg_time`) VALUES
(1, 'Hi Shivangi!', 'praful', NULL),
(4, 'hi anuj!', 'praful', NULL),
(5, 'Aur be anuj?', 'praful', NULL),
(21, 'Hello!', 'praful', NULL),
(23, 'This is a test message.', 'praful', NULL),
(24, 'Message testing in process.', 'praful', NULL),
(29, 'No idea what is going on', 'praful', NULL),
(31, 'Kanetkar ko add karo koi!', 'praful', NULL),
(32, 'Nautanki!', 'praful', NULL),
(34, 'Hey praful!', 'anuj', NULL),
(38, 'Message 1', 'praful', NULL),
(39, 'Message 2', 'praful', NULL),
(40, 'Message 3', 'praful', NULL),
(41, 'Message 4', 'praful', NULL),
(42, 'Hey guyz!!', 'kashish@iitg.ernet.in', '2013-04-13 17:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `msg_notif`
--

CREATE TABLE IF NOT EXISTS `msg_notif` (
  `notif_type` int(11) NOT NULL DEFAULT '0',
  `messageid` int(11) NOT NULL DEFAULT '0',
  `notif_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`notif_type`,`messageid`),
  KEY `messageid` (`messageid`),
  KEY `FK_msg_notif_notification` (`notif_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msg_notif`
--

INSERT INTO `msg_notif` (`notif_type`, `messageid`, `notif_id`) VALUES
(0, 16, 6),
(1, 39, 7),
(0, 17, 10),
(0, 18, 11),
(1, 40, 12),
(1, 41, 13),
(0, 20, 19),
(0, 21, 20),
(0, 22, 21),
(0, 23, 22),
(1, 42, 23),
(1, 43, 24);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `notif_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '0',
  `notif_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`notif_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notif_id`, `type`, `notif_time`) VALUES
(2, 0, '2013-04-13 09:45:58'),
(4, 0, '2013-04-13 09:48:44'),
(5, 0, '2013-04-13 09:49:16'),
(6, 1, '2013-04-13 13:22:37'),
(7, 1, '2013-04-13 13:23:25'),
(8, 0, '2013-04-13 13:32:23'),
(9, 0, '2013-04-13 13:41:22'),
(10, 1, '2013-04-13 13:42:05'),
(11, 1, '2013-04-13 13:46:33'),
(12, 1, '2013-04-13 13:46:37'),
(13, 1, '2013-04-13 13:58:52'),
(14, 0, '2013-04-13 15:13:43'),
(15, 0, '2013-04-13 15:13:49'),
(16, 0, '2013-04-13 15:14:01'),
(17, 0, '2013-04-13 15:14:25'),
(18, 0, '2013-04-13 16:22:38'),
(19, 1, '2013-04-13 17:06:07'),
(20, 1, '2013-04-13 17:07:42'),
(21, 1, '2013-04-13 17:07:45'),
(22, 1, '2013-04-13 17:54:06'),
(23, 1, '2013-04-13 17:54:10'),
(24, 1, '2013-04-13 18:02:56');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `postid` int(11) NOT NULL AUTO_INCREMENT,
  `sender_userid` varchar(40) NOT NULL,
  `file_pointer` varchar(255) NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`postid`),
  KEY `sender_userid` (`sender_userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`postid`, `sender_userid`, `file_pointer`, `post_time`) VALUES
(60, 'praful', 'first post', '0000-00-00 00:00:00'),
(61, 'anuj', 'second post', '0000-00-00 00:00:00'),
(62, 'praful', 'third post', '0000-00-00 00:00:00'),
(63, 'praful', 'fourth post', '0000-00-00 00:00:00'),
(64, 'praful', 'fifth post', '0000-00-00 00:00:00'),
(65, 'praful', 'new post', '0000-00-00 00:00:00'),
(67, 'praful', 'Hi there!', '2013-04-13 09:45:58'),
(68, 'praful', 'aksdasgd', '2013-04-13 13:32:23'),
(69, 'praful', 'This is a test post.', '2013-04-13 13:41:22'),
(70, 'praful', 'Latest post!', '2013-04-13 15:14:01'),
(71, 'a.kanetkar@iitg.ernet.in', 'Jai Manas!', '2013-04-13 16:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `post_notif`
--

CREATE TABLE IF NOT EXISTS `post_notif` (
  `notif_id` int(11) NOT NULL DEFAULT '0',
  `post_or_comment_id` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`notif_id`),
  KEY `FK_post_notif_post` (`post_or_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_notif`
--

INSERT INTO `post_notif` (`notif_id`, `post_or_comment_id`, `type`) VALUES
(2, 67, 0),
(4, 22, 1),
(5, 23, 1),
(8, 68, 0),
(9, 69, 0),
(14, 24, 1),
(15, 25, 1),
(16, 70, 0),
(17, 26, 1),
(18, 71, 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `userid` varchar(40) NOT NULL DEFAULT '',
  `name` varchar(40) DEFAULT NULL,
  `department` varchar(60) DEFAULT NULL,
  `hostel` varchar(40) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `designation` varchar(40) DEFAULT NULL,
  `about_me` text,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`userid`, `name`, `department`, `hostel`, `dob`, `designation`, `about_me`) VALUES
('a.kanetkar@iitg.ernet.in', 'Aditya Kanetkar', 'CSE', 'Manas', '2013-03-28', 'Student', 'Aditya Kanetkar'),
('anuj', 'Anuj Gupta', 'CSE', 'Kameng', '2013-03-28', 'Student', '123123123'),
('g.neha@iitg.ernet.in', 'Neha Goyal', 'CSE', 'Subhansiri', '2013-06-04', 'Student', ''),
('kashish@iitg.ernet.in', 'Kashish Babbar', 'CSE', 'Umiam', '2013-03-28', 'Student', ''),
('praful', 'Praful Johari', 'CSE', 'Kameng', '2013-03-28', 'Student', 'I am a student. :/'),
('s.achal@iitg.ernet.in', 'Achal Shah', 'CSE', 'Dihing', '2013-03-28', 'Student', 'Achal'),
('sejal@iitg.ernet.in', 'Sejal ', 'CSE', 'Subhansiri', '2013-03-28', 'Student', ''),
('shivangi@iitg.ernet.in', 'Shivangi', 'CSE', 'Kameng', '2013-03-28', 'Student', '');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `requestid` int(10) NOT NULL AUTO_INCREMENT,
  `request_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`requestid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`requestid`, `request_time`, `status`) VALUES
(1, '2013-04-13 09:53:13', 1),
(3, '2013-04-13 11:02:28', 1),
(4, '2013-04-13 11:02:17', 0),
(5, '2013-04-13 11:04:45', 1),
(6, '2013-04-13 14:08:26', 0),
(7, '2013-04-13 14:58:34', 0),
(8, '2013-04-13 15:11:16', 1),
(9, '2013-04-13 14:59:33', 0),
(10, '2013-04-13 15:00:38', 0),
(11, '2013-04-13 15:02:28', 0),
(12, '2013-04-13 15:02:41', 0),
(13, '2013-04-13 15:03:29', 0),
(15, '2013-04-13 15:48:10', 0),
(16, '2013-04-13 15:48:20', 0),
(17, '2013-04-13 15:50:25', 0),
(18, '2013-04-13 15:50:51', 0),
(19, '2013-04-13 15:53:55', 0),
(20, '2013-04-13 16:17:00', 0),
(21, '2013-04-13 16:20:01', 0),
(22, '2013-04-13 16:22:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `request_rel`
--

CREATE TABLE IF NOT EXISTS `request_rel` (
  `requestid` int(10) NOT NULL DEFAULT '0',
  `userid` varchar(40) NOT NULL DEFAULT '',
  `groupid` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`requestid`,`userid`,`groupid`),
  KEY `FK__profile` (`userid`),
  KEY `FK__groups` (`groupid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_rel`
--

INSERT INTO `request_rel` (`requestid`, `userid`, `groupid`) VALUES
(22, 'a.kanetkar@iitg.ernet.in', 'Manas'),
(1, 'anuj', 'Kameng'),
(3, 'praful', 'Kapili'),
(4, 'praful', 'IITG-2014'),
(5, 'praful', 'Kapili'),
(15, 'praful', 'Umiam'),
(20, 'praful', 'Umiam'),
(7, 's.achal@iitg.ernet.in', 'Kapili'),
(8, 's.achal@iitg.ernet.in', 'Kameng');

-- --------------------------------------------------------

--
-- Table structure for table `user_notif`
--

CREATE TABLE IF NOT EXISTS `user_notif` (
  `notif_id` int(11) NOT NULL DEFAULT '0',
  `seen_unseen` int(11) DEFAULT NULL,
  `userid` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`notif_id`,`userid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_notif`
--

INSERT INTO `user_notif` (`notif_id`, `seen_unseen`, `userid`) VALUES
(2, 0, 'anuj'),
(2, 1, 'praful'),
(4, 0, 'anuj'),
(4, 1, 'praful'),
(5, 0, 'anuj'),
(5, 1, 'praful'),
(6, 1, 'praful'),
(6, 0, 'shivangi@iitg.ernet.in'),
(7, 0, 'shivangi@iitg.ernet.in'),
(8, 1, 'praful'),
(10, 0, 'anuj'),
(10, 1, 'praful'),
(11, 0, 'anuj'),
(11, 0, 'shivangi@iitg.ernet.in'),
(12, 0, 'anuj'),
(12, 0, 'shivangi@iitg.ernet.in'),
(13, 0, 'anuj'),
(16, 1, 's.achal@iitg.ernet.in'),
(17, 0, 'praful'),
(19, 0, 'shivangi@iitg.ernet.in'),
(22, 0, 'praful'),
(22, 0, 's.achal@iitg.ernet.in'),
(22, 0, 'shivangi@iitg.ernet.in'),
(23, 0, 'praful'),
(23, 0, 's.achal@iitg.ernet.in'),
(23, 0, 'shivangi@iitg.ernet.in'),
(24, 0, 'praful'),
(24, 0, 's.achal@iitg.ernet.in'),
(24, 0, 'shivangi@iitg.ernet.in');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK_admin_groups` FOREIGN KEY (`groupid`) REFERENCES `groups` (`groupid`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_admin_profile` FOREIGN KEY (`userid`) REFERENCES `profile` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `post` (`postid`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`sender_userid`) REFERENCES `profile` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `has_msgs`
--
ALTER TABLE `has_msgs`
  ADD CONSTRAINT `has_msgs_ibfk_1` FOREIGN KEY (`convid`) REFERENCES `conversation` (`convid`) ON DELETE CASCADE,
  ADD CONSTRAINT `has_msgs_ibfk_2` FOREIGN KEY (`messageid`) REFERENCES `messages` (`messageid`) ON DELETE CASCADE;

--
-- Constraints for table `has_posts`
--
ALTER TABLE `has_posts`
  ADD CONSTRAINT `has_posts_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `post` (`postid`) ON DELETE CASCADE,
  ADD CONSTRAINT `has_posts_ibfk_2` FOREIGN KEY (`groupid`) REFERENCES `groups` (`groupid`) ON DELETE CASCADE;

--
-- Constraints for table `is_in`
--
ALTER TABLE `is_in`
  ADD CONSTRAINT `is_in_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `profile` (`userid`) ON DELETE CASCADE,
  ADD CONSTRAINT `is_in_ibfk_2` FOREIGN KEY (`groupid`) REFERENCES `groups` (`groupid`) ON DELETE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `profile` (`userid`);

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`convid`) REFERENCES `conversation` (`convid`) ON DELETE CASCADE,
  ADD CONSTRAINT `members_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `profile` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `FK_messages_profile` FOREIGN KEY (`sender_userid`) REFERENCES `profile` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `msg_notif`
--
ALTER TABLE `msg_notif`
  ADD CONSTRAINT `FK_msg_notif_notification` FOREIGN KEY (`notif_id`) REFERENCES `notification` (`notif_id`) ON DELETE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`sender_userid`) REFERENCES `profile` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `post_notif`
--
ALTER TABLE `post_notif`
  ADD CONSTRAINT `FK_post_notif_notification` FOREIGN KEY (`notif_id`) REFERENCES `notification` (`notif_id`) ON DELETE CASCADE;

--
-- Constraints for table `request_rel`
--
ALTER TABLE `request_rel`
  ADD CONSTRAINT `FK__groups` FOREIGN KEY (`groupid`) REFERENCES `groups` (`groupid`),
  ADD CONSTRAINT `FK__profile` FOREIGN KEY (`userid`) REFERENCES `profile` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK__request` FOREIGN KEY (`requestid`) REFERENCES `request` (`requestid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_notif`
--
ALTER TABLE `user_notif`
  ADD CONSTRAINT `FK_user_notif_notification` FOREIGN KEY (`notif_id`) REFERENCES `notification` (`notif_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_notif_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `profile` (`userid`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
