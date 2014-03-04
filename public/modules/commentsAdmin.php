<br />
<hr />
<div style='font-weight: bold;color:red;'><?php echo $msg_comment?></div>
<?php if ($NumC > 0) {?>
	<h1>Comments</h1>
	<div id='comments'>
	<?php 
		$i=1;
		echo "<ul>";
		foreach ($ItemComments as $Comments){ 
			
			echo "<li>";
			echo $i .'. '. $html->sanitize($Comments['V_Comments_Admin']['subject']);
			echo "<span>by ".$html->sanitize($Comments['V_Comments_Admin']['name'])." on ". date("d M Y H:i:s",strtotime($Comments['V_Comments_Admin']['date_created']))."</span>";
			echo "<p>".$html->sanitize($Comments['V_Comments_Admin']['comment'])."</p>";
			echo "<p>" ;
			if ($Comments['V_Comments_Admin']['status'] == 0)
				echo $html->link('Show','admin/'. $Comments['V_Comments_Admin']['type'].'/edit/'.$id.'/comment/show/'.$Comments['V_Comments_Admin']['id'],'button1','',true,"Are you sure to show this item ?") ;
			else
				echo $html->link('Hide','admin/'. $Comments['V_Comments_Admin']['type'].'/edit/'.$id.'/comment/hide/'.$Comments['V_Comments_Admin']['id'],'button1','',true,"Are you sure to hide this item ?") ;
				
			echo " ". $html->link('Delete','admin/'. $Comments['V_Comments_Admin']['type'].'/edit/'.$id.'/comment/delete/'.$Comments['V_Comments_Admin']['id'],'button1','',true,"Are you sure to delete this comment ?") ."</p>";
			echo "</li>";
			$i++;
		}
		echo "</ul>";
	?>
	</div>
<?php }else{ ?>
	<h1>Comments</h1>
	<div id='comments'>
	<ul>
		<li>No Comments yet...</li>
	</ul>
	</div>
<?php } ?>