<?php $page = Url::getParam('page'); ?>
<?php if(($page != 'catalogue')) { } else { ?>
 
<!--side-->  
<div class="side mdl-cell--3-col">
<div class="wrap  demo-card-square mdl-card">
    <?php require_once('basket_left.php'); ?>
 </div>
    <?php if (!empty($cats)) { ?>
    
    <div class="wrap demo-card-square mdl-card">
    <i class="material-icons">category</i>
    <span class="mdl-typography--headline">Categories</span>
    <ul class="demo-list-icon mdl-list">
        <?php 
            foreach($cats as $cat) {
				echo "<li class=\"mdl-list__item\">";
				echo "<i class=\"material-icons mdl-list__item-icon\">list</i>";
                echo "<a href=\"/?page=catalogue&amp;category="
                .$cat->id."\"";
                echo Helper::getActive(array('category' => $cat->id));
                echo ">";
				echo "<span class=\"mdl-list__item-primary-content\">";
                echo Helper::encodeHtml($cat->name);
				echo "</span>";
				echo "</a>";
                echo "</li>";
            }
        ?>
        </ul>
        </div>
    <?php } ?>
    
    <div class="wrap   demo-card-square mdl-card">
    <div class="fb-page" data-width="254" data-href="https://www.facebook.com/envato/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/envato/"><a href="https://www.facebook.com/envato/">Envato</a></blockquote></div></div>
    </div>

    <div class="wrap   demo-card-square mdl-card">
    	<img src="/images/SPRINTERONE.jpg" width="254" />
        </div>
        <div class="wrap   demo-card-square mdl-card">
        <img src="/images/SPRINTERTWO.jpg" width="254" />
        </div>

    
    
    <div class="wrap  demo-card-square mdl-card">
    <iframe width="254" height="200" src="https://www.youtube.com/embed/AhgtoQIfuQ4" frameborder="0" allowfullscreen></iframe>
    </div>
    
    <div class="wrap   demo-card-square mdl-card">
    <iframe width="254" height="200" src="https://www.youtube.com/embed/3OcNdxPhAUk" frameborder="0" allowfullscreen></iframe>
    </div>
    
</div>
	

<?php } ?>  