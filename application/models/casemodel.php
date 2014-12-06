<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 */
class CaseModel extends MONGO_MODEL {
	var $_collection = "cases";
	var $_collection_laywer = "lawyers";
	
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
	
	public function find_cases(){
		$cases = $this->mongo_db->get($this->_collection);
		$cases = $this->convertIDs($cases);
		
		foreach($cases as &$case){
			//$case->attorney
			//die(var_dump($case));
			if($case["attorney"] == null){
				$case["attorney"] = null;
				continue;
			}
			
			$laywers = $this->convertIDs($this->mongo_db
				->where(Array("_id" => new MongoId($case["attorney"])))
				->select(Array("_id","status","name"))
				->get($this->_collection_laywer));
			
			if(count($laywers) > 0 ){
				$case["attorney"] = $laywers[0]; 
			}else{
				$case["attorney"] = null;
			}
		}
		
		return $cases;
	}
	
	public function find_case($id ){
		
		$cases = $this->mongo_db
			->where(Array("_id" => new MongoId($id)))
			->get($this->_collection);
		
		$cases = $this->convertIDs($cases);
	
		foreach($cases as &$case){
			//$case->attorney
			//die(var_dump($case));
			if($case["attorney"] == null){
				$case["attorney"] = null;
				continue;
			}
				
			$laywers = $this->convertIDs($this->mongo_db
					->where(Array("_id" => new MongoId($case["attorney"])))
					->select(Array("_id","status","name"))
					->get($this->_collection_laywer));
				
			if(count($laywers) > 0 ){
				$case["attorney"] = $laywers[0];
			}else{
				$case["attorney"] = null;
			}
		}
	
		return count($cases) > 0 ? $cases[0] : null;
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
