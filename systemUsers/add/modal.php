<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if($validateFlag == 200){
?>
	<h1>Ny systembruger</h1>
	<ul>
		<li class="active" onclick="modalTab('<?php echo purify($modalId); ?>', 1);">
			Generelt
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 2);">
			Identitet
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 3);">
			Roller
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 4);">
			Grupper
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 5);">
			Logbog
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 6);">
			Mærker
		</li>
	</ul>
	<form action="/systemUsers/add/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input id="inputName" name="name" oninput="validateInput(this);" pattern=".{3,}" placeholder="Jens Nielsen" type="text" required autofocus><label for="inputName">Navn</label><br>
			<select id="inputSecurityClearance" name="securityClearance" required>
				<option value="1. Til tjenestebrug">1. Til tjenestebrug</option>
				<option value="2. Fortroligt">2. Fortroligt</option>
				<option value="3. Hemmeligt">3. Hemmeligt</option>
				<option value="4. Yderst hemmeligt">4. Yderst hemmeligt</option>
			</select><label for="inputSecurityClearance">Sikkerhedsgodkendelse</label><br>
			<div class="checkbox unchecked" onclick="modalCheckbox(this);"><input id="inputBlockSignIn" name="blockSignIn" type="checkbox" value="1"><label for="inputBlockSignIn">Bloker log ind</label></div><br>
			<div class="checkbox unchecked" onclick="modalCheckbox(this);"><input id="inputUserMustChangePasswordAtNextSignIn" name="userMustChangePasswordAtNextSignIn" type="checkbox" value="1"><label for="inputUserMustChangePasswordAtNextSignIn">Brugeren skal ændre adgangskode ved næste log ind</label></div><br>
			<div class="checkbox unchecked" onclick="modalCheckbox(this);"><input id="inputForceUseOfMultifactorAuthentication" name="forceUseOfMultifactorAuthentication" type="checkbox" value="1"><label for="inputForceUseOfMultifactorAuthentication">Gennemtving brug af flerfaktorautentificering</label></div><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="photo" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/user-circle.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>');"></div>
			<input id="inputEntityId" name="identities_id" type="hidden">
			<input class="photo" id="inputEntityType" type="text" readonly><label>Type</label><br>
			<input class="photo" id="inputEntityName" type="text" readonly><label>Navn</label><br>
			<input class="photo" id="inputEntityName2" type="text" readonly><label>Supplerende navneoplysninger</label><br>
			<input id="inputEntityPhone" type="text" readonly><label>Telefon</label><br>
			<input id="inputEntityEmail" type="text" readonly><label>E-mail</label><br>
			<input class="addContent" onclick="modal(0, 'basic', '/systemUsers/add/entity/associate/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>', true, 1);" type="button" value="Tilknyt identitet" autofocus>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fusers-crown.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					Der er ikke tilføjet nogen roller
				</div>
			</div>
			<input class="addContent" onclick="modal(0, 'basic', '/systemUsers/add/roles/add/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>', true, 1);" type="button" value="Tilføj rolle" autofocus>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fusers-class.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					Der er ikke tilføjet nogen grupper
				</div>
			</div>
			<input class="addContent" onclick="modal(0, 'basic', '/systemUsers/add/groups/add/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>', true, 1);" type="button" value="Tilføj gruppe" autofocus>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fbars.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					Der er ikke registreret nogen hændelser
				</div>
			</div>
		</div>
		
		<div class="tagTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="tagContainer"></div>
			<input class="addTag" onclick="modal(0, 'basic', '/systemUsers/add/tags/add/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>', true, 1);" type="button" value="Tilføj mærke" autofocus>
		</div>
		
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Gem systembruger">
		</div>
	</form>
	<?php
	if(getSystemConfigurations('logSystemUsers') == 1 || getSystemConfigurations('logSystemUsers') == -1){
		$type = 'view';
		$trigger_systemUsers_id = $_SESSION['systemUsers_id'];
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
		$devices_id = null;
		$exports_id = null;
		$filesContent_id = null;
		$filesMetaData_id = null;
		$identities_id = null;
		$meetings_id = null;
		$policies_id = null;
		$processingActivities_id = null;
		$processingActivitiesLegalBasises_id = null;
		$progressTime_id = null;
		$pseudoNames_id = null;
		$sessions_id = null;
		$systemConfigurations_id = null;
		$systemEvents_id = null;
		$systemNotifications_id = null;
		$systemStorages_id = null;
		$systemUsers_id = null;
		$systemUsersSystemPreferences_id = null;
		$tableVersions_id = null;
		$tags_id = null;
		$tagsReferences_id = null;
		
		addSystemEvent(
			$trigger_systemUsers_id,
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
			$fileName,
			$devices_id,
			$exports_id,
			$filesContent_id,
			$filesMetaData_id,
			$identities_id,
			$meetings_id,
			$policies_id,
			$processingActivities_id,
			$processingActivitiesLegalBasises_id,
			$progressTime_id,
			$pseudoNames_id,
			$sessions_id,
			$systemConfigurations_id,
			$systemEvents_id,
			$systemNotifications_id,
			$systemStorages_id,
			$systemUsers_id,
			$systemUsersSystemPreferences_id,
			$tableVersions_id,
			$tags_id,
			$tagsReferences_id
		);
	}
}
else{
	if(getSystemConfigurations('logSystemUsers') == 1 || getSystemConfigurations('logSystemUsers') == -1){
		$type = 'view';
		$trigger_systemUsers_id = $_SESSION['systemUsers_id'];
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
		$devices_id = null;
		$exports_id = null;
		$filesContent_id = null;
		$filesMetaData_id = null;
		$identities_id = null;
		$meetings_id = null;
		$policies_id = null;
		$processingActivities_id = null;
		$processingActivitiesLegalBasises_id = null;
		$progressTime_id = null;
		$pseudoNames_id = null;
		$sessions_id = null;
		$systemConfigurations_id = null;
		$systemEvents_id = null;
		$systemNotifications_id = null;
		$systemStorages_id = null;
		$systemUsers_id = null;
		$systemUsersSystemPreferences_id = null;
		$tableVersions_id = null;
		$tags_id = null;
		$tagsReferences_id = null;
		
		addSystemEvent(
			$trigger_systemUsers_id,
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
			$fileName,
			$devices_id,
			$exports_id,
			$filesContent_id,
			$filesMetaData_id,
			$identities_id,
			$meetings_id,
			$policies_id,
			$processingActivities_id,
			$processingActivitiesLegalBasises_id,
			$progressTime_id,
			$pseudoNames_id,
			$sessions_id,
			$systemConfigurations_id,
			$systemEvents_id,
			$systemNotifications_id,
			$systemStorages_id,
			$systemUsers_id,
			$systemUsersSystemPreferences_id,
			$tableVersions_id,
			$tags_id,
			$tagsReferences_id
		);
	}
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>