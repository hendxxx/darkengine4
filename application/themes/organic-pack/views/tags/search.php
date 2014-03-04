<div id="content_full">
	<div class="post">
		<h1 class="title">Tags</h1>
			<div class="entry">
				 
					Result for tags = <i><?php echo $tags_value;?></i> (<?php echo $NumTags; ?>) <br />
					<ul>
					<?php foreach ($AllTags as $AllTagsitem){ ?>
				     
				  	<li> 
						<span>
							<?php echo $html->link($AllTagsitem['V_Tags']['subject'],$AllTagsitem['V_Tags']['type']."/view/". $AllTagsitem['V_Tags']['id'] ."/". $AllTagsitem['V_Tags']['subject']);?>
						</span>
					</li>
				  	
					<?php } ?>
					 
					</ul>
					
					 
				 
				 
			</div>
		<div>
	</div>
</div>