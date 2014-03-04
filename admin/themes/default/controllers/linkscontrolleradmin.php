<?php

class LinksControllerAdmin extends ControllerAdmin {
	function delete($id = null){
		$html = new HTML;
		
		$html->sanitize($id);
		
		$this->set('page','links');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		
		//DELETE
		if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1'){
			$this->Links->id = $id;
			if ($this->Links->delete()){
					$this->set('msg', "Data successfully deleted");
				}else{
					$this->set('msg', "Data cannot deleted <br/ >". $this->Links->getError() );
			}	
		}else{
			
			$this->set('msg', "You have no right to delete this item!");
		}
		
		//Show Links
		$pageNumber = 1;
		$this->Links->id=null;
	  	$this->Links->setPage($pageNumber);
	  	$this->Links->setLimit(PAGINATE_LIMIT);
	  	$links = $this->Links->search();
	  	$NumOfLinks = $this->Links->NumOfRecord();
	  	$this->set('NumOfLinks',$NumOfLinks);
	  	$totalPages = $this->Links->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('links',$links);
	  	$this->set('currentPageNumber',$pageNumber);

		//Comments
		$dispatch = $this->__construct_no_view("V_Comments_Admin");
		$this->V_Comments_Admin->id = null;
		$this->V_Comments_Admin->where("type",'links');
		$this->V_Comments_Admin->where("ids",$id);
		$this->set("LinksComments",$this->V_Comments_Admin->search());
		$this->set("NumC",$this->V_Comments_Admin->NumOfRecord());
	}
	
	function edit($id = null ) {
		$html = new HTML;
		
		$this->set('page','links');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		$id = $html->sanitize($id);
		 
		
		//Cek permission
		if (!isset($_SESSION['IS_ADMIN']) || $_SESSION['IS_ADMIN']!='1'){
			$this->set('msg', "You have no right to perform this action!");
			
		}else{
			//Edit
			if (isset($_POST['act_new_id'])){
				
				$pic=$_FILES['image']['name'];
				$uploaddir = ROOT . '/public/uploads/image/links/';
				$uploadfile = $uploaddir . $_FILES['image']['name'];
				$type = $_FILES['image']['type'];
				
				$noimg = (int)isset($_POST['no_img']);
				
				if ($pic != "" &&  $noimg == 0){
					if(!$html->cekFileType($type)){
						$this->set('msg', "File Type ".$type . " not allowed!");
					}else{
						if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
							chmod($uploadfile,0755);
							 
							$this->Links->id = $html->sanitize($_POST["act_new_id"]);
							$this->Links->name = $html->sanitize($_POST["name"]);
							$this->Links->image = $html->sanitize($_FILES['image']['name']);
							$this->Links->to = $html->sanitize($_POST["to"]);
							$this->Links->user_created = $html->sanitize($_POST["user_created"]);
							$this->Links->date_created = date("Y-m-d H:i:s", strtotime($_POST["date_created"]));
							$this->Links->user_modified = $_SESSION['ADMIN_UID'];
							$this->Links->date_modified = date("Y-m-d H:i:s", strtotime('now'));
							
							if ($this->Links->save()){
								$this->set('msg', "Data successfully edited");
							}else{
								$this->set('msg', "Data cannot edited <br/ >". $this->Links->getError() );
							}
							
						}
					}
				}else{
					$this->Links->id = $html->sanitize($_POST["act_new_id"]);
					$this->Links->name = $html->sanitize($_POST["name"]);
					if ($noimg == 1)
						$this->Links->image = "nothing";
					else
						$this->Links->image = "";
					
					$this->Links->to = $html->sanitize($_POST["to"]);
					$this->Links->user_created = $html->sanitize($_POST["user_created"]);
					$this->Links->date_created = date("Y-m-d H:i:s", strtotime($_POST["date_created"]));
					$this->Links->user_modified = $_SESSION['ADMIN_UID'];
					$this->Links->date_modified = date("Y-m-d H:i:s", strtotime('now'));
					
					if ($this->Links->save()){
						$this->set('msg', "Data successfully edited");
					}else{
						$this->set('msg', "Data cannot edited <br/ >". $this->Links->getError() );
					}
					
				}
			}
			//Show links
			$this->Links->id=$id;
			$links = $this->Links->search();
			$this->set('links',$links);
			
			//Comments
			$dispatch = $this->__construct_no_view("V_Comments_Admin");
			$this->V_Comments_Admin->id = null;
			$this->V_Comments_Admin->where("type",'links');
			$this->V_Comments_Admin->where("ids",$id);
			$this->set("LinksComments",$this->V_Comments_Admin->search());
			$this->set("NumC",$this->V_Comments_Admin->NumOfRecord());
		}
	 	 
	}
	function add() {
		$html = new HTML;
		$this->set('page','links');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		
		//Cek permission
		if (!isset($_SESSION['IS_ADMIN']) || $_SESSION['IS_ADMIN']!='1'){
			$this->set('msg', "You have no right to perform this action!");
			
		}else{
			//Show links
			if (isset($_POST['act_new_id'])){
				$pic=$_FILES['image']['name'];
				$uploaddir = ROOT . '/public/uploads/image/links/';
				$uploadfile = $uploaddir . $_FILES['image']['name'];
				$type = $_FILES['image']['type'];
				
				if ($pic != ""){
					if(!$html->cekFileType($type)){
						$this->set('msg', "File Type ".$type . " not allowed!");
					}else{
						if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
							chmod($uploadfile,0755);
							
							$this->Links->id = null;
							$this->Links->name = $html->sanitize($_POST["name"]);
							$this->Links->image = $html->sanitize($pic);
							$this->Links->to = $html->sanitize($_POST["to"]);
							$this->Links->user_created = $html->sanitize($_POST["user_created"]);
							$this->Links->date_created = date("Y-m-d H:i:s", strtotime($_POST["date_created"]));
							$this->Links->user_modified = $_SESSION['ADMIN_UID'];
							$this->Links->date_modified = date("Y-m-d H:i:s", strtotime('now'));
							
							if ($this->Links->save()){
								$this->set('msg', "Data successfully added");
							}else{
								$this->set('msg', "Data cannot added <br/ >". $this->Links->getError() );
							}
							 
						}
					}
				}else{
					$this->Links->id = null;
					$this->Links->name = $html->sanitize($_POST["name"]);
					$this->Links->image = "nothing";
					$this->Links->to = $html->sanitize($_POST["to"]);
					$this->Links->user_created = $html->sanitize($_POST["user_created"]);
					$this->Links->date_created = date("Y-m-d H:i:s", strtotime($_POST["date_created"]));
					$this->Links->user_modified = $_SESSION['ADMIN_UID'];
					$this->Links->date_modified = date("Y-m-d H:i:s", strtotime('now'));
					
					if ($this->Links->save()){
						$this->set('msg', "Data successfully added");
					}else{
						$this->set('msg', "Data cannot added <br/ >". $this->Links->getError() );
					}
				}
			} 
		}
		
	}
	function index() {
		//Show links
		$this->set('page','links');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		$pageNumber = 1;
		$this->Links->id=null;
		$this->Links->orderBy("id","desc");
	  	$this->Links->setPage($pageNumber);
	  	$this->Links->setLimit(PAGINATE_LIMIT);
	  	$links = $this->Links->search();
	  	$NumOfLinks = $this->Links->NumOfRecord();
	  	$this->set('NumOfLinks',$NumOfLinks);
	  	$totalPages = $this->Links->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('links',$links);
	  	$this->set('currentPageNumber',$pageNumber);
	  		  
	}

	function page ($pageNumber = 1) {
	  	//Show links
	  	$html = new HTML;
	  	$html->sanitize($pageNumber);
	  	$this->set('page','links');
	  	$this->set('msg', "");
		$this->set('msg_comment', "");
		$this->Links->id=null;
		$this->Links->orderBy("id","desc");
	  	$this->Links->setPage($pageNumber);
	  	$this->Links->setLimit(PAGINATE_LIMIT);
	  	$links = $this->Links->search();
	  	$NumOfLinks = $this->Links->NumOfRecord();
	  	$this->set('NumOfLinks',$NumOfLinks);
	  	$totalPages = $this->Links->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('links',$links);
	  	$this->set('currentPageNumber',$pageNumber);
	  	
	}
	
}
