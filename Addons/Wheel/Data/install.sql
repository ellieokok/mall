-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-02-18 08:28:44
-- 服务器版本： 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `multi_4`
--

-- --------------------------------------------------------

--
-- 表的结构 `multi_wheel_config`
--

CREATE TABLE IF NOT EXISTS `multi_addon_wheel_config` (
`id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `activity_time` text NOT NULL,
  `activity_explain` text NOT NULL,
  `everyday` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `level1_prob` float NOT NULL,
  `level2_prob` float NOT NULL,
  `level3_prob` float NOT NULL,
  `level4_prob` float NOT NULL,
  `level5_prob` float NOT NULL,
  `level6_prob` float NOT NULL,
  `level7_prob` float NOT NULL,
  `level1_store` int(11) NOT NULL,
  `level2_store` int(11) NOT NULL,
  `level3_store` int(11) NOT NULL,
  `level4_store` int(11) NOT NULL,
  `level5_store` int(11) NOT NULL,
  `level6_store` int(11) NOT NULL,
  `level7_store` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `multi_wheel_config`
--

INSERT INTO `multi_addon_wheel_config` (`id`, `name`, `activity_time`, `activity_explain`, `everyday`, `status`, `level1_prob`, `level2_prob`, `level3_prob`, `level4_prob`, `level5_prob`, `level6_prob`, `level7_prob`, `level1_store`, `level2_store`, `level3_store`, `level4_store`, `level5_store`, `level6_store`, `level7_store`, `time`) VALUES
(1, '幸运大转盘', '5月28日-6月1日', '<div><strong>111112313231</strong></div><div><br/></div>', 1, 0, 0, 0, 0, 0, 0, 15, 75, 0, 0, 0, 0, 0, 500, 75, '2015-08-28 02:20:47');

-- --------------------------------------------------------

--
-- 表的结构 `multi_wheel_record`
--

CREATE TABLE IF NOT EXISTS `multi_addon_wheel_record` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `multi_wheel_record`
--

INSERT INTO `multi_addon_wheel_record` (`id`, `user_id`, `level`, `time`) VALUES
(1, 2, 0, '2015-08-28 02:09:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `multi_wheel_config`
--
ALTER TABLE `multi_addon_wheel_config`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multi_wheel_record`
--
ALTER TABLE `multi_addon_wheel_record`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `multi_wheel_config`
--
ALTER TABLE `multi_addon_wheel_config`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `multi_wheel_record`
--
ALTER TABLE `multi_addon_wheel_record`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
