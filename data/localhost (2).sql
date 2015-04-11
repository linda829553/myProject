-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 04 月 11 日 09:03
-- 服务器版本: 5.5.8
-- PHP 版本: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `ysxh_a2ygxf99`
--
CREATE DATABASE `ysxh_a2ygxf99` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ysxh_a2ygxf99`;

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `admin`
--


-- --------------------------------------------------------

--
-- 表的结构 `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `department`
--

INSERT INTO `department` (`id`, `department_name`) VALUES
(2, '服务部'),
(3, '理事会'),
(4, '主席团');

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `post_time` int(10) unsigned NOT NULL,
  `depart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`id`, `content`, `post_time`, `depart_id`, `user_id`, `parent_id`) VALUES
(1, '你好！！111111111111', 1428508800, 2, 0, 0),
(2, '大这腿子321', 1428716628, -1, 0, 0),
(3, '测试13232131', 1428716831, 4, 1, 0),
(4, '你好吉劳斯莱斯你好吉劳斯莱斯你好吉劳斯莱斯你好吉劳斯莱斯你好吉劳斯莱斯你好吉劳斯莱斯你好吉劳斯莱斯你好吉劳斯莱斯你好吉劳斯莱斯你好吉劳斯莱斯24234243231', 1428716805, 3, 1, 0),
(5, '123413213131', 1428634829, 2, 1, 0),
(6, '按部门查看123213312313', 1428719082, 2, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `position`
--

CREATE TABLE IF NOT EXISTS `position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `position`
--

INSERT INTO `position` (`id`, `position_name`) VALUES
(1, '管理员'),
(2, '理事');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `department_id` int(11) NOT NULL,
  `position_name` varchar(50) NOT NULL,
  `sex` int(11) NOT NULL,
  `mobile` varchar(14) NOT NULL,
  `remark` varchar(50) DEFAULT NULL,
  `mark` int(11) DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `department_id`, `position_name`, `sex`, `mobile`, `remark`, `mark`) VALUES
(3, '1234', '222222', 2, '管理员', 1, '12313233', '', 1),
(8, '4444', '222222', 0, '', 0, '', NULL, 1),
(9, '123', '111111', -1, '', 1, '', '', 1),
(10, '2222', '111111', 3, '', 0, '', '', 0);
