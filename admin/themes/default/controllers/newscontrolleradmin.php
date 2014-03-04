<?php

class NewsControllerAdmin extends ControllerAdmin {
	function delete($id = null){
		$html = new HTML;
		
		$html->sanitize($id);
		
		$this->set('page','news');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		
		//DELETE
		if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1'){
			$this->News->id = $id;
			if ($this->News->delete()){
					$this->set('msg', "Data successfully deleted");
				}else{
					$this->set('msg', "Data cannot deleted <br/ >". $this->News->getError() );
			}	
		}else{
			
			$this->set('msg', "You have no right to delete this item!");
		}
		
		//Show News
		$pageNumber = 1;
		$this->News->id=null;
	  	$this->News->setPage($pageNumber);
	  	$this->News->setLimit(PAGINATE_LIMIT);
	  	$news = $this->News->search();
	  	$NumOfNews = $this->News->NumOfRecord();
	  	$this->set('NumOfNews',$NumOfNews);
	  	$totalPages = $this->News->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('news',$news);
	  	$this->set('currentPageNumber',$pageNumber);

		//Comments
		$dispatch = $this->__construct_no_view("V_Comments_Admin");
		$this->V_Comments_Admin->id = null;
		$this->V_Comments_Admin->where("type",'news');
		$this->V_Comments_Admin->where("ids",$id);
		$this->set("NewsComments",$this->V_Comments_Admin->search());
		$this->set("NumC",$this->V_Comments_Admin->NumOfRecord());
	}
	
	function edit($id = null,$param1 = null,$param2 = null,$param3 = null) {
		$html = new HTML;
		$this->set('page','news');
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
					//$this->News->custom("update comments set `status`='0' where `id`='".$param3."'");
					$this->set('msg_comment', "Comment successfully hide");
				}elseif ($param2 == "show"){
					$this->Comments->id = $param3;
					$this->Comments->status = 1;
					$this->Comments->save(array("id","status"));
					//$this->News->custom("update comments set `status`='1' where `id`='".$param3."'");
					$this->set('msg_comment', "Comment successfully show");
							 
				}elseif ($param2 == "delete"){
					//$this->News->custom("delete from comments where `id`='".$param3."'");
					$this->Comments->id = $param3;
					$this->Comments->delete();
					$this->set('msg_comment', "Comment successfully delete");
				}
			}
			
			//Edit
			if (isset($_POST['act_new_id'])){
				$this->News->id = $html->sanitize($_POST["act_new_id"]);
				$this->News->subject = $html->sanitize($_POST["subject"]);
				$this->News->tags = $html->sanitize($_POST["tags"]);
				$this->News->front = $html->sanitize($_POST["front"]);
				$this->News->content = $_POST["content"];
				$this->News->user_created = $html->sanitize($_POST["user_created"]);
				$this->News->date_created = date("Y-m-d H:i:s", strtotime($_POST["date_created"]));
				$this->News->user_modified = $_SESSION['ADMIN_UID'];
				$this->News->date_modified = date("Y-m-d H:i:s", strtotime('now'));
				
				if ($this->News->save()){
					$this->set('msg', "Data successfully edited");
				}else{
					$this->set('msg', "Data cannot edited <br/ >". $this->News->getError() );
				}
			}
			
				
			//Show news
			$this->News->id=$id;
			$news = $this->News->search();
			$this->set('news',$news);
			
			//Comments
			$dispatch = $this->__construct_no_view("V_Comments_Admin");
			$this->V_Comments_Admin->id = null;
			$this->V_Comments_Admin->where("type",'news');
			$this->V_Comments_Admin->where("ids",$id);
			$this->set("NewsComments",$this->V_Comments_Admin->search());
			$this->set("NumC",$this->V_Comments_Admin->NumOfRecord());
			
		}

	  		
	 	 
	}
	function add() {
		$html = new HTML;
		$this->set('page','news');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		
		//Cek permission
		if (!isset($_SESSION['IS_ADMIN']) || $_SESSION['IS_ADMIN']!='1'){
			$this->set('msg', "You have no right to perform this action!");
			
		}else{
			//Show news
			if (isset($_POST['act_new_id'])){
				$this->News->id = null;
				$this->News->subject = $html->sanitize($_POST["subject"]);
				$this->News->tags = $html->sanitize($_POST["tags"]);
				$this->News->front = $html->sanitize($_POST["front"]);
				$this->News->content = $_POST["content"];
				$this->News->user_created = $html->sanitize($_POST["user_created"]);
				$this->News->date_created = date("Y-m-d H:i:s", strtotime($_POST["date_created"]));
				$this->News->user_modified = $_SESSION['ADMIN_UID'];
				$this->News->date_modified = date("Y-m-d H:i:s", strtotime('now'));
				
				if ($this->News->save()){
					$this->set('msg', "Data successfully added");
				}else{
					$this->set('msg', "Data cannot added <br/ >". $this->News->getError() );
				}
				
			} 
		}
		
		
	}
	function index() {
		//Show news
		$this->set('page','news');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		$pageNumber = 1;
		$this->News->id=null;
		$this->News->orderBy("id","desc");
	  	$this->News->setPage($pageNumber);
	  	$this->News->setLimit(PAGINATE_LIMIT);
	  	$news = $this->News->search();
	  	$NumOfNews = $this->News->NumOfRecord();
	  	$this->set('NumOfNews',$NumOfNews);
	  	$totalPages = $this->News->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('news',$news);
	  	$this->set('currentPageNumber',$pageNumber);
	  		  
	}

	function page ($pageNumber = 1) {
	  	//Show news
	  	$html = new HTML;
	  	$html->sanitize($pageNumber);
	  	$this->set('page','news');
	  	$this->set('msg', "");
		$this->set('msg_comment', "");
		$this->News->id=null;
		$this->News->orderBy("id","desc");
	  	$this->News->setPage($pageNumber);
	  	$this->News->setLimit(PAGINATE_LIMIT);
	  	$news = $this->News->search();
	  	$NumOfNews = $this->News->NumOfRecord();
	  	$this->set('NumOfNews',$NumOfNews);
	  	$totalPages = $this->News->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('news',$news);
	  	$this->set('currentPageNumber',$pageNumber);
	  	
	}
	
}
