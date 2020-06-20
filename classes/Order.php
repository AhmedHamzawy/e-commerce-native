<?php
class Order extends Application {

	protected static $table_name = "orders";
	protected static $db_fields = array('id','client','vat_rate','vat','subtotal','total','date','status',
		'pp_status','txn_id','payment_status','ipn','response','notes');
		
	public $id;
	public $client;
	public $vat_rate;
	public $vat;
	public $subtotal;
	public $total;
	public $date;
	public $status;
	public $pp_status;
	public $txn_id;
	public $payment_status;
	public $ipn;
	public $response;
	public $notes;

	protected $_basket = array();
	
	protected $_fields = array();
	
	
	
	
	
	
	public function createOrder() {
		
		$objorderItems = new orderItems();
		$objorderItems->getItems();
		Session::getInstance();

		if (!empty($objorderItems->_items)) {
			
			$objClient = new Client();
			$Client = $objClient->getUser(Session::getSession(Login::$_login_front));
			
			if (!empty($Client)) {
			
				$objBasket = new Basket();
				
				
			    $this->_fields = array('client' => $Client->id ,
				'vat_rate' => $objBasket->_vat_rate , 'vat' => $objBasket->_vat ,
			    'subtotal' => $objBasket ->_sub_total , 'total' => $objBasket->_total , 'date' => Helper::setDate()); 
				$this->prepareInsert($this->_fields);
				
				$this->save(); echo $this->id;

				if (!empty($this->id)) {
					$this->_fields = array();
					return $objorderItems->addItems($this->id);
				}
				
			}
			
			return false;
			
		}
		
		return false;
	
	}
		
	
	

	
	public function getOrder($id = null) {
		
		$id = !empty($id) ? $id : $this->id;
		
		return self::find_by_id($id,false,false);
	
	}
	
	

	
	
	public function approve($array = null, $result = null) {
		  if (!empty($array) && !empty($result)) {
			if (
				array_key_exists('txn_id', $array) &&
				array_key_exists('payment_status', $array) &&
				array_key_exists('custom', $array)
			) {
				
					
				$active = $array['payment_status'] == 'Completed' ? 1 : 0;
				
				$out = array();
				
				foreach($array as $key => $value) {
					$out[] = "{$key} : {$value}";
				}
				
				$out = implode("\n", $out);
				
				$this->id = $array['custom'];
			    $this->_fields = array('pp_status' => $active ,
				'txn_id' => $array['txn_id'] , 'payment_status' => $array['payment_status'] ,
			    'ipn' => $out , 'response' => $result); 
				$this->prepareInsert($this->_fields);
				$this->save();
				}
	    	}			
		}
	
	
	
	
	public function getClientOrders($client_id = null) {
		$database = Dbase::getInstance();
		if (!empty($client_id)) {
			$sqli = "SELECT * FROM " . self::$table_name .
					" WHERE `client` = '".$database->escape_value($client_id)."'
					ORDER BY `date` DESC";
			return self::find_by_sqli($sqli);
		}
	}
	
	
	

	public function getOrders($srch = null) {
		$database = Dbase::getInstance();
		$sqli  = "SELECT * FROM " . self::$table_name;
		$sqli .= !empty($srch) ?
				" WHERE `id` = '".$database->escape_value($srch)."'" :
				null;
		$sqli .= " ORDER BY `date` DESC";
		return self::find_by_sqli($sqli);
	}
	
	
	
	
	
	
	public function updateOrder($id = null, $array = null) {
		
		if (!empty($id) && !empty($array) && is_array($array)
		 && array_key_exists('status', $array) && array_key_exists('notes', $array)) {
		 $this->id = $id;	 
		 $this->_fields = array('status' => $array['status'] , 'notes' => $array['notes']); 
		 $this->prepareInsert($this->_fields);
		 return $this->save() ? true : false; 
		}
		
	}
	
	
	

	
	public function removeOrder($id = null) {
		
		$this->id = $id; 
		$this->delete();
	}
	
	
	
	
	
}