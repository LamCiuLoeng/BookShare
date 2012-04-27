SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `email` varchar(100) NOT NULL,
  `active` int(10) unsigned NOT NULL default '0',
  `create_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `password` varchar(45) NOT NULL,
  `points` float default '0',
  `locale` varchar(10) default 'en',
  `account_type` varchar(50) default NULL,
  `pic` varchar(500) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `users` VALUES ('1', 'admin@bookcat.hk', '0','2014-047-21 15:46:54','1q2w3e4r5t',0,'zh_HK','normal',null);

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(45) NOT NULL,
  `active` int(10) unsigned NOT NULL default '0',
  `description` varchar(200) default NULL,
  `create_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `groups` VALUES ('1', 'ADMIN', '0', 'Administrator Group','2012-04-21 15:46:54');
INSERT INTO `groups` VALUES ('2', 'NORMAL', '0', 'Normal User Group','2012-04-21 15:46:54');

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

INSERT INTO `user_group` VALUES ('1','1');


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
  `rating` int(11) default '0',
  `active` int(11) default '0',
  `download_times` int(11) default '0',
  `pages` varchar(500) default NULL,
  `xml` varchar(10000) default NULL,
  `file_path` varchar(500) default NULL,
  `file_url` varchar(500) default NULL,
  `promote` int(11) default '0',
  `cover` varchar(500) default NULL,
  `thumb` varchar(500) default NULL,
  `version` int(11) NOT NULL default '1',
  `author` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



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


SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `book_category`
-- ----------------------------
DROP TABLE IF EXISTS `book_category`;
CREATE TABLE `book_category` (
  `book_id` int(10) unsigned NOT NULL auto_increment,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`book_id`,`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


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


SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `user_book`
-- ----------------------------
DROP TABLE IF EXISTS `user_book`;
CREATE TABLE `user_book` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `points` float NOT NULL default '0',
  `create_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL default '0',
  PRIMARY KEY  (`user_id`,`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


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


SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `exchange_log`
-- ----------------------------
DROP TABLE IF EXISTS `exchange_log`;
CREATE TABLE `exchange_log` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `points` float NOT NULL,
  `create_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL default '0',
  `approve_by_id` int(11) default NULL,
  `update_time` timestamp NULL default NULL,
  `active` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

