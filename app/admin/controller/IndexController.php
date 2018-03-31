<?php
use frame\vendor\Controller;

class IndexController extends Controller{

	public function index(){
		// dump('这是后台 Controller 控制器 的 index 方法');
		// dump( $GLOBALS['config'] );
        $this->view('',[
            'name'  =>  'bool',
        ]);
	}



}
