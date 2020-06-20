<?php 


//check if the admin is logged in 

$session =  Session::getInstance();
if ($session->is_logged_in(Login::$_login_admin)) {Helper::redirect(Login::$_dashboard_admin);}


// login form validation

$objForm = new Form();
$objValid = new Validation($objForm);


// admin authentication

if ($objForm->isPost('login_email')) {

	$objAdmin = new Admin();
	$foundAdmin = $objAdmin->authenticate($objForm->getPost('login_email'), $objForm->getPost('login_password'));
	if ($foundAdmin) {

		$session->login(Login::$_login_admin,$foundAdmin);

		
	} else {
		
		// show errors 
		
		$objValid->add2Errors('login');
	}
	
}



// header template

require_once('template/_header.php'); 


?>

</div>

<div class="mdl-card mdl-shadow--2dp wrapper">

    <div class="mdl-card__title text-center mdl-color--primary mdl-color-text--white">
    <h2 class="mdl-card__title-text">Login</h2>
    </div>

    
<div class="mdl-card__supporting-text">

                <form action="" method="post">
                	<?php echo $objValid->validate('login'); ?>
                    <div class="mdl-textfield mdl-js-textfield">
                    
                        
                        <input type="text" class="mdl-textfield__input" name="login_email" id="login_email"
                        class="fld" value="" />
                        <label class="mdl-textfield__label" for="login_email">Login:</label>    
                    
                    </div>
                    
                    <div class="mdl-textfield mdl-js-textfield"> 
                    
                        <input type="password" class="mdl-textfield__input" name="login_password" id="login_password"
                        class="fld" value="" />
                        <label class="mdl-textfield__label" for="login_password">Password:</label>    
                    
                    </div> 
                    
                     
                                <button class="mdl-button mdl-js-button mdl-js-ripple-effect"  type="submit" 
                                class="btn" value="Next" >
                                Login
                                </button>

        
           


</form>

</div>

</div>


<?php require_once('template/_footer.php'); ?>


