<?php

class SearchController extends Controller {

	function index() {
		$this->set('page','search');
		$this->set('title','Search - Darkengine v4');
		$html = new HTML;
		if (isset($_POST['s_value'])){
			$_SESSION['S_VALUE'] = $_POST['s_value'];
			$value = $html->sanitize($_SESSION['S_VALUE']) ;
			$this->set('search_value',$value);
			
			
			//search all content
		  	$dispatch = $this->__construct_no_view("V_Search");
			$this->V_Search->setPage(1);
			$this->V_Search->setLimit(PAGINATE_LIMIT);
		  	$this->V_Search->id = null;
			$this->V_Search->like("subject",$value,false);
			$this->V_Search->like("front",$value,false);
			$this->V_Search->like("content",$value,false);
			$this->V_Search->OrderBy("date_created","Desc");
			$this->set("AllSearch",$this->V_Search->search());
			$this->set("NumSearch",$this->V_Search->NumOfRecord());
			
			$totalPages = $this->V_Search->totalPages();
			
			$this->set('totalPages',$totalPages);
		  	$pageNumber = 1;
		  	
		  	$this->set('currentPageNumber',$pageNumber);
		}
		
	}
	
	function page($pageNumber = 1) {
		$this->set('page','search');
		$this->set('title','Search - Darkengine v4');
		$html = new HTML;
		
		if ( isset($_SESSION['S_VALUE']) ){
			$value = $html->sanitize($_SESSION['S_VALUE']) ;
			$this->set('search_value',$value);
			
			//search all content
		  	$dispatch = $this->__construct_no_view("V_Search");
			$this->V_Search->setPage($pageNumber);
			$this->V_Search->setLimit(PAGINATE_LIMIT);
		  	$this->V_Search->id = null;
			$this->V_Search->like("subject",$value,false);
			$this->V_Search->like("front",$value,false);
			$this->V_Search->like("content",$value,false);
			$this->V_Search->OrderBy("date_created","Desc");
			$this->set("AllSearch",$this->V_Search->search());
			$this->set("NumSearch",$this->V_Search->NumOfRecord());
			 
			
			$totalPages = $this->V_Search->totalPages();
			$this->set('totalPages',$totalPages);
		  	$this->set('currentPageNumber',$pageNumber);
		}
		
	}

}
