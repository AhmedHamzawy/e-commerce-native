<?php

class Rates extends Application{
	
	
	protected static $table_name = 'rates';
	protected static $db_fields = array('id', 'id_product' , 'ip' , 'rate' , 'dt_rated');
	public $id;
	public $id_product;
	public $ip;
	public $rate;
	public $dt_rated;
	
	
	
	public static function getRates() {
		
		
		return self::find_all(false,false);
		
	}
	
	
	public static function getRate($ip) {
		
		
		$database =  Dbase::getInstance();
		 
		 $sqli = "SELECT * FROM " . self::$table_name; 
		 $sqli .= " WHERE ip= '$ip'";
					
		 $result = self::find_by_sqli($sqli);
		 return $result;		
		
		
	}
	
	public static function getTotalRates($id) {
		
		
		$database =  Dbase::getInstance();
		 
		 $sqli = "SELECT * FROM " . self::$table_name; 
		 $safe_product_id = $database->escape_value($id);
		 $sqli .= " WHERE product_id= '$safe_product_id'";
					
		 $result = self::find_by_sqli($sqli);
		 return $result;
		
	}
	
	public function addRate($params = null) {
		
		
		if (!empty($params)) {
			$this->prepareInsert($params);
		 	return $this->save() ? true : false;
		}
		
		
	}
	
	public function updateRate($params = null, $id = null) {
		
            $database = Dbase::getInstance();
			
			if (!empty($params) && !empty($id)) {
			
				
				$sqli  = "UPDATE " . self::$table_name;
				$sqli .= " SET ";
				$sqli .= " rate = " . $database->escape_value($params['rate']);
				$sqli .= " WHERE ip = " . $database->escape_value($params['ip']);
				
				return $database->query($sqli) ? true : false;
			
		}	
		
	}
	
}


?>