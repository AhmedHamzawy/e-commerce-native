<?php
class Country extends Application {

	protected static $table_name = 'countries';
	protected static $db_fields = array('id','name','code');
	public  $id;
	public  $name;
	public  $code;
	
	public function getCountries() {
		
		return self::find_all(false,false);
		
	}
	
	
	
	
	
	
	
	public function getCountry($id = null) {
		
	    return self::find_by_id($id,false,false);
		
	}



}