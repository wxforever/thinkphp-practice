<?php
namespace Home\Controller;
use Think\Controller;

class CrudController extends Controller {

public function query(){
	header("Access-Control-Allow-Origin: *");

// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
      if(IS_POST){
      	//获取查询表名和主键
      	   $tab=I('tab');
      	   $condition=I('condition');
      	   $Model = M($tab);
		   $res = $Model->where($condition)->find();
		   if($res){
		   		$this->ajaxReturn($res);
		   }else{
		   	header("HTTP/1.0 400 Bad Request");
		   	$this->ajaxReturn(array('query'=>"fail"));
		   }
		   
      }
		
}

public function select(){
	header("Access-Control-Allow-Origin: *");

// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
      if(IS_POST){
      	//选择固定数目符合条件的选项
      	   $tab=I('tab');
      	   $condition=I('condition');

      	   $limit=I('limit');
      	
      	   $Model = M($tab);
		   $res = $Model->where($condition)->limit($limit)->select();

		   if($res){
		   		$this->ajaxReturn($res);
		   }else{
		   	header("HTTP/1.0 400 Bad Request");
		   	$this->ajaxReturn(array('select'=>"fail"));
		   }
		   
      }
		
}

public function add(){
	header("Access-Control-Allow-Origin: *");

// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
	if(IS_POST){
		 $tab=I('tab');
		$Model = M($tab);
		$Model ->create();
		$flag = $Model ->add();
		if($flag){
			$this->ajaxReturn(array("add"=>"success","id"=>$flag));
		}else{
			header("HTTP/1.0 400 Bad Request");
			$this->ajaxReturn(array("add"=>"fail","id"=>$flag));
		}
	}
}

public function addAll(){//
	header("Access-Control-Allow-Origin: *");

// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
	if(IS_POST){
		 $tab=I('tab');
		$Model = M($tab);
		//var_dump(I('dataList'));
		$dataList=json_decode($_POST['dataList'],true);//转为数组,加true，不加true返回值为null

		//var_dump($dataList);
		$flag = $Model ->addAll($dataList);
		if($flag){
			$this->ajaxReturn(array("addall"=>"success","lastid"=>$flag));
		}else{
			header("HTTP/1.0 400 Bad Request");
			$this->ajaxReturn(array("addall"=>"fail","lastid"=>$flag));
		}
	}
}

public function modify(){
	header("Access-Control-Allow-Origin: *");

// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
	
	if(IS_POST){
		$tab=I('tab');
		$Model = M($tab);
		$Model ->create();
		$flag = $Model ->save();
		if($flag!==false){

			$this->ajaxReturn(array("modify"=>"success","affect"=>$flag));
		}else{
			header("HTTP/1.0 400 Bad Request");
			$this->ajaxReturn(array("modify"=>"fail","affect"=>$flag));
		}
	}
}

public function delete(){
	header("Access-Control-Allow-Origin: *");
	// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
	
	$tab=I('tab');
	$Model = M($tab);
	$id = I('id'); 
	$flag = $Model->where('id='.$id)->delete();
	if($flag){
			$this->ajaxReturn(array('delete'=>'success'));
		}else{
			header("HTTP/1.0 400 Bad Request");
			$this->ajaxReturn(array('delete'=>'fail'));
		}
}

public function count(){
	header("Access-Control-Allow-Origin: *");
	// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
	
	    if(IS_POST){
      	//选择固定数目符合条件的选项 //
      	   $tab=I('tab');
      	   $map=json_decode($_POST['condition'],true);//转为关联数组

      	   $limit=I('limit');
      	
      	   $Model = M($tab);
		   $res = $Model->where($map)->count();

		   if($res){
		   		$this->ajaxReturn($res);
		   }else{
		   
		   	header("HTTP/1.0 400 Bad Request");
		   	$this->ajaxReturn(array('count'=>"fail"));
		   }
		   
      }
}


	}