<?php

$id = Url::getParam('id');

if (!empty($id)) {

$objCatalogue = new Catalogue();
$product = $objCatalogue->displayProduct($id);
$objRates = new Rates();

if (!empty($product)) {

		$category = $objCatalogue->displayCategory($product->category);
		
		require_once('header.php');

?>
        
	
<?php 
		
		
			
	$image = !empty($product->image) ? 
		'media/catalogue/'.$product->image : 
		null;
	
	if (!empty($image)) {
		
		$width = Helper::getImgSize($image, 0);
		$width = $width > 1020 ? 1020 : $width;
		echo "<div id=\"left\" class=\"cat mdl-cell--6-col\"><img src=\"{$image}\" alt=\"";
		echo Helper::encodeHTML($product->name, 1);
		echo "\" width=\"{$width}\" />";
		echo "</div>";
	}
		
		
		
	echo "<div id=\"right\" class=\"side mdl-cell--4-col\">
	
		<h3 class=\"mdl-typography--text-center mdl-typography--display-2
		\">".$product->name."</h3>";
		
		echo "<br/>";
		
		echo "<h4 class=\"mdl-typography--text-center mdl-typography--display-3\">
		<strong>&pound;".$product->price."</strong></h4>";
		
		echo "<hr/>";
		
		echo Basket::activeButton($product->id);
		
		echo "<hr/>";
		
		?>
		<div class="extra social">
		
		<!-- Go to www.addthis.com/dashboard to customize your tools -->
		<div class="addthis_sharing_toolbox"></div>
		
		</div>
		
        <hr/>
        
		<div class="extra rate-ex1-cnt">
		
		
			<div id="1" class="rate-btn-1 rate-btn"></div>
			<div id="2" class="rate-btn-2 rate-btn"></div>
			<div id="3" class="rate-btn-3 rate-btn"></div>
			<div id="4" class="rate-btn-4 rate-btn"></div>
			<div id="5" class="rate-btn-5 rate-btn"></div>

			<div class="box-result-cnt">
			<?php
				
				$totalrates = $objRates->getTotalRates($id);
								
					!empty($totalrates) ? $rate_times = count($totalrates) : $rate_times = 0;
					
					foreach($totalrates as $rate){
					$sum_rates[] = $rate->rate ;
					}
			
					!empty($totalrates) ? $sum_rates = array_sum($sum_rates) : $sum_rates = 0 ;
					$rate_times == 0 ? $rate_value = 0 : $rate_value = $sum_rates/$rate_times;
					$rate_bg = (($rate_value)/5)*100;
			
					?>
					<hr>
						<h3>The content was rated <strong><?php echo  $rate_times; ?></strong> times.</h3>
					<hr>
						<h3>The rating is at <strong><?php  echo  $rate_value; ?></strong> .</h3>
					<hr>
					<div class="rate-result-cnt">
							<div class="rate-bg" style="width:<?php  echo  $rate_bg; ?>%"></div>
							<div class="rate-stars"></div>
					</div>
					<hr>
					
					</div><!-- /rate-result-cnt -->
					
					
					</div>
					
					<div style="text-align:center">
					
					<div class="fb-save" data-uri="https://www.instagram.com/facebook/" data-size="large"></div>
					
					</div>
	</div>
	
	
	
	
	
	
  <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
    
    
    <div class="mdl-tabs__tab-bar">
     
      <a href="#description-panel" class="mdl-tabs__tab is-active">Description</a>
      <a href="#comments-panel" class="mdl-tabs__tab">Comments</a>
      
    </div>
    
    <div class="mdl-tabs__panel is-active" id="description-panel">
    
    
    <?php
        
        echo "<div class=\"dev\">&#160;</div>";
        echo "<p class=\"desc\">".Helper::encodeHTML($product->description)."</p>";
        echo "<div class=\"dev br_td\">&#160;</div>"; 
        echo "<p><a href=\"javascript:history.go(-1)\">Go back</a></p>";
        ?>
        
        
    </div>
    
    
    <div class="mdl-tabs__panel" id="comments-panel">
    
        <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator"
        data-width="100%" data-numposts="5"></div>
        
     </div>  
        
  </div>

   
</div>
	
<?php
$i = 0;
$also = $objCatalogue->displayProductsPublic($product->category);
?>
<h1 class="mdl-typography--text-center mdl-typography--display-2">Also From <?php echo $category->name ?></h1>
<?php
foreach ($also as $alsofrom) {
	
	if ($i == 4) {break;} else {++$i;}
	
	?>
    <div class="cat mdl-cell--12-col">

	 <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet  mdl-cell--4-col-phone demo-card-square mdl-card mdl-shadow--2dp" style="float:left">   

        <div class="mdl-card__title mdl-card--expand">
        
        
        
            <a href=<?php G_PATH.DS ?>"?page=catalogue-item&amp;category=<?php echo $category->id; ?>&amp;
            id=<?php echo $alsofrom->id; ?>">
            
                    <h2 class="mdl-card__title-text">
                    <?php echo Helper::encodeHtml($alsofrom->name, 1); ?>
                    <br/>
                    <?php echo $alsofrom->_currency; echo number_format
                    ($alsofrom->price); ?>
                    </h2>
            
            </a>
            
            <?php echo Basket::activeButton($alsofrom->id); ?>
        
        </div>
        
            
            <?php
            
                $image = !empty($alsofrom->image) ? 
                $alsofrom->_path.$alsofrom->image :
                $alsofrom->_path.'unavailable.png';
                
                $width = Helper::getImgSize($image, 0);
               // $width = $width > 317 ? 317 : $width;
                
            ?>
            
            
             <a href=<?php echo G_PATH.DS ?>"?page=catalogue-item&amp;category=<?php echo $category->id; ?>&amp;
             id=<?php echo $alsofrom->id; ?>">
             
             <div class="mdl-card__media">
             
                <img src="<?php echo $image; ?>" alt="<?php echo Helper::encodeHtml($alsofrom->name, 1); ?>" 
                width="<?php echo $width; ?>"
                 />
                 
             </div>  
               
             </a> 
            
            
            <div class="mdl-card__supporting-text">
            
                <?php echo Helper::shortenString(Helper::encodeHtml($alsofrom->description)); ?>
                
            </div>
            
</div>
</div>
		<?php
		}
        ?>
        <?php 
echo "<div class=\"clear\" style=\"clear:both\"></div>";
		require_once('footer.php');
		
		
	} else {
		require_once('error.php');	
	}

} else {
	require_once('error.php');
}

?> 