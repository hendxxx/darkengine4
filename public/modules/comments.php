<?php include('../public/jscripts/js_init.php'); 

if (USE_COMMENT){
?>
<script language="javascript">
		 
		function validate_form(thisform){
			with (thisform){
				if (validate_required(name,"Your name must be filled out!")==false){name.focus();return false;}
				if (validate_required(comment,"Your comment must be filled out!")==false){comment.focus();return false;}
				if (validate_required(subject,"Your subject must be filled out!")==false){subject.focus();return false;}
			}
		}
		 
</script>
<div style='font-weight: bold;color:red;'><?php echo $msg?></div>
<br />
<form name='commentform' method="POST" action='<?php echo BASE_PATH."/".$type."/view/".$id."/". $title . URL_SUFFIX ?>' onsubmit='return validate_form(this);'>
	<h1>Comment Form</h1>
	<table border="0">
	<tbody>
		<tr>
			<td> <label for="name">Your name</label></td>
			<td>: <input type="text" maxlength="60" class="input1" name="name" id="name" size="30" value="<?php echo $name?>"  /></td>
		</tr>
		<tr>
			<td> <label for="subject">Subject</label></td>
			<td>: <input type="text" maxlength="60" class="input1" name="subject" id="subject" size="30" value="<?php echo $subject?>"  /></td>
		</tr>
		<tr>
			<td colspan="2">
			<textarea cols="60" rows="15" name="comment" id="comment" style="width:500px;height:150px;"><?php echo $comment?></textarea>
			</td>
		</tr>
		<tr>
			<td valign="top"> <label for="subject">Verification</label></td>
			<td>: 
			<?php 
				$captcha = new Captcha();
				echo $captcha->LoadCaptcha();
			?></td>
		</tr>
		<tr>
			<td colspan="2">
			<input type='hidden' name="do" value='_save_comment' />
			<input type='submit' value='Submit' />
			</td>
		</tr>
		
		</tbody>
	</table>
</form>
<br />
<hr />

<?php if ($NumC > 0) {?>
	<h3>Comments</h3>
	<div id='comments'>
	<?php

		$i=1;
		echo "<ul>";
		
		foreach ($ItemComments as $Comments){ 
			echo "<li>";
			echo $i .'. '. $html->sanitize($Comments['V_Comments']['subject']);
			echo "<span>by ". $html->sanitize($Comments['V_Comments']['name']) ." on ". date("d M Y H:i:s",strtotime($Comments['V_Comments']['date_created']))."</span>";
			echo "<p>". $html->sanitize($Comments['V_Comments']['comment']) ."</p>";
			echo "</li>";
			$i++;
		}
		echo "</ul>";
	?>
	</div>
<?php }else{ ?>
	<h3>Comments</h3>
	<div id='comments'>
	<ul>
		<li>No Comments yet...</li>
	</ul>
	</div>
<?php } 

}