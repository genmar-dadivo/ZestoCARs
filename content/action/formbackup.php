<?php
	include ('dumper.php');
	date_default_timezone_set("Asia/Manila");
	$Ynow = date('Y');
    $MDnow = date('md');
	$Bfolder = '../dbase/' . $Ynow . '/';
	$Cbfolder = '../dbase/' . $Ynow . '/' . $MDnow;
	if (!file_exists($Bfolder)) {
	    mkdir($Bfolder, 0777, true);
	    if (!file_exists($Cbfolder)) { mkdir($Cbfolder, 0777, true); }
	}
	elseif (file_exists($Bfolder)) {
		if (!file_exists($Cbfolder)) { mkdir($Cbfolder, 0777, true); }
	}
	try {
		$Bckp = Shuttle_Dumper::create(array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db_name' => 'zesto',
		));
		$Bckp->dump($Cbfolder . '/zesto.sql');
	}
	catch(Shuttle_Exception $e) { echo "Couldn't dump database: " . $e->getMessage(); }
?>