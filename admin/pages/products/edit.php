<?php 

// fetching the id of the product

$id = Url::getParam('id');


if (!empty($id)) {
	
	// Get the product
	
	$objproducts = new Products();
	$product = $objproducts->getProduct($id);
	
	// Counting the No. of products

	$product_count = Products::count_all();
	
	if (!empty($product)) {
	
		// adding form validation

		$objForm = new Form();
		$objValid = new Validation($objForm);
		
		// displaying categories
		
		$objCatalogue = new Catalogue();
		$categories = $objCatalogue->displayCategories();
	
			
		if ($objForm->isPost('name')) {
			
			$objValid->_expected = array(
				'category',
				'name',
				'description',
				'position',
				'visible',
				'price'
			);
			
			$objValid->_required = array(
				'category',
				'name',
				'description',
				'position',
				'price'
			);
			
			if ($objValid->isValid()) {
				
				if ($objproducts->updateProduct($objValid->_post, $id)) {
				
					$objUpload = new Upload();
					
					if ($objUpload->upload(CATALOGUE_PATH)) {
					
						if (is_file(CATALOGUE_PATH.DS.$product->image)) {
							unlink(CATALOGUE_PATH.DS.$product->image);
						}
					
						$objproducts->updateProduct(array('image' => $objUpload->_names[0]), $id);
						Helper::redirect(G_PATH.'admin'.Url::getCurrentUrl(array('action', 'id')).'&action=edited');
					} else {
						Helper::redirect(G_PATH.'admin'.Url::getCurrentUrl(array('action', 'id')).'&action=edited-no-upload');
					}
					
				} else {
					Helper::redirect(G_PATH.'admin'.Url::getCurrentUrl(array('action', 'id')).'&action=edited-failed');
				}
				
			}
			
		}
		
		// header template
		
		require_once('template/_header.php'); 
?>
	
    <header class="mdl-layout__header">

        <div class="mdl-layout__header-row">
        
        
            <div class="mdl-layout-spacer"></div>
            
            <span class="mdl-layout-title mdl-typography--text-center mdl-typography--display-3">Products :: Edit</span>
            
            <div class="mdl-layout-spacer"></div>
        
        
        
        </div>
    </header>
    
    <div class="mdl-card mdl-shadow--2dp wrapper frmcont">

    <div class="mdl-card__title text-center mdl-color--primary mdl-color-text--white">
    <h2 class="mdl-card__title-text">Products :: Edit</h2>
    </div>
    
 
            <div class="mdl-card__supporting-text">
	
	<form action="" method="post" enctype="multipart/form-data">
		
			    <?php echo $objValid->validate('category'); ?>
               <div id="select-container" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                
					
					<select name="category" id="category" class="mdl-textfield__input">
						<option value=""></option>
						<?php if (!empty($categories)) { ?>
							<?php foreach($categories as $cat) { ?>
							<option value="<?php echo $cat->id; ?>"
							<?php echo $objForm->stickySelect('category', $cat->id, $product->category); ?>>
							<?php echo Helper::encodeHtml($cat->name); ?>
							</option>
							<?php } ?>
						<?php } ?>
					</select>
				    <label for="category" class="mdl-textfield__label">Category: *</label>



				<?php echo $objValid->validate('name'); ?>
               <div class="mdl-textfield mdl-js-textfield">

				<label for="name" class="mdl-textfield__label">Name: *</label>
				
					<input type="text" name="name" id="name" class="mdl-textfield__input"
						value="<?php echo $objForm->stickyText('name', $product->name); ?>" class="fld" />
				</div>
                
            
        	
            	<?php echo $objValid->validate('position');  ?>
                
               <div id="select-container" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                
                <select name="position" id="position" class="mdl-textfield__input">
                	<option value=""></option>
					<?php for($count = 1 ; $count <= ($product_count + 1) ; $count++){ ?>
                         <option value="<?php echo $count ?>"
                         <?php echo $objForm->stickySelect('position', $count , $product->position) ?>>
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
                    <input type="radio" id="option-0" class="mdl-radio__button" name="visible" id="visible"
                    value="0"/> 
                    <span class="mdl-radio__label">No</span>
                    </label>
                    
                    &nbsp;
                    
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
                    <input type="radio" id="option-1" class="mdl-radio__button" name="visible" id="visible"
                    value="1" checked="checked" />
                     <span class="mdl-radio__label"> Yes </span>
                    </label>
                </div>
                
            
            					<?php echo $objValid->validate('description'); ?>

            			<div class="mdl-textfield mdl-js-textfield">

				<label for="description" class="mdl-textfield__label">Description: *</label>
				
					<textarea name="description" id="description" class="mdl-textfield__input" cols="" rows=""
						class="tar_fixed"><?php echo $objForm->stickyText('description', $product->description); ?></textarea>
				</div>
                
                					<?php echo $objValid->validate('price'); ?>

                			<div class="mdl-textfield mdl-js-textfield">

				<label for="price" class="mdl-textfield__label">Price: *</label>
				
					<input type="text" name="price" id="price" class="mdl-textfield__input" 
						value="<?php echo $objForm->stickyText('price', $product->price); ?>" class="fld_price" />
				</div>
                
								<?php echo $objValid->validate('image'); ?>

						<div class="mdl-textfield mdl-js-textfield">

               <label for="image">Image:</label>

					<input type="file" name="image" id="image" size="30" />
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