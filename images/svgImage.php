<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

header('Content-type: image/svg+xml');

$id = $_GET['id'];
$fill = $_GET['fill'];

echo str_replace('<svg', '<svg fill="' . purify($fill) . '"', file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/' . purify($id)));

require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>