-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 09 月 07 日 09:59
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `groupmap`
--

-- --------------------------------------------------------

--
-- 表的结构 `groupinfo`
--

CREATE TABLE IF NOT EXISTS `groupinfo` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `groupName` varchar(50) COLLATE utf8_bin NOT NULL,
  `creTime` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `overTime` int(11) NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `loginfo`
--

CREATE TABLE IF NOT EXISTS `loginfo` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `actionTime` int(11) NOT NULL,
  `action` varchar(255) COLLATE utf8_bin NOT NULL,
  `data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `onlineuserinfo`
--

CREATE TABLE IF NOT EXISTS `onlineuserinfo` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `servTime` int(11) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `stateinfo`
--

CREATE TABLE IF NOT EXISTS `stateinfo` (
  `sid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `longitude` double(11,6) NOT NULL,
  `latitude` double(11,6) NOT NULL,
  `servTime` int(11) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `stateinfo`
--

INSERT INTO `stateinfo` (`sid`, `uid`, `longitude`, `latitude`, `servTime`) VALUES
(0, 2, 222.330000, 333.000000, 20140505),
(1, 1, 123.000000, 235.000000, 20140404);

-- --------------------------------------------------------

--
-- 表的结构 `tb_admin`
--

CREATE TABLE IF NOT EXISTS `tb_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) COLLATE utf8_bin NOT NULL,
  `password` varchar(50) COLLATE utf8_bin NOT NULL,
  `checked` int(11) NOT NULL,
  `pwd` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `username`, `password`, `checked`, `pwd`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'admin');

-- --------------------------------------------------------

--
-- 表的结构 `userinfo`
--

CREATE TABLE IF NOT EXISTS `userinfo` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `telAccount` varchar(50) COLLATE utf8_bin NOT NULL,
  `nationNo` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `userName` varchar(255) COLLATE utf8_bin NOT NULL,
  `sex` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `creTime` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
