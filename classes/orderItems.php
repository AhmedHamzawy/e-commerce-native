<?php
class orderItems extends Order{ 
	
	protected static $table_name = "orders_items";
	protected static $db_fields = array('id','order','product','price','qty');
	public $id;
	public $order;
	public $product;
	public $price;
	public $qty;
	protected $_items = array();
	protected $order_id;	

	
	public function getItems() {
		
		Session::getInstance();
		$this->_basket = Session::getSession('basket');
		if (!empty($this->_basket)) {
			$objCatalogue = new Catalogue();
			foreach($this->_basket as $key => $value) {
				$this->_items[$key] = $objCatalogue->displayProduct($key);
			}
		}
			return $this->_items;
	}
		
	
	protected function addItems($order_id = null) {
		$database = Dbase::getInstance();
		if (!empty($order_id)) {
			$error = array();
			foreach($this->_items as $item) {
				$sqli = "INSERT INTO " .self::$table_name.
						"(`order`, `product`, `price`, `qty`)
						VALUES ('{$order_id}', '".$item->id."', '".$item->price."', '".$this->_basket[$item->id]['qty']."')";
				if (!$database->query($sqli)) {
					$error[] = $sqli;
				}
			}
			
			return empty($error) ? true : false;
			
		}
		return false;

		
	}
	
 
    public function getOrderItems($ordid = null) {
		
		$database =  Dbase::getInstance();
		 
		 $sqli = "SELECT * FROM " . self::$table_name; 
		 $safe_id = $database->escape_value($ordid);
		 $sqli .= " WHERE `order` = '$safe_id'";
		 $result = self::find_by_sqli($sqli,false,false);
		 return $result;
	}
}
?>