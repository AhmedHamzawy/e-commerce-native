<?php 

$objOrder = new Order();


$srch = Url::getParam('srch');


if (!empty($srch)) {
	
	$orders = $objOrder->getOrders($srch);
	$empty = 'There are no results matching your searching criteria.';
	
} else {
	
	$orders = $objOrder->getOrders();
	$empty = 'There are currently no records.';
	
}

$objPaging = new Paging($orders, 5);
$rows = $objPaging->getRecords();

$objPaging->_url = G_PATH.'admin'.$objPaging->_url;

require_once('template/_header.php'); 
?>


<header class="mdl-layout__header">

<div class="mdl-layout__header-row">

<div class="mdl-layout-spacer"></div>

<span class="mdl-layout-title mdl-typography--text-center mdl-typography--display-3">Orders</span>

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
		<th>Date</th>
		<th class="col_15 ta_r">Total</th>
		<th class="col_15 ta_r">Status</th>
		<th class="col_15 ta_r">PP Status</th>
		<th class="col_15 ta_r">Remove</th>
		<th class="col_5 ta_r">View</th>
	</tr>
	
	<?php foreach($rows as $order) { ?>
	
	<tr>
		<td class="mdl-data-table__cell--non-numeric"><?php echo $order->id; ?></td>
		<td><?php echo Helper::setDate(1, $order->date); ?></td>
		<td class="ta_r">&pound;<?php echo number_format($order->total, 2); ?></td>
		<td class="ta_r">
		<?php 
		    $objStatus = new statuses();
			$status = $objStatus->getStatus($order->status);
			echo $status->name;	
		?>
		</td>
		<td class="ta_r">
		<?php 
			echo $order->payment_status != null ? 
				$order->payment_status :
				"Pending";
		?>
		</td>
		<td class="ta_r">
		<?php if ($order->status == 1) { ?>
			<a href=<?php G_PATH.'admin'.DS ?>"?page=orders&amp;action=remove&amp;id=<?php echo $order->id; ?>">Remove</a>
		<?php } else { ?>
			<span class="inactive">Remove</span>
		<?php } ?>
		</td>		
		<td class="ta_r">
			<a href=<?php G_PATH.'admin'.DS ?>"?page=orders&amp;action=edit&amp;id=<?php echo $order->id; ?>">View</a>
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





