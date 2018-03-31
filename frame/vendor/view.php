<?php
namespace frame\vendor;
use frame\vendor\Exception;
/**
* 视图类
*/
final class View
{

	function __construct(){}
	
	/**
	 * [fetch 分配模板]
	 * @return [type] [description]
	 */
	public static function fetch($tpl=null,$arg=[]){
		//模板后缀
		$ext=isset($GLOBALS['config']['TPL_TEMPLATE_SUFFIX']) ? $GLOBALS['config']['TPL_TEMPLATE_SUFFIX'] : '.tpl';
		
		// 目录分割符
		$depr=isset($GLOBALS['config']['TPL_FILE_DEPR']) ? $GLOBALS['config']['TPL_FILE_DEPR'] : '/';

		// 当前模版
		if( empty($tpl) ){
			$tpl=__ACTION__;
		}

		// 分配变量
		if( !is_null($arg) && !empty($arg) ){
			error_reporting(0);
			extract( $arg);
		}
		
		// 主题
		$theme = isset($GLOBALS['config']['TPL_THEME']) ? $GLOBALS['config']['TPL_THEME'].'/' :'';
		$viewPath = isset($GLOBALS['config']['VIEW_PATH']) ? $GLOBALS['config']['VIEW_PATH'] :'';

		// 判断是否设置模板路径
		if( empty( $viewPath ) ){
			$path = __APP__.'/'.__MODULE__.'/view/'.$theme.lcfirst(CONTROLLER_NAME).$depr.$tpl.$ext;
		}else{
			$path = __ROOT__.'/'.$viewPath.$theme.lcfirst(CONTROLLER_NAME).$depr.$tpl.$ext;
		}

		//检测模板是否存在
		file_exists($path) || Exception::error($tpl.'模板不存在!<br>',$path);

		//引入视图
		include $path;
	}

	//页面静态化
	public static function view($tpl=null,$temp=[]){	
		//php并发锁
		$fp = fopen(__ROOT__.'/.lock', 'r');
		flock($fp, LOCK_EX);

		// 当前模版
		if( empty($tpl) || is_null($tpl) ){
			$tplPath=__MODULE__.'/'.CONTROLLER_NAME.'-'.__ACTION__.'.html';
		}

		//缓存路径
		$rootPath = isset($GLOBALS['config']['CACHE_PATH']) ? $GLOBALS['config']['CACHE_PATH'] :'cache/';
		$Path = __ROOT__.'/'.$rootPath.'html/'.$tplPath;		

		//只有开启 DEBUG\CACHE_HTML 才会缓存html页面
		$GLOBALS['config']['DEBUG'] = isset($GLOBALS['config']['DEBUG']) ? $GLOBALS['config']['DEBUG'] :false;
		$GLOBALS['config']['CACHE_HTML'] = isset($GLOBALS['config']['CACHE_HTML']) ? $GLOBALS['config']['CACHE_HTML'] :false;
		$GLOBALS['config']['DEBUG'] || die( include($Path) );

		if( !$GLOBALS['config']['CACHE_HTML'] ){
			file_exists($Path) ? die( include($Path) ) : self::fetch($tpl=null,$temp);
		}else{
			ob_start();
			self::fetch($tpl=null,$temp);
			$content = ob_get_contents();
			file_put_contents($Path, $content);
			ob_clean();	
			include $Path;					
		}
		fclose($fp);

	}


}