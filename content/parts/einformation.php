<?php date_default_timezone_set("Asia/Manila"); ?>
<div class="row">
    <form id="formEinfo" class="container" enctype="multipart/form-data">
        <br>
        <br>
        <input type="text" name="euname" id="euname" class="hidden">
        <div class="personalinfo">
            <div class="mt-5 row">
                <div class="col-sm-3">
                    <div class="container-profile mb-3">
                        <div class="content">
                            <div class="content-overlay"></div>
                            <img src="../../assets/img/thumbnail.png"
                            class="content-image img-thumbnail rounded float-start" style="max-height: 200px; max-width: 100%;"
                            id="profile" alt="2x2">
                            <div class="content-details fadeIn-bottom">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <span style="font-size: 3em; color: rgb(255, 255, 255);">
                                            <a class="custom-a">
                                                <i class="fas fa-id-card pointer view-id"></i>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3 row 2x2upload">
                <div class="col-sm-11">
                    <input type="file" class="form-control form-control-lg fw-light fs-6 border-0" name="epicture" id="epicture" accept="image/x-png,image/gif,image/jpeg"
                    onchange="document.getElementById('profile').src = window.URL.createObjectURL(this.files[0])"
                    placeholder="2x2 Picture">
                </div>
                <div class="col">
                    <i id="qrid" class="popover__title fas fa-qrcode fa-3x pointer qrid"  data-bs-container="body" data-bs-toggle="popover"></i>
                    <div id="selector">
                    </div>
                </div>
            </div>
            <div class="mt-3 row namearea">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control text-capitalize fw-light fs-6 border-0" 
                        name="firstname" id="firstname" 
                        placeholder="First Name" autocomplete="off" required>
                        <label for="firstname">First Name</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control text-capitalize fw-light fs-6 border-0" 
                        name="middlename" id="middlename" 
                        placeholder="Middle Name" autocomplete="off" required>
                        <label for="middlename">Middle Name</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control text-capitalize fw-light fs-6 border-0" 
                        name="lastname" id="lastname" 
                        placeholder="Last Name" autocomplete="off" required>
                        <label for="lastname">Last Name</label>
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-floating">
                        <input type="text" class="form-control text-uppercase fw-light fs-6 border-0" 
                        name="namesuffix" id="namesuffix" 
                        placeholder="NS" autocomplete="off" required>
                        <label for="namesuffix">NS</label>
                    </div>
                </div>
            </div>
            <div class="mt-3 row bdate">
                <div class="col-sm-6">
                    <div class="form-floating">
                        <input type="text" onfocus="this.type='date'" onblur="this.type='text'" class="form-control fw-light fs-6 border-0" name="birthdate" id="birthdate" 
                        max="<?php echo date('Y-m-d'); ?>" placeholder="Birth Date" required>
                        <label for="birthdate">Birth Date</label>
                    </div>
                </div>
            </div>
            <div class="mt-3 row gender">
                <div class="col-sm-6">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sex" id="male" value="1">
                        <label class="form-check-label" for="male"> Male </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sex" id="female" value="0">
                        <label class="form-check-label" for="female"> Female </label>
                    </div>
                </div>
            </div>
            <div class="mt-3 row address">
                <div class="col-sm-12">
                    <div class="form-floating">
                        <textarea class="form-control custom-no-resize text-capitalize fw-light fs-6 border-0" style="height: 100px;" placeholder="Address" name="address" id="address" autocomplete="off" required></textarea>
                        <label for="address">Address</label>
                    </div>
                </div>
            </div>
            <div class="mt-3 row permaaddress">
                <div class="col-sm-12">
                    <div class="form-floating">
                        <textarea class="form-control custom-no-resize text-capitalize fw-light fs-6 border-0" style="height: 100px;" placeholder="Permanent Address" name="permaaddress" id="permaaddress" autocomplete="off" required></textarea>
                        <label for="permaaddress">Permanent Address</label>
                    </div>
                </div>
            </div>
            <div class="mt-1 row checkerpermaaddress">
                <div class="col-sm-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="permanentaddress">
                        <label class="form-check-label pointer" for="permanentaddress">
                          Same with current address
                        </label>
                      </div>
                </div>
            </div>
            <div class="mt-3 row phonenumber">
                <div class="col-sm-12">
                    <div class="form-floating">
                        <input type="text" class="form-control text-capitalize fw-light fs-6 border-0" 
                        name="phonenumber" id="phonenumber" 
                        placeholder="Phone Number" autocomplete="off" required>
                        <label for="phonenumber">Phone Number</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="presentwork">
            <div class="mt-3 row idnum">
                <div class="col-sm-6">
                    <div class="form-floating">
                        <input type="text" class="form-control text-capitalize fw-light fs-6 border-0" 
                        name="eidnumber" id="eidnumber" 
                        placeholder="ID Number" autocomplete="off" required>
                        <label for="eidnumber">ID Number</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-floating">
                        <input type="text" class="form-control text-capitalize fw-light fs-6 border-0" 
                        name="company" id="company" 
                        placeholder="Company" autocomplete="off" required>
                        <label for="company">Company</label>
                    </div>
                </div>
            </div>
            <div class="mt-3 row designation">
                <div class="col-sm-6">
                    <div class="form-floating">
                        <select class="form-select fw-light fs-6 border-0" name="region" id="region" required>
                            <option value="" selected disabled>Region</option>
                        </select>
                        <label for="region">Region</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-floating">
                        <select class="form-select fw-light fs-6 border-0" name="department" id="department" required>
                            <option value="" selected disabled>Department</option>
                            <?php
							    require '../dbase/dbconfig.php';
								$sql = "SELECT * FROM department ORDER BY department ASC";
								$stm = $con->prepare($sql);
								$stm->execute();
								$results = $stm->fetchAll(PDO::FETCH_ASSOC);
								foreach ($results as $row) {
								    $id = $row['id'];
									$department = ucwords($row['department']);
									    echo "<option value='$id'> $department </option>";
								}
							?>
                        </select>
                        <label for="department">Department</label>
                    </div>
                </div>
            </div>
            <div class="mt-3 row jobtitle">
                <div class="col-sm-12">
                    <div class="form-floating">
                        <div class="form-floating">
                            <input type="text" class="form-control text-capitalize fw-light fs-6 border-0" 
                            name="position" id="position" 
                            placeholder="Position" autocomplete="off" required>
                            <label for="position">Position</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3 row prevcomp">
                <div class="col-sm-12">
                    <div class="form-floating">
                        <input type="text" class="form-control text-capitalize fw-light fs-6 border-0 letteronly" 
                        name="prevdept" id="prevdept" 
                        placeholder="Previous Department" autocomplete="off" required>
                        <label for="prevdept">Previous Department</label>
                    </div>
                </div>
            </div>
            <div class="mt-3 row datehired">
                <div class="col-sm-6">
                    <div class="form-floating">
                        <input type="text" onfocus="this.type='date'" onblur="this.type='text'" class="form-control fw-light fs-6 border-0" name="datehired" id="datehired" 
                        max="<?php echo date('Y-m-d'); ?>" placeholder="Date Hired" required>
                        <label for="datehired">Date Hired</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-floating">
                        <input type="text" onfocus="this.type='date'" onblur="this.type='text'" class="form-control fw-light fs-6 border-0" name="dateregular" id="dateregular" 
                        max="<?php echo date('Y-m-d'); ?>" placeholder="Date Regular" required>
                        <label for="dateregular">Date Regular</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="govids">
            <div class="mt-3 row">
                <div class="col-sm-4">
                    <div class="form-floating">
                        <input type="text" class="form-control numberonly fw-light fs-6 border-0" 
                        name="sss" id="sss" 
                        placeholder="SSS No." autocomplete="off" required>
                        <label for="sss">SSS No.</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-floating">
                        <input type="text" class="form-control numberonly fw-light fs-6 border-0" 
                        name="philhealth" id="philhealth" 
                        placeholder="Philhealth" autocomplete="off" required>
                        <label for="philhealth">Philhealth</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-floating">
                        <input type="text" class="form-control numberonly fw-light fs-6 border-0" 
                        name="tin" id="tin" 
                        placeholder="Full Name" autocomplete="off" required>
                        <label for="tin">TIN</label>
                    </div>
                </div>
            </div>
            <div class="mt-3 row">
                <div class="col-sm-6">
                    <div class="form-floating">
                        <input type="text" class="form-control numberonly fw-light fs-6 border-0" 
                        name="pagibigmid" id="pagibigmid" 
                        placeholder="PAGIBIG (MID)" autocomplete="off" required>
                        <label for="pagibigmid">PAGIBIG (MID)</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-floating">
                        <input type="text" class="form-control numberonly fw-light fs-6 border-0" 
                        name="pagibigrtn" id="pagibigrtn" 
                        placeholder="PAGIBIG (RTN)" autocomplete="off" required>
                        <label for="pagibigrtn">PAGIBIG (RTN)</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="insurance">
            <div class="mt-3 row">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control numberonly fw-light fs-6 border-0" 
                        name="coco" id="coco" 
                        placeholder="Cocolife No." autocomplete="off" required>
                        <label for="coco">Cocolife No.</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control numberonly fw-light fs-6 border-0" 
                        name="ins" id="ins" 
                        placeholder="Amount" autocomplete="off" required>
                        <label for="ins">Amount</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="schools">
            <div class="mt-3 row">
                <div class="col-sm-12">
                    <div class="form-floating">
                        <input type="text" class="form-control text-capitalize fw-light fs-6 border-0" 
                        name="college" id="college" 
                        placeholder="College" autocomplete="off" required>
                        <label for="college">College</label>
                    </div>
                </div>
            </div>
            <div class="mt-3 row">
                <div class="col-sm-12">
                    <div class="form-floating">
                        <input type="text" class="form-control text-capitalize fw-light fs-6 border-0" 
                        name="hs" id="hs" 
                        placeholder="Highschool" autocomplete="off" required>
                        <label for="hs">Highschool</label>
                    </div>
                </div>
            </div>
            <div class="mt-3 row">
                <div class="col-sm-12">
                    <div class="form-floating">
                        <input type="text" class="form-control text-capitalize fw-light fs-6 border-0" 
                        name="elem" id="elem" 
                        placeholder="Elementary" autocomplete="off" required>
                        <label for="elem">Elementary</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="workhistory">
            <div class="mt-3 row workhistory">
                <div class="col-sm-12">
                    <div class="form-floating">
                        <textarea class="form-control custom-no-resize text-capitalize fw-light fs-6 border-0" style="height: 250px;" placeholder="Work History" name="workhist" id="workhist" autocomplete="off"></textarea>
                        <label for="wh">Work History</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="emergency">
            <div class="mt-3 row emergencyphonenumber">
                <div class="col-sm-12">
                    <div class="form-floating">
                        <input type="text" class="form-control fw-light fs-6 border-0" 
                        name="ephonenumber" id="ephonenumber" 
                        placeholder="Emergency Phone Number" autocomplete="off" required>
                        <label for="ephonenumber">Emergency Phone Number</label>
                    </div>
                </div>
            </div>
            <div class="mt-3 row contactperson">
                <div class="col-sm-6">
                    <div class="form-floating">
                        <input type="text" class="form-control text-capitalize fw-light fs-6 border-0" 
                        name="contactperson" id="contactperson" 
                        placeholder="Contact Person" autocomplete="off" required>
                        <label for="contactperson">Contact Person</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-floating">
                        <input type="text" class="form-control text-capitalize fw-light fs-6 border-0" 
                        name="contactpersonrelation" id="contactpersonrelation" 
                        placeholder="Contact Person" autocomplete="off" required>
                        <label for="contactpersonrelation">Relation</label>
                    </div>
                </div>
            </div>
            <div class="mt-3 row emergencyaddress">
                <div class="col-sm-12">
                    <div class="form-floating">
                        <textarea class="form-control custom-no-resize text-capitalize fw-light fs-6 border-0" name="eaddress" id="eaddress" style="height: 100px;" placeholder="Emergency Address" autocomplete="off" required></textarea>
                        <label for="eaddress">Emergency Address</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3 row">
            <div class="col-sm-2">
                <button type="submit" id="btnSubmit" class="custom-btn-1 col-sm-3">Submit</button>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="view-idcard" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        <img src="../../assets/img/sample-bg-min.jpg" class="img-fluid" alt="...">
        </div>
    </div>
</div>
<script>
    $('.view-id').click(function(e) {
        $('#view-idcard').appendTo("body");
        $('#view-idcard').modal('show');
    });
    $('.numberonly').keyup(function(event) { this.value = this.value.replace(/[^0-9.\.]/g,''); });
    $(document).ready(function(){
        var qrid = document.getElementById('qrid');
        var popover = new bootstrap.Popover(qrid, {
            html: true,
            container: "body",
            placement: "left",
            template: '<div class="popover" role="tooltip"><div class="popover-arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
        });
        $('#sss').inputmask("99-9999999-9");
        $('#pagibigrtn').inputmask("9999-9999-9999");
        $('#pagibigmid').inputmask("9999-9999-9999");
        $('#philhealth').inputmask("99-999999999-9");
        $('#tin').inputmask("999-999-999-0");
        $('#eidnumber').inputmask("99-999999");
        $('#phonenumber, #ephonenumber').inputmask("(+63)-9999999999");
        var uid = $('#uid').val();
        $.ajax({
            type: "GET",
            url: '../../content/action/getEinfo.php?euid=' + uid,
            success: function(data) {
                var udata = data.split(",");
                $('#firstname').val(udata[0]);
                $('#middlename').val(udata[1]);
                $('#lastname').val(udata[2]);
                $('#namesuffix').val(udata[3]);
                $('#birthdate').val(udata[4]);
                if (udata[5] == 1) {
                    $('#male').prop('checked', true);
                    $('#female').prop('checked', false);
                }
                else {
                    $('#male').prop('checked', false);
                    $('#female').prop('checked', true);
                }
                $('#address').val(udata[6]);
                $('#permaaddress').val(udata[7]);
                if (udata[6] == udata[7]) { $('#permanentaddress').prop('checked', true); }
                $('#phonenumber').val(udata[8]);
                $('#eidnumber').val(udata[9]);
                $('#eidnumber').click();
                $('#company').val(udata[10]);
                $("#region option[value='" + udata[11] + "']").prop('selected', true);
                $("#department option[value='" + udata[12] + "']").prop('selected', true);
                $('#position').val(udata[13]);
                $('#prevdept').val(udata[14]);
                $('#datehired').val(udata[15]);
                $('#dateregular').val(udata[16]);
                $('#sss').val(udata[17]);
                $('#philhealth').val(udata[10]);
                $('#tin').val(udata[10]);
                $('#pagibigmid').val(udata[10]);
                $('#pagibigrtn').val(udata[10]);
                $('#coco').val(udata[10]);
                $('#ins').val(udata[10]);
                $('#college').val(udata[10]);
                $('#hs').val(udata[10]);
                $('#elem').val(udata[10]);
                $('#workhist').val(udata[10]);
                $('#ephonenumber').val(udata[10]);
                $('#contactperson').val(udata[10]);
                $('#contactpersonrelation').val(udata[10]);
                $('#eaddress').val(udata[10]);
            }
        });
    });
    $('#profile img[width=16][height=16]').css({border:'1px solid red'});
    $("#epicture").change(function() {
        var val = $(this).val();
        switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
            case 'gif': case 'jpg': case 'png':
                $('#btnSubmit').prop("disabled", false);
                break;
            default:
                $(this).val('');
                $('#btnSubmit').prop("disabled", true);
                break;
        }
    });
    // Einfo Mecha
    $('#formEinfo').on('submit', function(e) {
        // $('#btnSubmit').prop("disabled", true);
        // $("#btnSubmit").html('Loading ...');
        e.preventDefault();
        var epicture = $('#epicture').prop('files')[0];
        var formData = new FormData(this);
        formData.append('file', epicture);
        $.ajax({
            type: 'POST',
            url: '../../content/action/formeinfo.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                alert(data);
                Push.create("ZestCARs", {
                    body: data,
                    icon: 'https://img.favpng.com/22/25/10/zest-o-philippines-logo-corporation-business-png-favpng-Brbj4NqJYBXtHd0E28th7r3dQ.jpg',
                    //timeout: 4000,
                    onClick: function() {
                        window.focus();
                        this.close();
                    },
                    onClose: function() { },
                });
                // window.location.href = '';
            }
        });
    });
    // Populate region
    $.getJSON( "../../assets/js/area/regions.json", function(data) {
        var region = $('#region');
        var roptions = "";
        $.each(data, function (i, region) {
            roptions += '<option value=' + region.key + '>' + region.long + '</option>';
        });
        $("#region").append(roptions);
    });
    $('#permanentaddress').change(function () {
        var permaaddress = $('#permaaddress').val();
        var address = $('#address').val();
        if ($('#permanentaddress').is(':checked') && address != '') {
            $('#permaaddress').val(address);
        }
        else {
            $('#permaaddress').val('');
        }
    });
    $('.letteronly').keyup(function(event) { this.value = this.value.replace(/[^A-Za-z \.]/g,''); });
    $('#eidnumber').click(function(e) {
        var eidnumber = $('#eidnumber').val();
        // var qrcode = new QRCode("qrcode", {
        //     text: eidnumber,
        //     width: 128,
        //     height: 128,
        //     colorDark : "#000000",
        //     colorLight : "#ffffff"
        // });
    });
    // Webcam
    // Webcam.attach('#my_camera');
    // Webcam.set({
    //     width: 320,
    //     height: 240,
    //     dest_width: 640,
    //     dest_height: 480,
    //     image_format: 'jpeg',
    //     jpeg_quality: 90,
    //     force_flash: false,
    // });
    // function take_snapshot() {
    //     Webcam.snap( function(data_uri) {
    //         //document.getElementById('my_result').innerHTML = '<img src="'+data_uri+'"/>';
    //     });
    // }
</script>
