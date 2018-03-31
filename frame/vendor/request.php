<?php
namespace frame\vendor;

final class Request
{

	public static function post($key=null){
		if( is_null($key) ){
			return $_POST;
		}else{
			if( isset( $_POST[$key] ) ){
				return self::filter( $_POST[$key] );
			}else{
				return [];
			}
		}
	}

	public static function get($key=null){
		if( is_null($key) ){
			return $_GET;
		}else{
			if( isset( $_GET[$key] ) ){
				return self::filter( $_GET[$key] );
			}else{
				return [];
			}
			
		}
	}

	public static function file($key=null){
		if( is_null($key) ){
			return $_FILES;
		}else{
			if( isset( $_FILES[$key] ) ){
				return $_FILES[$key];
			}else{
				return [];
			}
			
		}
	}

	//过滤器
	public static function filter($val){
		return  htmlentities($val);
	}

}
