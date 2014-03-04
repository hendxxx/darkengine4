<?php

class LevelControllerAdmin extends ControllerAdmin {
	function delete($id = null){
		$html = new HTML;
		
		$html->sanitize($id);
		
		$this->set('page','level');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		
		//DELETE
		if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1'){
			$this->Level->id = $id;
			if ($this->Level->delete()){
					$this->set('msg', "Data successfully deleted");
				}else{
					$this->set('msg', "Data cannot deleted <br/ >". $this->Level->getError() );
			}	
		}else{
			
			$this->set('msg', "You have no right to delete this item!");
		}
		
		//Show Level
		$pageNumber = 1;
		$this->Level->id=null;
	  	$this->Level->setPage($pageNumber);
	  	$this->Level->setLimit(PAGINATE_LIMIT);
	  	$level = $this->Level->search();
	  	$NumOfLevel = $this->Level->NumOfRecord();
	  	$this->set('NumOfLevel',$NumOfLevel);
	  	$totalPages = $this->Level->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('level',$level);
	  	$this->set('currentPageNumber',$pageNumber);
 
	}
	
	function edit($id = null ) {
		$html = new HTML;
		
		$this->set('page','level');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		$id = $html->sanitize($id);
		
		//Cek permission
		if ((!isset($_SESSION['IS_ADMIN']) || $_SESSION['IS_ADMIN']!='1')){
			if ($_SESSION['ADMIN_Uid_id'] == $id){
				//Show level
				$this->Level->id=$id;
				$level = $this->Level->search();
				$this->set('id',$id);
				$this->set('level',$level);
			}else{
				$this->set('msg', "You have no right to perform this action!");	
			}
			
		}else{
			//Edit
			if (isset($_POST['id'])){
				$this->Level->id = $id;
				$this->Level->LevelName = $html->sanitize($_POST["levelname"]);
				$this->Level->IsAdmin = $html->sanitize($_POST["isadmin"]);
				
				if ($this->Level->save()){
					$this->set('msg', "Data successfully edited");
				}else{
					$this->set('msg', "Data cannot edited <br/ >". $this->Level->getError() );
				}
			}

			//Show level
			$this->Level->id=$id;
			$level = $this->Level->search();
			$this->set('level',$level);
			
		}
	 	 
	}
	function add() {
		$html = new HTML;
		$this->set('page','level');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		
		//Cek permission
		if (!isset($_SESSION['IS_ADMIN']) || $_SESSION['IS_ADMIN']!='1'){
			$this->set('msg', "You have no right to perform this action!");
		}else{
			//Show level
			if (isset($_POST['id'])){
				 
					$this->Level->id = null;
					$this->Level->LevelName = $html->sanitize($_POST["levelname"]);
					$this->Level->IsAdmin = $html->sanitize($_POST["isadmin"]);
					
					if ($this->Level->save()){
						$this->set('msg', "Data successfully added");
					}else{
						$this->set('msg', "Data cannot added <br/ >". $this->Level->getError() );
					}
				 
			} 
		}
		
		
	}
	function index() {
		//Show level
		$this->set('page','level');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		$pageNumber = 1;
		$this->Level->id=null;
		$this->Level->orderBy("id","desc");
	  	$this->Level->setPage($pageNumber);
	  	$this->Level->setLimit(PAGINATE_LIMIT);
	  	$level = $this->Level->search();
	  	$NumOfLevel = $this->Level->NumOfRecord();
	  	$this->set('NumOfLevel',$NumOfLevel);
	  	$totalPages = $this->Level->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('level',$level);
	  	$this->set('currentPageNumber',$pageNumber); 
	}

	function page ($pageNumber = 1) {
	  	//Show level
	  	$html = new HTML;
	  	$html->sanitize($pageNumber);
	  	$this->set('page','level');
	  	$this->set('msg', "");
		$this->set('msg_comment', "");
		$this->Level->id=null;
		$this->Level->orderBy("id","desc");
	  	$this->Level->setPage($pageNumber);
	  	$this->Level->setLimit(PAGINATE_LIMIT);
	  	$level = $this->Level->search();
	  	$NumOfLevel = $this->Level->NumOfRecord();
	  	$this->set('NumOfLevel',$NumOfLevel);
	  	$totalPages = $this->Level->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('level',$level);
	  	$this->set('currentPageNumber',$pageNumber);
	  	
	}
	
}
