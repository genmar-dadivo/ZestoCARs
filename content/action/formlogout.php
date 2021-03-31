<?php
	session_start();
	if(isset($_SESSION['zcars_auth'])) {
		unset($_SESSION['zcars_auth']);
		echo "<script>window.location.assign('../../')</script>";
	}
	else { echo "<script>window.location.assign('../../')</script>"; }
?>