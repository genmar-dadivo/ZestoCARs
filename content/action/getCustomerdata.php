<?php
    require '../dbase/dbconfig.php';
    $sql = "SELECT * FROM arcusfil_sql LIMIT 44900";
    $stm = $con->prepare($sql);
    $stm->execute();
    $results = $stm->fetchAll(PDO::FETCH_ASSOC);
    if ($stm->rowCount() >= 1) {
        foreach ($results as $row) {
            $id = $row['id'];
            $dbno = $row['dbno'];
            $Cus_No = $row['Cus_No'];
            $Slspsn_No = strtoupper($row['Slspsn_No']);
            $Cus_Name = ucwords($row['Cus_Name']);
            $Addr_1 = ucwords($row['Addr_1']);
            $Addr_2 = ucwords($row['Addr_2']);
            $City = ucwords($row['City']);
            $States = strtoupper($row['States']);
            $Zip = strtoupper($row['Zip']);
            $Country = strtoupper($row['Country']);
            $Contact = ucwords($row['Contact']);
            $Contact_2 = ucwords($row['Contact_2']);
            $Phone_No = $row['Phone_No'];
            $Phone_No_2 = $row['Phone_No_2'];
            $Phone_Ext = strtoupper($row['Phone_Ext']);
            $Phone_Ext_2 = strtoupper($row['Phone_Ext_2']);
            $Fax_No = $row['Fax_No'];
            $Start_Dt = $row['Start_Dt'];
            $Cus_Type_Cd = strtoupper($row['Cus_Type_Cd']);
            $Bal_Meth = strtoupper($row['Bal_Meth']);
            $Stm_Freq = strtoupper($row['Stm_Freq']);
            $Cr_Lmt = $row['Cr_Lmt'];
            $Cr_Rating = $row['Cr_Rating'];
            $Hold_Fg = strtoupper($row['Hold_Fg']);
            $Collector = strtoupper($row['Collector']);
            $Fin_Chg_Fg = strtoupper($row['Fin_Chg_Fg']);
            $Cus_Origin = $row['Cus_Origin'];
            $Filler_0003 = $row['Filler_0003'];
            $Terr = strtoupper($row['Terr']);
            $Curr_Cd = $row['Curr_Cd'];
            $Par_Cus_No = $row['Par_Cus_No'];
            $Par_Cus_Fg = strtoupper($row['Par_Cus_Fg']);
            $Ship_Via_Cd = strtoupper($row['Ship_Via_Cd']);
            $Ups_Zone = $row['Ups_Zone'];
            $Ar_Terms_Cd = strtoupper($row['Ar_Terms_Cd']);
            $Dsc_Pct = $row['Dsc_Pct'];
            $Ytd_Dsc_Given = $row['Ytd_Dsc_Given'];
            $Txbl_Fg = $row['Txbl_Fg'];
            $Tax_Cd = strtoupper($row['Tax_Cd']);
            $Tax_Cd_2 = strtoupper($row['Tax_Cd_2']);
            $Tax_Cd_3 = strtoupper($row['Tax_Cd_3']);
            $Exempt_No = $row['Exempt_No'];
            $Sls_Ptd = $row['Sls_Ptd'];
            $Sls_Ytd = $row['Sls_Ytd'];
            $Sls_Last_Yr = $row['Sls_Last_Yr'];
            $Cost_Ptd = $row['Cost_Ptd'];
            $Cost_Ytd = $row['Cost_Ytd'];
            $Cost_Last_Yr = $row['Cost_Last_Yr'];
            $Balance = $row['Balance'];
            $High_Balance = $row['High_Balance'];
            $Last_Sale_Dt = $row['Last_Sale_Dt'];
            $Last_Sale_Amt = $row['Last_Sale_Amt'];
            $Inv_Ytd = $row['Inv_Ytd'];
            $Inv_Last_Yr = $row['Inv_Last_Yr'];
            $Paid_Inv_Ytd = $row['Paid_Inv_Ytd'];
            $Last_Pay_Dt = $row['Last_Pay_Dt'];
            $Last_Pay_Amt = $row['Last_Pay_Amt'];
            $Avg_Pay_Ytd = $row['Avg_Pay_Ytd'];
            $Avg_Pay_Last_Yr = $row['Avg_Pay_Last_Yr'];
            $Last_Stm_Age_Dt = $row['Last_Stm_Age_Dt'];
            $Amt_Age_Prd_1 = $row['Amt_Age_Prd_1'];
            $Amt_Age_Prd_2 = $row['Amt_Age_Prd_2'];
            $Amt_Age_Prd_3 = $row['Amt_Age_Prd_3'];
            $Amt_Age_Prd_4 = $row['Amt_Age_Prd_4'];
            $Allow_Sb_Item = strtoupper($row['Allow_Sb_Item']);
            $Allow_Bo = strtoupper($row['Allow_Bo']);
            $Allow_Part_Ship = strtoupper($row['Allow_Part_Ship']);
            $Print_Dunn_Fg = strtoupper($row['Print_Dunn_Fg']);
            $Cmt_1 = ucwords($row['Cmt_1']);
            $Cmt_2 = ucwords($row['Cmt_2']);
            $Vend_No = $row['Vend_No'];
            $Tax_Sched = $row['Tax_Sched'];
            $Cr_Card_1_Desc = ucwords($row['Cr_Card_1_Desc']);
            $Cr_Card_1_Acct = ucwords($row['Cr_Card_1_Acct']);
            $Cr_Card_1_Exp_Dt = ucwords($row['Cr_Card_1_Exp_Dt']);
            $Cr_Card_2_Desc = ucwords($row['Cr_Card_2_Desc']);
            $Cr_Card_2_Acct = ucwords($row['Cr_Card_2_Acct']);
            $Cr_Card_2_Exp_Dt = ucwords($row['Cr_Card_2_Exp_Dt']);
            $User_Def_Fld_1 = ucwords($row['User_Def_Fld_1']);
            $User_Def_Fld_2 = ucwords($row['User_Def_Fld_2']);
            $User_Def_Fld_3 = ucwords($row['User_Def_Fld_3']);
            $User_Def_Fld_4 = ucwords($row['User_Def_Fld_4']);
            $User_Def_Fld_5 = ucwords($row['User_Def_Fld_5']);
            $Dflt_Inv_Form = $row['Dflt_Inv_Form'];
            $Loc = strtoupper($row['Loc']);
            $Note_1 = ucwords($row['Note_1']);
            $Note_2 = ucwords($row['Note_2']);
            $Note_3 = ucwords($row['Note_3']);
            $Note_4 = ucwords($row['Note_4']);
            $Note_5 = ucwords($row['Note_5']);
            $User_Dt = $row['User_Dt'];
            $User_Amount = $row['User_Amount'];
            $Amt_Age_Oe_Term = strtoupper($row['Amt_Age_Oe_Term']);
            $Cus_Alt_Adr_Cd = strtoupper($row['Cus_Alt_Adr_Cd']);
            $Rfc_No = $row['Rfc_No'];
            $Email_Addr = strtolower($row['Email_Addr']);
            $output['data'][] = array(
                "",
                "$dbno",
                "$Cus_No",
                "$Slspsn_No",
                "$Cus_Name",
                "$Addr_1",
                "$Addr_2",
                "$City",
                "$States",
                "$Zip",
                "$Country",
                "$Contact",
                "$Contact_2",
                "$Phone_No",
                "$Phone_No_2",
                "$Phone_Ext",
                "$Phone_Ext_2",
                "$Fax_No",
                "$Start_Dt",
                "$Cus_Type_Cd",
                "$Bal_Meth",
                "$Stm_Freq",
                "$Cr_Lmt",
                "$Cr_Rating",
                "$Hold_Fg",
                "$Collector",
                "$Fin_Chg_Fg",
                "$Cus_Origin",
                "$Filler_0003",
                "$Terr",
                "$Curr_Cd",
                "$Par_Cus_No",
                "$Par_Cus_Fg",
                "$Ship_Via_Cd",
                "$Ups_Zone",
                "$Ar_Terms_Cd",
                "$Dsc_Pct",
                "$Ytd_Dsc_Given",
                "$Txbl_Fg",
                "$Tax_Cd",
                "$Tax_Cd_2",
                "$Tax_Cd_3",
                "$Exempt_No",
                "$Sls_Ptd",
                "$Sls_Ytd",
                "$Sls_Last_Yr",
                "$Cost_Ptd",
                "$Cost_Ytd",
                "$Cost_Last_Yr",
                "$Balance",
                "$High_Balance",
                "$Last_Sale_Dt",
                "$Last_Sale_Amt",
                "$Inv_Ytd",
                "$Inv_Last_Yr",
                "$Paid_Inv_Ytd",
                "$Last_Pay_Dt",
                "$Last_Pay_Amt",
                "$Avg_Pay_Ytd",
                "$Avg_Pay_Last_Yr",
                "$Last_Stm_Age_Dt",
                "$Amt_Age_Prd_1",
                "$Amt_Age_Prd_2",
                "$Amt_Age_Prd_3",
                "$Amt_Age_Prd_4",
                "$Allow_Sb_Item",
                "$Allow_Bo",
                "$Allow_Part_Ship",
                "$Print_Dunn_Fg",
                "$Cmt_1",
                "$Cmt_2",
                "$Vend_No",
                "$Tax_Sched",
                "$Cr_Card_1_Desc",
                "$Cr_Card_1_Acct",
                "$Cr_Card_1_Exp_Dt",
                "$Cr_Card_2_Desc",
                "$Cr_Card_2_Acct",
                "$Cr_Card_2_Exp_Dt",
                "$User_Def_Fld_1",
                "$User_Def_Fld_2",
                "$User_Def_Fld_3",
                "$User_Def_Fld_4",
                "$User_Def_Fld_5",
                "$Dflt_Inv_Form",
                "$Loc",
                "$Note_1",
                "$Note_2",
                "$Note_3",
                "$Note_4",
                "$Note_5",
                "$User_Dt",
                "$User_Amount",
                "$Amt_Age_Oe_Term",
                "$Cus_Alt_Adr_Cd",
                "$Rfc_No",
                "$Email_Addr"
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