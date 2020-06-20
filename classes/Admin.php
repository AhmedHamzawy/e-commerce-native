<?php
class Admin extends User {

	protected static $table_name="admins";
	protected static $db_fields = array('id', 'first_name', 'last_name' , 'email' ,'password');
	
	public $id;
	public $first_name;
	public $last_name;
	public $email;
	public $password;
	
	
	
	
	
	
	public function getAdmins($srch = null) {
			return $this->getUsers($srch);
	}
	
	
	
}