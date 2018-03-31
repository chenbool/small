<?php
use frame\vendor\Model;
/**
* User
*/
class User extends Model{

	public $tableName = 'user'; 
	function __construct(){
		parent::__construct();
	}

	public function add(){
		$id = $this->database->insert($this->tableName, [    
			'name' => 'bool'.time(),  
		]);

		dump($id);
	}

	public function find($id){
		return $this->database->select('user','*');
	}

}