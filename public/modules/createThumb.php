<?php
/**
 * @author Hendry Apr 7, 2010
 *
 */

      function resize($img, $w, $h, $newfilename,$force_resize=true) {
       $c_w = 0;
       //Check if GD extension is loaded
       if (!extension_loaded('gd') && !extension_loaded('gd2')) {
        trigger_error("GD is not loaded", E_USER_WARNING);
        return false;
       }
       //Get Image size info
       $imgInfo = getimagesize($img);
       switch ($imgInfo[2]) {
        case 1: $im = imagecreatefromgif($img); break;
        case 2: $im = imagecreatefromjpeg($img);  break;
        case 3: $im = imagecreatefrompng($img); break;
        default:  trigger_error('Unsupported filetype!', E_USER_WARNING); return false; break;
       }
	
		//If image dimension is smaller, do not resize
		 if (($imgInfo[0] <= $w && $imgInfo[1] <= $h) && !$force_resize) {
		  $nHeight = $imgInfo[1];
		  $nWidth = $imgInfo[0];
		 }else{
		//yeah, resize it, but keep it proportional
		  if ($w/$imgInfo[0] > $h/$imgInfo[1]) {
		   $nWidth = $w;
		   $nHeight = $imgInfo[1]*($w/$imgInfo[0]);
		  }else{
		   $nWidth = $imgInfo[0]*($h/$imgInfo[1]);
		   $nHeight = $h;
		  }
		 }
		 $nWidth = round($nWidth);
		 $nHeight = round($nHeight);
       
       if ($nWidth > $w){
       	$c_w= $w - $nWidth;
       	$c_w = $c_w/2;
       }
       $c_h= 0;
       if ($nHeight> $h){
       	$c_h= $h - $nHeight;
       	$c_h = $c_h/2;
       }
       
       $newImg = imagecreatetruecolor($w, $h);

       /* Check if this image is PNG or GIF, then set if Transparent*/  
       if(($imgInfo[2] == 1) OR ($imgInfo[2]==3)){
        imagealphablending($newImg, false);
        imagesavealpha($newImg,true);
        $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
        imagefilledrectangle($newImg, 0, 0, $w, $h, $transparent);
       }
       
	   imagecopyresampled($newImg, $im, $c_w, $c_h, $c_w, $c_h, $nWidth, $nHeight, $imgInfo[0], $imgInfo[1]);
	   
       //Generate the file, and rename it to $newfilename
       switch ($imgInfo[2]) {
        case 1: imagegif($newImg,$newfilename); break;
        case 2: imagejpeg($newImg,$newfilename);  break;
        case 3: imagepng($newImg,$newfilename); break;
        default:  trigger_error('Failed resize image!', E_USER_WARNING); return false; break;
       }
         return $newfilename;
      }