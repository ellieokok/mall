
--
-- 表的结构 `multi_addon_coupon`
--

CREATE TABLE IF NOT EXISTS `multi_addon_coupon` (
`id` int(10) NOT NULL COMMENT '自增ID',
  `coupon_menu_id` int(16) NOT NULL COMMENT '代金券分类ID',
  `code` varchar(255) NOT NULL COMMENT '代金券码',
  `status` int(11) NOT NULL COMMENT '1为已经使用',
  `price` int(16) NOT NULL COMMENT '代金卷价格',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `ctime` int(16) NOT NULL COMMENT '创建时间',
  `last_time` int(16) NOT NULL COMMENT '最后使用时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `multi_addon_coupon_menu`
--

CREATE TABLE IF NOT EXISTS `multi_addon_coupon_menu` (
`id` int(16) NOT NULL COMMENT '优惠券ID',
  `name` varchar(255) NOT NULL COMMENT '优惠券名字',
  `price` varchar(255) NOT NULL COMMENT '优惠券价格',
  `num` int(12) NOT NULL COMMENT '优惠券数量',
  `last_time` varchar(255) NOT NULL COMMENT '过期时间',
  `ctime` int(16) NOT NULL COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `multi_addon_coupon`
--
ALTER TABLE `multi_addon_coupon`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multi_addon_coupon_menu`
--
ALTER TABLE `multi_addon_coupon_menu`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `multi_addon_coupon`
--
ALTER TABLE `multi_addon_coupon`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID';
--
-- AUTO_INCREMENT for table `multi_addon_coupon_menu`
--
ALTER TABLE `multi_addon_coupon_menu`
MODIFY `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '优惠券ID';