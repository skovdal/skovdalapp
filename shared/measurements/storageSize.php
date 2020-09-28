<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

function storageSize($size, $precision){
	if($size == 0){
		$calculatedSize = number_format(round(0, $precision), 2, ',', '.');
		$calculatedSizeUnit = 'kB';
		return $calculatedSize . ' ' . $calculatedSizeUnit;
	}
	else if($size > 0 and $size <= 1000000){
		$calculatedSize = number_format(round($size / 1000, $precision), 2, ',', '.');
		$calculatedSizeUnit = 'kB';
		return $calculatedSize . ' ' . $calculatedSizeUnit;
	}
	else if($size > 0 and $size <= 1000000000){
		$calculatedSize = number_format(round($size / 1000000, $precision), 2, ',', '.');
		$calculatedSizeUnit = 'MB';
		return $calculatedSize . ' ' . $calculatedSizeUnit;
	}
	else if($size > 0 and $size <= 1000000000000){
		$calculatedSize = number_format(round($size / 1000000000, $precision), 2, ',', '.');
		$calculatedSizeUnit = 'GB';
		return $calculatedSize . ' ' . $calculatedSizeUnit;
	}
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>