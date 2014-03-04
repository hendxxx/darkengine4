<div id="content_full">
	<?php foreach ($articles as $articlesitem): ?>
		<div class="post">
			<h1 class="title"><?php echo $articlesitem['Articles']['subject']?></h1>
			<div class="entry">
				<?php 
					if (trim($articlesitem['Articles']['front']) == ""){
						echo $articlesitem['Articles']['content'];
					}else{
						echo $articlesitem['Articles']['front'];
					}
				?>
			</div>
			  <?php 
			    $numofcomments = "";
			    if (USE_COMMENT){
				    $i=0;
			    	foreach ($articlesComments as $articlesCommentitem):
					    if ($articlesCommentitem['V_Comments']['ids']==$articlesitem['Articles']['id']){
					    	$i++;
					    	$numofcomments = "&nbsp;&bull;&nbsp; Comments (" . $i . ")";
					    }
				    endforeach;
			    }
			    ?>
			    
			<?php $action_articles = $articlesitem['Articles']['id']."/".strtolower(str_replace(" ","-",$articlesitem['Articles']['subject'])); ?>
			<p class="meta_full">Posted by <?php echo $articlesitem['Articles']['user_modified'];?> on <?php echo strftime("%d %B %Y",strtotime($articlesitem['Articles']['date_modified']));?> <?php echo $numofcomments?> &nbsp;&bull;&nbsp; <?php echo $html->link("Full articles","articles/view/".$action_articles,"permalink")?></p>
		</div>
	<?php endforeach ?>    
	
	<div class="post">
	
	<?php 
	$page = 'articles/page/';
	include(ROOT .DS .'public/modules/paging.php');
	?> 
	<br />

	</div>
</div>