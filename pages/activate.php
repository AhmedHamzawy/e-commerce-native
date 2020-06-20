<?php
$code = Url::getParam('code');

if (!empty($code)) {
	
	$objclient = new Client();
	$client = $objclient->getClientByHash($code);

	if (!empty($client)) {
		
		if ($client[0]->active == 0) {
			if ($objclient->makeActive($client[0]->id)) {
				$mess  = "<div class=\"messagecon\" style=\"margin:5% auto\" >";
				$mess .= "<i class=\"material-icons md-150\">mood</i>";
				$mess  = "<h1 class=\"mdl-typography--text-center mdl-typography--display-3\">Thank you</h1><br />";
				$mess .= "<p>Your account has now been successfully activated.<br />";
				$mess .= "You can now log in and continue with your order.</p>";
				$mess .= "</div>";
			} else {
				$mess  = "<div class=\"messagecon\">";
				$mess .= "<i class=\"material-icons md-150\">sentiment_very_dissatisfied</i>";
				$mess  = "<h1 class=\"mdl-typography--text-center mdl-typography--display-3\">Activation unsuccessful</h1>
				<br />";
				$mess .= "<p>There has been a problem activating your account.<br />";
				$mess .= "Please contact administrator.</p>";
				$mess .= "</div>";			
			}
		} else {
			$mess  = "<div class=\"messagecon\" >";
			// $mess .= "<i class=\"material-icons md-150\">mood</i>";
			$mess  = "<h1 class=\"mdl-typography--text-center mdl-typography--display-3\">Account already activated</h1>
			<br />";
			$mess .= "<p>This account has already been activated.</p>";
			$mess  = "</div>"; 

		}
		
	} else {
		Helper::redirect("/?page=error");
	}
	
	require_once("header.php");
	echo $mess;
	require_once("footer.php");
	
} else {
	Helper::redirect("/?page=error");
}






		