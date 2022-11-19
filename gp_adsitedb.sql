-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2022 at 02:54 AM
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
-- Database: `gp_adsitedb`
--
CREATE DATABASE IF NOT EXISTS `gp_adsitedb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `gp_adsitedb`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_username`, `admin_password`) VALUES
(1, 'badKarma', '$2y$10$d9aJkF07OjfBOhqTCN8MlO53oJprsudqdZcclipZgZW4.kQXT7JUC');

-- --------------------------------------------------------

--
-- Table structure for table `ad_table`
--

CREATE TABLE `ad_table` (
  `ad_id` int(10) UNSIGNED NOT NULL,
  `ad_category_id` tinyint(3) UNSIGNED NOT NULL,
  `ad_title` varchar(250) NOT NULL,
  `ad_description` text NOT NULL,
  `ad_image_path` varchar(300) NOT NULL,
  `ad_price` decimal(15,2) NOT NULL,
  `ad_status` enum('PENDING','VERIFIED','DECLINED') NOT NULL,
  `ad_city_id` smallint(5) UNSIGNED NOT NULL,
  `ad_created` datetime NOT NULL,
  `ad_last_modified` datetime NOT NULL,
  `ad_user_id` int(10) UNSIGNED NOT NULL,
  `ad_type_id` smallint(5) UNSIGNED NOT NULL,
  `ad_expired` datetime NOT NULL,
  `ad_expiration_offset` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ad_table`
--

INSERT INTO `ad_table` (`ad_id`, `ad_category_id`, `ad_title`, `ad_description`, `ad_image_path`, `ad_price`, `ad_status`, `ad_city_id`, `ad_created`, `ad_last_modified`, `ad_user_id`, `ad_type_id`, `ad_expired`, `ad_expiration_offset`) VALUES
(15, 2, 'BMW Z4 2014', '2012yom 2014 reg BMW Z4 sDrive 20i \r\nConvertible hardtop\r\n2 liter twin-scroll turbo\r\nValvetronic exhaust with pops and bangs\r\n8 speed ZF transmission with paddles\r\n19inch BMW M staggered wheels\r\nBi-xenon automatic headlights with self leveling\r\nAutomatic wipers\r\nFront and rear Parking sensors\r\nTire pressure monitoring system\r\nAdaptive M Suspension\r\nAdaptive steering \r\nComfort Access\r\nDual-zone Climate control\r\nCruise control with brake function\r\nHeated seats\r\nHeadup Display \r\nRear camera \r\nMost features unlocked\r\nM sport steering wheel\r\nHarman Kardon sound system \r\nAuto-dimming rear view mirror and side mirrors\r\nHeated side mirrors with auto dip down\r\nAmbient lighting \r\n35,000 miles done \r\n2nd owner \r\nimported by BMW premium selection \r\nideal maintained', '.\\images\\1\\15\\bmw-z4-sdrive3-2014-wbalm7c52ee385876-img2.jpg', '22500000.00', 'VERIFIED', 23, '2022-11-20 02:23:46', '2022-11-20 02:45:39', 1, 1, '2022-11-20 02:23:46', '+P0Y0M0DT0H0M0S'),
(16, 2, 'Suzuki Intruder 2019', 'Bike Type: Motorbikes\r\nCondition: Used\r\nBrand: Suzuki\r\nModel: Intruder\r\nTrim / Edition: 2019\r\nYear of Manufacture: 2019\r\nEngine capacity: 150 cc\r\nMileage: 37,000 km\r\nGood condition can be arrange leasing 400000', '.\\images\\1\\16\\WhatsApp-Image-2022-01-26-at-5.38.39-PM.jpeg', '445000.00', 'VERIFIED', 5, '2022-11-20 02:32:59', '2022-11-20 02:45:38', 1, 3, '2022-11-25 02:45:38', '+P0Y0M0DT0H0M0S'),
(17, 10, 'Luxury Hotel for Sale Beruwala', 'Property type: Hotel\r\nAddress: ambalapola road beruwala\r\nSize: 8,500 sqft\r\nTotal 58 perch/ 8500sq 5 bed luxury villa / 5 bath/ servant room/ driver room/ roof top terrace /indoor garden/balcony/Swimming pool /outdoor garden/wooden cabana/car park /batminton Court /pool table/development /cctv/hotwater/ cable tv/AC/Fully furnished.\r\n120Million Negotiable please no brokers', '.\\images\\1\\17\\PIDXePK8-aarunya-nature-resort-sri-lanka.jpg', '120000000.00', 'VERIFIED', 25, '2022-11-20 02:39:31', '2022-11-20 02:45:36', 1, 2, '2022-11-21 02:45:36', '+P0Y0M0DT0H0M0S'),
(18, 10, 'Piliyandala Madapatha Brand New House For Sale', '🔴PILIYANDALA MADAPATHA BRAND NEW HOUSE\r\n✅PRICE - 17 Million (ලක්ෂ 170)✅\r\n🟣🟣SINGLE STOREY HOUSE🟣🟣\r\n🔹️8.4 Perches\r\n🔹️20ft road\r\n🔹️1450 sqft\r\n🔸️3 bedrooms \r\n🔸️2 bathrooms\r\n🔸️Servant bathroom\r\nLiving, dining areas, pantry\r\nFully tiled, Roller gate, CCTV\r\n300m to main road (bus road)\r\n800m to Batuwandara\r\n5km to Piliyandala\r\nHighly residential area\r\nBeautiful new house (Never been used)\r\nClear deed\r\n\r\n🟣CASH DEALS ONLY (අත්පිට මුදලට පමණයි)\r\n💰Price - 17 Million (ලක්ෂ 170) negotiable\r\n《《《 NO BROKERS PLEASE 》》》\r\nබ්‍රෝකර්වරු ඇමතීමෙන් වලකින්න\r\n\r\nSocial Media :\r\nFacebook | YouTube - WD Real Estate', '.\\images\\1\\18\\maxresdefault.jpg', '17000000.00', 'VERIFIED', 23, '2022-11-20 02:42:54', '2022-11-20 02:45:37', 1, 1, '2022-11-20 02:42:54', '+P0Y0M0DT0H0M0S');

-- --------------------------------------------------------

--
-- Table structure for table `category_table`
--

CREATE TABLE `category_table` (
  `category_id` tinyint(3) UNSIGNED NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_table`
--

INSERT INTO `category_table` (`category_id`, `category_name`) VALUES
(3, 'Business'),
(9, 'Computer'),
(4, 'Electronics'),
(5, 'Jobs'),
(8, 'Mobile'),
(11, 'Other'),
(1, 'Personal'),
(10, 'Property'),
(7, 'Proposals'),
(2, 'Vehicles');

-- --------------------------------------------------------

--
-- Table structure for table `city_table`
--

CREATE TABLE `city_table` (
  `city_id` smallint(5) UNSIGNED NOT NULL,
  `city_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city_table`
--

INSERT INTO `city_table` (`city_id`, `city_name`) VALUES
(4, 'Ampara'),
(7, 'Anuradhapura'),
(21, 'Badulla'),
(5, 'Batticaloa'),
(23, 'Colombo'),
(18, 'Galle'),
(24, 'Gampaha'),
(19, 'Hambantota'),
(9, 'Jaffna'),
(25, 'Kalutara'),
(1, 'Kandy'),
(16, 'Kegalle'),
(10, 'Killinochchi'),
(14, 'Kurunegala'),
(11, 'Mannar'),
(2, 'Matale'),
(20, 'Matara'),
(22, 'Monaragala'),
(12, 'Mullativ'),
(3, 'Nuwara Eliya'),
(8, 'Plonnaruwa'),
(15, 'Puttalam'),
(17, 'Ratnapura'),
(6, 'Trincomalee'),
(13, 'Vavuniya');

-- --------------------------------------------------------

--
-- Table structure for table `payment_type_table`
--

CREATE TABLE `payment_type_table` (
  `payment_type_id` tinyint(3) UNSIGNED NOT NULL,
  `payment_type_description` varchar(50) NOT NULL,
  `payment_type_price` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_type_table`
--

INSERT INTO `payment_type_table` (`payment_type_id`, `payment_type_description`, `payment_type_price`) VALUES
(1, 'normal', '500.00'),
(2, 'normal+top1', '1000.00'),
(3, 'normal+top2', '5000.00'),
(4, 'top1', '500.00'),
(5, 'top2', '4500.00');

-- --------------------------------------------------------

--
-- Table structure for table `type_table`
--

CREATE TABLE `type_table` (
  `type_id` smallint(5) UNSIGNED NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `type_valid_days` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type_table`
--

INSERT INTO `type_table` (`type_id`, `type_name`, `type_valid_days`) VALUES
(1, 'normal', -1),
(2, 'top1', 1),
(3, 'top2', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_phone_no` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `user_phone_no`) VALUES
(5, '0773031234'),
(1, '0773039123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_username` (`admin_username`);

--
-- Indexes for table `ad_table`
--
ALTER TABLE `ad_table`
  ADD PRIMARY KEY (`ad_id`),
  ADD KEY `FK_AdCity` (`ad_city_id`),
  ADD KEY `FK_AdCategory` (`ad_category_id`),
  ADD KEY `FK_AdUser` (`ad_user_id`),
  ADD KEY `FK_AdType` (`ad_type_id`);

--
-- Indexes for table `category_table`
--
ALTER TABLE `category_table`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `city_table`
--
ALTER TABLE `city_table`
  ADD PRIMARY KEY (`city_id`),
  ADD UNIQUE KEY `city_name` (`city_name`);

--
-- Indexes for table `payment_type_table`
--
ALTER TABLE `payment_type_table`
  ADD PRIMARY KEY (`payment_type_id`),
  ADD UNIQUE KEY `payment_type_description` (`payment_type_description`);

--
-- Indexes for table `type_table`
--
ALTER TABLE `type_table`
  ADD PRIMARY KEY (`type_id`),
  ADD UNIQUE KEY `type_name` (`type_name`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_phone_no` (`user_phone_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ad_table`
--
ALTER TABLE `ad_table`
  MODIFY `ad_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `category_table`
--
ALTER TABLE `category_table`
  MODIFY `category_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `city_table`
--
ALTER TABLE `city_table`
  MODIFY `city_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `payment_type_table`
--
ALTER TABLE `payment_type_table`
  MODIFY `payment_type_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `type_table`
--
ALTER TABLE `type_table`
  MODIFY `type_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ad_table`
--
ALTER TABLE `ad_table`
  ADD CONSTRAINT `FK_AdCategory` FOREIGN KEY (`ad_category_id`) REFERENCES `category_table` (`category_id`),
  ADD CONSTRAINT `FK_AdCity` FOREIGN KEY (`ad_city_id`) REFERENCES `city_table` (`city_id`),
  ADD CONSTRAINT `FK_AdType` FOREIGN KEY (`ad_type_id`) REFERENCES `type_table` (`type_id`),
  ADD CONSTRAINT `FK_AdUser` FOREIGN KEY (`ad_user_id`) REFERENCES `user_table` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
