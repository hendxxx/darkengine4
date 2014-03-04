<div id="content_full">
	<div class="post">
		<h1 class="title">Sitemap</h1>
		<div class="entry">
		Sitemap of <?php echo SITE_NAME?>
		<ul type="disc">
			<li><?php echo $html->link(SITE_NAME,'')?></li>
			
			<!-- Announcements -->
			<ul type="disc">
				<li><?php echo $html->link('announcements','announcements')?></li>
				<?php 
				if ($numAnnouncements > 0) {
					foreach ($announcements as $announcementsitem){
						?>
						<ul type="disc"><li><?php echo $html->link($announcementsitem['Announcements']['subject'],"announcements/view/".$announcementsitem['Announcements']['id']."/".$announcementsitem['Announcements']['subject'])?></li></ul>
						<?php 
					}	
				}
				?>
			</ul>
			
			<!-- Announcements -->
			<ul type="disc">
				<li><?php echo $html->link('news','news')?></li>
				<?php 
					if ($numNews > 0) {
						foreach ($news as $newsitem){
							?>
							<ul type="disc"><li><?php echo $html->link($newsitem['News']['subject'],"news/view/".$newsitem['News']['id']."/".$newsitem['News']['subject'])?></li></ul>
							<?php 
						}	
					}
				?>
			</ul>
			
			<!-- Articles -->
			<ul type="disc">
				<li><?php echo $html->link('articles','articles')?></li>
				<?php 
					if ($numArticles > 0) {
						foreach ($articles as $articlesitem){
							?>
							<ul type="disc"><li><?php echo $html->link($articlesitem['Articles']['subject'],"articles/view/".$articlesitem['Articles']['id']."/".$articlesitem['Articles']['subject'])?></li></ul>
							<?php 
						}	
					}
				?>
			</ul>
			
			<!-- Gallery -->
			<ul type="disc">
				<li><?php echo $html->link('gallery','gallery')?></li>
				<?php 
					if ($numGallery > 0) {
						foreach ($gallery as $galleryitem){
							?>
							<ul type="disc"><li><?php echo $html->link($galleryitem['Gallery']['name'],"gallery/view/".$galleryitem['Gallery']['id']."/".$galleryitem['Gallery']['name'])?></li></ul>
							<?php 
						}	
					}
				?>
			</ul>
			
			<!-- Pages-->
			<?php 
				if ($numPages > 0) {
					foreach ($pages as $pagesitem){
						?>
						<ul type="disc"><li><?php echo $html->link($pagesitem['Pages']['name'],$pagesitem['Pages']['name'])?></li></ul>
						<?php 
					}	
				}
				
			?>
			
			<ul type="disc"><li><?php echo $html->link('about','about')?></li></ul>
			<ul type="disc"><li><?php echo $html->link('contact','contact')?></li></ul>
			
		</ul>
		
		<?php echo $html->link('XML Version','modules/sitemap.php')?>
		
		</div>
		
	</div>
</div>