create database if not exists vote default charset utf8 collate utf8_general_ci;

create table sysconfig(
  cid int(11) not null auto_increment,
  vote_name varchar(45) not null,
  dietime date not null,
  method int(11) not null DEFAULT '1',
  description varchar(800) not null default '',
  PRIMARY KEY (cid)
)engine=MyISAM auto_increment=2 default CHARSET=utf8;

create table users(
  cid int(11) not null auto_increment,
  username varchar(40) not null,
  passwd varchar(45) not null,
  admin int(11) not null DEFAULT '0',
  isvote int(11) not null default '0',
  PRIMARY KEY (cid)
)engine=MyISAM auto_increment=3 DEFAULT CHARSET=utf8;

create table votename(
  cid int(11) not null auto_increment,
  question_name VARCHAR(200) not null,
  votetype int(11) not null default '0' comment '0为单选\1为多选',
  sumvotenum int(11) not null default '1',
  PRIMARY KEY (cid)
)engine=MyISAM auto_increment=16 DEFAULT charset=utf8;

CREATE TABLE `voteoption` (
  `cid` int(11) NOT NULL auto_increment,
  `optionname` varchar(100) NOT NULL default '',
  `votenum` int(11) NOT NULL default '0',
  `upid` int(11) NOT NULL,
  PRIMARY KEY  (`cid`,`upid`),
  KEY `fk_voteoption_votename_idx` (`upid`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

INSERT INTO `sysconfig` VALUES ('2', '测试', '2019-01-31', '1', '测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试');