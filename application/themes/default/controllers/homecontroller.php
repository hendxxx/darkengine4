<?php

class HomeController extends Controller {

 	function index() {
		$this->set('title','Darkengine v4');
		$this->set('page','home');

		//Latest News
		$dispatch = $this->__construct_no_view("News");
		$this->News->orderBy('date_created','DESC');
		$this->News->id = null;
		$this->News->setLimit(5);
		$this->News->setPage(1);
		$this->set('news',$this->News->search());
		$this->set('NumNews',$this->News->NumOfRecord());
		//Comments
		$dispatch = $this->__construct_no_view("V_Comments");
		$this->V_Comments->id = null;
		$this->V_Comments->where("type","news");
		$this->set('newsComments',$this->V_Comments->search());
		$this->set('NumCNews',$this->V_Comments->NumOfRecord());
		 
		//$this->set('newsComments',$this->News->custom("select * from `V_NumOfComments` where `type`='news'"));
		
		//Announcements
		$dispatch = $this->__construct_no_view("Announcements");
		$this->Announcements->id = null;
		$this->Announcements->setLimit(1);
		$this->Announcements->setPage(1);
		$this->Announcements->orderBy('date_created','DESC');
		$this->set('announcements',$this->Announcements->search());
		//Comments
		$dispatch = $this->__construct_no_view("V_Comments");
		$this->V_Comments->id = null;
		$this->V_Comments->where("type","announcements");
		$this->set('announcementsComments',$this->V_Comments->search());
		$this->set('NumCAnnouncements',$this->V_Comments->NumOfRecord());
		//$this->set('announcementsComments',$this->Announcements->custom("select * from `V_NumOfComments` where `type`='announcements'"));
		
		//Articles
		$dispatch = $this->__construct_no_view("Articles");
		$this->Articles->id = null;
		$this->Articles->setLimit(4);
		$this->Articles->setPage(1);
		$this->Articles->orderBy('date_created','DESC');
		$this->set('articles',$this->Articles->search());
		//Comments
		$dispatch = $this->__construct_no_view("V_Comments");
		$this->V_Comments->id = null;
		$this->V_Comments->where("type","articles");
		$this->V_Comments->orderBy('date_created','DESC');
		$this->set('articlesComments',$this->V_Comments->search());
		$this->set('NumCArticles',$this->V_Comments->NumOfRecord());
		//$this->set('articlesComments',$this->Articles->custom("select * from `V_NumOfComments` where `type`='articles'"));
				 
		//Latest Comments
		$dispatch = $this->__construct_no_view("V_Comments");
		$this->V_Comments->id = null;
		$this->V_Comments->where("status","1");
		$this->V_Comments->setLimit(6);
		$this->V_Comments->setPage(1);
		$this->V_Comments->orderBy('date_created','DESC');
		$this->set('comments',$this->V_Comments->search());
		$this->set('NumC',$this->V_Comments->NumOfRecord());
		
		//Links
		$dispatch = $this->__construct_no_view("Links");
		$this->Links->id = null;
		$this->Links->orderBy('date_created','DESC');
		$this->set('links',$this->Links->search());
		$this->set('NumLinks',$this->Links->NumOfRecord());
		
		//Tag Cloud
		$dispatch = $this->__construct_no_view("V_Tags");
		$this->V_Tags->id = null;
		$this->set('TagCloud',$this->V_Tags->search());
	}
	
 
}
