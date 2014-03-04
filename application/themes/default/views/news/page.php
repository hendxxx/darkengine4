<div id="content_full">
	<?php foreach ($news as $newsitem): ?>
		<div class="post">
			<h1 class="title"><?php echo $newsitem['News']['subject']?></h1>
			<div class="entry">
				<?php
					if ( trim($newsitem['News']['front']) == "" ){
						 echo $newsitem['News']['content'];
					}else{
						 echo $newsitem['News']['front'];
					}
				?>
			</div>
			 <?php 
			    $numofcomments = "";
			    if (USE_COMMENT){
				    $i=0;
				    foreach ($newsComments as $newsCommentitem):
					    if ($newsCommentitem['V_Comments']['ids']==$newsitem['News']['id']){
					    	$i++;
					    	$numofcomments = "&nbsp;&bull;&nbsp; Comments (" . $NumC . ")";
			    		}
				    endforeach;
			    }
			    ?>
			    
			<?php $action_news = $newsitem['News']['id']."/".strtolower(str_replace(" ","-",$newsitem['News']['subject'])); ?>
			<p class="meta_full">Posted by <?php echo $newsitem['News']['user_modified'];?> on <?php echo strftime("%d %B %Y",strtotime($newsitem['News']['date_modified']));?> <?php echo $numofcomments?> &nbsp;&bull;&nbsp; <?php echo $html->link("Full news","news/view/".$action_news,"permalink")?></p>
		</div>
	<?php endforeach ?>    
	
	<div class="post">
	
	<?php 
	$page = 'news/page/';
	include(ROOT .DS .'public/modules/paging.php');
	?> 
	<br />

	</div>
</div>