<?php

// preventing from click-jacking 
// header("X-Frame-Options: DENY");
// header("Content-Security-Policy: frame-ancestors 'none'", false);


$sessionOne = Session::getInstance();
$objCatalogue = new Catalogue();
$cats = $objCatalogue->displayCategories();
$objBusiness = new Business();
$business = $objBusiness->getBusiness();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Ecstacy Ecommerce website project</title>
<meta name="description" content="Ecstacy Ecommerce website project" />
<meta name="keywords" content="Ecstacy Ecommerce website project" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<!-- Update your html tag to include the itemscope and itemtype attributes. -->
<html itemscope itemtype="http://schema.org/Product">

<!-- Place this data between the <head> tags of your website -->
<title>Page Title. Maximum length 60-70 characters</title>
<meta name="description" content="Page description. No longer than 155 characters." />

<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="The Name or Title Here">
<meta itemprop="description" content="This is the page description">
<meta itemprop="image" content="http://www.example.com/image.jpg">

<!-- Twitter Card data -->
<meta name="twitter:card" content="product">
<meta name="twitter:site" content="@publisher_handle">
<meta name="twitter:title" content="Page Title">
<meta name="twitter:description" content="Page description less than 200 characters">
<meta name="twitter:creator" content="@author_handle">
<meta name="twitter:image" content="http://www.example.com/image.html">
<meta name="twitter:data1" content="$3">
<meta name="twitter:label1" content="Price">
<meta name="twitter:data2" content="Black">
<meta name="twitter:label2" content="Color">

<!-- Open Graph data -->
<meta property="og:title" content="Title Here" />
<meta property="og:type" content="article" />
<meta property="og:url" content="http://www.example.com/" />
<meta property="og:image" content="http://example.com/image.jpg" />
<meta property="og:description" content="Description Here" />
<meta property="og:site_name" content="Site Name, i.e. Moz" />
<meta property="og:price:amount" content="15.00" />
<meta property="og:price:currency" content="USD" />



<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="css/mdl/material.min.css">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css" />
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/core.css" rel="stylesheet" type="text/css" />
<link href="css/slide.css" rel="stylesheet" type="text/css" />
<link href="css/rate.css" rel="stylesheet" type="text/css" />
<link href="css/carousel.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />

<!--<script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>-->
<script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="css/mdl/material.min.js"></script>
<script type="text/javascript" src="js/slide.js"></script>
<script type="text/javascript" src="js/carousel.js"></script>


<script>
var scrollTo = function(top) {
  var content = $(".mdl-layout__content");
  var target = top ? 0 : $(".page-content").height();
  content.stop().animate({ scrollTop: target }, "slow");
};

var scrollToTop = function() {
  scrollTo(true);
};


$(function() {
  $("#scroll-up-btn").click(scrollToTop);
});
</script>


<script type="text/javascript" src="js/wow.min.js"></script>
<script>
new WOW().init();

</script>


</head>



<body  class="mdl-layout__content animated fadeIn">

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<div id="loader-wrapper">
		
			<div id="loader"></div>
			<div class="loader-section section-left"></div>
			<div class="loader-section section-right"></div>

</div>
		




<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header wrapper-parallax">


    <header id="header" class="mdl-layout__header">
    
    
        <div id="header_in" class="mdl-layout__header-row">
        
        
        	<!--title-->
            <span class="mdl-layout-title"><a href="<?php G_PATH ?>"><?php echo $business->name; ?></a></span>
            
            <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>
            
             
               
           	<!--Client Name-->      
            <?php
                if($sessionOne->is_logged_in(Login::$_login_front)){ 
                    echo '<div id="logged_as">Logged in as: <strong>';
                    echo $sessionOne->getFullNameFront(Login::$_login_front);
                    echo '</strong> | <a href="'.G_PATH.'?page=orders">My orders</a>';
                    echo ' | <a href="'.G_PATH.'?page=logout">Logout</a></div>';	
                }else{
                    echo '<div id="logged_as"><a href="'.G_PATH.'?page=login">Login</a></div>';
                }
            ?>
            
           
            
       </div>
       
    </header>
 
<main class="mdl-layout__content">
<div class="page-content mdl-grid mdl-cell--10-col">

    	