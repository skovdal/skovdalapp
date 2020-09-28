<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

$preferences_newEntityIdidentities_newEntityType = getSystemPreferences('newEntityIdidentities_newEntityType');
if($preferences_newEntityIdidentities_newEntityType == -1){
	$validateFlag = 400;
}

$preferences_newEntityIdidentities_newEntityPreEnteredCvrNumber = getSystemPreferences('newEntityIdidentities_newEntityPreEnteredCvrNumber');
if($preferences_newEntityIdidentities_newEntityPreEnteredCvrNumber == -1){
	$validateFlag = 400;
}

if($validateFlag == 200){
?>
	<h1>Ny identitet</h1>
	<ul>
		<li class="active" onclick="modalTab('<?php echo purify($modalId); ?>', 1);">
			Generelt
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 2);">
			Adresse
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 3);">
			Kontakt
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 4);">
			Mærker
		</li>
	</ul>
	<form action="/identities/add/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="photo" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/user-circle.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>');"></div>
			<select class="photo" id="inputType" name="type" autofocus required>
				<option value="Fysisk person" <?php if($preferences_newEntityIdidentities_newEntityType == 'Fysisk person'){echo 'selected';} ?>>Fysisk person</option>
				<option value="Juridisk person" <?php if($preferences_newEntityIdidentities_newEntityType == 'Juridisk person'){echo 'selected';} ?>>Juridisk person</option>
				<option value="Offentlig myndighed" <?php if($preferences_newEntityIdidentities_newEntityType == 'Offentlig myndighed'){echo 'selected';} ?>>Offentlig myndighed</option>
				<option value="Anden type" <?php if($preferences_newEntityIdidentities_newEntityType == 'Anden type'){echo 'selected';} ?>>Anden type</option>
			</select><label for="inputType">Type</label><br>
			<input class="photo" id="inputName" name="name" pattern=".{3,}" placeholder="Jens Nielsen" type="text" required><label for="inputName">Navn</label><br>
			<input class="photo" id="inputName2" name="name2" pattern=".{3,}" placeholder="Økonomiafdelingen" type="text"><label for="inputName2">Supplerende navneoplysninger</label><br>
			<input id="inputCvrNumber"  name="cvrNumber" pattern="[0-9]{8}" placeholder="12345678" type="text" value="<?php echo purify($preferences_newEntityIdidentities_newEntityPreEnteredCvrNumber); ?>"><label for="inputCvrNumber">CVR-nummer</label><br>
			<input id="inputCprNumber"  name="cprNumber" pattern="[0-9]{2}[0,1][0-9][0-9]{2}-[0-9]{4}" placeholder="010203-1234" type="text"><label for="inputCprNumber">CPR-nummer</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input id="inputDawaAddress" list="dawaAddressList" name="dawaAddress" oninput="dawa(this, '#inputAddress', '#inputAddress2', '#inputZipCode', '#inputCity', '#inputCountry');" pattern=".{3,}" placeholder="Rødkælkevej 3, Hadbjerg, 8370 Hadsten" type="text" autofocus><label for="inputDawaAddress">DAWA-adresse</label>
			<datalist id="dawaAddressList"></datalist>
			<br>
			<input id="inputAddress" name="address" pattern=".{3,}" placeholder="Rødkælkevej 3" type="text"><label for="inputAddress">Adresse</label><br>
			<input id="inputAddress2" name="address2" pattern=".{3,}" placeholder="Hadbjerg" type="text"><label for="inputAddress2">Supplerende adresseoplysninger</label><br>
			<input id="inputZipCode" name="zipCode" pattern="[0-9]{4}" placeholder="8000" type="text"><label for="inputZipCode">Postnummer</label><br>
			<input id="inputCity" name="city" pattern=".{3,}" placeholder="Aarhus" type="text"><label for="inputCity">By</label><br>
			
			<select id="inputCountry" name="country">
				<option value="DK">Danmark</option>
				<option value="SE">Sverige</option>
				<option value="">Ikke relevant</option>
			</select><label for="inputCountry">Land</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input id="inputPhone"  name="phone" pattern=".{3,}" placeholder="+45 12 34 56 78" type="text" autofocus><label for="inputPhone">Telefon</label><br>
			<input id="inputPhone2"  name="phone2" pattern=".{3,}" placeholder="+45 23 45 67 89" type="text"><label for="inputPhone2">Sekundær telefon</label><br>
			<input id="inputEmail"  name="email" placeholder="navn@efternavn.dk" type="email"><label for="inputEmail">E-mail</label><br>
			<input id="inputEmail2"  name="email2" placeholder="efternavn@navn.dk" type="email"><label for="inputEmail2">Sekundær e-mail</label><br>
		</div>
		
		<div class="tagTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="tagContainer"></div>
			<input class="addTag" onclick="modal(0, 'basic', '/identities/add/tags/add/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>', true, 1);" type="button" value="Tilføj mærke" autofocus>
		</div>
		
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Gem identitet">
		</div>
	</form>
	<?php
	if(getSystemConfigurations('logIdidentities') == 1 || getSystemConfigurations('logIdidentities') == -1){
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
	if(getSystemConfigurations('logIdidentities') == 1 || getSystemConfigurations('logIdidentities') == -1){
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