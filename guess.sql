-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-06-20 11:56:30
-- 服务器版本： 10.1.9-MariaDB
-- PHP Version: 7.0.1

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
('5f7109e2b3b95f3f86e9029e2a710d6243e9706d', '::1', 1466044899, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436363034343839393b656d61696c7c733a373a223140312e636f6d223b6e616d657c733a343a2231313131223b726f6c65737c613a313a7b693a303b733a31363a22726f6c655f73757065725f61646d696e223b7d),
('910b2dfd961df8b19fa49e8ad7b32969a5b52114', '::1', 1466045505, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436363034353530353b656d61696c7c733a373a223140312e636f6d223b6e616d657c733a343a2231313131223b726f6c65737c613a323a7b693a303b733a31363a22726f6c655f73757065725f61646d696e223b693a313b733a31333a22726f6c655f78785f61646d696e223b7d),
('1ef1f5159faf02aad42f622091fce0a206101411', '::1', 1466045820, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436363034353832303b656d61696c7c733a373a223140312e636f6d223b6e616d657c733a343a2231313131223b726f6c65737c613a323a7b693a303b733a31363a22726f6c655f73757065725f61646d696e223b693a313b733a31333a22726f6c655f78785f61646d696e223b7d),
('d2bc0187a98dfaeadbf75dc2b4b897492fb11378', '::1', 1466046814, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436363034363831343b656d61696c7c733a373a223140312e636f6d223b6e616d657c733a343a2231313131223b726f6c65737c613a323a7b693a303b733a31363a22726f6c655f73757065725f61646d696e223b693a313b733a31333a22726f6c655f78785f61646d696e223b7d),
('897bdeb35be73a4ff46a2e96154cef4255c8940a', '::1', 1466046877, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436363034363837333b656d61696c7c733a373a223140312e636f6d223b6e616d657c733a343a2231313131223b726f6c65737c613a313a7b693a303b733a31363a22726f6c655f73757065725f61646d696e223b7d),
('c07fa5df054601b4b1da8052d24261c967a3c2ae', '::1', 1466384772, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436363338343730373b656d61696c7c733a373a223140312e636f6d223b6e616d657c733a343a2231313131223b726f6c65737c613a313a7b693a303b733a31363a22726f6c655f73757065725f61646d696e223b7d),
('d03f5bd224e3cf73d1d119a15fbf34da004ff6f0', '::1', 1466405013, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436363430343737373b656d61696c7c733a373a223140312e636f6d223b6e616d657c733a343a2231313131223b726f6c65737c613a313a7b693a303b733a31363a22726f6c655f73757065725f61646d696e223b7d);

-- --------------------------------------------------------

--
-- 表的结构 `guess_game_info`
--

CREATE TABLE `guess_game_info` (
  `id` int(11) NOT NULL,
  `home_id` int(11) NOT NULL,
  `away_id` int(11) NOT NULL,
  `fixture` int(11) NOT NULL,
  `deadline` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `guess_team_info`
--

CREATE TABLE `guess_team_info` (
  `id` int(11) NOT NULL,
  `team_name` varchar(200) COLLATE utf32_unicode_ci NOT NULL,
  `tm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

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
(8, 'role_super_admin', 1111, '1@1.com', '1111', '$6$rounds=5000$usesomesillystri$ZkOG5TjiP4alo4h6LKoXB876LYG4RL15KBXZYTPYqzBqYE3aR91ls5P4hRcoJZmBjAvV6zfgVZVtq47Qm4Rif/', 1, 1465571167, 1465571167),
(9, 'role_user', 2222, '2@2.com', '2222', '$6$rounds=5000$usesomesillystri$d1qx8B2wAC8xjTdCccVIUg5DcElIAu/8aHirWtPgBLBUD.adO6jUQR/XGTxiI8HZs2OcSjKRsd1RCfefhlghJ1', 1, 1465729943, 1465729943),
(10, 'role_user', 3333, '3@3.com', '3333', '$6$rounds=5000$usesomesillystri$ZIT8h1jB/zKhxP9ENeDX2c5mF6YEk6xaSsP8lxJ3E8tjruaT/xQkl0833c4drwv2pe5g2bvXAck/X6D/CpR9f/', 1, 1465733767, 1465733767),
(11, 'role_user', 4444, '4@4.com', '4444', '$6$rounds=5000$usesomesillystri$VUrWkhYBJzE7wbsMUD8DRiHNOLd7RBM9.r/jjte6Cp9Sj5HRaVCv/J2DmD5t9vevNtv7ZR85HDBl39zucORFw1', 1, 1465735384, 1465735384),
(12, 'role_user', 5555, '5@5.com', '&lt;code&gt;5555&lt;/code&gt;', '$6$rounds=5000$usesomesillystri$aL6dOreaVowbWxRTFhqSHUG8Q3vjBfU/n1EoNYWXU48vrCzcu0jGb6sYMvL..bPoir/neLXHzZF.qMbu5Vz1v1', 1, 1466405003, 1466405003);

-- --------------------------------------------------------

--
-- 表的结构 `guess_user_score`
--

CREATE TABLE `guess_user_score` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `guess_game_info`
--
ALTER TABLE `guess_game_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guess_team_info`
--
ALTER TABLE `guess_team_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tm_id` (`tm_id`);

--
-- Indexes for table `guess_user`
--
ALTER TABLE `guess_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`email`,`name`);

--
-- Indexes for table `guess_user_score`
--
ALTER TABLE `guess_user_score`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `guess_game_info`
--
ALTER TABLE `guess_game_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `guess_team_info`
--
ALTER TABLE `guess_team_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `guess_user`
--
ALTER TABLE `guess_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- 使用表AUTO_INCREMENT `guess_user_score`
--
ALTER TABLE `guess_user_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
