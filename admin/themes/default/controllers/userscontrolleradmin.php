<?php

class UsersControllerAdmin extends ControllerAdmin {
	function delete($id = null){
		$html = new HTML;
		
		$html->sanitize($id);
		
		$this->set('page','users');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		
		//DELETE
		if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1'){
			$this->Users->id = $id;
			if ($this->Users->delete()){
					$this->set('msg', "Data successfully deleted");
				}else{
					$this->set('msg', "Data cannot deleted <br/ >". $this->Users->getError() );
			}	
		}else{
			
			$this->set('msg', "You have no right to delete this item!");
		}
		
		//Show Users
		$pageNumber = 1;
		$this->Users->id=null;
	  	$this->Users->setPage($pageNumber);
	  	$this->Users->setLimit(PAGINATE_LIMIT);
	  	$users = $this->Users->search();
	  	$NumOfUsers = $this->Users->NumOfRecord();
	  	$this->set('NumOfUsers',$NumOfUsers);		  	
	  	$totalPages = $this->Users->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('users',$users);
	  	$this->set('currentPageNumber',$pageNumber);
 
	}
	
	function edit($id = null ) {
		$html = new HTML;
		
		$this->set('page','users');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		$id = $html->sanitize($id);
		
		
		if ((isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1')){
			//List of levels
			$dispatch = $this->__construct_no_view("Level");
			$this->Level->id = null;
			if ((!isset($_SESSION['IS_ADMIN']) || $_SESSION['IS_ADMIN']!='1')){
				$this->Level->where('IS_ADMIN',0);	
			}
			$this->set("levels",$this->Level->search());
			$this->set("NumLevel",$this->Level->NumOfRecord());
		}
		
		//Cek permission
		if ((!isset($_SESSION['IS_ADMIN']) || $_SESSION['IS_ADMIN']!='1')){
			if ($_SESSION['ADMIN_UID_ID'] == $id){
				//Edit
				if (isset($_POST['act_new_id'])){
					$this->Users->id = $html->sanitize($_POST["act_new_id"]);
					$this->Users->UID = $html->sanitize($_POST["uid"]);
					
					if( (isset($_POST["pwd"]) && $_POST["pwd"] != "")){
						$this->Users->PWD = $html->sanitize(hash("sha256",$_POST["pwd"]));
					}else{
						$this->Users->PWD = $html->sanitize($_POST["cur_pwd"]);
					}
					
					$this->Users->LEVEL = "";
					$this->Users->last_login = $_SESSION['ADMIN_LAST_LOGIN'];
	
					if ($this->Users->save()){
						$this->set('msg', "Data successfully edited");
					}else{
						$this->set('msg', "Data cannot edited <br/ >". $this->Users->getError() );
					}
				}
				//Show users
				$this->Users->id=$id;
				$users = $this->Users->search();
				$this->set('id',$id);
				$this->set('users',$users);
			}else{
				$this->set('msg', "You have no right to perform this action!");	
			}
			
		}else{
			//Edit
			if (isset($_POST['act_new_id'])){
				$this->Users->id = $html->sanitize($_POST["act_new_id"]);
				$this->Users->UID = $html->sanitize($_POST["uid"]);
				
				if( (isset($_POST["pwd"]) && $_POST["pwd"] != "")){
					$this->Users->PWD = $html->sanitize(hash("sha256",$_POST["pwd"]));
				}else{
					$this->Users->PWD = $html->sanitize($_POST["cur_pwd"]);
				}
				
				$this->Users->LEVEL = $html->sanitize($_POST["level"]);
				$this->Users->last_login = $_SESSION['ADMIN_LAST_LOGIN'];

				if ($this->Users->save()){
					$this->set('msg', "Data successfully edited");
				}else{
					$this->set('msg', "Data cannot edited <br/ >". $this->Users->getError() );
				}
			}

			//Show users
			$this->Users->id=$id;
			$users = $this->Users->search();
			$this->set('users',$users);
			
		}
	 	 
	}
	function add() {
		$html = new HTML;
		$this->set('page','users');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		
		//List of levels
		$dispatch = $this->__construct_no_view("Level");
		$this->Level->id = null;
		$this->set("levels",$this->Level->search());
		$this->set("NumLevel",$this->Level->NumOfRecord());
		
		//Cek permission
		if (!isset($_SESSION['IS_ADMIN']) || $_SESSION['IS_ADMIN']!='1'){
			$this->set('msg', "You have no right to perform this action!");
		}else{
			//Show users
			if (isset($_POST['act_new_id'])){
				if ( ($_POST["cpwd"] != $_POST["pwd"]) ){
					$this->set('msg', "Password didn't match!");
				}else{
					$this->Users->id = null;
					$this->Users->UID = $html->sanitize($_POST["uid"]);
					$this->Users->PWD = $html->sanitize(hash("sha256",$_POST["pwd"]));
					$this->Users->LEVEL = $html->sanitize($_POST["level"]);
					$this->Users->last_login = "Never";
					
					if ($this->Users->save()){
						$this->set('msg', "Data successfully added");
					}else{
						$this->set('msg', "Data cannot added <br/ >". $this->Users->getError() );
					}
				}
			} 
		}
		
		
	}
	function index() {
		//Show users
		$this->set('page','users');
		$this->set('msg', "");
		$this->set('msg_comment', "");
		$pageNumber = 1;
		$this->Users->id=null;
		$this->Users->orderBy("id","desc");
	  	$this->Users->setPage($pageNumber);
	  	$this->Users->setLimit(PAGINATE_LIMIT);
	  	$users = $this->Users->search();
	  	$NumOfUsers = $this->Users->NumOfRecord();
	  	$this->set('NumOfUsers',$NumOfUsers);	
	  	$totalPages = $this->Users->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('users',$users);
	  	$this->set('currentPageNumber',$pageNumber); 
	}

	function page ($pageNumber = 1) {
	  	//Show users
	  	$html = new HTML;
	  	$html->sanitize($pageNumber);
	  	$this->set('page','users');
	  	$this->set('msg', "");
		$this->set('msg_comment', "");
		$this->Users->id=null;
		$this->Users->orderBy("id","desc");
	  	$this->Users->setPage($pageNumber);
	  	$this->Users->setLimit(PAGINATE_LIMIT);
	  	$users = $this->Users->search();
	  	$NumOfUsers = $this->Users->NumOfRecord();
	  	$this->set('NumOfUsers',$NumOfUsers);
	  	$totalPages = $this->Users->totalPages();
	  	$this->set('totalPages',$totalPages);
	  	$this->set('users',$users);
	  	$this->set('currentPageNumber',$pageNumber);
	  	
	}
	
}
