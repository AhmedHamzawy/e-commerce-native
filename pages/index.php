<?php require_once('header.php'); ?>

<?php $imagesTotal = 4; ?>
</div>

<section>
<div class="galleryPreviewContainer">

    <div class="title">
    
    
            <h1 class="mdl-typography--text-center mdl-typography--display-3">
            
            <div class="wow slideInUp" data-wow-delay="2s">
            Ecstacy E-coommerce
            </div>
            <div class="wow slideInUp" data-wow-delay="3s">
            One Of The Biggest Platforms You Can 
            </div>
            
            <a href="/?page=catalogue&category=5">
            
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored
            wow fadeIn" data-wow-delay="4s">Shop Now
            </button>
            
            </a>
            </h1>
    
    </div>
    
    <div class="galleryPreviewImage">
    
    
			<?php
            for ($i = 1; $i <= $imagesTotal; $i++) {
            echo '<img class="previewImage' . $i . '" src="images/slide/'. $i . '.jpg"  alt="" />';
            }
            ?>
    
    
    </div>


</div>
</section>

<section>
<div class="all_products">

        <h1 class="parallax mdl-typography--text-center mdl-typography--display-2">Latest Products</h1> 
        
        
        <div id="carousel_container">


        <?php 
        $objCatalogue = new Catalogue();
        $allProducts = Products::getAllProducts();
        ?>
        
        
        
        <div id='left_scroll'><a href='javascript:slide("left");'><img src="images/left.png" /></a></div>
        
        <div id='carousel_inner'>
        
        
            <ul id='carousel_ul'> 
            
			
					<?php 		
                    
                    $j =0;
                    if(!empty($allProducts)) {
                    foreach($allProducts as $product) {
                    
                    if ($j == 6) {break;} else {++$j;}
                    
                    $category = $objCatalogue->displayCategory($product->category);	
                    ?>
                    
                    
                    <li class="demo-card-square mdl-card mdl-shadow--2dp">   
                    
                    <div class="mdl-card__title mdl-card--expand">
                    
                    
                    
                    <a href=<?php G_PATH.DS ?>"?page=catalogue-item&amp;category=<?php  echo $category->id; ?>&amp;
                    id=<?php echo $product->id; ?>">
                    
                    <h2 class="mdl-card__title-text">
                    
                            <?php echo Helper::encodeHtml($product->name, 1); ?>
                            <br/>
                            <?php echo $product->_currency; echo number_format
                            ($product->price); ?>
                            
                    </h2>
                    
                    </a>
                    
                    <?php echo Basket::activeButton($product->id); ?>
                    
                    </div>
                    
                    
                    
                    
                    <?php
                    
                    $image = !empty($product->image) ? 
                    $product->_path.$product->image :
                    $product->_path.'unavailable.png';
                    
                    $width = Helper::getImgSize($image, 0);
                    $width = $width > 500 ? 500 : $width;
                    
                    ?>
                    
                    
                    <a href=<?php G_PATH.DS ?>"?page=catalogue-item&amp;category=<?php echo $category->id; ?>&amp;
                    id=<?php echo $product->id; ?>">
                    
                    
                    <div class="mdl-card__media">
                    
                    
                    <img src="<?php echo $image; ?>" alt="<?php echo Helper::encodeHtml($product->name, 1); ?>" 
                    width="<?php echo $width; ?>"
                    />
                    
                    
                    </div>  
                    
                    </a> 
                    
                    
                    <div class="mdl-card__supporting-text">
                    
                    <?php echo Helper::shortenString(Helper::encodeHtml($product->description));  ?>
                    
                    </div>
                    
                    
                    
                    </li>
                    
                    <?php  } } ?>
            
            
           		 </ul>
            
            
            </div>
            
        </div>
        
        
        <div id='right_scroll'><a href='javascript:slide("right");'><img src='images/right.png' /></a></div>
        <input type='hidden' id='hidden_auto_slide_seconds' value=0 />
</div>
</section>

<section>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</section>

<section>
<?php 
$objCatalogue = new Catalogue();

$products = $objCatalogue->displayProductsPublic(5);

$category = $objCatalogue->displaycategory(5); 
?>

<h1 class="parallax mdl-typography--text-center mdl-typography--display-2">Latest From :: <?php echo $category->name; ?></h1>



<div class="mdl-grid products_cat" >

		<?php 		
        
        $k =0;
        if(!empty($products)) {
        foreach($products as $product) {
        
        if ($k == 6) {break;} else {++$k;}
        
        $category = $objCatalogue->displayCategory($product->category);	
        ?>
        
        
        <div class="mdl-cell mdl-cell--4-col demo-card-square mdl-card mdl-shadow--2dp" style="float:left;">   
        
        <div class="mdl-card__title mdl-card--expand">
        
        
        
        <a href=<?php G_PATH.DS ?>"?page=catalogue-item&amp;category=<?php  echo $category->id; ?>&amp;
        id=<?php echo $product->id; ?>">
        
        
        <h2 class="mdl-card__title-text">
        <?php echo Helper::encodeHtml($product->name, 1); ?>
        <br/>
        <?php echo $product->_currency; echo number_format
        ($product->price); ?>
        </h2>
        
        
        </a>
        
        <?php echo Basket::activeButton($product->id); ?>
        
        </div>
        
        
        
        
        <?php
        
        $image = !empty($product->image) ? 
        $product->_path.$product->image :
        $product->_path.'unavailable.png';
        
        $width = Helper::getImgSize($image, 0);
        $width = $width > 450 ? 450 : $width;
        
        ?>
        
        
        <a href=<?php G_PATH.DS ?>"?page=catalogue-item&amp;category=<?php echo $category->id; ?>&amp;
        id=<?php echo $product->id; ?>">
        
        <div class="mdl-card__media">
        
        
        <img src="<?php echo $image; ?>" alt="<?php echo Helper::encodeHtml($product->name, 1); ?>" 
        width="<?php echo $width; ?>"
        />
        
        
        </div>  
        
        </a> 
        
        
        <div class="mdl-card__supporting-text">
        
        <?php echo Helper::shortenString(Helper::encodeHtml($product->description));  ?>
        
        </div>
        
        
        </div>
        
        
        <?php  } } ?>

</div>
</section>



<section>
<?php 
$objCatalogue = new Catalogue();

$products = $objCatalogue->displayProductsPublic(6);

$category = $objCatalogue->displaycategory(6); 
?>

<h1 class="parallax mdl-typography--text-center mdl-typography--display-2">Latest From :: <?php echo $category->name; ?></h1>



<div class="mdl-grid products_cat" >

		<?php 		
        
        $l =0;
        if(!empty($products)) {
        foreach($products as $product) {
        
        if ($l == 6) {break;} else {++$l;}
        
        $category = $objCatalogue->displayCategory($product->category);	
        ?>
        
        
        <div class="mdl-cell mdl-cell--4-col demo-card-square mdl-card mdl-shadow--2dp" style="float:left;">   
        
        <div class="mdl-card__title mdl-card--expand">
        
        
        
        <a href=<?php G_PATH.DS ?>"?page=catalogue-item&amp;category=<?php  echo $category->id; ?>&amp;
        id=<?php echo $product->id; ?>">
        
        
        <h2 class="mdl-card__title-text">
        <?php echo Helper::encodeHtml($product->name, 1); ?>
        <br/>
        <?php echo $product->_currency; echo number_format
        ($product->price); ?>
        </h2>
        
        
        </a>
        
        <?php echo Basket::activeButton($product->id); ?>
        
        </div>
        
        
        
        
        <?php
        
        $image = !empty($product->image) ? 
        $product->_path.$product->image :
        $product->_path.'unavailable.png';
        
        $width = Helper::getImgSize($image, 0);
        $width = $width > 450 ? 450 : $width;
        
        ?>
        
        
        <a href=<?php G_PATH.DS ?>"?page=catalogue-item&amp;category=<?php echo $category->id; ?>&amp;
        id=<?php echo $product->id; ?>">
        
        <div class="mdl-card__media">
        
        
        <img src="<?php echo $image; ?>" alt="<?php echo Helper::encodeHtml($product->name, 1); ?>" 
        width="<?php echo $width; ?>"
        />
        
        
        </div>  
        
        </a> 
        
        
        <div class="mdl-card__supporting-text">
        
        <?php echo Helper::shortenString(Helper::encodeHtml($product->description));  ?>
        
        </div>
        
        
        </div>
        
        
        <?php  } } ?>

</div>
</section>



<section>
<?php 
$objCatalogue = new Catalogue();

$products = $objCatalogue->displayProductsPublic(7); 

$category = $objCatalogue->displaycategory(7); 
?>

<h1 class="parallax mdl-typography--text-center mdl-typography--display-2">Latest From :: <?php echo $category->name; ?></h1>


<div class="mdl-grid products_cat" >

		<?php 		
        
        $m =0;
        if(!empty($products)) {
        foreach($products as $product) {
        
        if ($m == 6) {break;} else {++$m;}
        
        $category = $objCatalogue->displayCategory($product->category);	
        ?>
        
        
        <div class="mdl-cell mdl-cell--4-col demo-card-square mdl-card mdl-shadow--2dp" style="float:left;">   
        
        <div class="mdl-card__title mdl-card--expand">
        
        
        
        <a href=<?php G_PATH.DS ?>"?page=catalogue-item&amp;category=<?php  echo $category->id; ?>&amp;
        id=<?php echo $product->id; ?>">
        
        
        <h2 class="mdl-card__title-text">
        <?php echo Helper::encodeHtml($product->name, 1); ?>
        <br/>
        <?php echo $product->_currency; echo number_format
        ($product->price); ?>
        </h2>
        
        </a>
        
        <?php echo Basket::activeButton($product->id); ?>
        
        </div>
        
        
        
        
        <?php
        
        $image = !empty($product->image) ? 
        $product->_path.$product->image :
        $product->_path.'unavailable.png';
        
        $width = Helper::getImgSize($image, 0);
        $width = $width > 450 ? 450 : $width;
        
        ?>
        
        
        <a href=<?php G_PATH.DS ?>"?page=catalogue-item&amp;category=<?php echo $category->id; ?>&amp;
        id=<?php echo $product->id; ?>">
        
        <div class="mdl-card__media">
        
        
        <img src="<?php echo $image; ?>" alt="<?php echo Helper::encodeHtml($product->name, 1); ?>" 
        width="<?php echo $width; ?>"
        />
        
        
        </div>  
        
        </a> 
        
        
        <div class="mdl-card__supporting-text">
        
        <?php echo Helper::shortenString(Helper::encodeHtml($product->description));  ?>
        
        </div>
        
        
        </div>
        
        
        <?php  } } ?>
        
</div>
</section>

<section>


<div class="mdl-grid parallaxone">

<h1 class="mdl-cell--12-col mdl-typography--text-center mdl-typography--display-2">Sponsored By</h1>

<img src="images/brands/apple.svg" class="mdl-cell mdl-cell--2-col"
style="margin:-1em 0 0 0;" width="90" height="90"  />

<img src="images/brands/philips.svg" class="mdl-cell mdl-cell--2-col" width="90" height="90"  />


<img src="images/brands/casio-logo.svg" class="mdl-cell mdl-cell--2-col"
style="margin:1em 0 0 0" width="70" height="70" />

<img src="images/brands/braun-logo.svg" class="mdl-cell mdl-cell--2-col" width="70" height="70"  />

<img src="images/brands/emporio-armani-2.svg" class="mdl-cell mdl-cell--2-col" width="100" height="100"  />

<img src="images/brands/panasonic.png" class="mdl-cell mdl-cell--2-col"
style="margin:-1.6em 0 0 0" width="100" height="150"  />


</div>


</section>

<section>


<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect" style="text-align:center; font-size:1.5em; line-height:33px;">
<div class="mdl-tabs__tab-bar">
<a href="#testimonial-panel" class="mdl-tabs__tab is-active">Testimonials</a>
<a href="#features-panel" class="mdl-tabs__tab">Features</a>
</div>

<div class="mdl-grid mdl-tabs__panel is-active" id="testimonial-panel">
<div class="mdl-cell--3-col testimonial" style="float:left">
<img src="images/personone.jpg" />
<p>
"I STRONGLY recommend e-commerce to EVERYONE interested in running a successful online business! E-commerce is the next killer app."<br/>- Elden F -
</p>
</div>
<div class="mdl-cell--3-col testimonial" style="float:left">
<img src="images/persontwo.jpg" />
<p>
"I don't always clop, but when I do, it's because of online shopping. I could probably go into sales for you. I made back the purchase price in just 48 hours! I would gladly pay over $600 for online shopping."
<br/>- Shannon O -
</p>
</div>
<div class="mdl-cell--3-col testimonial" style="float:left">
<img src="images/personthree.jpg" />
<p>
"Cart site is worth much more than I paid. Cart site has completely surpassed our expectations. Definitely worth the investment. Keep up the excellent work."
<br/>- Emmalyn P -
</p>
</div>
<div class="mdl-cell--3-col testimonial" style="float:left">
<img src="images/personfour.jpg" />
<p>
"Thank you so much for your help. Thanks for the great service. We can't understand how we've been living without online shopping. Not able to tell you how happy I am with online shopping."
<br/>- Ailee T -
</p>
</div>
</div>
<div class="mdl-tabs__panel" id="features-panel">
<div class="mdl-cell--3-col features" style="float:left">
<i class="material-icons md-150">local_shipping</i>
<h1>Fast Shipping</h1>
<p>whitin less than 24 hours you'll recieve your georgeous items</p>
</div>
<div class="mdl-cell--3-col features" style="float:left">
<i class="material-icons md-150">attach_money</i>
<h1>Money Gurantee back</h1>
<p>The Money Will completly back to you</p>
</div>
<div class="mdl-cell--3-col features" style="float:left">
<i class="material-icons md-150">local_offer</i>
<h1>Special Prices</h1>
<p>prices are special</p>
</div>
<div class="mdl-cell--3-col features" style="float:left">
<i class="material-icons md-150">headset_mic</i>
<h1>Cusomer Care</h1>
<p>Customer Care Will Be 24/7</p>
</div>
</div>
</div>
</section>

<div class="clear" style="clear:both"></div>
<?php require_once('footer.php'); ?>