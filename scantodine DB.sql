-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2024 at 03:22 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scantodine`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_info`
--

CREATE TABLE `bill_info` (
  `id` int(6) NOT NULL,
  `res_code` int(6) NOT NULL,
  `tax_rate` int(3) NOT NULL DEFAULT 0,
  `add_charge` int(5) NOT NULL DEFAULT 0,
  `dis` int(3) NOT NULL DEFAULT 0,
  `upi_id` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill_info`
--

INSERT INTO `bill_info` (`id`, `res_code`, `tax_rate`, `add_charge`, `dis`, `upi_id`) VALUES
(20, 421340, 10, 20, 2, 'test2314'),
(32, 547902, 18, 20, 2, '-');

-- --------------------------------------------------------

--
-- Table structure for table `default_item`
--

CREATE TABLE `default_item` (
  `item_id` int(6) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'others',
  `extension` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `default_item`
--

INSERT INTO `default_item` (`item_id`, `item_name`, `category`, `extension`) VALUES
(1000, 'Gujarati', 'default_category', 'jpg'),
(1007, 'punjabi', 'default_category', 'jpg'),
(1014, 'southIndian', 'default_category', 'jpg'),
(1028, 'snacks', 'default_category', 'jpg'),
(1035, 'Sweets', 'default_category', 'jpg'),
(1042, 'chinese', 'default_category', 'jpg'),
(1049, 'dishes', 'default_category', 'jpg'),
(1056, 'others', 'default_category', 'jpg'),
(101007, 'noodles', 'chinese', 'jpg'),
(101021, 'samosa', 'snacks', 'jpg'),
(101042, 'burger', 'snacks', 'png'),
(101063, 'momos', 'snacks', 'jpg'),
(101091, 'malpua', 'snacks', 'jpg'),
(101098, 'kadhi', 'gujarati', 'jpg'),
(101105, 'ghughra', 'sweets', 'jpg'),
(101112, 'dal_batti', 'dishes', 'jpg'),
(101126, 'poha', 'others', 'jpg'),
(101154, 'cheese_puff', 'snacks', 'jpg'),
(101175, 'dal_makhani', 'punjabi', 'jpg'),
(101203, 'dhokla', 'gujarati', 'jpg'),
(101210, 'dosa', 'southindian', 'jpg'),
(101224, 'khichdi', 'gujarati', 'jpg'),
(101245, 'handwo', 'gujarati', 'jpg'),
(101252, 'idlisambhar', 'southindian', 'jpg'),
(101259, 'khandvi', 'gujarati', 'jpg'),
(101266, 'litti_chokha', 'others', 'jpg'),
(101273, 'sevkhamni', 'gujarati', 'jpg'),
(101280, 'manchurian', 'chinese', 'jpg'),
(101287, 'meduvada', 'southindian', 'jpg'),
(101315, 'paneer', 'punjabi', 'jpg'),
(101322, 'cheese_nuggets', 'others', 'jpg'),
(101336, 'pasta', 'others', 'jpeg'),
(101343, 'ghughra', 'gujarati', 'jpeg'),
(101350, 'pongal', 'southindian', 'jpg'),
(101364, 'rajma_chawal', 'dishes', 'jpg'),
(101371, 'french_fries', 'snacks', 'jpg'),
(101378, 'pakode', 'others', 'jpg'),
(101385, 'sandwich', 'snacks', 'jpg'),
(101392, 'sev_usal', 'others', 'jpg'),
(101413, 'uttapan', 'southindian', 'jpg'),
(101420, 'vada_pav', 'others', 'jpg'),
(101500, 'chinese_bhel', 'chinese', 'jpg'),
(101507, 'shup', 'others', 'jpg'),
(101514, 'dabeli', 'snacks', 'jpg'),
(101521, 'fafda_jalebi', 'gujarati', 'png'),
(101528, 'gulab_jamun', 'sweets', 'jpeg'),
(101535, 'kheer', 'sweets', 'jpg'),
(101542, 'pizza', 'others', 'jpg'),
(101549, 'ras_gulla', 'sweets', 'jpg'),
(101556, 'ras_malai', 'sweets', 'jpg'),
(101563, 'sandesh', 'sweets', 'jpg'),
(101570, 'spring_rolls', 'chinese', 'jpg'),
(101577, 'wraps', 'others', 'jpg'),
(101600, 'aloo_paratha', 'punjabi', 'jpg'),
(101607, 'chole_bhature', 'dishes', 'jpg'),
(101614, 'gujarati', 'dishes', 'jpg'),
(101621, 'punjabi', 'dishes', 'png'),
(101628, 'lassi', 'punjabi', 'jpg'),
(101635, 'makki_di roti_sarson_ka_saag', 'dishes', 'jpg'),
(101642, 'pav_bhaji', 'dishes', 'jpeg'),
(101649, 'kadhyawadi', 'dishes', 'jpeg'),
(101656, 'puri_and_aloo_sabji', 'dishes', 'jpg'),
(101663, 'upma', 'snacks', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `res_code` int(6) NOT NULL,
  `username` varchar(25) NOT NULL,
  `fb_email` varchar(255) NOT NULL,
  `fb_subject` varchar(30) NOT NULL,
  `fb_description` varchar(500) NOT NULL,
  `rating` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `res_code`, `username`, `fb_email`, `fb_subject`, `fb_description`, `rating`) VALUES
(12, 421340, 'test', 'test@gmail.com', 'general report', 'Your food was delicious. I will must visit again.', 0),
(13, 421340, 'test2', 'test2@gmail.com', 'general report', 'Your restaurant system is too good.', 0),
(15, 547902, 'test', 'test@gmail.com', 'normal', 'delicious food.', 0),
(16, 547902, 'test2', 'test@gmail.com', 'normal', 'Jordaaarrrrrr', 0),
(17, 547902, 'Testing', 'art@gmail.com', 'General Feedback', 'thankt', 4),
(18, 547902, 'Testing', 'art@gmail.com', 'General Feedback', 'thankt', 2),
(19, 547902, 'Testing', 'art@gmail.com', 'General Feedback', 'thankt', 4),
(20, 547902, 'Testing', 'art@gmail.com', 'General Feedback', 'thankt', 1),
(21, 547902, 'Testing', 'art@gmail.com', 'General Feedback', 'thankt', 5),
(22, 547902, 'Testing', 'art@gmail.com', 'General Feedback', 'thankt', 5),
(23, 547902, 'Testing', 'art@gmail.com', 'General Feedback', 'thankt', 4),
(24, 547902, 'Testing', 'art@gmail.com', 'General Feedback', 'thankt', 3),
(25, 547902, 'aryan', 'shivang123@gmail.com', 'General Feedback', 'Delicious ', 5);

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

CREATE TABLE `food_items` (
  `food_type_id` int(8) NOT NULL,
  `food_id` int(6) NOT NULL,
  `res_id` int(6) NOT NULL,
  `type_name` varchar(25) NOT NULL,
  `type_price` int(6) NOT NULL,
  `type_des` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_items`
--

INSERT INTO `food_items` (`food_type_id`, `food_id`, `res_id`, `type_name`, `type_price`, `type_des`) VALUES
(10855733, 101252, 421340, 'idli with sambhar', 40, 'sambhar, chatni'),
(11929655, 101628, 547902, 'lassi 2', 40, 'VIP lassi, price is out of your capacity'),
(14345218, 101343, 421340, 'Undefined', 0, 'Undefined'),
(14717852, 101315, 454082, 'Paneer makhan', 300, 'Very tasty 😋'),
(14807411, 101600, 454082, 'Cheese aloo Paratha ', 200, 'Very tasty and cheesy'),
(16743016, 101600, 547902, 'cheese aloo paratha', 200, 'with cheesy delight'),
(22352204, 101642, 421340, 'pav bhaji', 50, 'affw'),
(23502636, 101600, 826068, 'Undefined', 0, 'Undefined'),
(23538814, 101343, 421340, 'Undefined', 0, 'Undefined'),
(23736544, 101245, 421340, 'handwo', 40, 'best'),
(25539281, 101252, 826068, 'Undefined', 0, 'Undefined'),
(26800815, 101098, 826068, 'Undefined', 0, 'Undefined'),
(27095744, 101203, 421340, 'naylon', 20, 'with chatni'),
(27503165, 101203, 421340, 'Undefined', 0, 'Undefined'),
(27978195, 101098, 421340, 'Rajasthani kadhi', 90, 'very special kadhi'),
(28340041, 101315, 547902, 'Panner matter', 200, 'delicious matter panner with cheese'),
(28352862, 101203, 421340, 'naylon', 35, 'with marcha'),
(28920420, 101175, 454082, 'Dal makhani spicy ', 1330, 'Very tasty 😋'),
(29126207, 101343, 421340, 'Undefined', 0, 'Undefined'),
(30835174, 101273, 826068, 'Undefined', 0, 'Undefined'),
(32761059, 101315, 897801, 'panner tikka', 129, 'Paneerr masaala'),
(33049101, 101098, 421340, 'kadhi', 40, 'special kadhi'),
(37951681, 101628, 547902, 'pubjabi lassi', 30, 'jordarr'),
(38189561, 101280, 236424, 'manchurian dry', 100, 'testy manchurian '),
(38330318, 101042, 547902, 'burger 1', 20, 'jabardast'),
(38370494, 101315, 421340, 'Undefined', 0, 'Undefined'),
(40381419, 101315, 897801, 'paneer masala', 299, 'ohk sir'),
(41620862, 101315, 421340, 'Undefined', 0, 'Undefined'),
(42034371, 101175, 454082, 'Dal makhani', 200, 'Very tasty 😋'),
(43292798, 101203, 236424, 'dhokla simple', 50, 'delicious dhokla'),
(45307434, 101343, 236424, 'ghughra spicy', 50, '2 piece'),
(47109468, 101600, 547902, 'Panjabi allo paratha', 100, 'with achar'),
(48014984, 101252, 454082, 'Sambhar', 201, 'Very tasty 😋'),
(48122625, 101315, 826068, 'Undefined', 0, 'Undefined'),
(50528005, 101252, 454082, 'Idli', 230, 'Very tasty 😋'),
(50603541, 101343, 421340, 'ghughra', 30, '3 ghughra with chatni'),
(50723230, 101600, 454082, 'Alloo Paratha ', 600, 'Very tasty 😋'),
(53932412, 101042, 421340, 'burger peri peri', 60, 'special peri peri\n'),
(54199671, 101252, 421340, 'idli masaledar', 30, 'special masala'),
(54504701, 101203, 826068, 'Undefined', 0, 'Undefined'),
(55272936, 101343, 236424, 'ghughra testy', 40, '4 piece'),
(58340245, 101224, 826068, 'Undefined', 0, 'Undefined'),
(59233252, 101203, 421340, 'surti', 20, 'with chatni'),
(61239430, 101042, 771843, 'burger 2', 60, 'jordarr'),
(63822297, 101287, 826068, 'Undefined', 0, 'Undefined'),
(64215611, 101203, 421340, 'dhokla 2 ', 100, 'mix dhokla with chatni'),
(65779923, 101203, 421340, 'Undefined', 0, 'Undefined'),
(66156442, 101203, 421340, 'dhokla 2', 100, 'mix dhokla with chatni'),
(67631600, 101343, 421340, 'jabardast ghughra ', 50, 'with chatni, sev'),
(72371920, 101203, 421340, 'dhokla 1', 40, 'delicious dhokla'),
(73992410, 101607, 421340, 'special chole', 40, 'with onions, marcha'),
(75957043, 101203, 421340, 'surti khaman', 30, 'marcha, chatni'),
(77037466, 101210, 454082, 'Masala dosa ', 160, 'Very tasty 😋'),
(77126579, 101287, 421340, 'meduvada', 30, '3 piece  '),
(78536497, 101343, 421340, 'Undefined', 0, 'Undefined'),
(79381940, 101343, 826068, 'Undefined', 0, 'Undefined'),
(81778408, 101245, 421340, 'Undefined', 0, 'Undefined'),
(82397876, 101343, 421340, 'Undefined', 0, 'Undefined'),
(82761663, 101628, 454082, 'Strawberry ', 300, 'Very tasty 😋'),
(84767449, 101252, 421340, 'normal idli', 40, 'with chatni'),
(86118522, 101042, 421340, 'burger cheese', 100, 'Special cheese added with extra layers'),
(86423292, 101315, 547902, 'paneer tikka', 170, 'extra cheese, paneer'),
(86489911, 101203, 771843, 'tasty dhokla', 50, 'delicious'),
(88679081, 101203, 771843, 'mix dhokla', 60, 'mix all types'),
(88879281, 101203, 421340, 'special dhokla', 70, 'special tadka'),
(91605103, 101042, 771843, 'burger 1', 40, 'tasty'),
(91616907, 101042, 547902, 'burger 2 ', 30, 'majedar'),
(93014526, 101175, 826068, 'Undefined', 0, 'Undefined'),
(96084148, 101203, 421340, 'dhokla 1', 30, 'delicious dhokla'),
(96957721, 101203, 421340, 'special dhokla', 100, 'special by scantodine'),
(97620592, 101521, 421340, 'Undefined', 0, 'Undefined'),
(98846518, 101521, 421340, 'Undefined', 0, 'Undefined');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `item_id` int(10) NOT NULL,
  `res_code` int(6) NOT NULL,
  `item_name` varchar(25) NOT NULL,
  `item_qun` int(6) NOT NULL,
  `mes_unit` varchar(25) NOT NULL,
  `category` varchar(25) NOT NULL,
  `additional_category` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`additional_category`)),
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`item_id`, `res_code`, `item_name`, `item_qun`, `mes_unit`, `category`, `additional_category`, `date_added`) VALUES
(23, 771843, 'sample', 30, 'KILOGRAM', 'VEGETARIAN', NULL, '2024-01-14'),
(24, 771843, 'sample2', 11, 'DOZEN', 'JAIN ITEM', NULL, '2024-01-14'),
(27, 454082, 'Onion', 50, 'KILOGRAM', 'VEGETARIAN', NULL, '2024-01-18'),
(28, 454082, 'Garlic', 29, 'KILOGRAM', 'VEGETARIAN', NULL, '2024-01-18'),
(30, 897801, 'Paneer', 5, 'KILOGRAM', 'DAIRY ITEM', NULL, '2024-01-23'),
(44, 547902, 'egges', 23, 'DOZEN', 'EGGETARIAN', '[\"test\",\"test2\",\"test3\"]', '2024-02-10'),
(45, 547902, 'sam', 34, 'KILOGRAM', 'VEGETARIAN', '[\"test\",\"test2\",\"test3\"]', '2024-02-10'),
(46, 547902, 'paneer', 14, 'KILOGRAM', 'VEGETARIAN', '[\"test\",\"test2\",\"test3\"]', '2024-02-10'),
(47, 547902, 'good', 10, 'DOZEN', 'TEST2', '[\"test\",\"test2\",\"test3\"]', '2024-02-10');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(12) NOT NULL,
  `cus_id` int(10) NOT NULL,
  `order_date` datetime NOT NULL,
  `table_num` int(3) NOT NULL,
  `res_id` int(6) NOT NULL,
  `items_det` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`items_det`)),
  `amount` double NOT NULL,
  `completion_code` int(6) NOT NULL,
  `order_status` varchar(25) NOT NULL DEFAULT 'finished'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `cus_id`, `order_date`, `table_num`, `res_id`, `items_det`, `amount`, `completion_code`, `order_status`) VALUES
(2, 20, '2024-01-27 11:05:58', 3, 547902, '{\"16743016\":1,\"28340041\":1,\"86423292\":2,\"16743016-inst\":\"more spicy\",\"28340041-inst\":\"more cheese\",\"86423292-inst\":\"\"}', 875.336, 823491, 'finished'),
(8, 26, '2024-01-28 05:10:58', 3, 547902, '{\"47109468\":3,\"47109468-inst\":\"it should be too spicy\"}', 366.52, 728325, 'finished'),
(9, 26, '2024-01-28 08:46:15', 3, 547902, '{\"16743016\":5,\"16743016-inst\":\"\"}', 1117.8, 158251, 'finished'),
(10, 28, '2024-01-29 11:37:18', 2, 421340, '{\"10855733\":2,\"53932412\":1,\"10855733-inst\":\"\",\"53932412-inst\":\"\"}', 170.52, 100095, 'placed'),
(12, 28, '2024-01-29 11:56:42', 5, 421340, '{\"27095744\":1,\"64215611\":2,\"27095744-inst\":\"\",\"64215611-inst\":\"\"}', 256.76, 765434, 'finished'),
(13, 28, '2024-01-29 12:00:22', 1, 421340, '{\"77126579\":2,\"77126579-inst\":\"\"}', 84.28, 973398, 'placed'),
(14, 29, '2024-01-29 10:38:52', 2, 771843, '{\"86489911\":1,\"86489911-inst\":\"\"}', 50, 916398, 'finished'),
(15, 29, '2024-01-29 10:42:57', 2, 771843, '{\"61239430\":1,\"86489911\":1,\"61239430-inst\":\"\",\"86489911-inst\":\"\"}', 110, 365790, 'finished'),
(16, 29, '2024-01-29 10:45:51', 5, 771843, '{\"91605103\":2,\"91605103-inst\":\"\"}', 80, 289922, 'finished'),
(17, 26, '2024-01-30 12:48:09', 2, 547902, '{\"28340041\":1,\"28340041-inst\":\"\"}', 234.6, 834974, 'finished'),
(18, 26, '2024-01-30 10:25:51', 2, 547902, '{\"16743016\":1,\"16743016-inst\":\"\"}', 234.6, 658308, 'finished'),
(19, 26, '2024-01-31 09:44:05', 2, 547902, '{\"16743016\":1,\"16743016-inst\":\"\"}', 234.6, 511601, 'finished'),
(20, 26, '2024-02-01 11:51:56', 2, 547902, '{\"28340041\":1,\"28340041-inst\":\"\"}', 234.6, 768152, 'finished'),
(21, 26, '2024-02-01 11:52:04', 2, 547902, '{\"28340041\":1,\"28340041-inst\":\"\"}', 234.6, 168839, 'finished'),
(22, 26, '2024-02-01 01:57:18', 2, 547902, '{\"47109468\":3,\"47109468-inst\":\"\"}', 345, 646348, 'finished'),
(23, 30, '2024-02-01 10:20:06', 2, 547902, '{\"16743016\":2,\"16743016-inst\":\"\"}', 455.4, 539761, 'finished'),
(24, 30, '2024-02-01 10:21:12', 2, 547902, '{\"86423292\":1,\"86423292-inst\":\"\"}', 201.48, 695462, 'finished'),
(25, 30, '2024-02-01 10:27:25', 2, 547902, '{\"86423292\":1,\"86423292-inst\":\"\"}', 201.48, 293634, 'finished'),
(26, 30, '2024-02-01 10:32:31', 2, 547902, '{\"86423292\":1,\"86423292-inst\":\"\"}', 201.48, 129424, 'finished'),
(27, 30, '2024-02-03 09:30:12', 2, 547902, '{\"28340041\":1,\"47109468\":1,\"28340041-inst\":\"\",\"47109468-inst\":\"\"}', 345, 750884, 'finished'),
(28, 30, '2024-02-03 09:38:01', 2, 547902, '{\"47109468\":2,\"47109468-inst\":\"\"}', 234.6, 858746, 'finished'),
(29, 30, '2024-02-03 09:38:50', 2, 547902, '{\"47109468\":2,\"47109468-inst\":\"\"}', 234.6, 615912, 'finished'),
(30, 30, '2024-02-03 10:10:09', 1, 547902, '{\"16743016\":1,\"28340041\":2,\"47109468\":2,\"86423292\":4,\"16743016-inst\":\"\",\"28340041-inst\":\"\",\"47109468-inst\":\"\",\"86423292-inst\":\"\"}', 1647.72, 429150, 'finished'),
(31, 30, '2024-02-04 11:34:28', 2, 547902, '{\"86423292\":1,\"86423292-inst\":\"\"}', 201.48, 563006, 'finished'),
(32, 30, '2024-02-04 01:09:54', 2, 547902, '{\"16743016\":2,\"16743016-inst\":\"\"}', 455.4, 472853, 'placed'),
(33, 26, '2024-02-04 09:10:21', 1, 547902, '{\"47109468\":1,\"47109468-inst\":\"\"}', 124.2, 246486, 'placed'),
(34, 26, '2024-02-04 09:15:46', 1, 547902, '{\"47109468\":1,\"47109468-inst\":\"\"}', 124.2, 469476, 'placed'),
(35, 30, '2024-02-06 09:36:04', 2, 547902, '{\"16743016\":1,\"16743016-inst\":\"\"}', 234.6, 196342, 'placed'),
(36, 26, '2024-02-10 08:57:57', 2, 547902, '{\"28340041\":1,\"37951681\":1,\"28340041-inst\":\"\",\"37951681-inst\":\"\"}', 267.72, 944510, 'placed'),
(37, 30, '2024-02-10 11:05:43', 1, 547902, '{\"37951681\":1,\"47109468\":1,\"37951681-inst\":\"\",\"47109468-inst\":\"\"}', 123.832, 842384, 'finished'),
(38, 30, '2024-02-10 11:07:08', 1, 547902, '{\"28340041\":2,\"37951681\":1,\"47109468\":1,\"28340041-inst\":\"\",\"37951681-inst\":\"\",\"47109468-inst\":\"\"}', 499.192, 367912, 'placed'),
(39, 30, '2024-02-16 07:23:06', 2, 547902, '{\"11929655\":2,\"11929655-inst\":\"\"}', 112.112, 779015, 'placed');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `res_name` varchar(255) NOT NULL,
  `res_code` int(6) NOT NULL,
  `owner_uid` int(15) NOT NULL,
  `res_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `res_name`, `res_code`, `owner_uid`, `res_address`) VALUES
(2, 'test', 421340, 3, 'asgher'),
(3, 'Test', 547902, 4, 'Abc'),
(5, 'Sample', 897801, 7, 'Ahmedabad '),
(7, 'test2', 236424, 9, 'surat'),
(8, 'test', 826068, 10, 'ahemdabasd'),
(9, 'sample restaurant', 771843, 13, 'mumbai'),
(12, 'Honest ', 454082, 27, 'Shashtri Nagar');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `table_id` int(10) NOT NULL,
  `res_id` int(6) NOT NULL,
  `table_num` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`table_id`, `res_id`, `table_num`) VALUES
(61, 897801, 1),
(62, 897801, 2),
(63, 897801, 3),
(89, 547902, 1),
(90, 547902, 2),
(91, 547902, 3),
(92, 421340, 1),
(93, 421340, 2),
(94, 421340, 3),
(95, 421340, 4),
(96, 421340, 5),
(97, 771843, 1),
(98, 771843, 2),
(99, 771843, 3),
(100, 771843, 4),
(101, 771843, 5),
(102, 547902, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_phone` varchar(10) NOT NULL,
  `password` varchar(12) NOT NULL,
  `res_code` int(6) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'manager'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_name`, `u_email`, `u_phone`, `password`, `res_code`, `role`) VALUES
(3, 'shivang', 'shivang@gmail.com', '2222222222', '111111111111', 421340, 'manager'),
(4, 'test', 'test@gmail.com', '1111111111', '123', 547902, 'manager'),
(7, 'Test2', 'Test2@gmail.com', '3333333333', '123', 897801, 'manager'),
(9, 'test2', 'test2@gmail.com', '9999999999', '123', 236424, 'manager'),
(10, 'namra', 'namra@1212', '5555555555', '123', 826068, 'manager'),
(13, 'sample', 'sample@gmail.com', '1212121212', '111111111111', 771843, 'manager'),
(20, 'test', 'test@gmail.com', '1212121212', '111111111111', 547902, 'customer'),
(23, 'test', 'test@gmail.com', '1234567822', '111111111111', 547902, 'customer'),
(26, 'aryan', 'aryan@gmail.com', '9898989898', '111111111111', 547902, 'customer'),
(27, 'Shiv', 'neel@gmail.com', '1000009999', '12348900', 454082, 'manager'),
(28, 'test5', 'test5@gmail.com', '9090909090', '111111111111', 421340, 'customer'),
(29, 'new test', 'new@123', '0101010101', '111111111111', 771843, 'customer'),
(30, 'Testing', 'Testing@gmail.com', '2121212121', '121212121212', 547902, 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill_info`
--
ALTER TABLE `bill_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `res_code` (`res_code`);

--
-- Indexes for table `default_item`
--
ALTER TABLE `default_item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `res_code` (`res_code`);

--
-- Indexes for table `food_items`
--
ALTER TABLE `food_items`
  ADD PRIMARY KEY (`food_type_id`),
  ADD KEY `food_foreign_id` (`food_id`),
  ADD KEY `res_foreign_id` (`res_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `res_code_for_inventory` (`res_code`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `cus_id` (`cus_id`),
  ADD KEY `res_id` (`res_id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `res_code` (`res_code`),
  ADD KEY `u_id` (`owner_uid`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `u_phone` (`u_phone`,`res_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill_info`
--
ALTER TABLE `bill_info`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `table_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `res_code` FOREIGN KEY (`res_code`) REFERENCES `restaurant` (`res_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `food_items`
--
ALTER TABLE `food_items`
  ADD CONSTRAINT `food_foreign_id` FOREIGN KEY (`food_id`) REFERENCES `default_item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `res_foreign_id` FOREIGN KEY (`res_id`) REFERENCES `restaurant` (`res_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `res_code_for_inventory` FOREIGN KEY (`res_code`) REFERENCES `restaurant` (`res_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `cus_id` FOREIGN KEY (`cus_id`) REFERENCES `users` (`u_id`),
  ADD CONSTRAINT `res_id` FOREIGN KEY (`res_id`) REFERENCES `restaurant` (`res_code`);

--
-- Constraints for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD CONSTRAINT `u_id` FOREIGN KEY (`owner_uid`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
