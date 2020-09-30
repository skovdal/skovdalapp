<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

$preferences_columnsProcessingActivities_columnsName = getSystemPreferences('columnsProcessingActivities_columnsName');
if($preferences_columnsProcessingActivities_columnsName == -1){
	$preferences_columnsProcessingActivities_columnsName = 1;
}

$preferences_columnsProcessingActivities_columnsSecurityClearance = getSystemPreferences('columnsProcessingActivities_columnsSecurityClearance');
if($preferences_columnsProcessingActivities_columnsSecurityClearance == -1){
	$preferences_columnsProcessingActivities_columnsSecurityClearance = 0;
}

$preferences_columnsProcessingActivities_columnsResponsibleIdentityType = getSystemPreferences('columnsProcessingActivities_columnsResponsibleIdentityType');
if($preferences_columnsProcessingActivities_columnsResponsibleIdentityType == -1){
	$preferences_columnsProcessingActivities_columnsResponsibleIdentityType = 0;
}

$preferences_columnsProcessingActivities_columnsResponsibleIdentityName = getSystemPreferences('columnsProcessingActivities_columnsResponsibleIdentityName');
if($preferences_columnsProcessingActivities_columnsResponsibleIdentityName == -1){
	$preferences_columnsProcessingActivities_columnsResponsibleIdentityName = 1;
}

$preferences_columnsProcessingActivities_columnsResponsibleIdentityName2 = getSystemPreferences('columnsProcessingActivities_columnsResponsibleIdentityName2');
if($preferences_columnsProcessingActivities_columnsResponsibleIdentityName2 == -1){
	$preferences_columnsProcessingActivities_columnsResponsibleIdentityName2 = 0;
}

$preferences_columnsProcessingActivities_columnsResponsibleIdentityPhone = getSystemPreferences('columnsProcessingActivities_columnsResponsibleIdentityPhone');
if($preferences_columnsProcessingActivities_columnsResponsibleIdentityPhone == -1){
	$preferences_columnsProcessingActivities_columnsResponsibleIdentityPhone = 0;
}

$preferences_columnsProcessingActivities_columnsResponsibleIdentityEmail = getSystemPreferences('columnsProcessingActivities_columnsResponsibleIdentityEmail');
if($preferences_columnsProcessingActivities_columnsResponsibleIdentityEmail == -1){
	$preferences_columnsProcessingActivities_columnsResponsibleIdentityEmail = 0;
}

$preferences_columnsProcessingActivities_columnsTags = getSystemPreferences('columnsProcessingActivities_columnsTags');
if($preferences_columnsProcessingActivities_columnsTags == -1){
	$preferences_columnsProcessingActivities_columnsTags = 1;
}

if(isset($_POST['searchName']) === false){
	$validateFlag = 400;
}
else{
	$searchName = $_POST['searchName'];
	$searchNameSql = '%' . $searchName . '%';
}

if(isset($_POST['searchResponsibleIdentityType']) === false){
	$validateFlag = 400;
}
else{
	$searchResponsibleIdentityType = $_POST['searchResponsibleIdentityType'];
	$searchResponsibleIdentityTypeSql = '%' . $searchResponsibleIdentityType . '%';
}

if(isset($_POST['searchResponsibleIdentityName']) === false){
	$validateFlag = 400;
}
else{
	$searchResponsibleIdentityName = $_POST['searchResponsibleIdentityName'];
	$searchResponsibleIdentityNameSql = '%' . $searchResponsibleIdentityName . '%';
}

if(isset($_POST['searchResponsibleIdentityName2']) === false){
	$validateFlag = 400;
}
else{
	$searchResponsibleIdentityName2 = $_POST['searchResponsibleIdentityName2'];
	$searchResponsibleIdentityName2Sql = '%' . $searchResponsibleIdentityName2 . '%';
}

if(isset($_POST['searchResponsibleIdentityPhone']) === false){
	$validateFlag = 400;
}
else{
	$searchResponsibleIdentityPhone = $_POST['searchResponsibleIdentityPhone'];
	$searchResponsibleIdentityPhoneSql = '%' . $searchResponsibleIdentityPhone . '%';
}

if(isset($_POST['searchResponsibleIdentityEmail']) === false){
	$validateFlag = 400;
}
else{
	$searchResponsibleIdentityEmail = $_POST['searchResponsibleIdentityEmail'];
	$searchResponsibleIdentityEmailSql = '%' . $searchResponsibleIdentityEmail . '%';
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
			`s0`.`tagsReferences`.`processingActivities_id` AS `tagsReferences_processingActivities_id`
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
			`s0`.`tagsReferences`.`processingActivities_id` IS NOT NULL
	");
	$stmt->bind_param('s', $searchTagsSql);
	$stmt->execute();
	$result = $stmt->get_result();
	
	if(mysqli_num_rows($result) == 0){
		$processingActivitiesWithTagsArray = array();
		array_push($processingActivitiesWithTagsArray, -1);
	}
	else{
		$processingActivitiesWithTagsArray = array();
		
		while($row = mysqli_fetch_assoc($result)){
			array_push($processingActivitiesWithTagsArray, $row['tagsReferences_processingActivities_id']);
		}
	}
	$result->close();
}

function orderBy($request){
	if(isset($_POST['orderBy']) === false){
		$orderBy = '`c0`.`processingActivities`.`id`';
		$orderBySort = 'DESC';
	}
	else{
		$orderBy = $_POST['orderBy'];
		if($orderBy == 'Name'){
			$orderBy = '`c0`.`processingActivities`.`name`';
		}
		else if($orderBy == 'SecurityClearance'){
			$orderBy = '`c0`.`processingActivities`.`securityClearance`';
		}
		else if($orderBy == 'ResponsibleIdentityType'){
			$orderBy = '`c0`.`identities`.`type`';
		}
		else if($orderBy == 'ResponsibleIdentityName'){
			$orderBy = '`c0`.`identities`.`name`';
		}
		else if($orderBy == 'ResponsibleIdentityName2'){
			$orderBy = '`c0`.`identities`.`name2`';
		}
		else if($orderBy == 'ResponsibleIdentityPhone'){
			$orderBy = '`c0`.`identities`.`phone`';
		}
		else if($orderBy == 'ResponsibleIdentityEmail'){
			$orderBy = '`c0`.`identities`.`email`';
		}
		else if($orderBy == 'Tags'){
			$orderBy = '`c0`.`processingActivities`.`name`';
		}
		else{
			$orderBy = '`c0`.`processingActivities`.`name`';
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

function getTags($processingActivities_id){
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
				`s0`.`tagsReferences`.`processingActivities_id` = ?
			ORDER BY
				`c0`.`tags`.`name` " . orderBy('orderBySort') . "
		");
		$stmt->bind_param('i', $processingActivities_id);
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
	
	if($searchNameSql == '%%' && $searchResponsibleIdentityTypeSql == '%%' && $searchResponsibleIdentityNameSql == '%%' && $searchResponsibleIdentityName2Sql == '%%' && $searchResponsibleIdentityPhoneSql == '%%' && $searchResponsibleIdentityEmailSql == '%%' && $searchTagsSql == '%%'){
		$stmt->prepare("
			SELECT
				`c0`.`processingActivities`.`id` AS `processingActivities_id`,
				`c0`.`processingActivities`.`name` AS `processingActivities_name`,
				`c0`.`processingActivities`.`securityClearance` AS `processingActivities_securityClearance`,
				`c0`.`identities`.`type` AS `identities_type`,
				`c0`.`identities`.`name` AS `identities_name`,
				`c0`.`identities`.`name2` AS `identities_name2`,
				`c0`.`identities`.`phone` AS `identities_phone`,
				`c0`.`identities`.`email` AS `identities_email`,
				`c0`.`identities`.`photo_filesMetaData_id` AS `identities_photo_filesMetaData_id`
			FROM
				`c0`.`processingActivities`
			INNER JOIN
				`c0`.`identities`
			ON
				`c0`.`processingActivities`.`responsible_identities_id` = `c0`.`identities`.`id`
			WHERE
				`c0`.`processingActivities`.`deleteFlag` IS NULL
				AND
				`c0`.`processingActivities`.`tempFlag` IS NULL
				AND
				`c0`.`processingActivities`.`legacyFlag` IS NULL
			ORDER BY
				" . orderBy('orderBy') . " " . orderBy('orderBySort') . "
		");
	}
	else{
		if(count($processingActivitiesWithTagsArray) > 0){
			$stmt->prepare("
				SELECT
					`c0`.`processingActivities`.`id` AS `processingActivities_id`,
					`c0`.`processingActivities`.`name` AS `processingActivities_name`,
					`c0`.`processingActivities`.`securityClearance` AS `processingActivities_securityClearance`,
					`c0`.`identities`.`type` AS `identities_type`,
					`c0`.`identities`.`name` AS `identities_name`,
					`c0`.`identities`.`name2` AS `identities_name2`,
					`c0`.`identities`.`phone` AS `identities_phone`,
					`c0`.`identities`.`email` AS `identities_email`,
					`c0`.`identities`.`photo_filesMetaData_id` AS `identities_photo_filesMetaData_id`
				FROM
					`c0`.`processingActivities`
				INNER JOIN
					`c0`.`identities`
				ON
					`c0`.`processingActivities`.`responsible_identities_id` = `c0`.`identities`.`id`
				WHERE
					`c0`.`processingActivities`.`name` LIKE ?
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
					`c0`.`processingActivities`.`deleteFlag` IS NULL
					AND
					`c0`.`processingActivities`.`tempFlag` IS NULL
					AND
					`c0`.`processingActivities`.`legacyFlag` IS NULL
					AND
					`c0`.`processingActivities`.`id` IN (" . implode(',', array_map('intval', $processingActivitiesWithTagsArray)) . ")
				ORDER BY
					" . orderBy('orderBy') . " " . orderBy('orderBySort') . "
			");
			$stmt->bind_param('ssssss', $searchNameSql, $searchResponsibleIdentityTypeSql, $searchResponsibleIdentityNameSql, $searchResponsibleIdentityName2Sql, $searchResponsibleIdentityPhoneSql, $searchResponsibleIdentityEmailSql);
		}
		else{
			$stmt->prepare("
				SELECT
					`c0`.`processingActivities`.`id` AS `processingActivities_id`,
					`c0`.`processingActivities`.`name` AS `processingActivities_name`,
					`c0`.`processingActivities`.`securityClearance` AS `processingActivities_securityClearance`,
					`c0`.`identities`.`type` AS `identities_type`,
					`c0`.`identities`.`name` AS `identities_name`,
					`c0`.`identities`.`name2` AS `identities_name2`,
					`c0`.`identities`.`phone` AS `identities_phone`,
					`c0`.`identities`.`email` AS `identities_email`,
					`c0`.`identities`.`photo_filesMetaData_id` AS `identities_photo_filesMetaData_id`
				FROM
					`c0`.`processingActivities`
				INNER JOIN
					`c0`.`identities`
				ON
					`c0`.`processingActivities`.`responsible_identities_id` = `c0`.`identities`.`id`
				WHERE
					`c0`.`processingActivities`.`name` LIKE ?
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
					`c0`.`processingActivities`.`deleteFlag` IS NULL
					AND
					`c0`.`processingActivities`.`tempFlag` IS NULL
					AND
					`c0`.`processingActivities`.`legacyFlag` IS NULL
				ORDER BY
					" . orderBy('orderBy') . " " . orderBy('orderBySort') . "
			");
			$stmt->bind_param('ssssss', $searchNameSql, $searchResponsibleIdentityTypeSql, $searchResponsibleIdentityNameSql, $searchResponsibleIdentityName2Sql, $searchResponsibleIdentityPhoneSql, $searchResponsibleIdentityEmailSql);
		}
	}
	
	$stmt->execute();
	$result = $stmt->get_result();
	
	if(mysqli_num_rows($result) == 0){
	?>
		<tr class="datatableInfo">
			<td colspan="100%">
				<input value="<?php echo mysqli_num_rows($result); ?>">
				<input value="<?php echo getTableVersion('processingActivities') . getTableVersion('identities'); ?>">
				<input value="processingActivities,identities">
			</td>
		</tr>
	<?php
	}
	else{
		?>
		<tr class="datatableInfo">
			<td colspan="100%">
				<input value="<?php echo mysqli_num_rows($result); ?>">
				<input value="<?php echo getTableVersion('processingActivities') . getTableVersion('identities'); ?>">
				<input value="processingActivities,identities">
			</td>
		</tr>
		<?php
		while($row = mysqli_fetch_assoc($result)){
		?>
			<tr>
				<td class="checkbox unchecked" onclick="datatableCheckbox(this);">
					<input name="processingActivities_id" type="checkbox" value="<?php echo purify($row['processingActivities_id']); ?>">
				</td>
				<td onclick="modal(0, 'large', '/processingActivities/view/modal.php', 'POST', '&processingActivities_id=<?php echo encodeId(purify($row['processingActivities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsProcessingActivities_columnsName == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['processingActivities_name']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/processingActivities/view/modal.php', 'POST', '&processingActivities_id=<?php echo encodeId(purify($row['processingActivities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsProcessingActivities_columnsSecurityClearance == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['processingActivities_securityClearance']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/processingActivities/view/modal.php', 'POST', '&processingActivities_id=<?php echo encodeId(purify($row['processingActivities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsProcessingActivities_columnsResponsibleIdentityType == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['identities_type']);
					?>
				</td>
				<td class="photo" onclick="modal(0, 'large', '/processingActivities/view/modal.php', 'POST', '&processingActivities_id=<?php echo encodeId(purify($row['processingActivities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsProcessingActivities_columnsResponsibleIdentityName == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
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
				<td onclick="modal(0, 'large', '/processingActivities/view/modal.php', 'POST', '&processingActivities_id=<?php echo encodeId(purify($row['processingActivities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsProcessingActivities_columnsResponsibleIdentityName2 == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['identities_name2']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/processingActivities/view/modal.php', 'POST', '&processingActivities_id=<?php echo encodeId(purify($row['processingActivities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsProcessingActivities_columnsResponsibleIdentityPhone == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['identities_phone']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/processingActivities/view/modal.php', 'POST', '&processingActivities_id=<?php echo encodeId(purify($row['processingActivities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsProcessingActivities_columnsResponsibleIdentityEmail == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['identities_email']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/processingActivities/view/modal.php', 'POST', '&processingActivities_id=<?php echo encodeId(purify($row['processingActivities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsProcessingActivities_columnsTags == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo getTags($row['processingActivities_id']);
					?>
				</td>
				<td>
					<div class="nav-btn ellipsis-h" onclick="dropdown(this);">
						<div class="dropdown up right">
							<ul>
								<li onclick="modal(0, 'large', '/processingActivities/copySingle/modal.php', 'POST', '&processingActivities_id=<?php echo encodeId(purify($row['processingActivities_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/copy.svg&fill=rgba(135,140,145,1)');">Kopier behandlingsaktivitet til ny behandlingsaktivitet</li>
								<li onclick="modal(0, 'basic', '/processingActivities/tagsSingle/add/modal.php', 'POST', '&processingActivities_id=<?php echo encodeId(purify($row['processingActivities_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/tag.svg&fill=rgba(135,140,145,1)');">Tilføj mærke på behandlingsaktivitet</li>
								<li onclick="modal(0, 'basic', '/processingActivities/deleteSingle/modal.php', 'POST', '&processingActivities_id=<?php echo encodeId(purify($row['processingActivities_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/trash-alt.svg&fill=rgba(135,140,145,1)');">Slet behandlingsaktivitet</li>
							</ul>
						</div>
					</div>
				</td>
			</tr>
		<?php
		}
	}
	$result->close();
	
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