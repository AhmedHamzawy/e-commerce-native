<?php 
$id = Url::getParam('id');

if (!empty($id)) {
	
	$objOrder = new Order();
	$order = $objOrder->getOrder($id);
	
	if (!empty($order)) {
	
		$objForm = new Form();
		$objValid = new Validation($objForm);
				
		$objClient = new Client();
		$client = $objClient->getUser($order->client);
		
		$objCountry = new Country();
		
		$objCatalogue = new Catalogue();
		
		$objOrderItems = new orderItems();
		
		$items = $objOrderItems->getOrderItems($id);	
		
		
		$objStatuses = new Statuses();
		
		$status = $objStatuses->getStatuses();
		
			
			
		if ($objForm->isPost('status')) {
			
			$objValid->_expected = array('status', 'notes');
			$objValid->_required = array('status');
			
			$vars = $objForm->getPostArray($objValid->_expected);
			
			if ($objValid->isValid()) {
				
				if ($objOrder->updateOrder($id, $vars)) {
					Helper::log_action('Order Updated' , "An Order {$id} is updated");				
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
        
        <span class="mdl-layout-title mdl-typography--text-center mdl-typography--display-3">Orders :: View</span>
        
        <div class="mdl-layout-spacer"></div>
        
        
        
        </div>
    </header>
    
     
	
	<form action="" method="post">
		
		<table cellpadding="0" cellspacing="0" border="0" class="mdl-data-table mdl-js-data-table mdl-data-table
         mdl-shadow--2dp">
			
			<tr>
				<th>Date:</th>
				<td colspan="4"><?php echo Helper::setDate(2, $order->date); ?></td>
			</tr>
			
			<tr>
				<th>Order no:</th>
				<td colspan="4"><?php echo $order->id; ?></td></td>
			</tr>
			
			<?php if (!empty($items)) { ?>
			
				<tr>
					<th rowspan="<?php echo count($items) + 1; ?>" >Items:</th>
					<td class="col_5">Id</td>
					<td>Item</td>
					<td class="col_5 ta_r">Qty</td>
					<td class="col_15 ta_r">Amount</td>
				</tr>
				
				<?php 
					foreach($items as $item) { 
						$product = $objCatalogue->displayProduct($item->product);
				?>
				
					<tr>
						<td><?php echo $product->id; ?></td>
						<td><?php echo Helper::encodeHtml($product->name); ?></td>
						<td class="ta_r"><?php echo $item->qty; ?></td>
						<td class="ta_r">&pound;<?php echo number_format(($item->price * $item->qty), 2); ?></td>						
					</tr>
				
				<?php } ?>
			
			<?php } ?>
			
			<tr>
				<th>Sub-total:</th>
				<td colspan="4" class="ta_r">
					&pound;<?php echo number_format($order->subtotal, 2); ?>
				</td>
			</tr>
			
			<tr>
				<th>VAT (<?php echo $order->vat_rate ; ?>%):</th>
				<td colspan="4" class="ta_r">
					&pound;<?php echo number_format($order->vat, 2); ?>
				</td>
			</tr>
			
			<tr>
				<th>Total:</th>
				<td colspan="4" class="ta_r">
					<strong>&pound;<?php echo number_format($order->total, 2); ?></strong>
				</td>
			</tr>
			
			<tr>				
				<th>Client:</th>
				<td colspan="4">
					<?php
						echo Helper::encodeHtml($client->first_name." ".$client->last_name).'<br />';
						echo Helper::encodeHtml($client->address_1).'<br />';
						echo Helper::encodeHtml($client->address_2).'<br />';
						echo Helper::encodeHtml($client->town).'<br />';
						echo Helper::encodeHtml($client->county).'<br />';
						echo Helper::encodeHtml($client->post_code).'<br />';
						$country = $objCountry->getCountry($client->country);
						echo Helper::encodeHtml($country->name).'<br />';
						echo '<a href="mailto:';
						echo $client->email;
						echo '">';
						echo $client->email;
						echo '</a>';
					?>
				</td>				
			</tr>
			
			<tr>
				<th>PP status:</th>
				<td colspan="4">
				<?php 
					echo !empty($order->payment_status) ?
						Helper::encodeHtml($order->payment_status) :
						"Pending";
				?>
				</td>
			</tr>
			    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">

			<tr>
				<th><label for="status">Order status:</label></th>
				<td colspan="4">
					<?php $objValid->validate('status'); ?>
					<?php if (!empty($status)) { ?>
					<select name="status" id="status" class="mdl-textfield__input">
						<?php foreach($status as $stat) { ?>
						<option value="<?php echo $stat->id; ?>"
						<?php echo $objForm->stickySelect('status', $stat->id, $order->status); ?>>
						<?php echo Helper::encodeHtml($stat->name); ?></option>
						<?php } ?>
					</select>
					<?php } ?>
				</td>
			</tr>
			
			<tr>
				<th><label for="notes">Notes:</label></th>
				<td colspan="4">
					<textarea name="notes" id="notes" cols="" rows=""
					class="mdl-textfield__input"><?php echo $objForm->stickyText('notes', $order->notes); ?></textarea>
				</td>
			</tr>
			</div>
			<tr>
				<th>&nbsp;</th>
				<td colspan="4">
				
						<a href="<?php echo G_PATH.'admin'.Url::getCurrentUrl(array('action')).'&action=invoice'; ?>" class=	                       "btn mdl-button mdl-js-button mdl-js-ripple-effect" target="_blank">Invoice</a>
					
			       <a href="<?php echo G_PATH.'admin'.Url::getCurrentUrl(array('action', 'id')); ?>" class="btn
                   mdl-button mdl-js-button mdl-js-ripple-effect">Go back</a>
					
						<input type="submit" id="btn_update" class="btn
                         mdl-button mdl-js-button mdl-js-ripple-effect" value="Update" />
					
				</td>
			</tr>
			
		</table>
		
	</form>

<?php 
		require_once('template/_footer.php'); 
	}
}
?>



