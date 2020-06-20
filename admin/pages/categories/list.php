<?php 

$objCatalogue = new Catalogue();
$categories = $objCatalogue->displayCategories();

$objPaging = new Paging($categories, 5);
$rows = $objPaging->getRecords();

$objPaging->_url = G_PATH.'admin'.$objPaging->_url;

require_once('template/_header.php'); 
?>

<header class="mdl-layout__header">

<div class="mdl-layout__header-row">

<!-- Colored FAB button with ripple -->
    <div class="add">
        <a href="<?php G_PATH.'admin'.DS ?>?page=categories&amp;action=add">
        <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
          <i class="material-icons">add</i>
        </button>
        </a>
    </div>

<div class="mdl-layout-spacer"></div>

<span class="mdl-layout-title mdl-typography--text-center mdl-typography--display-3">Categories</span>

<div class="mdl-layout-spacer"></div>



</div>
</header>

<?php if (!empty($rows)) { ?>

<table cellpadding="0" cellspacing="0" border="0" class="mdl-data-table mdl-js-data-table mdl-data-table mdl-shadow--2dp">
	
	<tr>
		<th class="mdl-data-table__cell--non-numeric">Category</th>
		<th class="col_15 ta_r">Remove</th>
		<th class="col_5 ta_r">Edit</th>
	</tr>
	
	<?php foreach($rows as $category) { ?>
	
	<tr>
		<td class="mdl-data-table__cell--non-numeric"><?php echo Helper::encodeHtml($category->name); ?></td>
		<td class="ta_r">
			<a href=<?php G_PATH.'admin'.DS ?>"?page=categories&amp;action=remove&amp;id=<?php echo $category->id; ?>">Remove</a>
		</td>
		<td class="ta_r">
			<a href=<?php G_PATH.'admin'.DS ?>"?page=categories&amp;action=edit&amp;id=<?php echo $category->id; ?>">Edit</a>
		</td>
	</tr>
	
	<?php } ?>
	
</table>

<?php echo $objPaging->getPaging(); ?>

<?php } else { ?>

	<p>There are currently no categories created.</p>

<?php } ?>

<?php require_once('template/_footer.php'); ?>





