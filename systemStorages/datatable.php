<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['datatableId']) === false){
	$validateFlag = 400;
}
else{
	$datatableId = $_POST['datatableId'];
}

$preferences_columnsSystemStorages_columnsConnectionStatus = getSystemPreferences('columnsSystemStorages_columnsConnectionStatus');
if($preferences_columnsSystemStorages_columnsConnectionStatus == -1){
	$$preferences_columnsSystemStorages_columnsConnectionStatus = 1;
}

$preferences_columnsSystemStorages_columnsName = getSystemPreferences('columnsSystemStorages_columnsName');
if($preferences_columnsSystemStorages_columnsName == -1){
	$preferences_columnsSystemStorages_columnsName = 1;
}

$preferences_columnsSystemStorages_columnsStorageSize = getSystemPreferences('columnsSystemStorages_columnsStorageSize');
if($preferences_columnsSystemStorages_columnsStorageSize == -1){
	$preferences_columnsSystemStorages_columnsStorageSize = 1;
}

$preferences_columnsSystemStorages_columnsType = getSystemPreferences('columnsSystemStorages_columnsType');
if($preferences_columnsSystemStorages_columnsType == -1){
	$preferences_columnsSystemStorages_columnsType = 1;
}

$preferences_columnsSystemStorages_columnsTags = getSystemPreferences('columnsSystemStorages_columnsTags');
if($preferences_columnsSystemStorages_columnsTags == -1){
	$preferences_columnsSystemStorages_columnsTags = 1;
}

if(isset($_POST['searchName']) === false){
	$validateFlag = 400;
}
else{
	$searchName = $_POST['searchName'];
	$searchNameSql = '%' . $searchName . '%';
}

if(isset($_POST['searchStorageSize']) === false){
	$validateFlag = 400;
}
else{
	$searchStorageSize = $_POST['searchStorageSize'];
	$searchStorageSizeSql = '%' . $searchStorageSize . '%';
}

if(isset($_POST['searchType']) === false){
	$validateFlag = 400;
}
else{
	$searchType = $_POST['searchType'];
	$searchTypeSql = '%' . $searchType . '%';
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
			`s0`.`tagsReferences`.`systemStorages_id` AS `tagsReferences_systemStorages_id`
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
			`s0`.`tagsReferences`.`systemStorages_id` IS NOT NULL
	");
	$stmt->bind_param('s', $searchTagsSql);
	$stmt->execute();
	$result = $stmt->get_result();
	
	if(mysqli_num_rows($result) == 0){
		$systemStoragesWithTagsArray = array();
		array_push($systemStoragesWithTagsArray, -1);
	}
	else{
		$systemStoragesWithTagsArray = array();
		
		while($row = mysqli_fetch_assoc($result)){
			array_push($systemStoragesWithTagsArray, $row['tagsReferences_systemStorages_id']);
		}
	}
	$result->close();
}

function orderBy($request){
	if(isset($_POST['orderBy']) === false){
		$orderBy = '`c0`.`systemStorages`.`id`';
		$orderBySort = 'DESC';
	}
	else{
		$orderBy = $_POST['orderBy'];
		if($orderBy == 'Name'){
			$orderBy = '`c0`.`systemStorages`.`name`';
		}
		else if($orderBy == 'StorageSize'){
			$orderBy = '`c0`.`systemStorages`.`storageSize`';
		}
		else if($orderBy == 'Type'){
			$orderBy = '`c0`.`systemStorages`.`type`';
		}
		else if($orderBy == 'Tags'){
			$orderBy = '`c0`.`systemStorages`.`name`';
		}
		else{
			$orderBy = '`c0`.`systemStorages`.`name`';
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

function getTags($systemStorages_id){
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
				`s0`.`tagsReferences`.`systemStorages_id` = ?
			ORDER BY
				`c0`.`tags`.`name` " . orderBy('orderBySort') . "
		");
		$stmt->bind_param('i', $systemStorages_id);
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
	
	if($searchNameSql == '%%' && $searchStorageSizeSql == '%%' && $searchTypeSql == '%%' && $searchTagsSql == '%%'){
		$stmt->prepare("
			SELECT
				`c0`.`systemStorages`.`id` AS `systemStorages_id`,
				`c0`.`systemStorages`.`name` AS `systemStorages_name`,
				`c0`.`systemStorages`.`type` AS `systemStorages_type`,
				`c0`.`systemStorages`.`storageSize` AS `systemStorages_storageSize`,
				`c0`.`systemStorages`.`ftp_connect_host` AS `systemStorages_ftp_connect_host`,
				`c0`.`systemStorages`.`ftp_connect_port` AS `systemStorages_ftp_connect_port`,
				`c0`.`systemStorages`.`ftp_connect_timeout` AS `systemStorages_ftp_connect_timeout`,
				`c0`.`systemStorages`.`ftp_login_username` AS `systemStorages_ftp_login_username`,
				`c0`.`systemStorages`.`ftp_login_password` AS `systemStorages_ftp_login_password`,
				`c0`.`systemStorages`.`ftp_pasv` AS `systemStorages_ftp_pasv`,
				`c0`.`systemStorages`.`ftp_ssl_connect_timeout` AS `systemStorages_ftp_ssl_connect_timeout`,
				`c0`.`systemStorages`.`ftp_ssl_connect_port` AS `systemStorages_ftp_ssl_connect_port`,
				`c0`.`systemStorages`.`ftp_put_remote_path` AS `systemStorages_ftp_put_remote_path`,
				`c0`.`systemStorages`.`mysql_host` AS `systemStorages_mysql_host`,
				`c0`.`systemStorages`.`mysql_username` AS `systemStorages_mysql_username`,
				`c0`.`systemStorages`.`mysql_password` AS `systemStorages_mysql_password`,
				`c0`.`systemStorages`.`mysql_dbname` AS `systemStorages_mysql_dbname`,
				`c0`.`systemStorages`.`mysql_port` AS `systemStorages_mysql_port`,
				`c0`.`systemStorages`.`mysql_socket` AS `systemStorages_mysql_socket`
			FROM
				`c0`.`systemStorages`
			WHERE
				`c0`.`systemStorages`.`deleteFlag` IS NULL
				AND
				`c0`.`systemStorages`.`tempFlag` IS NULL
				AND
				`c0`.`systemStorages`.`legacyFlag` IS NULL
			ORDER BY
				" . orderBy('orderBy') . " " . orderBy('orderBySort') . "
		");
	}
	else{
		if(count($systemStoragesWithTagsArray) > 0){
			$stmt->prepare("
				SELECT
					`c0`.`systemStorages`.`id` AS `systemStorages_id`,
					`c0`.`systemStorages`.`name` AS `systemStorages_name`,
					`c0`.`systemStorages`.`type` AS `systemStorages_type`,
					`c0`.`systemStorages`.`storageSize` AS `systemStorages_storageSize`,
					`c0`.`systemStorages`.`ftp_connect_host` AS `systemStorages_ftp_connect_host`,
					`c0`.`systemStorages`.`ftp_connect_port` AS `systemStorages_ftp_connect_port`,
					`c0`.`systemStorages`.`ftp_connect_timeout` AS `systemStorages_ftp_connect_timeout`,
					`c0`.`systemStorages`.`ftp_login_username` AS `systemStorages_ftp_login_username`,
					`c0`.`systemStorages`.`ftp_login_password` AS `systemStorages_ftp_login_password`,
					`c0`.`systemStorages`.`ftp_pasv` AS `systemStorages_ftp_pasv`,
					`c0`.`systemStorages`.`ftp_ssl_connect_timeout` AS `systemStorages_ftp_ssl_connect_timeout`,
					`c0`.`systemStorages`.`ftp_ssl_connect_port` AS `systemStorages_ftp_ssl_connect_port`,
					`c0`.`systemStorages`.`ftp_put_remote_path` AS `systemStorages_ftp_put_remote_path`,
					`c0`.`systemStorages`.`mysql_host` AS `systemStorages_mysql_host`,
					`c0`.`systemStorages`.`mysql_username` AS `systemStorages_mysql_username`,
					`c0`.`systemStorages`.`mysql_password` AS `systemStorages_mysql_password`,
					`c0`.`systemStorages`.`mysql_dbname` AS `systemStorages_mysql_dbname`,
					`c0`.`systemStorages`.`mysql_port` AS `systemStorages_mysql_port`,
					`c0`.`systemStorages`.`mysql_socket` AS `systemStorages_mysql_socket`
				FROM
					`c0`.`systemStorages`
				WHERE
					`c0`.`systemStorages`.`name` LIKE ?
					AND
					`c0`.`systemStorages`.`storageSize` LIKE ?
					AND
					`c0`.`systemStorages`.`type` LIKE ?
					AND
					`c0`.`systemStorages`.`deleteFlag` IS NULL
					AND
					`c0`.`systemStorages`.`tempFlag` IS NULL
					AND
					`c0`.`systemStorages`.`legacyFlag` IS NULL
					AND
					`c0`.`systemStorages`.`id` IN (" . implode(',', array_map('intval', $systemStoragesWithTagsArray)) . ")
				ORDER BY
					" . orderBy('orderBy') . " " . orderBy('orderBySort') . "
			");
			$stmt->bind_param('sss', $searchNameSql, $searchStorageSizeSql, $searchTypeSql);
		}
		else{
			$stmt->prepare("
				SELECT
					`c0`.`systemStorages`.`id` AS `systemStorages_id`,
					`c0`.`systemStorages`.`name` AS `systemStorages_name`,
					`c0`.`systemStorages`.`type` AS `systemStorages_type`,
					`c0`.`systemStorages`.`storageSize` AS `systemStorages_storageSize`,
					`c0`.`systemStorages`.`ftp_connect_host` AS `systemStorages_ftp_connect_host`,
					`c0`.`systemStorages`.`ftp_connect_port` AS `systemStorages_ftp_connect_port`,
					`c0`.`systemStorages`.`ftp_connect_timeout` AS `systemStorages_ftp_connect_timeout`,
					`c0`.`systemStorages`.`ftp_login_username` AS `systemStorages_ftp_login_username`,
					`c0`.`systemStorages`.`ftp_login_password` AS `systemStorages_ftp_login_password`,
					`c0`.`systemStorages`.`ftp_pasv` AS `systemStorages_ftp_pasv`,
					`c0`.`systemStorages`.`ftp_ssl_connect_timeout` AS `systemStorages_ftp_ssl_connect_timeout`,
					`c0`.`systemStorages`.`ftp_ssl_connect_port` AS `systemStorages_ftp_ssl_connect_port`,
					`c0`.`systemStorages`.`ftp_put_remote_path` AS `systemStorages_ftp_put_remote_path`,
					`c0`.`systemStorages`.`mysql_host` AS `systemStorages_mysql_host`,
					`c0`.`systemStorages`.`mysql_username` AS `systemStorages_mysql_username`,
					`c0`.`systemStorages`.`mysql_password` AS `systemStorages_mysql_password`,
					`c0`.`systemStorages`.`mysql_dbname` AS `systemStorages_mysql_dbname`,
					`c0`.`systemStorages`.`mysql_port` AS `systemStorages_mysql_port`,
					`c0`.`systemStorages`.`mysql_socket` AS `systemStorages_mysql_socket`
				FROM
					`c0`.`systemStorages`
				WHERE
					`c0`.`systemStorages`.`name` LIKE ?
					AND
					`c0`.`systemStorages`.`storageSize` LIKE ?
					AND
					`c0`.`systemStorages`.`type` LIKE ?
					AND
					`c0`.`systemStorages`.`deleteFlag` IS NULL
					AND
					`c0`.`systemStorages`.`tempFlag` IS NULL
					AND
					`c0`.`systemStorages`.`legacyFlag` IS NULL
				ORDER BY
					" . orderBy('orderBy') . " " . orderBy('orderBySort') . "
			");
			$stmt->bind_param('sss', $searchNameSql, $searchStorageSizeSql, $searchTypeSql);
		}
	}
	
	$stmt->execute();
	$result = $stmt->get_result();
	
	if(mysqli_num_rows($result) == 0){
	?>
		<tr class="datatableInfo">
			<td colspan="100%">
				<input value="<?php echo mysqli_num_rows($result); ?>">
				<input value="<?php echo getTableVersion('systemStorages'); ?>">
				<input value="systemStorages">
			</td>
		</tr>
	<?php
	}
	else{
		?>
		<tr class="datatableInfo">
			<td colspan="100%">
				<input value="<?php echo mysqli_num_rows($result); ?>">
				<input value="<?php echo getTableVersion('systemStorages'); ?>">
				<input value="systemStorages">
			</td>
		</tr>
		<?php
		while($row = mysqli_fetch_assoc($result)){
		?>
			<tr>
				<td class="checkbox unchecked" onclick="datatableCheckbox(this);">
					<input name="systemStorages_id" type="checkbox" value="<?php echo encodeId(purify($row['systemStorages_id'])); ?>">
				</td>
				<td>
					<div class="pulseContainer" id="pulseContainer<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>"><div class="pulseCore danger"></div><div class="pulse danger"></div></div>
					
					<input id="inputType<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>" type="hidden" value="<?php echo purify($row['systemStorages_type']); ?>">
					<input id="inputName<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>" type="hidden" value="<?php echo purify($row['systemStorages_name']); ?>">
					<input id="inputMySQLHost<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>" type="hidden" value="<?php echo purify($row['systemStorages_mysql_host']); ?>">
					<input id="inputMySQLUsername<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>" type="hidden" value="<?php echo purify($row['systemStorages_mysql_username']); ?>">
					<input id="inputMySQLPassword<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>" type="hidden" value="<?php echo purify($row['systemStorages_mysql_password']); ?>">
					<input id="inputMySQLDbName<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>" type="hidden" value="<?php echo purify($row['systemStorages_mysql_dbname']); ?>">
					<input id="inputMySQLPort<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>" type="hidden" value="<?php echo purify($row['systemStorages_mysql_port']); ?>">
					<input id="inputMySQLSocket<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>" type="hidden" value="<?php echo purify($row['systemStorages_mysql_socket']); ?>">
					<input id="inputFTPHost<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>" type="hidden" value="<?php echo purify($row['systemStorages_ftp_connect_host']); ?>">
					<input id="inputFTPPort<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>" type="hidden" value="<?php echo purify($row['systemStorages_ftp_connect_port']); ?>">
					<input id="inputFTPTimeout<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>" type="hidden" value="<?php echo purify($row['systemStorages_ftp_connect_timeout']); ?>">
					<input id="inputFTPRemotePath<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>" type="hidden" value="<?php echo purify($row['systemStorages_ftp_put_remote_path']); ?>">
					<input id="inputFTPSSLPort<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>" type="hidden" value="<?php echo purify($row['systemStorages_ftp_ssl_connect_port']); ?>">
					<input id="inputFTPSSLTimeout<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>" type="hidden" value="<?php echo purify($row['systemStorages_ftp_ssl_connect_timeout']); ?>">
					<input id="inputFTPPassiveMode<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>" type="hidden" value="<?php echo purify($row['systemStorages_ftp_pasv']); ?>">
					<input id="inputFTPUsername<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>" type="hidden" value="<?php echo purify($row['systemStorages_ftp_login_username']); ?>">
					<input id="inputFTPPassword<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>" type="hidden" value="<?php echo purify($row['systemStorages_ftp_login_password']); ?>">
					
					<input class="datatableScript" type="hidden" value="
						(function(){
							checkConnection(
								'<?php echo encodeId(purify($row['systemStorages_id'])); ?>',
								0,
								document.querySelectorAll('#<?php echo purify($datatableId); ?> form #pulseContainer<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0],
								document.querySelectorAll('#<?php echo purify($datatableId); ?> form #inputType<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0],
								document.querySelectorAll('#<?php echo purify($datatableId); ?> form #inputName<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0],
								document.querySelectorAll('#<?php echo purify($datatableId); ?> form #inputMySQLHost<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0],
								document.querySelectorAll('#<?php echo purify($datatableId); ?> form #inputMySQLUsername<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0],
								document.querySelectorAll('#<?php echo purify($datatableId); ?> form #inputMySQLPassword<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0],
								document.querySelectorAll('#<?php echo purify($datatableId); ?> form #inputMySQLDbName<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0],
								document.querySelectorAll('#<?php echo purify($datatableId); ?> form #inputMySQLPort<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0],
								document.querySelectorAll('#<?php echo purify($datatableId); ?> form #inputMySQLSocket<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0],
								document.querySelectorAll('#<?php echo purify($datatableId); ?> form #inputFTPHost<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0],
								document.querySelectorAll('#<?php echo purify($datatableId); ?> form #inputFTPPort<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0],
								document.querySelectorAll('#<?php echo purify($datatableId); ?> form #inputFTPTimeout<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0],
								document.querySelectorAll('#<?php echo purify($datatableId); ?> form #inputFTPRemotePath<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0],
								document.querySelectorAll('#<?php echo purify($datatableId); ?> form #inputFTPSSLPort<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0],
								document.querySelectorAll('#<?php echo purify($datatableId); ?> form #inputFTPSSLTimeout<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0],
								document.querySelectorAll('#<?php echo purify($datatableId); ?> form #inputFTPPassiveMode<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0],
								document.querySelectorAll('#<?php echo purify($datatableId); ?> form #inputFTPUsername<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0],
								document.querySelectorAll('#<?php echo purify($datatableId); ?> form #inputFTPPassword<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0]
							);
							document.querySelectorAll('#<?php echo purify($datatableId); ?> form #pulseContainer<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0].parentElement.style.position = 'relative';
							document.querySelectorAll('#<?php echo purify($datatableId); ?> form #pulseContainer<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0].parentElement.style.width = '45px';
							
							document.querySelectorAll('#<?php echo purify($datatableId); ?> form #pulseContainer<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0].style.left = '0px';
							document.querySelectorAll('#<?php echo purify($datatableId); ?> form #pulseContainer<?php echo purify($datatableId); ?><?php echo encodeId(purify($row['systemStorages_id'])); ?>')[0].style.width = '100%';
						})();
					">
				</td>
				<td onclick="modal(0, 'large', '/systemStorages/view/modal.php', 'POST', '&systemStorages_id=<?php echo encodeId(purify($row['systemStorages_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemStorages_columnsName == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['systemStorages_name']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemStorages/view/modal.php', 'POST', '&systemStorages_id=<?php echo encodeId(purify($row['systemStorages_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemStorages_columnsType == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['systemStorages_type']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemStorages/view/modal.php', 'POST', '&systemStorages_id=<?php echo encodeId(purify($row['systemStorages_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemStorages_columnsStorageSize == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify(storageSize($row['systemStorages_storageSize'], 0));
					?>
				</td>
				<td onclick="modal(0, 'large', '/systemStorages/view/modal.php', 'POST', '&systemStorages_id=<?php echo encodeId(purify($row['systemStorages_id'])); ?>', true, 1);" style="<?php if($preferences_columnsSystemStorages_columnsTags == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo getTags($row['systemStorages_id']);
					?>
				</td>
				<td>
					<div class="nav-btn ellipsis-h" onclick="dropdown(this);">
						<div class="dropdown up right">
							<ul>
								<li onclick="modal(0, 'basic', '/systemStorages/useAsSystemDatabaseSingle/modal.php', 'POST', '&systemStorages_id=<?php echo encodeId(purify($row['systemStorages_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/database.svg&fill=rgba(135,140,145,1)');">Anvend systemlager som systemdatabase</li>
								<li onclick="modal(0, 'large', '/systemStorages/copySingle/modal.php', 'POST', '&systemStorages_id=<?php echo encodeId(purify($row['systemStorages_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/copy.svg&fill=rgba(135,140,145,1)');">Kopier systemlager til nyt systemlager</li>
								<li onclick="modal(0, 'large', '/systemStorages/copySingle/modal.php', 'POST', '&systemStorages_id=<?php echo encodeId(purify($row['systemStorages_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/history.svg&fill=rgba(135,140,145,1)');">Sikkerhedskopier systemlager</li>
								<li onclick="modal(0, 'basic', '/systemStorages/tagsSingle/add/modal.php', 'POST', '&systemStorages_id=<?php echo encodeId(purify($row['systemStorages_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/tag.svg&fill=rgba(135,140,145,1)');">Tilføj mærke på systemlager</li>
								<li onclick="modal(0, 'basic', '/systemStorages/deleteSingle/modal.php', 'POST', '&systemStorages_id=<?php echo encodeId(purify($row['systemStorages_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/trash-alt.svg&fill=rgba(135,140,145,1)');">Slet systemlager</li>
							</ul>
						</div>
					</div>
				</td>
			</tr>
		<?php
		}
	}
	$result->close();
	
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