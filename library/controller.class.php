<?php
class Controller {

	protected $_model;
	protected $_controller;
	protected $_action;
	protected $_template;
	protected $_IsError;
	
	function __construct($model, $controller, $action) {
		$this->_IsError = "false";
		$this->_controller = $controller;
		$this->_action = $action;
		$this->_model = $model;

		$this->$model = new $model;
		$this->_template = new Template($controller,$action);

	}
	function __construct_no_view($model) {
		 
		$this->_model = $model;

		$this->$model = new $model;

	}
	function set($name,$value) {
		$this->_template->set($name,$value);
	}
	
	function _IsError($iserror = "false"){
		$this->_IsError = $iserror;
	}
	
	function render($_page = null) {
		if ($_page == null){
			$this->_template->render();
		}else{
			$this->_IsError = "true";
			$this->_template->render($_page);
		}
	}
	
	function __destruct(){
		if ($this->_IsError == "false")
			$this->render();
	}

}
