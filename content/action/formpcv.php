<?php
    date_default_timezone_set("Asia/Manila");
    require '../dbase/dbconfig.php';
    $daterequest = date('Y-m-d');
    $pcvno = preg_replace('/[^a-zA-Z0-9\']/', '', strtoupper($_POST['pcvno']));
    $payto = preg_replace('/[^a-zA-Z Ññ\']/', '', ucwords($_POST['payto']));
    $branch = $_POST['branch'];
    $description = $_POST['description'];
    $descriptionmerge = '';
    foreach ($description as $key => $descriptionvalue) {
        $descriptionmerge .=  preg_replace('/[^a-zA-Z0-9 @#\']/', '', ucwords($descriptionvalue)) . ',';
    }
    $amount = $_POST['amount'];
    $amountmerge = '';
    foreach ($amount as $key => $amountvalue) {
        $amountmerge .=  preg_replace('/[^a-zA-Z0-9\']/', '', $amountvalue). ',';
    }
    $sql = "SELECT pcvno FROM pcv WHERE pcvno = '$pcvno'";
    $stm = $con->prepare($sql);
	$stm->execute();
    if ($stm->rowCount() == 0) {
        $sql = "INSERT INTO pcv (pcvno, branch, particulars, amount, payto, daterequest) VALUES ('$pcvno', '$branch', '$descriptionmerge', '$amountmerge', '$payto', '$daterequest')";
        $stm = $con->prepare($sql);
        $stm->execute();
        echo "Data Entered.";
    }
    else { echo "Error Occured."; }
?>