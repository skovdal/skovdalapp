<?php
$ftpStream = ftp_connect('waws-prod-am2-223.ftp.azurewebsites.windows.net');
ftp_login($ftpStream, 'DFIS', 'wr26Q6kfEkc0nqrh2vterXhFieyxxwC9NMKZdNMe44mMjw6bqJZYGmAMvisb');
ftp_pasv($ftpStream, true);

$file = 'localfile.txt';

if(ftp_put($ftpStream, '/site/storage/serverfile.txt', $file)){
	echo 'Successfully uploaded.';
}
else{
	echo 'Error uploading.';
}

ftp_close($ftpStream);
?>