<div id="content_full">
	<div class="post">
		<?php if(!isset($Page['Pages']['title'])){ ?>
	        <h1 class="title">Error 404</h1>
	        <div id="entry">
	        	<?php echo $Page['Pages']['content']?>
	        <div class="clear"></div>
	        </div>
            <?php }else{?>
	        <h1 class="title"><?php echo $Page['Pages']['title']?></h1>
	        <div id="entry">
	        	<?php echo $Page['Pages']['content']?>
	        <div class="clear"></div>
	    	</div>
		<?php }?>
	</div>
	 
	
</div>
                