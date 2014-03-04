	<div id="content_full">
	<div class="post">
		<h1 class="title"><?php echo $gallery['Gallery']['name']?></h1>
		<div class="entry">
			<div class="gallery_img_detail">
			<img width="100%" src='<?php echo BASE_PATH?>/public/uploads/image/<?php echo $gallery['Gallery']['image'];?>' />
			</div>
			<br/>
			<?php echo $gallery['Gallery']['content'] ?>
		</div>
			<?php 
			$numofcomments = "";
			    if (USE_COMMENT){
			    	if ($NumC==0)
						$numofcomments = "&nbsp;&bull;&nbsp; No Comment";
					else
						$numofcomments = "&nbsp;&bull;&nbsp; Comments (" . $NumC . ")";
			    }
			
			?>
		<p class="meta_full">Posted by <?php echo $gallery['Gallery']['user_modified'];?> on <?php echo strftime("%d %B %Y",strtotime($gallery['Gallery']['date_modified']));?> <?php echo $numofcomments?> </p>
	</div>
	
	
	<div class="post">
	<?php
	$type="gallery";
	$id = $gallery['Gallery']['id']; 
	$title = strtolower(str_replace(" ","-",$gallery['Gallery']['name']));
	$ItemComments = $V_Comments;
	include(ROOT .DS .'public/modules/comments.php');
	?> 
	</div>
	
</div>