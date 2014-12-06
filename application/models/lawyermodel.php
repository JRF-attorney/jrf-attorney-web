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
	// name,phone,areas,identify,email,auth:{type,uid,identify}
	// 
	
	
	public function insert($datas = null){
		if($datas == null){
			return false;
		}
		$datas["status"] = 0;
		$datas["createDate"] = time() *1000.0;
		$this->mongo_db->insert($this->_collection,$datas);

		return true;
	}
	
	public function find_laywers($status = null){

		//$users = $this->mongo_db->where()->get($this->_collection);
		if($status == null){
			$users = $this->mongo_db->get($this->_collection);
		}else{
			$users = $this->mongo_db->where(Array("status" => $status))->get($this->_collection);
		}

		$users = $this->convertIDs($users);
		
		return $users;
		
	}

	public function find_laywer($id){
	
		//$users = $this->mongo_db->where()->get($this->_collection);
		$users = $this->convertIDs($this->mongo_db->where(Array("_id" => new MongoId($id)))->get($this->_collection));

		if(count($users) == 0 || count($users) > 1){
			return null;
		}
		return $users[0];
	
	}
	

	private function convertIDs($datas){
		foreach ($datas as &$user){
			$field = "\$id";
			$user["id"] = $user["_id"]->$field;
			unset($user["_id"]);
		}
		return $datas;
	}
}
