<?php
    // !
    ini_set('memory_limit', '-1');
    require '../dbase/dbconfig.php';
    $sql = "SELECT (SELECT mcid.MC_ID FROM mrktng_category_dtl mcid WHERE mcid.CATEGORY = a.CATEGORY) AS MktgCID, (SELECT mcdesc.MC_DESCRIPTION FROM mrktng_category_hdr mcdesc WHERE mcdesc.ID = MktgCID) AS MCDESCRIPTION, a.id, a.ITEM_NO, a.SKU, a.CATEGORY, a.PROD_CAT FROM product a";
    $stm = $con->prepare($sql);
    $stm->execute();
    $results = $stm->fetchAll(PDO::FETCH_ASSOC);
    if ($stm->rowCount() >= 1) {
        foreach ($results as $row) {
            $MktgCID = $row['MktgCID'];
            $MCDESCRIPTION = ucwords($row['MCDESCRIPTION']);
            $id = $row['id'];
            $ITEM_NO = $row['ITEM_NO'];
            $SKU = strtoupper($row['SKU']);
            $CATEGORY = strtoupper($row['CATEGORY']);
            $PROD_CAT = strtoupper($row['PROD_CAT']);
            $output['data'][] = array(
                "",
                "$ITEM_NO",
                "$SKU",
                "$CATEGORY",
                "$PROD_CAT",
                "$MCDESCRIPTION"
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
            ""
            );
    }
    echo json_encode($output);
?>