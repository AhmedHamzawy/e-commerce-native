<?php
$cat = Url::getParam('category');

if(empty($cat)) {
	
	require_once("error.php");
	
	
} else {

	$objCatalogue = new Catalogue();
	$category = $objCatalogue->displayCategory($cat);

	if(empty($category)) {
		
		require_once("error.php");
		
	} else {
	
		$rows = $objCatalogue->displayProductsPublic($cat);
		
		
		// instantiate paging class
		$objPaging = new Paging($rows, 6);
		$rows = $objPaging->getRecords();
		
		$objPaging->_url =  $objPaging->_url;
		
		require_once("header.php");
?>



<div class="cat mdl-cell--8-col mdl-cell--10-col-phone">

		<?php //echo Helper::breadCrumb(); ?>
        
<h1 class="mdl-typography--text-center mdl-typography--display-2">Catalogue :: <?php echo $category->name; ?></h1>




<?php
		if(!empty($rows)) {
			foreach($rows as $row) {
?>

    
  <div class="products mdl-cell mdl-cell--6-col demo-card-square mdl-card mdl-shadow--2dp" style="float:left">   
    
  <div class="mdl-card__title mdl-card--expand">
  
 
  
   <a href=<?php G_PATH.DS ?>"?page=catalogue-item&amp;category=<?php echo $category->id; ?>&amp;id=<?php echo $row->id; ?>">
   
   <h2 class="mdl-card__title-text">
   <?php echo Helper::encodeHtml($row->name, 1); ?>
   <br/>
   <?php echo $row->_currency; echo number_format
   ($row->price); ?>
   </h2>
   
   </a>
   
    <?php echo Basket::activeButton($row->id); ?>
   
   </div>
   
   
        
        
        <?php
		
			$image = !empty($row->image) ? 
			$row->_path.$row->image :
			$row->_path.'unavailable.png';
			
			$width = Helper::getImgSize($image, 0);
			//$width = $width > 317 ? 317 : $width;
			
		?>
        
		
         <a href=<?php G_PATH.DS ?>"?page=catalogue-item&amp;category=<?php echo $category->id; ?>&amp;id=<?php echo $row->id; ?>">
         
         <div class="mdl-card__media">
            <img src="<?php echo $image; ?>" alt="<?php echo Helper::encodeHtml($row->name, 1); ?>" 
            width="<?php echo $width; ?>"
             />
         </div>  
           
         </a> 
        
        
        <div class="mdl-card__supporting-text">
        
			<?php echo Helper::shortenString(Helper::encodeHtml($row->description)); ?>
            
        </div>
        
      </div>	

<?php
			}
			
			    echo "<div class=\"clear\" style=\"clear:both\"></div>";
				echo $objPaging->getPaging();
				
				
			
		} else {
?>
<p>There are no products in this category.</p>
  
<?php		
		}
		
?>		
</div>
<?php require_once("side.php"); ?>
</div>
	<?php	require_once("footer.php");
	
	}
}
?>