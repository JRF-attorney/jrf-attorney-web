<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 */
class LawyerModel extends MONGO_MODEL {
	var $_collection = "lawyers";
	function __construct()
	{
		parent::__construct();
	}
	
	//Fields:姓名、電話、可陪偵區域、律師證號（等等等，待司改會提供完整資料）
	// name,phone,areas,identify,email,auth:{type,uid}
	// 
	
	
	public function insert($data = null){
		if($data == null){
			return false;
		}
		$data["createDate"] = time() *1000.0;
		$this->mongo_db->insert($this->_collection,$data);

		return true;
	}
	
	public function find_valid_user($account,$pwd){
		$users= $this->mongo_db->where(Array("enabled" => true,"account"=> $account,"password" => sha1($pwd)))->get($this->_collection);
		
		if(count($users) == 0 || count($users) > 1){
			return null;
		}
		return $users[0];
		
	}

}
