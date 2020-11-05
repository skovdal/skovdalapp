<?php
function httpStatusCodes($statusCode){
	if($statusCode == 100){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Continue', true, $statusCode);
	}
	else if($statusCode == 101){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Switching Protocols', true, $statusCode);
	}
	else if($statusCode == 102){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Processing', true, $statusCode);
	}
	else if($statusCode == 103){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Early Hints', true, $statusCode);
	}
	else if($statusCode == 200){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' OK', true, $statusCode);
	}
	else if($statusCode == 201){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Created', true, $statusCode);
	}
	else if($statusCode == 202){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Accepted', true, $statusCode);
	}
	else if($statusCode == 203){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Non-Authoritative Information', true, $statusCode);
	}
	else if($statusCode == 204){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' No Content', true, $statusCode);
	}
	else if($statusCode == 205){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Reset Content', true, $statusCode);
	}
	else if($statusCode == 206){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Partial Content', true, $statusCode);
	}
	else if($statusCode == 207){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Multi-Status', true, $statusCode);
	}
	else if($statusCode == 208){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Already Reported', true, $statusCode);
	}
	else if($statusCode == 226){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' IM Used', true, $statusCode);
	}
	else if($statusCode == 300){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Multiple Choices', true, $statusCode);
	}
	else if($statusCode == 301){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Moved Permanently', true, $statusCode);
	}
	else if($statusCode == 302){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Found', true, $statusCode);
	}
	else if($statusCode == 303){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' See Other', true, $statusCode);
	}
	else if($statusCode == 304){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Not Modified', true, $statusCode);
	}
	else if($statusCode == 305){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Use Proxy', true, $statusCode);
	}
	else if($statusCode == 306){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Switch Proxy', true, $statusCode);
	}
	else if($statusCode == 307){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Temporary Redirect', true, $statusCode);
	}
	else if($statusCode == 308){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Permanent Redirect', true, $statusCode);
	}
	else if($statusCode == 400){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Bad Request', true, $statusCode);
	}
	else if($statusCode == 401){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Unauthorized', true, $statusCode);
	}
	else if($statusCode == 402){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Payment Required', true, $statusCode);
	}
	else if($statusCode == 403){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Forbidden', true, $statusCode);
	}
	else if($statusCode == 404){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Not Found', true, $statusCode);
	}
	else if($statusCode == 405){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Method Not Allowed', true, $statusCode);
	}
	else if($statusCode == 406){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Not Acceptable', true, $statusCode);
	}
	else if($statusCode == 407){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Proxy Authentication Required', true, $statusCode);
	}
	else if($statusCode == 408){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Request Timeout', true, $statusCode);
	}
	else if($statusCode == 409){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Conflict', true, $statusCode);
	}
	else if($statusCode == 410){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Gone', true, $statusCode);
	}
	else if($statusCode == 411){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Length Required', true, $statusCode);
	}
	else if($statusCode == 412){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Precondition Failed', true, $statusCode);
	}
	else if($statusCode == 413){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Payload Too Large', true, $statusCode);
	}
	else if($statusCode == 414){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' URI Too Long', true, $statusCode);
	}
	else if($statusCode == 415){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Unsupported Media Type', true, $statusCode);
	}
	else if($statusCode == 416){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Range Not Satisfiable', true, $statusCode);
	}
	else if($statusCode == 417){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Expectation Failed', true, $statusCode);
	}
	else if($statusCode == 421){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Misdirected Request', true, $statusCode);
	}
	else if($statusCode == 422){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Unprocessable Entity', true, $statusCode);
	}
	else if($statusCode == 423){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Locked', true, $statusCode);
	}
	else if($statusCode == 424){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Failed Dependency', true, $statusCode);
	}
	else if($statusCode == 425){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Too Early', true, $statusCode);
	}
	else if($statusCode == 426){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Upgrade Required', true, $statusCode);
	}
	else if($statusCode == 428){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Precondition Required', true, $statusCode);
	}
	else if($statusCode == 429){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Too Many Requests', true, $statusCode);
	}
	else if($statusCode == 431){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Request Header Fields Too Large', true, $statusCode);
	}
	else if($statusCode == 451){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Unavailable For Legal Reasons', true, $statusCode);
	}
	else if($statusCode == 500){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Internal Server Error', true, $statusCode);
	}
	else if($statusCode == 501){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Not Implemented', true, $statusCode);
	}
	else if($statusCode == 502){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Bad Gateway', true, $statusCode);
	}
	else if($statusCode == 503){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Service Unavailable', true, $statusCode);
	}
	else if($statusCode == 504){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Gateway Timeout', true, $statusCode);
	}
	else if($statusCode == 505){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' HTTP Version Not Supported', true, $statusCode);
	}
	else if($statusCode == 506){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Variant Also Negotiates', true, $statusCode);
	}
	else if($statusCode == 507){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Insufficient Storage', true, $statusCode);
	}
	else if($statusCode == 508){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Loop Detected', true, $statusCode);
	}
	else if($statusCode == 510){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Not Extended', true, $statusCode);
	}
	else if($statusCode == 511){
		return header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode ' Network Authentication Required', true, $statusCode);
	}
}
?>