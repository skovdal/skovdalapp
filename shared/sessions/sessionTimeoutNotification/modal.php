<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';
?><h1>Udløb af session</h1>
<span></span>
<br>
<form onsubmit="return false;">
	<div></div>
	<div class="buttons">
		<input onclick="renewSession();" type="submit" value="Forny session">
	</div>
</form>
<div class="countdown"></div><?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php'
?>