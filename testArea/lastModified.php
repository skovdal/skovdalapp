<?php
$files = array_merge(glob("*.php"));
$files = array_combine($files, array_map("filemtime", $files));
arsort($files);

$latest_file = key($files);

echo $latest_file;
?>