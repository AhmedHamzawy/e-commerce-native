<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.


class Application {
	
 public $in;
	
	
	

 public static function find_all($public = true,$priv = true) {

		$sqli = "SELECT * FROM " . static::$table_name ;
		if($public && $priv){
			$sqli .= " WHERE visible = 1";
		}
		if($priv){
		$sqli .= " ORDER BY position DESC";
		}
		$result = self::find_by_sqli($sqli);
		return $result;	
		
    }
	
	
	
	
	
	
	
    public static function find_by_id($id=0,$public = true,$priv=true) {
		
		
		$database =  Dbase::getInstance();
	
		$sqli = "SELECT * FROM " . static::$table_name ;
		$sqli .= " WHERE id= "   . $database->escape_value($id);
		if($public && $priv){
		$sqli .=" AND visible = 1"; 	
		}
		$sqli .=" LIMIT 1";
		$result_array = static::find_by_sqli($sqli);
		return !empty($result_array) ? array_shift($result_array) : false;
		
    }
  
  
  
  
  
  
    public static function find_by_sqli($sqli="") {
		
      $database =  Dbase::getInstance();

      $result_set = $database->query($sqli);
      $object_array = array();
      while ($row = $database->fetch_array($result_set)) {
         $object_array[] = static::instantiate($row);
      }
      return $object_array;
	  
     }
	 
	 
	 



	public static function count_all() {
		
	  $database =  Dbase::getInstance();
	  $sqli = "SELECT COUNT(*) FROM ".static::$table_name;
      $result_set = $database->query($sqli);
	  $row = $database->fetch_array($result_set);
      return array_shift($row);
	  
	}
	
	
	
	
	public function prepareInsert($array = null) {
		
		if (!empty($array)) {
			$this->in = $array;
			return $this->in;
			
		}
	}




	private static function instantiate($record) {
		
		// Could check that $record exists and is an array
	$className = get_called_class();	
    $object = new $className;
		// Simple, long-form approach:
		// $object->id 				= $record['id'];
		// $object->username 	= $record['username'];
		// $object->password 	= $record['password'];
		// $object->first_name = $record['first_name'];
		// $object->last_name 	= $record['last_name'];
		
		// More dynamic, short-form approach:
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
		
	}
	
	
	
	private function has_attribute($attribute) {
		
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $this->attributes());
	  
	}


	protected function attributes() { 
	
	  // return an array of attribute names and their values
	  $attributes = array();
	  
	  foreach(static::$db_fields as $field) {
	    if(property_exists($this, $field)) {
	      $attributes[$field] = $this->$field;
	    }
	  }
	  return $attributes;
	  
	}
	
	
	
	protected function sanitized_attributes() {
		
	  $database =  Dbase::getInstance();
	  $clean_attributes = array();
	  // sanitize the values before submitting
	  // Note: does not alter the actual value of each attribute
	  foreach($this->in as $key => $value){  
	    $clean_attributes[$key] = $database->escape_value($value);
	  }
	  return $clean_attributes;
	  
	}
	
	
	
	public function save() {
		
	  // A new record won't have an id yet.
	  return isset($this->id) ? $this->update() : $this->create();
	  
	}
	
	public function create() {
		
		$database =  Dbase::getInstance();
		// Don't forget your SQLI syntax and good habits:
		// - INSERT INTO table (key, key) VALUES ('value', 'value')
		// - single-quotes around all values
		// - escape all values to prevent SQLI injection
		$attributes = $this->sanitized_attributes();
	    $sqli = "INSERT INTO ".static::$table_name." (";
		$sqli .= join(", ", array_keys($attributes));
	    $sqli .= ") VALUES ('";
		$sqli .= join("', '", array_values($attributes));
		$sqli .= "')";
	  	$database->query($sqli);
	    return $this->id = $database->insert_id();
	
	}
	

	public function update() {
		
	  $database =  Dbase::getInstance();
		// Don't forget your SQLI syntax and good habits:
		// - UPDATE table SET key='value', key='value' WHERE condition
		// - single-quotes around all values
		// - escape all values to prevent SQLI injection
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sqli = "UPDATE ".static::$table_name." SET ";
		$sqli .= join(", ", $attribute_pairs);
		$sqli .= " WHERE id=". $database->escape_value($this->id);
	  return $database->query($sqli) ? true : false;
	  // maybe you can write 
	  //return ($database->affected_rows() >= 0) ? true : false;
	  
	}

	public function delete() {
		
		$database =  Dbase::getInstance();
		// Don't forget your SQLI syntax and good habits:
		// - DELETE FROM table WHERE condition LIMIT 1
		// - escape all values to prevent SQLI injection
		// - use LIMIT 1
		$sqli = "DELETE FROM ".static::$table_name;
		$sqli .= " WHERE id=". $database->escape_value($this->id);
		$sqli .= " LIMIT 1";
		$database->query($sqli);
		return ($database->affected_rows() == 1) ? true : false;
		
		// NB: After deleting, the instance of User still 
		// exists, even though the database entry does not.
		// This can be useful, as in:
		//   echo $user->first_name . " was deleted";
		// but, for example, we can't call $user->update() 
		// after calling $user->delete().
    }
	

}

	
