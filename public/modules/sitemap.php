<?php
/**
 * @author Hendry Apr 7, 2010
 *
 */

header("Content-type: text/xml");

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
	
$xml_output = "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n";
	$xml_output .="<url>\n";
		$xml_output .="<loc>http://".BASE_PATH."</loc>\n";
		$xml_output .="<changefreq>daily</changefreq>\n";
		$xml_output .="<priority>1</priority>\n";
	$xml_output .="</url>\n";
	
	//Announcements
	$xml_output .="<url>\n";	
		$xml_output .="<loc>http://".BASE_PATH."/announcements/</loc>\n";
		$xml_output .="<priority>0.80</priority>\n";
		$xml_output .="<changefreq>daily</changefreq>\n";
	$xml_output .="</url>\n";
	$hasil=ExecSQLToArray("SELECT * FROM announcements order by ID Desc");
	while($data = mysql_fetch_array($hasil)){
		$xml_output .="<url>\n";
			$xml_output .="<loc>http://".BASE_PATH."/news/".$data['subject']."</loc>\n";
			$xml_output .="<priority>0.80</priority>\n";
			$xml_output .="<changefreq>daily</changefreq>\n";
		$xml_output .="</url>\n";			
	}
	
	//News
	$xml_output .="<url>\n";	
		$xml_output .="<loc>http://".BASE_PATH."/news/</loc>\n";
		$xml_output .="<priority>0.80</priority>\n";
		$xml_output .="<changefreq>daily</changefreq>\n";
	$xml_output .="</url>\n";
	$hasil=ExecSQLToArray("SELECT * FROM news order by ID Desc");
	while($data = mysql_fetch_array($hasil)){
		$xml_output .="<url>\n";
			$xml_output .="<loc>http://".BASE_PATH."/news/".$data['subject']."</loc>\n";
			$xml_output .="<priority>0.80</priority>\n";
			$xml_output .="<changefreq>daily</changefreq>\n";
		$xml_output .="</url>\n";			
	}
			
	//Articles
	$xml_output .="<url>\n";	
		$xml_output .="<loc>http://".BASE_PATH."/articles/</loc>\n";
		$xml_output .="<priority>0.80</priority>\n";
		$xml_output .="<changefreq>daily</changefreq>\n";
	$xml_output .="</url>\n";
	$hasil=ExecSQLToArray("SELECT * FROM articles order by ID Desc");
	while($data = mysql_fetch_array($hasil)){
		$xml_output .="<url>\n";
			$xml_output .="<loc>http://".BASE_PATH."/articles/".$data['subject']."</loc>\n";
			$xml_output .="<priority>0.80</priority>\n";
			$xml_output .="<changefreq>daily</changefreq>\n";
		$xml_output .="</url>\n";			
	}
	
	//Gallery
	$xml_output .="<url>\n";	
		$xml_output .="<loc>http://".BASE_PATH."/gallery/</loc>\n";
		$xml_output .="<priority>0.80</priority>\n";
		$xml_output .="<changefreq>daily</changefreq>\n";
	$xml_output .="</url>\n";
	$hasil=ExecSQLToArray("SELECT * FROM gallery order by ID Desc");
	while($data = mysql_fetch_array($hasil)){
		$xml_output .="<url>\n";
			$xml_output .="<loc>http://".BASE_PATH."/gallery/".$data['name']."</loc>\n";
			$xml_output .="<priority>0.80</priority>\n";
			$xml_output .="<changefreq>daily</changefreq>\n";
		$xml_output .="</url>\n";			
	}
	
	//Page
	$hasil=ExecSQLToArray("SELECT * FROM pages order by ID Desc");
	while($data = mysql_fetch_array($hasil)){
		$xml_output .="<url>\n";
			$xml_output .="<loc>http://".BASE_PATH."/".$data['name']."</loc>\n";
			$xml_output .="<priority>0.80</priority>\n";
			$xml_output .="<changefreq>daily</changefreq>\n";
		$xml_output .="</url>\n";			
	}
	
	
	$xml_output .="<url>\n";	
		$xml_output .="<loc>http://".BASE_PATH."/about</loc>\n";
		$xml_output .="<priority>0.80</priority>\n";
		$xml_output .="<changefreq>daily</changefreq>\n";
	$xml_output .="</url>\n";
	
	$xml_output .="<url>\n";	
		$xml_output .="<loc>http://".BASE_PATH."/contact</loc>\n";
		$xml_output .="<priority>0.80</priority>\n";
		$xml_output .="<changefreq>daily</changefreq>\n";
	$xml_output .="</url>\n";
	
$xml_output .= "</urlset>\n";

echo $xml_output;