<div id="content_full">
	<div class="post">
		<div class="gallery">
		<?php foreach ($gallery as $galleryitem): ?>
			<div class="panel">
				<?php 
				$link = "<img src='".BASE_PATH."/public/uploads/image/thumbs/".$galleryitem['Gallery']['image']."' />
						 <span>".$galleryitem['Gallery']['name']."</span>";
				
				if (USE_COMMENT){
				    $numofcomments = "No Comment";
					$i=0;
					foreach ($galleryComments as $galleryCommentitem):
					    if ($galleryCommentitem['V_Comments']['ids']==$galleryitem['Gallery']['id']){
					    	$i++;
					    	$numofcomments = " Comments (" . $i . ")";
					    }
				    endforeach;
				    
			    }
			    
				$link .= $numofcomments;
				
				echo $html->link($link,'gallery/view/'.$galleryitem['Gallery']['id']."/".$galleryitem['Gallery']['name']);
				?>
			</div>
		<?php endforeach ?>  
		</div>
	</div>
	
	<div class="post">
	<?php 
	$page = 'gallery/page/';
	include(ROOT .DS .'public/modules/paging.php');
	?> 
	<br />

	</div>
</div>