<?php

class TagsController extends Controller {

	function index() {
		$this->set('page','Tags');
		$this->set('title','Tags - Darkengine v4');
		$html = new HTML;
		
		//search all content
	  	$dispatch = $this->__construct_no_view("V_Tags");
		$this->V_Tags->setPage(1);
		$this->V_Tags->setLimit(PAGINATE_LIMIT);
	  	$this->V_Tags->id = null;
		$this->V_Tags->like("tags","test",false);
		$this->set("AllTags",$this->V_Tags->search());
		$this->set("NumTags",$this->V_Tags->NumOfRecord());
		
		$totalPages = $this->V_Tags->totalPages();
		
		$this->set('totalPages',$totalPages);
	  	$pageNumber = 1;
	  	
	  	$this->set('currentPageNumber',$pageNumber);
		 
		
	}
	
	function page($pageNumber = 1) {
		$this->set('page','Tags');
		$this->set('title','Tags - Darkengine v4');
		$html = new HTML;
		
		 
	}
	
	function search($tags=null) {
		$this->set('page','Tags');
		$this->set('title','Tags - Darkengine v4');
		$html = new HTML;
		
		$dispatch = $this->__construct_no_view("V_Tags");
	  	$this->V_Tags->SetPage(1);
	  	$this->V_Tags->id = null;
		$this->V_Tags->like("tags",$tags,false);
		$this->V_Tags->orderby("subject");
		$this->set("AllTags",$this->V_Tags->search());
		$this->set("NumTags",$this->V_Tags->NumOfRecord());
		$this->set('tags_value',$tags);
		
		 
	}

}
