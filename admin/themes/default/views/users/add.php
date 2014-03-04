<?php
include('../public/jscripts/js_init.php');
if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1'){
	if (!isset($_POST['act_new_id'])){
		$id = "";
		
		$uid = "";
		$pwd = "";
		$level = "";
		
		?>
		
		<script language="javascript">
			 
			function validate_form(thisform){
				with (thisform){
					if (validate_required(uid,"User ID must be filled out!")==false){uid.focus();return false;}
					if (validate_required(level,"Level must be filled out!")==false){level.focus();return false;}
					if (validate_required(pwd,"Password must be filled out!")==false){pwd.focus();return false;}
					if (pwd.value.length <= 4) {alert('Password must over 4 letter!');pwd.focus();return false;}
					if (pwd.value != cpwd.value) {alert('Password didnt macth!');cpwd.focus();return false;}
				}
			}
			 
		</script>
		<div id='errormsg'><?php echo $msg?></div>
		<form name='adminform' method="POST" action='<?php echo BASE_PATH."/admin/users/add"?>' onsubmit='return validate_form(this);'>
		<input type=hidden size=133 name=act_new_id value='<?php echo $id?>'>
		<input type=hidden size=133 name=user_created value='<?php echo $user_created ?>'>
		
			<table  border=0 cellpadding=5 cellspacing=5 width='100'% class='admin_form'>
				<tr>
				<td width=10%>ID</td>
				<td width=1>:</td>
				<td width=90%><input type=text size=10 name='id' value="<?php echo $id?>" readonly></td>
				</tr>
	
				<tr>
				<td >User ID</td>
				<td width=1>:</td>
				<td ><input type=text size=50 name='uid' value="<?php echo $uid?>" maxlength="100" ></td>
				</tr>
				
				<tr>
				<td >Level</td>
				<td width=1>:</td>
				<td >
					<select name='level'>
						<?php foreach ($levels as $levelsitem){
							echo "<option value='".$levelsitem['Level']['LevelName']."'>".$levelsitem['Level']['LevelName']."</option>";
						}?>
						
					</select>
				</td>
				</tr>
				
				<tr>
				<td >Password</td>
				<td width=1>:</td>
				<td ><input type=password size=50 name='pwd' value="<?php echo $pwd?>" maxlength="300" ></td>
				</tr>
			 	
			 	<tr>
				<td >Confirm Password</td>
				<td width=1>:</td>
				<td ><input type=password size=50 name='cpwd' value="" maxlength="300" ></td>
				</tr>
				
			</table>
			<p>
				<input type=submit value=Save class=button1>&nbsp;
				<input type=reset value=Reset class=button1>&nbsp;
				<input type=button value=Back class=button1 onclick="GoToURL('<?php echo BASE_PATH?>/admin/users')">
			</p>
		</form>
	<?php 
	}else{
		?>
		<div id='errormsg'><?php echo $msg?></div>
		<form name='adminform' method="POST" action='<?php echo BASE_PATH."/admin/users/add"?>' onsubmit='return validate_form(this);'>
		<input type=button value=Back class=button1 onclick="GoToURL('<?php echo BASE_PATH ?>/admin/users')" ></input>
		</form>
		<?php 
	}
}else{
	?>
		<div id='errormsg'><?php echo $msg?></div>
		<form name='adminform' method="POST" action='<?php echo BASE_PATH."/admin/users/add"?>' onsubmit='return validate_form(this);'>
		<input type=button value=Back class=button1 onclick="GoToURL('<?php echo BASE_PATH ?>/admin/users')" ></input>
		</form>
	<?php 	
}
	