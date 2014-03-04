<?php

class HTML {
	private $js = array();
	function limitword($w,$limit = 20){
		$more = "";
		if (strlen($w) > $limit){
			$more = "...";
			$_w = str_split($w,$limit-strlen($more));
			$w = $_w[0];
		}
		return $w . $more;
	}
	function cekFileType($file){
	    $imgType = array(
	        "GIF" =>"image/gif",
	        "JPG" => "image/jpg",
	        "JPEG" => "image/jpeg",
	        "PJPEG" => "image/pjpeg",
	        "BMP" => "image/bmp",
	        "PNG" => "image/png",
		"MP3" => "audio/mpeg");
	    if(in_array($file,$imgType)) 
	        return true;
	    else return false;
	}
	
	
	function RedirectTo($to){
		header ( 'Location: ' . BASE_PATH . "/" . $to) ;
	}
	function shortenUrls($data) {
		$data = preg_replace_callback('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', array(get_class($this), '_fetchTinyUrl'), $data);
		return $data;
	}

	private function _fetchTinyUrl($url) { 
		$ch = curl_init(); 
		$timeout = 5; 
		curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url[0]); 
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout); 
		$data = curl_exec($ch); 
		curl_close($ch); 
		return '<a href="'.$data.'" target = "_blank" >'.$data.'</a>'; 
	}

	function sanitize($data) {
		$data = mysql_real_escape_string($data);
		$data = htmlspecialchars($data);
		$data = preg_replace('/\s\s+/', ' ', $data);
		$data = strip_tags($data,"<b><i><br /><br /><p>");
		return $data;
	}
	function GetWebIcon($link){
		if ($link == "http://" || $link == ""){
			return "";
		}else{
			$link = explode("/",$link);
			$link = $link[2];
			$link = preg_replace('|https?:[/]+|i', '', $link);
			return "<img src='http://www.google.com/s2/favicons?domain=".$link."' border='0' alt='' style='margin:0;padding:0;padding-right:10px;' width='16' height='16' />";
		}
		
	}
	function linkToOther($text,$path,$class = null ,$id = null,$title = null,$additional = null,$target = "_new"){
		if ($title != null)
			$title = "title='".$title."'";
		else
			$title = "";
			
		if ($class != null)
			$class = "class='".$class."'";
		else
			$class = "";
			
		if ($id != null)
			$id = "id='".$id."'";
		else
			$id = "";

		if ($target != null)
			$target = "target='".$target."'";
		else
			$target = "";
			
		$data = '<a href="'. $path.'" '.$class.' '.$id.' '. $title .' ' .$additional . ' ' .$target. ' >'.$text.'</a>';	
		return $data;
	}
	function link($text,$path,$class = null ,$id = null ,$title = null ,$additional = null,$prompt = null,$confirmMessage = "Are you sure?") {
		
		if ($path != "")
			$path = $path . URL_SUFFIX;
		 
		//replace ALL except = /_.,
		$search  = array('/[^a-z\d_.,\x2D\x2F ]+/i', '/ +/');
		$replace = array('', '-');
		$path = preg_replace($search, $replace, strtolower($path));
		$path = str_replace(' ','-',$path);
		
		if ($title != null)
			$title = "title='".$title."'";
		else
			$title = "";
			
		if ($class != null)
			$class = "class='".$class."'";
		else
			$class = "";
			
		if ($id != null)
			$id = "id='".$id."'";
		else
			$id = "";
		
		if ($additional == null)
			$additional = "";
			
		if ($prompt) {
			$data = '<a href="javascript:void(0);" '.$class.' '.$id.' onclick="javascript:jumpTo(\''.BASE_PATH.'/'.$path.'\',\''.$confirmMessage.'\')">'.$text.'</a>';
		} else {
			$data = '<a href="'.BASE_PATH.'/'.$path.'"  '.$class.' '.$id.' '. $title .' '. $additional .' >'.$text.'</a>';	
		}
		return $data;
	}

	function includeJs($fileName,$themes = null) {
		if (!isset($themes)){
			$data = '<script src="'.$fileName.'.js" type="text/javascript"></script>';
		}else{
			$data = '<script src="'.BASE_PATH .'/public/themes/'.$themes.'/'.$fileName.'.js" type="text/javascript"></script>';
		}

		return $data;

	}

	function loadImage($fileName, $themes = null, $additional = '') {
		if (!isset($themes)){
			$data = '<img src="'.$fileName.' '.$additional.'" />';
		}else{
			$data = '<img src="'.BASE_PATH.'/public/themes/'.$themes.'/images/'.$fileName .'" '.$additional.' />';
			
		}
		return $data;
	}

	function includeCss($fileName,$admin=false,$themes = null) {
		if ($admin)
			if (!isset($themes))
				$data = '<link rel="stylesheet" type="text/css" media="all" href="'. BASE_PATH .'/public/admin/styles/'.$fileName.'.css" />';
			else
					$data = '<link rel="stylesheet" type="text/css" media="all" href="'. BASE_PATH .'/public/themes/'.$themes.'/'.$fileName.'.css" />';
		else
			if (!isset($themes))
				$data = '<link rel="stylesheet" type="text/css" media="all" href="'. BASE_PATH .'/public/'.$fileName.'.css" />';	
			else
				$data = '<link rel="stylesheet" type="text/css" media="all" href="'. BASE_PATH .'/public/themes/'.$themes.'/'.$fileName.'.css" />';
		
		return $data;
	}
}