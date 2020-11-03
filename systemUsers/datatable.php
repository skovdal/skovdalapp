<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

$preferences_columnsSystemUsers_columnsName = getSystemPreferences('columnsSystemUsers_columnsName');
if($preferences_columnsSystemUsers_columnsName == -1){
	$preferences_columnsSystemUsers_columnsName = 1;
}

$preferences_columnsSystemUsers_columnsSecurityClearance = getSystemPreferences('columnsSystemUsers_columnsSecurityClearance');
if($preferences_columnsSystemUsers_columnsSecurityClearance == -1){
	$preferences_columnsSystemUsers_columnsSecurityClearance = 0;
}

$preferences_columnsSystemUsers_columnsBlockSignIn = getSystemPreferences('columnsSystemUsers_columnsBlockSignIn');
if($preferences_columnsSystemUsers_columnsBlockSignIn == -1){
	$preferences_columnsSystemUsers_columnsBlockSignIn = 1;
}

$preferences_columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn = getSystemPreferences('columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn');
if($preferences_columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn == -1){
	$preferences_columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn = 0;
}

$preferences_columnsSystemUsers_columnsForceUseOfMultifactorAuthentication = getSystemPreferences('columnsSystemUsers_columnsForceUseOfMultifactorAuthentication');
if($preferences_columnsSystemUsers_columnsForceUseOfMultifactorAuthentication == -1){
	$preferences_columnsSystemUsers_columnsForceUseOfMultifactorAuthentication = 0;
}

$preferences_columnsSystemUsers_columnsEntityType = getSystemPreferences('columnsSystemUsers_columnsEntityType');
if($preferences_columnsSystemUsers_columnsEntityType == -1){
	$preferences_columnsSystemUsers_columnsEntityType = 0;
}

$preferences_columnsSystemUsers_columnsEntityName = getSystemPreferences('columnsSystemUsers_columnsEntityName');
if($preferences_columnsSystemUsers_columnsEntityName == -1){
	$preferences_columnsSystemUsers_columnsEntityName = 1;
}

$preferences_columnsSystemUsers_columnsEntityName2 = getSystemPreferences('columnsSystemUsers_columnsEntityName2');
if($preferences_columnsSystemUsers_columnsEntityName2 == -1){
	$preferences_columnsSystemUsers_columnsEntityName2 = 0;
}

$preferences_columnsSystemUsers_columnsEntityPhone = getSystemPreferences('columnsSystemUsers_columnsEntityPhone');
if($preferences_columnsSystemUsers_columnsEntityPhone == -1){
	$preferences_columnsSystemUsers_columnsEntityPhone = 0;
}

$preferences_columnsSystemUsers_columnsEntityEmail = getSystemPreferences('columnsSystemUsers_columnsEntityEmail');
if($preferences_columnsSystemUsers_columnsEntityEmail == -1){
	$preferences_columnsSystemUsers_columnsEntityEmail = 0;
}

$preferences_columnsSystemUsers_columnsTags = getSystemPreferences('columnsSystemUsers_columnsTags');
if($preferences_columnsSystemUsers_columnsTags == -1){
	$preferences_columnsSystemUsers_columnsTags = 1;
}

if(isset($_POST['searchName']) === false){
	$validateFlag = 400;
}
else{
	$searchName = $_POST['searchName'];
	$searchNameSql = '%' . $searchName . '%';
}

if(isset($_POST['searchEntityType']) === false){
	$validateFlag = 400;
}
else{
	$searchEntityType = $_POST['searchEntityType'];
	$searchEntityTypeSql = '%' . $searchEntityType . '%';
}

if(isset($_POST['searchEntityName']) === false){
	$validateFlag = 400;
}
else{
	$searchEntityName = $_POST['searchEntityName'];
	$searchEntityNameSql = '%' . $searchEntityName . '%';
}

if(isset($_POST['searchEntityName2']) === false){
	$validateFlag = 400;
}
else{
	$searchEntityName2 = $_POST['searchEntityName2'];
	$searchEntityName2Sql = '%' . $searchEntityName2 . '%';
}

if(isset($_POST['searchEntityPhone']) === false){
	$validateFlag = 400;
}
else{
	$searchEntityPhone = $_POST['searchEntityPhone'];
	$searchEntityPhoneSql = '%' . $searchEntityPhone . '%';
}

if(isset($_POST['searchEntityEmail']) === false){
	$validateFlag = 400;
}
else{
	$searchEntityEmail = $_POST['searchEntityEmail'];
	$searchEntityEmailSql = '%' . $searchEntityEmail . '%';
}

if(isset($_POST['searchTags']) === false){
	$validateFlag = 400;
}
else{
	$searchTags = $_POST['searchTags'];
	$searchTagsSql = '%' . $searchTags . '%';
}

if($searchTagsSql != '%%'){
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
		SELECT
			`c0`.`tags`.`id` AS `tags_id`,
			`s0`.`tagsReferences`.`id` AS `tagsReferences_id`,
			`s0`.`tagsReferences`.`systemUsers_id` AS `tagsReferences_systemUsers_id`
		FROM
			`c0`.`tags`
		INNER JOIN
			`s0`.`tagsReferences`
		ON
			`c0`.`tags`.`id` = `s0`.`tagsReferences`.`tags_id`
		WHERE
			`c0`.`tags`.`deleteFlag` IS NULL
			AND
			`c0`.`tags`.`tempFlag` IS NULL
			AND
			`c0`.`tags`.`legacyFlag` IS NULL
			AND
			`c0`.`tags`.`name` LIKE ?
			AND
			`s0`.`tagsReferences`.`deleteFlag` IS NULL
			AND
			`s0`.`tagsReferences`.`tempFlag` IS NULL
			AND
			`s0`.`tagsReferences`.`legacyFlag` IS NULL
			AND
			`s0`.`tagsReferences`.`systemUsers_id` IS NOT NULL
	");
	$stmt->bind_param('s', $searchTagsSql);
	$stmt->execute();
	$result = $stmt->get_result();
	
	if(mysqli_num_rows($result) == 0){
		$systemUsersWithTagsArray = array();
		array_push($systemUsersWithTagsArray, -1);
	}
	else{
		$systemUsersWithTagsArray = array();
		
		while($row = mysqli_fetch_assoc($result)){
			array_push($systemUsersWithTagsArray, $row['tagsReferences_systemUsers_id']);
		}
	}
	$result->close();
}

function orderBy($request){
	if(isset($_POST['orderBy']) === false){
		$orderBy = '`c0`.`systemUsers`.`id`';
		$orderBySort = 'DESC';
	}
	else{
		$orderBy = $_POST['orderBy'];
		if($orderBy == 'Name'){
			$orderBy = '`c0`.`systemUsers`.`name`';
		}
		else if($orderBy == 'SecurityClearance'){
			$orderBy = '`c0`.`systemUsers`.`securityClearance`';
		}
		else if($orderBy == 'BlockSignIn'){
			$orderBy = '`c0`.`systemUsers`.`blockSignIn`';
		}
		else if($orderBy == 'UserMustChangePasswordAtNextSignIn'){
			$orderBy = '`c0`.`systemUsers`.`userMustChangePasswordAtNextSignIn`';
		}
		else if($orderBy == 'ForceUseOfMultifactorAuthentication'){
			$orderBy = '`c0`.`systemUsers`.`forceUseOfMultifactorAuthentication`';
		}
		else if($orderBy == 'EntityType'){
			$orderBy = '`c0`.`identities`.`type`';
		}
		else if($orderBy == 'EntityName'){
			$orderBy = '`c0`.`identities`.`name`';
		}
		else if($orderBy == 'EntityName2'){
			$orderBy = '`c0`.`identities`.`name2`';
		}
		else if($orderBy == 'EntityPhone'){
			$orderBy = '`c0`.`identities`.`phone`';
		}
		else if($orderBy == 'EntityEmail'){
			$orderBy = '`c0`.`identities`.`email`';
		}
		else if($orderBy == 'Tags'){
			$orderBy = '`c0`.`systemUsers`.`name`';
		}
		else{
			$orderBy = '`c0`.`systemUsers`.`name`';
		}
		
		$orderBySort = $_POST['orderBySort'];
		if($orderBySort != 'ASC' && $orderBySort != 'DESC'){
			$orderBySort = 'ASC';
		}
	}
	
	if($request == 'orderBy'){
		return $orderBy;
	}
	else if($request == 'orderBySort'){
		return $orderBySort;
	}
}

function getTags($systemUsers_id){
	$validateFlag = 200;
	
	if($validateFlag == 200){
		if(isset($con) === false){$con = dbConnection();}
		$stmt = $con->stmt_init();
		$stmt->prepare("
			SELECT
				`s0`.`tagsReferences`.`id` AS `tagsReferences_id`,
				`c0`.`tags`.`name` AS `tags_name`,
				`c0`.`tags`.`borderColor` AS `tags_borderColor`,
				`c0`.`tags`.`backgroundColor` AS `tags_backgroundColor`,
				`c0`.`tags`.`fontColor` AS `tags_fontColor`
			FROM
				`s0`.`tagsReferences`
			INNER JOIN
				`c0`.`tags`
			ON
				`s0`.`tagsReferences`.`tags_id` = `c0`.`tags`.`id`
			WHERE
				`s0`.`tagsReferences`.`deleteFlag` IS NULL
				AND
				`s0`.`tagsReferences`.`tempFlag` IS NULL
				AND
				`s0`.`tagsReferences`.`legacyFlag` IS NULL
				AND
				`s0`.`tagsReferences`.`systemUsers_id` = ?
			ORDER BY
				`c0`.`tags`.`name` " . orderBy('orderBySort') . "
		");
		$stmt->bind_param('i', $systemUsers_id);
		$stmt->execute();
		$result = $stmt->get_result();
		
		if(mysqli_num_rows($result) == 0){
			$response = '';
		}
		else{
			$response = '';
			
			while($row = mysqli_fetch_assoc($result)){
				$response = $response . '<div class="tag" style="background-color:' . purify($row['tags_backgroundColor']) . '; border:1px solid ' . purify($row['tags_borderColor']) . '; color:' . purify($row['tags_fontColor']) . ';">' . purify($row['tags_name']) . '</div>';
			}
		}
		$result->close();
		
		return $response;
	}
}

if($validateFlag == 200){
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	
	if($searchNameSql == '%%' && $searchEntityTypeSql == '%%' && $searchEntityNameSql == '%%' && $searchEntityName2Sql == '%%' && $searchEntityPhoneSql == '%%' && $searchEntityEmailSql == '%%' && $searchTagsSql == '%%'){
		$stmt->prepare("
			SELECT
				`c0`.`systemUsers`.`id` AS `systemUsers_id`,
				`c0`.`systemUsers`.`name` AS `systemUsers_name`,
				`c0`.`systemUsers`.`securityClearance` AS `systemUsers_securityClearance`,
				`c0`.`systemUsers`.`blockSignIn` AS `systemUsers_blockSignIn`,
				`c0`.`systemUsers`.`userMustChangePasswordAtNextSignIn` AS `systemUsers_userMustChangePasswordAtNextSignIn`,
				`c0`.`systemUsers`.`forceUseOfMultifactorAuthentication` AS `systemUsers_forceUseOfMultifactorAuthentication`,
				`c0`.`identities`.`type` AS `identities_type`,
				`c0`.`identities`.`name` AS `identities_name`,
				`c0`.`identities`.`name2` AS `identities_name2`,
				`c0`.`identities`.`phone` AS `identities_phone`,
				`c0`.`identities`.`email` AS `identities_email`,
				`c0`.`identities`.`photo_filesMetaData_id` AS `identities_photo_filesMetaData_id`
			FROM
				`c0`.`systemUsers`
			INNER JOIN
				`c0`.`identities`
			ON
				`c0`.`systemUsers`.`identities_id` = `c0`.`identities`.`id`
			WHERE
				`c0`.`systemUsers`.`deleteFlag` IS NULL
				AND
				`c0`.`systemUsers`.`tempFlag` IS NULL
				AND
				`c0`.`systemUsers`.`legacyFlag` IS NULL
			ORDER BY
				" . orderBy('orderBy') . " " . orderBy('orderBySort') . "
		");
	}
	else{
		if(count($systemUsersWithTagsArray) > 0){
			$stmt->prepare("
				SELECT
					`c0`.`systemUsers`.`id` AS `systemUsers_id`,
					`c0`.`systemUsers`.`name` AS `systemUsers_name`,
					`c0`.`systemUsers`.`securityClearance` AS `systemUsers_securityClearance`,
					`c0`.`systemUsers`.`blockSignIn` AS `systemUsers_blockSignIn`,
					`c0`.`systemUsers`.`userMustChangePasswordAtNextSignIn` AS `systemUsers_userMustChangePasswordAtNextSignIn`,
					`c0`.`systemUsers`.`forceUseOfMultifactorAuthentication` AS `systemUsers_forceUseOfMultifactorAuthentication`,
					`c0`.`identities`.`type` AS `identities_type`,
					`c0`.`identities`.`name` AS `identities_name`,
					`c0`.`identities`.`name2` AS `identities_name2`,
					`c0`.`identities`.`phone` AS `identities_phone`,
					`c0`.`identities`.`email` AS `identities_email`,
					`c0`.`identities`.`photo_filesMetaData_id` AS `identities_photo_filesMetaData_id`
				FROM
					`c0`.`systemUsers`
				INNER JOIN
					`c0`.`identities`
				ON
					`c0`.`systemUsers`.`identities_id` = `c0`.`identities`.`id`
				WHERE
					`c0`.`systemUsers`.`name` LIKE ?
					AND
					`c0`.`identities`.`type` LIKE ?
					AND
					`c0`.`identities`.`name` LIKE ?
					AND
					`c0`.`identities`.`name2` LIKE ?
					AND
					`c0`.`identities`.`phone` LIKE ?
					AND
					`c0`.`identities`.`email` LIKE ?
					AND
					`c0`.`systemUsers`.`deleteFlag` IS NULL
					AND
					`c0`.`systemUsers`.`tempFlag` IS NULL
					AND
					`c0`.`systemUsers`.`legacyFlag` IS NULL
					AND
					`c0`.`systemUsers`.`id` IN (" . implode(',', array_map('intval', $systemUsersWithTagsArray)) . ")
				ORDER BY
					" . orderBy('orderBy') . " " . orderBy('orderBySort') . "
			");
			$stmt->bind_param('ssssss', $searchNameSql, $searchEntityTypeSql, $searchEntityNameSql, $searchEntityName2Sql, $searchEntityPhoneSql, $searchEntityEmailSql);
		}
		else{
			$stmt->prepare("
				SELECT
					`c0`.`systemUsers`.`id` AS `systemUsers_id`,
					`c0`.`systemUsers`.`name` AS `systemUsers_name`,
					`c0`.`systemUsers`.`securityClearance` AS `systemUsers_securityClearance`,
					`c0`.`systemUsers`.`blockSignIn` AS `systemUsers_blockSignIn`,
					`c0`.`systemUsers`.`userMustChangePasswordAtNextSignIn` AS `systemUsers_userMustChangePasswordAtNextSignIn`,
					`c0`.`systemUsers`.`forceUseOfMultifactorAuthentication` AS `systemUsers_forceUseOfMultifactorAuthentication`,
					`c0`.`identities`.`type` AS `identities_type`,
					`c0`.`identities`.`name` AS `identities_name`,
					`c0`.`identities`.`name2` AS `identities_name2`,
					`c0`.`identities`.`phone` AS `identities_phone`,
					`c0`.`identities`.`email` AS `identities_email`,
					`c0`.`identities`.`photo_filesMetaData_id` AS `identities_photo_filesMetaData_id`
				FROM
					`c0`.`systemUsers`
				INNER JOIN
					`c0`.`identities`
				ON
					`c0`.`systemUsers`.`identities_id` = `c0`.`identities`.`id`
				WHERE
					`c0`.`systemUsers`.`name` LIKE ?
					AND
					`c0`.`identities`.`type` LIKE ?
					AND
					`c0`.`identities`.`name` LIKE ?
					AND
					`c0`.`identities`.`name2` LIKE ?
					AND
					`c0`.`identities`.`phone` LIKE ?
					AND
					`c0`.`identities`.`email` LIKE ?
					AND
					`c0`.`systemUsers`.`deleteFlag` IS NULL
					AND
					`c0`.`systemUsers`.`tempFlag` IS NULL
					AND
					`c0`.`systemUsers`.`legacyFlag` IS NULL
				ORDER BY
					" . orderBy('orderBy') . " " . orderBy('orderBySort') . "
			");
			$stmt->bind_param('ssssss', $searchNameSql, $searchEntityTypeSql, $searchEntityNameSql, $searchEntityName2Sql, $searchEntityPhoneSql, $searchEntityEmailSql);
		}
	}
	
	$stmt->execute();
	$result = $stmt->get_result();
	
	if(mysqli_num_rows($result) == 0){
	?>
		<tr class="datatableInfo">
			<td colspan="100%">
				<input value="<?php echo mysqli_num_rows($result); ?>">
				<input value="<?php echo getTableVersion('systemUsers') . getTableVersion('identities'); ?>">
				<input value="systemUsers,identities">
				<input class="datatableScript" type="hidden" value="alert('test1');">
			</td>
		</tr>
	<?php
	}
	else{
		?>
		<tr class="datatableInfo">
			<td colspan="100%">
				<input value="<?php echo mysqli_num_rows($result); ?>">
				<input value="<?php echo getTableVersion('systemUsers') . getTableVersion('identities'); ?>">
				<input value="systemUsers,identities">
				<input class="datatableScript" type="hidden" value="alert('test2');">
			</td>
		</tr>
		<?php
		while($row = mysqli_fetch_assoc($result)){
		?>
			<tr>
				<td class="checkbox unchecked" onclick="datatableCheckbox(this);">
					<input name="systemUsers_id" type="checkbox" value="<?php echo encodeId(purify($row['systemUsers_id'])); ?>">
				</td>
				<td onclick="modal(0, 'large', '/systemUsers/view/modal.php', 'POST', '&systemUsers_id=<?php echo encodeId(purify($row['systemUsers_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemUsers_columnsName == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['systemUsers_name']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemUsers/view/modal.php', 'POST', '&systemUsers_id=<?php echo encodeId(purify($row['systemUsers_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemUsers_columnsSecurityClearance == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['systemUsers_securityClearance']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemUsers/view/modal.php', 'POST', '&systemUsers_id=<?php echo encodeId(purify($row['systemUsers_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemUsers_columnsBlockSignIn == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					if($row['systemUsers_blockSignIn'] == 1){
						echo 'Ja';
					}
					else{
						echo 'Nej';
					}
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemUsers/view/modal.php', 'POST', '&systemUsers_id=<?php echo encodeId(purify($row['systemUsers_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					if($row['systemUsers_userMustChangePasswordAtNextSignIn'] == 1){
						echo 'Ja';
					}
					else{
						echo 'Nej';
					}
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemUsers/view/modal.php', 'POST', '&systemUsers_id=<?php echo encodeId(purify($row['systemUsers_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemUsers_columnsForceUseOfMultifactorAuthentication == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					if($row['systemUsers_forceUseOfMultifactorAuthentication'] == 1){
						echo 'Ja';
					}
					else{
						echo 'Nej';
					}
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemUsers/view/modal.php', 'POST', '&systemUsers_id=<?php echo encodeId(purify($row['systemUsers_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemUsers_columnsEntityType == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['identities_type']);
					?>
				</td>
				<td class="photo" onclick="modal(0, 'large', '/systemUsers/view/modal.php', 'POST', '&systemUsers_id=<?php echo encodeId(purify($row['systemUsers_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemUsers_columnsEntityName == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
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
				<td onclick="modal(0, 'large', '/systemUsers/view/modal.php', 'POST', '&systemUsers_id=<?php echo encodeId(purify($row['systemUsers_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemUsers_columnsEntityName2 == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['identities_name2']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemUsers/view/modal.php', 'POST', '&systemUsers_id=<?php echo encodeId(purify($row['systemUsers_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemUsers_columnsEntityPhone == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['identities_phone']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemUsers/view/modal.php', 'POST', '&systemUsers_id=<?php echo encodeId(purify($row['systemUsers_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemUsers_columnsEntityEmail == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['identities_email']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemUsers/view/modal.php', 'POST', '&systemUsers_id=<?php echo encodeId(purify($row['systemUsers_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemUsers_columnsTags == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo getTags($row['systemUsers_id']);
					?>
				</td>
				<td>
					<div class="nav-btn ellipsis-h" onclick="dropdown(this);">
						<div class="dropdown up right">
							<ul>
								<li onclick="modal(0, 'large', '/systemUsers/copySingle/modal.php', 'POST', '&systemUsers_id=<?php echo encodeId(purify($row['systemUsers_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/copy.svg&fill=rgba(135,140,145,1)');">Kopier systembruger til ny systembruger</li>
								<li onclick="modal(0, 'basic', '/systemUsers/tagsSingle/add/modal.php', 'POST', '&systemUsers_id=<?php echo encodeId(purify($row['systemUsers_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/tag.svg&fill=rgba(135,140,145,1)');">Tilføj mærke på systembruger</li>
								<li onclick="modal(0, 'basic', '/systemUsers/deleteSingle/modal.php', 'POST', '&systemUsers_id=<?php echo encodeId(purify($row['systemUsers_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/trash-alt.svg&fill=rgba(135,140,145,1)');">Slet systembruger</li>
							</ul>
						</div>
					</div>
				</td>
			</tr>
		<?php
		}
	}
	$result->close();
	
	if(getSystemConfigurations('logSystemUsers') == 1 || getSystemConfigurations('logSystemUsers') == -1){
		$type = 'view';
		$trigger_systemUsers_id = $_SESSION['systemUsers_id'];
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