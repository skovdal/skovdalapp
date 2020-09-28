<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

$configuration_logIdidentities = getSystemConfigurations('logIdidentities');
if($configuration_logIdidentities == -1){
	$validateFlag = 400;
}

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if(isset($_POST['type']) === false){
	$validateFlag = 400;
}
else{
	$type = $_POST['type'];
}

if(isset($_POST['name']) === false){
	$validateFlag = 400;
}
else{
	$name = $_POST['name'];
	if(strlen($name) < 3){
		$validateFlag = 400;
	}
}

if(isset($_POST['name2']) === false){
	$validateFlag = 400;
}
else{
	$name2 = $_POST['name2'];
}

if(isset($_POST['cvrNumber']) === false){
	$validateFlag = 400;
}
else{
	$cvrNumber = $_POST['cvrNumber'];
}

if(isset($_POST['cprNumber']) === false){
	$validateFlag = 400;
}
else{
	$cprNumber = $_POST['cprNumber'];
}

if(isset($_POST['address']) === false){
	$validateFlag = 400;
}
else{
	$address = $_POST['address'];
}

if(isset($_POST['address2']) === false){
	$validateFlag = 400;
}
else{
	$address2 = $_POST['address2'];
}

if(isset($_POST['zipCode']) === false){
	$validateFlag = 400;
}
else{
	$zipCode = $_POST['zipCode'];
}

if(isset($_POST['city']) === false){
	$validateFlag = 400;
}
else{
	$city = $_POST['city'];
}

if(isset($_POST['country']) === false){
	$validateFlag = 400;
}
else{
	$country = $_POST['country'];
}

if(isset($_POST['phone']) === false){
	$validateFlag = 400;
}
else{
	$phone = $_POST['phone'];
}

if(isset($_POST['phone2']) === false){
	$validateFlag = 400;
}
else{
	$phone2 = $_POST['phone2'];
}

if(isset($_POST['email']) === false){
	$validateFlag = 400;
}
else{
	$email = $_POST['email'];
}

if(isset($_POST['email2']) === false){
	$validateFlag = 400;
}
else{
	$email2 = $_POST['email2'];
}

if($validateFlag == 200){
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
		INSERT INTO
			`c0`.`identities`
		(
			`c0`.`identities`.`type`,
			`c0`.`identities`.`name`,
			`c0`.`identities`.`name2`,
			`c0`.`identities`.`cvrNumber`,
			`c0`.`identities`.`cprNumber`,
			`c0`.`identities`.`address`,
			`c0`.`identities`.`address2`,
			`c0`.`identities`.`zipCode`,
			`c0`.`identities`.`city`,
			`c0`.`identities`.`country`,
			`c0`.`identities`.`phone`,
			`c0`.`identities`.`phone2`,
			`c0`.`identities`.`email`,
			`c0`.`identities`.`email2`
		)
		VALUES
		(
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?
		)
	");
	$stmt->bind_param('ssssssssssssss', $type, $name, $name2, $cvrNumber, $cprNumber, $address, $address2, $zipCode, $city, $country, $phone, $phone2, $email, $email2);
	$stmt->execute();
	$identities_id = mysqli_insert_id($con);
	setTableVersion('identities');

	foreach($_POST as $postName => $postValue){
		if(substr($postName, 0, 9) == 'tag-name-'){
			$tagId = str_replace('tag-name-', '', $postName);
			$name = $_POST['tag-name-' . $tagId];
			$borderColor = $_POST['tag-borderColor-' . $tagId];
			$backgroundColor = $_POST['tag-backgroundColor-' . $tagId];
			$fontColor = $_POST['tag-fontColor-' . $tagId];
			
			if(isset($con) === false){$con = dbConnection();}
			$stmt = $con->stmt_init();
			$stmt->prepare("
				SELECT
					`c0`.`tags`.`id` AS `tags_id`
				FROM
					`c0`.`tags`
				WHERE
					`c0`.`tags`.`name` = ?
					AND
					`c0`.`tags`.`borderColor` = ?
					AND
					`c0`.`tags`.`backgroundColor` = ?
					AND
					`c0`.`tags`.`fontColor` = ?
				LIMIT 1
			");
			$stmt->bind_param('ssss', $name, $borderColor, $backgroundColor, $fontColor);
			$stmt->execute();
			$result = $stmt->get_result();
			
			if(mysqli_num_rows($result) == 0){
				$tags_id = 0;
			}
			else{
				while($row = mysqli_fetch_assoc($result)){
					$tags_id = $row['tags_id'];
				}
			}
			$result->close();
					
			if($tags_id == 0){
				if(isset($con) === false){if(isset($con) === false){$con = dbConnection();}}
				$stmt = $con->stmt_init();
				$stmt->prepare("
					INSERT INTO
						`c0`.`tags`
					(
						`c0`.`tags`.`name`,
						`c0`.`tags`.`borderColor`,
						`c0`.`tags`.`backgroundColor`,
						`c0`.`tags`.`fontColor`
					)
					VALUES
					(
						?,
						?,
						?,
						?
					)
				");
				$stmt->bind_param('ssss', $name, $borderColor, $backgroundColor, $fontColor);
				$stmt->execute();
				$tags_id = mysqli_insert_id($con);
				setTableVersion('tags');
			}
			
			if(isset($con) === false){$con = dbConnection();}
			$stmt = $con->stmt_init();
			$stmt->prepare("
				INSERT INTO
					`s0`.`tagsReferences`
				(
					`s0`.`tagsReferences`.`tags_id`,
					`s0`.`tagsReferences`.`identities_id`
				)
				VALUES
				(
					?,
					?
				)
			");
			$stmt->bind_param('ii', $tags_id, $identities_id);
			$stmt->execute();
			setTableVersion('tagsReferences');
		}
	}
	?>
	<script>
		parent.datatableUpdate('', 'datatable1', 0);
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();
		parent.toastr('success', 'Ny identitet', 'Identiteten blev tilføjet.', 0, true, '');
	</script>
	<?php
	if(getSystemConfigurations('logIdidentities') == 1 || getSystemConfigurations('logIdidentities') == -1){
		$type = 'add';
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
?>
	<script>
		for(var i = 0; i < parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> input[type="text"], #modal-<?php echo purify($modalId); ?> input[type="tel"], #modal-<?php echo purify($modalId); ?> input[type="email"], #modal-<?php echo purify($modalId); ?> input[type="number"]').length; i++){
			parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> input[type="text"], #modal-<?php echo purify($modalId); ?> input[type="tel"], #modal-<?php echo purify($modalId); ?> input[type="email"], #modal-<?php echo purify($modalId); ?> input[type="number"]')[i].readOnly = false;
		}
		
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> input[type="submit"]')[0].disabled = false;
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> input[type="submit"]')[0].value = 'Gem';
		parent.toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?1234-ABCD-5678-EFGH');
	</script>
	<?php
	if(getSystemConfigurations('logIdidentities') == 1 || getSystemConfigurations('logIdidentities') == -1){
		$type = 'add';
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