<?php 

// adding form validation

$objForm = new Form();
$objValid = new Validation($objForm);

// Counting the No. of categories
   
$categories_count = Categories::count_all();

if ($objForm->isPost('name')) {
	
	$objValid->_expected = array('name','position','visible');	
	$objValid->_required = array('name','position');
	
	$objCategories = new Categories();
	
	
	$name = $objForm->getPost('name');
	
	if ($objCategories->duplicateCategory($name)) {
		$objValid->add2Errors('name_duplicate');
	}
	
	if ($objValid->isValid()) {
		
		if ($objCategories->addCategory($objValid->_post)) {
			
			$category = $objValid->_post["name"];
			Helper::log_action('Category Added' , "A new Category {$category} is added");
			Helper::redirect(G_PATH.'admin'.Url::getCurrentUrl(array('action', 'id')).'&action=added');
			
		} else {
			Helper::redirect(G_PATH.'admin'.Url::getCurrentUrl(array('action', 'id')).'&action=added-failed');
		}
		
	}
	
}

// header template

require_once('template/_header.php'); 
?>


<header class="mdl-layout__header">

<div class="mdl-layout__header-row">


<div class="mdl-layout-spacer"></div>

<span class="mdl-layout-title mdl-typography--text-center mdl-typography--display-3">Categories :: Add</span>

<div class="mdl-layout-spacer"></div>



</div>
</header>

<div class="mdl-card mdl-shadow--2dp wrapper frmcont">

    <div class="mdl-card__title text-center mdl-color--primary mdl-color-text--white">
    <h2 class="mdl-card__title-text">Categories :: Add</h2>
    </div>
    

            <div class="mdl-card__supporting-text">

<form action="" method="post">
				<?php 
					echo $objValid->validate('name'); 
					echo $objValid->validate('name_duplicate'); 
				?>
        <div class="mdl-textfield mdl-js-textfield">
        
        <label for="name" class="mdl-textfield__label">Name: *</label>
        
        
        <input type="text" name="name" id="name" 
        value="<?php echo $objForm->stickyText('name'); ?>" 
        class="mdl-textfield__input" />
        </div>
        
        
                        	<?php echo $objValid->validate('position');  ?>


                           <div id="select-container" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

        	
                <select name="position" id="position" class="mdl-textfield__input">
                	<option value=""></option>
					<?php for($count = 1 ; $count <= ($categories_count + 1) ; $count++){ ?>
                         <option value="<?php echo $count ?>"
                         <?php echo $objForm->stickySelect('position', $count) ?>>
                         <?php echo $count ?>
                         </option>
                     
                   <?php } ?>
        		</select>
                <label for="position" class="mdl-textfield__label">Position : *</label>
            
            </div>
            
            	                            			 <div class="mdl-textfield mdl-js-textfield">
                
                    <label for="visible">Visible : *</label>
                </div>    
                
               <div class="mdl-textfield mdl-js-textfield">
    
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-0">
                    <input type="radio" id="option-0" class="mdl-radio__button" name="visible" 
                    value="0"/> 
                    <span class="mdl-radio__label">No</span>
                    </label>
                    
                    &nbsp;
                    
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
                    <input type="radio" id="option-1" class="mdl-radio__button" name="visible" 
                    value="1" checked="checked" />
                     <span class="mdl-radio__label"> Yes </span>
                    </label>
                </div>
          
          
          
          
          
           <div class="mdl-textfield mdl-js-textfield">
                     
                    <input type="submit" id="btn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect
                     mdl-button--accent mdl-align-center"  value="Add" />
                    
                </div>
			
</form>
</div>
</div>


<?php require_once('template/_footer.php'); ?>



