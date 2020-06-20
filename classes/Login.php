<?php
class Login {

	public static $_login_page_front = G_PATH."?page=login";
	public static $_dashboard_front = G_PATH."?page=orders";
	public static $_login_front = "cid";
	
	public static $_login_page_admin = "../admin/";
	public static $_dashboard_admin = "../../admin/?page=products";
	public static $_login_admin = "aid";
	
	public static $_valid_login = "valid";
	
	public static $_referrer = "refer";
	
	
	public static function password_encrypt($password){
	$hash_format = "$2y$10$"; // tell PHP to use  blowfish with a 'cost' of 10 
    $salt_length = 22;  // Blowfish salts should be 22 chars or more
	$salt = self::generate_salt($salt_length);
	$format_and_salt = $hash_format . $salt ;
	$hash = crypt($password , $format_and_salt);
	return $hash;	
	}
	
	
	
	
	public static function generate_salt($length){
		// not 100% unique not 100% random , but good enough for a salt
		// MD5 returns 32 chars
		$unique_random_string = md5(uniqid(mt_rand(),true));
		// valid chars for a salt are [a-zA-z0-9./]
		$base64_string = base64_encode($unique_random_string);
		// but not '+' which is valid in base64 encoding
		$modified_base64_string = str_replace('+' , '.' , $base64_string);
		// truncate string to the correct length
		$salt = substr($modified_base64_string , 0 , $length);
		return $salt;  
	}
	
	
	
	public static function password_check($password , $existing_hash){
		// Existing hash contains format and salt at start
		$hash = crypt($password , $existing_hash);
		if($hash == $existing_hash){
		 return true;	
		}else{
			return false;
		}
	}
	
	
	
	
	
	
	
	public static function getFullNameFront($id = null) {
		if (!empty($id)) {
			$objUser = new User();
			$user = $objUser->getUser($id);
			if (!empty($user)) {
				return $user['first_name']." ".$user['last_name'];
			}
		}
	}
	
	
	
	
	
	
	
	
	
	
	public static function logout($case = null) {
		if (!empty($case)) {
			$_SESSION[$case] = null;
			$_SESSION[self::$_valid_login] = null;
			unset($_SESSION[$case]);
			unset($_SESSION[self::$_valid_login]);
		} else {
			session_destroy();
		}
	}
	
	
	
	
	
	
	
	
	


}