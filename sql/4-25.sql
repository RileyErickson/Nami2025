-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2025 at 06:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbahtngmaidjgd`
--
CREATE DATABASE IF NOT EXISTS `dbahtngmaidjgd` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dbahtngmaidjgd`;

-- --------------------------------------------------------

--
-- Table structure for table `blacklisted`
--

CREATE TABLE `blacklisted` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dbanimals`
--

CREATE TABLE `dbanimals` (
  `id` int(11) NOT NULL,
  `odhs_id` varchar(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `breed` varchar(256) DEFAULT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `spay_neuter_done` varchar(3) NOT NULL,
  `spay_neuter_date` date DEFAULT NULL,
  `rabies_given_date` date NOT NULL,
  `rabies_due_date` date DEFAULT NULL,
  `heartworm_given_date` date NOT NULL,
  `heartworm_due_date` date DEFAULT NULL,
  `distemper1_given_date` date NOT NULL,
  `distemper1_due_date` date DEFAULT NULL,
  `distemper2_given_date` date NOT NULL,
  `distemper2_due_date` date DEFAULT NULL,
  `distemper3_given_date` date NOT NULL,
  `distemper3_due_date` date DEFAULT NULL,
  `microchip_done` varchar(3) NOT NULL,
  `archived` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dbanimals`
--

INSERT INTO `dbanimals` (`id`, `odhs_id`, `name`, `breed`, `age`, `gender`, `notes`, `spay_neuter_done`, `spay_neuter_date`, `rabies_given_date`, `rabies_due_date`, `heartworm_given_date`, `heartworm_due_date`, `distemper1_given_date`, `distemper1_due_date`, `distemper2_given_date`, `distemper2_due_date`, `distemper3_given_date`, `distemper3_due_date`, `microchip_done`, `archived`) VALUES
(1, '1234', 'Noodle', 'Schnoodle', 5, 'female', '', 'yes', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'no', 'no'),
(2, '43221', 'Cin', 'Poodle', 18, 'female', ' | Bordetella: 2024-01-24', 'yes', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2024-01-24', '2030-01-24', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'no', 'no'),
(3, '543534', 'Rosie', 'Cat', 9, 'male', '', 'yes', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'no', 'no'),
(4, '890890', 'George', 'Cat', 6, 'female', '', 'yes', '2024-01-05', '2024-01-26', '2026-01-02', '0000-00-00', '2024-01-22', '0000-00-00', '2024-01-29', '0000-00-00', '2024-01-24', '0000-00-00', '2024-01-25', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `dbeventmedia`
--

CREATE TABLE `dbeventmedia` (
  `id` int(11) NOT NULL,
  `eventID` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `type` text NOT NULL,
  `file_format` text NOT NULL,
  `description` text NOT NULL,
  `altername_name` text NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dbeventpersons`
--

CREATE TABLE `dbeventpersons` (
  `eventID` int(11) NOT NULL,
  `userID` varchar(256) NOT NULL,
  `position` text NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dbeventpersons`
--

INSERT INTO `dbeventpersons` (`eventID`, `userID`, `position`, `notes`) VALUES
(30, 'test', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(31, 'test', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(29, 'someInfo2', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(28, 'username', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(28, 'lucy', 'v', ''),
(29, 'fredastaire', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(64, 'test', 'v', 'Skills: no | Dietary restrictions: no | Disabilities: no | Materials: no'),
(36, 'username', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(71, 'test', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(72, 'test', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(64, 'fredastaire', 'v', 'Skills: Dance | Dietary restrictions:  | Disabilities:  | Materials: Cookies'),
(71, 'fredastaire', 'v', ''),
(71, 'lucy', 'v', ''),
(75, 'lucy', 'v', ''),
(64, 'vmsroot', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(36, 'fredastaire', 'v', 'Skills: Tap dancer (films include Top Hat and Shall We Dance) | Dietary restrictions:  | Disabilities:  | Materials: Tap shoes'),
(73, 'vmsroot', 'v', 'Skills: Baking | Dietary restrictions:  | Disabilities:  | Materials: Marmalade and toast'),
(36, 'morgan', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(36, 'charles', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(64, 'charles', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(79, 'charles', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(70, 'lucy', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: Marmalade and toast'),
(70, 'vmsroot', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials:'),
(78, 'charles', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials:'),
(79, 'testuser', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(82, 'testuser', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(83, 'testuser', 'v', 'Skills: No | Dietary restrictions: No | Disabilities: No | Materials: No'),
(97, 'morgan', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(81, 'charles', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(73, 'fredastaire', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: Cookies'),
(101, 'stepvainc@gmail.com', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials:'),
(101, 'StrawberryJade', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials:'),
(101, 'SaraDowd', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials:'),
(101, 'ebrenna2', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials:'),
(100, 'vmsroot', 'v', 'Skills: None | Dietary restrictions: None | Disabilities: None | Materials: None');

-- --------------------------------------------------------

--
-- Table structure for table `dbevents`
--

CREATE TABLE `dbevents` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `date` char(10) NOT NULL,
  `startTime` char(5) NOT NULL,
  `endTime` char(5) NOT NULL,
  `description` text NOT NULL,
  `capacity` int(11) NOT NULL,
  `completed` text NOT NULL,
  `event_type` text NOT NULL,
  `restricted_signup` tinyint(1) NOT NULL,
  `location` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dbevents`
--

INSERT INTO `dbevents` (`id`, `name`, `date`, `startTime`, `endTime`, `description`, `capacity`, `completed`, `event_type`, `restricted_signup`, `location`) VALUES
(28, 'Thanksgiving Feast', '2024-11-28', '', '23:59', 'There is so much to give thanks for!', 0, 'no', '', 1, NULL),
(29, 'Tuesdays with the Troubadours', '2024-11-26', '', '23:59', 'The Troubadours are live!', 0, 'no', '', 0, NULL),
(30, 'Hogwarts Festival', '2024-11-23', '', '23:59', 'Hello', 0, 'no', '', 0, 'Hogwarts'),
(31, 'Sing Together!', '2024-11-23', '', '23:59', 'aoeiaoei', 0, 'no', '', 0, NULL),
(36, 'Daytime Yoga', '2024-12-17', '11:00', '12:00', 'Weekly event', 25, 'no', '', 0, 'STEP VA Studio'),
(47, 'Finding Nemo Jr Audition Track', '2025-01-02', '18:00', '20:00', '(ages 10+)', 30, 'no', '', 0, 'Riverside First Church of God'),
(64, 'Christmas Cookie Party', '2024-12-14', '16:00', '18:00', 'Bring your favorite cookie recipe to share!', 0, 'yes', '', 0, NULL),
(69, 'Finding Nemo Jr: Tech Classes', '2025-01-07', '18:00', '20:00', 'ages 13+', 12, 'no', '', 1, 'STEP VA Studio: 3328 Bourbon Street'),
(70, 'Rolex Paris Masters', '2024-12-25', '13:00', '15:00', 'Testing testing 123', 99, 'no', '', 1, 'Location'),
(71, 'Christmas Party', '2024-12-22', '18:00', '21:00', 'Welcome!', 100, 'no', '', 1, 'Palace'),
(72, 'Awesome Event 2024', '2024-12-05', '13:00', '17:00', 'This is the most awesome event of 2024!', 50, 'no', '', 0, 'UMW'),
(73, 'Finding Nemo Jr.', '2025-07-19', '17:00', '18:30', 'Come and see the children perform!', 100, 'no', '', 1, 'Step VA headquarters'),
(75, 'The Spotsylvanians', '2024-12-14', '19:00', '21:00', 'The Spotsylvanians Present A Hometown Holiday', 100, 'no', '', 1, 'Riverbend High School 12301 Spotswood Furnace Road Fredericksburg'),
(76, 'Fred&#039;s Piano Recital', '2024-12-14', '18:00', '21:00', 'Come hear Fred play piano!', 99, 'no', '', 0, 'StepVA Headquarters'),
(78, 'Costume making', '2024-12-23', '12:00', '17:00', 'Costume making', 10, 'no', '', 1, 'location'),
(79, 'Singing lessons', '2024-12-22', '12:00', '17:00', 'Singing Lessons', 10, 'no', '', 0, 'Location'),
(80, 'Arts and Crafts', '2024-12-11', '12:00', '17:00', 'Awesome!', 10, 'no', '', 0, 'location'),
(81, 'Dancing lessons', '2024-12-18', '12:00', '17:00', 'dancing lessons!', 10, 'no', '', 0, 'location'),
(82, 'Tree Ceremony', '2024-12-10', '21:30', '22:00', 'Come light a Christmas Tree downtown!', 2, 'no', '', 0, ''),
(83, 'Step VA Presentation', '2024-12-11', '09:00', '13:00', 'TADA!!!', 4, 'no', '', 0, 'Tada'),
(87, 'Christmas Tree Lighting', '2024-12-14', '07:00', '18:00', 'We&#039;re going to light the Christmas tree!', 99, 'no', '', 0, 'Stafford Square'),
(89, 'Tuesdays with the Troubadours: Christmas with the Troubadours', '2024-12-17', '09:00', '12:00', 'The Troubadours are live! Come celebrate Christmas!', 99, 'no', '', 0, 'Virtual Online'),
(92, 'CandyLand Game Night', '2024-12-12', '07:00', '12:00', 'Let&#039;s play CandyLand!', 15, 'no', '', 0, 'STEP VA Studio: 3328 Bourbon Street'),
(94, 'Gary_Young_Resume_Policy.pdf', '2024-12-26', '00:00', '00:01', 'ABC', 8, 'no', '', 0, ''),
(97, 'Test', '2024-12-12', '12:00', '13:00', 'Test', 1, 'no', '', 0, 'Test'),
(98, 'Rolex Paris Masters', '2024-12-11', '15:42', '18:00', 'Testing testing 123', 4, 'no', '', 0, 'Location'),
(99, 'Christmas Wrapping Event', '2025-02-05', '15:45', '18:00', 'hot', 3, 'no', '', 0, 'Location'),
(100, 'Finding Nemo', '2025-02-15', '17:30', '20:00', 'approved volunteers', 15, 'no', '', 1, ''),
(101, 'Finding Nemo Rehearsal', '2025-01-23', '17:30', '20:00', 'rehearsal', 20, 'no', '', 1, 'Riverside First Church of God 3461 Fall Hill Ave. Fredericksburg 22401'),
(103, 'Finding Nemo Rehearsal', '2025-01-30', '17:30', '20:00', 'rehearsal', 20, 'no', '', 1, 'Riverside First Church of God 3461 Fall Hill Ave. Fredericksburg 22401'),
(104, 'Finding Nemo Rehearsal', '2025-02-06', '17:30', '20:00', 'rehearsal', 20, 'no', '', 1, 'Riverside First Church of God 3461 Fall Hill Ave. Fredericksburg 22401'),
(105, 'Finding Nemo Rehearsal', '2025-03-27', '17:30', '20:00', 'rehearsal', 20, 'no', '', 1, 'Riverside First Church of God 3461 Fall Hill Ave. Fredericksburg 22401'),
(106, 'Finding Nemo Rehearsal', '2025-03-20', '17:30', '20:00', 'rehearsal', 20, 'no', '', 1, 'Riverside First Church of God 3461 Fall Hill Ave. Fredericksburg 22401'),
(107, 'visa', '2025-02-02', '12:00', '13:00', 'dqdwec', 60, 'no', '', 1, 'vwvw'),
(108, 'jninjn', '2025-02-13', '12:00', '13:00', 'ijnoi', 1, 'no', '', 1, 'noin'),
(109, 'Test', '2025-02-13', '13:00', '14:30', 'This is a test event', 99, 'no', '', 0, 'Fredericksburg, VA');

-- --------------------------------------------------------

--
-- Table structure for table `dbformmanagement`
--

CREATE TABLE `dbformmanagement` (
  `formid` int(11) NOT NULL,
  `application` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `isOpen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dbmessages`
--

CREATE TABLE `dbmessages` (
  `id` int(11) NOT NULL,
  `senderID` varchar(256) NOT NULL,
  `recipientID` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `body` text NOT NULL,
  `time` varchar(16) NOT NULL,
  `wasRead` tinyint(1) NOT NULL DEFAULT 0,
  `prioritylevel` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dbmessages`
--

INSERT INTO `dbmessages` (`id`, `senderID`, `recipientID`, `title`, `body`, `time`, `wasRead`, `prioritylevel`) VALUES
(0, 'vmsroot', 'username', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-02-10:19', 0, 0),
(0, 'vmsroot', 'vmsroot', 'username requested to sign up for a restricted event', 'username requested to sign up for restricted event notification test. Please review.', '2024-12-02-10:19', 1, 0),
(0, 'vmsroot', 'username', 'Your sign-up has been approved.', 'Thank you for signing up for notification testing (unrestricted)!', '2024-12-02-10:19', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-02-11:15', 0, 0),
(0, 'vmsroot', 'vmsroot', 'fredastaire requested to sign up for a restricted event', 'fredastaire requested to sign up for restricted event notification test. Please review.', '2024-12-02-11:15', 1, 0),
(0, 'vmsroot', 'someInfo2', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-02-16:06', 0, 0),
(0, 'vmsroot', 'vmsroot', 'someInfo2 requested to sign up for a restricted event', 'someInfo2 requested to sign up for notification testing (restricted). Please review.', '2024-12-02-16:06', 1, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for DO NOT DELETE will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-02-19:22', 0, 0),
(0, 'vmsroot', 'vmsroot', 'fredastaire requested to sign up for a restricted event', 'fredastaire requested to sign up for DO NOT DELETE. Please review.', '2024-12-02-19:22', 1, 0),
(0, 'vmsroot', 'morgan', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Rolex Paris Masters will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-02-20:31', 0, 0),
(0, 'vmsroot', 'vmsroot', 'morgan requested to sign up for a restricted event', 'morgan requested to sign up for Rolex Paris Masters. Please review.', '2024-12-02-20:31', 1, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-02-21:01', 0, 0),
(0, 'vmsroot', 'vmsroot', 'fredastaire requested to sign up for a restricted event', 'fredastaire requested to sign up for restricted event notification test. Please review.', '2024-12-02-21:01', 1, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-02-21:05', 0, 0),
(0, 'vmsroot', 'vmsroot', 'fredastaire requested to sign up for a restricted event', 'fredastaire requested to sign up for Christmas Party. Please review.', '2024-12-02-21:05', 1, 0),
(0, 'vmsroot', 'morgan', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Cookie Party!', '2024-12-02-21:09', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Cookie Party!', '2024-12-02-21:11', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-02:08', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-02:08', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-02:13', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-02:13', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-02:18', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-02:18', 1, 0),
(0, 'vmsroot', 'test', 'Your sign-up has been approved.', 'Thank you for signing up for notification testing (restricted)!', '2024-12-04-02:40', 0, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-02:42', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-02:42', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-02:44', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-02:44', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-02:46', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-02:46', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-02:54', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-02:54', 1, 0),
(0, 'vmsroot', 'username', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-03:04', 0, 0),
(0, 'vmsroot', 'vmsroot', 'username requested to sign up for a restricted event', 'username requested to sign up for restricted event notification test. Please review.', '2024-12-04-03:04', 1, 0),
(0, 'vmsroot', 'username', 'Your sign-up has been approved.', 'Thank you for signing up for Test!', '2024-12-04-03:05', 0, 0),
(0, 'vmsroot', 'username', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-03:05', 0, 0),
(0, 'vmsroot', 'vmsroot', 'username requested to sign up for a restricted event', 'username requested to sign up for Christmas Party. Please review.', '2024-12-04-03:05', 1, 0),
(0, 'vmsroot', 'test', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Party!', '2024-12-04-03:08', 0, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-03:09', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for restricted event notification test. Please review.', '2024-12-04-03:09', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for DO NOT DELETE will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-03:09', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for DO NOT DELETE. Please review.', '2024-12-04-03:09', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-03:15', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-03:15', 1, 0),
(0, 'vmsroot', 'test', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-04-03:20', 0, 0),
(0, 'vmsroot', 'test', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-04-03:23', 0, 0),
(0, 'vmsroot', 'test', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-04-03:41', 0, 0),
(0, 'vmsroot', 'someInfo2', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-04-05:16', 0, 0),
(0, 'vmsroot', 'someInfo2', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-04-05:17', 0, 0),
(0, 'vmsroot', 'someInfo2', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-04-05:17', 0, 0),
(0, 'vmsroot', 'someInfo2', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for AHHHH will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-09:16', 0, 0),
(0, 'vmsroot', 'vmsroot', 'someInfo2 requested to sign up for a restricted event', 'someInfo2 requested to sign up for AHHHH. Please review.', '2024-12-04-09:16', 1, 0),
(0, 'vmsroot', 'someInfo2', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-04-09:22', 0, 0),
(0, 'vmsroot', 'lucy', 'Your sign-up has been approved.', 'Thank you for signing up for restricted event notification test!', '2024-12-04-11:26', 0, 0),
(0, 'vmsroot', 'vmsroot', 'username cancelled their sign up for Christmas Party', 'username cancelled their sign up for Christmas Party', '2024-12-04-13:38', 1, 0),
(0, 'vmsroot', 'vmsroot', 'username cancelled their sign up for restricted event notification test', 'username cancelled their sign up for restricted event notification test', '2024-12-04-13:38', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Awesome Event 2024!', '2024-12-05-14:12', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Cookie Party!', '2024-12-05-18:26', 1, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-05-18:27', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-05-18:30', 0, 0),
(0, 'vmsroot', 'lucy', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-05-18:57', 0, 0),
(0, 'vmsroot', 'username', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for cool event will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-07-12:31', 0, 0),
(0, 'vmsroot', 'lucy', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for The Spotsylvanians will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-13:28', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-16:57', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-16:59', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for AHHHH will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-17:22', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for cool event will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-17:37', 1, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-18:56', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for DO NOT DELETE will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-18:58', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Cookie Party!', '2024-12-09-18:59', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-09-19:01', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for restricted event notification test!', '2024-12-09-19:12', 1, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-19:13', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your sign-up has been approved.', 'Thank you for signing up for restricted event notification test!', '2024-12-09-19:18', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-19:19', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-19:37', 0, 0),
(0, 'vmsroot', 'test', 'Your sign-up has been approved.', 'Thank you for signing up for notification testing (unrestricted)!', '2024-12-09-19:39', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your sign-up has been approved.', 'Thank you for signing up for notification testing (restricted)!', '2024-12-09-19:42', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-19:42', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for restricted event notification test!', '2024-12-09-19:46', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for AHHHH!', '2024-12-09-19:47', 1, 0),
(0, 'vmsroot', 'fredastaire', 'Your sign-up has been approved.', 'Thank you for signing up for Test!', '2024-12-09-19:47', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Finding Nemo Jr. will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-19:48', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Finding Nemo Jr.!', '2024-12-09-19:49', 1, 0),
(0, 'vmsroot', 'someInfo2', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for AHHHH will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-20:30', 0, 0),
(0, 'vmsroot', 'morgan', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for New Years Day Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-20:31', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event signup has been approved', 'You are now signed up for Array. Congratulations!', '2024-12-09-20:41', 1, 0),
(0, 'vmsroot', 'testuser', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for New Years Day Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-20:42', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for New Years Day Party!', '2024-12-09-20:42', 1, 0),
(0, 'vmsroot', 'testuser', 'Your restricted event signup has been approved', 'You are now signed up for Array. Congratulations!', '2024-12-09-20:43', 0, 0),
(0, 'vmsroot', 'lucy', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for New Years Day Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-20:43', 0, 0),
(0, 'vmsroot', 'vmsroot', 'morgan cancelled their sign up for New Years Day Party', 'morgan cancelled their sign up for New Years Day Party', '2024-12-09-20:44', 1, 0),
(0, 'vmsroot', 'testuser', 'Your sign-up has been approved.', 'Thank you for signing up for New Years Day Party!', '2024-12-09-20:45', 0, 0),
(0, 'vmsroot', 'vmsroot', 'testuser cancelled their sign up for New Years Day Party', 'testuser cancelled their sign up for New Years Day Party', '2024-12-09-20:46', 1, 0),
(0, 'vmsroot', 'testuser', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Party!', '2024-12-09-20:46', 0, 0),
(0, 'vmsroot', 'vmsroot', 'testuser cancelled their sign up for Christmas Party', 'testuser cancelled their sign up for Christmas Party', '2024-12-09-20:46', 1, 0),
(0, 'vmsroot', 'vmsroot', 'testuser cancelled their sign up for Monday Morning', 'testuser cancelled their sign up for Monday Morning', '2024-12-09-20:46', 1, 0),
(0, 'vmsroot', 'testuser', 'Your sign-up has been approved.', 'Thank you for signing up for New Years Day Party!', '2024-12-09-20:47', 0, 0),
(0, 'vmsroot', 'morgan', 'Your sign-up has been approved.', 'Thank you for signing up for Daytime Yoga!', '2024-12-09-20:47', 0, 0),
(0, 'vmsroot', 'vmsroot', 'morgan cancelled their sign up for Christmas Cookie Party', 'morgan cancelled their sign up for Christmas Cookie Party', '2024-12-09-20:47', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Party!', '2024-12-09-20:49', 1, 0),
(0, 'vmsroot', 'lucy', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Rolex Paris Masters will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-20:51', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Rolex Paris Masters!', '2024-12-09-21:03', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Rolex Paris Masters will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-21:05', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Rolex Paris Masters!', '2024-12-09-21:05', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Rolex Paris Masters!', '2024-12-09-21:06', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Rolex Paris Masters will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-21:10', 1, 0),
(0, 'vmsroot', 'charles', 'Your sign-up has been approved.', 'Thank you for signing up for Daytime Yoga!', '2024-12-10-13:35', 1, 0),
(0, 'vmsroot', 'charles', 'Your sign-up has been approved.', 'Thank you for signing up for Finding Nemo Jr Audition Track!', '2024-12-10-13:36', 1, 0),
(0, 'vmsroot', 'charles', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Cookie Party!', '2024-12-10-13:36', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Rolex Paris Masters!', '2024-12-10-17:11', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Rolex Paris Masters will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-10-17:40', 1, 0),
(0, 'vmsroot', 'charles', 'Your sign-up has been approved.', 'Thank you for signing up for Arts and Crafts!', '2024-12-10-18:45', 1, 0),
(0, 'vmsroot', 'charles', 'You are now signed up for Singing lessons!', 'Thank you for signing up for Singing lessons!', '2024-12-10-18:52', 1, 0),
(0, 'vmsroot', 'charles', 'Your request to sign up for Costume making has been sent to an admin.', 'Your request to sign up for Costume making will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-10-19:16', 1, 0),
(0, 'vmsroot', 'vmsroot', 'charles cancelled their sign up for Finding Nemo Jr Audition Track', 'charles cancelled their sign up for Finding Nemo Jr Audition Track', '2024-12-10-19:33', 1, 0),
(0, 'vmsroot', 'charles', 'Your request to sign up for The Spotsylvanians has been sent to an admin.', 'Your request to sign up for The Spotsylvanians will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-10-19:57', 1, 0),
(0, 'vmsroot', 'charles', 'You are now signed up for Dancing lessons!', 'Thank you for signing up for Dancing lessons!', '2024-12-10-20:03', 1, 0),
(0, 'vmsroot', 'vmsroot', 'charles cancelled their sign up for Dancing lessons', 'charles cancelled their sign up for Dancing lessons', '2024-12-10-20:04', 1, 0),
(0, 'vmsroot', 'charles', 'Your request to sign up for Finding Nemo Jr: Tech Classes has been sent to an admin.', 'Your request to sign up for Finding Nemo Jr: Tech Classes will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-10-20:06', 1, 0),
(0, 'vmsroot', 'charles', 'Your request to sign up for Rolex Paris Masters has been sent to an admin.', 'Your request to sign up for Rolex Paris Masters will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-10-20:15', 1, 0),
(0, 'vmsroot', 'vmsroot', 'charles cancelled their sign up for Arts and Crafts', 'charles cancelled their sign up for Arts and Crafts', '2024-12-10-20:20', 1, 0),
(0, 'vmsroot', 'charles', 'Your sign up for Arts and Crafts has been cancelled.', 'charles cancelled their sign up for Arts and Crafts', '2024-12-10-20:20', 1, 0),
(0, 'vmsroot', 'testuser', 'You are now signed up for Christmas Party!', 'Thank you for signing up for Christmas Party!', '2024-12-10-20:58', 0, 0),
(0, 'vmsroot', 'testuser', 'Your request to sign up for Christmas Party has been sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-10-21:07', 0, 0),
(0, 'vmsroot', 'vmsroot', 'testuser cancelled their sign up for New Years Day Party', 'testuser cancelled their sign up for New Years Day Party', '2024-12-10-21:08', 1, 0),
(0, 'vmsroot', 'testuser', 'Your sign up for New Years Day Party has been cancelled.', 'testuser cancelled their sign up for New Years Day Party', '2024-12-10-21:08', 0, 0),
(0, 'vmsroot', 'testuser', 'You are now signed up for Singing lessons!', 'Thank you for signing up for Singing lessons!', '2024-12-10-21:08', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your request to sign up for New Years Day Party has been sent to an admin.', 'Your request to sign up for New Years Day Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-10-21:10', 1, 0),
(0, 'vmsroot', 'testuser', 'You are now signed up for Tree Ceremony!', 'Thank you for signing up for Tree Ceremony!', '2024-12-10-21:29', 0, 0),
(0, 'vmsroot', 'testuser', 'You are now signed up for Step VA Presentation!', 'Thank you for signing up for Step VA Presentation!', '2024-12-11-03:22', 0, 0),
(0, 'vmsroot', 'testuser', 'Your request to sign up for Christmas Party has been sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-11-03:36', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your request to sign up for Christmas Party has been sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-11-03:41', 1, 0),
(0, 'vmsroot', 'testuser', 'Your restricted event signup has been approved', 'You are now signed up for Christmas Party. Congratulations!', '2024-12-11-03:41', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your request to sign up for Christmas Party has been sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-11-03:41', 1, 0),
(0, 'vmsroot', 'testuser', 'Your sign-up for Christmas Party has been denied.', 'Your sign up for Christmas Party has been denied.', '2024-12-11-03:43', 0, 0),
(0, 'vmsroot', 'testuser', 'Your request to sign up for Christmas Party has been sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-11-03:43', 0, 0),
(0, 'vmsroot', 'morgan', 'You are now signed up for Test!', 'Thank you for signing up for Test!', '2024-12-11-15:41', 0, 0),
(0, 'vmsroot', 'charles', 'You are now signed up for Dancing lessons!', 'Thank you for signing up for Dancing lessons!', '2024-12-11-16:26', 1, 0),
(0, 'vmsroot', 'charles', 'Your request to sign up for Christmas Party has been sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-11-16:26', 1, 0),
(0, 'vmsroot', 'polack@umw.edu', 'You are now signed up for Gary_Young_Resume_NSWCDD.pdf!', 'Thank you for signing up for Gary_Young_Resume_NSWCDD.pdf!', '2025-01-14-13:34', 1, 0),
(0, 'vmsroot', 'stepvainc@gmail.com', 'Your request to sign up for Finding Nemo Rehearsal has been sent to an admin.', 'Your request to sign up for Finding Nemo Rehearsal will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2025-01-20-16:17', 1, 0),
(0, 'vmsroot', 'stepvainc@gmail.com', 'Your restricted event signup has been approved', 'You are now signed up for Finding Nemo Rehearsal. Congratulations!', '2025-01-20-16:21', 0, 0),
(0, 'vmsroot', 'SaraDowd', 'Your request to sign up for Finding Nemo Rehearsal has been sent to an admin.', 'Your request to sign up for Finding Nemo Rehearsal will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2025-01-20-18:58', 1, 0),
(0, 'vmsroot', 'StrawberryJade', 'Your request to sign up for Finding Nemo Rehearsal has been sent to an admin.', 'Your request to sign up for Finding Nemo Rehearsal will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2025-01-21-12:11', 1, 0),
(0, 'vmsroot', 'ebrenna2', 'Your request to sign up for Finding Nemo Rehearsal has been sent to an admin.', 'Your request to sign up for Finding Nemo Rehearsal will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2025-02-03-12:19', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your request to sign up for Finding Nemo has been sent to an admin.', 'Your request to sign up for Finding Nemo will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2025-02-07-15:39', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your request to sign up for jninjn has been sent to an admin.', 'Your request to sign up for jninjn will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2025-02-07-16:05', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your request to sign up for Finding Nemo Rehearsal has been sent to an admin.', 'Your request to sign up for Finding Nemo Rehearsal will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2025-02-07-16:06', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dbpendingsignups`
--

CREATE TABLE `dbpendingsignups` (
  `username` varchar(25) NOT NULL,
  `eventname` varchar(100) NOT NULL,
  `role` varchar(5) NOT NULL,
  `notes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dbpendingsignups`
--

INSERT INTO `dbpendingsignups` (`username`, `eventname`, `role`, `notes`) VALUES
('vmsroot', '108', 'v', 'Skills: non | Dietary restrictions: ojnjo | Disabilities: jonoj | Materials: knock'),
('vmsroot', '101', 'v', 'Skills: rvwav | Dietary restrictions: varv | Disabilities: var | Materials: arv');

-- --------------------------------------------------------

--
-- Table structure for table `dbpersonhours`
--

CREATE TABLE `dbpersonhours` (
  `personID` varchar(256) NOT NULL,
  `eventID` int(11) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dbpersonhours`
--

INSERT INTO `dbpersonhours` (`personID`, `eventID`, `start_time`, `end_time`) VALUES
('test', 31, '2024-11-23 22:00:00', '2024-11-23 23:00:00'),
('test', 30, '2024-11-23 23:00:00', '2024-11-24 00:30:00'),
('test', 30, '2024-11-23 20:05:00', '2024-11-23 20:10:00'),
('test', 72, '2024-12-05 19:20:00', '2024-12-05 20:40:00'),
('test', 72, '2024-12-05 20:21:07', '2024-12-05 20:56:24'),
('test', 72, '2024-12-05 21:00:00', '2024-12-05 22:30:00'),
('test', 31, '2024-11-23 23:30:00', '2024-11-24 01:00:00'),
('testuser', 82, '2024-12-11 03:29:00', '2024-12-11 04:00:00'),
('testuser', 83, '2024-12-11 15:30:00', '2024-12-11 16:00:00'),
('testuser', 83, '2024-12-11 22:05:43', '2024-12-11 22:05:46'),
('testuser', 83, '2024-12-11 22:16:44', '2024-12-11 22:16:49'),
('testuser', 83, '2024-12-11 22:48:00', '2024-12-11 23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `dbpersons`
--

CREATE TABLE `dbpersons` (
  `id` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `venue` text DEFAULT NULL,
  `first_name` text NOT NULL,
  `last_name` text DEFAULT NULL,
  `street_address` text DEFAULT NULL,
  `city` text DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zip_code` text DEFAULT NULL,
  `phone1` varchar(12) NOT NULL,
  `phone1type` text DEFAULT NULL,
  `emergency_contact_phone` varchar(12) DEFAULT NULL,
  `emergency_contact_phone_type` text DEFAULT NULL,
  `birthday` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `emergency_contact_first_name` text DEFAULT NULL,
  `contact_num` varchar(12) DEFAULT NULL,
  `emergency_contact_relation` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `profile_pic` text DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `tshirt_size` text DEFAULT NULL,
  `how_you_heard_of_stepva` text DEFAULT NULL,
  `sensory_sensitivities` text DEFAULT NULL,
  `disability_accomodation_needs` text DEFAULT NULL,
  `school_affiliation` text DEFAULT NULL,
  `race` text DEFAULT NULL,
  `preferred_feedback_method` text DEFAULT NULL,
  `hobbies` text DEFAULT NULL,
  `professional_experience` text DEFAULT NULL,
  `archived` tinyint(1) NOT NULL,
  `emergency_contact_last_name` text DEFAULT NULL,
  `photo_release` text DEFAULT NULL,
  `photo_release_notes` text DEFAULT NULL,
  `training_complete` int(11) NOT NULL DEFAULT 0,
  `training_date` text DEFAULT NULL,
  `orientation_complete` int(11) NOT NULL DEFAULT 0,
  `orientation_date` text DEFAULT NULL,
  `background_complete` int(11) NOT NULL DEFAULT 0,
  `background_date` text DEFAULT NULL,
  `choiceNamiAffiliate` text DEFAULT NULL,
  `comfortableReadingAloud` tinyint(1) DEFAULT NULL,
  `willingToCompleteTraining` tinyint(1) DEFAULT NULL,
  `staminaToCompleteCourse` tinyint(1) DEFAULT NULL,
  `supportSystemToHelp` tinyint(1) DEFAULT NULL,
  `computerAccess` tinyint(1) DEFAULT NULL,
  `acknowledge_commitment` tinyint(1) DEFAULT NULL,
  `pathOfRecovery` tinyint(1) DEFAULT NULL,
  `involvementInNami` text NOT NULL,
  `anyAccessibilityNeeds` text DEFAULT NULL,
  `mayText` text DEFAULT NULL,
  `strengths` text DEFAULT NULL,
  `primaryRole` text DEFAULT NULL,
  `workBest` text DEFAULT NULL,
  `learningMethod` text DEFAULT NULL,
  `introOrExtro` text DEFAULT NULL,
  `interest` text DEFAULT NULL,
  `activePayingNamiAffiliate` text DEFAULT NULL,
  `ifNotAreWilling` text DEFAULT NULL,
  `familyWithMentalIllness` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dbpersons`
--

INSERT INTO `dbpersons` (`id`, `start_date`, `venue`, `first_name`, `last_name`, `street_address`, `city`, `state`, `zip_code`, `phone1`, `phone1type`, `emergency_contact_phone`, `emergency_contact_phone_type`, `birthday`, `email`, `emergency_contact_first_name`, `contact_num`, `emergency_contact_relation`, `type`, `status`, `notes`, `password`, `profile_pic`, `gender`, `tshirt_size`, `how_you_heard_of_stepva`, `sensory_sensitivities`, `disability_accomodation_needs`, `school_affiliation`, `race`, `preferred_feedback_method`, `hobbies`, `professional_experience`, `archived`, `emergency_contact_last_name`, `photo_release`, `photo_release_notes`, `training_complete`, `training_date`, `orientation_complete`, `orientation_date`, `background_complete`, `background_date`, `choiceNamiAffiliate`, `comfortableReadingAloud`, `willingToCompleteTraining`, `staminaToCompleteCourse`, `supportSystemToHelp`, `computerAccess`, `acknowledge_commitment`, `pathOfRecovery`, `involvementInNami`, `anyAccessibilityNeeds`, `mayText`, `strengths`, `primaryRole`, `workBest`, `learningMethod`, `introOrExtro`, `interest`, `activePayingNamiAffiliate`, `ifNotAreWilling`, `familyWithMentalIllness`) VALUES
('aaa', '2024-12-09', 'n/a', 'aaa', 'aaa', 'a', 'a', 'VA', '33333', '1231231233', 'cellphone', '2342342344', 'cellphone', '2001-07-07', 'a@a.a', 'a', 'n/a', 'a', 'volunteer', 'Active', 'n/a', '$2y$10$5s8HaYX98.3Wlsr7hpiVH.UGtxt0YqSGCrcWFsV5McmiN9wjUZNBu', 'n/a', 'gender', 'xs', '', 'sensory_sensitivities', '', 'a', 'race', 'No preference', '', '', 0, 'a', 'Restricted', 'a', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Abby Floyd', '2025-01-09', 'n/a', 'Abigail', 'Floyd', '5425 Rainwood Dr', 'Fredericksburg', 'VA', '22407', '5403226396', 'cellphone', '5404290350', 'cellphone', '2008-03-08', 'amfloyd14@icloud.com', 'Melissa', 'n/a', 'Mother', 'v', 'Active', 'n/a', '$2y$10$OreonRBUiYTXffapXDSzN.lt04IVsOrOiQ27UsT1XBZj5IctrXetG', 'n/a', 'gender', 'xl', '', 'sensory_sensitivities', '', 'Courtland Highschool', 'race', 'no-preference', '', '', 0, 'Floyd', 'Not Restricted', 'N/A', 1, '2022-06-11', 1, '2022-06-11', 1, '2022-06-11', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('AbbyGriff', '2025-01-09', 'n/a', 'Abby', 'Griffin', '5417, Holley Oak Lane', 'Fredericksburg', 'VA', '22407', '5406612606', 'cellphone', '5408348825', 'cellphone', '2010-09-01', 'abigailfgriff@gmail.com', 'Pam', 'n/a', 'Mother', 'volunteer', 'Active', 'n/a', '$2y$10$c901gH6WuN9DgxmwodzOKeOgpdu87OlTTXEvj2/Ejt/SIIZpSc9si', 'n/a', 'gender', 's', 'My sister (Sarah Garner)', 'sensory_sensitivities', 'None', 'Homeschooled', 'race', 'text', 'I know how to run a mic table and can assist with a sound board, I have been in 15 musicals, I am a babysitter, and I know how to spike a stage', 'Yes; I volunteer as a Sunday school assistant.', 0, 'Griffin', 'Not Restricted', 'None', 1, '', 1, '', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('addison_fiore', '2025-01-09', 'n/a', 'Addison', 'Fiore', '10804 Cinnamon Teal Drive', 'Spotsylvania', 'VA', '22553', '5403720591', 'cellphone', '5409031781', 'cellphone', '2007-11-06', 'addisonfiore8@gmail.com', 'Jennifer', 'n/a', 'Mother', 'volunteer', 'Active', 'n/a', '$2y$10$0QK4ippSoaT/e2VZ3NaG7OcqFJDps2uFz22.1NjJ.iuD7sbuyLUYW', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'Riverbend Highschool', 'race', 'text', '', '', 0, 'Fiore', 'Restricted', 'N/A', 1, '2023-07-11', 1, '2023-07-17', 1, '2023-06-07', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Amwages13', '2025-01-13', 'n/a', 'Lexi', 'Wages', '3 Rodeo Ct', 'Fredericksburg', 'VA', '22407', '5403599086', 'cellphone', '5402875446', 'cellphone', '2011-11-18', 'leximariewages@gmail.com', 'Laurie', 'n/a', 'Mother', 'volunteer', 'Active', 'n/a', '$2y$10$PD0TAmsArH3AF79GeiPKuu/t3b2KwoKnixcU2OvDqA/6IjMxEsra.', 'n/a', 'gender', 's', 'Sister', 'sensory_sensitivities', 'No', 'Battlefield Middle', 'race', 'text', 'Crotchet', '', 0, 'Wages', 'Not Restricted', 'N/a', 1, '2024-12-27', 1, '2024-12-27', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('ascrivani3', '2025-01-09', 'n/a', 'Amelia', 'Scrivani', '12565 Spotswood Furnace Rd', 'Fredericksburg', 'VA', '22407', '7185141845', 'cellphone', '7183546470', 'cellphone', '2004-08-09', 'ascrivani3@gmail.com', 'Michele', 'n/a', 'Mother', 'volunteer', 'Active', 'n/a', '$2y$10$RfIm4IswPvtW656I6h2cR.czd4uCKldaSsKB5zCiw8642lfimAFj.', 'n/a', 'gender', 'm', 'My brother participates in various Step VA activities', 'sensory_sensitivities', '', 'N/A', 'race', 'text', '', 'I have spent many years volunteering with my old elementary school’s annual chorus performance, every year they put on a musical.', 0, 'Scrivani', 'Not Restricted', 'N/A', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('brianna@gmail.com', '2024-01-22', 'portland', 'Brianna', 'Wahl', '212 Latham Road', 'Mineola', 'VA', '11501', '1234567890', 'cellphone', '', '', '2004-04-04', 'brianna@gmail.com', 'Mom', '1234567890', 'Mother', 'admin', 'Active', '', '$2y$10$jNbMmZwq.1r/5/oy61IRkOSX4PY6sxpYEdWfu9tLRZA6m1NgsxD6m', '', 'Female', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('bum@gmail.com', '2024-01-24', 'portland', 'bum', 'bum', '1345 Strattford St.', 'Mineola', 'VA', '22401', '1234567890', 'home', '', '', '1111-11-11', 'bum@gmail.com', 'Mom', '1234567890', 'Mom', 'admin', 'Active', '', '$2y$10$Ps8FnZXT7d4uiU/R5YFnRecIRbRakyVtbXP9TVqp7vVpuB3yTXFIO', '', 'Male', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('charles', '2024-12-10', 'n/a', 'Charles', 'Wilt', 'Street Address', 'Fredericksburg', 'VA', '22405', '1231231234', 'cellphone', '1231231234', 'cellphone', '2004-06-15', 'charles@gmail.com', 'Michael', 'n/a', 'Father', 'volunteer', 'Active', 'n/a', '$2y$10$BhurBvyEs9hTa7sIeZEqHeuE0aAXSGX/CcwMw7y/4dHt0ztL1MjMO', 'n/a', 'gender', 's', '', 'sensory_sensitivities', '', 'N/A', 'race', 'No preference', '', '', 0, 'Wilt', 'Not Restricted', 'N/A', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('christitowle', '2025-01-09', 'n/a', 'Christi', 'Towle', '201 New Hope Church Road', 'Fredericksburg', 'VA', '22405', '8044415060', 'cellphone', '8044415060', 'cellphone', '1972-12-11', 'towlefamily@yahoo.com', 'Jason', 'n/a', 'Spouse', 'volunteer', 'Active', 'n/a', '$2y$10$QKAHn4eKKL8qgF2gDGjNiektJolio9YlhMByUyLXE.GfJVSygOAli', 'n/a', 'gender', 'm', 'A friend', 'sensory_sensitivities', 'No', 'N/A', 'race', 'No preference', 'gardening, crafts', 'Yes', 0, 'Towle', 'Not Restricted', 'N/A', 0, '', 1, '', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('derp', '2024-12-09', 'n/a', 'a', 'a', 'a', 'a', 'VA', '12323', '1231231234', 'home', '1231231234', 'home', '2024-12-04', 'awe@gmail.com', 'a', 'n/a', 'a', 'volunteer', 'Active', 'n/a', '$2y$10$gYsD0Y1dwlDK4SZH59VGuOlqu78JwLrSXViebTkX0KxMOQgWIR7c.', 'n/a', 'gender', 's', '', 'sensory_sensitivities', '', 'a', 'race', 'No preference', '', '', 0, 'a', 'Restricted', 'a', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('ebrenna2', '2025-02-03', 'n/a', 'Emma', 'Brennan', '212 Willis St', 'Fredericksburg', 'VA', '22401', '7035099647', 'cellphone', '7032965189', 'cellphone', '2002-09-23', 'em.brenn@yahoo.com', 'Laura', 'n/a', 'Mother', 'volunteer', 'Active', 'n/a', '$2y$10$3hIpyIl79iyRTb.edM.uEuV8aT9t5v4juO3vXmpcIYULPokjpftKK', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'UMW', 'race', 'No preference', '', '', 0, 'Brennan', 'Not Restricted', 'N/A', 1, '2025-02-03', 1, '2025-02-03', 1, '2025-02-03', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('fredastaire', '2024-11-18', 'n/a', 'Fred', 'Astaire', '11 Dance Avenue', 'Stafford', 'VA', '12345', '1234567890', 'cellphone', '2222222221', 'cellphone', '1899-05-10', 'fredastaire@myemail.com', 'Fred Jr.', 'n/a', 'Son', 'v', 'Active', 'n/a', '$2y$10$VUZObvA3Cy69ykkohegJYevjJU3DFlZbgmfTSPzee7TMPRSMMg9fG', 'n/a', 'gender', 'm', 'A little bird told me.', 'sensory_sensitivities', 'No', 'N/A', 'race', 'email', 'Dance!', 'Yes', 0, 'Astaire', 'Not Restricted', 'N/A', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('jake_demo', '2024-11-24', 'n/a', 'Jake', 'Furman', '1234 Street', 'Fredericksburg', 'VA', '10001', '5555555555', 'cellphone', '4444444444', 'cellphone', '2002-01-31', 'jake@gmail.com', 'Mom', 'n/a', 'Mom', 'volunteer', 'Active', 'n/a', '$2y$10$UNhNSABqTedXO.fWLy7eduhDVsdNp9GbkdnkR05oyjZnYPe9XjExu', 'n/a', 'gender', 'l', '', 'sensory_sensitivities', '', 'UMW', 'race', '', '', '', 0, 'Furman', 'Not Restricted', 'no', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('jd25', NULL, NULL, 'john', 'doe', '123 ln', 'fred', 'VA', '22401', '1231231234', NULL, NULL, NULL, NULL, 'hfdsjal@ghdjsl.com', NULL, NULL, NULL, 'participant', 'pending', NULL, '$2y$10$yuKk5vgVDgkdlJ9dIGAf5OikO2M7BvbZfcb6YD99DdKN1/x0QyG9.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'written', NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'i dont', NULL, 'yes_text', '3 s 3 w', 'marketing', 'self', 'kinesthetic', 'intro', 'no', 'no', 'no', 'no'),
('John_38_Doe', '3333-11-22', NULL, 'John', 'Doe', NULL, NULL, NULL, NULL, 'volunteer', NULL, NULL, NULL, NULL, 'volunteer@gmail.com', NULL, NULL, NULL, 'donor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('lucy', '2024-11-25', 'n/a', 'Lucy', 'Pevensie', '10 London Avenue', 'Stafford', 'VA', '12345', '1234567890', 'home', '0987654321', 'cellphone', '1901-01-01', 'lucy@narnia.com', 'Peter', 'n/a', 'Brother', 'volunteer', 'Active', 'n/a', '$2y$10$VQ5Za13gNAn/DoAJzwG.j.zMhL1YBjOpsJclMJqfSF1XKxMp2eS9S', 'n/a', 'gender', 's', 'Aslan', 'sensory_sensitivities', 'No', 'N/A', 'race', 'email', 'Arts and crafts', 'Yes', 0, 'Pevensie', 'Restricted', 'N/A', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('mom@gmail.com', '2024-01-22', 'portland', 'Lorraine', 'Egan', '212 Latham Road', 'Mineola', 'NY', '11501', '5167423832', 'home', '', '', '1910-10-10', 'mom@gmail.com', 'Mom', '5167423832', 'Dead', 'admin', 'Active', '', '$2y$10$of1CkoNXZwyhAMS5GQ.aYuAW1SHptF6z31ONahnF2qK4Y/W9Ty2h2', '', 'Male', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('morgan', '2024-12-02', 'n/a', 'Morgan', 'Harper', '123 Street', 'Fredericksburg', 'VA', '10001', '5555555555', 'cellphone', '5555555555', 'cellphone', '2003-11-24', 'morgan@gmail.com', 'Christine', 'n/a', 'Mom', 'v', 'Active', 'n/a', '$2y$10$klnM0EjO78i3ifPFMU3YQe6YXq14W3RpmSUsP1.IP0f6wVE6ExYoe', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'USC', 'race', 'email', '', 'Yessss', 0, 'Harper', 'Not Restricted', 'N/A', 1, '2024-12-04', 1, '2024-12-03', 1, '2024-12-02', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('oliver@gmail.com', '2024-01-22', 'portland', 'Oliver', 'Wahl', '1345 Strattford St.', 'Fredericksburg', 'VA', '22401', '1234567890', 'home', '', '', '2011-11-11', 'oliver@gmail.com', 'Mom', '1234567890', 'Mother', 'admin', 'Active', '', '$2y$10$tgIjMkXhPzdmgGhUgbfPRuXLJVZHLiC0pWQQwOYKx8p8H8XY3eHw6', '', 'Other', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('peter@gmail.com', '2024-01-22', 'portland', 'Peter', 'Polack', '1345 Strattford St.', 'Mineola', 'VA', '12345', '1234567890', 'cellphone', '', '', '1968-09-09', 'peter@gmail.com', 'Mom', '1234567890', 'Mom', 'admin', 'Active', '', '$2y$10$j5xJ6GWaBhnb45aktS.kruk05u./TsAhEoCI3VRlNs0SRGrIqz.B6', '', 'Male', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('polack@um.edu', '2024-01-22', 'portland', 'Jennifer', 'Polack', '15 Wallace Farms Lane', 'Fredericksburg', 'VA', '22406', '1234567890', 'cellphone', '', '', '1970-05-01', 'polack@um.edu', 'Mom', '1234567890', 'Mom', 'admin', 'Active', '', '$2y$10$mp18j4WqhlQo7MTeS/9kt.i08n7nbt0YMuRoAxtAy52BlinqPUE4C', '', 'Female', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('polack@umw.edu', '2025-01-09', 'n/a', 'Jennifer', 'ADMIN', '15 Wallace Farms Lane', 'Fredericksburg', 'VA', '22406', '5402959700', 'cellphone', '5402959700', 'cellphone', '1970-05-01', 'polack@umw.edu', 'Jennifer', 'n/a', 'Me', 'volunteer', 'Active', 'n/a', '$2y$10$CxMpQDWPyURnla9pb8FvveQSRrMBU7.zAB.ZbdHwK1P/suPuwcy0O', 'n/a', 'gender', 'l', '', 'sensory_sensitivities', '', 'UMW', 'race', 'No preference', '', '', 0, 'Polack', 'Restricted', 'NA', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('RileyErickson23', NULL, NULL, 'Riley', 'Erickson', '8481 den circle', 'King George', 'VA', '22485', '3606310776', NULL, NULL, NULL, NULL, 'mommaduck36@gmail.com', NULL, NULL, NULL, 'volunteer', 'Active', NULL, '$2y$10$mcvK0zUCjNrQs8P3BmO7tu/rmNy3VqcZEqWaUr3vkCr7Q2i2Kd1SG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'verbal', NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'a', NULL, 'no_text', 'a a a', 'group', 'self', 'visual', 'intro', 'no', 'no', 'no', 'yes'),
('RileyErickson23!@', NULL, NULL, 'Riley', 'Erickson', '8481 den circle', 'King George', 'VA', '22485', '3606310776', NULL, NULL, NULL, NULL, 'mommaduck36@gmail.com', NULL, NULL, NULL, 'volunteer', 'Active', NULL, '$2y$10$zRNBlPLxQhAa8FcD583SmOirqGU8xLjEJyH962DmUB9b.NMp4MZeS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'verbal', NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'asa', NULL, 'yes_text', 'a b c', 'group', 'self', 'audiotory', 'extro', 'no', 'no', 'no', 'no'),
('s', '2024-11-18', 'n/a', 'a', 'hj', 'f', 'f', 'VA', '12333', '1231231234', 'home', '1231231234', 'cellphone', '2000-12-20', 'jf@gmail.com', 'e', 'n/a', 'e', 'volunteer', 'Active', 'n/a', '$2y$10$7ml7KedmERvRYpflzuMAHOsXdssqzMo5FidkOtekjj9R6u1OdTXqy', 'n/a', 'gender', 's', '', 'sensory_sensitivities', '', 's', 'race', '', '', '', 0, 'e', 'Restricted', 's', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('SaraDowd', '2025-01-13', 'n/a', 'Sara', 'Dowd', '11 Barlow House Court', 'Stafford', 'VA', '22554', '8582549611', 'cellphone', '8582548568', 'cellphone', '1978-01-23', 'sarazonadowd@gmail.com', 'Daniel', 'n/a', 'Spouse', 'volunteer', 'Active', 'n/a', '$2y$10$BQ4n2HGpgxfaFnBf0HexveU8I0ppdINNXvhZdynQyOiaitOnP6dw6', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'n/a', 'race', 'email', '', '', 0, 'Dowd', 'Not Restricted', 'n/a', 1, '', 1, '', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('someInfo2', '2024-11-24', 'n/a', 'nah', 'whywouldi', '0', '0', 'VA', '00000', '0000000000', 'work', '0000000000', 'work', '0001-01-01', '0@0.o', 'nah', 'n/a', 'a', 'volunteer', 'Active', 'n/a', '$2y$10$umJj4HXb5tpj79rc4Vj8hu5wCK7BSjMEDdtX7sfdGjMqjt5.ap3bq', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'why would i be', 'race', '', '', '', 0, 'whywouldi', 'Not Restricted', 'a', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('stepvainc@gmail.com', '2024-12-17', 'n/a', 'Jan', 'Monroe', '12419 Toll House Rd.', 'SPOTSYLVANIA', 'VA', '22551', '7575351963', 'cellphone', '7575351967', 'cellphone', '2000-12-09', 'stepvainc@gmail.com', 'Mike', 'n/a', 'spouse', 'volunteer', 'Active', 'n/a', '$2y$10$mOC.B5elQp8HZhdkNhR/V.jjNBwcsTzQdjG14Aia1jP.8XkNSWj0u', 'n/a', 'gender', 's', '', 'sensory_sensitivities', 'no', 'N/a', 'race', 'text', 'yoga, music', 'yes', 0, 'Monroe', 'Not Restricted', 'n/a', 1, '2013-10-13', 1, '2013-10-13', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('StrawberryJade', '2025-01-09', 'n/a', 'Jade', 'Sergi', '2449 Harpoon Drive', 'Stafford', 'VA', '22554', '5406994590', 'cellphone', '3014120327', 'cellphone', '2005-04-21', 'jtsergi42@gmail.com', 'Carol', 'n/a', 'Mother', 'volunteer', 'Active', 'n/a', '$2y$10$Q3bVGR6B6E4Ibz7k9vryMO5mFJvtkLO418iADpEonhKdt7vzb5R22', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'N/A', 'race', 'text', '', '', 0, 'Yeh', 'Not Restricted', 'N/A', 1, '2024-11-20', 1, '2019-05-30', 1, '2023-05-29', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('test', '2024-11-20', 'n/a', 'Harry', 'Potter', '123 Apple St.', 'Fredericksburg', 'VA', '22003', '1231231234', 'cellphone', '4324324321', 'home', '2000-07-07', 'test@gmail.com', 'Ron', 'n/a', 'Friend', 'v', 'Active', 'n/a', '$2y$10$3qNoA1RwCbO9/1eHev.T0OCdhfBwaS9cmzGVFdCD4CFqmyEPjgkbm', 'n/a', 'gender', 'm', 'I didn&amp;#039;t', 'sensory_sensitivities', 'aoei', 'Hogwarts', 'race', 'text', 'aoei', 'aoei', 0, 'Weasley', 'Not Restricted', ':0', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('testuser', '2024-11-25', 'n/a', 'Jane', 'Doe', '123 Main Street', 'Fredericksburg', 'VA', '22401', '5555555555', 'cellphone', '6666666666', 'cellphone', '1999-01-01', 'test@mail.com', 'Ron', 'n/a', 'Friend', 'v', 'Active', 'n/a', '$2y$10$kfaLBXEYKBmdzaO6x7KtBuQeXu5o8Wof2MaR5vwJ44aoqPwMsgkIa', 'n/a', 'gender', 'l', 'A little birdie told me', 'sensory_sensitivities', 'Nah', 'N/A', 'race', 'text', 'Being Rad', 'Nah', 0, 'Swanson', 'Not Restricted', 'N/A', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('testuser2', '2024-12-11', 'n/a', 'Jane', 'Doe', '123 Main Street', 'Fredericksburg', 'VA', '22401', '5555555555', 'cellphone', '6666666666', 'cellphone', '2003-08-26', 'test2@mail.com', 'Ron', 'n/a', 'Father', 'volunteer', 'Active', 'n/a', '$2y$10$mqnpfidPOnnZB1TKDrUa2.cWEcfrOcfslsxdaDG2o6ouWnqTCnFzK', 'n/a', 'gender', 'l', 'Test', 'sensory_sensitivities', 'NO', 'No', 'race', 'No preference', 'No', 'No', 0, 'Swanson', 'Not Restricted', 'NO', 1, '2024-12-10', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Thall1', '2025-01-09', 'n/a', 'Teresa', 'Hall', '119 Garfield Avenue', 'Colonial Beach', 'VA', '22443', '5405977489', 'cellphone', '5407608128', 'cellphone', '1969-05-07', 'tlomeara3@gmail.com', 'Tim', 'n/a', 'Spouse', 'volunteer', 'Active', 'n/a', '$2y$10$.Er980h41trC1NRObt4U5.S8YKbORWhwC2.44tHoLLBnmSmMa8hKK', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'N/A', 'race', 'text', '', '', 0, 'Hall', 'Not Restricted', 'N/A', 1, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('tom@gmail.com', '2024-01-22', 'portland', 'tom', 'tom', '1345 Strattford St.', 'Mineola', 'NY', '12345', '1234567890', 'home', '', '', '1920-02-02', 'tom@gmail.com', 'Dad', '9876543210', 'Father', 'admin', 'Active', '', '$2y$10$1Zcj7n/prdkNxZjxTK1zUOF7391byZvsXkJcN8S8aZL57sz/OfxP.', '', 'Male', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'yes', 'a', 'a', 'a', 'a', 'a', NULL, NULL, NULL, NULL),
('username', '2024-11-18', 'n/a', 'cool', 'cool', 'weqwe', 'qewq', 'VA', '12312', '1231231234', 'home', '1231232134', 'cellphone', '2024-11-01', 'cool@gmail.com', 'cool', 'n/a', 'cool', 'v', 'Inactive', 'n/a', '$2y$10$yz35FMhhRl.hVIyjhvASJeQ.sp0lc7hzQQJJRBHH00spfTOlQJ4Cy', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'w', 'race', 'email', '', '', 0, 'cool', 'Not Restricted', 'super awesome', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('usernameusername', '2024-12-09', 'n/a', 'Noah', 'Stafford', 'My address', 'City', 'VA', '22405', '1231231234', 'cellphone', '1231231234', 'cellphone', '2024-12-01', 'email@gmail.com', 'Contact', 'n/a', 'Mom', 'volunteer', 'Active', 'n/a', '$2y$10$uGbO0uD4CFwN0ewoqGG8T.9PT.1F8pOBSJVOKXkvNSlRSjAANMhOK', 'n/a', 'gender', 'xs', '', 'sensory_sensitivities', '', 'N/A', 'race', 'No preference', '', '', 0, 'Lastname', 'Not Restricted', 'N/A', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('vmsroot', '0000-00-00', 'portland', 'vmsroot', 'a', 'a', 'a', 'VA', 'N/A', '', 'N/A', 'N/A', 'N/A', 'N/A', 'vmsroot', 'N/A', 'N/A', 'N/A', '', 'N/A', 'N/A', '$2y$10$.3p8xvmUqmxNztEzMJQRBesLDwdiRU3xnt/HOcJtsglwsbUk88VTO', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('work', '2024-12-10', 'n/a', 'a', 'a', 'a', 'a', 'VA', '11111', '1231231234', 'cellphone', '1231231234', 'cellphone', '2024-12-04', 'a@gmail.com', 'a', 'n/a', 'a', 'volunteer', 'Active', 'n/a', '$2y$10$ChUa935f6QE8RtHI4p2vX.WtCeoVPPYQhgVNFfgnvLPo0mVJGXbCi', 'n/a', 'gender', 's', '', 'sensory_sensitivities', '', 'a', 'race', 'No preference', '', '', 0, 'a', 'Restricted', 'a', 0, '', 0, '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `formmanager`
--

CREATE TABLE `formmanager` (
  `managerID` int(11) NOT NULL,
  `originalID` int(11) NOT NULL,
  `formname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `minutes_keywords`
--

CREATE TABLE `minutes_keywords` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `keyword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `minutes_keywords`
--

INSERT INTO `minutes_keywords` (`id`, `date`, `keyword`) VALUES
(1, '1111-11-11', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `minutes_link`
--

CREATE TABLE `minutes_link` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `minutes_link`
--

INSERT INTO `minutes_link` (`id`, `name`, `date`) VALUES
(1, 'https://jenniferp161.sg-host.com/addMinutes.php', '1111-11-11');

-- --------------------------------------------------------

--
-- Table structure for table `pendinghourlogs`
--

CREATE TABLE `pendinghourlogs` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `what` text NOT NULL,
  `hours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(6) NOT NULL,
  `confirmed` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verification`
--

INSERT INTO `verification` (`id`, `email`, `code`, `confirmed`, `created_at`) VALUES
(1, 'mommaduck36@gmail.com', '111111', 0, '2025-04-25 06:01:23'),
(2, 'override@nonexist.com', '111111', 0, '2025-04-25 06:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `volunteerhours`
--

CREATE TABLE `volunteerhours` (
  `id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `hours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `volunteerhours`
--

INSERT INTO `volunteerhours` (`id`, `f_name`, `l_name`, `date`, `hours`) VALUES
(1, 'Riley', 'Erickson', '3332-11-22', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blacklisted`
--
ALTER TABLE `blacklisted`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dbanimals`
--
ALTER TABLE `dbanimals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dbeventmedia`
--
ALTER TABLE `dbeventmedia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKeventID2` (`eventID`);

--
-- Indexes for table `dbeventpersons`
--
ALTER TABLE `dbeventpersons`
  ADD KEY `FKeventID` (`eventID`),
  ADD KEY `FKpersonID` (`userID`);

--
-- Indexes for table `dbevents`
--
ALTER TABLE `dbevents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dbformmanagement`
--
ALTER TABLE `dbformmanagement`
  ADD PRIMARY KEY (`formid`);

--
-- Indexes for table `dbpersonhours`
--
ALTER TABLE `dbpersonhours`
  ADD KEY `FkpersonID2` (`personID`),
  ADD KEY `FKeventID3` (`eventID`);

--
-- Indexes for table `dbpersons`
--
ALTER TABLE `dbpersons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formmanager`
--
ALTER TABLE `formmanager`
  ADD PRIMARY KEY (`managerID`);

--
-- Indexes for table `minutes_keywords`
--
ALTER TABLE `minutes_keywords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minutes_link`
--
ALTER TABLE `minutes_link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendinghourlogs`
--
ALTER TABLE `pendinghourlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volunteerhours`
--
ALTER TABLE `volunteerhours`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blacklisted`
--
ALTER TABLE `blacklisted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dbanimals`
--
ALTER TABLE `dbanimals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dbeventmedia`
--
ALTER TABLE `dbeventmedia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dbevents`
--
ALTER TABLE `dbevents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `dbformmanagement`
--
ALTER TABLE `dbformmanagement`
  MODIFY `formid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `minutes_keywords`
--
ALTER TABLE `minutes_keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `minutes_link`
--
ALTER TABLE `minutes_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pendinghourlogs`
--
ALTER TABLE `pendinghourlogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `verification`
--
ALTER TABLE `verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `volunteerhours`
--
ALTER TABLE `volunteerhours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dbeventmedia`
--
ALTER TABLE `dbeventmedia`
  ADD CONSTRAINT `FKeventID2` FOREIGN KEY (`eventID`) REFERENCES `dbevents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dbeventpersons`
--
ALTER TABLE `dbeventpersons`
  ADD CONSTRAINT `FKeventID` FOREIGN KEY (`eventID`) REFERENCES `dbevents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKpersonID` FOREIGN KEY (`userID`) REFERENCES `dbpersons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dbpersonhours`
--
ALTER TABLE `dbpersonhours`
  ADD CONSTRAINT `FKeventID3` FOREIGN KEY (`eventID`) REFERENCES `dbevents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FkpersonID2` FOREIGN KEY (`personID`) REFERENCES `dbpersons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Database: `nami`
--
CREATE DATABASE IF NOT EXISTS `nami` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `nami`;

-- --------------------------------------------------------

--
-- Table structure for table `dbanimals`
--

CREATE TABLE `dbanimals` (
  `id` int(11) NOT NULL,
  `odhs_id` varchar(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `breed` varchar(256) DEFAULT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `spay_neuter_done` varchar(3) NOT NULL,
  `spay_neuter_date` date DEFAULT NULL,
  `rabies_given_date` date NOT NULL,
  `rabies_due_date` date DEFAULT NULL,
  `heartworm_given_date` date NOT NULL,
  `heartworm_due_date` date DEFAULT NULL,
  `distemper1_given_date` date NOT NULL,
  `distemper1_due_date` date DEFAULT NULL,
  `distemper2_given_date` date NOT NULL,
  `distemper2_due_date` date DEFAULT NULL,
  `distemper3_given_date` date NOT NULL,
  `distemper3_due_date` date DEFAULT NULL,
  `microchip_done` varchar(3) NOT NULL,
  `archived` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dbanimals`
--

INSERT INTO `dbanimals` (`id`, `odhs_id`, `name`, `breed`, `age`, `gender`, `notes`, `spay_neuter_done`, `spay_neuter_date`, `rabies_given_date`, `rabies_due_date`, `heartworm_given_date`, `heartworm_due_date`, `distemper1_given_date`, `distemper1_due_date`, `distemper2_given_date`, `distemper2_due_date`, `distemper3_given_date`, `distemper3_due_date`, `microchip_done`, `archived`) VALUES
(1, '1234', 'Noodle', 'Schnoodle', 5, 'female', '', 'yes', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'no', 'no'),
(2, '43221', 'Cin', 'Poodle', 18, 'female', ' | Bordetella: 2024-01-24', 'yes', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2024-01-24', '2030-01-24', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'no', 'no'),
(3, '543534', 'Rosie', 'Cat', 9, 'male', '', 'yes', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'no', 'no'),
(4, '890890', 'George', 'Cat', 6, 'female', '', 'yes', '2024-01-05', '2024-01-26', '2026-01-02', '0000-00-00', '2024-01-22', '0000-00-00', '2024-01-29', '0000-00-00', '2024-01-24', '0000-00-00', '2024-01-25', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `dbeventmedia`
--

CREATE TABLE `dbeventmedia` (
  `id` int(11) NOT NULL,
  `eventID` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `type` text NOT NULL,
  `file_format` text NOT NULL,
  `description` text NOT NULL,
  `altername_name` text NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dbeventpersons`
--

CREATE TABLE `dbeventpersons` (
  `eventID` int(11) NOT NULL,
  `userID` varchar(256) NOT NULL,
  `position` text NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dbeventpersons`
--

INSERT INTO `dbeventpersons` (`eventID`, `userID`, `position`, `notes`) VALUES
(30, 'test', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(31, 'test', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(29, 'someInfo2', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(28, 'username', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(28, 'lucy', 'v', ''),
(29, 'fredastaire', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(64, 'test', 'v', 'Skills: no | Dietary restrictions: no | Disabilities: no | Materials: no'),
(36, 'username', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(71, 'test', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(72, 'test', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(64, 'fredastaire', 'v', 'Skills: Dance | Dietary restrictions:  | Disabilities:  | Materials: Cookies'),
(71, 'fredastaire', 'v', ''),
(71, 'lucy', 'v', ''),
(75, 'lucy', 'v', ''),
(64, 'vmsroot', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(36, 'fredastaire', 'v', 'Skills: Tap dancer (films include Top Hat and Shall We Dance) | Dietary restrictions:  | Disabilities:  | Materials: Tap shoes'),
(73, 'vmsroot', 'v', 'Skills: Baking | Dietary restrictions:  | Disabilities:  | Materials: Marmalade and toast'),
(36, 'morgan', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(36, 'charles', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(64, 'charles', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(79, 'charles', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(70, 'lucy', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: Marmalade and toast'),
(70, 'vmsroot', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials:'),
(78, 'charles', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials:'),
(79, 'testuser', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(82, 'testuser', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(83, 'testuser', 'v', 'Skills: No | Dietary restrictions: No | Disabilities: No | Materials: No'),
(97, 'morgan', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(81, 'charles', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(73, 'fredastaire', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: Cookies'),
(101, 'stepvainc@gmail.com', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials:'),
(101, 'StrawberryJade', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials:'),
(101, 'SaraDowd', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials:'),
(101, 'ebrenna2', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials:'),
(100, 'vmsroot', 'v', 'Skills: None | Dietary restrictions: None | Disabilities: None | Materials: None');

-- --------------------------------------------------------

--
-- Table structure for table `dbevents`
--

CREATE TABLE `dbevents` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `date` char(10) NOT NULL,
  `startTime` char(5) NOT NULL,
  `endTime` char(5) NOT NULL,
  `description` text NOT NULL,
  `capacity` int(11) NOT NULL,
  `completed` text NOT NULL,
  `event_type` text NOT NULL,
  `restricted_signup` tinyint(1) NOT NULL,
  `location` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dbevents`
--

INSERT INTO `dbevents` (`id`, `name`, `date`, `startTime`, `endTime`, `description`, `capacity`, `completed`, `event_type`, `restricted_signup`, `location`) VALUES
(28, 'Thanksgiving Feast', '2024-11-28', '', '23:59', 'There is so much to give thanks for!', 0, 'no', '', 1, NULL),
(29, 'Tuesdays with the Troubadours', '2024-11-26', '', '23:59', 'The Troubadours are live!', 0, 'no', '', 0, NULL),
(30, 'Hogwarts Festival', '2024-11-23', '', '23:59', 'Hello', 0, 'no', '', 0, 'Hogwarts'),
(31, 'Sing Together!', '2024-11-23', '', '23:59', 'aoeiaoei', 0, 'no', '', 0, NULL),
(36, 'Daytime Yoga', '2024-12-17', '11:00', '12:00', 'Weekly event', 25, 'no', '', 0, 'STEP VA Studio'),
(47, 'Finding Nemo Jr Audition Track', '2025-01-02', '18:00', '20:00', '(ages 10+)', 30, 'no', '', 0, 'Riverside First Church of God'),
(64, 'Christmas Cookie Party', '2024-12-14', '16:00', '18:00', 'Bring your favorite cookie recipe to share!', 0, 'yes', '', 0, NULL),
(69, 'Finding Nemo Jr: Tech Classes', '2025-01-07', '18:00', '20:00', 'ages 13+', 12, 'no', '', 1, 'STEP VA Studio: 3328 Bourbon Street'),
(70, 'Rolex Paris Masters', '2024-12-25', '13:00', '15:00', 'Testing testing 123', 99, 'no', '', 1, 'Location'),
(71, 'Christmas Party', '2024-12-22', '18:00', '21:00', 'Welcome!', 100, 'no', '', 1, 'Palace'),
(72, 'Awesome Event 2024', '2024-12-05', '13:00', '17:00', 'This is the most awesome event of 2024!', 50, 'no', '', 0, 'UMW'),
(73, 'Finding Nemo Jr.', '2025-07-19', '17:00', '18:30', 'Come and see the children perform!', 100, 'no', '', 1, 'Step VA headquarters'),
(75, 'The Spotsylvanians', '2024-12-14', '19:00', '21:00', 'The Spotsylvanians Present A Hometown Holiday', 100, 'no', '', 1, 'Riverbend High School 12301 Spotswood Furnace Road Fredericksburg'),
(76, 'Fred&#039;s Piano Recital', '2024-12-14', '18:00', '21:00', 'Come hear Fred play piano!', 99, 'no', '', 0, 'StepVA Headquarters'),
(78, 'Costume making', '2024-12-23', '12:00', '17:00', 'Costume making', 10, 'no', '', 1, 'location'),
(79, 'Singing lessons', '2024-12-22', '12:00', '17:00', 'Singing Lessons', 10, 'no', '', 0, 'Location'),
(80, 'Arts and Crafts', '2024-12-11', '12:00', '17:00', 'Awesome!', 10, 'no', '', 0, 'location'),
(81, 'Dancing lessons', '2024-12-18', '12:00', '17:00', 'dancing lessons!', 10, 'no', '', 0, 'location'),
(82, 'Tree Ceremony', '2024-12-10', '21:30', '22:00', 'Come light a Christmas Tree downtown!', 2, 'no', '', 0, ''),
(83, 'Step VA Presentation', '2024-12-11', '09:00', '13:00', 'TADA!!!', 4, 'no', '', 0, 'Tada'),
(87, 'Christmas Tree Lighting', '2024-12-14', '07:00', '18:00', 'We&#039;re going to light the Christmas tree!', 99, 'no', '', 0, 'Stafford Square'),
(89, 'Tuesdays with the Troubadours: Christmas with the Troubadours', '2024-12-17', '09:00', '12:00', 'The Troubadours are live! Come celebrate Christmas!', 99, 'no', '', 0, 'Virtual Online'),
(92, 'CandyLand Game Night', '2024-12-12', '07:00', '12:00', 'Let&#039;s play CandyLand!', 15, 'no', '', 0, 'STEP VA Studio: 3328 Bourbon Street'),
(94, 'Gary_Young_Resume_Policy.pdf', '2024-12-26', '00:00', '00:01', 'ABC', 8, 'no', '', 0, ''),
(97, 'Test', '2024-12-12', '12:00', '13:00', 'Test', 1, 'no', '', 0, 'Test'),
(98, 'Rolex Paris Masters', '2024-12-11', '15:42', '18:00', 'Testing testing 123', 4, 'no', '', 0, 'Location'),
(99, 'Christmas Wrapping Event', '2025-02-05', '15:45', '18:00', 'hot', 3, 'no', '', 0, 'Location'),
(100, 'Finding Nemo', '2025-02-15', '17:30', '20:00', 'approved volunteers', 15, 'no', '', 1, ''),
(101, 'Finding Nemo Rehearsal', '2025-01-23', '17:30', '20:00', 'rehearsal', 20, 'no', '', 1, 'Riverside First Church of God 3461 Fall Hill Ave. Fredericksburg 22401'),
(103, 'Finding Nemo Rehearsal', '2025-01-30', '17:30', '20:00', 'rehearsal', 20, 'no', '', 1, 'Riverside First Church of God 3461 Fall Hill Ave. Fredericksburg 22401'),
(104, 'Finding Nemo Rehearsal', '2025-02-06', '17:30', '20:00', 'rehearsal', 20, 'no', '', 1, 'Riverside First Church of God 3461 Fall Hill Ave. Fredericksburg 22401'),
(105, 'Finding Nemo Rehearsal', '2025-03-27', '17:30', '20:00', 'rehearsal', 20, 'no', '', 1, 'Riverside First Church of God 3461 Fall Hill Ave. Fredericksburg 22401'),
(106, 'Finding Nemo Rehearsal', '2025-03-20', '17:30', '20:00', 'rehearsal', 20, 'no', '', 1, 'Riverside First Church of God 3461 Fall Hill Ave. Fredericksburg 22401'),
(107, 'visa', '2025-02-02', '12:00', '13:00', 'dqdwec', 60, 'no', '', 1, 'vwvw'),
(108, 'jninjn', '2025-02-13', '12:00', '13:00', 'ijnoi', 1, 'no', '', 1, 'noin'),
(109, 'Test', '2025-02-13', '13:00', '14:30', 'This is a test event', 99, 'no', '', 0, 'Fredericksburg, VA');

-- --------------------------------------------------------

--
-- Table structure for table `dbmessages`
--

CREATE TABLE `dbmessages` (
  `id` int(11) NOT NULL,
  `senderID` varchar(256) NOT NULL,
  `recipientID` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `body` text NOT NULL,
  `time` varchar(16) NOT NULL,
  `wasRead` tinyint(1) NOT NULL DEFAULT 0,
  `prioritylevel` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dbmessages`
--

INSERT INTO `dbmessages` (`id`, `senderID`, `recipientID`, `title`, `body`, `time`, `wasRead`, `prioritylevel`) VALUES
(0, 'vmsroot', 'username', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-02-10:19', 0, 0),
(0, 'vmsroot', 'vmsroot', 'username requested to sign up for a restricted event', 'username requested to sign up for restricted event notification test. Please review.', '2024-12-02-10:19', 1, 0),
(0, 'vmsroot', 'username', 'Your sign-up has been approved.', 'Thank you for signing up for notification testing (unrestricted)!', '2024-12-02-10:19', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-02-11:15', 0, 0),
(0, 'vmsroot', 'vmsroot', 'fredastaire requested to sign up for a restricted event', 'fredastaire requested to sign up for restricted event notification test. Please review.', '2024-12-02-11:15', 1, 0),
(0, 'vmsroot', 'someInfo2', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-02-16:06', 0, 0),
(0, 'vmsroot', 'vmsroot', 'someInfo2 requested to sign up for a restricted event', 'someInfo2 requested to sign up for notification testing (restricted). Please review.', '2024-12-02-16:06', 1, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for DO NOT DELETE will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-02-19:22', 0, 0),
(0, 'vmsroot', 'vmsroot', 'fredastaire requested to sign up for a restricted event', 'fredastaire requested to sign up for DO NOT DELETE. Please review.', '2024-12-02-19:22', 1, 0),
(0, 'vmsroot', 'morgan', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Rolex Paris Masters will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-02-20:31', 0, 0),
(0, 'vmsroot', 'vmsroot', 'morgan requested to sign up for a restricted event', 'morgan requested to sign up for Rolex Paris Masters. Please review.', '2024-12-02-20:31', 1, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-02-21:01', 0, 0),
(0, 'vmsroot', 'vmsroot', 'fredastaire requested to sign up for a restricted event', 'fredastaire requested to sign up for restricted event notification test. Please review.', '2024-12-02-21:01', 1, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-02-21:05', 0, 0),
(0, 'vmsroot', 'vmsroot', 'fredastaire requested to sign up for a restricted event', 'fredastaire requested to sign up for Christmas Party. Please review.', '2024-12-02-21:05', 1, 0),
(0, 'vmsroot', 'morgan', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Cookie Party!', '2024-12-02-21:09', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Cookie Party!', '2024-12-02-21:11', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-02:08', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-02:08', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-02:13', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-02:13', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-02:18', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-02:18', 1, 0),
(0, 'vmsroot', 'test', 'Your sign-up has been approved.', 'Thank you for signing up for notification testing (restricted)!', '2024-12-04-02:40', 0, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-02:42', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-02:42', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-02:44', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-02:44', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-02:46', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-02:46', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-02:54', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-02:54', 1, 0),
(0, 'vmsroot', 'username', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-03:04', 0, 0),
(0, 'vmsroot', 'vmsroot', 'username requested to sign up for a restricted event', 'username requested to sign up for restricted event notification test. Please review.', '2024-12-04-03:04', 1, 0),
(0, 'vmsroot', 'username', 'Your sign-up has been approved.', 'Thank you for signing up for Test!', '2024-12-04-03:05', 0, 0),
(0, 'vmsroot', 'username', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-03:05', 0, 0),
(0, 'vmsroot', 'vmsroot', 'username requested to sign up for a restricted event', 'username requested to sign up for Christmas Party. Please review.', '2024-12-04-03:05', 1, 0),
(0, 'vmsroot', 'test', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Party!', '2024-12-04-03:08', 0, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-03:09', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for restricted event notification test. Please review.', '2024-12-04-03:09', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for DO NOT DELETE will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-03:09', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for DO NOT DELETE. Please review.', '2024-12-04-03:09', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-03:15', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-03:15', 1, 0),
(0, 'vmsroot', 'test', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-04-03:20', 0, 0),
(0, 'vmsroot', 'test', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-04-03:23', 0, 0),
(0, 'vmsroot', 'test', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-04-03:41', 0, 0),
(0, 'vmsroot', 'someInfo2', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-04-05:16', 0, 0),
(0, 'vmsroot', 'someInfo2', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-04-05:17', 0, 0),
(0, 'vmsroot', 'someInfo2', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-04-05:17', 0, 0),
(0, 'vmsroot', 'someInfo2', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for AHHHH will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-09:16', 0, 0),
(0, 'vmsroot', 'vmsroot', 'someInfo2 requested to sign up for a restricted event', 'someInfo2 requested to sign up for AHHHH. Please review.', '2024-12-04-09:16', 1, 0),
(0, 'vmsroot', 'someInfo2', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-04-09:22', 0, 0),
(0, 'vmsroot', 'lucy', 'Your sign-up has been approved.', 'Thank you for signing up for restricted event notification test!', '2024-12-04-11:26', 0, 0),
(0, 'vmsroot', 'vmsroot', 'username cancelled their sign up for Christmas Party', 'username cancelled their sign up for Christmas Party', '2024-12-04-13:38', 1, 0),
(0, 'vmsroot', 'vmsroot', 'username cancelled their sign up for restricted event notification test', 'username cancelled their sign up for restricted event notification test', '2024-12-04-13:38', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Awesome Event 2024!', '2024-12-05-14:12', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Cookie Party!', '2024-12-05-18:26', 1, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-05-18:27', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-05-18:30', 0, 0),
(0, 'vmsroot', 'lucy', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-05-18:57', 0, 0),
(0, 'vmsroot', 'username', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for cool event will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-07-12:31', 0, 0),
(0, 'vmsroot', 'lucy', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for The Spotsylvanians will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-13:28', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-16:57', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-16:59', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for AHHHH will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-17:22', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for cool event will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-17:37', 1, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-18:56', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for DO NOT DELETE will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-18:58', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Cookie Party!', '2024-12-09-18:59', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-09-19:01', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for restricted event notification test!', '2024-12-09-19:12', 1, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-19:13', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your sign-up has been approved.', 'Thank you for signing up for restricted event notification test!', '2024-12-09-19:18', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-19:19', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-19:37', 0, 0),
(0, 'vmsroot', 'test', 'Your sign-up has been approved.', 'Thank you for signing up for notification testing (unrestricted)!', '2024-12-09-19:39', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your sign-up has been approved.', 'Thank you for signing up for notification testing (restricted)!', '2024-12-09-19:42', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-19:42', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for restricted event notification test!', '2024-12-09-19:46', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for AHHHH!', '2024-12-09-19:47', 1, 0),
(0, 'vmsroot', 'fredastaire', 'Your sign-up has been approved.', 'Thank you for signing up for Test!', '2024-12-09-19:47', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Finding Nemo Jr. will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-19:48', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Finding Nemo Jr.!', '2024-12-09-19:49', 1, 0),
(0, 'vmsroot', 'someInfo2', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for AHHHH will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-20:30', 0, 0),
(0, 'vmsroot', 'morgan', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for New Years Day Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-20:31', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event signup has been approved', 'You are now signed up for Array. Congratulations!', '2024-12-09-20:41', 1, 0),
(0, 'vmsroot', 'testuser', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for New Years Day Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-20:42', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for New Years Day Party!', '2024-12-09-20:42', 1, 0),
(0, 'vmsroot', 'testuser', 'Your restricted event signup has been approved', 'You are now signed up for Array. Congratulations!', '2024-12-09-20:43', 0, 0),
(0, 'vmsroot', 'lucy', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for New Years Day Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-20:43', 0, 0),
(0, 'vmsroot', 'vmsroot', 'morgan cancelled their sign up for New Years Day Party', 'morgan cancelled their sign up for New Years Day Party', '2024-12-09-20:44', 1, 0),
(0, 'vmsroot', 'testuser', 'Your sign-up has been approved.', 'Thank you for signing up for New Years Day Party!', '2024-12-09-20:45', 0, 0),
(0, 'vmsroot', 'vmsroot', 'testuser cancelled their sign up for New Years Day Party', 'testuser cancelled their sign up for New Years Day Party', '2024-12-09-20:46', 1, 0),
(0, 'vmsroot', 'testuser', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Party!', '2024-12-09-20:46', 0, 0),
(0, 'vmsroot', 'vmsroot', 'testuser cancelled their sign up for Christmas Party', 'testuser cancelled their sign up for Christmas Party', '2024-12-09-20:46', 1, 0),
(0, 'vmsroot', 'vmsroot', 'testuser cancelled their sign up for Monday Morning', 'testuser cancelled their sign up for Monday Morning', '2024-12-09-20:46', 1, 0),
(0, 'vmsroot', 'testuser', 'Your sign-up has been approved.', 'Thank you for signing up for New Years Day Party!', '2024-12-09-20:47', 0, 0),
(0, 'vmsroot', 'morgan', 'Your sign-up has been approved.', 'Thank you for signing up for Daytime Yoga!', '2024-12-09-20:47', 0, 0),
(0, 'vmsroot', 'vmsroot', 'morgan cancelled their sign up for Christmas Cookie Party', 'morgan cancelled their sign up for Christmas Cookie Party', '2024-12-09-20:47', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Party!', '2024-12-09-20:49', 1, 0),
(0, 'vmsroot', 'lucy', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Rolex Paris Masters will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-20:51', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Rolex Paris Masters!', '2024-12-09-21:03', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Rolex Paris Masters will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-21:05', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Rolex Paris Masters!', '2024-12-09-21:05', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Rolex Paris Masters!', '2024-12-09-21:06', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Rolex Paris Masters will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-21:10', 1, 0),
(0, 'vmsroot', 'charles', 'Your sign-up has been approved.', 'Thank you for signing up for Daytime Yoga!', '2024-12-10-13:35', 1, 0),
(0, 'vmsroot', 'charles', 'Your sign-up has been approved.', 'Thank you for signing up for Finding Nemo Jr Audition Track!', '2024-12-10-13:36', 1, 0),
(0, 'vmsroot', 'charles', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Cookie Party!', '2024-12-10-13:36', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Rolex Paris Masters!', '2024-12-10-17:11', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Rolex Paris Masters will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-10-17:40', 1, 0),
(0, 'vmsroot', 'charles', 'Your sign-up has been approved.', 'Thank you for signing up for Arts and Crafts!', '2024-12-10-18:45', 1, 0),
(0, 'vmsroot', 'charles', 'You are now signed up for Singing lessons!', 'Thank you for signing up for Singing lessons!', '2024-12-10-18:52', 1, 0),
(0, 'vmsroot', 'charles', 'Your request to sign up for Costume making has been sent to an admin.', 'Your request to sign up for Costume making will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-10-19:16', 1, 0),
(0, 'vmsroot', 'vmsroot', 'charles cancelled their sign up for Finding Nemo Jr Audition Track', 'charles cancelled their sign up for Finding Nemo Jr Audition Track', '2024-12-10-19:33', 1, 0),
(0, 'vmsroot', 'charles', 'Your request to sign up for The Spotsylvanians has been sent to an admin.', 'Your request to sign up for The Spotsylvanians will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-10-19:57', 1, 0),
(0, 'vmsroot', 'charles', 'You are now signed up for Dancing lessons!', 'Thank you for signing up for Dancing lessons!', '2024-12-10-20:03', 1, 0),
(0, 'vmsroot', 'vmsroot', 'charles cancelled their sign up for Dancing lessons', 'charles cancelled their sign up for Dancing lessons', '2024-12-10-20:04', 1, 0),
(0, 'vmsroot', 'charles', 'Your request to sign up for Finding Nemo Jr: Tech Classes has been sent to an admin.', 'Your request to sign up for Finding Nemo Jr: Tech Classes will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-10-20:06', 1, 0),
(0, 'vmsroot', 'charles', 'Your request to sign up for Rolex Paris Masters has been sent to an admin.', 'Your request to sign up for Rolex Paris Masters will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-10-20:15', 1, 0),
(0, 'vmsroot', 'vmsroot', 'charles cancelled their sign up for Arts and Crafts', 'charles cancelled their sign up for Arts and Crafts', '2024-12-10-20:20', 1, 0),
(0, 'vmsroot', 'charles', 'Your sign up for Arts and Crafts has been cancelled.', 'charles cancelled their sign up for Arts and Crafts', '2024-12-10-20:20', 1, 0),
(0, 'vmsroot', 'testuser', 'You are now signed up for Christmas Party!', 'Thank you for signing up for Christmas Party!', '2024-12-10-20:58', 0, 0),
(0, 'vmsroot', 'testuser', 'Your request to sign up for Christmas Party has been sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-10-21:07', 0, 0),
(0, 'vmsroot', 'vmsroot', 'testuser cancelled their sign up for New Years Day Party', 'testuser cancelled their sign up for New Years Day Party', '2024-12-10-21:08', 1, 0),
(0, 'vmsroot', 'testuser', 'Your sign up for New Years Day Party has been cancelled.', 'testuser cancelled their sign up for New Years Day Party', '2024-12-10-21:08', 0, 0),
(0, 'vmsroot', 'testuser', 'You are now signed up for Singing lessons!', 'Thank you for signing up for Singing lessons!', '2024-12-10-21:08', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your request to sign up for New Years Day Party has been sent to an admin.', 'Your request to sign up for New Years Day Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-10-21:10', 1, 0),
(0, 'vmsroot', 'testuser', 'You are now signed up for Tree Ceremony!', 'Thank you for signing up for Tree Ceremony!', '2024-12-10-21:29', 0, 0),
(0, 'vmsroot', 'testuser', 'You are now signed up for Step VA Presentation!', 'Thank you for signing up for Step VA Presentation!', '2024-12-11-03:22', 0, 0),
(0, 'vmsroot', 'testuser', 'Your request to sign up for Christmas Party has been sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-11-03:36', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your request to sign up for Christmas Party has been sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-11-03:41', 1, 0),
(0, 'vmsroot', 'testuser', 'Your restricted event signup has been approved', 'You are now signed up for Christmas Party. Congratulations!', '2024-12-11-03:41', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your request to sign up for Christmas Party has been sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-11-03:41', 1, 0),
(0, 'vmsroot', 'testuser', 'Your sign-up for Christmas Party has been denied.', 'Your sign up for Christmas Party has been denied.', '2024-12-11-03:43', 0, 0),
(0, 'vmsroot', 'testuser', 'Your request to sign up for Christmas Party has been sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-11-03:43', 0, 0),
(0, 'vmsroot', 'morgan', 'You are now signed up for Test!', 'Thank you for signing up for Test!', '2024-12-11-15:41', 0, 0),
(0, 'vmsroot', 'charles', 'You are now signed up for Dancing lessons!', 'Thank you for signing up for Dancing lessons!', '2024-12-11-16:26', 1, 0),
(0, 'vmsroot', 'charles', 'Your request to sign up for Christmas Party has been sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-11-16:26', 1, 0),
(0, 'vmsroot', 'polack@umw.edu', 'You are now signed up for Gary_Young_Resume_NSWCDD.pdf!', 'Thank you for signing up for Gary_Young_Resume_NSWCDD.pdf!', '2025-01-14-13:34', 1, 0),
(0, 'vmsroot', 'stepvainc@gmail.com', 'Your request to sign up for Finding Nemo Rehearsal has been sent to an admin.', 'Your request to sign up for Finding Nemo Rehearsal will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2025-01-20-16:17', 1, 0),
(0, 'vmsroot', 'stepvainc@gmail.com', 'Your restricted event signup has been approved', 'You are now signed up for Finding Nemo Rehearsal. Congratulations!', '2025-01-20-16:21', 0, 0),
(0, 'vmsroot', 'SaraDowd', 'Your request to sign up for Finding Nemo Rehearsal has been sent to an admin.', 'Your request to sign up for Finding Nemo Rehearsal will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2025-01-20-18:58', 1, 0),
(0, 'vmsroot', 'StrawberryJade', 'Your request to sign up for Finding Nemo Rehearsal has been sent to an admin.', 'Your request to sign up for Finding Nemo Rehearsal will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2025-01-21-12:11', 1, 0),
(0, 'vmsroot', 'ebrenna2', 'Your request to sign up for Finding Nemo Rehearsal has been sent to an admin.', 'Your request to sign up for Finding Nemo Rehearsal will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2025-02-03-12:19', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your request to sign up for Finding Nemo has been sent to an admin.', 'Your request to sign up for Finding Nemo will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2025-02-07-15:39', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your request to sign up for jninjn has been sent to an admin.', 'Your request to sign up for jninjn will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2025-02-07-16:05', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your request to sign up for Finding Nemo Rehearsal has been sent to an admin.', 'Your request to sign up for Finding Nemo Rehearsal will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2025-02-07-16:06', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dbpendingsignups`
--

CREATE TABLE `dbpendingsignups` (
  `username` varchar(25) NOT NULL,
  `eventname` varchar(100) NOT NULL,
  `role` varchar(5) NOT NULL,
  `notes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dbpendingsignups`
--

INSERT INTO `dbpendingsignups` (`username`, `eventname`, `role`, `notes`) VALUES
('vmsroot', '108', 'v', 'Skills: non | Dietary restrictions: ojnjo | Disabilities: jonoj | Materials: knock'),
('vmsroot', '101', 'v', 'Skills: rvwav | Dietary restrictions: varv | Disabilities: var | Materials: arv');

-- --------------------------------------------------------

--
-- Table structure for table `dbpersonhours`
--

CREATE TABLE `dbpersonhours` (
  `personID` varchar(256) NOT NULL,
  `eventID` int(11) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dbpersonhours`
--

INSERT INTO `dbpersonhours` (`personID`, `eventID`, `start_time`, `end_time`) VALUES
('test', 31, '2024-11-23 22:00:00', '2024-11-23 23:00:00'),
('test', 30, '2024-11-23 23:00:00', '2024-11-24 00:30:00'),
('test', 30, '2024-11-23 20:05:00', '2024-11-23 20:10:00'),
('test', 72, '2024-12-05 19:20:00', '2024-12-05 20:40:00'),
('test', 72, '2024-12-05 20:21:07', '2024-12-05 20:56:24'),
('test', 72, '2024-12-05 21:00:00', '2024-12-05 22:30:00'),
('test', 31, '2024-11-23 23:30:00', '2024-11-24 01:00:00'),
('testuser', 82, '2024-12-11 03:29:00', '2024-12-11 04:00:00'),
('testuser', 83, '2024-12-11 15:30:00', '2024-12-11 16:00:00'),
('testuser', 83, '2024-12-11 22:05:43', '2024-12-11 22:05:46'),
('testuser', 83, '2024-12-11 22:16:44', '2024-12-11 22:16:49'),
('testuser', 83, '2024-12-11 22:48:00', '2024-12-11 23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `dbpersons`
--

CREATE TABLE `dbpersons` (
  `id` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` text DEFAULT NULL,
  `venue` text DEFAULT NULL,
  `first_name` text NOT NULL,
  `last_name` text DEFAULT NULL,
  `street_address` text DEFAULT NULL,
  `city` text DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zip_code` text DEFAULT NULL,
  `phone1` varchar(12) NOT NULL,
  `phone1type` text DEFAULT NULL,
  `emergency_contact_phone` varchar(12) DEFAULT NULL,
  `emergency_contact_phone_type` text DEFAULT NULL,
  `birthday` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `emergency_contact_first_name` text NOT NULL,
  `contact_num` varchar(12) NOT NULL,
  `emergency_contact_relation` text NOT NULL,
  `contact_method` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `profile_pic` text NOT NULL,
  `gender` varchar(6) NOT NULL,
  `tshirt_size` text NOT NULL,
  `how_you_heard_of_stepva` text NOT NULL,
  `sensory_sensitivities` text NOT NULL,
  `disability_accomodation_needs` text NOT NULL,
  `school_affiliation` text NOT NULL,
  `race` text NOT NULL,
  `preferred_feedback_method` text NOT NULL,
  `hobbies` text NOT NULL,
  `professional_experience` text NOT NULL,
  `archived` tinyint(1) NOT NULL,
  `emergency_contact_last_name` text NOT NULL,
  `photo_release` text NOT NULL,
  `photo_release_notes` text NOT NULL,
  `training_complete` int(11) NOT NULL DEFAULT 0,
  `training_date` text NOT NULL,
  `orientation_complete` int(11) NOT NULL DEFAULT 0,
  `orientation_date` text NOT NULL,
  `background_complete` int(11) NOT NULL DEFAULT 0,
  `background_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dbpersons`
--

INSERT INTO `dbpersons` (`id`, `start_date`, `venue`, `first_name`, `last_name`, `street_address`, `city`, `state`, `zip_code`, `phone1`, `phone1type`, `emergency_contact_phone`, `emergency_contact_phone_type`, `birthday`, `email`, `emergency_contact_first_name`, `contact_num`, `emergency_contact_relation`, `contact_method`, `type`, `status`, `notes`, `password`, `profile_pic`, `gender`, `tshirt_size`, `how_you_heard_of_stepva`, `sensory_sensitivities`, `disability_accomodation_needs`, `school_affiliation`, `race`, `preferred_feedback_method`, `hobbies`, `professional_experience`, `archived`, `emergency_contact_last_name`, `photo_release`, `photo_release_notes`, `training_complete`, `training_date`, `orientation_complete`, `orientation_date`, `background_complete`, `background_date`) VALUES
('aaa', '2024-12-09', 'n/a', 'aaa', 'aaa', 'a', 'a', 'VA', '33333', '1231231233', 'cellphone', '2342342344', 'cellphone', '2001-07-07', 'a@a.a', 'a', 'n/a', 'a', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$5s8HaYX98.3Wlsr7hpiVH.UGtxt0YqSGCrcWFsV5McmiN9wjUZNBu', 'n/a', 'gender', 'xs', '', 'sensory_sensitivities', '', 'a', 'race', 'No preference', '', '', 0, 'a', 'Restricted', 'a', 0, '', 0, '', 0, ''),
('Abby Floyd', '2025-01-09', 'n/a', 'Abigail', 'Floyd', '5425 Rainwood Dr', 'Fredericksburg', 'VA', '22407', '5403226396', 'cellphone', '5404290350', 'cellphone', '2008-03-08', 'amfloyd14@icloud.com', 'Melissa', 'n/a', 'Mother', 'n/a', 'v', 'Active', 'n/a', '$2y$10$OreonRBUiYTXffapXDSzN.lt04IVsOrOiQ27UsT1XBZj5IctrXetG', 'n/a', 'gender', 'xl', '', 'sensory_sensitivities', '', 'Courtland Highschool', 'race', 'no-preference', '', '', 0, 'Floyd', 'Not Restricted', 'N/A', 1, '2022-06-11', 1, '2022-06-11', 1, '2022-06-11'),
('AbbyGriff', '2025-01-09', 'n/a', 'Abby', 'Griffin', '5417, Holley Oak Lane', 'Fredericksburg', 'VA', '22407', '5406612606', 'cellphone', '5408348825', 'cellphone', '2010-09-01', 'abigailfgriff@gmail.com', 'Pam', 'n/a', 'Mother', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$c901gH6WuN9DgxmwodzOKeOgpdu87OlTTXEvj2/Ejt/SIIZpSc9si', 'n/a', 'gender', 's', 'My sister (Sarah Garner)', 'sensory_sensitivities', 'None', 'Homeschooled', 'race', 'text', 'I know how to run a mic table and can assist with a sound board, I have been in 15 musicals, I am a babysitter, and I know how to spike a stage', 'Yes; I volunteer as a Sunday school assistant.', 0, 'Griffin', 'Not Restricted', 'None', 1, '', 1, '', 1, ''),
('addison_fiore', '2025-01-09', 'n/a', 'Addison', 'Fiore', '10804 Cinnamon Teal Drive', 'Spotsylvania', 'VA', '22553', '5403720591', 'cellphone', '5409031781', 'cellphone', '2007-11-06', 'addisonfiore8@gmail.com', 'Jennifer', 'n/a', 'Mother', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$0QK4ippSoaT/e2VZ3NaG7OcqFJDps2uFz22.1NjJ.iuD7sbuyLUYW', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'Riverbend Highschool', 'race', 'text', '', '', 0, 'Fiore', 'Restricted', 'N/A', 1, '2023-07-11', 1, '2023-07-17', 1, '2023-06-07'),
('Amwages13', '2025-01-13', 'n/a', 'Lexi', 'Wages', '3 Rodeo Ct', 'Fredericksburg', 'VA', '22407', '5403599086', 'cellphone', '5402875446', 'cellphone', '2011-11-18', 'leximariewages@gmail.com', 'Laurie', 'n/a', 'Mother', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$PD0TAmsArH3AF79GeiPKuu/t3b2KwoKnixcU2OvDqA/6IjMxEsra.', 'n/a', 'gender', 's', 'Sister', 'sensory_sensitivities', 'No', 'Battlefield Middle', 'race', 'text', 'Crotchet', '', 0, 'Wages', 'Not Restricted', 'N/a', 1, '2024-12-27', 1, '2024-12-27', 0, ''),
('ascrivani3', '2025-01-09', 'n/a', 'Amelia', 'Scrivani', '12565 Spotswood Furnace Rd', 'Fredericksburg', 'VA', '22407', '7185141845', 'cellphone', '7183546470', 'cellphone', '2004-08-09', 'ascrivani3@gmail.com', 'Michele', 'n/a', 'Mother', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$RfIm4IswPvtW656I6h2cR.czd4uCKldaSsKB5zCiw8642lfimAFj.', 'n/a', 'gender', 'm', 'My brother participates in various Step VA activities', 'sensory_sensitivities', '', 'N/A', 'race', 'text', '', 'I have spent many years volunteering with my old elementary school’s annual chorus performance, every year they put on a musical.', 0, 'Scrivani', 'Not Restricted', 'N/A', 0, '', 0, '', 0, ''),
('brianna@gmail.com', '2024-01-22', 'portland', 'Brianna', 'Wahl', '212 Latham Road', 'Mineola', 'VA', '11501', '1234567890', 'cellphone', '', '', '2004-04-04', 'brianna@gmail.com', 'Mom', '1234567890', 'Mother', 'text', 'admin', 'Active', '', '$2y$10$jNbMmZwq.1r/5/oy61IRkOSX4PY6sxpYEdWfu9tLRZA6m1NgsxD6m', '', 'Female', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, ''),
('bum@gmail.com', '2024-01-24', 'portland', 'bum', 'bum', '1345 Strattford St.', 'Mineola', 'VA', '22401', '1234567890', 'home', '', '', '1111-11-11', 'bum@gmail.com', 'Mom', '1234567890', 'Mom', 'text', 'admin', 'Active', '', '$2y$10$Ps8FnZXT7d4uiU/R5YFnRecIRbRakyVtbXP9TVqp7vVpuB3yTXFIO', '', 'Male', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, ''),
('charles', '2024-12-10', 'n/a', 'Charles', 'Wilt', 'Street Address', 'Fredericksburg', 'VA', '22405', '1231231234', 'cellphone', '1231231234', 'cellphone', '2004-06-15', 'charles@gmail.com', 'Michael', 'n/a', 'Father', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$BhurBvyEs9hTa7sIeZEqHeuE0aAXSGX/CcwMw7y/4dHt0ztL1MjMO', 'n/a', 'gender', 's', '', 'sensory_sensitivities', '', 'N/A', 'race', 'No preference', '', '', 0, 'Wilt', 'Not Restricted', 'N/A', 0, '', 0, '', 0, ''),
('christitowle', '2025-01-09', 'n/a', 'Christi', 'Towle', '201 New Hope Church Road', 'Fredericksburg', 'VA', '22405', '8044415060', 'cellphone', '8044415060', 'cellphone', '1972-12-11', 'towlefamily@yahoo.com', 'Jason', 'n/a', 'Spouse', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$QKAHn4eKKL8qgF2gDGjNiektJolio9YlhMByUyLXE.GfJVSygOAli', 'n/a', 'gender', 'm', 'A friend', 'sensory_sensitivities', 'No', 'N/A', 'race', 'No preference', 'gardening, crafts', 'Yes', 0, 'Towle', 'Not Restricted', 'N/A', 0, '', 1, '', 1, ''),
('derp', '2024-12-09', 'n/a', 'a', 'a', 'a', 'a', 'VA', '12323', '1231231234', 'home', '1231231234', 'home', '2024-12-04', 'awe@gmail.com', 'a', 'n/a', 'a', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$gYsD0Y1dwlDK4SZH59VGuOlqu78JwLrSXViebTkX0KxMOQgWIR7c.', 'n/a', 'gender', 's', '', 'sensory_sensitivities', '', 'a', 'race', 'No preference', '', '', 0, 'a', 'Restricted', 'a', 0, '', 0, '', 0, ''),
('ebrenna2', '2025-02-03', 'n/a', 'Emma', 'Brennan', '212 Willis St', 'Fredericksburg', 'VA', '22401', '7035099647', 'cellphone', '7032965189', 'cellphone', '2002-09-23', 'em.brenn@yahoo.com', 'Laura', 'n/a', 'Mother', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$3hIpyIl79iyRTb.edM.uEuV8aT9t5v4juO3vXmpcIYULPokjpftKK', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'UMW', 'race', 'No preference', '', '', 0, 'Brennan', 'Not Restricted', 'N/A', 1, '2025-02-03', 1, '2025-02-03', 1, '2025-02-03'),
('fredastaire', '2024-11-18', 'n/a', 'Fred', 'Astaire', '11 Dance Avenue', 'Stafford', 'VA', '12345', '1234567890', 'cellphone', '2222222221', 'cellphone', '1899-05-10', 'fredastaire@myemail.com', 'Fred Jr.', 'n/a', 'Son', 'n/a', 'v', 'Active', 'n/a', '$2y$10$VUZObvA3Cy69ykkohegJYevjJU3DFlZbgmfTSPzee7TMPRSMMg9fG', 'n/a', 'gender', 'm', 'A little bird told me.', 'sensory_sensitivities', 'No', 'N/A', 'race', 'email', 'Dance!', 'Yes', 0, 'Astaire', 'Not Restricted', 'N/A', 0, '', 0, '', 0, ''),
('jake_demo', '2024-11-24', 'n/a', 'Jake', 'Furman', '1234 Street', 'Fredericksburg', 'VA', '10001', '5555555555', 'cellphone', '4444444444', 'cellphone', '2002-01-31', 'jake@gmail.com', 'Mom', 'n/a', 'Mom', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$UNhNSABqTedXO.fWLy7eduhDVsdNp9GbkdnkR05oyjZnYPe9XjExu', 'n/a', 'gender', 'l', '', 'sensory_sensitivities', '', 'UMW', 'race', '', '', '', 0, 'Furman', 'Not Restricted', 'no', 0, '', 0, '', 0, ''),
('lucy', '2024-11-25', 'n/a', 'Lucy', 'Pevensie', '10 London Avenue', 'Stafford', 'VA', '12345', '1234567890', 'home', '0987654321', 'cellphone', '1901-01-01', 'lucy@narnia.com', 'Peter', 'n/a', 'Brother', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$VQ5Za13gNAn/DoAJzwG.j.zMhL1YBjOpsJclMJqfSF1XKxMp2eS9S', 'n/a', 'gender', 's', 'Aslan', 'sensory_sensitivities', 'No', 'N/A', 'race', 'email', 'Arts and crafts', 'Yes', 0, 'Pevensie', 'Restricted', 'N/A', 0, '', 0, '', 0, ''),
('mom@gmail.com', '2024-01-22', 'portland', 'Lorraine', 'Egan', '212 Latham Road', 'Mineola', 'NY', '11501', '5167423832', 'home', '', '', '1910-10-10', 'mom@gmail.com', 'Mom', '5167423832', 'Dead', 'phone', 'admin', 'Active', '', '$2y$10$of1CkoNXZwyhAMS5GQ.aYuAW1SHptF6z31ONahnF2qK4Y/W9Ty2h2', '', 'Male', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, ''),
('morgan', '2024-12-02', 'n/a', 'Morgan', 'Harper', '123 Street', 'Fredericksburg', 'VA', '10001', '5555555555', 'cellphone', '5555555555', 'cellphone', '2003-11-24', 'morgan@gmail.com', 'Christine', 'n/a', 'Mom', 'n/a', 'v', 'Active', 'n/a', '$2y$10$klnM0EjO78i3ifPFMU3YQe6YXq14W3RpmSUsP1.IP0f6wVE6ExYoe', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'USC', 'race', 'email', '', 'Yessss', 0, 'Harper', 'Not Restricted', 'N/A', 1, '2024-12-04', 1, '2024-12-03', 1, '2024-12-02'),
('oliver@gmail.com', '2024-01-22', 'portland', 'Oliver', 'Wahl', '1345 Strattford St.', 'Fredericksburg', 'VA', '22401', '1234567890', 'home', '', '', '2011-11-11', 'oliver@gmail.com', 'Mom', '1234567890', 'Mother', 'text', 'admin', 'Active', '', '$2y$10$tgIjMkXhPzdmgGhUgbfPRuXLJVZHLiC0pWQQwOYKx8p8H8XY3eHw6', '', 'Other', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, ''),
('peter@gmail.com', '2024-01-22', 'portland', 'Peter', 'Polack', '1345 Strattford St.', 'Mineola', 'VA', '12345', '1234567890', 'cellphone', '', '', '1968-09-09', 'peter@gmail.com', 'Mom', '1234567890', 'Mom', 'email', 'admin', 'Active', '', '$2y$10$j5xJ6GWaBhnb45aktS.kruk05u./TsAhEoCI3VRlNs0SRGrIqz.B6', '', 'Male', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, ''),
('polack@um.edu', '2024-01-22', 'portland', 'Jennifer', 'Polack', '15 Wallace Farms Lane', 'Fredericksburg', 'VA', '22406', '1234567890', 'cellphone', '', '', '1970-05-01', 'polack@um.edu', 'Mom', '1234567890', 'Mom', 'email', 'admin', 'Active', '', '$2y$10$mp18j4WqhlQo7MTeS/9kt.i08n7nbt0YMuRoAxtAy52BlinqPUE4C', '', 'Female', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, ''),
('polack@umw.edu', '2025-01-09', 'n/a', 'Jennifer', 'ADMIN', '15 Wallace Farms Lane', 'Fredericksburg', 'VA', '22406', '5402959700', 'cellphone', '5402959700', 'cellphone', '1970-05-01', 'polack@umw.edu', 'Jennifer', 'n/a', 'Me', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$CxMpQDWPyURnla9pb8FvveQSRrMBU7.zAB.ZbdHwK1P/suPuwcy0O', 'n/a', 'gender', 'l', '', 'sensory_sensitivities', '', 'UMW', 'race', 'No preference', '', '', 0, 'Polack', 'Restricted', 'NA', 0, '', 0, '', 0, ''),
('s', '2024-11-18', 'n/a', 'a', 'hj', 'f', 'f', 'VA', '12333', '1231231234', 'home', '1231231234', 'cellphone', '2000-12-20', 'jf@gmail.com', 'e', 'n/a', 'e', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$7ml7KedmERvRYpflzuMAHOsXdssqzMo5FidkOtekjj9R6u1OdTXqy', 'n/a', 'gender', 's', '', 'sensory_sensitivities', '', 's', 'race', '', '', '', 0, 'e', 'Restricted', 's', 0, '', 0, '', 0, ''),
('SaraDowd', '2025-01-13', 'n/a', 'Sara', 'Dowd', '11 Barlow House Court', 'Stafford', 'VA', '22554', '8582549611', 'cellphone', '8582548568', 'cellphone', '1978-01-23', 'sarazonadowd@gmail.com', 'Daniel', 'n/a', 'Spouse', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$BQ4n2HGpgxfaFnBf0HexveU8I0ppdINNXvhZdynQyOiaitOnP6dw6', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'n/a', 'race', 'email', '', '', 0, 'Dowd', 'Not Restricted', 'n/a', 1, '', 1, '', 1, ''),
('someInfo2', '2024-11-24', 'n/a', 'nah', 'whywouldi', '0', '0', 'VA', '00000', '0000000000', 'work', '0000000000', 'work', '0001-01-01', '0@0.o', 'nah', 'n/a', 'a', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$umJj4HXb5tpj79rc4Vj8hu5wCK7BSjMEDdtX7sfdGjMqjt5.ap3bq', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'why would i be', 'race', '', '', '', 0, 'whywouldi', 'Not Restricted', 'a', 0, '', 0, '', 0, ''),
('stepvainc@gmail.com', '2024-12-17', 'n/a', 'Jan', 'Monroe', '12419 Toll House Rd.', 'SPOTSYLVANIA', 'VA', '22551', '7575351963', 'cellphone', '7575351967', 'cellphone', '2000-12-09', 'stepvainc@gmail.com', 'Mike', 'n/a', 'spouse', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$mOC.B5elQp8HZhdkNhR/V.jjNBwcsTzQdjG14Aia1jP.8XkNSWj0u', 'n/a', 'gender', 's', '', 'sensory_sensitivities', 'no', 'N/a', 'race', 'text', 'yoga, music', 'yes', 0, 'Monroe', 'Not Restricted', 'n/a', 1, '2013-10-13', 1, '2013-10-13', 1, ''),
('StrawberryJade', '2025-01-09', 'n/a', 'Jade', 'Sergi', '2449 Harpoon Drive', 'Stafford', 'VA', '22554', '5406994590', 'cellphone', '3014120327', 'cellphone', '2005-04-21', 'jtsergi42@gmail.com', 'Carol', 'n/a', 'Mother', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$Q3bVGR6B6E4Ibz7k9vryMO5mFJvtkLO418iADpEonhKdt7vzb5R22', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'N/A', 'race', 'text', '', '', 0, 'Yeh', 'Not Restricted', 'N/A', 1, '2024-11-20', 1, '2019-05-30', 1, '2023-05-29'),
('test', '2024-11-20', 'n/a', 'Harry', 'Potter', '123 Apple St.', 'Fredericksburg', 'VA', '22003', '1231231234', 'cellphone', '4324324321', 'home', '2000-07-07', 'test@gmail.com', 'Ron', 'n/a', 'Friend', 'n/a', 'v', 'Active', 'n/a', '$2y$10$3qNoA1RwCbO9/1eHev.T0OCdhfBwaS9cmzGVFdCD4CFqmyEPjgkbm', 'n/a', 'gender', 'm', 'I didn&amp;#039;t', 'sensory_sensitivities', 'aoei', 'Hogwarts', 'race', 'text', 'aoei', 'aoei', 0, 'Weasley', 'Not Restricted', ':0', 0, '', 0, '', 0, ''),
('testuser', '2024-11-25', 'n/a', 'Jane', 'Doe', '123 Main Street', 'Fredericksburg', 'VA', '22401', '5555555555', 'cellphone', '6666666666', 'cellphone', '1999-01-01', 'test@mail.com', 'Ron', 'n/a', 'Friend', 'n/a', 'v', 'Active', 'n/a', '$2y$10$kfaLBXEYKBmdzaO6x7KtBuQeXu5o8Wof2MaR5vwJ44aoqPwMsgkIa', 'n/a', 'gender', 'l', 'A little birdie told me', 'sensory_sensitivities', 'Nah', 'N/A', 'race', 'text', 'Being Rad', 'Nah', 0, 'Swanson', 'Not Restricted', 'N/A', 0, '', 0, '', 0, ''),
('testuser2', '2024-12-11', 'n/a', 'Jane', 'Doe', '123 Main Street', 'Fredericksburg', 'VA', '22401', '5555555555', 'cellphone', '6666666666', 'cellphone', '2003-08-26', 'test2@mail.com', 'Ron', 'n/a', 'Father', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$mqnpfidPOnnZB1TKDrUa2.cWEcfrOcfslsxdaDG2o6ouWnqTCnFzK', 'n/a', 'gender', 'l', 'Test', 'sensory_sensitivities', 'NO', 'No', 'race', 'No preference', 'No', 'No', 0, 'Swanson', 'Not Restricted', 'NO', 1, '2024-12-10', 0, '', 0, ''),
('Thall1', '2025-01-09', 'n/a', 'Teresa', 'Hall', '119 Garfield Avenue', 'Colonial Beach', 'VA', '22443', '5405977489', 'cellphone', '5407608128', 'cellphone', '1969-05-07', 'tlomeara3@gmail.com', 'Tim', 'n/a', 'Spouse', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$.Er980h41trC1NRObt4U5.S8YKbORWhwC2.44tHoLLBnmSmMa8hKK', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'N/A', 'race', 'text', '', '', 0, 'Hall', 'Not Restricted', 'N/A', 1, '', 0, '', 0, ''),
('tom@gmail.com', '2024-01-22', 'portland', 'tom', 'tom', '1345 Strattford St.', 'Mineola', 'NY', '12345', '1234567890', 'home', '', '', '1920-02-02', 'tom@gmail.com', 'Dad', '9876543210', 'Father', 'phone', 'admin', 'Active', '', '$2y$10$1Zcj7n/prdkNxZjxTK1zUOF7391byZvsXkJcN8S8aZL57sz/OfxP.', '', 'Male', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, ''),
('username', '2024-11-18', 'n/a', 'cool', 'cool', 'weqwe', 'qewq', 'VA', '12312', '1231231234', 'home', '1231232134', 'cellphone', '2024-11-01', 'cool@gmail.com', 'cool', 'n/a', 'cool', 'n/a', 'v', 'Inactive', 'n/a', '$2y$10$yz35FMhhRl.hVIyjhvASJeQ.sp0lc7hzQQJJRBHH00spfTOlQJ4Cy', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'w', 'race', 'email', '', '', 0, 'cool', 'Not Restricted', 'super awesome', 0, '', 0, '', 0, ''),
('usernameusername', '2024-12-09', 'n/a', 'Noah', 'Stafford', 'My address', 'City', 'VA', '22405', '1231231234', 'cellphone', '1231231234', 'cellphone', '2024-12-01', 'email@gmail.com', 'Contact', 'n/a', 'Mom', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$uGbO0uD4CFwN0ewoqGG8T.9PT.1F8pOBSJVOKXkvNSlRSjAANMhOK', 'n/a', 'gender', 'xs', '', 'sensory_sensitivities', '', 'N/A', 'race', 'No preference', '', '', 0, 'Lastname', 'Not Restricted', 'N/A', 0, '', 0, '', 0, ''),
('vmsroot', 'N/A', 'portland', 'vmsroot', '', 'N/A', 'N/A', 'VA', 'N/A', '', 'N/A', 'N/A', 'N/A', 'N/A', 'vmsroot', 'N/A', 'N/A', 'N/A', 'N/A', '', 'N/A', 'N/A', '$2y$10$.3p8xvmUqmxNztEzMJQRBesLDwdiRU3xnt/HOcJtsglwsbUk88VTO', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, ''),
('work', '2024-12-10', 'n/a', 'a', 'a', 'a', 'a', 'VA', '11111', '1231231234', 'cellphone', '1231231234', 'cellphone', '2024-12-04', 'a@gmail.com', 'a', 'n/a', 'a', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$ChUa935f6QE8RtHI4p2vX.WtCeoVPPYQhgVNFfgnvLPo0mVJGXbCi', 'n/a', 'gender', 's', '', 'sensory_sensitivities', '', 'a', 'race', 'No preference', '', '', 0, 'a', 'Restricted', 'a', 0, '', 0, '', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dbanimals`
--
ALTER TABLE `dbanimals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dbeventmedia`
--
ALTER TABLE `dbeventmedia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKeventID2` (`eventID`);

--
-- Indexes for table `dbeventpersons`
--
ALTER TABLE `dbeventpersons`
  ADD KEY `FKeventID` (`eventID`),
  ADD KEY `FKpersonID` (`userID`);

--
-- Indexes for table `dbevents`
--
ALTER TABLE `dbevents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dbpersonhours`
--
ALTER TABLE `dbpersonhours`
  ADD KEY `FkpersonID2` (`personID`),
  ADD KEY `FKeventID3` (`eventID`);

--
-- Indexes for table `dbpersons`
--
ALTER TABLE `dbpersons`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dbanimals`
--
ALTER TABLE `dbanimals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dbeventmedia`
--
ALTER TABLE `dbeventmedia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dbevents`
--
ALTER TABLE `dbevents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dbeventmedia`
--
ALTER TABLE `dbeventmedia`
  ADD CONSTRAINT `FKeventID2` FOREIGN KEY (`eventID`) REFERENCES `dbevents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dbeventpersons`
--
ALTER TABLE `dbeventpersons`
  ADD CONSTRAINT `FKeventID` FOREIGN KEY (`eventID`) REFERENCES `dbevents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKpersonID` FOREIGN KEY (`userID`) REFERENCES `dbpersons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dbpersonhours`
--
ALTER TABLE `dbpersonhours`
  ADD CONSTRAINT `FKeventID3` FOREIGN KEY (`eventID`) REFERENCES `dbevents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FkpersonID2` FOREIGN KEY (`personID`) REFERENCES `dbpersons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Database: `note_app`
--
CREATE DATABASE IF NOT EXISTS `note_app` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `note_app`;

-- --------------------------------------------------------

--
-- Table structure for table `chech`
--

CREATE TABLE `chech` (
  `journel` date NOT NULL,
  `body` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chech`
--

INSERT INTO `chech` (`journel`, `body`) VALUES
('2002-11-23', 'this is a check in today went well I completed all needed things to do'),
('2025-02-14', 'AHHHHHHHHHHHH beees'),
('2222-11-14', 'today went well');

-- --------------------------------------------------------

--
-- Table structure for table `check`
--

CREATE TABLE `check` (
  `journel` date NOT NULL,
  `body` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daily_tasks`
--

CREATE TABLE `daily_tasks` (
  `name` varchar(100) NOT NULL,
  `last_completed` date NOT NULL,
  `disc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daily_tasks`
--

INSERT INTO `daily_tasks` (`name`, `last_completed`, `disc`) VALUES
('brush teeth', '2025-02-02', 'brush and floss'),
('dfsfdds', '0000-00-00', 'fdsadfadfd'),
('shower', '2025-02-03', 'take a shower'),
('tash', '0000-00-00', 'tasking things'),
('tashs', '0000-00-00', 'tasks'),
('task', '0000-00-00', 'date');

-- --------------------------------------------------------

--
-- Table structure for table `dbanimals`
--

CREATE TABLE `dbanimals` (
  `id` int(11) NOT NULL,
  `odhs_id` varchar(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `breed` varchar(256) DEFAULT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `spay_neuter_done` varchar(3) NOT NULL,
  `spay_neuter_date` date DEFAULT NULL,
  `rabies_given_date` date NOT NULL,
  `rabies_due_date` date DEFAULT NULL,
  `heartworm_given_date` date NOT NULL,
  `heartworm_due_date` date DEFAULT NULL,
  `distemper1_given_date` date NOT NULL,
  `distemper1_due_date` date DEFAULT NULL,
  `distemper2_given_date` date NOT NULL,
  `distemper2_due_date` date DEFAULT NULL,
  `distemper3_given_date` date NOT NULL,
  `distemper3_due_date` date DEFAULT NULL,
  `microchip_done` varchar(3) NOT NULL,
  `archived` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dbanimals`
--

INSERT INTO `dbanimals` (`id`, `odhs_id`, `name`, `breed`, `age`, `gender`, `notes`, `spay_neuter_done`, `spay_neuter_date`, `rabies_given_date`, `rabies_due_date`, `heartworm_given_date`, `heartworm_due_date`, `distemper1_given_date`, `distemper1_due_date`, `distemper2_given_date`, `distemper2_due_date`, `distemper3_given_date`, `distemper3_due_date`, `microchip_done`, `archived`) VALUES
(1, '1234', 'Noodle', 'Schnoodle', 5, 'female', '', 'yes', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'no', 'no'),
(2, '43221', 'Cin', 'Poodle', 18, 'female', ' | Bordetella: 2024-01-24', 'yes', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2024-01-24', '2030-01-24', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'no', 'no'),
(3, '543534', 'Rosie', 'Cat', 9, 'male', '', 'yes', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'no', 'no'),
(4, '890890', 'George', 'Cat', 6, 'female', '', 'yes', '2024-01-05', '2024-01-26', '2026-01-02', '0000-00-00', '2024-01-22', '0000-00-00', '2024-01-29', '0000-00-00', '2024-01-24', '0000-00-00', '2024-01-25', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `dbcsgapplication`
--

CREATE TABLE `dbcsgapplication` (
  `csgApplicationID` int(11) NOT NULL,
  `reasonToBecomeCSG` text NOT NULL,
  `whyIsNowRightTime` text NOT NULL,
  `statusInRecoveryJourney` text NOT NULL,
  `screenerName` text NOT NULL,
  `screeningDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dbeventmedia`
--

CREATE TABLE `dbeventmedia` (
  `id` int(11) NOT NULL,
  `eventID` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `type` text NOT NULL,
  `file_format` text NOT NULL,
  `description` text NOT NULL,
  `altername_name` text NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dbeventpersons`
--

CREATE TABLE `dbeventpersons` (
  `eventID` int(11) NOT NULL,
  `userID` varchar(256) NOT NULL,
  `position` text NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dbeventpersons`
--

INSERT INTO `dbeventpersons` (`eventID`, `userID`, `position`, `notes`) VALUES
(30, 'test', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(31, 'test', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(29, 'someInfo2', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(28, 'username', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(28, 'lucy', 'v', ''),
(29, 'fredastaire', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(64, 'test', 'v', 'Skills: no | Dietary restrictions: no | Disabilities: no | Materials: no'),
(36, 'username', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(71, 'test', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(72, 'test', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(64, 'fredastaire', 'v', 'Skills: Dance | Dietary restrictions:  | Disabilities:  | Materials: Cookies'),
(71, 'fredastaire', 'v', ''),
(71, 'lucy', 'v', ''),
(75, 'lucy', 'v', ''),
(64, 'vmsroot', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(36, 'fredastaire', 'v', 'Skills: Tap dancer (films include Top Hat and Shall We Dance) | Dietary restrictions:  | Disabilities:  | Materials: Tap shoes'),
(73, 'vmsroot', 'v', 'Skills: Baking | Dietary restrictions:  | Disabilities:  | Materials: Marmalade and toast'),
(36, 'morgan', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(36, 'charles', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(64, 'charles', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(79, 'charles', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(70, 'lucy', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: Marmalade and toast'),
(70, 'vmsroot', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials:'),
(78, 'charles', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials:'),
(79, 'testuser', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(82, 'testuser', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(83, 'testuser', 'v', 'Skills: No | Dietary restrictions: No | Disabilities: No | Materials: No'),
(97, 'morgan', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(81, 'charles', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: '),
(73, 'fredastaire', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials: Cookies'),
(101, 'stepvainc@gmail.com', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials:'),
(101, 'StrawberryJade', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials:'),
(101, 'SaraDowd', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials:'),
(101, 'ebrenna2', 'v', 'Skills:  | Dietary restrictions:  | Disabilities:  | Materials:'),
(100, 'vmsroot', 'v', 'Skills: None | Dietary restrictions: None | Disabilities: None | Materials: None');

-- --------------------------------------------------------

--
-- Table structure for table `dbevents`
--

CREATE TABLE `dbevents` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `date` char(10) NOT NULL,
  `startTime` char(5) NOT NULL,
  `endTime` char(5) NOT NULL,
  `description` text NOT NULL,
  `capacity` int(11) NOT NULL,
  `completed` text NOT NULL,
  `event_type` text NOT NULL,
  `restricted_signup` tinyint(1) NOT NULL,
  `location` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dbevents`
--

INSERT INTO `dbevents` (`id`, `name`, `date`, `startTime`, `endTime`, `description`, `capacity`, `completed`, `event_type`, `restricted_signup`, `location`) VALUES
(28, 'Thanksgiving Feast', '2024-11-28', '', '23:59', 'There is so much to give thanks for!', 0, 'no', '', 1, NULL),
(29, 'Tuesdays with the Troubadours', '2024-11-26', '', '23:59', 'The Troubadours are live!', 0, 'no', '', 0, NULL),
(30, 'Hogwarts Festival', '2024-11-23', '', '23:59', 'Hello', 0, 'no', '', 0, 'Hogwarts'),
(31, 'Sing Together!', '2024-11-23', '', '23:59', 'aoeiaoei', 0, 'no', '', 0, NULL),
(36, 'Daytime Yoga', '2024-12-17', '11:00', '12:00', 'Weekly event', 25, 'no', '', 0, 'STEP VA Studio'),
(47, 'Finding Nemo Jr Audition Track', '2025-01-02', '18:00', '20:00', '(ages 10+)', 30, 'no', '', 0, 'Riverside First Church of God'),
(64, 'Christmas Cookie Party', '2024-12-14', '16:00', '18:00', 'Bring your favorite cookie recipe to share!', 0, 'yes', '', 0, NULL),
(69, 'Finding Nemo Jr: Tech Classes', '2025-01-07', '18:00', '20:00', 'ages 13+', 12, 'no', '', 1, 'STEP VA Studio: 3328 Bourbon Street'),
(70, 'Rolex Paris Masters', '2024-12-25', '13:00', '15:00', 'Testing testing 123', 99, 'no', '', 1, 'Location'),
(71, 'Christmas Party', '2024-12-22', '18:00', '21:00', 'Welcome!', 100, 'no', '', 1, 'Palace'),
(72, 'Awesome Event 2024', '2024-12-05', '13:00', '17:00', 'This is the most awesome event of 2024!', 50, 'no', '', 0, 'UMW'),
(73, 'Finding Nemo Jr.', '2025-07-19', '17:00', '18:30', 'Come and see the children perform!', 100, 'no', '', 1, 'Step VA headquarters'),
(75, 'The Spotsylvanians', '2024-12-14', '19:00', '21:00', 'The Spotsylvanians Present A Hometown Holiday', 100, 'no', '', 1, 'Riverbend High School 12301 Spotswood Furnace Road Fredericksburg'),
(76, 'Fred&#039;s Piano Recital', '2024-12-14', '18:00', '21:00', 'Come hear Fred play piano!', 99, 'no', '', 0, 'StepVA Headquarters'),
(78, 'Costume making', '2024-12-23', '12:00', '17:00', 'Costume making', 10, 'no', '', 1, 'location'),
(79, 'Singing lessons', '2024-12-22', '12:00', '17:00', 'Singing Lessons', 10, 'no', '', 0, 'Location'),
(80, 'Arts and Crafts', '2024-12-11', '12:00', '17:00', 'Awesome!', 10, 'no', '', 0, 'location'),
(81, 'Dancing lessons', '2024-12-18', '12:00', '17:00', 'dancing lessons!', 10, 'no', '', 0, 'location'),
(82, 'Tree Ceremony', '2024-12-10', '21:30', '22:00', 'Come light a Christmas Tree downtown!', 2, 'no', '', 0, ''),
(83, 'Step VA Presentation', '2024-12-11', '09:00', '13:00', 'TADA!!!', 4, 'no', '', 0, 'Tada'),
(87, 'Christmas Tree Lighting', '2024-12-14', '07:00', '18:00', 'We&#039;re going to light the Christmas tree!', 99, 'no', '', 0, 'Stafford Square'),
(89, 'Tuesdays with the Troubadours: Christmas with the Troubadours', '2024-12-17', '09:00', '12:00', 'The Troubadours are live! Come celebrate Christmas!', 99, 'no', '', 0, 'Virtual Online'),
(92, 'CandyLand Game Night', '2024-12-12', '07:00', '12:00', 'Let&#039;s play CandyLand!', 15, 'no', '', 0, 'STEP VA Studio: 3328 Bourbon Street'),
(94, 'Gary_Young_Resume_Policy.pdf', '2024-12-26', '00:00', '00:01', 'ABC', 8, 'no', '', 0, ''),
(97, 'Test', '2024-12-12', '12:00', '13:00', 'Test', 1, 'no', '', 0, 'Test'),
(98, 'Rolex Paris Masters', '2024-12-11', '15:42', '18:00', 'Testing testing 123', 4, 'no', '', 0, 'Location'),
(99, 'Christmas Wrapping Event', '2025-02-05', '15:45', '18:00', 'hot', 3, 'no', '', 0, 'Location'),
(100, 'Finding Nemo', '2025-02-15', '17:30', '20:00', 'approved volunteers', 15, 'no', '', 1, ''),
(101, 'Finding Nemo Rehearsal', '2025-01-23', '17:30', '20:00', 'rehearsal', 20, 'no', '', 1, 'Riverside First Church of God 3461 Fall Hill Ave. Fredericksburg 22401'),
(103, 'Finding Nemo Rehearsal', '2025-01-30', '17:30', '20:00', 'rehearsal', 20, 'no', '', 1, 'Riverside First Church of God 3461 Fall Hill Ave. Fredericksburg 22401'),
(104, 'Finding Nemo Rehearsal', '2025-02-06', '17:30', '20:00', 'rehearsal', 20, 'no', '', 1, 'Riverside First Church of God 3461 Fall Hill Ave. Fredericksburg 22401'),
(105, 'Finding Nemo Rehearsal', '2025-03-27', '17:30', '20:00', 'rehearsal', 20, 'no', '', 1, 'Riverside First Church of God 3461 Fall Hill Ave. Fredericksburg 22401'),
(106, 'Finding Nemo Rehearsal', '2025-03-20', '17:30', '20:00', 'rehearsal', 20, 'no', '', 1, 'Riverside First Church of God 3461 Fall Hill Ave. Fredericksburg 22401'),
(107, 'visa', '2025-02-02', '12:00', '13:00', 'dqdwec', 60, 'no', '', 1, 'vwvw'),
(108, 'jninjn', '2025-02-13', '12:00', '13:00', 'ijnoi', 1, 'no', '', 1, 'noin'),
(109, 'Test', '2025-02-13', '13:00', '14:30', 'This is a test event', 99, 'no', '', 0, 'Fredericksburg, VA');

-- --------------------------------------------------------

--
-- Table structure for table `dbf2fapplication`
--

CREATE TABLE `dbf2fapplication` (
  `f2fApplicationID` int(11) NOT NULL,
  `reasonToBecomeF2F` text NOT NULL,
  `whyIsNowRightTime` text NOT NULL,
  `screenerName` text NOT NULL,
  `screeningDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dbfsgapplication`
--

CREATE TABLE `dbfsgapplication` (
  `fsgApplicationID` int(11) NOT NULL,
  `reasonToBecomeFSG` text NOT NULL,
  `whyIsNowRightTime` text NOT NULL,
  `screenerName` text NOT NULL,
  `screeningDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dbhfapplication`
--

CREATE TABLE `dbhfapplication` (
  `hfApplicationID` int(11) NOT NULL,
  `reasonToBecomeHF` text NOT NULL,
  `whyIsNowRightTime` text NOT NULL,
  `screenerName` text NOT NULL,
  `screeningDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dbioovapplication`
--

CREATE TABLE `dbioovapplication` (
  `ioovApplicationID` int(11) NOT NULL,
  `reasonToBecomeIOOV` text NOT NULL,
  `whyIsNowRightTime` text NOT NULL,
  `statusInRecoveryJourney` text NOT NULL,
  `screenerName` text NOT NULL,
  `screeningDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dbmessages`
--

CREATE TABLE `dbmessages` (
  `id` int(11) NOT NULL,
  `senderID` varchar(256) NOT NULL,
  `recipientID` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `body` text NOT NULL,
  `time` varchar(16) NOT NULL,
  `wasRead` tinyint(1) NOT NULL DEFAULT 0,
  `prioritylevel` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dbmessages`
--

INSERT INTO `dbmessages` (`id`, `senderID`, `recipientID`, `title`, `body`, `time`, `wasRead`, `prioritylevel`) VALUES
(0, 'vmsroot', 'username', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-02-10:19', 0, 0),
(0, 'vmsroot', 'vmsroot', 'username requested to sign up for a restricted event', 'username requested to sign up for restricted event notification test. Please review.', '2024-12-02-10:19', 1, 0),
(0, 'vmsroot', 'username', 'Your sign-up has been approved.', 'Thank you for signing up for notification testing (unrestricted)!', '2024-12-02-10:19', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-02-11:15', 0, 0),
(0, 'vmsroot', 'vmsroot', 'fredastaire requested to sign up for a restricted event', 'fredastaire requested to sign up for restricted event notification test. Please review.', '2024-12-02-11:15', 1, 0),
(0, 'vmsroot', 'someInfo2', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-02-16:06', 0, 0),
(0, 'vmsroot', 'vmsroot', 'someInfo2 requested to sign up for a restricted event', 'someInfo2 requested to sign up for notification testing (restricted). Please review.', '2024-12-02-16:06', 1, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for DO NOT DELETE will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-02-19:22', 0, 0),
(0, 'vmsroot', 'vmsroot', 'fredastaire requested to sign up for a restricted event', 'fredastaire requested to sign up for DO NOT DELETE. Please review.', '2024-12-02-19:22', 1, 0),
(0, 'vmsroot', 'morgan', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Rolex Paris Masters will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-02-20:31', 0, 0),
(0, 'vmsroot', 'vmsroot', 'morgan requested to sign up for a restricted event', 'morgan requested to sign up for Rolex Paris Masters. Please review.', '2024-12-02-20:31', 1, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-02-21:01', 0, 0),
(0, 'vmsroot', 'vmsroot', 'fredastaire requested to sign up for a restricted event', 'fredastaire requested to sign up for restricted event notification test. Please review.', '2024-12-02-21:01', 1, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-02-21:05', 0, 0),
(0, 'vmsroot', 'vmsroot', 'fredastaire requested to sign up for a restricted event', 'fredastaire requested to sign up for Christmas Party. Please review.', '2024-12-02-21:05', 1, 0),
(0, 'vmsroot', 'morgan', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Cookie Party!', '2024-12-02-21:09', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Cookie Party!', '2024-12-02-21:11', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-02:08', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-02:08', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-02:13', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-02:13', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-02:18', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-02:18', 1, 0),
(0, 'vmsroot', 'test', 'Your sign-up has been approved.', 'Thank you for signing up for notification testing (restricted)!', '2024-12-04-02:40', 0, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-02:42', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-02:42', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-02:44', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-02:44', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-02:46', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-02:46', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-02:54', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-02:54', 1, 0),
(0, 'vmsroot', 'username', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-03:04', 0, 0),
(0, 'vmsroot', 'vmsroot', 'username requested to sign up for a restricted event', 'username requested to sign up for restricted event notification test. Please review.', '2024-12-04-03:04', 1, 0),
(0, 'vmsroot', 'username', 'Your sign-up has been approved.', 'Thank you for signing up for Test!', '2024-12-04-03:05', 0, 0),
(0, 'vmsroot', 'username', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-03:05', 0, 0),
(0, 'vmsroot', 'vmsroot', 'username requested to sign up for a restricted event', 'username requested to sign up for Christmas Party. Please review.', '2024-12-04-03:05', 1, 0),
(0, 'vmsroot', 'test', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Party!', '2024-12-04-03:08', 0, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-03:09', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for restricted event notification test. Please review.', '2024-12-04-03:09', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for DO NOT DELETE will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-03:09', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for DO NOT DELETE. Please review.', '2024-12-04-03:09', 1, 0),
(0, 'vmsroot', 'test', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-03:15', 0, 0),
(0, 'vmsroot', 'vmsroot', 'test requested to sign up for a restricted event', 'test requested to sign up for notification testing (restricted). Please review.', '2024-12-04-03:15', 1, 0),
(0, 'vmsroot', 'test', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-04-03:20', 0, 0),
(0, 'vmsroot', 'test', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-04-03:23', 0, 0),
(0, 'vmsroot', 'test', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-04-03:41', 0, 0),
(0, 'vmsroot', 'someInfo2', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-04-05:16', 0, 0),
(0, 'vmsroot', 'someInfo2', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-04-05:17', 0, 0),
(0, 'vmsroot', 'someInfo2', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-04-05:17', 0, 0),
(0, 'vmsroot', 'someInfo2', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for AHHHH will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-04-09:16', 0, 0),
(0, 'vmsroot', 'vmsroot', 'someInfo2 requested to sign up for a restricted event', 'someInfo2 requested to sign up for AHHHH. Please review.', '2024-12-04-09:16', 1, 0),
(0, 'vmsroot', 'someInfo2', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-04-09:22', 0, 0),
(0, 'vmsroot', 'lucy', 'Your sign-up has been approved.', 'Thank you for signing up for restricted event notification test!', '2024-12-04-11:26', 0, 0),
(0, 'vmsroot', 'vmsroot', 'username cancelled their sign up for Christmas Party', 'username cancelled their sign up for Christmas Party', '2024-12-04-13:38', 1, 0),
(0, 'vmsroot', 'vmsroot', 'username cancelled their sign up for restricted event notification test', 'username cancelled their sign up for restricted event notification test', '2024-12-04-13:38', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Awesome Event 2024!', '2024-12-05-14:12', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Cookie Party!', '2024-12-05-18:26', 1, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-05-18:27', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-05-18:30', 0, 0),
(0, 'vmsroot', 'lucy', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-05-18:57', 0, 0),
(0, 'vmsroot', 'username', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for cool event will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-07-12:31', 0, 0),
(0, 'vmsroot', 'lucy', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for The Spotsylvanians will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-13:28', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-16:57', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-16:59', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for AHHHH will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-17:22', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for cool event will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-17:37', 1, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-18:56', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for DO NOT DELETE will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-18:58', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Cookie Party!', '2024-12-09-18:59', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for s!', '2024-12-09-19:01', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for restricted event notification test!', '2024-12-09-19:12', 1, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-19:13', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your sign-up has been approved.', 'Thank you for signing up for restricted event notification test!', '2024-12-09-19:18', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-19:19', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for notification testing (restricted) will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-19:37', 0, 0),
(0, 'vmsroot', 'test', 'Your sign-up has been approved.', 'Thank you for signing up for notification testing (unrestricted)!', '2024-12-09-19:39', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your sign-up has been approved.', 'Thank you for signing up for notification testing (restricted)!', '2024-12-09-19:42', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for restricted event notification test will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-19:42', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for restricted event notification test!', '2024-12-09-19:46', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for AHHHH!', '2024-12-09-19:47', 1, 0),
(0, 'vmsroot', 'fredastaire', 'Your sign-up has been approved.', 'Thank you for signing up for Test!', '2024-12-09-19:47', 0, 0),
(0, 'vmsroot', 'fredastaire', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Finding Nemo Jr. will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-19:48', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Finding Nemo Jr.!', '2024-12-09-19:49', 1, 0),
(0, 'vmsroot', 'someInfo2', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for AHHHH will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-20:30', 0, 0),
(0, 'vmsroot', 'morgan', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for New Years Day Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-20:31', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event signup has been approved', 'You are now signed up for Array. Congratulations!', '2024-12-09-20:41', 1, 0),
(0, 'vmsroot', 'testuser', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for New Years Day Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-20:42', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for New Years Day Party!', '2024-12-09-20:42', 1, 0),
(0, 'vmsroot', 'testuser', 'Your restricted event signup has been approved', 'You are now signed up for Array. Congratulations!', '2024-12-09-20:43', 0, 0),
(0, 'vmsroot', 'lucy', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for New Years Day Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-20:43', 0, 0),
(0, 'vmsroot', 'vmsroot', 'morgan cancelled their sign up for New Years Day Party', 'morgan cancelled their sign up for New Years Day Party', '2024-12-09-20:44', 1, 0),
(0, 'vmsroot', 'testuser', 'Your sign-up has been approved.', 'Thank you for signing up for New Years Day Party!', '2024-12-09-20:45', 0, 0),
(0, 'vmsroot', 'vmsroot', 'testuser cancelled their sign up for New Years Day Party', 'testuser cancelled their sign up for New Years Day Party', '2024-12-09-20:46', 1, 0),
(0, 'vmsroot', 'testuser', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Party!', '2024-12-09-20:46', 0, 0),
(0, 'vmsroot', 'vmsroot', 'testuser cancelled their sign up for Christmas Party', 'testuser cancelled their sign up for Christmas Party', '2024-12-09-20:46', 1, 0),
(0, 'vmsroot', 'vmsroot', 'testuser cancelled their sign up for Monday Morning', 'testuser cancelled their sign up for Monday Morning', '2024-12-09-20:46', 1, 0),
(0, 'vmsroot', 'testuser', 'Your sign-up has been approved.', 'Thank you for signing up for New Years Day Party!', '2024-12-09-20:47', 0, 0),
(0, 'vmsroot', 'morgan', 'Your sign-up has been approved.', 'Thank you for signing up for Daytime Yoga!', '2024-12-09-20:47', 0, 0),
(0, 'vmsroot', 'vmsroot', 'morgan cancelled their sign up for Christmas Cookie Party', 'morgan cancelled their sign up for Christmas Cookie Party', '2024-12-09-20:47', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Party!', '2024-12-09-20:49', 1, 0),
(0, 'vmsroot', 'lucy', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Rolex Paris Masters will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-20:51', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Rolex Paris Masters!', '2024-12-09-21:03', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Rolex Paris Masters will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-21:05', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Rolex Paris Masters!', '2024-12-09-21:05', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Rolex Paris Masters!', '2024-12-09-21:06', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Rolex Paris Masters will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-09-21:10', 1, 0),
(0, 'vmsroot', 'charles', 'Your sign-up has been approved.', 'Thank you for signing up for Daytime Yoga!', '2024-12-10-13:35', 1, 0),
(0, 'vmsroot', 'charles', 'Your sign-up has been approved.', 'Thank you for signing up for Finding Nemo Jr Audition Track!', '2024-12-10-13:36', 1, 0),
(0, 'vmsroot', 'charles', 'Your sign-up has been approved.', 'Thank you for signing up for Christmas Cookie Party!', '2024-12-10-13:36', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your sign-up has been approved.', 'Thank you for signing up for Rolex Paris Masters!', '2024-12-10-17:11', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your restricted event sign-up has sent to an admin.', 'Your request to sign up for Rolex Paris Masters will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-10-17:40', 1, 0),
(0, 'vmsroot', 'charles', 'Your sign-up has been approved.', 'Thank you for signing up for Arts and Crafts!', '2024-12-10-18:45', 1, 0),
(0, 'vmsroot', 'charles', 'You are now signed up for Singing lessons!', 'Thank you for signing up for Singing lessons!', '2024-12-10-18:52', 1, 0),
(0, 'vmsroot', 'charles', 'Your request to sign up for Costume making has been sent to an admin.', 'Your request to sign up for Costume making will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-10-19:16', 1, 0),
(0, 'vmsroot', 'vmsroot', 'charles cancelled their sign up for Finding Nemo Jr Audition Track', 'charles cancelled their sign up for Finding Nemo Jr Audition Track', '2024-12-10-19:33', 1, 0),
(0, 'vmsroot', 'charles', 'Your request to sign up for The Spotsylvanians has been sent to an admin.', 'Your request to sign up for The Spotsylvanians will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-10-19:57', 1, 0),
(0, 'vmsroot', 'charles', 'You are now signed up for Dancing lessons!', 'Thank you for signing up for Dancing lessons!', '2024-12-10-20:03', 1, 0),
(0, 'vmsroot', 'vmsroot', 'charles cancelled their sign up for Dancing lessons', 'charles cancelled their sign up for Dancing lessons', '2024-12-10-20:04', 1, 0),
(0, 'vmsroot', 'charles', 'Your request to sign up for Finding Nemo Jr: Tech Classes has been sent to an admin.', 'Your request to sign up for Finding Nemo Jr: Tech Classes will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-10-20:06', 1, 0),
(0, 'vmsroot', 'charles', 'Your request to sign up for Rolex Paris Masters has been sent to an admin.', 'Your request to sign up for Rolex Paris Masters will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-10-20:15', 1, 0),
(0, 'vmsroot', 'vmsroot', 'charles cancelled their sign up for Arts and Crafts', 'charles cancelled their sign up for Arts and Crafts', '2024-12-10-20:20', 1, 0),
(0, 'vmsroot', 'charles', 'Your sign up for Arts and Crafts has been cancelled.', 'charles cancelled their sign up for Arts and Crafts', '2024-12-10-20:20', 1, 0),
(0, 'vmsroot', 'testuser', 'You are now signed up for Christmas Party!', 'Thank you for signing up for Christmas Party!', '2024-12-10-20:58', 0, 0),
(0, 'vmsroot', 'testuser', 'Your request to sign up for Christmas Party has been sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-10-21:07', 0, 0),
(0, 'vmsroot', 'vmsroot', 'testuser cancelled their sign up for New Years Day Party', 'testuser cancelled their sign up for New Years Day Party', '2024-12-10-21:08', 1, 0),
(0, 'vmsroot', 'testuser', 'Your sign up for New Years Day Party has been cancelled.', 'testuser cancelled their sign up for New Years Day Party', '2024-12-10-21:08', 0, 0),
(0, 'vmsroot', 'testuser', 'You are now signed up for Singing lessons!', 'Thank you for signing up for Singing lessons!', '2024-12-10-21:08', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your request to sign up for New Years Day Party has been sent to an admin.', 'Your request to sign up for New Years Day Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-10-21:10', 1, 0),
(0, 'vmsroot', 'testuser', 'You are now signed up for Tree Ceremony!', 'Thank you for signing up for Tree Ceremony!', '2024-12-10-21:29', 0, 0),
(0, 'vmsroot', 'testuser', 'You are now signed up for Step VA Presentation!', 'Thank you for signing up for Step VA Presentation!', '2024-12-11-03:22', 0, 0),
(0, 'vmsroot', 'testuser', 'Your request to sign up for Christmas Party has been sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-11-03:36', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your request to sign up for Christmas Party has been sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-11-03:41', 1, 0),
(0, 'vmsroot', 'testuser', 'Your restricted event signup has been approved', 'You are now signed up for Christmas Party. Congratulations!', '2024-12-11-03:41', 0, 0),
(0, 'vmsroot', 'vmsroot', 'Your request to sign up for Christmas Party has been sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-11-03:41', 1, 0),
(0, 'vmsroot', 'testuser', 'Your sign-up for Christmas Party has been denied.', 'Your sign up for Christmas Party has been denied.', '2024-12-11-03:43', 0, 0),
(0, 'vmsroot', 'testuser', 'Your request to sign up for Christmas Party has been sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-11-03:43', 0, 0),
(0, 'vmsroot', 'morgan', 'You are now signed up for Test!', 'Thank you for signing up for Test!', '2024-12-11-15:41', 0, 0),
(0, 'vmsroot', 'charles', 'You are now signed up for Dancing lessons!', 'Thank you for signing up for Dancing lessons!', '2024-12-11-16:26', 1, 0),
(0, 'vmsroot', 'charles', 'Your request to sign up for Christmas Party has been sent to an admin.', 'Your request to sign up for Christmas Party will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2024-12-11-16:26', 1, 0),
(0, 'vmsroot', 'polack@umw.edu', 'You are now signed up for Gary_Young_Resume_NSWCDD.pdf!', 'Thank you for signing up for Gary_Young_Resume_NSWCDD.pdf!', '2025-01-14-13:34', 1, 0),
(0, 'vmsroot', 'stepvainc@gmail.com', 'Your request to sign up for Finding Nemo Rehearsal has been sent to an admin.', 'Your request to sign up for Finding Nemo Rehearsal will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2025-01-20-16:17', 1, 0),
(0, 'vmsroot', 'stepvainc@gmail.com', 'Your restricted event signup has been approved', 'You are now signed up for Finding Nemo Rehearsal. Congratulations!', '2025-01-20-16:21', 0, 0),
(0, 'vmsroot', 'SaraDowd', 'Your request to sign up for Finding Nemo Rehearsal has been sent to an admin.', 'Your request to sign up for Finding Nemo Rehearsal will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2025-01-20-18:58', 1, 0),
(0, 'vmsroot', 'StrawberryJade', 'Your request to sign up for Finding Nemo Rehearsal has been sent to an admin.', 'Your request to sign up for Finding Nemo Rehearsal will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2025-01-21-12:11', 1, 0),
(0, 'vmsroot', 'ebrenna2', 'Your request to sign up for Finding Nemo Rehearsal has been sent to an admin.', 'Your request to sign up for Finding Nemo Rehearsal will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2025-02-03-12:19', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your request to sign up for Finding Nemo has been sent to an admin.', 'Your request to sign up for Finding Nemo will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2025-02-07-15:39', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your request to sign up for jninjn has been sent to an admin.', 'Your request to sign up for jninjn will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2025-02-07-16:05', 1, 0),
(0, 'vmsroot', 'vmsroot', 'Your request to sign up for Finding Nemo Rehearsal has been sent to an admin.', 'Your request to sign up for Finding Nemo Rehearsal will be reviewed by an admin shortly. You will get another notification when you get approved or denied.', '2025-02-07-16:06', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dbp2papplication`
--

CREATE TABLE `dbp2papplication` (
  `p2pApplicationID` int(11) NOT NULL,
  `reasonToBecomeP2P` text NOT NULL,
  `whyIsNowRightTime` text NOT NULL,
  `statusInRecoveryJourney` text NOT NULL,
  `screenerName` text NOT NULL,
  `screeningDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dbpendingsignups`
--

CREATE TABLE `dbpendingsignups` (
  `username` varchar(25) NOT NULL,
  `eventname` varchar(100) NOT NULL,
  `role` varchar(5) NOT NULL,
  `notes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dbpendingsignups`
--

INSERT INTO `dbpendingsignups` (`username`, `eventname`, `role`, `notes`) VALUES
('vmsroot', '108', 'v', 'Skills: non | Dietary restrictions: ojnjo | Disabilities: jonoj | Materials: knock'),
('vmsroot', '101', 'v', 'Skills: rvwav | Dietary restrictions: varv | Disabilities: var | Materials: arv');

-- --------------------------------------------------------

--
-- Table structure for table `dbpersonhours`
--

CREATE TABLE `dbpersonhours` (
  `personID` varchar(256) NOT NULL,
  `eventID` int(11) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dbpersonhours`
--

INSERT INTO `dbpersonhours` (`personID`, `eventID`, `start_time`, `end_time`) VALUES
('test', 31, '2024-11-23 22:00:00', '2024-11-23 23:00:00'),
('test', 30, '2024-11-23 23:00:00', '2024-11-24 00:30:00'),
('test', 30, '2024-11-23 20:05:00', '2024-11-23 20:10:00'),
('test', 72, '2024-12-05 19:20:00', '2024-12-05 20:40:00'),
('test', 72, '2024-12-05 20:21:07', '2024-12-05 20:56:24'),
('test', 72, '2024-12-05 21:00:00', '2024-12-05 22:30:00'),
('test', 31, '2024-11-23 23:30:00', '2024-11-24 01:00:00'),
('testuser', 82, '2024-12-11 03:29:00', '2024-12-11 04:00:00'),
('testuser', 83, '2024-12-11 15:30:00', '2024-12-11 16:00:00'),
('testuser', 83, '2024-12-11 22:05:43', '2024-12-11 22:05:46'),
('testuser', 83, '2024-12-11 22:16:44', '2024-12-11 22:16:49'),
('testuser', 83, '2024-12-11 22:48:00', '2024-12-11 23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `dbpersons`
--

CREATE TABLE `dbpersons` (
  `id` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` text DEFAULT NULL,
  `venue` text DEFAULT NULL,
  `first_name` text NOT NULL,
  `last_name` text DEFAULT NULL,
  `street_address` text DEFAULT NULL,
  `city` text DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zip_code` text DEFAULT NULL,
  `phone1` varchar(12) NOT NULL,
  `phone1type` text DEFAULT NULL,
  `emergency_contact_phone` varchar(12) DEFAULT NULL,
  `emergency_contact_phone_type` text DEFAULT NULL,
  `birthday` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `emergency_contact_first_name` text NOT NULL,
  `contact_num` varchar(12) NOT NULL,
  `emergency_contact_relation` text NOT NULL,
  `contact_method` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `profile_pic` text NOT NULL,
  `gender` varchar(6) NOT NULL,
  `tshirt_size` text NOT NULL,
  `how_you_heard_of_stepva` text NOT NULL,
  `sensory_sensitivities` text NOT NULL,
  `disability_accomodation_needs` text NOT NULL,
  `school_affiliation` text NOT NULL,
  `race` text NOT NULL,
  `preferred_feedback_method` text NOT NULL,
  `hobbies` text NOT NULL,
  `professional_experience` text NOT NULL,
  `archived` tinyint(1) NOT NULL,
  `emergency_contact_last_name` text NOT NULL,
  `photo_release` text NOT NULL,
  `photo_release_notes` text NOT NULL,
  `training_complete` int(11) NOT NULL DEFAULT 0,
  `training_date` text NOT NULL,
  `orientation_complete` int(11) NOT NULL DEFAULT 0,
  `orientation_date` text NOT NULL,
  `background_complete` int(11) NOT NULL DEFAULT 0,
  `background_date` text NOT NULL,
  `activatePayingNamiAffiliate` tinyint(1) NOT NULL,
  `ifNotAreWilling` tinyint(1) NOT NULL,
  `choiceNamiAffiliate` text NOT NULL,
  `familyWithMentalillnes` tinyint(1) NOT NULL,
  `comfortableReadingAloud` tinyint(1) NOT NULL,
  `willingToCompleteTraining` tinyint(1) NOT NULL,
  `staminaToCompleteCourse` tinyint(1) NOT NULL,
  `supportSystemToHelp` tinyint(1) NOT NULL,
  `computerAccess` tinyint(1) NOT NULL,
  `acknowledge_commitment` tinyint(1) NOT NULL,
  `pathOfRecovery` tinyint(1) NOT NULL,
  `involvementInNami` text NOT NULL,
  `anyAccessibilityNeeds` text NOT NULL,
  `f2fApplicationID` int(11) NOT NULL,
  `p2pApplicationID` int(11) NOT NULL,
  `ioovApplicationID` int(11) NOT NULL,
  `fsgApplicationID` int(11) NOT NULL,
  `csgApplicationID` int(11) NOT NULL,
  `hfApplicationID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dbpersons`
--

INSERT INTO `dbpersons` (`id`, `start_date`, `venue`, `first_name`, `last_name`, `street_address`, `city`, `state`, `zip_code`, `phone1`, `phone1type`, `emergency_contact_phone`, `emergency_contact_phone_type`, `birthday`, `email`, `emergency_contact_first_name`, `contact_num`, `emergency_contact_relation`, `contact_method`, `type`, `status`, `notes`, `password`, `profile_pic`, `gender`, `tshirt_size`, `how_you_heard_of_stepva`, `sensory_sensitivities`, `disability_accomodation_needs`, `school_affiliation`, `race`, `preferred_feedback_method`, `hobbies`, `professional_experience`, `archived`, `emergency_contact_last_name`, `photo_release`, `photo_release_notes`, `training_complete`, `training_date`, `orientation_complete`, `orientation_date`, `background_complete`, `background_date`, `activatePayingNamiAffiliate`, `ifNotAreWilling`, `choiceNamiAffiliate`, `familyWithMentalillnes`, `comfortableReadingAloud`, `willingToCompleteTraining`, `staminaToCompleteCourse`, `supportSystemToHelp`, `computerAccess`, `acknowledge_commitment`, `pathOfRecovery`, `involvementInNami`, `anyAccessibilityNeeds`, `f2fApplicationID`, `p2pApplicationID`, `ioovApplicationID`, `fsgApplicationID`, `csgApplicationID`, `hfApplicationID`) VALUES
('aaa', '2024-12-09', 'n/a', 'aaa', 'aaa', 'a', 'a', 'VA', '33333', '1231231233', 'cellphone', '2342342344', 'cellphone', '2001-07-07', 'a@a.a', 'a', 'n/a', 'a', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$5s8HaYX98.3Wlsr7hpiVH.UGtxt0YqSGCrcWFsV5McmiN9wjUZNBu', 'n/a', 'gender', 'xs', '', 'sensory_sensitivities', '', 'a', 'race', 'No preference', '', '', 0, 'a', 'Restricted', 'a', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('Abby Floyd', '2025-01-09', 'n/a', 'Abigail', 'Floyd', '5425 Rainwood Dr', 'Fredericksburg', 'VA', '22407', '5403226396', 'cellphone', '5404290350', 'cellphone', '2008-03-08', 'amfloyd14@icloud.com', 'Melissa', 'n/a', 'Mother', 'n/a', 'v', 'Active', 'n/a', '$2y$10$OreonRBUiYTXffapXDSzN.lt04IVsOrOiQ27UsT1XBZj5IctrXetG', 'n/a', 'gender', 'xl', '', 'sensory_sensitivities', '', 'Courtland Highschool', 'race', 'no-preference', '', '', 0, 'Floyd', 'Not Restricted', 'N/A', 1, '2022-06-11', 1, '2022-06-11', 1, '2022-06-11', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('AbbyGriff', '2025-01-09', 'n/a', 'Abby', 'Griffin', '5417, Holley Oak Lane', 'Fredericksburg', 'VA', '22407', '5406612606', 'cellphone', '5408348825', 'cellphone', '2010-09-01', 'abigailfgriff@gmail.com', 'Pam', 'n/a', 'Mother', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$c901gH6WuN9DgxmwodzOKeOgpdu87OlTTXEvj2/Ejt/SIIZpSc9si', 'n/a', 'gender', 's', 'My sister (Sarah Garner)', 'sensory_sensitivities', 'None', 'Homeschooled', 'race', 'text', 'I know how to run a mic table and can assist with a sound board, I have been in 15 musicals, I am a babysitter, and I know how to spike a stage', 'Yes; I volunteer as a Sunday school assistant.', 0, 'Griffin', 'Not Restricted', 'None', 1, '', 1, '', 1, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('addison_fiore', '2025-01-09', 'n/a', 'Addison', 'Fiore', '10804 Cinnamon Teal Drive', 'Spotsylvania', 'VA', '22553', '5403720591', 'cellphone', '5409031781', 'cellphone', '2007-11-06', 'addisonfiore8@gmail.com', 'Jennifer', 'n/a', 'Mother', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$0QK4ippSoaT/e2VZ3NaG7OcqFJDps2uFz22.1NjJ.iuD7sbuyLUYW', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'Riverbend Highschool', 'race', 'text', '', '', 0, 'Fiore', 'Restricted', 'N/A', 1, '2023-07-11', 1, '2023-07-17', 1, '2023-06-07', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('Amwages13', '2025-01-13', 'n/a', 'Lexi', 'Wages', '3 Rodeo Ct', 'Fredericksburg', 'VA', '22407', '5403599086', 'cellphone', '5402875446', 'cellphone', '2011-11-18', 'leximariewages@gmail.com', 'Laurie', 'n/a', 'Mother', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$PD0TAmsArH3AF79GeiPKuu/t3b2KwoKnixcU2OvDqA/6IjMxEsra.', 'n/a', 'gender', 's', 'Sister', 'sensory_sensitivities', 'No', 'Battlefield Middle', 'race', 'text', 'Crotchet', '', 0, 'Wages', 'Not Restricted', 'N/a', 1, '2024-12-27', 1, '2024-12-27', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('ascrivani3', '2025-01-09', 'n/a', 'Amelia', 'Scrivani', '12565 Spotswood Furnace Rd', 'Fredericksburg', 'VA', '22407', '7185141845', 'cellphone', '7183546470', 'cellphone', '2004-08-09', 'ascrivani3@gmail.com', 'Michele', 'n/a', 'Mother', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$RfIm4IswPvtW656I6h2cR.czd4uCKldaSsKB5zCiw8642lfimAFj.', 'n/a', 'gender', 'm', 'My brother participates in various Step VA activities', 'sensory_sensitivities', '', 'N/A', 'race', 'text', '', 'I have spent many years volunteering with my old elementary school’s annual chorus performance, every year they put on a musical.', 0, 'Scrivani', 'Not Restricted', 'N/A', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('brianna@gmail.com', '2024-01-22', 'portland', 'Brianna', 'Wahl', '212 Latham Road', 'Mineola', 'VA', '11501', '1234567890', 'cellphone', '', '', '2004-04-04', 'brianna@gmail.com', 'Mom', '1234567890', 'Mother', 'text', 'admin', 'Active', '', '$2y$10$jNbMmZwq.1r/5/oy61IRkOSX4PY6sxpYEdWfu9tLRZA6m1NgsxD6m', '', 'Female', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('bum@gmail.com', '2024-01-24', 'portland', 'bum', 'bum', '1345 Strattford St.', 'Mineola', 'VA', '22401', '1234567890', 'home', '', '', '1111-11-11', 'bum@gmail.com', 'Mom', '1234567890', 'Mom', 'text', 'admin', 'Active', '', '$2y$10$Ps8FnZXT7d4uiU/R5YFnRecIRbRakyVtbXP9TVqp7vVpuB3yTXFIO', '', 'Male', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('charles', '2024-12-10', 'n/a', 'Charles', 'Wilt', 'Street Address', 'Fredericksburg', 'VA', '22405', '1231231234', 'cellphone', '1231231234', 'cellphone', '2004-06-15', 'charles@gmail.com', 'Michael', 'n/a', 'Father', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$BhurBvyEs9hTa7sIeZEqHeuE0aAXSGX/CcwMw7y/4dHt0ztL1MjMO', 'n/a', 'gender', 's', '', 'sensory_sensitivities', '', 'N/A', 'race', 'No preference', '', '', 0, 'Wilt', 'Not Restricted', 'N/A', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('christitowle', '2025-01-09', 'n/a', 'Christi', 'Towle', '201 New Hope Church Road', 'Fredericksburg', 'VA', '22405', '8044415060', 'cellphone', '8044415060', 'cellphone', '1972-12-11', 'towlefamily@yahoo.com', 'Jason', 'n/a', 'Spouse', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$QKAHn4eKKL8qgF2gDGjNiektJolio9YlhMByUyLXE.GfJVSygOAli', 'n/a', 'gender', 'm', 'A friend', 'sensory_sensitivities', 'No', 'N/A', 'race', 'No preference', 'gardening, crafts', 'Yes', 0, 'Towle', 'Not Restricted', 'N/A', 0, '', 1, '', 1, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('derp', '2024-12-09', 'n/a', 'a', 'a', 'a', 'a', 'VA', '12323', '1231231234', 'home', '1231231234', 'home', '2024-12-04', 'awe@gmail.com', 'a', 'n/a', 'a', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$gYsD0Y1dwlDK4SZH59VGuOlqu78JwLrSXViebTkX0KxMOQgWIR7c.', 'n/a', 'gender', 's', '', 'sensory_sensitivities', '', 'a', 'race', 'No preference', '', '', 0, 'a', 'Restricted', 'a', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('ebrenna2', '2025-02-03', 'n/a', 'Emma', 'Brennan', '212 Willis St', 'Fredericksburg', 'VA', '22401', '7035099647', 'cellphone', '7032965189', 'cellphone', '2002-09-23', 'em.brenn@yahoo.com', 'Laura', 'n/a', 'Mother', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$3hIpyIl79iyRTb.edM.uEuV8aT9t5v4juO3vXmpcIYULPokjpftKK', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'UMW', 'race', 'No preference', '', '', 0, 'Brennan', 'Not Restricted', 'N/A', 1, '2025-02-03', 1, '2025-02-03', 1, '2025-02-03', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('fredastaire', '2024-11-18', 'n/a', 'Fred', 'Astaire', '11 Dance Avenue', 'Stafford', 'VA', '12345', '1234567890', 'cellphone', '2222222221', 'cellphone', '1899-05-10', 'fredastaire@myemail.com', 'Fred Jr.', 'n/a', 'Son', 'n/a', 'v', 'Active', 'n/a', '$2y$10$VUZObvA3Cy69ykkohegJYevjJU3DFlZbgmfTSPzee7TMPRSMMg9fG', 'n/a', 'gender', 'm', 'A little bird told me.', 'sensory_sensitivities', 'No', 'N/A', 'race', 'email', 'Dance!', 'Yes', 0, 'Astaire', 'Not Restricted', 'N/A', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('jake_demo', '2024-11-24', 'n/a', 'Jake', 'Furman', '1234 Street', 'Fredericksburg', 'VA', '10001', '5555555555', 'cellphone', '4444444444', 'cellphone', '2002-01-31', 'jake@gmail.com', 'Mom', 'n/a', 'Mom', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$UNhNSABqTedXO.fWLy7eduhDVsdNp9GbkdnkR05oyjZnYPe9XjExu', 'n/a', 'gender', 'l', '', 'sensory_sensitivities', '', 'UMW', 'race', '', '', '', 0, 'Furman', 'Not Restricted', 'no', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('lucy', '2024-11-25', 'n/a', 'Lucy', 'Pevensie', '10 London Avenue', 'Stafford', 'VA', '12345', '1234567890', 'home', '0987654321', 'cellphone', '1901-01-01', 'lucy@narnia.com', 'Peter', 'n/a', 'Brother', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$VQ5Za13gNAn/DoAJzwG.j.zMhL1YBjOpsJclMJqfSF1XKxMp2eS9S', 'n/a', 'gender', 's', 'Aslan', 'sensory_sensitivities', 'No', 'N/A', 'race', 'email', 'Arts and crafts', 'Yes', 0, 'Pevensie', 'Restricted', 'N/A', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('mom@gmail.com', '2024-01-22', 'portland', 'Lorraine', 'Egan', '212 Latham Road', 'Mineola', 'NY', '11501', '5167423832', 'home', '', '', '1910-10-10', 'mom@gmail.com', 'Mom', '5167423832', 'Dead', 'phone', 'admin', 'Active', '', '$2y$10$of1CkoNXZwyhAMS5GQ.aYuAW1SHptF6z31ONahnF2qK4Y/W9Ty2h2', '', 'Male', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('morgan', '2024-12-02', 'n/a', 'Morgan', 'Harper', '123 Street', 'Fredericksburg', 'VA', '10001', '5555555555', 'cellphone', '5555555555', 'cellphone', '2003-11-24', 'morgan@gmail.com', 'Christine', 'n/a', 'Mom', 'n/a', 'v', 'Active', 'n/a', '$2y$10$klnM0EjO78i3ifPFMU3YQe6YXq14W3RpmSUsP1.IP0f6wVE6ExYoe', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'USC', 'race', 'email', '', 'Yessss', 0, 'Harper', 'Not Restricted', 'N/A', 1, '2024-12-04', 1, '2024-12-03', 1, '2024-12-02', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('oliver@gmail.com', '2024-01-22', 'portland', 'Oliver', 'Wahl', '1345 Strattford St.', 'Fredericksburg', 'VA', '22401', '1234567890', 'home', '', '', '2011-11-11', 'oliver@gmail.com', 'Mom', '1234567890', 'Mother', 'text', 'admin', 'Active', '', '$2y$10$tgIjMkXhPzdmgGhUgbfPRuXLJVZHLiC0pWQQwOYKx8p8H8XY3eHw6', '', 'Other', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('peter@gmail.com', '2024-01-22', 'portland', 'Peter', 'Polack', '1345 Strattford St.', 'Mineola', 'VA', '12345', '1234567890', 'cellphone', '', '', '1968-09-09', 'peter@gmail.com', 'Mom', '1234567890', 'Mom', 'email', 'admin', 'Active', '', '$2y$10$j5xJ6GWaBhnb45aktS.kruk05u./TsAhEoCI3VRlNs0SRGrIqz.B6', '', 'Male', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('polack@um.edu', '2024-01-22', 'portland', 'Jennifer', 'Polack', '15 Wallace Farms Lane', 'Fredericksburg', 'VA', '22406', '1234567890', 'cellphone', '', '', '1970-05-01', 'polack@um.edu', 'Mom', '1234567890', 'Mom', 'email', 'admin', 'Active', '', '$2y$10$mp18j4WqhlQo7MTeS/9kt.i08n7nbt0YMuRoAxtAy52BlinqPUE4C', '', 'Female', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('polack@umw.edu', '2025-01-09', 'n/a', 'Jennifer', 'ADMIN', '15 Wallace Farms Lane', 'Fredericksburg', 'VA', '22406', '5402959700', 'cellphone', '5402959700', 'cellphone', '1970-05-01', 'polack@umw.edu', 'Jennifer', 'n/a', 'Me', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$CxMpQDWPyURnla9pb8FvveQSRrMBU7.zAB.ZbdHwK1P/suPuwcy0O', 'n/a', 'gender', 'l', '', 'sensory_sensitivities', '', 'UMW', 'race', 'No preference', '', '', 0, 'Polack', 'Restricted', 'NA', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('s', '2024-11-18', 'n/a', 'a', 'hj', 'f', 'f', 'VA', '12333', '1231231234', 'home', '1231231234', 'cellphone', '2000-12-20', 'jf@gmail.com', 'e', 'n/a', 'e', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$7ml7KedmERvRYpflzuMAHOsXdssqzMo5FidkOtekjj9R6u1OdTXqy', 'n/a', 'gender', 's', '', 'sensory_sensitivities', '', 's', 'race', '', '', '', 0, 'e', 'Restricted', 's', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('SaraDowd', '2025-01-13', 'n/a', 'Sara', 'Dowd', '11 Barlow House Court', 'Stafford', 'VA', '22554', '8582549611', 'cellphone', '8582548568', 'cellphone', '1978-01-23', 'sarazonadowd@gmail.com', 'Daniel', 'n/a', 'Spouse', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$BQ4n2HGpgxfaFnBf0HexveU8I0ppdINNXvhZdynQyOiaitOnP6dw6', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'n/a', 'race', 'email', '', '', 0, 'Dowd', 'Not Restricted', 'n/a', 1, '', 1, '', 1, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('someInfo2', '2024-11-24', 'n/a', 'nah', 'whywouldi', '0', '0', 'VA', '00000', '0000000000', 'work', '0000000000', 'work', '0001-01-01', '0@0.o', 'nah', 'n/a', 'a', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$umJj4HXb5tpj79rc4Vj8hu5wCK7BSjMEDdtX7sfdGjMqjt5.ap3bq', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'why would i be', 'race', '', '', '', 0, 'whywouldi', 'Not Restricted', 'a', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('stepvainc@gmail.com', '2024-12-17', 'n/a', 'Jan', 'Monroe', '12419 Toll House Rd.', 'SPOTSYLVANIA', 'VA', '22551', '7575351963', 'cellphone', '7575351967', 'cellphone', '2000-12-09', 'stepvainc@gmail.com', 'Mike', 'n/a', 'spouse', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$mOC.B5elQp8HZhdkNhR/V.jjNBwcsTzQdjG14Aia1jP.8XkNSWj0u', 'n/a', 'gender', 's', '', 'sensory_sensitivities', 'no', 'N/a', 'race', 'text', 'yoga, music', 'yes', 0, 'Monroe', 'Not Restricted', 'n/a', 1, '2013-10-13', 1, '2013-10-13', 1, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('StrawberryJade', '2025-01-09', 'n/a', 'Jade', 'Sergi', '2449 Harpoon Drive', 'Stafford', 'VA', '22554', '5406994590', 'cellphone', '3014120327', 'cellphone', '2005-04-21', 'jtsergi42@gmail.com', 'Carol', 'n/a', 'Mother', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$Q3bVGR6B6E4Ibz7k9vryMO5mFJvtkLO418iADpEonhKdt7vzb5R22', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'N/A', 'race', 'text', '', '', 0, 'Yeh', 'Not Restricted', 'N/A', 1, '2024-11-20', 1, '2019-05-30', 1, '2023-05-29', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('test', '2024-11-20', 'n/a', 'Harry', 'Potter', '123 Apple St.', 'Fredericksburg', 'VA', '22003', '1231231234', 'cellphone', '4324324321', 'home', '2000-07-07', 'test@gmail.com', 'Ron', 'n/a', 'Friend', 'n/a', 'v', 'Active', 'n/a', '$2y$10$3qNoA1RwCbO9/1eHev.T0OCdhfBwaS9cmzGVFdCD4CFqmyEPjgkbm', 'n/a', 'gender', 'm', 'I didn&amp;#039;t', 'sensory_sensitivities', 'aoei', 'Hogwarts', 'race', 'text', 'aoei', 'aoei', 0, 'Weasley', 'Not Restricted', ':0', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('testuser', '2024-11-25', 'n/a', 'Jane', 'Doe', '123 Main Street', 'Fredericksburg', 'VA', '22401', '5555555555', 'cellphone', '6666666666', 'cellphone', '1999-01-01', 'test@mail.com', 'Ron', 'n/a', 'Friend', 'n/a', 'v', 'Active', 'n/a', '$2y$10$kfaLBXEYKBmdzaO6x7KtBuQeXu5o8Wof2MaR5vwJ44aoqPwMsgkIa', 'n/a', 'gender', 'l', 'A little birdie told me', 'sensory_sensitivities', 'Nah', 'N/A', 'race', 'text', 'Being Rad', 'Nah', 0, 'Swanson', 'Not Restricted', 'N/A', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('testuser2', '2024-12-11', 'n/a', 'Jane', 'Doe', '123 Main Street', 'Fredericksburg', 'VA', '22401', '5555555555', 'cellphone', '6666666666', 'cellphone', '2003-08-26', 'test2@mail.com', 'Ron', 'n/a', 'Father', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$mqnpfidPOnnZB1TKDrUa2.cWEcfrOcfslsxdaDG2o6ouWnqTCnFzK', 'n/a', 'gender', 'l', 'Test', 'sensory_sensitivities', 'NO', 'No', 'race', 'No preference', 'No', 'No', 0, 'Swanson', 'Not Restricted', 'NO', 1, '2024-12-10', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('Thall1', '2025-01-09', 'n/a', 'Teresa', 'Hall', '119 Garfield Avenue', 'Colonial Beach', 'VA', '22443', '5405977489', 'cellphone', '5407608128', 'cellphone', '1969-05-07', 'tlomeara3@gmail.com', 'Tim', 'n/a', 'Spouse', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$.Er980h41trC1NRObt4U5.S8YKbORWhwC2.44tHoLLBnmSmMa8hKK', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'N/A', 'race', 'text', '', '', 0, 'Hall', 'Not Restricted', 'N/A', 1, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('tom@gmail.com', '2024-01-22', 'portland', 'tom', 'tom', '1345 Strattford St.', 'Mineola', 'NY', '12345', '1234567890', 'home', '', '', '1920-02-02', 'tom@gmail.com', 'Dad', '9876543210', 'Father', 'phone', 'admin', 'Active', '', '$2y$10$1Zcj7n/prdkNxZjxTK1zUOF7391byZvsXkJcN8S8aZL57sz/OfxP.', '', 'Male', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('username', '2024-11-18', 'n/a', 'cool', 'cool', 'weqwe', 'qewq', 'VA', '12312', '1231231234', 'home', '1231232134', 'cellphone', '2024-11-01', 'cool@gmail.com', 'cool', 'n/a', 'cool', 'n/a', 'v', 'Inactive', 'n/a', '$2y$10$yz35FMhhRl.hVIyjhvASJeQ.sp0lc7hzQQJJRBHH00spfTOlQJ4Cy', 'n/a', 'gender', 'm', '', 'sensory_sensitivities', '', 'w', 'race', 'email', '', '', 0, 'cool', 'Not Restricted', 'super awesome', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('usernameusername', '2024-12-09', 'n/a', 'Noah', 'Stafford', 'My address', 'City', 'VA', '22405', '1231231234', 'cellphone', '1231231234', 'cellphone', '2024-12-01', 'email@gmail.com', 'Contact', 'n/a', 'Mom', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$uGbO0uD4CFwN0ewoqGG8T.9PT.1F8pOBSJVOKXkvNSlRSjAANMhOK', 'n/a', 'gender', 'xs', '', 'sensory_sensitivities', '', 'N/A', 'race', 'No preference', '', '', 0, 'Lastname', 'Not Restricted', 'N/A', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('vmsroot', 'N/A', 'portland', 'vmsroot', '', 'N/A', 'N/A', 'VA', 'N/A', '', 'N/A', 'N/A', 'N/A', 'N/A', 'vmsroot', 'N/A', 'N/A', 'N/A', 'N/A', '', 'N/A', 'N/A', '$2y$10$.3p8xvmUqmxNztEzMJQRBesLDwdiRU3xnt/HOcJtsglwsbUk88VTO', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0),
('work', '2024-12-10', 'n/a', 'a', 'a', 'a', 'a', 'VA', '11111', '1231231234', 'cellphone', '1231231234', 'cellphone', '2024-12-04', 'a@gmail.com', 'a', 'n/a', 'a', 'n/a', 'volunteer', 'Active', 'n/a', '$2y$10$ChUa935f6QE8RtHI4p2vX.WtCeoVPPYQhgVNFfgnvLPo0mVJGXbCi', 'n/a', 'gender', 's', '', 'sensory_sensitivities', '', 'a', 'race', 'No preference', '', '', 0, 'a', 'Restricted', 'a', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `title`, `content`) VALUES
(1, 'test page', 'blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah '),
(2, 'test stuff', 'this is a example of pagination'),
(3, 'title 2 ', 'alalalalalalalalala'),
(4, 'title something', 'tototototototototo ');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `name` int(100) NOT NULL,
  `tagged` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `name` varchar(100) NOT NULL,
  `time` date NOT NULL,
  `disc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_color`
--

CREATE TABLE `task_color` (
  `task` varchar(100) NOT NULL,
  `Red` int(255) NOT NULL,
  `Blue` int(255) NOT NULL,
  `Green` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chech`
--
ALTER TABLE `chech`
  ADD PRIMARY KEY (`journel`);

--
-- Indexes for table `check`
--
ALTER TABLE `check`
  ADD PRIMARY KEY (`journel`);

--
-- Indexes for table `daily_tasks`
--
ALTER TABLE `daily_tasks`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `dbanimals`
--
ALTER TABLE `dbanimals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dbcsgapplication`
--
ALTER TABLE `dbcsgapplication`
  ADD PRIMARY KEY (`csgApplicationID`);

--
-- Indexes for table `dbeventmedia`
--
ALTER TABLE `dbeventmedia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKeventID2` (`eventID`);

--
-- Indexes for table `dbeventpersons`
--
ALTER TABLE `dbeventpersons`
  ADD KEY `FKeventID` (`eventID`),
  ADD KEY `FKpersonID` (`userID`);

--
-- Indexes for table `dbevents`
--
ALTER TABLE `dbevents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dbf2fapplication`
--
ALTER TABLE `dbf2fapplication`
  ADD PRIMARY KEY (`f2fApplicationID`);

--
-- Indexes for table `dbfsgapplication`
--
ALTER TABLE `dbfsgapplication`
  ADD PRIMARY KEY (`fsgApplicationID`);

--
-- Indexes for table `dbhfapplication`
--
ALTER TABLE `dbhfapplication`
  ADD PRIMARY KEY (`hfApplicationID`);

--
-- Indexes for table `dbioovapplication`
--
ALTER TABLE `dbioovapplication`
  ADD PRIMARY KEY (`ioovApplicationID`);

--
-- Indexes for table `dbp2papplication`
--
ALTER TABLE `dbp2papplication`
  ADD PRIMARY KEY (`p2pApplicationID`);

--
-- Indexes for table `dbpersonhours`
--
ALTER TABLE `dbpersonhours`
  ADD KEY `FkpersonID2` (`personID`),
  ADD KEY `FKeventID3` (`eventID`);

--
-- Indexes for table `dbpersons`
--
ALTER TABLE `dbpersons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `task_color`
--
ALTER TABLE `task_color`
  ADD PRIMARY KEY (`task`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dbanimals`
--
ALTER TABLE `dbanimals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dbeventmedia`
--
ALTER TABLE `dbeventmedia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dbevents`
--
ALTER TABLE `dbevents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dbeventmedia`
--
ALTER TABLE `dbeventmedia`
  ADD CONSTRAINT `FKeventID2` FOREIGN KEY (`eventID`) REFERENCES `dbevents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dbeventpersons`
--
ALTER TABLE `dbeventpersons`
  ADD CONSTRAINT `FKeventID` FOREIGN KEY (`eventID`) REFERENCES `dbevents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKpersonID` FOREIGN KEY (`userID`) REFERENCES `dbpersons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dbpersonhours`
--
ALTER TABLE `dbpersonhours`
  ADD CONSTRAINT `FKeventID3` FOREIGN KEY (`eventID`) REFERENCES `dbevents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FkpersonID2` FOREIGN KEY (`personID`) REFERENCES `dbpersons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

--
-- Dumping data for table `pma__export_templates`
--

INSERT INTO `pma__export_templates` (`id`, `username`, `export_type`, `template_name`, `template_data`) VALUES
(1, 'root', 'server', 'stepvadb', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"db_select[]\":[\"nami\",\"note_app\",\"phpmyadmin\",\"stepvadb\",\"test\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@SERVER@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_columns\":\"something\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Structure of table @TABLE@\",\"latex_structure_continued_caption\":\"Structure of table @TABLE@ (continued)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Content of table @TABLE@\",\"latex_data_continued_caption\":\"Content of table @TABLE@ (continued)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"yaml_structure_or_data\":\"data\",\"\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_drop_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_procedure_function\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"dbahtngmaidjgd\",\"table\":\"verification\"},{\"db\":\"dbahtngmaidjgd\",\"table\":\"dbpersons\"},{\"db\":\"dbahtngmaidjgd\",\"table\":\"dbpersonhours\"},{\"db\":\"stepvadb\",\"table\":\"dbpersons\"},{\"db\":\"stepvadb\",\"table\":\"dbpersonhours\"},{\"db\":\"stepvadb\",\"table\":\"minutes_link\"},{\"db\":\"stepvadb\",\"table\":\"minutes_keywords\"},{\"db\":\"stepvadb\",\"table\":\"blacklisted\"},{\"db\":\"stepvadb\",\"table\":\"dbcsgapplication\"},{\"db\":\"stepvadb\",\"table\":\"dbioovapplication\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'note_app', 'dbpersons', '{\"CREATE_TIME\":\"2025-03-10 08:42:44\",\"col_order\":[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,27,28,26,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62],\"col_visib\":[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],\"sorted_col\":\"`dbpersons`.`first_name` ASC\"}', '2025-03-17 13:26:51');

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2025-04-25 16:24:33', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Dumping data for table `pma__users`
--

INSERT INTO `pma__users` (`username`, `usergroup`) VALUES
('bad', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `stepvadb`
--
CREATE DATABASE IF NOT EXISTS `stepvadb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `stepvadb`;

-- --------------------------------------------------------

--
-- Table structure for table `dbevents`
--

CREATE TABLE `dbevents` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `date` char(10) NOT NULL,
  `startTime` char(5) NOT NULL,
  `endTime` char(5) NOT NULL,
  `description` text NOT NULL,
  `capacity` int(11) NOT NULL,
  `completed` text NOT NULL,
  `event_type` text NOT NULL,
  `restricted_signup` tinyint(1) NOT NULL,
  `location` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dbevents`
--

INSERT INTO `dbevents` (`id`, `name`, `date`, `startTime`, `endTime`, `description`, `capacity`, `completed`, `event_type`, `restricted_signup`, `location`) VALUES
(28, 'Thanksgiving Feast', '2024-11-28', '', '23:59', 'There is so much to give thanks for!', 0, 'no', '', 1, NULL),
(29, 'Tuesdays with the Troubadours', '2024-11-26', '', '23:59', 'The Troubadours are live!', 0, 'no', '', 0, NULL),
(30, 'Hogwarts Festival', '2024-11-23', '', '23:59', 'Hello', 0, 'no', '', 0, 'Hogwarts'),
(31, 'Sing Together!', '2024-11-23', '', '23:59', 'aoeiaoei', 0, 'no', '', 0, NULL),
(36, 'Daytime Yoga', '2024-12-17', '11:00', '12:00', 'Weekly event', 25, 'no', '', 0, 'STEP VA Studio'),
(47, 'Finding Nemo Jr Audition Track', '2025-01-02', '18:00', '20:00', '(ages 10+)', 30, 'no', '', 0, 'Riverside First Church of God'),
(64, 'Christmas Cookie Party', '2024-12-14', '16:00', '18:00', 'Bring your favorite cookie recipe to share!', 0, 'yes', '', 0, NULL),
(69, 'Finding Nemo Jr: Tech Classes', '2025-01-07', '18:00', '20:00', 'ages 13+', 12, 'no', '', 1, 'STEP VA Studio: 3328 Bourbon Street'),
(70, 'Rolex Paris Masters', '2024-12-25', '13:00', '15:00', 'Testing testing 123', 99, 'no', '', 1, 'Location'),
(71, 'Christmas Party', '2024-12-22', '18:00', '21:00', 'Welcome!', 100, 'no', '', 1, 'Palace'),
(72, 'Awesome Event 2024', '2024-12-05', '13:00', '17:00', 'This is the most awesome event of 2024!', 50, 'no', '', 0, 'UMW'),
(73, 'Finding Nemo Jr.', '2025-07-19', '17:00', '18:30', 'Come and see the children perform!', 100, 'no', '', 1, 'Step VA headquarters'),
(75, 'The Spotsylvanians', '2024-12-14', '19:00', '21:00', 'The Spotsylvanians Present A Hometown Holiday', 100, 'no', '', 1, 'Riverbend High School 12301 Spotswood Furnace Road Fredericksburg'),
(76, 'Fred&#039;s Piano Recital', '2024-12-14', '18:00', '21:00', 'Come hear Fred play piano!', 99, 'no', '', 0, 'StepVA Headquarters'),
(78, 'Costume making', '2024-12-23', '12:00', '17:00', 'Costume making', 10, 'no', '', 1, 'location'),
(79, 'Singing lessons', '2024-12-22', '12:00', '17:00', 'Singing Lessons', 10, 'no', '', 0, 'Location'),
(80, 'Arts and Crafts', '2024-12-11', '12:00', '17:00', 'Awesome!', 10, 'no', '', 0, 'location'),
(81, 'Dancing lessons', '2024-12-18', '12:00', '17:00', 'dancing lessons!', 10, 'no', '', 0, 'location'),
(82, 'Tree Ceremony', '2024-12-10', '21:30', '22:00', 'Come light a Christmas Tree downtown!', 2, 'no', '', 0, ''),
(83, 'Step VA Presentation', '2024-12-11', '09:00', '13:00', 'TADA!!!', 4, 'no', '', 0, 'Tada'),
(87, 'Christmas Tree Lighting', '2024-12-14', '07:00', '18:00', 'We&#039;re going to light the Christmas tree!', 99, 'no', '', 0, 'Stafford Square'),
(89, 'Tuesdays with the Troubadours: Christmas with the Troubadours', '2024-12-17', '09:00', '12:00', 'The Troubadours are live! Come celebrate Christmas!', 99, 'no', '', 0, 'Virtual Online'),
(92, 'CandyLand Game Night', '2024-12-12', '07:00', '12:00', 'Let&#039;s play CandyLand!', 15, 'no', '', 0, 'STEP VA Studio: 3328 Bourbon Street'),
(94, 'Gary_Young_Resume_Policy.pdf', '2024-12-26', '00:00', '00:01', 'ABC', 8, 'no', '', 0, ''),
(97, 'Test', '2024-12-12', '12:00', '13:00', 'Test', 1, 'no', '', 0, 'Test'),
(98, 'Rolex Paris Masters', '2024-12-11', '15:42', '18:00', 'Testing testing 123', 4, 'no', '', 0, 'Location'),
(99, 'Christmas Wrapping Event', '2025-02-05', '15:45', '18:00', 'hot', 3, 'no', '', 0, 'Location'),
(100, 'Finding Nemo', '2025-02-15', '17:30', '20:00', 'approved volunteers', 15, 'no', '', 1, ''),
(101, 'Finding Nemo Rehearsal', '2025-01-23', '17:30', '20:00', 'rehearsal', 20, 'no', '', 1, 'Riverside First Church of God 3461 Fall Hill Ave. Fredericksburg 22401'),
(103, 'Finding Nemo Rehearsal', '2025-01-30', '17:30', '20:00', 'rehearsal', 20, 'no', '', 1, 'Riverside First Church of God 3461 Fall Hill Ave. Fredericksburg 22401'),
(104, 'Finding Nemo Rehearsal', '2025-02-06', '17:30', '20:00', 'rehearsal', 20, 'no', '', 1, 'Riverside First Church of God 3461 Fall Hill Ave. Fredericksburg 22401'),
(105, 'Finding Nemo Rehearsal', '2025-03-27', '17:30', '20:00', 'rehearsal', 20, 'no', '', 1, 'Riverside First Church of God 3461 Fall Hill Ave. Fredericksburg 22401'),
(106, 'Finding Nemo Rehearsal', '2025-03-20', '17:30', '20:00', 'rehearsal', 20, 'no', '', 1, 'Riverside First Church of God 3461 Fall Hill Ave. Fredericksburg 22401'),
(107, 'visa', '2025-02-02', '12:00', '13:00', 'dqdwec', 60, 'no', '', 1, 'vwvw'),
(108, 'jninjn', '2025-02-13', '12:00', '13:00', 'ijnoi', 1, 'no', '', 1, 'noin'),
(109, 'Test', '2025-02-13', '13:00', '14:30', 'This is a test event', 99, 'no', '', 0, 'Fredericksburg, VA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dbevents`
--
ALTER TABLE `dbevents`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dbevents`
--
ALTER TABLE `dbevents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
