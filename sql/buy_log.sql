/*
Navicat MySQL Data Transfer

Source Server         : bookshare
Source Server Version : 50067
Source Host           : 192.168.21.157:3306
Source Database       : bookshare

Target Server Type    : MYSQL
Target Server Version : 50067
File Encoding         : 65001

Date: 2012-02-05 18:06:48
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `buy_log`
-- ----------------------------
DROP TABLE IF EXISTS `buy_log`;
CREATE TABLE `buy_log` (
  `id` int(11) NOT NULL auto_increment,
  `no` varchar(20) NOT NULL,
  `points` int(11) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `amount` float NOT NULL,
  `remark` varchar(1000) default NULL,
  `pay_way` varchar(50) default NULL,
  `status` int(11) NOT NULL default '0',
  `active` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL,
  `create_time` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of buy_log
-- ----------------------------
