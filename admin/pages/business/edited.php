<?php
$url = '/admin'.Url::getCurrentUrl(array('action', 'id'));
require_once('template/_header.php');
?>
<header class="mdl-layout__header">

    <div class="mdl-layout__header-row">
    
    
    <div class="mdl-layout-spacer"></div>
    
    <span class="mdl-layout-title mdl-typography--text-center mdl-typography--display-3">Business :: Edit</span>
    
    <div class="mdl-layout-spacer"></div>
    
    
    
    </div>
    
</header>


<div class="messagecon">

<img src="../images/tick.png" />


<p>The record has been updated successfully<br />
<a href="<?php echo $url; ?>">Go back to the business record</a></p>

</div>
<?php require_once('template/_footer.php'); ?>