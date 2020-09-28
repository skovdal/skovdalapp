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
	<h1>Tilføj behandlingshjemler</h1>
	<ul>
		<?php
		if(isset($con) === false){$con = dbConnection();}
		$stmt = $con->stmt_init();
		$stmt->prepare("
			SELECT DISTINCT
				`c0`.`processingActivitiesLegalBasises`.`sourceShortName` AS `processingActivitiesLegalBasises_sourceShortName`,
				MD5(`c0`.`processingActivitiesLegalBasises`.`sourceFullName`) AS `md5_processingActivitiesLegalBasises_sourceFullName`,
				`c0`.`processingActivitiesLegalBasises`.`sourceFullName` AS `processingActivitiesLegalBasises_sourceFullName`
			FROM
				`c0`.`processingActivitiesLegalBasises`
			WHERE
				`c0`.`processingActivitiesLegalBasises`.`deleteFlag` IS NULL
				AND
				`c0`.`processingActivitiesLegalBasises`.`tempFlag` IS NULL
				AND
				`c0`.`processingActivitiesLegalBasises`.`legacyFlag` IS NULL
			ORDER BY
				`c0`.`processingActivitiesLegalBasises`.`sourceShortName` ASC,
				`c0`.`processingActivitiesLegalBasises`.`sourceFullName` ASC
		");
		$stmt->execute();
		$result = $stmt->get_result();
		
		if(mysqli_num_rows($result) == 0){
		}
		else{
			$counter = 0;
			while($row = mysqli_fetch_assoc($result)){
				$counter++;
				if($counter == 1){
					$first_md5_Processingactivitieslegasbasises_sourceShortName = $row['md5_processingActivitiesLegalBasises_sourceFullName'];
					?>
					<li class="active" onclick="modalTabAlternative('<?php echo purify($modalId); ?>', <?php echo purify($counter); ?> ,'<?php echo purify($row['md5_processingActivitiesLegalBasises_sourceFullName']); ?>');" title="<?php echo purify($row['processingActivitiesLegalBasises_sourceFullName']); ?>">
						<?php echo purify($row['processingActivitiesLegalBasises_sourceShortName']); ?>
					</li>
				<?php
				}
				else{
				?>
					<li onclick="modalTabAlternative('<?php echo purify($modalId); ?>', <?php echo purify($counter); ?> ,'<?php echo purify($row['md5_processingActivitiesLegalBasises_sourceFullName']); ?>');" title="<?php echo purify($row['processingActivitiesLegalBasises_sourceFullName']); ?>">
						<?php echo purify($row['processingActivitiesLegalBasises_sourceShortName']); ?>
					</li>
				<?php
				}
			}
		}
		$result->close();
		?>
	</ul>
	<form action="/processingActivities/add/tags/add/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<input name="refererModalId" type="hidden" value="<?php echo purify($refererModalId); ?>">
		
		<?php
		if(isset($con) === false){$con = dbConnection();}
		$stmt = $con->stmt_init();
		$stmt->prepare("
			SELECT
				`c0`.`processingActivitiesLegalBasises`.`id` AS `processingActivitiesLegalBasises_id`,
				`c0`.`processingActivitiesLegalBasises`.`sourceShortName` AS `processingActivitiesLegalBasises_sourceShortName`,
				`c0`.`processingActivitiesLegalBasises`.`sourceFullName` AS `processingActivitiesLegalBasises_sourceFullName`,
				MD5(`c0`.`processingActivitiesLegalBasises`.`sourceFullName`) AS `md5_processingActivitiesLegalBasises_sourceFullName`,
				`c0`.`processingActivitiesLegalBasises`.`identifier` AS `processingActivitiesLegalBasises_identifier`,
				`c0`.`processingActivitiesLegalBasises`.`text` AS `processingActivitiesLegalBasises_text`
			FROM
				`c0`.`processingActivitiesLegalBasises`
			WHERE
				`c0`.`processingActivitiesLegalBasises`.`deleteFlag` IS NULL
				AND
				`c0`.`processingActivitiesLegalBasises`.`tempFlag` IS NULL
				AND
				`c0`.`processingActivitiesLegalBasises`.`legacyFlag` IS NULL
			ORDER BY
				`c0`.`processingActivitiesLegalBasises`.`sourceShortName` ASC,
				`c0`.`processingActivitiesLegalBasises`.`identifier` ASC
		");
		$stmt->execute();
		$result = $stmt->get_result();
		
		if(mysqli_num_rows($result) == 0){
		}
		else{
		?>
			<div>
				<div style="column-count:2;">
					<?php
					while($row = mysqli_fetch_assoc($result)){
						if($row['md5_processingActivitiesLegalBasises_sourceFullName'] == $first_md5_Processingactivitieslegasbasises_sourceShortName){
						?>
							<div class="checkbox unchecked" data-identifier="<?php echo purify($row['md5_processingActivitiesLegalBasises_sourceFullName']); ?>" onclick="modalCheckbox(this);"><input id="inputLegalBasis<?php echo purify($row['processingActivitiesLegalBasises_id']); ?>" name="legalBasis<?php echo purify($row['processingActivitiesLegalBasises_id']); ?>" type="checkbox" value="1" <?php if($preferences_shortcutsProcessingActivities_shortcutsNew == 1){echo 'checked';} ?>><label for="LegalBasis<?php echo purify($row['processingActivitiesLegalBasises_id']); ?>"><strong><?php echo purify($row['processingActivitiesLegalBasises_identifier']); ?></strong><br><?php echo purify($row['processingActivitiesLegalBasises_text']); ?></label></div><br>
							<br>
						<?php
						}
						else{
						?>
							<div class="checkbox unchecked" data-identifier="<?php echo purify($row['md5_processingActivitiesLegalBasises_sourceFullName']); ?>" onclick="modalCheckbox(this);" style="display:none;"><input id="inputLegalBasis<?php echo purify($row['processingActivitiesLegalBasises_id']); ?>" name="legalBasis<?php echo purify($row['processingActivitiesLegalBasises_id']); ?>" type="checkbox" value="1" <?php if($preferences_shortcutsProcessingActivities_shortcutsNew == 1){echo 'checked';} ?>><label for="LegalBasis<?php echo purify($row['processingActivitiesLegalBasises_id']); ?>"><strong><?php echo purify($row['processingActivitiesLegalBasises_identifier']); ?></strong><br><?php echo purify($row['processingActivitiesLegalBasises_text']); ?></label></div><br style="display:none;">
							<br style="display:none;">
						<?php
						}
					}
					?>
				</div>
			</div>
		<?php
		}
		$result->close();
		?>
		
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Tilføj">
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