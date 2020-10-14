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
	<h1>Tilknyt identitet</h1>
	<form>
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<input name="refererModalId" type="hidden" value="<?php echo purify($refererModalId); ?>">
		<div class="contentDatatableTab">
			<div class="contentContainer">
				<?php
									if(isset($con) === false){$con = dbConnection();}
		$stmt = $con->stmt_init();
				$stmt->prepare("
					SELECT
						`c0`.`identities`.`id` AS `identities_id`,
						`c0`.`identities`.`type` AS `identities_type`,
						`c0`.`identities`.`name` AS `identities_name`,
						`c0`.`identities`.`name2` AS `identities_name2`,
						`c0`.`identities`.`phone` AS `identities_phone`,
						`c0`.`identities`.`email` AS `identities_email`,
						`c0`.`identities`.`photo_filesMetaData_id` AS `identities_photo_filesMetaData_id`
					FROM
						`c0`.`identities`
					WHERE
						`c0`.`identities`.`deleteFlag` IS NULL
						AND
						`c0`.`identities`.`tempFlag` IS NULL
						AND
						`c0`.`identities`.`legacyFlag` IS NULL
					ORDER BY
						`c0`.`identities`.`name` ASC
				");
				$stmt->execute();
				$result = $stmt->get_result();
				
				if(mysqli_num_rows($result) == 0){
				?>
					<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fusers.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
						Der er ikke tilføjet nogen identiteter
					</div>
				<?php
				}
				else{
				?>
					<table>
						<?php
						while($row = mysqli_fetch_assoc($result)){
						?>
							<tr>
								<td class="photo" onclick="
									document.querySelectorAll('#modal-<?php echo purify($refererModalId); ?> #inputEntityId')[0].value = '<?php echo encodeId(purify($row['identities_id'])); ?>';
									document.querySelectorAll('#modal-<?php echo purify($refererModalId); ?> #inputEntityType')[0].value = '<?php echo purify($row['identities_type']); ?>';
									document.querySelectorAll('#modal-<?php echo purify($refererModalId); ?> #inputEntityName')[0].value = '<?php echo purify($row['identities_name']); ?>';
									document.querySelectorAll('#modal-<?php echo purify($refererModalId); ?> #inputEntityName2')[0].value = '<?php echo purify($row['identities_name2']); ?>';
									document.querySelectorAll('#modal-<?php echo purify($refererModalId); ?> #inputEntityPhone')[0].value = '<?php echo purify($row['identities_phone']); ?>';
									document.querySelectorAll('#modal-<?php echo purify($refererModalId); ?> #inputEntityEmail')[0].value = '<?php echo purify($row['identities_email']); ?>';
									document.querySelectorAll('#modal-<?php echo purify($refererModalId); ?> #inputEntityEmail')[0].value = '<?php echo purify($row['identities_email']); ?>';
									<?php
									if($row['identities_photo_filesMetaData_id'] === null){
									?>
										document.querySelectorAll('#modal-<?php echo purify($refererModalId); ?> form > div > div.photo')[0].style.backgroundImage = 'url(\'/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/user-circle.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>\')';
									<?php
									}
									else{
									?>
										document.querySelectorAll('#modal-<?php echo purify($refererModalId); ?> form > div > div.photo')[0].style.backgroundImage = 'url(\'<?php echo '/serve/photo.php?id=' . encodeId(purify($row['identities_photo_filesMetaData_id'])); ?>\')';
									<?php
									}
									?>
									document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();
									">
									<div class="photo" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/user-circle.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>');"></div>
									<?php
									if($row['identities_photo_filesMetaData_id'] === null){
									?>
										<div class="photo" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/user-circle.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>');"></div>
									<?php
									}
									else{
									?>
										<div class="photo" style="background-image:url('<?php echo '/serve/photo.php?id=' . encodeId(purify($row['identities_photo_filesMetaData_id'])); ?>');"></div>
									<?php
									}
									echo purify($row['identities_name']);
									?>
								</td>
							</tr>
						<?php
						}
						?>
					</table>
				<?php
				}
				$result->close();
							?>
			</div>
		</div>
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk">
		</div>
	</form>
	<?php
	if(getSystemConfigurations('logSystemStorages') == 1 || getSystemConfigurations('logSystemStorages') == -1){
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
	if(getSystemConfigurations('logSystemStorages') == 1 || getSystemConfigurations('logSystemStorages') == -1){
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