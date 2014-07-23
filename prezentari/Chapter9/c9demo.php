<?php
	//php image type format
/*
	$image = imagecreate(200, 200);
	$white = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
	$black = imagecolorallocate($image, 0x00, 0x00, 0x00);
	imagefilledrectangle($image, 50, 50, 150, 150, $black);
	if (imagetypes() & IMG_PNG) {
		header("Content-Type: image/png");
		imagepng($image);
	}
	else if (imagetypes() & IMG_JPG) {
		header("Content-Type: image/jpeg");
		imagejpeg($image);
	}
	else if (imagetypes() & IMG_GIF) {
		header("Content-Type: image/gif");
		imagegif($image);
	} 
*/
	
	//php draw polygons
/*
	$image = imagecreatetruecolor(400, 300);
	$col_poly = imagecolorallocate($image, 255, 0, 255);
	imagepolygon($image, array(
							0,   0,
							100, 200,
							300, 200
						),
						3,
						$col_poly);
	header('Content-type: image/png');
	imagepng($image);
	imagedestroy($image);
*/

	//php rotate image 
/*
	$image = imagecreatetruecolor(400, 300);
	$col_poly = imagecolorallocate($image, 255, 0, 255);
	$degrees = 45;
	imagealphablending($image, true);
	imagepolygon($image, array(
							0,   0,
							100, 200,
							300, 200
						),
						3,
						$col_poly);
	header('Content-type: image/png');
	$trans_rotate = imagecolorallocatealpha($image, 0, 255, 255, 5);
	$rotate = imagerotate($image, $degrees, $trans_rotate);
	
	imagepng($rotate);
	imagedestroy($image);
	imagedestroy($rotate);
*/

	//php images with text
/*
	$image = imagecreate(200, 200);
	$white = imagecolorallocate($image, 250, 250, 250);
	$black = imagecolorallocate($image, 0, 0, 0);
	imagefilledrectangle($image, 50, 50, 150, 150, $black);
	imagestring($image, 5, 50, 160, "A Black Box", $black);
	header("Content-Type: image/png");
	imagepng($image);
*/

	//php images with text
/*
	$image = imagecreate(200, 200);
	$white = imagecolorallocate($image, 250, 250, 250);
	$black = imagecolorallocate($image, 0, 0, 0);
	imagefilledrectangle($image, 50, 50, 150, 150, $black);
	imagestring($image, 1, 10, 10, "Font 1: A Black Box", $black);
	imagestring($image, 2, 10, 30, "Font 10: A Black Box", $black);
	imagestring($image, 3, 10, 50, "Font 15: A Black Box", $black);
	imagestring($image, 4, 10, 70, "Font 20: A Black Box", $black);
	header("Content-Type: image/png");
	imagepng($image);
*/

	//php alpha channel
/*
	$image = imagecreatetruecolor(150, 150);
	//imagealphablending($image, false);
	$white = imagecolorallocate($image, 255, 255, 255);
	imagefilledrectangle($image, 0, 0, 150, 150, $white);
	$red = imagecolorallocatealpha($image, 255, 50, 0, 63);
	imagefilledellipse($image, 75, 75, 80, 50, $red);
	//imagealphablending($image, false);
	$gray = imagecolorallocatealpha($image, 70, 70, 70, 63);
	imagefilledrectangle($image, 60, 60, 120, 120, $gray);
	header("Content-Type: image/png");
	imagepng($image);
*/
?>




















