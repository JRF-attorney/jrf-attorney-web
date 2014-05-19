<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_ADMIN_Controller {

	/**
	 *
	 * @var Google
	 */
	var $google;

	public function index(){
		$this->_site_redirect("backadmin/event/index");
	}
	/*-----------------------------*/


	public function logout(){
		session_destroy();
		$this->_site_redirect("backadmin/user/login");
	}

	public function login($status = "" ){
		$from = $this->input->get("from");
		$this->load->view("admin/login",
			Array(
				"selector" => "index",
				"pageTitle" => "後台登入",
				"status" => $status,
				"from"=>$from
			)
		);
	}

	public function oauth_cb(){
		$from = $this->input->get("state");
		$this->load->library("google");
		$user = $this->google->authenticate();
		if($user == null){
			$message = "Google 認證失敗，請再試一次或聯絡資訊團隊 。";
			$this->load->view("admin/login",
				Array(
					"selector" => "index",
					"pageTitle" => "後台登入",
					"status" => "error",
					"message" => "登入失敗,理由： ". $message ,
					"from" => $from
				)
			);
			return true;
		}
		
		$this->load->model("adminModel");
		//$user["email"] 
		if($this->adminModel->find_by_email($user["email"] ) == null && strpos($user["email"],"@jrf.org.tw") === FALSE){
			$message = "您的帳號沒有管理權限，請洽資訊團隊！";
			$this->load->view("admin/login",
				Array(
					"selector" => "index",
					"pageTitle" => "後台登入",
					"status" => "error",
					"message" => "登入失敗,理由： ". $message ,
					"from" => $from
				)
			);
			return true;
		}
		
		$this->do_login(Array( "account" => $user["email"] ));
		if($from != null){
			redirect(base_url($from));
		}else{
			$this->_site_redirect("backadmin/");
		}
	}


	public function logining(){
		$from = $this->input->post("from");
		$this->load->library("google");
		redirect($this->google->get_auth_url($from));
	}

}
