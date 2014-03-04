<?php

class ArticlesControllerAdmin extends ControllerAdmin {
	function delete($id = null){
		$html = new HTML;
		$this->set('page','articles');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		
		//DELETE
		if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1'){
			$this->Articles->id = $html->sanitize($id);
			if ($this->Articles->delete()){
					$this->set('msg', "Data successfully deleted");
				}else{
					$this->set('msg', "Data cannot deleted <br/ >". $this->Articles->getError() );
			}	
		}else{
			
			$this->set('msg', "You have no right to delete this item!");
		}
		
		//Show Articles
		$pageNumber = 1;
		$this->Articles->id=null;
	  	$this->Articles->setPage($pageNumber);
	  	$this->Articles->setLimit(PAGINATE_LIMIT);
	  	$articles = $this->Articles->search();
	  	$totalPages = $this->Articles->totalPages();
	  	$NumOfArticles = $this->Articles->NumOfRecord();
	  	$this->set('NumOfArticles',$NumOfArticles);
	  	$this->set('totalPages',$totalPages);
	  	$this->set('articles',$articles);
	  	$this->set('currentPageNumber',$pageNumber);

		//Comments
		$dispatch = $this->__construct_no_view("V_Comments_Admin");
		$this->V_Comments_Admin->id = null;
		$this->V_Comments_Admin->where("type",'articles');
		$this->V_Comments_Admin->where("ids",$id);
		$this->set("ArticlesComments",$this->V_Comments_Admin->search());
		$this->set("NumC",$this->V_Comments_Admin->NumOfRecord());
	}
	function edit($id = null,$param1 = null,$param2 = null,$param3 = null) {
		$html = new HTML;

		$this->set('page','articles');
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
					//$this->Articles->custom("update comments set `status`='0' where `id`='".$param3."'");
					$this->set('msg_comment', "Comment successfully hide");
				}elseif ($param2 == "show"){
					$this->Comments->id = $param3;
					$this->Comments->status = 1;
					$this->Comments->save(array("id","status"));
					//$this->Articles->custom("update comments set `status`='1' where `id`='".$param3."'");
					$this->set('msg_comment', "Comment successfully show");
							 
				}elseif ($param2 == "delete"){
					//$this->Articles->custom("delete from comments where `id`='".$param3."'");
					$this->Comments->id = $param3;
					$this->Comments->delete();
					$this->set('msg_comment', "Comment successfully delete");
				}
			}
			
			//Edit
			if (isset($_POST['act_new_id'])){
				$this->Articles->id = $html->sanitize($_POST["act_new_id"]);
				$this->Articles->subject = $html->sanitize($_POST["subject"]);
				$this->Articles->tags = $html->sanitize($_POST["tags"]);
				$this->Articles->front = $html->sanitize($_POST["front"]);
				$this->Articles->content = $html->sanitize($_POST["content"]);
				$this->Articles->user_created = $html->sanitize($_POST["user_created"]);
				$this->Articles->date_created = date("Y-m-d H:i:s", strtotime($_POST["date_created"]));
				$this->Articles->user_modified = $_SESSION['ADMIN_UID'];
				$this->Articles->date_modified = date("Y-m-d H:i:s", strtotime('now'));
				
				if ($this->Articles->save()){
					$this->set('msg', "Data successfully edited");
				}else{
					$this->set('msg', "Data cannot edited <br/ >". $this->Articles->getError() );
				}
			}
			
			//Show articles
			$this->Articles->id=$id;
			$articles = $this->Articles->search();
			$this->set('articles',$articles);
			
			//Comments
			$dispatch = $this->__construct_no_view("V_Comments_Admin");
			$this->V_Comments_Admin->id = null;
			$this->V_Comments_Admin->where("type",'articles');
			$this->V_Comments_Admin->where("ids",$id);
			$this->set("ArticlesComments",$this->V_Comments_Admin->search());
			$this->set("NumC",$this->V_Comments_Admin->NumOfRecord());
			
		}
	 	 
	}
	function add() {
		$html = new HTML;
		$this->set('page','articles');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		
		//Cek permission
		if (!isset($_SESSION['IS_ADMIN']) || $_SESSION['IS_ADMIN']!='1'){
			$this->set('msg', "You have no right to perform this action!");
			
		}else{
			//Show articles
			if (isset($_POST['act_new_id'])){
				$this->Articles->id = null;
				$this->Articles->subject = $html->sanitize($_POST["subject"]);
				$this->Articles->front = $html->sanitize($_POST["front"]);
				$this->Articles->content = $html->sanitize($_POST["content"]);
				$this->Articles->user_created = $html->sanitize($_POST["user_created"]);
				$this->Articles->date_created = date("Y-m-d H:i:s", strtotime($_POST["date_created"]));
				$this->Articles->user_modified = $_SESSION['ADMIN_UID'];
				$this->Articles->date_modified = date("Y-m-d H:i:s", strtotime('now'));
				
				if ($this->Articles->save()){
					$this->set('msg', "Data successfully added");
				}else{
					$this->set('msg', "Data cannot added <br/ >". $this->Articles->getError() );
				}
				
			} 
		}
		
		
	}
	function index() {
		//Show articles
		$this->set('page','articles');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		$pageNumber = 1;
		$this->Articles->id=null;
		$this->Articles->orderBy("id","desc");
	  	$this->Articles->setPage($pageNumber);
	  	$this->Articles->setLimit(PAGINATE_LIMIT);
	  	$articles = $this->Articles->search();
	  	$NumOfArticles = $this->Articles->NumOfRecord();
	  	$this->set('NumOfArticles',$NumOfArticles);
	  	$totalPages = $this->Articles->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('articles',$articles);
	  	$this->set('currentPageNumber',$pageNumber);
	  		  
	}

	function page ($pageNumber = 1) {
	  	//Show articles
	  	$html = new HTML;
	  	$html->sanitize($pageNumber);
	  	$this->set('page','articles');
	  	$this->set('msg', "");
		$this->set('msg_comment', "");
		$this->Articles->id=null;
		$this->Articles->orderBy("id","desc");
	  	$this->Articles->setPage($pageNumber);
	  	$this->Articles->setLimit(PAGINATE_LIMIT);
	  	$articles = $this->Articles->search();
	  	$NumOfArticles = $this->Articles->NumOfRecord();
	  	$this->set('NumOfArticles',$NumOfArticles);
	  	$totalPages = $this->Articles->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('articles',$articles);
	  	$this->set('currentPageNumber',$pageNumber);
	  	
	}
	
}
