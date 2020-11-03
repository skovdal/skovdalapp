<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/progressTime/getProgressTime.php';

$validateFlag = 200;

$preferences_shortcutsSystemEvents_shortcutsUpdate = getSystemPreferences('shortcutsSystemEvents_shortcutsUpdate');
if($preferences_shortcutsSystemEvents_shortcutsUpdate == -1){
	$preferences_shortcutsSystemEvents_shortcutsUpdate = 0;
}

$preferences_shortcutsSystemEvents_shortcutsExport = getSystemPreferences('shortcutsSystemEvents_shortcutsExport');
if($preferences_shortcutsSystemEvents_shortcutsExport == -1){
	$preferences_shortcutsSystemEvents_shortcutsExport = 0;
}

$preferences_shortcutsSystemEvents_shortcutsTags = getSystemPreferences('shortcutsSystemEvents_shortcutsTags');
if($preferences_shortcutsSystemEvents_shortcutsTags == -1){
	$preferences_shortcutsSystemEvents_shortcutsTags = 1;
}

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

$preferences_orderBySystemEvents_orderBy = getSystemPreferences('orderBySystemEvents_orderBy');
if($preferences_orderBySystemEvents_orderBy == -1){
	$preferences_orderBySystemEvents_orderBy = 'StartTime';
}

function orderBy($request, $preferences_orderBySystemEvents_orderBy){
	if(isset($_GET['orderBy']) === false){
		$orderBy = $preferences_orderBySystemEvents_orderBy;
		
		if($orderBy == 'StartTime'){
			$orderBySort = 'DESC';
		}
		else{
			$orderBySort = 'ASC';
		}
	}
	else{
		$orderBy = $_GET['orderBy'];
		if($orderBy != 'Type' && $orderBy != 'IpAddress' && $orderBy != 'EndTime' && $orderBy != 'Finished' && $orderBy != 'Host' && $orderBy != 'HttpVersion' && $orderBy != 'InstanceId' && $orderBy != 'Method' && $orderBy != 'Status' && $orderBy != 'UserAgent' && $orderBy != 'Version' && $orderBy != 'HttpsEnabled' && $orderBy != 'FileName'){
			$orderBy = 'StartTime';
		}
		
		$orderBySort = $_GET['orderBySort'];
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

function getTags(){
	$validateFlag = 200;
	
	if($validateFlag == 200){
		if(isset($con) === false){$con = dbConnection();}
		$stmt = $con->stmt_init();
		$stmt->prepare("
			SELECT
				DISTINCT(`c0`.`tags`.`name`) AS `tags_name`
			FROM
				`c0`.`tags`
			WHERE
				`c0`.`tags`.`deleteFlag` IS NULL
				AND
				`c0`.`tags`.`tempFlag` IS NULL
				AND
				`c0`.`tags`.`legacyFlag` IS NULL
			ORDER BY
				`c0`.`tags`.`name`
		");
		$stmt->execute();
		$result = $stmt->get_result();
		
		if(mysqli_num_rows($result) == 0){
			$response = '';
		}
		else{
			$response = '';
			
			while($row = mysqli_fetch_assoc($result)){
				$response = $response . '<option value="' . purify($row['tags_name']) . '">';
			}
		}
		$result->close();
			
		return $response;
	}
}

if(isset($_GET['searchStartTime']) === false){
	$searchStartTime = '';
}
else{
	$searchStartTime = $_GET['searchStartTime'];
}

if(isset($_GET['searchIpAddress']) === false){
	$searchIpAddress = '';
}
else{
	$searchIpAddress = $_GET['searchIpAddress'];
}

if(isset($_GET['searchType']) === false){
	$searchType = '';
}
else{
	$searchType = $_GET['searchType'];
}

if(isset($_GET['searchEndTime']) === false){
	$searchEndTime = '';
}
else{
	$searchEndTime = $_GET['searchEndTime'];
}

if(isset($_GET['searchFinished']) === false){
	$searchFinished = '';
}
else{
	$searchFinished = $_GET['searchFinished'];
}

if(isset($_GET['searchHost']) === false){
	$searchHost = '';
}
else{
	$searchHost = $_GET['searchHost'];
}

if(isset($_GET['searchHttpVersion']) === false){
	$searchHttpVersion = '';
}
else{
	$searchHttpVersion = $_GET['searchHttpVersion'];
}

if(isset($_GET['searchInstanceId']) === false){
	$searchInstanceId = '';
}
else{
	$searchInstanceId = $_GET['searchInstanceId'];
}

if(isset($_GET['searchMethod']) === false){
	$searchMethod = '';
}
else{
	$searchMethod = $_GET['searchMethod'];
}

if(isset($_GET['searchStatus']) === false){
	$searchStatus = '';
}
else{
	$searchStatus = $_GET['searchStatus'];
}

if(isset($_GET['searchUserAgent']) === false){
	$searchUserAgent = '';
}
else{
	$searchUserAgent = $_GET['searchUserAgent'];
}

if(isset($_GET['searchVersion']) === false){
	$searchVersion = '';
}
else{
	$searchVersion = $_GET['searchVersion'];
}

if(isset($_GET['searchHttpsEnabled']) === false){
	$searchHttpsEnabled = '';
}
else{
	$searchHttpsEnabled = $_GET['searchHttpsEnabled'];
}

if(isset($_GET['searchFileName']) === false){
	$searchFileName = '';
}
else{
	$searchFileName = $_GET['searchFileName'];
}

if(isset($_GET['searchTags']) === false){
	$searchTags = '';
}
else{
	$searchTags = $_GET['searchTags'];
}

if($validateFlag == 200){
?>
	<!DOCTYPE html>
	
	<html>
		<head>
			
			<meta charset="UTF-8">
			
			<title>Systemhændelser</title>
			
			<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
			<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
			<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
			<link rel="manifest" href="/site.webmanifest">
			<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#000000">
			<meta name="msapplication-TileColor" content="#ffffff">
			<meta name="theme-color" content="#ffffff">		
			
			<style>
				<?php
				require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/css/shared.php.css';
				?>
			</style>
			
			
			<script src="/javascript/shared.js?<?php echo date('YmdHis'); ?>" type="text/javascript" charset="utf-8"></script>
			
			<script>
				window.onpopstate = function(event){
					location.reload();
				};
				
				window.addEventListener('keypress', function(event){
					if(event.key == 'Escape'){
						if(document.querySelectorAll('.modal div.close').length > 0){
							document.querySelectorAll('.modal div.close')[document.querySelectorAll('.modal div.close').length-1].click();
						}
					}
				});
				
				function onLoad(){
					checkSession();
					datatableUpdate('', 'datatable1', 0);
				}
				
				function datatableUpdate(focusElement, datatableId, silent){
					var requestStart = new Date().getTime();
					var openUrl = '/systemEvents/datatable.php';
					var sendParameters = 'orderBy=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=orderBy]')[0].value) +
						'&orderBySort=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=orderBySort]')[0].value) +
						'&searchType=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchType]')[0].value) +
						'&searchIpAddress=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchIpAddress]')[0].value) +
						'&searchStartTime=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchStartTime]')[0].value) +
						'&searchEndTime=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchEndTime]')[0].value) +
						'&searchFinished=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchFinished]')[0].value) +
						'&searchHost=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchHost]')[0].value) +
						'&searchHttpVersion=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchHttpVersion]')[0].value) +
						'&searchInstanceId=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchInstanceId]')[0].value) +
						'&searchMethod=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchMethod]')[0].value) +
						'&searchStatus=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchStatus]')[0].value) +
						'&searchUserAgent=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchUserAgent]')[0].value) +
						'&searchVersion=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchVersion]')[0].value) +
						'&searchHttpsEnabled=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchHttpsEnabled]')[0].value) +
						'&searchFileName=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchFileName]')[0].value) +
						'&searchTags=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchTags]')[0].value);
					
					for(var i = 2; i < document.querySelectorAll('#' + datatableId + ' form table tr').length; i++){
						document.querySelectorAll('#' + datatableId + ' form table tr')[i].innerHTML = '';
					}
					
					if(silent == 0){
						document.querySelectorAll('#' + datatableId + ' > h2')[0].innerHTML = 'Systemhændelser';
						document.title = document.querySelectorAll('#' + datatableId + ' > h2')[0].innerHTML;
						document.querySelectorAll('#' + datatableId + ' form table')[0].insertAdjacentHTML('beforeend', '<tr class="loading"><td colspan="' + document.querySelectorAll('#' + datatableId + ' form table tr td').length + '"><img src="/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/bars.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>" height="75"><div class="progress"><div class="status"></div></div></td></tr>');
						document.querySelectorAll('#' + datatableId + ' form table tr.loading td div.progress > div.status')[0].style.animationDuration = '<?php echo getProgressTime('/systemEvents/datatable.php') . 'ms'; ?>';
					}
					
					var request = new XMLHttpRequest();
					request.onreadystatechange = function(){
						if(request.readyState == 4 && request.status == 200){
							var requestEnd = new Date().getTime();
							addProgressTime(openUrl, requestEnd -requestStart);
							
							for(var i = 2; i < document.querySelectorAll('#' + datatableId + ' form table tr').length; i++){
								document.querySelectorAll('#' + datatableId + ' form table tr')[i].innerHTML = '';
							}
							
							document.querySelectorAll('#' + datatableId + ' form table')[0].insertAdjacentHTML('beforeend', request.responseText);
							document.querySelectorAll('#' + datatableId + ' > h2')[0].innerHTML = 'Systemhændelser (' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form table tr.datatableInfo td input')[0].value) + ')';
							document.title = document.querySelectorAll('#' + datatableId + ' > h2')[0].innerHTML;
							
							history.pushState(
								null,
								null,
								'index.php?' + sendParameters
							);
							
							if(focusElement == ''){
								if(document.querySelectorAll('body div.modal').length == 0){
									document.querySelectorAll('#' + datatableId + ' form input[name=search<?php echo purify($preferences_orderBySystemEvents_orderBy); ?>]')[0].focus();
								}
							}
							else{
								if(document.querySelectorAll('body div.modal').length == 0){
									if(document.body.contains(focusElement)){
										focusElement.focus();
									}	
								}
							}
							
							document.querySelectorAll('#' + datatableId + ' tr th')[0].className = 'checkbox unchecked';
							document.querySelectorAll('#' + datatableId + ' tr th')[0].style.animationName = 'checkboxHeadUnchecked';
							document.querySelectorAll('#' + datatableId + ' tr th input[type="checkbox"]')[0].checked = false;
							
							checkTableVersion(datatableId);
							
							for(var i = 0; i < document.querySelectorAll('#' + datatableId + ' .datatableScript').length; i++){
								eval(document.querySelectorAll('#' + datatableId + ' .datatableScript')[i].value);
							}
						}
						else if(request.readyState == 4 && (request.status == 400 || request.status == 401 || request.status == 404 || request.status == 500)){
							toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?1234-ABCD-5678-EFGH');
						}
					}
					request.open('POST', openUrl);
					request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
					request.ontimeout = function(){toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?1234-ABCD-5678-EFGH');}
					request.send(sendParameters);
				}
				
				function datatableOrderBy(newOrderBy, element, datatableId){
					var currentOrderBy = document.querySelectorAll('#' + datatableId + ' form input[name=orderBy]')[0].value;
					var currentOrderBySort = document.querySelectorAll('#' + datatableId + ' form input[name=orderBySort]')[0].value;
					
					for(var i = 0; i < element.parentElement.querySelectorAll('th').length; i++){
						if(i > 0){
							element.parentElement.querySelectorAll('th')[i].style.backgroundImage = 'none';
						}
						
						element.parentElement.querySelectorAll('th')[i].style.padding = '20px 10px 20px 10px';
					}
					
					if(currentOrderBy == newOrderBy){
						if(document.querySelectorAll('#' + datatableId + ' form input[name=orderBySort]')[0].value == 'ASC'){
							document.querySelectorAll('#' + datatableId + ' form input[name=orderBySort]')[0].value = 'DESC';
							element.style.backgroundImage = 'url("/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>")';
							element.style.padding = '20px 36px 20px 10px';
						}
						else{
							document.querySelectorAll('#' + datatableId + ' form input[name=orderBySort]')[0].value = 'ASC';
							element.style.backgroundImage = 'url("/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>")';
							element.style.padding = '20px 36px 20px 10px';
						}
						
						history.pushState(
							null,
							null,
							'?orderBy=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=orderBy]')[0].value) +
							'&orderBySort=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=orderBySort]')[0].value) +
							'&searchType=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchType]')[0].value) +
							'&searchIpAddress=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchIpAddress]')[0].value) +
							'&searchStartTime=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchStartTime]')[0].value) +
							'&searchEndTime=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchEndTime]')[0].value) +
							'&searchFinished=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchFinished]')[0].value) +
							'&searchHost=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchHost]')[0].value) +
							'&searchHttpVersion=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchHttpVersion]')[0].value) +
							'&searchInstanceId=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchInstanceId]')[0].value) +
							'&searchMethod=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchMethod]')[0].value) +
							'&searchStatus=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchStatus]')[0].value) +
							'&searchUserAgent=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchUserAgent]')[0].value) +
							'&searchVersion=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchVersion]')[0].value) +
							'&searchHttpsEnabled=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchHttpsEnabled]')[0].value) +
							'&searchFileName=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchFileName]')[0].value) +
							'&searchTags=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchTags]')[0].value)
						);
						datatableUpdate(document.querySelectorAll('#' + datatableId + ' form input[name=search' + newOrderBy + ']')[0], datatableId, 0);
					}
					else{
						document.querySelectorAll('#' + datatableId + ' form input[name=orderBy]')[0].value = newOrderBy;
						document.querySelectorAll('#' + datatableId + ' form input[name=orderBySort]')[0].value = 'ASC';
						element.style.padding = '20px 36px 20px 10px';
						element.style.backgroundImage = 'url("/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>")';
						
						history.pushState(
							null,
							null,
							'?orderBy=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=orderBy]')[0].value) +
							'&orderBySort=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=orderBySort]')[0].value) +
							'&searchType=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchType]')[0].value) +
							'&searchIpAddress=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchIpAddress]')[0].value) +
							'&searchStartTime=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchStartTime]')[0].value) +
							'&searchEndTime=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchEndTime]')[0].value) +
							'&searchFinished=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchFinished]')[0].value) +
							'&searchHost=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchHost]')[0].value) +
							'&searchHttpVersion=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchHttpVersion]')[0].value) +
							'&searchInstanceId=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchInstanceId]')[0].value) +
							'&searchMethod=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchMethod]')[0].value) +
							'&searchStatus=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchStatus]')[0].value) +
							'&searchUserAgent=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchUserAgent]')[0].value) +
							'&searchVersion=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchVersion]')[0].value) +
							'&searchHttpsEnabled=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchHttpsEnabled]')[0].value) +
							'&searchFileName=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchFileName]')[0].value) +
							'&searchTags=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchTags]')[0].value)
						);
						datatableUpdate(document.querySelectorAll('#' + datatableId + ' form input[name=search' + newOrderBy + ']')[0], datatableId, 0);
					}
				}
			</script>
		</head>
		
		<body onload="onLoad();">
			<main>
				<div class="main">
					<h1>Systemhændelser</h1>
					
					<div class="nav-btn" onclick="dropdown(this);">
						<div class="dropdown down right">
							<ul>
								<li onclick="modal(0, 'large', '/systemEvents/systemPreferences/modal.php', 'POST', '', true, 1);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/cog.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>');">Præferencer for systemhændelser</li>
								<li onclick="modal(0, 'large', '/systemEvents/configuration/modal.php', 'POST', '', true, 1);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/shield.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>');">Sikkerhedsindstillinger for systemhændelser</li>
							</ul>
						</div>
					</div>
					
					<ul class="breadcrumbs">
						<li onclick="document.location.href='/index.php';"><img height="12" src="/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/home-lg-alt.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>"></li>
						<li onclick="document.location.href='/systemEvents/index.php';">Systemhændelser</li>
					</ul>
					
					<div class="info" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/bars.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>');">
						Her finder du alle systemhændelser.
					</div>
					
					<div class="datatable" id="datatable1">
						<h2>Systemhændelser</h2>
						
						<div class="nav-btn" onclick="dropdown(this);">
							<div class="dropdown down right">
								<ul>
									<li onclick="datatableUpdate('', this.closest('div.datatable').id, 0);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/sync.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>');">Opdater systemhændelser</li>
									<li onclick="if(datatableGetCheckedCheckboxes(this.closest('div.datatable').id) === false){toastr('warning', 'Eksporter markerede systemhændelser', 'Der er ikke markeret nogen systemhændelser.', 0, true, '');}else{modal(0, 'large', '/systemEvents/exportMultiple/modal.php', 'POST', '&systemEvents_id=' + encodeURIComponent(datatableGetCheckedCheckboxes(this.closest('div.datatable').id)), true, 1);}" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/file-export.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>');">Eksporter markerede systemhændelser</li>
									<li onclick="if(datatableGetCheckedCheckboxes(this.closest('div.datatable').id) === false){toastr('warning', 'Tilføj mærke på markerede systemhændelser', 'Der er ikke markeret nogen systemhændelser.', 0, true, '');}else{modal(0, 'basic', '/systemEvents/tagsMultiple/add/modal.php', 'POST', '&systemEvents_id=' + encodeURIComponent(datatableGetCheckedCheckboxes(this.closest('div.datatable').id)), true, 1);}" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/tags.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>');">Tilføj mærke på markerede systemhændelser</li>
								</ul>
							</div>
						</div>
						
						<div class="action-btn circle tags" onclick="if(datatableGetCheckedCheckboxes(this.closest('div.datatable').id) === false){toastr('warning', 'Tilføj mærke på markerede systemhændelser', 'Der er ikke markeret nogen systemhændelser.', 0, true, '');}else{modal(0, 'basic', '/systemEvents/tagsMultiple/add/modal.php', 'POST', '&systemEvents_id=' + encodeURIComponent(datatableGetCheckedCheckboxes(this.closest('div.datatable').id)), true, 1);}" style="<?php if($preferences_shortcutsSystemEvents_shortcutsTags == 1){}else{echo 'display:none;';} ?>"></div>
						<div class="action-btn circle export" onclick="if(datatableGetCheckedCheckboxes(this.closest('div.datatable').id) === false){toastr('warning', 'Eksporter markerede systemhændelser', 'Der er ikke markeret nogen systemhændelser.', 0, true, '');}else{modal(0, 'large', '/systemEvents/exportMultiple/modal.php', 'POST', '&systemEvents_id=' + encodeURIComponent(datatableGetCheckedCheckboxes(this.closest('div.datatable').id)), true, 1);}" style="<?php if($preferences_shortcutsSystemEvents_shortcutsExport == 1){}else{echo 'display:none;';} ?>"></div>
						<div class="action-btn circle update" onclick="datatableUpdate('', this.closest('div.datatable').id, 0);" style="<?php if($preferences_shortcutsSystemEvents_shortcutsUpdate == 1){}else{echo 'display:none;';} ?>"></div>
						
						<hr>
						<form onsubmit="datatableUpdate(document.activeElement, this.closest('div.datatable').id, 0); return false;">
							<input name="orderBy" type="hidden" value="<?php echo orderBy('orderBy', purify($preferences_orderBySystemEvents_orderBy)); ?>">
							<input name="orderBySort" type="hidden" value="<?php echo orderBy('orderBySort', purify($preferences_orderBySystemEvents_orderBy)); ?>">
							
							<table>
								<tr class="search">
									<td>
										
									</td>
									<td style="<?php if($preferences_columnsSystemEvents_columnsType == 1){}else{echo 'display:none;';} ?>">
										<input list="searchTypeList" name="searchType" type="search" value="<?php echo purify($searchType); ?>">
										<datalist id="searchTypeList">
											<option value="danger">
											<option value="info">
											<option value="success">
											<option value="warning">
										</datalist>
									</td>
									<td style="<?php if($preferences_columnsSystemEvents_columnsIpAddress == 1){}else{echo 'display:none;';} ?>">
										<input name="searchIpAddress" type="search" value="<?php echo purify($searchIpAddress); ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemEvents_columnsStartTime == 1){}else{echo 'display:none;';} ?>">
										<input name="searchStartTime" type="search" value="<?php echo purify($searchStartTime); ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemEvents_columnsEndTime == 1){}else{echo 'display:none;';} ?>">
										<input name="searchEndTime" type="search" value="<?php echo purify($searchEndTime); ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemEvents_columnsFinished == 1){}else{echo 'display:none;';} ?>">
										<input name="searchFinished" type="search" value="<?php echo purify($searchFinished); ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemEvents_columnsHost == 1){}else{echo 'display:none;';} ?>">
										<input name="searchHost" type="search" value="<?php echo purify($searchHost); ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemEvents_columnsHost == 1){}else{echo 'display:none;';} ?>">
										<input name="searchHttpVersion" type="search" value="<?php echo purify($searchHttpVersion); ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemEvents_columnsHost == 1){}else{echo 'display:none;';} ?>">
										<input name="searchInstanceId" type="search" value="<?php echo purify($searchInstanceId); ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemEvents_columnsHost == 1){}else{echo 'display:none;';} ?>">
										<input name="searchMethod" type="search" value="<?php echo purify($searchMethod); ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemEvents_columnsHost == 1){}else{echo 'display:none;';} ?>">
										<input name="searchStatus" type="search" value="<?php echo purify($searchStatus); ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemEvents_columnsHost == 1){}else{echo 'display:none;';} ?>">
										<input name="searchUserAgent" type="search" value="<?php echo purify($searchUserAgent); ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemEvents_columnsHost == 1){}else{echo 'display:none;';} ?>">
										<input name="searchVersion" type="search" value="<?php echo purify($searchVersion); ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemEvents_columnsHost == 1){}else{echo 'display:none;';} ?>">
										<input name="searchHttpsEnabled" type="search" value="<?php echo purify($searchHttpsEnabled); ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemEvents_columnsHost == 1){}else{echo 'display:none;';} ?>">
										<input name="searchFileName" type="search" value="<?php echo purify($searchFileName); ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemEvents_columnsTags == 1){}else{echo 'display:none;';} ?>">
										<input list="searchTagsList" name="searchTags" type="search" value="<?php echo purify($searchTags); ?>">
										<datalist id="searchTagsList">
											<?php echo getTags(); ?>
										</datalist>
									</td>
									<td>
										<input style="visibility:hidden;" type="submit">
									</td>
								</tr>
								<tr>
									<th class="checkbox unchecked" onclick="datatableCheckbox(this);">
										<input type="checkbox">
									</th>
									<?php
									if('Type' == orderBy('orderBy', $preferences_orderBySystemEvents_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemEvents_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('Type', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsType == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('Type', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsType == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('Type', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemEvents_columnsType == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										Type
									</th>
									<?php
									if('StartTime' == orderBy('orderBy', $preferences_orderBySystemEvents_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemEvents_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('StartTime', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsStartTime == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('StartTime', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsStartTime == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('StartTime', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemEvents_columnsStartTime == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										Starttid
									</th>
									<?php
									if('EndTime' == orderBy('orderBy', $preferences_orderBySystemEvents_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemEvents_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('EndTime', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsEndTime == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('EndTime', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsEndTime == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('EndTime', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemEvents_columnsEndTime == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										Sluttid
									</th>
									<?php
									if('Status' == orderBy('orderBy', $preferences_orderBySystemEvents_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemEvents_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('Status', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsStatus == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('Status', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsStatus == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('Status', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemEvents_columnsStatus == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										Status
									</th>
									<?php
									if('Finished' == orderBy('orderBy', $preferences_orderBySystemEvents_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemEvents_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('Finished', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsFinished == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('Finished', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsFinished == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('Finished', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemEvents_columnsFinished == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										Afsluttet
									</th>
									<?php
									if('IpAddress' == orderBy('orderBy', $preferences_orderBySystemEvents_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemEvents_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('IpAddress', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsIpAddress == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('IpAddress', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsIpAddress == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('IpAddress', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemEvents_columnsIpAddress == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										IP-adresse
									</th>
									<?php
									if('Host' == orderBy('orderBy', $preferences_orderBySystemEvents_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemEvents_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('Host', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsHost == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('Host', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsHost == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('Host', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemEvents_columnsHost == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										Vært
									</th>
									<?php
									if('HttpVersion' == orderBy('orderBy', $preferences_orderBySystemEvents_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemEvents_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('HttpVersion', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsHttpVersion == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('HttpVersion', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsHttpVersion == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('HttpVersion', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemEvents_columnsHttpVersion == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										HTTP-version
									</th>
									<?php
									if('InstanceId' == orderBy('orderBy', $preferences_orderBySystemEvents_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemEvents_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('InstanceId', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsInstanceId == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('InstanceId', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsInstanceId == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('InstanceId', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemEvents_columnsInstanceId == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										Sessionsid
									</th>
									<?php
									if('Method' == orderBy('orderBy', $preferences_orderBySystemEvents_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemEvents_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('Method', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsMethod == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('Method', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsMethod == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('Method', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemEvents_columnsMethod == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										Metode
									</th>
									<?php
									if('UserAgent' == orderBy('orderBy', $preferences_orderBySystemEvents_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemEvents_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('UserAgent', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsUserAgent == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('UserAgent', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsUserAgent == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('UserAgent', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemEvents_columnsUserAgent == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										Brugeragent
									</th>
									<?php
									if('HttpsEnabled' == orderBy('orderBy', $preferences_orderBySystemEvents_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemEvents_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('HttpsEnabled', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsHttpsEnabled == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('HttpsEnabled', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsHttpsEnabled == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('HttpsEnabled', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemEvents_columnsHttpsEnabled == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										HTTPS
									</th>
									<?php
									if('FileName' == orderBy('orderBy', $preferences_orderBySystemEvents_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemEvents_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('FileName', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsFileName == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('FileName', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsFileName == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('FileName', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemEvents_columnsFileName == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										Filnavn
									</th>
									<?php
									if('Version' == orderBy('orderBy', $preferences_orderBySystemEvents_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemEvents_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('Version', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsVersion == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('Version', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemEvents_columnsVersion == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('Version', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemEvents_columnsVersion == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										Version
									</th>
									<th style="cursor:default; <?php if($preferences_columnsSystemEvents_columnsTags == 1){}else{echo 'display:none;';} ?>">
										Mærker
									</th>
									<th>
										
									</th>
								</tr>
							</table>
						</form>
					</div>
					
					<div class="footer">
						&copy; Copyright 2019 Martin Richard Skovdal
					</div>
				</div>
			</main>
			
			<header>
				<div class="header">
					<div class="button" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/draw-circle.svg'); ?>&fill=<?php echo urlencode('rgba(100,95,195,1)'); ?>'); right:222px;"></div>
					<div class="button" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/bells.svg'); ?>&fill=<?php echo urlencode('rgba(100,95,195,1)'); ?>'); right:148px;"></div>
					<div class="button" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/user-circle.svg'); ?>&fill=<?php echo urlencode('rgba(100,95,195,1)'); ?>'); right:74px;"></div>
					<div class="button" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/search.svg'); ?>&fill=<?php echo urlencode('rgba(100,95,195,1)'); ?>'); right:0px;"></div>
				</div>
			</header>
			<?php
			require_once $_SERVER['DOCUMENT_ROOT'] . '/nav/index.php';
			?>
		</body>
	</html>
	<?php
	if(getSystemConfigurations('logSystemEvents') == 1 || getSystemConfigurations('logSystemEvents') == -1){
		$type = 'view';
		$trigger_systemUsers_id = $_SESSION['systemUsers_id'];
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