<?php
if(isset($con) === true){
	$con->close();
}

if(isset($validateFlag) === true){
	httpStatusCodes($validateFlag);
}

if(isset($errorMessages_id) === true){
	echo $errorMessages_id;
}
?>