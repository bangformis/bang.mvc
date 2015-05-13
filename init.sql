-- ----------------------------
-- 初始化資料庫使用
-- error_log為系統錯誤記錄資料庫
-- ----------------------------
DROP TABLE IF EXISTS `error_log`;
CREATE TABLE `error_log` (
`Id`  bigint(20) NOT NULL AUTO_INCREMENT ,
`Content`  text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`Filename`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`Line`  int(11) NOT NULL ,
`Message`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`DateTime`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
PRIMARY KEY (`Id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=5
ROW_FORMAT=COMPACT
;

