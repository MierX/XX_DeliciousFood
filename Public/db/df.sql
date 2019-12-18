/*
 Navicat MySQL Data Transfer

 Source Server         : me
 Source Server Type    : MySQL
 Source Server Version : 80012
 Source Host           : localhost:3306
 Source Schema         : df

 Target Server Type    : MySQL
 Target Server Version : 80012
 File Encoding         : 65001

 Date: 18/12/2019 13:50:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `nickname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `addtime` int(11) NULL DEFAULT 0,
  `status` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, '13616019194', 'mier', '123456a', 1576222795, 1);
INSERT INTO `user` VALUES (2, '13616019195', 'Mier123', '123456A', 1576222897, 1);
INSERT INTO `user` VALUES (3, '13616016165', 'test', '123456a', 1576224755, 1);
INSERT INTO `user` VALUES (4, '13616019191', 'Mier', '123456a', 1576648140, 1);

SET FOREIGN_KEY_CHECKS = 1;
