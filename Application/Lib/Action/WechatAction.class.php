<?php
header("Content-type:text/html; charset=utf-8");
Class WechatAction extends Action{
	
	//΢�Ź��ں���ݵ�Ψһ��ʶ�����ͨ������΢�ŷ��͵��ʼ��в鿴
	var $appid = 'wx60b1fdb8938e6ea9';

	//JSAPI�ӿ��л�ȡopenid����˺��ڹ���ƽ̨��������ģʽ��ɲ鿴
	var $appsecret = 'e962851664c969b8b90ef3a1cef77171';

	//=======��curl��ʱ���á�===================================
	//������ͨ��curlʹ��HTTP POST�������˴����޸��䳬ʱʱ�䣬Ĭ��Ϊ30��
	var $curl_timeout = 30;
	
	var $code;//code�룬���Ի�ȡopenid
	var $openid;//�û���openid
	
	/**
	 * 	���ã����ɿ��Ի��code��url
	 */
	function createOauthUrlForCode($redirectUrl)
	{
		$urlObj["appid"] =$this->appid;
		$urlObj["redirect_uri"] = "$redirectUrl";
		$urlObj["response_type"] = "code";
		$urlObj["scope"] = "snsapi_base";
		$urlObj["state"] = "STATE"."#wechat_redirect";
		$bizString = $this->formatBizQueryParaMap($urlObj, false);
		return "https://open.weixin.qq.com/connect/oauth2/authorize?".$bizString;
	}
	
	/**
	 * 	���ã����ɿ��Ի��openid��url
	 */
	function createOauthUrlForOpenid()
	{
		$urlObj["appid"] = $this->appid;
		$urlObj["secret"] = $this->appsecret;
		$urlObj["code"] = $this->code;
		$urlObj["grant_type"] = "authorization_code";
		$bizString = $this->formatBizQueryParaMap($urlObj, false);
		return "https://api.weixin.qq.com/sns/oauth2/access_token?".$bizString;
	}
	
	/**
	 * 	���ã�ͨ��curl��΢���ύcode���Ի�ȡopenid
	 */
	function getOpenid()
	{
		$url = $this->createOauthUrlForOpenid();
        //��ʼ��curl
       	$ch = curl_init();
		//���ó�ʱ
		curl_setopt($ch, CURLOP_TIMEOUT, $this->curl_timeout);
		curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		//����curl�������jason��ʽ����
        $res = curl_exec($ch);
		curl_close($ch);
		//ȡ��openid
		$data = json_decode($res,true);
		$this->openid = $data['openid'];
		return $this->openid;
	}
	
	/**
	 * 	���ã���ʽ��������ǩ��������Ҫʹ��
	 */
	function formatBizQueryParaMap($paraMap, $urlencode)
	{
		$buff = "";
		ksort($paraMap);
		foreach ($paraMap as $k => $v)
		{
		    if($urlencode)
		    {
			   $v = urlencode($v);
			}
			//$buff .= strtolower($k) . "=" . $v . "&";
			$buff .= $k . "=" . $v . "&";
		}
		$reqPar;
		if (strlen($buff) > 0) 
		{
			$reqPar = substr($buff, 0, strlen($buff)-1);
		}
		return $reqPar;
	}
	
	/**
	 * 	���ã�����code
	 */
	function setCode($code_)
	{
		$this->code = $code_;
	}










}
?>