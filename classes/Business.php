<?php
class Business extends Application {
	
	protected static $table_name = 'business';
	protected static $db_fields = array('id', 'name' , 'address' , 'telephone' , 'email' , 'website' , 'vat_rate');
	public $id;
	public $name;
	public $address;
	public $telephone;
	public $email;
	public $website;
	public $vat_rate;

	
	
	
	
	public function getBusiness() {
		
	    return self::find_by_id(1,true,false);
		
	}
	
	
	
	public function getVatRate() {
		
		$business = $this->getBusiness();
		return $business->vat_rate;
		
	}
	
	
	
	public function updateBusiness($vars = null) {
		
		if (!empty($vars)) {
			
			$this->id = 1;
			$this->prepareInsert($vars);
			return $this->save() ? true : false;
			
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

}