<?php

class SitemapController extends Controller {

	function index() {
		$this->set('page','sitemap');
		$this->set('title','Sitemap - Darkengine v4');
		
		//PAGES
		$dispatch = $this->__construct_no_view("Pages");
		$this->Pages->id=null;
		$this->Pages->orderBy("id","Desc");
		$pages = $this->Pages->search();
		$found = $this->Pages->NumOfRecord();
		$this->set('numPages',$found);
		$this->set('pages',$pages);
		
		//Announcements
		$dispatch = $this->__construct_no_view("Announcements");
		$this->Announcements->id=null;
		$this->Announcements->orderBy("id","Desc");
		$announcements = $this->Announcements->search();
		$found = $this->Announcements->NumOfRecord();
		$this->set('numAnnouncements',$found);
		$this->set('announcements',$announcements);
		
		//Articles
		$dispatch = $this->__construct_no_view("Articles");
		$this->Articles->id=null;
		$this->Articles->orderBy("id","Desc");
		$articles = $this->Articles->search();
		$found = $this->Articles->NumOfRecord();
		$this->set('numArticles',$found);
		$this->set('articles',$articles);
		
		//Gallery
		$dispatch = $this->__construct_no_view("Gallery");
		$this->Gallery->id=null;
		$this->Gallery->orderBy("id","Desc");
		$gallery = $this->Gallery->search();
		$found = $this->Gallery->NumOfRecord();
		$this->set('numGallery',$found);
		$this->set('gallery',$gallery);
		
		//News
		$dispatch = $this->__construct_no_view("News");
		$this->News->id=null;
		$this->News->orderBy("id","Desc");
		$news = $this->News->search();
		$found = $this->News->NumOfRecord();
		$this->set('numNews',$found);
		$this->set('news',$news);
	}
	
	 

}
