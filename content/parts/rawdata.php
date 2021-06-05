<div class="modal fade" id="rawdata-settings" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content custom-bg-1">
            <nav class="navbar">
            </nav>
            <div class="modal-body">
                Raw Data Filter
                <form id="rawdata-form">
                    <div class="container">
                        <div class="row">
                            <div class="mt-3">
                                <div class="form-floating">
                                    <select class="form-select border-0 fw-light fs-6" id="database-name">
                                        <option value="" selected disabled>Select Source</option>
                                        <option value="1">CSI</option>
                                        <option value="2">Macola</option>
                                        <option value="3">Noah</option>
                                    </select>
                                    <label for="database-name">Database</label>
                                </div>
                            </div>
                            <div class="mt-1">
                                <div class="form-floating">
                                    <select class="form-select border-0 fw-light fs-6" id="data-month">
                                        <option value="" disabled selected></option>
                                        <?php
                                        $months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec");
                                        $length = count($months);
                                        for ($i = 0; $i < $length; $i++) {
                                            $mv = $i + 1;
                                            echo "<option value='" . sprintf("%02d", $mv) . "'>" . $months[$i] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <label for="data-month">Month</label>
                                </div>
                            </div>
                            <div class="mt-1">
                                <div class="form-floating">
                                    <input type="text" class="form-control text-uppercase border-0 fw-light fs-6" id="data-limit" placeholder="Limit" autocomplete="off">
                                    <label for="data-limit">Limit</label>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="form-floating">
                                    <textarea class="form-control border-0 fw-light fs-6" placeholder="Others" id="others" style="resize: none; min-height: 150px;" name="others"></textarea>
                                    <label for="others">Others</label>
                                </div>
                            </div>
                            <div class="mt-3 mb-5">
                                <div class="form-floating">
                                    <input type="text" class="form-control border-0 fw-light fs-6" id="data-year" placeholder="Year" autocomplete="off">
                                    <label for="data-year">Year</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12 hidden" id="tResultdiv">
    <div class="card border-0">
       <div class="card-body container">
            <div class="row">
                <div class="mt-5">
                    <table id="traw" class="hidden table table-striped responsive nowrap" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>DBNO</th>
                                <th>SALESMAN</th>
                                <th>DSM</th>
                                <th>DSMSORT</th>
                                <th>BRANCH</th>
                                <th>OT</th>
                                <th>ORDERNO</th>
                                <th>SEQUENCENO</th>
                                <th>ITEMNO</th>
                                <th>PRODCAT</th>
                                <th>ITEMCAT</th>
                                <th>SKU</th>
                                <th>LOCATION</th>
                                <th>QTYORDERED</th>
                                <th>QTYTOSHIP</th>
                                <th>UNITPRICE</th>
                                <th>REQUESTDATE</th>
                                <th>QBO</th>
                                <th>QRTS</th>
                                <th>UOM</th>
                                <th>UNITCOST</th>
                                <th>TQO</th>
                                <th>TQS</th>
                                <th>PRICEORIG</th>
                                <th>LPD</th>
                                <th>IPC</th>
                                <th>UF1</th>
                                <th>UF2</th>
                                <th>UF3</th>
                                <th>UF4</th>
                                <th>UF5</th>
                                <th>CUSTOMER</th>
                                <th>ADDRESS</th>
                                <th>CUSTTIN</th>
                                <th>CUSTTYPE</th>
                                <th>PROVINCIAL</th>
                                <th>REGIONS</th>
                                <th>INVOICENO</th>
                                <th>INVOICEDATE</th>
                                <th>GROSS</th>
                                <th>NET</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>DBNO</th>
                                <th>SALESMAN</th>
                                <th>DSM</th>
                                <th>DSMSORT</th>
                                <th>BRANCH</th>
                                <th>OT</th>
                                <th>ORDERNO</th>
                                <th>SEQUENCENO</th>
                                <th>ITEMNO</th>
                                <th>PRODCAT</th>
                                <th>ITEMCAT</th>
                                <th>SKU</th>
                                <th>LOCATION</th>
                                <th>QTYORDERED</th>
                                <th>QTYTOSHIP</th>
                                <th>UNITPRICE</th>
                                <th>REQUESTDATE</th>
                                <th>QBO</th>
                                <th>QRTS</th>
                                <th>UOM</th>
                                <th>UNITCOST</th>
                                <th>TQO</th>
                                <th>TQS</th>
                                <th>PRICEORIG</th>
                                <th>LPD</th>
                                <th>IPC</th>
                                <th>UF1</th>
                                <th>UF2</th>
                                <th>UF3</th>
                                <th>UF4</th>
                                <th>UF5</th>
                                <th>CUSTOMER</th>
                                <th>ADDRESS</th>
                                <th>CUSTTIN</th>
                                <th>CUSTTYPE</th>
                                <th>PROVINCIAL</th>
                                <th>REGIONS</th>
                                <th>INVOICENO</th>
                                <th>INVOICEDATE</th>
                                <th>GROSS</th>
                                <th>NET</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="hidden">
    <input id="dbval">
    <input id="mval">
    <input id="yval">
    <input id="lim">
</div>
<script>
    $("#rawdata-form").on("change", function() {
        var db = $('#database-name').val();
        var dm = $('#data-month').val();
        var dy = $('#data-year').val();
        var lim = $('#data-limit').val();
        $('#dbval').val(db);
        $('#mval').val(dm);
        $('#yval').val(dy);
        $('#lim').val(lim);
        if (db != '' && dm != '' &&  dy != '') {
            if ($("#tResultdiv").hasClass("hidden")) { $("#tResultdiv").removeClass("hidden"); }
            var dbname = '';
            var mname = '';
            if (db == 1) { dbname = 'CSI'; }
            else if (db == 2) { dbname = 'Macola'; }
            else if (db == 3) { dbname = 'Noah'; }
            var months = [ "January", "February", "March", "April", "May", "June", 
               "July", "August", "September", "October", "November", "December" ];
            dmnew = parseInt(dm);
            dmnew = dmnew - 1;
            mname = months[dmnew];
            $('.section_name ').append(document.createTextNode(' (' + dbname + ' ' + mname + dy + ' ' + lim + ')'));
            var d = new Date();
            var gettime = d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
            console.log('%cStarts @ ' + gettime, 'background: #222; color: #bada55');
            $('#traw').removeClass('hidden');
            $('#rawdata-settings').modal("hide");
            $('#rawdata-settings').on('hidden.bs.modal', function (e) {
                $(this).find("input,textarea,select").val('').end()
                    .find("input[type=checkbox], input[type=radio]")
                    .prop("checked", "")
                    .end();
                    document.onkeydown = fkey;
                    document.onkeypress = fkey
                    document.onkeyup = fkey;
                    var wasPressed = false;
                    function fkey(e){
                        e = e || window.event;
                        if(wasPressed) return; 
                        if (e.keyCode == 116) {
                            var appid = Cookies.get('appid');
                            wasPressed = true;
                            if (appid == 4) {
                                if (confirm('Are you sure you want to leave this page?')) { location.reload(); }
                                else { wasPressed = false; return false; }
                            }
                        }
                    }
            });
            $('#traw tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" class="form-control">' );
            });
            var dbval = $('#dbval').val();
            var mval = $('#mval').val();
            var yval = $('#yval').val();
            var lim = $('#lim').val();
            var dbname = '';
            var months = ["January", "February", "March", "April", "May", "June", 
           "July", "August", "September", "October", "November", "December"];
            if (dbval == 1) { dbname = 'CSI'; }
            else if (dbval == 2) { dbname = 'Macola'; }
            else if (dbval == 3) { dbname = 'Noah'; }
            var mvalue = parseInt(mval) - 1;
            var excelfn = months[mvalue].substring(0,3).toUpperCase() + yval + ' ' + dbname;
            var sectionname = $('.section_name ').text();
            var table = $('#traw').DataTable({
                dom: 'Bfrtip',
                "oLanguage": { "sSearch": "" },
                buttons: [
                    {
                        extend: "excel",
                        className: "btn btn-sm btn-primary",
                        text: 'Export',
                        filename: sectionname,
                        init: function(api, node, config) { $(node).removeClass('dt-button') }
                    },
                    {
                        extend: "copy",
                        className: "btn btn-sm btn-primary",
                        text: 'Copy',
                        init: function(api, node, config) { $(node).removeClass('dt-button') }
                    },
                    {
                        extend: "print",
                        className: "btn btn-sm btn-primary",
                        text: 'Print',
                        title: function(){
                            var printTitle = 'Sales Report';
                            return printTitle
                        },
                        init: function(api, node, config) { $(node).removeClass('dt-button') }
                    },
                ],
                "ajax": {
                    'type': 'POST',
                    'url': '../action/getRawdata.php',
                    'data': {
                        dbval: $('#dbval').val(),
                        mval: $('#mval').val(),
                        yval: $('#yval').val(),
                        lim: $('#lim').val()
                    }
                },
                initComplete: function () {
                    var nd = new Date();
                    var ngettime = nd.getHours() + ':' + nd.getMinutes() + ':' + nd.getSeconds();
                    console.log('Finish @ ' + ngettime);
                    var diff = Math.abs(d - nd),
                    min = Math.floor((diff/1000/60) << 0),
                    sec = Math.floor((diff/1000) % 60);
                    console.log('Duration ' + min + ':' + sec);
                    this.api().columns().every( function () {
                        var that = this;
                        $('input', this.footer()).on('keyup change clear', function () {
                            if ( that.search() !== this.value ) { that.search(this.value).draw(); }
                        });
                    });
                }
            });
        }
    });
    $(document).ready(function() {
        $('#rawdata-settings').appendTo("body");
        $('#rawdata-settings').modal('show', {backdrop: 'static', keyboard: false});
        $('#data-year').inputmask("9999");
    });
    $("#rawdata-settings").dblclick(function(e) { if (e.ctrlKey) { $('#rawdata-settings').modal("hide"); } });
</script>