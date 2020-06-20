<?php 

// adding form validation

$objForm = new Form();
$objValid = new Validation($objForm);

// displaying categories

$objCatalogue = new Catalogue();
$categories = $objCatalogue->displayCategories();

$objproducts = new Products();

// Counting the No. of products

$product_count = Products::count_all();

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
		
		if ($objproducts->addProduct($objValid->_post)) {

			$objUpload = new Upload();
			
			if ($objUpload->upload(CATALOGUE_PATH)) {
				$objproducts->updateProduct(array('image' => $objUpload->_names[0]), $objproducts->id);
				Helper::redirect(G_PATH.'admin'.Url::getCurrentUrl(array('action', 'id')).'&action=added');
			} else {
				Helper::redirect(G_PATH.'admin'.Url::getCurrentUrl(array('action', 'id')).'&action=added-no-upload');
			}
			
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

<span class="mdl-layout-title mdl-typography--text-center mdl-typography--display-3">Products :: Add</span>

<div class="mdl-layout-spacer"></div>



</div>
</header>

<div class="mdl-card mdl-shadow--2dp wrapper frmcont">

    <div class="mdl-card__title text-center mdl-color--primary mdl-color-text--white">
    <h2 class="mdl-card__title-text">Products :: Add</h2>
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
                <?php echo $objForm->stickySelect('category', $cat->id); ?>>
                <?php echo Helper::encodeHtml($cat->name); ?>
                </option>
                <?php } ?>
                <?php } ?>
                </select>
                <label for="category" class="mdl-textfield__label">Category: *</label>

                </div>
                
                <?php echo $objValid->validate('name'); ?>
                <div class="mdl-textfield mdl-js-textfield">
                
                    <label for="name" class="mdl-textfield__label">Name: *</label>
                    
                    <input type="text" name="name" class="mdl-textfield__input" id="name" 
                    value="<?php echo $objForm->stickyText('name'); ?>" class="fld" />
            
            	</div>
            
               <?php echo $objValid->validate('position');  ?>
               <div id="select-container" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

            
            
                
                <select name="position" id="position" class="mdl-textfield__input">
                <option value=""></option>
                <?php for($count = 1 ; $count <= ($product_count + 1) ; $count++){ ?>
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
                
                
                    <label for="description">Description: *</label>
                    
                    <textarea name="description" class="mdl-textfield__input" id="description" cols="" rows=""
                    class="tar_fixed"><?php echo $objForm->stickyText('description'); ?></textarea>
                
                </div>
            
                <?php echo $objValid->validate('price'); ?>
                <div class="mdl-textfield mdl-js-textfield">
                
                    <label for="price">Price: *</label>
                    
                    <input type="text" name="price" class="mdl-textfield__input" id="price" 
                    value="<?php echo $objForm->stickyText('price'); ?>" class="fld_price" />
                
                
                </div>
            	
                
                <div class="mdl-textfield mdl-js-textfield">
                
                    <?php echo $objValid->validate('image'); ?>

                    <label for="image">Image:</label>
                    
                    <input type="file" name="image" id="image"  size="30" />
                    
                </div>
                
                 <div class="mdl-textfield mdl-js-textfield">
                     
                    <input type="submit" id="btn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect
                     mdl-button--accent mdl-align-center btn"  value="Add" />
                    
                </div>
            
           	 </form>
        </div>
</div>

<?php require_once('template/_footer.php'); ?>



