<?php
    require '../dbase/dbconfig.php';
    $dbval = $_POST['dbval'];
    $mval = $_POST['mval'];
    $yval = $_POST['yval'];
    $lim = $_POST['lim'];
    if ($lim <> '') {
        if (strpos($lim, 'LIMIT')) {
            $lim = "LIMIT " . $lim;
        }
        else {
            $param = explode(",", $lim);
            $starter = $param[0];
            $ender = $param[1];
        }
    }
    // CSI
    if ($dbval == 1) {
        $US = 40000000;
        $USE = 49999999;
        $DB = '1';
        $startday = "00";
        $endday = "99";
        if ($lim <> '') {
            if (!strpos($lim, 'LIMIT')) {
                $param = explode(",", $lim);
                $startday = $param[0];
                $endday = $param[1];
            }
        }
        $limit = $lim;
        $S = $yval . $mval . $startday;
        $E = $yval . $mval . $endday;
        $sql = "SELECT
        (SELECT os.ORDER_STATUS FROM oeordhdr os WHERE os.DB_NO = l.DB_NO AND os.ORDER_NO = l.ORDER_NO) AS ORDERSTATUS,
        (SELECT ode.ORDER_DATE_ENTERED FROM oeordhdr ode WHERE ode.DB_NO = l.DB_NO AND ode.ORDER_NO =l.ORDER_NO) AS ORDERDATEENTERED,
        (SELECT oatn.ORDER_APPLY_TO_NO FROM oeordhdr oatn WHERE oatn.DB_NO = l.DB_NO AND oatn.ORDER_NO = l.ORDER_NO LIMIT 1) AS ORDERAPPLYTONO,
        (SELECT opon.ORDER_PUR_ORDER_NO FROM oeordhdr opon WHERE opon.DB_NO = l.DB_NO AND opon.ORDER_NO = l.ORDER_NO LIMIT 1) AS ORDERPURORDERNO,
        (SELECT ocn.ORDER_CUSTOMER_NO FROM oeordhdr ocn WHERE ocn.DB_NO = l.DB_NO AND ocn.ORDER_NO = l.ORDER_NO LIMIT 1) AS ORDERCUSTOMERNO,
        (SELECT C.CUSTOMER FROM v_customer_info C WHERE TRIM(C.DBNO) = TRIM(l.DB_NO) 
        AND C.CUS_NO LIKE CONCAT ('%' , TRIM(ORDERCUSTOMERNO) , '%') LIMIT 1) AS CUSTOMERN,
        (SELECT A.ADDRESS FROM v_customer_info A WHERE A.DBNO = l.DB_NO AND A.CUS_NO LIKE CONCAT ('%' , ORDERCUSTOMERNO , '%') LIMIT 1) AS ADDRESSC, 
        (SELECT T.TIN_NO FROM v_customer_info T WHERE T.DBNO = l.DB_NO AND T.CUS_NO LIKE CONCAT ('%' , ORDERCUSTOMERNO , '%') LIMIT 1) AS TINC, 
        (SELECT t.CUST_TYPE_CODE FROM v_customer_type t WHERE t.DBNO = l.DB_NO AND t.CUS_NO LIKE CONCAT ('%' , ORDERCUSTOMERNO , '%') LIMIT 1) AS TYPEC, 
        (SELECT cbm.CUSTOMER_BAL_METHOD FROM oeordhdr cbm WHERE cbm.DB_NO = l.DB_NO AND cbm.ORDER_NO = l.ORDER_NO LIMIT 1) AS CUSTOMERBALMETHOD, 
        (SELECT sd.SHIPPING_DATE FROM oeordhdr sd WHERE sd.DB_NO = l.DB_NO AND sd.ORDER_NO = l.ORDER_NO LIMIT 1) AS SHIPPINGDATE, 
        (SELECT svc.SHIP_VIA_CODE FROM oeordhdr svc WHERE svc.DB_NO = l.DB_NO AND svc.ORDER_NO = l.ORDER_NO) AS SHIPVIACODE, 
        (SELECT tc.TERMS_CODE FROM oeordhdr tc WHERE tc.DB_NO = l.DB_NO AND tc.ORDER_NO = l.ORDER_NO) AS TERMSCODE, 
        (SELECT ml.MFGING_LOCATION FROM oeordhdr ml WHERE ml.DB_NO = l.DB_NO AND ml.ORDER_NO = l.ORDER_NO) AS MFGINGLOCATION, 
        (SELECT ttc.TOTAL_COST FROM oeordhdr ttc WHERE ttc.DB_NO = l.DB_NO AND ttc.ORDER_NO = l.ORDER_NO) AS TOTALCOST, 
        (SELECT tsa.TOTAL_SALE_AMOUNT FROM oeordhdr tsa WHERE tsa.DB_NO = l.DB_NO AND tsa.ORDER_NO = l.ORDER_NO) AS TOTALSALEAMOUNT, 
        (SELECT sn.SALESMAN_NO_1 FROM oeordhdr sn WHERE sn.DB_NO = l.DB_NO AND sn.ORDER_NO = l.ORDER_NO LIMIT 1) AS SALESMAN, 
        (SELECT p.dsm_code FROM psr p WHERE p.psr_code = SALESMAN) AS DSMCODE, 
        (SELECT d.dsm_desc FROM dsm d WHERE d.dsm_code = DSMCODE) AS DSMDESC, 
        (SELECT ds.DSMSORT FROM dsm ds WHERE ds.dsm_code = DSMCODE) AS DSMSORT,  
        (SELECT i.CATEGORY FROM product i WHERE i.ITEM_NO = l.ITEM_NO) AS ITEMCAT, 
        (SELECT n.SKU FROM product n WHERE n.ITEM_NO = l.ITEM_NO) AS INAME, 
        (SELECT p.PROD_CODE FROM product p WHERE p.ITEM_NO = l.ITEM_NO) AS PRODCAT, 
        l.DB_NO, l.ORDER_TYPE, l.ORDER_NO, l.SEQUENCE_NO, l.GEN_INV_NO, l.ITEM_NO, l.LOCATION, l.QTY_ORDERED, 
        l.QTY_TO_SHIP, l.UNIT_PRICE, l.REQUEST_DATE, l.UNIT_OF_MEASURE, l.UNIT_COST, l.TOTAL_QTY_ORDERED, l.TOTAL_QTY_SHIPPED, 
        l.PRICE_ORG, l.ITEM_PROD_CAT, l.USER_FIELD_3, l.USER_FIELD_5, l.BILL_DATE, l.ITEM_CUSTOMER 
        FROM oeordlin l
        WHERE l.DB_NO IN ($DB) AND l.ORDER_NO BETWEEN $US AND $USE 
        AND l.USER_FIELD_5 = ''
        AND l.REQUEST_DATE BETWEEN $S AND $E $limit";
        $stm = $con->prepare($sql);
        $stm->execute();
        $results = $stm->fetchAll(PDO::FETCH_ASSOC);
        if ($stm->rowCount() >= 1) {
            foreach ($results as $row) {
                $ORDERSTATUS = $row['ORDERSTATUS'];
                $ORDERDATEENTERED = $row['ORDERDATEENTERED'];
                $ORDERAPPLYTONO = $row['ORDERAPPLYTONO'];
                $ORDERPURORDERNO = $row['ORDERPURORDERNO'];
                $ORDERCUSTOMERNO = $row['ORDERCUSTOMERNO'];
                $CUSTOMERBALMETHOD = strtoupper($row['CUSTOMERBALMETHOD']);
                $SHIPPINGDATE = $row['SHIPPINGDATE'];
                $SHIPVIACODE = strtoupper($row['SHIPVIACODE']);
                $TERMSCODE = $row['TERMSCODE'];
                $MFGINGLOCATION = $row['MFGINGLOCATION'];
                $TOTALSALEAMOUNT = $row['TOTALSALEAMOUNT'];
                $TOTALCOST = $row['TOTALCOST'];
                $SALESMAN =strtoupper($row['SALESMAN']);
                $DSMCODE = strtoupper($row['DSMCODE']);
                $DSMDESC = strtoupper($row['DSMDESC']);
                $DSMSORT = $row['DSMSORT'];
                $ITEMCAT = strtoupper(preg_replace('/\s+/', ' ',$row['ITEMCAT']));
                $INAME = strtoupper(preg_replace('/[^A-Za-z0-9-]/', '', $row['INAME']));
                $PRODCAT = strtoupper(preg_replace('/\s+/', ' ',$row['PRODCAT']));
                $DB_NO = $row['DB_NO'];
                $ORDER_TYPE = strtoupper($row['ORDER_TYPE']);
                $ORDER_NO = $row['ORDER_NO'];
                $SEQUENCE_NO = $row['SEQUENCE_NO'];
                $GEN_INV_NO = strtoupper($row['GEN_INV_NO']);
                $ITEM_NO = $row['ITEM_NO'];
                $LOCATION = $row['LOCATION'];
                $QTY_ORDERED = $row['QTY_ORDERED'];
                $QTY_TO_SHIP = $row['QTY_TO_SHIP'];
                $UNIT_PRICE = $row['UNIT_PRICE'];
                $REQUEST_DATE = $row['REQUEST_DATE'];
                $UNIT_OF_MEASURE = strtoupper($row['UNIT_OF_MEASURE']);
                $UNIT_COST = $row['UNIT_COST'];
                $TOTAL_QTY_ORDERED = $row['TOTAL_QTY_ORDERED'];
                $TOTAL_QTY_SHIPPED = $row['TOTAL_QTY_SHIPPED'];
                $PRICE_ORG = $row['PRICE_ORG'];
                $ITEM_PROD_CAT = strtoupper($row['ITEM_PROD_CAT']);
                $USER_FIELD_3 = $row['USER_FIELD_3'];
                $USER_FIELD_5 = $row['USER_FIELD_5'];
                $BILL_DATE = $row['BILL_DATE'];
                // branch mecha
                if ($DB_NO == 1) { $branch = 'GMA'; }
                elseif ($DB_NO == 3) { $branch = 'CANLUBANG'; }
                elseif ($DB_NO == 4) { $branch = 'PILI/NAGA'; }
                elseif ($DB_NO == 5) { $branch = 'PAMPANGA'; }
                elseif ($DB_NO == 12) { $branch = 'ESMO'; }
                elseif ($DB_NO == 13) { $branch = 'OZAMIZ'; }
                elseif ($DB_NO == 14) { $branch = 'AGDAO'; }
                elseif ($DB_NO == 15) { $branch = 'TORIL/COTABATO'; }
                if (isset($row['SALESMAN'])) {
                    $DSMCODE = preg_replace('/\s+/', '', $row['DSMCODE']);
                    $DSMDESC = preg_replace('/\s+/', '', $row['DSMDESC']);
                    $DSMSORT = preg_replace('/\s+/', '', $row['DSMSORT']);
                }
                else {
                    $DSMCODE = $row['SALESMAN'];
                    $DSMDESC = '';
                    $DSMSORT = '';
                }
                if (isset($row['CUSTOMERN'])) {
                    $CUSTOMERN = strtoupper($row['CUSTOMERN']);
                    $ADDRESSC = strtoupper($row['ADDRESSC']);
                    $TYPEC = $row['TYPEC'];
                    $TINC = $row['TINC'];
                }
                else {
                    $CUSTOMERN = strtoupper($row['CUSTOMER']);
                    $ADDRESSC = strtoupper("N/A");
                    $TYPEC = strtoupper("N/A");
                    $TINC = strtoupper("N/A");
                }
                // region mecha
                $SL = array("CD1", "CD2", "ND1", "OSC", "OSN");
                $NL = array("DD1", "PD1", "PD2", "SD1", "OSP", "OSD");
                $MT = array("I97", "GB1", "GB2");
                $GT = array("APX", "GBX", "GW1", "GX1", "GX2", "GMS", "OSE", "RB1");
                $V = array("BD1", "BX1", "LD1", "OD1", "TD1", "OSO", "OSL");
                $M = array("VD1", "VD2", "VD3", "YD1", "YX1", "ZD1", "OSA", "OSY", "OSZ", "OST");
                if (in_array($DSMCODE, $SL)) { $AREA = '1. SOUTH-LUZON'; }
                elseif (in_array($DSMCODE, $NL)) { $AREA = '2. NORTH-LUZON'; }
                elseif (in_array($DSMCODE, $MT)) { $AREA = '3. MODERN TRADE'; }
                elseif (in_array($DSMCODE, $GT)) { $AREA = '4. GEN TRADE'; }
                elseif (in_array($DSMCODE, $V)) { $AREA = '5. VISAYAS'; }
                elseif (in_array($DSMCODE, $M)) { $AREA = '6. MINDANAO'; }
                else { $AREA = 'N/A'; }
                // gross net mecha
                $gross = $QTY_TO_SHIP * $PRICE_ORG;
                $net = $QTY_TO_SHIP *  $UNIT_PRICE;
                if ($PRODCAT == 'RTD') { $PRODCAT = '1. RTD'; }
                elseif ($PRODCAT == 'DAIRY') { $PRODCAT = '2. DAIRY'; }
                elseif ($PRODCAT == 'NCB & CSD') { $PRODCAT = '3. NCB & CSD'; }
                elseif ($PRODCAT == 'FOOD') { $PRODCAT = '4. FOOD'; }
                elseif ($PRODCAT == 'POWDER') { $PRODCAT = '5. POWDER'; }
                $output['data'][] = array(
                    "",
                    "$DB_NO",
                    "$SALESMAN",
                    "$DSMCODE-$DSMDESC",
                    "$DSMSORT $DSMCODE-$DSMDESC",
                    "$branch",
                    "$ORDER_TYPE",
                    "$ORDER_NO",
                    "$SEQUENCE_NO",
                    "$ITEM_NO",
                    "$ITEMCAT",
                    "$PRODCAT",
                    "$INAME",
                    "$LOCATION",
                    "$QTY_ORDERED",
                    "$QTY_TO_SHIP",
                    "$UNIT_PRICE",
                    "$REQUEST_DATE",
                    "",
                    "",
                    "$UNIT_OF_MEASURE",
                    "$UNIT_COST",
                    "$TOTAL_QTY_ORDERED",
                    "$TOTAL_QTY_SHIPPED",
                    "$PRICE_ORG",
                    "",
                    "$ITEM_PROD_CAT",
                    "",
                    "",
                    "$USER_FIELD_3",
                    "",
                    "$USER_FIELD_5",
                    "$CUSTOMERN",
                    "$ADDRESSC",
                    "$TINC",
                    "",
                    "N/A",
                    "$AREA",
                    "$ORDER_NO",
                    "$BILL_DATE",
                    "$gross",
                    "$net",
                );
            }
        }
        else {
            $output['data'][] = array(
                    "",
                    "$S",
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
    }
    // Macola
    elseif ($dbval == 2) {
        $US = 90000000;
        $DB = '1';
        $startday = "00";
        $endday = "99";
        if ($lim <> '') {
            if (!strpos($lim, 'LIMIT')) {
                $param = explode(",", $lim);
                $startday = $param[0];
                $endday = $param[1];
            }
        }
        $limit = $lim;
        $STARTER = $yval . $mval . $startday;
        $ENDER = $yval . $mval . $endday;
        $sql = "SELECT 
        (SELECT C.CUSTOMER FROM v_customer_info C WHERE TRIM(C.DBNO) = TRIM(l.DATABASE_NO) 
        AND C.CUS_NO LIKE CONCAT ('%' , TRIM(l.CUSTOMER) , '%') LIMIT 1) AS CUSTOMERN, 
        (SELECT A.ADDRESS FROM v_customer_info A WHERE A.DBNO = l.DATABASE_NO AND A.CUS_NO LIKE CONCAT ('%' , l.CUSTOMER , '%') LIMIT 1) AS ADDRESSC, 
        (SELECT T.TIN_NO FROM v_customer_info T WHERE T.DBNO = l.DATABASE_NO AND T.CUS_NO LIKE CONCAT ('%' , l.CUSTOMER , '%') LIMIT 1) AS TINC, 
        (SELECT t.CUST_TYPE_CODE FROM v_customer_type t WHERE t.DBNO = l.DATABASE_NO AND t.CUS_NO LIKE CONCAT ('%' , l.CUSTOMER , '%') LIMIT 1) AS TYPEC, 
        (SELECT h.SALESMAN_NO1 FROM oehdrhst h WHERE h.DATABASE_NO = TRIM(l.DATABASE_NO) AND h.OE_NO = l.ORDER_NO LIMIT 1) AS SALESMAN, 
        (SELECT p.dsm_code FROM psr p WHERE p.psr_code = SALESMAN) AS DSMCODE, 
        (SELECT d.dsm_desc FROM dsm d WHERE d.dsm_code = DSMCODE) AS DSMDESC, 
        (SELECT ds.DSMSORT FROM dsm ds WHERE ds.dsm_code = DSMCODE) AS DSMSORT, 
        (SELECT i.CATEGORY FROM product i WHERE i.ITEM_NO = l.ITEM_NO) AS ITEMCAT, 
        (SELECT n.SKU FROM product n WHERE n.ITEM_NO = l.ITEM_NO) AS INAME, 
        (SELECT p.PROD_CODE FROM product p WHERE p.ITEM_NO = l.ITEM_NO) AS PRODCAT, 
        l.ID, l.DATABASE_NO, l.ORDER_TYPE, l.ORDER_NO, l.SEQUENCE_NO, l.ITEM_NO, l.LOCATION, l.QTY_ORDERED, l.QTY_TO_SHIP, l.UNIT_PRICE, 
        l.REQUEST_DATE, l.QTY_BACK_ORDERED, l.QTY_RETURN_TO_STOCK, l.UNIT_OF_MEASURE, l.UNIT_COST, l.TOTAL_QTY_ORDERED, l.TOTAL_QTY_SHIPPED, 
        l.PRICE_ORG, l.LAST_POST_DATE, l.ITEM_PROD_CAT, l.USER_FIELD_1, l.USER_FIELD_2, l.USER_FIELD_3, l.USER_FIELD_4, l.CUSTOMER, 
        l.INVOICE_NO, l.INVOICE_DATE, IF(l.USER_FIELD_5 = l.CUSTOMER, '', '0') AS USER_FIELD_5 
        FROM oelinhst l 
        WHERE l.DATABASE_NO IN ($DB) AND USER_FIELD_5 = '' AND TRIM(l.ORDER_TYPE) = 'o' AND l.UNIT_PRICE <> 0 
        AND l.INVOICE_NO < $US AND l.INVOICE_DATE BETWEEN $STARTER AND $ENDER $limit";
        $stm = $con->prepare($sql);
        $stm->execute();
        $results = $stm->fetchAll(PDO::FETCH_ASSOC);
        if ($stm->rowCount() >= 1) {
            foreach ($results as $row) {
                $ID = $row['ID'];
                $DATABASE_NO = $row['DATABASE_NO'];
                $ORDER_TYPE = strtoupper($row['ORDER_TYPE']);
                $ORDER_NO = $row['ORDER_NO'];
                $SEQUENCE_NO = $row['SEQUENCE_NO'];
                $ITEM_NO = $row['ITEM_NO'];
                $LOCATION = $row['LOCATION'];
                $QTY_ORDERED = $row['QTY_ORDERED'];
                $QTY_TO_SHIP = $row['QTY_TO_SHIP'];
                $UNIT_PRICE = $row['UNIT_PRICE'];
                $REQUEST_DATE = $row['REQUEST_DATE'];
                $QTY_BACK_ORDERED = $row['QTY_BACK_ORDERED'];
                $QTY_RETURN_TO_STOCK = $row['QTY_RETURN_TO_STOCK'];
                $UNIT_OF_MEASURE = strtoupper($row['UNIT_OF_MEASURE']);
                $UNIT_COST = $row['UNIT_COST'];
                $TOTAL_QTY_ORDERED = $row['TOTAL_QTY_ORDERED'];
                $TOTAL_QTY_SHIPPED = $row['TOTAL_QTY_SHIPPED'];
                $PRICE_ORG = $row['PRICE_ORG'];
                $LAST_POST_DATE = $row['LAST_POST_DATE'];
                $ITEM_PROD_CAT = strtoupper($row['ITEM_PROD_CAT']);
                $USER_FIELD_1 = $row['USER_FIELD_1'];
                $USER_FIELD_2 = $row['USER_FIELD_2'];
                $USER_FIELD_3 = $row['USER_FIELD_3'];
                $USER_FIELD_4 = $row['USER_FIELD_4'];
                $USER_FIELD_5 = strtoupper($row['USER_FIELD_5']);
                $CUSTOMER = $row['CUSTOMER'];
                $INVOICE_NO = $row['INVOICE_NO'];
                $INVOICE_DATE = $row['INVOICE_DATE'];
                // readable invoice date mecha
                $IDY = substr($INVOICE_DATE, 0, 4);
                $IDM = substr($INVOICE_DATE, 4, 2);
                $IDD = substr($INVOICE_DATE, 6, 2);
                $INAME = strtoupper(preg_replace('/[^A-Za-z0-9-]/', '', $row['INAME']));
                $ITEMCAT = strtoupper(preg_replace('/\s+/', ' ',$row['ITEMCAT']));
                $PRODCAT = preg_replace('/\s+/', '', $row['PRODCAT']);
                $PRODCAT = strtoupper(preg_replace('/[^a-zA-Z0-9\']/', '', $row['PRODCAT']));
                $SALESMAN = strtoupper($row['SALESMAN']);
                if (isset($row['SALESMAN'])) {
                    $DSMCODE = strtoupper(preg_replace('/\s+/', '', $row['DSMCODE']));
                    $DSMDESC = strtoupper(preg_replace('/\s+/', '', $row['DSMDESC']));
                    $DSMSORT = strtoupper(preg_replace('/\s+/', '', $row['DSMSORT']));
                }
                else {
                    $DSMCODE = $row['SALESMAN'];
                    $DSMDESC = '';
                    $DSMSORT = '';
                }
                if (isset($row['CUSTOMERN'])) {
                    $CUSTOMERN = strtoupper($row['CUSTOMERN']);
                    $ADDRESSC = strtoupper($row['ADDRESSC']);
                    $TYPEC = $row['TYPEC'];
                    $TINC = $row['TINC'];
                }
                else {
                    $CUSTOMERN = strtoupper($row['CUSTOMER']);
                    $ADDRESSC = strtoupper("N/A");
                    $TYPEC = strtoupper("N/A");
                    $TINC = strtoupper("N/A");
                }
                // region mecha
                $SL = array("CD1", "CD2", "ND1", "OSC", "OSN");
                $NL = array("DD1", "PD1", "PD2", "SD1", "OSP", "OSD");
                $MT = array("I97", "GB1", "GB2");
                $GT = array("APX", "GBX", "GW1", "GX1", "GX2", "GMS", "OSE", "RB1");
                $V = array("BD1", "BX1", "LD1", "OD1", "TD1", "OSO", "OSL");
                $M = array("VD1", "VD2", "VD3", "YD1", "YX1", "ZD1", "OSA", "OSY", "OSZ", "OST");
                if (in_array($DSMCODE, $SL)) { $AREA = '1. SOUTH-LUZON'; }
                elseif (in_array($DSMCODE, $NL)) { $AREA = '2. NORTH-LUZON'; }
                elseif (in_array($DSMCODE, $MT)) { $AREA = '3. MODERN TRADE'; }
                elseif (in_array($DSMCODE, $GT)) { $AREA = '4. GEN TRADE'; }
                elseif (in_array($DSMCODE, $V)) { $AREA = '5. VISAYAS'; }
                elseif (in_array($DSMCODE, $M)) { $AREA = '6. MINDANAO'; }
                else { $AREA = 'ERROR'; }
                // branch mecha
                if ($DATABASE_NO == 1) { $branch = 'GMA'; }
                elseif ($DATABASE_NO == 3) { $branch = 'CANLUBANG'; }
                elseif ($DATABASE_NO == 4) { $branch = 'PILI/NAGA'; }
                elseif ($DATABASE_NO == 5) { $branch = 'PAMPANGA'; }
                elseif ($DATABASE_NO == 12) { $branch = 'ESMO'; }
                elseif ($DATABASE_NO == 13) { $branch = 'OZAMIZ'; }
                elseif ($DATABASE_NO == 14) { $branch = 'AGDAO'; }
                elseif ($DATABASE_NO == 15) { $branch = 'TORIL/COTABATO'; }
                // gross net mecha
                $gross = $QTY_TO_SHIP * $PRICE_ORG;
                $net = $QTY_TO_SHIP *  $UNIT_PRICE;
                if ($PRODCAT == 'RTD') { $PRODCAT = '1. RTD'; }
                elseif ($PRODCAT == 'DAIRY') { $PRODCAT = '2. DAIRY'; }
                elseif ($PRODCAT == 'NCB & CSD') { $PRODCAT = '3. NCB & CSD'; }
                elseif ($PRODCAT == 'NCBCSD') { $PRODCAT = '3. NCB & CSD'; }
                elseif ($PRODCAT == 'FOOD') { $PRODCAT = '4. FOOD'; }
                elseif ($PRODCAT == 'POWDER') { $PRODCAT = '5. POWDER'; }
                $output['data'][] = array(
                    "",
                    "$DATABASE_NO",
                    "$SALESMAN",
                    "$DSMCODE-$DSMDESC",
                    "$DSMSORT $DSMCODE-$DSMDESC",
                    "$branch",
                    "$ORDER_TYPE",
                    "$ORDER_NO",
                    "$SEQUENCE_NO",
                    "$ITEM_NO",
                    "$ITEMCAT",
                    "$PRODCAT",
                    "$INAME",
                    "$LOCATION",
                    "$QTY_ORDERED",
                    "$QTY_TO_SHIP",
                    "$UNIT_PRICE",
                    "$REQUEST_DATE",
                    "$QTY_BACK_ORDERED",
                    "$QTY_RETURN_TO_STOCK",
                    "$UNIT_OF_MEASURE",
                    "$UNIT_COST",
                    "$TOTAL_QTY_ORDERED",
                    "$TOTAL_QTY_SHIPPED",
                    "$PRICE_ORG",
                    "$LAST_POST_DATE",
                    "$ITEM_PROD_CAT",
                    "$USER_FIELD_1",
                    "$USER_FIELD_2",
                    "$USER_FIELD_3",
                    "$USER_FIELD_4",
                    "$USER_FIELD_5",
                    "$CUSTOMERN",
                    "$ADDRESSC",
                    "$TINC",
                    "$TYPEC",
                    "N/A",
                    "$AREA",
                    "$INVOICE_NO",
                    "$INVOICE_DATE",
                    "$gross",
                    "$net"
                );
            }
        }
        else {
            $output['data'][] = array(
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
                    ""
                );
        }
    }
    // Noah
    elseif ($dbval == 3) {
        $T = $yval;
        $B = $mval;
        $S = 0;
        $E = 99;
        $startday = "00";
        $endday = "99";
        if ($lim <> '') {
            if (strpos($lim, 'LIMIT')) { $lim = "LIMIT " . $lim; }
            else {
                $param = explode(",", $lim);
                $S = $param[0];
                $E = $param[1];
            }
        }
        $limit = $lim;
        $sql = "SELECT 
        SUBSTRING(DSM, 1, 3) AS DSMCODE,
        SUBSTRING(SKU, 1, 7) AS ITEMNO,
        (SELECT ds.DSMSORT FROM dsm ds WHERE ds.dsm_code = DSMCODE) AS DSMSORT,
        (SELECT p.PROD_CODE FROM product p WHERE p.ITEM_NO = ITEMNO LIMIT 1) AS PRODCAT, 
        nl.*
        FROM noah_oelinhst nl
        WHERE
        nl.TAON = $T AND
        nl.BUWAN = $B AND
        nl.ARAW BETWEEN 0 AND 99
        $limit";
        $stm = $con->prepare($sql);
        $stm->execute();
        $results = $stm->fetchAll(PDO::FETCH_ASSOC);
        if ($stm->rowCount() >= 1) {
            foreach ($results as $row) {
                $id = $row['id'];
                $DBNO = strtoupper($row['DBNO']);
                $BRANCH_NAME = strtoupper($row['BRANCH_NAME']);
                $DSM = strtoupper($row['DSM']);
                $DSMSORT = $row['DSMSORT'];
                $SALESMAN_CODE = preg_replace('/\s+/', '', strtoupper($row['SALESMAN_CODE']));
                // SET DSM MECHA
                $dsmc = array("TD1-TACLOBAN","BX1-CEBU GT","LD1-ILOILO","OSD-OFFICE STA. BARBARA","SD1-CAUAYAN","DD1-STA BARBARA","OSE-OFFICE SALES EDSA","OSB-OFFICE SALES CEBU","OSL-OFFICE SALES ILOILO","OD1-BACOLOD","I97-HRI","OSS-OFFICE CAUAYAN","OSO-OFFICE BACOLOD","BD1-CEBU MT");
                if (in_array($DSM, $dsmc)) { $DSM = strtoupper($row['DSM']); }
                else {
                    if ($DBNO == "BCLD0000") {
                        if (strpos($SALESMAN_CODE, 'OFF') !== false) { $DSM = "OSO-OFFICE BACOLOD"; $DSMSORT = 28; }
                        else { $DSM = "OD1-BACOLOD"; $DSMSORT = 27; }
                    }
                    elseif ($DBNO == "CEBU0000") {
                        $BD = array("BK0000000118","BK0000000245","BK0000000116","BK0000000224","BK0000000041","BK0000000195","HRI000000121","BK0000000120","HRI000000122","BK0000000204","BK0000000247","BK0000000248","BH-S00000225");
                        $BX = array("VX0000000212","VX0000000126","VX0000000213","VX0000000152","VX0000000131","BK0000000119","VX0000000129","VX0000000127","VX0000000215");
                        $TD = array("BK0000000200","HRI000000208","BK0000000201");

                        if (strpos($SALESMAN_CODE, 'OFF') !== false) {
                            $DSM = "OSB-OFFICE SALES CEBU"; $DSMSORT = 24;
                        }
                        elseif (in_array($SALESMAN_CODE, $BD)) { $DSM = "BD1-CEBU MT"; $DSMSORT = 22; }
                        elseif (in_array($SALESMAN_CODE, $BX)) { $DSM = "BX1-CEBU GT"; $DSMSORT = 23; }
                        elseif (in_array($SALESMAN_CODE, $TD)) { $DSM = "TD1-TACLOBAN"; $DSMSORT = 29; }
                    }
                    elseif ($DBNO == "DGPN0000") {
                        if (strpos($SALESMAN_CODE, 'OFF') !== false) { $DSM = "OSD-OFFICE STA. BARBARA"; $DSMSORT = 16; }
                        else {
                            $DDONE = array("BK0000000166","BK0000000191","BK0000000206","VX0000000194","VX0000000216","VX0000000221","VX0000000246");
                            $SDONE = array("BK0000000136","VX0000000095","VX0000000095");
                            if (in_array($SALESMAN_CODE, $DDONE)) { $DSM = "DD1-STABARBARA"; $DSMSORT = 15; }
                            elseif (in_array($SALESMAN_CODE, $SDONE)) { $DSM = "SD1-CAUAYAN"; $DSMSORT = 20; }
                        }
                    }
                    elseif ($DBNO == "EDSA0000") {
                        if (strpos($SALESMAN_CODE, 'OFF') !== false) { $DSM = "OSE-OFFICE SALES EDSA"; $DSMSORT = 8; }
                        else { $DSM = "I97-HRI"; }
                    }
                    elseif ($DBNO == "ILOI0000") {
                        if (strpos($SALESMAN_CODE, 'OFF') !== false) { $DSM = "OSL-OFFICE SALES ILOILO"; $DSMSORT = 26; }
                        else { $DSM = "LD1-ILOILO"; $DSMSORT = 25; }
                    }
                    elseif ($DBNO == "STGO0000") {
                        if (strpos($SALESMAN_CODE, 'OFF') !== false) { $DSM = "OSS-OFFICE CAUAYAN"; $DSMSORT = 21; }
                        else { $DSM = "SD1-CAUAYAN"; $DSMSORT = 20; }
                    }
                }
                $TAON = $row['TAON'];
                $BUWAN = $row['BUWAN'];
                $ARAW = $row['ARAW'];
                $SELLING_TYPE = strtoupper($row['SELLING_TYPE']);
                $CUSTOMERS = strtoupper($row['CUSTOMERS']);
                $ADDRESS = strtoupper($row['ADDRESS']);
                $TIN = $row['TIN'];
                $CUSTOMERS_TYPE = strtoupper($row['CUSTOMERS_TYPE']);
                $PROVINCIAL = strtoupper($row['PROVINCIAL']);
                $ACCOUNTS = $row['ACCOUNTS'];
                $CATEGORY = strtoupper(preg_replace('/\s+/', ' ',$row['CATEGORY']));
                $PRODUCT_CATEGORY = strtoupper(preg_replace('/\s+/', ' ',$row['PRODUCT_CATEGORY']));
                if (strpos($PRODUCT_CATEGORY, 'CARBONATED PET 1') !== false) { $PRODUCT_CATEGORY = 'ZESTO CARBONATED PET 1.5L'; }
                $SKU = strtoupper(preg_replace('/[^A-Za-z0-9-]/', '', $row['SKU']));
                if (strpos($SKU, 'FRESHPICK') !== false) { $PRODUCT_CATEGORY = 'ZESTO FRESH PICK'; }
                $UOM = strtoupper($row['UOM']);
                $QTY = $row['QTY'];
                $AMOUNT = $row['AMOUNT'];
                $NET_AMOUNT = $row['NET_AMOUNT'];
                $TRANSDATE = $row['TRANSDATE'];
                $NOAH_INV_NO = strtoupper($row['NOAH_INV_NO']);
                $MANUAL_INV_NO = strtoupper($row['MANUAL_INV_NO']);
                $DATE_CONFIRMED = $row['DATE_CONFIRMED'];
                $DSMCODE = preg_replace('/\s+/', '', strtoupper($row['DSMCODE']));
                if ($DSMCODE == '') { $DSMCODE = substr($DSM, 0, 3); }
                else { $DSMCODE = preg_replace('/\s+/', '', strtoupper($row['DSMCODE'])); }
                $ITEMNO = $row['ITEMNO'];
                $PRODCAT = $row['PRODCAT'];
                // REGION/AREA MECHA
                $SL = array("CD1", "CD2", "ND1", "OSC", "OSN");
                $NL = array("DD1", "PD1", "PD2", "SD1", "OSP", "OSD", "OSS");
                $MT = array("I97", "GB1", "GB2");
                $GT = array("APX", "GBX", "GW1", "GX1", "GX2", "OSE");
                $V = array("BD1", "BX1", "LD1", "OD1", "TD1", "OSO", "OSL", "OSB");
                $M = array("VD1", "VD2", "VD3", "YD1", "YX1", "ZD1", "OSA", "OSY", "OSZ", "OST");
                if (in_array($DSMCODE, $SL)) { $AREA = '1. SOUTH-LUZON'; }
                elseif (in_array($DSMCODE, $NL)) { $AREA = '2. NORTH-LUZON'; }
                elseif (in_array($DSMCODE, $MT)) { $AREA = '3. MODERN TRADE'; }
                elseif (in_array($DSMCODE, $GT)) { $AREA = '4. GEN TRADE'; }
                elseif (in_array($DSMCODE, $V)) { $AREA = '5. VISAYAS'; }
                elseif (in_array($DSMCODE, $M)) { $AREA = '6. MINDANAO'; }
                else { $AREA = $DSMCODE; }
                if ($PRODCAT == 'RTD') { $PRODCAT = '1. RTD'; }
                elseif ($PRODCAT == 'DAIRY') { $PRODCAT = '2. DAIRY'; }
                elseif ($PRODCAT == 'NCB & CSD') { $PRODCAT = '3. NCB & CSD'; }
                elseif ($PRODCAT == 'FOOD') { $PRODCAT = '4. FOOD'; }
                elseif ($PRODCAT == 'POWDER') { $PRODCAT = '5. POWDER'; }
                $output['data'][] = array(
                    "",
                    "$DBNO",
                    "$SALESMAN_CODE",
                    "$DSM",
                    "$DSMSORT $DSM",
                    "$BRANCH_NAME",
                    "$SELLING_TYPE",
                    "$NOAH_INV_NO",
                    "",
                    "$ITEMNO",
                    "$PRODUCT_CATEGORY",
                    "$PRODCAT",
                    "$SKU",
                    "",
                    "$QTY",
                    "$QTY",
                    "",
                    "$TRANSDATE",
                    "",
                    "",
                    "$UOM",
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
                    "$CUSTOMERS",
                    "$ADDRESS",
                    "$TIN",
                    "$CUSTOMERS_TYPE",
                    "$PROVINCIAL",
                    "$AREA",
                    "$MANUAL_INV_NO",
                    "$TRANSDATE",
                    "$AMOUNT",
                    "$NET_AMOUNT",
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
                    ""
                );
        }
    }
    else { echo "Error."; $output = 'ERROR'; }
    echo json_encode($output);
?>