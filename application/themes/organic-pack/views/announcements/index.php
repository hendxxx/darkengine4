<div id="content_full">
	<?php foreach ($announcements as $announcementsitem): ?>
		<div class="post">
			<h1 class="title"><?php echo $announcementsitem['Announcements']['subject']?></h1>
			<div class="entry">
				<?php
				if (trim($announcementsitem['Announcements']['front'] == "")){
					echo $announcementsitem['Announcements']['content'];
				}else{
					echo $announcementsitem['Announcements']['front'];	
				}
				?>
			</div>
			 <?php 
			    $numofcomments = "";
			    if (USE_COMMENT){
				    $i = 0;
				    foreach ($announcementsComments as $announcementsCommentitem):
					    if ($announcementsCommentitem['V_Comments']['ids']==$announcementsitem['Announcements']['id']){
					    	$i++;
					    	$numofcomments = "&nbsp;&bull;&nbsp; Comments (" . $i . ")";
					    }
				    endforeach;
			    }
			    ?>
			    
			<?php $action_announcements = $announcementsitem['Announcements']['id']."/".strtolower(str_replace(" ","-",$announcementsitem['Announcements']['subject'])); ?>
			<p class="meta_full">Posted by <?php echo $announcementsitem['Announcements']['user_modified'];?> on <?php echo strftime("%d %B %Y",strtotime($announcementsitem['Announcements']['date_modified']));?> <?php echo $numofcomments?> &nbsp;&bull;&nbsp; <?php echo $html->link("Full announcement","announcements/view/".$action_announcements,"permalink")?></p>
		</div>
	<?php endforeach ?>    
	
	<div class="post">
	
	<?php 
	$page = 'announcements/page/';
	include(ROOT .DS .'public/themes/default/paging.php');
	?> 
	<br />

	</div>
</div>