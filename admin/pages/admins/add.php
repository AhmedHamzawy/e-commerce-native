<?php 

// adding form validation

$objForm = new Form();
$objValid = new Validation($objForm);

$objAdmins = new Admin();


if ($objForm->isPost('first_name')) {

$objValid->_expected = array(
'first_name',
'last_name',
'email',
'password',
'confirm_password'
);

$objValid->_required = array(
'first_name',
'last_name',
'email',
'password',
'confirm_password'
);

$objValid->_special = array(
'email' => 'email'
);

$objValid->_post_remove = array(
'confirm_password'
);

$objValid->_post_format = array(
'password' => 'password'
);


// validate password
$pass_1 = $objForm->getPost('password');
$pass_2 = $objForm->getPost('confirm_password');

if (!empty($pass_1) && !empty($pass_2) && $pass_1 != $pass_2) {
$objValid->add2Errors('password_mismatch');
}


$email = $objForm->getPost('email');
$admin = $objAdmins->getByEmail($email,false);

if (!empty($admin)) {
$objValid->add2Errors('email_duplicate');
}



if ($objValid->isValid()) {


if ($objAdmins->addUser($objValid->_post)) {

$username = $objValid->_post["first_name"].' '.$objValid->_post["last_name"];
Helper::log_action('Admin Added' , "A new Admin {$username} is added");
Helper::redirect(G_PATH.'admin'.Url::getCurrentUrl(array('action', 'id')).'&action=added');

} else {
Helper::redirect(G_PATH.'admin'.Url::getCurrentUrl(array('action', 'id')).'&action=added-failed');
}

}

}

// header template

require_once('template/_header.php'); 
?>


<header class="mdl-layout__header">

    <div class="mdl-layout__header-row">
    
    
    <div class="mdl-layout-spacer"></div>
    
    <span class="mdl-layout-title mdl-typography--text-center mdl-typography--display-3">Admins :: Add</span>
    
    <div class="mdl-layout-spacer"></div>
    
    
    
    </div>
    
</header>


<div class="mdl-card mdl-shadow--2dp wrapper frmcont">

    <div class="mdl-card__title text-center mdl-color--primary mdl-color-text--white">
    <h2 class="mdl-card__title-text">Admins :: Add</h2>
    </div>
        <div class="mdl-card__supporting-text">
        
        <form action="" method="post" enctype="multipart/form-data">
        
        <?php echo $objValid->validate('first_name'); ?>
        
        <div class="mdl-textfield mdl-js-textfield">
        
        <label for="first_name" class="mdl-textfield__label">First name: *</label>
        
        <input type="text" name="first_name" id="first_name" class="mdl-textfield__input" 
        value="<?php echo $objForm->stickyText('first_name'); ?>" />
        
        </div>
        
        <?php echo $objValid->validate('last_name'); ?>
        
        <div class="mdl-textfield mdl-js-textfield">
         
        <label for="last_name" class="mdl-textfield__label">Last name: *</label>
        
        
        <input type="text" name="last_name" id="last_name" class="mdl-textfield__input"
        value="<?php echo $objForm->stickyText('last_name'); ?>" />
        </div>
        
        
        <?php echo $objValid->validate('email'); ?>
        <?php echo $objValid->validate('email_duplicate'); ?>
        <div class="mdl-textfield mdl-js-textfield">
        
        <label for="email" class="mdl-textfield__label">Email address: *</label>
        
        
        
        <input type="text" name="email" id="email" class="mdl-textfield__input" 
        value="<?php echo $objForm->stickyText('email'); ?>" />
        
        </div>
        
        <?php echo $objValid->validate('password'); ?>
        <?php echo $objValid->validate('password_mismatch'); ?>
       <div class="mdl-textfield mdl-js-textfield">
        
        <label for="password" class="mdl-textfield__label">Password: *</label>
        
        
        
        <input type="password" name="password" id="password" class="mdl-textfield__input" 
        value="" />
        
        </div>
        
        <?php echo $objValid->validate('confirm_password'); ?>
        
        <div class="mdl-textfield mdl-js-textfield">
        
        <label for="confirm_password" class="mdl-textfield__label">Confirm password: *</label>
        
        
        <input type="password" name="confirm_password"
        id="confirm_password" class="mdl-textfield__input" value="" />
        
        </div>
        
        <div class="mdl-textfield mdl-js-textfield">
        
        <input type="submit" id="btn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect
        mdl-button--accent mdl-align-center"  value="Add" />
        
        </div>
        
        </form>
        </div>
</div>

<?php require_once('template/_footer.php'); ?>



