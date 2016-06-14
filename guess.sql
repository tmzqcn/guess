-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-06-14 10:29:08
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
('cbd45843dca6b8e78d923a29dba549f4911eec49', '::1', 1465736044, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436353733363034343b),
('f303a025d91d56f26ca007e3417da6f4d4cb4d9b', '::1', 1465736178, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436353733363034343b);

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
(8, 'role_user', 1111, '1@1.com', '1111', '$6$rounds=5000$usesomesillystri$ZkOG5TjiP4alo4h6LKoXB876LYG4RL15KBXZYTPYqzBqYE3aR91ls5P4hRcoJZmBjAvV6zfgVZVtq47Qm4Rif/', 1, 1465571167, 1465571167),
(9, 'role_user', 2222, '2@2.com', '2222', '$6$rounds=5000$usesomesillystri$d1qx8B2wAC8xjTdCccVIUg5DcElIAu/8aHirWtPgBLBUD.adO6jUQR/XGTxiI8HZs2OcSjKRsd1RCfefhlghJ1', 1, 1465729943, 1465729943),
(10, 'role_user', 3333, '3@3.com', '3333', '$6$rounds=5000$usesomesillystri$ZIT8h1jB/zKhxP9ENeDX2c5mF6YEk6xaSsP8lxJ3E8tjruaT/xQkl0833c4drwv2pe5g2bvXAck/X6D/CpR9f/', 1, 1465733767, 1465733767),
(11, 'role_user', 4444, '4@4.com', '4444', '$6$rounds=5000$usesomesillystri$VUrWkhYBJzE7wbsMUD8DRiHNOLd7RBM9.r/jjte6Cp9Sj5HRaVCv/J2DmD5t9vevNtv7ZR85HDBl39zucORFw1', 1, 1465735384, 1465735384);

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
-- 使用表AUTO_INCREMENT `guess_user`
--
ALTER TABLE `guess_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用表AUTO_INCREMENT `guess_user_score`
--
ALTER TABLE `guess_user_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
