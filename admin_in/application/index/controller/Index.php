<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
        return '222';
    }

    public function login(){
    	header('Access-Control-Allow-Origin:*');  
		header('Access-Control-Allow-Methods:POST');  
		header('Access-Control-Allow-Headers:x-requested-with,content-type');

    	
    	if ($_POST) {
    		$where = array();
    		if(!empty($_POST['admin_login'])){
    			$where['admin_login'] = $_POST['admin_login'];
    		};
    		$order_info = db('admin')->where($where)->find();
    		if ($order_info['admin_password']==md5($_POST['admin_password'])) {

    			$update_data['admin_last_time'] = time();
    			// $update_data['admin_last_ip']   = 
    			$update_admin = db('admin')->where('admin_id='.$order_info['admin_id'])->update($update_data);
    			if ($update_admin) {
    				$data['token']  = $this->login_token($order_info['admin_id'],$order_info['admin_username'],$order_info['admin_login']);
					$data['status'] = '200';
					$data['codes']  = 'successfully';
					return json_encode($data);
    			}else{
    				$data['status'] = '500';
    				$data['codes']  = 'Network error';
    				return json_encode($data);
    			}
    		}else{
    			$data['status'] = '500';
				$data['codes']  = 'username or password false';
				return json_encode($data);
    		}
    	}else{
    		$data['status'] = '500';
    		$data['codes']  = "illegal access";
    		return json_encode($data);
    	}
    }


    protected function login_token($admin_id,$admin_username='无名人',$admin_login=''){
    	$admin_id               = intval($admin_id);
    	$admin_login            = trim($admin_login);
    	$data['admin_id']       = $admin_id;
    	$data['admin_username'] = $admin_username;
    	$data['token']          = md5($admin_login.time());
    	$data['login_time']     = time();
    	$add_token = db('admin_token')->insert($data);
    	if ($add_token) {
    	 	return $data['token'];
    	}else{
    		return 'Network error';
    	} 
    }



}
