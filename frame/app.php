<?php
namespace frame;
use frame\vendor\Route;
use frame\vendor\Constant;
use frame\vendor\Loader;

final class app
{
    public static function run(){
        // 加载
        require 'auto.php';
        new auto();
        new Constant();
        Loader::_init();
        // 路由
        new Route();
    }

}
