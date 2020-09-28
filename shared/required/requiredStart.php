<?php
if(session_status() == PHP_SESSION_NONE){
	session_start();
}

$_SESSION['systemUsers_id'] = 4;
$systemEvents_addEvent_startTime = microtime(true);

require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/encryptEncode/encodeId.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/encryptEncode/decodeId.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/dbConnections/dbConnections.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/systemConfigurations/getSystemConfiguration.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/systemEvents/add/systemSubmit.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/systemPreferences/getSystemPreference.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/tableVersions/getTableVersion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/tableVersions/setTableVersion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/xss/purify.php';
?>