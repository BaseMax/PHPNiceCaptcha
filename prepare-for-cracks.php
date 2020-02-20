<?php
// $debug should be true in c.php file...
function string($input, $length = 5) {
	$lengths = strlen($input);
	$output = "";
	for($i = 0; $i < $length; $i++) {
		$output .= $input[mt_rand(0, $lengths - 1)];
	}
	return $output;
}
for($i=1;$i<=500;$i++) {
	print $i."\n";
	$code=string("123456789",4);
	file_put_contents("for-crack/$code.png", file_get_contents("http://localhost/c.php?code=".$code));
}
