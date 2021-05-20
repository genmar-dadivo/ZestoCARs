<div class="container">
    <div class="row">
        <div style="height: 100px;"></div>
        <img class="zesto-logo rounded mx-auto d-block" src="../../assets/img/logo.png" style="max-width: 500px;" class="img-fluid">
    </div>
</div>
<script>
    const tilt = $('.zesto-logo').tilt({
        maxTilt:        20,
        perspective:    1000,
        easing:         "cubic-bezier(.03,.98,.52,.99)",
        scale:          1,
        speed:          300,
        transition:     true,
        disableAxis:    null,
        reset:          true,
        glare:          false,
        maxGlare:       0
    });
    var uid = $('#uid').val();
    $.ajax({
        url: '../../content/action/getEinfo.php?euid=' + uid,
        success: function(data) {
            if(data.indexOf('Error') >= 0){
                Push.create("ZestCARs", {
                    body: 'Please input your details.',
                    icon: 'https://img.favpng.com/22/25/10/zest-o-philippines-logo-corporation-business-png-favpng-Brbj4NqJYBXtHd0E28th7r3dQ.jpg',
                    //timeout: 4000,
                    onClick: function() {
                        window.focus();
                        this.close();
                        contentloader(3);
                    },
                    onClose: function() {
                        window.location.href = '';
                        contentloader(3);
                    },
                });
            }
        }
    });
    // Push.create("ZestCARs", {
    //     body: 'asd',
    //     icon: 'https://img.favpng.com/22/25/10/zest-o-philippines-logo-corporation-business-png-favpng-Brbj4NqJYBXtHd0E28th7r3dQ.jpg',
    //     timeout: 4000,
    //     onClick: function() {
    //         window.focus();
    //         this.close();
    //     },
    //     onClose: function() {
    //         window.location.href = '';
    //     },
    // });
</script>