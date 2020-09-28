<?php
if(file_exists($_SERVER['DOCUMENT_ROOT'] . parse_url($_SERVER['REQUEST_URI'])['path'])){
	require $_SERVER['DOCUMENT_ROOT'] . parse_url($_SERVER['REQUEST_URI'])['path'];
}
else{
	http_response_code(404);
}
?>