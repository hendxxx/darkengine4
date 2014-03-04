<?php
include('../public/jscripts/js_init.php');
if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1'){	
	if (!isset($_POST['act_new_id'])){
		$id = "";
		
		$subject = "";
		$tags= ""; 
		$front = "";
		$main_msg= "-";
		
		$user_created = $_SESSION['ADMIN_UID'];
		$date_created = date("M d Y",strtotime('now'));
	 
		echo $html->includeJs('modules/jquery/jquery-1.3.1.min');
		echo $html->includeJs('modules/jquery/jquery-ui-1.7.1.custom.min');
		echo $html->includeJs('modules/jquery/datepicker.jQuery');
		echo $html->includeCss('modules/filament_datepicker/css/ui.daterangepicker');
		echo $html->includeCss('modules/filament_datepicker/css/redmond/jquery-ui-1.7.1.custom');
		?>
		
		<script type="text/javascript">	
				$(function(){
					if($(window.parent.document).find('iframe').size()){
						var inframe = true;
					}
					 $('#daterange').daterangepicker({
						arrows: true, 
					 	dateFormat: 'M d yy',
					 	datepickerOptions: {
					 		changeMonth: true,
					 		changeYear: true
					 	},
					 	onOpen:function(){ $('.ui-daterangepicker-specificDate').trigger('click'); if(inframe){ $(window.parent.document).find('iframe:eq(1)').width(700).height('35em');} }, 
					  	onClose: function(){ if(inframe){ $(window.parent.document).find('iframe:eq(1)').width('100%').height('5em');} }
					 }); 
				 });
		</script>
		<script language="javascript">
			 
			function validate_form(thisform){
				with (thisform){
					if (validate_required(subject,"Subject must be filled out!")==false){subject.focus();return false;}
					if (validate_required(content,"Message must be filled out!")==false){content.focus();return false;}
				}
			}
			 
		</script>
		<div id='errormsg'><?php echo $msg?></div>
		<form name='adminform' method="POST" action='<?php echo BASE_PATH."/admin/articles/add"?>' onsubmit='return validate_form(this);'>
		<input type=hidden size=133 name=act_new_id value='<?php echo $id?>'>
		<input type=hidden size=133 name=user_created value='<?php echo $user_created ?>'>
		
			<table  border=0 cellpadding=5 cellspacing=5 width='100'% class='admin_form'>
				<tr>
				<td width=10%>ID</td>
				<td width=1>:</td>
				<td width=90%><input type=text size=100 name='id' value="<?php echo $id?>" readonly></td>
				</tr>
	
				<tr>
				<td >Date</td>
				<td width=1>:</td>
				<td >
				<input type="text" id="daterange" class="css1"  value="<?php echo $date_created?>" size=19 name='date_created'>
				</td>
				</tr>
				
				<tr>
				<td >Subject</td>
				<td width=1>:</td>
				<td ><input type=text size=100 name='subject' value="<?php echo $subject?>" maxlength="100" ></td>
				</tr>
			
				<tr>
				<td >Tags</td>
				<td width=1>:</td>
				<td ><input type=text size=100 name='tags' value="<?php echo $tags?>" maxlength="200" ></td>
				</tr>
				
				<tr>
				<td >Front</td>
				<td width=1>:</td>
				<td ><input type=text size=100 name='front' value="<?php echo $front?>"  maxlength="300" ></td>
				</tr>
				
				<tr>
				<td valign=top>Content</td>
				<td width=1 valign=top>:</td>
				<td ><textarea rows=20 cols=130 name='content' ><?php echo $main_msg?></textarea></td>
				</tr>
			</table>
			<p>
				<input type=submit value=Save class=button1>&nbsp;
				<input type=reset value=Reset class=button1>&nbsp;
				<input type=button value=Back class=button1 onclick="GoToURL('<?php echo BASE_PATH?>/admin/articles')">
			</p>
		</form>
	<?php 
	}else{
		?>
		<div id='errormsg'><?php echo $msg?></div>
		<form name='adminform' method="POST" action='<?php echo BASE_PATH."/admin/articles/add"?>' onsubmit='return validate_form(this);'>
		<input type=button value=Back class=button1 onclick="GoToURL('<?php echo BASE_PATH ?>/admin/articles')" ></input>
		</form>
		<?php 
	}
	
	if (!isset($_POST['act_new_id'])){
		echo $html->includeJs('modules/fckeditor/fckeditor');
		?>
		<script type="text/javascript">
		<!--
		// Automatically calculates the editor base path based on the _samples directory.
		// This is usefull only for these samples. A real application should use something like this:
		// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
		var sBasePath = '<?php echo BASE_PATH?>/public/modules/fckeditor/' ;
		
		var oFCKeditor = new FCKeditor( 'content' ) ;
		oFCKeditor.BasePath	= sBasePath ;
		oFCKeditor.Height	= 300 ;
		oFCKeditor.ReplaceTextarea() ;
		//-->
		</script>	
	<?php }
}else{
	?>
		<div id='errormsg'><?php echo $msg?></div>
		<form name='adminform' method="POST" action='<?php echo BASE_PATH."/admin/articles/add"?>' onsubmit='return validate_form(this);'>
		<input type=button value=Back class=button1 onclick="GoToURL('<?php echo BASE_PATH ?>/admin/articles')" ></input>
		</form>
	<?php 
}	