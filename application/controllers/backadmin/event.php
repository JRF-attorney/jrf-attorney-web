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

}
