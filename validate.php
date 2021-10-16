<?php
	require_once('PHPOTP/code/rfc6238.php');
	
    $code = $_POST['c'];
    $username = $_POST['username'];
    $password = $_POST['password'];
	$secretkey = 'GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ';
	$currentcode = $code;

	if (TokenAuth6238::verify($secretkey,$currentcode)) {
        if($username == 'admin' && $password == 'admin'){
            echo "Code is valid\n";
            $link_address = "upload_file.php";
            echo "<a href='$link_address'>Link</a>";
        } else {
            echo "Your credentials is invalid\n";
            $tanggal=date('M j H:i:s');
            system("echo " . $tanggal . " GAGAL " . $_SERVER['REMOTE_ADDR'] . " >> /var/www/html/log/report");
        }
	} else {
        if($username == 'admin' && $password == 'admin'){
            echo "Invalid code\n";
        } else {
            echo "Your credentials is invalid\n";
            $tanggal=date('M j H:i:s');
            system("echo " . $tanggal . " GAGAL " . $_SERVER['REMOTE_ADDR'] . " >> /var/www/html/log/report");
        }
	}

//   print sprintf('<img src="%s"/>',TokenAuth6238::getBarCodeUrl('','',$secretkey,'My%20App'));
//   print TokenAuth6238::getTokenCodeDebug($secretkey,0); 