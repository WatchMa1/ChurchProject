-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2022 at 09:50 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
(13, 0, 'green', 'Activity was done but no survey done to check the score', 1, 16, 5, 4, 2, 1, 9, 8, 1648114658, 8, 1648114658);

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
(3, 'UNZA', '097777777', '097777777', '', '', '', 'nstcpromo@gmail.com', 'nstcpromo@gmail.com', '', 1659037478, NULL, 1659037478, NULL, NULL);

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
(3, 'Technical Department', '', 9, 1, 1638299096, 1, 1638299096);

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
(1, 1, 1, 0, 'Member', 2020, 9, 8, 1607614740, 8, 1607614740);

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
(2, 'Mayembe', 2, NULL, 'Family_Photo_9_22-11-2021_01-42-57.jpg', 'Kalundu', 0, 1637584977, 9, 1637585326, 9);

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
(6, '% increase of Residential Fellowship Bands that are fully operational in meetings and activities', 90, 70, 75, 85, 90, 2, 1, 9, 8, 1648111094, 8, 1648111094);

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
(2, 'Mr.', 'Martin', '', 'Mayembe', '', '1997-01-14', 'Male', 'Single', 2, 1637585326, 9, 1637585326, 9, 9);

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
(2, '1', '2', '', 1637585326, 9, 1637585326, 9);

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
(5, 'Manage Interests', 'This right allows a user to create, view, edit or delete interest information. This right is given to the Interest Coordinator Department leader by default.', 9);

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
(11, 7, 4, 9, 1, 0, 1, 0);

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
(5, 'Church Pastor', '', 9),
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
(1, 6, 0, NULL, 0000, 1, 1, 0, 1, 0, 0),
(2, 2, 1, NULL, 2020, 6, 2, 1607497071, 2, 1607497071, 0),
(4, 2, 1, NULL, 2020, 8, 2, 1607497191, 2, 1607497191, 0),
(5, 2, 1, NULL, 2022, 9, 1, 1637584891, 1, 1637584891, 0),
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
(18, 1, 1, NULL, 2022, 24, 24, 1644824471, 24, 1644824471, 0),
(19, 1, NULL, NULL, 2022, 26, 26, 1645015846, 26, 1645015846, 0),
(20, 1, NULL, NULL, 2022, 27, 27, 1645017186, 27, 1645017186, 0);

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
(4, 'Improved Discipleship', 2, 1, 9, 1647763824, 9, 1647763824, 9);

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
(1, 'Admin', '', 'Admin', 'admin@email.com', '$2y$13$i04nP75ZAxggNe3KprvBge55TxnNi6Et58tixHKFEN3P7CmSDOdnC', 'yuw2baYwVnVtEaeNew0jIZNkaWBLNnTE', 0, 1632840885, NULL, 6, 9),
(2, 'Test', '', 'Test', 'test@email.com', '$2y$13$G1FT8apX9OTkUm79pJ26z.hlVmviEEJ90G14aRSg6rILMXYyLdzeC', 'Ig4u3wzYVZgokDh3f2mBpwm91iL8zLrr', 1579770825, 1644828063, 1, 6, 9),
(3, 'Second', '', 'Test', 't@email.com', '$2y$13$zrNaYXE.jiYKhe/QmAv86eGzISVZgO1xh6gwoF0tQtmYXyS2SbWr.', 'sJmDmx52oq-E4fOGyQnXIbUyHwBbwd53', 1579770878, 1644827775, 1, 1, 9),
(4, 'Third', '', 'Test', 'g@email.com', '$2y$13$.ye/URgfTp4t3FdV7fOz4expwe/2DlhJzcw3WvBbtu7IDhaAAgvQy', 'hzN7VHJQmoBu62tQtZROAFuJYbHnFJre', 1579770903, 1579770903, 1, 1, 9),
(5, 'Martin', '', 'Mayembe', 'mayembem34@gmail.com', '$2y$13$R86/oJRfsA19B7lwiTv6bOeQVEm7NVzqHvXBNx0N7CP4MdmN2suQ.', 'rhahUkFwPViIrlQlSnOhARMMT4vKujU7', 1607496966, 1607497333, 1, 2, 0),
(6, 'Martin', '', 'Mayembe', 'mayembem34@gmail.com', '$2y$13$OjCQuu5VJFQUrcGShBAzuuDz6gBYzq5s6liH051tYAWc3q8EciqFO', '_zXByQBa7QsaEeuZQPbls1DbKXh0qLQK', 1607497070, 1607497313, 1, 2, 0),
(7, 'Martin', '', 'Mayembe', 'mayembem34@gmail.com', '$2y$13$5TfwzcGD4hjUjc8YO6OZBOWiUz.pRruiXejkeZwPPd89POQ4ukkrW', '79itgtPOUZT59SrDxY4be0j4awfCO5VR', 1607497114, 1607497295, 1, 2, 0),
(8, 'Martin', '', 'Mayembe', 'mayembem34@gmail.com', '$2y$13$kiqczP47U4F8ODp8H9Bcq.krIv/.kkcWAuZuhJVxYrEyg74F6I6/i', 'QH_SCu-h0NzwsLE-B_vWI3PVYxGJkw8H', 1607497191, 1607497191, 1, 2, 9),
(9, 'Martin', '', 'Mayembe', 'mayembem@hotmail.com', '$2y$13$bSw3NH.xKctZx8bwdwC6buWGbhcIPH2yPTPS078yyg4zwK.OynTYS', 'Ic3zZcuzSzJqDNgEfQXUz_n6ZlTYh9qo', 1637584891, 1637584891, 1, 2, 9),
(24, 'Martin', '', 'Chishimba', 'sdasingles0@gmail.com', '$2y$13$d0AvI76qWb9uKabtXaSAa.5sHHVyEsUKrUkm0piDJrPWJRCKtJnQy', 'TXALkveOTxrDO9Xrm5jnyEDFKgOFekjH', 1644824471, 1644826946, 1, 1, 9),
(26, 'Martin', '', 'Chishimba', 'martinchishimba52@gmail.com', '$2y$13$9NS6xM0VrI7q6t9upWdaxumEIULl9YmAOSpufrGt54aJBODqn.T22', '4hGmU7Db4LocCm75_DY2NN2uYYac9heu', 1645015846, 1651235972, 1, 1, 8),
(27, 'Zizwe', '', 'Mtonga', 'zizwemtonga23@gmail.com', '$2y$13$OVeK/sLd39lvPw0mcfhmfumByu2yMtj6qkoyLM5/Pinu51n.rd5AK', 'G2MLEwF8z8zQ2AnzW6njcHzxvAwIoYup', 1645017185, 1645018115, 1, 1, 9);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `baptism`
--
ALTER TABLE `baptism`
  MODIFY `baptism_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department_member`
--
ALTER TABLE `department_member`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `initiative`
--
ALTER TABLE `initiative`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `k_p_i`
--
ALTER TABLE `k_p_i`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `membership_status`
--
ALTER TABLE `membership_status`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `right`
--
ALTER TABLE `right`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `right_status`
--
ALTER TABLE `right_status`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `role_status`
--
ALTER TABLE `role_status`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `strategic_objective`
--
ALTER TABLE `strategic_objective`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `upload_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `work_place`
--
ALTER TABLE `work_place`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accomplished_activity`
--
ALTER TABLE `accomplished_activity`
  ADD CONSTRAINT `fk_acc-act_cb` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_acc-act_ub` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `fk_address_createdby` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_address_member` FOREIGN KEY (`member`) REFERENCES `member` (`id`),
  ADD CONSTRAINT `fk_address_updatedby` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `baptism`
--
ALTER TABLE `baptism`
  ADD CONSTRAINT `baptism_ibfk_1` FOREIGN KEY (`baptising_minister`) REFERENCES `minister` (`minister_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `fk_dep_cb` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_dep_ub` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `member_baptism`
--
ALTER TABLE `member_baptism`
  ADD CONSTRAINT `member_baptism_ibfk_1` FOREIGN KEY (`baptism_id`) REFERENCES `baptism` (`baptism_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_baptism_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `minister`
--
ALTER TABLE `minister`
  ADD CONSTRAINT `minister_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
