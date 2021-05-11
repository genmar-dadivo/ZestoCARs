<?php date_default_timezone_set("Asia/Manila"); ?>
<div class="container">
    <form id="formEinfo" class="mt-5" enctype="multipart/form-data">
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="date" class="form-control border-0 fw-light fs-6" id="dts" max="<?php echo date ('Y-m-d'); ?>">
                    <label for="dts">Date Start</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-3 col">
                    <input type="date" class="form-control border-0 fw-light fs-6" id="dte" min="<?php echo $date = date('Y-m-d', strtotime("+1 day")); ?>">
                    <label for="dte">Date End</label>
                </div>
            </div>
        </div>
    </form>
</div>