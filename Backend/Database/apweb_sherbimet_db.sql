-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 30, 2021 at 10:01 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apweb_sherbimet_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_aboutus`
--

CREATE TABLE `tbl_aboutus` (
  `aboutus_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` text COLLATE utf8_unicode_ci,
  `about_footer` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_aboutus`
--

INSERT INTO `tbl_aboutus` (`aboutus_id`, `description`, `image`, `about_footer`) VALUES
(1, 'To provide employment to the people of India and give our contribution towards reducing the unemployment rate of worlds largest democratic country\r\nTo provide a quality service to the people of “INDIA”.', 'noimage.png', 'All Rights Are Reserved Sherbimet 2021');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_mobile` bigint(11) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_profile` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_mobile`, `admin_email`, `admin_password`, `admin_profile`) VALUES
(1, 'Admin', 8780482151, 'admin@gmail.com', 'admin@998', '1619612802Chrysanthemum.jpg'),
(2, 'Super Admin', 9426402677, 'super@gmail.com', '123456', 'noimage.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_area`
--

CREATE TABLE `tbl_area` (
  `area_id` int(11) NOT NULL,
  `area_name` varchar(100) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `insert_datetime` datetime DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_area`
--

INSERT INTO `tbl_area` (`area_id`, `area_name`, `is_active`, `is_delete`, `insert_datetime`, `update_datetime`) VALUES
(1, 'Colaba', 1, 0, NULL, NULL),
(2, 'Bandra', 1, 0, NULL, NULL),
(3, 'Borivali', 1, 0, NULL, NULL),
(4, 'Ghatkopar', 1, 0, '2020-03-18 10:30:30', '2020-03-18 10:44:59'),
(5, 'Mulun', 1, 0, NULL, NULL),
(6, 'Dadar', 1, 0, NULL, NULL),
(7, 'Thane', 1, 0, '2020-03-18 10:30:30', '2020-03-18 10:44:59'),
(8, 'Church Gate', 1, 0, '2020-03-18 10:30:30', '2020-03-18 10:44:59'),
(9, 'Marins', 1, 0, NULL, NULL),
(10, 'Juhu', 1, 0, NULL, NULL),
(11, 'Valkeshvar', 1, 0, '2020-03-18 10:30:30', '2020-03-18 10:44:59'),
(12, 'Andheri', 1, 0, '2020-03-18 10:30:30', '2020-03-18 10:44:59'),
(13, 'Parel', 1, 0, '2020-03-18 10:30:30', '2020-03-18 10:44:59'),
(14, 'Malad', 1, 0, NULL, NULL),
(15, 'Malabar hills', 1, 0, NULL, NULL),
(16, 'Versova', 1, 0, '2020-03-18 10:30:30', '2020-03-18 10:44:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city`
--

CREATE TABLE `tbl_city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(100) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `insert_datetime` datetime DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_city`
--

INSERT INTO `tbl_city` (`city_id`, `city_name`, `is_active`, `is_delete`, `insert_datetime`, `update_datetime`) VALUES
(1, 'Mumbai', 1, 0, '2020-04-22 10:39:03', '2020-04-22 10:39:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback_date` varchar(20) NOT NULL,
  `feedback_message` varchar(100) NOT NULL,
  `feedback_rating` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `is_booking` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `insert_datetime` datetime DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`feedback_id`, `feedback_date`, `feedback_message`, `feedback_rating`, `user_id`, `worker_id`, `booking_id`, `is_booking`, `is_active`, `is_delete`, `insert_datetime`, `update_datetime`) VALUES
(1, '2021-04-29', 'nice work', '5.0', 12, 19, 1, 0, 1, 0, '2021-04-29 06:07:18', NULL),
(2, '2021-04-29', 'good', '5.0', 1, 18, 7, 0, 1, 0, '2021-04-29 07:02:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_language`
--

CREATE TABLE `tbl_language` (
  `language_id` int(11) NOT NULL,
  `language_name` varchar(100) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `insert_datetime` datetime DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_language`
--

INSERT INTO `tbl_language` (`language_id`, `language_name`, `is_active`, `is_delete`, `insert_datetime`, `update_datetime`) VALUES
(1, 'Hindi', 1, 0, '2020-04-22 10:45:28', NULL),
(2, 'Gujarati', 1, 0, '2020-04-22 10:45:32', NULL),
(3, 'English', 1, 0, '2020-04-22 10:45:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_package`
--

CREATE TABLE `tbl_package` (
  `package_id` int(11) NOT NULL,
  `package_name` varchar(200) NOT NULL,
  `package_price` int(11) NOT NULL,
  `package_details` text,
  `package_image` text,
  `subservice_id` int(11) NOT NULL,
  `is_search` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_package`
--

INSERT INTO `tbl_package` (`package_id`, `package_name`, `package_price`, `package_details`, `package_image`, `subservice_id`, `is_search`) VALUES
(1, 'Cleaning 1BHK Monthly', 849, 'test', '1619692463cr3.jpg', 1, 1),
(2, 'Cleaning 1BHK Quarterly (3 Months)', 2299, 'test', '1619692457cr3.jpg', 1, 1),
(3, 'Cleaning 1BHK Yearly (12 Months)', 8149, 'test', '1619692456cr3.jpg', 1, 1),
(4, 'Cleaning 2BHK Monthly', 949, 'test', '1619692170cr1.jpg', 2, 1),
(5, 'Cleaning 2BHK Quarterly (3 Months)', 2559, 'test', '1619692170cr1.jpg', 2, 1),
(6, 'Cleaning 2BHK Yearly (12 Months)', 9109, 'test', '1619692150cr1.jpg', 2, 1),
(7, 'Cleaning 3BHK Monthly', 1049, 'test', '1619692090cr4.jpg', 3, 1),
(8, 'Cleaning 3BHK Quarterly', 2829, 'test', '1619692087cr4.jpg', 3, 1),
(9, 'Cleaning 3BHK Yearly (12 Months)', 10069, 'test', '1619692084cr4.jpg', 3, 1),
(10, 'Cleaning studio/office Monthly', 749, 'test', '1619692042cr2.jpg', 4, 1),
(11, 'Cleaning studio/office Quarterly (3 Months)', 2019, 'test', '1619692035cr2.jpg', 4, 1),
(12, 'Cleaning studio/office Yearly (12 Months)', 7189, 'test', '1619692033cr2.jpg', 4, 1),
(13, 'Cooking Helper 1time Monthly', 2999, 'test', '1619691726c4.jpg', 5, 1),
(14, 'Cooking Helper 1time Quarterly (3 Months)', 8099, 'test', '1619691723c4.jpg', 5, 1),
(15, 'Cooking Helper 1time Yearly (12 Months)', 28789, 'test', '1619691720c4.jpg', 5, 1),
(16, 'Cooking simple food 1time Monthly', 3999, 'test', '1619691824c3.jpg', 6, 1),
(17, 'Cooking simple food 1time Quarterly (3 Months)', 10799, 'test', '1619691821c3.jpg', 6, 1),
(18, 'Cooking simple food 1time Yearly (12 Months)', 38389, 'test', '1619691819c3.jpg', 6, 1),
(19, 'Cooking for 1time 1day up to 20 persons', 499, 'test', '1619691779c2.jpg', 7, 1),
(20, 'Cooking and washing utensils for 1time 1day up to 20 persons', 699, 'test', '1619691645c1.jpg', 8, 1),
(21, 'Washing Utensil 1time Monthly', 849, 'test', '1619691131w3.png', 9, 1),
(22, 'Washing Utensil 1time Quarterly (3 Months)', 2299, 'test', '1619691135w3.png', 9, 1),
(23, 'Washing Utensil 1time Yearly (12 Months)', 8149, 'test', '1619691143w3.png', 9, 1),
(24, 'Washing Utensil 2time Monthly', 1599, 'test', '1619691154w3.png', 10, 1),
(25, 'Washing Utensil 2time Quarterly (3 Months)', 4319, 'test', '1619691159w3.png', 10, 1),
(26, 'Washing Utensil 2time Yearly (12 Months)', 15349, 'test', '1619691160w3.png', 10, 1),
(27, 'Washing Clothes per person Monthly', 349, 'test', '1619691094wash2.png', 11, 1),
(28, 'Washing Clothes per person Quarterly (3 Months)', 939, 'test', '1619691157wash2.png', 11, 1),
(29, 'Washing Clothes per person Yearly (12 Months)', 3349, 'test', '1619691160wash2.png', 11, 1),
(30, 'Baby Sitting 10hrs Monthly', 14999, 'test', '1619692612babysiter.jpg', 12, 1),
(31, 'Baby Sitting 10hrs daily Quarterly (3 Months)', 40499, 'test', '1619692606babysiter.jpg', 12, 1),
(32, 'Baby Sitting 10hrs daily Yearly (12 Months)', 99999, 'test', '1619692600babysiter.jpg', 12, 1),
(33, 'Baby Sitting per hr', 69, 'test', '1619692599babysiter.jpg', 13, 1),
(34, 'Baby Massage 1hr', 399, 'test', '1619692541babamassage.jpg', 14, 1),
(35, 'Gardening Monthly', 499, 'test', '1619691474gardening2.jpg', 15, 1),
(36, 'Gardening Quarterly (3 Months)', 1349, 'test', '1619691474gardening2.jpg', 15, 1),
(37, 'Gardening Yearly (12 Months)', 4789, 'test', '1619691472gardening2.jpg', 15, 1),
(38, 'Gardening per day', 49, 'test', '1619691460g3.jpg', 16, 1),
(39, 'Patient care Monthly', 14999, 'test', '1619691398patien_care.png', 17, 1),
(40, 'Patient care Quarterly (3 Months)', 40499, 'test', '1619691393patien_care.png', 17, 1),
(41, 'Patient care Yearly (12 Months)', 99999, 'test', '1619691390patien_care.png', 17, 1),
(42, 'Elderly care Monthly', 9999, 'test', '1619691359oldycare.jpg', 18, 1),
(43, 'Elderly care Quarterly (3 Months)', 26999, 'test', '1619691357oldycare.jpg', 18, 1),
(44, 'Elderly care Yearly (12 Months)', 95989, 'test', '1619691353oldycare.jpg', 18, 1),
(45, 'Driver Monthly', 24999, 'test', '1619691300driver3.png', 20, 1),
(46, 'Driver Quarterly (3 Months)', 67499, 'test', '1619691299driver3.png', 20, 1),
(47, 'Driver Yearly (12 Months)', 99999, 'test', '1619691296driver3.png', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pincode`
--

CREATE TABLE `tbl_pincode` (
  `pincode_id` int(11) NOT NULL,
  `pincode` varchar(30) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `insert_datetime` datetime DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pincode`
--

INSERT INTO `tbl_pincode` (`pincode_id`, `pincode`, `is_active`, `is_delete`, `insert_datetime`, `update_datetime`) VALUES
(1, '380015', 1, 0, '2020-04-22 10:40:56', NULL),
(2, '380018', 1, 0, '2020-04-22 10:41:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request`
--

CREATE TABLE `tbl_request` (
  `request_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `user_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `booking_totalamount` int(11) NOT NULL,
  `booking_message` text,
  `booking_address` text,
  `booking_status` varchar(50) NOT NULL DEFAULT 'Pending',
  `status_id` int(11) NOT NULL DEFAULT '1',
  `area_id` int(11) NOT NULL,
  `can_accept` int(11) NOT NULL DEFAULT '1',
  `cancel_reason` text,
  `payment_method` varchar(200) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `insert_datetime` datetime DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_request`
--

INSERT INTO `tbl_request` (`request_id`, `booking_date`, `booking_time`, `user_id`, `worker_id`, `package_id`, `booking_totalamount`, `booking_message`, `booking_address`, `booking_status`, `status_id`, `area_id`, `can_accept`, `cancel_reason`, `payment_method`, `is_active`, `is_delete`, `insert_datetime`, `update_datetime`) VALUES
(1, '2021-04-29', '18:04:44', 12, 19, 33, 69, 'test', 'jodhpur', 'Accepted', 4, 1, 0, NULL, 'Cash', 1, 0, '2021-04-29 06:05:00', NULL),
(2, '2021-04-29', '18:12:22', 12, 19, 33, 69, 'test', 'jodhpur', 'Accepted', 4, 1, 0, NULL, 'Cash', 1, 0, '2021-04-29 06:12:37', NULL),
(3, '2021-04-29', '18:23:50', 1, 18, 1, 849, 'test message', 'test address', 'Accepted', 4, 1, 0, NULL, 'Cash', 1, 0, '2021-04-29 06:24:12', NULL),
(4, '2021-04-29', '18:27:16', 1, 19, 2, 2299, 'test', 'test', 'Accepted', 4, 1, 0, NULL, 'Cash', 1, 0, '2021-04-29 06:27:37', NULL),
(5, '2021-04-29', '18:28:52', 12, 18, 2, 2299, 'test', 'jodhpur', 'Accepted', 4, 1, 0, NULL, 'Cash', 1, 0, '2021-04-29 06:29:03', NULL),
(6, '2021-04-29', '18:46:01', 12, 19, 33, 69, 'test', 'jp', 'Accepted', 4, 7, 0, NULL, 'Cash', 1, 0, '2021-04-29 06:47:25', NULL),
(7, '2021-04-29', '18:58:50', 1, 18, 2, 2299, 'null', 'null', 'Accepted', 4, 12, 0, NULL, 'Razorpay', 1, 0, '2021-04-29 07:00:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service`
--

CREATE TABLE `tbl_service` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(200) NOT NULL,
  `service_image` text,
  `area_id` int(11) NOT NULL,
  `is_search` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_service`
--

INSERT INTO `tbl_service` (`service_id`, `service_name`, `service_image`, `area_id`, `is_search`) VALUES
(1, 'Cleaning', '1619689255cleaning.jpg', 1, 1),
(2, 'Cooking', '1619689198cooking.jpg', 1, 1),
(3, 'Washing', '1619689188wash.jpg', 1, 1),
(4, 'Baby Sitting', '1619689180babysiter.jpg', 1, 1),
(5, 'Gardening', '1619689169gardening.jpg', 1, 1),
(6, 'Care', '1619689138care.jpg', 1, 1),
(7, 'Driver', '1619689081driver.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`status_id`, `status_name`) VALUES
(1, 'Pending'),
(2, 'Accpeted'),
(3, 'Ongoing'),
(4, 'Completed'),
(5, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subservice`
--

CREATE TABLE `tbl_subservice` (
  `subservice_id` int(11) NOT NULL,
  `subservice_name` varchar(200) NOT NULL,
  `subservice_image` text,
  `service_id` int(11) NOT NULL,
  `is_search` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_subservice`
--

INSERT INTO `tbl_subservice` (`subservice_id`, `subservice_name`, `subservice_image`, `service_id`, `is_search`) VALUES
(1, 'Cleaning 1BHK', '1619690993cr3.jpg', 1, 1),
(2, 'Cleaning 2BHK', '1619690990cr1.jpg', 1, 1),
(3, 'Cleaning 3BHK', '1619690958cr4.jpg', 1, 1),
(4, 'Cleaning studio/office', '1619690956cr2.jpg', 1, 1),
(5, 'Cooking Helper 1time', '1619690795c4.jpg', 2, 1),
(6, 'Cooking simple food 1time', '1619690660c3.jpg', 2, 1),
(7, 'Cooking for 1time 1day up to 20 persons', '1619690653c2.jpg', 2, 1),
(8, 'Cooking and washing utensils for 1time 1day up to 20 persons', '1619690649c1.jpg', 2, 1),
(9, 'Washing Utensil 1time', '1619690462w4.jpg', 3, 1),
(10, 'Washing Utensil 2time', '1619690424w3.png', 3, 1),
(11, 'Washing Clothes per person', '1619690307wash2.png', 3, 1),
(12, 'Baby Sitting 10hrs', '1619692648babysiter.jpg', 4, 1),
(13, 'Baby Sitting per hr pr day', '1619692640babysiter.jpg', 4, 1),
(14, 'Baby Massage 1hr', '1619689988babamassage.jpg', 4, 1),
(15, 'Gardening', '1619689784gardening2.jpg', 5, 1),
(16, 'Gardening per day', '1619689831g3.jpg', 5, 1),
(17, 'Patient care', '1619689699patien_care.png', 6, 1),
(18, 'Elderly care', '1619689646oldycare.jpg', 6, 1),
(19, 'Driver per day 300km', '1619689558driver4.jpg', 7, 1),
(20, 'Driver', '1619689495driver3.png', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL DEFAULT '2',
  `user_name` varchar(100) NOT NULL,
  `user_gender` varchar(12) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_mobileno` bigint(20) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_address` text,
  `area_id` varchar(100) NOT NULL,
  `user_image` text,
  `mobile_otp` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `insert_datetime` datetime DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  `device_token` text,
  `is_login` int(11) NOT NULL DEFAULT '0',
  `user_first_name` varchar(100) NOT NULL,
  `user_middle_name` varchar(100) NOT NULL,
  `user_last_name` varchar(100) NOT NULL,
  `user_address_line_1` text,
  `user_address_line_2` text,
  `city_id` int(11) NOT NULL,
  `pincode_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `user_lat` varchar(100) DEFAULT NULL,
  `user_long` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_type_id`, `user_name`, `user_gender`, `user_email`, `user_mobileno`, `user_password`, `user_address`, `area_id`, `user_image`, `mobile_otp`, `is_active`, `is_delete`, `insert_datetime`, `update_datetime`, `device_token`, `is_login`, `user_first_name`, `user_middle_name`, `user_last_name`, `user_address_line_1`, `user_address_line_2`, `city_id`, `pincode_id`, `language_id`, `user_lat`, `user_long`) VALUES
(1, 2, 'Siddharth s shah', 'Male', 'siddharth11@gmail.com', 9586248516, '123123', 'jodhpur jodhpur Ahmedabad Navranpura 380015', '1', '161926548919-05-30-AGF-l798tntWT9jWa82K-TyYVlNFbL9YcFLanLvJCg=s900-mo-c-c0xffffffff-rj-k-no.jpg', 0, 1, 0, NULL, '2020-04-22 02:57:11', 'exMXdmQHQOyliNmW0dIiKX:APA91bGJmqP8hbQQU_yLJUX5JzSjeoYVb2VwYQRoQSREXdH-8b-1BzLSlOJbP3lh82Tqm4P1FHPfAleBATKRVWVwOtqsUOc9qAcrQhbEv-QzzAicbX-_94BKPrxKVCxCWWT7RV1Ai3Wu', 0, 'Siddharth', 'S', 'Shah', 'jodhpur', 'jodhpur', 1, 1, 3, NULL, NULL),
(2, 2, 'sid', 'Male', 'siddharth@gmail.com', 8887779990, '111', 'abcdefg', '3', 'noimage.png', 0, 1, 0, NULL, NULL, NULL, 0, '', '', '', NULL, NULL, 0, 0, 0, NULL, NULL),
(3, 2, 'kiran thakor', 'Male', 'kiran@gmail.com', 8780482151, '789456123', 'jodhpur', '1', 'noimage.png', 340721, 1, 0, NULL, NULL, 'adasd', 0, '', '', '', NULL, NULL, 0, 0, 0, NULL, NULL),
(4, 2, 'Shrey', 'Male', 'shrey@gmail.com', 852369741, 'qwerty', '', '2', 'noimage.png', 0, 1, 0, NULL, NULL, NULL, 0, '', '', '', NULL, NULL, 0, 0, 0, NULL, NULL),
(5, 2, 'Abhishek', 'Male', 'abhinim@gmail.com', 1234567890, '1234', 'abcdefg', '3', 'noimage.png', 0, 1, 0, NULL, NULL, NULL, 0, '', '', '', NULL, NULL, 0, 0, 0, NULL, NULL),
(6, 2, 'abhishek', 'Male', 'abhi@gmail.com', 9909901234, '1234', 'etretgt', '1', 'noimage.png', 580602, 1, 0, NULL, NULL, 'ssss', 0, '', '', '', NULL, NULL, 0, 0, 0, NULL, NULL),
(7, 2, 'prince shah', 'Male', 'prince@gmail.com', 9909901232, 'prince123', 'jodhpur', '4', 'noimage.png', 580608, 1, 0, '2020-03-18 12:20:17', NULL, NULL, 0, '', '', '', NULL, NULL, 0, 0, 0, NULL, NULL),
(8, 2, 'ravi n patel', 'Male', 'ravi@gmail.com', 9909901212, 'ravi123', 'jodhpur jodhpur Ahmedabad Jodhpur 380015', '4', '1584514665Koala.jpg', 721152, 1, 0, '2020-03-18 12:20:48', '2020-04-22 11:29:06', '', 1, 'ravi', 'n', 'patel', 'jodhpur', 'jodhpur', 1, 1, 1, NULL, NULL),
(9, 2, 'Ram S Shah', 'Male', 'ram@gmail.com', 9909901212, 'ram123', 'jodhpur maftaparu vas Ahmedabad  380015', '4', 'noimage.png', 0, 1, 0, '2020-04-22 11:08:37', NULL, NULL, 0, 'Ram', 'S', 'Shah', '', '', 1, 1, 2, NULL, NULL),
(10, 2, 'ramu p patel', 'Male', 'ramu11@gmail.com', 9909901234, 'ramu123', 'jodhpur maftaparuvas Ahmedabad Jodhpur 380015', '4', 'noimage.png', 0, 1, 0, '2020-04-22 11:12:10', '2021-04-20 11:20:39', NULL, 0, 'ramu', 'p', 'patel', 'jodhpur', 'maftaparuvas', 1, 1, 1, '23.0225', '72.5714'),
(11, 2, 'Prince S Patel', 'Male', 'prince12@gmail.com', 9909901234, '123123', 'jp jp1 Ahmedabad Navranpura 380015', '1', 'noimage.png', 0, 1, 0, '2021-04-20 11:15:38', NULL, NULL, 0, 'Prince', 'S', 'Patel', 'jp', 'jp1', 1, 1, 1, '23.0225', '72.5714'),
(12, 2, 'Raj Bakabhai Patel', 'Male', 'raj123@gmail.com', 9909901211, 'raj123', 'jodhpur jodhpur Mumbai Colaba 380015', '1', 'noimage.png', 0, 1, 0, '2021-04-28 05:58:15', NULL, 'fu0m44NEQ4GhXnuhCPudN1:APA91bHVLk_Eha9gO0Hf2MPrUAftHrXz7PHz1gTsWbVYvNTKjC7vF7FGoYGYRXdU2X7EMn4O7ddxI5dkDNzofxemgKZMMwLdhyTZnz4YPPf_gVLs9Mh2fbCZpekTyE02o5_CmM-5xgLL', 0, 'Raj', 'Bakabhai', 'Patel', 'jodhpur', 'jodhpur', 1, 1, 3, '23.0225', '72.5714');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_type`
--

CREATE TABLE `tbl_user_type` (
  `user_type_id` int(11) NOT NULL,
  `user_type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_type`
--

INSERT INTO `tbl_user_type` (`user_type_id`, `user_type_name`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'worker');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_worker`
--

CREATE TABLE `tbl_worker` (
  `worker_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL DEFAULT '3',
  `worker_name` varchar(100) NOT NULL,
  `worker_gender` varchar(30) NOT NULL,
  `worker_email` varchar(100) NOT NULL,
  `worker_mobile` bigint(20) NOT NULL,
  `worker_password` varchar(100) NOT NULL,
  `worker_experience` int(11) NOT NULL,
  `worker_image` varchar(100) NOT NULL,
  `worker_price` double(10,2) NOT NULL,
  `package_id` int(11) NOT NULL,
  `worker_address` text,
  `mobile_otp` int(11) NOT NULL DEFAULT '0',
  `is_login` int(11) NOT NULL DEFAULT '0',
  `device_token` text,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `insert_datetime` datetime DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  `worker_first_name` varchar(100) NOT NULL,
  `worker_middle_name` varchar(100) NOT NULL,
  `worker_last_name` varchar(100) NOT NULL,
  `worker_address_line_1` text NOT NULL,
  `worker_address_line_2` text NOT NULL,
  `city_id` int(11) NOT NULL,
  `pincode_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `aadharcard_no` text NOT NULL,
  `worker_dob` date NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_worker`
--

INSERT INTO `tbl_worker` (`worker_id`, `user_type_id`, `worker_name`, `worker_gender`, `worker_email`, `worker_mobile`, `worker_password`, `worker_experience`, `worker_image`, `worker_price`, `package_id`, `worker_address`, `mobile_otp`, `is_login`, `device_token`, `is_active`, `is_delete`, `insert_datetime`, `update_datetime`, `worker_first_name`, `worker_middle_name`, `worker_last_name`, `worker_address_line_1`, `worker_address_line_2`, `city_id`, `pincode_id`, `language_id`, `aadharcard_no`, `worker_dob`, `category_id`) VALUES
(1, 3, 'xyz', 'Male', 'xyz@gmail.com', 1234567890, '123456', 2, 'noimage.png', 500.00, 1, NULL, 0, 0, NULL, 1, 0, NULL, NULL, '', '', '', '', '', 0, 0, 0, '', '0000-00-00', 0),
(2, 3, 'abc', 'Male', 'abc@gmail.com', 55555555555, '123', 1, 'noimage.png', 200.00, 1, NULL, 0, 0, NULL, 1, 0, NULL, NULL, '', '', '', '', '', 0, 0, 0, '', '0000-00-00', 0),
(3, 3, 'qwe', 'Male', 'qqqq@gmail.com', 7777777, '777', 3, 'noimage.png', 3000.00, 2, NULL, 0, 0, NULL, 1, 0, NULL, NULL, '', '', '', '', '', 0, 0, 0, '', '0000-00-00', 0),
(6, 3, 'sid', 'male', 'siddharth@ggg.com', 0, '123', 2, 'noimage.png', 2000.00, 5, NULL, 0, 0, NULL, 1, 0, NULL, NULL, '', '', '', '', '', 0, 0, 0, '', '0000-00-00', 0),
(7, 3, 'RamBhai', 'Male', 'sdnjd@gmail.com', 8788800000, '123', 5, 'noimage.png', 20.00, 10, NULL, 0, 0, NULL, 1, 0, NULL, NULL, '', '', '', '', '', 0, 0, 0, '', '0000-00-00', 0),
(9, 3, 'sid', 'Male', 'asd@gmail.com', 5254563214, '5555', 2, 'noimage.png', 300.00, 3, NULL, 0, 0, NULL, 1, 0, NULL, NULL, '', '', '', '', '', 0, 0, 0, '', '0000-00-00', 0),
(10, 3, 'Test Worker', 'Femal', 'test@gmail.com', 9999999999, '123456', 5, 'noimage.png', 1000.00, 1, NULL, 0, 0, NULL, 1, 0, NULL, NULL, '', '', '', '', '', 0, 0, 0, '', '0000-00-00', 0),
(11, 3, 'Test Worker', 'Femal', 'test@gmail.com', 9999999999, '123456', 5, 'noimage.png', 1000.00, 1, NULL, 0, 0, NULL, 1, 0, NULL, NULL, '', '', '', '', '', 0, 0, 0, '', '0000-00-00', 0),
(12, 3, 'N R', 'Femal', 'test.at@gmail.com', 7895623210, '123', 2, 'noimage.png', 25800.00, 1, NULL, 0, 0, NULL, 1, 0, NULL, NULL, '', '', '', '', '', 0, 0, 0, '', '0000-00-00', 0),
(13, 3, 'Test Worker', 'Femal', 'test@gmail.com', 9898989898, '123456', 5, 'noimage.png', 5000.00, 1, NULL, 0, 0, NULL, 1, 0, NULL, NULL, '', '', '', '', '', 0, 0, 0, '', '0000-00-00', 0),
(14, 3, 'ram shah', 'Male', 'ram@gmail.com', 9909901234, 'ram123', 2, 'noimage.png', 200.00, 6, '0', 0, 0, NULL, 1, 0, '2020-03-18 03:49:14', NULL, '', '', '', '', '', 0, 0, 0, '', '0000-00-00', 0),
(15, 3, 'ramesh shah', 'Male', 'ramesh@gmail.com', 9909901233, 'ramesh123', 2, '1586779620images.jpeg', 300.00, 3, 'jodhpur', 280244, 1, '', 1, 0, '2020-03-18 03:51:02', '2020-03-18 07:13:02', '', '', '', '', '', 0, 0, 0, '', '0000-00-00', 0),
(16, 3, 'Raj R Raval', 'Male', 'raj123@gmail.com', 9909909898, 'raj@123', 2, '1586779620images.jpeg', 300.00, 14, 'Navrangpura Navrangpura Ahmedabad Mithakali 380015', 861509, 1, 'cGD3op6YElA:APA91bF8RdXP-hw51VhQptsEOdAnrlpwk6iEB4ctT7-pEukq8E03LHipX9L0FHxTcdDHAkWjdJp-EyXNsP5Yk8MaVaOf6EfFhZZwdkP3-KihlYA1YKFy_yLxX5CdCSlljcfpceYI9flR', 1, 0, '2020-03-18 03:51:02', '2020-03-18 07:13:02', 'Raj', 'R', 'Raval', 'Navrangpura', 'Navrangpura', 1, 1, 3, '828292929292', '1995-04-23', 4),
(17, 3, 'ramu s shah', 'Male', 'ramu@gmail.com', 9909901232, 'ramu123', 2, 'noimage.png', 23800.00, 4, 'jodhpur jodhpur Ahmedabad Navranpura 380015', 0, 0, NULL, 1, 0, '2020-04-22 02:24:51', NULL, 'ramu', 's', 'shah', 'jodhpur', 'jodhpur', 1, 1, 1, '', '0000-00-00', 2),
(18, 3, 'Parul M Shah', 'Male', 'pavan@gmail.com', 9898909092, 'pavan123', 2, '16196040091583298333970.png', 21312.00, 2, 'jodhour jodhpur Mumbai Colaba 380015', 912448, 1, 'eqc717JfTmWg-27nt3XRlZ:APA91bHzc7YK1GFYno6hEgcSsHo8m3UloJ6TWHV-rc6DjDbZu4y9iYAzf29hDU8WX3H-Noaaent6AQoSyXAfjEtWaI7b0XCi01ktqaCDLkmhcY2Uzrupfi42tKCmPzYxmuuD60hQ9Ji8', 1, 0, '2020-04-22 02:27:47', NULL, 'Parul', 'M', 'Shah', 'jodhour', 'jodhpur', 1, 1, 3, '123123990123', '2020-01-01', 1),
(19, 3, 'Prince Rajubhai Shah', 'Male', 'prince@gmail.com', 9909901212, '123123', 2, 'noimage.png', 0.00, 33, 'jodhpur jodhpur Mumbai Colaba 380015', 484477, 1, 'c1MAbs6ESZaH4nlLlPcBTD:APA91bELz5Ex3ixl9oxRYLLj9kHbWI21N2BlfkaxFiwZCNVFPmF865l78yoaCPziK_H7X62A-IjyXy9cbfPEwahQG1qM7wJP2fJBd3XyTSFw6Ik-sDwRxYiOQiTLt6DchLfhIw7VLCoX', 1, 0, '2021-04-28 05:59:48', NULL, 'Prince', 'Rajubhai', 'Shah', 'jodhpur', 'jodhpur', 1, 1, 3, '121231231231', '1990-04-28', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_aboutus`
--
ALTER TABLE `tbl_aboutus`
  ADD PRIMARY KEY (`aboutus_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`),
  ADD UNIQUE KEY `admin_mobile` (`admin_mobile`);

--
-- Indexes for table `tbl_area`
--
ALTER TABLE `tbl_area`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `tbl_city`
--
ALTER TABLE `tbl_city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `tbl_language`
--
ALTER TABLE `tbl_language`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `tbl_package`
--
ALTER TABLE `tbl_package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `tbl_pincode`
--
ALTER TABLE `tbl_pincode`
  ADD PRIMARY KEY (`pincode_id`);

--
-- Indexes for table `tbl_request`
--
ALTER TABLE `tbl_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `tbl_service`
--
ALTER TABLE `tbl_service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tbl_subservice`
--
ALTER TABLE `tbl_subservice`
  ADD PRIMARY KEY (`subservice_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_type`
--
ALTER TABLE `tbl_user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- Indexes for table `tbl_worker`
--
ALTER TABLE `tbl_worker`
  ADD PRIMARY KEY (`worker_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_aboutus`
--
ALTER TABLE `tbl_aboutus`
  MODIFY `aboutus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_area`
--
ALTER TABLE `tbl_area`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_city`
--
ALTER TABLE `tbl_city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_language`
--
ALTER TABLE `tbl_language`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_package`
--
ALTER TABLE `tbl_package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbl_pincode`
--
ALTER TABLE `tbl_pincode`
  MODIFY `pincode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_request`
--
ALTER TABLE `tbl_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_service`
--
ALTER TABLE `tbl_service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_subservice`
--
ALTER TABLE `tbl_subservice`
  MODIFY `subservice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_user_type`
--
ALTER TABLE `tbl_user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_worker`
--
ALTER TABLE `tbl_worker`
  MODIFY `worker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
