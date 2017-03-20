-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-11-10 08:13:00
-- 服务器版本： 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wemall`
--

-- --------------------------------------------------------

--
-- 表的结构 `wemall_addon_card_config`
--

CREATE TABLE IF NOT EXISTS `wemall_addon_card_config` (
`id` int(10) unsigned NOT NULL,
  `notify_url` text NOT NULL,
  `about_url` text NOT NULL,
  `address` text NOT NULL,
  `tel` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wemall_addon_card_config`
--

INSERT INTO `wemall_addon_card_config` (`id`, `notify_url`, `about_url`, `address`, `tel`, `time`) VALUES
(1, '#', '#', '河南郑州', '10086', '2015-11-10 03:58:23');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_ads`
--

CREATE TABLE IF NOT EXISTS `wemall_ads` (
`id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `sub` text NOT NULL,
  `file_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `remark` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `wemall_ads`
--

INSERT INTO `wemall_ads` (`id`, `name`, `sub`, `file_id`, `url`, `remark`, `time`) VALUES
(1, '1', '', 7, '', '1', '2015-11-06 06:58:06'),
(2, '2', '', 6, '', '1', '2015-11-06 06:58:20'),
(3, '3', '', 5, '', '1', '2015-11-06 06:58:30'),
(4, '4', '', 4, '', '1', '2015-11-06 06:58:41'),
(5, '5', '', 3, '', '1', '2015-11-06 06:58:50'),
(6, '7', '', 2, '', '1', '2015-11-06 06:58:57');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_alipay`
--

CREATE TABLE IF NOT EXISTS `wemall_alipay` (
`id` int(11) NOT NULL,
  `alipayname` varchar(100) DEFAULT NULL COMMENT '支付宝名称',
  `partner` varchar(100) DEFAULT NULL COMMENT '合作身份者id',
  `key` varchar(100) DEFAULT NULL COMMENT '安全检验码',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wemall_alipay`
--

INSERT INTO `wemall_alipay` (`id`, `alipayname`, `partner`, `key`, `time`) VALUES
(1, '', '', '', '2015-11-06 09:23:05');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_analysis`
--

CREATE TABLE IF NOT EXISTS `wemall_analysis` (
`id` int(10) unsigned NOT NULL,
  `orders` int(11) NOT NULL,
  `trades` float NOT NULL,
  `registers` int(11) NOT NULL,
  `users` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wemall_artical`
--

CREATE TABLE IF NOT EXISTS `wemall_artical` (
`id` int(10) unsigned NOT NULL,
  `title` text NOT NULL,
  `file_id` int(11) NOT NULL,
  `author` text NOT NULL,
  `sub` text NOT NULL,
  `content` text NOT NULL,
  `remark` text NOT NULL,
  `visiter` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wemall_auth_group`
--

CREATE TABLE IF NOT EXISTS `wemall_auth_group` (
`id` mediumint(8) unsigned NOT NULL,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wemall_auth_group`
--

INSERT INTO `wemall_auth_group` (`id`, `title`, `status`, `rules`, `time`) VALUES
(1, '超级管理员', 1, '1', '2015-11-06 03:46:17');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_auth_group_access`
--

CREATE TABLE IF NOT EXISTS `wemall_auth_group_access` (
`id` int(10) unsigned NOT NULL,
  `uid` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wemall_auth_group_access`
--

INSERT INTO `wemall_auth_group_access` (`id`, `uid`, `group_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `wemall_auth_rule`
--

CREATE TABLE IF NOT EXISTS `wemall_auth_rule` (
`id` mediumint(8) unsigned NOT NULL,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- 转存表中的数据 `wemall_auth_rule`
--

INSERT INTO `wemall_auth_rule` (`id`, `name`, `title`, `type`, `status`, `condition`, `time`) VALUES
(1, 'Admin/Index/index', '系统首页', 1, 1, '', '2015-10-13 21:51:29'),
(2, 'Admin/Index/userChart', '用户分析', 1, 1, '', '2015-10-18 02:19:06'),
(3, 'Admin/Config/shopSet', '商城设置', 1, 1, '', '2015-10-14 10:15:02'),
(4, 'Admin/Config/addressSet', '地址设置', 1, 1, '', '2015-10-14 06:03:58'),
(5, 'Admin/Config/tplSet', '模板设置', 1, 1, '', '2015-10-14 06:04:24'),
(6, 'Admin/Config/alipaySet', '支付宝设置', 1, 1, '', '2015-10-14 06:04:46'),
(7, 'Admin/Config/wxPrintSet', '微信打印机设置', 1, 1, '', '2015-10-14 06:05:04'),
(8, 'Admin/Config/smsSet', '短信验证设置', 1, 1, '', '2015-10-14 06:05:26'),
(9, 'Admin/Config/wxTplMsgSet', '微信模板消息设置', 1, 1, '', '2015-10-14 06:05:45'),
(10, 'Admin/Weixin/wxSet', '微信设置', 1, 1, '', '2015-10-14 06:07:56'),
(11, 'Admin/Weixin/wxMenuSet', '微信菜单设置', 1, 1, '', '2015-10-14 06:08:13'),
(12, 'Admin/Weixin/wxReplySet', '自定义回复设置', 1, 1, '', '2015-10-14 06:08:26'),
(13, 'Admin/Shop/ads', '广告管理', 1, 1, '', '2015-10-14 06:08:44'),
(14, 'Admin/Shop/menu', '菜单管理', 1, 1, '', '2015-10-14 06:09:00'),
(15, 'Admin/Shop/product', '商品管理', 1, 1, '', '2015-10-14 06:09:15'),
(16, 'Admin/Order/order', '订单管理', 1, 1, '', '2015-10-14 06:09:41'),
(17, 'Admin/Trade/trade', '财务管理', 1, 1, '', '2015-10-14 06:09:59'),
(18, 'Admin/User/authGroup', '用户组管理', 1, 1, '', '2015-10-14 06:10:16'),
(19, 'Admin/Addon/addon', '插件管理', 1, 1, '', '2015-10-14 06:11:01'),
(20, 'Admin/User/authRule', '权限管理', 1, 1, '', '2015-10-14 06:10:16'),
(21, 'Admin/User/user', '用户管理', 1, 1, '', '2015-10-14 10:18:46'),
(22, 'Admin/Config/addProvince', '添加省份', 1, 1, '', '2015-10-14 10:19:00'),
(23, 'Admin/Config/modifyProvince', '修改省份', 1, 1, '', '2015-10-14 06:03:58'),
(24, 'Admin/Config/delProvince', '删除省份', 1, 1, '', '2015-10-14 06:03:58'),
(25, 'Admin/Config/addCity', '添加城市', 1, 1, '', '2015-10-14 06:03:58'),
(26, 'Admin/Config/city', '城市管理', 1, 1, '', '2015-10-14 10:19:56'),
(27, 'Admin/Config/delCity', '删除城市', 1, 1, '', '2015-10-14 06:03:58'),
(28, 'Admin/Config/modifyCity', '修改城市', 1, 1, '', '2015-10-14 06:03:58'),
(29, 'Admin/File/imageUploader', '图片管理', 1, 1, '', '2015-10-14 10:20:12'),
(30, 'Admin/File/delImage', '删除图片', 1, 1, '', '2015-10-14 10:20:18'),
(31, 'Admin/File/uploadImage', '上传图片', 1, 1, '', '2015-10-14 10:20:24'),
(32, 'Admin/Shop/addMenu', '添加菜单', 1, 1, '', '2015-10-14 06:08:44'),
(33, 'Admin/Shop/modifyMenu', '修改菜单', 1, 1, '', '2015-10-14 06:08:44'),
(34, 'Admin/Shop/delMenu', '删除菜单', 1, 1, '', '2015-10-14 06:08:44'),
(35, 'Admin/Shop/addProduct', '添加商品', 1, 1, '', '2015-10-14 06:08:44'),
(36, 'Admin/Shop/modifyProduct', '修改商品', 1, 1, '', '2015-10-14 06:08:44'),
(37, 'Admin/Shop/updateProduct', '更新商品', 1, 1, '', '2015-10-18 03:09:21'),
(38, 'Admin/Shop/delProduct', '删除商品', 1, 1, '', '2015-10-14 10:21:04'),
(39, 'Admin/Shop/addAds', '添加广告', 1, 1, '', '2015-10-14 10:21:11'),
(40, 'Admin/Shop/modifyAds', '修改广告', 1, 1, '', '2015-10-14 10:21:17'),
(41, 'Admin/Shop/delAds', '删除广告', 1, 1, '', '2015-10-14 10:21:23'),
(42, 'Admin/User/login', '用户登录', 1, 1, '', '2015-10-14 10:21:31'),
(43, 'Admin/User/logout', '用户注销', 1, 1, '', '2015-10-14 10:21:37'),
(44, 'Admin/User/delUser', '删除用户', 1, 1, '', '2015-10-14 10:21:43'),
(45, 'Admin/User/addUser', '添加用户', 1, 1, '', '2015-10-14 10:21:48'),
(46, 'Admin/User/modifyUser', '修改用户', 1, 1, '', '2015-10-14 10:21:54'),
(47, 'Admin/User/addAuthGroup', '添加用户组', 1, 1, '', '2015-10-14 10:22:00'),
(48, 'Admin/User/modifyAuthGroup', '修改用户组', 1, 1, '', '2015-10-14 10:22:09'),
(49, 'Admin/User/delAuthGroup', '删除用户组', 1, 1, '', '2015-10-14 10:22:14'),
(50, 'Admin/Base/getNotify', '系统通知', 1, 1, '', '2015-10-18 02:16:38'),
(51, 'Admin/Addon/addonShop', '插件商店', 1, 1, '', '2015-10-14 06:11:01'),
(52, 'Admin/Index/orderChart', '订单分析', 1, 1, '', '2015-10-18 02:19:17'),
(53, 'Admin/Index/productChart', '商品分析', 1, 1, '', '2015-10-18 02:19:35'),
(54, 'Admin/Shop/comment', '评论管理', 1, 1, '', '2015-10-14 10:21:23'),
(55, 'Admin/Shop/productSearch', '商品搜索', 1, 1, '', '2015-10-18 02:21:13'),
(56, 'Admin/Order/search', '订单搜索', 1, 1, '', '2015-10-18 02:24:07'),
(57, 'Admin/Shop/delComment', '删除评论', 1, 1, '', '2015-10-14 10:21:23'),
(58, 'Admin/Order/update', '订单操作', 1, 1, '', '2015-10-18 03:00:46');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_comment`
--

CREATE TABLE IF NOT EXISTS `wemall_comment` (
`id` int(10) unsigned NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wemall_config`
--

CREATE TABLE IF NOT EXISTS `wemall_config` (
`id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `notification` text NOT NULL,
  `reminder` text NOT NULL,
  `tel` text NOT NULL,
  `address` text NOT NULL,
  `freight` float NOT NULL,
  `full` int(11) NOT NULL COMMENT '满',
  `discount` int(11) NOT NULL COMMENT '减',
  `delivery_time` text NOT NULL,
  `theme` text NOT NULL,
  `qrcode` text NOT NULL,
  `oauth` tinyint(1) NOT NULL,
  `oauth_debug` int(1) NOT NULL,
  `balance_payment` tinyint(1) NOT NULL,
  `wechat_payment` tinyint(1) NOT NULL,
  `alipay_payment` tinyint(1) NOT NULL,
  `cool_payment` tinyint(1) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wemall_config`
--

INSERT INTO `wemall_config` (`id`, `name`, `notification`, `reminder`, `tel`, `address`, `freight`, `full`, `discount`, `delivery_time`, `theme`, `qrcode`, `oauth`, `oauth_debug`, `balance_payment`, `wechat_payment`, `alipay_payment`, `cool_payment`, `time`) VALUES
(1, 'wemall商城', '欢迎来到wemall商城!', '您的订单我们将在约定的时间送达，谢谢！收货时间在15:30～17:30时间段内，请留意您的手机。', '10086', '河南省郑州市', 0, 20, 2, '10:30-11:30,14:30-15:30,16:00-17:00,15:30-17:30', 'default', 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQHD7zoAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xL0lramZuV0xsX2ZhQUljSzJ4V0JtAAIEVpV7VQMEAAAAAA%3D%3D', 1, 1, 1, 1, 1, 1, '2015-11-03 03:49:10');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_contact`
--

CREATE TABLE IF NOT EXISTS `wemall_contact` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `province` text,
  `city` text,
  `district` text,
  `address` text NOT NULL,
  `postcode` text,
  `default` tinyint(1) NOT NULL,
  `remark` text,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wemall_file`
--

CREATE TABLE IF NOT EXISTS `wemall_file` (
`id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `ext` text NOT NULL,
  `type` text NOT NULL,
  `savename` text NOT NULL,
  `savepath` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `wemall_file`
--

INSERT INTO `wemall_file` (`id`, `name`, `ext`, `type`, `savename`, `savepath`, `time`) VALUES
(1, '55e6b902cef38.jpg', 'jpg', 'image/jpeg', '56149e72a10c4.jpg', '2015-10-07/', '2015-10-07 04:24:18'),
(2, '5615e26f54d75.jpg', 'jpg', 'image/jpeg', '563c4f4336719.jpg', '2015-11-06/', '2015-11-06 06:57:07'),
(3, '5615ea4fd93f4.jpg', 'jpg', 'image/jpeg', '563c4f433762a.jpg', '2015-11-06/', '2015-11-06 06:57:07'),
(4, '5615eaa90c582.jpg', 'jpg', 'image/jpeg', '563c4f4337c28.jpg', '2015-11-06/', '2015-11-06 06:57:07'),
(5, '5615eaa90d34c.jpg', 'jpg', 'image/jpeg', '563c4f4338996.jpg', '2015-11-06/', '2015-11-06 06:57:07'),
(6, '5615eaa90dfad.jpg', 'jpg', 'image/jpeg', '563c4f4339b2d.jpg', '2015-11-06/', '2015-11-06 06:57:07'),
(7, '5615eaa90e804.jpg', 'jpg', 'image/jpeg', '563c4f433ab12.jpg', '2015-11-06/', '2015-11-06 06:57:07'),
(9, '1-370x370-1420.jpg', 'jpg', 'image/jpeg', '563c52adac85f.jpg', '2015-11-06/', '2015-11-06 07:11:41'),
(10, '1-370x370-5844-4KHF8KDU.jpg', 'jpg', 'image/jpeg', '563c52bb4b7eb.jpg', '2015-11-06/', '2015-11-06 07:11:55'),
(11, '1-370x370-5985-9KPFBWR1.jpg', 'jpg', 'image/jpeg', '563c52bb4bced.jpg', '2015-11-06/', '2015-11-06 07:11:55'),
(12, '1-370x370-6486-BXPDCPCU.jpg', 'jpg', 'image/jpeg', '563c540523c16.jpg', '2015-11-06/', '2015-11-06 07:17:25'),
(13, '1-370x370-5942-KCHKPX9K.jpg', 'jpg', 'image/jpeg', '563c540524b9c.jpg', '2015-11-06/', '2015-11-06 07:17:25'),
(14, '1-370x370-4394-3YU37TSK.jpg', 'jpg', 'image/jpeg', '563c54052539a.jpg', '2015-11-06/', '2015-11-06 07:17:25'),
(15, '1-370x370-3265-PU41F9AB.jpg', 'jpg', 'image/jpeg', '563c540525aca.jpg', '2015-11-06/', '2015-11-06 07:17:25'),
(16, '1-370x370-4854-4TC46UPX.jpg', 'jpg', 'image/jpeg', '563c5405260d0.jpg', '2015-11-06/', '2015-11-06 07:17:25'),
(17, '1-370x370-6423-YSDU6WA6.jpg', 'jpg', 'image/jpeg', '563c540526487.jpg', '2015-11-06/', '2015-11-06 07:17:25'),
(18, '55fa7cf5d3c70.jpg', 'jpg', 'image/jpeg', '563c61f936dbd.jpg', '2015-11-06/', '2015-11-06 08:16:57'),
(19, '55fa79e11089e.png', 'png', 'image/jpeg', '563c61f937aff.png', '2015-11-06/', '2015-11-06 08:16:57'),
(20, '55fa76b46c708.png', 'png', 'image/jpeg', '563c61f938112.png', '2015-11-06/', '2015-11-06 08:16:57'),
(21, '55fa763dbe297.png', 'png', 'image/jpeg', '563c61f9385ba.png', '2015-11-06/', '2015-11-06 08:16:57'),
(22, '55fa76266b041.png', 'png', 'image/jpeg', '563c61f938931.png', '2015-11-06/', '2015-11-06 08:16:57'),
(23, '55fa759ae7a02.png', 'png', 'image/jpeg', '563c61f938cac.png', '2015-11-06/', '2015-11-06 08:16:57'),
(24, '55fa73efc80f0.png', 'png', 'image/jpeg', '563c61f939289.png', '2015-11-06/', '2015-11-06 08:16:57'),
(25, '55fa737d985f2.png', 'png', 'image/jpeg', '563c61f9395ed.png', '2015-11-06/', '2015-11-06 08:16:57'),
(26, '563885a8a6b84.jpg', 'jpg', 'image/jpeg', '563c61f93985d.jpg', '2015-11-06/', '2015-11-06 08:16:57'),
(27, '1417595621584.jpg', 'jpg', 'image/jpeg', '563c68eff3721.jpg', '2015-11-06/', '2015-11-06 08:46:40'),
(28, '1417597271905.jpg', 'jpg', 'image/jpeg', '563c695de2403.jpg', '2015-11-06/', '2015-11-06 08:48:29'),
(29, '1434268044104.jpg', 'jpg', 'image/jpeg', '563c695de2cbe.jpg', '2015-11-06/', '2015-11-06 08:48:29');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_loc_city`
--

CREATE TABLE IF NOT EXISTS `wemall_loc_city` (
`id` int(10) unsigned NOT NULL,
  `province_id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wemall_loc_city`
--

INSERT INTO `wemall_loc_city` (`id`, `province_id`, `name`) VALUES
(1, 1, '郑州市');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_loc_district`
--

CREATE TABLE IF NOT EXISTS `wemall_loc_district` (
`id` int(10) unsigned NOT NULL,
  `province_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `zipcode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wemall_loc_province`
--

CREATE TABLE IF NOT EXISTS `wemall_loc_province` (
`id` int(10) unsigned NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wemall_loc_province`
--

INSERT INTO `wemall_loc_province` (`id`, `name`) VALUES
(1, '河南省');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_log`
--

CREATE TABLE IF NOT EXISTS `wemall_log` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wemall_menu`
--

CREATE TABLE IF NOT EXISTS `wemall_menu` (
`id` int(11) unsigned NOT NULL,
  `name` text NOT NULL,
  `pid` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `remark` text NOT NULL,
  `rank` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `wemall_menu`
--

INSERT INTO `wemall_menu` (`id`, `name`, `pid`, `file_id`, `remark`, `rank`, `time`) VALUES
(1, '水果', 0, 0, '', 0, '2015-11-06 07:00:08'),
(2, '生鲜', 0, 0, '', 0, '2015-11-06 08:05:39'),
(3, '外卖', 0, 0, '', 0, '2015-11-06 08:06:06'),
(4, '超市', 0, 0, '', 0, '2015-11-06 08:06:11'),
(5, '社区', 0, 0, '', 0, '2015-11-06 07:01:11');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_order`
--

CREATE TABLE IF NOT EXISTS `wemall_order` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `orderid` text NOT NULL,
  `totalprice` text NOT NULL,
  `payment` text NOT NULL,
  `pay_status` int(11) NOT NULL,
  `delivery_time` text NOT NULL,
  `freight` float NOT NULL,
  `discount` int(11) NOT NULL,
  `remark` text,
  `status` int(11) NOT NULL COMMENT '0:未处理，1:已发货，-2:退货中，-3:退货完成，-4:申请退货，-1:交易取消，2:交易完成',
  `time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wemall_order_detail`
--

CREATE TABLE IF NOT EXISTS `wemall_order_detail` (
`id` int(10) unsigned NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `attr` text NOT NULL,
  `num` int(11) NOT NULL,
  `price` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wemall_product`
--

CREATE TABLE IF NOT EXISTS `wemall_product` (
`id` int(10) unsigned NOT NULL,
  `menu_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `price` text NOT NULL,
  `score` float NOT NULL,
  `attrs` text NOT NULL,
  `albums` text NOT NULL,
  `store` int(11) NOT NULL,
  `sales` int(11) NOT NULL,
  `visiter` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `detail` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0:售罄，-1:下架，1:出售',
  `recommend` int(11) NOT NULL,
  `remark` text NOT NULL,
  `rank` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `wemall_product`
--

INSERT INTO `wemall_product` (`id`, `menu_id`, `name`, `price`, `score`, `attrs`, `albums`, `store`, `sales`, `visiter`, `file_id`, `detail`, `status`, `recommend`, `remark`, `rank`, `time`) VALUES
(1, 1, '橙子', '12', 12, '', '', 0, 0, 2, 10, '', 1, 0, '', 0, '2015-11-06 07:48:11'),
(2, 1, '香蕉', '12', 12, '', '', 0, 0, 1, 9, '', 1, 0, '', 0, '2015-11-10 05:13:01'),
(3, 1, '苹果', '12', 12, '', '', 0, 1, 12, 11, '', 1, 1, '', 0, '2015-11-09 15:51:46'),
(4, 1, '香梨', '12', 12, '', '', 0, 0, 0, 17, '', 1, 0, '', 0, '2015-11-06 07:17:39'),
(5, 1, '葡萄', '12', 12, '', '', 0, 0, 0, 16, '', 1, 0, '', 0, '2015-11-06 07:18:02'),
(6, 1, '菠萝', '12', 12, '', '', 0, 0, 0, 15, '', 1, 0, '', 0, '2015-11-06 07:18:18'),
(7, 1, '火龙果', '12', 12, '', '', 0, 0, 2, 14, '', 1, 0, '', 0, '2015-11-06 09:38:49'),
(8, 1, '奇异果', '12', 12, '', '', 0, 0, 0, 13, '', 1, 0, '', 0, '2015-11-06 07:18:57'),
(9, 1, '蓝莓', '12', 12, '', '', 0, 0, 1, 12, '', 1, 0, '', 0, '2015-11-06 08:01:53'),
(10, 2, '清蒸鲈鱼', '12', 12, '', '', 0, 0, 0, 24, '', 1, 0, '', 0, '2015-11-06 08:17:37'),
(11, 2, '香辣大闸蟹', '12', 12, '', '', 0, 0, 0, 18, '', 1, 0, '', 0, '2015-11-06 08:19:07'),
(12, 2, '大米饽饽嫩羊肉', '12', 12, '', '', 0, 0, 1, 26, '', 1, 0, '', 0, '2015-11-06 08:21:04'),
(13, 2, '蘸汁菠菜', '12', 12, '', '', 0, 0, 0, 25, '', 1, 0, '', 0, '2015-11-06 08:20:46'),
(14, 2, '手抓羊排', '12', 12, '', '', 0, 0, 0, 23, '', 1, 0, '', 0, '2015-11-06 08:21:29'),
(15, 2, '美汁活鲍', '12', 12, '', '', 0, 0, 0, 22, '', 1, 0, '', 0, '2015-11-06 08:22:13'),
(16, 2, '香辣花甲', '12', 12, '', '', 0, 0, 0, 20, '', 1, 0, '', 0, '2015-11-06 08:23:29'),
(17, 2, '香辣蛏子', '12', 12, '', '', 0, 0, 0, 19, '', 1, 0, '', 0, '2015-11-06 08:27:19'),
(18, 2, '清蒸黄花鱼', '12', 12, '', '', 0, 0, 0, 21, '', 1, 0, '', 0, '2015-11-06 08:29:37'),
(19, 3, '红烧排骨', '12', 12, '', '', 0, 0, 1, 27, '', 1, 0, '', 0, '2015-11-06 08:46:58'),
(20, 3, '京酱肉丝', '12', 12, '', '', 0, 0, 1, 29, '', 1, 0, '', 0, '2015-11-10 02:56:34'),
(21, 3, '肉末茄子', '12', 12, '', '', 0, 0, 0, 28, '', 1, 0, '', 0, '2015-11-10 02:58:03');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_sms`
--

CREATE TABLE IF NOT EXISTS `wemall_sms` (
`id` int(10) unsigned NOT NULL,
  `user` text NOT NULL,
  `pass` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wemall_sms`
--

INSERT INTO `wemall_sms` (`id`, `user`, `pass`, `time`) VALUES
(1, '1', '1', '2015-11-06 03:57:15');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_trade`
--

CREATE TABLE IF NOT EXISTS `wemall_trade` (
`id` int(10) unsigned NOT NULL,
  `tradeid` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `money` float NOT NULL,
  `payment` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wemall_user`
--

CREATE TABLE IF NOT EXISTS `wemall_user` (
`id` int(10) unsigned NOT NULL,
  `openid` text NOT NULL,
  `username` text NOT NULL,
  `phone` text NOT NULL,
  `password` text NOT NULL,
  `token` text,
  `avater` text NOT NULL,
  `sex` tinyint(4) NOT NULL COMMENT '1:男,2女',
  `city` text NOT NULL,
  `province` text NOT NULL,
  `country` text NOT NULL,
  `language` text NOT NULL,
  `subscribe` tinyint(1) NOT NULL,
  `money` float NOT NULL,
  `score` float NOT NULL,
  `status` int(11) NOT NULL,
  `lastip` text NOT NULL,
  `ctime` text NOT NULL,
  `buy_num` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `wemall_user`
--

INSERT INTO `wemall_user` (`id`, `openid`, `username`, `phone`, `password`, `token`, `avater`, `sex`, `city`, `province`, `country`, `language`, `subscribe`, `money`, `score`, `status`, `lastip`, `ctime`, `buy_num`, `time`) VALUES
(1, '', 'admin', '', '21232f297a57a5a743894a0e4a801fc3', '', '', 0, '', '', '', '', 0, 0, 0, 0, '', '', 0, '2015-11-06 03:50:57'),
(2, 'oojFxs4s3PSZVjL-X5UpFPhNfG0c', 'better', '', '21232f297a57a5a743894a0e4a801fc3', '', 'http://wx.qlogo.cn/mmopen/KMt8YcxoTr7iaBlsovicVoDriciaLBcQtic7D4IyETkKusiasVicTJq5s2PianSUeg9HuVjGXQQQ9Pz07vyrdE7lMQ1EGw/0', 0, '', '', '', '', 0, 12.3, 144, 1, '0.0.0.0', '2015-10-19 12:40:19', 73, '2015-11-09 15:51:46');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_user_favorites`
--

CREATE TABLE IF NOT EXISTS `wemall_user_favorites` (
`id` int(11) NOT NULL,
  `product_id` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wemall_wx_config`
--

CREATE TABLE IF NOT EXISTS `wemall_wx_config` (
`id` int(5) NOT NULL,
  `token` text NOT NULL,
  `appid` text NOT NULL,
  `appsecret` text NOT NULL,
  `encodingaeskey` text NOT NULL,
  `switch` int(11) NOT NULL,
  `mchid` text NOT NULL,
  `key` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wemall_wx_config`
--

INSERT INTO `wemall_wx_config` (`id`, `token`, `appid`, `appsecret`, `encodingaeskey`, `switch`, `mchid`, `key`, `time`) VALUES
(1, '', '', '', '', 0, '', '', '2015-11-06 09:23:58');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_wx_menu`
--

CREATE TABLE IF NOT EXISTS `wemall_wx_menu` (
`id` int(5) NOT NULL,
  `type` text,
  `name` text NOT NULL,
  `key` text NOT NULL,
  `url` text NOT NULL,
  `pid` int(5) NOT NULL DEFAULT '0',
  `rank` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `wemall_wx_menu`
--

INSERT INTO `wemall_wx_menu` (`id`, `type`, `name`, `key`, `url`, `pid`, `rank`, `status`, `time`) VALUES
(1, 'view', '商业版', '', 'http://1.inuoer.com/wemall/App/Index/index', 0, '', 0, '2015-11-06 09:25:17'),
(2, 'view', '分销版', '', 'http://1.inuoer.com/wfx/App/Shop/index', 0, '', 0, '2015-11-06 09:25:28'),
(3, 'click', 'QQ客服', 'qqkf', '', 0, '', 0, '2015-11-06 09:25:40');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_wx_print`
--

CREATE TABLE IF NOT EXISTS `wemall_wx_print` (
`id` int(11) NOT NULL,
  `apikey` varchar(100) DEFAULT NULL COMMENT 'apikey',
  `mkey` varchar(100) DEFAULT NULL COMMENT '秘钥',
  `partner` varchar(100) DEFAULT NULL COMMENT '用户id',
  `machine_code` varchar(100) DEFAULT NULL COMMENT '机器码',
  `switch` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wemall_wx_print`
--

INSERT INTO `wemall_wx_print` (`id`, `apikey`, `mkey`, `partner`, `machine_code`, `switch`, `time`) VALUES
(1, '1', '1', '1', '1', 0, '2015-11-06 03:57:11');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_wx_reply`
--

CREATE TABLE IF NOT EXISTS `wemall_wx_reply` (
`id` int(10) unsigned NOT NULL,
  `type` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `file_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `key` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `wemall_wx_reply`
--

INSERT INTO `wemall_wx_reply` (`id`, `type`, `title`, `description`, `file_id`, `url`, `key`, `time`) VALUES
(1, 'text', '恭喜你加入WeMall，欢迎体验WeMall商业版，WeMall分销版和WeMall开源版。WeMall商业版更新，速度提升30%，致力于打造世界上最快，体验最好的微商城。客服QQ：2034210985', '', 0, '', 'subscribe', '2015-11-06 09:26:02'),
(2, 'news', '欢迎来到商业版wemall商城', '欢迎来到商业版wemall商城', 1, 'http://1.inuoer.com/3/App/Index/index', '商城', '2015-11-06 09:26:36');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_wx_tplmsg`
--

CREATE TABLE IF NOT EXISTS `wemall_wx_tplmsg` (
`id` int(10) unsigned NOT NULL,
  `template_id_short` text NOT NULL,
  `template_id` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `wemall_wx_tplmsg`
--

INSERT INTO `wemall_wx_tplmsg` (`id`, `template_id_short`, `template_id`, `time`) VALUES
(1, 'OPENTM201785396', '2fXIC52dOVv9NXPbpBN7O9C9W5N5qT28G6OuzVilUt4', '2015-11-06 09:23:20'),
(2, 'OPENTM201285651', 'l4P2fDh8yxG8a3NR-ROzcIuxR-FKvpawFe4Bh3drLd0', '2015-11-06 09:23:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wemall_addon_card_config`
--
ALTER TABLE `wemall_addon_card_config`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_ads`
--
ALTER TABLE `wemall_ads`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_alipay`
--
ALTER TABLE `wemall_alipay`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_analysis`
--
ALTER TABLE `wemall_analysis`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_artical`
--
ALTER TABLE `wemall_artical`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_auth_group`
--
ALTER TABLE `wemall_auth_group`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_auth_group_access`
--
ALTER TABLE `wemall_auth_group_access`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_auth_rule`
--
ALTER TABLE `wemall_auth_rule`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `wemall_comment`
--
ALTER TABLE `wemall_comment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_config`
--
ALTER TABLE `wemall_config`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_contact`
--
ALTER TABLE `wemall_contact`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_file`
--
ALTER TABLE `wemall_file`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_loc_city`
--
ALTER TABLE `wemall_loc_city`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_loc_district`
--
ALTER TABLE `wemall_loc_district`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_loc_province`
--
ALTER TABLE `wemall_loc_province`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_log`
--
ALTER TABLE `wemall_log`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_menu`
--
ALTER TABLE `wemall_menu`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_order`
--
ALTER TABLE `wemall_order`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_order_detail`
--
ALTER TABLE `wemall_order_detail`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_product`
--
ALTER TABLE `wemall_product`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_sms`
--
ALTER TABLE `wemall_sms`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_trade`
--
ALTER TABLE `wemall_trade`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_user`
--
ALTER TABLE `wemall_user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_user_favorites`
--
ALTER TABLE `wemall_user_favorites`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_wx_config`
--
ALTER TABLE `wemall_wx_config`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_wx_menu`
--
ALTER TABLE `wemall_wx_menu`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_wx_print`
--
ALTER TABLE `wemall_wx_print`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_wx_reply`
--
ALTER TABLE `wemall_wx_reply`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_wx_tplmsg`
--
ALTER TABLE `wemall_wx_tplmsg`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wemall_addon_card_config`
--
ALTER TABLE `wemall_addon_card_config`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wemall_ads`
--
ALTER TABLE `wemall_ads`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `wemall_alipay`
--
ALTER TABLE `wemall_alipay`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wemall_analysis`
--
ALTER TABLE `wemall_analysis`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wemall_artical`
--
ALTER TABLE `wemall_artical`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wemall_auth_group`
--
ALTER TABLE `wemall_auth_group`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wemall_auth_group_access`
--
ALTER TABLE `wemall_auth_group_access`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wemall_auth_rule`
--
ALTER TABLE `wemall_auth_rule`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `wemall_comment`
--
ALTER TABLE `wemall_comment`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wemall_config`
--
ALTER TABLE `wemall_config`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wemall_contact`
--
ALTER TABLE `wemall_contact`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wemall_file`
--
ALTER TABLE `wemall_file`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `wemall_loc_city`
--
ALTER TABLE `wemall_loc_city`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wemall_loc_district`
--
ALTER TABLE `wemall_loc_district`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wemall_loc_province`
--
ALTER TABLE `wemall_loc_province`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wemall_log`
--
ALTER TABLE `wemall_log`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wemall_menu`
--
ALTER TABLE `wemall_menu`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `wemall_order`
--
ALTER TABLE `wemall_order`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wemall_order_detail`
--
ALTER TABLE `wemall_order_detail`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wemall_product`
--
ALTER TABLE `wemall_product`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `wemall_sms`
--
ALTER TABLE `wemall_sms`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wemall_trade`
--
ALTER TABLE `wemall_trade`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wemall_user`
--
ALTER TABLE `wemall_user`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `wemall_user_favorites`
--
ALTER TABLE `wemall_user_favorites`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wemall_wx_config`
--
ALTER TABLE `wemall_wx_config`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wemall_wx_menu`
--
ALTER TABLE `wemall_wx_menu`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `wemall_wx_print`
--
ALTER TABLE `wemall_wx_print`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wemall_wx_reply`
--
ALTER TABLE `wemall_wx_reply`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `wemall_wx_tplmsg`
--
ALTER TABLE `wemall_wx_tplmsg`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
