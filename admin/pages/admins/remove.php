<?php 
$id = Url::getParam('id');

if (!empty($id)) {

	$objAdmin = new Admin();
	$admin = $objAdmin->getUser($id);

	if (!empty($admin)) {
	
			$yes = G_PATH.'admin'.Url::getCurrentUrl().'&amp;remove=1';
			$no = 'javascript:history.go(-1)';
			
			$remove = Url::getParam('remove');

			if (!empty($remove)) {
				
				$username = $admin->first_name.' '.$admin->last_name;
 			    Helper::log_action('Admin Deleted' , "The Admin {$username} is deleted");
				$objAdmin->removeUser($id);
				
				Helper::redirect(G_PATH.'admin'.Url::getCurrentUrl(array('action', 'id', 'remove', 'srch', Paging::$_key)));
			}
			
			require_once('template/_header.php'); 
?>



<header class="mdl-layout__header">

    <div class="mdl-layout__header-row">
    
    
    <div class="mdl-layout-spacer"></div>
    
    <span class="mdl-layout-title mdl-typography--text-center mdl-typography--display-3">Admins :: Remove</span>
    
    <div class="mdl-layout-spacer"></div>
    
    
    
    </div>
    
</header>

<div class="messagecon">

<img src="../images/warning.png" />


<p>Are you sure you want to remove this admin (<?php echo $admin->first_name." ".$admin->last_name; ?>)?<br />
There is no undo!<br />
<a href="<?php echo $yes; ?>">Yes</a> | <a href="<?php echo $no; ?>">No</a></p>

</div>
<?php 
			require_once('template/_footer.php'); 
		}
	}	

?>