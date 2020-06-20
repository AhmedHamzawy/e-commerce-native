<?php
$session = Session::getInstance();
$session->restrictFront();

$token1 = mt_rand();
$token2 = Login::password_encrypt($token1);
Session::getInstance();
Session::setSession('token2', $token2);

$objBasket = new Basket();

$out = array();

$session = Session::getSession('basket');

if (!empty($session)) {
	$objCatalogue = new Catalogue();
	foreach($session as $key => $value) {
		$out[$key] = $objCatalogue->displayProduct($key);
	}
}

require_once("header.php");
?>

</div>
<h1 class="mdl-typography--text-center mdl-typography--display-3">Order summary</h1>

<?php if (!empty($out)) { ?>

<div id="big_basket">

	<form action="" method="post" id="frm_basket">
		
		<table cellpadding="0" cellspacing="0" border="0" class="mdl-data-table mdl-js-data-table mdl-data-table 
        mdl-shadow--2dp bb">
		
			<tr>
				<th class="mdl-data-table__cell--non-numeric">Item</th>
				<th class="ta_r">Qty</th>
				<th class="ta_r col_15">Price</th>
			</tr>
			
			<?php foreach($out as $item) { ?>
			
				<tr>
					<td class="mdl-data-table__cell--non-numeric"><?php echo $item->name; ?></td>
					<td class="ta_r"><?php echo $session[$item->id]['qty']; ?></td>
				<td class="ta_r">&pound;<?php echo number_format($objBasket->itemTotal($item->price, $session[$item->id]['qty'])
				, 2); ?></td>
				</tr>				
			<?php } ?>
			
			<?php if ($objBasket->_vat_rate > 0) { ?>
			
			<tr>
				<td colspan="2" class="br_td">
					Sub-total:
				</td>
				<td class="ta_r br_td">
					&pound;<?php echo number_format($objBasket->_sub_total, 2); ?>
				</td>
			</tr>
			
			<tr>
				<td colspan="2" class="br_td">
					VAT (<?php echo $objBasket->_vat_rate; ?>%)
				</td>
				<td class="ta_r br_td">
					&pound;<?php echo number_format($objBasket->_vat, 2); ?>
				</td>
			</tr>
			
			<?php } ?>
			
			<tr>
				<td colspan="2" class="br_td">
					<strong>Total:</strong>
				</td>
				<td class="ta_r br_td">
					<strong>&pound;<?php echo number_format($objBasket->_total, 2); ?></strong>
				</td>
			</tr>
			
		</table>
		
		
		<div class="sbm sbm_blue fl_r paypal" 
			id="<?php echo $token2; ?>">
			<span class="btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect
         mdl-button--accent">
            Proceed to PayPal</span>
		</div>
		
		<div class="sbm sbm_blue fl_l">
			<a href="/?page=basket" class="btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect
         mdl-button--accent">Amend order</a>
		</div>
        
       

		
	</form>
	
	

<?php } else { ?>

	<p>Your basket is currently empty.</p>

<?php } ?>


<?php
require_once("footer.php");

?>