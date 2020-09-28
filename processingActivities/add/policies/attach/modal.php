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
	<h1>Vedhæft politik</h1>
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
						`c0`.`policies`.`id` AS `policies_id`,
						`c0`.`policies`.`type` AS `policies_type`,
						`c0`.`policies`.`name` AS `policies_name`,
						`c0`.`policies`.`name2` AS `policies_name2`,
						`c0`.`policies`.`phone` AS `policies_phone`,
						`c0`.`policies`.`email` AS `policies_email`
					FROM
						`c0`.`policies`
					WHERE
						`c0`.`policies`.`deleteFlag` IS NULL
						AND
						`c0`.`policies`.`tempFlag` IS NULL
						AND
						`c0`.`policies`.`legacyFlag` IS NULL
					ORDER BY
						`c0`.`policies`.`name` ASC
				");
				$stmt->execute();
				$result = $stmt->get_result();
				
				if(mysqli_num_rows($result) == 0){
				?>
					<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fbook.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
						Der er ikke tilføjet nogen politikker
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
								<td onclick="
									document.querySelectorAll('#modal-<?php echo purify($refererModalId); ?> #inputEntityId')[0].value = '<?php echo purify($row['policies_id']); ?>';
									document.querySelectorAll('#modal-<?php echo purify($refererModalId); ?> #inputEntityType')[0].value = '<?php echo purify($row['policies_type']); ?>';
									document.querySelectorAll('#modal-<?php echo purify($refererModalId); ?> #inputEntityName')[0].value = '<?php echo purify($row['policies_name']); ?>';
									document.querySelectorAll('#modal-<?php echo purify($refererModalId); ?> #inputEntityName2')[0].value = '<?php echo purify($row['policies_name2']); ?>';
									document.querySelectorAll('#modal-<?php echo purify($refererModalId); ?> #inputEntityPhone')[0].value = '<?php echo purify($row['policies_phone']); ?>';
									document.querySelectorAll('#modal-<?php echo purify($refererModalId); ?> #inputEntityEmail')[0].value = '<?php echo purify($row['policies_email']); ?>';
									">
									<?php
									echo purify($row['policies_name']);
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