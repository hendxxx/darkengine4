	<div id="content_full">
	<div class="post">
		<h1 class="title"><?php echo $articles['Articles']['subject']?></h1>
		<div class="entry">
			<?php echo $articles['Articles']['front'] ?>
			<?php echo $articles['Articles']['content'] ?>
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
		<p class="meta_full">Posted by <?php echo $articles['Articles']['user_modified'];?> on <?php echo strftime("%d %B %Y",strtotime($articles['Articles']['date_modified']));?> <?php echo $numofcomments?> </p>
	</div>
	
	
	<div class="post">
	<?php
	$type="articles";
	$id = $articles['Articles']['id']; 
	$title = strtolower(str_replace(" ","-",$articles['Articles']['subject']));
	$ItemComments = $V_Comments;
	include(ROOT .DS .'public/modules/comments.php');
	?> 
	</div>
	
</div>