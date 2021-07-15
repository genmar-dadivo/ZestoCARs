<?php
    require '../dbase/dbconfig.php';
    $sql = "SELECT * FROM pcv";
    $stm = $con->prepare($sql);
    $stm->execute();
    $results = $stm->fetchAll(PDO::FETCH_ASSOC);
    if ($stm->rowCount() >= 1) {
        foreach ($results as $row) {
            $pcvno = $row['pcvno'];
            $branch = $row['branch'];
            if ($branch == 1) {}
            elseif ($branch == 1) {}
            $particulars = explode(',', preg_replace('/[^a-zA-Z0-9,\']/', '', $row['particulars']));
            $itemone = $particulars[0];
            $amount = $row['amount'];
            $payto = $row['payto'];
            $approvedby = $row['approvedby'];
            $receivedby = $row['receivedby'];
            $cancelledby = $row['cancelledby'];
            $daterequest = date("m-d-Y", strtotime($row['daterequest']));
            $datestatusmoved = date("m-d-Y", strtotime($row['datestatusmoved']));
            $output['data'][] = array(
                "",
                "$pcvno",
                "$branch",
                "$itemone",
                "$amount",
                "$payto",
                "$approvedby",
                "$daterequest",
                "",
                "<i class='pointer fa fa-print'></i>"
            );
        }
    }
    else {
        $output['data'][] = array(
            "",
            "No Data",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            ""
            );
    }
    echo json_encode($output);
?>