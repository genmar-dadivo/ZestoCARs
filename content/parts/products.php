<div class="col-lg-12" id="tproductdiv">
    <div class="container">
        <div class="row">
            <div class="card mt-5 border-0">
                <div class="card-body">
                    <div class="mt-5">
                        <table id="tproduct" class="table table-striped responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ITEM NO</th>
                                    <th>DESCRIPTION</th>
                                    <th>CATEGORY</th>
                                    <th>PROD CAT</th>
                                    <th>MC</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>ITEM NO</th>
                                    <th>DESCRIPTION</th>
                                    <th>CATEGORY</th>
                                    <th>PROD CAT</th>
                                    <th>MC</th>
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
        var table = $('#tproduct').DataTable({
            dom: 'Bfrtip',
            "oLanguage": { "sSearch": "" },
            buttons: [
                {
                    extend: "excel",
                    className: "btn btn-sm btn-primary",
                    text: 'Export',
                    filename: 'Product List',
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
                        var printTitle = 'Product List';
                        return printTitle
                    },
                    init: function(api, node, config) { $(node).removeClass('dt-button') }
                },
            ],
            "ajax": {
                'type': 'POST',
                'url': '../action/getProductdata.php',
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
</script>