<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/measurements/storageSize.php';

$validateFlag = 200;

$preferences_columnsFiles_columnsType = getSystemPreferences('columnsFiles_columnsType');
if($preferences_columnsFiles_columnsType == -1){
	$preferences_columnsFiles_columnsType = 1;
}

$preferences_columnsFiles_columnsName = getSystemPreferences('columnsFiles_columnsName');
if($preferences_columnsFiles_columnsName == -1){
	$preferences_columnsFiles_columnsName = 1;
}

$preferences_columnsFiles_columnsSize = getSystemPreferences('columnsFiles_columnsSize');
if($preferences_columnsFiles_columnsSize == -1){
	$preferences_columnsFiles_columnsSize = 1;
}

$preferences_columnsFiles_columnsLastModified = getSystemPreferences('columnsFiles_columnsLastModified');
if($preferences_columnsFiles_columnsLastModified == -1){
	$preferences_columnsFiles_columnsLastModified = 0;
}

$preferences_columnsFiles_columnsTags = getSystemPreferences('columnsFiles_columnsTags');
if($preferences_columnsFiles_columnsTags == -1){
	$preferences_columnsFiles_columnsTags = 1;
}

if(isset($_POST['searchType']) === false){
	$validateFlag = 400;
}
else{
	$searchType = $_POST['searchType'];
	$searchTypeSql = '%' . $searchType . '%';
}

if(isset($_POST['searchName']) === false){
	$validateFlag = 400;
}
else{
	$searchName = $_POST['searchName'];
	$searchNameSql = '%' . $searchName . '%';
}

if(isset($_POST['searchSize']) === false){
	$validateFlag = 400;
}
else{
	$searchSize = $_POST['searchSize'];
	$searchSizeSql = '%' . $searchSize . '%';
}

if(isset($_POST['searchLastModified']) === false){
	$validateFlag = 400;
}
else{
	$searchLastModified = $_POST['searchLastModified'];
	$searchLastModifiedSql = '%' . $searchLastModified . '%';
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
			`s0`.`tagsReferences`.`files_id` AS `tagsReferences_files_id`
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
			`s0`.`tagsReferences`.`files_id` IS NOT NULL
	");
	$stmt->bind_param('s', $searchTagsSql);
	$stmt->execute();
	$result = $stmt->get_result();
	
	if(mysqli_num_rows($result) == 0){
		$filesWithTagsArray = array();
		array_push($filesWithTagsArray, -1);
	}
	else{
		$filesWithTagsArray = array();
		
		while($row = mysqli_fetch_assoc($result)){
			array_push($filesWithTagsArray, $row['tagsReferences_files_id']);
		}
	}
	$result->close();
}

function orderBy($request){
	if(isset($_POST['orderBy']) === false){
		$orderBy = '`c0`.`filesMetaData`.`id`';
		$orderBySort = 'DESC';
	}
	else{
		$orderBy = $_POST['orderBy'];
		if($orderBy == 'Type'){
			$orderBy = '`c0`.`filesMetaData`.`type`';
		}
		else if($orderBy == 'Name'){
			$orderBy = '`c0`.`filesMetaData`.`name`';
		}
		else if($orderBy == 'Size'){
			$orderBy = '`c0`.`filesMetaData`.`size`';
		}
		else if($orderBy == 'LastModified'){
			$orderBy = '`c0`.`filesMetaData`.`lastModified`';
		}
		else if($orderBy == 'Tags'){
			$orderBy = '`c0`.`filesMetaData`.`name`';
		}
		else{
			$orderBy = '`c0`.`filesMetaData`.`name`';
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

function getTags($files_id){
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
				`s0`.`tagsReferences`.`files_id` = ?
			ORDER BY
				`c0`.`tags`.`name` " . orderBy('orderBySort') . "
		");
		$stmt->bind_param('i', $files_id);
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
	
	if($searchTypeSql == '%%' && $searchNameSql == '%%' && $searchSizeSql == '%%' && $searchLastModifiedSql == '%%' && $searchTagsSql == '%%'){
		$stmt->prepare("
			SELECT
				`c0`.`filesMetaData`.`id` AS `files_id`,
				`c0`.`filesMetaData`.`type` AS `files_type`,
				`c0`.`filesMetaData`.`name` AS `files_name`,
				`c0`.`filesMetaData`.`size` AS `files_size`,
				`c0`.`filesMetaData`.`lastModified` AS `files_lastModified`
			FROM
				`c0`.`filesMetaData`
			WHERE
				`c0`.`filesMetaData`.`deleteFlag` IS NULL
				AND
				`c0`.`filesMetaData`.`tempFlag` IS NULL
				AND
				`c0`.`filesMetaData`.`legacyFlag` IS NULL
				AND
				`c0`.`filesMetaData`.`hiddenFlag` IS NULL
			ORDER BY
				" . orderBy('orderBy') . " " . orderBy('orderBySort') . "
		");
	}
	else{
		if(count($filesWithTagsArray) > 0){
			$stmt->prepare("
				SELECT
					`c0`.`filesMetaData`.`id` AS `files_id`,
					`c0`.`filesMetaData`.`type` AS `files_type`,
					`c0`.`filesMetaData`.`name` AS `files_name`,
					`c0`.`filesMetaData`.`size` AS `files_size`,
					`c0`.`filesMetaData`.`lastModified` AS `files_lastModified`
				FROM
					`c0`.`filesMetaData`
				WHERE
					`c0`.`filesMetaData`.`type` LIKE ?
					AND
					`c0`.`filesMetaData`.`name` LIKE ?
					AND
					`c0`.`filesMetaData`.`size` LIKE ?
					AND
					`c0`.`filesMetaData`.`lastModified` LIKE ?
					AND
					`c0`.`filesMetaData`.`deleteFlag` IS NULL
					AND
					`c0`.`filesMetaData`.`tempFlag` IS NULL
					AND
					`c0`.`filesMetaData`.`legacyFlag` IS NULL
					AND
					`c0`.`filesMetaData`.`hiddenFlag` IS NULL
					AND
					`c0`.`filesMetaData`.`id` IN (" . implode(',', array_map('intval', $filesWithTagsArray)) . ")
				ORDER BY
					" . orderBy('orderBy') . " " . orderBy('orderBySort') . "
			");
			$stmt->bind_param('ssss', $searchTypeSql, $searchNameSql, $searchSizeSql, $searchLastModifiedSql);
		}
		else{
			$stmt->prepare("
				SELECT
					`c0`.`filesMetaData`.`id` AS `files_id`,
					`c0`.`filesMetaData`.`type` AS `files_type`,
					`c0`.`filesMetaData`.`name` AS `files_name`,
					`c0`.`filesMetaData`.`size` AS `files_size`,
					`c0`.`filesMetaData`.`lastModified` AS `files_lastModified`
				FROM
					`c0`.`filesMetaData`
				WHERE
					`c0`.`filesMetaData`.`type` LIKE ?
					AND
					`c0`.`filesMetaData`.`name` LIKE ?
					AND
					`c0`.`filesMetaData`.`size` LIKE ?
					AND
					`c0`.`filesMetaData`.`lastModified` LIKE ?
					AND
					`c0`.`filesMetaData`.`deleteFlag` IS NULL
					AND
					`c0`.`filesMetaData`.`tempFlag` IS NULL
					AND
					`c0`.`filesMetaData`.`legacyFlag` IS NULL
					AND
					`c0`.`filesMetaData`.`hiddenFlag` IS NULL
				ORDER BY
					" . orderBy('orderBy') . " " . orderBy('orderBySort') . "
			");
			$stmt->bind_param('ssss', $searchTypeSql, $searchNameSql, $searchSizeSql, $searchLastModifiedSql);
		}
	}
	
	$stmt->execute();
	$result = $stmt->get_result();
	
	if(mysqli_num_rows($result) == 0){
	?>
		<tr class="datatableInfo">
			<td colspan="100%">
				<input value="<?php echo mysqli_num_rows($result); ?>">
				<input value="<?php echo getTableVersion('filesMetaData'); ?>">
				<input value="filesMetaData">
			</td>
		</tr>
	<?php
	}
	else{
		?>
		<tr class="datatableInfo">
			<td colspan="100%">
				<input value="<?php echo mysqli_num_rows($result); ?>">
				<input value="<?php echo getTableVersion('filesMetaData'); ?>">
				<input value="filesMetaData">
			</td>
		</tr>
		<?php
		while($row = mysqli_fetch_assoc($result)){
		?>
			<tr>
				<td class="checkbox unchecked" onclick="datatableCheckbox(this);">
					<input name="entities_id" type="checkbox" value="<?php echo encodeId(purify($row['files_id'])); ?>">
				</td>
				<td onclick="modal(0, 'large', '/files/view/modal.php', 'POST', '&files_id=<?php echo encodeId(purify($row['files_id'])); ?>', true, 1);" style="<?php if($preferences_columnsFiles_columnsType == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['files_type']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/files/view/modal.php', 'POST', '&files_id=<?php echo encodeId(purify($row['files_id'])); ?>', true, 1);" style="<?php if($preferences_columnsFiles_columnsName == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['files_name']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/files/view/modal.php', 'POST', '&files_id=<?php echo encodeId(purify($row['files_id'])); ?>', true, 1);" style="<?php if($preferences_columnsFiles_columnsSize == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify(storageSize($row['files_size'], 2));
					?>
				</td>
				<td onclick="modal(0, 'large', '/files/view/modal.php', 'POST', '&files_id=<?php echo encodeId(purify($row['files_id'])); ?>', true, 1);" style="<?php if($preferences_columnsFiles_columnsLastModified == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['files_lastModified']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/files/view/modal.php', 'POST', '&files_id=<?php echo encodeId(purify($row['files_id'])); ?>', true, 1);" style="<?php if($preferences_columnsFiles_columnsTags == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo getTags($row['files_id']);
					?>
				</td>
				<td>
					<div class="nav-btn ellipsis-h" onclick="dropdown(this);">
						<div class="dropdown up right">
							<ul>
								<li onclick="modal(0, 'large', '/files/shareSingle/modal.php', 'POST', '&files_id=<?php echo encodeId(purify($row['files_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/share.svg&fill=rgba(135,140,145,1)');">Del fil</li>
								<li onclick="modal(0, 'large', '/files/decryptSingle/modal.php', 'POST', '&files_id=<?php echo encodeId(purify($row['files_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/eye.svg&fill=rgba(135,140,145,1)');">Dekrypter fil</li>
								<li onclick="modal(0, 'large', '/files/downloadSingle/modal.php', 'POST', '&files_id=<?php echo encodeId(purify($row['files_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/file-download.svg&fill=rgba(135,140,145,1)');">Download fil</li>
								<li onclick="modal(0, 'large', '/files/copySingle/modal.php', 'POST', '&files_id=<?php echo encodeId(purify($row['files_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/copy.svg&fill=rgba(135,140,145,1)');">Kopier fil til ny fil</li>
								<li onclick="modal(0, 'large', '/files/encryptSingle/modal.php', 'POST', '&files_id=<?php echo encodeId(purify($row['files_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/eye-slash.svg&fill=rgba(135,140,145,1)');">Krypter fil</li>
								<li onclick="modal(0, 'large', '/files/lockSingle/modal.php', 'POST', '&files_id=<?php echo encodeId(purify($row['files_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/lock.svg&fill=rgba(135,140,145,1)');">Lås fil</li>
								<li onclick="modal(0, 'large', '/files/unlockSingle/modal.php', 'POST', '&files_id=<?php echo encodeId(purify($row['files_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/unlock.svg&fill=rgba(135,140,145,1)');">Lås fil op</li>
								<li onclick="modal(0, 'basic', '/files/tagsSingle/add/modal.php', 'POST', '&files_id=<?php echo encodeId(purify($row['files_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/tag.svg&fill=rgba(135,140,145,1)');">Tilføj mærke på fil</li>
								<li onclick="modal(0, 'basic', '/files/deleteSingle/modal.php', 'POST', '&files_id=<?php echo encodeId(purify($row['files_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/trash-alt.svg&fill=rgba(135,140,145,1)');">Slet fil</li>
							</ul>
						</div>
					</div>
				</td>
			</tr>
		<?php
		}
	}
	$result->close();
	
	if(getSystemConfigurations('logFiles') == 1 || getSystemConfigurations('logFiles') == -1){
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
	if(getSystemConfigurations('logFiles') == 1 || getSystemConfigurations('logFiles') == -1){
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