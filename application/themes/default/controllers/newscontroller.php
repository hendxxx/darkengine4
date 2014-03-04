<?php

class NewsController extends Controller {

	 function view($id = null,$name = null) {
		$html = new HTML;
		$captcha = new Captcha;
		
		$id = $html->sanitize($id);
		$name = $html->sanitize($name);
		
		$this->set('msg','');
		 
 		$this->set('name' ,'Anonymous');
 		$this->set('subject' ,'No Subject');
 		$this->set('comment' ,'');

		//Save Comment
		if (isset($_POST['do']) &&  $_POST['do']=='_save_comment'){
			if ($captcha->IsVerOK()){
				$this->set('msg','Saving comment...');
				
				$dispatch = $this->__construct_no_view("Comments");
				$this->Comments->id = null;
				$this->Comments->type = "news";
				$this->Comments->ids = $html->sanitize($id);
				$this->Comments->name = $html->sanitize($_POST["name"]);
				$this->Comments->subject = $html->sanitize($_POST["subject"]);
				$this->Comments->comment =$html->sanitize( $_POST["comment"]);
				$this->Comments->status = "1";
				$this->Comments->user_created = $html->sanitize($_POST["name"]);
				$this->Comments->date_created = date("Y-m-d H:i:s", strtotime('now'));
				$this->Comments->user_modified = $html->sanitize($_POST["name"]);
				$this->Comments->date_modified = date("Y-m-d H:i:s", strtotime('now'));
				
				if ($this->Comments->save()){
					$this->set('msg', "Your comment successfully added");
				}else{
					$this->set('name' ,$html->sanitize($_POST["name"]));
		 			$this->set('subject' ,$html->sanitize($_POST["subject"]));
		 			$this->set('comment' ,$html->sanitize($_POST["comment"]));
		 			$this->set('msg', "Your comment cannot added ");
				}
			}else{
				$this->set('name' ,$html->sanitize($_POST["name"]));
		 		$this->set('subject' ,$html->sanitize($_POST["subject"]));
		 		$this->set('comment' ,$html->sanitize($_POST["comment"]));
		 		
				$this->set('msg','verification failed');
			}
			
		}
		
		//show News
	 	$this->set('page','news');
		$name = str_replace("-"," ",$name);
		$this->set('title',$name.' - Darkengine v4');
		$this->News->id=$id;
		$news = $this->News->search();
		$this->set('news',$news);
		
		//comments
		$dispatch = $this->__construct_no_view("V_Comments");
		$this->V_Comments->id = null;
		$this->V_Comments->where("type",'news');
		$this->V_Comments->where("ids",$id);
		$this->set("V_Comments",$this->V_Comments->search());
		$this->set("NumC",$this->V_Comments->NumOfRecord());
		
		
	}
	
	function index() {
		$this->set('page','news');
		$this->set('title','News - Darkengine v4');
		$pageNumber = 1;
		$this->News->id=null;
	  	$this->News->setPage($pageNumber);
	  	$this->News->setLimit(PAGINATE_LIMIT);
	  	$this->News->orderby('id','desc');
	  	$news = $this->News->search();
	  	$totalPages = $this->News->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('news',$news);
	  	$this->set('currentPageNumber',$pageNumber);
	  	
	  	//comments
	  	$dispatch = $this->__construct_no_view("V_Comments");
		$this->V_Comments->id = null;
		$this->V_Comments->where("type",'news');
		$this->set("newsComments",$this->V_Comments->search());
		$this->set("NumC",$this->V_Comments->NumOfRecord());
		
	}

	function page ($pageNumber = 1) {
	  	$html = new HTML;
	  	$pageNumber = $html->sanitize($pageNumber);
	  	
	  	$this->set('page','news');
		$this->set('title','News - Darkengine v4');
	  	$this->News->id=null;
	  	$this->News->setPage($pageNumber);
	  	$this->News->setLimit(PAGINATE_LIMIT);
	  	$this->News->orderby('id','desc');
	  	$news = $this->News->search();
	  	$totalPages = $this->News->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('news',$news);
	  	$this->set('currentPageNumber',$pageNumber);

	  	//comments
	  	$dispatch = $this->__construct_no_view("V_Comments");
		$this->V_Comments->id = null;
		$this->V_Comments->where("type",'news');
		$this->set("newsComments",$this->V_Comments->search());
		$this->set("NumC",$this->V_Comments->NumOfRecord());
	}
	
}
