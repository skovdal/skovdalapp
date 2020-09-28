<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

$preferences_columnsSystemEvents_columnsType = getSystemPreferences('columnsSystemEvents_columnsType');
if($preferences_columnsSystemEvents_columnsType == -1){
	$preferences_columnsSystemEvents_columnsType = 1;
}

$preferences_columnsSystemEvents_columnsIpAddress = getSystemPreferences('columnsSystemEvents_columnsIpAddress');
if($preferences_columnsSystemEvents_columnsIpAddress == -1){
	$preferences_columnsSystemEvents_columnsIpAddress = 1;
}

$preferences_columnsSystemEvents_columnsStartTime = getSystemPreferences('columnsSystemEvents_columnsStartTime');
if($preferences_columnsSystemEvents_columnsStartTime == -1){
	$preferences_columnsSystemEvents_columnsStartTime = 0;
}

$preferences_columnsSystemEvents_columnsEndTime = getSystemPreferences('columnsSystemEvents_columnsEndTime');
if($preferences_columnsSystemEvents_columnsEndTime == -1){
	$preferences_columnsSystemEvents_columnsEndTime = 1;
}

$preferences_columnsSystemEvents_columnsFinished = getSystemPreferences('columnsSystemEvents_columnsFinished');
if($preferences_columnsSystemEvents_columnsFinished == -1){
	$preferences_columnsSystemEvents_columnsFinished = 1;
}

$preferences_columnsSystemEvents_columnsHost = getSystemPreferences('columnsSystemEvents_columnsHost');
if($preferences_columnsSystemEvents_columnsHost == -1){
	$preferences_columnsSystemEvents_columnsHost = 0;
}

$preferences_columnsSystemEvents_columnsHttpVersion = getSystemPreferences('columnsSystemEvents_columnsHttpVersion');
if($preferences_columnsSystemEvents_columnsHttpVersion == -1){
	$preferences_columnsSystemEvents_columnsHttpVersion = 0;
}

$preferences_columnsSystemEvents_columnsInstanceId = getSystemPreferences('columnsSystemEvents_columnsInstanceId');
if($preferences_columnsSystemEvents_columnsInstanceId == -1){
	$preferences_columnsSystemEvents_columnsInstanceId = 0;
}

$preferences_columnsSystemEvents_columnsMethod = getSystemPreferences('columnsSystemEvents_columnsMethod');
if($preferences_columnsSystemEvents_columnsMethod == -1){
	$preferences_columnsSystemEvents_columnsMethod = 0;
}

$preferences_columnsSystemEvents_columnsStatus = getSystemPreferences('columnsSystemEvents_columnsStatus');
if($preferences_columnsSystemEvents_columnsStatus == -1){
	$preferences_columnsSystemEvents_columnsStatus = 0;
}

$preferences_columnsSystemEvents_columnsUserAgent = getSystemPreferences('columnsSystemEvents_columnsUserAgent');
if($preferences_columnsSystemEvents_columnsUserAgent == -1){
	$preferences_columnsSystemEvents_columnsUserAgent = 0;
}

$preferences_columnsSystemEvents_columnsVersion = getSystemPreferences('columnsSystemEvents_columnsVersion');
if($preferences_columnsSystemEvents_columnsVersion == -1){
	$preferences_columnsSystemEvents_columnsVersion = 0;
}

$preferences_columnsSystemEvents_columnsHttpsEnabled = getSystemPreferences('columnsSystemEvents_columnsHttpsEnabled');
if($preferences_columnsSystemEvents_columnsHttpsEnabled == -1){
	$preferences_columnsSystemEvents_columnsHttpsEnabled = 0;
}

$preferences_columnsSystemEvents_columnsFileName = getSystemPreferences('columnsSystemEvents_columnsFileName');
if($preferences_columnsSystemEvents_columnsFileName == -1){
	$preferences_columnsSystemEvents_columnsFileName = 0;
}

$preferences_columnsSystemEvents_columnsTags = getSystemPreferences('columnsSystemEvents_columnsTags');
if($preferences_columnsSystemEvents_columnsTags == -1){
	$preferences_columnsSystemEvents_columnsTags = 1;
}

if(isset($_POST['searchType']) === false){
	$validateFlag = 400;
}
else{
	$searchType = $_POST['searchType'];
	$searchTypeSql = '%' . $searchType . '%';
}

if(isset($_POST['searchIpAddress']) === false){
	$validateFlag = 400;
}
else{
	$searchIpAddress = $_POST['searchIpAddress'];
	$searchIpAddressSql = '%' . $searchIpAddress . '%';
}

if(isset($_POST['searchStartTime']) === false){
	$validateFlag = 400;
}
else{
	$searchStartTime = $_POST['searchStartTime'];
	$searchStartTimeSql = '%' . $searchStartTime . '%';
}

if(isset($_POST['searchEndTime']) === false){
	$validateFlag = 400;
}
else{
	$searchEndTime = $_POST['searchEndTime'];
	$searchEndTimeSql = '%' . $searchEndTime . '%';
}

if(isset($_POST['searchFinished']) === false){
	$validateFlag = 400;
}
else{
	$searchFinished = $_POST['searchFinished'];
	$searchFinishedSql = '%' . $searchFinished . '%';
}

if(isset($_POST['searchHost']) === false){
	$validateFlag = 400;
}
else{
	$searchHost = $_POST['searchHost'];
	$searchHostSql = '%' . $searchHost . '%';
}

if(isset($_POST['searchHttpVersion']) === false){
	$validateFlag = 400;
}
else{
	$searchHttpVersion = $_POST['searchHttpVersion'];
	$searchHttpVersionSql = '%' . $searchHttpVersion . '%';
}

if(isset($_POST['searchInstanceId']) === false){
	$validateFlag = 400;
}
else{
	$searchInstanceId = $_POST['searchInstanceId'];
	$searchInstanceIdSql = '%' . $searchInstanceId . '%';
}

if(isset($_POST['searchMethod']) === false){
	$validateFlag = 400;
}
else{
	$searchMethod = $_POST['searchMethod'];
	$searchMethodSql = '%' . $searchMethod . '%';
}

if(isset($_POST['searchStatus']) === false){
	$validateFlag = 400;
}
else{
	$searchStatus = $_POST['searchStatus'];
	$searchStatusSql = '%' . $searchStatus . '%';
}

if(isset($_POST['searchUserAgent']) === false){
	$validateFlag = 400;
}
else{
	$searchUserAgent = $_POST['searchUserAgent'];
	$searchUserAgentSql = '%' . $searchUserAgent . '%';
}

if(isset($_POST['searchVersion']) === false){
	$validateFlag = 400;
}
else{
	$searchVersion = $_POST['searchVersion'];
	$searchVersionSql = '%' . $searchVersion . '%';
}

if(isset($_POST['searchHttpsEnabled']) === false){
	$validateFlag = 400;
}
else{
	$searchHttpsEnabled = $_POST['searchHttpsEnabled'];
	$searchHttpsEnabledSql = '%' . $searchHttpsEnabled . '%';
}

if(isset($_POST['searchFileName']) === false){
	$validateFlag = 400;
}
else{
	$searchFileName = $_POST['searchFileName'];
	$searchFileNameSql = '%' . $searchFileName . '%';
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
			`s0`.`tagsReferences`.`systemEvents_id` AS `tagsReferences_systemEvents_id`
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
			`s0`.`tagsReferences`.`systemEvents_id` IS NOT NULL
	");
	$stmt->bind_param('s', $searchTagsSql);
	$stmt->execute();
	$result = $stmt->get_result();
	
	if(mysqli_num_rows($result) == 0){
		$systemEventsWithTagsArray = array();
		array_push($systemEventsWithTagsArray, -1);
	}
	else{
		$systemEventsWithTagsArray = array();
		
		while($row = mysqli_fetch_assoc($result)){
			array_push($systemEventsWithTagsArray, $row['tagsReferences_systemEvents_id']);
		}
	}
	$result->close();
}

function orderBy($request){
	if(isset($_POST['orderBy']) === false){
		$orderBy = '`c0`.`systemEvents`.`id`';
		$orderBySort = 'DESC';
	}
	else{
		$orderBy = $_POST['orderBy'];
		if($orderBy == 'Type'){
			$orderBy = '`c0`.`systemEvents`.`type`';
		}
		else if($orderBy == 'IpAddress'){
			$orderBy = '`c0`.`systemEvents`.`ipAddress`';
		}
		else if($orderBy == 'StartTime'){
			$orderBy = '`c0`.`systemEvents`.`startTime`';
		}
		else if($orderBy == 'EndTime'){
			$orderBy = '`c0`.`systemEvents`.`endTime`';
		}
		else if($orderBy == 'Finished'){
			$orderBy = '`c0`.`systemEvents`.`finished`';
		}
		else if($orderBy == 'Host'){
			$orderBy = '`c0`.`systemEvents`.`host`';
		}
		else if($orderBy == 'HttpVersion'){
			$orderBy = '`c0`.`systemEvents`.`httpVersion`';
		}
		else if($orderBy == 'InstanceId'){
			$orderBy = '`c0`.`systemEvents`.`instanceId`';
		}
		else if($orderBy == 'Method'){
			$orderBy = '`c0`.`systemEvents`.`method`';
		}
		else if($orderBy == 'Status'){
			$orderBy = '`c0`.`systemEvents`.`status`';
		}
		else if($orderBy == 'UserAgent'){
			$orderBy = '`c0`.`systemEvents`.`userAgent`';
		}
		else if($orderBy == 'Version'){
			$orderBy = '`c0`.`systemEvents`.`version`';
		}
		else if($orderBy == 'HttpsEnabled'){
			$orderBy = '`c0`.`systemEvents`.`httpsEnabled`';
		}
		else if($orderBy == 'FileName'){
			$orderBy = '`c0`.`systemEvents`.`fileName`';
		}
		else if($orderBy == 'Tags'){
			$orderBy = '`c0`.`systemEvents`.`startTime`';
		}
		else{
			$orderBy = '`c0`.`systemEvents`.`startTime`';
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

function getTags($systemEvents_id){
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
				`s0`.`tagsReferences`.`systemEvents_id` = ?
			ORDER BY
				`c0`.`tags`.`name` " . orderBy('orderBySort') . "
		");
		$stmt->bind_param('i', $systemEvents_id);
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
	
	if($searchTypeSql == '%%' && $searchIpAddressSql == '%%' && $searchStartTimeSql == '%%' && $searchEndTimeSql == '%%' && $searchFinishedSql == '%%' && $searchHostSql == '%%' && $searchHttpVersionSql == '%%' && $searchInstanceIdSql == '%%' && $searchMethodSql == '%%' && $searchStatusSql == '%%' && $searchUserAgentSql == '%%' && $searchVersionSql == '%%' && $searchHttpsEnabledSql == '%%' && $searchFileNameSql == '%%' && $searchTagsSql == '%%'){
		$stmt->prepare("
			SELECT
				`c0`.`systemEvents`.`id` AS `systemEvents_id`,
				`c0`.`systemEvents`.`type` AS `systemEvents_type`,
				`c0`.`systemEvents`.`ipAddress` AS `systemEvents_ipAddress`,
				`c0`.`systemEvents`.`startTime` AS `systemEvents_startTime`,
				`c0`.`systemEvents`.`endTime` AS `systemEvents_endTime`,
				`c0`.`systemEvents`.`finished` AS `systemEvents_finished`,
				`c0`.`systemEvents`.`host` AS `systemEvents_host`,
				`c0`.`systemEvents`.`httpVersion` AS `systemEvents_httpVersion`,
				`c0`.`systemEvents`.`instanceId` AS `systemEvents_instanceId`,
				`c0`.`systemEvents`.`method` AS `systemEvents_method`,
				`c0`.`systemEvents`.`status` AS `systemEvents_status`,
				`c0`.`systemEvents`.`userAgent` AS `systemEvents_userAgent`,
				`c0`.`systemEvents`.`version` AS `systemEvents_version`,
				`c0`.`systemEvents`.`httpsEnabled` AS `systemEvents_httpsEnabled`,
				`c0`.`systemEvents`.`fileName` AS `systemEvents_fileName`,
				`c0`.`systemUsers`.`name` AS `systemUsers_name`
			FROM
				`c0`.`systemEvents`
			INNER JOIN
				`c0`.`systemUsers`
			ON
				`c0`.`systemEvents`.`systemUsers_id` = `c0`.`systemUsers`.`id`
			ORDER BY
				" . orderBy('orderBy') . " " . orderBy('orderBySort') . "
		");
	}
	else{
		if(count($systemEventsWithTagsArray) > 0){
			$stmt->prepare("
				SELECT
					`c0`.`systemEvents`.`id` AS `systemEvents_id`,
					`c0`.`systemEvents`.`type` AS `systemEvents_type`,
					`c0`.`systemEvents`.`ipAddress` AS `systemEvents_ipAddress`,
					`c0`.`systemEvents`.`startTime` AS `systemEvents_startTime`,
					`c0`.`systemEvents`.`endTime` AS `systemEvents_endTime`,
					`c0`.`systemEvents`.`finished` AS `systemEvents_finished`,
					`c0`.`systemEvents`.`host` AS `systemEvents_host`,
					`c0`.`systemEvents`.`httpVersion` AS `systemEvents_httpVersion`,
					`c0`.`systemEvents`.`instanceId` AS `systemEvents_instanceId`,
					`c0`.`systemEvents`.`method` AS `systemEvents_method`,
					`c0`.`systemEvents`.`status` AS `systemEvents_status`,
					`c0`.`systemEvents`.`userAgent` AS `systemEvents_userAgent`,
					`c0`.`systemEvents`.`version` AS `systemEvents_version`,
					`c0`.`systemEvents`.`httpsEnabled` AS `systemEvents_httpsEnabled`,
					`c0`.`systemEvents`.`fileName` AS `systemEvents_fileName`,
					`c0`.`systemUsers`.`name` AS `systemUsers_name`
				FROM
					`c0`.`systemEvents`
				INNER JOIN
					`c0`.`systemUsers`
				ON
					`c0`.`systemEvents`.`systemUsers_id` = `c0`.`systemUsers`.`id`
				WHERE
					`c0`.`systemEvents`.`type` LIKE ?
					AND
					`c0`.`systemEvents`.`ipAddress` LIKE ?
					AND
					`c0`.`systemEvents`.`startTime` LIKE ?
					AND
					`c0`.`systemEvents`.`endTime` LIKE ?
					AND
					`c0`.`systemEvents`.`finished` LIKE ?
					AND
					`c0`.`systemEvents`.`host` LIKE ?
					AND
					`c0`.`systemEvents`.`httpVersion` LIKE ?
					AND
					`c0`.`systemEvents`.`instanceId` LIKE ?
					AND
					`c0`.`systemEvents`.`method` LIKE ?
					AND
					`c0`.`systemEvents`.`status` LIKE ?
					AND
					`c0`.`systemEvents`.`userAgent` LIKE ?
					AND
					`c0`.`systemEvents`.`version` LIKE ?
					AND
					`c0`.`systemEvents`.`httpsEnabled` LIKE ?
					AND
					`c0`.`systemEvents`.`fileName` LIKE ?
					AND
					`c0`.`systemUsers`.`name` LIKE ?
					AND
					`c0`.`systemEvents`.`id` IN (" . implode(',', array_map('intval', $systemEventsWithTagsArray)) . ")
				ORDER BY
					" . orderBy('orderBy') . " " . orderBy('orderBySort') . "
			");
			$stmt->bind_param('sssssssss', $searchTypeSql, $searchIpAddressSql, $searchStartTimeSql, $searchEndTimeSql, $searchFinishedSql, $searchHostSql, $searchHttpVersionSql, $searchInstanceIdSql, $searchMethodSql, $searchStatusSql, $searchUserAgentSql, $searchVersionSql, $searchHttpsEnabledSql, $searchFileNameSql, $searchSystemUsers_name);
		}
		else{
			$stmt->prepare("
				SELECT
					`c0`.`systemEvents`.`id` AS `systemEvents_id`,
					`c0`.`systemEvents`.`type` AS `systemEvents_type`,
					`c0`.`systemEvents`.`ipAddress` AS `systemEvents_ipAddress`,
					`c0`.`systemEvents`.`startTime` AS `systemEvents_startTime`,
					`c0`.`systemEvents`.`endTime` AS `systemEvents_endTime`,
					`c0`.`systemEvents`.`finished` AS `systemEvents_finished`,
					`c0`.`systemEvents`.`host` AS `systemEvents_host`,
					`c0`.`systemEvents`.`httpVersion` AS `systemEvents_httpVersion`,
					`c0`.`systemEvents`.`instanceId` AS `systemEvents_instanceId`,
					`c0`.`systemEvents`.`method` AS `systemEvents_method`,
					`c0`.`systemEvents`.`status` AS `systemEvents_status`,
					`c0`.`systemEvents`.`userAgent` AS `systemEvents_userAgent`,
					`c0`.`systemEvents`.`version` AS `systemEvents_version`,
					`c0`.`systemEvents`.`httpsEnabled` AS `systemEvents_httpsEnabled`,
					`c0`.`systemEvents`.`fileName` AS `systemEvents_fileName`,
					`c0`.`systemUsers`.`name` AS `systemUsers_name`
				FROM
					`c0`.`systemEvents`
				INNER JOIN
					`c0`.`systemUsers`
				ON
					`c0`.`systemEvents`.`systemUsers_id` = `c0`.`systemUsers`.`id`
				WHERE
					`c0`.`systemEvents`.`type` LIKE ?
					AND
					`c0`.`systemEvents`.`ipAddress` LIKE ?
					AND
					`c0`.`systemEvents`.`startTime` LIKE ?
					AND
					`c0`.`systemEvents`.`endTime` LIKE ?
					AND
					`c0`.`systemEvents`.`finished` LIKE ?
					AND
					`c0`.`systemEvents`.`host` LIKE ?
					AND
					`c0`.`systemEvents`.`httpVersion` LIKE ?
					AND
					`c0`.`systemEvents`.`instanceId` LIKE ?
					AND
					`c0`.`systemEvents`.`method` LIKE ?
					AND
					`c0`.`systemEvents`.`status` LIKE ?
					AND
					`c0`.`systemEvents`.`userAgent` LIKE ?
					AND
					`c0`.`systemEvents`.`version` LIKE ?
					AND
					`c0`.`systemEvents`.`httpsEnabled` LIKE ?
					AND
					`c0`.`systemEvents`.`fileName` LIKE ?
					AND
					`c0`.`systemUsers`.`name` LIKE ?
				ORDER BY
					" . orderBy('orderBy') . " " . orderBy('orderBySort') . "
			");
			$stmt->bind_param('sssssssss', $searchTypeSql, $searchIpAddressSql, $searchStartTimeSql, $searchEndTimeSql, $searchFinishedSql, $searchHostSql, $searchHttpVersionSql, $searchInstanceIdSql, $searchMethodSql, $searchStatusSql, $searchUserAgentSql, $searchVersionSql, $searchHttpsEnabledSql, $searchFileNameSql, $searchSystemUsers_name);
		}
	}
	
	$stmt->execute();
	$result = $stmt->get_result();
	
	if(mysqli_num_rows($result) == 0){
	?>
		<tr class="datatableInfo">
			<td colspan="100%">
				<input value="<?php echo mysqli_num_rows($result); ?>">
				<input value="<?php echo getTableVersion('systemEvents') . getTableVersion('systemUsers'); ?>">
				<input value="systemEvents,systemUsers">
			</td>
		</tr>
	<?php
	}
	else{
		?>
		<tr class="datatableInfo">
			<td colspan="100%">
				<input value="<?php echo mysqli_num_rows($result); ?>">
				<input value="<?php echo getTableVersion('systemEvents') . getTableVersion('systemUsers'); ?>">
				<input value="systemEvents,systemUsers">
			</td>
		</tr>
		<?php
		while($row = mysqli_fetch_assoc($result)){
		?>
			<tr>
				<td class="checkbox unchecked" onclick="datatableCheckbox(this);">
					<input name="systemEvents_id" type="checkbox" value="<?php echo encodeId(purify($row['systemEvents_id'])); ?>">
				</td>
				<td onclick="modal(0, 'large', '/systemEvents/view/modal.php', 'POST', '&systemEvents_id=<?php echo encodeId(purify($row['systemEvents_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemEvents_columnsType == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['systemEvents_type']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemEvents/view/modal.php', 'POST', '&systemEvents_id=<?php echo encodeId(purify($row['systemEvents_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemEvents_columnsStartTime == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['systemEvents_startTime']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemEvents/view/modal.php', 'POST', '&systemEvents_id=<?php echo encodeId(purify($row['systemEvents_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemEvents_columnsEndTime == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['systemEvents_endTime']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemEvents/view/modal.php', 'POST', '&systemEvents_id=<?php echo encodeId(purify($row['systemEvents_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemEvents_columnsStatus == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					if($row['systemEvents_status'] == 200){
						echo 'OK';
					}
					else if($row['systemEvents_status'] == 400){
						echo 'Mangelfuld forespørgsel';
					}
					else if($row['systemEvents_status'] == 401){
						echo 'Uautoriseret';
					}
					else if($row['systemEvents_status'] == 404){
						echo 'Ikke fundet';
					}
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemEvents/view/modal.php', 'POST', '&systemEvents_id=<?php echo encodeId(purify($row['systemEvents_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemEvents_columnsFinished == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					if($row['systemEvents_finished'] == 1){
						echo 'Ja';
					}
					else{
						echo 'Nej';
					}
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemEvents/view/modal.php', 'POST', '&systemEvents_id=<?php echo encodeId(purify($row['systemEvents_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemEvents_columnsIpAddress == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['systemEvents_ipAddress']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemEvents/view/modal.php', 'POST', '&systemEvents_id=<?php echo encodeId(purify($row['systemEvents_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemEvents_columnsHost == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['systemEvents_host']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemEvents/view/modal.php', 'POST', '&systemEvents_id=<?php echo encodeId(purify($row['systemEvents_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemEvents_columnsHttpVersion == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
				<?php
				echo purify($row['systemEvents_httpVersion']);
				?>
				</td>
				<td onclick="modal(0, 'large', '/systemEvents/view/modal.php', 'POST', '&systemEvents_id=<?php echo encodeId(purify($row['systemEvents_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemEvents_columnsInstanceId == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
				<?php
				echo purify($row['systemEvents_instanceId']);
				?>
				</td>
				<td onclick="modal(0, 'large', '/systemEvents/view/modal.php', 'POST', '&systemEvents_id=<?php echo encodeId(purify($row['systemEvents_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemEvents_columnsMethod == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
				<?php
				echo purify($row['systemEvents_method']);
				?>
				</td>
				<td onclick="modal(0, 'large', '/systemEvents/view/modal.php', 'POST', '&systemEvents_id=<?php echo encodeId(purify($row['systemEvents_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemEvents_columnsUserAgent == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
				<?php
				echo purify($row['systemEvents_userAgent']);
				?>
				</td>
				<td onclick="modal(0, 'large', '/systemEvents/view/modal.php', 'POST', '&systemEvents_id=<?php echo encodeId(purify($row['systemEvents_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemEvents_columnsHttpsEnabled == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
				<?php
				echo purify($row['systemEvents_httpsEnabled']);
				?>
				</td>
				<td onclick="modal(0, 'large', '/systemEvents/view/modal.php', 'POST', '&systemEvents_id=<?php echo encodeId(purify($row['systemEvents_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemEvents_columnsFileName == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
				<?php
				echo purify($row['systemEvents_fileName']);
				?>
				</td>
				<td onclick="modal(0, 'large', '/systemEvents/view/modal.php', 'POST', '&systemEvents_id=<?php echo encodeId(purify($row['systemEvents_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemEvents_columnsVersion == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
				<?php
				echo purify($row['systemEvents_version']);
				?>
				</td>
				<td onclick="modal(0, 'large', '/systemEvents/view/modal.php', 'POST', '&systemEvents_id=<?php echo encodeId(purify($row['systemEvents_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemEvents_columnsTags == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo getTags($row['systemEvents_id']);
					?>
				</td>
				<td>
					<div class="nav-btn ellipsis-h" onclick="dropdown(this);">
						<div class="dropdown up right">
							<ul>
								<li onclick="modal(0, 'basic', '/systemEvents/tagsSingle/add/modal.php', 'POST', '&systemEvents_id=<?php echo encodeId(purify($row['systemEvents_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/tag.svg&fill=rgba(135,140,145,1)');">Tilføj mærke på systemhændelse</li>
							</ul>
						</div>
					</div>
				</td>
			</tr>
		<?php
		}
	}
	$result->close();
	
	if(getSystemConfigurations('logSystemEvents') == 1 || getSystemConfigurations('logSystemEvents') == -1){
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
	if(getSystemConfigurations('logSystemEvents') == 1 || getSystemConfigurations('logSystemEvents') == -1){
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