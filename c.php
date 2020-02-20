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
	imagecolorallocate($image, 50,10,5),
];
imagerectangle($image, 0, 0, rand(40, 190), rand(40, 60), $colors[0]);
//////////////////////////////////////////
header('Content-type: image/png');
imagepng($image);
