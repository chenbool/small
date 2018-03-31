<?php
namespace frame\vendor;

final class Exception
{
	
	function __construct(){}

	public static function error($title,$msg){
		echo '<div style="border:1px solid #ccc;background:#FAFAFA;padding:5px 15px;z-index:1000;margin:5px;"> <pre>';
		echo '<h2>'.$title.'</h2>';
		echo $msg;
		echo '</pre></div> ';	
		exit;	
	}

}