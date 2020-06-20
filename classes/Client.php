<?php
class Client extends User {
	
	protected static $table_name = "clients";
	protected static $db_fields = array('id','first_name','last_name','address_1','address_2','town','county','post_code',
		'country','email','password','date','active','hash');
	
	public $id;
	public $first_name;
	public $last_name;
	public $address_1;
	public $address_2;
	public $town;
	public $county;
	public $post_code;
	public $country;
	public $email;
	public $password;
	public $date;
	public $active;
	public $hash;
	
	

	public function getClients($srch = null) {
		return $this->getUsers($srch);
	}
	
	
	
	public function getClientByHash($hash = null) {
		
		$database = Dbase::getInstance();
		if (!empty($hash)) {
			$sqli  = "SELECT * FROM " . self::$table_name . 
			" WHERE `hash` = '".$database->escape_value($hash)."'";
			return  self::find_by_sqli($sqli);
		}
	}
	
	
	
	public function sendEmail($params){
		
			
			// send email
			$objEmail = new Email();
			if ($objEmail->process(1, array(
				'email'			=> $params['email'],
				'first_name'	=> $params['first_name'],
				'last_name'		=> $params['last_name'],
				'password'		=> $password,
				'hash'			=> $params['hash']
			))) {
				return true;
			}
			
			return false;
			
			
	}
	
	
	public function makeActive($id = null) {
		
		
		$database = Dbase::getInstance();
		if (!empty($id)) {
			$sqli = "UPDATE ". static::$table_name . 
			" SET `active` = 1 WHERE `id` = '".$database->escape_value($id)."'";
			return $database->query($sqli);
		}
		
		
	}
	
	
}