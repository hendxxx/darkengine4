<?php

class AnnouncementsControllerAdmin extends ControllerAdmin {
	function delete($id = null){
		$html = new HTML;
		$this->set('page','announcements');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		
		//DELETE
		if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1'){
			$this->Announcements->id = $html->sanitize($id);
			if ($this->Announcements->delete()){
					$this->set('msg', "Data successfully deleted");
				}else{
					$this->set('msg', "Data cannot deleted <br/ >". $this->Announcements->getError() );
			}	
		}else{
			
			$this->set('msg', "You have no right to delete this item!");
		}
		
		//Show Announcements
		$pageNumber = 1;
		$this->Announcements->id=null;
	  	$this->Announcements->setPage($pageNumber);
	  	$this->Announcements->setLimit(PAGINATE_LIMIT);
	  	$announcements = $this->Announcements->search();
	  	$NumOfAnnouncements = $this->Announcements->NumOfRecord();
	  	$this->set('NumOfAnnouncements',$NumOfAnnouncements);
	  	$totalPages = $this->Announcements->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('announcements',$announcements);
	  	$this->set('currentPageNumber',$pageNumber);

		//Comments
		$dispatch = $this->__construct_no_view("V_Comments_Admin");
		$this->V_Comments_Admin->id = null;
		$this->V_Comments_Admin->where("type",'announcements');
		$this->V_Comments_Admin->where("ids",$id);
		$this->set("AnnouncementsComments",$this->V_Comments_Admin->search());
		$this->set("NumC",$this->V_Comments_Admin->NumOfRecord());
	}
	function edit($id = null,$param1 = null,$param2 = null,$param3 = null) {
		$html = new HTML;
		
		$this->set('page','announcements');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		$id = $html->sanitize($id);
		$param1 = $html->sanitize($param1);
		$param2 = $html->sanitize($param2);
		$param3 = $html->sanitize($param3);
		
		//Cek permission
		if (!isset($_SESSION['IS_ADMIN']) || $_SESSION['IS_ADMIN']!='1'){
			$this->set('msg', "You have no right to perform this action!");
			
		}else{
			//Comments Actions
			if ($param1 == "comment"){
				$dispatch = $this->__construct_no_view("Comments");
				if ($param2 == "hide"){
					$this->Comments->id = $param3;
					$this->Comments->status = 0;
					$this->Comments->save(array("id","status"));
					//$this->Announcements->custom("update comments set `status`='0' where `id`='".$param3."'");
					$this->set('msg_comment', "Comment successfully hide");
				}elseif ($param2 == "show"){
					$this->Comments->id = $param3;
					$this->Comments->status = 1;
					$this->Comments->save(array("id","status"));
					//$this->Announcements->custom("update comments set `status`='1' where `id`='".$param3."'");
					$this->set('msg_comment', "Comment successfully show");
							 
				}elseif ($param2 == "delete"){
					//$this->Announcements->custom("delete from comments where `id`='".$param3."'");
					$this->Comments->id = $param3;
					$this->Comments->delete();
					$this->set('msg_comment', "Comment successfully delete");
				}
			}
			
			//Edit
			if (isset($_POST['act_new_id'])){
				$this->Announcements->id = $html->sanitize($_POST["act_new_id"]);
				$this->Announcements->subject = $html->sanitize($_POST["subject"]);
				$this->Announcements->front = $html->sanitize($_POST["front"]);
				$this->Announcements->content = $html->sanitize($_POST["content"]);
				$this->Announcements->user_created = $html->sanitize($_POST["user_created"]);
				$this->Announcements->date_created = date("Y-m-d H:i:s", strtotime($_POST["date_created"]));
				$this->Announcements->user_modified = $_SESSION['ADMIN_UID'];
				$this->Announcements->date_modified = date("Y-m-d H:i:s", strtotime('now'));
				
				if ($this->Announcements->save()){
					$this->set('msg', "Data successfully edited");
				}else{
					$this->set('msg', "Data cannot edited <br/ >". $this->Announcements->getError() );
				}
			}
			
			//Show announcements
			$this->Announcements->id=$id;
			$announcements = $this->Announcements->search();
			$this->set('announcements',$announcements);
			
			//Comments
			$dispatch = $this->__construct_no_view("V_Comments_Admin");
			$this->V_Comments_Admin->id = null;
			$this->V_Comments_Admin->where("type",'announcements');
			$this->V_Comments_Admin->where("ids",$id);
			$this->set("AnnouncementsComments",$this->V_Comments_Admin->search());
			$this->set("NumC",$this->V_Comments_Admin->NumOfRecord());
			
		}

		
	  		
	 	 
	}
	function add() {
		$html = new HTML;
		$this->set('page','announcements');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		
		//Cek permission
		if (!isset($_SESSION['IS_ADMIN']) || $_SESSION['IS_ADMIN']!='1'){
			$this->set('msg', "You have no right to perform this action!");
			
		}else{
			//Show announcements
			if (isset($_POST['act_new_id'])){
				$this->Announcements->id = null;
				$this->Announcements->subject = $html->sanitize($_POST["subject"]);
				$this->Announcements->front = $html->sanitize($_POST["front"]);
				$this->Announcements->content = $html->sanitize($_POST["content"]);
				$this->Announcements->user_created = $html->sanitize($_POST["user_created"]);
				$this->Announcements->date_created = date("Y-m-d H:i:s", strtotime($_POST["date_created"]));
				$this->Announcements->user_modified = $_SESSION['ADMIN_UID'];
				$this->Announcements->date_modified = date("Y-m-d H:i:s", strtotime('now'));
				
				if ($this->Announcements->save()){
					$this->set('msg', "Data successfully added");
				}else{
					$this->set('msg', "Data cannot added <br/ >". $this->Announcements->getError() );
				}
				
			} 
		}
		
		
	}
	function index() {
		//Show announcements
		$this->set('page','announcements');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		$pageNumber = 1;
		$this->Announcements->id=null;
		$this->Announcements->orderBy("id","desc");
	  	$this->Announcements->setPage($pageNumber);
	  	$this->Announcements->setLimit(PAGINATE_LIMIT);
	  	$announcements = $this->Announcements->search();
	  	$NumOfAnnouncements = $this->Announcements->NumOfRecord();
	  	$this->set('NumOfAnnouncements',$NumOfAnnouncements);
	  	$totalPages = $this->Announcements->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('announcements',$announcements);
	  	$this->set('currentPageNumber',$pageNumber);
	  		  
	}

	function page ($pageNumber = 1) {
	  	//Show announcements
	  	$html = new HTML;
	  	$html->sanitize($pageNumber);
	  	$this->set('page','announcements');
	  	$this->set('msg', "");
		$this->set('msg_comment', "");
		$this->Announcements->id=null;
		$this->Announcements->orderBy("id","desc");
	  	$this->Announcements->setPage($pageNumber);
	  	$this->Announcements->setLimit(PAGINATE_LIMIT);
	  	$announcements = $this->Announcements->search();
	  	$NumOfAnnouncements = $this->Announcements->NumOfRecord();
	  	$this->set('NumOfAnnouncements',$NumOfAnnouncements);
	  	$totalPages = $this->Announcements->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('announcements',$announcements);
	  	$this->set('currentPageNumber',$pageNumber);
	  	
	}
	
}
