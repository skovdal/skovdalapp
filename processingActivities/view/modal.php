<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if(isset($_POST['processingActivities_id']) === false){
	$validateFlag = 400;
}
else{
	$processingActivities_id = $_POST['processingActivities_id'];
	if(decodeId($processingActivities_id) == -1){
		$validateFlag = 400;
	}
	else{
		$processingActivities_id = decodeId($processingActivities_id);
	}
}

if(isset($con) === false){$con = dbConnection();}
$stmt = $con->stmt_init();
$stmt->prepare("
	SELECT
		`c0`.`processingActivities`.`name` AS `processingActivities_name`,
		`c0`.`processingActivities`.`securityClearance` AS `processingActivities_securityClearance`,
		`c0`.`processingActivities`.`identities_id` AS `processingActivities_identities_id`
	FROM
		`c0`.`processingActivities`
	WHERE
		`c0`.`processingActivities`.`id` = ?
	LIMIT 1
");
$stmt->bind_param('i', $processingActivities_id);
$stmt->execute();
$result = $stmt->get_result();

if(mysqli_num_rows($result) == 0){
	$validateFlag = 400;
}
else{
	while($row = mysqli_fetch_assoc($result)){
		$processingActivities_name = $row['processingActivities_name'];
		$processingActivities_securityClearance = $row['processingActivities_securityClearance'];
		$processingActivities_identities_id = $row['processingActivities_identities_id'];
	}
}
$result->close();

if(isset($con) === false){$con = dbConnection();}
$stmt = $con->stmt_init();
$stmt->prepare("
	SELECT
		`c0`.`identities`.`type` AS `identities_type`,
		`c0`.`identities`.`name` AS `identities_name`,
		`c0`.`identities`.`name2` AS `identities_name2`,
		`c0`.`identities`.`phone` AS `identities_phone`,
		`c0`.`identities`.`email` AS `identities_email`,
		`c0`.`identities`.`securityClearance` AS `identities_securityClearance`,
		`c0`.`identities`.`photo_filesMetaData_id` AS `identities_photo_filesMetaData_id`
	FROM
		`c0`.`identities`
	WHERE
		`c0`.`identities`.`id` = ?
	LIMIT 1
");
$stmt->bind_param('i', $processingActivities_identities_id);
$stmt->execute();
$result = $stmt->get_result();

if(mysqli_num_rows($result) == 0){
	$validateFlag = 400;
}
else{
	while($row = mysqli_fetch_assoc($result)){
		$identities_type = $row['identities_type'];
		$identities_name = $row['identities_name'];
		$identities_name2 = $row['identities_name2'];
		$identities_phone = $row['identities_phone'];
		$identities_email = $row['identities_email'];
		$identities_securityClearance = $row['identities_securityClearance'];
		$identities_photo_filesMetaData_id = $row['identities_photo_filesMetaData_id'];
		
		if($identities_photo_filesMetaData_id === null){
			$identities_photoUrl = '/images/svgImage.php?id=' . urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/user-circle.svg') . '&fill=' . urlencode('rgba(135,140,145,1)');
		}
		else{
			$identities_photoUrl = '/serve/photo.php?id=' . encodeId($identities_photo_filesMetaData_id);
		}
	}
}
$result->close();

if($validateFlag == 200){
?>
	<h1><?php echo purify($processingActivities_name); ?></h1>
	<ul>
		<li class="active" onclick="modalTab('<?php echo purify($modalId); ?>', 1);">
			Generelt
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 2);">
			Formål
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 3);">
			Personoplysninger
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 4);">
			Politikker
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 5);">
			Procedurer
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 6);">
			Behandlingssystemer
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 7);">
			Registrerede
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 8);">
			Risikovurderinger
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 9);">
			Konsekvensvurderinger
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 10);">
			Ansvarshavende
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 11);">
			Databeskyttelsesrådgiver
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 12);">
			Dataansvarlige
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 13);">
			Modtagere
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 14);">
			Mærker
		</li>
	</ul>
	<form onsubmit="return false;">
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input type="text" value="<?php echo purify($processingActivities_name); ?>" readonly><label>Navn</label><br>
			<input type="text" value="<?php echo purify($processingActivities_securityClearance); ?>" readonly><label>Sikkerhedsgodkendelse</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<textarea readonly></textarea><label>Formål</label><br>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fuser-tag.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					Der er ikke tilføjet nogen personoplysninger
				</div>
			</div>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="photo" style="background-image:url('<?php echo purify($identities_photoUrl); ?>');"></div>
			<input class="photo" type="text" value="<?php echo purify($identities_type); ?>" readonly><label>Type</label><br>
			<input class="photo" type="text" value="<?php echo purify($identities_name); ?>" readonly><label>Navn</label><br>
			<input class="photo" type="text" value="<?php echo purify($identities_name2); ?>" readonly><label>Supplerende navneoplysninger</label><br>
			<input type="text" value="<?php echo purify($identities_phone); ?>" readonly><label>Telefon</label><br>
			<input type="text" value="<?php echo purify($identities_email); ?>" readonly><label>E-mail</label><br>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fusers-crown.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					Der er ikke tilføjet nogen roller
				</div>
			</div>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fusers-class.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					Der er ikke tilføjet nogen grupper
				</div>
			</div>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fbars.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					Der er ikke registreret nogen hændelser
				</div>
			</div>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fbars.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					Der er ikke registreret nogen hændelser
				</div>
			</div>
		</div>
		
		<div class="tagTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="tagContainer">
				<?php
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
						`c0`.`tags`.`name` ASC
				");
				$stmt->bind_param('i', $processingActivities_id);
				$stmt->execute();
				$result = $stmt->get_result();
				
				if(mysqli_num_rows($result) == 0){
					echo '<div class="noContent"><br><br><br><br><br><br><br><br><br>Der er ikke tilføjet nogen mærker</div>';
				}
				else{
					while($row = mysqli_fetch_assoc($result)){
						echo '<div class="tag" style="background-color:' . purify($row['tags_backgroundColor']) . '; background-image:none; border:1px solid ' . purify($row['tags_borderColor']) . '; color:' . purify($row['tags_fontColor']) . '; cursor:default; padding:3px 9px 3px 9px;">' . purify($row['tags_name']) . '</div>';
					}
				}
				$result->close();
							?>
			</div>
		</div>
		
		<div class="buttons">
			<input class="delete" onclick="modal(0, 'basic', '/processingActivities/view/delete/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>&processingActivities_id=<?php echo encodeId(purify($processingActivities_id)); ?>', true, 1);" type="button" value="Slet behandlingsaktivitet"><input class="edit" onclick="modal(<?php echo purify($modalId); ?>, 'large', '/processingActivities/edit/modal.php', 'POST', '&processingActivities_id=<?php echo encodeId(purify($processingActivities_id)); ?>', false, 0)" type="button" value="Editer behandlingsaktivitet"><input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk">
		</div>
	</form>
	<?php
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