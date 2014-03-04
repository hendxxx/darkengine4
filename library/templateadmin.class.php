<?php
class TemplateAdmin {

	protected $variables = array();
	protected $_controller;
	protected $_action;

	function __construct($controller,$action) {
		$this->_controller = $controller;
		$this->_action = $action;
	}

	/** Set Variables **/

	function set($name,$value) {
		$this->variables[$name] = $value;
	}

	/** Display Template **/

    function render($_page = null) {
		$html = new HTML;
    	extract($this->variables);
			
		include (ROOT . DS .'admin'. DS . 'themes' . DS . THEMES. DS .'views'. DS. 'header.php');
		
        if ($_page == null)
        	include (ROOT . DS . 'admin' . DS . 'themes' . DS . THEMES . DS .'views'. DS. $this->_controller . DS . $this->_action . '.php');		 
		else
			include (ROOT . DS . 'admin' . DS . 'themes' . DS . THEMES . DS .'views'. DS. $_page);

		include (ROOT . DS .'admin'. DS . 'themes' . DS . THEMES . DS . 'views'. DS .'footer.php');
		
    }
	
}
