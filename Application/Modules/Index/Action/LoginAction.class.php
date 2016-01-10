<?php
header("Content-type:text/html;charset=utf-8");
Class LoginAction extends Action{
	 Public function _initialize(){

	 }
	Public function  index(){
		
		$this->display();
	}
	public function checklogin(){
		 if($_POST)
		 {    
			    $user_login=I('post.user_login');
			    $user_pass=md5(I('post.user_pass'));
			    $user_info=M('users')->where('user_login="'.$user_login.'" and user_pass="'.$user_pass.'"')->find();
                if(user_info)
			   {
                   $_SESSION['user_info']=$user_info;	
				   echo "<script>window.location.href='".U('Xadmin/Index/index')."'</script>";
			   }else{
                   echo "<script>window.location.href='".U('Xadmin/Index/index')."'</script>";
			   }
	
		
  	}
	Public function  logout(){
			if( $_SESSION['user_info']['user_level']==1 || $_SESSION['user_info']['user_level']==2)
			{
			    unset($_SESSION['user_info']);
			    echo "<script>window.location.href='".U('Index/Common/login')."'</script>";
			}else{
				 unset($_SESSION['user_info']);
				 echo "<script>window.location.href='".U('Xadmin/Login/index')."'</script>";
			}
	}


	
 }
?>