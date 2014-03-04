<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<meta name="description" content='Description here' />
 
<meta name="robots" content="index, follow" />
 
<meta name="default" content="robots.txt" />
<meta name="generator" content="robots.txt" />
<meta name="keywords" content="robots.txt" />
 
<meta name="author" content="Hendry Kurniawan" />

<link rel="alternate" type="application/rss+xml" title="RSS" href="modules/rss.php" />
<link rel="shortcut icon" href="favicon.ico" /> 

<title><?php echo $title?></title>

<?php echo $html->includeCss('style',false,THEMES); ?>
<?php echo $html->includeJs('js/jquery.min'); ?>
</head>
<body>
	<div id="header">
		<div id="logo">
			<h1><?php echo $html->link('Darkengine','')?></h1>
			<p> design by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a></p>
		</div>
	</div>
	<!-- end #header -->
	<div id="menu">
		<ul>
		 <?php 
		 $current_home = "";
		 $current_news = "";
		 $current_announcements = "";
		 $current_articles = "";
		 $current_sitemap = "";
		 $current_about = "";
		 $current_contact = "";
		 $current_test123 = "";
		 $current_gallery = "";
		 
		 if (!isset($page)) $page = "home";
 		 $current = "current_" . $page;
		 $$current = "class='first'";

		 ?>
		 
			<li <?php echo $current_home;?>> <?php echo $html->link('Home','')?></li>
			<li <?php echo $current_announcements;?>> <?php echo $html->link('Announcements','announcements')?></li>
			<li <?php echo $current_news;?>><?php echo $html->link('News','news')?></li>
			<li <?php echo $current_articles;?>><?php echo $html->link('Articles','articles')?></li>
			<li <?php echo $current_gallery;?>><?php echo $html->link('Gallery','gallery')?></li>
			<li <?php echo $current_sitemap;?>><?php echo $html->link('Sitemap','sitemap')?></li>
			<li <?php echo $current_about;?>><?php echo $html->link('About','about')?></li>
			<li <?php echo $current_contact;?>><?php echo $html->link('Contact','contact')?></li>
			<li <?php echo $current_test123;?>><?php echo $html->link('Test123','test123')?></li>
			
		</ul>
	</div>
	<!-- end #menu -->
<div id="wrapper">
<div class="btm">
	<div id="page">