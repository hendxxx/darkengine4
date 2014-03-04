<?php

class AnnouncementsController extends Controller {
	protected $Page_Limit = 10;
	
	function index($pageNumber = 1,$id = null) {

		$html = new HTML;
		$pageNumber = $html->sanitize($pageNumber);
		
		$this->set('page','announcements');
		$this->set('title','Announcements - Darkengine v4');
		 
		if((int)($pageNumber) == 0 || ( $id!=null && (int)$id == 0)) {
			$this->render('404.php');
		}else{
			$this->Announcements->id=$id;
			$this->Announcements->setPage($pageNumber);
			$this->Announcements->setLimit($this->Page_Limit);
			$this->Announcements->orderby('id','desc');
			
			$announcements = $this->Announcements->search();
			$totalPages = $this->Announcements->totalPages();
			$this->set('totalPages',$totalPages);
			$this->set('announcements',$announcements);
			$this->set('currentPageNumber',$pageNumber);
			  	
			//comments
			$dispatch = $this->__construct_no_view("V_Comments");
			$this->V_Comments->id = $id;
			$this->V_Comments->where("type",'announcements');
			
			if ($id != null)
				$this->V_Comments->where("id",$id);
			
			$this->set("announcementsComments",$this->V_Comments->search());
			$this->set("NumC",$this->V_Comments->NumOfRecord());
			
			$dispatch = $this->__construct_no_view("V_Comments");
			$this->V_Comments->id = null;
			$this->V_Comments->where("type",'announcements');
			$this->V_Comments->where("ids",$id);
			$this->set("V_Comments",$this->V_Comments->search());
			$this->set("NumC",$this->V_Comments->NumOfRecordAfterFilter());
 		
		}
		
	}

	function page ($pageNumber = 1) {
	  	$html = new HTML;
	  	$pageNumber = $html->sanitize($pageNumber);
	  	$this->index($pageNumber);
	  	if((int)($pageNumber) > 0 ) {
			$this->render('announcements/index.php');
		}
	}
	
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
				$this->Comments->type = "announcements";
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

		$this->index(1,$id);
	}
 
}
