<?php

class Products extends Application{
		
	protected static $table_name = 'products';
	protected static $db_fields = array('id', 'name', 'description', 'position' , 'visible' , 'price' ,'date', 'category' ,
	'image');
	public $id;
	public $name;
	public $description;
	public $position;
	public $visible;
	public $price;
	public $date;
	public $category;
	public $image;
    public $_path = 'media/catalogue/';
	public $_currency = '&pound;';
	
	
	
	public static function getProducts($cat , $public = true) {
	
		 $database =  Dbase::getInstance();
		 
		 $sqli = "SELECT * FROM " . self::$table_name; 
		 $safe_category = $database->escape_value($cat);
		 $sqli .= " WHERE category= '$safe_category'";
		 if($public){
		 $sqli .= " AND visible = 1 ";
		 } 
		 $sqli .= " ORDER BY position DESC";			
		 $result = self::find_by_sqli($sqli);
		 return $result;		
	}
	
	
	public static function getProduct($id) {
		
		return self::find_by_id($id,false,false);
	}
	

	public static function getAllProducts($srch = null) {
		
		$database = Dbase::getInstance();
		
		$sqli = "SELECT * FROM ". self::$table_name;
		if (!empty($srch)) {
			$srch = $database->escape_value($srch);
			$sqli .= " WHERE `name` LIKE '%{$srch}%' || `id` = '{$srch}'";
		}
		$sqli .= " ORDER BY `date` DESC";
		return self::find_by_sqli($sqli);
	}
	
	
	public function addProduct($params = null) {
		if (!empty($params)) {
			$params['date'] = Helper::setDate();
			$this->prepareInsert($params);
		 	return $this->save() ? true : false;
		}
	}
	
	
	
	
	
	
	
	public function updateProduct($params = null, $id = null) {
		if (!empty($params) && !empty($id)) {
			
			$this->id = $params['id'] = $id;
			
			$this->prepareInsert($params);
			return $this->save() ? true : false;
		}
	}
	
	
	
	
	
	
	
	
	public function removeProduct($id = null) {
		if (!empty($id)) {
			$product = $this->getProduct($id);
			if (!empty($product)) {
				if (is_file(CATALOGUE_PATH.DS.$product->image)) {
					unlink(CATALOGUE_PATH.DS.$product->image);
				}
				$this->id  = $id;
				$this->delete();
			}
			return false;
		}
		return false;
	}
	
	
	
	
	
	
	
	
	
	
}



?>