<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     swaggerVersion="1.2",
 *     resourcePath="/lawyer",
 *     basePath="http://localhost/jrf-attorney-web/index.php/api/lawyer/"
 *
 * )
*/
class Lawyer extends MY_API_Controller {

	/**
	 *
	 * @SWG\Api(
	 *   path="/register",
	 *   description="新律師註冊，通過後會拿到一個永久的 token (sid)。 ",
	 *   @SWG\Operation(
	 *   	method="POST", summary="",
	 *	   @SWG\Parameters(
	 *			@SWG\Parameter(
 *          	name="name",
 *           	description="律師名字（本名）",
 *           	paramType="form",
	 *           required=true,
	 *           type="string"
	 *         ),
	 *         @SWG\Parameter(
 *          	name="phone",
 *           	description="律師電話",
	 *           paramType="form",
	 *           required=true,
	 *           type="string"
	 *         ),
	 *         @SWG\Parameter(
 *          	name="areas",
 *           	description="可陪偵區域(json array),ex. ['基隆律師公會','台北律師公會'] ",
 *           	paramType="form",
	 *           required=true,
	 *           type="string"
	 *         ),
	 *         @SWG\Parameter(
 *          	name="identify",
 *           	description="律師證號",
 *           	paramType="form",
	 *           required=true,
	 *           type="string"
	 *         ),
	 *         @SWG\Parameter(
	 *          	name="email",
	 *           	description="Email",
	 *           	paramType="form",
	 *           required=true,
	 *           type="string"
	 *         ),
	 *         @SWG\Parameter(
	 *          	name="authType",
	 *           	description="登入資料（目前接受 'FB' 跟 'Google' 兩個值 ）",
	 *           	paramType="form",
	 *           required=true,
	 *           type="string"
	 *         ),
	 *         @SWG\Parameter(
	 *          	name="authToken",
	 *           	description="登入資料中 Google or Facebook 的 access token (由 android/iOS 預先認證好丟上來) ",
	 *           	paramType="form",
	 *           required=true,
	 *           type="string"
	 *         ),
	 *         @SWG\Parameter(
	 *          	name="line",
	 *           	description="line ID (選填)",
	 *           	paramType="form",
	 *           required=false,
	 *           type="string"
	 *         )
	 *      )
	 *   
	 *   )
	 * )
	 */
	public function register(){
		session_write_close();
		
		$this->load->model("lawyerModel");

		$fields = Array("name","phone","areas","email","identify","authType","authToken");

		$data = Array();
		foreach($fields as $key){
			if(!isset($_POST[$key])){
				return $this->return_error(API_ERROR_PARAMETER_INVALID, "Expected parameter [".$key."] but missed.");
			}
			$data[$key] = $_POST[$key];
		}
		
		if(isset($_POST["line"])){ //optional
			$data["line"] = $_POST["line"];
		}
		
		if($data["authType"] != "FB" && $data["authType"] == "Google"){
			return $this->return_error(API_ERROR_PARAMETER_INVALID, "authType should be 'FB' or 'Google'. ");
		}
		
		$auth = Array("type" => $data["authType"]);
		
		if($data["authType"] == "Google"){
			try{
				$result = file_get_contents("https://www.googleapis.com/oauth2/v1/userinfo?access_token=".$data["authToken"]);
				$ginfo = json_decode($result);
				
				$auth["uid"] = $ginfo->id;
				$auth["info"] = $ginfo;
				
			}catch(Exception $ex){
				return $this->return_error(API_ERROR_ACCESS_TOKEN_INVALID, "authToken auth failed");
			}
		}else if($data["authType"] == "FB"){
			try{
				
				$result = file_get_contents("https://graph.facebook.com/me?access_token=".$data["authToken"]);
				$fbinfo = json_decode($result);
			
				$auth["uid"] = $fbinfo->id;
				$auth["info"] = $fbinfo;
			
			}catch(Exception $ex){
				return $this->return_error(API_ERROR_ACCESS_TOKEN_INVALID, "authToken auth failed");
			}
		}
		unset($data["authType"]);
		unset($data["authToken"]);
		
		$data["auths"] = Array($auth);
		$access_token = uniqid("jrf",true);
		$data["access_tokens"] = Array($access_token);
		$data["enabled"] = false;
		$success = $this->lawyerModel->insert($data);
		
		if(!$success){
			return $this->return_error(API_ERROR_UNKNOWN,"unknow error when registering account");
		}
		return $this->return_success_json($access_token);
		
	}
	
	public function bind_device(){
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */