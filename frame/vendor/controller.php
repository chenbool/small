<?php
namespace frame\vendor;
use frame\vendor\view;

class Controller
{
	
	function __construct(){}

	// 模版分配
	public function display($tpl=null,$temp=[]){
		View::fetch($tpl,$temp);		
	}	
	
	public function view($tpl=null,$temp=[]){
		View::view($tpl,$temp);		
	}	

	// 返回ajax
	public function returnAjax($res){
		return die( json_encode($res) );		
	}

}