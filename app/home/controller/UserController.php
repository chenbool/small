<?php
use frame\vendor\Controller;

class UserController extends Controller
{
    public function add($id=1,$arg=2){
        dump($id);
        dump($arg);
        echo func_num_args();         //输出参数个数
        dump( $_GET );
    }
    
}
