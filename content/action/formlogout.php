<?php
	session_start();
	require '../dbase/dbconfig.php';
	if(isset($_SESSION['zcars_auth'])) {
		$uname = $_SESSION['zcars_auth'];
		$sqloffline = "UPDATE tuser SET status = 0 WHERE uname = '$uname'";
        $stmoffline = $con->prepare($sqloffline);
        $stmoffline->execute();
		if ($stmoffline->rowCount() == 1) {
			echo "<script>
				window.location.assign('../../')
			</script>";
			unset($_SESSION['zcars_auth']);
		}
	}
	else { echo "<script>window.location.assign('../../')</script>"; }
?>