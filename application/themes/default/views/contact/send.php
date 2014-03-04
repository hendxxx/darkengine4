<div id="content_full">
	<div class="post">
		<h1 class="title">Contact Us</h1>
		<div class="entry">
		<?php echo $contact_detail?> <br /> 
		Send email to this contact (following message will send to <strong><i><?php echo $sendto ?></i></strong>) :
		<?php include('../public/jscripts/js_init.php'); ?>
		<script language="javascript">
				function validate_form(thisform){
					with (thisform){
						if (validate_required(name,"Your name must be filled out!")==false){name.focus();return false;}
						if (validate_required_email(email,"Your email must be filled out!")==false){email.focus();return false;}
						if (validate_required(comment,"Your comment must be filled out!")==false){comment.focus();return false;}
						if (validate_required(subject,"Your subject must be filled out!")==false){subject.focus();return false;}
					}
				}
				 
		</script>
		<div style='font-weight: bold;color:red;'><?php echo $msg?></div>
		<br />
		<form name='commentform' method="POST" action='<?php echo BASE_PATH."/contact/send/"?>' onsubmit='return validate_form(this);'>
			<table border="0">
			<tbody>
				<tr>
					<td> <label for="name">Your name</label></td>
					<td>: <input type="text" maxlength="60" name="name" id="name" size="30" value="<?php echo $name?>"  /></td>
				</tr>
				<tr>
					<td> <label for="subject">Email</label></td>
					<td>: <input type="text" maxlength="60" name="email" id="email" size="30" value="<?php echo $email?>"  /></td>
				</tr>
				<tr>
					<td> <label for="subject">Subject</label></td>
					<td>: <input type="text" maxlength="60" name="subject" id="subject" size="30" value="<?php echo $subject?>"  /></td>
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
					<input type='hidden' name="do" value='_send_comment' />
					<input type='submit' value='Submit' />
					</td>
				</tr>
				
				</tbody>
			</table>
		</form>
</div>
		
	</div>
</div>