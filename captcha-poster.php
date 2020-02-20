<?php
// Max Base
// https://github.com/BaseMax/PHPNiceCaptcha
session_start();
$debug=false;
$font_path = "/usr/share/nginx/html/2.ttf";
// $font_path = "/usr/share/nginx/html/" . $_GET["font"]. ".ttf";
// arial.ttf";
// $debug=true; // Never not use this in public domain or place! IT'S YOUR RISK!
function string($input, $length = 5) {
	$lengths = strlen($input);
	$output = "";
	for($i = 0; $i < $length; $i++) {
		$output .= $input[mt_rand(0, $lengths - 1)];
	}
	return $output;
}
$width=640;
$height=480;
$codeLength=4;
$chars="123456789";
$lineInPart=2;
$CircleInPart=3;
$lineInAll=4;
$CircleInAll=6;
$code = string($chars, $codeLength);
if($debug == true && isset($_GET['code'])) {
	$code=$_GET['code'];
}
$image = imagecreatetruecolor($width, $height);
$cHeight=$height;
$cWidth=$width / $codeLength;
imageantialias($image, true);
$colors=[
	#16F292, rgb(22,242,146)
	//imagecolorallocate($image, 22,242,146),
	#b6177b, rgb(182,23,123)
	//imagecolorallocate($image, 182,23,123),
	#3a2b00, rgb(58,43,0)
	//imagecolorallocate($image, 58,43,0),
	#9f1435, rgb(159,20,53)
	//imagecolorallocate($image, 159,20,53),

	randColor(),
	randColor(),
	randColor(),
	randColor(),
];
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
function randColor() {
	global $image;
	return imagecolorallocate($image, rand(0, 95), rand(0, 95), rand(0, 95));
}
for($i=0;$i<$codeLength;$i++) {
	$x1=$i * $cWidth;
	$y1=0;
	$x2=$x1 + $cWidth;
	$y2=$cHeight;
	imagefilledrectangle($image, $x1, $y1, $x2, $y2, $colors[$i]);
	$text = $code[$i];
	imagettftext($image, 65, rand(0, 80), $x1 + rand(60, 90), rand(80, $height-30), randColor(), $font_path, $text);
	for($li=0;$li<$lineInPart;$li++) {
		// drawLine
		$textColor=$colors[$i];
		while($textColor == $colors[$i]) {
			$textColor=randColor();
		}
		imageline($image, $x1+rand(-7, 10), rand(10, $height-5), $x2-rand(5,10), rand(10, $height-5), $textColor);
	}
	for($ci=0;$ci<$CircleInPart;$ci++) {
		// drawCircle
		$color=imagecolorallocate($image, rand(0,190), rand(0,190), rand(0,190));
		$size=rand(7,10);
		imagefilledellipse($image, $x1+rand(-7, 10), rand(10, $height-5), $size, $size, randColor());
	}
}
for($li=0;$li<$lineInAll;$li++) {
	// drawLine
	imageline($image, rand(-7, $width), rand(10, $height-5), $x2-rand(5,10), rand(10, $height-5), randColor());
}
for($ci=0;$ci<$CircleInAll;$ci++) {
	// drawCircle
	$color=imagecolorallocate($image, rand(0,190), rand(0,190), rand(0,190));
	$size=rand(7,15);
	imagefilledellipse($image, rand(-7, $width-20), rand(10, $height-5), $size, $size, randColor());
}
header("Content-type: image/png");
imagepng($image);
