<?php 


$session = Session::getInstance();
if ($session->is_logged_in()){Helper::redirect(Login::$_dashboard_front);}

$objForm = new Form();
$objValid = new Validation($objForm);

$objClient = new Client();

$is_active_login = "is-active";
$is_active_register="";

// login form
if ($objForm->isPost('login_email')) {
if($session->request_is_post()) {
	if($session->csrf_token_is_valid()){

	
	$foundClient = $objClient->authenticate($objForm->getPost('login_email'), $objForm->getPost('login_password'));
	if ($foundClient) {
		
		$session->login(Login::$_login_front,$foundClient);
		
	} else {
		$objValid->add2Errors('login');
	}
}
	} else { $objValid->add2Errors('csrf'); var_dump($objValid->_errors); }
}



// registration form
if ($objForm->isPost('first_name')) {
	
	$objValid->_exptected = array(
		'first_name',
		'last_name',
		'address_1',
		'address_2',
		'town',
		'county',
		'post_code',
		'country',
		'email',
		'password',
		'confirm_password'
	);
	
	$objValid->_required = array(
		'first_name',
		'last_name',
		'address_1',
		'town',
		'county',
		'post_code',
		'country',
		'email',
		'password',
		'confirm_password'
	);
	
	$objValid->_special = array(
		'email' => 'email'
	);
	
	$objValid->_post_remove = array(
		//'csrf_token',
		'confirm_password'
	);
	
	$objValid->_post_format = array(
		'password' => 'password'
	);
	
	
	// validate password
	$pass_1 = $objForm->getPost('password');
	$pass_2 = $objForm->getPost('confirm_password');
	
	if (!empty($pass_1) && !empty($pass_2) && $pass_1 != $pass_2) {
		$objValid->add2Errors('password_mismatch');
	}
	
	
	$email = $objForm->getPost('email');
	$client = $objClient->getByEmail($email);
	
	if (!empty($client)) {
		$objValid->add2Errors('email_duplicate');
	}
			
   
	if ($objValid->isValid()) {
		
		// add hash for activating account
		$objValid->_post['hash'] = mt_rand().date('YmdHis').mt_rand();

		// add registration date
		$objValid->_post['date'] = Helper::setDate();
		
		
		
		if ($objClient->addUser($objValid->_post, $objForm->getPost('password'))) {
			$objClient->sendEmail($objValid->_post);
			Helper::redirect(G_PATH.'?page=registered');
			 
		} else {
			Helper::redirect(G_PATH.'?page=registered-failed');
			 
		}
		
	} else {
	
	$is_active_login = ''; $is_active_register="is-active";  ?> 
    
	
    
   <?php 
   
   }
	
} 




require_once('header.php'); 
?>

</div>
	<div id="mdl-cell mdl-cell--9-col">

<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
  <div class="mdl-tabs__tab-bar">
    	
      <a href="#login-panel" class="mdl-tabs__tab <?php echo $is_active_login ?>" 
      onclick="document.getElementById('register-panel').style.display = 'none'">Login</a>
      
      <a href="#register-panel" class="mdl-tabs__tab <?php echo $is_active_register ?>" 
      onclick="document.getElementById('register-panel').style.display = 'block'" >Register</a>
      
  </div>
  
  
<div class="mdl-tabs__panel <?php echo $is_active_login ?>" id="login-panel">      

<div class="mdl-card mdl-shadow--2dp wrapper">

    <div class="mdl-card__title text-center mdl-color--primary mdl-color-text--white">
    <h2 class="mdl-card__title-text">Login</h2>
    </div>
    
<div class="mdl-card__supporting-text">

<form action="" method="post">

	<?php echo $objValid->validate('login'); ?>
	<?php echo $session->csrf_token_tag(); ?>
    
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
  
        <input type="text" name="login_email"
            id="login_email" class="mdl-textfield__input" value="" />
        <label class="mdl-textfield__label" for="login_email">Login:</label>  
          
    </div>		
    
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
    
    
        <input type="password" name="login_password"
            id="login_password" class="mdl-textfield__input" pattern="-?[0-9]*(\.[0-9]+)?" value="" />
            
        <label class="mdl-textfield__label" for="login_password">Password:</label>   
        <span class="mdl-textfield__error">Input is not a number!</span>    
        
        
    </div>              
    
    <div class="mdl-card__actions mdl-card--border text-center">
    
        <!-- Flat button with ripple -->
        <button class="mdl-button mdl-js-button mdl-js-ripple-effect" type="submit" id="btn_login" value="Login" >
        Login		
        </button>
        </div>
        
    </div>          


</form>

</div>

</div>
</div>  


<div class="mdl-tabs__panel <?php echo $is_active_register ?>" id="register-panel"
<?php
if ($is_active_register == 'is-active') {
?>
   style="display:block;"
    
	<?php	
 }else {
	 ?>
	 style="display:none;"
     
    <?php 
 } 
?>
>  

<div class="mdl-card mdl-shadow--2dp wrapper">

    <div class="mdl-card__title text-center mdl-color--primary mdl-color-text--white">
    
  	  <h2 class="mdl-card__title-text">Not Registered Yet:</h2>
    
    </div>
    
    <div class="mdl-card__supporting-text">
    
    <form action="" method="post">
    
    
    <?php echo $objValid->validate('first_name'); ?>
    <div class="mdl-textfield mdl-js-textfield  mdl-textfield--floating-label textfield-demo">
    
        <input type="text" name="first_name" id="first_name" class="mdl-textfield__input" 
            value="<?php echo $objForm->stickyText('first_name'); ?>" />
        <label class="mdl-textfield__label" for="first_name">First name: *</label>    
    
    </div>
    
    <?php echo $objValid->validate('last_name'); ?>
    <div class="mdl-textfield mdl-js-textfield  mdl-textfield--floating-label textfield-demo">
    
        <input type="text" name="last_name" id="last_name" class="mdl-textfield__input"
            value="<?php echo $objForm->stickyText('last_name'); ?>" />
        <label class="mdl-textfield__label" for="last_name">Last name: *</label>    
        
    </div>
    
    <?php echo $objValid->validate('address_1'); ?>
    <div class="mdl-textfield mdl-js-textfield  mdl-textfield--floating-label textfield-demo">
    
        <input type="text" name="address_1" id="address_1" class="mdl-textfield__input" 
            value="<?php echo $objForm->stickyText('address_1'); ?>" />
        <label class="mdl-textfield__label" for="address_1">Address 1: *</label>
    
    
    </div>
    
    <?php echo $objValid->validate('address_2'); ?>
    <div class="mdl-textfield mdl-js-textfield  mdl-textfield--floating-label textfield-demo">
    
      
        <input type="text" name="address_2" id="address_2" class="mdl-textfield__input" 
            value="<?php echo $objForm->stickyText('address_2'); ?>" />
         <label class="mdl-textfield__label" for="address_2">Address 2:</label>
    
        
    </div>
    
    <?php echo $objValid->validate('town'); ?>
    <div class="mdl-textfield mdl-js-textfield  mdl-textfield--floating-label textfield-demo">
    
        
        <input type="text" name="town" id="town" class="mdl-textfield__input"
            value="<?php echo $objForm->stickyText('town'); ?>" />
        <label class="mdl-textfield__label" for="town">Town: *</label>  

    </div>
    
    <?php echo $objValid->validate('county'); ?>
    <div class="mdl-textfield mdl-js-textfield  mdl-textfield--floating-label textfield-demo">
    
        
        <input type="text" name="county" id="county" class="mdl-textfield__input" 
            value="<?php echo $objForm->stickyText('county'); ?>" />
         <label class="mdl-textfield__label" for="county">County: *</label>

    
    </div>
    
    <?php echo $objValid->validate('post_code'); ?>
    <div class="mdl-textfield mdl-js-textfield  mdl-textfield--floating-label textfield-demo">
    
        
        <input type="text" name="post_code" id="post_code" class="mdl-textfield__input" 
         pattern="-?[0-9]*(\.[0-9]+)?" value="<?php echo $objForm->stickyText('post_code'); ?>" />
        <span class="mdl-textfield__error">Input is not a number!</span>    
        <label class="mdl-textfield__label" for="post_code">Post code: *</label>

    </div>    
    
    
    <?php echo $objValid->validate('country'); ?>
    <div id="select-container" class="mdl-textfield mdl-js-textfield  mdl-textfield--floating-label textfield-demo">
    
    
		 
           <?php echo $objForm->getCountriesSelect(229); ?>
          
          <!--<span>Select a value</span>-->
		  <label class="mdl-textfield__label" for="country">Country: *</label>          
    
    </div>        
    
    
    <?php echo $objValid->validate('email'); ?>
    <?php echo $objValid->validate('email_duplicate'); ?>
    <div class="mdl-textfield mdl-js-textfield  mdl-textfield--floating-label textfield-demo">
    
            
       
        <input type="text" name="email" id="email" class="mdl-textfield__input"  
            value="<?php echo $objForm->stickyText('email'); ?>" />
        <label class="mdl-textfield__label" for="email">Email address: *</label>
     
        
    </div>		
    
    <?php echo $objValid->validate('password'); ?>
    <?php echo $objValid->validate('password_mismatch'); ?>
    <div class="mdl-textfield mdl-js-textfield  mdl-textfield--floating-label textfield-demo">
    
       
        <input type="password" name="password" id="password" class="mdl-textfield__input" 
        pattern="-?[0-9]*(\.[0-9]+)?"	value="" />
        <span class="mdl-textfield__error">Input is not a number!</span>
        <label class="mdl-textfield__label" for="password">Password: *</label>    
    
    </div>		
    
    <?php echo $objValid->validate('confirm_password'); ?>
    <div class="mdl-textfield mdl-js-textfield  mdl-textfield--floating-label textfield-demo">
    
        
        <input type="password" name="confirm_password" class="mdl-textfield__input" 
        pattern="-?[0-9]*(\.[0-9]+)?" id="confirm_password" class="fld" value="" />
        <span class="mdl-textfield__error">Input is not a number!</span> 
        <label class="mdl-textfield__label" for="confirm_password">Confirm password: *</label>
    
    </div>	
    
    <!--<div class="mdl-card__actions mdl-card--border text-center">-->
    <button class="mdl-button mdl-js-button mdl-js-ripple-effect" type="submit" id="btn" value="Register" >
    Register		
    </button>
    <!--</div>-->
    </div>
    </form>
    </div>
</div></div>

<?php require_once('footer.php'); ?>