<?php
namespace frame\vendor;
use Medoo\Medoo;

/**
* 模型
*/
class Model{

	public $database;
	public $tableName;
	function __construct(){

		$config = $GLOBALS['database'];

		$this->database = new medoo([
		    // 必须配置项
		    'database_type' => $config['database_type'],
		    'database_name' => $config['database_name'],
		    'server' 		=> $config['server'],
		    'username'		=> $config['username'],
		    'password' 		=> $config['password'],
		    'charset' 		=> $config['charset'],
		 
		    // 可选参数
		    'port' 			=> $config['port'],
		    'prefix' 		=> $config['prefix'],
		 
		    // 连接参数扩展, 更多参考 http://www.php.net/manual/en/pdo.setattribute.php
		    'option' 		=> [
		        \PDO::ATTR_CASE => \PDO::CASE_NATURAL
		    ]
		]);
	}


}