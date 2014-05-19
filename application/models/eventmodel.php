<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 */
class EventModel extends MONGO_MODEL {
	var $_collection = "events";
	function __construct()
	{
		parent::__construct();
	}
	
	
	function get_cases($page = 1,$pageSize = 100){
		return $this->mongo_db->limit($pageSize)->offset(($page-1) * $pageSize )
			->get($this->_collection);
		
	}
	
// 	姓名
// 	電話
// 	逮捕原因（案由）
// 	陪偵地點：地名(通常都是派出所)、地址、map
// 	陪偵地點區域（縣市，因為律師需要註冊該縣市律師才能執業，所以區域很重要）（至少 UI 中由陪偵地點自動推出）
// 	案件狀態（依照 新收案、已確認陪偵、陪偵中、已結束、取消）
// 	接案律師（資料庫中允許多位，但 UI 先最多顯示一位）
// 	到達時間
// 	陪偵結果紀錄

	//name,phone,reason,location,address,latlng,
	//belongto,status,lawyer,assume_time,result
}
