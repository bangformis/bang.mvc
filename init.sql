-- ----------------------------
-- 初始化資料庫使用
-- error_log為系統錯誤記錄資料庫
-- ----------------------------
DROP TABLE IF EXISTS `error_log`;
CREATE TABLE `error_log` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Content` text NOT NULL,
  `Filename` varchar(200) NOT NULL,
  `Message` varchar(200) NOT NULL,
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
