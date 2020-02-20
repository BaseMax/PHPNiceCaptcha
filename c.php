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
// ABCDEFGHIJKLMNOPQRSTUVWXYZ
$captcha_string = string("0123456789", 4);
$image = imagecreatetruecolor(200, 50);
imageantialias($image, true);
//////////////////////////////////////////
$colors=[
	#16F292, 22,242,146
	imagecolorallocate($image, 22,242,146),
	#b6177b, rgb(182,23,123)
	imagecolorallocate($image, 182,23,123),
	#3a2b00, rgb(58,43,0)
	imagecolorallocate($image, 58,43,0),
	#9f1435, rgb(159,20,53)
	imagecolorallocate($image, 159,20,53),
];
imagerectangle($image, 0, 0, rand(40, 190), rand(40, 60), $colors[0]);
//////////////////////////////////////////
header('Content-type: image/png');
imagepng($image);
