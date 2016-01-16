<?php
header("Content-type:text/html; charset=utf-8");
Class IndexAction extends CommonAction{
	var $url="https://gfapi.chinacloudsites.cn/auth/token";
	
	public function index(){
		
		echo "goalfriend index page!!";
		//$this->display();
	}
	
	//获取token
	public function getToken(){
	
		$data =array( 
			'username' => '13810261748',
			'password' => 'chenlong',
			'client_id' => 'WeChatServer',
			'client_secret' => 'Luyu1990',
			'grant_type' => 'password'
		);
	
		$post =$this->arrChangeToString($data);
		$url=$this->url;
		
		$result =$this->https_request($url,$post);
		
		$result =json_decode($result,true);
		
		$condition['username']=$result['userName'];
		$dataArr['access_token']=$result['access_token'];
		$dataArr['refresh_token']=$result['refresh_token'];
		$dataArr['time']=time()+$result['expires_in'];
		$dataArr['username']=$result['userName'];
		
		$list =M("access_token")->where($condition)->find();
		if($list){
			M("access_token")->where($condition)->save($dataArr);
		}else{
			M("access_token")->add($dataArr);
		}
		
	}
	
	//数组拼接字符串
	public function arrChangeToString(array $array){
		$post ='';
		foreach($array as $key =>$value){
			$post.=$key."=".$value."&";
		}
		$post =substr($post,0,-1);
		return $post;
	}
	
	
	//post 推送
	public function https_request($url, $data = null){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_HEADER,0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		if (!empty($data)){
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
	}



}
?>