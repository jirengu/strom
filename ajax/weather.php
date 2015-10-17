<?php

$ip = getIp();
echo $ip;

function getWeather()
{
	date_default_timezone_set('PRC');
	set_time_limit(0);
	$private_key = '1af25d_SmartWeatherAPI_575592d';
	$appid='75988d93774b5659';
	$appid_six=substr($appid,0,6);
	$areaid = '101010100';  
	$type='forecast_f'; //基础气象接口
	$date=date("YmdHi");
	$public_key="http://open.weather.com.cn/data/?areaid=".$areaid."&type=".$type."&date=".$date."&appid=".$appid;
	 
	$key = base64_encode(hash_hmac('sha1',$public_key,$private_key,TRUE));
	 
	$URL="http://open.weather.com.cn/data/?areaid=".$areaid."&type=".$type."&date=".$date."&appid=".$appid_six."&key=".urlencode($key);
	//echo $URL;
	 
	$string=file_get_contents($URL);
	 
	echo $string;

}




function getIp(){    
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))    
	$ip = getenv("HTTP_CLIENT_IP");    
	else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))    
	$ip = getenv("HTTP_X_FORWARDED_FOR");    
	else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))    
	$ip = getenv("REMOTE_ADDR");    
	else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))    
	$ip = $_SERVER['REMOTE_ADDR'];    
	else 
	$ip = "unknow";    
	return($ip);    
}
 
?>