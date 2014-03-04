<style>
#pagination-flickr {clear:both;}
#pagination-flickr ul{border:0; margin:0; padding:0;}

#pagination-flickr li{
float:left;
display:block;
border:0; margin:0; padding:0;
font-size:11px;
list-style:none;

}
#pagination-flickr a{

border:solid 1px #DDDDDD;
margin-right:2px;
}
#pagination-flickr .previous-off,
#pagination-flickr .next-off {

color:#666666;
display:block;
float:left;
font-weight:bold;
padding:3px 4px;

display: none;
}
#pagination-flickr .next a,
#pagination-flickr .previous a {

font-weight:bold;
border:solid 1px #DDDDDD;

} 
#pagination-flickr .active{
border:solid 1px #DDDDDD;
background-color:#eaeaea;
color:#000000;
font-weight:bold;
display:block;
float:left;
padding:3px 6px;
margin-right:2px;
}
#pagination-flickr a:link,
#pagination-flickr a:visited {

color:#000000;
display:block;
float:left;
padding:3px 6px;
text-decoration:none;
}
#pagination-flickr a:hover{

border:solid 1px #666666;
}


</style>
<br />
<div id="pagination-flickr">
	<ul>
	<?php 
	if (!isset($add))
		$add = "";
	
	if (!isset($totalPages)) 
		$totalPages = 0;
							
	
	if ($totalPages > 1){
		
	?>
	<?php if ($currentPageNumber <= 1){ ?>
		<li class="previous-off">&lt;&lt;</li>
	<?php }else{ ?>
		<li class="previous"><?php echo $html->link("&lt;&lt; ",$page. 1 . $add) ?></li>
	<?php }?>
	
	<?php if ($currentPageNumber <= 1){ ?>
		<li class="previous-off"> &lt;</li>
	<?php }else{ ?>
		<li class="previous"><?php echo $html->link(" &lt; ",$page. ($currentPageNumber-1). $add) ?></li>
	<?php }?>
	
	<?php /**for ($i = 1; $i <= $totalPages; $i++) {
		$cur ="";
		if ($i == $currentPageNumber){
			$cur = "class='active'";
			echo "<li ".$cur.">" .$i ."</li>";
		}else{
			echo "<li >" . $html->link($i,$page.$i. $add) ."</li>";
		}
		
	}**/
	 
	$PageLeftRight = 4;
	$jumPage = $totalPages;
	$noPage = $currentPageNumber;
	$showPage=0;
	$cur = "class='active'";
	for($i = 1; $i <= $jumPage; $i++)
	{
         if ((($i >= $noPage - $PageLeftRight) && ($i <= $noPage + $PageLeftRight)) || ($i == 1) || ($i == $jumPage))
         {
            if (($showPage == 1) && ($i != 2))  echo "<li style='padding-top:5px;'>...</li>";
            if (($showPage != ($jumPage - 1)) && ($i == $jumPage))  echo "<li style='padding-top:5px;'>...</li>";
            if ($i == $noPage) {
            	echo "<li ".$cur.">" .$i ."</li>";
            } else {
            	echo "<li >" . $html->link($i,$page.$i. $add) ."</li>";
            }
            $showPage = $i;
         }
	}
	?>
	
	<?php if ($currentPageNumber >= $totalPages){ ?>
		<li class="next-off"> &gt;</li>
	<?php }else{ ?>
		<li class="next"><?php echo $html->link(' &gt;',$page. ($currentPageNumber+1) . $add) ?></li>
	<?php }?>
	
	<?php if ($currentPageNumber >= $totalPages){ ?>
		<li class="next-off"> &gt;&gt;</li>
	<?php }else{ ?>
		<li class="next"><?php echo $html->link(' &gt;&gt;',$page.$totalPages. $add) ?></li>
	<?php }?>
<?php }?>
	
	</ul> 
</div>
