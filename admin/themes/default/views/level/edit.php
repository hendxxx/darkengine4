<?php
include('../public/jscripts/js_init.php');

	$id = $level['Level']['id'];
	$levelname = $level['Level']['LevelName'];
	$isadmin = $level['Level']['IsAdmin'];

if ((isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1') || (isset($level))){
	?>
	
	<script language="javascript">
		 
		function validate_form(thisform){
			with (thisform){
				if (validate_required(levelname,"Level Name must be filled out!")==false){levelname.focus();return false;}
			}
		}
		 
	</script>
	<div id='errormsg'><?php echo $msg?></div>
	<form name='adminform' method="POST" action='<?php echo BASE_PATH."/admin/level/edit/".$id ?>' onsubmit='return validate_form(this);'>
	<input type=hidden size=133 name=act_new_id value='<?php echo $id?>'>
	<input type=hidden size=133 name=user_created value='<?php echo $user_created ?>'>
	
		<table  border=0 cellpadding=5 cellspacing=5 width='100'% class='admin_form'>
			<tr>
			<td width=10%>id</td>
			<td width=1>:</td>
			<td width=90%><input type=text size=10 name='id' value="<?php echo $id?>" readonly></td>
			</tr>

			<tr>
			<td >Level Name</td>
			<td width=1>:</td>
			<td ><input type=text size=50 name='levelname' value="<?php echo $levelname?>" maxlength="100" ></td>
			</tr>
			
			<tr>
			<td >Is Admin</td>
			<td width=1>:</td>
			<td >
			<?php 
			if ($isadmin == 1){
				$yes_selected = "selected";
				$no_selected = "";
			}else{	
				$yes_selected = "";
				$no_selected = "selected";
			} 
			
			?>
			<select name="isadmin">
				<option value="1" <?php echo $yes_selected?>>Yes</option>
				<option value="0" <?php echo $no_selected?>>No</option>
			</select>
			</td>
			</tr>
			
		</table>
		<p>
			<input type=hidden size=50 name='cur_pwd' value="<?php echo $pwd?>" maxlength="300" >
			<input type=submit value=Save class=button1>&nbsp;
			<input type=reset value=Reset class=button1>&nbsp;
			<input type=button value=Back class=button1 onclick="GoToURL('<?php echo BASE_PATH?>/admin/level')">
		</p>
	</form>
<?php
}else{
	?>
		<div id='errormsg'><?php echo $msg?></div>
		<form name='adminform' method="POST" action='<?php echo BASE_PATH."/admin/level/add"?>' onsubmit='return validate_form(this);'>
		<input type=button value=Back class=button1 onclick="GoToURL('<?php echo BASE_PATH ?>/admin/level')" ></input>
		</form>
	<?php 
}