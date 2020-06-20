<?php 
$session = Session::getInstance();
$session->restrictFront();


$objClient = new Client();
//$Client = $objClient->getUser(Session::getSession(Login::$_login_front));
$Client = $objClient->getUser(Session::getSession(Login::$_login_front));

if (!empty($Client)) {

	$objForm = new Form();
	$objValid = new Validation($objForm);
	
	if ($objForm->isPost('first_name')) {
		
		$objValid->_expected = array(
			'first_name',
			'last_name',
			'address_1',
			'address_2',
			'town',
			'county',
			'post_code',
			'country',
			'email'
		);
		
		$objValid->_required = array(
			'first_name',
			'last_name',
			'address_1',
			'town',
			'county',
			'post_code',
			'country',
			'email'
		);
		
		$objValid->_special = array(
			'email' => 'email'
		);
		
		
		if ($objValid->isValid()) {
			
			if ($objClient->updateUser($objValid->_post, $Client->id)) {
				Helper::redirect(G_PATH.'?page=summary');
			} else {
				$mess  = "<p class=\"red\">There was a problem updating your details.<br />";
				$mess .= "Please contact administrator.</p>";
			}
			
		}
		
	}
	
	require_once('header.php'); 
	?>
	</div>
     <p class="mdl-typography--text-center mdl-typography--display-3">Please check your details and click <strong>Next</strong>.</p>
   
   
	<div id="mdl-cell mdl-cell--9-col">
<div class="mdl-card mdl-shadow--2dp wrapper">

    <div class="mdl-card__title text-center mdl-color--primary mdl-color-text--white">
    <h2 class="mdl-card__title-text">Check Out</h2>
    </div>
	
    
	
    
   <div class="mdl-card__supporting-text">

	
	<?php echo !empty($mess) ? $mess : null; ?>
	
	<form action="" method="post">
		
        
        
            <div class="mdl-textfield mdl-js-textfield">
        
        <label class="mdl-textfield__label" for="first_name">First name: *</label></th>

					<?php echo $objValid->validate('first_name'); ?>
					<input type="text" name="first_name"
						id="first_name" class="mdl-textfield__input" 
						value="<?php echo $objForm->stickyText('first_name', $Client->first_name); ?>" />
			</div>	
                
            <div class="mdl-textfield mdl-js-textfield">


				<label class="mdl-textfield__label" for="last_name">Last name: *</label>
				
                
					<?php echo $objValid->validate('last_name'); ?>
					<input type="text" name="last_name"
						id="last_name" class="mdl-textfield__input" 
						value="<?php echo $objForm->stickyText('last_name', $Client->last_name); ?>" />
			</div>	
                
            <div class="mdl-textfield mdl-js-textfield">


				<label class="mdl-textfield__label" for="address_1">Address 1: *</label>
				
					<?php echo $objValid->validate('address_1'); ?>
					<input type="text" name="address_1"
						id="address_1" class="mdl-textfield__input" 
						value="<?php echo $objForm->stickyText('address_1', $Client->address_1); ?>" />
			</div>
            	
			
            <div class="mdl-textfield mdl-js-textfield">
            
				<label class="mdl-textfield__label" for="address_2">Address 2:</label>
				
					<?php echo $objValid->validate('address_2'); ?>
					<input type="text" name="address_2"
						id="address_2" class="mdl-textfield__input" 
						value="<?php echo $objForm->stickyText('address_2', $Client->address_2); ?>" />
							
                            
             </div>

			
            <div class="mdl-textfield mdl-js-textfield">


				<label class="mdl-textfield__label" for="town">Town: *</label>

					<?php echo $objValid->validate('town'); ?>
					<input type="text" name="town"
						id="town" class="mdl-textfield__input" 
						value="<?php echo $objForm->stickyText('town', $Client->town); ?>" />
				
            </div>     
			
            <div class="mdl-textfield mdl-js-textfield">


				<label class="mdl-textfield__label" for="county">County: *</label>
				
					<?php echo $objValid->validate('county'); ?>
					<input type="text" name="county"
						id="county" class="mdl-textfield__input" 
						value="<?php echo $objForm->stickyText('county', $Client->county); ?>" />
				
             </div>       
			
            <div class="mdl-textfield mdl-js-textfield">
            
            
				<label class="mdl-textfield__label" for="post_code">Post code: *</label>
				
					<?php echo $objValid->validate('post_code'); ?>
					<input type="text" name="post_code"
						id="post_code" class="mdl-textfield__input" pattern="-?[0-9]*(\.[0-9]+)?" 
						value="<?php echo $objForm->stickyText('post_code', $Client->post_code); ?>" />
                    <span class="mdl-textfield__error">Input is not a number!</span>         
		
            
             </div>       
			
            <?php echo $objValid->validate('country'); ?>
            <div id="select-container" class="mdl-textfield mdl-js-textfield">

					<?php echo $objForm->getCountriesSelect($Client->country); ?>
                    <label for="country" class="mdl-textfield__label">Country: *</label>
				
            </div>     
			
            <div class="mdl-textfield mdl-js-textfield">
            
				<label class="mdl-textfield__label" for="email">Email address: *</label>
				
					<?php echo $objValid->validate('email'); ?>
					<input type="text" name="email"
						id="email"  class="mdl-textfield__input" 
						value="<?php echo $objForm->stickyText('email', $Client->email); ?>" />
			
            </div>       
	
			
            
        <button class="mdl-button mdl-js-button mdl-js-ripple-effect"  type="submit" class="btn" value="Next" >
	    Next		
        </button>
	</form>
</div>
</div>
</div>
<?php 
	require_once('footer.php'); 
} else {

	Helper::redirect('/?page=error');

}
	
?>