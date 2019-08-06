/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : weijia

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2019-08-05 08:30:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `a_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `a_name` varchar(255) NOT NULL DEFAULT '' COMMENT '管理员名称',
  `a_pwd` varchar(255) NOT NULL DEFAULT '0' COMMENT '密码',
  `a_toke` varchar(255) NOT NULL DEFAULT '0' COMMENT '密码口令',
  `a_level` enum('0','1','2','3') NOT NULL DEFAULT '0' COMMENT '0：不限，1：总管，2：主管，3：员工',
  `a_status` enum('0','1','-1') NOT NULL DEFAULT '1' COMMENT '0：不限，1：正常，-1：删除',
  `a_phone` varchar(11) NOT NULL DEFAULT '0' COMMENT '手机号',
  `a_email` varchar(255) NOT NULL DEFAULT '0' COMMENT '邮箱',
  `a_ctime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `a_utime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后修改时间',
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'jim', '123456', '0', '1', '-1', '15869693636', '0', '0', '0');
INSERT INTO `admin` VALUES ('2', 'tom', '', '0', '2', '1', '15789897878', '0', '0', '0');
INSERT INTO `admin` VALUES ('3', 'lili', '', '0', '2', '1', '14859685958', '584758@qq.com', '0', '1564915984');
INSERT INTO `admin` VALUES ('4', 'lucy', '123456', '0', '3', '1', '0', '0', '0', '0');
INSERT INTO `admin` VALUES ('5', '11111', '22222', '0', '2', '1', '0', '0', '0', '0');
INSERT INTO `admin` VALUES ('6', '11111', '22222', '0', '2', '1', '0', '0', '0', '0');
INSERT INTO `admin` VALUES ('7', '11111', '22222', '0', '2', '1', '0', '0', '0', '0');
INSERT INTO `admin` VALUES ('8', '11111', '22222', '0', '2', '1', '0', '0', '0', '0');
INSERT INTO `admin` VALUES ('9', '11111', '22222', '0', '2', '1', '0', '0', '0', '0');
INSERT INTO `admin` VALUES ('10', '邓老师', '33deccb2f887d875db03e3a960d2f74d', '0ddcca4f21f3d9352014befcf3f54fa0', '2', '1', '13547475858', '123456@qq.com', '1564907720', '1564907720');
INSERT INTO `admin` VALUES ('11', '邓老师', 'dd58382480a2fd1a5f05499999d72076', '764f23682e4d38c97c53e87b84505f2b', '2', '1', '13547475858', '123456@qq.com', '1564907950', '1564907950');
INSERT INTO `admin` VALUES ('12', 'admin', '21f7e46593a427353400a52ae9c72a5b', 'dea969f6f4a114b01f824b3f0058702d', '1', '1', '13566669999', '123456@qq.com', '1564924438', '1564924438');

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `c_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '房屋配置表',
  `c_bed` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否有床      （0：没有  ，  1：有）',
  `c_table` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否有桌椅     （0：没有   ，  1：有）',
  `c_wardrobe` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否有衣柜    （0：没有     ，1：有）',
  `c_sofa` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否有沙发   （0：没有  ，  1：有）',
  `c_internet` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否有宽带    （0：没有  ，  1：有）',
  `c_tv` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否有电视   （0：没有  ，  1：有）',
  `c _air` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否有空调    （0：没有  ，  1：有）',
  `c_wash` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否有洗衣机     （0：没有    ，  1：有）',
  `c_ice` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否有冰箱    （0：没有  ，   1：有）',
  `c_hotwater` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否有热水器     （0：没有   ，1：有）',
  `c_gas` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否有燃气灶    （0：没有 ，1：没有）',
  `c_smoke` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否有抽烟机     （0：没有  ，1：有）',
  `c_furnace` enum('0','1') NOT NULL DEFAULT '1' COMMENT '是否有电磁炉    （0：没有   ，   1：有）',
  `c_wave` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否有微波炉    （0：没有   ，    1：有）',
  `c_toilet` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否有独立卫生间      （0：没有  ，  2：有）',
  `c_sun` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否有阳台   （0：没有  ，   1：有）',
  `c_cook` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否可以做饭    （0：不可以   ，   1：可以）',
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='22223333';

-- ----------------------------
-- Records of config
-- ----------------------------

-- ----------------------------
-- Table structure for house
-- ----------------------------
DROP TABLE IF EXISTS `house`;
CREATE TABLE `house` (
  `h_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '出租房源发布表',
  `uh_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户与出租房屋关联字段',
  `uh_to_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '受委托方的编号',
  `h_to` varchar(255) DEFAULT NULL,
  `h_state` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '（0：不限  ， 1：整租  ，  2：合租）',
  `h_rule` enum('0','1','2','3') NOT NULL DEFAULT '0' COMMENT '租金支付规则  （0：不限，1：压一付一，2：压一付三，3：半年付）',
  `h_space` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '房子的面积',
  `h_inmoney` json NOT NULL COMMENT '租金包含的费用',
  `h_money` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '房屋出租价格',
  `h_elevator` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '是否有电梯   （0：不限，1：有，2：没有）',
  `h_city` varchar(255) NOT NULL DEFAULT '' COMMENT '所在城市',
  `h_province` varchar(255) NOT NULL DEFAULT '' COMMENT '所在省份',
  `h_area` varchar(255) NOT NULL DEFAULT '' COMMENT '所在（区、县）',
  `h_town` varchar(255) NOT NULL DEFAULT '' COMMENT '所在（镇、乡）',
  `h_qv` varchar(255) NOT NULL DEFAULT '' COMMENT '所在小区名称',
  `h_addr` varchar(255) NOT NULL DEFAULT '' COMMENT '详细地址（**号楼**单元**号）',
  `h_ting` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '***厅',
  `h_shi` int(11) NOT NULL DEFAULT '0' COMMENT '***室',
  `h_wei` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '***卫生间',
  `h_xiang` varchar(255) NOT NULL DEFAULT '' COMMENT '朝向',
  `h_floor` varchar(225) NOT NULL DEFAULT '' COMMENT '楼层',
  `h_in` varchar(255) NOT NULL DEFAULT '' COMMENT '入住时间',
  `h_many` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '宜住人数',
  `h_look` varchar(255) NOT NULL DEFAULT '' COMMENT '看房时间',
  `h_content` varchar(255) NOT NULL DEFAULT '' COMMENT '（补充几句）补充文字',
  PRIMARY KEY (`h_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of house
-- ----------------------------

-- ----------------------------
-- Table structure for requirement
-- ----------------------------
DROP TABLE IF EXISTS `requirement`;
CREATE TABLE `requirement` (
  `r_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `r_sex` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '性别要求   （0：男女不限；1：男；2：女）',
  `r_pet` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否可以养宠物    （0：没要求，1：禁止）',
  `r_month` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否半年起租   （0：否，   1：是）',
  `r_year` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否一年起租   （0：不是 ，      1：是）',
  `r_stable` enum('0','1') NOT NULL DEFAULT '0' COMMENT '租户是否稳定   （0：没要求  ，  1：稳定）',
  `r_rest` enum('0','1') NOT NULL DEFAULT '0' COMMENT '作息是否正常    （0：没要求   ，   1：是）',
  `r_smoke` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否禁烟    （0：没要求  ， 1：禁烟）',
  PRIMARY KEY (`r_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='11111';

-- ----------------------------
-- Records of requirement
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `u_status` enum('0','1','2','3') NOT NULL DEFAULT '0' COMMENT '注册类型  （0：不限，1：业主，2：中介，3：房客）',
  `u_num` varchar(255) NOT NULL DEFAULT '0' COMMENT '身份证号',
  `u_phone` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户联系电话',
  `u_img` varchar(255) NOT NULL DEFAULT '' COMMENT '营业执照',
  `u_sex` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '性别   （0：不限，1：男，2：女）',
  `u_listen` varchar(255) NOT NULL DEFAULT '' COMMENT '电话接听时段',
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='333333';

-- ----------------------------
-- Records of user
-- ----------------------------
