<?php

class PagesControllerAdmin extends ControllerAdmin {
	function delete($id = null){
		$html = new HTML;
		
		$html->sanitize($id);
		
		$this->set('page','pages');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		
		//DELETE
		if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1'){
			$this->Pages->id = $id;
			if ($this->Pages->delete()){
					$this->set('msg', "Data successfully deleted");
				}else{
					$this->set('msg', "Data cannot deleted <br/ >". $this->Pages->getError() );
			}	
		}else{
			
			$this->set('msg', "You have no right to delete this item!");
		}
		
		//Show Pages
		$pageNumber = 1;
		$this->Pages->id=null;
	  	$this->Pages->setPage($pageNumber);
	  	$this->Pages->setLimit(PAGINATE_LIMIT);
	  	$pages = $this->Pages->search();
	  	$NumOfPages = $this->Pages->NumOfRecord();
	  	$this->set('NumOfPages',$NumOfPages);	  	
	  	$totalPages = $this->Pages->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('pages',$pages);
	  	$this->set('currentPageNumber',$pageNumber);
 
	}
	
	function edit($id = null ) {
		$html = new HTML;
		
		$this->set('page','pages');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		$id = $html->sanitize($id);
 		
		//List of pages
		$dispatch = $this->__construct_no_view("Pages");
		$this->Pages->id = null;
		$this->set("subpages",$this->Pages->search());
		$this->set("NumPages",$this->Pages->NumOfRecord());
		
		//Cek permission
		if (!isset($_SESSION['IS_ADMIN']) || $_SESSION['IS_ADMIN']!='1'){
			$this->set('msg', "You have no right to perform this action!");
			
		}else{
			 
			//Edit
			if (isset($_POST['act_new_id'])){
				$this->Pages->id = $html->sanitize($_POST["act_new_id"]);
				$this->Pages->name = $html->sanitize($_POST["name"]);
				$this->Pages->title = $html->sanitize($_POST["title"]);
				$this->Pages->parent = $html->sanitize($_POST["parent"]);
				$this->Pages->content = $_POST["content"];
				$this->Pages->user_created = $html->sanitize($_POST["user_created"]);
				$this->Pages->date_created = date("Y-m-d H:i:s", strtotime($_POST["date_created"]));
				$this->Pages->user_modified = $_SESSION['ADMIN_UID'];
				$this->Pages->date_modified = date("Y-m-d H:i:s", strtotime('now'));
				
				if ($this->Pages->save()){
					$this->set('msg', "Data successfully edited");
				}else{
					$this->set('msg', "Data cannot edited <br/ >". $this->Pages->getError() );
				}
			}
			//Show pages
			$this->Pages->id=$id;
			$pages = $this->Pages->search();
			$this->set('pages',$pages);
		}

		
 
	  		
	 	 
	}
	function add() {
		$html = new HTML;
		$this->set('page','pages');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		
		//List of pages
		$dispatch = $this->__construct_no_view("Pages");
		$this->Pages->id = null;
		$this->set("subpages",$this->Pages->search());
		$this->set("NumPages",$this->Pages->NumOfRecord());
		
		//Cek permission
		if (!isset($_SESSION['IS_ADMIN']) || $_SESSION['IS_ADMIN']!='1'){
			$this->set('msg', "You have no right to perform this action!");
			
		}else{
			//Show pages
			if (isset($_POST['act_new_id'])){
				$this->Pages->id = null;
				$this->Pages->name = $html->sanitize($_POST["name"]);
				$this->Pages->title = $html->sanitize($_POST["title"]);
				$this->Pages->parent = $html->sanitize($_POST["parent"]);
				$this->Pages->content = $_POST["content"];
				$this->Pages->user_created = $html->sanitize($_POST["user_created"]);
				$this->Pages->date_created = date("Y-m-d H:i:s", strtotime($_POST["date_created"]));
				$this->Pages->user_modified = $_SESSION['ADMIN_UID'];
				$this->Pages->date_modified = date("Y-m-d H:i:s", strtotime('now'));
				
				if ($this->Pages->save()){
					$this->set('msg', "Data successfully added");
				}else{
					$this->set('msg', "Data cannot added <br/ >". $this->Pages->getError() );
				}
				
			} 
		}
		
		
	}
	function index() {
		//Show pages
		$this->set('page','pages');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		$pageNumber = 1;
		$this->Pages->id=null;
		$this->Pages->orderBy("id","desc");
	  	$this->Pages->setPage($pageNumber);
	  	$this->Pages->setLimit(PAGINATE_LIMIT);
	  	$pages = $this->Pages->search();
	  	$NumOfPages = $this->Pages->NumOfRecord();
	  	$this->set('NumOfPages',$NumOfPages);	
	  	$totalPages = $this->Pages->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('pages',$pages);
	  	$this->set('currentPageNumber',$pageNumber);
	  		  
	}

	function page ($pageNumber = 1) {
	  	//Show pages
	  	$html = new HTML;
	  	$html->sanitize($pageNumber);
	  	$this->set('page','pages');
	  	$this->set('msg', "");
		$this->set('msg_comment', "");
		$this->Pages->id=null;
		$this->Pages->orderBy("id","desc");
	  	$this->Pages->setPage($pageNumber);
	  	$this->Pages->setLimit(PAGINATE_LIMIT);
	  	$pages = $this->Pages->search();
	  	$NumOfPages = $this->Pages->NumOfRecord();
	  	$this->set('NumOfPages',$NumOfPages);	
	  	$totalPages = $this->Pages->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('pages',$pages);
	  	$this->set('currentPageNumber',$pageNumber);
	  	
	}
	
}
