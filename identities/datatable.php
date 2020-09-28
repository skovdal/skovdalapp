<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

$preferences_columnsIdidentities_columnsType = getSystemPreferences('columnsIdidentities_columnsType');
if($preferences_columnsIdidentities_columnsType == -1){
	$preferences_columnsIdidentities_columnsType = 1;
}

$preferences_columnsIdidentities_columnsName = getSystemPreferences('columnsIdidentities_columnsName');
if($preferences_columnsIdidentities_columnsName == -1){
	$preferences_columnsIdidentities_columnsName = 1;
}

$preferences_columnsIdidentities_columnsName2 = getSystemPreferences('columnsIdidentities_columnsName2');
if($preferences_columnsIdidentities_columnsName2 == -1){
	$preferences_columnsIdidentities_columnsName2 = 0;
}

$preferences_columnsIdidentities_columnsCvrNumber = getSystemPreferences('columnsIdidentities_columnsCvrNumber');
if($preferences_columnsIdidentities_columnsCvrNumber == -1){
	$preferences_columnsIdidentities_columnsCvrNumber = 0;
}

$preferences_columnsIdidentities_columnsCprNumber = getSystemPreferences('columnsIdidentities_columnsCprNumber');
if($preferences_columnsIdidentities_columnsCprNumber == -1){
	$preferences_columnsIdidentities_columnsCprNumber = 0;
}

$preferences_columnsIdidentities_columnsAddress = getSystemPreferences('columnsIdidentities_columnsAddress');
if($preferences_columnsIdidentities_columnsAddress == -1){
	$preferences_columnsIdidentities_columnsAddress = 0;
}

$preferences_columnsIdidentities_columnsAddress2 = getSystemPreferences('columnsIdidentities_columnsAddress2');
if($preferences_columnsIdidentities_columnsAddress2 == -1){
	$preferences_columnsIdidentities_columnsAddress2 = 0;
}

$preferences_columnsIdidentities_columnsZipCode = getSystemPreferences('columnsIdidentities_columnsZipCode');
if($preferences_columnsIdidentities_columnsZipCode == -1){
	$preferences_columnsIdidentities_columnsZipCode = 0;
}

$preferences_columnsIdidentities_columnsCity = getSystemPreferences('columnsIdidentities_columnsCity');
if($preferences_columnsIdidentities_columnsCity == -1){
	$preferences_columnsIdidentities_columnsCity = 0;
}

$preferences_columnsIdidentities_columnsCountry = getSystemPreferences('columnsIdidentities_columnsCountry');
if($preferences_columnsIdidentities_columnsCountry == -1){
	$preferences_columnsIdidentities_columnsCountry = 0;
}

$preferences_columnsIdidentities_columnsPhone = getSystemPreferences('columnsIdidentities_columnsPhone');
if($preferences_columnsIdidentities_columnsPhone == -1){
	$preferences_columnsIdidentities_columnsPhone = 0;
}

$preferences_columnsIdidentities_columnsPhone2 = getSystemPreferences('columnsIdidentities_columnsPhone2');
if($preferences_columnsIdidentities_columnsPhone2 == -1){
	$preferences_columnsIdidentities_columnsPhone2 = 0;
}

$preferences_columnsIdidentities_columnsEmail = getSystemPreferences('columnsIdidentities_columnsEmail');
if($preferences_columnsIdidentities_columnsEmail == -1){
	$preferences_columnsIdidentities_columnsEmail = 1;
}

$preferences_columnsIdidentities_columnsEmail2 = getSystemPreferences('columnsIdidentities_columnsEmail2');
if($preferences_columnsIdidentities_columnsEmail2 == -1){
	$preferences_columnsIdidentities_columnsEmail2 = 0;
}

$preferences_columnsIdidentities_columnsTags = getSystemPreferences('columnsIdidentities_columnsTags');
if($preferences_columnsIdidentities_columnsTags == -1){
	$preferences_columnsIdidentities_columnsTags = 1;
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

if(isset($_POST['searchName2']) === false){
	$validateFlag = 400;
}
else{
	$searchName2 = $_POST['searchName2'];
	$searchName2Sql = '%' . $searchName2 . '%';
}

if(isset($_POST['searchCvrNumber']) === false){
	$validateFlag = 400;
}
else{
	$searchCvrNumber = $_POST['searchCvrNumber'];
	$searchCvrNumberSql = '%' . $searchCvrNumber . '%';
}

if(isset($_POST['searchCprNumber']) === false){
	$validateFlag = 400;
}
else{
	$searchCprNumber = $_POST['searchCprNumber'];
	$searchCprNumberSql = '%' . $searchCprNumber . '%';
}

if(isset($_POST['searchAddress']) === false){
	$validateFlag = 400;
}
else{
	$searchAddress = $_POST['searchAddress'];
	$searchAddressSql = '%' . $searchAddress . '%';
}

if(isset($_POST['searchAddress2']) === false){
	$validateFlag = 400;
}
else{
	$searchAddress2 = $_POST['searchAddress2'];
	$searchAddress2Sql = '%' . $searchAddress2 . '%';
}

if(isset($_POST['searchZipCode']) === false){
	$validateFlag = 400;
}
else{
	$searchZipCode = $_POST['searchZipCode'];
	$searchZipCodeSql = '%' . $searchZipCode . '%';
}

if(isset($_POST['searchCity']) === false){
	$validateFlag = 400;
}
else{
	$searchCity = $_POST['searchCity'];
	$searchCitySql = '%' . $searchCity . '%';
}

if(isset($_POST['searchCountry']) === false){
	$validateFlag = 400;
}
else{
	$searchCountry = $_POST['searchCountry'];
	$searchCountrySql = '%' . $searchCountry . '%';
}

if(isset($_POST['searchPhone']) === false){
	$validateFlag = 400;
}
else{
	$searchPhone = $_POST['searchPhone'];
	$searchPhoneSql = '%' . $searchPhone . '%';
}

if(isset($_POST['searchPhone2']) === false){
	$validateFlag = 400;
}
else{
	$searchPhone2 = $_POST['searchPhone2'];
	$searchPhone2Sql = '%' . $searchPhone2 . '%';
}

if(isset($_POST['searchEmail']) === false){
	$validateFlag = 400;
}
else{
	$searchEmail = $_POST['searchEmail'];
	$searchEmailSql = '%' . $searchEmail . '%';
}

if(isset($_POST['searchEmail2']) === false){
	$validateFlag = 400;
}
else{
	$searchEmail2 = $_POST['searchEmail2'];
	$searchEmail2Sql = '%' . $searchEmail2 . '%';
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
			`s0`.`tagsReferences`.`identities_id` AS `tagsReferences_identities_id`
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
			`s0`.`tagsReferences`.`identities_id` IS NOT NULL
	");
	$stmt->bind_param('s', $searchTagsSql);
	$stmt->execute();
	$result = $stmt->get_result();
	
	if(mysqli_num_rows($result) == 0){
		$identitiesWithTagsArray = array();
	}
	else{
		$identitiesWithTagsArray = array();
		
		while($row = mysqli_fetch_assoc($result)){
			array_push($identitiesWithTagsArray, $row['tagsReferences_identities_id']);
		}
	}
	$result->close();
}

function orderBy($request){
	if(isset($_POST['orderBy']) === false){
		$orderBy = '`c0`.`identities`.`id`';
		$orderBySort = 'DESC';
	}
	else{
		$orderBy = $_POST['orderBy'];
		if($orderBy == 'Type'){
			$orderBy = '`c0`.`identities`.`type`';
		}
		else if($orderBy == 'Name'){
			$orderBy = '`c0`.`identities`.`name`';
		}
		else if($orderBy == 'Name2'){
			$orderBy = '`c0`.`identities`.`name2`';
		}
		else if($orderBy == 'CvrNumber'){
			$orderBy = '`c0`.`identities`.`cvrNumber`';
		}
		else if($orderBy == 'CprNumber'){
			$orderBy = '`c0`.`identities`.`cprNumber`';
		}
		else if($orderBy == 'Address'){
			$orderBy = '`c0`.`identities`.`address`';
		}
		else if($orderBy == 'Address2'){
			$orderBy = '`c0`.`identities`.`address2`';
		}
		else if($orderBy == 'ZipCode'){
			$orderBy = '`c0`.`identities`.`zipCode`';
		}
		else if($orderBy == 'City'){
			$orderBy = '`c0`.`identities`.`city`';
		}
		else if($orderBy == 'Country'){
			$orderBy = '`c0`.`identities`.`country`';
		}
		else if($orderBy == 'Phone'){
			$orderBy = '`c0`.`identities`.`phone`';
		}
		else if($orderBy == 'Phone2'){
			$orderBy = '`c0`.`identities`.`phone2`';
		}
		else if($orderBy == 'Email'){
			$orderBy = '`c0`.`identities`.`email`';
		}
		else if($orderBy == 'Email2'){
			$orderBy = '`c0`.`identities`.`email2`';
		}
		else if($orderBy == 'Tags'){
			$orderBy = '`c0`.`identities`.`name`';
		}
		else{
			$orderBy = '`c0`.`identities`.`name`';
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

function getTags($identities_id){
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
				`s0`.`tagsReferences`.`identities_id` = ?
			ORDER BY
				`c0`.`tags`.`name` " . orderBy('orderBySort') . "
		");
		$stmt->bind_param('i', $identities_id);
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
	
	if($searchTypeSql == '%%' && $searchNameSql == '%%' && $searchName2Sql == '%%' && $searchCvrNumberSql == '%%' && $searchCprNumberSql == '%%' && $searchAddressSql == '%%' && $searchAddress2Sql == '%%' && $searchZipCodeSql == '%%' && $searchCitySql == '%%' && $searchCountrySql == '%%' && $searchPhoneSql == '%%' && $searchPhone2Sql == '%%' && $searchEmailSql == '%%' && $searchEmail2Sql == '%%' && $searchTagsSql == '%%'){
		$stmt->prepare("
			SELECT
				`c0`.`identities`.`id` AS `identities_id`,
				`c0`.`identities`.`type` AS `identities_type`,
				`c0`.`identities`.`name` AS `identities_name`,
				`c0`.`identities`.`name2` AS `identities_name2`,
				`c0`.`identities`.`cvrNumber` AS `identities_cvrNumber`,
				`c0`.`identities`.`cprNumber` AS `identities_cprNumber`,
				`c0`.`identities`.`address` AS `identities_address`,
				`c0`.`identities`.`address2` AS `identities_address2`,
				`c0`.`identities`.`zipCode` AS `identities_zipCode`,
				`c0`.`identities`.`city` AS `identities_city`,
				`c0`.`identities`.`country` AS `identities_country`,
				`c0`.`identities`.`phone` AS `identities_phone`,
				`c0`.`identities`.`phone2` AS `identities_phone2`,
				`c0`.`identities`.`email` AS `identities_email`,
				`c0`.`identities`.`email2` AS `identities_email2`,
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
				" . orderBy('orderBy') . " " . orderBy('orderBySort') . "
		");
	}
	else{
		if(count($identitiesWithTagsArray) > 0){
			$stmt->prepare("
				SELECT
					`c0`.`identities`.`id` AS `identities_id`,
					`c0`.`identities`.`type` AS `identities_type`,
					`c0`.`identities`.`name` AS `identities_name`,
					`c0`.`identities`.`name2` AS `identities_name2`,
					`c0`.`identities`.`cvrNumber` AS `identities_cvrNumber`,
					`c0`.`identities`.`cprNumber` AS `identities_cprNumber`,
					`c0`.`identities`.`address` AS `identities_address`,
					`c0`.`identities`.`address2` AS `identities_address2`,
					`c0`.`identities`.`zipCode` AS `identities_zipCode`,
					`c0`.`identities`.`city` AS `identities_city`,
					`c0`.`identities`.`country` AS `identities_country`,
					`c0`.`identities`.`phone` AS `identities_phone`,
					`c0`.`identities`.`phone2` AS `identities_phone2`,
					`c0`.`identities`.`email` AS `identities_email`,
					`c0`.`identities`.`email2` AS `identities_email2`,
					`c0`.`identities`.`photo_filesMetaData_id` AS `identities_photo_filesMetaData_id`
				FROM
					`c0`.`identities`
				WHERE
					`c0`.`identities`.`type` LIKE ?
					AND
					`c0`.`identities`.`name` LIKE ?
					AND
					`c0`.`identities`.`name2` LIKE ?
					AND
					`c0`.`identities`.`cvrNumber` LIKE ?
					AND
					`c0`.`identities`.`cprNumber` LIKE ?
					AND
					`c0`.`identities`.`address` LIKE ?
					AND
					`c0`.`identities`.`address2` LIKE ?
					AND
					`c0`.`identities`.`zipCode` LIKE ?
					AND
					`c0`.`identities`.`city` LIKE ?
					AND
					`c0`.`identities`.`country` LIKE ?
					AND
					`c0`.`identities`.`phone` LIKE ?
					AND
					`c0`.`identities`.`phone2` LIKE ?
					AND
					`c0`.`identities`.`email` LIKE ?
					AND
					`c0`.`identities`.`email2` LIKE ?
					AND
					`c0`.`identities`.`deleteFlag` IS NULL
					AND
					`c0`.`identities`.`tempFlag` IS NULL
					AND
					`c0`.`identities`.`legacyFlag` IS NULL
					AND
					`c0`.`identities`.`id` IN (" . implode(',', array_map('intval', $identitiesWithTagsArray)) . ")
				ORDER BY
					" . orderBy('orderBy') . " " . orderBy('orderBySort') . "
			");
			$stmt->bind_param('ssssssssssssss', $searchTypeSql, $searchNameSql, $searchName2Sql, $searchCvrNumberSql, $searchCprNumberSql, $searchAddressSql, $searchAddress2Sql, $searchZipCodeSql, $searchCitySql, $searchCountrySql, $searchPhoneSql, $searchPhone2Sql, $searchEmailSql, $searchEmail2Sql);
		}
		else{
			$stmt->prepare("
				SELECT
					`c0`.`identities`.`id` AS `identities_id`,
					`c0`.`identities`.`type` AS `identities_type`,
					`c0`.`identities`.`name` AS `identities_name`,
					`c0`.`identities`.`name2` AS `identities_name2`,
					`c0`.`identities`.`cvrNumber` AS `identities_cvrNumber`,
					`c0`.`identities`.`cprNumber` AS `identities_cprNumber`,
					`c0`.`identities`.`address` AS `identities_address`,
					`c0`.`identities`.`address2` AS `identities_address2`,
					`c0`.`identities`.`zipCode` AS `identities_zipCode`,
					`c0`.`identities`.`city` AS `identities_city`,
					`c0`.`identities`.`country` AS `identities_country`,
					`c0`.`identities`.`phone` AS `identities_phone`,
					`c0`.`identities`.`phone2` AS `identities_phone2`,
					`c0`.`identities`.`email` AS `identities_email`,
					`c0`.`identities`.`email2` AS `identities_email2`,
					`c0`.`identities`.`photo_filesMetaData_id` AS `identities_photo_filesMetaData_id`
				FROM
					`c0`.`identities`
				WHERE
					`c0`.`identities`.`type` LIKE ?
					AND
					`c0`.`identities`.`name` LIKE ?
					AND
					`c0`.`identities`.`name2` LIKE ?
					AND
					`c0`.`identities`.`cvrNumber` LIKE ?
					AND
					`c0`.`identities`.`cprNumber` LIKE ?
					AND
					`c0`.`identities`.`address` LIKE ?
					AND
					`c0`.`identities`.`address2` LIKE ?
					AND
					`c0`.`identities`.`zipCode` LIKE ?
					AND
					`c0`.`identities`.`city` LIKE ?
					AND
					`c0`.`identities`.`country` LIKE ?
					AND
					`c0`.`identities`.`phone` LIKE ?
					AND
					`c0`.`identities`.`phone2` LIKE ?
					AND
					`c0`.`identities`.`email` LIKE ?
					AND
					`c0`.`identities`.`email2` LIKE ?
					AND
					`c0`.`identities`.`deleteFlag` IS NULL
					AND
					`c0`.`identities`.`tempFlag` IS NULL
					AND
					`c0`.`identities`.`legacyFlag` IS NULL
				ORDER BY
					" . orderBy('orderBy') . " " . orderBy('orderBySort') . "
			");
			$stmt->bind_param('ssssssssssssss', $searchTypeSql, $searchNameSql, $searchName2Sql, $searchCvrNumberSql, $searchCprNumberSql, $searchAddressSql, $searchAddress2Sql, $searchZipCodeSql, $searchCitySql, $searchCountrySql, $searchPhoneSql, $searchPhone2Sql, $searchEmailSql, $searchEmail2Sql);
		}
	}
	
	$stmt->execute();
	$result = $stmt->get_result();
	
	if(mysqli_num_rows($result) == 0){
	?>
		<tr class="datatableInfo">
			<td colspan="100%">
				<input value="<?php echo mysqli_num_rows($result); ?>">
				<input value="<?php echo md5(getTableVersion('identities')); ?>">
			</td>
		</tr>
	<?php
	}
	else{
		?>
		<tr class="datatableInfo">
			<td colspan="100%">
				<input value="<?php echo mysqli_num_rows($result); ?>">
				<input value="<?php echo md5(getTableVersion('identities')); ?>">
			</td>
		</tr>
		<?php
		while($row = mysqli_fetch_assoc($result)){
		?>
			<tr>
				<td class="checkbox unchecked" onclick="datatableCheckbox(this);">
					<input name="identities_id" type="checkbox" value="<?php echo encodeId(purify($row['identities_id'])); ?>">
				</td>
				<td onclick="modal(0, 'large', '/identities/view/modal.php', 'POST', '&identities_id=<?php echo encodeId(purify($row['identities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsIdidentities_columnsType == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['identities_type']);
					?>
				</td>
				<td class="photo" onclick="modal(0, 'large', '/identities/view/modal.php', 'POST', '&identities_id=<?php echo encodeId(purify($row['identities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsIdidentities_columnsName == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					if($row['identities_photo_filesMetaData_id'] === null){
					?>
						<div class="photo" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/user-circle.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>');"></div>
					<?php
					}
					else{
					?>
						<div class="photo" style="background-image:url('<?php echo '/serve/photo.php?id=' . purify($row['identities_photo_filesMetaData_id']); ?>');"></div>
					<?php
					}
					echo purify($row['identities_name']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/identities/view/modal.php', 'POST', '&identities_id=<?php echo encodeId(purify($row['identities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsIdidentities_columnsName2 == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['identities_name2']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/identities/view/modal.php', 'POST', '&identities_id=<?php echo encodeId(purify($row['identities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsIdidentities_columnsCvrNumber == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['identities_cvrNumber']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/identities/view/modal.php', 'POST', '&identities_id=<?php echo encodeId(purify($row['identities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsIdidentities_columnsCprNumber == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['identities_cprNumber']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/identities/view/modal.php', 'POST', '&identities_id=<?php echo encodeId(purify($row['identities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsIdidentities_columnsAddress == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['identities_address']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/identities/view/modal.php', 'POST', '&identities_id=<?php echo encodeId(purify($row['identities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsIdidentities_columnsAddress2 == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['identities_address2']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/identities/view/modal.php', 'POST', '&identities_id=<?php echo encodeId(purify($row['identities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsIdidentities_columnsZipCode == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['identities_zipCode']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/identities/view/modal.php', 'POST', '&identities_id=<?php echo encodeId(purify($row['identities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsIdidentities_columnsCity == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['identities_city']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/identities/view/modal.php', 'POST', '&identities_id=<?php echo encodeId(purify($row['identities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsIdidentities_columnsCountry == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['identities_country']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/identities/view/modal.php', 'POST', '&identities_id=<?php echo encodeId(purify($row['identities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsIdidentities_columnsPhone == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['identities_phone']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/identities/view/modal.php', 'POST', '&identities_id=<?php echo encodeId(purify($row['identities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsIdidentities_columnsPhone2 == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['identities_phone2']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/identities/view/modal.php', 'POST', '&identities_id=<?php echo encodeId(purify($row['identities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsIdidentities_columnsEmail == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['identities_email']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/identities/view/modal.php', 'POST', '&identities_id=<?php echo encodeId(purify($row['identities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsIdidentities_columnsEmail2 == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo purify($row['identities_email2']);
					?>
				</td>
				<td onclick="modal(0, 'large', '/identities/view/modal.php', 'POST', '&identities_id=<?php echo encodeId(purify($row['identities_id'])); ?>', true, 1);" style="<?php if($preferences_columnsIdidentities_columnsTags == 1){echo 'display:table-cell;';}else{echo 'display:none;';} ?>">
					<?php
					echo getTags($row['identities_id']);
					?>
				</td>
				<td>
					<div class="nav-btn ellipsis-h" onclick="dropdown(this);">
						<div class="dropdown up right">
							<ul>
								<li onclick="modal(0, 'large', '/identities/copySingle/modal.php', 'POST', '&identities_id=<?php echo encodeId(purify($row['identities_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/copy.svg&fill=rgba(135,140,145,1)');">Kopier identitet til ny identitet</li>
								<li onclick="modal(0, 'basic', '/identities/tagsSingle/add/modal.php', 'POST', '&identities_id=<?php echo encodeId(purify($row['identities_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/tag.svg&fill=rgba(135,140,145,1)');">Tilføj mærke på identitet</li>
								<li onclick="modal(0, 'basic', '/identities/deleteSingle/modal.php', 'POST', '&identities_id=<?php echo encodeId(purify($row['identities_id'])); ?>', true, 1);" style="background-image:url('/images/svgImage.php?id=/images/fontawesome-pro-5.9.0-web/svgs/solid/trash-alt.svg&fill=rgba(135,140,145,1)');">Slet identitet</li>
							</ul>
						</div>
					</div>
				</td>
			</tr>
		<?php
		}
	}
	$result->close();
	
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