<?php
	date_default_timezone_set("Asia/Manila");
	$Ynow = date('Y');
    $MDnow = date('md');
    $time = time();
    // additional settings
	// $start = 20200400;
	// $end = $start + 99;
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
		else {
			// cleaners
			$rawdata = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $_POST['rawdata']);
			$rawdata = str_replace(["'","UPDATE","OR ","INSERT","INTO","VALUES", "MATCHING","DATABASE_NO,ORDER_NO,SEQUENCE_NO","DATABASE_NO, OE_NO, CUSTOMER_NO","(", ")", ";", "/"], "",$rawdata);
			$rawdata = preg_replace('/\\\\/', '', $rawdata);
			$rawdata = strtolower($rawdata);
		
			// line oelinhst mecha
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
					// checker
					$sqlchecker = "SELECT ID, ORDER_NO, ITEM_NO FROM oelinhst WHERE DATABASE_NO = $DATABASE_NO AND ORDER_NO = '$ORDER_NO' AND ITEM_NO = '$ITEM_NO' AND UNIT_PRICE = '$UNIT_PRICE' AND INVOICE_DATE BETWEEN $start AND $end";
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
				// duplicate checker
				$sqldupchecker = "SELECT DATABASE_NO FROM `oelinhst` WHERE DATABASE_NO LIKE '%D%' ";
				$stmdupchecker = $con->prepare($sqldupchecker);
				$stmdupchecker->execute();
				$duplicounter = $stmdupchecker->rowCount();
				echo "$duplicounter duplicate entry. \n";
				//echo date('h:i A') . "\n";
				echo "$runner(s) records inserted";
				// delete duplicate
				$sqldupdelete = "DELETE FROM `oelinhst` WHERE DATABASE_NO LIKE '%D%' ";
				$stmdupdelete = $con->prepare($sqldupdelete);
				$stmdupdelete->execute();
			}
			// head oehdrhst mecha
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
					// checker
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
				// duplicate checker
				$sqldupchecker = "SELECT DATABASE_NO FROM `oehdrhst` WHERE DATABASE_NO LIKE '%D%' ";
				$stmdupchecker = $con->prepare($sqldupchecker);
				$stmdupchecker->execute();
				$duplicounter = $stmdupchecker->rowCount();
				echo "$duplicounter duplicate entry. \n";
				//echo date('h:i A') . "\n";
				echo "$runner(s) records inserted.";
				// delete duplicate
				$sqldupdelete = "DELETE FROM `oehdrhst` WHERE DATABASE_NO LIKE '%D%' ";
				$stmdupdelete = $con->prepare($sqldupdelete);
				$stmdupdelete->execute();
			}
			// item mecha
			elseif (strpos($rawdata, 'oelinhst') === false AND strpos($rawdata, 'oehdrhst') === false AND strpos($rawdata, 'product') !== false) {
				$rowdata = explode('product', $rawdata);
				$autodivide = substr_count($rawdata, "product");
				$runner = 0;
				while ($runner < $autodivide) {
					$datarunner = $runner + 1;
					$data = explode(',', $rowdata[$datarunner]);
					$CATEGORY = $data[0];
					$SKU = $data[1];
					$ITEM_NO = $data[2];
					// checker
					$sqlchecker = "SELECT ITEM_NO FROM product WHERE ITEM_NO = '$ITEM_NO' ";
					$stmchecker = $con->prepare($sqlchecker);
					$stmchecker->execute();
					if ($stmchecker->rowCount() > 0) { $ITEM_NO = "D" . $ITEM_NO; }
					$sqlinsert = "INSERT INTO product (CATEGORY, SKU, ITEM_NO) VALUES ('$CATEGORY', '$SKU', '$ITEM_NO')";
					$stminsert = $con->prepare($sqlinsert);
					$stminsert->execute();
					$runner++;
				}
				// duplicate checker
				$sqldupchecker = "SELECT ITEM_NO FROM `product` WHERE ITEM_NO LIKE '%D%' ";
				$stmdupchecker = $con->prepare($sqldupchecker);
				$stmdupchecker->execute();
				$duplicounter = $stmdupchecker->rowCount();
				echo "$duplicounter duplicate entry. \n";
				echo date('h:i A') . "\n";
				echo "$runner(s) records inserted.";
				// delete duplicate
				$sqldupdelete = "DELETE FROM `product` WHERE ITEM_NO LIKE '%D%' ";
				$stmdupdelete = $con->prepare($sqldupdelete);
				$stmdupdelete->execute();
			}
			// customer mecha
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
				// duplicate checker
				$sqldupchecker = "SELECT DBNO FROM `v_customer_info` WHERE DBNO LIKE '%D%' ";
				$stmdupchecker = $con->prepare($sqldupchecker);
				$stmdupchecker->execute();
				$duplicounter = $stmdupchecker->rowCount();
				echo "$duplicounter duplicate entry. \n";
				echo date('h:i A') . "\n";
				echo "$runner(s) records inserted";
				// delete duplicate
				$sqldupdelete = "DELETE FROM `v_customer_info` WHERE DBNO LIKE '%D%' ";
				$stmdupdelete = $con->prepare($sqldupdelete);
				$stmdupdelete->execute();
			}
			// head oeorhdr mecha
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
					// checker
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
				// duplicate checker
				$sqldupchecker = "SELECT DB_NO FROM `OEORDHDR` WHERE DB_NO LIKE '%D%' ";
				$stmdupchecker = $con->prepare($sqldupchecker);
				$stmdupchecker->execute();
				$duplicounter = $stmdupchecker->rowCount();
				echo "$duplicounter duplicate entry. \n";
				// echo date('h:i A') . "\n";
				echo "$runner(s) records inserted";
				// delete duplicate
				$sqldupdelete = "DELETE FROM `OEORDHDR` WHERE DB_NO LIKE '%D%' ";
				$stmdupdelete = $con->prepare($sqldupdelete);
				$stmdupdelete->execute();
			}
			// line oeordlin mecha
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
					// checker
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
				// duplicate checker
				$sqldupchecker = "SELECT DB_NO FROM `oeordlin` WHERE DB_NO LIKE '%D%' ";
				$stmdupchecker = $con->prepare($sqldupchecker);
				$stmdupchecker->execute();
				$duplicounter = $stmdupchecker->rowCount();
				echo "$duplicounter duplicate entry. \n";
				// echo date('h:i A') . "\n";
				echo "$runner(s) records inserted";
				// delete duplicate
				$sqldupdelete = "DELETE FROM `oeordlin` WHERE DB_NO LIKE '%D%' ";
				$stmdupdelete = $con->prepare($sqldupdelete);
				$stmdupdelete->execute();
			}
			// noah oeordlin mecha
			elseif (strpos($rawdata, 'oelinhst') === false AND strpos($rawdata, 'oehdrhst') === false AND strpos($rawdata, 'noahs') !== false) {
				$rowdata = explode('noahs', $rawdata);
				$autodivide = substr_count($rawdata, "noahs");
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
				// duplicate checker
				$sqldupchecker = "SELECT DBNO FROM `noah_oelinhst` WHERE DBNO LIKE '%DUPLI%' ";
				$stmdupchecker = $con->prepare($sqldupchecker);
				$stmdupchecker->execute();
				$duplicounter = $stmdupchecker->rowCount();
				echo "$duplicounter duplicate entry. \n";
				// echo date('h:i A') . "\n";
				echo "$runner(s) records inserted";
				// delete duplicate
				// $sqldupdelete = "DELETE FROM `noah_oelinhst` WHERE DBNO LIKE '%DUPLI%' ";
				// $stmdupdelete = $con->prepare($sqldupdelete);
				// $stmdupdelete->execute();
			}
			// SO
			elseif (strpos($rawdata, 'oelinhst') === false AND strpos($rawdata, 'oehdrhst') === false AND strpos($rawdata, 'salesorderz') !== false) {
				$rowdata = explode('salesorderz', $rawdata);
				$autodivide = substr_count($rawdata, "salesorderz");
				$runner = 0;
				$values = '';

			}
			else { echo "Error"; }
		}
	}
?>