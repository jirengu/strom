<?php

$weather = getWeather();

if($_GET['callback']){
	$cb = $_GET['callback'];
	echo "$cb&&$cb($weather)";
}else{
	echo $weather;
}

function getCity(){
	$ip = getIp();
	$uri = "http://api.map.baidu.com/location/ip?ak=A20cb515b0fa284cb99c36956c06e737&ip=$ip&coor=bd09ll";
	$str = file_get_contents($uri);

	$cityArr = json_decode($str);
	if( $cityArr->{'status'} == 0 ){
		return $cityArr->{'content'}->{'address_detail'}->{'city'};
	}else{
		return '';
	};
}

function getWeather(){
	$city = getCity();
	echo $city;
	$uri = "http://api.map.baidu.com/telematics/v3/weather?location=$city&output=json&ak=A20cb515b0fa284cb99c36956c06e737";
	$str = file_get_contents(($uri));
	return $str;
}



function getIp()
{
    static $realip;
    print_r($_SERVER);
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

    if(strpos($realip, ',')){
    	$realip = substr($realip , 0, strpos($realip, ','));
    }
    echo $realip;
    return $realip;
}
 
?>