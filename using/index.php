<?php
// Max Base
// https://github.com/BaseMax/PHPNiceCaptcha

// Please change captcha.php links to your captcha php files...
session_start();
if(isset($_POST["submit"])) {
	print $_SESSION["captcha"]."<br>";
	print $_POST["code"]."<br>";
}
?>
<img id="image" src="captcha.php">
<button id="refresh" onclick="document.querySelector('#image').src='captcha.php';">Refresh</button>
<form action="" method="POST">
  <input type="text" name="code">
  <button name="submit">send</button>
</form>
