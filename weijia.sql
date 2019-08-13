/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : weijia

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2019-08-13 10:14:27
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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', '2d6cf5bebe4917c2477bd8808aa0d27c', '687e11c7269d64bf358461f3b502150d', '1', '1', '13547475858', '123456@qq.com', '1565575150', '1565575150');
INSERT INTO `admin` VALUES ('2', 'xinyi', '6ed6ba6d57f789b624f2666b93da8fbf', '2ba27849bc76ac7475b15d06324ae9a5', '2', '1', '14859685958', '123456@qq.com', '1565575176', '1565575176');
INSERT INTO `admin` VALUES ('3', 'youwei', 'f6a7104a66c118f98c2849d4bf750164', 'ecdcead9a8df6c81f52a0557a16e0a6e', '3', '1', '13566669999', '123456@qq.com', '1565575205', '1565575205');

-- ----------------------------
-- Table structure for coupon
-- ----------------------------
DROP TABLE IF EXISTS `coupon`;
CREATE TABLE `coupon` (
  `c_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `c_status` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '福利券使用状态（0：不限，1：未用，2：已用）',
  `c_level` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '福利券种类（0：不限，1：租房福利劵，2：费租房福利券）',
  `c_ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '福利券创建时间',
  `c_state` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '福利券赠送状态（0：不限，1：未赠送，2：已赠送）',
  `c_money` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '额度',
  `cu_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '福利券持有者',
  `c_stime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '转赠福利券时的转赠时间',
  `cu_sid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '接收赠送福利券的用户编号',
  `cu_name` varchar(255) NOT NULL DEFAULT '0' COMMENT '创建者的姓名',
  `cu_sname` varchar(255) NOT NULL DEFAULT '0' COMMENT '福利券持有者姓名',
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of coupon
-- ----------------------------
-- ----------------------------
-- Table structure for house
-- ----------------------------
DROP TABLE IF EXISTS `house`;
CREATE TABLE `house` (
  `h_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '出租房源发布表',
  `hu_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发布用户的ID',
  `hu_name` varchar(255) NOT NULL DEFAULT '0' COMMENT '房源发布人昵称',
  `hu_phone` varchar(255) NOT NULL DEFAULT '0' COMMENT '发布房源者的联系电话',
  `h_state` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '（0：不限  ， 1：整租  ，  2：合租）',
  `h_level` enum('0','1','2','-1') NOT NULL DEFAULT '1' COMMENT '房源出租状态（0：不限，1：出租中，2：下架，-1：成交）',
  `h_status` enum('0','1','2','-1') NOT NULL DEFAULT '1' COMMENT '房源展示位置（0：不限，1：快租房，2：青年公寓）',
  `h_rule` enum('0','1','2','3') NOT NULL DEFAULT '0' COMMENT '租金支付规则  （0：不限，1：压一付一，2：压一付三，3：半年付）',
  `h_space` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '房子的面积',
  `h_inmoney` json NOT NULL COMMENT '租金包含的费用',
  `h_money` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '房屋出租价格',
  `h_elevator` enum('0','1','-1') NOT NULL DEFAULT '0' COMMENT '是否有电梯   （0：不限，1：有，-1：没有）',
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
  `h_listen` varchar(255) NOT NULL DEFAULT '0' COMMENT '接听电话时间',
  `h_content` varchar(255) NOT NULL DEFAULT '' COMMENT '（补充几句）补充文字',
  `h_config` json NOT NULL COMMENT '房屋配置',
  `h_ask` json NOT NULL COMMENT '房源要求',
  `h_lock` varchar(255) NOT NULL DEFAULT '0' COMMENT '房源密码锁--密码',
  `h_ctime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  `h_etime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '下架或租出时间',
  `h_uploads` json NOT NULL COMMENT '房源的介绍图片（多张）',
  `h_img` varchar(255) NOT NULL DEFAULT '0' COMMENT '推广主图（介绍图片的第一张）',
  `h_hname` varchar(255) NOT NULL DEFAULT '0' COMMENT '产权人的名字',
  `h_hnum` varchar(225) NOT NULL DEFAULT '0' COMMENT '房产证编号',
  PRIMARY KEY (`h_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of house
-- ----------------------------
-- ----------------------------
-- Table structure for meet
-- ----------------------------
DROP TABLE IF EXISTS `meet`;
CREATE TABLE `meet` (
  `m_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mu_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发起预约者的编号',
  `mh_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '预约房源的编号',
  `m_ctime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '预约发起时间',
  `m_level` enum('0','1','2','-1') NOT NULL DEFAULT '0' COMMENT '预约申请状态（0：不限，1：申请中，2：同意，-1：拒绝）',
  `mu_name` varchar(255) NOT NULL DEFAULT '0' COMMENT '预约者的名称',
  `mu_phone` varchar(255) NOT NULL DEFAULT '0' COMMENT '预约者的手机号',
  `mh_name` varchar(255) NOT NULL DEFAULT '0' COMMENT '预约房源负责人的名称',
  `mh_phone` varchar(255) NOT NULL DEFAULT '0' COMMENT '预约房源的联系电话',
  `mh_addr` varchar(255) NOT NULL DEFAULT '0' COMMENT '预约房源的地址',
  `m_etime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '房客预约申请的回复时间',
  `m_because` varchar(255) NOT NULL DEFAULT '0' COMMENT '预约拒绝原因',
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of meet
-- ----------------------------
-- ----------------------------
-- Table structure for record
-- ----------------------------
DROP TABLE IF EXISTS `record`;
CREATE TABLE `record` (
  `r_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `r_name` varchar(255) NOT NULL DEFAULT '0' COMMENT '公司名称',
  `r_www` varchar(255) NOT NULL DEFAULT '0' COMMENT '网站名称',
  `r_server` varchar(255) NOT NULL DEFAULT '0' COMMENT '客服电话',
  `r_title` varchar(255) NOT NULL DEFAULT '0' COMMENT '标题',
  `r_weima` varchar(255) NOT NULL DEFAULT '0' COMMENT '微信二维码',
  `r_zhima` varchar(255) NOT NULL DEFAULT '0' COMMENT '支付宝二维码',
  `r_logo` varchar(255) NOT NULL DEFAULT '0' COMMENT '公司logo',
  `r_coupon0` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '租房代金券金额',
  `r_coupon1` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '非租房代金券金额',
  `r_first` varchar(255) NOT NULL DEFAULT '0' COMMENT '一级分销的提成',
  `r_second` varchar(255) NOT NULL DEFAULT '0' COMMENT '二级分销的提成',
  `r_keywords` varchar(255) NOT NULL DEFAULT '0' COMMENT '网站关键字',
  `r_description` varchar(255) NOT NULL DEFAULT '0' COMMENT '网站描述',
  `r_icp` varchar(255) NOT NULL DEFAULT '0' COMMENT '网站备案号',
  `r_addr` varchar(255) NOT NULL DEFAULT '0' COMMENT '公司地址',
  PRIMARY KEY (`r_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of record
-- ----------------------------
INSERT INTO `record` VALUES ('1', '1', '2', '3', '4', 'company\\20190809\\d1f73977ebe552f35a72d008abd4fe2d.jpg', 'company\\20190809\\b0760006a7e57050c60c268e2493ef65.jpg', 'company\\20190809\\78c7db24d03386c547681b8a687af0b8.jpg', '5', '6', '7', '8', '9', '10', '11', '12');

-- ----------------------------
-- Table structure for shenqing
-- ----------------------------
DROP TABLE IF EXISTS `shenqing`;
CREATE TABLE `shenqing` (
  `s_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `su_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '申请用户的编号',
  `s_status` enum('0','1','2','-1') NOT NULL DEFAULT '1' COMMENT '申请状态（0：不限，1：申请中，2：通过，-1：拒绝）',
  `s_level` enum('0','1','2','3','4','5') NOT NULL DEFAULT '0' COMMENT '申请类型（0：不限，1：职业房东，2职业经纪人，3：房源转到青年公寓，4：房产认证，5：实名认证（租客发布房源））',
  `s_name` varchar(255) NOT NULL DEFAULT '0' COMMENT '真是姓名',
  `s_num` varchar(255) NOT NULL DEFAULT '0' COMMENT '身份证号',
  `s_img` varchar(255) NOT NULL DEFAULT '0' COMMENT '证件照',
  `s_refuse` varchar(255) NOT NULL DEFAULT '0' COMMENT '拒绝原因',
  `s_ctime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '申请发起时间',
  `s_money` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '押金（申请职业房东/经纪人--必填）',
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shenqing
-- ----------------------------
-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `u_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `u_one` enum('0','1','-1') NOT NULL DEFAULT '1' COMMENT '租客（0：不限，1：是，-1：不是）',
  `u_two` enum('0','1','-1') NOT NULL DEFAULT '-1' COMMENT '房东（0：不限，1：是，-1：不是）',
  `u_three` enum('0','1','-1') NOT NULL DEFAULT '-1' COMMENT '职业房东（0：不限，1：是，-1：不是）',
  `u_four` enum('0','1','-1') NOT NULL DEFAULT '-1' COMMENT '职业经纪人（0：不限，1：是，-1：不是）',
  `u_name` varchar(255) NOT NULL DEFAULT '0' COMMENT '用户名称',
  `u_level` enum('0','1','-1') NOT NULL DEFAULT '1' COMMENT '0：不限，1：正常，-1：删除',
  `u_num` varchar(255) NOT NULL DEFAULT '0' COMMENT '身份证号',
  `u_num0` varchar(255) NOT NULL DEFAULT '0' COMMENT '身份证号正面照',
  `u_num1` varchar(255) DEFAULT '0' COMMENT '身份证反面照',
  `u_phone` varchar(11) NOT NULL DEFAULT '0' COMMENT '用户联系电话',
  `u_img` varchar(255) NOT NULL DEFAULT '' COMMENT '营业执照',
  `u_sex` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '性别   （0：不限，1：男，2：女）',
  `u_listen` varchar(255) NOT NULL DEFAULT '' COMMENT '电话接听时段',
  `u_money` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '押金',
  `u_ctime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户创建时间',
  `u_ma` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '邀请码（邀请别人）',
  `u_mato` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '邀请码（被邀请）',
  `u_tname` varchar(255) NOT NULL DEFAULT '0' COMMENT '真实姓名',
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='333333';

-- ----------------------------
-- Records of user
-- ----------------------------