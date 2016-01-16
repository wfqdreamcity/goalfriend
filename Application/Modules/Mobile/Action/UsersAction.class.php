<?php
header("Content-type:text/html; charset=utf-8");
Class UsersAction extends CommonAction{
	var $url="https://gfapi.chinacloudsites.cn/auth/token";
	var $url_user="https://gfapi.chinacloudsites.cn/";
	
	public function _initialize(){
		//微信授权(如果是微信浏览器)
		 $user_agent = $_SERVER['HTTP_USER_AGENT'];
		 if (strpos($user_agent, 'MicroMessenger') != false) {
			$this->wechat();
			//p($_SESSION);
		 }
        
	}
	
	//page for m_web
	public function index(){
		//not login
		if(!$_SESSION['users']){
			$this->redirect("Mobile/Users/login");
			exit;
		}
		
		//get users' info
		$this->userInfo =$_SESSION['users'];
		$this->display();
		
		//echo "login success!";
		
		//p($_SESSION);
	}
	
	//login page
	public function login(){
		
		$url_load="index";
		$this->url_load=$url_load;
		$this->display();
	}
	
	//login
	public function loginAjax(){
		
		$username=I("post.mobile");
		$passwd=I("post.passwd");
		
		$result =$this->getRefreshAccessToken($username,$passwd);
		if($result['error']){
			if($result['error']=='invalid_grant'){
				$code="fail";
				$msg="用户名或者密码错误!";
			}
			if($result['error']=='invalid_username'){
				$code="fail";
				$msg="该账号未注册!";
			}
		}else{
		   //获取用户基本信息
		   $res =$this->getUserInfo($result);
		   if($res=='ok'){
			    $code="ok";
				$msg="success!";
		   }else{
			    $code="fail";
				$msg=$res;
		   }
		}
		//如果微信浏览器 绑定微信
		if($_SESSION['openid']){
			$this->correlationWeChat($username);
		}
		
		$data['code']=$code;
		$data['msg']=$msg;
		$data =json_encode($data);
		
		echo $data;
		
	}
	
	//获取用户信息
	public function getUserInfo($result){
		$url =$this->url_user."api/Account/UserInfo";
		
		$Info=$this->https_request_get($url,$result['access_token']);
		$Info=json_decode($Info,true);
		
		if($Info['code']=='2000'){
			//用户的基本信息
			$_SESSION['users']=$Info['data'];
			//当前用户的access_token 信息
			$_SESSION['users']['token']=$result;
			
			return "ok";
	    }else{
			return "获取用户信息失败,请稍后重新登入!";
		}

	}
	
	//绑定微信
	public function correlationWeChat($username){
		
		$url =$this->url_user."api/Account/WeChatId";
		//$openid="oyfH8t85UBD6NThS-IODLfPcd5GY";
		$openid=$_SESSION['openid'];
		$access_token =$this->getAccessToken($username);
		
		//如果该微信号已经绑定了则不能从新绑定
		$condition1['openid']=$openid;
		$list =M("access_token")->where($condition1)->find();
		if(!$list){
		
			$data['openID']=$openid;
			//$data['Username']=$username;
			
			$post =$this->arrChangeToString($data);
			//球友绑定openid
			$result =$this->https_request_post($url,$post,$access_token);
			
			//微信端绑定openid
			$dataArr['openid']=$openid;
			$condition['username']=$username;
			M("access_token")->where($condition)->save($dataArr);
		}
		//$result=json_decode($result,true);
		//$_SESSION['correlation']=$result;
		
	}
	
	//获取用户信息通过openid
	public function getUserInfoByOpenid($openid){
		$condition['openid']=$openid;
		$list =M("access_token")->where($condition)->find();
		//获取access_token
		if($list){
			$username=$list['username'];
			$result =$this->getRefreshAccessToken($username);
			if($result['error']){
			
					$code="fail";
					$msg="绑定信息已过期，重新绑定!";
			}else{
			   //获取用户基本信息
			   $res =$this->getUserInfo($result);
			   if($res=='ok'){
					$code="ok";
					$msg="success!";
			   }else{
					$code="fail";
					$msg=$res;
			   }
			}
			if($code=="fail"){
				echo $code;
				echo $msg;
				sleep(3);
			}
		}
	}
	
	//新用户注册
	public function register(){
		$this->display();
	}
	public function registerAjax(){
		$url =$this->url_user."api/Account/Register";
		$data['phoneNumber']=I("post.mobile");
		$data['password']=I("post.passwd1");
		$data['confirmPassword']=I("post.passwd2");
		$data['nickname']=I("post.nickname");
		$data['verifyCode']=I("post.code");
		
		$post =$this->arrChangeToString($data);
		
		$result =$this->https_request_basic($url,$post);
		
		echo $result;
		//$result =json_decode($result,true);
	}
	//发送短信验证码
	public function sendCode(){
		$url =$this->url_user."api/Account/RequestVerifyCode";
		$data['mobile']=I("post.mobile");
		
		//$data['mobile']='15117950233';
		
		$post =$this->arrChangeToString($data);
		
		$result =$this->https_request_basic($url,$post);
		
		$result =json_decode($result,true);
	
		if($result['code']=='2000'){
			echo "ok";
		}else{
			echo "fail";
		}
	}
	
	//获取access_token
    public function getAccessToken($username){
		$condition['username']=$username;
		$condition['time']=array('gt',time());
		$result =M('access_token')->where($condition)->find();
		//$sql = M("access_token")->getLastSql();
	
		if(!$result){
			//过去刷新access_token
			$result =$this->getRefreshAccessToken($username);
		}
		
		return $result['access_token'];
	}
	
	//获取token(首次验证获取token信息)
	public function getToken($username=0,$passwd=0){
		
		$data =array( 
			'client_id' => 'WeChatServer',
			'client_secret' => 'Luyu1990',
			'grant_type' => 'password'
		);
		$data['username']=$username;
		$data['password']=$passwd;
		
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

		return $result;
		
	}
	//刷新access_token
	public function getRefreshAccessToken($username=0,$passwd=0){
		$data =array( 
			'client_id' => 'WeChatServer',
			'client_secret' => 'Luyu1990',
			'grant_type' => 'refresh_token'
		);
		$condition['username']=$username;
		$result =M("access_token")->where($condition)->find();
		//如果已经存在通过refresh 获取token
		if($result){
			$data['refresh_token']=$result['refresh_token'];
		
			$post =$this->arrChangeToString($data);
			$url=$this->url;
			
			$result =$this->https_request($url,$post);
			
			$result =json_decode($result,true);
			
			//如果refresh_token成功
			if(!$result['error']){
				$condition['username']=$result['userName'];
				$dataArr['access_token']=$result['access_token'];
				$dataArr['refresh_token']=$result['refresh_token'];
				$dataArr['time']=time()+$result['expires_in'];
				
				M("access_token")->where($condition)->save($dataArr);
			
				return $result;
			}else{
				//重新绑定删除原纪录
				$condition1['openid']=$_SESSION['openid'];
				M("access_token")->where($condition1)->delete();
			}

		}
		
		//重新获取access_token
		$result =$this->getToken($username,$passwd);
		
		return $result;
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
	
	
	//post 推送(auth)
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
	public function https_request_basic($url, $data = null){
		$curl = curl_init();
		$username="WeChatServer";
		$password="Luyu1990";
		$baseCode =base64_encode($username.":".$password);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, Array("Authorization: Basic ".$baseCode));		
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
	//post 推送
	public function https_request_post($url, $data = null,$access_token){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, Array("Authorization: Bearer ".$access_token)); 
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
	
	//获取用户信息
	public function https_request_get($url,$access_token){
		
		$ch = curl_init($url);  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回  
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    // https请求 不验证证书和hosts
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Authorization: Bearer ".$access_token)); 
		$result = curl_exec($ch) ;  
		return $result;
	}
	
	//获取微信用户基本
	 public function wechat(){
		if(!isset($_SESSION['openid'])){
			//获取access_token过程中的跳转uri，通过跳转将code传入jsapi支付页面
			 $url = 'http://goalfriend.duapp.com/mobile/users/wechat';
			 $Wechat = new WechatAction();
			 //=========步骤1：网页授权获取用户openid============
			 //通过code获得openid
			 if (!isset($_GET['code'])){
				//触发微信返回code码
				$url = $Wechat->createOauthUrlForCode($url);
				Header("Location: $url"); 
			 }else{
				//获取code码，以获取openid
				$code = $_GET['code'];
				$Wechat->setCode($code);
				$openid = $Wechat->getOpenId();
				//赋值openid
				$_SESSION['openid']=$openid;
				//通过openid 登入
				$this->getUserInfoByOpenid($openid);
				//回调原来的页面
				//Header("Location: selectcombo");
				$this->redirect('Mobile/Users/index');				
			 }
			 exit;
		}
	 }
	 
	 //login out 
	 public function logout(){
		 unset($_SESSION['users']);
		 unset($_SESSION['openid']);
		 $this->redirect("Mobile/index/index");
	 }



}
?>