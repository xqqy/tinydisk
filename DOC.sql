-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-11-17 21:10:01
-- 服务器版本： 10.2.10-MariaDB-10.2.10+maria~xenial-log
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DOC`
--

-- --------------------------------------------------------

--
-- 表的结构 `DOC`
--

CREATE TABLE `DOC` (
  `NAME` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '文件名',
  `PATH` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '文件路径',
  `INFO` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '没有解释的文件' COMMENT '文件注释',
  `HASH` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='云盘';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `DOC`
--
ALTER TABLE `DOC`
  ADD PRIMARY KEY (`PATH`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
