# small
自己写的一个小型的mvc框架

## 路由

http://localhost/small/index.php/控制器/方法-参数1-参数2-参数3...

http://localhost/small/index.php/Index/add-1-bool

## 控制器接受参数


      public function add($id=1,$arg=2){
          dump($id);
          dump($arg);
          echo func_num_args();         //输出参数个数
          dump( $_GET );
      }



## 打印

      dump()
      
      dd()


## 数据库

	use Medoo\Medoo;
	
    // 初始化配置
    $database = new Medoo([
        'database_type' => 'mysql',
        'database_name' => 'dazuoye',
        'server'        => 'localhost',
        'username'      => 'root',
        'password'      => 'root',
        'charset'       => 'utf8',
        'prefix'        =>  ''
    ]);

    $row=$database->select('user','*');

    dump($row);


## 视图


        $this->display();
        $this->view();  //只有view可以静态化页面
        view::fetch();
        $this->display('',[
          'name'  =>  'bool',
        ]);




## 验证码
  
	  frame\library\Captcha;
	  
	  $code = new Captcha();
	  $code->CreateImg();
	  $code = NULL;


## session


    session();
    session('uid');
    session('uid',1);


## cookie


    cookie();
    cookie('uid');
    cookie('uid',1);
    cookie('uid',1,1000);



## Request 请求


    use frame\vendor\Request;

    Request::get()
    Request::get('id')
    Request::post()
    Request::post('id')
    Request::file()
    Request::file('fileName')
  
  
## 配置

	return [
		'URL_HTML_SUFFIX'		=>	'html',			
		'URL_ARG_DEPR'			=>	'-',				//url参数分隔符
		'TPL_TEMPLATE_SUFFIX'		=>	'.tpl',				//视图模板后缀
		'TPL_FILE_DEPR'			=>	'/',				//视图分割图
		'DEBUG'				=>	true,				//开发调试模式
		'CACHE_PATH'			=>	'cache/',			//缓存路径
		'CACHE_HTML'			=>	true,				//是否开启html页面缓存
		// 'SESSION_TYPE'          	=> 'DB',				//session保存类型
		// 'TPL_THEME'			=>	'default',		//视图主题
		// 'VIEW_PATH'       		=>	'template/',	//模板路径
	];
