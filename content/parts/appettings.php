<div class="col-lg-12 mt-5">
    <div class="accordion accordion-flush" id="appsettings">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#websettings" aria-expanded="false" aria-controls="websettings">
                    App Settings
                </button>
            </h2>
            <div id="websettings" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#appsettings">
                <div class="accordion-body">
                    <div class="container">
                        <form id="formAppsettings" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col">
                                    <div class="container-profile mb-3">
                                            <div class="content col-lg-3">
                                                <div class="content-overlay"></div>
                                                <img id="imageprev"
                                                class="content-image img-thumbnail rounded float-start" style="max-height: 200px; max-width: 100%;"
                                                id="profile" alt="2x2">
                                                <div class="content-details fadeIn-bottom">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <input type="file" class="form-control  form-control-lg fw-light fs-6 border-1" name="webimages" id="webimages" accept="image/x-png,image/gif,image/jpeg"
                                        onchange="document.getElementById('profile').src = window.URL.createObjectURL(this.files[0])"
                                        placeholder="Web Image" required>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control border-0 shadow-sm" id="webname" name="webname" placeholder="Website Name" autocomplete="off" required>
                                        <label for="webname">Website Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    <button type="submit" id="btnSubmit" class="btn btn-primary"> Submit </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#addmenusettings" aria-expanded="false" aria-controls="addmenusettings">
                    Add Menu
                </button>
            </h2>
            <div id="addmenusettings" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#appsettings">
                <div class="accordion-body">
                    <div class="container">
                        <form id="formMenu">
                            <div class="row mt-3">
                                <div class="col-lg-4">
                                    <div class="form-floating">
                                        <select class="form-select fw-light fs-6 border-0" name="mentype" id="mentype" required>
                                            <option value="" selected disabled>Type</option>
                                            <option value="0"> Section </option>
                                            <option value="1"> Main </option>
                                            <option value="2"> Sub </option>
                                        </select>
                                        <label for="mentype">Menu Type</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <select class="form-select fw-light fs-6 border-0 text-capitalize" name="mainmenu" id="mainmenu" required>
                                            <option value="" selected disabled>Head Menu</option>
                                        </select>
                                        <label for="mainmenu">Main</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control text-capitalize fw-light fs-6 border-0" 
                                        name="menname" id="menname" 
                                        placeholder="Name" autocomplete="off" required>
                                        <label for="menname">Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-12">
                                    <button type="submit" id="btnSubmitmenu" class="btn btn-primary"> Submit </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#menumanagersettings" aria-expanded="false" aria-controls="menumanagersettings">
                    Menu Manager
                </button>
            </h2>
            <div id="menumanagersettings" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#appsettings">
                <div class="accordion-body">
                    <div class="container">
                    </div>
                </div>
            </div>
            <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#userlevelsettings" aria-expanded="false" aria-controls="userlevelsettings">
                    User Level
                </button>
            </h2>
            <div id="userlevelsettings" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#appsettings">
                <div class="accordion-body">
                    <div class="container">
                        <table id="tlevel" class="table table-striped responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 5px;"></th>
                                    <th>LEVEL</th>
                                    <th>NAME</th>
                                    <th>AUTH</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="width: 5px;"></th>
                                    <th>LEVEL</th>
                                    <th>NAME</th>
                                    <th>AUTH</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade border-0" tabindex="-1" role="dialog" aria-hidden="true" id="addauth">
	<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<nav class="navbar navbar-light bg-light">
			</nav>
			<div class="modal-body custom-bg-1">
                <form id="formLevel">
                    <div class="container">
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control border-0 shadow-sm code" id="levelname" maxlength="10" name="name" placeholder="Level Name" autocomplete="off" required>
                                    <label for="levelname">Level Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control border-0 shadow-sm code numberonly level" id="pcvno" maxlength="10" name="level" placeholder="Level" autocomplete="off" required>
                                    <label for="level">Level</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col">
                                Privilege
                            </div>
                        </div>
                        <div class="row mb-3">
                        <?php
                        require '../dbase/dbconfig.php';
                        $sqlsection = "SELECT id, orderid, name FROM menu WHERE type = 0";
                        $stmsection = $con->prepare($sqlsection);
                        $stmsection->execute();
                        $resultssection = $stmsection->fetchAll(PDO::FETCH_ASSOC);
                        if ($stmsection->rowCount() >= 1) {
                            foreach ($resultssection as $rowsection) {
                                $idsection   = $rowsection['id'];
                                $orderidsection   = $rowsection['orderid'];
                                $namesection = ucwords($rowsection['name']);
                                echo '<div class="col">';
                                echo '<div class="form-check">';
                                echo '<input class="form-check-input sectioncheckbox' . $idsection . '" type="checkbox" value="" id="' . $idsection . '">';
                                echo '<label class="form-check-label" for="' . $idsection . '">' . $namesection . '</label>';
                                echo '</div>';
                                $sqlmain = "SELECT id, orderid, name FROM menu WHERE type = 1 AND rootid =  $idsection";
                                $stmmain = $con->prepare($sqlmain);
                                $stmmain->execute();
                                $resultsmain = $stmmain->fetchAll(PDO::FETCH_ASSOC);
                                if ($stmmain->rowCount() >= 1) {
                                    foreach ($resultsmain as $rowmain) {
                                        $idmain     = $rowmain['id'];
                                        $orderidmain     = $rowmain['orderid'];
                                        $namemain   = ucwords($rowmain['name']);
                                        $sqlchecker = "SELECT id FROM menu WHERE rootid =  $idmain";
                                        $stmchecker = $con->prepare($sqlchecker);
                                        $stmchecker->execute();
                                        if ($stmchecker->rowCount() >= 1) {
                                            echo '<div class="form-check">';
                                            echo '<input class="form-check-input maincheckbox' . $idmain . '" type="checkbox" value="" id="' . $idmain . '">';
                                            echo '<label class="form-check-label" for="' . $idmain . '">' . $namemain . '</label>';
                                            echo '</div>';
                                            ?>
                                            <script>
                                                $('.maincheckbox<?php echo $idmain; ?>').change(function () {
                                                    if ($(".sectioncheckbox<?php echo $idsection; ?>").is(':checked')) {
                                                    $('.sectioncheckbox<?php echo $idsection; ?>').prop('checked', true);
                                                    }
                                                    else { $('.sectioncheckbox<?php echo $idsection; ?>').prop('checked', false); }
                                                    
                                                    $('.sectioncheckbox<?php echo $idsection; ?>').prop('checked', true);
                                                });
                                            </script>
                                            <?php
                                            $sqlsub = "SELECT id, orderid, name FROM menu WHERE type = 2 AND rootid =  $idmain";
                                            $stmsub = $con->prepare($sqlsub);
                                            $stmsub->execute();
                                            $resultssub = $stmsub->fetchAll(PDO::FETCH_ASSOC);
                                            if ($stmsub->rowCount() >= 1) {
                                                foreach ($resultssub as $rowsub) {
                                                    $idsub   = $rowsub['id'];
                                                    $orderidsub   = $rowsub['orderid'];
                                                    if ($orderidsub == 0) { $color = 'text-danger'; }
                                                    else { $color = ''; }
                                                    $namesub = ucwords($rowsub['name']);
                                                    echo '<div class="form-check">';
                                                    echo '<input class="form-check-input subcheckbox' . $idsub . '" type="checkbox" value="" id="' . $idsub . '">';
                                                    echo '<label class="form-check-label" for="' . $idsub . '">' . $namesub . '</label>';
                                                    echo '</div>';
                                                    ?>
                                                    <script>
                                                        $('.subcheckbox<?php echo $idsub; ?>').change(function () {
                                                            var maincheckbox<?php echo $idmain; ?> = $(".maincheckbox<?php echo $idmain; ?>").length;
                                                            if (maincheckbox<?php echo $idmain; ?> != 0) {
                                                            $('.maincheckbox<?php echo $idmain; ?>').prop('checked', true);
                                                            }
                                                            else { $('.maincheckbox<?php echo $idmain; ?>').prop('checked', false); }
                                                        });
                                                    </script>
                                                    <?php
                                                }
                                            }
                                        } 
                                        else {
                                            echo '<div class="form-check">';
                                            echo '<input class="form-check-input maincheckbox' . $idmain . '" type="checkbox" value="" id="' . $idmain . '">';
                                            echo '<label class="form-check-label" for="' . $idmain . '">' . $namemain . '</label>';
                                            echo '</div>';
                                            ?>
                                            <script>
                                                $('.subcheckbox<?php echo $idsub; ?>').change(function () {
                                                    var maincheckbox<?php echo $idmain; ?> = $(".maincheckbox<?php echo $idmain; ?>").length;
                                                    if (maincheckbox<?php echo $idmain; ?> != 0) {
                                                    $('.maincheckbox<?php echo $idmain; ?>').prop('checked', true);
                                                    }
                                                    else { $('.maincheckbox<?php echo $idmain; ?>').prop('checked', false); }
                                                });
                                            </script>
                                            <?php
                                        }
                                    }
                                }
                                echo '</div>';
                            }
                        }
                        else { echo "No Data."; }
                        ?>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary"> Create </button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Cancel </button>
                            </div>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>
<script>
    $('.numberonly').keyup(function(event) { this.value = this.value.replace(/[^0-9.\.]/g,''); });
    $('#mentype').on('change', function(e) {
        var mentype = $('#mentype').val();
        $('#mainmenu').empty();
        if (mentype == 0) { 
            $('#mainmenu').prop('required', false);
            $('#mainmenu').append('<option value="" selected disabled>Head Menu</option>'); 
        }
        else {
            $('#mainmenu').prop('required', true);
            $.getJSON('../../content/action/formmenu.php?men=' + mentype, function(data) {
            //alert(data);
                var html = '';
                var len = data.length;
                for (var i = 0; i< len; i++) {
                    html += '<option class="text-capitalize" value="' + data[i].id + '">' + data[i].name + '</option>';
                }
                $('#mainmenu').append(html);
            });
        }
    });
    $.ajax({
        type: 'GET',
        url: '../../content/action/getAppsettings.php',
        success: function(data) {
            var datasplit = data.split(",");
            $('#webname').val(datasplit[1]);
            $("#imageprev").attr("src", "../../assets/img/" + datasplit[0]);
        }
    });
    $('#formAppsettings').on('submit', function(e) {
        $('#btnSubmit').prop("disabled", true);
        $("#btnSubmit").html('Loading ...');
        e.preventDefault();
        var webimages = $('#webimages').prop('files')[0];
        var formData = new FormData(this);
        formData.append('file', webimages);
        $.ajax({
            type: 'POST',
            url: '../../content/action/formappsettings.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                alert(data);
                location.reload();
                $('#btnSubmit').prop("disabled", false);
                $("#btnSubmit").html('Submit');
            }
        });
    });
    $('#formMenu').on('submit', function(e) {
        $('#btnSubmitmenu').prop("disabled", true);
        $("#btnSubmitmenu").html('Loading ...');
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../../content/action/formmenu.php',
            data: $('#formMenu').serialize(),
            success: function(data) {
                $('#btnSubmitmenu').prop("disabled", false);
                $("#btnSubmitmenu").html('Submit');
                alert(data);
                $('#formMenu')[0].reset();
            }
        });
    });
    var table = $('#tlevel').DataTable({
        dom: 'Bfrtip',
        "oLanguage": { "sSearch": "" },
        "ajax": {
            'type': 'POST',
            'url': '../action/getLevelsdata.php',
        },
        initComplete: function () {
            this.api().columns().every( function () {
                var that = this;
                $('input', this.footer()).on('keyup change clear', function () {
                if ( that.search() !== this.value ) { that.search(this.value).draw(); }
                });
            });
        },
        buttons: [
	        {
	            text: 'Add Auth',
	            className: "btn btn-sm btn-primary",
	            action: function (e, dt, node, config) {
	                $('#addauth').appendTo("body");
	                $('#addauth').modal('show');
	            }
	        }
	    ]
    });
</script>