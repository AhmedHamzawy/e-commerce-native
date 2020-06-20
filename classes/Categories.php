<?php

class Categories extends Application{
	
	
	protected static $table_name = 'categories';
	protected static $db_fields = array('id', 'name' , 'position' , 'visible');
	public $id;
	public $name;
	public $position;
	public $visible;
	
	
	
	public static function getCategories() {
		
		
		return self::find_all(false,false);
		
	}
	
	
	public static function getCategory($id) {
		
		
		return self::find_by_id($id,true,false);
		
		
	}
	
	public function addCategory($params = null) {
		
		
		if (!empty($params)) {
			$this->prepareInsert($params);
		 	return $this->save() ? true : false;
		}
		
		
	}
	
	public function updateCategory($params = null, $id = null) {
		
		
			if (!empty($params) && !empty($id)) {
			
				$this->id = $params['id'] = $id;
				
				$this->prepareInsert($params);
				return $this->save() ? true : false;
			
		}	
		
	}
	

	public function duplicateCategory($name = null, $id = null) {
		
		$database = Dbase::getInstance();
		if (!empty($name)) {
			$sqli  = "SELECT * FROM " . self::$table_name . 
					 " WHERE `name` = '".$database->escape_value($name)."'";
			$sqli .= !empty($id) ? 
					" AND `id` != '".$database->escape_value($id)."'" : 
					null;
			return self::find_by_sqli($sqli);
		}
		return false;
		
		
	}
	
	
	public function removeCategory($id = null) {
		
		$this->id  = $id;
		$this->delete();
		
	}
	
}


?>