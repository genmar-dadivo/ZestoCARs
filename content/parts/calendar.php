<?php
	session_start();
	if (!isset($_SESSION['zcars_auth']) ) { 
		echo "<script type='text/javascript'> window.location = '../../' </script>";
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="../../assets/css/bs/bootstrap.min.css" rel="stylesheet">
    <!-- Animate CSS -->
    <link href="../../assets/css/animate/animate.min.css" rel="stylesheet">
    <!-- OS CSS -->
    <link href="../../assets/css/os/css/OverlayScrollbars.min.css" rel="stylesheet">
    <!-- FA CSS -->
    <link href="../../assets/css/fa/css/fontawesome.min.css" rel="stylesheet">
    <link href="../../assets/css/fa/css/brands.min.css" rel="stylesheet">
    <link href="../../assets/css/fa/css/solid.min.css" rel="stylesheet">
    <!-- FC CSS -->
    <link href="../../assets/js/fc/main.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../assets/css/custom/custom.css" rel="stylesheet">
    <link rel="icon" href="../../assets/img/logo.png" type="image/gif" sizes="30x30">
    <title>Zesto | CARS</title>
  </head>
  <body class="noselect custom-bg-1">
    <div class="container">
      <div class="row mt-5">
        <a onclick="contentloader(0);" class="custom-a"> Back </a>
        <div class="card shadow border-0">
          <div class="card-body">
            <div id='calendar'></div>
          </div>
        </div>
        <div style="min-height: 50px;"></div>
      </div>
    </div>
    <input id="uid" class="hidden" name="uid" value="<?php echo $_SESSION['zcars_auth']; ?>">
    <div class="modal fade" id="add-schedule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <nav class="navbar navbar-light bg-light">
          </nav>
          <div class="modal-body">
            <div class="sched-form">
              <div class="container">
                <form id="formschedule">
                  <input type="hidden" id="startdate" name="startdate">
                  <div class="mt-3 row">
                    <div class="col-lg-12">
                      <div class="form-floating">
                        <input type="text" name="title" class="form-control text-capitalize" id="sched-title" placeholder="Title" autocomplete="off" required>
                        <label for="sched-title">Title</label>
                      </div>
                    </div>
                  </div>
                  <div class="mt-3 row">
                    <div class="col-lg-6">
                      <div class="form-floating">
                        <select class="form-select" id="sched-stime" name="stime" required>
                          <option value="" selected disabled>Time Start</option>
                        </select>
                        <label for="id="sched-stime">Start Time</label>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-floating">
                        <select class="form-select" id="sched-etime" name="etime" required readonly>
                          <option value="" selected disabled>End Time</option>
                        </select>
                        <label for="id="sched-stime">End Time</label>
                      </div>
                    </div>
                  </div>
                  <div class="mt-1 row">
                    <div class="col-lg-12">
                      <div class="form-check">
                        <input class="form-check-input" name="wholeday" type="checkbox" value="check" id="wholeday">
                        <label class="form-check-label pointer" for="wholeday"> Whole Day </label>
                      </div>
                    </div>
                  </div>
                  <div class="mt-3 row">
                    <div class="col-lg-12">
                      <div class="form-floating">
                        <textarea class="form-control custom-no-resize" style="height: 100px;" placeholder="Description" name="description" id="description" autocomplete="off" required></textarea>
                          <label for="address">Description</label>
                      </div>
                    </div>
                  </div>
                  <div class="mt-3 row">
                    <div class="col-sm-2">
                        <button type="submit" id="btnSave" class="custom-btn-1 col-sm-3">Save</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="../../assets/js/bs/bootstrap.min.js"></script>
    <!-- JQuery -->
    <script src="../../assets/js/jquery/jquery-3.5.1.min.js"></script>
    <!-- JQuery UI -->
    <script src="../../assets/js/jquery-ui/jquery-ui.js"></script>
    <!-- FC JS -->
    <script src="../../assets/js/fc/main.min.js"></script>
    <!-- Push JS -->
    <script src="../../assets/js/push/push.min.js"></script>
    <!-- Cookie JS -->
    <script src="../../assets/js/cookie/js.cookie.min.js"></script>
    <!-- OS JS -->
    <script	src="../../assets/js/os/OverlayScrollbars.min.js"></script>
    <script	src="../../assets/js/os/jquery.overlayScrollbars.min.js"></script>
    <!-- Moment JS -->
		<script src="../../assets/js/moment/moment.js"></script>
		<script src="../../assets/js/moment/moment-with-locales.min.js"></script>
    <!-- Custom JS -->
    <script src="../../assets/js/custom/custom.js"></script>
  </body>
</html>