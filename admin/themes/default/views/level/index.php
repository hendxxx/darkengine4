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
	
<h1>Level List</h1>
<h2>all level here</h2>
<br />
<div id='errormsg'><?php echo $msg?></div>
<br />
<?php 
if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1'){
	echo $html->link("New",'admin/level/add','button1','');
}?>

<br />
<br />
<table id='myTable' cellpadding=5 cellspacing=0 width='100%' class='sorted regroup'>
<thead>
	<tr>
	<th id='id' class='sortedminus' width=50 axis='number'>id</th>
	<th id='levelname' axis='string'>Level Name</th>
	<th id='isadmin' axis='string'>Is Admin</th>
	<th width='8%' axis='string' id='noprint' class='nosort'>Action</th>
	</tr>
</thead>
<tbody>
	<?php $i=0;foreach ($level as $levelitem){
		echo "<tr >";
		echo "<td headers='id' class='leftAlign' axis='number'>".$levelitem['Level']['id']."</td>";
		echo "<td headers='levelname' axis='string'>".$levelitem['Level']['LevelName']."</td>";
		if ($levelitem['Level']['IsAdmin'] == 1 ) {
			$isadmin_label = "Yes";
		}else{
			$isadmin_label = "No";
		}
		
		echo "<td headers='isadmin' axis='string'>".$isadmin_label."</td>";
		echo "<td align=center axis='string' id='noprint'>";
		
		if ((isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1') || $_SESSION['ADMIN_Uid'] == $levelitem['Level']['id'] ){
			echo $html->link("Edit",'admin/level/edit/'.$levelitem['Level']['id']);
		}
		if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1'){
			echo " ".$html->link("Delete",'admin/level/delete/'.$levelitem['Level']['id'],"","","",true,"Are you sure to delete this item ?");
		}
		echo "</td>";
		echo "</tr>";
		$i++;
		} 
	?>
</tbody>
<tfoot><tr><td colspan='5'>Total : <?php echo $NumOfLevel?></td></tr>
</tfoot>
</table>

<?php 
$page = 'admin/level/page/';
include(ROOT . DS . 'public/modules/pagingAdmin.php');
?>
	