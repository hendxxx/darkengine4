<?php

class ContactController extends Controller {

	function index() {
		$this->set('page','contact');
		$this->set('title','Contact - Darkengine v4');
		$this->set('msg','');
		$sendemailto = explode(";",SENDTO);
		$this->set('sendto', $sendemailto[0]);
		
		$dispatch = $this->__construct_no_view("Pages");
		$this->Pages->id=null;
		$this->Pages->where("name","Contact");
		$page = $this->Pages->search();
		$this->set('contact_detail', $page[0]['Pages']['content']);
	}
	
	function send(){
		$html = new HTML;
		$captcha = new Captcha;
		
		$this->set('page','contact');
		$this->set('title','Contact - Darkengine v4');
		$this->set('msg','');
		
		$dispatch = $this->__construct_no_view("Pages");
		$this->Pages->id=null;
		$this->Pages->where("name","Contact");
		$page = $this->Pages->search();
		$this->set('contact_detail', $page[0]['Pages']['content']);
		
		
		$sendemailto = explode(";",SENDTO);
		$this->set('sendto', $sendemailto[0]);
		
		
		if (isset($_POST['do']) && $_POST['do']=='_send_comment'){
			$name = $html->sanitize($_POST['name']);
			$subject = $html->sanitize($_POST['subject']);
			$email = $html->sanitize($_POST['email']);
			$msg = $html->sanitize($_POST['comment']);
			$this->set('name',$name);
			$this->set('subject',$subject);
			$this->set('email',$email);
			$this->set('comment',$msg);
			
			if ($captcha->IsVerOK()){
				$to=SENDTO;
				$server=SMTP_SERVER;
				
				ini_set('SMTP',$server);
				
				$this->set('msg','Sending...');
				if (mail($to,"E-mail From ".$name ."(". $email.") ". $subject," ". $msg,"From: ".$name)){
					$this->set('msg','sending email success');
			    }else{
			        $this->set('msg','sending email failed');
			    }	
			}else{
				$this->set('msg','verification failed');
			}
		}
	}

}
