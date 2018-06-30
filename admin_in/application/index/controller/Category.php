<?php
namespace app\index\controller;

class Category
{
	//分类先到二级
    public function index()
    {
        return '222';
    }
    //显示全部
    public function category_show_all(){
    	header('Access-Control-Allow-Origin:*');  
		header('Access-Control-Allow-Methods:POST');  
		header('Access-Control-Allow-Headers:x-requested-with,content-type');





    }
    //显示单个
    public function category_show(){

    }
    //添加
    public function category_add_show(){
    	$data['category_article'] = db('category_article')->where("parent_id='0'")->select();
    	$data['rost_moble']       = db('rost_moble')->select();
    	return json_encode($data);
    }
    public function category_add_show(){
    	if ($_POST) {
    		

    		
    	}
    	return json_encode($data);
    }
    //删除
    public function category_del(){

    }
    //更改
    public function category_edit(){

    }

    //上传图片
    public function upload(){
    	header('Access-Control-Allow-Origin:*');  
		header('Access-Control-Allow-Methods:POST');  
		header('Access-Control-Allow-Headers:x-requested-with,content-type');
    	return '1';
    }


    



}
