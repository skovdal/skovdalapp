<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

$preferences_columnsSystemNotifications_columnsType = getSystemPreferences('columnsSystemNotifications_columnsType');
if($preferences_columnsSystemNotifications_columnsType == -1){
	$preferences_columnsSystemNotifications_columnsType = 1;
}

$preferences_columnsSystemNotifications_columnsTitle = getSystemPreferences('columnsSystemNotifications_columnsTitle');
if($preferences_columnsSystemNotifications_columnsTitle == -1){
	$preferences_columnsSystemNotifications_columnsTitle = 1;
}

$preferences_columnsSystemNotifications_columnsMsg = getSystemPreferences('columnsSystemNotifications_columnsMsg');
if($preferences_columnsSystemNotifications_columnsMsg == -1){
	$preferences_columnsSystemNotifications_columnsMsg = 0;
}

$preferences_columnsSystemNotifications_columnsSystemUsers_name = getSystemPreferences('columnsSystemNotifications_columnsSystemUsers_name');
if($preferences_columnsSystemNotifications_columnsSystemUsers_name == -1){
	$preferences_columnsSystemNotifications_columnsSystemUsers_name = 1;
}

$preferences_columnsSystemNotifications_columnsDate = getSystemPreferences('columnsSystemNotifications_columnsDate');
if($preferences_columnsSystemNotifications_columnsDate == -1){
	$preferences_columnsSystemNotifications_columnsDate = 1;
}

$preferences_columnsSystemNotifications_columnsIpAddress = getSystemPreferences('columnsSystemNotifications_columnsIpAddress');
if($preferences_columnsSystemNotifications_columnsIpAddress == -1){
	$preferences_columnsSystemNotifications_columnsIpAddress = 0;
}

$preferences_columnsSystemNotifications_columnsTags = getSystemPreferences('columnsSystemNotifications_columnsTags');
if($preferences_columnsSystemNotifications_columnsTags == -1){
	$preferences_columnsSystemNotifications_columnsTags = 1;
}

if(isset($_POST['searchType']) === false){
	$validateFlag = 400;
}
else{
	$searchType = $_POST['searchType'];
	$searchTypeSql = '%' . $searchType . '%';
}

if(isset($_POST['searchTitle']) === false){
	$validateFlag = 400;
}
else{
	$searchTitle = $_POST['searchTitle'];
	$searchTitleSql = '%' . $searchTitle . '%';
}

if(isset($_POST['searchMsg']) === false){
	$validateFlag = 400;
}
else{
	$searchMsg = $_POST['searchMsg'];
	$searchMsgSql = '%' . $searchMsg . '%';
}

if(isset($_POST['searchSystemUsers_name']) === false){
	$validateFlag = 400;
}
else{
	$searchSystemUsers_name = $_POST['searchSystemUsers_name'];
	$searchSystemUsers_nameSql = '%' . $searchSystemUsers_name . '%';
}

if(isset($_POST['searchDate']) === false){
	$validateFlag = 400;
}
else{
	$searchDate = $_POST['searchDate'];
	$searchDateSql = '%' . $searchDate . '%';
}

if(isset($_POST['searchIpAddress']) === false){
	$validateFlag = 400;
}
else{
	$searchIpAddress = $_POST['searchIpAddress'];
	$searchIpAddressSql = '%' . $searchIpAddress . '%';
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
			`s0`.`tagsReferences`.`systemNotifications_id` AS `tagsReferences_systemNotifications_id`
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
			`s0`.`tagsReferences`.`systemNotifications_id` IS NOT NULL
	");
	$stmt->bind_param('s', $searchTagsSql);
	$stmt->execute();
	$result = $stmt->get_result();
	
	if(mysqli_num_rows($result) == 0){
		$systemNotificationsWithTagsArray = array();
		array_push($systemNotificationsWithTagsArray, -1);
	}
	else{
		$systemNotificationsWithTagsArray = array();
		
		while($row = mysqli_fetch_assoc($result)){
			array_push($systemNotificationsWithTagsArray, $row['tagsReferences_systemNotifications_id']);
		}
	}
	$result->close();
}

function orderBy($request){
	if(isset($_POST['orderBy']) === false){
		$orderBy = '`c0`.`systemNotifications`.`id`';
		$orderBySort = 'DESC';
	}
	else{
		$orderBy = $_POST['orderBy'];
		if($orderBy == 'Type'){
			$orderBy = '`c0`.`systemNotifications`.`type`';
		}
		else if($orderBy == 'Title'){
			$orderBy = '`c0`.`systemNotifications`.`title`';
		}
		else if($orderBy == 'Msg'){
			$orderBy = '`c0`.`systemNotifications`.`msg`';
		}
		else if($orderBy == 'SystemUsers_name'){
			$orderBy = '`c0`.`systemUsers`.`name`';
		}
		else if($orderBy == 'Date'){
			$orderBy = '`c0`.`systemNotifications`.`date`';
		}
		else if($orderBy == 'IpAddress'){
			$orderBy = '`c0`.`systemNotifications`.`ipAddress`';
		}
		else if($orderBy == 'Tags'){
			$orderBy = '`c0`.`systemNotifications`.`title`';
		}
		else{
			$orderBy = '`c0`.`systemNotifications`.`date`';
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

function getTags($systemNotifications_id){
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
				`s0`.`tagsReferences`.`systemNotifications_id` = ?
			ORDER BY
				`c0`.`tags`.`name` " . orderBy('orderBySort') . "
		");
		$stmt->bind_param('i', $systemNotifications_id);
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
	
	if($searchTypeSql == '%%' && $searchTitleSql == '%%' && $searchMsgSql == '%%' && $searchSystemUsers_nameSql == '%%' && $searchDateSql == '%%' && $searchIpAddressSql == '%%' && $searchTagsSql == '%%'){
		$stmt->prepare("
			SELECT
				`c0`.`systemNotifications`.`id` AS `systemNotifications_id`,
				`c0`.`systemNotifications`.`type` AS `systemNotifications_type`,
				`c0`.`systemNotifications`.`title` AS `systemNotifications_title`,
				`c0`.`systemNotifications`.`msg` AS `systemNotifications_msg`,
				DATE_FORMAT(`c0`.`systemNotifications`.`date`, '%d-%m-%Y %H:%i:%s') AS `systemNotifications_date`,
				`c0`.`systemNotifications`.`ipAddress` AS `systemNotifications_ipAddress`,
				`c0`.`systemUsers`.`name` AS `systemUsers_name`
			FROM
				`c0`.`systemNotifications`
			INNER JOIN
				`c0`.`systemUsers`
			ON
				`c0`.`systemNotifications`.`systemUsers_id` = `c0`.`systemUsers`.`id`
			ORDER BY
				" . orderBy('orderBy') . " " . orderBy('orderBySort') . "
		");
	}
	else{
		if(count($systemNotificationsWithTagsArray) > 0){
			$stmt->prepare("
				SELECT
					`c0`.`systemNotifications`.`id` AS `systemNotifications_id`,
					`c0`.`systemNotifications`.`type` AS `systemNotifications_type`,
					`c0`.`systemNotifications`.`title` AS `systemNotifications_title`,
					`c0`.`systemNotifications`.`msg` AS `systemNotifications_msg`,
					DATE_FORMAT(`c0`.`systemNotifications`.`date`, '%d-%m-%Y %H:%i:%s') AS `systemNotifications_date`,
					`c0`.`systemNotifications`.`ipAddress` AS `systemNotifications_ipAddress`,
					`c0`.`systemUsers`.`name` AS `systemUsers_name`
				FROM
					`c0`.`systemNotifications`
				INNER JOIN
					`c0`.`systemUsers`
				ON
					`c0`.`systemNotifications`.`systemUsers_id` = `c0`.`systemUsers`.`id`
				WHERE
					`c0`.`systemNotifications`.`type` LIKE ?
					AND
					`c0`.`systemNotifications`.`title` LIKE ?
					AND
					`c0`.`systemNotifications`.`msg` LIKE ?
					AND
					`c0`.`systemNotifications`.`date` LIKE ?
					AND
					`c0`.`systemNotifications`.`ipAddress` LIKE ?
					AND
					`c0`.`systemUsers`.`name` LIKE ?
					AND
					`c0`.`systemNotifications`.`id` IN (" . implode(',', array_map('intval', $systemNotificationsWithTagsArray)) . ")
				ORDER BY
					" . orderBy('orderBy') . " " . orderBy('orderBySort') . "
			");
			$stmt->bind_param('ssssss', $searchTypeSql, $searchTitleSql, $searchMsgSql, $searchSystemUsers_nameSql, $searchDateSql, $searchIpAddressSql);
		}
		else{
			$stmt->prepare("
				SELECT
					`c0`.`systemNotifications`.`id` AS `systemNotifications_id`,
					`c0`.`systemNotifications`.`type` AS `systemNotifications_type`,
					`c0`.`systemNotifications`.`title` AS `systemNotifications_title`,
					`c0`.`systemNotifications`.`msg` AS `systemNotifications_msg`,
					DATE_FORMAT(`c0`.`systemNotifications`.`date`, '%d-%m-%Y %H:%i:%s') AS `systemNotifications_date`,
					`c0`.`systemNotifications`.`ipAddress` AS `systemNotifications_ipAddress`,
					`c0`.`systemUsers`.`name` AS `systemUsers_name`
				FROM
					`c0`.`systemNotifications`
				INNER JOIN
					`c0`.`systemUsers`
				ON
					`c0`.`systemNotifications`.`systemUsers_id` = `c0`.`systemUsers`.`id`
				WHERE
					`c0`.`systemNotifications`.`type` LIKE ?
					AND
					`c0`.`systemNotifications`.`title` LIKE ?
					AND
					`c0`.`systemNotifications`.`msg` LIKE ?
					AND
					`c0`.`systemNotifications`.`date` LIKE ?
					AND
					`c0`.`systemNotifications`.`ipAddress` LIKE ?
					AND
					`c0`.`systemUsers`.`name` LIKE ?
				ORDER BY
					" . orderBy('orderBy') . " " . orderBy('orderBySort') . "
			");
			$stmt->bind_param('ssssss', $searchTypeSql, $searchTitleSql, $searchMsgSql, $searchSystemUsers_nameSql, $searchDateSql, $searchIpAddressSql);
		}
	}
	
	$stmt->execute();
	$result = $stmt->get_result();
	
	if(mysqli_num_rows($result) == 0){
	?>
		<tr class="datatableInfo">
			<td colspan="100%">
				<input value="<?php echo mysqli_num_rows($result); ?>">
				<input value="<?php echo md5(getTableVersion('systemNotifications') . getTableVersion('systemUsers')); ?>">
			</td>
		</tr>
	<?php
	}
	else{
		?>
		<tr class="datatableInfo">
			<td colspan="100%">
				<input value="<?php echo mysqli_num_rows($result); ?>">
				<input value="<?php echo md5(getTableVersion('systemNotifications') . getTableVersion('systemUsers')); ?>">
			</td>
		</tr>
		<?php
		while($row = mysqli_fetch_assoc($result)){
		?>
			<tr>
				<td class="checkbox unchecked" onclick="datatableCheckbox(this);">
					<input name="systemNotifications_id" type="checkbox" value="<?php echo encodeId(purify($row['systemNotifications_id'])); ?>">
				</td>
				<td onclick="modal(0, 'large', '/systemNotifications/view/modal.php', 'POST', '&systemNotifications_id=<?php echo encodeId(purify($row['systemNotifications_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemNotifications_columnsType == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['systemNotifications_type']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemNotifications/view/modal.php', 'POST', '&systemNotifications_id=<?php echo encodeId(purify($row['systemNotifications_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemNotifications_columnsTitle == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['systemNotifications_title']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemNotifications/view/modal.php', 'POST', '&systemNotifications_id=<?php echo encodeId(purify($row['systemNotifications_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemNotifications_columnsMsg == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['systemNotifications_msg']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemNotifications/view/modal.php', 'POST', '&systemNotifications_id=<?php echo encodeId(purify($row['systemNotifications_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemNotifications_columnsSystemUsers_name == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['systemUsers_name']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemNotifications/view/modal.php', 'POST', '&systemNotifications_id=<?php echo encodeId(purify($row['systemNotifications_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemNotifications_columnsDate == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['systemNotifications_date']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemNotifications/view/modal.php', 'POST', '&systemNotifications_id=<?php echo encodeId(purify($row['systemNotifications_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemNotifications_columnsIpAddress == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['systemNotifications_ipAddress']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemNotifications/view/modal.php', 'POST', '&systemNotifications_id=<?php echo encodeId(purify($row['systemNotifications_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemNotifications_columnsTags == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo getTags($row['systemNotifications_id']);
					?>
				</td>
				<td>
					<div class="nav-btn ellipsis-h" onclick="dropdown(this);">
						<div class="dropdown up right">
							<ul>
								<li onclick="modal(0, 'basic', '/systemNotifications/tagsSingle/add/modal.php', 'POST', '&systemNotifications_id=<?php echo purify($row['systemNotifications_id']); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/tag.svg&fill=rgba(135,140,145,1)');">Tilføj mærke på systemnotifikation</li>
							</ul>
						</div>
					</div>
				</td>
			</tr>
		<?php
		}
	}
	$result->close();
	
	if(getSystemConfigurations('logSystemNotifications') == 1 || getSystemConfigurations('logSystemNotifications') == -1){
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
	if(getSystemConfigurations('logSystemNotifications') == 1 || getSystemConfigurations('logSystemNotifications') == -1){
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