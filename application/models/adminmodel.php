<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class AdminModel extends MONGO_MODEL {
	
	var $_collection = "admin";
	
	function __construct()
	{
		parent::__construct();
	}
	
	function find_by_email($email){

		$items = $this->mongo_db->where("_id",$email)->limit(1)->get($this->_collection);
		if(count($items) == 0){
			return null;
		}
		
		return $items[0];
		
	}

}
