<?php

$ip = getIp();
echo $ip;
getWeather2();

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

function getCity(){
	$ip = getIp();
	$uri = "http://api.map.baidu.com/location/ip?ak=E4805d16520de693a3fe707cdc962045&ip=$ip&coor=bd09ll";
	$str = file_get_contents($uri);
	$city = json_decode($str)->city;
}

function getWeather2(){
	$city = '杭州市';
	$uri = "http://api.map.baidu.com/telematics/v3/weather?location=$city&output=json&ak=A20cb515b0fa284cb99c36956c06e737";
	$str = file_get_contents(($uri));
	echo $str;
}



	function getIp()
	{
	    static $realip;
	    if (isset($_SERVER)){
	        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
	            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
	            $realip = $_SERVER["HTTP_CLIENT_IP"];
	        } else {
	            $realip = $_SERVER["REMOTE_ADDR"];
	        }
	    } else {
	        if (getenv("HTTP_X_FORWARDED_FOR")){
	            $realip = getenv("HTTP_X_FORWARDED_FOR");
	        } else if (getenv("HTTP_CLIENT_IP")) {
	            $realip = getenv("HTTP_CLIENT_IP");
	        } else {
	            $realip = getenv("REMOTE_ADDR");
	        }
	    }
	    return $realip;
	}
 
?>