/*
Navicat MySQL Data Transfer

Source Server         : bookshare
Source Server Version : 50067
Source Host           : 192.168.21.157:3306
Source Database       : bookshare

Target Server Type    : MYSQL
Target Server Version : 50067
File Encoding         : 65001

Date: 2011-09-27 17:08:14
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `books`
-- ----------------------------
DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(45) NOT NULL,
  `desc` varchar(1000) NOT NULL,
  `short_desc` varchar(200) NOT NULL,
  `point` float NOT NULL default '0',
  `create_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `create_by` int(10) unsigned NOT NULL,
  `url_path` varchar(45) default NULL,
  `path` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of books
-- ----------------------------
INSERT INTO `books` VALUES ('1', 'aa', '11', '22', '0.5', '2011-09-27 16:58:18', '1', null, null);
