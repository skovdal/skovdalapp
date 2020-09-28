<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';
?><h1>Ugyldig session</h1>
<span>Din session er ugyldig.<br><br>Log på for at genoptage arbejdet.<br></span>
<br>
<form onsubmit="return false;">
	<div></div>
	<div class="buttons">
		<input onclick="renewSession();" type="submit" value="Log på">
	</div>
</form><?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>