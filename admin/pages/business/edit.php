<?php

$objBusiness = new Business();
$business = $objBusiness->getBusiness();

if (!empty($business)) {

	$objForm = new Form();
	$objValid = new Validation($objForm);
	
	if ($objForm->isPost('name')) {
	
		$objValid->_expected = array(
			'name',
			'address',
			'telephone',
			'email',
			'website',
			'vat_rate'
		);
		
		$objValid->_required = array(
			'name',
			'address',
			'telephone',
			'email',
			'vat_rate'
		);
		
		$objValid->_special = array(
			'email' => 'email'
		);
		
		$vars = $objForm->getPostArray($objValid->_expected);
		
		if ($objValid->isValid()) {
			if ($objBusiness->updateBusiness($vars)) {
				Helper::log_action('Business Data Updated' , "The Business Data is Updated");
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

<span class="mdl-layout-title mdl-typography--text-center mdl-typography--display-3">Business</span>

<div class="mdl-layout-spacer"></div>



</div>
</header>    


   <div class="mdl-card mdl-shadow--2dp wrapper frmcont">

    <div class="mdl-card__title text-center mdl-color--primary mdl-color-text--white">
    <h2 class="mdl-card__title-text">Business</h2>
    </div>
            <div class="mdl-card__supporting-text">
	<form action="" method="post">
		
        
        					<?php echo $objValid->validate('name'); ?>

        		<div class="mdl-textfield mdl-js-textfield">


        <label for="name" class="mdl-textfield__label">Name: *</label>
				
					<input type="text" name="name"
						id="name" class="mdl-textfield__input"  
						value="<?php echo $objForm->stickyText('name', $business->name); ?>" />
				</div>
                
                					<?php echo $objValid->validate('address'); ?>

                		<div class="mdl-textfield mdl-js-textfield">

                <label for="address" class="mdl-textfield__label">Address: *</label></th>
				
					<textarea name="address" id="address" class="mdl-textfield__input"  
						cols="" rows=""><?php echo $objForm->stickyText('address', $business->address); ?></textarea>
				</div>
                
                					<?php echo $objValid->validate('telephone'); ?>

                		<div class="mdl-textfield mdl-js-textfield">

                <label for="telephone" class="mdl-textfield__label">Telephone: *</label></th>
					<input type="text" name="telephone"
						id="telephone" class="mdl-textfield__input"  
						value="<?php echo $objForm->stickyText('telephone', $business->telephone); ?>" />
				</div>
                
                					<?php echo $objValid->validate('email'); ?>

                		<div class="mdl-textfield mdl-js-textfield">

                <label for="email" class="mdl-textfield__label">Email: *</label></th>

					<input type="text" name="email"
						id="email" class="mdl-textfield__input"  
						value="<?php echo $objForm->stickyText('email', $business->email); ?>" />
				
                </div>
                
                					<?php echo $objValid->validate('website'); ?>

                		<div class="mdl-textfield mdl-js-textfield">

                <label for="website" class="mdl-textfield__label">Website:</label></th>

					<input type="text" name="website"
						id="website" class="mdl-textfield__input"  
						value="<?php echo $objForm->stickyText('website', $business->website); ?>" />
				</div>
                
                					<?php echo $objValid->validate('vat_rate'); ?>

                		<div class="mdl-textfield mdl-js-textfield">

                <label for="vat_rate" class="mdl-textfield__label">VAT Rate: *</label></th>

					<input type="text" name="vat_rate"
						id="vat_rate" class="mdl-textfield__input" 
						value="<?php echo $objForm->stickyText('vat_rate', $business->vat_rate); ?>" />
				
                </div>
                
					 <div class="mdl-textfield mdl-js-textfield">
                     
                    <input type="submit" id="btn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect
                     mdl-button--accent mdl-align-center"  value="Update" />
                    
                </div>
			
</form>
</div>
</div>

<?php require_once('template/_footer.php'); } ?>