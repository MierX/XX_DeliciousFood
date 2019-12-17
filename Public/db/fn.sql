/*
 Navicat MySQL Data Transfer

 Source Server         : me
 Source Server Type    : MySQL
 Source Server Version : 80012
 Source Host           : localhost:3306
 Source Schema         : fn

 Target Server Type    : MySQL
 Target Server Version : 80012
 File Encoding         : 65001

 Date: 14/12/2019 16:27:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for accept
-- ----------------------------
DROP TABLE IF EXISTS `accept`;
CREATE TABLE `accept`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NULL DEFAULT 0,
  `nid` int(11) NULL DEFAULT 0,
  `needs` int(11) NULL DEFAULT 0,
  `score` int(11) NULL DEFAULT 0,
  `ntou` int(1) NULL DEFAULT 0,
  `addtime` int(11) NULL DEFAULT 0,
  `endtime` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of accept
-- ----------------------------
INSERT INTO `accept` VALUES (2, 2, 1, 6, 0, 0, 1575191383, 0);
INSERT INTO `accept` VALUES (3, 2, 2, 9, 0, 0, 1575283502, 0);
INSERT INTO `accept` VALUES (4, 1, 2, 5, 3, 1, 1576304458, 1576304857);

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `account` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'admin', '管理员', 'admin', '123456');

-- ----------------------------
-- Table structure for apply
-- ----------------------------
DROP TABLE IF EXISTS `apply`;
CREATE TABLE `apply`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `needs` int(11) NOT NULL DEFAULT 0,
  `nurse` int(11) NOT NULL DEFAULT 0,
  `addtime` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for chat
-- ----------------------------
DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT 0,
  `nid` int(11) NOT NULL DEFAULT 0,
  `author` int(11) NOT NULL DEFAULT 0,
  `role` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `addtime` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 41 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of chat
-- ----------------------------
INSERT INTO `chat` VALUES (1, 2, 1, 2, 'User', '<p>123<br/></p>', 1574790963);
INSERT INTO `chat` VALUES (2, 2, 1, 2, 'User', '<p>123123<br/></p>', 1574790978);
INSERT INTO `chat` VALUES (3, 2, 1, 2, 'User', '<p>123123<br/></p>', 1574790991);
INSERT INTO `chat` VALUES (4, 2, 1, 2, 'User', '<p>123123<br/></p>', 1574790998);
INSERT INTO `chat` VALUES (5, 2, 1, 2, 'User', '<p>123123123<br/></p>', 1574791004);
INSERT INTO `chat` VALUES (6, 2, 1, 2, 'User', '<p>1231<br/></p>', 1574791011);
INSERT INTO `chat` VALUES (7, 2, 1, 2, 'User', '<p>1231asd<br/></p>', 1574791023);
INSERT INTO `chat` VALUES (8, 2, 1, 2, 'User', '<p>阿瑟东<br/>阿瑟东<br/>阿德亲吻请问</p>', 1574791076);
INSERT INTO `chat` VALUES (9, 2, 1, 2, 'User', '<p>wqeqw<br/></p>', 1574822966);
INSERT INTO `chat` VALUES (10, 2, 1, 2, 'User', '<p>1231531651516<br/></p>', 1574823056);
INSERT INTO `chat` VALUES (11, 2, 1, 2, 'User', '<p>1231531651516456<br/></p>', 1574823067);
INSERT INTO `chat` VALUES (12, 2, 1, 2, 'User', '<p>123<br/></p>', 1574825320);
INSERT INTO `chat` VALUES (13, 2, 1, 1, 'Nurse', '<p>123<br/></p>', 1574822966);
INSERT INTO `chat` VALUES (14, 2, 1, 2, 'User', '<p>123213<br/></p>', 1574835842);
INSERT INTO `chat` VALUES (15, 2, 1, 2, 'User', '<p>阿三大苏打<br/></p>', 1574840702);
INSERT INTO `chat` VALUES (16, 2, 1, 2, 'User', '<p>阿三大苏打<br/></p>', 1574840706);
INSERT INTO `chat` VALUES (17, 2, 1, 2, 'User', '<p>阿三大苏打<br/></p>', 1574840709);
INSERT INTO `chat` VALUES (18, 2, 1, 2, 'User', '<p>阿三大苏打<br/></p>', 1574840711);
INSERT INTO `chat` VALUES (19, 2, 1, 2, 'User', '<p>阿大撒<br/></p>', 1574840827);
INSERT INTO `chat` VALUES (20, 2, 1, 2, 'User', '<p>阿萨大<br/></p>', 1574841030);
INSERT INTO `chat` VALUES (21, 2, 1, 2, 'User', '<p>阿萨大<br/></p>', 1574841162);
INSERT INTO `chat` VALUES (22, 2, 1, 2, 'User', '<p>阿萨大123<br/></p>', 1574841182);
INSERT INTO `chat` VALUES (23, 2, 1, 2, 'User', '<p>单哈哈<br/></p>', 1574841195);
INSERT INTO `chat` VALUES (24, 2, 1, 2, 'User', '<p>123奥错</p>', 1574841206);
INSERT INTO `chat` VALUES (25, 2, 1, 1, 'Nurse', '<p>asd&nbsp;<br/></p>', 1574843115);
INSERT INTO `chat` VALUES (26, 2, 1, 1, 'Nurse', '<p>asdsadasd</p>', 1574843121);
INSERT INTO `chat` VALUES (27, 2, 1, 1, 'Nurse', '<p>123阿萨大</p>', 1574843127);
INSERT INTO `chat` VALUES (28, 2, 1, 2, 'User', '<p>阿萨大<br/></p>', 1574843163);
INSERT INTO `chat` VALUES (29, 2, 1, 1, 'Nurse', '<p>阿三大苏打</p>', 1574843166);
INSERT INTO `chat` VALUES (30, 2, 1, 2, 'User', '<p>阿三大苏打</p>', 1574843180);
INSERT INTO `chat` VALUES (31, 2, 1, 2, 'User', '<p>阿斯顿萨达</p>', 1574843189);
INSERT INTO `chat` VALUES (32, 2, 1, 1, 'Nurse', '<p>萨达萨达<br/></p>', 1574843193);
INSERT INTO `chat` VALUES (33, 2, 1, 1, 'Nurse', '<p>你是煞笔</p>', 1574843225);
INSERT INTO `chat` VALUES (34, 2, 1, 2, 'User', '<p>你才是</p>', 1574843231);
INSERT INTO `chat` VALUES (35, 2, 1, 2, 'User', '<p>你才是</p>', 1574843242);
INSERT INTO `chat` VALUES (36, 2, 2, 2, 'User', '<p>asd<br/></p>', 1574850403);
INSERT INTO `chat` VALUES (37, 2, 1, 2, 'User', '<p>哈咯哈咯<br/></p>', 1575107826);
INSERT INTO `chat` VALUES (38, 2, 2, 2, 'User', '<p>恩呐呐呐<br/></p>', 1575169082);
INSERT INTO `chat` VALUES (39, 2, 2, 2, 'Nurse', '<p>123123<br/></p>', 1575169584);
INSERT INTO `chat` VALUES (40, 2, 2, 2, 'Nurse', '<p>adsdasd<br/></p>', 1575169827);
INSERT INTO `chat` VALUES (41, 1, 2, 2, 'Nurse', '<p>213123<br/></p>', 1576304397);
INSERT INTO `chat` VALUES (42, 1, 2, 1, 'User', '<p>123213213213<br/></p>', 1576304435);

-- ----------------------------
-- Table structure for needs
-- ----------------------------
DROP TABLE IF EXISTS `needs`;
CREATE TABLE `needs`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT 0,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `disease` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `reward` int(10) NOT NULL DEFAULT 0,
  `worktime` int(10) NOT NULL DEFAULT 0,
  `needs` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `addtime` int(10) NOT NULL DEFAULT 0,
  `endtime` int(10) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1未开始，2已开始，3已结束，4已失效',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of needs
-- ----------------------------
INSERT INTO `needs` VALUES (1, 1, '【重病求医！】帮我买个板蓝根！', '感冒', 20, 5, '<p>帮我买盒板蓝根！</p><p><img src=\"/ueditor/php/upload/image/20191111/1573457078877817.jpg\" title=\"1573457078877817.jpg\" alt=\"chan.jpg\"/></p>', 1576303500, 1576908300, 1);
INSERT INTO `needs` VALUES (2, 1, '【重病求医！】帮我买个板蓝根！', '感冒', 20, 5, '<p>帮我买盒板蓝根！</p><p><img src=\"/ueditor/php/upload/image/20191111/1573457078877817.jpg\" title=\"1573457078877817.jpg\" alt=\"chan.jpg\"/></p>', 1576303507, 1576908307, 1);
INSERT INTO `needs` VALUES (3, 1, '【重病求医！】帮我买个板蓝根！', '感冒', 20, 5, '<p>帮我买盒板蓝根！</p><p><img src=\"/ueditor/php/upload/image/20191111/1573457078877817.jpg\" title=\"1573457078877817.jpg\" alt=\"chan.jpg\"/></p>', 1576303512, 1576908312, 1);
INSERT INTO `needs` VALUES (4, 1, '【重病求医！】帮我买个板蓝根！', '感冒', 20, 5, '<p>帮我买盒板蓝根！</p><p><img src=\"/ueditor/php/upload/image/20191111/1573457078877817.jpg\" title=\"1573457078877817.jpg\" alt=\"chan.jpg\"/></p>', 1576303514, 1576908314, 1);
INSERT INTO `needs` VALUES (5, 1, '【重病求医！】帮我买个板蓝根！', '感冒', 20, 5, '<p>帮我买盒板蓝根！</p><p><img src=\"/ueditor/php/upload/image/20191111/1573457078877817.jpg\" title=\"1573457078877817.jpg\" alt=\"chan.jpg\"/></p>', 1576303701, 1576908501, 3);
INSERT INTO `needs` VALUES (6, 2, '【重病求医！】帮我买个板蓝根！', '感冒', 20, 5, '<p>帮我买盒板蓝根！</p><p><img src=\"/ueditor/php/upload/image/20191111/1573457078877817.jpg\" title=\"1573457078877817.jpg\" alt=\"chan.jpg\"/></p>', 1574681270, 1575286070, 2);
INSERT INTO `needs` VALUES (7, 2, '【重病求医！】帮我买个板蓝根！', '感冒', 20, 5, '<p>帮我买盒板蓝根！</p><p><img src=\"/ueditor/php/upload/image/20191111/1573457078877817.jpg\" title=\"1573457078877817.jpg\" alt=\"chan.jpg\"/></p>', 1576303577, 1576908377, 1);
INSERT INTO `needs` VALUES (8, 2, '【重病求医！】帮我买个板蓝根！', '感冒', 20, 5, '<p>帮我买盒板蓝根！</p><p><img src=\"/ueditor/php/upload/image/20191111/1573457078877817.jpg\" title=\"1573457078877817.jpg\" alt=\"chan.jpg\"/></p>', 1576303692, 1576908492, 1);
INSERT INTO `needs` VALUES (9, 2, '【重病求医！】帮我买个板蓝根！', '感冒', 20, 5, '<p>帮我买盒板蓝根！</p><p><img src=\"/ueditor/php/upload/image/20191111/1573457078877817.jpg\" title=\"1573457078877817.jpg\" alt=\"chan.jpg\"/></p>', 1576295061, 1576899861, 2);
INSERT INTO `needs` VALUES (10, 2, 'aaa！', '感冒', 20, 5, '<p>帮我买盒板蓝根！</p><p><img src=\"/ueditor/php/upload/image/20191111/1573457078877817.jpg\" title=\"1573457078877817.jpg\" alt=\"chan.jpg\"/>123213213213</p>', 1575542851, 1576147651, 2);
INSERT INTO `needs` VALUES (11, 2, '【重病求医！】帮我买个板蓝根！', '感冒', 20, 5, '<p>帮我买盒板蓝根！</p><p><img src=\"/ueditor/php/upload/image/20191111/1573457078877817.jpg\" title=\"1573457078877817.jpg\" alt=\"chan.jpg\"/></p>', 1575542151, 1576146951, 2);
INSERT INTO `needs` VALUES (12, 3, 'wo shi xin lai de ', 'wuliao', 12, 1, '<p>超级无聊boring</p>', 1576295061, 1576899861, 1);
INSERT INTO `needs` VALUES (13, 2, 'test', 'wuliao', 24, 24, '<p>23232321231344</p>', 1576295061, 1576899861, 1);
INSERT INTO `needs` VALUES (14, 2, 'test1', 'test1', 112, 1232, '<p>2222222222222222222222222222222</p><p>test1<img src=\"/ueditor/php/upload/image/20191125/1574669382117603.jpg\" title=\"1574669382117603.jpg\" alt=\"07datun.jpg\"/></p><p>test12222222</p><p><br/></p>', 1576295061, 1576899861, 1);
INSERT INTO `needs` VALUES (15, 2, '123', '3213', 12, 123, '<p>123213adsadadasdaasd</p><p>asdasdad</p>', 1576295061, 1576899861, 1);
INSERT INTO `needs` VALUES (16, 2, '123', '12', 123, 123, '<p>123213213</p>', 1576295061, 1576899861, 1);
INSERT INTO `needs` VALUES (17, 2, '萨达', '阿萨大', 123, 0, '<p>萨达</p>', 1576295061, 1576899861, 1);
INSERT INTO `needs` VALUES (18, 2, 'test1', 'wuliao', 123, 123, '<p>asdasd<br/></p><p>asdsad</p><p>asdsad</p><p><br/></p><p>asdsadasd</p><p><br/></p><p>asdasdasd</p><p>asdsadasd</p>', 1576295061, 1576899861, 1);

-- ----------------------------
-- Table structure for notice
-- ----------------------------
DROP TABLE IF EXISTS `notice`;
CREATE TABLE `notice`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `hot` int(11) NOT NULL DEFAULT 1,
  `author` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `addtime` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of notice
-- ----------------------------
INSERT INTO `notice` VALUES (1, 'test1', 6, '管理员', '<p>test1</p><p><span style=\"font-size: 20px;\">test1</span></p><p><span style=\"font-size: 24px;\">test1</span></p><p><span style=\"font-size: 24px;\"><img src=\"/ueditor/php/upload/image/20191107/1573107649761427.gif\" title=\"1573107649761427.gif\" alt=\"ball.gif\"/></span></p>', 1, 1522101156);
INSERT INTO `notice` VALUES (2, 'test2', 6, '管理员', '<p>test22222222</p>', 1, 1573056000);
INSERT INTO `notice` VALUES (3, 'test3', 49, '管理员', '<p>请新编辑内容</p>', 1, 1573117385);
INSERT INTO `notice` VALUES (4, 'test1', 11, '管理员', '<p>test1</p><p><span style=\"font-size: 20px;\">test1</span></p><p><span style=\"font-size: 24px;\">test1</span></p><p><span style=\"font-size: 24px;\"><img src=\"/ueditor/php/upload/image/20191107/1573107649761427.gif\" title=\"1573107649761427.gif\" alt=\"ball.gif\"/></span></p>', 1, 1522101156);
INSERT INTO `notice` VALUES (5, 'test1', 7, '管理员', '<p>test1</p><p><span style=\"font-size: 20px;\">test1</span></p><p><span style=\"font-size: 24px;\">test1</span></p><p><span style=\"font-size: 24px;\"><img src=\"/ueditor/php/upload/image/20191107/1573107649761427.gif\" title=\"1573107649761427.gif\" alt=\"ball.gif\"/></span></p>', 1, 1522101156);
INSERT INTO `notice` VALUES (6, 'test1', 1, '管理员', '<p>test1</p><p><span style=\"font-size: 20px;\">test1</span></p><p><span style=\"font-size: 24px;\">test1</span></p><p><span style=\"font-size: 24px;\"><img src=\"/ueditor/php/upload/image/20191107/1573107649761427.gif\" title=\"1573107649761427.gif\" alt=\"ball.gif\"/></span></p>', 1, 1522101156);
INSERT INTO `notice` VALUES (7, 'test1', 1, '管理员', '<p>test1</p><p><span style=\"font-size: 20px;\">test1</span></p><p><span style=\"font-size: 24px;\">test1</span></p><p><span style=\"font-size: 24px;\"><img src=\"/ueditor/php/upload/image/20191107/1573107649761427.gif\" title=\"1573107649761427.gif\" alt=\"ball.gif\"/></span></p>', 1, 1522101156);
INSERT INTO `notice` VALUES (8, 'test1', 1, '管理员', '<p>test1</p><p><span style=\"font-size: 20px;\">test1</span></p><p><span style=\"font-size: 24px;\">test1</span></p><p><span style=\"font-size: 24px;\"><img src=\"/ueditor/php/upload/image/20191107/1573107649761427.gif\" title=\"1573107649761427.gif\" alt=\"ball.gif\"/></span></p>', 1, 1522101156);
INSERT INTO `notice` VALUES (9, 'test1', 2, '管理员', '<p>test1</p><p><span style=\"font-size: 20px;\">test1</span></p><p><span style=\"font-size: 24px;\">test1</span></p><p><span style=\"font-size: 24px;\"><img src=\"/ueditor/php/upload/image/20191107/1573107649761427.gif\" title=\"1573107649761427.gif\" alt=\"ball.gif\"/></span></p>', 1, 1522101156);
INSERT INTO `notice` VALUES (10, 'test1', 5, '管理员', '<p>test1</p><p><span style=\"font-size: 20px;\">test1</span></p><p><span style=\"font-size: 24px;\">test1</span></p><p><span style=\"font-size: 24px;\"><img src=\"/ueditor/php/upload/image/20191107/1573107649761427.gif\" title=\"1573107649761427.gif\" alt=\"ball.gif\"/></span></p>', 1, 1522101156);
INSERT INTO `notice` VALUES (11, 'test11', 2, '管理员', '<p>test1</p><p><span style=\"font-size: 20px;\">test1</span></p><p><span style=\"font-size: 24px;\">test1</span></p><p><span style=\"font-size: 24px;\"><img src=\"/ueditor/php/upload/image/20191107/1573107649761427.gif\" title=\"1573107649761427.gif\" alt=\"ball.gif\"/></span></p>', 1, 1522101156);

-- ----------------------------
-- Table structure for nurse
-- ----------------------------
DROP TABLE IF EXISTS `nurse`;
CREATE TABLE `nurse`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(23) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `account` varchar(23) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(23) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(23) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `age` int(3) NOT NULL,
  `phone` bigint(11) NOT NULL,
  `card` bigint(18) NOT NULL,
  `work-year` varchar(23) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `work-add` varchar(23) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `work-expertise` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `merits` bigint(128) NOT NULL DEFAULT 0,
  `remark` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `addtime` int(10) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of nurse
-- ----------------------------
INSERT INTO `nurse` VALUES (1, 'Nurse', 'test001', '123456', 'test1', 1, 18, 12312312300, 12345678900987654, '2', 'qwadasd', '感冒', 0, '<p>我我我我我我我我我</p>', 1, 1572687086);
INSERT INTO `nurse` VALUES (2, 'Nurse', 'test002', '123456', 'test2', 2, 41, 12312312301, 123123123123123123, '15', '123213', '无', 1, '<p>你好你好</p><p><img src=\"/ueditor/php/upload/image/20191214/1576308949742637.jpg\" title=\"1576308949742637.jpg\" alt=\"04dinghuisi.jpg\"/></p><p>在这里</p><p><img src=\"/ueditor/php/upload/image/20191214/1576308956334124.jpg\" title=\"1576308956334124.jpg\" alt=\"022_avatar_big.jpg\"/></p><p><br/></p>', 1, 1572687086);
INSERT INTO `nurse` VALUES (3, 'Nurse', 'test003', '123456', 'test3', 1, 41, 12312312302, 123123123123123124, '10', '123213', '感冒', 0, 'testtest', 1, 1572687086);
INSERT INTO `nurse` VALUES (4, 'Nurse', 'test004', '123456', 'test4', 2, 41, 12312312303, 123123123123123125, '10', '123213', '感冒', 0, 'testtest', 1, 1572687086);
INSERT INTO `nurse` VALUES (5, 'Nurse', 'test005', '123456', 'test5', 1, 41, 12312312304, 123123123123123126, '10', '123213', '感冒', 0, 'testtest', 1, 1572687086);
INSERT INTO `nurse` VALUES (6, 'Nurse', 'test006', '123456', 'test6', 2, 41, 12312312305, 123123123123123127, '10', '123213', '感冒', 0, 'testtest', 1, 1572687086);
INSERT INTO `nurse` VALUES (7, 'Nurse', 'test007', '123456', 'test7', 1, 41, 12312312306, 123123123123123128, '10', '123213', '感冒', 0, 'testtest', 1, 1572687086);
INSERT INTO `nurse` VALUES (8, 'Nurse', 'test008', '123456', 'test8', 2, 41, 12312312307, 123123123123123129, '10', '123213', '感冒', 0, 'testtest', 1, 1572687086);
INSERT INTO `nurse` VALUES (9, 'Nurse', 'test009', '123456', 'test9', 1, 41, 12312312308, 1231231231231231210, '10', '123213', '感冒', 0, 'testtest', 1, 1572687086);
INSERT INTO `nurse` VALUES (10, 'Nurse', 'test010', '123456', 'test10', 2, 41, 12312312309, 1231231231231231211, '10', '123213', '感冒', 0, 'testtest', 1, 1572687086);
INSERT INTO `nurse` VALUES (11, 'Nurse', 'test011', '123456', 'test11', 1, 41, 12312312310, 1231231231231231212, '10', '123213', '感冒', 0, 'testtest', 1, 1572687086);

-- ----------------------------
-- Table structure for nurse_collection
-- ----------------------------
DROP TABLE IF EXISTS `nurse_collection`;
CREATE TABLE `nurse_collection`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) NOT NULL DEFAULT 0,
  `ids` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of nurse_collection
-- ----------------------------
INSERT INTO `nurse_collection` VALUES (8, 2, '{\"1\":8,\"2\":7,\"4\":12,\"5\":1,\"6\":2,\"7\":6,\"8\":15,\"9\":18,\"10\":5}');
INSERT INTO `nurse_collection` VALUES (9, 1, '[6]');

-- ----------------------------
-- Table structure for nurse_needs
-- ----------------------------
DROP TABLE IF EXISTS `nurse_needs`;
CREATE TABLE `nurse_needs`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) NOT NULL DEFAULT 0,
  `nurse` int(11) NOT NULL DEFAULT 0,
  `addtime` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of nurse_needs
-- ----------------------------
INSERT INTO `nurse_needs` VALUES (1, 1, 2, 1575281220);
INSERT INTO `nurse_needs` VALUES (2, 2, 2, 1575281220);

-- ----------------------------
-- Table structure for record
-- ----------------------------
DROP TABLE IF EXISTS `record`;
CREATE TABLE `record`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `needs` int(11) NULL DEFAULT 0,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `addtime` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of record
-- ----------------------------
INSERT INTO `record` VALUES (1, 9, '阿斯顿萨达', 1576304057);
INSERT INTO `record` VALUES (2, 9, '阿斯顿萨达萨达撒旦撒旦', 1576304063);
INSERT INTO `record` VALUES (3, 5, '123213', 1576304508);
INSERT INTO `record` VALUES (4, 5, 'asdasd', 1576304512);
INSERT INTO `record` VALUES (5, 5, 'asdsad1231', 1576304515);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(23) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `account` varchar(23) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(23) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(23) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `age` int(3) NOT NULL,
  `phone` bigint(11) NOT NULL,
  `card` bigint(18) NOT NULL,
  `score` int(255) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1,
  `addtime` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'User', 'test001', '123456', 'test1', 1, 18, 12312312300, 350652201305061855, 8, 1, 1572687034);
INSERT INTO `user` VALUES (2, 'User', 'test002', '123456', 'test2', 1, 27, 12312312301, 123123123123123123, 0, 1, 1572687034);
INSERT INTO `user` VALUES (3, 'User', 'test003', '123456', 'test3', 1, 32, 12312312302, 123123123123123132, 0, 1, 1573612148);
INSERT INTO `user` VALUES (4, 'User', 'test005', '123456', '张小花', 2, 18, 13211011213, 350652201305061854, 0, 1, 1575541867);

-- ----------------------------
-- Table structure for user_collection
-- ----------------------------
DROP TABLE IF EXISTS `user_collection`;
CREATE TABLE `user_collection`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `ids` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_collection
-- ----------------------------
INSERT INTO `user_collection` VALUES (1, 2, '{\"2\":3,\"3\":6,\"4\":8,\"5\":1,\"6\":2}');

SET FOREIGN_KEY_CHECKS = 1;
