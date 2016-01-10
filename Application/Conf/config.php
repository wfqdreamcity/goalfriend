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

	'DB_HOST' => 'sqld.duapp.com:4050',
   'DB_USER' => '733b1262701b4a47840f4ee64369ccd2',
   'DB_PWD' => 'b9322f2d8aa04838b33b3ce27170e2e8',
	'DB_NAME' => 'RXZHwtrVMcDCpGLPotDl',
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
