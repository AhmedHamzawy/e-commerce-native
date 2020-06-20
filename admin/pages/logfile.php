<?php

  $session = Session::getInstance();
  $session->restrictAdmin();
	
  $logfile = G_PATH.DS.'logs'.DS.'log.txt';

  if(Url::getParam('clear') == 'true') {
		file_put_contents($logfile, '');
	  // Add the first log entry
	  Helper::log_action('Logs Cleared', "by User ID {$session->admin_id}");
    // redirect to this same page so that the URL won't 
    // have "clear=true" anymore
   Helper::redirect(G_PATH.'admin'.DS."?page=logfile");
  }
  

require_once('template/_header.php');   
  
?>



<header class="mdl-layout__header">

<div class="mdl-layout__header-row">

<!-- Colored FAB button with ripple -->
<div class="add">
    <a href=<?php G_PATH.'admin'.DS ?>"?page=logfile&clear=true">
    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
      <i class="material-icons">clear</i>
    </button>
    </a>
</div>

<div class="mdl-layout-spacer"></div>

<span class="mdl-layout-title mdl-typography--text-center mdl-typography--display-3">Log File</span>

<div class="mdl-layout-spacer"></div>


</div>
</header>

<div class="messagecon">

<?php

  if( file_exists($logfile) && is_readable($logfile) && 
			$handle = fopen($logfile, 'r')) {  // read
    echo "<ul class=\"log-entries\">";
		while(!feof($handle)) {
			$entry = fgets($handle);
			if(trim($entry) != "") {
				echo "<li>{$entry}</li>";
			}
		}
		echo "</ul>";
    fclose($handle);
  } else {
    echo "Could not read from {$logfile}.";
  }

?>

</div>

<?php require_once('template/_footer.php'); ?>
