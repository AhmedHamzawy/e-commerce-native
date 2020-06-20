<?php 

$objClient = new Client();
$objOrder = new Order();


$srch = Url::getParam('srch');


if (!empty($srch)) {
	
	$clients = $objClient->getClients($srch);
	$empty = 'There are no results matching your searching criteria.';
	
} else {
	
	$clients = $objClient->getClients();
	$empty = 'There are currently no records.';
	
}


$objPaging = new Paging($clients, 5);
$rows = $objPaging->getRecords();


$objPaging->_url = G_PATH.'admin'.$objPaging->_url;


require_once('template/_header.php'); 
?>

<header class="mdl-layout__header">

<div class="mdl-layout__header-row">

<div class="mdl-layout-spacer"></div>

<span class="mdl-layout-title mdl-typography--text-center mdl-typography--display-3">Clients</span>

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
		<th class="mdl-data-table__cell--non-numeric">Name</th>
		<th class="col_15 ta_r">Remove</th>
		<th class="col_5 ta_r">View</th>
	</tr>
	
	<?php foreach($rows as $client) { ?>
	
	<tr>
		<td class="mdl-data-table__cell--non-numeric"><?php echo Helper::encodeHtml($client->first_name." ".$client->last_name);
		?></td>
		<td class="ta_r">
		<?php 
			$orders = $objOrder->getClientOrders($client->id);
							
			if (empty($orders)) { 
		?>
			<a href="<?php G_PATH.'admin'.DS ?>?page=clients&amp;action=remove&amp;id=<?php echo $client->id; ?>">Remove</a>
		<?php } else { ?>
			<span class="inactive">Remove</span>
		<?php } ?>
		</td>		
		<td class="ta_r">
			<a href="<?php G_PATH.'admin'.DS ?>?page=clients&amp;action=edit&amp;id=<?php echo $client->id; ?>">Edit</a>
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





