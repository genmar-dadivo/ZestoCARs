<div class="contenedor mt-5 card" id="terminal"></div>
<script type="text/javascript">
    var interface2 = new Cmd({
        selector: '#terminal',
        external_processor: function(input, cmd)  {
            if (input === 'test') {
                setTimeout(function() {
                    cmd.handleResponse({
                        cmd_out: 'Success!'
                    });
            }, 100);
                return true;
            }
            else if (input === 'foo') { return 'String style return.';}   
            else if (input === 'text')  { return 'This is normal text. This is <em>italic</em> text. This is <em>bold</em> text.'; } 
            else if (input === 'bar') {
                return { cmd_out: 'Object style return.' };
            }
            else if (input === 'long') {
                return 'This is a really long output. This is a really long output. This is a really long output. This is a really long output. This is a really long output. This is a really long output. This is a really long output. This is a really long output. This is a really long output. This is a really long output. This is a really long output. This is a really long output. This is a really long output. This is a really long output. This is a really long output. This is a really long output. This is a really long output. '
            }
            else if (input === 'autofill') {
                return '<span data-type="autofill" data-autofill="here is some text">click me</span>'; } 
            else if (input === 'password') {
                return {
                    cmd_out: 'Type in a password. Type "reset" to return to normal',
                    show_pass: true
                };
            } 
            else if (input === 'password-async') {
                setTimeout(function() {
                    cmd.handleResponse({
                    cmd_out: 'Type in a password. Type "reset" to return to normal.',
                    show_pass: true
                    });
                }, 100);
                return true;
            } 
            else if (input === 'reset') {
                return {
                    cmd_out: 'Back to normal',
                    show_pass: false,
                    hide_output: true
                };
            }
            else if (input.startsWith('create') !== -1) {
                input = input.replace('create','');
                var splitter = input.split(' ');
                var db = splitter[1];
                var mo = splitter[2];
                var year = splitter[3];
                var dbs = ["macola", "noah", "csi"];
                var checker = 0;
                if (db === '' && mo === '' && year === '') { return 'Invalid parameters.'; }
                else {
                    if (dbs.indexOf(db) !== -1) { checker = 1; }
                    else { checker = 0; }
                    if (mo >= 1 && mo <= 12) { checker = 1; }
                    else { checker = 0; }
                    if (year.replace(/[^0-9]/g,"").length == 4) { checker = 1; }
                    else { checker = 0; }
                    return 'asd';
                }
            }
        }
    });
</script>