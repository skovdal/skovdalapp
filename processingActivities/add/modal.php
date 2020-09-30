<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if($validateFlag == 200){
?>
	<h1>Ny behandlingsaktivitet</h1>
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
	<form action="/processingActivities/add/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input id="inputName" name="name" pattern=".{3,}" placeholder="Jens Nielsen" type="text" required autofocus><label for="inputName">Navn</label><br>
			<select id="inputSecurityClearance" name="securityClearance" required>
				<option value="1. Til tjenestebrug">1. Til tjenestebrug</option>
				<option value="2. Fortroligt">2. Fortroligt</option>
				<option value="3. Hemmeligt">3. Hemmeligt</option>
				<option value="4. Yderst hemmeligt">4. Yderst hemmeligt</option>
			</select><label for="inputSecurityClearance">Sikkerhedsgodkendelse</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<textarea id="inputPurpose" name="purpose" required></textarea><label>Formål</label><br>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fuser-tag.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					<br><br><br><br><br><br><br><br><br>Der er ikke tilføjet nogen personoplysninger
				</div>
			</div>
			<input class="addContent" onclick="modal(0, 'basic', '/processingActivities/add/personalData/add/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>', true, 1);" type="button" value="Tilføj personoplysninger" autofocus>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fbook.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					<br><br><br><br><br><br><br><br><br>Der er ikke vedhæftet nogen politikker
				</div>
			</div>
			<input class="addContent" onclick="modal(0, 'basic', '/processingActivities/add/policies/attach/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>', true, 1);" type="button" value="Vedhæft politik" autofocus>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fbook-alt.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					<br><br><br><br><br><br><br><br><br>Der er ikke vedhæftet nogen procedurer
				</div>
			</div>
			<input class="addContent" onclick="modal(0, 'basic', '/processingActivities/add/procedures/attach/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>', true, 1);" type="button" value="Tilføj procedure" autofocus>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fserver.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					<br><br><br><br><br><br><br><br><br>Der er ikke tilføjet nogen behandlingssystemer
				</div>
			</div>
			<input class="addContent" onclick="modal(0, 'basic', '/processingActivities/add/systems/add/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>', true, 1);" type="button" value="Tilføj behandlingssystem" autofocus>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fuser-friends.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					<br><br><br><br><br><br><br><br><br>Der er ikke tilføjet nogen registrerede
				</div>
			</div>
			<input class="addContent" onclick="modal(0, 'basic', '/processingActivities/add/dataSubjects/add/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>', true, 1);" type="button" value="Tilføj registreret" autofocus>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fbalance-scale-right.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					<br><br><br><br><br><br><br><br><br>Der er ikke tilføjet nogen risikovurderinger
				</div>
			</div>
			<input class="addContent" onclick="modal(0, 'basic', '/processingActivities/add/riskAssessments/add/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>', true, 1);" type="button" value="Tilføj risikovurdering" autofocus>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fball-pile.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					<br><br><br><br><br><br><br><br><br>Der er ikke tilføjet nogen konsekvensvurderinger
				</div>
			</div>
			<input class="addContent" onclick="modal(0, 'basic', '/processingActivities/add/imapctAssessments/add/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>', true, 1);" type="button" value="Tilføj konsekvensvurdering" autofocus>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="photo" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/user-circle.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>');"></div>
			<input id="inputResponsibleIdentityId" name="responsible_identities_id" type="hidden">
			<input class="photo" id="inputResponsibleIdentityType" type="text" readonly><label>Type</label><br>
			<input class="photo" id="inputResponsibleIdentityName" type="text" readonly><label>Navn</label><br>
			<input class="photo" id="inputResponsibleIdentityName2" type="text" readonly><label>Supplerende navneoplysninger</label><br>
			<input id="inputResponsibleIdentityPhone" type="text" readonly><label>Telefon</label><br>
			<input id="inputResponsibleIdentityEmail" type="text" readonly><label>E-mail</label><br>
			<input class="addContent" onclick="modal(0, 'basic', '/processingActivities/add/responsibleIdentity/associate/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>', true, 1);" type="button" value="Tilknyt identitet" autofocus>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="photo" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/user-circle.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>');"></div>
			<input id="inputDpoIdentityId" name="dpo_identities_id" type="hidden" value="<?php echo encodeId(purify($processingActivities_identities_id)); ?>">
			<input class="photo" id="inputDpoIdentityType" type="text" readonly><label>Type</label><br>
			<input class="photo" id="inputDpoIdentityName" type="text" readonly><label>Navn</label><br>
			<input class="photo" id="inputDpoIdentityName2" type="text" readonly><label>Supplerende navneoplysninger</label><br>
			<input id="inputDpoIdentityPhone" type="text" readonly><label>Telefon</label><br>
			<input id="inputDpoIdentityEmail" type="text" readonly><label>E-mail</label><br>
			<input class="addContent" onclick="modal(0, 'basic', '/processingActivities/add/dpoIdentity/associate/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>', true, 1);" type="button" value="Tilknyt identitet" autofocus>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fuser-tie.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					<br><br><br><br><br><br><br><br><br>Der er ikke tilføjet nogen dataansvarlige
				</div>
			</div>
			<input class="addContent" onclick="modal(0, 'basic', '/processingActivities/add/imapctAssessments/add/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>', true, 1);" type="button" value="Tilføj dataansvarlig" autofocus>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fusers-cog.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					<br><br><br><br><br><br><br><br><br>Der er ikke tilføjet nogen modtagere
				</div>
			</div>
			<input class="addContent" onclick="modal(0, 'basic', '/processingActivities/add/imapctAssessments/add/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>', true, 1);" type="button" value="Tilføj modtager" autofocus>
		</div>
		
		<div class="tagTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="tagContainer"></div>
			<input class="addTag" onclick="modal(0, 'basic', '/processingActivities/add/tags/add/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>', true, 1);" type="button" value="Tilføj mærke" autofocus>
		</div>
		
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Gem behandlingsaktivitet">
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