<?php
header("Content-type:text/html; charset=utf-8");
Class IndexAction extends CommonAction{
	
	//page for m_web
	public function index(){
		$this->display();
	}
	
	//login
	public function login(){
		
		$username="13810261748";
		$passwd="chenlong";
		
		$obj =new UsersAction();
		
		//$result =$obj->getToken($username,$passwd);
		$result =$obj->getRefreshAccessToken($username);
		
	    p($result);
	}
	
	//login page
	



}
?>