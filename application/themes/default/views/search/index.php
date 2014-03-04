<div id="content_full">
	<div class="post">
		<h1 class="title">Search</h1>
			<div class="entry">
			 <?php if (isset($_POST['s_value']) && $_POST['s_value'] != "" ){?>
					Result for = <i><?php echo $search_value;?></i> (<?php echo $NumSearch; ?>) <br />
					<ul>
					<?php if ($NumSearch > 0){ ?>
					<?php foreach ($AllSearch as $AllSearchitem): ?>
				    <?php $action_search = $AllSearchitem['V_Search']['id']."/".strtolower(str_replace(" ","-",$AllSearchitem['V_Search']['subject'])); ?>
				    
				  	<li><?php 
				  		if ($AllSearchitem['V_Search']['Type']=="pages")
				  			echo $html->link($AllSearchitem['V_Search']['subject'],$AllSearchitem['V_Search']['subject']);
				  		else
				  			echo $html->link($AllSearchitem['V_Search']['subject'],$AllSearchitem['V_Search']['Type']."/view/".$action_search);
				  		?>
						<span><?php echo strftime("%d %B %Y",strtotime($AllSearchitem['V_Search']['date_modified']));?> by <?php echo $AllSearchitem['V_Search']['user_modified'];?></span></li>
				  	<?php endforeach;
					}else{
						echo "No result...";
					} 
				  	?>
					
					</ul>
					
					<?php 
					$page = 'search/page/';
					$add = $s_value;
					include(ROOT .DS .'public/modules/paging.php');
					?>
				<?php }else{?>
					<form name='searchform' method="POST" action='<?php echo BASE_PATH."/search/"?>' >
						
						<input type='text' name='s_value'  value='' style='width:170px;'> <input type='submit' name='search' value='Search' style='width:60px;'>
					</form>
				<?php }?>
				 
			</div>
		<div>
	</div>
</div>