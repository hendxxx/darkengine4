<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $html->includeCss('style',true); ?>
<meta name="generator" content="" />
<title>Darkengine v4 Admin Page</title>

</head>
<body>
	
<div id="header">
	<h1>DARKENGINE V4</h1>
	<h2>Simply yet safe</h2>
</div>

<div id="menu">
	<ul>
	 <?php 
		 $current_home = "";
		 $current_news = "";
		 $current_articles = "";
		 $current_announcements = "";
		 $current_logout = "";
		 $current_pages = "";
		 $current_gallery = "";
		 $current_links = "";
		 $current_users = "";
		 $current_level = "";
		 
		 if (!isset($page)) $page = "home";
 		 $current = "current_" . $page;
		 $$current = "id='current_page_item'";

		 ?>
		 
		<li <?php echo $current_home;?>><?php echo $html->link('home','admin/home')?></li>
		<?php if (isset($_SESSION['ADMIN_LOGED']) && $_SESSION['ADMIN_LOGED']=='true'){?>
		<li <?php echo $current_news;?>><?php echo $html->link('news','admin/news')?></li>
		<li <?php echo $current_announcements;?>><?php echo $html->link('announcements','admin/announcements')?></li>
		<li <?php echo $current_articles;?>><?php echo $html->link('articles','admin/articles')?></li>
		<li <?php echo $current_gallery;?>><?php echo $html->link('gallery','admin/gallery')?></li>
		<li <?php echo $current_pages;?>><?php echo $html->link('pages','admin/pages')?></li>
		<li <?php echo $current_links;?>><?php echo $html->link('links','admin/links')?></li>
		<li <?php echo $current_users;?>><?php echo $html->link('users','admin/users')?></li>
		<li <?php echo $current_level;?>><?php echo $html->link('level','admin/level')?></li>
		<li <?php echo $current_logout;?>><?php echo $html->link('logout','admin/home/logout')?></li>
		<?php }?>
	</ul>
</div>
<div id="main">	
	<div id=center>
