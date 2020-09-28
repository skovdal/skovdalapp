<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if(isset($_POST['refererModalId']) === false){
	$validateFlag = 400;
}
else{
	$refererModalId = $_POST['refererModalId'];
}

if($validateFlag == 200){
?>
	<h1>Tilføj personoplysning</h1>
	<form action="/processingActivities/add/tags/add/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<input name="refererModalId" type="hidden" value="<?php echo purify($refererModalId); ?>">
		<div>
			Tilføj nedenstående mærke på behandlingsaktiviteten.<br>
			<br>
			<input id="inputName" name="name" pattern=".{3,}" placeholder="Oplysninger om..." type="text" value="<?php echo purify($processingActivities_name); ?>" required autofocus><label for="inputName">Personoplysning</label><br>
			<select id="inputCategory" name="category" required>
				<optgroup label="Almindelige personoplysninger">
					<option value="Navne">Almindelige personoplysninger</option>
				</optgroup>
					<option disabled></option>
				<optgroup label="Fortrolige personoplysninger">
					<option value="Navne">Personnumre</option>
					<option value="Navne">Straffedomme og lovovertrædelser</option>
					<option value="Navne">Øvrige fortrolige personoplysninger</option>
				</optgroup>
					<option disabled></option>
				<optgroup label="Følsomme personoplysninger">
					<option value="Navne">Race</option>
					<option value="Navne">Etnisk oprindelse</option>
					<option value="Navne">Politisk overbevisning</option>
					<option value="Navne">Religiøs overbevisning</option>
					<option value="Navne">Filosofisk overbevisning</option>
					<option value="Navne">Fagforeningsmæssigt tilhørsforhold</option>
					<option value="Navne">Genetiske data</option>
					<option value="Navne">Biometriske data</option>
					<option value="Navne">Helbredsoplysninger</option>
					<option value="Navne">Seksuelle forhold</option>
					<option value="Navne">Seksuelle orientering</option>
				</optgroup>
			</select><label for="inputCategory">Kategori</label><br>
			<input id="inputName" name="name" pattern=".{3,}" placeholder="5 år efter endt ansættelse" type="text" value="<?php echo purify($processingActivities_name); ?>" required><label for="inputName">Opbevaringsperiode</label><br>
			<div class="contentTab noPadding">
				<div class="contentContainer">
					<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fgavel.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
						<br><br><br><br><br><br><br><br><br>Der er ikke tilføjet nogen behandlingshjemler
					</div>
				</div>
			</div>
			<input class="addContent" onclick="modal(0, 'fullWindow', '/processingActivities/add/personalData/add/legalBasis/add/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>&processingActivities_id=<?php echo purify($processingActivities_id); ?>', true, 1);" type="button" value="Tilføj behandlingshjemler">
		</div>
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Tilføj">
		</div>
	</form>
	<?php
	if(getSystemConfigurations('logProcessingActivities') == 1 || getSystemConfigurations('logProcessingActivities') == -1){
		$type = 'view';
		$processingActivities_id = $_SESSION['processingActivities_id'];
		$ipAddress = $_SERVER['REMOTE_ADDR'];
		$startTime = $systemEvents_addEvent_startTime;
		$endTime = microtime(true);
		$finished = 1;
		$host = $_SERVER['SERVER_NAME'];
		$httpVersion = $_SERVER['SERVER_PROTOCOL'];
		$instanceId = session_id();
		$method = $_SERVER['REQUEST_METHOD'];
		$status = $validateFlag;
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		$version = date('YmdHisu', filemtime(__FILE__));
		$postData = json_encode($_POST);
		$getData = json_encode($_GET);
		$httpsEnabled = $_SERVER['HTTPS'];
		$fileName = $_SERVER['SCRIPT_FILENAME'];
		
		addSystemEvent(
			$processingActivities_id,
			$type,
			$ipAddress,
			$startTime,
			$endTime,
			$finished,
			$host,
			$httpVersion,
			$instanceId,
			$method,
			$status,
			$userAgent,
			$version,
			$postData,
			$getData,
			$httpsEnabled,
			$fileName
		);
	}
}
else{
	if(getSystemConfigurations('logProcessingActivities') == 1 || getSystemConfigurations('logProcessingActivities') == -1){
		$type = 'view';
		$processingActivities_id = $_SESSION['processingActivities_id'];
		$ipAddress = $_SERVER['REMOTE_ADDR'];
		$startTime = $systemEvents_addEvent_startTime;
		$endTime = microtime(true);
		$latency = ($endTime - $startTime);
		$finished = 0;
		$host = $_SERVER['SERVER_NAME'];
		$httpVersion = $_SERVER['SERVER_PROTOCOL'];
		$instanceId = session_id();
		$method = $_SERVER['REQUEST_METHOD'];
		$status = $validateFlag;
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		$version = date('YmdHisu', filemtime(__FILE__));
		$postData = json_encode($_POST);
		$getData = json_encode($_GET);
		$httpsEnabled = $_SERVER['HTTPS'];
		$fileName = $_SERVER['SCRIPT_FILENAME'];
		
		addSystemEvent(
			$processingActivities_id,
			$type,
			$ipAddress,
			$startTime,
			$endTime,
			$finished,
			$host,
			$httpVersion,
			$instanceId,
			$method,
			$status,
			$userAgent,
			$version,
			$postData,
			$getData,
			$httpsEnabled,
			$fileName
		);
	}
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>