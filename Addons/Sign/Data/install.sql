-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-02-18 11:02:42
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
-- 表的结构 `multi_addon_sign_config`
--

CREATE TABLE IF NOT EXISTS `multi_addon_sign_config` (
`id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `first_sign` float NOT NULL,
  `continue_sign` float NOT NULL,
  `max_sign` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `multi_addon_sign_config`
--

INSERT INTO `multi_addon_sign_config` (`id`, `name`, `first_sign`, `continue_sign`, `max_sign`) VALUES
(1, '签到系统', 6, 2, 30);

-- --------------------------------------------------------

--
-- 表的结构 `multi_addon_sign_record`
--

CREATE TABLE IF NOT EXISTS `multi_addon_sign_record` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `score` float NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `multi_addon_sign_config`
--
ALTER TABLE `multi_addon_sign_config`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multi_addon_sign_record`
--
ALTER TABLE `multi_addon_sign_record`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `multi_addon_sign_config`
--
ALTER TABLE `multi_addon_sign_config`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `multi_addon_sign_record`
--
ALTER TABLE `multi_addon_sign_record`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-02-18 11:27:32
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
-- 表的结构 `multi_addon_score`
--

CREATE TABLE IF NOT EXISTS `multi_addon_score` (
`id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `score` float NOT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL,
  `recommend` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `multi_addon_score`
--

INSERT INTO `multi_addon_score` (`id`, `name`, `score`, `image`, `status`, `recommend`, `rank`, `time`) VALUES
(1, '儿时的辣条', 12, '56299216a9397.jpg', 1, 1, 3, '2015-10-23 01:49:10'),
(2, '真牛皮鞋', 25, '5629930dbe4aa.jpg', 1, 1, 1, '2015-10-23 01:53:17');

-- --------------------------------------------------------

--
-- 表的结构 `multi_addon_score_order`
--

CREATE TABLE IF NOT EXISTS `multi_addon_score_order` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `orderid` text NOT NULL,
  `score_id` int(11) NOT NULL,
  `totalscore` float NOT NULL,
  `status` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `multi_addon_score`
--
ALTER TABLE `multi_addon_score`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multi_addon_score_order`
--
ALTER TABLE `multi_addon_score_order`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `multi_addon_score`
--
ALTER TABLE `multi_addon_score`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `multi_addon_score_order`
--
ALTER TABLE `multi_addon_score_order`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
