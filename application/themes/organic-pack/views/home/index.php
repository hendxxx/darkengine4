<div id="content">
	<!-- Announcements -->
	<div class="post">
	<?php foreach ($announcements as $announcementsitem): ?>
		<?php $action_article = $announcementsitem['Announcements']['id']."/".strtolower(str_replace(" ","-",$announcementsitem['Announcements']['subject'])); ?>
		<h1 class="title"><?php echo $html->link( $announcementsitem['Announcements']['subject'] ,"announcements/view/".$action_article)?></h1>
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
				    		$numofcomments = " &nbsp;&bull;&nbsp; Comments (" . $i . ")";
				    	}
				    endforeach;
			    }
			    ?>
			    <br />
		<p class="meta">Posted by <?php echo $announcementsitem['Announcements']['user_modified'];?> on <?php echo strftime("%d %B %Y",strtotime($announcementsitem['Announcements']['date_modified']));?><?php echo $numofcomments?> &nbsp;&bull;&nbsp; <?php echo $html->link("Full announcement","announcements/view/".$action_article,"permalink")?></p>
	<?php endforeach ?>
	</div>
	
	<!-- Articles -->
	<div class="post">
	<?php foreach ($articles as $articlesitem): ?>
		<?php $action_article = $articlesitem['Articles']['id']."/".strtolower(str_replace(" ","-",$articlesitem['Articles']['subject'])); ?>
		<h1 class="title"><?php echo $html->link( $articlesitem['Articles']['subject'] ,"articles/view/".$action_article)?></h1>
		<div class="entry">
			<?php
				if (trim($announcementsitem['Announcements']['front'] == "")){
					echo $articlesitem['Articles']['content'];
				}else{
					echo $articlesitem['Articles']['front'];	
				}
			?>	
		 
		</div>
				<?php 
			    $numofcomments = "";
			    if (USE_COMMENT){
				    $i = 0;
				    foreach ($articlesComments as $articlesCommentitem):
					    if ($articlesCommentitem['V_Comments']['ids']==$articlesitem['Articles']['id']){
					    	$i++;
					    	$numofcomments = " &nbsp;&bull;&nbsp; Comments (" . $i . ")";
			    		}
				    endforeach;
			    }
			    ?>
			    <br />
		<p class="meta">Posted by <?php echo $articlesitem['Articles']['user_modified'];?> on <?php echo strftime("%d %B %Y",strtotime($articlesitem['Articles']['date_modified']));?><?php echo $numofcomments?> &nbsp;&bull;&nbsp; <?php echo $html->link("Full article","articles/view/".$action_article,"permalink")?></p>
	<?php endforeach ?>
	</div>
	
</div>

<div id="sidebar">
	<ul>
		<li>
			<h2>Search</h2>
			<ul>
				<li>
					<form name='searchform' method="post" action='<?php echo BASE_PATH."/search/"?>' >
					<input type='text' name='s_value'  value='' style='width:170px;' /> <input type='submit' name='search' value='Search' style='width:60px;' />
					</form>
				</li>
			</ul> 
		</li>
	</ul>
	
	<ul>
		<li>
			<h2>Latest news</h2>
			<ul>
			<?php 
			
			if((int)$NumNews > 0) {?>
			
			<?php foreach ($news as $newsitem): ?>
		    <?php $action_news = $newsitem['News']['id']."/".strtolower(str_replace(" ","-",$newsitem['News']['subject'])); ?>
		    
			    <?php 
			    $numofcomments = "";
			    if (USE_COMMENT){
				    $i = 0;
				    foreach ($newsComments as $newsCommentitem):
				    	if ($newsCommentitem['V_Comments']['ids']==$newsitem['News']['id']){
				    		$i++;
				    		$numofcomments = "(" . $i . ")";
				    	}
				    endforeach;
			    }
			    ?>
		    
		  	<li><?php echo $html->link($newsitem['News']['subject'],"news/view/".$action_news)?> <?php echo $numofcomments;?> <span><?php echo strftime("%d %B %Y",strtotime($newsitem['News']['date_modified']));?> by <?php echo $newsitem['News']['user_modified'];?></span></li>
		  	<?php endforeach; 
			 }else{ 
				echo "No News yet...";
			 }?>
			</ul>				  
		</li>
		
		<?php if (USE_COMMENT){ ?>
		<li>
			<h2>Latest comments</h2>
			<ul>
			<?php 
			
			if((int)$NumC > 0) {?>
				<?php foreach ($comments as $commentsitem): ?>
			    <?php $action_comments = $commentsitem['V_Comments']['ids'].'/'.$commentsitem['V_Comments']['content_subject']; ?>
			    <?php
			    if (strlen($commentsitem['V_Comments']['subject']) > 30 )
			    	$title = substr($commentsitem['V_Comments']['subject'],0,27) . ' ...';
			    else
			    	$title = $commentsitem['V_Comments']['subject'];
			    
			    ?>
			    <li>
			    <?php echo $html->link($title,$commentsitem['V_Comments']['type']."/view/".$action_comments)?>
				    <span>
				    <?php echo strftime("%d %B %Y",strtotime($commentsitem['V_Comments']['date_modified']));?> on <?php echo $commentsitem['V_Comments']['type']?> by <?php echo $commentsitem['V_Comments']['user_modified']?>
				    </span>
			    </li>
				<?php endforeach; 
			 }else{ 
				echo "No Comments yet...";
			 }?>
			</ul>				  
		</li>
		<?php } ?>
		
		 
			<h2>Links</h2>
			<p>
			<?php 
			if((int)$NumLinks > 0) {?>
			<?php foreach ($links as $linksitem): ?>
			 
		    <a href="<?php echo $linksitem['Links']['to']?>" target='_new' title='<?php echo $linksitem['Links']['name'] ?>'>
		    	<?php if($linksitem['Links']['image'] != "nothing") {?>
		    		<img src='<?php echo BASE_PATH. "/public/uploads/image/links/". $linksitem['Links']['image'] ?>' border='0' alt=""  /> <br />
		    	<?php }else{ ?>
		    		<?php echo $html->GetWebIcon($linksitem['Links']['to']) . $linksitem['Links']['name']."<br />" ?>
		    	<?php }?>
		    </a>
		    
		  	<?php endforeach; 
			 }else{ 
				echo "<li>No Links yet...</li>";
			 }?>
			 </p>
		
		<h2>Tag Cloud</h2>
		<p>
			<?php include("./public/modules/wcloud/could.php");?>
		</p>
		
	</ul>
</div>
