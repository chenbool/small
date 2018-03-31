<?php
use frame\vendor\Request;
use frame\vendor\Controller;

class IndexController extends Controller{

	public function index(){
        // dump( session('uid') );
        // dump( cookie('name') );
		dump('这是 Controller 控制器 的 index 方法');
	}

	// http://localhost/small/index.php/Index/add-2-name
    public function add($id=1,$arg=2){
        //dump( Request::get('id') );
        dump($id);
        dump($arg);
        // echo func_num_args();         //输出参数个数
        // dump( $_GET['args'] );
    }

    public function db(){
        $model = new User();
        $res=$model->find(1);
        dump($res);
    }

}
