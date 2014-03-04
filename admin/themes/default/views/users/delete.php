<?php 
echo $html->includeCss("jscripts/exp_tables/style");
echo $html->includeJs("jscripts/exp_tables/load_table");
echo $html->includeJs("jscripts/exp_tables/Event");
echo $html->includeJs("jscripts/exp_tables/SortedTable");

include('../public/jscripts/js_init.php'); 

?>
<style>
table{
	color:#000000;
}
table a{
	color:red;
}
</style>
	
<h1>Users List</h1>
<h2>all users here</h2>
<br />
<div id='errormsg'><?php echo $msg?></div>
<br />
<?php 
if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1'){
	echo $html->link("New",'admin/users/add','button1','');
}?>

<br />
<br />
<table id='myTable' cellpadding=5 cellspacing=0 width='100%' class='sorted regroup'>
<thead>
	<tr>
	<th id='id' class='sortedminus' width=50 axis='number'>ID</th>
	<th id='uid' axis='string'>User ID</th>
	<th id='pwd' axis='string'>Level</th>
	<th id='last' width='100' axis='string'>Last Login</th>
	<th width='8%' axis='string' id='noprint' class='nosort'>Action</th>
	</tr>
</thead>
<tbody>
	<?php $i=0;foreach ($users as $usersitem){
		echo "<tr >";
		echo "<td headers='id' class='leftAlign' axis='number'>".$usersitem['Users']['id']."</td>";
		echo "<td headers='uid' axis='string'>".$usersitem['Users']['UID']."</td>";
		echo "<td headers='pwd' axis='string'>".$usersitem['Users']['LEVEL']."</td>";
		echo "<td headers='last' axis='string'>".$usersitem['Users']['last_login']."</td>";
		echo "<td align=center axis='string' id='noprint'>";

		if ((isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1') || $_SESSION['ADMIN_UID'] == $usersitem['Users']['UID'] ){
			echo $html->link("Edit",'admin/users/edit/'.$usersitem['Users']['id']);
		}
		if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1'){
			echo " ".$html->link("Delete",'admin/users/delete/'.$usersitem['Users']['id'],"","","",true,"Are you sure to delete this item ?");
		}
		echo "</td>";
		echo "</tr>";
		$i++;
		} 
	?>
</tbody>
<tfoot><tr><td colspan='5'>Total : <?php echo $NumOfUsers?></td></tr>
</tfoot>
</table>

<?php 
$page = 'admin/users/page/';
include(ROOT . DS . 'public/modules/pagingAdmin.php');
?>
	