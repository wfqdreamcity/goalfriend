/*
�������ݿ�
*/


CREATE TABLE `access_token` (
   `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '����id',
   `username` varchar(50) NOT NULL COMMENT '�û���',
   `openid` varchar(50) DEFAULT NULL COMMENT '΢��openid',
   `access_token` varchar(1000) DEFAULT NULL COMMENT 'access_token',
   `refresh_token` varchar(100) DEFAULT NULL COMMENT 'refresh_token',
   `time` varchar(30) DEFAULT NULL COMMENT '����ʱ��',
   PRIMARY KEY (`id`,`username`)
 ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1