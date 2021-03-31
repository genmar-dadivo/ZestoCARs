<?php
    session_start();
    date_default_timezone_set("Asia/Manila");
    $datetimenow = date('YmdHis');
    if (isset($_SESSION['zcars_auth']) ) { echo "<script type='text/javascript'> window.location = 'content/pages' </script>"; }
?>
<!doctype html>
<html lang="en">
   	<head>
    	<meta charset="utf-8">
      	<meta name="viewport" content="width=device-width, initial-scale=1">
      	<!-- Bootstrap CSS -->
      	<link href="assets/css/bs/bootstrap.min.css" rel="stylesheet">
      	<!-- Animate CSS -->
      	<link href="assets/css/animate/animate.min.css" rel="stylesheet">
      	<!-- OS CSS -->
      	<link href="assets/css/os/css/OverlayScrollbars.min.css" rel="stylesheet">
      	<!-- Custom CSS -->
      	<link href="assets/css/custom/custom.css" rel="stylesheet">
      	<link rel="icon" href="assets/img/logo.png" type="image/gif" sizes="30x30">
      	<title>Zesto | CARS</title>
   </head>
   <body class="noselect custom-bg-1">
      	<div class="container custom-container">
        	<section id="formHolder">
            	<div class="row">
					<div class="col-sm-6 brand">
					</div>
					<div class="col-sm-6 form">
						<div class="signupdiv form-piece switched">
							<form class="signup-form" id="formSignup">
								<div class="sign-panels">
									<div class="signup">
										<input type="text" placeholder="Email Address" autocomplete="off" name="email" id="email" required>
										<input type="text" placeholder="Employee Number" class="numberonly" name="enumber" id="enumber" autocomplete="off" required>
										<input type="text" placeholder="Full Name" class="text-capitalize" name="fname" id="fname" autocomplete="off" required>
										<input type="text" placeholder="Username" autocomplete="off" name="username" id="username" required>
										<input type="password" placeholder="Password" name="password" id="password" autocomplete="on" required>
										<button type="submit" class="btn-signin" id="btnRegister">Register</button>
										<div class="mx-auto" style="width: 130px;">
											<a class="pointer switch fw-lighter text-muted text-decoration-none">I have an account</a>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="logindiv form-piece">
							<form class="login-form" id="formLogin">
								<div class="sign-panels">
									<div class="login">
										<input type="text" placeholder="Username" name="txtUname" id="txtUname" autocomplete="off" required>
										<input type="password" placeholder="Password" name="txtPword" id="txtPword" autocomplete="on" required>
										<button type="submit" class="btn-signin" id="btnSignin">Sign In</button>
										<div class="mx-auto text-center" style="width: 200px;">
											<a class="pointer switch fw-lighter text-muted text-decoration-none">I'm New</a>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
         	</section>
      	</div>
      	<!-- Bootstrap JS -->
      	<script src="assets/js/bs/bootstrap.min.js"></script>
      	<!-- JQuery -->
      	<script src="assets/js/jquery/jquery-3.5.1.min.js"></script>
      	<!-- OS JS -->
      	<script src="assets/js/os/OverlayScrollbars.min.js"></script>
      	<script src="assets/js/os/jquery.overlayScrollbars.min.js"></script>
      	<!-- Popper JS -->
      	<script src="assets/js/popper/popper.min.js"></script>
      	<!-- Push JS -->
      	<script src="assets/js/push/push.min.js"></script>
      	<!-- Input Masking JS -->
      	<script src="assets/js/ib/inputmask.min.js"></script>
		<script src="assets/js/ib/jquery.inputmask.min.js"></script>
		<script src="assets/js/ib/bindings/inputmask.binding.js"></script>
	  	<!-- Custom JS -->
      	<script src="assets/js/cookie/js.cookie.min.js"></script>
		<!-- Custom JS -->
      	<script src="assets/js/custom/custom.js"></script>
   </body>
</html>