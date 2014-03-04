<?php
/*
 * Created on 29 Mar 10
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<div id=login>
	<h1>Login</h1>
		<form  method='POST' action='<?php echo BASE_PATH;?>/admin/home/login' >
			<fieldset>
				<label for='username'>Admin ID:</label>
					<input id='username' type='text' name='username' size=30 value='' /><br/><br/>
				<label for='password'>Password:</label>
					<input id='password' type='password' name='password' size=30 value='' /><br/><br/>
					
					<input class='button1' type='submit' name='button1' value='Sign In' />
					<input type='hidden' name='dologin' value='true'>
			</fieldset>
		</form>		
</div>