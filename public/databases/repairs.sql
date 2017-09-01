-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-09-01 07:25:56
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `repairs`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) UNSIGNED NOT NULL COMMENT '管理员ID',
  `admin_name` varchar(20) NOT NULL COMMENT '管理员名称',
  `admin_avatar` varchar(100) DEFAULT NULL COMMENT '管理员头像',
  `admin_password` varchar(32) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `admin_login_time` int(10) NOT NULL COMMENT '登录时间',
  `admin_login_num` int(11) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `admin_is_super` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否超级管理员',
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  `admin_quick_link` varchar(400) DEFAULT NULL COMMENT '管理员常用操作',
  `member_id` int(11) DEFAULT NULL COMMENT '绑定前台帐号，可以使用前台帐号密码登录后台',
  `status` int(1) UNSIGNED ZEROFILL DEFAULT '0' COMMENT '状态：-1禁用，0启用',
  `create_time` int(20) DEFAULT NULL,
  `update_time` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- --------------------------------------------------------

--
-- 表的结构 `admin_auth`
--

CREATE TABLE `admin_auth` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL DEFAULT '',
  `title` varchar(20) NOT NULL DEFAULT '',
  `type` int(1) NOT NULL DEFAULT '1',
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '链接',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `pid` int(10) NOT NULL COMMENT '父级ID',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(20) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='功能权限';

-- --------------------------------------------------------

--
-- 表的结构 `admin_role`
--

CREATE TABLE `admin_role` (
  `role_id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `role_name` varchar(20) DEFAULT NULL COMMENT '角色名称',
  `role_group` text COMMENT '权限内容',
  `role_desc` text COMMENT '描述',
  `create_time` int(20) DEFAULT NULL COMMENT '添加时间',
  `update_time` int(20) DEFAULT NULL COMMENT '更新时间',
  `status` int(1) DEFAULT '0' COMMENT '状态：-1禁用，0是启用'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色权限';

-- --------------------------------------------------------

--
-- 表的结构 `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL COMMENT 'id',
  `conventional_material` varchar(500) NOT NULL COMMENT '常规物料',
  `homemade_material` varchar(500) NOT NULL COMMENT '自制物料',
  `promotional_material` varchar(500) NOT NULL COMMENT '促销物料',
  `guarantee` varchar(500) NOT NULL COMMENT '保修类',
  `status` int(2) DEFAULT '0' COMMENT '状态',
  `marks` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_time` int(10) DEFAULT '0',
  `update_time` int(10) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='申请内容表';

-- --------------------------------------------------------

--
-- 表的结构 `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '信息状态(1警告,2错误,3严重错误)',
  `type` varchar(10) NOT NULL COMMENT '日志类型(system 系统日志 ,daily 日常 )',
  `remarks` text NOT NULL COMMENT '备注',
  `function` varchar(20) NOT NULL COMMENT '备注方法',
  `update_time` int(20) DEFAULT NULL,
  `create_time` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统日志';

-- --------------------------------------------------------

--
-- 表的结构 `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL COMMENT '业务员id',
  `name` varchar(50) NOT NULL COMMENT '业务员名称',
  `email` varchar(30) DEFAULT NULL COMMENT '邮箱',
  `real_name` varchar(10) NOT NULL COMMENT '真实姓名',
  `passwd` varchar(32) NOT NULL COMMENT '会员密码',
  `card` varchar(50) NOT NULL COMMENT '会员身份证',
  `address` varchar(50) NOT NULL COMMENT '户籍地址',
  `phone` varchar(20) NOT NULL COMMENT '会员电话',
  `img` varchar(100) DEFAULT NULL COMMENT '会员头像',
  `gc_id` varchar(20) NOT NULL DEFAULT '' COMMENT '所属门店',
  `create_time` int(10) DEFAULT '0',
  `update_time` int(10) DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '0不能登录1 可以登录',
  `open_id` varchar(50) DEFAULT NULL COMMENT 'openid',
  `marks` varchar(255) DEFAULT NULL COMMENT '备注'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='业务员表';

-- --------------------------------------------------------

--
-- 表的结构 `member_class`
--

CREATE TABLE `member_class` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '索引ID',
  `name` varchar(100) NOT NULL COMMENT '分类名称',
  `type_id` int(10) UNSIGNED DEFAULT '0' COMMENT '类型id',
  `type_name` varchar(100) DEFAULT '' COMMENT '类型名称',
  `parent_id` int(10) UNSIGNED DEFAULT '0' COMMENT '父ID',
  `standard` varchar(30) DEFAULT '' COMMENT '分类标实',
  `sort` int(10) UNSIGNED DEFAULT '0' COMMENT '排序',
  `title` varchar(200) DEFAULT '' COMMENT '名称',
  `keywords` varchar(255) DEFAULT '' COMMENT '关键词',
  `description` varchar(255) DEFAULT '' COMMENT '描述',
  `image` varchar(100) DEFAULT '' COMMENT '分类图标',
  `update_time` int(20) DEFAULT NULL COMMENT '更新时间',
  `create_time` int(20) DEFAULT NULL COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分类表';

-- --------------------------------------------------------

--
-- 表的结构 `setting`
--

CREATE TABLE `setting` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '配置ID',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '配置标题',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '配置名称',
  `value` text NOT NULL COMMENT '配置值',
  `group` int(4) UNSIGNED NOT NULL DEFAULT '0' COMMENT '配置分组',
  `type` varchar(16) NOT NULL DEFAULT '' COMMENT '配置类型',
  `options` varchar(255) NOT NULL DEFAULT '' COMMENT '配置额外值',
  `tip` varchar(100) NOT NULL DEFAULT '' COMMENT '配置说明',
  `create_time` int(11) UNSIGNED DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) UNSIGNED DEFAULT NULL COMMENT '更新时间',
  `sort` int(4) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序',
  `status` int(4) NOT NULL DEFAULT '0' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统配置表';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admin_auth`
--
ALTER TABLE `admin_auth`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `admin_role`
--
ALTER TABLE `admin_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `member_class`
--
ALTER TABLE `member_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '管理员ID';
--
-- 使用表AUTO_INCREMENT `admin_auth`
--
ALTER TABLE `admin_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `admin_role`
--
ALTER TABLE `admin_role`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id';
--
-- 使用表AUTO_INCREMENT `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- 使用表AUTO_INCREMENT `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '业务员id';
--
-- 使用表AUTO_INCREMENT `member_class`
--
ALTER TABLE `member_class`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '索引ID';
--
-- 使用表AUTO_INCREMENT `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '配置ID';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
