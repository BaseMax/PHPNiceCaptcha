<?php
session_start();
function string($input, $length = 5) {
	$lengths = strlen($input);
	$output = "";
	for($i = 0; $i < $length; $i++) {
		$output .= $input[mt_rand(0, $lengths - 1)];
	}
	return $output;
}
$width=200;
$height=50;
$codeLength=4;
$chars="0123456789";
$lineInPart=2;
$CircleInPart=3;
$code = string($chars, $codeLength);
$image = imagecreatetruecolor($width, $height);
$cHeight=$height;
$cWidth=$width / $codeLength;
imageantialias($image, true);
$colors=[
	#16F292, rgb(22,242,146)
	imagecolorallocate($image, 22,242,146),
	#b6177b, rgb(182,23,123)
	imagecolorallocate($image, 182,23,123),
	#3a2b00, rgb(58,43,0)
	imagecolorallocate($image, 58,43,0),
	#9f1435, rgb(159,20,53)
	imagecolorallocate($image, 159,20,53),
];
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
$font_path = "/var/www/html/arial.ttf";
for($i=0;$i<$codeLength;$i++) {
	$x1=$i * $cWidth;
	$y1=0;
	$x2=$x1 + $cWidth;
	$y2=$cHeight;
	imagefilledrectangle($image, $x1, $y1, $x2, $y2, $colors[$i]);
	$text = $code[$i];
	imagettftext($image, 25, rand(0, 80), $x1 + rand(17, 30), 37, $black, $font_path, $text);
	for($li=0;$li<$lineInPart;$li++) {
		imageline($image, $x1+rand(-7, 10), rand(10, $height-5), $x2-rand(5,10), rand(10, $height-5), $black);
		$color=imagecolorallocate($image, rand(0,190), rand(0,190), rand(0,190));
		$size=rand(7,10);
		imagefilledellipse($image, $x1+rand(-7, 10), rand(10, $height-5), $size, $size, $color);
	}
	for($ci=0;$ci<$CircleInPart;$ci++) {

	}
}
header("Content-type: image/png");
imagepng($image);
