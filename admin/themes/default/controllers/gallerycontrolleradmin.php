<?php

class GalleryControllerAdmin extends ControllerAdmin {
	function delete($id = null){
		$html = new HTML;
		
		$html->sanitize($id);
		
		$this->set('page','gallery');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		
		//DELETE
		if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1'){
			$this->Gallery->id = $id;
			if ($this->Gallery->delete()){
					$this->set('msg', "Data successfully deleted");
				}else{
					$this->set('msg', "Data cannot deleted <br/ >". $this->Gallery->getError() );
			}	
		}else{
			
			$this->set('msg', "You have no right to delete this item!");
		}
		
		//Show Gallery
		$pageNumber = 1;
		$this->Gallery->id=null;
	  	$this->Gallery->setPage($pageNumber);
	  	$this->Gallery->setLimit(PAGINATE_LIMIT);
	  	$gallery = $this->Gallery->search();
	  	$NumOfGallery = $this->Gallery->NumOfRecord();
	  	$this->set('NumOfGallery',$NumOfGallery);
	  	$totalPages = $this->Gallery->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('gallery',$gallery);
	  	$this->set('currentPageNumber',$pageNumber);

		//Comments
		$dispatch = $this->__construct_no_view("V_Comments_Admin");
		$this->V_Comments_Admin->id = null;
		$this->V_Comments_Admin->where("type",'gallery');
		$this->V_Comments_Admin->where("ids",$id);
		$this->set("GalleryComments",$this->V_Comments_Admin->search());
		$this->set("NumC",$this->V_Comments_Admin->NumOfRecord());
	}
	
	function edit($id = null,$param1 = null,$param2 = null,$param3 = null) {
		$html = new HTML;
		
		$this->set('page','gallery');
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
					//$this->Gallery->custom("update comments set `status`='0' where `id`='".$param3."'");
					$this->set('msg_comment', "Comment successfully hide");
				}elseif ($param2 == "show"){
					$this->Comments->id = $param3;
					$this->Comments->status = 1;
					$this->Comments->save(array("id","status"));
					//$this->Gallery->custom("update comments set `status`='1' where `id`='".$param3."'");
					$this->set('msg_comment', "Comment successfully show");
							 
				}elseif ($param2 == "delete"){
					//$this->Gallery->custom("delete from comments where `id`='".$param3."'");
					$this->Comments->id = $param3;
					$this->Comments->delete();
					$this->set('msg_comment', "Comment successfully delete");
				}
			}
			
			
			//Edit
			if (isset($_POST['act_new_id'])){
				
				$pic=$_FILES['image']['name'];
				$uploaddir = ROOT . '/public/uploads/image/';
				$uploadfile = $uploaddir . $_FILES['image']['name'];
				$type = $_FILES['image']['type'];

				$noimg = (int)isset($_POST['no_img']);
				
				if ($pic != "" &&  $noimg == 0){
					if(!$html->cekFileType($type)){
						$this->set('msg', "File Type ".$type . " not allowed!");
					}else{
						if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
							chmod($uploadfile,0755);
							
							require_once (ROOT.'/public/modules/createThumb.php');
							$image = $uploaddir.$pic; // File image location
							$newfilename = "$uploaddir/thumbs/$pic"; // New file name for thumb
					 		$thumbnail = resize($image,200, 200, $newfilename);
							if (!$thumbnail ){
								$this->set('msg', "Created thumbnail failed!");
							}else{
								$this->Gallery->id = $html->sanitize($_POST["act_new_id"]);
								$this->Gallery->name = $html->sanitize($_POST["name"]);
								$this->Gallery->image = $html->sanitize($_FILES['image']['name']);
								$this->Gallery->content = $html->sanitize($_POST["content"]);
								$this->Gallery->user_created = $html->sanitize($_POST["user_created"]);
								$this->Gallery->date_created = date("Y-m-d H:i:s", strtotime($_POST["date_created"]));
								$this->Gallery->user_modified = $_SESSION['ADMIN_UID'];
								$this->Gallery->date_modified = date("Y-m-d H:i:s", strtotime('now'));
								
								if ($this->Gallery->save()){
									$this->set('msg', "Data successfully edited");
								}else{
									$this->set('msg', "Data cannot edited <br/ >". $this->Gallery->getError() );
								}
							}
							
						}
					}
				}else{
					$this->Gallery->id = $html->sanitize($_POST["act_new_id"]);
					$this->Gallery->name = $html->sanitize($_POST["name"]);
					if ($noimg == 0)
						$this->Gallery->image = "";
					else
						$this->Gallery->image = "no_img.gif";
					
					$this->Gallery->content = $html->sanitize($_POST["content"]);
					$this->Gallery->user_created = $html->sanitize($_POST["user_created"]);
					$this->Gallery->date_created = date("Y-m-d H:i:s", strtotime($_POST["date_created"]));
					$this->Gallery->user_modified = $_SESSION['ADMIN_UID'];
					$this->Gallery->date_modified = date("Y-m-d H:i:s", strtotime('now'));
					
					if ($this->Gallery->save()){
						$this->set('msg', "Data successfully edited");
					}else{
						$this->set('msg', "Data cannot edited <br/ >". $this->Gallery->getError() );
					}
				}
			}
			//Show gallery
			$this->Gallery->id=$id;
			$gallery = $this->Gallery->search();
			$this->set('gallery',$gallery);
			
			//Comments
			$dispatch = $this->__construct_no_view("V_Comments_Admin");
			$this->V_Comments_Admin->id = null;
			$this->V_Comments_Admin->where("type",'gallery');
			$this->V_Comments_Admin->where("ids",$id);
			$this->set("GalleryComments",$this->V_Comments_Admin->search());
			$this->set("NumC",$this->V_Comments_Admin->NumOfRecord());
			
		}

	}
	function add() {
		$html = new HTML;
		$this->set('page','gallery');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		
		//Cek permission
		if (!isset($_SESSION['IS_ADMIN']) || $_SESSION['IS_ADMIN']!='1'){
			$this->set('msg', "You have no right to perform this action!");
			
		}else{
			//Show gallery
			if (isset($_POST['act_new_id'])){
				$pic=$_FILES['image']['name'];
				$uploaddir = ROOT . '/public/uploads/image/';
				$uploadfile = $uploaddir . $_FILES['image']['name'];
				$type = $_FILES['image']['type'];
				
				if ($pic != ""){
					if(!$html->cekFileType($type)){
						$this->set('msg', "File Type ".$type . " not allowed!");
					}else{
						if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
							chmod($uploadfile,0755);
							
							require_once (ROOT.'/public/modules/createThumb.php');
							$image = $uploaddir.$pic; // File image location
							$newfilename = "$uploaddir/thumbs/$pic"; // New file name for thumb
					 		$thumbnail = resize($image,200, 200, $newfilename);
							
					 		if (!$thumbnail ){
								$this->set('msg', "Created thumbnail failed!");
							}else{
								$this->Gallery->id = null;
								$this->Gallery->name = $html->sanitize($_POST["name"]);
								$this->Gallery->image = $html->sanitize($pic);
								$this->Gallery->content = $html->sanitize($_POST["content"]);
								$this->Gallery->user_created = $html->sanitize($_POST["user_created"]);
								$this->Gallery->date_created = date("Y-m-d H:i:s", strtotime($_POST["date_created"]));
								$this->Gallery->user_modified = $_SESSION['ADMIN_UID'];
								$this->Gallery->date_modified = date("Y-m-d H:i:s", strtotime('now'));
								
								if ($this->Gallery->save()){
									$this->set('msg', "Data successfully added");
								}else{
									$this->set('msg', "Data cannot added <br/ >". $this->Gallery->getError() );
								}
							}
						}
					}
				}else{
					$this->Gallery->id = null;
					$this->Gallery->name = $html->sanitize($_POST["name"]);
					$this->Gallery->image = "no_img.gif";
					$this->Gallery->content = $html->sanitize($_POST["content"]);
					$this->Gallery->user_created = $html->sanitize($_POST["user_created"]);
					$this->Gallery->date_created = date("Y-m-d H:i:s", strtotime($_POST["date_created"]));
					$this->Gallery->user_modified = $_SESSION['ADMIN_UID'];
					$this->Gallery->date_modified = date("Y-m-d H:i:s", strtotime('now'));
					
					if ($this->Gallery->save()){
						$this->set('msg', "Data successfully added");
					}else{
						$this->set('msg', "Data cannot added <br/ >". $this->Gallery->getError() );
					}
				}
			} 
		}
		
	}
	function index() {
		//Show gallery
		$this->set('page','gallery');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		$pageNumber = 1;
		$this->Gallery->id=null;
		$this->Gallery->orderBy("id","desc");
	  	$this->Gallery->setPage($pageNumber);
	  	$this->Gallery->setLimit(PAGINATE_LIMIT);
	  	$gallery = $this->Gallery->search();
	  	$NumOfGallery = $this->Gallery->NumOfRecord();
	  	$this->set('NumOfGallery',$NumOfGallery);
	  	$totalPages = $this->Gallery->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('gallery',$gallery);
	  	$this->set('currentPageNumber',$pageNumber);
	  		  
	}

	function page ($pageNumber = 1) {
	  	//Show gallery
	  	$html = new HTML;
	  	$html->sanitize($pageNumber);
	  	$this->set('page','gallery');
	  	$this->set('msg', "");
		$this->set('msg_comment', "");
		$this->Gallery->id=null;
		$this->Gallery->orderBy("id","desc");
	  	$this->Gallery->setPage($pageNumber);
	  	$this->Gallery->setLimit(PAGINATE_LIMIT);
	  	$gallery = $this->Gallery->search();
	  	$NumOfGallery = $this->Gallery->NumOfRecord();
	  	$this->set('NumOfGallery',$NumOfGallery);
	  	$totalPages = $this->Gallery->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('gallery',$gallery);
	  	$this->set('currentPageNumber',$pageNumber);
	  	
	}
	
}
