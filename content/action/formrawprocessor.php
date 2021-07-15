<?php
	date_default_timezone_set("Asia/Manila");
	$Ynow = date('Y');
    $MDnow = date('md');
    $time = time();
	$start = 00000000;
	$end = 99999999;
	require '../dbase/dbconfig.php';
	if (isset($_POST['rawdata'])) {
		$rawdata = $_POST['rawdata'];
		if (strpos($rawdata, 'maxpacket') !== false) {
			$sqlsetglobal = "SET GLOBAL max_allowed_packet=1073741824";
			$stmsetglobal = $con->prepare($sqlsetglobal);
			$stmsetglobal->execute();
			echo "MAX PACKET SET.";
		}
		elseif (strpos(strtolower($rawdata), 'dtf') !== false) { 
			echo "Showing Custom Formatter. \n";
			$splitter = explode(" ", $rawdata);
			echo $splitter[1];
		}
		elseif (strpos($rawdata, 'formatter') !== false) {
			//="formatter "&A1&","&B1&","&C1
			$rawdata = str_replace(["'","1-TOTAL", "2-TOTAL", "3-TOTAL", "4-TOTAL", "5-TOTAL", "6-TOTAL", "1. ", "2. ", "3. ", "4. ", "5. ", "6. ", "1 ", "2 ", "3 ", "4 ", "5 "], "",$rawdata);
			$rowdata = explode('formatter', $rawdata);
			$autodivide = substr_count($rawdata, "formatter");
			$runner = 0;
			$skurunner = 0;
			$yearcounter = -1;
			$monthcounter = -1;
			$areacounter = -1;
			$dsmcounter = -1;
			$mktgcounter = -1;
			$itmcounter = -1;
			$uomcounter = -1;
			$yeararraypusher = array();
			$montharraypusher = array();
			$areaarraypusher = array();
			$dsmarraypusher = array();
			$mktgarraypusher = array();
			$itmarraypusher = array();
			$uomarraypusher = array();
			$skuarray = array();
			while ($runner < $autodivide) {
				$datarunner = $runner + 1;
				$data = explode(',', preg_replace('/\s+/', ' ', $rowdata[$datarunner]));
				$areaarray = array("MINDANAO", "NORTH LUZON", "NCR",  "SOUTH LUZON", "VISAYAS", "MODERN TRADE", "GEN TRADE", "SOUTH-LUZON", "NORTH-LUZON");
				$dsmarray = array("APX-ASIA PRIMERA", "BD1-CEBU MT", "BX1-CEBU GT",  "CD1-CANLUBANG", "CD2-CANLUBANG", "DD1-STA BARBARA", "GB1-BOOKING I", "GB2-BOOKING II", "GBX-NORTH-GMA", "GW1-SOUTH-GMA", "GX1-EAST-GMA", "GX2-WEST-GMA", "I97-HRI", "LD1-ILOILO", "ND1-PILI", "OD1-BACOLOD", "PD1-PABAZA DISTRICT", "PD2-BUNETA DISTRICT", "RB1-DAIRY BARN", "SD1-CAUAYAN", "TD1-TACLOBAN", "VD1-NORTH DAVAO", "VD2-COTABATO", "VD3-COTABATO II", "YD1-ESMO-CBL REGION", "YX1-ESMO-CRG REGION", "ZD1-OZAMIZ", "OSN-OFFICE SALES NAGA", "OSA-OFFICE SALES AGDAO", "OST-OFFICE SALES TORIL", "OSY-OFFICE SALES ESMO", "OSZ-OFFICE SALES OZAMIZ", "OSB-OFFICE SALES CEBU", "OSL-OFFICE SALES ILOILO", "OSO-OFFICE SALES BACOLOD", "OSE-OFFICE SALES HO", "OSD-OFFICE SALES STA. BARBARA", "OSP-OFFICE SALES PAMPANGA", "OSS-OFFICE SALES CAUAYAN");
				$mktgarray = array("RTD", "FOOD", "NCB & CSD",  "POWDER", "DAIRY", "OTHER LINE");
				$catarray = array("BIG-250 RTD","JR RTD","OK LAKI RTD","OK RTD","PLUS 200 RTD","PLUS BURST RTD","PLUS KING RTD","SUNGLO RTD","ZESTO FRESH PICK","ZESTO RTD","DUTCH MAID","YOGHURT 110ML","YOGHURT 200ML","ZESTO CHOCO REG 200ML","ZESTO CHOCO TBA 250ML","ZESTO CHOCO TWA 110ML","PURIFIED WATER","ZESTO CARBONATED 237ML","ZESTO CARBONATED 330ML","ZESTO CARBONATED PET 1.5L","ZESTO CARBONATED PET 500ML","ZESTO JUICE IN CAN","ZESTO SLICE 355ML","QUICK CHOW INSTANT","QUICK CHOW RICE NOODLES","QUICK CHOW CANTON","QUICK CHOW CUP NOODLES","TEKKI SHOMEN","TEKKI YAKIUDON","TITA FRITA","SUNGLO POWDER JUICE","ZESTO ICED TEA POWDER","EXTRA JOSS", "ZESTO ICED TEA RTD", "ZESTO KIDZ", "HAUS BLEND CAFE", "ZESTO MILKO FM 1L", "ONE TEA 355ML", "ONE TEA 500ML", "SUNBURST 250ML", "JUCU JUCU 200ML", "ZESTO MILKO FM 250ML", "ZESTO SLICE PET 1.25L", "ZESTO CARBONATED 250ML");
				$uomarray = array("BX", "BX10", "BX11", "PC", "CS", "CS24", "PK04", "CS08", "PK05", "CS12", "CS6", "CS30", "CS06", "CS08", "CS72", "PK10", "PK08", "CS48", "CS60", "PK06", "CS4", "CS8");
				// CHECKER
				if (strlen(str_replace(' ', '', $data[0])) == 4 && is_numeric(str_replace(' ', '', $data[0]))) {
					$YEARNUM = $data[0];
					$YEARPREV = '';
					array_push($yeararraypusher,$YEARNUM);
					if ($YEARNUM <> $YEARPREV) { $yearcounter++; }
					$YEARPREV = $data[0];
				}
				elseif (strlen(preg_replace('/\s+/', ' ', $data[0])) <= 2) {
					$MONTHNUM = $data[0];
					$MONTHPREV = '';
					array_push($montharraypusher,$MONTHNUM);
					if ($MONTHPREV <> $MONTHNUM) { $monthcounter++; }
					$MONTHPREV = $data[0];
				}
				elseif (in_array(trim($data[0]), $areaarray)) {
					$AREA = $data[0];
					$AREAPREV = '';
					array_push($areaarraypusher,$AREA);
					if ($AREAPREV <> $AREA) { $areacounter++; }
					$AREAPREV = $data[0];
				}
				elseif (in_array(trim($data[0]), $dsmarray)) { 
					$DSM = $data[0];
					$DSMPREV = '';
					array_push($dsmarraypusher,$DSM);
					if ($DSMPREV <> $DSM) { $dsmcounter++; }
					$DSMPREV = $data[0];
				}
				elseif (in_array(trim($data[0]), $mktgarray)) { 
					$MARKETING_CATEGORY = $data[0];
					$MKTGPREV = '';
					array_push($mktgarraypusher,$MARKETING_CATEGORY);
					if ($MKTGPREV <> $MARKETING_CATEGORY) { $mktgcounter++; }
					$MKTGPREV = $data[0];
				}
				elseif (in_array(trim($data[0]), $catarray)) { 
					$ITEM_CATEGORY = $data[0];
					$ITMPREV = '';
					array_push($itmarraypusher,$ITEM_CATEGORY);
					if ($ITMPREV <> $ITEM_CATEGORY) { $itmcounter++; }
					$ITMPREV = $data[0];
				}
				elseif (in_array(str_replace(' ', '', $data[0]), $uomarray)) { 
					$UOM = $data[0];
					$UOMPREV = '';
					array_push($uomarraypusher,$UOM);
					if ($UOMPREV <> $UOM) { $uomcounter++; }
					$UOMPREV = $data[0];
				}
				elseif (strlen(preg_replace('/\s+/', ' ', $data[0])) >= 20 && !in_array(trim($data[0]), $catarray)) {
					$SKU = preg_replace( '/\s+/', ' ', $data[0]);
					$VOL = $data[1];
					$PV = $data[2];
					$AREAa = $areaarraypusher[$areacounter];
					$DSMa = $dsmarraypusher[$dsmcounter];
					$MARKETING_CATEGORYa = $mktgarraypusher[$mktgcounter];
					$ITEM_CATEGORYa = $itmarraypusher[$itmcounter];
					$UOMa = $uomarraypusher[$uomcounter];
					$MONTHNUMa = $montharraypusher[$monthcounter];
					$YEARNUMa = $yeararraypusher[$yearcounter];
					$sqlinsert = "INSERT INTO formatter (AREA, DSM, MARKETING_CATEGORY, ITEM_CATEGORY, UOM, SKU, VOL, PV, MONTHNUM, YEARNUM) VALUES ('$AREAa', '$DSMa', '$MARKETING_CATEGORYa', '$ITEM_CATEGORYa', '$UOMa', '$SKU', '$VOL', '$PV', '$MONTHNUMa', '$YEARNUMa')";
					$stminsert = $con->prepare($sqlinsert);
					$stminsert->execute();
					$skurunner++;
				}
				$runner++;
			}
			echo "$skurunner(s) records inserted";
		}
		else {
			// CLEANERS
			$rawdata = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $_POST['rawdata']);
			$rawdata = str_replace(["'","UPDATE","OR ","INSERT","INTO","VALUES", "MATCHING","DATABASE_NO,ORDER_NO,SEQUENCE_NO","DATABASE_NO, OE_NO, CUSTOMER_NO","(", ")", ";", "/"], "",$rawdata);
			$rawdata = preg_replace('/\\\\/', '', $rawdata);
			$rawdata = strtolower($rawdata);
			// LINE OELINHST MECHA
			if (strpos($rawdata, 'oelinhst') !== false AND strpos($rawdata, 'oehdrhst') === false) {
				$rowdata = explode('oelinhst', $rawdata);
				$autodivide = substr_count($rawdata, "oelinhst");
				$runner = 0;
				$values = '';
				while ($runner < $autodivide) {
					$datarunner = $runner + 1;
					$data = explode(',', $rowdata[$datarunner]);
					$DATABASE_NO = str_replace(' ', '', $data[0]);
					$ORDER_TYPE = str_replace(' ', '', $data[1]);
					$ORDER_NO = str_replace(' ', '', $data[2]);
					$SEQUENCE_NO = str_replace(' ', '', $data[3]);
					$ITEM_NO = str_replace(' ', '', $data[4]);
					$LOCATION = str_replace(' ', '', $data[5]);
					$QTY_ORDERED = str_replace(' ', '', $data[6]);
					$QTY_TO_SHIP = str_replace(' ', '', $data[7]);
					$UNIT_PRICE = str_replace(' ', '', $data[8]);
					$REQUEST_DATE = str_replace(' ', '', $data[9]);
					$QTY_BACK_ORDERED = str_replace(' ', '', $data[10]);
					$QTY_RETURN_TO_STOCK = str_replace(' ', '', $data[11]);
					$UNIT_OF_MEASURE = str_replace(' ', '', $data[12]);
					$UNIT_COST = str_replace(' ', '', $data[13]);
					$TOTAL_QTY_ORDERED = str_replace(' ', '', $data[14]);
					$TOTAL_QTY_SHIPPED = str_replace(' ', '', $data[15]);
					$PRICE_ORG = str_replace(' ', '', $data[16]);
					$LAST_POST_DATE = str_replace(' ', '', $data[17]);
					$ITEM_PROD_CAT = str_replace(' ', '', $data[18]);
					$USER_FIELD_1 = str_replace(' ', '', $data[19]);
					$USER_FIELD_2 = str_replace(' ', '', $data[20]);
					$USER_FIELD_3 = str_replace(' ', '', $data[21]);
					$USER_FIELD_4 = str_replace(' ', '', $data[22]);
					$USER_FIELD_5 = str_replace(' ', '', $data[23]);
					$CUSTOMER = str_replace(' ', '', $data[24]);
					$INVOICE_NO = str_replace(' ', '', $data[25]);
					if (isset($data[26])) { $INVOICE_DATE = $data[26]; }
					else { $INVOICE_DATE = ''; }
					// CHECKER
					$sqlchecker = "SELECT ID, ORDER_NO, ITEM_NO FROM oelinhst WHERE DATABASE_NO = '$DATABASE_NO' AND ORDER_NO = '$ORDER_NO' AND ITEM_NO = '$ITEM_NO' AND UNIT_PRICE = '$UNIT_PRICE' AND INVOICE_DATE BETWEEN $start AND $end";
					$stmchecker = $con->prepare($sqlchecker);
					$stmchecker->execute();
					if ($stmchecker->rowCount() > 0) { $DATABASE_NO = "D" . $DATABASE_NO; }
					$values .= "('$DATABASE_NO', '$ORDER_TYPE', '$ORDER_NO', '$SEQUENCE_NO', '$ITEM_NO', '$LOCATION', '$QTY_ORDERED', '$QTY_TO_SHIP', '$UNIT_PRICE', '$REQUEST_DATE', '$QTY_BACK_ORDERED', '$QTY_RETURN_TO_STOCK', '$UNIT_OF_MEASURE', '$UNIT_COST', '$TOTAL_QTY_ORDERED', '$TOTAL_QTY_SHIPPED', '$PRICE_ORG', '$LAST_POST_DATE', '$ITEM_PROD_CAT', '$USER_FIELD_1', '$USER_FIELD_2', '$USER_FIELD_3', '$USER_FIELD_4', '$USER_FIELD_5', '$CUSTOMER', '$INVOICE_NO', '$INVOICE_DATE'),";
					$runner++;
				}
				$values = rtrim($values, ", ");
				$sqlinsert = "INSERT INTO oelinhst (DATABASE_NO, ORDER_TYPE, ORDER_NO, SEQUENCE_NO, ITEM_NO, LOCATION, QTY_ORDERED, QTY_TO_SHIP, UNIT_PRICE, REQUEST_DATE, QTY_BACK_ORDERED, QTY_RETURN_TO_STOCK, UNIT_OF_MEASURE, UNIT_COST, TOTAL_QTY_ORDERED, TOTAL_QTY_SHIPPED, PRICE_ORG, LAST_POST_DATE, ITEM_PROD_CAT, USER_FIELD_1, USER_FIELD_2, USER_FIELD_3, USER_FIELD_4, USER_FIELD_5, CUSTOMER, INVOICE_NO, INVOICE_DATE) VALUES " . $values;
				//echo $sqlinsert;
				$stminsert = $con->prepare($sqlinsert);
				$stminsert->execute();
				// DUPLICATE CHECKER
				$sqldupchecker = "SELECT DATABASE_NO FROM `oelinhst` WHERE DATABASE_NO LIKE '%D%' ";
				$stmdupchecker = $con->prepare($sqldupchecker);
				$stmdupchecker->execute();
				$duplicounter = $stmdupchecker->rowCount();
				echo "$duplicounter duplicate entry. \n";
				//echo date('h:i A') . "\n";
				echo "$runner(s) records inserted";
				// DELETE DUPLICATE
				$sqldupdelete = "DELETE FROM `oelinhst` WHERE DATABASE_NO LIKE '%D%' ";
				$stmdupdelete = $con->prepare($sqldupdelete);
				$stmdupdelete->execute();
			}
			// HEAD OEHDRHST MECHA
			elseif (strpos($rawdata, 'oelinhst') === false AND strpos($rawdata, 'oehdrhst') !== false) {
				$rowdata = explode('oehdrhst', $rawdata);
				$autodivide = substr_count($rawdata, "oehdrhst");
				$runner = 0;
				$values = '';
				while ($runner < $autodivide) {
					$datarunner = $runner + 1;
					$data = explode(',', $rowdata[$datarunner]);
					$DATABASE_NO = str_replace(' ', '', $data[0]);
					$OEHH_TYPE = str_replace(' ', '', $data[1]);
					$OE_NO = str_replace(' ', '', $data[2]);
					$STATUS = str_replace(' ', '', $data[3]);
					$DATE_ENTERED = str_replace(' ', '', $data[4]);
					$OEHH_DATE = str_replace(' ', '', $data[5]);
					$APPLY_TO_NO = str_replace(' ', '', $data[6]);
					$CUSTOMER_NO = str_replace(' ', '', $data[7]);
					$SHIPPING_DATE = str_replace(' ', '', $data[8]);
					$SHIP_VIA_CODE = str_replace(' ', '', $data[9]);
					$TERMS_CODE = str_replace(' ', '', $data[10]);
					$SALESMAN_NO1 = str_replace(' ', '', $data[11]);
					$TAX_CODE_1 = str_replace(' ', '', $data[12]);
					$MFGING_LOCATION = str_replace(' ', '', $data[13]);
					$TOTAL_SALE_AMOUNT = str_replace(' ', '', $data[14]);
					$TOTAL_TAXABLE_AMOUNT = str_replace(' ', '', $data[15]);
					$DATE_PICKED = str_replace(' ', '', $data[16]);
					$DATE_BILLED = str_replace(' ', '', $data[17]);
					$INVOICE_NO = str_replace(' ', '', $data[18]);
					$INVOICE_DATE = str_replace(' ', '', $data[19]);
					$POSTED_DATE = str_replace(' ', '', $data[20]);
					$ORIG_ORDER_TYPE = str_replace(' ', '', $data[21]);
					$ORIG_ORDER_DATE = str_replace(' ', '', $data[22]);
					$ORIG_ORDER_NO = str_replace(' ', '', $data[23]);
					$OE_CASH_KEY = str_replace(' ', '', $data[24]);
					$USER_FIELD_1 = str_replace(' ', '', $data[25]);
					$USER_FIELD_2 = str_replace(' ', '', $data[26]);
					$USER_FIELD_3 = str_replace(' ', '', $data[27]);
					$USER_FIELD_4 = str_replace(' ', '', $data[28]);
					$USER_FIELD_5 = str_replace(' ', '', $data[29]);
					$DATE_SHIPPED = str_replace(' ', '', $data[30]);
					$OE_PO_NO = str_replace(' ', '', $data[31]);
					// CHECKER
					$sqlchecker = "SELECT ID, OE_NO, SALESMAN_NO1 FROM oehdrhst WHERE DATABASE_NO = '$DATABASE_NO' AND OE_NO = '$OE_NO' AND SALESMAN_NO1 = '$SALESMAN_NO1' AND ORIG_ORDER_TYPE = '$ORIG_ORDER_TYPE' ";
					$stmchecker = $con->prepare($sqlchecker);
					$stmchecker->execute();
					if ($stmchecker->rowCount() > 0) { $DATABASE_NO = "D" . $DATABASE_NO; }
					$values .= "('$DATABASE_NO', '$OEHH_TYPE', '$OE_NO', '$STATUS', '$DATE_ENTERED', '$OEHH_DATE', '$APPLY_TO_NO', '$CUSTOMER_NO', '$SHIPPING_DATE', '$SHIP_VIA_CODE', '$TERMS_CODE', '$SALESMAN_NO1', '$TAX_CODE_1', '$MFGING_LOCATION', '$TOTAL_SALE_AMOUNT', '$TOTAL_TAXABLE_AMOUNT', '$DATE_PICKED', '$DATE_BILLED', '$INVOICE_NO', '$INVOICE_DATE', '$POSTED_DATE', '$ORIG_ORDER_TYPE', '$ORIG_ORDER_DATE', '$ORIG_ORDER_NO', '$OE_CASH_KEY', '$USER_FIELD_1', '$USER_FIELD_2', '$USER_FIELD_3', '$USER_FIELD_4', '$USER_FIELD_5', '$DATE_SHIPPED', '$OE_PO_NO'),";
					$runner++;
				}
				$values = rtrim($values, ", ");
				$sqlinsert = "INSERT INTO oehdrhst (DATABASE_NO, OEHH_TYPE, OE_NO, STATUS, DATE_ENTERED, OEHH_DATE, APPLY_TO_NO, CUSTOMER_NO, SHIPPING_DATE, SHIP_VIA_CODE, TERMS_CODE, SALESMAN_NO1, TAX_CODE_1, MFGING_LOCATION, TOTAL_SALE_AMOUNT, TOTAL_TAXABLE_AMOUNT, DATE_PICKED, DATE_BILLED, INVOICE_NO, INVOICE_DATE, POSTED_DATE, ORIG_ORDER_TYPE, ORIG_ORDER_DATE, ORIG_ORDER_NO, OE_CASH_KEY, USER_FIELD_1, USER_FIELD_2, USER_FIELD_3, USER_FIELD_4, USER_FIELD_5, DATE_SHIPPED, OE_PO_NO) VALUES " . $values;
				//echo $sqlinsert;
				$stminsert = $con->prepare($sqlinsert);
				$stminsert->execute();
				// DUPLICATE CHECKER
				$sqldupchecker = "SELECT DATABASE_NO FROM `oehdrhst` WHERE DATABASE_NO LIKE '%D%' ";
				$stmdupchecker = $con->prepare($sqldupchecker);
				$stmdupchecker->execute();
				$duplicounter = $stmdupchecker->rowCount();
				echo "$duplicounter duplicate entry. \n";
				//echo date('h:i A') . "\n";
				echo "$runner(s) records inserted.";
				// DELETE DUPLICATE
				$sqldupdelete = "DELETE FROM `oehdrhst` WHERE DATABASE_NO LIKE '%D%' ";
				$stmdupdelete = $con->prepare($sqldupdelete);
				$stmdupdelete->execute();
			}
			// ITEM MECHA
			elseif (strpos($rawdata, 'oelinhst') === false AND strpos($rawdata, 'oehdrhst') === false AND strpos($rawdata, 'productx') !== false) {
				$rowdata = explode('productx', $rawdata);
				$autodivide = substr_count($rawdata, "productx");
				$runner = 0;
				while ($runner < $autodivide) {
					$datarunner = $runner + 1;
					$data = explode(',', $rowdata[$datarunner]);
					$CATEGORY = $data[0];
					$SKU = $data[1];
					$ITEM_NO = $data[2];
					// CHECKER
					$sqlchecker = "SELECT ITEM_NO FROM product WHERE ITEM_NO = '$ITEM_NO' ";
					$stmchecker = $con->prepare($sqlchecker);
					$stmchecker->execute();
					if ($stmchecker->rowCount() > 0) { $ITEM_NO = "D" . $ITEM_NO; }
					$sqlinsert = "INSERT INTO product (CATEGORY, SKU, ITEM_NO) VALUES ('$CATEGORY', '$SKU', '$ITEM_NO')";
					$stminsert = $con->prepare($sqlinsert);
					$stminsert->execute();
					$runner++;
				}
				// DUPLICATE CHECKER
				$sqldupchecker = "SELECT ITEM_NO FROM `product` WHERE ITEM_NO LIKE '%D%' ";
				$stmdupchecker = $con->prepare($sqldupchecker);
				$stmdupchecker->execute();
				$duplicounter = $stmdupchecker->rowCount();
				echo "$duplicounter duplicate entry. \n";
				echo date('h:i A') . "\n";
				echo "$runner(s) records inserted.";
				// DELETE DUPLICATE
				$sqldupdelete = "DELETE FROM `product` WHERE ITEM_NO LIKE '%D%' ";
				$stmdupdelete = $con->prepare($sqldupdelete);
				$stmdupdelete->execute();
			}
			// ITEM MECHA 2
			elseif (strpos($rawdata, 'oelinhst') === false AND strpos($rawdata, 'oehdrhst') === false AND strpos($rawdata, 'prodx2') !== false) {
				$rowdata = explode('prodx2', $rawdata);
				$autodivide = substr_count($rawdata, "prodx2");
				$runner = 0;
				$values = '';
				while ($runner < $autodivide) {
					$datarunner = $runner + 1;
					$data = explode(',', $rowdata[$datarunner]);
					$CATEGORY = $data[0];
					$ITEM_NO = $data[1];
					$SKU = $data[2];
					$PROD_CAT = $data[3];
					// CHECKER
					$sqlchecker = "SELECT ITEM_NO FROM product WHERE ITEM_NO = $ITEM_NO ";
					$stmchecker = $con->prepare($sqlchecker);
					$stmchecker->execute();
					if ($stmchecker->rowCount() > 0) { $ITEM_NO = "D" . $ITEM_NO; }
					$values .= "('$CATEGORY', '$ITEM_NO', '$SKU', '$PROD_CAT'),";
					$runner++;
				}
				$values = rtrim($values, ", ");
				$sqlinsert = "INSERT INTO product (CATEGORY, ITEM_NO, SKU, PROD_CAT) VALUES " . $values;
				$stminsert = $con->prepare($sqlinsert);
				$stminsert->execute();
				// DUPLICATE CHECKER
				$sqldupchecker = "SELECT ITEM_NO FROM `product` WHERE ITEM_NO LIKE '%D%' ";
				$stmdupchecker = $con->prepare($sqldupchecker);
				$stmdupchecker->execute();
				$duplicounter = $stmdupchecker->rowCount();
				echo "$duplicounter duplicate entry. \n";
				echo date('h:i A') . "\n";
				echo "$runner(s) records inserted.";
				// DELETE DUPLICATE
				$sqldupdelete = "DELETE FROM `product` WHERE ITEM_NO LIKE '%D%' ";
				$stmdupdelete = $con->prepare($sqldupdelete);
				$stmdupdelete->execute();
			}
			// CUSTOMER MECHA
			elseif (strpos($rawdata, 'oelinhst') === false AND strpos($rawdata, 'oehdrhst') === false AND strpos($rawdata, 'customerz') !== false) {
				$rowdata = explode('customerz', $rawdata);
				$autodivide = substr_count($rawdata, "customerz");
				$runner = 0;
				$values = '';
				while ($runner < $autodivide) {
					$datarunner = $runner + 1;
					$data = explode(',', $rowdata[$datarunner]);
					$DBNO = $data[0];
					$CUS_NO = $data[1];
					$CUSTOMER = $data[2];
					$ADDRESS = $data[3];
					$TIN_NO = $data[4];
					$CONTACT_PERSON = $data[5];
					$CREDIT_LIMIT = $data[6];
					// checker
					$sqlchecker = "SELECT ID, DBNO, CUS_NO FROM v_customer_info WHERE DBNO = $DBNO AND CUS_NO = '$CUS_NO'";
					$stmchecker = $con->prepare($sqlchecker);
					$stmchecker->execute();
					if ($stmchecker->rowCount() > 0) { $DBNO = "D" . $DBNO; }
					$values .= "('$DBNO', '$CUS_NO', '$CUSTOMER', '$ADDRESS', '$TIN_NO', '$CONTACT_PERSON', '$CREDIT_LIMIT'),";
					$runner++;
				}
				$values = rtrim($values, ", ");
				$sqlinsert = "INSERT INTO v_customer_info (DBNO, CUS_NO, CUSTOMER, ADDRESS, TIN_NO, CONTACT_PERSON, CREDIT_LIMIT) VALUES " . $values;
				$stminsert = $con->prepare($sqlinsert);
				$stminsert->execute();
				// DUPLICATE CHECKER
				$sqldupchecker = "SELECT DBNO FROM `v_customer_info` WHERE DBNO LIKE '%D%' ";
				$stmdupchecker = $con->prepare($sqldupchecker);
				$stmdupchecker->execute();
				$duplicounter = $stmdupchecker->rowCount();
				echo "$duplicounter duplicate entry. \n";
				echo date('h:i A') . "\n";
				echo "$runner(s) records inserted";
				// DELETE DUPLICATE
				$sqldupdelete = "DELETE FROM `v_customer_info` WHERE DBNO LIKE '%D%' ";
				$stmdupdelete = $con->prepare($sqldupdelete);
				$stmdupdelete->execute();
			}
			// HEAD OEORHDR MECHA
			elseif (strpos($rawdata, 'oelinhst') === false AND strpos($rawdata, 'oehdrhst') === false AND strpos($rawdata, 'oeorhdr') !== false) {
				$rowdata = explode('oeorhdr', $rawdata);
				$autodivide = substr_count($rawdata, "oeorhdr");
				$runner = 0;
				$values = '';
				while ($runner < $autodivide) {
					$datarunner = $runner + 1;
					$data = explode(',', $rowdata[$datarunner]);
					$DB_NO = str_replace(' ', '', $data[0]);
					$ORDER_TYPE = str_replace(' ', '', $data[1]);
					$ORDER_NO = str_replace(' ', '', $data[2]);
					$ORDER_STATUS = str_replace(' ', '', $data[3]);
					$ORDER_DATE_ENTERED = str_replace(' ', '', $data[4]);
					$ORDER_DATE = str_replace(' ', '', $data[5]);
					$ORDER_APPLY_TO_NO = str_replace(' ', '', $data[6]);
					$ORDER_PUR_ORDER_NO = str_replace(' ', '', $data[7]);
					$ORDER_CUSTOMER_NO = str_replace(' ', '', $data[8]);
					$CUSTOMER_BAL_METHOD = str_replace(' ', '', $data[9]);
					$SHIPPING_DATE = str_replace(' ', '', $data[10]);
					$SHIP_VIA_CODE = str_replace(' ', '', $data[11]);
					$TERMS_CODE = str_replace(' ', '', $data[12]);
					$SALESMAN_NO_1 = str_replace(' ', '', $data[13]);
					$MFGING_LOCATION = str_replace(' ', '', $data[14]);
					$TOTAL_SALE_AMOUNT = str_replace(' ', '', $data[15]);
					$TOTAL_COST = str_replace(' ', '', $data[16]);
					$INVOICE_NO = str_replace(' ', '', $data[17]);
					$INVOICE_DATE = str_replace(' ', '', $data[18]);
					$OE_CASH_KEY = str_replace(' ', '', $data[19]);
					$USER_FIELD_1 = str_replace(' ', '', $data[20]);
					$USER_FIELD_2 = str_replace(' ', '', $data[21]);
					$USER_FIELD_3 = str_replace(' ', '', $data[22]);
					$USER_FIELD_4 = str_replace(' ', '', $data[23]);
					$USER_FIELD_5 = str_replace(' ', '', $data[24]);
					$ENCODED_BY = str_replace(' ', '', $data[25]);
					// CHECKER
					$sqlchecker = "SELECT ID, ORDER_NO, SALESMAN_NO_1 FROM OEORDHDR WHERE DB_NO = '$DB_NO' AND ORDER_NO = '$ORDER_NO' AND SALESMAN_NO_1 = '$SALESMAN_NO_1' AND ORDER_TYPE = '$ORDER_TYPE' ";
					$stmchecker = $con->prepare($sqlchecker);
					$stmchecker->execute();
					if ($stmchecker->rowCount() > 0) { $DB_NO = "D" . $DB_NO; }
					$values .= "('$DB_NO', '$ORDER_TYPE', '$ORDER_NO', '$ORDER_STATUS', '$ORDER_DATE_ENTERED', '$ORDER_DATE', '$ORDER_APPLY_TO_NO', '$ORDER_PUR_ORDER_NO', '$ORDER_CUSTOMER_NO', '$CUSTOMER_BAL_METHOD', '$SHIPPING_DATE', '$SHIP_VIA_CODE', '$TERMS_CODE', '$SALESMAN_NO_1', '$MFGING_LOCATION', '$TOTAL_SALE_AMOUNT', '$TOTAL_COST', '$INVOICE_NO', '$INVOICE_DATE', '$OE_CASH_KEY', '$USER_FIELD_1', '$USER_FIELD_2', '$USER_FIELD_3', '$USER_FIELD_4', '$USER_FIELD_5', '$ENCODED_BY'),";
					$runner++;
				}
				$values = rtrim($values, ", ");
				$sqlinsert = "INSERT INTO OEORDHDR (DB_NO, ORDER_TYPE, ORDER_NO, ORDER_STATUS, ORDER_DATE_ENTERED, ORDER_DATE, ORDER_APPLY_TO_NO, ORDER_PUR_ORDER_NO, ORDER_CUSTOMER_NO, CUSTOMER_BAL_METHOD, SHIPPING_DATE, SHIP_VIA_CODE, TERMS_CODE, SALESMAN_NO_1, MFGING_LOCATION, TOTAL_SALE_AMOUNT, TOTAL_COST, INVOICE_NO, INVOICE_DATE, OE_CASH_KEY, USER_FIELD_1, USER_FIELD_2, USER_FIELD_3, USER_FIELD_4, USER_FIELD_5, ENCODED_BY) VALUES " . $values;
				// echo $sqlinsert;
				$stminsert = $con->prepare($sqlinsert);
				$stminsert->execute();
				// DUPLICATE CHECKER
				$sqldupchecker = "SELECT DB_NO FROM `OEORDHDR` WHERE DB_NO LIKE '%D%' ";
				$stmdupchecker = $con->prepare($sqldupchecker);
				$stmdupchecker->execute();
				$duplicounter = $stmdupchecker->rowCount();
				echo "$duplicounter duplicate entry. \n";
				// echo date('h:i A') . "\n";
				echo "$runner(s) records inserted";
				// DELETE DUPLICATE
				$sqldupdelete = "DELETE FROM `OEORDHDR` WHERE DB_NO LIKE '%D%' ";
				$stmdupdelete = $con->prepare($sqldupdelete);
				$stmdupdelete->execute();
			}
			// LINE OEORDLIN MECHA
			elseif (strpos($rawdata, 'oelinhst') === false AND strpos($rawdata, 'oehdrhst') === false AND strpos($rawdata, 'oeordlin') !== false) {
				$rowdata = explode('oeordlin', $rawdata);
				$autodivide = substr_count($rawdata, "oeordlin");
				$runner = 0;
				$values = '';
				while ($runner < $autodivide) {
					$datarunner = $runner + 1;
					$data = explode(',', $rowdata[$datarunner]);
					$DB_NO = str_replace(' ', '', $data[0]);
					$ORDER_TYPE = str_replace(' ', '', $data[1]);
					$ORDER_NO = str_replace(' ', '', $data[2]);
					$SEQUENCE_NO = str_replace(' ', '', $data[3]);
					$GEN_INV_NO = str_replace(' ', '', $data[4]);
					$ITEM_NO = str_replace(' ', '', $data[5]);
					$LOCATION = str_replace(' ', '', $data[6]);
					$QTY_ORDERED = str_replace(' ', '', $data[7]);
					$QTY_TO_SHIP = str_replace(' ', '', $data[8]);
					$UNIT_PRICE = str_replace(' ', '', $data[9]);
					$REQUEST_DATE = str_replace(' ', '', $data[10]);
					$UNIT_OF_MEASURE = str_replace(' ', '', $data[11]);
					$UNIT_COST = str_replace(' ', '', $data[12]);
					$TOTAL_QTY_ORDERED = str_replace(' ', '', $data[13]);
					$TOTAL_QTY_SHIPPED = str_replace(' ', '', $data[14]);
					$PRICE_ORG = str_replace(' ', '', $data[15]);
					$ITEM_PROD_CAT = str_replace(' ', '', $data[16]);
					$USER_FIELD_3 = str_replace(' ', '', $data[17]);
					$USER_FIELD_5 = str_replace(' ', '', $data[18]);
					$BILL_DATE = str_replace(' ', '', $data[19]);
					$ITEM_CUSTOMER = str_replace(' ', '', $data[20]);
					// CHECKER
					$sqlchecker = "SELECT ID, ORDER_NO, ITEM_NO FROM oeordlin WHERE DB_NO = $DB_NO AND ORDER_NO = $ORDER_NO AND ITEM_NO = '$ITEM_NO' AND UNIT_PRICE = '$UNIT_PRICE' AND REQUEST_DATE BETWEEN $start AND $end";
					$stmchecker = $con->prepare($sqlchecker);
					$stmchecker->execute();
					if ($stmchecker->rowCount() > 0) { $DB_NO = "D" . $DB_NO; }
					$values .= "('$DB_NO', '$ORDER_TYPE', '$ORDER_NO', '$SEQUENCE_NO', '$GEN_INV_NO', '$ITEM_NO', '$LOCATION', '$QTY_ORDERED', '$QTY_TO_SHIP', '$UNIT_PRICE', '$REQUEST_DATE', '$UNIT_OF_MEASURE', '$UNIT_COST', '$TOTAL_QTY_ORDERED', '$TOTAL_QTY_SHIPPED', '$PRICE_ORG', '$ITEM_PROD_CAT', '$USER_FIELD_3', '$USER_FIELD_5', '$BILL_DATE', '$ITEM_CUSTOMER'),";
					$runner++;
				}
				$values = rtrim($values, ", ");
				$sqlinsert = "INSERT INTO oeordlin (DB_NO, ORDER_TYPE, ORDER_NO, SEQUENCE_NO, GEN_INV_NO, ITEM_NO, LOCATION, QTY_ORDERED, QTY_TO_SHIP, UNIT_PRICE, REQUEST_DATE, UNIT_OF_MEASURE, UNIT_COST, TOTAL_QTY_ORDERED, TOTAL_QTY_SHIPPED, PRICE_ORG, ITEM_PROD_CAT, USER_FIELD_3, USER_FIELD_5, BILL_DATE, ITEM_CUSTOMER) VALUES " . $values;
				// echo $sqlinsert;
				$stminsert = $con->prepare($sqlinsert);
				$stminsert->execute();
				// DUPLICATE CHECKER
				$sqldupchecker = "SELECT DB_NO FROM `oeordlin` WHERE DB_NO LIKE '%D%' ";
				$stmdupchecker = $con->prepare($sqldupchecker);
				$stmdupchecker->execute();
				$duplicounter = $stmdupchecker->rowCount();
				echo "$duplicounter duplicate entry. \n";
				// echo date('h:i A') . "\n";
				echo "$runner(s) records inserted";
				// DELETE DUPLICATE
				$sqldupdelete = "DELETE FROM `oeordlin` WHERE DB_NO LIKE '%D%' ";
				$stmdupdelete = $con->prepare($sqldupdelete);
				$stmdupdelete->execute();
			}
			// NOAH OEORDLIN MECHA
			elseif (strpos($rawdata, 'oelinhst') === false AND strpos($rawdata, 'oehdrhst') === false AND strpos($rawdata, 'noahx') !== false) {
				$rowdata = explode('noahx', $rawdata);
				$autodivide = substr_count($rawdata, "noahx");
				$runner = 0;
				$values = '';
				while ($runner < $autodivide) {
					$datarunner = $runner + 1;
					$data = explode(',', $rowdata[$datarunner]);
					$DBNO = str_replace(' ', '', $data[0]);
					$BRANCH_NAME = str_replace(' ', '', $data[1]);
					$DSM = str_replace(' ', '', $data[2]);
					$SALESMAN_CODE = str_replace(' ', '', $data[3]);
					$TAON = str_replace(' ', '', $data[4]);
					$BUWAN = str_replace(' ', '', $data[5]);
					$ARAW = str_replace(' ', '', $data[6]);
					$SELLING_TYPE = str_replace(' ', '', $data[7]);
					$CUSTOMERS = str_replace(' ', '', $data[8]);
					$ADDRESS = $data[9];
					$TIN = str_replace(' ', '', $data[10]);
					$CUSTOMERS_TYPE = str_replace(' ', '', $data[11]);
					$PROVINCIAL = str_replace(' ', '', $data[12]);
					$ACCOUNTS = str_replace(' ', '', $data[13]);
					$CATEGORY = $data[14];
					$PRODUCT_CATEGORY = $data[15];
					$SKU = str_replace(' ', '', $data[16]);
					$UOM = str_replace(' ', '', $data[17]);
					$QTY = str_replace(' ', '', $data[18]);
					$AMOUNT = str_replace(' ', '', $data[19]);
					$NET_AMOUNT = str_replace(' ', '', $data[20]);
					$TRANSDATE = $data[21];
					$NOAH_INV_NO = str_replace(' ', '', $data[22]);
					$MANUAL_INV_NO = str_replace(' ', '', $data[23]);
					$DATE_CONFIRMED = $data[24];
					// checker
					$sqlchecker = "SELECT id, DBNO FROM noah_oelinhst WHERE DBNO = '$DBNO' AND SKU = '$SKU' AND TRANSDATE = '$TRANSDATE' AND NOAH_INV_NO = '$NOAH_INV_NO' ";
					$stmchecker = $con->prepare($sqlchecker);
					$stmchecker->execute();
					if ($stmchecker->rowCount() > 0) { $DBNO = "DUPLI" . $DBNO; }
					$values .= "('$DBNO', '$BRANCH_NAME', '$DSM', '$SALESMAN_CODE', $TAON, $BUWAN, $ARAW, '$SELLING_TYPE', '$CUSTOMERS', '$ADDRESS', '$TIN', '$CUSTOMERS_TYPE', '$PROVINCIAL', '$ACCOUNTS', '$CATEGORY', '$PRODUCT_CATEGORY', '$SKU', '$UOM', '$QTY', '$AMOUNT', '$NET_AMOUNT', '$TRANSDATE', '$NOAH_INV_NO', '$MANUAL_INV_NO', '$DATE_CONFIRMED'),";
					$runner++;
				}
				$values = rtrim($values, ", ");
				$sqlinsert = "INSERT INTO noah_oelinhst (DBNO, BRANCH_NAME, DSM, SALESMAN_CODE, TAON, BUWAN, ARAW, SELLING_TYPE, CUSTOMERS, ADDRESS, TIN, CUSTOMERS_TYPE, PROVINCIAL, ACCOUNTS, CATEGORY, PRODUCT_CATEGORY, SKU, UOM, QTY, AMOUNT, NET_AMOUNT, TRANSDATE, NOAH_INV_NO, MANUAL_INV_NO, DATE_CONFIRMED) VALUES " . $values;
				// echo $sqlinsert;
				$stminsert = $con->prepare($sqlinsert);
				$stminsert->execute();
				// DUPLICATE CHECKER
				$sqldupchecker = "SELECT DBNO FROM `noah_oelinhst` WHERE DBNO LIKE '%DUPLI%' ";
				$stmdupchecker = $con->prepare($sqldupchecker);
				$stmdupchecker->execute();
				$duplicounter = $stmdupchecker->rowCount();
				echo "$duplicounter duplicate entry. \n";
				// echo date('h:i A') . "\n";
				echo "$runner(s) records inserted";
				// DELETE DUPLICATE
				$sqldupdelete = "DELETE FROM `noah_oelinhst` WHERE DBNO LIKE '%DUPLI%' ";
				$stmdupdelete = $con->prepare($sqldupdelete);
				$stmdupdelete->execute();
			}
			// SO
			elseif (strpos($rawdata, 'oelinhst') === false AND strpos($rawdata, 'oehdrhst') === false AND strpos($rawdata, 'salesorderz') !== false) {
				$rowdata = explode('salesorderz', $rawdata);
				$autodivide = substr_count($rawdata, "salesorderz");
				$runner = 0;
				$values = '';

			}
			// ARCUSFIL
			elseif (strpos($rawdata, 'oelinhst') === false AND strpos($rawdata, 'oehdrhst') === false AND strpos($rawdata, 'arcusfil_sql') !== false) {
				$rowdata = explode('arcusfil_sql', $rawdata);
				$autodivide = substr_count($rawdata, "arcusfil_sql");
				$runner = 0;
				$values = '';
				while ($runner < $autodivide) {
					$datarunner = $runner + 1;
					$data = explode(',', $rowdata[$datarunner]);
					$dbno = preg_replace('/\s+/', ' ', $data[0]);
					$CUS_NO = preg_replace('/\s+/', ' ', $data[1]);
					$CUS_NAME = preg_replace('/\s+/', ' ', $data[2]);
					$CUS_STREET1 = preg_replace('/\s+/', ' ', $data[3]);
					$CUS_STREET2 = preg_replace('/\s+/', ' ', $data[4]);
					$CUS_CITY = preg_replace('/\s+/', ' ', $data[5]);
					$CUS_ST = preg_replace('/\s+/', ' ', $data[6]);
					$CUS_ZIP = preg_replace('/\s+/', ' ', $data[7]);
					$CUS_COUNTRY = preg_replace('/\s+/', ' ', $data[8]);
					$CUS_CONTACT = preg_replace('/\s+/', ' ', $data[9]);
					$CUS_CONTACT_2 = preg_replace('/\s+/', ' ', $data[10]);
					$CUS_PHONE_NO = preg_replace('/\s+/', ' ', $data[11]);
					$CUS_PHONE_NO_2 = preg_replace('/\s+/', ' ', $data[12]);
					$CUS_PHONE_EXT = preg_replace('/\s+/', ' ', $data[13]);
					$CUS_PHONE_EXT_2 = preg_replace('/\s+/', ' ', $data[14]);
					$CUS_FAX_NO = preg_replace('/\s+/', ' ', $data[15]);
					$CUS_START_DT = preg_replace('/\s+/', ' ', $data[16]);
					$CUS_SLM_NO = preg_replace('/\s+/', ' ', $data[17]);
					$CUS_TP = preg_replace('/\s+/', ' ', $data[18]);
					$CUS_BAL_METH = preg_replace('/\s+/', ' ', $data[19]);
					$CUS_STM_FREQ = preg_replace('/\s+/', ' ', $data[20]);
					$CUS_CR_LIMIT = preg_replace('/\s+/', ' ', $data[21]);
					$CUS_CR_RATING = preg_replace('/\s+/', ' ', $data[22]);
					$CUS_CR_HOLD_FG = preg_replace('/\s+/', ' ', $data[23]);
					$CUS_COLLECTOR = preg_replace('/\s+/', ' ', $data[24]);
					$CUS_FIN_CHG_FG = preg_replace('/\s+/', ' ', $data[25]);
					$CUS_ORIGIN = preg_replace('/\s+/', ' ', $data[26]);
					$FILLER_0003 = preg_replace('/\s+/', ' ', $data[27]);
					$CUS_TERR = preg_replace('/\s+/', ' ', $data[28]);
					$CUS_CURR_CODE = preg_replace('/\s+/', ' ', $data[29]);
					$CUS_PARENT_CUS_NO = preg_replace('/\s+/', ' ', $data[30]);
					$CUS_PARENT_CUS_FLG = preg_replace('/\s+/', ' ', $data[31]);
					$CUS_SHIP_VIA_CD = preg_replace('/\s+/', ' ', $data[32]);
					$CUS_UPS_ZONE = preg_replace('/\s+/', ' ', $data[33]);
					$CUS_TERMS_CD = preg_replace('/\s+/', ' ', $data[34]);
					$CUS_DSC_PCT = preg_replace('/\s+/', ' ', $data[35]);
					$CUS_YTD_DSC_GIVEN = preg_replace('/\s+/', ' ', $data[36]);
					$CUS_TXBL_FG = preg_replace('/\s+/', ' ', $data[37]);
					$CUS_TX_CD1 = preg_replace('/\s+/', ' ', $data[38]);
					$CUS_TX_CD2 = preg_replace('/\s+/', ' ', $data[39]);
					$CUS_TX_CD3 = preg_replace('/\s+/', ' ', $data[40]);
					$CUS_EXEMPT_NO = preg_replace('/\s+/', ' ', $data[41]);
					$CUS_SALES_PTD = preg_replace('/\s+/', ' ', $data[42]);
					$CUS_SALES_YTD = preg_replace('/\s+/', ' ', $data[43]);
					$CUS_SALES_LAST_YR = preg_replace('/\s+/', ' ', $data[44]);
					$CUS_COST_PTD = preg_replace('/\s+/', ' ', $data[45]);
					$CUS_COST_YTD = preg_replace('/\s+/', ' ', $data[46]);
					$CUS_COST_LAST_YR = preg_replace('/\s+/', ' ', $data[47]);
					$CUS_BALANCE = preg_replace('/\s+/', ' ', $data[48]);
					$CUS_HIGH_BALANCE = preg_replace('/\s+/', ' ', $data[49]);
					$CUS_LAST_SALE_DT = preg_replace('/\s+/', ' ', $data[50]);
					$CUS_LAST_SALE_AMT = preg_replace('/\s+/', ' ', $data[51]);
					$CUS_INV_YTD = preg_replace('/\s+/', ' ', $data[52]);
					$CUS_INV_LAST_YR = preg_replace('/\s+/', ' ', $data[53]);
					$CUS_PAID_INV_YTD = preg_replace('/\s+/', ' ', $data[54]);
					$CUS_LAST_PAY_DT = preg_replace('/\s+/', ' ', $data[55]);
					$CUS_LAST_PAY_AMT = preg_replace('/\s+/', ' ', $data[56]);
					$CUS_AVG_PAY_YTD = preg_replace('/\s+/', ' ', $data[57]);
					$CUS_AVG_PAY_LAST_YR = preg_replace('/\s+/', ' ', $data[58]);
					$CUS_LAST_STM_AGE_DT = preg_replace('/\s+/', ' ', $data[59]);
					$CUS_AMT_AGE_PD1 = preg_replace('/\s+/', ' ', $data[60]);
					$CUS_AMT_AGE_PD2 = preg_replace('/\s+/', ' ', $data[61]);
					$CUS_AMT_AGE_PD3 = preg_replace('/\s+/', ' ', $data[62]);
					$CUS_AMT_AGE_PD4 = preg_replace('/\s+/', ' ', $data[63]);
					$CUS_ALLOW_SUB_ITMS = preg_replace('/\s+/', ' ', $data[64]);
					$CUS_ALLOW_BO = preg_replace('/\s+/', ' ', $data[65]);
					$CUS_ALLOW_PART_SHIP = preg_replace('/\s+/', ' ', $data[66]);
					$CUS_PRINT_DUNN_FG = preg_replace('/\s+/', ' ', $data[67]);
					$CUS_COMMENT1 = preg_replace('/\s+/', ' ', $data[68]);
					$CUS_COMMENT2 = preg_replace('/\s+/', ' ', $data[69]);
					$CUS_AP_VENDOR = preg_replace('/\s+/', ' ', $data[70]);
					$CUS_TAX_SCHED = preg_replace('/\s+/', ' ', $data[71]);
					$CUS_CREDCRD1_DESC = preg_replace('/\s+/', ' ', $data[72]);
					$CUS_CREDCRD1_ACCT = preg_replace('/\s+/', ' ', $data[73]);
					$CUS_CREDCRD1_EXP_DT = preg_replace('/\s+/', ' ', $data[74]);
					$CUS_CREDCRD2_DESC = preg_replace('/\s+/', ' ', $data[75]);
					$CUS_CREDCRD2_ACCT = preg_replace('/\s+/', ' ', $data[76]);
					$CUS_CREDCRD2_EXP_DT = preg_replace('/\s+/', ' ', $data[77]);
					$CUS_USER_FLD1 = preg_replace('/\s+/', ' ', $data[78]);
					$CUS_USER_FLD2 = preg_replace('/\s+/', ' ', $data[79]);
					$CUS_USER_FLD3 = preg_replace('/\s+/', ' ', $data[80]);
					$CUS_USER_FLD4 = preg_replace('/\s+/', ' ', $data[81]);
					$CUS_USER_FLD5 = preg_replace('/\s+/', ' ', $data[82]);
					$DEFAULT_INV_FORM = preg_replace('/\s+/', ' ', $data[83]);
					$CUS_ORDER_LOC = preg_replace('/\s+/', ' ', $data[84]);
					$CUS_NOTE_1 = preg_replace('/\s+/', ' ', $data[85]);
					$CUS_NOTE_2 = preg_replace('/\s+/', ' ', $data[86]);
					$CUS_NOTE_3 = preg_replace('/\s+/', ' ', $data[87]);
					$CUS_NOTE_4 = preg_replace('/\s+/', ' ', $data[88]);
					$CUS_NOTE_5 = preg_replace('/\s+/', ' ', $data[89]);
					$CUS_USER_DATE = preg_replace('/\s+/', ' ', $data[90]);
					$USER_AMOUNT = preg_replace('/\s+/', ' ', $data[91]);
					$CUS_AMT_AGE_OE_TERM = preg_replace('/\s+/', ' ', $data[92]);
					$CUS_ALT_ADDRESS = preg_replace('/\s+/', ' ', $data[93]);
					$CUS_RFC_NUMBER = preg_replace('/\s+/', ' ', $data[94]);
					$EMAIL_ADDR = preg_replace('/\s+/', ' ', $data[95]);
					// checker
					$sqlchecker = "SELECT id, DBNO FROM arcusfil_sql WHERE dbno = '$dbno' AND Cus_No = '$CUS_NO'";
					$stmchecker = $con->prepare($sqlchecker);
					$stmchecker->execute();
					if ($stmchecker->rowCount() > 0) { $dbno = "DUPLI" . $dbno; }
					$values .= "('$dbno','$CUS_NO','$CUS_NAME','$CUS_STREET1','$CUS_STREET2','$CUS_CITY','$CUS_ST','$CUS_ZIP','$CUS_COUNTRY','$CUS_CONTACT','$CUS_CONTACT_2','$CUS_PHONE_NO','$CUS_PHONE_NO_2','$CUS_PHONE_EXT','$CUS_PHONE_EXT_2','$CUS_FAX_NO','$CUS_START_DT','$CUS_SLM_NO','$CUS_TP','$CUS_BAL_METH','$CUS_STM_FREQ','$CUS_CR_LIMIT','$CUS_CR_RATING','$CUS_CR_HOLD_FG','$CUS_COLLECTOR','$CUS_FIN_CHG_FG','$CUS_ORIGIN','$FILLER_0003','$CUS_TERR','$CUS_CURR_CODE','$CUS_PARENT_CUS_NO','$CUS_PARENT_CUS_FLG','$CUS_SHIP_VIA_CD','$CUS_UPS_ZONE','$CUS_TERMS_CD','$CUS_DSC_PCT','$CUS_YTD_DSC_GIVEN','$CUS_TXBL_FG','$CUS_TX_CD1','$CUS_TX_CD2','$CUS_TX_CD3','$CUS_EXEMPT_NO','$CUS_SALES_PTD','$CUS_SALES_YTD','$CUS_SALES_LAST_YR','$CUS_COST_PTD','$CUS_COST_YTD','$CUS_COST_LAST_YR','$CUS_BALANCE','$CUS_HIGH_BALANCE','$CUS_LAST_SALE_DT','$CUS_LAST_SALE_AMT','$CUS_INV_YTD','$CUS_INV_LAST_YR','$CUS_PAID_INV_YTD','$CUS_LAST_PAY_DT','$CUS_LAST_PAY_AMT','$CUS_AVG_PAY_YTD','$CUS_AVG_PAY_LAST_YR','$CUS_LAST_STM_AGE_DT','$CUS_AMT_AGE_PD1','$CUS_AMT_AGE_PD2','$CUS_AMT_AGE_PD3','$CUS_AMT_AGE_PD4','$CUS_ALLOW_SUB_ITMS','$CUS_ALLOW_BO','$CUS_ALLOW_PART_SHIP','$CUS_PRINT_DUNN_FG','$CUS_COMMENT1','$CUS_COMMENT2','$CUS_AP_VENDOR','$CUS_TAX_SCHED','$CUS_CREDCRD1_DESC','$CUS_CREDCRD1_ACCT','$CUS_CREDCRD1_EXP_DT','$CUS_CREDCRD2_DESC','$CUS_CREDCRD2_ACCT','$CUS_CREDCRD2_EXP_DT','$CUS_USER_FLD1','$CUS_USER_FLD2','$CUS_USER_FLD3','$CUS_USER_FLD4','$CUS_USER_FLD5','$DEFAULT_INV_FORM','$CUS_ORDER_LOC','$CUS_NOTE_1','$CUS_NOTE_2','$CUS_NOTE_3','$CUS_NOTE_4','$CUS_NOTE_5','$CUS_USER_DATE','$USER_AMOUNT','$CUS_AMT_AGE_OE_TERM','$CUS_ALT_ADDRESS','$CUS_RFC_NUMBER','$EMAIL_ADDR'),";
					$runner++;
				}
				$values = rtrim($values, ", ");
				$sqlinsert = "INSERT INTO arcusfil_sql (dbno,CUS_NO,CUS_NAME,CUS_STREET1,CUS_STREET2,CUS_CITY,CUS_ST,CUS_ZIP,CUS_COUNTRY,CUS_CONTACT,CUS_CONTACT_2,CUS_PHONE_NO,CUS_PHONE_NO_2,CUS_PHONE_EXT,CUS_PHONE_EXT_2,CUS_FAX_NO,CUS_START_DT,CUS_SLM_NO,CUS_TP,CUS_BAL_METH,CUS_STM_FREQ,CUS_CR_LIMIT,CUS_CR_RATING,CUS_CR_HOLD_FG,CUS_COLLECTOR,CUS_FIN_CHG_FG,CUS_ORIGIN,FILLER_0003,CUS_TERR,CUS_CURR_CODE,CUS_PARENT_CUS_NO,CUS_PARENT_CUS_FLG,CUS_SHIP_VIA_CD,CUS_UPS_ZONE,CUS_TERMS_CD,CUS_DSC_PCT,CUS_YTD_DSC_GIVEN,CUS_TXBL_FG,CUS_TX_CD1,CUS_TX_CD2,CUS_TX_CD3,CUS_EXEMPT_NO,CUS_SALES_PTD,CUS_SALES_YTD,CUS_SALES_LAST_YR,CUS_COST_PTD,CUS_COST_YTD,CUS_COST_LAST_YR,CUS_BALANCE,CUS_HIGH_BALANCE,CUS_LAST_SALE_DT,CUS_LAST_SALE_AMT,CUS_INV_YTD,CUS_INV_LAST_YR,CUS_PAID_INV_YTD,CUS_LAST_PAY_DT,CUS_LAST_PAY_AMT,CUS_AVG_PAY_YTD,CUS_AVG_PAY_LAST_YR,CUS_LAST_STM_AGE_DT,CUS_AMT_AGE_PD1,CUS_AMT_AGE_PD2,CUS_AMT_AGE_PD3,CUS_AMT_AGE_PD4,CUS_ALLOW_SUB_ITMS,CUS_ALLOW_BO,CUS_ALLOW_PART_SHIP,CUS_PRINT_DUNN_FG,CUS_COMMENT1,CUS_COMMENT2,CUS_AP_VENDOR,CUS_TAX_SCHED,CUS_CREDCRD1_DESC,CUS_CREDCRD1_ACCT,CUS_CREDCRD1_EXP_DT,CUS_CREDCRD2_DESC,CUS_CREDCRD2_ACCT,CUS_CREDCRD2_EXP_DT,CUS_USER_FLD1,CUS_USER_FLD2,CUS_USER_FLD3,CUS_USER_FLD4,CUS_USER_FLD5,DEFAULT_INV_FORM,CUS_ORDER_LOC,CUS_NOTE_1,CUS_NOTE_2,CUS_NOTE_3,CUS_NOTE_4,CUS_NOTE_5,CUS_USER_DATE,USER_AMOUNT,CUS_AMT_AGE_OE_TERM,CUS_ALT_ADDRESS,CUS_RFC_NUMBER,EMAIL_ADDR) VALUES " . $values;
				//echo $sqlinsert;
				$stminsert = $con->prepare($sqlinsert);
				$stminsert->execute();
				// DUPLICATE CHECKER
				$sqldupchecker = "SELECT dbno FROM `arcusfil_sql` WHERE dbno LIKE '%DUPLI%' ";
				$stmdupchecker = $con->prepare($sqldupchecker);
				$stmdupchecker->execute();
				$duplicounter = $stmdupchecker->rowCount();
				echo "$duplicounter duplicate entry. \n";
				// echo date('h:i A') . "\n";
				echo "$runner(s) records inserted";
				// DELETE DUPLICATE
				$sqldupdelete = "DELETE FROM `arcusfil_sql` WHERE dbno LIKE '%DUPLI%' ";
				$stmdupdelete = $con->prepare($sqldupdelete);
				$stmdupdelete->execute();
			}
			// NATIONAL SALES
			elseif (strpos($rawdata, 'nationalsalesx') !== false) {
				set_time_limit(3600);
				$rowdata = explode('nationalsalesx', $rawdata);
				$autodivide = substr_count($rawdata, "nationalsalesx");
				$runner = 0;
				$values = '';
				while ($runner < $autodivide) {
					$datarunner = $runner + 1;
					$data = explode(',', $rowdata[$datarunner]);
					$DBNO = preg_replace('/\s+/', ' ', str_replace(' ', '', $data[0]));
					$SALESMAN = preg_replace('/\s+/', ' ', $data[1]);
					$DSM = preg_replace('/\s+/', ' ', $data[2]);
					$BRANCH = preg_replace('/\s+/', ' ', $data[3]);
					$OT = preg_replace('/\s+/', ' ', $data[4]);
					$ORDERNO = preg_replace('/\s+/', ' ', $data[5]);
					$SEQUENCENO = preg_replace('/\s+/', ' ', $data[6]);
					$ITEMNO = preg_replace('/\s+/', ' ', $data[7]);
					$LOCATION = preg_replace('/\s+/', ' ', $data[8]);
					$QTYORDERED = preg_replace('/\s+/', ' ', $data[9]);
					$QTYTOSHIP = preg_replace('/\s+/', ' ', $data[10]);
					$UNITPRICE = preg_replace('/\s+/', ' ', $data[11]);
					$REQUESTDATE = preg_replace('/\s+/', ' ', $data[12]);
					$QBO = preg_replace('/\s+/', ' ', $data[13]);
					$QRTS = preg_replace('/\s+/', ' ', $data[14]);
					$UOM = preg_replace('/\s+/', ' ', $data[15]);
					$UNITCOST = preg_replace('/\s+/', ' ', $data[16]);
					$TQO = preg_replace('/\s+/', ' ', $data[17]);
					$TQS = preg_replace('/\s+/', ' ', $data[18]);
					$PRICEORIG = preg_replace('/\s+/', ' ', $data[19]);
					$LPD = preg_replace('/\s+/', ' ', $data[20]);
					$IPC = preg_replace('/\s+/', ' ', $data[21]);
					$UF1 = preg_replace('/\s+/', ' ', $data[22]);
					$UF2 = preg_replace('/\s+/', ' ', $data[23]);
					$UF3 = preg_replace('/\s+/', ' ', $data[24]);
					$UF4 = preg_replace('/\s+/', ' ', $data[25]);
					$UF5 = preg_replace('/\s+/', ' ', $data[26]);
					$CUSTOMER = preg_replace('/\s+/', ' ', $data[27]);
					$CUSTOMER = preg_replace("/[^A-Za-z0-9 -.]/", "", $CUSTOMER);
					$PROVINCIAL = preg_replace('/\s+/', ' ', $data[28]);
					$INVOICENO = preg_replace('/\s+/', ' ', $data[29]);
					$INVOICEDATE = preg_replace('/\s+/', ' ', $data[30]);
					$YEAR = preg_replace('/\s+/', ' ', substr($INVOICEDATE, 0, 4));
					if ($YEAR >= 2000) { $INVOICEDATE = preg_replace('/\s+/', ' ', $data[30]); }
					else { $INVOICEDATE = substr($INVOICEDATE, 4, 4) . substr($INVOICEDATE, 0, 2) . substr($INVOICEDATE, 2, 2); }
					$GROSS = preg_replace('/\s+/', ' ', $data[31]);
					$NET = preg_replace('/\s+/', ' ', $data[32]);
					// CHECKER
					$sqlchecker = "SELECT id, DBNO FROM sales WHERE TRIM(DBNO) = '$DBNO' AND ORDERNO = '$ORDERNO' AND ITEMNO = '$ITEMNO' AND QTYORDERED = '$QTYORDERED'";
					$stmchecker = $con->prepare($sqlchecker);
					$stmchecker->execute();
					if ($stmchecker->rowCount() > 0) { $DBNO = "DUPLI" . $DBNO; }
					$values .= "('$DBNO','$SALESMAN','$DSM','$BRANCH','$OT','$ORDERNO','$SEQUENCENO','$ITEMNO','$LOCATION','$QTYORDERED','$QTYTOSHIP','$UNITPRICE','$REQUESTDATE','$QBO','$QRTS','$UOM','$UNITCOST','$TQO','$TQS','$PRICEORIG','$LPD','$IPC','$UF1','$UF2','$UF3','$UF4','$UF5','$CUSTOMER','$PROVINCIAL','$INVOICENO','$INVOICEDATE','$GROSS','$NET'),";
					$runner++;
				}
				$values = rtrim($values, ", ");
				$sqlinsert = "INSERT INTO sales (DBNO,SALESMAN,DSM,BRANCH,OT,ORDERNO,SEQUENCENO,ITEMNO,LOC,QTYORDERED,QTYTOSHIP,UNITPRICE,REQUESTDATE,QBO,QRTS,UOM,UNITCOST,TQO,TQS,PRICEORIG,LPD,IPC,UF1,UF2,UF3,UF4,UF5,CUSTOMER,PROVINCIAL,INVOICENO,INVOICEDATE,GROSS,NET) VALUES " . $values;
				// echo "$sqlinsert";
				$stminsert = $con->prepare($sqlinsert);
				$stminsert->execute();
				// DUPLICATE CHECKER
				$sqldupchecker = "SELECT DBNO FROM `sales` WHERE DBNO LIKE '%DUPLI%' ";
				$stmdupchecker = $con->prepare($sqldupchecker);
				$stmdupchecker->execute();
				$duplicounter = $stmdupchecker->rowCount();
				echo "$duplicounter duplicate entry. \n";
				echo "$runner(s) records inserted";
				// DELETE DUPLICATE
				$sqldupdelete = "DELETE FROM `sales` WHERE DBNO LIKE '%DUPLI%' ";
				$stmdupdelete = $con->prepare($sqldupdelete);
				$stmdupdelete->execute();
			}
			// ARCUS TO CUS INFO
			elseif (strpos($rawdata, 'arcustocus') !== false) {
				set_time_limit(3600);
				$sql = "SELECT dbno, Cus_No, Cus_Name, Addr_1, Contact, Cr_Lmt, Cus_Type_Cd FROM arcusfil_sql";
				$stm = $con->prepare($sql);
				$stm->execute();
				$results = $stm->fetchAll(PDO::FETCH_ASSOC);
				if ($stm->rowCount() >= 1) {
					$runner = 0;
					$values = '';
					foreach ($results as $row) {
						$dbno = str_replace(' ', '', $row['dbno']);
						$Cus_No = $row['Cus_No'];
						$Cus_Name = $row['Cus_Name'];
						$Addr_1 = $row['Addr_1'];
						$Contact = $row['Contact'];
						$Cr_Lmt = $row['Cr_Lmt'];
						$Cus_Type_Cd = $row['Cus_Type_Cd'];
						// CHECKER
						$sqlchecker = "SELECT id, DBNO FROM v_customer_info WHERE TRIM(DBNO) = '$dbno' AND CUS_NO LIKE '%$Cus_No%'";
						$stmchecker = $con->prepare($sqlchecker);
						$stmchecker->execute();
						if ($stmchecker->rowCount() > 0) { $dbno = "DUPLI" . $dbno; }
						$values .= "('$dbno','$Cus_No','$Cus_Name','$Addr_1','$Contact','$Cr_Lmt', '$Cus_Type_Cd'),";
						$runner++;
					}
					$values = rtrim($values, ", ");
					$sqlinsert = "INSERT INTO v_customer_info (DBNO,CUS_NO ,CUSTOMER,ADDRESS,CONTACT_PERSON,CREDIT_LIMIT,ctype) VALUES " . $values;
					// echo "$sqlinsert";
					$stminsert = $con->prepare($sqlinsert);
					$stminsert->execute();
					// DUPLICATE CHECKER
					$sqldupchecker = "SELECT DBNO FROM `v_customer_info` WHERE DBNO LIKE '%DUPLI%' ";
					$stmdupchecker = $con->prepare($sqldupchecker);
					$stmdupchecker->execute();
					$duplicounter = $stmdupchecker->rowCount();
					echo "$duplicounter duplicate entry. \n";
					echo "$runner(s) records inserted";
					// DELETE DUPLICATE
					$sqldupdelete = "DELETE FROM `v_customer_info` WHERE DBNO LIKE '%DUPLI%' ";
					$stmdupdelete = $con->prepare($sqldupdelete);
					$stmdupdelete->execute();
				}
			}
			// OEHDR
			elseif (strpos($rawdata, 'oehdrcsi') !== false) {
				$rowdata = explode('oehdrcsi', $rawdata);
				$autodivide = substr_count($rawdata, "oehdrcsi");
				$runner = 0;
				$values = '';
				while ($runner < $autodivide) {
					$datarunner = $runner + 1;
					$data = explode(',', $rowdata[$datarunner]);
					$DATABASE_NO = str_replace(' ', '', $data[0]);
					$ORDER_TYPE = str_replace(' ', '', $data[1]);
					$ORDER_NO = str_replace(' ', '', $data[2]);
					$ORDER_DATE_ENTERED = str_replace(' ', '', $data[3]);
					$ORDER_DATE = str_replace(' ', '', $data[4]);
					$ORDER_PUR_ORDER_NO = str_replace(' ', '', $data[5]);
					$ORDER_CUSTOMER_NO = str_replace(' ', '', $data[6]);
					$SHIPPING_DATE = str_replace(' ', '', $data[7]);
					$SALESMAN_NO_1 = str_replace(' ', '', $data[8]);
					$MFGING_LOCATION = str_replace(' ', '', $data[9]);
					$S_SONO = str_replace(' ', '', $data[10]);
					$GATEPASS_NO = str_replace(' ', '', $data[11]);
					$STATUS = str_replace(' ', '', $data[12]);
					// CHECKER
					$sqlchecker = "SELECT ID, ORDER_NO, ORDER_DATE, ORDER_CUSTOMER_NO FROM oehdr WHERE DATABASE_NO = '$DATABASE_NO' AND ORDER_NO = '$ORDER_NO' AND ORDER_CUSTOMER_NO = '$ORDER_CUSTOMER_NO'";
					$stmchecker = $con->prepare($sqlchecker);
					$stmchecker->execute();
					if ($stmchecker->rowCount() > 0) { $DATABASE_NO = "D" . $DATABASE_NO; }
					$values .= "('$DATABASE_NO','$ORDER_TYPE','$ORDER_NO','$ORDER_DATE_ENTERED','$ORDER_DATE','$ORDER_PUR_ORDER_NO','$ORDER_CUSTOMER_NO','$SHIPPING_DATE','$SALESMAN_NO_1','$MFGING_LOCATION','$S_SONO','$GATEPASS_NO','$STATUS'),";
					$runner++;
				}
				$values = rtrim($values, ", ");
				$sqlinsert = "INSERT INTO oehdr (DATABASE_NO,ORDER_TYPE,ORDER_NO,ORDER_DATE_ENTERED,ORDER_DATE,ORDER_PUR_ORDER_NO,ORDER_CUSTOMER_NO,SHIPPING_DATE,SALESMAN_NO_1,MFGING_LOCATION,S_SONO,GATEPASS_NO,STATUS) VALUES " . $values;
				//echo $sqlinsert;
				$stminsert = $con->prepare($sqlinsert);
				$stminsert->execute();
				// DUPLICATE CHECKER
				$sqldupchecker = "SELECT DATABASE_NO FROM `oehdr` WHERE DATABASE_NO LIKE '%D%' ";
				$stmdupchecker = $con->prepare($sqldupchecker);
				$stmdupchecker->execute();
				$duplicounter = $stmdupchecker->rowCount();
				echo "$duplicounter duplicate entry. \n";
				//echo date('h:i A') . "\n";
				echo "$runner(s) records inserted";
				// DELETE DUPLICATE
				$sqldupdelete = "DELETE FROM `oehdr` WHERE DATABASE_NO LIKE '%D%' ";
				$stmdupdelete = $con->prepare($sqldupdelete);
				$stmdupdelete->execute();
			}
			else { echo "Error"; }
		}
	}
?>