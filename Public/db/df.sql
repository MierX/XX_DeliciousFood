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

 Date: 18/12/2019 18:15:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `nickname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `login` int(255) NULL DEFAULT 0,
  `status` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'admin', 'Admin', '123456', 4, 1);

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
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, '13616019194', 'mier', '123456a', 1576222795, 1);
INSERT INTO `user` VALUES (2, '13616019195', 'Mier123', '123456A', 1576222897, 0);
INSERT INTO `user` VALUES (3, '13616016165', 'test', '123456a', 1576224755, 1);
INSERT INTO `user` VALUES (4, '13616019191', 'Mier', '123456a', 1576648140, 1);
INSERT INTO `user` VALUES (5, '13616019110', 'mier1', '123456a', 1576222795, 1);
INSERT INTO `user` VALUES (6, '13616019111', 'Mier1123', '123456A', 1576222897, 0);
INSERT INTO `user` VALUES (7, '13616016112', 'test1', '123456a', 1576224755, 1);
INSERT INTO `user` VALUES (8, '13616019113', 'Mier1', '123456a', 1576648140, 1);
INSERT INTO `user` VALUES (9, '13616019114', 'mier2', '123456a', 1576222795, 1);
INSERT INTO `user` VALUES (10, '13616019115', 'Mier1223', '123456A', 1576222897, 0);
INSERT INTO `user` VALUES (11, '13616016116', 'test2', '123456a', 1576224755, 1);
INSERT INTO `user` VALUES (12, '13616019117', 'Mier2', '123456a', 1576648140, 1);
INSERT INTO `user` VALUES (13, '13616019118', 'mier3', '123456a', 1576222795, 1);
INSERT INTO `user` VALUES (14, '13616019119', 'Mier1323', '123456A', 1576222897, 0);
INSERT INTO `user` VALUES (15, '13616016120', 'test3', '123456a', 1576224755, 1);
INSERT INTO `user` VALUES (16, '13616019121', 'Mier3', '123456a', 1576648140, 1);
INSERT INTO `user` VALUES (17, '13616019122', 'mier11', '123456a', 1576222795, 1);
INSERT INTO `user` VALUES (18, '13616019123', 'Mier11123', '123456A', 1576222897, 0);
INSERT INTO `user` VALUES (19, '13616016124', 'test11', '123456a', 1576224755, 1);
INSERT INTO `user` VALUES (20, '13616019125', 'Mier11', '123456a', 1576648140, 1);
INSERT INTO `user` VALUES (21, '13616019126', 'mier21', '123456a', 1576222795, 1);
INSERT INTO `user` VALUES (22, '13616019127', 'Mier11223', '123456A', 1576222897, 0);
INSERT INTO `user` VALUES (23, '13616016128', 'test21', '123456a', 1576224755, 1);
INSERT INTO `user` VALUES (24, '13616019129', 'Mier21', '123456a', 1576648140, 1);
INSERT INTO `user` VALUES (25, '13616019130', 'mier31', '123456a', 1576222795, 1);
INSERT INTO `user` VALUES (26, '13616019131', 'Mier11323', '123456A', 1576222897, 0);
INSERT INTO `user` VALUES (27, '13616016132', 'test31', '123456a', 1576224755, 1);
INSERT INTO `user` VALUES (28, '13616019133', 'Mier31', '123456a', 1576648140, 1);

SET FOREIGN_KEY_CHECKS = 1;
