<?php
header("Content-type:text/html;charset=utf-8");
require_once('comm.php');

define("TOKEN", "goalfriend");
$wechat = new wechat();

if (isset($_GET['echostr'])) {
    $wechat->valid();
}else{
	$wechat->getMessage();
}

class wechat
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }
	public function getMessage()
    {
        $object = $GLOBALS["HTTP_RAW_POST_DATA"];
		$object = simplexml_load_string($object, 'SimpleXMLElement', LIBXML_NOCDATA);
		$RX_TYPE = trim($object->MsgType);//获取消息类型
	    switch ($RX_TYPE)
		{
			case "event":
				$result = $this->receiveEvent($object);
				break;
			case "text":
				$result = $this->receiveText($object);
				break;
		}
		echo $result;
		exit;
    }
	//接入微信验证
    public function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        if( $tmpStr == $signature ){
			//file_put_contents("/data/lamp/apache2/htdocs/1/test.txt",date('Y-m-d H:i:d',time())."true\n",FILE_APPEND);
            return true;
        }else{
			//file_put_contents("/data/lamp/apache2/htdocs/1/test.txt",date('Y-m-d H:i:d',time())."false\n",FILE_APPEND);
            return false;
        }
    }
	
	//接收微信事件
	private function receiveEvent($object)
	{
		$contentStr = "";
		$Event = trim($object->Event);
		switch ($Event)
		{
			/* case "subscribe":
				$contentStr = "您好，欢迎关注车女婿上门保养！小婿等您好久了^^下单及更多常见问题了解请您回复“帮助”哦，同时也欢迎您拨打400-011-1919服务热线，客服工作时间为早9点至晚6点，非常感谢您的理解和支持！";
				
				$openid =$object->FromUserName;
				$scene_key=$object->EventKey;
				$scan_time = date('Y-m-d H:i:s',time());
				$nickname =$this->getUserInfo($openid);
				$connect =  new connect();
				$result = $connect->query("INSERT INTO ecs_qrcode_info (openid,nickname,scene_key,time) VALUES('".$openid."','".$nickname."','".$scene_key."','".$scan_time."')");
				break;
		   case "unsubscribe":
				$contentStr = "123";
				$openid =$object->FromUserName;
				$connect =  new connect();
				$result = $connect->query("DELETE FROM ecs_qrcode_info WHERE openid='".$openid."'");
				break;
			case "SCAN":
				$contentStr = "您好，欢迎关注车女婿上门保养！服务范围查询请回复“范围”； 预约下单流程及优惠口令使用方法请回复“下单”；活动套餐指定配件查询请回复“配件”；其他问题及投诉建议劳烦您拨打400-011-1919服务热线，客服工作时间为早9点至晚6点，非常感谢您的理解和支持！";
				
				 //要实现统计分析，则需要扫描事件写入数据库，这里可以记录 EventKey及用户OpenID，扫描时间
				$openid =$object->FromUserName;
				$scene_key=$object->EventKey;
				$scan_time = date('Y-m-d H:i:s',time());
				$nickname =$this->getUserInfo($openid);
				$connect =  new connect();
				$result = $connect->query("INSERT INTO ecs_qrcode_info (openid,nickname,scene_key,time) VALUES('".$openid."','".$nickname."','".$scene_key."','".$scan_time."')");
				break; */
			default:
				break;      
	 
		}
		$resultStr = $this->transmitText($object, $contentStr);
		return $resultStr;
	}
	//接收微信文本信息
	private function receiveText($object)
	{
		$contentStr = "";
		$keyword = trim($object->Content);
		switch ($keyword)
		{
			case "goalfriend":
				$contentStr = "goalfriend";
				break;
			default:
				break;      
	 
		}
		/* $MsgType =trim($object->MsgType);
		switch ($MsgType)
		{
			case "text":
				//插入数据库
				$openid =$object->FromUserName;
				
				$nickname =$this->getUserInfo($openid);
				$CreateTime=$object->CreateTime;
				$Content=$object->Content;
				//$connect =  new connect();
				//$result = $connect->query("INSERT INTO ecs_chat_log (openid,message,nickname,time) VALUES('".$openid."','".$Content."','".$nickname."','".$CreateTime."')");
				break;
			default:
				break;      
	 
		} */
		//file_put_contents("/data/lamp/apache2/htdocs/car/mobile/wechat/test.txt",date('Y-m-d H:i:d',time())."user=>".$openid =$object->FromUserName.":say:".$keyword."\n",FILE_APPEND);
		$resultStr = $this->transmitText($object, $contentStr);
		return $resultStr;
	}
	private function transmitText($object, $content)
    {
        if (!isset($content) || empty($content)){
            return "";
        }
        $textTpl = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[text]]></MsgType>
		<Content><![CDATA[%s]]></Content>
		</xml>";
        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $result;
    }
	private function getUserInfo($openid){
			require_once('getTokenMessage.php');
			$access_token = getToken();
			$userinfo = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=zh_CN");
			$userinfo = json_decode($userinfo);
			$nickname = $userinfo->{'nickname'};
			return $nickname;
	}
}
