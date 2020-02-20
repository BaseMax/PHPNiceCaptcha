<?php
session_start();
function string($input, $strength = 5) {
	$input_length = strlen($input);
	$random_string = '';
	for($i = 0; $i < $strength; $i++) {
		$random_character = $input[mt_rand(0, $input_length - 1)];
		$random_string .= $random_character;
	}
	return $random_string;
}
$width=200;
$height=50;
$codeLength=4;
$code = string("0123456789", $codeLength);
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
for($i=0;$i<$codeLength;$i++) {
	// print $i * $cHeight."\n";
	// print $i * $cWidth."\n";
	$x1=$i * $cWidth;
	$y1=0;
	$x2=$x1 + $cWidth;
	$y2=$cHeight;
	imagefilledrectangle($image, $x1, $y1, $x2, $y2, $colors[$i]);
}
header('Content-type: image/png');
imagepng($image);
