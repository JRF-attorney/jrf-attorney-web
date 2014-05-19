<?php use MongoQB\Builder;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  MY_Controller  extends  CI_Controller  {

	/**
	 * @var LawyerModel
	 */
	var $lawyerModel; //LawyerModel
	
	/**
	 * @var EventModel
	 */
	var $eventModel;//EventModel
	
	public function __construct(){
		parent::__construct();
		session_start();
	}

	protected function _init(){
		session_start();
	}

	protected function return_success_json ($obj = null){
		return $this->return_json(new ReturnMessage(true,0, null, $obj));
	}
	
	protected function return_error($code,$msg){
		return $this->return_json(new ReturnMessage(false,$code,$msg, null));
	}
	
	protected function return_json ($obj){
		echo json_encode($obj);
		return true;
	}
	
}

/**
 * 給後台用的核心 controller （負責登入驗證跟權限檢測）
 * @author TonyQ
 */

class  MY_ADMIN_Controller  extends  MY_Controller  {

	public function __construct(){

		parent::__construct();

		$this->_init();

		// do whatever here - i often use this method for authentication controller

	}

	protected function _init(){

		$global_data['pageScript'] = "";
		// 		$global_data['pageTitle'] = "";
		$global_data['selector'] = "";

		//		$global_data['isLogin'] = ($this->session->userdata('l_user') != null);

		//load into all views loaded by this controller
		$this->load->vars($global_data);

	}

	public function post($var){
		return _trim_strip_tags($this->input->post($var));
	}

	protected function _site_redirect($url){
		redirect(site_url($url), 'location', 302);
	}

	// 需要時再 implement
	// 	protected function send_mail($message,$subject,$to){
	// 		$this->load->library('email');
	// 		$this->email->from('', '');
	// 		$this->email->to($to);
	// 		$this->email->message($message);
	// 		$this->email->subject($subject);
	// 		$this->email->send();
	// 	}

	protected function is_empty(){

		$params = func_get_args();

		foreach ($params as $key => $item){
			if(trim($item) == "") {
				return true;
			}
		}
		return false;

	}

	/* routing / filter */

	public function _remap($method, $params = array())
	{
		if (!method_exists($this, $method))
		{
			show_404();
			return null;
		}

		if($method != "login" && $method != "logining" && $method !="oauth_cb"){
			if(!_isLogined()){
				$this->_site_redirect("backadmin/user/login/?from=".urlencode(_current_uri()));
				return null;
			}
		}else{
			if(_isLogined()){
				$this->_site_redirect("backadmin/");
				return null;
			}
		}
		return call_user_func_array(array($this, $method), $params);
	}

	/* helper */

	protected function do_login($user){
		$_SESSION['JRF_USER_ID'] = $user["account"];
		$_SESSION['JRF_LOGIN_STATUS'] = "LOGIN";

		$ip = get_ip();

		$_SESSION['JRF_IP'] = $ip;
		$_SESSION['JRF_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
		$_SESSION['JRF_LOGIN_DATE'] = time()*1000.0;

		// 		$this->AdminModel->insert_login_status($user["account"], $ip, $_SERVER['HTTP_USER_AGENT']);
	}

}

class  MY_API_Controller  extends  MY_Controller  {

	public function __construct(){
		parent::__construct();
	}

	protected function return_success_json ($obj = null){
		return $this->return_json(new ReturnMessage(true,0, null, $obj));
	}

	protected function return_error($code,$msg){
		return $this->return_json(new ReturnMessage(false,$code,$msg, null));
	}

	protected function return_json ($obj){
		header("Access-Control-Allow-Origin: *");
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($obj);
		return true;
	}
	
	public function _remap($method, $params = array())
	{
		if (!method_exists($this, $method))
		{
			show_404();
			return null;
		}
		//NOTE log here.
	
		if($method != "activate"){
// 			$token = $this->input->get("access_token");
// 			if(empty($token)){
// 				$token = $this->input->post("access_token");
// 			}
// 			if(empty($token)){
// 				return $this->return_json(new ReturnMessage(false,ERROR_ACCESS_TOKEN_INVALID,"access_token invalid", null));
// 			}
// 			$user = $this->GUserModel->find_user_by_token($token);
// 			if($user == null ){
// 				return $this->return_json(new ReturnMessage(false,ERROR_ACCESS_TOKEN_INVALID,"access_token invalid", null));
// 			}
	
// 			if($user["level"] < 2 ){
// 				return $this->return_json(new ReturnMessage(false,ERROR_PERMISSION_DENIED,"permission denied", null));
// 			}
// 			if($this->faction == 2){
// 				return $this->return_json(new ReturnMessage(false,ERROR_PERMISSION_DENIED,"permission denied", null));
// 			}
	
// 			$this->account = $user["account"];
// 			$this->token = $token;
// 			$this->faction = $user["faction"];
// 			$this->level = $user["level"];
		}
		return call_user_func_array(array($this, $method), $params);
	}
}

class ReturnMessage{
	var $isSuccess;
	var $errorCode;
	var $data;
	public function __construct($isSuccess,$errorCode,$errorMessage,$data){
		$this->isSuccess = $isSuccess;
		$this->errorCode = $errorCode;
		$this->errorMessage = $errorMessage;
		$this->data = $data;
	}
}
