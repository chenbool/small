<?php
namespace frame\vendor;

final class Route
{
    function __construct(){
        $this->dispatch();
    }

	// 处理路由
	private function dispatch(){
        $this->is_pathinfo();
        
        
    }    

    public function is_pathinfo(){

    	// 检测路由PATH_INFO
    	if( !isset($_SERVER['PATH_INFO']) ){
    		$_SERVER['PATH_INFO'] = '/Index/index';
    	}

    	// 检测路由缓存
    	// if( isset($_SESSION['route'][$_SERVER['PATH_INFO']]) ){
    	// 	$route = $_SESSION['route'][$_SERVER['PATH_INFO']];
    	// 	if( isset($_GET['args']) ){
    	// 		$_GET['args'] = $route[3];
    	// 	}else{
    	// 		$_GET['args'] = [];
    	// 	}
    		
    	// 	$this->_load($route[0],$route[1],$route[2]);
    	// 	exit;
    	// }


		// 判断是否有 path_info
		if(  !isset( $_SERVER['PATH_INFO'] )  ){
			$module = defined('BIND_MODULE') ? BIND_MODULE : 'home';
			$controller="index";
			$action='index';
		}else{
			// 获取path_info
			$pathInfo=trim( $_SERVER['PATH_INFO'] ,'/');	

			// 拆分url
			$route = explode('/',$pathInfo); 
            
			// 检测用户是否绑定模块
			if( defined('BIND_MODULE') ){
				$module =  BIND_MODULE;
				$controller=$route[0];
				unset($route[0]);
			}else{
				$module=$route[0];
				unset($route[0]);
				$controller=$route[1];
				unset($route[1]);			
			}

			// 过滤完的参数
			$arg=array_values($route);
            if( empty($arg[0]) ){
            	$arg[0] = 'index';
            }

            // 设置
            $config = $GLOBALS['config'];

			// 去除url后缀
			if( isset($config['URL_HTML_SUFFIX']) ){
				$args=str_replace('.'.$config['URL_HTML_SUFFIX'],"",$arg[0]);
			}

            // 判断是否设置了参数分隔符
			if( isset($config['URL_ARG_DEPR']) ){
				$args = explode($config['URL_ARG_DEPR'],$args); 
			}

            // 控制器方法
            $action = $args[0];
            unset($args[0]);

            // 参数存到get
            $_GET['args'] = array_values($args);
        }

        
        // $this->cache($module,$controller,$action,$_GET['args']);

        $this->_load($module,$controller,$action);
    }



	// 加载控制器
	private function _load($module,$controller,$action){

		define('CONTROLLER_NAME', ucfirst($controller));
		
		// 控制器首字母大写
		$controller=ucfirst($controller).'Controller';
		//收字母小写 
		$action=lcfirst($action);

		define('__MODULE__', $module);
		define('__ACTION__', $action);
		define('__CONTROLLER__', $controller);
		
		//载入配置文件
		$conf=Loader::_load(__APP__.'/'.$module.'/config.php');
		$GLOBALS['config'] = array_merge($conf,$GLOBALS['config']);


		//载入路径
		$path = __APP__.'/'.$module.'/controller/'.$controller.'.php';

		// 判断控制器是否存在
		if( is_file($path) ){
			require  $path;		
			$controller=new $controller();

			// 验证方法是否存在
			$methods = get_class_methods($controller);
			if( in_array($action, $methods) ){
                call_user_func_array(array($controller, $action), $_GET['args']);
			}else{
				Exception::error($action.'方法不存在!<br>',$path);
			}
			
		}else{
			Exception::error($controller.'控制器不存在!<br>',$path);
		}

	}


	// 缓存
	public function cache($module,$controller,$action,$args){
        if( !isset($_SERVER['PATH_INFO']) ){
        	$_SERVER['PATH_INFO']='/Index/index';
        }
        // $_SESSION['route'][$_SERVER['PATH_INFO']] = $module.'/'.$controller.'/'.$action;
        $_SESSION['route'][$_SERVER['PATH_INFO']] = [$module,$controller,$action,$args];
	}


}
