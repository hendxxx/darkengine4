<?php

class PagesController extends Controller {

	function index() {
		$this->set('page','page');
		$this->set('title','Custom Page - Darkengine v4');
	}
	
	
	function view($title,$sub="",$action="") {
		$html = new HTML;
		$title = $html->sanitize($title);
		$this->set('page',str_replace(" ","",$title));
		$this->set('title',$title.' - Darkengine v4');
		
	
		$dispatch = $this->__construct_no_view("Pages");
		$this->Pages->id=null;
		if ($sub==""){
			$this->Pages->where("name",$title);
		}else{
			$this->Pages->where("name",$sub);
			$this->Pages->where("parent",$title);
		}
		$page = $this->Pages->search();
		$found = $this->Pages->NumOfRecord();
		if ($found > 0){
			$this->set('Page',$page[0]);
			
			$dispatch = $this->__construct_no_view("Pages");
			$this->Pages->id=null;
			$this->Pages->where("name",$title);
			$parentpage = $this->Pages->search();
			$this->set('Parent',$parentpage[0]['Pages']['title']);
		}else{
			$att["id"] = "0";
			$att["name"] = "Error 404";
			$att["content"] = "<p>Page not Found</p>";
			$att["user_created"] = "System";
			$att["date_created"] = date("M d Y",strtotime('now'));
			
			$page["Pages"] = $att;
			$pageError = array($page);
			
			$this->set('Page',$pageError[0]);	
		}
		 
	}

}
