-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2016 at 02:45 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zendexample`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE IF NOT EXISTS `chat_messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `user_id`, `message`, `stamp`) VALUES
(1, 15, 'dsadas', '2015-12-11 03:29:42'),
(2, 15, 'dsad', '2015-12-11 03:29:45'),
(3, 15, 'asdasd', '2015-12-11 03:30:56'),
(4, 15, 'jkhkj', '2015-12-11 03:39:33'),
(5, 16, 'hello', '2015-12-11 03:40:19'),
(6, 16, 'howare you', '2015-12-11 03:40:28'),
(7, 16, 'hjk', '2015-12-11 03:43:01'),
(8, 19, 'hello', '2015-12-11 03:43:34'),
(9, 16, 'ádasd', '2015-12-16 03:08:15'),
(10, 16, '?á', '2015-12-16 03:08:19'),
(11, 21, 'tran', '2015-12-17 13:12:00'),
(12, 16, 'tran', '2015-12-17 13:16:33'),
(13, 15, 'dasd', '2015-12-17 13:17:01'),
(14, 15, 'dasd', '2015-12-17 13:17:05'),
(15, 15, 'hello', '2015-12-17 16:22:34');

-- --------------------------------------------------------

--
-- Table structure for table `image_uploads`
--

CREATE TABLE IF NOT EXISTS `image_uploads` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image_uploads`
--

INSERT INTO `image_uploads` (`id`, `filename`, `thumbnail`, `label`, `user_id`) VALUES
(1, 'download (1).png', 'tn_download (1).png', '', 16),
(2, 'download.png', 'tn_download.png', '', 16),
(3, 'head-bottom-picture.png', 'tn_head-bottom-picture.png', '', 16),
(4, 'zf-logo-mark.png', 'tn_zf-logo-mark.png', '', 16);

-- --------------------------------------------------------

--
-- Table structure for table `stickynotes`
--

CREATE TABLE IF NOT EXISTS `stickynotes` (
  `id` int(11) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store_orders`
--

CREATE TABLE IF NOT EXISTS `store_orders` (
  `id` int(11) NOT NULL,
  `store_product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` float(9,2) NOT NULL,
  `status` enum('new','completed','shipped','cancelled') DEFAULT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `ship_to_street` varchar(255) DEFAULT NULL,
  `ship_to_city` varchar(255) DEFAULT NULL,
  `ship_to_state` varchar(2) DEFAULT NULL,
  `ship_to_zip` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_orders`
--

INSERT INTO `store_orders` (`id`, `store_product_id`, `qty`, `total`, `status`, `stamp`, `first_name`, `last_name`, `email`, `ship_to_street`, `ship_to_city`, `ship_to_state`, `ship_to_zip`) VALUES
(1, 1, 0, 0.00, 'new', '2015-12-18 04:15:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `store_products`
--

CREATE TABLE IF NOT EXISTS `store_products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `cost` float(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE IF NOT EXISTS `uploads` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `filename`, `label`, `user_id`) VALUES
(1, 'TrungTranThanh.doc', '123', 15),
(6, 'JAVA_TranThanhTrung.HN.2015.12.8].doc', '456', 16),
(7, 'Gi?y-gi?i-thi?u.doc', 'giay gioi thieu', 16),
(8, '251.doc', '', 17),
(10, 'ajax-loader.gif', '12345', 17),
(12, 'Bai Tap Tuyen Dung Android 25122015[1].doc', '456', 17);

-- --------------------------------------------------------

--
-- Table structure for table `uploads_sharing`
--

CREATE TABLE IF NOT EXISTS `uploads_sharing` (
  `id` int(11) NOT NULL,
  `upload_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uploads_sharing`
--

INSERT INTO `uploads_sharing` (`id`, `upload_id`, `user_id`) VALUES
(8, 1, 16),
(10, 1, 17),
(11, 1, 18),
(12, 1, 19),
(2, 3, 3),
(5, 3, 7),
(6, 3, 11),
(1, 3, 12),
(13, 6, 15),
(14, 6, 16),
(15, 6, 18),
(16, 6, 19),
(18, 7, 18),
(17, 7, 19),
(19, 7, 21),
(22, 10, 16),
(21, 10, 18),
(23, 12, 16),
(20, 12, 18);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`) VALUES
(15, 'trung', 'trantrung@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(16, 'trung1', 'test@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(17, 'trung2', 'test1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(18, 'test', 'test2@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(19, 'test1', 'test3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(20, 'trung', 'test21@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(21, 'trung', 'trungtranthanh.k56@gmail.com', '34892dfb4e619ab8a38b92ff570692bb');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_uploads`
--
ALTER TABLE `image_uploads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `filename` (`filename`);

--
-- Indexes for table `store_orders`
--
ALTER TABLE `store_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_products`
--
ALTER TABLE `store_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `filename` (`filename`);

--
-- Indexes for table `uploads_sharing`
--
ALTER TABLE `uploads_sharing`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `upload_id` (`upload_id`,`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `image_uploads`
--
ALTER TABLE `image_uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `store_orders`
--
ALTER TABLE `store_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `store_products`
--
ALTER TABLE `store_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `uploads_sharing`
--
ALTER TABLE `uploads_sharing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
