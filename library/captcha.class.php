<?php
/**
 * @author Hendry Apr 6, 2010
 *
 */
class Captcha {
	function LoadCaptcha(){
		return "Write the following word <br/>
			<img src=\"".BASE_PATH."/public/modules/captcha/captcha.php\" id=\"captcha\" /><br/>
			<a href=\"#\" onclick=\"
			    document.getElementById('captcha').src='".BASE_PATH."/public/modules/captcha/captcha.php?'+Math.random();
			    document.getElementById('captcha-form').focus();\"
			    id=\"change-image\">Not readable, change text</a><br/><br/>
			<input type=\"text\" name=\"captcha\" id=\"captcha-form\"/><br/><br/>";
	}
	function IsVerOK(){
		//session_start();
		/** Validate captcha */
		if (!empty($_REQUEST['captcha'])) {
		    if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) {
		        return false;
		    } else {
		    	return true;
		    }
		}
	}
}