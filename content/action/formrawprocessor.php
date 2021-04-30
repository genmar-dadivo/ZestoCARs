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
					// checker
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
			// NOAH OEORDLIN MECHA
			elseif (strpos($rawdata, 'oelinhst') === false AND strpos($rawdata, 'oehdrhst') === false AND strpos($rawdata, 'noahx') !== false) {
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
			// ARCUSFIL
			elseif (strpos($rawdata, 'oelinhst') === false AND strpos($rawdata, 'oehdrhst') === false AND strpos($rawdata, 'arcusfil_sql') !== false) {
				$rowdata = explode('arcusfil_sql', $rawdata);
				$autodivide = substr_count($rawdata, "arcusfil_sql");
				$runner = 0;
				$values = '';
				while ($runner < $autodivide) {
					$datarunner = $runner + 1;
					$data = explode(',', $rowdata[$datarunner]);
					$dbno = str_replace(' ', '', $data[0]);
					$Cus_No = preg_replace('/\s+/', ' ', $data[1]);
					$Slspsn_No = preg_replace('/\s+/', ' ', $data[2]);
					$Cus_Name = preg_replace('/\s+/', ' ', $data[3]);
					$Addr_1 = preg_replace('/\s+/', ' ', $data[4]);
					$Addr_2 = preg_replace('/\s+/', ' ', $data[5]);
					$City = preg_replace('/\s+/', ' ', $data[6]);
					$State = preg_replace('/\s+/', ' ', $data[7]);
					$Zip = preg_replace('/\s+/', ' ', $data[8]);
					$Country = preg_replace('/\s+/', ' ', $data[9]);
					$Contact = preg_replace('/\s+/', ' ', $data[10]);
					$Contact_2 = preg_replace('/\s+/', ' ', $data[11]);
					$Phone_No = preg_replace('/\s+/', ' ', $data[12]);
					$Phone_No_2 = preg_replace('/\s+/', ' ', $data[13]);
					$Phone_Ext = preg_replace('/\s+/', ' ', $data[14]);
					$Phone_Ext_2 = preg_replace('/\s+/', ' ', $data[15]);
					$Fax_No = preg_replace('/\s+/', ' ', $data[16]);
					$Start_Dt = preg_replace('/\s+/', ' ', $data[17]);
					$Cus_Type_Cd = preg_replace('/\s+/', ' ', $data[18]);
					$Bal_Meth = preg_replace('/\s+/', ' ', $data[19]);
					$Stm_Freq = preg_replace('/\s+/', ' ', $data[20]);
					$Cr_Lmt = preg_replace('/\s+/', ' ', $data[21]);
					$Cr_Rating = preg_replace('/\s+/', ' ', $data[22]);
					$Hold_Fg = preg_replace('/\s+/', ' ', $data[23]);
					$Collector = preg_replace('/\s+/', ' ', $data[24]);
					$Fin_Chg_Fg = preg_replace('/\s+/', ' ', $data[25]);
					$Cus_Origin = preg_replace('/\s+/', ' ', $data[26]);
					$Filler_0003 = preg_replace('/\s+/', ' ', $data[27]);
					$Terr = preg_replace('/\s+/', ' ', $data[28]);
					$Curr_Cd = preg_replace('/\s+/', ' ', $data[29]);
					$Par_Cus_No = preg_replace('/\s+/', ' ', $data[30]);
					$Par_Cus_Fg = preg_replace('/\s+/', ' ', $data[31]);
					$Ship_Via_Cd = preg_replace('/\s+/', ' ', $data[32]);
					$Ups_Zone = preg_replace('/\s+/', ' ', $data[33]);
					$Ar_Terms_Cd = preg_replace('/\s+/', ' ', $data[34]);
					$Dsc_Pct = preg_replace('/\s+/', ' ', $data[35]);
					$Ytd_Dsc_Given = preg_replace('/\s+/', ' ', $data[36]);
					$Txbl_Fg = preg_replace('/\s+/', ' ', $data[37]);
					$Tax_Cd = preg_replace('/\s+/', ' ', $data[38]);
					$Tax_Cd_2 = preg_replace('/\s+/', ' ', $data[39]);
					$Tax_Cd_3 = preg_replace('/\s+/', ' ', $data[40]);
					$Exempt_No = preg_replace('/\s+/', ' ', $data[41]);
					$Sls_Ptd = preg_replace('/\s+/', ' ', $data[42]);
					$Sls_Ytd = preg_replace('/\s+/', ' ', $data[43]);
					$Sls_Last_Yr = preg_replace('/\s+/', ' ', $data[44]);
					$Cost_Ptd = preg_replace('/\s+/', ' ', $data[45]);
					$Cost_Ytd = preg_replace('/\s+/', ' ', $data[46]);
					$Cost_Last_Yr = preg_replace('/\s+/', ' ', $data[47]);
					$Balance = preg_replace('/\s+/', ' ', $data[48]);
					$High_Balance = preg_replace('/\s+/', ' ', $data[49]);
					$Last_Sale_Dt = preg_replace('/\s+/', ' ', $data[50]);
					$Last_Sale_Amt = preg_replace('/\s+/', ' ', $data[51]);
					$Inv_Ytd = preg_replace('/\s+/', ' ', $data[52]);
					$Inv_Last_Yr = preg_replace('/\s+/', ' ', $data[53]);
					$Paid_Inv_Ytd = preg_replace('/\s+/', ' ', $data[54]);
					$Last_Pay_Dt = preg_replace('/\s+/', ' ', $data[55]);
					$Last_Pay_Amt = preg_replace('/\s+/', ' ', $data[56]);
					$Avg_Pay_Ytd = preg_replace('/\s+/', ' ', $data[57]);
					$Avg_Pay_Last_Yr = preg_replace('/\s+/', ' ', $data[58]);
					$Last_Stm_Age_Dt = preg_replace('/\s+/', ' ', $data[59]);
					$Amt_Age_Prd_1 = preg_replace('/\s+/', ' ', $data[60]);
					$Amt_Age_Prd_2 = preg_replace('/\s+/', ' ', $data[61]);
					$Amt_Age_Prd_3 = preg_replace('/\s+/', ' ', $data[62]);
					$Amt_Age_Prd_4 = preg_replace('/\s+/', ' ', $data[63]);
					$Allow_Sb_Item = preg_replace('/\s+/', ' ', $data[64]);
					$Allow_Bo = preg_replace('/\s+/', ' ', $data[65]);
					$Allow_Part_Ship = preg_replace('/\s+/', ' ', $data[66]);
					$Print_Dunn_Fg = preg_replace('/\s+/', ' ', $data[67]);
					$Cmt_1 = preg_replace('/\s+/', ' ', $data[68]);
					$Cmt_2 = preg_replace('/\s+/', ' ', $data[69]);
					$Vend_No = preg_replace('/\s+/', ' ', $data[70]);
					$Tax_Sched = preg_replace('/\s+/', ' ', $data[71]);
					$Cr_Card_1_Desc = preg_replace('/\s+/', ' ', $data[72]);
					$Cr_Card_1_Acct = preg_replace('/\s+/', ' ', $data[73]);
					$Cr_Card_1_Exp_Dt = preg_replace('/\s+/', ' ', $data[74]);
					$Cr_Card_2_Desc = preg_replace('/\s+/', ' ', $data[75]);
					$Cr_Card_2_Acct = preg_replace('/\s+/', ' ', $data[76]);
					$Cr_Card_2_Exp_Dt = preg_replace('/\s+/', ' ', $data[77]);
					$User_Def_Fld_1 = preg_replace('/\s+/', ' ', $data[78]);
					$User_Def_Fld_2 = preg_replace('/\s+/', ' ', $data[79]);
					$User_Def_Fld_3 = preg_replace('/\s+/', ' ', $data[80]);
					$User_Def_Fld_4 = preg_replace('/\s+/', ' ', $data[81]);
					$User_Def_Fld_5 = preg_replace('/\s+/', ' ', $data[82]);
					$Dflt_Inv_Form = preg_replace('/\s+/', ' ', $data[83]);
					$Loc = preg_replace('/\s+/', ' ', $data[84]);
					$Note_1 = preg_replace('/\s+/', ' ', $data[85]);
					$Note_2 = preg_replace('/\s+/', ' ', $data[86]);
					$Note_3 = preg_replace('/\s+/', ' ', $data[87]);
					$Note_4 = preg_replace('/\s+/', ' ', $data[88]);
					$Note_5 = preg_replace('/\s+/', ' ', $data[89]);
					$User_Dt = preg_replace('/\s+/', ' ', $data[90]);
					$User_Amount = preg_replace('/\s+/', ' ', $data[91]);
					$Amt_Age_Oe_Term = preg_replace('/\s+/', ' ', $data[92]);
					$Cus_Alt_Adr_Cd = preg_replace('/\s+/', ' ', $data[93]);
					$Rfc_No = preg_replace('/\s+/', ' ', $data[94]);
					$Email_Addr = preg_replace('/\s+/', ' ', $data[95]);
					// checker
					$sqlchecker = "SELECT id, DBNO FROM arcusfil_sql WHERE dbno = '$dbno' AND Cus_No = '$Cus_No'";
					$stmchecker = $con->prepare($sqlchecker);
					$stmchecker->execute();
					if ($stmchecker->rowCount() > 0) { $dbno = "DUPLI" . $dbno; }
					$values .= "('$dbno','$Cus_No','$Slspsn_No','$Cus_Name','$Addr_1','$Addr_2','$City','$State','$Zip','$Country','$Contact','$Contact_2','$Phone_No','$Phone_No_2','$Phone_Ext','$Phone_Ext_2','$Fax_No','$Start_Dt','$Cus_Type_Cd','$Bal_Meth','$Stm_Freq','$Cr_Lmt','$Cr_Rating','$Hold_Fg','$Collector','$Fin_Chg_Fg','$Cus_Origin','$Filler_0003','$Terr','$Curr_Cd','$Par_Cus_No','$Par_Cus_Fg','$Ship_Via_Cd','$Ups_Zone','$Ar_Terms_Cd','$Dsc_Pct','$Ytd_Dsc_Given','$Txbl_Fg','$Tax_Cd','$Tax_Cd_2','$Tax_Cd_3','$Exempt_No','$Sls_Ptd','$Sls_Ytd','$Sls_Last_Yr','$Cost_Ptd','$Cost_Ytd','$Cost_Last_Yr','$Balance','$High_Balance','$Last_Sale_Dt','$Last_Sale_Amt','$Inv_Ytd','$Inv_Last_Yr','$Paid_Inv_Ytd','$Last_Pay_Dt','$Last_Pay_Amt','$Avg_Pay_Ytd','$Avg_Pay_Last_Yr','$Last_Stm_Age_Dt','$Amt_Age_Prd_1','$Amt_Age_Prd_2','$Amt_Age_Prd_3','$Amt_Age_Prd_4','$Allow_Sb_Item','$Allow_Bo','$Allow_Part_Ship','$Print_Dunn_Fg','$Cmt_1','$Cmt_2','$Vend_No','$Tax_Sched','$Cr_Card_1_Desc','$Cr_Card_1_Acct','$Cr_Card_1_Exp_Dt','$Cr_Card_2_Desc','$Cr_Card_2_Acct','$Cr_Card_2_Exp_Dt','$User_Def_Fld_1','$User_Def_Fld_2','$User_Def_Fld_3','$User_Def_Fld_4','$User_Def_Fld_5','$Dflt_Inv_Form','$Loc','$Note_1','$Note_2','$Note_3','$Note_4','$Note_5','$User_Dt','$User_Amount','$Amt_Age_Oe_Term','$Cus_Alt_Adr_Cd','$Rfc_No','$Email_Addr'),";
					$runner++;
				}
				$values = rtrim($values, ", ");
				$sqlinsert = "INSERT INTO arcusfil_sql (dbno, Cus_No, Slspsn_No, Cus_Name, Addr_1, Addr_2, City, States, Zip, Country, Contact, Contact_2, Phone_No, Phone_No_2, Phone_Ext, Phone_Ext_2, Fax_No, Start_Dt, Cus_Type_Cd, Bal_Meth, Stm_Freq, Cr_Lmt, Cr_Rating, Hold_Fg, Collector, Fin_Chg_Fg, Cus_Origin, Filler_0003, Terr, Curr_Cd, Par_Cus_No, Par_Cus_Fg, Ship_Via_Cd, Ups_Zone, Ar_Terms_Cd, Dsc_Pct, Ytd_Dsc_Given, Txbl_Fg, Tax_Cd, Tax_Cd_2, Tax_Cd_3, Exempt_No, Sls_Ptd, Sls_Ytd, Sls_Last_Yr, Cost_Ptd, Cost_Ytd, Cost_Last_Yr, Balance, High_Balance, Last_Sale_Dt, Last_Sale_Amt, Inv_Ytd, Inv_Last_Yr, Paid_Inv_Ytd, Last_Pay_Dt, Last_Pay_Amt, Avg_Pay_Ytd, Avg_Pay_Last_Yr, Last_Stm_Age_Dt, Amt_Age_Prd_1, Amt_Age_Prd_2, Amt_Age_Prd_3, Amt_Age_Prd_4, Allow_Sb_Item, Allow_Bo, Allow_Part_Ship, Print_Dunn_Fg, Cmt_1, Cmt_2, Vend_No, Tax_Sched, Cr_Card_1_Desc, Cr_Card_1_Acct, Cr_Card_1_Exp_Dt, Cr_Card_2_Desc, Cr_Card_2_Acct, Cr_Card_2_Exp_Dt, User_Def_Fld_1, User_Def_Fld_2, User_Def_Fld_3, User_Def_Fld_4, User_Def_Fld_5, Dflt_Inv_Form, Loc, Note_1, Note_2, Note_3, Note_4, Note_5, User_Dt, User_Amount, Amt_Age_Oe_Term, Cus_Alt_Adr_Cd, Rfc_No, Email_Addr) VALUES " . $values;
				//echo $sqlinsert;
				$stminsert = $con->prepare($sqlinsert);
				$stminsert->execute();
				// duplicate checker
				$sqldupchecker = "SELECT dbno FROM `arcusfil_sql` WHERE dbno LIKE '%DUPLI%' ";
				$stmdupchecker = $con->prepare($sqldupchecker);
				$stmdupchecker->execute();
				$duplicounter = $stmdupchecker->rowCount();
				echo "$duplicounter duplicate entry. \n";
				// echo date('h:i A') . "\n";
				echo "$runner(s) records inserted";
				// delete duplicate
				$sqldupdelete = "DELETE FROM `arcusfil_sql` WHERE dbno LIKE '%DUPLI%' ";
				$stmdupdelete = $con->prepare($sqldupdelete);
				$stmdupdelete->execute();
			}
			else { echo "Error"; }
		}
	}
?>