<?php
namespace frame\vendor;

final class Loader
{
    public static function _load($file){
    	if( is_file($file) ){
    		return include $file;
    	}else{
    		return $GLOBALS['config'];
    	}  
    }

	/**
	 * [_init 加载配置目录下文件]
	 * @return [type]         [description]
	 */
	public static function _init(){
		$conf=self::_load('config/config.php');
		$GLOBALS['config'] = $conf;

		$database=self::_load('config/database.php');
		$GLOBALS['database'] = $database;

		session_start();	
	}

	
}
