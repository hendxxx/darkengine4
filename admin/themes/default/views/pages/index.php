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
	
<h1>Pages List</h1>
<h2>all pages here</h2>
<br />
<div id='errormsg'><?php echo $msg?></div>
<br />
<?php 
if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1'){
	echo $html->link("New",'admin/pages/add','button1','');
}?>

<br />
<br />
<table id='myTable' cellpadding=5 cellspacing=0 width='100%' class='sorted regroup'>
<thead>
	<tr>
	<th id='id' class='sortedminus' width=50 axis='number'>ID</th>
	<th id='name' axis='string'>Name</th>
	<th id='title' axis='string'>Title</th>
	<th id='parent' axis='string'>Parent</th>
	<th id='user_created' width='100' axis='string'>User Created</th>
	<th id='date_created' width='100' axis='string'>Date Created</th>
	<th id='user_modified' width='100' axis='string'>User Modified</th>
	<th id='date_modified' width='100' axis='string'>Date Modified</th>
	<th width='8%' axis='string' id='noprint' class='nosort'>Action</th>
	</tr>
</thead>
<tbody>
	<?php foreach ($pages as $pagesitem){
		echo "<tr >";
		echo "<td headers='id' class='leftAlign' axis='number'>".$pagesitem['Pages']['id']."</td>";
		echo "<td headers='name' axis='string'>".$pagesitem['Pages']['name']."</td>";
		echo "<td headers='title' axis='string'>".$pagesitem['Pages']['title']."</td>";
		echo "<td headers='parent' axis='string'>".$pagesitem['Pages']['parent']."</td>";
		echo "<td headers='user_created' axis='string'>".$pagesitem['Pages']['user_created']."</td>";
		echo "<td headers='date_created' axis='date'>".date("M d Y", strtotime($pagesitem['Pages']['date_created']))."</td>";
		echo "<td headers='user_modifed' axis='string'>".$pagesitem['Pages']['user_modified']."</td>";
		echo "<td headers='date_modifed' axis='date'>".date("M d Y", strtotime($pagesitem['Pages']['date_modified']))."</td>";
		echo "<td align=center axis='string' id='noprint'>";
		if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1'){
			echo $html->link("Edit",'admin/pages/edit/'.$pagesitem['Pages']['id'])." ".$html->link("Delete",'admin/pages/delete/'.$pagesitem['Pages']['id'],"","",true,"Are you sure to delete this item ?");
		}
		echo "</td>";
		echo "</tr>";
		} 
	?>
</tbody>
<tfoot><tr><td colspan='9'>Total : <?php echo $NumOfPages?></td></tr>
</tfoot>
</table>

<?php 
$page = 'admin/pages/page/';
include(ROOT . DS . 'public/modules/pagingAdmin.php');
?>
	