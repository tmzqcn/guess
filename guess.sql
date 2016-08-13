-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-08-13 17:00:47
-- 服务器版本： 10.1.10-MariaDB
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guess`
--

-- --------------------------------------------------------

--
-- 表的结构 `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('b83fa163a7a123325d9be1761039b3e1bbc4eb41', '::1', 1471056753, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313035363735333b757365725f69647c733a323a223133223b656d61696c7c733a373a223140312e636f6d223b6e616d657c733a343a2231313131223b726f6c65737c613a313a7b693a303b733a31363a22726f6c655f67756573735f61646d696e223b7d),
('8fa28b64db717d1c5b119f24a3a1915446f03c8f', '::1', 1471058921, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313035383932313b757365725f69647c733a323a223133223b656d61696c7c733a373a223140312e636f6d223b6e616d657c733a343a2231313131223b726f6c65737c613a313a7b693a303b733a31363a22726f6c655f67756573735f61646d696e223b7d),
('a36dcff98b8e69631ccff67167e043f462a5abfe', '::1', 1471059235, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313035393233353b757365725f69647c733a323a223133223b656d61696c7c733a373a223140312e636f6d223b6e616d657c733a343a2231313131223b726f6c65737c613a313a7b693a303b733a31363a22726f6c655f67756573735f61646d696e223b7d),
('5f68791c42056027ee8c7ff9729c7697fdf5a2a0', '::1', 1471059603, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313035393630333b757365725f69647c733a323a223133223b656d61696c7c733a373a223140312e636f6d223b6e616d657c733a343a2231313131223b726f6c65737c613a313a7b693a303b733a31363a22726f6c655f67756573735f61646d696e223b7d),
('4e4599580aa116f78f555170e54e48a86a97299d', '::1', 1471063864, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313036333836343b757365725f69647c733a323a223133223b656d61696c7c733a373a223140312e636f6d223b6e616d657c733a343a2231313131223b726f6c65737c613a313a7b693a303b733a31363a22726f6c655f67756573735f61646d696e223b7d),
('940883a0709920dbf1fc70118c4ddbe50be02743', '::1', 1471063860, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313036333836303b),
('8acc6bb91d644164b82d69cde3f60bab087ed2a9', '::1', 1471063860, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313036333836303b),
('2a55997cd1e76e6883df1285d006a115b26a32ac', '::1', 1471064897, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313036343839373b757365725f69647c733a323a223133223b656d61696c7c733a373a223140312e636f6d223b6e616d657c733a343a2231313131223b726f6c65737c613a313a7b693a303b733a31363a22726f6c655f67756573735f61646d696e223b7d),
('b2dc8c9701dfb48b22fe3a2b2c5429e0507c9c88', '::1', 1471065219, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313036353231393b757365725f69647c733a323a223133223b656d61696c7c733a373a223140312e636f6d223b6e616d657c733a343a2231313131223b726f6c65737c613a313a7b693a303b733a31363a22726f6c655f67756573735f61646d696e223b7d),
('45718cb8fe180a13ced27820c13c45af7f1d118a', '::1', 1467350444, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313036353231393b757365725f69647c733a323a223133223b656d61696c7c733a373a223140312e636f6d223b6e616d657c733a343a2231313131223b726f6c65737c613a313a7b693a303b733a31363a22726f6c655f67756573735f61646d696e223b7d),
('14aafe5eae825d788725c74b2f6135805a88fb87', '::1', 1471068323, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313036383332333b757365725f69647c733a323a223133223b656d61696c7c733a373a223140312e636f6d223b6e616d657c733a343a2231313131223b726f6c65737c613a313a7b693a303b733a31363a22726f6c655f67756573735f61646d696e223b7d),
('48f28d56aed2c03077ad6814bbdcc04f09324839', '::1', 1471072010, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313037323031303b757365725f69647c733a323a223133223b656d61696c7c733a373a223140312e636f6d223b6e616d657c733a343a2231313131223b726f6c65737c613a313a7b693a303b733a31363a22726f6c655f67756573735f61646d696e223b7d),
('3cd083784684adeb92d77d6faa59944b373f0f6e', '::1', 1471069195, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313036393139353b),
('bccc79b5d8719142e5041b592b42e844a1a984ca', '::1', 1471069195, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313036393139353b),
('f5faef00470c8c41503b0a59d90fe8ab9a54357b', '::1', 1471074389, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313037343338393b757365725f69647c733a323a223133223b656d61696c7c733a373a223140312e636f6d223b6e616d657c733a343a2231313131223b726f6c65737c613a313a7b693a303b733a31363a22726f6c655f67756573735f61646d696e223b7d),
('4c40c28fd7df9635ec0f09cdb222912cadd4bd62', '::1', 1471074695, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313037343639353b757365725f69647c733a323a223133223b656d61696c7c733a373a223140312e636f6d223b6e616d657c733a343a2231313131223b726f6c65737c613a313a7b693a303b733a31363a22726f6c655f67756573735f61646d696e223b7d),
('8c4c0cb2807ff7166aae10533a8bb60e177e48ac', '::1', 1471075185, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313037353138353b757365725f69647c733a323a223133223b656d61696c7c733a373a223140312e636f6d223b6e616d657c733a343a2231313131223b726f6c65737c613a313a7b693a303b733a31363a22726f6c655f67756573735f61646d696e223b7d),
('1e976e60a61e12491fe6bf7d22324c920f9e07a8', '::1', 1471075216, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437313037353138353b757365725f69647c733a323a223133223b656d61696c7c733a373a223140312e636f6d223b6e616d657c733a343a2231313131223b726f6c65737c613a313a7b693a303b733a31363a22726f6c655f67756573735f61646d696e223b7d);

-- --------------------------------------------------------

--
-- 表的结构 `guess_guess_info`
--

CREATE TABLE `guess_guess_info` (
  `guess_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `score` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `point` int(11) NOT NULL,
  `guess_result` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `guess_guess_info`
--

INSERT INTO `guess_guess_info` (`guess_id`, `user_id`, `match_id`, `score`, `point`, `guess_result`) VALUES
(9, 13, 8, '-1', 10, 0),
(10, 13, 8, '0', 20, 0),
(11, 13, 8, '1', 30, 0),
(12, 13, 8, '0', 1000, 0),
(13, 13, 8, '-1', 1500, 0),
(14, 13, 8, '-1', 1900, 0),
(15, 13, 8, '-1', 9999, 0),
(16, 13, 8, '0', 1000, 0),
(17, 13, 11, '-1', 100, 0),
(18, 13, 11, '1', 300, 0),
(19, 13, 11, '0', 800, 0),
(20, 13, 11, '-1', 2, 0),
(21, 13, 11, '-1', 56, 0),
(22, 13, 11, '0', 22, 0),
(23, 13, 11, '1', 222, 0),
(24, 13, 11, '1', 11, 0),
(25, 13, 11, '1', 15, 0),
(26, 13, 11, '1', 100, 0),
(27, 13, 11, '0', 20, 0),
(28, 13, 11, '0', 1, 0),
(29, 13, 1, '-1', 20, 1),
(30, 13, 2, '0', 300, 0),
(31, 13, 3, '-1', 22, 0),
(32, 13, 3, '-1', 20, 0),
(33, 13, 4, '-1', 200, 0),
(34, 13, 9, '1', 200, 0),
(35, 13, 10, '0', 200, 0),
(36, 13, 10, '-1', 300, 0),
(37, 13, 7, '1', 200, 0),
(38, 13, 8, '1', 200, 0),
(39, 13, 12, '1', 2000, 0),
(40, 13, 1, '0', 10, 0),
(41, 13, 2, '1', 1, 0),
(42, 13, 9, '0', 20, 0),
(43, 13, 3, '1', 10, 0),
(44, 13, 3, '1', 200, 0),
(45, 13, 11, '-1', 10, 0),
(46, 13, 11, '-1', 100, 0);

-- --------------------------------------------------------

--
-- 表的结构 `guess_match_info`
--

CREATE TABLE `guess_match_info` (
  `id` int(11) NOT NULL,
  `home_id` int(11) NOT NULL,
  `away_id` int(11) NOT NULL,
  `fixture` int(11) NOT NULL,
  `deadline` int(11) NOT NULL,
  `tm_match_id` int(11) DEFAULT NULL,
  `update_at` int(11) NOT NULL,
  `submitted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- 转存表中的数据 `guess_match_info`
--

INSERT INTO `guess_match_info` (`id`, `home_id`, `away_id`, `fixture`, `deadline`, `tm_match_id`, `update_at`, `submitted`) VALUES
(1, 1, 2, 1467788416, 1467781216, 123064379, 1467776135, 1),
(3, 4, 1, 1467961216, 1467954016, 123064389, 1467776448, 0),
(4, 5, 6, 1467961217, 1467954017, 123064396, 1467776477, 0),
(7, 17, 18, 1468401660, 1468394460, NULL, 1467796938, 0),
(8, 17, 19, 1469181900, 1469174700, NULL, 1467799549, 0),
(9, 1, 20, 1468134004, 1468126804, 123064399, 1468131086, 0),
(10, 21, 22, 1468138399, 1468131199, 123064398, 1468136201, 0),
(11, 23, 24, 1472302320, 1472215920, NULL, 1468587165, 0);

-- --------------------------------------------------------

--
-- 表的结构 `guess_match_odds`
--

CREATE TABLE `guess_match_odds` (
  `odds_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `score` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `odds` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `guess_match_odds`
--

INSERT INTO `guess_match_odds` (`odds_id`, `match_id`, `score`, `odds`) VALUES
(1, 1, '1', '1.20'),
(2, 1, '0', '1.60'),
(3, 1, '-1', '6.00'),
(4, 2, '1', '2.20'),
(5, 2, '0', '1.10'),
(6, 2, '-1', '2.10'),
(7, 3, '1', '2.00'),
(8, 3, '0', '1.80'),
(9, 3, '-1', '3.00'),
(10, 4, '1', '568.00'),
(11, 4, '0', '2.00'),
(12, 4, '-1', '2.33'),
(19, 7, '1', '2.20'),
(20, 7, '0', '1.80'),
(21, 7, '-1', '1.40'),
(22, 8, '1', '2.50'),
(23, 8, '0', '1.80'),
(24, 8, '-1', '1.20'),
(25, 9, '1', '1.20'),
(26, 9, '0', '11.00'),
(27, 9, '-1', '1.40'),
(28, 10, '1', '1.20'),
(29, 10, '0', '1.80'),
(30, 10, '-1', '1.20'),
(31, 11, '1', '1.10'),
(32, 11, '0', '1.60'),
(33, 11, '-1', '1.40'),
(34, 12, '1', '1.20'),
(35, 12, '0', '1.60'),
(36, 12, '-1', '1.40');

-- --------------------------------------------------------

--
-- 表的结构 `guess_team_info`
--

CREATE TABLE `guess_team_info` (
  `id` int(11) NOT NULL,
  `team_name` varchar(200) COLLATE utf32_unicode_ci NOT NULL,
  `tm_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- 转存表中的数据 `guess_team_info`
--

INSERT INTO `guess_team_info` (`id`, `team_name`, `tm_id`) VALUES
(1, '无处不在的范尼', 2370328),
(2, 'Jinzhou FK', 3834828),
(3, 'Beijing FX', 3272490),
(4, 'B Real Madrid A.C.红金龙', 3600856),
(5, '无处不在的范尼小分队', 3473826),
(6, '米兰内洛', 2111001),
(17, '中国', NULL),
(18, '日本', NULL),
(19, '英格兰', NULL),
(20, 'B.K Suizhou', 3835588),
(21, '山东晋南闪电', 3835585),
(22, '青岛高校国信足球俱乐部', 3835586),
(23, '葡萄牙', NULL),
(24, '法国', NULL),
(25, 'Fenghua Shi GS', 3834827);

-- --------------------------------------------------------

--
-- 表的结构 `guess_user`
--

CREATE TABLE `guess_user` (
  `id` int(11) NOT NULL,
  `roles` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'role_user',
  `tm_id` int(11) DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `enable` tinyint(1) NOT NULL DEFAULT '1',
  `update_at` int(11) NOT NULL DEFAULT '1',
  `create_at` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `guess_user`
--

INSERT INTO `guess_user` (`id`, `roles`, `tm_id`, `email`, `name`, `password`, `enable`, `update_at`, `create_at`) VALUES
(13, 'role_guess_admin', 1111, '1@1.com', '1111', '$6$rounds=5000$usesomesillystri$ZkOG5TjiP4alo4h6LKoXB876LYG4RL15KBXZYTPYqzBqYE3aR91ls5P4hRcoJZmBjAvV6zfgVZVtq47Qm4Rif/', 1, 1468158921, 1468158921);

-- --------------------------------------------------------

--
-- 表的结构 `guess_user_point`
--

CREATE TABLE `guess_user_point` (
  `user_id` int(11) NOT NULL,
  `point` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `guess_user_point`
--

INSERT INTO `guess_user_point` (`user_id`, `point`) VALUES
(13, 993357);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `guess_guess_info`
--
ALTER TABLE `guess_guess_info`
  ADD PRIMARY KEY (`guess_id`);

--
-- Indexes for table `guess_match_info`
--
ALTER TABLE `guess_match_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guess_match_odds`
--
ALTER TABLE `guess_match_odds`
  ADD PRIMARY KEY (`odds_id`),
  ADD KEY `match_id` (`match_id`);

--
-- Indexes for table `guess_team_info`
--
ALTER TABLE `guess_team_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_name` (`team_name`(191));

--
-- Indexes for table `guess_user`
--
ALTER TABLE `guess_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`email`,`name`);

--
-- Indexes for table `guess_user_point`
--
ALTER TABLE `guess_user_point`
  ADD PRIMARY KEY (`user_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `guess_guess_info`
--
ALTER TABLE `guess_guess_info`
  MODIFY `guess_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- 使用表AUTO_INCREMENT `guess_match_info`
--
ALTER TABLE `guess_match_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- 使用表AUTO_INCREMENT `guess_match_odds`
--
ALTER TABLE `guess_match_odds`
  MODIFY `odds_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- 使用表AUTO_INCREMENT `guess_team_info`
--
ALTER TABLE `guess_team_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- 使用表AUTO_INCREMENT `guess_user`
--
ALTER TABLE `guess_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
