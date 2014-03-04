	<div id="content_full">
	<div class="post">
		<h1 class="title"><?php echo $news['News']['subject']?></h1>
		<div class="entry">
			<?php echo $news['News']['front'] ?>
			<?php echo $news['News']['content'] ?>
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
		<p class="meta_full">Posted by <?php echo $news['News']['user_modified'];?> on <?php echo strftime("%d %B %Y",strtotime($news['News']['date_modified']));?> <?php echo $numofcomments?> </p>
	</div>
	
	
	<div class="post">
	<?php
	$type="news";
	$id = $news['News']['id']; 
	$title = strtolower(str_replace(" ","-",$news['News']['subject']));
	$ItemComments = $V_Comments;
	include(ROOT .DS .'public/modules/comments.php');
	?> 
	</div>
	
</div>