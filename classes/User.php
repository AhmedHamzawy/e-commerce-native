<?php
class User extends Application {
	
	
	public function authenticate($email = null, $password = null) {
	
		$database =  Dbase::getInstance();
			
		if (!empty($email) && !empty($password)) {
			
			$email = $database->escape_value($email);
			$password = $database->escape_value($password);
			$sqli  = "SELECT * FROM " . static::$table_name ;
			$sqli .= " WHERE email = '{$email}' ";
			if(static::$table_name == 'clients'){
			$sqli .= " AND `active` = 1 ";
			}
			$sqli .= " LIMIT 1";
			$result_array = static::find_by_sqli($sqli,false,false);
			if(!empty($result_array)) { 
			$email = array_shift($result_array);
			return Login::password_check($password , $email->password) ? $email : false ;
			}
			
		}
	 
	}
	
	public function getUsers($srch = null) {
		$database = Dbase::getInstance();
		$sqli = "SELECT * FROM" . static::$table_name .
				" WHERE `active` = 1";
		if (!empty($srch)) {
			$srch = $database->escape_value($srch);
			$sqli .= " AND (`first_name` LIKE '%{$srch}%' || `last_name` LIKE '%{$srch}%')";
		}
		$sqli .= " ORDER BY `last_name`, `first_name` ASC";
		return self::find_all($sqli,false,false);
	}
	
	public function getUser($id = null) {
		
		return self::find_by_id($id,false,false);
		
	}
	
	public function getByEmail($email = null , $active = true) {
		
		$database =  Dbase::getInstance();
		$safe_email = $database->escape_value($email);
		
		if (!empty($safe_email)) {
			$sqli  = "SELECT `id` FROM " .static::$table_name."";
			$sqli .= " WHERE `email` = '".$safe_email."'";
		if($active){			
			$sqli .= " AND `active` = 1";
		}
			return $result = self::find_by_sqli($sqli);
		}
	}
	
	
	public function addUser($params = null, $password = null) {
		if (!empty($params)) {
			$this->prepareInsert($params);
			return $this->save() ? true : false;
		}
	}
	
	
	
	public function updateUser($array = null, $id = null) {
		
		$this->id = $array['id'] = $id;
		$this->prepareInsert($array);
		return $this->save() ? true : false;
	}
	
	
	
	
	public function removeUser($id = null) {
		
		$this->id = $id;
		$this->delete();
		
	}
	
	
	
	
	
	

	
}