function checkTableVersion(datatableId){
	if(document.querySelectorAll('#' + datatableId + ' form table').length > -1){
		var checksum = document.querySelectorAll('#' + datatableId + ' form table tr.datatableInfo td input')[1].value;
		var tableName = document.querySelectorAll('#' + datatableId + ' form table tr.datatableInfo td input')[2].value;
		
		var request = new XMLHttpRequest();
		request.onreadystatechange = function(){
			if(request.readyState == 4 && request.status == 200){
				if(request.responseText == 0){
					var timeoutFunction = function(){checkTableVersion(datatableId);}
					setTimeout(timeoutFunction, 10000);
				}
				else{
					datatableUpdate('', datatableId, 1);
				}
			}
			else if(request.readyState == 4 && (request.status == 400 || request.status == 401 || request.status == 404 || request.status == 500)){
				// toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?3');
			}
		}
		request.open('POST', '/shared/tableVersions/checkTableVersion.php');
		request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		request.ontimeout = function(){toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?4');}
		request.send(
			'tableName=' + encodeURIComponent(tableName) +
			'&checksum=' + encodeURIComponent(checksum)
		);
	}
}

function dragDropFile(event){
	event.preventDefault();
	alert('t');
}

function getDatalistDataAttribute(datalistId, optionValue, dataAttribute){
	if(document.querySelectorAll('#' + datalistId + ' > option[value="' + optionValue + '"]').length > 0){
		return document.querySelectorAll('#' + datalistId + ' > option[value="' + optionValue + '"]')[0].getAttribute('data-' + dataAttribute);
	}
	else{
		return false;
	}
}

function dawa(inputId, targetAddress, targetAddress2, targetZipCode, targetCity, countryInput){
	var request = new XMLHttpRequest();
	request.onreadystatechange = function(){
		if(request.readyState == 4 && request.status == 200){
			document.querySelectorAll('#' + inputId.getAttribute('list'))[0].innerHTML = '';
			
			var arr = request.responseText;
			var arr = JSON.parse(arr);
			var i;
			for(i = 0; i < arr.length; i++){
				document.querySelectorAll('#' + inputId.getAttribute('list'))[0].insertAdjacentHTML('beforeend', '<option value="' + arr[i].tekst + '">');
				
				if(document.querySelectorAll('#' + inputId.getAttribute('list')).length >= 2 || document.querySelectorAll('#' + inputId.getAttribute('list')).length == 0){
					document.querySelectorAll(targetAddress)[0].value = '';
					document.querySelectorAll(targetAddress2)[0].value = '';
					document.querySelectorAll(targetZipCode)[0].value = '';
					document.querySelectorAll(targetCity)[0].value = '';
				}
				else{
					document.querySelectorAll(targetAddress)[0].value = arr[i].adresse.vejnavn;
					if(arr[i].adresse.husnr !== null){
						document.querySelectorAll(targetAddress)[0].value = document.querySelectorAll(targetAddress)[0].value + ' ' + arr[i].adresse.husnr;
					}
					if(arr[i].adresse.etage !== null){
						document.querySelectorAll(targetAddress)[0].value = document.querySelectorAll(targetAddress)[0].value + ', ' + arr[i].adresse.etage + '.';
					}
					if(arr[i].adresse.dør !== null){
						document.querySelectorAll(targetAddress)[0].value = document.querySelectorAll(targetAddress)[0].value + ' ' + arr[i].adresse.dør;
					}
					
					document.querySelectorAll(targetAddress2)[0].value = arr[i].adresse.supplerendebynavn;
					document.querySelectorAll(targetZipCode)[0].value = arr[i].adresse.postnr;
					document.querySelectorAll(targetCity)[0].value = arr[i].adresse.postnrnavn;
				}
			}
		}
		else if(request.readyState == 4 && (request.status == 400 || request.status == 401 || request.status == 404 || request.status == 500)){
			toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?1');
		}
	}
	request.open('GET', 'https://dawa.aws.dk/adresser/autocomplete?q=' + encodeURIComponent(inputId.value));
	request.ontimeout = function(){toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?2');}
	request.send();
}

function checkExportStatus(formId){
	var modalId = formId.querySelectorAll('input[name="modalId"]')[0].value;
	
	var request = new XMLHttpRequest();
	request.onreadystatechange = function(){
		if(request.readyState == 4 && request.status == 200){
			if(request.responseText == '200'){
				document.querySelectorAll('#modal-' + modalId + ' div.close')[0].click();
				toastr('success', 'Eksporter markerede identiteter', 'De markerede identiteter blev eksporterede.', 0, true, '');
			}
			else if(request.responseText == '404'){
				var timeoutFunction = function(){checkExportStatus(formId);}
				setTimeout(timeoutFunction, 500);
			}
		}
		else if(request.readyState == 4 && (request.status == 400 || request.status == 401 || request.status == 404 || request.status == 500)){
			document.querySelectorAll('#modal-' + modalId + ' input[type="submit"]')[0].disabled = false;
			document.querySelectorAll('#modal-' + modalId + ' input[type="submit"]')[0].value = 'Eksporter';
			toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?3');
		}
	}
	request.open('POST', '/export/checkExportStatus.php');
	request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	request.ontimeout = function(){toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?4');}
	request.send(
		'modalId=' + encodeURIComponent(modalId)
	);
}

function validateInput(inputId){
	if(inputId.validity.valid === true){
	}
	else{
	}
}

function submitForm(formId){
	for(var i = 0; i < formId.querySelectorAll('input[type="text"], input[type="tel"], input[type="email"], input[type="number"]').length; i++){
		formId.querySelectorAll('input[type="text"], input[type="tel"], input[type="email"], input[type="number"]')[i].readOnly = true;
		formId.querySelectorAll('input[type="text"], input[type="tel"], input[type="email"], input[type="number"]')[i].blur();
	}
	
	formId.querySelectorAll('input[type="submit"]')[0].disabled = true;
	workingButton(formId.querySelectorAll('input[type="submit"]')[0]);
	
	if(formId.action.indexOf('/exportMultiple/') >= 0){
		checkExportStatus(formId);
	}
}

function workingButton(buttonId){
	setTimeout(function(){
		if(document.body.contains(buttonId) === true){
			if(buttonId.disabled === true){
				buttonId.value = '○ ○ ○';
			}
		}
	}, 0);
	setTimeout(function(){
		if(document.body.contains(buttonId) === true){
			if(buttonId.disabled === true){
				buttonId.value = '● ○ ○';
			}
		}
	}, 500);
	setTimeout(function(){
		if(document.body.contains(buttonId) === true){
			if(buttonId.disabled === true){
				buttonId.value = '● ● ○';
			}
		}
	}, 1000);
	setTimeout(function(){
		if(document.body.contains(buttonId) === true){
			if(buttonId.disabled === true){
				buttonId.value = '● ● ●';
			}
		}
	}, 1500);
	setTimeout(function(){
		if(document.body.contains(buttonId) === true){
			if(buttonId.disabled === true){
				buttonId.value = '○ ● ●';
			}
		}
	}, 2000);
	setTimeout(function(){
		if(document.body.contains(buttonId) === true){
			if(buttonId.disabled === true){
				buttonId.value = '○ ○ ●';
			}
		}
	}, 2500);
	setTimeout(function(){
		if(document.body.contains(buttonId) === true){
			if(buttonId.disabled === true){
				workingButton(buttonId);
			}
		}
	}, 3000);
}

function checkSession(){
	var request = new XMLHttpRequest();
	request.onreadystatechange = function(){
		if(request.readyState == 4 && request.status == 200){
			if(request.responseText == '0'){
				modal('sessionTimeoutNotification', 'basic', '/shared/sessions/sessionTimeoutNotification/modal.php', 'POST', '', true, 1);
			}
			else{
				setTimeout(function(){
					checkSession();
				}, 60000);
			}
		}
		else if(request.readyState == 4 && (request.status == 400 || request.status == 401)){
			modal('sessionInvalidNotification', 'basic', '/shared/sessions/sessionInvalidNotification/modal.php', 'POST', '', true, 1);
		}
		else if(request.readyState == 4 && (request.status == 404 || request.status == 500)){
			toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?5');
		}
	}
	request.open('POST', '/shared/sessions/checkSession.php');
	request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	request.ontimeout = function(){toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?6');}
	request.send(
		'sessionKey=' + encodeURIComponent(sessionStorage.getItem('sessionKey'))
	);
}

function renewSession(){
	var request = new XMLHttpRequest();
	request.onreadystatechange = function(){
		if(request.readyState == 4 && request.status == 200){
			sessionStorage.setItem('sessionKey', request.responseText);
			toastr('success', 'Session', 'Sessionen blev fornyet.', 0, true, '');
			modal('sessionTimeoutNotification', 'basic', '/shared/sessions/sessionTimeoutNotification/modal.php', 'POST', '', true, 1);
		}
		else if(request.readyState == 4 && (request.status == 400 || request.status == 401 || request.status == 404 || request.status == 500)){
			toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?7');
		}
	}
	request.open('POST', '/shared/sessions/renewSession.php');
	request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	request.ontimeout = function(){toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?8');}
	request.send();
}

function addProgressTime(url, time){
	var request = new XMLHttpRequest();
	request.onreadystatechange = function(){
		if(request.readyState == 4 && request.status == 200){
		}
		else if(request.readyState == 4 && (request.status == 400 || request.status == 401 || request.status == 404 || request.status == 500)){
			toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?9');
		}
	}
	request.open('POST', '/shared/progressTime/addProgressTime.php');
	request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	request.ontimeout = function(){toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?10');}
	request.send(
		'url=' + encodeURIComponent(url) +
		'&time=' + encodeURIComponent(time)
	);
}

function darkener(darkenerId){
	function generateDarkenerId(){
		var darkenerId = Math.floor(Math.random() * 123456789123456789);
		
		if(document.querySelectorAll('#darkener-' + darkenerId).length > 0){
			generateDarkenerId();
		}
		else{
			return darkenerId;
		}
	}
	
	var validateFlag = 200;
	
	if(isNaN(darkenerId) === true){
		var validateFlag = 400;
	}
	
	if(validateFlag == 200){
		if(!darkenerId > 0){
			var darkenerId = generateDarkenerId();
		}
		
		if(document.querySelectorAll('#darkener-' + darkenerId).length > 0){
			document.querySelectorAll('#darkener-' + darkenerId)[0].style.animationName = 'darkenerHide';
			
			var timeoutFunction = function(){document.querySelectorAll('#darkener-' + darkenerId)[0].remove();}
			setTimeout(timeoutFunction, 500);
		}
		else{
			document.body.insertAdjacentHTML('beforeend', '<div class="darkener" id="darkener-' + darkenerId + '"></div>');
			document.querySelectorAll('#darkener-' + darkenerId)[0].style.display = 'inline-block';
			document.querySelectorAll('#darkener-' + darkenerId)[0].style.animationName = 'darkenerShow';
		}
	}
	else{
		toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?11');
	}
}

function modalGenerateContent(modalId, contentTabId, noContentMessage){
	if(document.querySelectorAll('#modal-' + modalId + ' div.contentTab')[contentTabId].querySelectorAll('input[type="hidden"][name^="content-name-"]').length > 0){
		document.querySelectorAll('#modal-' + modalId + ' div.contentTab')[contentTabId].querySelectorAll('div.contentContainer')[0].innerHTML = '';
	}
	else{
		document.querySelectorAll('#modal-' + modalId + ' div.contentTab')[contentTabId].querySelectorAll('div.contentContainer')[0].innerHTML = '<div class="noContent"><br><br><br><br><br><br><br><br><br>' + noContentMessage + '</div>';
	}
	
	if(document.querySelectorAll('#modal-' + modalId + ' div.contentTab')[contentTabId].querySelectorAll('input[type="hidden"][name^="content-name-"]').length > 0){
		document.querySelectorAll('#modal-' + modalId + ' div.contentTab')[contentTabId].querySelectorAll('div.contentContainer')[0].insertAdjacentHTML('beforeend', '<table><tr><th>Kategori</th><th>Sårbarhed</th></tr>');
		
		for(var i = 0; i < document.querySelectorAll('#modal-' + modalId + ' div.contentTab')[contentTabId].querySelectorAll('input[type="hidden"][name^="content-name-"]').length; i++){
			document.querySelectorAll('#modal-' + modalId + ' div.contentTab')[contentTabId].querySelectorAll('div.contentContainer > table')[0].insertAdjacentHTML('beforeend', '<tr><td>' + document.querySelectorAll('#modal-' + modalId + ' div.contentTab')[contentTabId].querySelectorAll('input[type="hidden"][name^="content-name-"]')[i].value + '</td><td>' + document.querySelectorAll('#modal-' + modalId + ' div.contentTab')[contentTabId].querySelectorAll('input[type="hidden"][name^="content-type-"]')[i].value + '</td></tr>');
		}
		
		document.querySelectorAll('#modal-' + modalId + ' div.contentTab')[contentTabId].querySelectorAll('div.contentContainer')[0].insertAdjacentHTML('beforeend', '</table>');
	}
}

function modalDeleteTag(tagId, tagName, modalId){
	tagId.remove();
	document.querySelectorAll('#modal-' + modalId + ' div.tagTab > input[name="' + tagName + '"]')[0].remove();
	modalGenerateTags(modalId);
}

function modalGenerateTags(modalId){
	if(document.querySelectorAll('#modal-' + modalId + ' div.tagTab > input[type="hidden"][name^="tag-name-"]').length > 0){
		document.querySelectorAll('#modal-' + modalId + ' div.tagTab div.tagContainer')[0].innerHTML = '';
	}
	else{
		document.querySelectorAll('#modal-' + modalId + ' div.tagTab div.tagContainer')[0].innerHTML = '<div class="noContent"><br><br><br><br><br><br><br><br><br>Der er ikke tilføjet nogen mærker</div>';
	}
	
	for(var i = 0; i < document.querySelectorAll('#modal-' + modalId + ' div.tagTab > input[type="hidden"][name^="tag-name-"]').length; i++){
		var backgroundImage = '/images/svgImage.php?id=' + encodeURIComponent('/images/fontawesome-pro-5.9.0-web/svgs/light/times-circle.svg') + '&fill=' + encodeURIComponent(document.querySelectorAll('#modal-' + modalId + ' div.tagTab > input[type="hidden"][name^="tag-name-"]')[i].getAttribute('data-fontColor'));
		var backgroundColor = document.querySelectorAll('#modal-' + modalId + ' div.tagTab > input[type="hidden"][name^="tag-name-"]')[i].getAttribute('data-backgroundColor');
		var borderColor = document.querySelectorAll('#modal-' + modalId + ' div.tagTab > input[type="hidden"][name^="tag-name-"]')[i].getAttribute('data-borderColor');
		var color = document.querySelectorAll('#modal-' + modalId + ' div.tagTab > input[type="hidden"][name^="tag-name-"]')[i].getAttribute('data-fontColor');
		
		document.querySelectorAll('#modal-' + modalId + ' div.tagTab > div.tagContainer')[0].insertAdjacentHTML('beforeend', '<div class="tag" onclick="modalDeleteTag(this, \'' + document.querySelectorAll('#modal-' + modalId + ' div.tagTab > input[type="hidden"][name^="tag-name-"]')[i].name + '\', \'' + modalId + '\');" style="background-color:' + backgroundColor + '; background-image:url(' + backgroundImage + '); border:1px solid ' + borderColor + '; color:' + color + ';">' + document.querySelectorAll('#modal-' + modalId + ' div.tagTab > input[type="hidden"][name^="tag-name-"]')[i].value + '</div>');
	}
}

function modalTab(modalId, tabId){
	if(document.querySelectorAll('#modal-' + modalId + ' > h1 ~ ul li').length > 0){
		for(var i = 0; i < document.querySelectorAll('#modal-' + modalId + ' > h1 ~ ul li').length; i++){
			document.querySelectorAll('#modal-' + modalId + ' > h1 ~ ul li')[i].className = '';
		}
		document.querySelectorAll('#modal-' + modalId + ' > h1 ~ ul li')[tabId-1].className = 'active';
		
		for(var i = 0; i < document.querySelectorAll('#modal-' + modalId + ' form > div').length; i++){
			document.querySelectorAll('#modal-' + modalId + ' form > div')[i].style.display = 'none';
		}
		document.querySelectorAll('#modal-' + modalId + ' form > div')[tabId-1].style.display = 'block';
		document.querySelectorAll('#modal-' + modalId + ' form > div')[document.querySelectorAll('#modal-' + modalId + ' form > div').length-1].style.display = 'block';
	}
}

function modalTabAlternative(modalId, tabId, dataIdentifier){
	if(document.querySelectorAll('#modal-' + modalId + ' > h1 ~ ul li').length > 0){
		for(var i = 0; i < document.querySelectorAll('#modal-' + modalId + ' > h1 ~ ul li').length; i++){
			document.querySelectorAll('#modal-' + modalId + ' > h1 ~ ul li')[i].className = '';
		}
		document.querySelectorAll('#modal-' + modalId + ' > h1 ~ ul li')[tabId-1].className = 'active';
		
		for(var i = 0; i < document.querySelectorAll('#modal-' + modalId + ' form div.checkbox').length; i++){
			document.querySelectorAll('#modal-' + modalId + ' form div.checkbox')[i].style.display = 'none';
		}
		
		for(var i = 0; i < document.querySelectorAll('#modal-' + modalId + ' form div.checkbox + br').length; i++){
			document.querySelectorAll('#modal-' + modalId + ' form div.checkbox + br')[i].style.display = 'none';
		}
		
		for(var i = 0; i < document.querySelectorAll('#modal-' + modalId + ' form div.checkbox + br + br').length; i++){
			document.querySelectorAll('#modal-' + modalId + ' form div.checkbox + br + br')[i].style.display = 'none';
		}
		
		for(var i = 0; i < document.querySelectorAll('#modal-' + modalId + ' form div.checkbox[data-identifier="' + dataIdentifier + '"]').length; i++){
			document.querySelectorAll('#modal-' + modalId + ' form div.checkbox[data-identifier="' + dataIdentifier + '"]')[i].style.display = 'inline-block';
		}
		
		for(var i = 0; i < document.querySelectorAll('#modal-' + modalId + ' form div.checkbox[data-identifier="' + dataIdentifier + '"] + br').length; i++){
			document.querySelectorAll('#modal-' + modalId + ' form div.checkbox[data-identifier="' + dataIdentifier + '"] + br')[i].style.display = 'inline';
		}
		
		for(var i = 0; i < document.querySelectorAll('#modal-' + modalId + ' form div.checkbox[data-identifier="' + dataIdentifier + '"] + br + br').length; i++){
			document.querySelectorAll('#modal-' + modalId + ' form div.checkbox[data-identifier="' + dataIdentifier + '"] + br + br')[i].style.display = 'inline';
		}
	}
}

function modal(modalId, modalStyle, modalUrl, modalMethod, modalParameters, showHide, tabId){
	function generateModalId(){
		var modalId = Math.floor(Math.random() * 123456789123456789);
		
		if(document.querySelectorAll('#modal-' + modalId).length > 0){
			generateModalId();
		}
		else{
			return modalId;
		}
	}
	
	var validateFlag = 200;
	
	if(isNaN(modalId) === true && modalId != 'sessionTimeoutNotification' && modalId != 'sessionInvalidNotification'){
		var validateFlag = 400;
	}
	
	if(modalStyle != 'basic' && modalStyle != 'small' && modalStyle != 'large' && modalStyle != 'fullWindow' && modalStyle != ''){
		var validateFlag = 400;
	}
	
	if(modalUrl.charAt(0) != '/' && modalUrl != ''){
		var validateFlag = 400;
	}
	
	if(modalMethod != 'GET' && modalMethod != 'POST' && modalMethod != ''){
		var validateFlag = 400;
	}
	
	if(modalParameters == ''){
/* 		var validateFlag = 400; */
	}
	
	if(showHide !== true && showHide !== false){
		var validateFlag = 400;
	}
	
	if(isNaN(tabId) === true && tabId != ''){
		var validateFlag = 400;
	}
	
	if(validateFlag == 200){
		if(showHide === false){
			if(document.querySelectorAll('#modal-' + modalId + ' > h1 ~ ul li').length > 0){
				if(tabId == 0){
					for(var i = 0; i < document.querySelectorAll('#modal-' + modalId + ' > h1 ~ ul li').length; i++){
						if(document.querySelectorAll('#modal-' + modalId + ' > h1 ~ ul li')[i].classList.contains('active') === true){
							var tabId = i +1;
						}
					}
				}
			}
			
			var request = new XMLHttpRequest();
			request.onreadystatechange = function(){
				if(request.readyState == 4 && request.status == 200){
					if(document.querySelectorAll('#modal-' + modalId)[0].getAttribute('class') == 'modal large'){
						document.querySelectorAll('#modal-' + modalId)[0].innerHTML = '<div class="minimizeWindow" onclick="modalMinimizeFromFullWindow(\'' + modalId + '\');"></div><div class="maximizeWindow" onclick="modalMaximizeToFullWindow(\'' + modalId + '\');"></div><div class="close" onclick="modal(\'' + modalId + '\', \'\', \'\', \'\', \'\', true, 0);"></div>' + request.responseText;
						
						document.querySelectorAll('#modal-' + modalId + ' div.maximizeWindow')[0].style.display = 'inline-block';
						document.querySelectorAll('#modal-' + modalId + ' div.minimizeWindow')[0].style.display = 'none';
					}
					else if(document.querySelectorAll('#modal-' + modalId)[0].getAttribute('class') == 'modal fullWindow'){
						document.querySelectorAll('#modal-' + modalId)[0].innerHTML = '<div class="minimizeWindow" onclick="modalMinimizeFromFullWindow(\'' + modalId + '\');"></div><div class="maximizeWindow" onclick="modalMaximizeToFullWindow(\'' + modalId + '\');"></div><div class="close" onclick="modal(\'' + modalId + '\', \'\', \'\', \'\', \'\', true, 0);"></div>' + request.responseText;
						
						document.querySelectorAll('#modal-' + modalId + ' div.maximizeWindow')[0].style.display = 'none';
						document.querySelectorAll('#modal-' + modalId + ' div.minimizeWindow')[0].style.display = 'inline-block';
					}
					else{
						document.querySelectorAll('#modal-' + modalId)[0].innerHTML = '<div class="close" onclick="modal(\'' + modalId + '\', \'\', \'\', \'\', \'\', true, 0);"></div>' + request.responseText;
					}
					
					for(var i = 0; i < document.querySelectorAll('#modal-' + modalId + ' form > div').length; i++){
						document.querySelectorAll('#modal-' + modalId + ' form > div')[i].style.display = 'none';
					}
					document.querySelectorAll('#modal-' + modalId + ' form > div')[0].style.display = 'block';
					document.querySelectorAll('#modal-' + modalId + ' form > div')[document.querySelectorAll('#modal-' + modalId + ' form > div').length-1].style.display = 'block';
					
					if(document.querySelectorAll('#modal-' + modalId + ' div.tagTab > input').length > 0){
						modalGenerateTags(modalId);
					}
					
					modalTab(modalId, tabId);
				}
				else if(request.readyState == 4 && (request.status == 400 || request.status == 401 || request.status == 404 || request.status == 500)){
					toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?12');
					console.log(request.responseText);
				}
			}
			request.open(modalMethod, modalUrl);
			request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
			request.ontimeout = function(){toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?13');}
			request.send(
				'modalId=' + encodeURIComponent(modalId) +
				modalParameters
			);
		}
		else{
			if(modalId == 'sessionTimeoutNotification'){
				var modalId = 'sessionTimeoutNotification';
			}
			else if(modalId == 'sessionInvalidNotification'){
				var modalId = 'sessionInvalidNotification';
			}
			else if(!modalId > 0){
				var modalId = generateModalId();
			}
			
			if(document.querySelectorAll('#modal-' + modalId).length > 0){
				darkener(modalId);
				document.querySelectorAll('#modal-' + modalId)[0].style.animationName = 'modalHide';
				
				var timeoutFunction = function(){document.querySelectorAll('#modal-' + modalId)[0].remove();}
				setTimeout(timeoutFunction, 500);
			}
			else{
				darkener(modalId);
				
				if(modalId == 'sessionTimeoutNotification'){
					document.body.insertAdjacentHTML('beforeend', '<div class="modal ' + modalStyle + '" id="modal-' + modalId + '"><div class="close" onclick="renewSession();"></div></div>');
				}
				else if(modalId == 'sessionInvalidNotification'){
					document.body.insertAdjacentHTML('beforeend', '<div class="modal ' + modalStyle + '" id="modal-' + modalId + '"><div class="close" onclick=""></div></div>');
				}
				else{
					if(modalStyle == 'large'){
						document.body.insertAdjacentHTML('beforeend', '<div class="modal ' + modalStyle + '" id="modal-' + modalId + '"><div class="minimizeWindow" onclick="modalMinimizeFromFullWindow(\'' + modalId + '\');"></div><div class="maximizeWindow" onclick="modalMaximizeToFullWindow(\'' + modalId + '\');"></div><div class="close" onclick="modal(\'' + modalId + '\', \'\', \'\', \'\', \'\', true, 1);"></div></div>');
					}
					else{
						document.body.insertAdjacentHTML('beforeend', '<div class="modal ' + modalStyle + '" id="modal-' + modalId + '"><div class="close" onclick="modal(\'' + modalId + '\', \'\', \'\', \'\', \'\', true, 1);"></div></div>');
					}
				}
				
				document.querySelectorAll('#modal-' + modalId)[0].style.display = 'inline-block';
				document.querySelectorAll('#modal-' + modalId)[0].style.animationName = 'modalShow';
				
				var request = new XMLHttpRequest();
				request.onreadystatechange = function(){
					if(request.readyState == 4 && request.status == 200){
						document.querySelectorAll('#modal-' + modalId)[0].insertAdjacentHTML('beforeend', request.responseText);
						
						if(modalId == 'sessionTimeoutNotification'){
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 30 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 0);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 29 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 1000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 28 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 2000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 27 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 3000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 26 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 4000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 25 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 5000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 24 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 6000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 23 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 7000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 22 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 8000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 21 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 9000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 20 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 10000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 19 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 11000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 18 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 12000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 17 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 13000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 16 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 14000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 15 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 15000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 14 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 16000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 13 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 17000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 12 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 18000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 11 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 19000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 10 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 20000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 9 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 21000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 8 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 22000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 7 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 23000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 6 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 24000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 5 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 25000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 4 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 26000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 3 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 27000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 2 sekunder.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 28000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session udløber snart.<br><br>Du bliver automatisk logget af systemet om 1 sekund.<br><br>Alle data gemmes, så du kan genoptage arbejdet senere.<br>';
								}
							}, 29000);
							setTimeout(function(){
								if(document.querySelectorAll('#modal-' + modalId + ' > .close').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > .close')[0].remove();
								}
								
								if(document.querySelectorAll('#modal-' + modalId + ' > span').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > span')[0].innerHTML = 'Din session er udløbet.<br><br>Alle data er gemt, så du kan genoptage arbejdet senere.<br>';
								}
								
								if(document.querySelectorAll('#modal-' + modalId + ' > form').length > 0){
									document.querySelectorAll('#modal-' + modalId + ' > form')[0].onsubmit = 'document.location.href=\'/notifications/index.php\'';
									document.querySelectorAll('#modal-' + modalId + ' > form')[0].innerHTML = '<hr><div class="buttons"><input type="submit" value="Log på og genoptag arbejdet"></div>';
								}
							}, 30000);
						}
						else if(modalId == 'sessionInvalidNotification'){
							if(document.querySelectorAll('#modal-' + modalId + ' > .close').length > 0){
								document.querySelectorAll('#modal-' + modalId + ' > .close')[0].remove();
							}
							
							if(document.querySelectorAll('#modal-' + modalId + ' > form').length > 0){
								document.querySelectorAll('#modal-' + modalId + ' > form')[0].onsubmit = 'document.location.href=\'/notifications/index.php\'';
							}
						}
						
						for(var i = 0; i < document.querySelectorAll('#modal-' + modalId + ' form > div').length; i++){
							document.querySelectorAll('#modal-' + modalId + ' form > div')[i].style.display = 'none';
						}
						document.querySelectorAll('#modal-' + modalId + ' form > div')[0].style.display = 'block';
						document.querySelectorAll('#modal-' + modalId + ' form > div')[document.querySelectorAll('#modal-' + modalId + ' form > div').length-1].style.display = 'block';
						
						if(document.querySelectorAll('#modal-' + modalId + ' div.tagTab > input').length > 0){
							modalGenerateTags(modalId);
						}
						
						modalTab(modalId, tabId);
						
						for(var i = 0; i < document.querySelectorAll('#modal-' + modalId + ' .modalScript').length; i++){
/* 							eval(document.querySelectorAll('#modal-' + modalId + ' .modalScript')[i].value); */
						}
					}
					else if(request.readyState == 4 && (request.status == 400 || request.status == 401 || request.status == 404 || request.status == 500)){
						toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?14');
						console.log(request.responseText);
					}
				}
				request.open(modalMethod, modalUrl);
				request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
				request.ontimeout = function(){toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?15');}
				request.send(
					'modalId=' + encodeURIComponent(modalId) +
					modalParameters
				);
			}
		}
	}
	else{
		toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?16');
	}
}

function modalCheckbox(dummyCheckbox){
	if(dummyCheckbox.querySelectorAll('input[type="checkbox"]')[0].checked === false){
		dummyCheckbox.className = 'checkbox checked';
		dummyCheckbox.querySelectorAll('input[type="checkbox"]')[0].checked = true;
	}
	else{
		dummyCheckbox.className = 'checkbox unchecked';
		dummyCheckbox.querySelectorAll('input[type="checkbox"]')[0].checked = false;
	}
}

function modalMaximizeToFullWindow(modalId){
	document.querySelectorAll('#modal-' + modalId)[0].className = 'modal fullWindow';
	document.querySelectorAll('#modal-' + modalId + ' div.maximizeWindow')[0].style.display = 'none';
	document.querySelectorAll('#modal-' + modalId + ' div.minimizeWindow')[0].style.display = 'inline-block';
}

function modalMinimizeFromFullWindow(modalId){
	document.querySelectorAll('#modal-' + modalId)[0].className = 'modal large';
	document.querySelectorAll('#modal-' + modalId + ' div.maximizeWindow')[0].style.display = 'inline-block';
	document.querySelectorAll('#modal-' + modalId + ' div.minimizeWindow')[0].style.display = 'none';
}

function toastr(type, title, msg, toastrId, register, openUrl){
	function generateToastrId(){
		var toastrId = Math.floor(Math.random() * 123456789123456789);
		
		if(document.querySelectorAll('#toastr-' + toastrId).length > 0){
			generateToastrId();
		}
		else{
			return toastrId;
		}
	}
	var validateFlag = 200;
	
	if(type != 'danger' && type != 'success' && type != 'info' && type != 'warning' && type != ''){
		var validateFlag = 400;
	}
	
	if(isNaN(toastrId) === true){
		var validateFlag = 400;
	}
	
	if(register !== true && register !== false && register != 1 && register != 0){
		var validateFlag = 400;
	}
	
	if(register == 1){
		register = true;
	}
	else if(register == 0){
		register = false;
	}
	
	if(validateFlag == 200){
		if(!toastrId > 0){
			var toastrId = generateToastrId();
		}
		
		if(document.querySelectorAll('#toastr-' + toastrId).length > 0){
			document.querySelectorAll('#toastr-' + toastrId)[0].style.animationName = 'toastrHide';
			
			var timeoutFunction = function(){document.querySelectorAll('#toastr-' + toastrId)[0].remove();}
			setTimeout(timeoutFunction, 1000);
		}
		else{
			if(document.querySelectorAll('div.toastr').length > 0){
				if(openUrl == ''){
					document.body.insertAdjacentHTML('beforeend', '<div class="toastr" id="toastr-' + toastrId + '"></div>');
				}
				else{
					document.body.insertAdjacentHTML('beforeend', '<div class="toastr" id="toastr-' + toastrId + '" onclick="window.open(\'' + openUrl + '\');" style="pointer-events:auto;"></div>');
				}
				
				var toastrBottom = 0;
				for(var i = 0; i < document.querySelectorAll('div.toastr').length; i++){
					var toastrBottom = toastrBottom + 15 + document.querySelectorAll('div.toastr')[i].offsetHeight;
				}
				
				document.querySelectorAll('#toastr-' + toastrId)[0].style.top = toastrBottom + 'px';
			}
			else{
				if(openUrl == ''){
					document.body.insertAdjacentHTML('beforeend', '<div class="toastr" id="toastr-' + toastrId + '"></div>');
				}
				else{
					document.body.insertAdjacentHTML('beforeend', '<div class="toastr" id="toastr-' + toastrId + '" onclick="window.open(\'' + openUrl + '\');" style="pointer-events:auto;"></div>');
				}
				
				document.querySelectorAll('#toastr-' + toastrId)[0].style.top = '15px';
			}
			
			if(type == 'danger'){
				document.querySelectorAll('#toastr-' + toastrId)[0].style.color = 'var(--color-white)';
				document.querySelectorAll('#toastr-' + toastrId)[0].style.backgroundColor = 'var(--color-danger)';
				document.querySelectorAll('#toastr-' + toastrId)[0].style.backgroundImage = 'url("/images/svgImage.php?id=' + encodeURIComponent('/images/fontawesome-pro-5.9.0-web/svgs/light/exclamation-circle.svg') + '&fill=' + encodeURIComponent('rgba(255,255,255,1)') + '")';
				document.querySelectorAll('#toastr-' + toastrId)[0].innerHTML = '<b>' + title + '</b><br>' + msg + '<div class="countdown"></div>';
			}
			else if(type == 'success'){
				document.querySelectorAll('#toastr-' + toastrId)[0].style.color = 'var(--color-white)';
				document.querySelectorAll('#toastr-' + toastrId)[0].style.backgroundColor = 'var(--color-success)';
				document.querySelectorAll('#toastr-' + toastrId)[0].style.backgroundImage = 'url("/images/svgImage.php?id=' + encodeURIComponent('/images/fontawesome-pro-5.9.0-web/svgs/light/check-circle.svg') + '&fill=' + encodeURIComponent('rgba(255,255,255,1)') + '")';
				document.querySelectorAll('#toastr-' + toastrId)[0].innerHTML = '<b>' + title + '</b><br>' + msg + '<div class="countdown"></div>';
			}
			else if(type == 'info'){
				document.querySelectorAll('#toastr-' + toastrId)[0].style.color = 'var(--color-white)';
				document.querySelectorAll('#toastr-' + toastrId)[0].style.backgroundColor = 'var(--color-info)';
				document.querySelectorAll('#toastr-' + toastrId)[0].style.backgroundImage = 'url("/images/svgImage.php?id=' + encodeURIComponent('/images/fontawesome-pro-5.9.0-web/svgs/light/info-circle.svg') + '&fill=' + encodeURIComponent('rgba(255,255,255,1)') + '")';
				document.querySelectorAll('#toastr-' + toastrId)[0].innerHTML = '<b>' + title + '</b><br>' + msg + '<div class="countdown"></div>';
			}
			else if(type == 'warning'){
				document.querySelectorAll('#toastr-' + toastrId)[0].style.color = 'var(--color-white)';
				document.querySelectorAll('#toastr-' + toastrId)[0].style.backgroundColor = 'var(--color-warning)';
				document.querySelectorAll('#toastr-' + toastrId)[0].style.backgroundImage = 'url("/images/svgImage.php?id=' + encodeURIComponent('/images/fontawesome-pro-5.9.0-web/svgs/light/exclamation-triangle.svg') + '&fill=' + encodeURIComponent('rgba(255,255,255,1)') + '")';
				document.querySelectorAll('#toastr-' + toastrId)[0].innerHTML = '<b>' + title + '</b><br>' + msg + '<div class="countdown"></div>';
			}
			
			document.querySelectorAll('#toastr-' + toastrId)[0].style.display = 'inline-block';
			document.querySelectorAll('#toastr-' + toastrId)[0].style.animationName = 'toastrShow';
			
			var timeoutFunction = function(){toastr(type, title, msg, toastrId, register, openUrl);}
			setTimeout(timeoutFunction, 7000);
			
			if(register == true){
				var request = new XMLHttpRequest();
				request.onreadystatechange = function(){
					if(request.readyState == 4 && request.status == 200){
						document.querySelectorAll('header > div.header > div.button')[1].style.animationDuration = '1s';
						document.querySelectorAll('header > div.header > div.button')[1].style.animationName = 'headerRightButtonsAddToNotificationCenter';
						
						setTimeout(
							function(){
								document.querySelectorAll('header > div.header > div.button')[1].style.animationDuration = 'none';
								document.querySelectorAll('header > div.header > div.button')[1].style.animationName = 'none';
							}
						, 1000);
					}
					else if(request.readyState == 4 && (request.status == 400 || request.status == 401 || request.status == 404 || request.status == 500)){
						toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, false, 'https://errors.complian.app.complian.dev?17');
					}
				}
				request.open('POST', '/systemNotifications/add/systemSubmit.php');
				request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
				request.ontimeout = function(){toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, false, 'https://errors.complian.app.complian.dev?18');}
				request.send(
					'type=' + encodeURIComponent(type) +
					'&title=' + encodeURIComponent(title) +
					'&msg=' + encodeURIComponent(msg)
				);
			}
		}
	}
	else{
		toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?19');
	}
}

function dropdown(dropdown){
	for(var i = 0; i < document.querySelectorAll('div.dropdown').length; i++){
		if(document.querySelectorAll('div.dropdown')[i] == dropdown.querySelectorAll('div.dropdown')[0]){
			if(dropdown.querySelectorAll('div.dropdown')[0].style.display == 'inline-block'){
				dropdown.querySelectorAll('div.dropdown')[0].style.animationName = 'dropdownHide';
				
				var timeoutFunction = function(){dropdown.querySelectorAll('div.dropdown')[0].style.display = 'none';}
				setTimeout(timeoutFunction, 500);
			}
			else{
				document.querySelectorAll('div.dropdown')[i].style.display = 'inline-block';
				
				if(dropdown.querySelectorAll('div.dropdown.down.right').length > 0){
					document.querySelectorAll('div.dropdown')[i].style.animationName = 'dropdownDownRightShow';
				}
				else if(dropdown.querySelectorAll('.dropdown.up.right').length > 0){
					document.querySelectorAll('div.dropdown')[i].style.animationName = 'dropdownUpRightShow';
				}
			}
		}
		else{
			document.querySelectorAll('div.dropdown')[i].style.display = 'none';
		}
	}
}

function datatableCheckbox(dummyCheckbox){
	if(dummyCheckbox.tagName == 'TD'){
		if(dummyCheckbox.querySelectorAll('input[type="checkbox"]')[0].checked === false){
			dummyCheckbox.className = 'checkbox checked';
			dummyCheckbox.style.animationName = 'checkboxChecked';
			dummyCheckbox.querySelectorAll('input[type="checkbox"]')[0].checked = true;
		}
		else{
			dummyCheckbox.className = 'checkbox unchecked';
			dummyCheckbox.style.animationName = 'checkboxUnchecked';
			dummyCheckbox.querySelectorAll('input[type="checkbox"]')[0].checked = false;
		}
		
		if(dummyCheckbox.parentElement.parentElement.parentElement.querySelectorAll('tr td.checkbox > input[type="checkbox"]:checked').length == 0){
			dummyCheckbox.parentElement.parentElement.parentElement.querySelectorAll('tr th.checkbox')[0].className = 'checkbox unchecked';
			dummyCheckbox.parentElement.parentElement.parentElement.querySelectorAll('tr th.checkbox')[0].style.animationName = 'checkboxHeadUnchecked';
			dummyCheckbox.parentElement.parentElement.parentElement.querySelectorAll('tr th.checkbox > input[type="checkbox"]')[0].checked = false;
		}
		else if(dummyCheckbox.parentElement.parentElement.parentElement.querySelectorAll('tr td.checkbox > input[type="checkbox"]:checked').length == dummyCheckbox.parentElement.parentElement.parentElement.querySelectorAll('tr td.checkbox > input[type="checkbox"]').length){
			dummyCheckbox.parentElement.parentElement.parentElement.querySelectorAll('tr th.checkbox')[0].className = 'checkbox checked';
			dummyCheckbox.parentElement.parentElement.parentElement.querySelectorAll('tr th.checkbox')[0].style.animationName = 'checkboxHeadChecked';
			dummyCheckbox.parentElement.parentElement.parentElement.querySelectorAll('tr th.checkbox > input[type="checkbox"]')[0].checked = true;
		}
		else{
			dummyCheckbox.parentElement.parentElement.parentElement.querySelectorAll('tr th.checkbox')[0].className = 'checkbox indeterminate';
			dummyCheckbox.parentElement.parentElement.parentElement.querySelectorAll('tr th.checkbox')[0].style.animationName = 'checkboxHeadIndeterminate';
			dummyCheckbox.parentElement.parentElement.parentElement.querySelectorAll('tr th.checkbox > input[type="checkbox"]')[0].checked = false;
		}
	}
	else if(dummyCheckbox.tagName == 'TH'){
		if(dummyCheckbox.querySelectorAll('input[type="checkbox"]')[0].checked === false){
			dummyCheckbox.className = 'checkbox checked';
			dummyCheckbox.style.animationName = 'checkboxHeadChecked';
			dummyCheckbox.querySelectorAll('input[type="checkbox"]')[0].checked = true;
			
			for(var i = 0; i < dummyCheckbox.parentElement.parentElement.parentElement.querySelectorAll('tr td.checkbox > input[type="checkbox"]').length; i++){
				dummyCheckbox.parentElement.parentElement.parentElement.querySelectorAll('tr td.checkbox')[i].className = 'checkbox checked';
				dummyCheckbox.parentElement.parentElement.parentElement.querySelectorAll('tr td.checkbox')[i].style.animationName = 'checkboxChecked';
				dummyCheckbox.parentElement.parentElement.parentElement.querySelectorAll('tr td.checkbox > input[type="checkbox"]')[i].checked = true;
			}
		}
		else if(dummyCheckbox.querySelectorAll('input[type="checkbox"]')[0].checked === true){
			dummyCheckbox.className = 'checkbox unchecked';
			dummyCheckbox.style.animationName = 'checkboxHeadUnchecked';
			dummyCheckbox.querySelectorAll('input[type="checkbox"]')[0].checked = false;
			
			for(var i = 0; i < dummyCheckbox.parentElement.parentElement.parentElement.querySelectorAll('tr td.checkbox > input[type="checkbox"]').length; i++){
				dummyCheckbox.parentElement.parentElement.parentElement.querySelectorAll('tr td.checkbox')[i].className = 'checkbox unchecked';
				dummyCheckbox.parentElement.parentElement.parentElement.querySelectorAll('tr td.checkbox')[i].style.animationName = 'checkboxUnchecked';
				dummyCheckbox.parentElement.parentElement.parentElement.querySelectorAll('tr td.checkbox > input[type="checkbox"]')[i].checked = false;
			}
		}
	}
}

function datatableGetCheckedCheckboxes(datatableId){
	if(document.querySelectorAll('#' + datatableId + ' td input[type="checkbox"]:checked').length > 0){
		var checkboxesChecked = [];
		for(var i = 0; i < document.querySelectorAll('#' + datatableId + ' td input[type="checkbox"]:checked').length; i++){
			checkboxesChecked.push(document.querySelectorAll('#' + datatableId + ' td input[type="checkbox"]:checked')[i].value);
		}
		return checkboxesChecked;
	}
	else{
		return false;
	}
}