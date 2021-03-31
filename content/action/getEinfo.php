<?php
    require '../dbase/dbconfig.php';
    if (isset($_GET['uid'])) {
        $uid = $_GET['uid'];
        $sql = "SELECT * FROM tuser WHERE uname = '$uid' ";
        $stm = $con->prepare($sql);
        $stm->execute();
        $results = $stm->fetchAll(PDO::FETCH_ASSOC);
        if ($stm->rowCount() == 1) {
            foreach ($results as $row) {
                $uname = $row['uname'];
                $fname = ucwords($row['fname']);
                $fnamepieces = explode(" ", $fname);
                $fullname = $fnamepieces[0] . " " . strtoupper(substr($fnamepieces[1], 0, 1)); 
                $email = $row['email'];
                $department = $row['department'];
                $sqldept = "SELECT * FROM department WHERE id = '$department' ";
                $stmdept = $con->prepare($sqldept);
                $stmdept->execute();
                $resultsdept = $stmdept->fetchAll(PDO::FETCH_ASSOC);
                if ($stmdept->rowCount() == 1) {
                    foreach ($resultsdept as $rowdept) { $deptname = $rowdept['department']; }
                }
                echo "$uname, $fullname, $email, $deptname";
            }
        }
        else { echo "Error."; }
    }
    elseif (isset($_GET['euid'])) {
        $euid = $_GET['euid'];
        $sql = "SELECT * FROM edata WHERE idnumber = '$euid' ";
        $stm = $con->prepare($sql);
        $stm->execute();
        if ($stm->rowCount() == 1) {
            $row = $stm->fetch();
            $fname = ucwords($row['fname']); // 0
            $mname = ucwords($row['mname']); // 1
            $lname = ucwords($row['lname']); // 2
            $ns = ucwords($row['ns']); // 3
            $bdate = $row['bdate']; // 4
            $sex = $row['sex']; // 5
            $address = str_replace( ',', '', $row['address']); // 6
            $permanentaddress = str_replace( ',', '', $row['permanentaddress']); // 7
            $phonenumber = $row['phonenumber']; // 8
            $idnumber = $row['idnumber']; // 9
            $company = $row['company']; // 10
            $region = strtoupper($row['region']); // 11
            $department = $row['department']; // 12
            $position = $row['position']; // 13
            if ($row['prevdept'] <> '') { $prevdept = $row['prevdept']; } // 14
            else { $prevdept = 'N/A'; }
            $datehired = $row['datehired']; // 15
            $dateregular = $row['dateregular']; // 16
            $sssno = $row['sssno']; // 17
            $pagibigrtn = $row['pagibigrtn']; // 18
            $pagibigmid = $row['pagibigmid']; // 19
            $tin = $row['tin']; // 20
            $cocolife = $row['cocolife']; // 21
            $ccamount = $row['ccamount']; // 22
            $college = $row['college']; // 23
            $hs = $row['hs']; // 24
            $elem = $row['elem']; // 25
            $workhistory = $row['workhistory']; // 26
            $ephonenumb = $row['ephonenumb']; // 27
            $econtactperson = $row['econtactperson']; // 28
            $econpersonrelation = $row['econpersonrelation']; // 29
            $eaddress = $row['eaddress']; // 30
            echo "$fname,$mname,$lname,$ns,$bdate,$sex,$address,$permanentaddress,$phonenumber,$idnumber,$company,$region,$department,$position,$prevdept,$datehired,$dateregular,$sssno,$pagibigrtn,$pagibigmid,$tin,$cocolife,$ccamount,$college,$hs,$elem,$workhistory,$ephonenumb,$econtactperson,$eaddress";
        }
        else { echo "Error"; }
    }
    elseif (isset($_GET['uid'])) {

    }
?>