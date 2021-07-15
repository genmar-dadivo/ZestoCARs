<?php
    require '../dbase/dbconfig.php';
    if (isset($_GET['param'])) {
        $param = $_GET['param'];
        $month = substr($param, 0, 2);
        $year = substr($param, 2, 4);
        $params = "WHERE MONTHNUM = $month AND YEARNUM = $year";
    }
    elseif (isset($_GET['hidden'])) { $params = 'LIMIT 0'; }
    else { $params = ''; }
    $sql = "SELECT * FROM formatter $params";
    $stm = $con->prepare($sql);
    $stm->execute();
    $results = $stm->fetchAll(PDO::FETCH_ASSOC);
    if ($stm->rowCount() >= 1) {
        foreach ($results as $row) {
            $AREA = $row['AREA'];
            $DSM = $row['DSM'];
            $MARKETING_CATEGORY = $row['MARKETING_CATEGORY'];
            $ITEM_CATEGORY = $row['ITEM_CATEGORY'];
            $UOM = $row['UOM'];
            $SKU = $row['SKU'];
            $VOL = $row['VOL'];
            $PV = $row['PV'];
            $MONTHNUM = $row['MONTHNUM'];
            $YEARNUM = $row['YEARNUM'];
            $output['data'][] = array(
                "",
                "$AREA",
                "$DSM",
                "$MARKETING_CATEGORY",
                "$ITEM_CATEGORY",
                "$UOM",
                "$SKU",
                "$VOL",
                "$PV",
                "$MONTHNUM",
                "$YEARNUM"
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