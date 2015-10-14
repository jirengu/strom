<?php
	set_time_limit(0);
	$private_key = '1af25d_SmartWeatherAPI_575592d';
	$appid='75988d93774b5659';
	$appid_six=substr($appid,0,6);
	$areaid = '101010100';  
	$type='forecast_v';
	$date=date("YmdHi");
	$public_key="http://open.weather.com.cn/data/?areaid=".$areaid."&type=".$type."&date=".$date."&appid=".$appid;
	 
	$key = base64_encode(hash_hmac('sha1',$public_key,$private_key,TRUE));
	 
	$URL="http://open.weather.com.cn/data/?areaid=".$areaid."&type=".$type."&date=".$date."&appid=".$appid_six."&key=".urlencode($key);
	echo $URL;
	 
	//$string=file_get_contents($URL);
	 
	//echo $string;
 
?>