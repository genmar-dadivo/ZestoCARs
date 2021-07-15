<?php
    // !
    ini_set('memory_limit', '-1');
    require '../dbase/dbconfig.php';
    $sql = "SELECT SUBSTR(CUS_NO, 5), A.*, 
    (SELECT B.description FROM customer_type B WHERE B.code = A.CUS_TP) AS CUSTYPE, (SELECT C.AR_TERMS_DESC FROM terms C WHERE C.AR_TERMS_CD = A.CUS_TERMS_CD) AS ARSDESC, (SELECT D.LONG_DESCRIPTION FROM terms D WHERE D.AR_TERMS_CD = A.CUS_TERMS_CD) AS ARLDESC
    FROM arcusfil_sql A WHERE A.dbno = 1 AND 
    TRIM(CUS_SLM_NO) IN ('G72', 'G06', 'W05', 'W07', 'W04', 'G12', 'G21', 'G20', 'G25', 'G04', 'G05', 'G10', 'G11', 'W01', 'G03', 'G17', 'W02', 'G02', 'G13', 'G15', 'G14') AND A.CUS_LAST_SALE_DT > 20170000";
    $stm = $con->prepare($sql);
    $stm->execute();
    $results = $stm->fetchAll(PDO::FETCH_ASSOC);
    if ($stm->rowCount() >= 1) {
        foreach ($results as $row) {
            $id = $row['id'];
            $dbno = $row['dbno'];
            $CUS_NO = $row['CUS_NO'];
            $CUS_NAME = ucwords($row['CUS_NAME']);
            $CUS_STREET1 = ucwords($row['CUS_STREET1']);
            $CUS_STREET2 = ucwords($row['CUS_STREET2']);
            $CUS_CITY = ucwords($row['CUS_CITY']);
            $CUS_ST = strtoupper($row['CUS_ST']);
            $CUS_ZIP = strtoupper($row['CUS_ZIP']);
            $CUS_COUNTRY = strtoupper($row['CUS_COUNTRY']);
            $CUS_CONTACT = ucwords($row['CUS_CONTACT']);
            $CUS_CONTACT_2 = ucwords($row['CUS_CONTACT_2']);
            $CUS_PHONE_NO = $row['CUS_PHONE_NO'];
            $CUS_PHONE_NO_2 = $row['CUS_PHONE_NO_2'];
            $CUS_PHONE_EXT = strtoupper($row['CUS_PHONE_EXT']);
            $CUS_PHONE_EXT_2 = strtoupper($row['CUS_PHONE_EXT_2']);
            $CUS_FAX_NO = $row['CUS_FAX_NO'];
            $CUS_START_DT = $row['CUS_START_DT'];
            $CUS_SLM_NO = strtoupper($row['CUS_SLM_NO']);
            $CUS_TP = strtoupper($row['CUS_TP']);
            $CUS_BAL_METH = strtoupper($row['CUS_BAL_METH']);
            $CUS_STM_FREQ = strtoupper($row['CUS_STM_FREQ']);
            $CUS_CR_LIMIT = $row['CUS_CR_LIMIT'];
            $CUS_CR_RATING = $row['CUS_CR_RATING'];
            $CUS_CR_HOLD_FG = strtoupper($row['CUS_CR_HOLD_FG']);
            $CUS_COLLECTOR = strtoupper($row['CUS_COLLECTOR']);
            $CUS_FIN_CHG_FG = strtoupper($row['CUS_FIN_CHG_FG']);
            $CUS_ORIGIN = $row['CUS_ORIGIN'];
            $FILLER_0003 = $row['FILLER_0003'];
            $CUS_TERR = strtoupper($row['CUS_TERR']);
            $CUS_CURR_CODE = $row['CUS_CURR_CODE'];
            $CUS_PARENT_CUS_NO = $row['CUS_PARENT_CUS_NO'];
            $CUS_PARENT_CUS_FLG = strtoupper($row['CUS_PARENT_CUS_FLG']);
            $CUS_SHIP_VIA_CD = strtoupper($row['CUS_SHIP_VIA_CD']);
            $CUS_UPS_ZONE = $row['CUS_UPS_ZONE'];
            $CUS_TERMS_CD = strtoupper($row['CUS_TERMS_CD']);
            $CUS_DSC_PCT = $row['CUS_DSC_PCT'];
            $CUS_YTD_DSC_GIVEN = $row['CUS_YTD_DSC_GIVEN'];
            $CUS_TXBL_FG = strtoupper($row['CUS_TXBL_FG']);
            $CUS_TX_CD1 = strtoupper($row['CUS_TX_CD1']);
            $CUS_TX_CD2 = strtoupper($row['CUS_TX_CD2']);
            $CUS_TX_CD3 = strtoupper($row['CUS_TX_CD3']);
            $CUS_EXEMPT_NO = $row['CUS_EXEMPT_NO'];
            $CUS_SALES_PTD = $row['CUS_SALES_PTD'];
            $CUS_SALES_YTD = $row['CUS_SALES_YTD'];
            $CUS_SALES_LAST_YR = $row['CUS_SALES_LAST_YR'];
            $CUS_COST_PTD = $row['CUS_COST_PTD'];
            $CUS_COST_YTD = $row['CUS_COST_YTD'];
            $CUS_COST_LAST_YR = $row['CUS_COST_LAST_YR'];
            $CUS_BALANCE = $row['CUS_BALANCE'];
            $CUS_HIGH_BALANCE = $row['CUS_HIGH_BALANCE'];
            $CUS_LAST_SALE_DT = $row['CUS_LAST_SALE_DT'];
            $CUS_LAST_SALE_AMT = $row['CUS_LAST_SALE_AMT'];
            $CUS_INV_YTD = $row['CUS_INV_YTD'];
            $CUS_INV_LAST_YR = $row['CUS_INV_LAST_YR'];
            $CUS_PAID_INV_YTD = $row['CUS_PAID_INV_YTD'];
            $CUS_LAST_PAY_DT = $row['CUS_LAST_PAY_DT'];
            $CUS_LAST_PAY_AMT = $row['CUS_LAST_PAY_AMT'];
            $CUS_AVG_PAY_YTD = $row['CUS_AVG_PAY_YTD'];
            $CUS_AVG_PAY_LAST_YR = $row['CUS_AVG_PAY_LAST_YR'];
            $CUS_LAST_STM_AGE_DT = $row['CUS_LAST_STM_AGE_DT'];
            $CUS_AMT_AGE_PD1 = $row['CUS_AMT_AGE_PD1'];
            $CUS_AMT_AGE_PD2 = $row['CUS_AMT_AGE_PD2'];
            $CUS_AMT_AGE_PD3 = $row['CUS_AMT_AGE_PD3'];
            $CUS_AMT_AGE_PD4 = $row['CUS_AMT_AGE_PD4'];
            $CUS_ALLOW_SUB_ITMS = strtoupper($row['CUS_ALLOW_SUB_ITMS']);
            $CUS_ALLOW_BO = strtoupper($row['CUS_ALLOW_BO']);
            $CUS_ALLOW_PART_SHIP = strtoupper($row['CUS_ALLOW_PART_SHIP']);
            $CUS_PRINT_DUNN_FG = strtoupper($row['CUS_PRINT_DUNN_FG']);
            $CUS_COMMENT1 = ucwords($row['CUS_COMMENT1']);
            $CUS_COMMENT2 = ucwords($row['CUS_COMMENT2']);
            $CUS_AP_VENDOR = $row['CUS_AP_VENDOR'];
            $CUS_TAX_SCHED = $row['CUS_TAX_SCHED'];
            $CUS_CREDCRD1_DESC = ucwords($row['CUS_CREDCRD1_DESC']);
            $CUS_CREDCRD1_ACCT = ucwords($row['CUS_CREDCRD1_ACCT']);
            $CUS_CREDCRD1_EXP_DT = ucwords($row['CUS_CREDCRD1_EXP_DT']);
            $CUS_CREDCRD2_DESC = ucwords($row['CUS_CREDCRD2_DESC']);
            $CUS_CREDCRD2_ACCT = ucwords($row['CUS_CREDCRD2_ACCT']);
            $CUS_CREDCRD2_EXP_DT = ucwords($row['CUS_CREDCRD2_EXP_DT']);
            $CUS_USER_FLD1 = ucwords($row['CUS_USER_FLD1']);
            $CUS_USER_FLD2 = ucwords($row['CUS_USER_FLD2']);
            $CUS_USER_FLD3 = ucwords($row['CUS_USER_FLD3']);
            $CUS_USER_FLD4 = ucwords($row['CUS_USER_FLD4']);
            $CUS_USER_FLD5 = ucwords($row['CUS_USER_FLD5']);
            $DEFAULT_INV_FORM = $row['DEFAULT_INV_FORM'];
            $CUS_ORDER_LOC = strtoupper($row['CUS_ORDER_LOC']);
            $CUS_NOTE_1 = ucwords($row['CUS_NOTE_1']);
            $CUS_NOTE_2 = ucwords($row['CUS_NOTE_2']);
            $CUS_NOTE_3 = ucwords($row['CUS_NOTE_3']);
            $CUS_NOTE_4 = ucwords($row['CUS_NOTE_4']);
            $CUS_NOTE_5 = ucwords($row['CUS_NOTE_5']);
            $CUS_USER_DATE = $row['CUS_USER_DATE'];
            $USER_AMOUNT = $row['USER_AMOUNT'];
            $CUS_AMT_AGE_OE_TERM = strtoupper($row['CUS_AMT_AGE_OE_TERM']);
            $CUS_ALT_ADDRESS = strtoupper($row['CUS_ALT_ADDRESS']);
            $CUS_RFC_NUMBER = $row['CUS_RFC_NUMBER'];
            $EMAIL_ADDR = strtolower($row['EMAIL_ADDR']);
            $CUSTYPE = strtoupper($row['CUSTYPE']);
            $ARSDESC = strtoupper($row['ARSDESC']);
            $ARLDESC = strtoupper($row['ARLDESC']);
            $output['data'][] = array(
                "",
                "$dbno",
                "$CUS_NO",
                "$CUS_SLM_NO",
                "$CUS_NAME",
                "$CUS_STREET1",
                "$CUS_STREET2",
                "$CUS_CITY",
                "$CUS_ST",
                "$CUS_ZIP",
                "$CUS_COUNTRY",
                "$CUS_CONTACT",
                "$CUS_CONTACT_2",
                "$CUS_PHONE_NO",
                "$CUS_PHONE_NO_2",
                "$CUS_PHONE_EXT",
                "$CUS_PHONE_EXT_2",
                "$CUS_FAX_NO",
                "$CUS_START_DT",
                "$CUS_TP / $CUSTYPE",
                "$CUS_BAL_METH",
                "$CUS_STM_FREQ",
                "$CUS_CR_LIMIT",
                "$CUS_CR_RATING",
                "$CUS_CR_HOLD_FG",
                "$CUS_COLLECTOR",
                "$CUS_FIN_CHG_FG",
                "$CUS_ORIGIN",
                "$FILLER_0003",
                "$CUS_TERR",
                "$CUS_CURR_CODE",
                "$CUS_PARENT_CUS_NO",
                "$CUS_PARENT_CUS_FLG",
                "$CUS_SHIP_VIA_CD",
                "$CUS_UPS_ZONE",
                "$ARSDESC / $ARLDESC",
                "$CUS_DSC_PCT",
                "$CUS_YTD_DSC_GIVEN",
                "$CUS_TXBL_FG",
                "$CUS_TX_CD1",
                "$CUS_TX_CD2",
                "$CUS_TX_CD3",
                "$CUS_EXEMPT_NO",
                "$CUS_SALES_PTD",
                "$CUS_SALES_YTD",
                "$CUS_SALES_LAST_YR",
                "$CUS_COST_PTD",
                "$CUS_COST_YTD",
                "$CUS_COST_LAST_YR",
                "$CUS_BALANCE",
                "$CUS_HIGH_BALANCE",
                "$CUS_LAST_SALE_DT",
                "$CUS_LAST_SALE_AMT",
                "$CUS_INV_YTD",
                "$CUS_INV_LAST_YR",
                "$CUS_PAID_INV_YTD",
                "$CUS_LAST_PAY_DT",
                "$CUS_LAST_PAY_AMT",
                "$CUS_AVG_PAY_YTD",
                "$CUS_AVG_PAY_LAST_YR",
                "$CUS_LAST_STM_AGE_DT",
                "$CUS_AMT_AGE_PD1",
                "$CUS_AMT_AGE_PD2",
                "$CUS_AMT_AGE_PD3",
                "$CUS_AMT_AGE_PD4",
                "$CUS_ALLOW_SUB_ITMS",
                "$CUS_ALLOW_BO",
                "$CUS_ALLOW_PART_SHIP",
                "$CUS_PRINT_DUNN_FG",
                "$CUS_COMMENT1",
                "$CUS_COMMENT2",
                "$CUS_AP_VENDOR",
                "$CUS_TAX_SCHED",
                "$CUS_CREDCRD1_DESC",
                "$CUS_CREDCRD1_ACCT",
                "$CUS_CREDCRD1_EXP_DT",
                "$CUS_CREDCRD2_DESC",
                "$CUS_CREDCRD2_ACCT",
                "$CUS_CREDCRD2_EXP_DT",
                "$CUS_USER_FLD1",
                "$CUS_USER_FLD2",
                "$CUS_USER_FLD3",
                "$CUS_USER_FLD4",
                "$CUS_USER_FLD5",
                "$DEFAULT_INV_FORM",
                "$CUS_ORDER_LOC",
                "$CUS_NOTE_1",
                "$CUS_NOTE_2",
                "$CUS_NOTE_3",
                "$CUS_NOTE_4",
                "$CUS_NOTE_5",
                "$CUS_USER_DATE",
                "$USER_AMOUNT",
                "$CUS_AMT_AGE_OE_TERM",
                "$CUS_ALT_ADDRESS",
                "$CUS_RFC_NUMBER",
                "$EMAIL_ADDR"
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
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
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