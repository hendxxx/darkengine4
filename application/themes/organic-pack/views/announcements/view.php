	<div id="content_full">
	<div class="post">
		<h1 class="title"><?php echo $announcements['Announcements']['subject']?></h1>
		<div class="entry">
			<?php echo $announcements['Announcements']['front'] ?>
			<?php echo $announcements['Announcements']['content'] ?>
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
		<p class="meta_full">Posted by <?php echo $announcements['Announcements']['user_modified'];?> on <?php echo strftime("%d %B %Y",strtotime($announcements['Announcements']['date_modified']));?> <?php echo $numofcomments?> </p>
	</div>
	
	
	<div class="post">
	<?php
	$type="announcements";
	$id = $announcements['Announcements']['id']; 
	$title = strtolower(str_replace(" ","-",$announcements['Announcements']['subject']));
	$ItemComments = $V_Comments;
	include(ROOT .DS .'public/modules/comments.php');
	?> 
	</div>
	
</div>