-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-02-18 11:03:28
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
-- 表的结构 `multi_vote_config`
--

CREATE TABLE IF NOT EXISTS `multi_addon_vote_config` (
`id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `activity_time` text NOT NULL,
  `about` text NOT NULL,
  `vote_num` int(11) NOT NULL,
  `visiter_num` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `multi_addon_vote_config`
--

INSERT INTO `multi_addon_vote_config` (`id`, `name`, `activity_time`, `about`, `vote_num`, `visiter_num`, `time`) VALUES
(1, 'WeMall5.0满意度投票', '2015年10月10日-2015年11月11日', '<p>&nbsp; &nbsp; &nbsp; &nbsp;近期我们将要上线WeMall5.0版本，这次将给大家的是全新的界面，完美的体验，为了让Wemall官方更加了解你们的意愿，请投上您宝贵的一票。</p><p><img src="http://192.168.1.101/wemall/Public/Uploads/20151023/14455681934289.jpg" _src="http://192.168.1.101/wemall/Public/Uploads/20151023/14455681934289.jpg" style="width: 317px; height: 248px;"/></p>', 685, 1544, '2015-10-23 02:46:57');

-- --------------------------------------------------------

--
-- 表的结构 `multi_vote_record`
--

CREATE TABLE IF NOT EXISTS `multi_addon_vote_record` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `multi_vote_record`
--

INSERT INTO `multi_addon_vote_record` (`id`, `user_id`, `time`) VALUES
(1, 2, '2015-08-28 10:16:13'),
(2, 2, '2015-08-28 10:16:16'),
(3, 2, '2015-08-28 10:17:39'),
(4, 2, '2015-08-28 10:18:07'),
(5, 2, '2015-08-28 10:20:10'),
(6, 2, '2015-08-28 10:26:16'),
(7, 2, '2015-10-23 02:15:07'),
(8, 2, '2015-10-23 02:46:22'),
(9, 2, '2015-10-23 02:46:24'),
(10, 2, '2015-10-23 02:46:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `multi_vote_config`
--
ALTER TABLE `multi_addon_vote_config`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multi_vote_record`
--
ALTER TABLE `multi_addon_vote_record`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `multi_vote_config`
--
ALTER TABLE `multi_addon_vote_config`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `multi_vote_record`
--
ALTER TABLE `multi_addon_vote_record`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
