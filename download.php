<?php
for($i=1;$i<=500;$i++) {
	print $i."\n";
	file_put_contents("sample/image-$i.png", file_get_contents("http://localhost/c.php"));
}
