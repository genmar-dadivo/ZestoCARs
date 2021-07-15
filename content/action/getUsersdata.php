<?php
    require '../dbase/dbconfig.php';
    $sql = "SELECT u.*, (SELECT dpt.department FROM department dpt WHERE dpt.id = u.department) AS deptdesc FROM tuser u WHERE u.lvl <> 0";
    $stm = $con->prepare($sql);
    $stm->execute();
    $results = $stm->fetchAll(PDO::FETCH_ASSOC);
    if ($stm->rowCount() >= 1) {
        foreach ($results as $row) {
            $id = $row['id'];
            $eidnum = $row['eidnum'];
            $uname = strtolower($row['uname']);
            $pword = $row['pword'];
            $fname = $row['fname'];
            $email = strtolower($row['email']);
            $department = $row['department'];
            $deptdesc = $row['deptdesc'];
            $lvl = $row['lvl'];
            $output['data'][] = array(
                "",
                "$eidnum",
                "$uname",
                "$fname",
                "$email",
                "$deptdesc",
                "$lvl"
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
            ""
            );
    }
    echo json_encode($output);
?>