<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/progressTime/getProgressTime.php';

$validateFlag = 200;

$preferences_shortcutsSystemUsers_shortcutsNew = getSystemPreferences('shortcutsSystemUsers_shortcutsNew');
if($preferences_shortcutsSystemUsers_shortcutsNew == -1){
	$preferences_shortcutsSystemUsers_shortcutsNew = 1;
}

$preferences_shortcutsSystemUsers_shortcutsUpdate = getSystemPreferences('shortcutsSystemUsers_shortcutsUpdate');
if($preferences_shortcutsSystemUsers_shortcutsUpdate == -1){
	$preferences_shortcutsSystemUsers_shortcutsUpdate = 1;
}

$preferences_shortcutsSystemUsers_shortcutsExport = getSystemPreferences('shortcutsSystemUsers_shortcutsExport');
if($preferences_shortcutsSystemUsers_shortcutsExport == -1){
	$preferences_shortcutsSystemUsers_shortcutsExport = 0;
}

$preferences_shortcutsSystemUsers_shortcutsTags = getSystemPreferences('shortcutsSystemUsers_shortcutsTags');
if($preferences_shortcutsSystemUsers_shortcutsTags == -1){
	$preferences_shortcutsSystemUsers_shortcutsTags = 1;
}

$preferences_shortcutsSystemUsers_shortcutsDelete = getSystemPreferences('shortcutsSystemUsers_shortcutsDelete');
if($preferences_shortcutsSystemUsers_shortcutsDelete == -1){
	$preferences_shortcutsSystemUsers_shortcutsDelete = 0;
}

$preferences_columnsSystemUsers_columnsName = getSystemPreferences('columnsSystemUsers_columnsName');
if($preferences_columnsSystemUsers_columnsName == -1){
	$preferences_columnsSystemUsers_columnsName = 1;
}

$preferences_columnsSystemUsers_columnsSecurityClearance = getSystemPreferences('columnsSystemUsers_columnsSecurityClearance');
if($preferences_columnsSystemUsers_columnsSecurityClearance == -1){
	$preferences_columnsSystemUsers_columnsSecurityClearance = 0;
}

$preferences_columnsSystemUsers_columnsBlockSignIn = getSystemPreferences('columnsSystemUsers_columnsBlockSignIn');
if($preferences_columnsSystemUsers_columnsBlockSignIn == -1){
	$preferences_columnsSystemUsers_columnsBlockSignIn = 1;
}

$preferences_columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn = getSystemPreferences('columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn');
if($preferences_columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn == -1){
	$preferences_columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn = 0;
}

$preferences_columnsSystemUsers_columnsForceUseOfMultifactorAuthentication = getSystemPreferences('columnsSystemUsers_columnsForceUseOfMultifactorAuthentication');
if($preferences_columnsSystemUsers_columnsForceUseOfMultifactorAuthentication == -1){
	$preferences_columnsSystemUsers_columnsForceUseOfMultifactorAuthentication = 0;
}

$preferences_columnsSystemUsers_columnsEntityType = getSystemPreferences('columnsSystemUsers_columnsEntityType');
if($preferences_columnsSystemUsers_columnsEntityType == -1){
	$preferences_columnsSystemUsers_columnsEntityType = 0;
}

$preferences_columnsSystemUsers_columnsEntityName = getSystemPreferences('columnsSystemUsers_columnsEntityName');
if($preferences_columnsSystemUsers_columnsEntityName == -1){
	$preferences_columnsSystemUsers_columnsEntityName = 1;
}

$preferences_columnsSystemUsers_columnsEntityName2 = getSystemPreferences('columnsSystemUsers_columnsEntityName2');
if($preferences_columnsSystemUsers_columnsEntityName2 == -1){
	$preferences_columnsSystemUsers_columnsEntityName2 = 0;
}

$preferences_columnsSystemUsers_columnsEntityPhone = getSystemPreferences('columnsSystemUsers_columnsEntityPhone');
if($preferences_columnsSystemUsers_columnsEntityPhone == -1){
	$preferences_columnsSystemUsers_columnsEntityPhone = 0;
}

$preferences_columnsSystemUsers_columnsEntityEmail = getSystemPreferences('columnsSystemUsers_columnsEntityEmail');
if($preferences_columnsSystemUsers_columnsEntityEmail == -1){
	$preferences_columnsSystemUsers_columnsEntityEmail = 0;
}

$preferences_columnsSystemUsers_columnsTags = getSystemPreferences('columnsSystemUsers_columnsTags');
if($preferences_columnsSystemUsers_columnsTags == -1){
	$preferences_columnsSystemUsers_columnsTags = 1;
}

$preferences_orderBySystemUsers_orderBy = getSystemPreferences('orderBySystemUsers_orderBy');
if($preferences_orderBySystemUsers_orderBy == -1){
	$preferences_orderBySystemUsers_orderBy = 'Name';
}

function orderBy($request, $preferences_orderBySystemUsers_orderBy){
	if(isset($_GET['orderBy']) === false){
		$orderBy = $preferences_orderBySystemUsers_orderBy;
		$orderBySort = 'ASC';
	}
	else{
		$orderBy = $_GET['orderBy'];
		if($orderBy != 'Name' && $orderBy != 'BlockSignIn' && $orderBy != 'UserMustChangePasswordAtNextSignIn' && $orderBy != 'ForceUseOfMultifactorAuthentication' && $orderBy != 'EntityType' && $orderBy != 'EntityName' && $orderBy != 'EntityName2' && $orderBy != 'EntityPhone' && $orderBy != 'EntityEmail'){
			$orderBy = 'Name';
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

if(isset($_GET['searchName']) === false){
	$searchName = '';
}
else{
	$searchName = $_GET['searchName'];
}

if(isset($_GET['searchEntityType']) === false){
	$searchEntityType = '';
}
else{
	$searchEntityType = $_GET['searchEntityType'];
}

if(isset($_GET['searchEntityName']) === false){
	$searchEntityName = '';
}
else{
	$searchEntityName = $_GET['searchEntityName'];
}

if(isset($_GET['searchEntityName2']) === false){
	$searchEntityName2 = '';
}
else{
	$searchEntityName2 = $_GET['searchEntityName2'];
}

if(isset($_GET['searchEntityPhone']) === false){
	$searchEntityPhone = '';
}
else{
	$searchEntityPhone = $_GET['searchEntityPhone'];
}

if(isset($_GET['searchEntityEmail']) === false){
	$searchEntityEmail = '';
}
else{
	$searchEntityEmail = $_GET['searchEntityEmail'];
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
			
			<title>Systembrugere</title>
			
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
					var openUrl = '/systemUsers/datatable.php';
					var sendParameters = 'orderBy=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=orderBy]')[0].value) +
						'&orderBySort=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=orderBySort]')[0].value) +
						'&searchName=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchName]')[0].value) +
						'&searchEntityType=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchEntityType]')[0].value) +
						'&searchEntityName=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchEntityName]')[0].value) +
						'&searchEntityName2=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchEntityName2]')[0].value) +
						'&searchEntityPhone=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchEntityPhone]')[0].value) +
						'&searchEntityEmail=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchEntityEmail]')[0].value) +
						'&searchTags=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchTags]')[0].value);
					
					for(var i = 2; i < document.querySelectorAll('#' + datatableId + ' form table tr').length; i++){
						document.querySelectorAll('#' + datatableId + ' form table tr')[i].innerHTML = '';
					}
					
					if(silent == 0){
						document.querySelectorAll('#' + datatableId + ' > h2')[0].innerHTML = 'Systembrugere';
						document.title = document.querySelectorAll('#' + datatableId + ' > h2')[0].innerHTML;
						document.querySelectorAll('#' + datatableId + ' form table')[0].insertAdjacentHTML('beforeend', '<tr class="loading"><td colspan="' + document.querySelectorAll('#' + datatableId + ' form table tr td').length + '"><img src="/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/user.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>" height="75"><div class="progress"><div class="status"></div></div></td></tr>');
						document.querySelectorAll('#' + datatableId + ' form table tr.loading td div.progress > div.status')[0].style.animationDuration = '<?php echo getProgressTime('/systemUsers/datatable.php') . 'ms'; ?>';
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
							document.querySelectorAll('#' + datatableId + ' > h2')[0].innerHTML = 'Systembrugere (' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form table tr.datatableInfo td input')[0].value) + ')';
							document.title = document.querySelectorAll('#' + datatableId + ' > h2')[0].innerHTML;
							
							history.pushState(
								null,
								null,
								'index.php?' + sendParameters
							);
							
							if(focusElement == ''){
								if(document.querySelectorAll('body div.modal').length == 0){
									document.querySelectorAll('#' + datatableId + ' form input[name=search<?php echo purify($preferences_orderBySystemUsers_orderBy); ?>]')[0].focus();
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
							'&searchName=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchName]')[0].value) +
							'&searchEntityType=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchEntityType]')[0].value) +
							'&searchEntityName=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchEntityName]')[0].value) +
							'&searchEntityName2=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchEntityName2]')[0].value) +
							'&searchEntityPhone=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchEntityPhone]')[0].value) +
							'&searchEntityEmail=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchEntityEmail]')[0].value) +
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
							'&searchName=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchName]')[0].value) +
							'&searchEntityType=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchEntityType]')[0].value) +
							'&searchEntityName=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchEntityName]')[0].value) +
							'&searchEntityName2=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchEntityName2]')[0].value) +
							'&searchEntityPhone=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchEntityPhone]')[0].value) +
							'&searchEntityEmail=' + encodeURIComponent(document.querySelectorAll('#' + datatableId + ' form input[name=searchEntityEmail]')[0].value) +
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
					<h1>Systembrugere</h1>
					
					<div class="nav-btn" onclick="dropdown(this);">
						<div class="dropdown down right">
							<ul>
								<li onclick="modal(0, 'large', '/systemUsers/systemPreferences/modal.php', 'POST', '', true, 1);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/cog.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>');">Præferencer for systembrugere</li>
								<li onclick="modal(0, 'large', '/systemUsers/configuration/modal.php', 'POST', '', true, 1);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/shield.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>');">Sikkerhedsindstillinger for systembrugere</li>
							</ul>
						</div>
					</div>
					
					<ul class="breadcrumbs">
						<li onclick="document.location.href='/index.php';"><img height="12" src="/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/home-lg-alt.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>"></li>
						<li onclick="document.location.href='/systemUsers/index.php';">Systembrugere</li>
					</ul>
					
					<div class="info" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/user.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>');">
						Her finder du alle systembrugere.
					</div>
					
					<div class="datatable" id="datatable1">
						<h2>Systembrugere</h2>
						
						<div class="nav-btn" onclick="dropdown(this);">
							<div class="dropdown down right">
								<ul>
									<li onclick="modal(0, 'large', '/systemUsers/add/modal.php', 'POST', '', true, 1);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/plus.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>');">Ny systembruger</li>
									<li onclick="datatableUpdate('', this.closest('div.datatable').id, 0);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/sync.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>');">Opdater systembrugere</li>
									<li onclick="if(datatableGetCheckedCheckboxes(this.closest('div.datatable').id) === false){toastr('warning', 'Eksporter markerede systembrugere', 'Der er ikke markeret nogen systembrugere.', 0, true, '');}else{modal(0, 'large', '/systemUsers/exportMultiple/modal.php', 'POST', '&systemUsers_id=' + encodeURIComponent(datatableGetCheckedCheckboxes(this.closest('div.datatable').id)), true, 1);}" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/file-export.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>');">Eksporter markerede systembrugere</li>
									<li onclick="if(datatableGetCheckedCheckboxes(this.closest('div.datatable').id) === false){toastr('warning', 'Tilføj mærke på markerede systembrugere', 'Der er ikke markeret nogen systembrugere.', 0, true, '');}else{modal(0, 'basic', '/systemUsers/tagsMultiple/add/modal.php', 'POST', '&systemUsers_id=' + encodeURIComponent(datatableGetCheckedCheckboxes(this.closest('div.datatable').id)), true, 1);}" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/tags.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>');">Tilføj mærke på markerede systembrugere</li>
									<li onclick="if(datatableGetCheckedCheckboxes(this.closest('div.datatable').id) === false){toastr('warning', 'Slet markerede systembrugere', 'Der er ikke markeret nogen systembrugere.', 0, true, '');}else{modal(0, 'basic', '/systemUsers/deleteMultiple/modal.php', 'POST', '&systemUsers_id=' + encodeURIComponent(datatableGetCheckedCheckboxes(this.closest('div.datatable').id)), true, 1);}" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/trash-alt.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>');">Slet markerede systembrugere</li>
								</ul>
							</div>
						</div>
						
						<div class="action-btn circle delete" onclick="if(datatableGetCheckedCheckboxes(this.closest('div.datatable').id) === false){toastr('warning', 'Slet markerede systembrugere', 'Der er ikke markeret nogen systembrugere.', 0, true, '');}else{modal(0, 'basic', '/systemUsers/deleteMultiple/modal.php', 'POST', '&systemUsers_id=' + encodeURIComponent(datatableGetCheckedCheckboxes(this.closest('div.datatable').id)), true, 1);}" style="<?php if($preferences_shortcutsSystemUsers_shortcutsDelete == 1){}else{echo 'display:none;';} ?>"></div>
						<div class="action-btn circle tags" onclick="if(datatableGetCheckedCheckboxes(this.closest('div.datatable').id) === false){toastr('warning', 'Tilføj mærke på markerede systembrugere', 'Der er ikke markeret nogen systembrugere.', 0, true, '');}else{modal(0, 'basic', '/systemUsers/tagsMultiple/add/modal.php', 'POST', '&systemUsers_id=' + encodeURIComponent(datatableGetCheckedCheckboxes(this.closest('div.datatable').id)), true, 1);}" style="<?php if($preferences_shortcutsSystemUsers_shortcutsTags == 1){}else{echo 'display:none;';} ?>"></div>
						<div class="action-btn circle export" onclick="if(datatableGetCheckedCheckboxes(this.closest('div.datatable').id) === false){toastr('warning', 'Eksporter markerede systembrugere', 'Der er ikke markeret nogen systembrugere.', 0, true, '');}else{modal(0, 'large', '/systemUsers/exportMultiple/modal.php', 'POST', '&systemUsers_id=' + encodeURIComponent(datatableGetCheckedCheckboxes(this.closest('div.datatable').id)), true, 1);}" style="<?php if($preferences_shortcutsSystemUsers_shortcutsExport == 1){}else{echo 'display:none;';} ?>"></div>
						<div class="action-btn circle update" onclick="datatableUpdate('', this.closest('div.datatable').id, 0);" style="<?php if($preferences_shortcutsSystemUsers_shortcutsUpdate == 1){}else{echo 'display:none;';} ?>"></div>
						<div class="action-btn circle add" onclick="modal(0, 'large', '/systemUsers/add/modal.php', 'POST', '', true, 1);" style="<?php if($preferences_shortcutsSystemUsers_shortcutsNew == 1){}else{echo 'display:none;';} ?>"></div>
						
						<hr>
						<form onsubmit="datatableUpdate(document.activeElement, this.closest('div.datatable').id, 0); return false;">
							<input name="orderBy" type="hidden" value="<?php echo orderBy('orderBy', purify($preferences_orderBySystemUsers_orderBy)); ?>">
							<input name="orderBySort" type="hidden" value="<?php echo orderBy('orderBySort', purify($preferences_orderBySystemUsers_orderBy)); ?>">
							
							<table>
								<tr class="search">
									<td>
										
									</td>
									<td style="<?php if($preferences_columnsSystemUsers_columnsName == 1){}else{echo 'display:none;';} ?>">
										<input name="searchName" type="search" value="<?php echo purify($searchName); ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemUsers_columnsSecurityClearance == 1){}else{echo 'display:none;';} ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemUsers_columnsBlockSignIn == 1){}else{echo 'display:none;';} ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn == 1){}else{echo 'display:none;';} ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemUsers_columnsForceUseOfMultifactorAuthentication == 1){}else{echo 'display:none;';} ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemUsers_columnsEntityType == 1){}else{echo 'display:none;';} ?>">
										<input name="searchEntityType" type="search" value="<?php echo purify($searchEntityType); ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemUsers_columnsEntityName == 1){}else{echo 'display:none;';} ?>">
										<input name="searchEntityName" type="search" value="<?php echo purify($searchEntityName); ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemUsers_columnsEntityName2 == 1){}else{echo 'display:none;';} ?>">
										<input name="searchEntityName2" type="search" value="<?php echo purify($searchEntityName2); ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemUsers_columnsEntityPhone == 1){}else{echo 'display:none;';} ?>">
										<input name="searchEntityPhone" type="search" value="<?php echo purify($searchEntityPhone); ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemUsers_columnsEntityEmail == 1){}else{echo 'display:none;';} ?>">
										<input name="searchEntityEmail" type="search" value="<?php echo purify($searchEntityEmail); ?>">
									</td>
									<td style="<?php if($preferences_columnsSystemUsers_columnsTags == 1){}else{echo 'display:none;';} ?>">
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
									if('Name' == orderBy('orderBy', $preferences_orderBySystemUsers_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemUsers_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('Name', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemUsers_columnsName == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('Name', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemUsers_columnsName == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('Name', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemUsers_columnsName == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										Navn
									</th>
									<?php
									if('SecurityClearance' == orderBy('orderBy', $preferences_orderBySystemUsers_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemUsers_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('SecurityClearance', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemUsers_columnsSecurityClearance == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('SecurityClearance', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemUsers_columnsSecurityClearance == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('SecurityClearance', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemUsers_columnsSecurityClearance == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										Sikkerhedsgodkendelse
									</th>
									<?php
									if('BlockSignIn' == orderBy('orderBy', $preferences_orderBySystemUsers_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemUsers_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('BlockSignIn', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemUsers_columnsBlockSignIn == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('BlockSignIn', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemUsers_columnsBlockSignIn == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('BlockSignIn', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemUsers_columnsBlockSignIn == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										Bloker log ind
									</th>
									<?php
									if('UserMustChangePasswordAtNextSignIn' == orderBy('orderBy', $preferences_orderBySystemUsers_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemUsers_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('UserMustChangePasswordAtNextSignIn', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('UserMustChangePasswordAtNextSignIn', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('UserMustChangePasswordAtNextSignIn', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										Brugeren skal ændre adgangskode ved næste log ind
									</th>
									<?php
									if('ForceUseOfMultifactorAuthentication' == orderBy('orderBy', $preferences_orderBySystemUsers_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemUsers_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('ForceUseOfMultifactorAuthentication', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemUsers_columnsForceUseOfMultifactorAuthentication == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('ForceUseOfMultifactorAuthentication', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemUsers_columnsForceUseOfMultifactorAuthentication == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('ForceUseOfMultifactorAuthentication', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemUsers_columnsForceUseOfMultifactorAuthentication == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										Gennemtving brug af flerfaktorautentificering
									</th>
									<?php
									if('EntityType' == orderBy('orderBy', $preferences_orderBySystemUsers_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemUsers_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('EntityType', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemUsers_columnsEntityType == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('EntityType', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemUsers_columnsEntityType == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('EntityType', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemUsers_columnsEntityType == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										Identitetstype
									</th>
									<?php
									if('EntityName' == orderBy('orderBy', $preferences_orderBySystemUsers_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemUsers_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('EntityName', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemUsers_columnsEntityName == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('EntityName', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemUsers_columnsEntityName == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('EntityName', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemUsers_columnsEntityName == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										Identitetsnavn
									</th>
									<?php
									if('EntityName2' == orderBy('orderBy', $preferences_orderBySystemUsers_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemUsers_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('EntityName2', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemUsers_columnsEntityName2 == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('EntityName2', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemUsers_columnsEntityName2 == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('EntityName2', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemUsers_columnsEntityName2 == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										Supplerende identitetsnavn
									</th>
									<?php
									if('EntityPhone' == orderBy('orderBy', $preferences_orderBySystemUsers_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemUsers_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('EntityPhone', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemUsers_columnsEntityPhone == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('EntityPhone', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemUsers_columnsEntityPhone == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('EntityPhone', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemUsers_columnsEntityPhone == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										Identitetstelefon
									</th>
									<?php
									if('EntityEmail' == orderBy('orderBy', $preferences_orderBySystemUsers_orderBy)){
										if(orderBy('orderBySort', $preferences_orderBySystemUsers_orderBy) == 'ASC'){
										?>
											<th onclick="datatableOrderBy('EntityEmail', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-up.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemUsers_columnsEntityEmail == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
										else{
										?>
											<th onclick="datatableOrderBy('EntityEmail', this, this.closest('div.datatable').id);" style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/sort-amount-down.svg'); ?>&fill=<?php echo urlencode('rgba(135,140,145,1)'); ?>'); padding:20px 36px 20px 10px; <?php if($preferences_columnsSystemUsers_columnsEntityEmail == 1){}else{echo 'display:none;';} ?>">
										<?php
										}
									}
									else{
									?>
										<th onclick="datatableOrderBy('EntityEmail', this, this.closest('div.datatable').id);" style="<?php if($preferences_columnsSystemUsers_columnsEntityEmail == 1){}else{echo 'display:none;';} ?>">
									<?php
									}
									?>
										Identitets-e-mail
									</th>
									<th style="cursor:default; <?php if($preferences_columnsSystemUsers_columnsTags == 1){}else{echo 'display:none;';} ?>">
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
	if(getSystemConfigurations('logSystemUsers') == 1 || getSystemConfigurations('logSystemUsers') == -1){
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
	if(getSystemConfigurations('logSystemUsers') == 1 || getSystemConfigurations('logSystemUsers') == -1){
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
