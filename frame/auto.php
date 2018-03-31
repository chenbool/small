<?php
namespace frame;
/**
 * 自动加载
 */
final class auto
{   
    // private $auto;
    function __construct(){
        $this->_auto( ['frame/vendor'] );
        
        $config = require './config/auto.php';
        $this->_auto( $config );
    }


    /**
     * 加载配置
     * @param [type] $config
     * @return void
     */
    public function _auto($config){

        foreach ($config as $key => $dir) {
            $files=scandir($dir);
            unset($files[0]);
            unset($files[1]);

            // 载入
            $this->_load($dir,$files);
        }

    }


   /**
     * 加载
     * @param [type] $config
     * @return void
     */
    public function _load($path,$config){

        foreach ($config as $key => $file) {
            // 判断类型
            if( is_dir($path.'/'.$file) ){
                $this->_auto([$path.'/'.$file]);
            }elseif(is_file($path.'/'.$file)) {
                include $path.'/'.$file;
            }
            
        }
    }


}