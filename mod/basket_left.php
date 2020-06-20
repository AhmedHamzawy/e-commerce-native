<?php Session::getInstance(); 
$objBasket = new Basket(); ?>
<i class="material-icons">shopping_cart</i>
<span class="mdl-typography--headline">Your Basket</span>

<ul class="demo-list-item mdl-list">
<dl id="basket_left">
	<li class="mdl-list__item">
    <span class="mdl-list__item-primary-content">
    <i class="material-icons">local_offer</i>
    <dt>No. of items:</dt>
	<dd class="bl_ti"><span><?php echo $objBasket->_number_of_items; ?></span></dd>
    </span>
    </li>
    <li class="mdl-list__item">
    <span class="mdl-list__item-primary-content">
    <i class="material-icons">star</i>
	<dt>Sub-total:</dt>
	<dd class="bl_st">&pound;<span><?php echo number_format($objBasket->_sub_total, 2); ?></span></dd>
    </span>
    </li>
    <li class="mdl-list__item">
    <span class="mdl-list__item-primary-content">
     <i class="material-icons">star</i>
	<dt>VAT (<span><?php echo $objBasket->_vat_rate; ?></span>%):</dt>
	<dd class="bl_vat">&pound;<span><?php echo number_format($objBasket->_vat, 2); ?></span></dd>
    </span>
    </li>
    <li class="mdl-list__item">
    <span class="mdl-list__item-primary-content">
     <i class="material-icons">star</i>
	<dt>Total (inc):</dt>
	<dd class="bl_total">&pound;<span><?php echo number_format($objBasket->_total, 2); ?></span></dd>
    </span>
    </li>
</dl>
</ul>



<div class="dev br_td">&#160;</div>
<li class="mdl-list__item">
    <span class="mdl-list__item-primary-content">
<p>
<i class="material-icons">shopping_cart</i>
<a href=<?php G_PATH.DS ?>"?page=basket">View Basket</a>
 | 
<i class="material-icons">check</i> 
 <a href=<?php G_PATH.DS ?>"?page=checkout">Checkout</a></p>
</span>
</li>
<div class="dev br_td">&#160;</div>
