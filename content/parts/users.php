<div class="modal fade" id="customer-settings" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <nav class="navbar">
            </nav>
            <div class="modal-body">
                Customer Data Filter
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12" id="tUresultdiv">
    <div class="container">
        <div class="row">
            <div class="card mt-5 border-0">
                <div class="card-body">
                    <div class="mt-5">
                        <table id="tusers" class="table table-striped responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ENUMBER</th>
                                    <th>UNAME</th>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>DEPT</th>
                                    <th>LVL</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>ENUMBER</th>
                                    <th>UNAME</th>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>DEPT</th>
                                    <th>LVL</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="hidden">
</div>
<script>
    //$("#customer-settings").on("change", function() {
        var d = new Date();
        var gettime = d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
        console.log('%cStarts @ ' + gettime, 'background: #222; color: #bada55');
        var table = $('#tusers').DataTable({
            dom: 'frtip',
            "oLanguage": { "sSearch": "" },
            "ajax": {
                'type': 'POST',
                'url': '../action/getUsersdata.php',
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
    //});
    $(document).ready(function() {
        // $('#customer-settings').appendTo("body");
        // $('#customer-settings').modal('show', {backdrop: 'static', keyboard: false});
    });
</script>