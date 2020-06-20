<?php
require_once('../inc/autoload.php');

Session::getInstance();

if (isset($_POST['qty']) && isset($_POST['id'])) {
	
	$out = array();
	$id = $_POST['id'];
	$val = $_POST['qty'];
	
	$objCatalogue = new Catalogue();
	$product = $objCatalogue->displayProduct($id);
	$product = get_object_vars($product);	

	
	if (!empty($product)) {
		
		switch($val) {
			case 0:
			Session::removeItem($id);
			break;
			default:
			Session::setItem($id, $val);
		}
		
	}
	
}