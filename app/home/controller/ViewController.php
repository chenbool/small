<?php
use frame\vendor\Request;
use frame\vendor\Controller;

class ViewController extends Controller{

	public function index(){
        // $this->display();
        $this->display('',[
        	'name'	=>	'bool',
        ]);
	}

}
