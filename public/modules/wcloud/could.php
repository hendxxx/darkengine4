  <style type="text/css">
    <!--
      @import url('<?php echo BASE_PATH?>/public/modules/wcloud/wordcloud.css');
    //-->
  </style>
<?php

	require ('./public/modules/wcloud/wordcloud.class.php');
	
	$d="";
	
	$i=0;
  if ($TagCloud != ''){
	foreach ($TagCloud as $TagCloudItem){
		if ($i == 0)
			$sep = "";
		else
			$sep = ",";
			
		$d .= $sep . str_replace(" ","",$TagCloudItem['V_Tags']['tags']) ;
		$i++;
	}
	}
	$a=explode(",",$d) ;
	
    $cloud = new wordCloud($a);
	
    $myCloud = $cloud->showCloud("array",true,false);
    $i=0;
 
    foreach ($myCloud as $key => $value) {
    	if ($i<20){
	    	$link = $html->link($value['word'],"tags/search/".$value['word']);
    		echo "<span class='word size".$value['sizeRange']."'>".$link."</span> ";
    	}
    	$i++;
    }