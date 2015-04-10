# 主机: localhost
# 数据库: myOA
# 表: 'category'
# 
CREATE TABLE `category` (
  `CategoryId` int(11) NOT NULL default '0',
  `CategoryName` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`CategoryId`)
) TYPE=MyISAM; 

# 主机: localhost
# 数据库: myOA
# 表: 'file'
# 
CREATE TABLE `file` (
  `FileId` int(11) NOT NULL auto_increment,
  `FromUserId` int(11) NOT NULL default '0',
  `CreateTime` date NOT NULL default '0000-00-00',
  `ToUserIdArray` varchar(100) NOT NULL default '',
  `Title` varchar(100) NOT NULL default '',
  `KeyWords` varchar(100) NOT NULL default '',
  `Content` text NOT NULL,
  `StatusId` int(11) NOT NULL default '0',
  `CategoryId` int(11) NOT NULL default '0',
  PRIMARY KEY  (`FileId`)
) TYPE=MyISAM; 

# 主机: localhost
# 数据库: myOA
# 表: 'log'
# 
CREATE TABLE `log` (
  `LogId` int(11) NOT NULL auto_increment,
  `CreateTime` date NOT NULL default '0000-00-00',
  `LogContent` text NOT NULL,
  PRIMARY KEY  (`LogId`)
) TYPE=MyISAM; 

# 主机: localhost
# 数据库: myOA
# 表: 'privilege'
# 
CREATE TABLE `privilege` (
  `PrivilegeId` int(11) NOT NULL default '0',
  `FileAdd` char(1) NOT NULL default '',
  `FileUpdate` char(1) NOT NULL default '',
  `FileDelete` char(1) NOT NULL default '',
  `FileSearch` char(1) NOT NULL default '',
  `FileDispose` char(1) NOT NULL default '',
  `PublicMessageAdd` char(1) NOT NULL default '',
  `PublicMessageUpdate` char(1) NOT NULL default '',
  `PublicMessageDelete` char(1) NOT NULL default '',
  `PublicMessageSearch` char(1) NOT NULL default '',
  `UserAdd` char(1) NOT NULL default '',
  `UserUpdate` char(1) NOT NULL default '',
  `UserDelete` char(1) NOT NULL default '',
  `LogSearch` char(1) NOT NULL default '',
  PRIMARY KEY  (`PrivilegeId`)
) TYPE=MyISAM; 


# 主机: localhost
# 数据库: myOA
# 表: 'publicmessage'
# 
CREATE TABLE `publicmessage` (
  `PublicMessageId` int(11) NOT NULL auto_increment,
  `FromUserId` int(11) NOT NULL default '0',
  `CreateTime` date NOT NULL default '0000-00-00',
  `Title` varchar(100) NOT NULL default '',
  `KeyWords` varchar(100) NOT NULL default '',
  `Content` varchar(100) NOT NULL default '',
  `CategoryId` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`PublicMessageId`)
) TYPE=MyISAM; 

# 主机: localhost
# 数据库: myOA
# 表: 'role'
# 
CREATE TABLE `role` (
  `RoleId` int(11) NOT NULL default '0',
  `RoleName` varchar(100) NOT NULL default '',
  `PrivilegeId` int(11) NOT NULL default '0',
  PRIMARY KEY  (`RoleId`)
) TYPE=MyISAM; 

# 主机: localhost
# 数据库: myOA
# 表: 'status'
# 
CREATE TABLE `status` (
  `StatusId` int(11) NOT NULL default '0',
  `StatusDesc` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`StatusId`)
) TYPE=MyISAM; 

# 主机: localhost
# 数据库: myOA
# 表: 'user'
# 
CREATE TABLE `user` (
  `UserId` int(11) NOT NULL auto_increment,
  `LoginName` varchar(100) NOT NULL default '',
  `Password` varchar(100) NOT NULL default '',
  `RealName` varchar(100) NOT NULL default '',
  `Department` varchar(100) NOT NULL default '',
  `Email` varchar(100) NOT NULL default '',
  `RoleId` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`UserId`)
) TYPE=MyISAM; 


# 初始化数据
insert into `category` values(1,'工作报告');
insert into `category` values(2,'红头文件');
insert into `category` values(3,'任务下达');

insert into `role` values(0,'未授权角色',0);
insert into `role` values(1,'普通员工',1);
insert into `role` values(2,'管理者',2);
insert into `role` values(3,'系统管理员',3);

insert into `status` values(1,'未上报');
insert into `status` values(2,'已上报');
insert into `status` values(3,'已审批');

insert into `privilege` values(0,'N','N','N','N','N','N','N','N','N','N','N','N','N');
insert into `privilege` values(1,'Y','Y','Y','N','N','Y','Y','N','Y','N','N','N','N');
insert into `privilege` values(2,'Y','Y','Y','Y','Y','Y','Y','Y','Y','N','N','N','N');
insert into `privilege` values(3,'N','N','Y','N','N','N','N','N','N','N','N','N','N');