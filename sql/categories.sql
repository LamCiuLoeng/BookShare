/*
Navicat MySQL Data Transfer

Source Server         : bookshare
Source Server Version : 50067
Source Host           : 192.168.21.157:3306
Source Database       : bookshare

Target Server Type    : MYSQL
Target Server Version : 50067
File Encoding         : 65001

Date: 2011-10-27 16:27:55
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(45) NOT NULL,
  `description` varchar(200) default NULL,
  `active` int(10) unsigned NOT NULL default '0',
  `create_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `create_by` int(10) unsigned NOT NULL,
  `promote` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', 'Art', 'Art', '0', '2011-10-21 15:46:54', '1', '1');
INSERT INTO `categories` VALUES ('2', 'Comic', 'asdfsdfsadfsad', '0', '2011-10-21 15:47:42', '1', '0');
