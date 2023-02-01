-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2022 at 12:50 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `accomplished_activity`
--

CREATE TABLE `accomplished_activity` (
  `id` int(11) UNSIGNED NOT NULL,
  `achieved_score` int(11) UNSIGNED NOT NULL,
  `color` varchar(30) NOT NULL,
  `reason_for_disparity` varchar(1000) DEFAULT NULL,
  `quarter` int(11) NOT NULL,
  `initiative` int(11) UNSIGNED NOT NULL,
  `kpi` int(11) UNSIGNED NOT NULL,
  `strategic_objective` int(11) UNSIGNED NOT NULL,
  `strategic_theme` int(11) UNSIGNED NOT NULL,
  `department` int(11) UNSIGNED NOT NULL,
  `status` int(2) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accomplished_activity`
--

INSERT INTO `accomplished_activity` (`id`, `achieved_score`, `color`, `reason_for_disparity`, `quarter`, `initiative`, `kpi`, `strategic_objective`, `strategic_theme`, `department`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(4, 50, 'green', 'The activity was done successfully, but no survey done to validate the score', 1, 13, 5, 4, 2, 1, 9, 8, 1648112768, 8, 1648112768),
(5, 50, 'green', 'The activity was done, being spearheaded by Family Life. The score was not validated by survey but there was great response from church members and beyond', 1, 2, 1, 1, 2, 1, 9, 8, 1648112950, 8, 1648112950),
(6, 0, 'red', 'Fellowship band leaders are not unresponsive to engagements efforts being made by the Prayer Band', 1, 3, 3, 1, 2, 1, 9, 8, 1648113044, 8, 1648113044),
(7, 4, 'orange', 'Only two bands have confirmed that meetings are happening. The rest are unresponsive. The figure given is an estimate', 1, 4, 3, 1, 2, 1, 9, 8, 1648113198, 8, 1648113198),
(8, 30, 'orange', 'Only two fellowship bands have responded to engagement efforts by the Prayer Band', 1, 5, 6, 2, 2, 1, 9, 8, 1648113449, 8, 1648113449),
(9, 0, 'red', 'No movement has been done yet', 1, 7, 3, 1, 2, 1, 9, 8, 1648113505, 8, 1648113505),
(10, 0, 'red', 'No movement yet due to low physical attendance because of the Covid 19 pandemic', 1, 18, 5, 4, 2, 1, 9, 8, 1648113618, 8, 1648113618),
(11, 0, 'red', 'The budget has not been approved', 1, 8, 6, 2, 2, 1, 9, 8, 1648114069, 8, 1648114069),
(12, 4, 'orange', 'In progress but there are limitations because the budget was not approved yet', 1, 11, 3, 3, 2, 1, 9, 8, 1648114574, 8, 1648114574),
(13, 0, 'green', 'Activity was done but no survey done to check the score', 1, 16, 5, 4, 2, 1, 9, 8, 1648114658, 8, 1648114658),
(14, 87, 'orange', '', 1, 5, 6, 2, 2, 4, 9, 38, 1665061808, 38, 1665061808);

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) UNSIGNED NOT NULL,
  `home_address` varchar(255) NOT NULL DEFAULT '',
  `mobile_number` varchar(255) DEFAULT NULL,
  `whatsapp_number` varchar(255) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `twitter_id` varchar(255) DEFAULT NULL,
  `instagram_id` varchar(255) DEFAULT NULL,
  `primary_email` varchar(255) DEFAULT NULL,
  `secondary_email` varchar(255) DEFAULT NULL,
  `gps_home_location` varchar(255) DEFAULT '',
  `created_at` int(11) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `member` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `home_address`, `mobile_number`, `whatsapp_number`, `facebook_id`, `twitter_id`, `instagram_id`, `primary_email`, `secondary_email`, `gps_home_location`, `created_at`, `created_by`, `updated_at`, `updated_by`, `member`) VALUES
(1, 'UNZA', '0972024917', '', '', '', '', 'mayembem34@gmail.com', 'mayembem34@gmail.com', '', 1607614640, NULL, 1607614640, NULL, 1),
(2, 'Katimamulilo Rd', '0972024917', '0972024917', 'Martin Mayembe', '', '', 'mayembem@hotmail.com', 'mayembem@hotmail.com', '', 1637585326, 9, 1637585326, 9, 2),
(3, 'UNZA', '097777777', '097777777', '', '', '', 'nstcpromo@gmail.com', 'nstcpromo@gmail.com', '', 1659037478, NULL, 1659037478, NULL, NULL),
(4, 'ADDRESS', '0987654321', '908765439876', '', '', '', 'sililosililo82@gmail.com', '', '', 1664905886, 38, 1664905886, 38, 3),
(5, 'admin2', '987654321', '', '', '', '', 'admin2@admin.com', '', '', 1665290382, 28, 1665290382, 28, 4);

-- --------------------------------------------------------

--
-- Table structure for table `baptism`
--

CREATE TABLE `baptism` (
  `baptism_id` int(11) UNSIGNED NOT NULL,
  `date` varchar(255) NOT NULL,
  `baptising_minister` int(11) UNSIGNED NOT NULL,
  `member_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `baptism_interest`
--

CREATE TABLE `baptism_interest` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `state` varchar(100) NOT NULL DEFAULT 'pending',
  `recieved_by` int(10) UNSIGNED DEFAULT NULL,
  `return_comment` text NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `baptism_interest`
--

INSERT INTO `baptism_interest` (`id`, `user`, `state`, `recieved_by`, `return_comment`, `created_at`, `updated_at`) VALUES
(2, 28, '', NULL, '', 1668098514, 1668098514);

-- --------------------------------------------------------

--
-- Table structure for table `child_dedication`
--

CREATE TABLE `child_dedication` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `child_name` text NOT NULL,
  `child_gender` text NOT NULL,
  `meaning_name` text DEFAULT NULL,
  `father_name` varchar(100) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `father_phone` varchar(15) DEFAULT NULL,
  `mother_phone` varchar(15) DEFAULT NULL,
  `father_email` varchar(150) DEFAULT NULL,
  `mother_email` varchar(150) DEFAULT NULL,
  `father_religious_affiliation` text NOT NULL,
  `father_adventist_membership` text NOT NULL,
  `mother_religious_affiliation` text NOT NULL,
  `mother_adventist_membership` text NOT NULL,
  `photo` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `child_dedication`
--

INSERT INTO `child_dedication` (`id`, `user_id`, `child_name`, `child_gender`, `meaning_name`, `father_name`, `mother_name`, `father_phone`, `mother_phone`, `father_email`, `mother_email`, `father_religious_affiliation`, `father_adventist_membership`, `mother_religious_affiliation`, `mother_adventist_membership`, `photo`, `status`, `created_at`, `updated_at`) VALUES
(3, 28, 'qadzwsrgfvx', 'male', 'rfscvx', 'sfvcx', 'grfsdvx', '', '', '', '', '', '', '', '', '', 1, 1665058926, 1665058997),
(4, 38, 'rdtcfyvguhbj', 'male', '', 'dfgjhk', 'yfguhijlk', '', '', '', '', '', '', '', '', '', 1, 1665061738, 1665062581);

-- --------------------------------------------------------

--
-- Table structure for table `church_contacts`
--

CREATE TABLE `church_contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `position_id` int(10) UNSIGNED NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `church_contacts`
--

INSERT INTO `church_contacts` (`id`, `position_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1665011305),
(2, 2, NULL, 1665011780),
(3, 4, 1665062447, 1665062447);

-- --------------------------------------------------------

--
-- Table structure for table `church_officers`
--

CREATE TABLE `church_officers` (
  `id` int(10) UNSIGNED NOT NULL,
  `position_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `added_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `church_officers`
--

INSERT INTO `church_officers` (`id`, `position_id`, `user_id`, `year`, `added_by`, `created_at`, `updated_at`) VALUES
(6, 3, 9, 2022, 28, 1665008512, 1665008512),
(7, 1, 38, 2022, 28, 1665048767, 1668337670),
(8, 2, 1, 2023, 28, 1665048785, 1665048785),
(10, 4, 38, 2023, 28, 1665123318, 1665123318);

-- --------------------------------------------------------

--
-- Table structure for table `church_positions`
--

CREATE TABLE `church_positions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED DEFAULT NULL,
  `added_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `church_positions`
--

INSERT INTO `church_positions` (`id`, `name`, `description`, `role_id`, `department_id`, `added_by`, `created_at`, `updated_at`) VALUES
(1, 'AY Leader', 'Leadership of youth movement', 2, 4, NULL, 0, 0),
(2, 'Pathfinder Directors', '', 1, NULL, NULL, 0, 0),
(3, 'Interest Cordinator', '', 1, NULL, 28, 1665006955, 1665006955),
(4, 'Prayer Band Leader', '', 2, 1, 28, 1665062329, 1665062329);

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `id` int(11) UNSIGNED NOT NULL,
  `club_name` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `age_group` varchar(255) NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `club_report`
--

CREATE TABLE `club_report` (
  `id` int(11) UNSIGNED NOT NULL,
  `club` int(11) UNSIGNED NOT NULL,
  `no_of_clubs` int(11) UNSIGNED NOT NULL,
  `membership` int(11) UNSIGNED NOT NULL,
  `no_invested` int(11) UNSIGNED NOT NULL,
  `no_of_camps` int(11) UNSIGNED NOT NULL,
  `no_baptised` int(11) UNSIGNED NOT NULL,
  `no_of_crusades` int(11) UNSIGNED NOT NULL,
  `no_baptised_at_crusades` int(11) UNSIGNED NOT NULL,
  `quarter` int(1) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conference_report`
--

CREATE TABLE `conference_report` (
  `id` int(11) UNSIGNED NOT NULL,
  `district` varchar(255) NOT NULL,
  `church` varchar(255) NOT NULL,
  `quarter` int(1) UNSIGNED NOT NULL,
  `year` year(4) NOT NULL,
  `district_pastor` int(11) UNSIGNED NOT NULL,
  `date_submitted` date NOT NULL,
  `no_of_churches` int(11) UNSIGNED NOT NULL,
  `no_of_churches_reporting` int(11) UNSIGNED NOT NULL,
  `no_of_companies` int(11) UNSIGNED NOT NULL,
  `no_of_companies_reporting` int(11) UNSIGNED NOT NULL,
  `no_of_branches` int(11) UNSIGNED NOT NULL,
  `no_of_branches_reporting` int(11) UNSIGNED NOT NULL,
  `strategic_plan` int(11) UNSIGNED NOT NULL,
  `department` int(11) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` int(2) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `description`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Prayer Band', '', 9, 1, 1638298996, 1, 1638298996),
(2, 'SPMEC', '', 9, 1, 1638299046, 1, 1638299064),
(3, 'Technical Department', '', 9, 1, 1638299096, 1, 1638299096),
(4, 'Adventist Youths', NULL, 9, 28, 1664971584, 28, 1664971584);

-- --------------------------------------------------------

--
-- Table structure for table `departmental_expense_items`
--

CREATE TABLE `departmental_expense_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `fund_item` int(10) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departmental_expense_items`
--

INSERT INTO `departmental_expense_items` (`id`, `fund_item`, `year`, `created_at`, `updated_at`) VALUES
(10, 1, 2022, 1666494831, 1666494831),
(11, 2, 2022, 1666495452, 1666495452),
(12, 3, 2023, 1666496827, 1666496827);

-- --------------------------------------------------------

--
-- Table structure for table `department_member`
--

CREATE TABLE `department_member` (
  `id` int(11) UNSIGNED NOT NULL,
  `member` int(11) UNSIGNED NOT NULL,
  `department` int(11) UNSIGNED NOT NULL,
  `club` int(11) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `status` int(2) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_member`
--

INSERT INTO `department_member` (`id`, `member`, `department`, `club`, `role`, `year`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 1, 0, 'Member', 2020, 9, 8, 1607614740, 8, 1607614740),
(2, 28, 1, 0, 'Member', 2020, 9, 8, 1607614740, 8, 1607614740);

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `id` int(11) UNSIGNED NOT NULL,
  `family_name` varchar(255) NOT NULL DEFAULT '',
  `head_of_family` int(11) UNSIGNED DEFAULT NULL,
  `spouse` int(11) UNSIGNED DEFAULT NULL,
  `family_photo` varchar(255) NOT NULL DEFAULT '',
  `prayer_band` varchar(255) NOT NULL DEFAULT '',
  `status` int(2) UNSIGNED NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`id`, `family_name`, `head_of_family`, `spouse`, `family_photo`, `prayer_band`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Mayembe', 1, NULL, 'Family_Photo_8_09-12-2020_08-07-09.jpg', 'UNZA', 0, 1607497630, 8, 1607506016, 8),
(2, 'Mayembe', 2, NULL, 'Family_Photo_9_22-11-2021_01-42-57.jpg', 'Kalundu', 0, 1637584977, 9, 1637585326, 9),
(3, 'SILILO', 3, NULL, 'Family_Photo_38_04-10-2022_07-46-30.jpg', 'band handsworth', 9, 1664905590, 38, 1664905886, 38),
(4, 'admin', 4, NULL, 'Family_Photo_28_09-10-2022_06-36-25.jpg', 'Admin', 9, 1665290185, 28, 1665290383, 28);

-- --------------------------------------------------------

--
-- Table structure for table `family_children`
--

CREATE TABLE `family_children` (
  `id` int(11) UNSIGNED NOT NULL,
  `family` int(11) UNSIGNED NOT NULL,
  `child` int(11) UNSIGNED NOT NULL,
  `status` int(2) UNSIGNED NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `family_other`
--

CREATE TABLE `family_other` (
  `id` int(11) UNSIGNED NOT NULL,
  `family` int(11) UNSIGNED NOT NULL,
  `other` int(11) UNSIGNED NOT NULL,
  `status` int(2) UNSIGNED NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fund_items`
--

CREATE TABLE `fund_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `fund_category` int(10) UNSIGNED NOT NULL,
  `dept` int(10) UNSIGNED DEFAULT NULL,
  `year` year(4) NOT NULL,
  `budget` decimal(20,2) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fund_items`
--

INSERT INTO `fund_items` (`id`, `item_name`, `description`, `fund_category`, `dept`, `year`, `budget`, `created_at`, `updated_at`) VALUES
(1, 'Local LCB', '', 20, 0, 2022, '283465.52', NULL, NULL),
(2, 'Tithe', '', 23, NULL, 2022, '4567654.89', NULL, NULL),
(3, 'Advent Youth', '', 20, 4, 2022, '4565.00', 1666488987, 1668101331),
(4, 'Dorcas', '', 21, NULL, 2022, '345687.69', 1666550794, 1666550794),
(5, 'Ay Day', '', 20, 4, 2022, '5000.00', 1668101241, 1668102382);

-- --------------------------------------------------------

--
-- Table structure for table `funeral_notices`
--

CREATE TABLE `funeral_notices` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `date_of_birth` int(11) NOT NULL,
  `date_of_death` int(11) NOT NULL,
  `address` text DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `position_in_church` text DEFAULT NULL,
  `family_members_and_contacts` text DEFAULT NULL,
  `notified_by` int(10) UNSIGNED NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `funeral_notices`
--

INSERT INTO `funeral_notices` (`id`, `first_name`, `last_name`, `gender`, `date_of_birth`, `date_of_death`, `address`, `photo`, `position_in_church`, `family_members_and_contacts`, `notified_by`, `created_at`, `updated_at`, `status`) VALUES
(1, 'ghfd ghfdsa', 'ghfdsa ghfdsa', 'male', 1665266400, 1665784800, 'hfgds', '', 'ghfd nfffffffff fgnbv rfgvbfhvbn ', 'mhbghfds', 38, 1665128218, 1665251732, 1);

-- --------------------------------------------------------

--
-- Table structure for table `incomes_and_expenses`
--

CREATE TABLE `incomes_and_expenses` (
  `id` int(10) UNSIGNED NOT NULL,
  `fund_item` int(10) UNSIGNED NOT NULL,
  `trans_type` varchar(50) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `date_of_trans` int(11) NOT NULL,
  `added_by` int(10) UNSIGNED NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incomes_and_expenses`
--

INSERT INTO `incomes_and_expenses` (`id`, `fund_item`, `trans_type`, `amount`, `date_of_trans`, `added_by`, `created_at`, `updated_at`, `updated_by`) VALUES
(1, 1, 'income', '45.00', 1657231200, 28, 1666476381, 1666477819, NULL),
(2, 1, 'expense', '1654.00', 1666476000, 28, 1666476788, 1666492118, NULL),
(3, 1, 'income', '5432.00', 1664229600, 28, 1666520452, 1666547853, NULL),
(4, 1, 'expense', '16454.00', 1666044000, 28, 1666520813, 1666523528, NULL),
(5, 1, 'expense', '281655.00', 1665007200, 28, 1666523405, 1666523405, NULL),
(6, 1, 'income', '50000.00', 1665525600, 28, 1666526339, 1666526339, NULL),
(7, 3, 'income', '4500.00', 1667948400, 28, 1668102338, 1668102338, NULL),
(8, 5, 'expense', '3500.00', 1667862000, 28, 1668102412, 1668102412, NULL),
(9, 3, 'expense', '34500.00', 1668294000, 38, 1668339267, 1668339267, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `initiative`
--

CREATE TABLE `initiative` (
  `id` int(11) UNSIGNED NOT NULL,
  `activity` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `budget` int(11) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `responsible_person` int(11) UNSIGNED NOT NULL,
  `strategic_objective` int(11) UNSIGNED NOT NULL,
  `kpi` int(11) UNSIGNED NOT NULL,
  `strategic_theme` int(11) UNSIGNED NOT NULL,
  `department_id` int(11) UNSIGNED NOT NULL,
  `status` int(2) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `initiative`
--

INSERT INTO `initiative` (`id`, `activity`, `start_date`, `end_date`, `budget`, `comments`, `responsible_person`, `strategic_objective`, `kpi`, `strategic_theme`, `department_id`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Crusade', '2020-11-30', '2020-12-09', 1000, 'No Comments', 1, 1, 0, 1, 1, 1, 8, 1607618165, 8, 1645018415),
(2, 'Have a study on how families can run family altars (Work with women ministries and family life)', '2022-01-01', '2022-12-31', 0, 'No comments', 1, 1, 1, 2, 1, 9, 8, 1648109865, 8, 1648109865),
(3, 'Encourage rotating presenters and hosts among fellowship band members', '2022-01-01', '2022-12-31', 0, 'No comments', 1, 1, 3, 2, 1, 9, 8, 1648109999, 8, 1648109999),
(4, 'Encourage use of mobile apps/ICT (i.e whatsapp) to remind and encourage members to attend online or phsical Residential Fellowship Band meetings', '2022-01-01', '2022-12-31', 0, 'No comments', 1, 1, 3, 2, 1, 9, 8, 1648110074, 8, 1648110074),
(5, 'Make followups through telephone calls,e-mails and visits with targeted fellowship bands', '2022-01-01', '2022-12-31', 1000, 'No comments', 1, 2, 6, 2, 1, 9, 8, 1648110772, 8, 1648111364),
(6, 'Conduct a retreat (Q2, Q3) at departmental level', '2022-01-01', '2022-12-31', 5000, 'No comments', 1, 2, 3, 2, 1, 9, 8, 1648110820, 8, 1648111402),
(7, ' Make residential fellowship band meeting reminder announcements atleast once a month at Church ', '2022-01-01', '2022-12-31', 0, 'No comments', 1, 1, 3, 2, 1, 9, 8, 1648110956, 8, 1648110956),
(8, 'Routine visits to revive inactive residential fellowship bands', '2022-01-01', '2022-12-31', 3000, 'No comments', 1, 2, 6, 2, 1, 9, 8, 1648111182, 8, 1648111285),
(9, ' Encourage and improve wide participation rates in fellowship band through rotation of weekly presenting officers and leadership ', '2022-01-01', '2022-12-31', 0, 'No comments', 1, 2, 6, 2, 1, 9, 8, 1648111267, 8, 1648111267),
(10, 'Conduct Hospital and home prayer visitations at request', '2022-01-01', '2022-12-31', 2000, 'No comments', 1, 3, 4, 2, 1, 9, 8, 1648111488, 8, 1648111488),
(11, 'Respond to / follow up prayer requests / interests from both Church members and non Church members', '2022-01-01', '2022-12-31', 1000, 'No comments', 1, 3, 3, 2, 1, 9, 8, 1648111578, 8, 1648111578),
(12, 'Proactively identify people in need of prayer and reach out to them.', '2022-01-01', '2022-12-31', 1000, 'No comments', 1, 3, 3, 2, 1, 9, 8, 1648111655, 8, 1648111655),
(13, ' Organise the 10 days of prayer meeting based on the GC themes', '2022-01-05', '2022-01-15', 0, 'No comments', 1, 4, 5, 2, 1, 9, 8, 1648111727, 8, 1648111727),
(14, 'Youth to conduct prayer and fasting program in the second quarter', '2022-04-02', '2022-04-02', 0, 'No comments', 1, 4, 5, 2, 1, 9, 8, 1648111847, 8, 1648111847),
(15, ' Conduct a study on importance of prayer (Q2 during prayer and fasting day)', '2022-04-02', '2022-04-02', 0, 'No comments', 1, 4, 5, 2, 1, 9, 8, 1648111895, 8, 1648111895),
(16, 'Conduct church quaterly prayer and fasting scheduled programs to enhance prayerfulness and discipleship', '2022-01-01', '2022-12-31', 0, 'No comments', 1, 4, 5, 2, 1, 9, 8, 1648111942, 8, 1648111942),
(17, 'Conduct prayer and fasting for prayer band, twice in a quarter and as need arises', '2022-01-01', '2022-12-31', 0, 'No comments', 1, 4, 5, 2, 1, 9, 8, 1648112001, 8, 1648112001),
(18, 'Hold Sabbath intercessory prayers for the Church leadership,worship services and requests from members (request through Interest coordinator, Prayer Box, Phone, email etc)', '2022-01-01', '2022-12-31', 0, 'No comments', 1, 4, 5, 2, 1, 9, 8, 1648112044, 8, 1648112044);

-- --------------------------------------------------------

--
-- Table structure for table `interest`
--

CREATE TABLE `interest` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `other_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `residence` varchar(255) NOT NULL,
  `denomination` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `need` varchar(255) NOT NULL,
  `status` int(2) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `k_p_i`
--

CREATE TABLE `k_p_i` (
  `id` int(11) UNSIGNED NOT NULL,
  `measure` varchar(255) NOT NULL,
  `yearly_target` int(11) UNSIGNED NOT NULL,
  `q1_target` int(11) UNSIGNED NOT NULL,
  `q2_target` int(11) UNSIGNED NOT NULL,
  `q3_target` int(11) NOT NULL,
  `q4_target` int(11) NOT NULL,
  `strategic_objective` int(11) UNSIGNED NOT NULL,
  `department` int(11) UNSIGNED NOT NULL,
  `status` int(2) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_p_i`
--

INSERT INTO `k_p_i` (`id`, `measure`, `yearly_target`, `q1_target`, `q2_target`, `q3_target`, `q4_target`, `strategic_objective`, `department`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, '% of Church members regularly engaged in family worship', 80, 50, 60, 70, 80, 1, 1, 0, 8, 1607520361, 8, 1648063634),
(2, 'Number of members visited', 100, 25, 25, 25, 25, 2, 1, 9, 8, 1641820657, 8, 1641820657),
(3, 'increase in the number of church members regularly attending online band meetings', 15, 5, 9, 13, 15, 1, 1, 9, 8, 1648063786, 8, 1648063786),
(4, '# of hospital and home prayer visitations for the sick, bereaved and any church/non-church member needing prayers', 50, 12, 25, 37, 50, 3, 1, 9, 8, 1648064398, 8, 1648064398),
(5, 'Church members (new and old) expressing a lifelong commitment to the church and personal, prayerful involvement in its mission', 80, 50, 60, 70, 80, 2, 1, 9, 8, 1648064477, 8, 1648064477),
(6, '% increase of Residential Fellowship Bands that are fully operational in meetings and activities', 90, 70, 75, 85, 90, 2, 1, 9, 8, 1648111094, 8, 1648111094),
(7, 'mmvygvjhj', 70, 20, 20, 20, 10, 1, 4, 9, 38, 1665063950, 38, 1665063950);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `other_name` varchar(255) DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `maiden_name` varchar(255) DEFAULT NULL,
  `date_of_birth` varchar(255) NOT NULL DEFAULT '',
  `gender` varchar(255) NOT NULL DEFAULT '',
  `marital_status` varchar(255) NOT NULL DEFAULT '',
  `membership_status` int(11) UNSIGNED NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `status` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `title`, `first_name`, `other_name`, `last_name`, `maiden_name`, `date_of_birth`, `gender`, `marital_status`, `membership_status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `status`) VALUES
(1, 'Mr.', 'Martin.', '', 'Mayembe', '', '1997-01-14', 'Male', 'Single', 1, 1607506016, 8, 1607523001, 8, 9),
(2, 'Mr.', 'Martin', '', 'Mayembe', '', '1997-01-14', 'Male', 'Single', 2, 1637585326, 9, 1637585326, 9, 9),
(3, 'Mr.', 'SILILO', 'MUYUNDA', 'MUYUNDA', '', '2020-10-13', 'Male', 'Single', 3, 1664905886, 38, 1664905886, 38, 9),
(4, 'Mr.', 'admin2', 'admin2', 'admin2', '', '2022-11-05', 'Male', 'Married', 4, 1665290382, 28, 1665290382, 28, 9);

-- --------------------------------------------------------

--
-- Table structure for table `membership_status`
--

CREATE TABLE `membership_status` (
  `id` int(11) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(255) NOT NULL DEFAULT '',
  `congregation` varchar(255) DEFAULT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `membership_status`
--

INSERT INTO `membership_status` (`id`, `status`, `type`, `congregation`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, '1', '', '', 1607506015, 8, 1607520899, 8),
(2, '1', '2', '', 1637585326, 9, 1637585326, 9),
(3, '1', '1', '', 1664905886, 38, 1664905886, 38),
(4, '2', '4', '', 1665290382, 28, 1665290382, 28);

-- --------------------------------------------------------

--
-- Table structure for table `member_baptism`
--

CREATE TABLE `member_baptism` (
  `member_baptism_id` int(11) UNSIGNED NOT NULL,
  `member_id` int(11) UNSIGNED NOT NULL,
  `baptism_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `member_type`
--

CREATE TABLE `member_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `group` int(11) UNSIGNED NOT NULL,
  `status` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member_type`
--

INSERT INTO `member_type` (`id`, `name`, `group`, `status`) VALUES
(1, 'Student', 1, 9),
(2, 'University SDA', 1, 9),
(3, 'Other SDA', 1, 9),
(4, 'Student', 2, 9),
(5, 'Sabbath School', 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `minister`
--

CREATE TABLE `minister` (
  `minister_id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `other_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `address_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `minister`
--

INSERT INTO `minister` (`minister_id`, `first_name`, `other_name`, `last_name`, `address_id`) VALUES
(1, 'Kelvin', '', 'Simukonda', 3);

-- --------------------------------------------------------

--
-- Table structure for table `offering_and_tithe`
--

CREATE TABLE `offering_and_tithe` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `receipt_id` varchar(50) NOT NULL,
  `date_of_receipt` int(11) NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `added_by` int(10) UNSIGNED NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offering_and_tithe`
--

INSERT INTO `offering_and_tithe` (`id`, `user`, `receipt_id`, `date_of_receipt`, `updated_by`, `added_by`, `created_at`, `updated_at`) VALUES
(5, 38, 'hgf543', 1664488800, 28, 28, 1666459630, 1666540048),
(8, 38, 'gfds45', 1666303200, 28, 28, 1666465553, 1666465553);

-- --------------------------------------------------------

--
-- Table structure for table `offering_and_tithe_receipts`
--

CREATE TABLE `offering_and_tithe_receipts` (
  `id` int(10) UNSIGNED NOT NULL,
  `receipt_id` varchar(50) NOT NULL,
  `fund_item` int(10) UNSIGNED NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `added_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offering_and_tithe_receipts`
--

INSERT INTO `offering_and_tithe_receipts` (`id`, `receipt_id`, `fund_item`, `amount`, `created_at`, `updated_at`, `added_by`, `updated_by`) VALUES
(1, 'E654', 1, '600.00', NULL, NULL, 28, 0),
(2, 'E654', 2, '65.00', NULL, NULL, 28, 0),
(3, 'g6543', 1, '54.00', NULL, 1666455838, 28, 28),
(4, 'g6543', 2, '4.00', NULL, 1666455838, 28, 28),
(5, 'hgf543', 1, '543.00', 1666459630, 1666459630, 28, 28),
(6, 'hgf543', 2, '49.00', 1666459630, 1666459630, 28, 28),
(7, 'jhgfd', 1, '655.00', 1666462639, 1666462639, 28, 28),
(8, 'jhgfd', 2, '653.00', 1666462639, 1666462639, 28, 28),
(9, 'ghfdsa54', 1, '554.00', 1666463905, 1666463905, 28, 28),
(10, 'ghfdsa54', 2, '65.00', 1666463905, 1666463905, 28, 28),
(11, 'gfds45', 1, '565.60', 1666465553, 1666465553, 28, 28),
(12, 'gfds45', 2, '7676.98', 1666465553, 1666465553, 28, 28),
(13, 'fghj6', 1, '0.00', 1666466041, 1666466041, 28, 28),
(14, 'fghj6', 2, '0.00', 1666466041, 1666466041, 28, 28),
(15, 'hgf543', 3, '765.00', 1666540048, 1666540048, 28, 28);

-- --------------------------------------------------------

--
-- Table structure for table `payment_request`
--

CREATE TABLE `payment_request` (
  `id` int(10) UNSIGNED NOT NULL,
  `requested_by` int(11) UNSIGNED NOT NULL,
  `department` int(11) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `strategic_area` text DEFAULT NULL,
  `date_required` int(11) NOT NULL,
  `payment_to_be_made_to` text NOT NULL,
  `purpose` text NOT NULL,
  `requested_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `processed_by` int(10) UNSIGNED DEFAULT NULL,
  `processed_at` int(11) DEFAULT NULL,
  `processed_amount` int(11) DEFAULT NULL,
  `processed_comment` text DEFAULT NULL,
  `processed_by_signature` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_request`
--

INSERT INTO `payment_request` (`id`, `requested_by`, `department`, `amount`, `strategic_area`, `date_required`, `payment_to_be_made_to`, `purpose`, `requested_at`, `updated_at`, `status`, `processed_by`, `processed_at`, `processed_amount`, `processed_comment`, `processed_by_signature`) VALUES
(1, 38, 1, 2000, 'strategic area', 2022, 'myself', 'poiuytreas', 1665113783, 1665118915, 2, 28, 1665118915, 455, 'qewrtygjhn', NULL),
(3, 28, 3, 876, 'oiuytrewa', 1665180000, 'jhbgvcxz', 'kjbgnvcxz', 1665114094, 1665123277, 1, 28, 1665123277, NULL, '', NULL),
(4, 38, 1, 4546, 'awsdxfcgvhbjnml,', 1665698400, 'zsdxfcvgbnm,.', 'dfgvhbjnm,./', 1665123403, 1665123403, 0, NULL, NULL, NULL, NULL, NULL),
(5, 38, 4, 5467, 'sdfghj', 1668466800, 'zdfdghjk', 'fdghjk', 1668339318, 1668339318, 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reminders_and_notices`
--

CREATE TABLE `reminders_and_notices` (
  `id` int(10) UNSIGNED NOT NULL,
  `date_of_notice` int(11) NOT NULL,
  `title` text NOT NULL,
  `body` text NOT NULL,
  `send_to` varchar(50) DEFAULT NULL,
  `audience` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `added_by` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reminders_and_notices`
--

INSERT INTO `reminders_and_notices` (`id`, `date_of_notice`, `title`, `body`, `send_to`, `audience`, `status`, `created_at`, `updated_at`, `added_by`) VALUES
(2, 1668034800, 'HELLO', '<p>Welcome</p>', 'department', 4, 1, 1668111705, 1668115407, 28),
(3, 1668034800, 'WELCOME', '<p>message to <b>Unisda </b>System</p>', 'all', 0, 1, 1668114073, 1668116825, 28),
(4, 1668118200, 'NOTICES TYGBDFHJ DFHJDFHJ DFKJ', '<p>notification iof the&nbsp;</p>', 'all', 1, 1, 1668118240, 1668119175, 28);

-- --------------------------------------------------------

--
-- Table structure for table `right`
--

CREATE TABLE `right` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(1000) DEFAULT NULL,
  `status` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `right`
--

INSERT INTO `right` (`id`, `name`, `description`, `status`) VALUES
(1, 'Manage Users', 'This right allows a user to create, edit, delete and restore other users. It is given to the system Administrator only by default.', 9),
(2, 'Create Member', 'This right allows a user to create a church member corresponding to the user. Every user except the administrator has this right.', 9),
(3, 'Manage Member', 'This right allows a user to create, edit, delete or restore church members in the system. This right is given to the Clerks department leader by default.', 9),
(4, 'Manage Department', 'This right allows a user to do all functions that pertain to a department in the church except from creating one. This right is given to departmental heads by default.', 9),
(5, 'Manage Interests', 'This right allows a user to create, view, edit or delete interest information. This right is given to the Interest Coordinator Department leader by default.', 9),
(6, 'Manage Strategic Plan', 'This allow user to Manage Strategic Plan', 9),
(7, 'Church Minister', NULL, 9);

-- --------------------------------------------------------

--
-- Table structure for table `right_status`
--

CREATE TABLE `right_status` (
  `id` int(11) UNSIGNED NOT NULL,
  `role` int(11) UNSIGNED NOT NULL,
  `right` int(11) UNSIGNED NOT NULL,
  `status` int(2) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `right_status`
--

INSERT INTO `right_status` (`id`, `role`, `right`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 2, 2, 9, 1, 1633446777, 1, 1634224808),
(2, 2, 1, 0, 1, 1633446876, 1, 1633446876),
(3, 6, 1, 9, 0, 1633703562, 0, 1633703562),
(7, 2, 4, 9, 0, 1634224794, 0, 1634224794),
(8, 4, 1, 9, 0, 1634231124, 0, 1634231124),
(9, 1, 2, 9, 1, 0, 1, 0),
(10, 6, 3, 9, 1, 0, 1, 0),
(11, 7, 4, 9, 1, 0, 1, 0),
(12, 6, 6, 9, 28, 0, 28, 0),
(13, 6, 1, 9, 28, 0, 28, 0),
(14, 6, 2, 9, 28, 0, 28, 0),
(15, 5, 7, 9, 28, 0, 28, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text DEFAULT NULL,
  `status` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `description`, `status`) VALUES
(1, 'Church Member', 'Create Member', 9),
(2, 'Departmental Head', 'Manage Department', 9),
(3, 'Head Elder', '', 9),
(4, 'Elder', '', 9),
(5, 'Church Pastor', 'Church Minister', 9),
(6, 'Admin', 'Manage Users', 9),
(7, 'Club Leader', 'Manage Club', 9);

-- --------------------------------------------------------

--
-- Table structure for table `role_status`
--

CREATE TABLE `role_status` (
  `id` int(11) UNSIGNED NOT NULL,
  `role` int(11) UNSIGNED NOT NULL,
  `department` int(11) UNSIGNED DEFAULT NULL,
  `club` int(11) UNSIGNED DEFAULT NULL,
  `year` year(4) NOT NULL,
  `user` int(11) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL,
  `status` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_status`
--

INSERT INTO `role_status` (`id`, `role`, `department`, `club`, `year`, `user`, `created_by`, `created_at`, `updated_by`, `updated_at`, `status`) VALUES
(1, 1, NULL, NULL, 2023, 1, 1, 0, 1, 1665048785, 0),
(2, 1, NULL, NULL, 2022, 6, 2, 1607497071, 2, 1665009824, 0),
(4, 2, 1, NULL, 2020, 8, 2, 1607497191, 2, 1607497191, 0),
(5, 1, NULL, NULL, 2022, 9, 1, 1637584891, 1, 1665008512, 0),
(6, 2, 3, NULL, 2022, 10, 1, 1641736921, 1, 1641736921, 0),
(7, 1, 1, NULL, 2022, 11, 1, 1641737466, 1, 1641737466, 0),
(8, 1, 1, NULL, 2022, 13, 1, 1641743472, 1, 1641743472, 0),
(9, 1, 1, NULL, 2022, 14, 1, 1641743558, 1, 1641743558, 0),
(10, 1, 1, NULL, 2022, 15, 1, 1641743678, 1, 1641743678, 0),
(11, 1, 1, NULL, 2022, 16, 1, 1641743861, 1, 1641743861, 0),
(12, 1, 1, NULL, 2024, 17, 1, 1644768838, 1, 1644768838, 0),
(13, 1, 1, NULL, 2024, 18, 1, 1644769025, 1, 1644769025, 0),
(14, 1, 1, NULL, 2024, 19, 1, 1644769717, 1, 1644769717, 0),
(15, 1, 1, NULL, 2024, 20, 1, 1644770355, 1, 1644770355, 0),
(16, 1, 1, NULL, 2024, 21, 1, 1644770889, 1, 1644770889, 0),
(17, 1, 1, NULL, 2022, 23, 23, 1644824257, 23, 1644824257, 0),
(18, 1, NULL, NULL, 2022, 24, 24, 1644824471, 24, 1665009611, 0),
(19, 1, NULL, NULL, 2022, 26, 26, 1645015846, 26, 1645015846, 0),
(20, 1, NULL, NULL, 2022, 27, 27, 1645017186, 27, 1645017186, 0),
(21, 6, 1, NULL, 2022, 28, 28, 1664053980, 28, 1664966331, 9),
(22, 2, 4, NULL, 2022, 38, 38, 1664901918, 38, 1668337670, 9);

-- --------------------------------------------------------

--
-- Table structure for table `strategic_objective`
--

CREATE TABLE `strategic_objective` (
  `id` int(11) UNSIGNED NOT NULL,
  `objective` varchar(255) NOT NULL,
  `strategic_theme` int(11) UNSIGNED NOT NULL,
  `department` int(11) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL,
  `status` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `strategic_objective`
--

INSERT INTO `strategic_objective` (`id`, `objective`, `strategic_theme`, `department`, `created_by`, `created_at`, `updated_by`, `updated_at`, `status`) VALUES
(1, 'Increase Knowlegde of God', 2, 1, 8, 1607520301, 8, 1647763760, 9),
(2, 'Enhanced Fellowship', 2, 1, 8, 1641820326, 8, 1647763783, 9),
(3, 'Improved Care Systems', 2, 1, 9, 1647763802, 9, 1647763802, 9),
(4, 'Improved Discipleship', 2, 1, 9, 1647763824, 9, 1647763824, 9),
(5, 'objective', 1, 4, 38, 1665063822, 38, 1665063822, 9);

-- --------------------------------------------------------

--
-- Table structure for table `strategic_plan`
--

CREATE TABLE `strategic_plan` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `start_year` year(4) NOT NULL,
  `finish_year` year(4) NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL,
  `status` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `strategic_plan`
--

INSERT INTO `strategic_plan` (`id`, `name`, `description`, `start_year`, `finish_year`, `created_by`, `created_at`, `updated_by`, `updated_at`, `status`) VALUES
(2, 'I WILL GO AND GROW', 'This is strategic plan centered on mission', 2020, 2024, 2, 0, 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `strategic_theme`
--

CREATE TABLE `strategic_theme` (
  `id` int(11) UNSIGNED NOT NULL,
  `theme` varchar(255) NOT NULL,
  `strategic_plan` varchar(255) NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL,
  `status` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `strategic_theme`
--

INSERT INTO `strategic_theme` (`id`, `theme`, `strategic_plan`, `created_by`, `created_at`, `updated_by`, `updated_at`, `status`) VALUES
(1, 'Reach Out With God', '2', 2, 1607520228, 2, 1607520228, 9),
(2, 'Reach In With  God', '2', 2, 1607617650, 2, 1607617650, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tithe_offering`
--

CREATE TABLE `tithe_offering` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `tithe` int(11) NOT NULL,
  `local_church_offering` int(11) NOT NULL,
  `conference_offering` int(11) NOT NULL,
  `campmeeting_offering` int(11) NOT NULL,
  `other_local_church_offering` int(11) NOT NULL,
  `offer_conference_offering` int(11) NOT NULL,
  `deposited` date NOT NULL,
  `added` int(11) NOT NULL,
  `updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tithe_offering`
--

INSERT INTO `tithe_offering` (`id`, `user_id`, `tithe`, `local_church_offering`, `conference_offering`, `campmeeting_offering`, `other_local_church_offering`, `offer_conference_offering`, `deposited`, `added`, `updated`) VALUES
(8, 3, 45554, 56, 54, 5, 65, 67, '2022-09-28', 1664385561, 1664385561),
(10, 26, 400, 0, 0, 0, 7, 0, '2022-09-27', 1664450379, 1664450379);

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `upload_id` int(9) UNSIGNED NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `document_url` text NOT NULL,
  `application_id` int(9) UNSIGNED NOT NULL,
  `user_id` int(9) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `other_name` varchar(255) DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password_hash` varchar(255) NOT NULL DEFAULT '',
  `auth` varchar(255) NOT NULL DEFAULT '',
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `role` int(11) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `other_name`, `last_name`, `email`, `password_hash`, `auth`, `created_at`, `updated_at`, `updated_by`, `role`, `status`) VALUES
(1, 'Admin', '', 'Admin', 'admin@email.com', '$2y$13$i04nP75ZAxggNe3KprvBge55TxnNi6Et58tixHKFEN3P7CmSDOdnC', 'yuw2baYwVnVtEaeNew0jIZNkaWBLNnTE', 0, 1665048785, NULL, 1, 9),
(2, 'Test', '', 'Test', 'test@email.com', '$2y$13$G1FT8apX9OTkUm79pJ26z.hlVmviEEJ90G14aRSg6rILMXYyLdzeC', 'Ig4u3wzYVZgokDh3f2mBpwm91iL8zLrr', 1579770825, 1644828063, 1, 6, 9),
(3, 'Second', '', 'Test', 't@email.com', '$2y$13$zrNaYXE.jiYKhe/QmAv86eGzISVZgO1xh6gwoF0tQtmYXyS2SbWr.', 'sJmDmx52oq-E4fOGyQnXIbUyHwBbwd53', 1579770878, 1644827775, 1, 1, 9),
(4, 'Third', '', 'Test', 'g@email.com', '$2y$13$.ye/URgfTp4t3FdV7fOz4expwe/2DlhJzcw3WvBbtu7IDhaAAgvQy', 'hzN7VHJQmoBu62tQtZROAFuJYbHnFJre', 1579770903, 1579770903, 1, 1, 9),
(6, 'Martin', '', 'Mayembe', 'mayembem34@gmail.com', '$2y$13$OjCQuu5VJFQUrcGShBAzuuDz6gBYzq5s6liH051tYAWc3q8EciqFO', '_zXByQBa7QsaEeuZQPbls1DbKXh0qLQK', 1607497070, 1607497313, 1, 2, 0),
(9, 'Martin', '', 'Mayembe', 'mayembem@hotmail.com', '$2y$13$bSw3NH.xKctZx8bwdwC6buWGbhcIPH2yPTPS078yyg4zwK.OynTYS', 'Ic3zZcuzSzJqDNgEfQXUz_n6ZlTYh9qo', 1637584891, 1665008512, 1, 1, 9),
(24, 'Martin', '', 'Chishimba', 'sdasingles0@gmail.com', '$2y$13$d0AvI76qWb9uKabtXaSAa.5sHHVyEsUKrUkm0piDJrPWJRCKtJnQy', 'TXALkveOTxrDO9Xrm5jnyEDFKgOFekjH', 1644824471, 1665007218, 1, 2, 9),
(26, 'Martin', '', 'Chishimba', 'martinchishimba52@gmail.com', '$2y$13$9NS6xM0VrI7q6t9upWdaxumEIULl9YmAOSpufrGt54aJBODqn.T22', '4hGmU7Db4LocCm75_DY2NN2uYYac9heu', 1645015846, 1668124736, 1, 1, 9),
(27, 'Zizwe', '', 'Mtonga', 'zizwemtonga23@gmail.com', '$2y$13$OVeK/sLd39lvPw0mcfhmfumByu2yMtj6qkoyLM5/Pinu51n.rd5AK', 'G2MLEwF8z8zQ2AnzW6njcHzxvAwIoYup', 1645017185, 1645018115, 1, 1, 9),
(28, 'admin2', '', 'admin2', 'admin2@admin.com', '$2y$13$twrK0oVk4mYkgOOhFKrm1.FXj04NyWXLxX9daQoFzAk/ivH0Uearm', 'ZOsh3qu3seml3iupC4zc4l6M5tZm41Co', 1664053574, 1664966331, 1, 6, 9),
(38, 'muyunda', '', 'sililo', 'sililosililo82@gmail.com', '$2y$13$m62peQOWI.UFK/ayPGrwc.3Ul635UGfJv3xWgXO1B.xvz9nil7kma', 'G-06YSgwKpHmk06-zjyyyhbmcx8gW5-1', 1664901714, 1668337780, 1, 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user_signatures`
--

CREATE TABLE `user_signatures` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `signature` text DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_signatures`
--

INSERT INTO `user_signatures` (`id`, `user_id`, `signature`, `created_at`, `updated_at`) VALUES
(4, 28, 'signature_285_09-10-2022_05-47-21.png', 1665330441, 1665330441);

-- --------------------------------------------------------

--
-- Table structure for table `wedding_notices`
--

CREATE TABLE `wedding_notices` (
  `id` int(11) NOT NULL,
  `groom_first_name` varchar(255) NOT NULL,
  `groom_last_name` varchar(255) NOT NULL,
  `bride_first_name` varchar(255) NOT NULL,
  `bride_last_name` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `more_info` text NOT NULL,
  `wedding_date` int(11) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `family` int(10) UNSIGNED DEFAULT NULL,
  `groom_church` varchar(255) DEFAULT NULL,
  `bride_church` varchar(255) DEFAULT NULL,
  `is_bride_baptised` varchar(10) NOT NULL,
  `is_groom_baptised` varchar(10) NOT NULL,
  `officiating_minister_name` varchar(255) DEFAULT NULL,
  `added_by` int(10) UNSIGNED NOT NULL,
  `processed_by` int(10) UNSIGNED DEFAULT NULL,
  `processed_at` int(10) UNSIGNED DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wedding_notices`
--

INSERT INTO `wedding_notices` (`id`, `groom_first_name`, `groom_last_name`, `bride_first_name`, `bride_last_name`, `address`, `more_info`, `wedding_date`, `phone_number`, `family`, `groom_church`, `bride_church`, `is_bride_baptised`, `is_groom_baptised`, `officiating_minister_name`, `added_by`, `processed_by`, `processed_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 'asdfgvb', 'aszdxfgvhbjnm', 'azSXDFGHJ', 'SDFGHJKLFDSZ', '', '', 2022, '', NULL, '', '', 'yes', 'yes', '', 28, 28, 1665608927, 1, 1665357891, 1665608927),
(2, 'rwefghn', 'jkhgfds', 'edgfhb', 'hgfdssfddd', '', '', 1666735200, '', NULL, '', '', 'yes', 'yes', '', 28, 28, 1665957575, 1, 1665358677, 1665957575),
(3, 'fdghjkl;', 'cgvhjkl;.\'', 'fghjkopl,;', 'cgvhjkl;', '', '', 1670454000, '', NULL, '', '', 'yes', 'yes', '', 28, NULL, NULL, 0, 1665959126, 1665959126);

-- --------------------------------------------------------

--
-- Table structure for table `weekly_schedule`
--

CREATE TABLE `weekly_schedule` (
  `id` int(11) NOT NULL,
  `day` date NOT NULL,
  `theme` tinytext NOT NULL,
  `elder_one` int(11) UNSIGNED NOT NULL,
  `elder_two` int(11) UNSIGNED DEFAULT NULL,
  `clerk_one` int(11) UNSIGNED DEFAULT NULL,
  `clerk_two` int(11) UNSIGNED DEFAULT NULL,
  `deacon_one` int(11) UNSIGNED DEFAULT NULL,
  `deacon_two` int(11) UNSIGNED DEFAULT NULL,
  `cares_concern` text DEFAULT NULL,
  `announcements` text DEFAULT NULL,
  `sabbath_school` text DEFAULT NULL,
  `main_service` text DEFAULT NULL,
  `afternoon_service` text DEFAULT NULL,
  `personal_ministries` text DEFAULT NULL,
  `pastor_coner` text DEFAULT NULL,
  `health_message` text DEFAULT NULL,
  `other` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weekly_schedule`
--

INSERT INTO `weekly_schedule` (`id`, `day`, `theme`, `elder_one`, `elder_two`, `clerk_one`, `clerk_two`, `deacon_one`, `deacon_two`, `cares_concern`, `announcements`, `sabbath_school`, `main_service`, `afternoon_service`, `personal_ministries`, `pastor_coner`, `health_message`, `other`) VALUES
(2, '2022-10-08', 'the theme to be announced', 28, NULL, NULL, NULL, NULL, NULL, '', '', '<p>pfo:kgo</p>', '', '', '', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `work_place`
--

CREATE TABLE `work_place` (
  `id` int(11) UNSIGNED NOT NULL,
  `name_of_work_place` varchar(255) NOT NULL DEFAULT '',
  `type_of_business` varchar(255) NOT NULL DEFAULT '',
  `job_title` varchar(255) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `salary` varchar(255) NOT NULL DEFAULT '',
  `created_at` int(11) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `member` int(11) UNSIGNED NOT NULL,
  `status` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `work_place`
--

INSERT INTO `work_place` (`id`, `name_of_work_place`, `type_of_business`, `job_title`, `address`, `salary`, `created_at`, `created_by`, `updated_at`, `updated_by`, `member`, `status`) VALUES
(1, 'National Science and Technology Council', 'Employed', 'Intern (Acting Programme Assistant', 'National Science and Technology Council, P.O. Box 51309, Haile Selassie Avenue Road, Curriculum Development Centre building, Longacres.', '3000', 1637585326, 9, 1637585326, 9, 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accomplished_activity`
--
ALTER TABLE `accomplished_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `initiative` (`initiative`),
  ADD KEY `department` (`department`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `kpi` (`kpi`),
  ADD KEY `strategic_objective` (`strategic_objective`),
  ADD KEY `strategic_theme` (`strategic_theme`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_address_createdby` (`created_by`),
  ADD KEY `fk_address_updatedby` (`updated_by`),
  ADD KEY `fk_address_member` (`member`);

--
-- Indexes for table `baptism`
--
ALTER TABLE `baptism`
  ADD PRIMARY KEY (`baptism_id`),
  ADD KEY `baptising_minister` (`baptising_minister`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `baptism_interest`
--
ALTER TABLE `baptism_interest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `recieved_by` (`recieved_by`);

--
-- Indexes for table `child_dedication`
--
ALTER TABLE `child_dedication`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `church_contacts`
--
ALTER TABLE `church_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `position_id` (`position_id`);

--
-- Indexes for table `church_officers`
--
ALTER TABLE `church_officers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `position_id` (`position_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `year` (`year`),
  ADD KEY `added_by` (`added_by`);

--
-- Indexes for table `church_positions`
--
ALTER TABLE `church_positions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `club_report`
--
ALTER TABLE `club_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club` (`club`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `conference_report`
--
ALTER TABLE `conference_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district_pastor` (`district_pastor`),
  ADD KEY `strategic_plan` (`strategic_plan`),
  ADD KEY `department` (`department`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `fk_dep_ub` (`updated_at`);

--
-- Indexes for table `departmental_expense_items`
--
ALTER TABLE `departmental_expense_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fund_item` (`fund_item`);

--
-- Indexes for table `department_member`
--
ALTER TABLE `department_member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member` (`member`),
  ADD KEY `department` (`department`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `club` (`club`);

--
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_family_head` (`head_of_family`),
  ADD KEY `fk_family_spouse` (`spouse`),
  ADD KEY `fk_family_createdby` (`created_by`),
  ADD KEY `fk_family_updatedby` (`updated_by`);

--
-- Indexes for table `family_children`
--
ALTER TABLE `family_children`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fc_family` (`family`),
  ADD KEY `fk_fc_child` (`child`),
  ADD KEY `fk_fc_createdby` (`created_by`),
  ADD KEY `fk_fc_updatedby` (`updated_by`);

--
-- Indexes for table `family_other`
--
ALTER TABLE `family_other`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fo_family` (`family`),
  ADD KEY `fk_fo_other` (`other`),
  ADD KEY `fk_fo_createdby` (`created_by`),
  ADD KEY `fk_fo_updatedby` (`updated_by`);

--
-- Indexes for table `fund_items`
--
ALTER TABLE `fund_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_name` (`item_name`),
  ADD KEY `fund_category` (`fund_category`),
  ADD KEY `year` (`year`),
  ADD KEY `dept` (`dept`);

--
-- Indexes for table `funeral_notices`
--
ALTER TABLE `funeral_notices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notified_by` (`notified_by`);

--
-- Indexes for table `incomes_and_expenses`
--
ALTER TABLE `incomes_and_expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fund_item` (`fund_item`),
  ADD KEY `trans_type` (`trans_type`),
  ADD KEY `trans_type_2` (`trans_type`),
  ADD KEY `id` (`id`,`created_at`,`updated_at`),
  ADD KEY `id_2` (`id`,`created_at`,`updated_by`),
  ADD KEY `added_by` (`added_by`);

--
-- Indexes for table `initiative`
--
ALTER TABLE `initiative`
  ADD PRIMARY KEY (`id`),
  ADD KEY `responsible_person` (`responsible_person`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `department` (`department_id`),
  ADD KEY `kpi` (`kpi`),
  ADD KEY `strategic_objective` (`strategic_objective`),
  ADD KEY `strategic_theme` (`strategic_theme`);

--
-- Indexes for table `interest`
--
ALTER TABLE `interest`
  ADD KEY `id` (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `k_p_i`
--
ALTER TABLE `k_p_i`
  ADD PRIMARY KEY (`id`),
  ADD KEY `strategic_objective` (`strategic_objective`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `department` (`department`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_member_status` (`membership_status`),
  ADD KEY `fk_member_createdby` (`created_by`),
  ADD KEY `fk_member_updatedby` (`updated_by`);

--
-- Indexes for table `membership_status`
--
ALTER TABLE `membership_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ms_createdby` (`created_by`),
  ADD KEY `fk_ms_updatedby` (`updated_by`);

--
-- Indexes for table `member_baptism`
--
ALTER TABLE `member_baptism`
  ADD PRIMARY KEY (`member_baptism_id`),
  ADD KEY `baptism_id` (`baptism_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `member_type`
--
ALTER TABLE `member_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minister`
--
ALTER TABLE `minister`
  ADD PRIMARY KEY (`minister_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `offering_and_tithe`
--
ALTER TABLE `offering_and_tithe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reciept_id` (`receipt_id`),
  ADD KEY `user` (`user`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `added_by` (`added_by`);

--
-- Indexes for table `offering_and_tithe_receipts`
--
ALTER TABLE `offering_and_tithe_receipts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fund_item` (`fund_item`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `reciept_id` (`receipt_id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `payment_request`
--
ALTER TABLE `payment_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requested_by` (`requested_by`),
  ADD KEY `department` (`department`),
  ADD KEY `processed_by` (`processed_by`);

--
-- Indexes for table `reminders_and_notices`
--
ALTER TABLE `reminders_and_notices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `added_by` (`added_by`);

--
-- Indexes for table `right`
--
ALTER TABLE `right`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `right_status`
--
ALTER TABLE `right_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`),
  ADD KEY `right` (`right`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_status`
--
ALTER TABLE `role_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`),
  ADD KEY `department` (`department`),
  ADD KEY `user` (`user`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `club` (`club`);

--
-- Indexes for table `strategic_objective`
--
ALTER TABLE `strategic_objective`
  ADD PRIMARY KEY (`id`),
  ADD KEY `strategic_theme` (`strategic_theme`),
  ADD KEY `department` (`department`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `strategic_plan`
--
ALTER TABLE `strategic_plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `strategic_theme`
--
ALTER TABLE `strategic_theme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `tithe_offering`
--
ALTER TABLE `tithe_offering`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user_id`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`upload_id`),
  ADD KEY `application_id` (`application_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_role` (`role`),
  ADD KEY `fk_user_updatedby` (`updated_by`);

--
-- Indexes for table `user_signatures`
--
ALTER TABLE `user_signatures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `wedding_notices`
--
ALTER TABLE `wedding_notices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `family` (`family`),
  ADD KEY `added_by` (`added_by`);

--
-- Indexes for table `weekly_schedule`
--
ALTER TABLE `weekly_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `elder_one` (`elder_one`),
  ADD KEY `clerk_one` (`clerk_one`),
  ADD KEY `elder_two` (`elder_two`),
  ADD KEY `clerk_two` (`clerk_two`),
  ADD KEY `deacon_one` (`deacon_one`),
  ADD KEY `deacon_two` (`deacon_two`);

--
-- Indexes for table `work_place`
--
ALTER TABLE `work_place`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wp_createdby` (`created_by`),
  ADD KEY `fk_wp_updatedby` (`updated_by`),
  ADD KEY `fk_wp_member` (`member`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accomplished_activity`
--
ALTER TABLE `accomplished_activity`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `baptism`
--
ALTER TABLE `baptism`
  MODIFY `baptism_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `baptism_interest`
--
ALTER TABLE `baptism_interest`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `child_dedication`
--
ALTER TABLE `child_dedication`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `church_contacts`
--
ALTER TABLE `church_contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `church_officers`
--
ALTER TABLE `church_officers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `church_positions`
--
ALTER TABLE `church_positions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `club_report`
--
ALTER TABLE `club_report`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conference_report`
--
ALTER TABLE `conference_report`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departmental_expense_items`
--
ALTER TABLE `departmental_expense_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `department_member`
--
ALTER TABLE `department_member`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `family_children`
--
ALTER TABLE `family_children`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `family_other`
--
ALTER TABLE `family_other`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fund_items`
--
ALTER TABLE `fund_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `funeral_notices`
--
ALTER TABLE `funeral_notices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `incomes_and_expenses`
--
ALTER TABLE `incomes_and_expenses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `initiative`
--
ALTER TABLE `initiative`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `k_p_i`
--
ALTER TABLE `k_p_i`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `membership_status`
--
ALTER TABLE `membership_status`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `member_baptism`
--
ALTER TABLE `member_baptism`
  MODIFY `member_baptism_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_type`
--
ALTER TABLE `member_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `minister`
--
ALTER TABLE `minister`
  MODIFY `minister_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `offering_and_tithe`
--
ALTER TABLE `offering_and_tithe`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `offering_and_tithe_receipts`
--
ALTER TABLE `offering_and_tithe_receipts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payment_request`
--
ALTER TABLE `payment_request`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reminders_and_notices`
--
ALTER TABLE `reminders_and_notices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `right`
--
ALTER TABLE `right`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `right_status`
--
ALTER TABLE `right_status`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `role_status`
--
ALTER TABLE `role_status`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `strategic_objective`
--
ALTER TABLE `strategic_objective`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `strategic_plan`
--
ALTER TABLE `strategic_plan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `strategic_theme`
--
ALTER TABLE `strategic_theme`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tithe_offering`
--
ALTER TABLE `tithe_offering`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `upload_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user_signatures`
--
ALTER TABLE `user_signatures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wedding_notices`
--
ALTER TABLE `wedding_notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `weekly_schedule`
--
ALTER TABLE `weekly_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `work_place`
--
ALTER TABLE `work_place`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `fk_address_createdby` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_address_member` FOREIGN KEY (`member`) REFERENCES `member` (`id`),
  ADD CONSTRAINT `fk_address_updatedby` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `reminders_and_notices`
--
ALTER TABLE `reminders_and_notices`
  ADD CONSTRAINT `reminders_and_notices_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
