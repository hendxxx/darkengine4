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
	
<h1>Links List</h1>
<h2>all links here</h2>
<br />
<div id='errormsg'><?php echo $msg?></div>
<br />
<?php 
if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1'){
	echo $html->link("New",'admin/links/add','button1','');
}?>

<br />
<br />
<table id='myTable' cellpadding=5 cellspacing=0 width='100%' class='sorted regroup'>
<thead>
	<tr>
	<th id='id' class='sortedminus' width=50 axis='number'>ID</th>
	<th id='image' width='1%' axis='string'>Image</th>
	<th id='name'  width='100' axis='string'>Name</th>
	<th id='linkto'  width='100' axis='string'>Link To</th>
	<th id='user_created' width='100' axis='string'>User Created</th>
	<th id='date_created' width='100' axis='string'>Date Created</th>
	<th id='user_modified' width='100' axis='string'>User Modified</th>
	<th id='date_modified' width='100' axis='string'>Date Modified</th>
	<th width='8%' axis='string' id='noprint' class='nosort'>Action</th>
	</tr>
</thead>
<tbody>
	<?php foreach ($links as $linksitem){
		echo "<tr >";
		echo "<td headers='id' class='leftAlign' axis='number'>".$linksitem['Links']['id']."</td>";
		echo "<td headers='image' axis='string'>";
		if ($linksitem['Links']['image'] != "nothing"){
			echo "<img width='200px' height='50px' src='". BASE_PATH."/public/uploads/image/links/". $linksitem['Links']['image']."'/>";
		}else{
			echo "";
		}
		echo "</td>";
		echo "<td headers='name' axis='string'>".$linksitem['Links']['name']."</td>";
		echo "<td headers='linkto' axis='string'>".$linksitem['Links']['to']."</td>";
		echo "<td headers='user_created' axis='string'>".$linksitem['Links']['user_created']."</td>";
		echo "<td headers='date_created' axis='date'>".date("M d Y", strtotime($linksitem['Links']['date_created']))."</td>";
		echo "<td headers='user_modifed' axis='string'>".$linksitem['Links']['user_modified']."</td>";
		echo "<td headers='date_modifed' axis='date'>".date("M d Y", strtotime($linksitem['Links']['date_modified']))."</td>";
		echo "<td align=center axis='string' id='noprint'>";
		if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1'){
			echo $html->link("Edit",'admin/links/edit/'.$linksitem['Links']['id'])." ".$html->link("Delete",'admin/links/delete/'.$linksitem['Links']['id'],"","",true,"Are you sure to delete this item ?");
		}
		echo "</td>";
		echo "</tr>";
		} 
	?>
</tbody>
<tfoot><tr><td colspan='9'>Total : <?php echo $NumOfLinks?></td></tr>
</tfoot>
</table>

<?php 
$page = 'admin/links/page/';
include(ROOT . DS . 'public/modules/pagingAdmin.php');
?>
	