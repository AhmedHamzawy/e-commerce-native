<?php
$session = Session::getInstance();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Ecommerce website project</title>
<meta name="description" content="Ecommerce website project" />
<meta name="keywords" content="Ecommerce website project" />
<meta http-equiv="imagetoolbar" content="no" />

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href="../css/Kaushan.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
<link rel="stylesheet" href="../css/mdl/material.min.css">
<link href="../css/reset.css" rel="stylesheet" type="text/css" />
<link href="../css/core.css" rel="stylesheet" type="text/css" />


<script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
<script src="../css/mdl/material.min.js"></script>


</head>
<body>


<?php $page = Url::getParam('page'); ?>

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
<header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
        <span class="mdl-layout-title"><a href="<?php G_PATH.'admin'.DS ?>?page=products">Ecstasy Admin Panel</a></span>
        <div class="mdl-layout-spacer"></div>
			<?php
				if($session->is_logged_in(Login::$_login_admin)){
				echo '<div id="logged_as">Logged in as: <strong>';
				echo $session->getFullNameFront(Login::$_login_admin);
				echo '</strong> | <a href="?page=logout">Logout</a></div>';	
				}else{
				echo '<div id="logged_as"><a href="/admin/">Login</a></div>';
				}
            ?>
        </div>
</header>

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer">
  
    <div class="mdl-layout__drawer">
    
		<?php if($page == NULL) { } else { ?>
        
        
        <span class="mdl-layout-title">Navigation</span>
        
        
        <nav class="mdl-navigation">
        
            <a class="mdl-navigation__link" href="<?php G_PATH.'admin'.DS ?>?page=products"
            <?php echo Helper::getActive(
            array('page' => 'products')
            ); ?>>
            products
            </a>
            
            <a class="mdl-navigation__link" href="<?php G_PATH.'admin'.DS ?>?page=categories"
            <?php echo Helper::getActive(
            array('page' => 'categories')
            ); ?>>
            categories
            </a>
            
            <a class="mdl-navigation__link" href="<?php G_PATH.'admin'.DS ?>?page=orders"
            <?php echo Helper::getActive(
            array('page' => 'orders')
            ); ?>>
            orders
            </a>
            
            <a class="mdl-navigation__link" href="<?php G_PATH.'admin'.DS ?>?page=clients"
            <?php echo Helper::getActive(
            array('page' => 'clients')
            ); ?>>
            clients
            </a>
            
            <a class="mdl-navigation__link" href="<?php G_PATH.'admin'.DS ?>?page=admins"
            <?php echo Helper::getActive(
            array('page' => 'admins')
            ); ?>>
            admins
            </a>
            
            <a class="mdl-navigation__link" href="<?php G_PATH.'admin'.DS ?>?page=logfile"
            <?php echo Helper::getActive(
            array('page' => 'logfile')
            ); ?>>
            logfile
            </a>
            
            <a class="mdl-navigation__link" href="<?php G_PATH.'admin'.DS ?>?page=business"
            <?php echo Helper::getActive(
            array('page' => 'business')
            ); ?>>
            business
            </a>
        </nav>
        <?php } ?>
    
    </div>


<main class="mdl-layout__content">
<div class="page-content">

		
		
		
		
		
		