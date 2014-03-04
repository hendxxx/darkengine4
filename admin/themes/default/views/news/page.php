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
	
<h1>News List</h1>
<h2>all news here</h2>
<br />
<div id='errormsg'><?php echo $msg?></div>
<br />
<?php 
if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1'){
	echo $html->link("New",'admin/news/add','button1','');
}
?>
<br />
<br />
<table id='myTable' cellpadding=5 cellspacing=0 width='100%' class='sorted regroup'>
<thead>
	<tr>
	<th id='id' class='sortedminus' width=50 axis='number'>ID</th>
	<th id='subject' axis='string'>Subject</th>
	<th id='tags' axis='string'>Tags</th>
	<th id='front' axis='string'>Front</th>
	<th id='user_created' width='100' axis='string'>User Created</th>
	<th id='date_created' width='100' axis='string'>Date Created</th>
	<th id='user_modified' width='100' axis='string'>User Modified</th>
	<th id='date_modified' width='100' axis='string'>Date Modified</th>
	<th width='8%' axis='string' id='noprint' class='nosort'>Action</th>
	</tr>
</thead>
<tbody>
	<?php foreach ($news as $newsitem){
		echo "<tr >";
		echo "<td headers='id' class='leftAlign' axis='number'>".$newsitem['News']['id']."</td>";
		echo "<td headers='subject' axis='string'>".$newsitem['News']['subject']."</td>";
		echo "<td headers='tags' axis='string'>".$newsitem['News']['tags']."</td>";
		echo "<td headers='front' axis='string'>".$newsitem['News']['front']."</td>";
		echo "<td headers='user_created' axis='string'>".$newsitem['News']['user_created']."</td>";
		echo "<td headers='date_created' axis='date'>".date("M d Y", strtotime($newsitem['News']['date_created']))."</td>";
		echo "<td headers='user_modifed' axis='string'>".$newsitem['News']['user_modified']."</td>";
		echo "<td headers='date_modifed' axis='date'>".date("M d Y", strtotime($newsitem['News']['date_modified']))."</td>";
		echo "<td align=center axis='string' id='noprint'>";
			
		if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']=='1'){
			echo $html->link("Edit",'admin/news/edit/'.$newsitem['News']['id']);
			echo " " . $html->link("Delete",'admin/news/delete/'.$newsitem['News']['id'],"","",true,"Are you sure to delete this item ?");
		}
		
		echo "</td>";
		echo "</tr>";
		} 
	?>
</tbody>
<tfoot><tr><td colspan='9'>Total : <?php echo $NumOfNews?></td></tr>
</tfoot>
</table>

<?php 
$page = 'admin/news/page/';
include(ROOT . DS . 'public/modules/pagingAdmin.php');
?>