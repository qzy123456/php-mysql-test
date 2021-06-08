/*
 Navicat Premium Data Transfer

 Source Server         : 192.168.16.51
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : 192.168.16.51:3306
 Source Schema         : TeachingDB

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 02/06/2021 10:11:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_course
-- ----------------------------
DROP TABLE IF EXISTS `t_course`;
CREATE TABLE `t_course` (
  `C#` varchar(255) NOT NULL,
  `Cname` varchar(255) NOT NULL,
  `T#` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`C#`),
  KEY `T#` (`T#`),
  CONSTRAINT `t_course_ibfk_1` FOREIGN KEY (`T#`) REFERENCES `t_teacher` (`T#`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_course
-- ----------------------------
BEGIN;
INSERT INTO `t_course` VALUES ('c001', '数据库', 't001');
INSERT INTO `t_course` VALUES ('c002', '英语', 't003');
INSERT INTO `t_course` VALUES ('c003', '软件测试', 't001');
INSERT INTO `t_course` VALUES ('c004', '数据结构', 't005');
INSERT INTO `t_course` VALUES ('c005', '微机原理', 't004');
INSERT INTO `t_course` VALUES ('c006', '网站开发', 't007');
INSERT INTO `t_course` VALUES ('c007', '操作系统', 't009');
INSERT INTO `t_course` VALUES ('c008', '计算机基础', 't004');
INSERT INTO `t_course` VALUES ('c009', 'Java程序设计', NULL);
INSERT INTO `t_course` VALUES ('c010', '工程数学', NULL);
COMMIT;

-- ----------------------------
-- Table structure for t_student
-- ----------------------------
DROP TABLE IF EXISTS `t_student`;
CREATE TABLE `t_student` (
  `S#` varchar(255) NOT NULL,
  `Sname` varchar(255) NOT NULL,
  `Sex` varchar(255) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `Major` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`S#`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_student
-- ----------------------------
BEGIN;
INSERT INTO `t_student` VALUES ('2012001', '王珊', '女', 25, '软件工程');
INSERT INTO `t_student` VALUES ('2012002', '李平', '男', 27, '软件工程');
INSERT INTO `t_student` VALUES ('2012003', '张华', '男', 30, '机械电子');
INSERT INTO `t_student` VALUES ('2012004', '吴军', '男', 33, '软件工程');
INSERT INTO `t_student` VALUES ('2012005', '李勇', '男', 32, '机械电子');
INSERT INTO `t_student` VALUES ('2012006', '周云', '女', 30, '英语');
INSERT INTO `t_student` VALUES ('2012007', '李娜', '女', 29, '软件工程');
INSERT INTO `t_student` VALUES ('2013001', '杨玲', '女', 28, '英语');
INSERT INTO `t_student` VALUES ('2013002', '王新', '男', 30, '软件工程');
INSERT INTO `t_student` VALUES ('2013003', '孙强', '男', 31, '机械电子');
INSERT INTO `t_student` VALUES ('2013004', '华宇', '男', 19, NULL);
INSERT INTO `t_student` VALUES ('2013005', '李华', '女', 25, '软件工程');
COMMIT;

-- ----------------------------
-- Table structure for t_student_course
-- ----------------------------
DROP TABLE IF EXISTS `t_student_course`;
CREATE TABLE `t_student_course` (
  `S#` char(10) NOT NULL,
  `C#` char(10) NOT NULL,
  `Score` int(11) DEFAULT NULL,
  PRIMARY KEY (`S#`,`C#`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_student_course
-- ----------------------------
BEGIN;
INSERT INTO `t_student_course` VALUES ('2012001', 'c001', 87);
INSERT INTO `t_student_course` VALUES ('2012001', 'c002', 75);
INSERT INTO `t_student_course` VALUES ('2012001', 'c003', 80);
INSERT INTO `t_student_course` VALUES ('2012001', 'c008', 90);
INSERT INTO `t_student_course` VALUES ('2012002', 'c003', 70);
INSERT INTO `t_student_course` VALUES ('2012002', 'c008', 88);
INSERT INTO `t_student_course` VALUES ('2012003', 'c001', 90);
INSERT INTO `t_student_course` VALUES ('2012003', 'c003', 85);
INSERT INTO `t_student_course` VALUES ('2012003', 'c008', 77);
INSERT INTO `t_student_course` VALUES ('2012004', 'c003', 90);
INSERT INTO `t_student_course` VALUES ('2012004', 'c008', 97);
INSERT INTO `t_student_course` VALUES ('2012005', 'c001', NULL);
INSERT INTO `t_student_course` VALUES ('2012005', 'c003', 88);
INSERT INTO `t_student_course` VALUES ('2012005', 'c008', 95);
INSERT INTO `t_student_course` VALUES ('2012006', 'c003', 90);
INSERT INTO `t_student_course` VALUES ('2012006', 'c008', 92);
INSERT INTO `t_student_course` VALUES ('2012007', 'c003', 76);
INSERT INTO `t_student_course` VALUES ('2012007', 'c008', 82);
INSERT INTO `t_student_course` VALUES ('2013001', 'c003', 67);
INSERT INTO `t_student_course` VALUES ('2013001', 'c008', 90);
INSERT INTO `t_student_course` VALUES ('2013002', 'c008', 79);
INSERT INTO `t_student_course` VALUES ('2013005', 'c001', NULL);
INSERT INTO `t_student_course` VALUES ('2013005', 'c003', 80);
INSERT INTO `t_student_course` VALUES ('2013005', 'c008', 90);
COMMIT;

-- ----------------------------
-- Table structure for t_teacher
-- ----------------------------
DROP TABLE IF EXISTS `t_teacher`;
CREATE TABLE `t_teacher` (
  `T#` varchar(255) NOT NULL,
  `Tname` varchar(255) NOT NULL,
  `Age` int(11) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Pass` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`T#`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_teacher
-- ----------------------------
BEGIN;
INSERT INTO `t_teacher` VALUES ('t001', '李明', 40, '副教授','123456');
INSERT INTO `t_teacher` VALUES ('t002', '赵云', 45, '教授','123456');
INSERT INTO `t_teacher` VALUES ('t003', '陈军', 30, '讲师','123456');
INSERT INTO `t_teacher` VALUES ('t004', '韩伟', 32, '副教授','123456');
INSERT INTO `t_teacher` VALUES ('t005', '刘红', 35, '副教授','123456');
INSERT INTO `t_teacher` VALUES ('t006', '张雷', 33, '副教授','123456');
INSERT INTO `t_teacher` VALUES ('t007', '李敏', 28, '讲师','123456');
INSERT INTO `t_teacher` VALUES ('t008', '钟燕', 31, '讲师','123456');
INSERT INTO `t_teacher` VALUES ('t009', '王海', 34, '副教授','123456');
INSERT INTO `t_teacher` VALUES ('t010', '李亚', 46, '教授','123456');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
