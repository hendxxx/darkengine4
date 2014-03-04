<?php
header("Content-type: application/rss+xml");

require_once ('../../config/config.php');
require_once ('../../application/themes/'.THEMES.'/config.php');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
if ($con)
	mysql_select_db(DB_NAME);
else
	die ('Error loading database!');
	
function ExecSQLToArray($SQL){
	$query = $SQL;
	$hasil = mysql_query($query);
	return $hasil;
}

function get_GMT_Diff(){
	$a=date('H:i:s');
	date_default_timezone_set('GMT');
	$b=date('H:i:s');
	date_default_timezone_set("UTC");
	$_c=$a-$b;
	if ($_c < 0 )
		return sprintf("-%04d", abs($_c));
	else
		return sprintf("+%04d", abs($_c));
}

$date=date('Y-M-d H:i:s');
$gmt=get_GMT_Diff();
$date = gmstrftime("%A, %d %B %Y %H:%M:%S",strtotime($date)) . " ". $gmt;

$xml_output = "<rss version=\"2.0\"
		xmlns:content=".'"http://purl.org/rss/1.0/modules/content/"'."
		xmlns:wfw=".'"http://wellformedweb.org/CommentAPI/"'."
		xmlns:atom=".'"http://www.w3.org/2005/Atom"'."
		xmlns:dc=".'"http://purl.org/dc/elements/1.1/"'." >";
$xml_output .= "<channel>\n"; 
$xml_output .= "<title>". SITE_NAME ." Feed</title>\n";

$xml_output .= "<link>". BASE_PATH ."</link>\n";

$xml_output .= "<description><![CDATA[ This is ". SITE_NAME ." feed description ]]></description>\n";
$xml_output .= "<lastBuildDate>$date</lastBuildDate>\n";
$xml_output .= "<language>en-us,id</language>\n";

//NEWS
$hasil=ExecSQLToArray("SELECT * FROM news order by ID Desc ");
while($data = mysql_fetch_array($hasil)){
	$id=$data['id'];
	$title = str_replace(" ","-",$data['subject']);
	
	$link = BASE_PATH . "/news/view/".$id."/".$title;
	
	// Escaping illegal characters
    $data['Subject'] = htmlspecialchars($data['subject']);
    $data['Subject'] = strip_tags($data['subject']);

	$output = preg_replace('/[^(\x20-\x7F)]*/','', $data['subject']);
	
    $date = gmstrftime("%a, %d %b %Y %H:%M:%S",strtotime($data['date_created'])) . " ". $gmt;
    
    $xml_output .= "\t<item>\n";
	$xml_output .= "\t\t<title>" . $output  . "  </title>\n";
    $xml_output .= "<pubDate>$date</pubDate>";
    $xml_output .= "<dc:creator>$data[user_created]</dc:creator>";
    $xml_output .= "\t\t<link>$link</link>\n";
    $xml_output .= "\t\t<guid isPermaLink='true'>$link</guid>\n";
    $xml_output .= "\t\t<description><![CDATA[$data[content]]]></description>\n";
    $xml_output .= "\t<category><![CDATA[News]]></category>\n";
    
    if (USE_COMMENT){
    	$xml_output .= "\t<comments>".$link."</comments>\n";
    	$xml_output .= "\t<numcomments>1</numcomments>\n";
    }
    
    $xml_output .= "\t</item>\n";
		
}

//Articles
$hasil=ExecSQLToArray("SELECT * FROM articles order by ID Desc ");
while($data = mysql_fetch_array($hasil)){
	$id=$data['id'];
	$title = str_replace(" ","-",$data['subject']);
	
	$link = BASE_PATH . "/news/view/".$id."/".$title;
	
	// Escaping illegal characters
    $data['Subject'] = htmlspecialchars($data['subject']);
    $data['Subject'] = strip_tags($data['subject']);

	$output = preg_replace('/[^(\x20-\x7F)]*/','', $data['subject']);
	
    $date = gmstrftime("%a, %d %b %Y %H:%M:%S",strtotime($data['date_created'])) . " ". $gmt;
    
    $xml_output .= "\t<item>\n";
	$xml_output .= "\t\t<title>" . $output  . "  </title>\n";
    $xml_output .= "<pubDate>$date</pubDate>";
    $xml_output .= "<dc:creator>$data[user_created]</dc:creator>";
    $xml_output .= "\t\t<link>$link</link>\n";
    $xml_output .= "\t\t<guid isPermaLink='true'>$link</guid>\n";
    $xml_output .= "\t\t<description><![CDATA[$data[content]]]></description>\n";
    $xml_output .= "\t<category><![CDATA[Articles]]></category>\n";
    
    if (USE_COMMENT){
    	$xml_output .= "\t<comments>".$link."</comments>\n";
    }
    
    $xml_output .= "\t</item>\n";
		
}

//Announcements
$hasil=ExecSQLToArray("SELECT * FROM announcements order by ID Desc ");
while($data = mysql_fetch_array($hasil)){
	$id=$data['id'];
	$title = str_replace(" ","-",$data['subject']);
	
	$link = BASE_PATH . "/news/view/".$id."/".$title;
	
	// Escaping illegal characters
    $data['Subject'] = htmlspecialchars($data['subject']);
    $data['Subject'] = strip_tags($data['subject']);

	$output = preg_replace('/[^(\x20-\x7F)]*/','', $data['subject']);
	
    $date = gmstrftime("%a, %d %b %Y %H:%M:%S",strtotime($data['date_created'])) . " ". $gmt;
    
    $xml_output .= "\t<item>\n";
	$xml_output .= "\t\t<title>" . $output  . "  </title>\n";
    $xml_output .= "<pubDate>$date</pubDate>";
    $xml_output .= "<dc:creator>$data[user_created]</dc:creator>";
    $xml_output .= "\t\t<link>$link</link>\n";
    $xml_output .= "\t\t<guid isPermaLink='true'>$link</guid>\n";
    $xml_output .= "\t\t<description><![CDATA[$data[content]]]></description>\n";
    $xml_output .= "\t<category><![CDATA[Announcements]]></category>\n";
    
    if (USE_COMMENT){
    	$xml_output .= "\t<comments>".$link."</comments>\n";
    }
    
    $xml_output .= "\t</item>\n";
		
}


//Gallery
$hasil=ExecSQLToArray("SELECT * FROM gallery order by ID Desc ");
while($data = mysql_fetch_array($hasil)){
	$id=$data['id'];
	$title = str_replace(" ","-",$data['name']);
	
	$link = BASE_PATH . "/news/view/".$id."/".$title;
	
	// Escaping illegal characters
    $data['name'] = htmlspecialchars($data['name']);
    $data['name'] = strip_tags($data['name']);

	$output = preg_replace('/[^(\x20-\x7F)]*/','', $data['name']);
	
    $date = gmstrftime("%a, %d %b %Y %H:%M:%S",strtotime($data['date_created'])) . " ". $gmt;
    
    $xml_output .= "\t<item>\n";
	$xml_output .= "\t\t<title>" . $output  . "  </title>\n";
    $xml_output .= "<pubDate>$date</pubDate>";
    $xml_output .= "<dc:creator>$data[user_created]</dc:creator>";
    $xml_output .= "\t\t<link>$link</link>\n";
    $xml_output .= "\t\t<guid isPermaLink='true'>$link</guid>\n";
    $xml_output .= "\t\t<description><![CDATA[ <img src='".BASE_PATH."/public/uploads/image/thumbs/".$data[image]."' />  $data[content]]]></description>\n";
    $xml_output .= "\t<category><![CDATA[Gallery]]></category>\n";
    
    if ($data[image] != "no_img.gif")
    	$xml_output .= "\t<enclosure url='".BASE_PATH."/public/uploads/image/".$data[image]."' length='10240' type='image/JPG' />\n";
    
    if (USE_COMMENT){
    	$xml_output .= "\t<comments>".$link."</comments>\n";
    }
    
    $xml_output .= "\t</item>\n";
		
}
$xml_output  .=  "</channel>\n";

$xml_output  .=  "</rss>\n";

echo $xml_output;
?>

