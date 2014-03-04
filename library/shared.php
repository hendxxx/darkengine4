	<?php

/** Check if environment is development and display errors **/

function setReporting() {
if (DEVELOPMENT_ENVIRONMENT == true) {
	error_reporting(E_ALL);
	ini_set('display_errors','On');
} else {
	error_reporting(E_ALL);
	ini_set('display_errors','Off');
	ini_set('log_errors', 'On');
	ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
}
}

/** Check for Magic Quotes and remove them **/

function stripSlashesDeep($value) {
	$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
	return $value;
}

function removeMagicQuotes() {
if ( get_magic_quotes_gpc() ) {
	$_GET    = stripSlashesDeep($_GET   );
	$_POST   = stripSlashesDeep($_POST  );
	$_COOKIE = stripSlashesDeep($_COOKIE);
}
}

/** Check register globals and remove them **/

function unregisterGlobals() {
    if (ini_get('register_globals')) {
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
        foreach ($array as $value) {
            foreach ($GLOBALS[$value] as $key => $var) {
                if ($var === $GLOBALS[$key]) {
                    unset($GLOBALS[$key]);
                }
            }
        }
    }
}

/** Main Call Function **/

function callHook() {
	global $url;

	$urlArray = array();

	$urlArray = explode("/",$url);

	//cek for home page, no controller, no action
	if (!isset($url)){
		$controller = "home";
		$action = 'index';
	}else{
		$controller = $urlArray[0];
		array_shift($urlArray);
		
		if (!isset($urlArray[0])){ 
			$action = 'index';
		}else {
			$action = $urlArray[0];
			if ($action == "") $action = "index";
		}
		array_shift($urlArray);
		
	}
	
	$queryString = $urlArray;

	$controllerName = $controller;
	$controller = ucwords($controller);
	$model = trim($controller);
	$controller .= 'Controller';
	
	$html = new HTML;

	//Check Controller exist
	if ((int)method_exists($controller, $action)) {
		$dispatch = new $controller($model,$controllerName,$action);
		call_user_func_array(array($dispatch,$action),$queryString);
	} else {
		$urlArray = explode("/",$url);
		
		$IsPageExistInDatabase = true;
		 
		if ($IsPageExistInDatabase){
			
			//for Pages
			$controller = "pagesController";
			$model = "Pages";
			$controllerName = "pages";
			$action = "view";
					
			$urlArray = explode("/",$url);
			
			//for pages
			if (!isset($urlArray[0])){ 
				$queryString = "";
			}else{
				$queryString = $urlArray;
				array_shift($urlArray);
			}
			
			//for sub pages
			if (isset($urlArray[1])){ 
				array_shift($urlArray);
				$queryString = $urlArray;
			}
			
			
			$dispatch = new $controller($model,$controllerName,$action);
			call_user_func_array(array($dispatch,$action),$queryString);
		
		}else{
		  	/* Error Generation Code Here */
			if (file_exists(ROOT . DS .'application'. DS . 'themes' . DS . THEMES  . DS . 'views' . DS . 'header.php')) {
				include (ROOT . DS .'application'. DS . 'themes' . DS . THEMES . DS . 'views' . DS . 'header.php');
			} else {
				include (ROOT . DS .'application'. DS . 'themes' . DS .'default'. DS . 'views' . DS. 'header.php');
			}

			require_once(ROOT . DS .'application'. DS . 'themes' . DS .THEMES . DS . 'views' . DS . '404.php');
			
			if (file_exists(ROOT . DS .'application'. DS . 'themes' . DS . THEMES . DS . 'views' . DS . 'footer.php')) {
				include (ROOT . DS .'application'. DS . 'themes' . DS . THEMES . DS . 'views' . DS . 'footer.php');
			} else {
				include (ROOT . DS .'application'. DS . 'themes'. DS . 'default'. DS . 'views' . DS .'footer.php');
			}
		}	
	}
}

/** Autoload any classes that are required **/

function __autoload($className) {
	if (file_exists(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php')) {
		require_once(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php');
	} else if (file_exists(ROOT . DS .'application'. DS . 'themes' . DS . THEMES . DS . 'controllers' . DS . strtolower($className) . '.php')) {
		require_once(ROOT . DS .'application'. DS . 'themes' . DS . THEMES . DS . 'controllers' . DS . strtolower($className) . '.php');
	} else if (file_exists(ROOT . DS .'application'. DS . 'themes' . DS . THEMES . DS . 'models' . DS . strtolower($className) . '.php')) {
		require_once(ROOT . DS .'application'. DS . 'themes' . DS . THEMES . DS . 'models' . DS . strtolower($className) . '.php');
	} else {
		/* Error Generation Code Here */
	}
}
$inflect =& new Inflection();

setReporting();
removeMagicQuotes();
unregisterGlobals();
callHook();
