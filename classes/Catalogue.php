<?php
class Catalogue extends Application {
	
	

	public function displayProducts($srch){
		return Products::getAllProducts($srch);
	}
	
	
	
	public function displayCategories(){
		return Categories::getCategories();
	}
	
	
	
	public function displayProduct($id){
		return Products::getProduct($id);
	}
	
	
	
	public function displayCategory($cat){
		return Categories::getCategory($cat);
		
	}
	
	
	public function displayProductsPublic($cat){
		return Products::getProducts($cat);
	}
	
	
}
?>