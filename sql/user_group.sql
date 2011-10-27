/*
Navicat MySQL Data Transfer

Source Server         : bookshare
Source Server Version : 50067
Source Host           : 192.168.21.157:3306
Source Database       : bookshare

Target Server Type    : MYSQL
Target Server Version : 50067
File Encoding         : 65001

Date: 2011-10-27 16:27:33
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `user_group`
-- ----------------------------
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  USING BTREE (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_group
-- ----------------------------
