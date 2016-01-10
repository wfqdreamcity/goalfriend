<?php	
function p($arr){
	echo '<pre>' . print_r($arr, true) . '</pre>';
}
 //倒计时,剩余多少天
 //day1是今天的日期，day2是截止日期
function get_the_remaining_days($day2){
	 $day1=date("Y-m-d H:i:s",time());
     $day=ceil((strtotime($day2)-strtotime($day1))/86400); //60s*60min*24h
	 if($day<=0)
	 {
		return "已成功";
	 }else{
	    return $day."天";
	 }
}

// 时间变成多少分钟前
function get_long_time($date){  
    $curr = time();
    $date = strtotime($date);
    $tmp = $curr - $date;
    if($tmp < 60){
        $re = $tmp.'秒前';
    }else if($tmp < 3600){
        $re = floor($tmp/60).'分钟前';
    }else if($tmp < 86400){
        $re = floor($tmp/3600).'小时前';
    }else if($tmp < 259200){//3天内
        $re = floor($tmp/86400).'天前';
    }else{
        $re = date('Y年m月d日',$date);
    }
    echo $re;
}  

/*获取字符串首字母*/
function getfirstchar($s0){   
    $fchar = ord($s0{0});
    if($fchar >= ord("A") and $fchar <= ord("z") )return strtoupper($s0{0});
    $s1 = iconv("UTF-8","gb2312", $s0);
    $s2 = iconv("gb2312","UTF-8", $s1);
    if($s2 == $s0){$s = $s1;}else{$s = $s0;}
    $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
    if($asc >= -20319 and $asc <= -20284) return "A";
    if($asc >= -20283 and $asc <= -19776) return "B";
    if($asc >= -19775 and $asc <= -19219) return "C";
    if($asc >= -19218 and $asc <= -18711) return "D";
    if($asc >= -18710 and $asc <= -18527) return "E";
    if($asc >= -18526 and $asc <= -18240) return "F";
    if($asc >= -18239 and $asc <= -17923) return "G";
    if($asc >= -17922 and $asc <= -17418) return "I";
    if($asc >= -17417 and $asc <= -16475) return "J";
    if($asc >= -16474 and $asc <= -16213) return "K";
    if($asc >= -16212 and $asc <= -15641) return "L";
    if($asc >= -15640 and $asc <= -15166) return "M";
    if($asc >= -15165 and $asc <= -14923) return "N";
    if($asc >= -14922 and $asc <= -14915) return "O";
    if($asc >= -14914 and $asc <= -14631) return "P";
    if($asc >= -14630 and $asc <= -14150) return "Q";
    if($asc >= -14149 and $asc <= -14091) return "R";
    if($asc >= -14090 and $asc <= -13319) return "S";
    if($asc >= -13318 and $asc <= -12839) return "T";
    if($asc >= -12838 and $asc <= -12557) return "W";
    if($asc >= -12556 and $asc <= -11848) return "X";
    if($asc >= -11847 and $asc <= -11056) return "Y";
    if($asc >= -11055 and $asc <= -10247) return "Z";
    return null;
}
 
/*汉字转拼音*/
function pinyin($zh){
    $ret = "";
    $s1 = iconv("UTF-8","gb2312", $zh);
    $s2 = iconv("gb2312","UTF-8", $s1);
    if($s2 == $zh){$zh = $s1;}
    for($i = 0; $i < strlen($zh); $i++){
        $s1 = substr($zh,$i,1);
        $p = ord($s1);
        if($p > 160){
            $s2 = substr($zh,$i++,2);
            $ret .= getfirstchar($s2);
        }else{
            $ret .= $s1;
        }
    }
    return $ret;
}

//----------------------------------------------------------------------------------- 
// 函数名：CheckImageSize($ImageFileName,$LimitSize) 
// 作 用：检验上传图片的大小 
// 参 数：$ImageFileName 上传的图片名 
// $LimitSize 要求的尺寸 
// 返回值：布尔值 
// 备 注：无
// 实例：echo CheckImageSize('https://www.baidu.com/img/bd_logo1.png',array('539','257')) ;
// 返回1 说明图片合适，返回0说明不合适
//----------------------------------------------------------------------------------- 
function CheckImageSize($ImageFileName,$LimitSize) 
{ 
	$size=GetImageSize($ImageFileName); 
	if($size[0]>$LimitSize[0] || $size[1]>$LimitSize[1]) 
	{ 
		//echo '图片尺寸过大'; 
		echo "0";
		return false; 
	} 
	return true; 
} 


//判断是否属手机
function is_mobile(){ 
    $user_agent = $_SERVER['HTTP_USER_AGENT']; 
    $mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong",
"airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525",
"applewebkit/532","asus","audio","aumic","avantogo","becker","benq","bilbo",
"bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger",
"dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web",
"goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei",
"hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc",
"lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-",
"lge9","longcos","maemo","mercator","meridian","micromax","midp","mini",
"mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen",
"nexian","nfbrowser","nintendo","nitro","nokia","nook","novarra","obigo",
"palm","panasonic","pantech","philips","phone","pg-","playstation","pocket",
"pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-",
"scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony",
"spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca",
"telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar",
"verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser",
"wii","windows ce","wireless","xda","xde","zte"); 
    $is_mobile = false; 
    foreach ($mobile_agents as $device) { 
        if (stristr($user_agent, $device)) { 
            $is_mobile = true; 
            break; 
        } 
    } 
    return $is_mobile; 
} 

//根据城市ID返回城市名字
function get_region_name($region_id){
    $region_name=M('region')->where('id='.$region_id)->getField('region_name');
    if($region_name){
        return $region_name;
    }
}

//在线交易订单支付处理函数
//函数功能：根据支付接口传回的数据判断该订单是否已经支付成功；
//返回值：如果订单已经成功支付，返回true，否则返回false；
function checkorderstatus($ordid){
    $Ord=M('Orderlist');
    $ordstatus=$Ord->where('ordid='.$ordid)->getField('ordstatus');
    if($ordstatus==1){
        return true;
    }else{
        return false;    
    }
}
//处理订单函数
//更新订单状态，写入订单支付后返回的数据
function orderhandle($parameter){
    $ordid=$parameter['out_trade_no'];
    $data['payment_trade_no']      =$parameter['trade_no'];
    $data['payment_trade_status']  =$parameter['trade_status'];
    $data['payment_notify_id']     =$parameter['notify_id'];
    $data['payment_notify_time']   =$parameter['notify_time'];
    $data['payment_buyer_email']   =$parameter['buyer_email'];
    $data['payment_status']             =2;
    $data['order_status']             =2;
    $Ord=M('orders');
    $Ord->where('order_sn='.$ordid)->save($data);
	$info=M("orders")->where('order_sn='.$ordid)->find();
	$name=$info['name'];
	$mobile=$info['mobile'];
    $sms=new SmsAction();
	$sms->OrdersSuccess($name,$mobil);

} 
/*-----------------------------------
2013.8.13更正
下面这个函数，其实不需要，大家可以把他删掉，
具体看我下面的修正补充部分的说明
------------------------------------*/
//获取一个随机且唯一的订单号；
function getordcode(){
    $Ord=M('Orderlist');
    $numbers = range (10,99);
    shuffle ($numbers); 
    $code=array_slice($numbers,0,4); 
    $ordcode=$code[0].$code[1].$code[2].$code[3];
    $oldcode=$Ord->where("ordcode='".$ordcode."'")->getField('ordcode');
    if($oldcode){
        getordcode();
    }else{
        return $ordcode;
    }
}
?>