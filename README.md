# goalfriend
goalfriend is a platform for goaler

#data base info

name:goalfriend
table:access_token
DDL detial:

create table
CREATE TABLE `access_token` (
   `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
   `username` varchar(50) NOT NULL COMMENT '用户名',
   `openid` varchar(50) DEFAULT NULL COMMENT '微信openid',
   `access_token` varchar(1000) DEFAULT NULL COMMENT 'access_token',
   `refresh_token` varchar(100) DEFAULT NULL COMMENT 'refresh_token',
   `time` varchar(30) DEFAULT NULL COMMENT '创建时间',
   PRIMARY KEY (`id`,`username`)
 ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1