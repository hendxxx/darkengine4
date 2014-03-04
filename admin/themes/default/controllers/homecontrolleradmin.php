<?php

class HomeControllerAdmin extends ControllerAdmin {
	function Redirect_To($to,$time=0){
		echo "<meta http-equiv='refresh' content='$time;URL=$to'>";
	}
	function index() {
		$this->set('page','home');
		$this->set('msg',"");
	}
	function login() {
		$html = new HTML;
		$this->set('page','home');
		$this->set('msg',"");
		if (isset($_POST['dologin'])){
			if ($_POST['dologin']=='true'){
				if($html->sanitize($_POST['username'])=="" || ($html->sanitize($_POST['password']))==""){
					$this->set('msg',"Username or password cannot be empty");
				}else{
					$dispatch = $this->__construct_no_view("V_user_detail");
					$this->V_user_detail->id = ""; 
					$this->V_user_detail->where("uid",$html->sanitize($_POST['username']));
					$user = $this->V_user_detail->search();
					$jum = $this->V_user_detail->NumOfRecordAfterFilter();
					 
					if ($jum == 1){
						$login=$user[0];
						$this->set('msg',"Verifying  ...");
						
						if ($login['V_user_detail']['PWD'] == hash("sha256",$_POST['password'])){
							$this->set('msg',"Authentication OK... directing to your request page");
							$_SESSION['ADMIN_LOGED']='true';
							$_SESSION['ADMIN_UID']= $html->sanitize($login['V_user_detail']['UID']);
							$_SESSION['IS_ADMIN']= $html->sanitize($login['V_user_detail']['IsAdmin']);
							$_SESSION['ADMIN_LAST_LOGIN']= $html->sanitize($login['V_user_detail']['last_login']);
							$_SESSION['ADMIN_UID_ID']= $html->sanitize($login['V_user_detail']['id']);
							if ($_SERVER['HTTP_REFERER']==BASE_PATH.'/admin/home/logout' || $_SERVER['HTTP_REFERER']==BASE_PATH.'/admin/home/login'){
								$this->Redirect_To(BASE_PATH.DS.'admin/home',1);
							}else{
								$this->Redirect_To($_SERVER['HTTP_REFERER'],1);	
							}
							
							$this->set('status',"ok");
						}else{
							$this->set('status',"failed");
							$this->set('msg',"Authentication Failed!");
						}
					}else{
						$this->set('status',"failed");
							$this->set('msg',"Authentication Failed!");
					}
					
						
				}
				
			}
		}
		
		
	}
	function logout(){
		$html = new HTML;
		$dispatch = $this->__construct_no_view("Users");
		$this->Users->id = $html->sanitize($_SESSION['ADMIN_UID_ID']);
		$this->Users->uid = $html->sanitize($_SESSION['ADMIN_UID']); 
		$this->Users->last_login  = date("d M Y",strtotime('now'));
		$this->Users->save(array("last_login"));
		unset($_SESSION['IS_ADMIN']);
		unset($_SESSION['ADMIN_UID_ID']);
		unset($_SESSION['ADMIN_LAST_LOGIN']);
		unset($_SESSION['ADMIN_LOGED']);
		unset($_SESSION['ADMIN_UID']);

	}
 	 
}
