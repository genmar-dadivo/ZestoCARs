<div class="row">
    <div class="container">
        <form id="formannounce">
            <div class="head-setting">
                <div class="row mt-5">
                    <div class="col-lg-6 form-inline">
                        <button type="submit" class="btn btn-primary btn-block" id="btnSend"> 
                            <i class="fa fa-paper-plane"></i> Send 
                        </button>
                        <button type="button" class="btn btn-primary btn-block" id="btnContact"> 
                            <i class="fas fa-address-book"></i> Contacts 
                        </button>
                    </div>
                </div>
                <div class="row mt-3 fw-light">
                    <label class="mail-from col-lg-10">From: info@zesto.com.ph</label>
                    <div class="col-lg-2 text-end">
                        <label class="mail-addset" style="word-spacing: 7px;">
                            <a class="cc-bcc-a custom-a pointer"> Cc/Bcc </a>
                            <a class="reply-to-a custom-a pointer"> Reply-to </a>
                        </label>
                    </div>
                </div>
            </div>
            <div class="mail-body">
                <div class="row mt-2">
                    <div class="col-lg-12">
                        <div class="form-floating">
                            <select class="form-select" name="mail_receiver" id="mail_receiver" required>
                                <option value="" disabled selected>Select Recipients</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                                <option value="single"> Single Recipient </option>
                            </select>
                            <label for="floatingSelect">To</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 single-recipient hidden">
                    <div class="col-lg-12">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control text-lowercase" name="mail_singlerecipient" id="mail_singlerecipient" placeholder="Single Recipient" autocomplete="off" readonly required>
                            <label for="mail_singlerecipient">Single Recipient</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 cc-bcc hidden" id="cc-bcc">
                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control text-lowercase" name="mail_cc" id="mail_cc" placeholder="Cc" autocomplete="off" readonly required>
                            <label for="mail_cc">Cc</label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control text-lowercase" name="mail_bcc" id="mail_bcc" placeholder="Bcc" autocomplete="off" readonly required>
                            <label for="mail_bcc">Bcc</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 reply-to hidden" id="reply-to">
                    <div class="col-lg-12">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control text-lowercase" name="mail_replyto" id="mail_replyto" placeholder="Subject" autocomplete="off" readonly required>
                            <label for="mail_replyto">Reply-to</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control text-capitalize" name="mail_subject" id="mail_subject" placeholder="Subject" autocomplete="off" required>
                            <label for="mail_subject">Subject</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 mb-5">
                    <div class="col-lg-12">
                        <div id="mail_content" style="min-height: 200px;"></div>
                    </div>
                </div>
            </div>
        </form>
        <div class="contact-div row mt-5 hidden">
            <div class="col-lg-12">
                <div class="card border-0">
                    <div class="card-body">
                        <table id="tpb" class="table table-striped responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th width="5%"></th>
                                    <th width="50%">Name</th>
                                    <th>Email</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="hidden" id="html"></div>
<script>
    $(".cc-bcc-a").on("click", function() {
        if ($("#cc-bcc").hasClass("hidden")) {
            $("#cc-bcc").removeClass("hidden");
            $("#mail_cc").attr("readonly", false);
            $("#mail_bcc").attr("readonly", false);
            $("#mail_cc").prop("required", true);
            $("#mail_bcc").prop("required", true);
        }
        else {
            $("#cc-bcc").addClass("hidden");
            $("#mail_cc").attr("readonly", true);
            $("#mail_bcc").attr("readonly", true);
            $("#mail_cc").prop("required", false);
            $("#mail_bcc").prop("required", false);
        }
    });
    $(".reply-to-a").on("click", function() {
        if ($("#reply-to").hasClass("hidden")) {
            $("#reply-to").removeClass("hidden");
            $("#mail_replyto").attr("readonly", false);
            $("#mail_replyto").prop("required", true);
        }
        else {
            $("#reply-to").addClass("hidden");
            $("#mail_replyto").attr("readonly", true);
            $("#mail_replyto").prop("required", true);
        }
    });
    $("#mail_receiver").on("change", function() {
        var smailrec = $('#mail_receiver').val();
        if (smailrec == 'single' && $(".single-recipient").hasClass("hidden")) {
            $(".single-recipient").removeClass("hidden");
            $("#mail_singlerecipient").attr("readonly", false);
            $("#mail_singlerecipient").prop("required", true);
        }
        else {
            $(".single-recipient").addClass("hidden");
            $("#mail_singlerecipient").attr("readonly", true);
            $("#mail_singlerecipient").prop("required", true);
        }
        
    });
    (function() {
        function init(raw_markdown) {
            var options = {
                placeholder: 'Message',
                theme: 'snow'
            };
            var quill = new Quill('#mail_content', options);
            var md = window.markdownit();
            md.set({ html: true });
            var result = md.render(raw_markdown);
            quill.clipboard.dangerouslyPasteHTML(result + "\n");
            var html = quill.container.firstChild.innerHTML;
            $("#markdown").text(toMarkdown(html));
            $("#html").text(html);
            $("#output-quill").html(html);
            $("#output-markdown").html(result);
            quill.on("text-change", function(delta, source) {
                var html = quill.container.firstChild.innerHTML;
                var markdown = toMarkdown(html);
                var rendered_markdown = md.render(markdown);
                $("#html").text(html);
            });
        }
        var text = "";
        init(text);
    })();
    $('#formannounce').on('submit', function (e) {
		$('#btnSend').prop("disabled", true);
	 	$("#btnSend").html('Loading ...');
	 	e.preventDefault();
	 	$.ajax({
	   		type: 'POST',
	   		url: '../../content/action/formannounce.php?',
	   		data: {
                mail_receiver: $('#mail_receiver').val(),
                mail_subject: $('#mail_subject').val(),
                mail_cc: $('#mail_cc').val(),
                mail_bcc: $('#mail_bcc').val(),
                mail_replyto: $('#mail_replyto').val(),
                mail_content: $('#html').text()
            },
	   		success: function (data) {
		 		Push.create("Executed.", {
		   			body: data,
		   			icon: 'https://img.favpng.com/22/25/10/zest-o-philippines-logo-corporation-business-png-favpng-Brbj4NqJYBXtHd0E28th7r3dQ.jpg',
		   			timeout: 4000,
		   			onClick: function () {
			 			window.focus();
			 			this.close();
		   			}
		 		});
	   		}
	 	});
	});
    $('#tpb tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control">' );
    });
    var table = $('#tpb').DataTable({
        dom: 'frtip',
        "oLanguage": { "sSearch": "" },
        "ajax": { 'url': '../action/getContact.php' },
        initComplete: function () {
            this.api().columns().every( function () {
                var that = this;
                $('input', this.footer()).on('keyup change clear', function () {
                    if ( that.search() !== this.value ) { that.search(this.value).draw(); }
                });
            });
        }
    });
</script>