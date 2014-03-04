<div id="content_full">
	<div class="post">
		<h1 class="title">Tags</h1>
			<div class="entry">
				<?php if (isset($_POST['s_value']) && $_POST['s_value'] != "" ){?>
					Result for = <i><?php echo $tags_value;?></i> (<?php echo $NumTags; ?>) <br />
					<ul>
					<?php if ($NumTags > 0){ ?>
					<?php foreach ($AllTags as $AllTagsitem): ?>
				    <?php $action_tags = $AllTagsitem['V_Tags']['id']."/".strtolower(str_replace(" ","-",$AllTagsitem['V_Tags']['subject'])); ?>
				    
				  	<li><?php 
				  		if ($AllTagsitem['V_Tags']['Type']=="pages")
				  			echo $html->link($AllTagsitem['V_Tags']['subject'],$AllTagsitem['V_Tags']['subject']);
				  		else
				  			echo $html->link($AllTagsitem['V_Tags']['subject'],$AllTagsitem['V_Tags']['Type']."/view/".$action_tags);
				  		?>
						<span><?php echo strftime("%d %B %Y",strtotime($AllTagsitem['V_Tags']['date_modified']));?> by <?php echo $AllTagsitem['V_Tags']['user_modified'];?></span></li>
				  	<?php endforeach;
					}else{
						echo "No result...";
					} 
				  	?>
					
					</ul>
					
					<?php 
					$page = 'tags/page/';
					include(ROOT .DS .'public/modules/paging.php');
					?>
				<?php }else{?>
					<form name='tagsform' method="POST" action='<?php echo BASE_PATH."/tags/"?>' >
						<input type='text' name='s_value'  value='' style='width:170px;'> <input type='submit' name='tags' value='Tags' style='width:60px;'>
					</form>
				<?php }?>
				 
			</div>
		<div>
	</div>
</div>