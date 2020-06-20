  
	<footer class="mdl-mega-footer">
  <div class="mdl-mega-footer__middle-section">

    <div class="mdl-mega-footer__drop-down-section">
      <input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked>
      <h1 class="mdl-mega-footer__heading">About us</h1>
      <ul class="mdl-mega-footer__link-list">
        <li><a href="#">Ecstasy is a featured 
        general online <br/> store contracted 
        with the the <br/> most fancy  brands  
        in the world  <br/> by suitable prices <br/> for your comfort
        </a></li>
        </ul>
    </div>

    <div class="mdl-mega-footer__drop-down-section">
      <input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked>
       <h1 class="mdl-mega-footer__heading">Twitter</h1>
       <div id="twitter-timeline" data-chrome="nofooter transparent">
                    </div>
       
    </div>
	
    
    <div class="mdl-mega-footer__drop-down-section">
      <input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked>
      <h1 class="mdl-mega-footer__heading">Contact Us</h1>
      <ul class="mdl-mega-footer__link-list">
        <li><a href="#"><i class="material-icons">contact_phone</i>Call Us: <br /> 078 8782 6034</a></li>
        <li><a href="#"><i class="material-icons">contact_mail</i>Email Us: <br/> Ecsatcyforcom@gmail.com</a></li>
      </ul>
    </div>
    
    <div class="mdl-mega-footer__drop-down-section">
      <h1 class="mdl-mega-footer__heading">Flickr</h1>
      <div id="8DR2YUOGL0"></div>
    </div>
</div>
<div class="mdl-mega-footer__middle-section">

<div class="mdl-mega-footer__drop-down-section">
      <h1 class="mdl-mega-footer__heading">Address</h1>
    <iframe
  width="300"
  height="200"
  frameborder="0" style="border:0"
  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCmrLLPAmhyPevrljkfltOQI5jM6zOdcec
    &q=Space+Needle,Seattle+WA" allowfullscreen>
</iframe>
	<br/><br/><br/>
    <a href="#"><i class="material-icons">place</i> &nbsp; 78 Southend Avenue BLACKFORD BA22 4SB </a>
    </div>
     <div class="mdl-mega-footer__drop-down-section">
             <h1 class="mdl-mega-footer__heading">Follow us on</h1>
    <a href="#"><img src="images/socialmedia/footer/facebook-Icon.png" alt="facebook"
    width="30" height="30" /></a>
    <a href="#"><img src="images/socialmedia/footer/Twitter-Icon.png" alt="twitter"
    width="30" height="30" /></a>
    <a href="#"><img src="images/socialmedia/footer/Google-Plus-Icon.png" alt="G+"
    width="30" height="30" /></a>
    <a href="#"><img src="images/socialmedia/footer/Linkedin-icon.png"
    width="30" height="30" alt="linkedin" /></a>
    <a href="#"><img src="images/socialmedia/footer/Instagram-Icon.png"
    width="30" height="30" alt="instagram" /></a>
    <a href="#"><img src="images/socialmedia/footer/Youtube-Icon.png"
    width="30" height="30" alt="youtube" /></a>
    <a href="#"><img src="images/socialmedia/footer/Pinterest-icon.png"
    width="30" height="30" alt="pinterest" /></a>
    <a href="#"><img src="images/socialmedia/footer/RSS-Icon.png"
    width="30" height="30" alt="rss" /></a>
   </div>
  
    
    <div class="mdl-mega-footer__drop-down-section">
    <h1 class="mdl-mega-footer__heading">Back To Top</h1>
      <ul class="mdl-mega-footer__link-list">
        <li>
    <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored" id="scroll-up-btn">
 <i class="material-icons">keyboard_arrow_up</i>
</button>
        </li>
      </ul>
      
  </div>
  
  <div class="mdl-mega-footer__drop-down-section">
      <h1 class="mdl-mega-footer__heading">Payment Methods</h1>
        <a href="#"><img src="images/paypal.svg" alt="paypal" width="319" height="110" /></a>
    </div>  
    
</div>
<h1 style="text-align:center">&copy; copyrights all rights reserved at Ecstacy E-commerce </h1>
    
</main></div>
</footer>

</div>
</div>





	
<script src="js/basket-old.js" type="text/javascript"></script>
<script src="js/rate.js" type="text/javascript"></script>
<script>
	var id = "<?php echo $id; ?>" ;
						
	$('.rate-btn').click(function(){    
		var therate = $(this).attr('id');
		var dataRate = 'act=rate&product_id='+id+'&rate='+therate; //
		$('.rate-btn').removeClass('rate-btn-active');
		for (var i = therate; i >= 0; i--) {
			$('.rate-btn-'+i).addClass('rate-btn-active');
		};
		$.ajax({
			type : "POST",
			url : "mod/rate.php",
			data: dataRate,
			success:function(){}
		});
		
	});
</script>
<script>

$(document).ready(function() {
	
	setTimeout(function(){
		$('body').addClass('loaded');
	}, 3000);
	
});

</script>
<script src="https://flickrit.com/embed.js.php?id=8DR2YUOGL0"></script>

<!-- Twitter JavaScript -->
    <script id="twitter-wjs" src="//platform.twitter.com/widgets.js"></script>
    <script>
        document.addEventListener('mdl-componentupgraded', function (e) {
            if (typeof e.target.MaterialLayout !== 'undefined') {
                twttr.widgets.createTimeline('600720083413962752', document.getElementById('twitter-timeline'), { related: 'twitterdev,twitterapi', width: '100%', height: 270 , chrome: 'noborders noscroll noheader nofooter transparent noscrollbar' });
            }
        });
    </script>
    
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55df49df06f00245"></script>
<script src="js/mdl-select.js" type="text/javascript"></script>
<script>
$("#select").mdlselect({
    value: ["0", "1", "2", "3"],
    label: ["n/a", "Option 1", "Option 2", "Option 2"],
    fixedHeight: '10em'
  });
</script>


</body>
</html>
<?php $database=Dbase::getInstance(); if(isset($database)) { $database->close_connection(); } ?>