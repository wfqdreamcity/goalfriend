<?php
	//echo phpinfo();
	/* $hostname = "127.0.0.1"; 
	$dbname = "golfrend";
	$username = "sa"; 
	$pwd = "root"; 
	$dsn="sqlsrv:Server=$hostname;database=$dbname";

	$db = new PDO ($dsn,$username,$pwd);
	$rs = $db->query("SELECT Id,Name FROM dbo.AspNetRoles");
	while ( $row = $rs->fetch( PDO::FETCH_ASSOC ) ) {  
		print_r( $row );  
	}  
	//$result_arr = $rs->fetchAll();
	//$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$sql="SELECT Id,Name FROM dbo.AspNetRoles";
  echo $sql;
	
	var_dump($rs);
	
	exit; */
    define('APP_NAME', 'Application');
    define('APP_PATH', './Application/');
	define('APP_DEBUG',true);
    require './ThinkPHP/ThinkPHP.php';
    //入口文件

