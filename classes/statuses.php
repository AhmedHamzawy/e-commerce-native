<?php

class Statuses extends Order{

	protected static $table_name = "statuses";
	protected static $db_fields = array('id','name');
	
	public $id;
	public $name;
		

	public function getStatus($id = null) {
		
		if (!empty($id)) {
			return  self::find_by_id($id,false,false);
		}
	}
    
    
    public function getStatuses() {
		
		return  self::find_all(false,false);
		
	}
}
?>