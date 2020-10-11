<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

function storageSize($size, $precision){
	if($size == -1){
		return 'Ubegrænset';
	}
	else if($size == 0){
		$calculatedSize = number_format(round(0, $precision), $precision, ',', '.');
		$calculatedSizeUnit = 'kB';
		return $calculatedSize . ' ' . $calculatedSizeUnit;
	}
	else if($size > 0 and $size <= 1000000){
		$calculatedSize = number_format(round($size / 1000, $precision), $precision, ',', '.');
		$calculatedSizeUnit = 'kB';
		return $calculatedSize . ' ' . $calculatedSizeUnit;
	}
	else if($size > 0 and $size <= 1000000000){
		$calculatedSize = number_format(round($size / 1000000, $precision), $precision, ',', '.');
		$calculatedSizeUnit = 'MB';
		return $calculatedSize . ' ' . $calculatedSizeUnit;
	}
	else if($size > 0 and $size <= 1000000000000){
		$calculatedSize = number_format(round($size / 1000000000, $precision), $precision, ',', '.');
		$calculatedSizeUnit = 'GB';
		return $calculatedSize . ' ' . $calculatedSizeUnit;
	}
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>