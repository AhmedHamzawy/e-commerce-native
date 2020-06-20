<?php
class Session extends Application {
	

	// sessions for login
	// A class to help work with Sessions
	// In this case, primarily to manage logging users in and out
	
	// Keep in mind when working with sessions that it is generally 
	// inadvisable to store DB-related objects in sessions

	
	private $logged_in = false;
	public $client_id;
	public $client_name;
	public $admin_id;
	public $admin_name;
	public $message;
	public $errors;
	public static $session = null;

	function __construct() {
		
		if(!isset($_SESSION)){
			session_start();  
		}
		
		$this->check_login();
	}
	
	public function is_logged_in($case = null) {
		
		if (!empty($case)) {
			return isset($_SESSION[$case]) ? true : false;
		}
		
	}

	public function login($case = null , $user) {
		
		// database should find user based on username/password
		if($user){
			
		if($case == 'cid'){
			
			$url = !empty($url) ? $url : Login::$_dashboard_front;
			$this->client_id = $_SESSION['client_id'] = $user->id; 
			$this->client_name = $_SESSION['client_name'] = $user->first_name;
			$_SESSION[$case] = $this->client_id;
			Helper::redirect(Url::getReferrerUrl());	
					   
		}elseif($case == 'aid'){
			
			$url = !empty($url) ? $url : Login::$_dashboard_admin;
			$this->admin_id = $_SESSION['admin_id'] = $user->id;
			$this->admin_name = $_SESSION['admin_name'] = $user->first_name;
			$_SESSION[$case] = $this->admin_id;
			Helper::redirect($url);
		  
			}
		}
		
  }
  
	public function restrictFront() {
	
		if (!$this->is_logged_in(Login::$_login_front)) {
			
			$url = Url::cPage() != "logout" ?
					Login::$_login_page_front."&".Login::$_referrer."=".Url::cPage() :
					Login::$_login_page_front;
			Helper::redirect($url);
			
		}
	
	}
	
	
	
	public function restrictAdmin() {
	
		if (!$this->is_logged_in(Login::$_login_admin)) {
			Helper::redirect(Login::$_login_page_admin);
		}
	
	}
 
   public function getFullNameFront($case = null) {
	   
		if($case == 'cid'){
			
			return $this->client_name;
			
		}elseif($case == 'aid'){
			
			return  $this->admin_name;
			
		}
		
   }
 	
  public function logout($case = null) {
	  
	if($case == 'cid'){
		
		 unset($_SESSION['client_id']);
		 unset($_SESSION['cid']);
		 unset($this->client_name);
		 $this->logged_in = false;
		 session_destroy();
		 return true;
	  }else if($case == 'aid'){
		  
		 unset($_SESSION['admin_id']);
		 unset($_SESSION['aid']);
		 unset($this->admin_name);
		 $this->logged_in = false;
		 session_destroy();
		 return true;
	} 
	
		return false;
  }


	private function check_login() {
		
		if(isset($_SESSION['client_id'])) {
			
		  $this->client_id = $_SESSION['client_id'];
		  $this->client_name = $_SESSION['client_name'];
		  $this->logged_in = true;
		  
		} 
		if(isset($_SESSION['admin_id'])) {
			
		  $this->admin_id = $_SESSION['admin_id'];
		  $this->admin_name = $_SESSION['admin_name'];
		  $this->logged_in = true;
		  
		}else{
			
		  unset($this->user_id);
		  $this->logged_in = false;
		  
		}
  }
  
	
	public function request_is_get() {
	return $_SERVER['REQUEST_METHOD'] === 'GET';
	}
	
	public function request_is_post() {
		return $_SERVER['REQUEST_METHOD'] === 'POST';
	}
	
	// Must call session_start() before this loads

	// Generate a token for use with CSRF protection.
	// Does not store the token.
	public function csrf_token() {
		return md5(uniqid(rand(), TRUE));
	}
	
	// Generate and store CSRF token in user session.
	// Requires session to have been started already.
	public function create_csrf_token() {
		$token = $this->csrf_token();
	  $_SESSION['csrf_token'] = $token;
		$_SESSION['csrf_token_time'] = time();
		return $token;
	}
	
	// Destroys a token by removing it from the session.
	public function destroy_csrf_token() {
	  $_SESSION['csrf_token'] = null;
		$_SESSION['csrf_token_time'] = null;
		return true;
	}
	
	// Return an HTML tag including the CSRF token 
	// for use in a form.
	// Usage: echo csrf_token_tag();
	public function csrf_token_tag() {
		$token = $this->create_csrf_token();
		return "<input type=\"hidden\" name=\"csrf_token\" value=\"".$token."\">";
	}
	
	// Returns true if user-submitted POST token is
	// identical to the previously stored SESSION token.
	// Returns false otherwise.
	public function csrf_token_is_valid() {
		$objForm = new Form();
		if($objForm->isPost('csrf_token')) {
			$user_token = $objForm->getPost('csrf_token');
			$stored_token = $_SESSION['csrf_token'];
			return $user_token === $stored_token;
		} else {
			return false;
		}
	}
	
	// You can simply check the token validity and 
	// handle the failure yourself, or you can use 
	// this "stop-everything-on-failure" function. 
	public function die_on_csrf_token_failure() {
		if(!csrf_token_is_valid()) {
			die("CSRF token validation failed.");
		}
	}
	
	// Optional check to see if token is also recent
	public function csrf_token_is_recent() {
		$max_elapsed = 60 * 60 * 24; // 1 day
		if(isset($_SESSION['csrf_token_time'])) {
			$stored_time = $_SESSION['csrf_token_time'];
			return ($stored_time + $max_elapsed) >= time();
		} else {
			// Remove expired token
			destroy_csrf_token();
			return false;
		}
	}	




// sessions for basket
	
	
	public static function setItem($id, $qty = 1) {
		$_SESSION['basket'][$id]['qty'] = $qty;
	}
	
	
	
	public static function removeItem($id, $qty = null) {
		if ($qty != null && $qty < $_SESSION['basket'][$id]['qty']) {
			$_SESSION['basket'][$id]['qty'] = ($_SESSION['basket'][$id]['qty'] - $qty);
		} else {
			$_SESSION['basket'][$id] = null;
			unset($_SESSION['basket'][$id]);
		}
	}
	
	
	public static function getSession($name = null) {
		if (!empty($name)) {
			return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
		}
	}
	
	
	
	
	
	
	public static function setSession($name = null, $value = null) {
		if (!empty($name) && !empty($value)) {
			$_SESSION[$name] = $value;
		}
	}
	
	
	
	
	
	
	public static function clear($id = null) {
		if (!empty($id) && isset($_SESSION[$id])) {
			$_SESSION[$id] = null;
			unset($_SESSION[$id]);
		} else {
			session_destroy();
		}
	}
	
 
  // instantiating Dbase class via singleton design pattern
  
  public static function getInstance(){
	  
	  if(self::$session == null){
		  
		  self::$session = new Session();
		  
	  }
	  
	  return self::$session;
  }
  
  
  // Private clone method to prevent cloning of the instance of the
  // *Singleton* instance.
 
  //  @return void
 
 
  private function  __clone(){
	  
  }
  
  
  //  Private unserialize method to prevent unserializing of the *Singleton* instance.
  //   @return void
     
  private function __wakeup()
  {
  }
	

}

?>