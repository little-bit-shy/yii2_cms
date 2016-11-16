/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50552
Source Host           : localhost:3306
Source Database       : myself

Target Server Type    : MYSQL
Target Server Version : 50552
File Encoding         : 65001

Date: 2016-11-16 16:24:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for myself_auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `myself_auth_assignment`;
CREATE TABLE `myself_auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `myself_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `myself_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of myself_auth_assignment
-- ----------------------------
INSERT INTO `myself_auth_assignment` VALUES ('超级管理员就是这么叼', '1', '1479280370');

-- ----------------------------
-- Table structure for myself_auth_item
-- ----------------------------
DROP TABLE IF EXISTS `myself_auth_item`;
CREATE TABLE `myself_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `myself_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `myself_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of myself_auth_item
-- ----------------------------
INSERT INTO `myself_auth_item` VALUES ('/*', '2', null, null, null, '1479281166', '1479281166');
INSERT INTO `myself_auth_item` VALUES ('/site/*', '2', null, null, null, '1479283300', '1479283300');
INSERT INTO `myself_auth_item` VALUES ('/site/error', '2', null, null, null, '1479283296', '1479283296');
INSERT INTO `myself_auth_item` VALUES ('/site/index', '2', null, null, null, '1479283290', '1479283290');
INSERT INTO `myself_auth_item` VALUES ('/site/login', '2', null, null, null, '1479283297', '1479283297');
INSERT INTO `myself_auth_item` VALUES ('/site/logout', '2', null, null, null, '1479283297', '1479283297');
INSERT INTO `myself_auth_item` VALUES ('超级管理员', '2', '裤衩穿外面的家伙...', null, null, '1479280063', '1479280063');
INSERT INTO `myself_auth_item` VALUES ('超级管理员就是这么叼', '1', '想咋咋的，你瞅啥...', null, null, '1479280347', '1479280347');

-- ----------------------------
-- Table structure for myself_auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `myself_auth_item_child`;
CREATE TABLE `myself_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `myself_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `myself_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `myself_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `myself_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of myself_auth_item_child
-- ----------------------------
INSERT INTO `myself_auth_item_child` VALUES ('超级管理员', '/*');
INSERT INTO `myself_auth_item_child` VALUES ('超级管理员就是这么叼', '超级管理员');

-- ----------------------------
-- Table structure for myself_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `myself_auth_rule`;
CREATE TABLE `myself_auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of myself_auth_rule
-- ----------------------------

-- ----------------------------
-- Table structure for myself_menu
-- ----------------------------
DROP TABLE IF EXISTS `myself_menu`;
CREATE TABLE `myself_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `myself_menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `myself_menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of myself_menu
-- ----------------------------
INSERT INTO `myself_menu` VALUES ('1', '首页', '3', '/site/index', '1', null);
INSERT INTO `myself_menu` VALUES ('2', '报错页', '3', '/site/error', '2', null);
INSERT INTO `myself_menu` VALUES ('3', '主页管理', null, null, null, null);

-- ----------------------------
-- Table structure for myself_user
-- ----------------------------
DROP TABLE IF EXISTS `myself_user`;
CREATE TABLE `myself_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) NOT NULL COMMENT '自动登录key',
  `password_hash` varchar(255) NOT NULL COMMENT '加密密码',
  `password_reset_token` varchar(255) DEFAULT NULL COMMENT '重置密码token',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `role` smallint(6) NOT NULL DEFAULT '10' COMMENT '角色等级',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '状态',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of myself_user
-- ----------------------------
INSERT INTO `myself_user` VALUES ('1', 'root', 'GiM61PMEcJTPfDqMkyWG_-KY_VaYBvn6', '$2y$13$iUiYV4O5ivgDkljHoqb48ujPxJgGETrnDBfDgsrWLbhtdRmT9BUdm', null, '1533356676@qq.com', '10', '10', '1479202941', '1479202941');
