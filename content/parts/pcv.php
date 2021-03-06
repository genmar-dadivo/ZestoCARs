<div class="col-lg-12" id="tpcvdiv">
	<div class="container">
		<div class="row">
			<div class="card mt-5 border-0">
				<div class="card-body">
					<div class="mt-5">
						<table id="tpcv" class="table table-striped responsive nowrap" width="100%">
							<thead>
								<tr>
									<th></th>
									<th>PCV NO</th>
									<th>BRANCH</th>
									<th>PARTICULARS</th>
									<th>AMOUNT</th>
									<th>PAY TO</th>
									<th>APP/CAN BY</th>
									<th>DATE REQUESTED</th>
									<th>DT SM</th>
									<th>ACTION</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<th></th>
									<th>PCV NO</th>
									<th>BRANCH</th>
									<th>PARTICULARS</th>
									<th>AMOUNT</th>
									<th>PAY TO</th>
									<th>APP/CAN BY</th>
									<th>DATE REQUESTED</th>
									<th>DT SM</th>
                                    <th>ACTION</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="pcvencode">
	<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<nav class="navbar navbar-light bg-light">
			</nav>
			<div class="modal-body custom-bg-1">
                <form id="formPCV">
                    <div class="container">
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control border-0 shadow-sm code pcvno" id="pcvno" name="pcvno" placeholder="PCV Number" autocomplete="off" required>
                                    <label for="pcvno">PCV Number</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control border-0 shadow-sm letteronly text-capitalize" id="payto" name="payto" placeholder="Pay To" autocomplete="off" required>
                                    <label for="payto">Pay To</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <select class="form-select border-0 shadow-sm" id="branch" name="branch" aria-label="Branch" required>
                                        <option value="" disabled selected>Branch</option>
                                        <option value="1"> GMA </option>
                                        <option value="3"> Canlubang </option>
                                        <option value="4"> Pili/Naga </option>
                                        <option value="5"> Pampanga </option>
                                        <option value="12"> Esmo </option>
                                        <option value="13"> Osamiz </option>
                                        <option value="14"> Agdao </option>
                                        <option value="15"> Toril </option>
                                        <option value="BCLD0000"> Bacolod </option>
                                        <option value="CEBU0000"> Cebu </option>
                                        <option value="DGPN0000"> Dagupan </option>
                                        <option value="EDSA0000"> EDSA </option>
                                        <option value="ILOI0000"> Iloilo </option>
                                        <option value="STGO0000"> Santiago </option>
                                    </select>
                                    <label for="floatingSelect">Branch</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control border-0 shadow-sm text-lowercase" id="emailapprover" name="emailapprover" placeholder="Approver's Email" autocomplete="off" required>
                                    <label for="emailapprover">Approver's Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control border-0 shadow-sm text-lowercase" id="emailrequest" name="emailrequest" placeholder="Requestor's Email" autocomplete="off" required>
                                    <label for="emailrequest">Requestor's Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-6">
                                <span class="text-primary pointer addparticulars">Add Particulars</span>
                            </div>
                        </div>
                        <div id="addparticulars">
                            <div class="row mt-1">
                                <div class="col-sm-8">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control border-0 shadow-sm" name="description[]" id="description" placeholder="Description" autocomplete="off" required>
                                        <label for="description">Description</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control border-0 shadow-sm numberonly" name="amount[]" id="amount" placeholder="Amount" autocomplete="off" required>
                                        <label for="amount">Amount</label>
                                    </div>
                                </div>
                            </div>
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
    var options = $("#branch option");       
    options.detach().sort(function(a,b) {
        var at = $(a).text();
        var bt = $(b).text();         
        return (at > bt)?1:((at < bt)?-1:0);
    });
    options.appendTo("#branch");    
    $('.pcvno').on('blur', function(){
        if($(this).val()) {
            $(this).addClass('text-uppercase');
            $(this).removeClass('text-capitalize');
        }
        else { 
            $(this).addClass('text-capitalize');
            $(this).removeClass('text-uppercase');
        }
    });
    $('.numberonly').keyup(function(event) { this.value = this.value.replace(/[^0-9.\.]/g,''); });
    $('.letteronly').keyup(function(event) { this.value = this.value.replace(/[^A-Za-z???? \.]/g,''); });
    $('.code').keyup(function(event) { this.value = this.value.replace(/[^A-Za-z0-9/\ \.]/g,''); });
	var d = new Date();
	var gettime = d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
	console.log('%cStarts @ ' + gettime, 'background: #222; color: #bada55');
	var table = $('#tpcv').DataTable({
	    dom: 'Bfrtip',
	    "oLanguage": { "sSearch": "" },
	    buttons: [
	        {
	            extend: "excel",
	            className: "btn btn-sm btn-primary",
	            text: 'Export',
	            filename: 'PCV List',
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
	                var printTitle = 'PCV List';
	                return printTitle
	            },
	            init: function(api, node, config) { $(node).removeClass('dt-button') }
	        },
	        {
	            text: 'Create PCV',
	            className: "btn btn-sm btn-primary",
	            action: function (e, dt, node, config) {
	                $('#pcvencode').appendTo("body");
	                $('#pcvencode').modal('show');
	            }
	        }
	    ],
	    "ajax": {
	        'type': 'POST',
	        'url': '../action/getPcvdata.php',
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
	$(document).ready(function () {
        var counter = 0;
        $(".addparticulars").click( function(e) {
            counter ++;
            e.preventDefault();
            $("#addparticulars").append(''+
            '<div class="appended">' +
                '<div class="row mt-1">' +
                    '<div class="col-sm-8">' +
                        '<div class="form-floating mb-3">' +
                            '<input type="text" class="form-control border-0 shadow-sm" name="description[] id="description' + counter +
                            '" placeholder="Description" autocomplete="off" required>' +
                            '<label for="description">Description</label>' +
                        '</div>' +
                    '</div>' + 
                    '<div class="col-sm-3">' +
                        '<div class="form-floating mb-3">' +
                            '<input type="text" class="form-control border-0 shadow-sm" name="amount[]" id="amount' + counter +
                            '" placeholder="Amount" autocomplete="off" required>' +
                            '<label for="amount">Amount</label>' +
                        '</div>' +
                    '</div>' +
                    '<div class="col-sm-1">' +
                        '<button type="button" class="mt-2 btn btn-outline-danger remove_this">X</button>' +
                    '</div>' +
                '</div>' +
            '</div>');
            return false;
        });
        $(document).on('click', '.remove_this', function() {
            $(this).closest('.appended').remove();
            return false;
        });
	});
    // PCV Mecha
    $('#formPCV').on('submit', function(e) {
        $('#btnCreate').prop("disabled", true);
        $("#btnCreate").html('Loading ...');
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../../content/action/formpcv.php',
            data: $('#formPCV').serialize(),
            success: function(data) {
                alert(data);
                table.ajax.reload();
                $('#pcvencode').modal('hide');
            }
        });
    });
</script>