<?php

class connect{
	private $query;
	public function __construct(){
		$this->mysqlconnect();
	}
	public function mysqlconnect(){
		$link = mysql_connect('localhost','root','qctt123');
		mysql_query("set names 'utf8'");
		if(!$link){
			 die('Could not connect: ' . mysql_error());
		}
		$result = mysql_select_db('chenvxu',$link);
		 if(!$result){
			 die('Could not connect: ' . mysql_error());
		 }
		//return $this->connect;
	}
	public function  query($sql){
		$result= mysql_query($sql);
		return $result;
	}
	
}