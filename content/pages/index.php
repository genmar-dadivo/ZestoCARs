<?php
	require '../dbase/dbconfig.php';
	session_start();
	if (!isset($_SESSION['zcars_auth']) ) { 
		echo "<script type='text/javascript'> window.location = '../../' </script>";
	}
	else {
		$zcars_auth = $_SESSION['zcars_auth'];
		$sql = "SELECT eidnum FROM tuser WHERE uname = '$zcars_auth' ";
        $stm = $con->prepare($sql);
        $stm->execute();
		if ($stm->rowCount() == 1) {
			$row = $stm->fetch();
			$eidnum = $row['eidnum'];
		}
		else { $eidnum = ''; }
	}
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Bootstrap CSS -->
		<link href="../../assets/css/bs/bootstrap.min.css" rel="stylesheet">
		<!-- Animate CSS -->
		<link href="../../assets/css/animate/animate.min.css" rel="stylesheet">
		<!-- OS CSS -->
		<link href="../../assets/css/os/css/OverlayScrollbars.min.css" rel="stylesheet">
		<!-- Datatable CSS -->
		<link rel="stylesheet" href="../../assets/js/dt/css/dataTables.bootstrap4.min.css">
    	<link rel="stylesheet" href="../../assets/js/dt/css/responsive.dataTables.min.css">
        <!-- FA CSS -->
        <link href="../../assets/css/fa/css/fontawesome.min.css" rel="stylesheet">
        <link href="../../assets/css/fa/css/brands.min.css" rel="stylesheet">
        <link href="../../assets/css/fa/css/solid.min.css" rel="stylesheet">
		<!-- Quill CSS -->
		<link href="../../assets/js/quill/css/quill.bubble.css" rel="stylesheet">
		<link href="../../assets/js/quill/css/quill.snow.css" rel="stylesheet">
		<!-- CMD CSS -->
		<link href="../../assets/js/cmd/cmd.min.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="../../assets/css/custom/custom.css" rel="stylesheet">
		<link rel="icon" href="../../assets/img/logo.png" type="image/gif" sizes="30x30">
		<title>Zesto | CARs</title>
	</head>
	<body class="noselect custom-bg-1">
        <div class="page-wrapper chiller-theme toggled">
            <a id="show-sidebar" class="btn btn-sm btn-dark" href="#" style="z-index: 999;">
                <i class="fas fa-bars"></i>
            </a>
            <main class="page-content navbar-light">
				<nav class="navbar fixed-top navbar-light custom-bg-3" style="z-index: 10;">
					<div class="container-fluid">
						<a class="navbar-brand fs-5" href="#"></a>
						<a class="section_name fw-light text-reset custom-a"> {section_name} </a>
						<input id="bodyid" class="hidden">
						<input id="uname" class="hidden" value="<?php echo $_SESSION['zcars_auth']; ?>">
						<input id="uid" class="hidden" value="<?php echo $eidnum; ?>">
					</div>
				</nav>
				<div id="page-content"></div>
            </main>
			<nav id="sidebar" class="sidebar-wrapper">
            </nav>
        </div>
		<!-- Bootstrap JS -->
		<script src="../../assets/js/bs/bootstrap.min.js"></script>
		<script src="../../assets/js/bs/bootstrap.bundle.min.js"></script>
		<script src="../../assets/js/bs/bootstrap.esm.min.js"></script>
		<!-- JQuery -->
		<script src="../../assets/js/jquery/jquery-3.5.1.min.js"></script>
		<!-- JQuery UI -->
		<script src="../../assets/js/jquery-ui/jquery-ui.js"></script>
		<!-- Datatable JS -->
		<script src="../../assets/js/dt/js/jquery.dataTables.min.js"></script>
		<script src="../../assets/js/dt/js/dataTables.bootstrap4.min.js"></script>
		<script src="../../assets/js/dt/js/dataTables.responsive.min.js"></script>
		<script src="../../assets/js/dt/js/dataTables.buttons.min.js"></script>   
		<script src="../../assets/js/dt/js/buttons.flash.min.js"></script>    
		<script src="../../assets/js/dt/js/buttons.html5.min.js"></script>    
		<script src="../../assets/js/dt/js/buttons.print.min.js"></script>
		<script src="../../assets/js/dt/js/jszip.min.js"></script>    
		<script src="../../assets/js/dt/js/pdfmake.min.js"></script>    
		<script src="../../assets/js/dt/js/vfs_fonts.js"></script> 
		<!-- OS JS -->
		<script	src="../../assets/js/os/OverlayScrollbars.min.js"></script>
		<script	src="../../assets/js/os/jquery.overlayScrollbars.min.js"></script>
		<!-- Popper JS -->
		<script src="../../assets/js/popper/popper.min.js"></script>
		<!-- Push JS -->
		<script src="../../assets/js/push/push.min.js"></script>
		<!-- Cookie JS -->
		<script src="../../assets/js/cookie/js.cookie.min.js"></script>
		<!-- Input Masking -->
		<script src="../../assets/js/ib/inputmask.min.js"></script>
		<script src="../../assets/js/ib/jquery.inputmask.min.js"></script>
		<script src="../../assets/js/ib/bindings/inputmask.binding.js"></script>
		<!-- Quill TE JS -->
		<script src="../../assets/js/quill/js/quill.min.js"></script>
		<script src='../../assets/js/quill/js/to-markdown.min.js'></script>
		<script src='../../assets/js/quill/js/markdown-it.min.js'></script>
		<!-- Tilt JS -->
		<script src="../../assets/js/tilt/tilt.jquery.min.js"></script>
		<!-- Moment JS -->
		<script src="../../assets/js/moment/moment.js"></script>
		<script src="../../assets/js/moment/moment-with-locales.min.js"></script>
		<!-- Webcam JS -->
		<script src="../../assets/js/webcam/webcam.min.js"></script>
		<!-- BS Notify JS -->
		<script src="../../assets/js/notify/bootstrap-notify.min.js"></script>
		<!-- CMD JS -->
		<script src="../../assets/js/cmd/cmd.min.js"></script>
		<!-- QR JS -->
		<script src="../../assets/js/qr/qrcode.min.js"></script>
		<!-- Custom JS -->
		<script src="../../assets/js/custom/custom.js"></script>
	</body>
</html>