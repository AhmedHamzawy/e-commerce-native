<?php 
$id = Url::getParam('id');

if (!empty($id)) {

	$objproducts = new products();
	$product = $objproducts->getProduct($id);
	
	if (!empty($product)) {
		
		$yes = G_PATH.'admin'.Url::getCurrentUrl().'&amp;remove=1';
		$no = 'javascript:history.go(-1)';
		
		$remove = Url::getParam('remove');
		
		if (!empty($remove)) {
			
			$objproducts->removeProduct($id);
			
			Helper::redirect(G_PATH.'admin'.Url::getCurrentUrl(array('action', 'id', 'remove', 'srch', Paging::$_key)));
			
		}
		
		require_once('template/_header.php'); 
?>


<header class="mdl-layout__header">

    <div class="mdl-layout__header-row">
    
    
    <div class="mdl-layout-spacer"></div>
    
    <span class="mdl-layout-title mdl-typography--text-center mdl-typography--display-3">Products :: Remove</span>
    
    <div class="mdl-layout-spacer"></div>
    
    
    
    </div>
    
</header>

<div class="messagecon">

<img src="../images/warning.png" />

<p>Are you sure you want to remove this record?<br />
There is no undo!<br />
<a href="<?php echo $yes; ?>">Yes</a> | <a href="<?php echo $no; ?>">No</a></p>

</div>
<?php 
		require_once('template/_footer.php'); 
	}	
}
?>