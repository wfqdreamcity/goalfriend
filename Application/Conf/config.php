<?php
//定义回调URL通用的URL
define('URL_CALLBACK', 'http://localhost/Common/callback?type=');
return array(
	//'配置项'=>'配置值'
	'APP_GROUP_LIST' => 'Index,Xadmin,Mobile', //项目分组设定
    'DEFAULT_GROUP'  => 'Index', //默认分组
	'APP_GROUP_MODE'=>'1',
	'APP_GROUP_PATH'=>'Modules',
    'URL_MODEL'=>'2',

	'DB_HOST' => '127.0.0.1',
   'DB_USER' => 'root',
   'DB_PWD' => 'qctt123',
	'DB_NAME' => 'goalfriend',
	'DB_PREFIX' => '',
	'DB_CHARSET' => 'utf8', 
    'URL_HTML_SUFFIX'=>'html',

	'TMPL_CACHE_ON'=>false,      // 默认开启模板缓存
	'TMPL_CACHE_ON'   => false,  // 默认开启模板编译缓存 false 的话每次都重新编译模板
    'ACTION_CACHE_ON'  => false,  // 默认关闭Action 缓存
    'HTML_CACHE_ON'   => false,   // 默认关闭静态缓存
    'DB_FIELDS_CACHE'=>false, //关闭DB字段缓存
	'URL_CASE_INSENSITIVE' =>true,
    
);
?>
