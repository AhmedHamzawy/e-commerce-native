<?php 
$id = Url::getParam('id');

if (!empty($id)) {

	$objClient = new Client();
	$client = $objClient->getUser($id);
	
	if (!empty($client)) {
		
		$objOrder = new Order();
		$orders = $objOrder->getClientOrders($id);
		
		if (empty($orders)) {
		
			$yes = G_PATH.'admin'.Url::getCurrentUrl().'&amp;remove=1';
			$no = 'javascript:history.go(-1)';
			
			$remove = Url::getParam('remove');
			
			if (!empty($remove)) {
				
				$objClient->removeUser($id);
 			   	Helper::log_action('Client Deleted' , "The Client {$id} is deleted");
				Helper::redirect(G_PATH.'admin'.Url::getCurrentUrl(array('action', 'id', 'remove', 'srch', Paging::$_key)));
				
			}
			
			require_once('template/_header.php'); 
?>

<header class="mdl-layout__header">

    <div class="mdl-layout__header-row">
    
    
    <div class="mdl-layout-spacer"></div>
    
    <span class="mdl-layout-title mdl-typography--text-center mdl-typography--display-3">Clients :: Remove</span>
    
    <div class="mdl-layout-spacer"></div>
    
    
    
    </div>
    
</header>

<div class="messagecon">

<img src="../images/warning.png" />


<p>Are you sure you want to remove this client (<?php echo $client->first_name." ".$client->last_name; ?>)?<br />
There is no undo!<br />
<a href="<?php echo $yes; ?>">Yes</a> | <a href="<?php echo $no; ?>">No</a></p>
<?php 
			require_once('template/_footer.php'); 
		}
	}	
}
?>