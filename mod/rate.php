<?php
require_once('../inc/autoload.php');

// adding form validation

$objForm = new Form();
$objValid = new Validation($objForm);
$objRates = new Rates();

if ($objForm->isPost('rate')) {
	
if($objForm->isPost('act')){
	
		//search if the user(ip) has already gave a note
		$ip = $_SERVER["REMOTE_ADDR"];
		$ip ==  "::1" ? $ip = chr(127) . chr(0) . chr(0) . chr(1) : $ip = $_SERVER["REMOTE_ADDR"];
		
		$objValid->_expected = array(
		'rate',
		'product_id'
		);
		$objValid->_required = array(
		'rate',
		'product_id'
		);
	
    	if(Rates::getRate($ip)){
    		if ($objValid->isValid()) {
				 $objValid->_post['ip'] = inet_ntop($ip);
				    	var_dump($objValid->_post);
				if ($objRates->updateRate($objValid->_post , 8)) { } else {  var_dump('error');}
			}
    	}else{
			if ($objValid->isValid()) {
								 $objValid->_post['ip'] = inet_ntop($ip);
								    	var_dump($objValid->_post);
				if ($objRates->addRate($objValid->_post)) { }
			}
    	}
    } 
}
	
?>