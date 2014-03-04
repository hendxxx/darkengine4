<?php
/*
 * Created on 29 Mar 10
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<h1>Welcome</h1>
<h2>
hi, <?php echo $_SESSION['ADMIN_UID'];?> <br />
<?php 
if (!isset($_SESSION['ADMIN_LAST_LOGIN']) || $_SESSION['ADMIN_LAST_LOGIN']=='Never'){
	echo "Last login Never <br /> ";
}else{
	echo "Last login ". date("D, d M Y",strtotime($_SESSION['ADMIN_LAST_LOGIN'])) ."<br />";
}

?>
</h2>
<br />
<p>
This is admin page for Darkengine v4. To change your password goto user menu then press edit link.

</p>