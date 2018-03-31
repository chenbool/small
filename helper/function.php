<?php

function dump($val){
	echo '<div style="border:1px solid #ccc;background:#FAFAFA;padding:5px 15px;z-index:1000;margin:5px;"> <pre>';
	var_dump($val);
	echo '</pre></div> ';
}


function dd($val){
	echo '<div style="border:1px solid #ccc;background:#FAFAFA;padding:5px 15px;z-index:1000;margin:5px;"> <pre>';
	var_dump($val);
	die( '</pre></div> ' );
}

function session($key='',$value=''){
	//读取
	if( !empty($key) && empty($value) ){
		if( isset($_SESSION[$key]) ){
			return $_SESSION[$key];
		}else{
			return [];
		}
	}else if( !empty($key) && !empty($value) ){
		return $_SESSION[$key] = $value;
	}else{
		return $_SESSION;
	}
}


function cookie($key='',$value='',$time=1000){
	//读取
	if( !empty($key) && empty($value) ){
		if( isset($_COOKIE[$key]) ){
			return $_COOKIE[$key];
		}else{
			return [];
		}	
	}else if( !empty($key) && !empty($value) ){
		return SetCookie($key, $value , time()+$time );
	}else{
		return $_COOKIE;
	}
}