CREATE TABLE `msg_admin_list` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(30) NOT NULL,
  `pwd` binary(60) NOT NULL,
  `name` varchar(10) NOT NULL,
  `hp` varchar(13) NOT NULL,
  `level` varchar(2) NOT NULL,
  `menus` varchar(2000) NOT NULL,
  `reg_dt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reg_ymd` date NOT NULL DEFAULT '0000-00-00',
  `reg_ip` varchar(15) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
INSERT INTO `msg_admin_list` VALUES (1,'pAdm2018','$2y$12$96jJ2Z6Bq74dxlBtMtSKL.pJCaQIpo3iZCbjYLls2jipp5YOoN25C','관리자','010-0000-0000','9','2018-09-03 19:19:00','2018-09-03','111.111.111.111');

CREATE TABLE `msg_conn_log` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(100) NOT NULL DEFAULT '',
  `id` varchar(30) NOT NULL DEFAULT '',
  `reg_ip` varchar(15) NOT NULL DEFAULT '',
  `referer` varchar(1024) NOT NULL DEFAULT '',
  `agent` varchar(512) NOT NULL DEFAULT '',
  `browser` varchar(512) NOT NULL DEFAULT '',
  `os` varchar(512) NOT NULL DEFAULT '',
  `memo` varchar(1024) NOT NULL DEFAULT '',
  `reg_dt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `msg_notice` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(200) NOT NULL DEFAULT '',
  `contents` text,
  `category` varchar(100) DEFAULT NULL,
  `category2` varchar(100) DEFAULT NULL,
  `is_notice` char(1) NOT NULL DEFAULT '0',
  `upfile` varchar(255) NOT NULL DEFAULT '',
  `writer_id` varchar(20) NOT NULL DEFAULT '',
  `writer_name` varchar(20) NOT NULL DEFAULT '',
  `hit` int(11) NOT NULL DEFAULT '0',
  `etc1` varchar(100) DEFAULT NULL,
  `etc2` varchar(100) DEFAULT NULL,
  `etc3` varchar(100) DEFAULT NULL,
  `etc4` varchar(100) DEFAULT NULL,
  `etc5` varchar(100) DEFAULT NULL,
  `etc6` varchar(100) DEFAULT NULL,
  `reg_dt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reg_ymd` date NOT NULL DEFAULT '0000-00-00',
  `reg_ip` varchar(15) NOT NULL,
  PRIMARY KEY (`idx`),
  UNIQUE KEY `idx_UNIQUE` (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `msg_siteinfo` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `policy` text,
  PRIMARY KEY (`idx`),
  UNIQUE KEY `idx_UNIQUE` (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `msg_logs` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `member_idx` int(11) NOT NULL,
  `page` varchar(200) NOT NULL,
  `msg` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `memo` varchar(100) DEFAULT '',
  `check` varchar(2) DEFAULT '0',
  `alert_type` varchar(10) DEFAULT NULL,
  `reg_dt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reg_ymd` date NOT NULL DEFAULT '0000-00-00',
  `reg_ip` varchar(15) NOT NULL,
  PRIMARY KEY (`idx`),
  UNIQUE KEY `idx_UNIQUE` (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;