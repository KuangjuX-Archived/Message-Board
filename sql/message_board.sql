-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2020-06-21 04:30:39
-- 服务器版本： 5.7.26
-- PHP 版本： 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `message_board`
--

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nickname` varchar(255) COLLATE utf8_bin NOT NULL,
  `to_message_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `nickname`, `to_message_id`, `comment`, `created_at`, `update_at`) VALUES
(4, 5, '??X', 2, 'hh', '2020-06-21 02:51:13', '2020-06-21 02:51:13'),
(2, 1, '123', 2, '这是一条测试评论', '2020-06-19 13:33:18', '2020-06-19 13:33:18'),
(3, 1, '123', 2, '这是一条测试评论', '2020-06-19 13:33:22', '2020-06-19 13:33:22');

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nickname` varchar(255) COLLATE utf8_bin NOT NULL,
  `topic` text COLLATE utf8_bin NOT NULL,
  `message` text COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`id`, `user_id`, `nickname`, `topic`, `message`, `created_at`, `update_at`) VALUES
(2, 3, 'hhh', '', 'TEST', '2020-06-19 08:28:40', '2020-06-19 08:28:40'),
(3, 3, 'hhh', '', 'TEST', '2020-06-19 08:32:12', '2020-06-19 08:32:12'),
(11, 1, '123', '今天早起', '午饭吃好', '2020-06-20 00:49:06', '2020-06-20 00:49:06'),
(12, 5, 'KuangjuX', '今天早起', '中午吃好', '2020-06-20 01:12:50', '2020-06-20 01:12:50');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `nickname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `avatar` text COLLATE utf8_bin,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nickname`, `email`, `avatar`, `created_at`, `update_at`) VALUES
(1, '123', '456', NULL, NULL, NULL, NULL, NULL),
(2, 'test', 'test', NULL, NULL, NULL, NULL, NULL),
(3, 'hhh', 'hhh', NULL, NULL, NULL, '2020-06-19 06:23:05', '2020-06-19 06:23:05'),
(4, 'ç‹‚ä¸”X', 'Zhjyyjjmjy666', NULL, NULL, NULL, '2020-06-19 13:49:36', '2020-06-19 13:49:36'),
(5, 'KuangjuX', 'Zhjyyjjmjy666', '狂且X', 'KuangjuX@outlook.com', '../avatar/1592712927.jpeg', '2020-06-21 04:15:27', '2020-06-21 04:15:27');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
