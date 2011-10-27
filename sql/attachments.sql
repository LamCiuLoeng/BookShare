/*
Navicat MySQL Data Transfer

Source Server         : bookshare
Source Server Version : 50067
Source Host           : 192.168.21.157:3306
Source Database       : bookshare

Target Server Type    : MYSQL
Target Server Version : 50067
File Encoding         : 65001

Date: 2011-10-27 16:28:11
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `attachments`
-- ----------------------------
DROP TABLE IF EXISTS `attachments`;
CREATE TABLE `attachments` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(500) NOT NULL,
  `file_path` varchar(1000) default NULL,
  `file_url` varchar(1000) default NULL,
  `active` int(11) default '0',
  `create_by` int(11) NOT NULL,
  `create_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `file_size` int(50) default NULL,
  `file_type` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of attachments
-- ----------------------------
