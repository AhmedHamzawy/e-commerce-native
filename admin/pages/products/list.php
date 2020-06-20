<?php 

$objCatalogue = new Catalogue();

$srch = Url::getParam('srch');


if (!empty($srch)) {
	
	$products = $objCatalogue->displayProducts($srch);
	$empty = 'There are no results matching your searching criteria.';
	
} else {
	
	$products = $objCatalogue->displayProducts($srch);
	$empty = 'There are currently no records.';
	
}


$objPaging = new Paging($products, 5);
$rows = $objPaging->getRecords();

$objPaging->_url = G_PATH.'admin'.$objPaging->_url;

require_once('template/_header.php');

 
?>


<header class="mdl-layout__header">

<div class="mdl-layout__header-row">

    <!-- Colored FAB button with ripple -->
    <div class="add">
        <a href="<?php G_PATH.'admin'.DS ?>?page=products&amp;action=add">
        <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
          <i class="material-icons">add</i>
        </button>
        </a>
    </div>
    
    
<div class="mdl-layout-spacer"></div>

<span class="mdl-layout-title mdl-typography--text-center mdl-typography--display-3">Products</span>

<div class="mdl-layout-spacer"></div>

<form action="" method="get">
	<?php echo Url::getParams4Search(array('srch', Paging::$_key)); ?>
	
			
            
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
    mdl-textfield--floating-label">
        <label class="mdl-button mdl-js-button mdl-button--icon srch"
        for="fixed-header-drawer-exp">
       		<i class="material-icons">search</i>
        </label>
        <div class="mdl-textfield__expandable-holder">
            <input class="mdl-textfield__input" type="text" name="srch"
            id="fixed-header-drawer-exp" value="<?php echo stripslashes($srch); ?>">
        </div>
    </div>
	
</form>

</div>
</header>


<?php if (!empty($rows)) { ?>

<table cellpadding="0" cellspacing="0" border="0" class="mdl-data-table mdl-js-data-table mdl-data-table mdl-shadow--2dp">
	
    
	<tr>
		<th class="mdl-data-table__cell--non-numeric">Id</th>
		<th>Product</th>
		<th class="col_15 ta_r">Remove</th>
		<th class="col_5 ta_r">Edit</th>
	</tr>
	
	<?php foreach($rows as $product) { ?>
	
	<tr>
		<td class="mdl-data-table__cell--non-numeric"><?php echo $product->id; ?></td>
		<td><?php echo Helper::encodeHtml($product->name); ?></td>
		<td class="ta_r">
			<a href=<?php G_PATH.'admin'.DS ?>"?page=products&amp;action=remove&amp;id=<?php echo $product->id; ?>">Remove</a>
		</td>
		<td class="ta_r">
			<a href=<?php G_PATH.'admin'.DS ?>"?page=products&amp;action=edit&amp;id=<?php echo $product->id; ?>">Edit</a>
		</td>
	</tr>
	
	<?php } ?>
	
</table>

<?php echo $objPaging->getPaging(); ?>


<?php 
	} else {
		echo '<p>'.$empty.'</p>';
	} 
?>

<?php require_once('template/_footer.php'); ?>