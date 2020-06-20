<?php 
$id = Url::getParam('id');

if (!empty($id)) {

	$objClient = new Client();
	$client = $objClient->getUser($id);
	
	if (!empty($client)) {
	
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
			
			$email = $objForm->getPost('email');
			$duplicate = $objClient->getByEmail($email);
			
			if (!empty($duplicate) && $duplicate[0]->id != $client->id) {
				$objValid->add2Errors('email_duplicate');
			}
			
			if ($objValid->isValid()) {
				
				if ($objClient->updateUser($objValid->_post, $client->id)) {
				 $clientname = $objValid->_post["first_name"].' '.$objValid->_post["last_name"];
 			   	 Helper::log_action('Client Edited' , "The Client {$clientname} is edited");
				 Helper::redirect(G_PATH.'admin'.Url::getCurrentUrl(array('action', 'id')).'&action=edited');
				} else {
					Helper::redirect(G_PATH.'admin'.Url::getCurrentUrl(array('action', 'id')).'&action=edited-failed');
				}
				
			}
			
		}
		
		require_once('template/_header.php'); 
?>
	
	
     <header class="mdl-layout__header">
    
        <div class="mdl-layout__header-row">
        
        
        <div class="mdl-layout-spacer"></div>
        
        <span class="mdl-layout-title mdl-typography--text-center mdl-typography--display-3">Clients :: Edit</span>
        
        <div class="mdl-layout-spacer"></div>
        
        
        
        </div>
    </header>
    
    <div class="mdl-card mdl-shadow--2dp wrapper frmcont">

    <div class="mdl-card__title text-center mdl-color--primary mdl-color-text--white">
    <h2 class="mdl-card__title-text">Clients :: Edit</h2>
    </div>
    
            <div class="mdl-card__supporting-text">
        
	<form action="" method="post">
		
        <?php echo $objValid->validate('first_name'); ?>
        <div class="mdl-textfield mdl-js-textfield">
             <label for="first_name" class="mdl-textfield__label">First name: *</label>
				
					
					<input type="text" name="first_name"
						id="first_name" class="mdl-textfield__input" 
						value="<?php echo $objForm->stickyText('first_name', $client->first_name); ?>" />
				</div>
                
              <?php echo $objValid->validate('last_name'); ?>
                <div class="mdl-textfield mdl-js-textfield">
                <label for="last_name" class="mdl-textfield__label">Last name: *</label>
                
					<input type="text" name="last_name"
						id="last_name" class="mdl-textfield__input" 
						value="<?php echo $objForm->stickyText('last_name', $client->last_name); ?>" />
				</div>
                
                					<?php echo $objValid->validate('address_1'); ?>

                <div class="mdl-textfield mdl-js-textfield">
                <label for="address_1" class="mdl-textfield__label">Address 1: *</label>
				
					<input type="text" name="address_1"
						id="address_1" class="mdl-textfield__input" 
						value="<?php echo $objForm->stickyText('address_1', $client->address_1); ?>" />
				</div>
                
                					<?php echo $objValid->validate('address_2'); ?>

                <div class="mdl-textfield mdl-js-textfield">
                <label for="address_2" class="mdl-textfield__label">Address 2:</label>
                
					<input type="text" name="address_2"
						id="address_2" class="mdl-textfield__input" 
						value="<?php echo $objForm->stickyText('address_2', $client->address_2); ?>" />
				</div>
                
                					<?php echo $objValid->validate('town'); ?>

                <div class="mdl-textfield mdl-js-textfield">
				<label for="town" class="mdl-textfield__label">Town: *</label>
				
					<input type="text" name="town"
						id="town" class="mdl-textfield__input"
						value="<?php echo $objForm->stickyText('town', $client->town); ?>" />
				</div>
                
                
                					<?php echo $objValid->validate('county'); ?>

                <div class="mdl-textfield mdl-js-textfield">
                <label for="county" class="mdl-textfield__label">County: *</label>
				
					<input type="text" name="county"
						id="county" class="mdl-textfield__input" 
						value="<?php echo $objForm->stickyText('county', $client->county); ?>" />
				</div>
                
                
                					<?php echo $objValid->validate('post_code'); ?>

                <div class="mdl-textfield mdl-js-textfield">
                <label for="post_code" class="mdl-textfield__label">Post code: *</label>
                
					<input type="text" name="post_code"
						id="post_code" class="mdl-textfield__input" 
						value="<?php echo $objForm->stickyText('post_code', $client->post_code); ?>" />
				</div>
                
                					<?php echo $objValid->validate('country'); ?>

                <div class="mdl-textfield mdl-js-textfield">
				<label for="country">Country: *</label>
				
					<?php echo $objForm->getCountriesSelect($client->country); ?>
				</div>
                
                					<?php echo $objValid->validate('email'); ?>

                <div class="mdl-textfield mdl-js-textfield">
				<label for="email" class="mdl-textfield__label">Email address: *</label>
				
					<input type="text" name="email"
						id="email" class="mdl-textfield__input" 
						value="<?php echo $objForm->stickyText('email', $client->email); ?>" />
				</div>
                
                <div class="mdl-textfield mdl-js-textfield">
                     
                    <input type="submit" id="btn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect
                     mdl-button--accent mdl-align-center"  value="Update" />
                    
                </div>
			
</form>
</div>
</div>

<?php 
		require_once('template/_footer.php'); 
	}
} 	
?>