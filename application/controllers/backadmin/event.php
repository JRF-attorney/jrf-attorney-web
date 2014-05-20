<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends MY_ADMIN_Controller {

	public function index(){
		session_write_close();
		
		$this->load->model("eventModel");
		$cases = $this->eventModel->get_cases(1,1000);
		
		$this->load->view('admin/event/index',Array(
			"selector" => "intro",
			"pageTitle" => "案件管理系統",
			"cases" => $cases
		));
	}

	public function new_(){
		session_write_close();
		
		$this->load->view('admin/event/new',Array(
				"selector" => "intro",
				"pageTitle" => "新增案件-案件管理系統",
				"data" => new FormObject()
		));
	}
	
	public function create(){
		session_write_close();
		$this->load->model("eventModel");
		
		$fields = Array("name","phone","reason","belongto","phone","location","address");
		

		$data = Array();
		foreach($fields as $key){
			if(!isset($_POST[$key])){
				return $this->return_error(API_ERROR_PARAMETER_INVALID, "Expected parameter [".h($key)."] but missed.");
			}
			$data[$key] = $_POST[$key];
		}

		$data["createDate"] = time() * 1000.0;
		$data["status"] = "新建立";

		$this->eventModel->insert($data);
		//name,phone,reason,location,address,latlng,
		//belongto,status,lawyer,assume_time,result
		
	}
}
