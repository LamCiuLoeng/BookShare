/*
Navicat MySQL Data Transfer

Source Server         : bookshare
Source Server Version : 50067
Source Host           : 192.168.21.157:3306
Source Database       : bookshare

Target Server Type    : MYSQL
Target Server Version : 50067
File Encoding         : 65001

Date: 2011-10-14 18:35:34
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `books`
-- ----------------------------
DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(45) NOT NULL,
  `description` varchar(1000) default NULL,
  `short_description` varchar(200) default NULL,
  `points` float default '0',
  `create_time` timestamp NULL default CURRENT_TIMESTAMP,
  `create_by` int(10) unsigned default NULL,
  `url_path` varchar(45) default NULL,
  `path` varchar(45) default NULL,
  `rating` int(11) default '0',
  `active` int(11) default '0',
  `download_times` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

