<?php
    date_default_timezone_set("Asia/Manila");
    require '../dbase/dbconfig.php';
    $datesent = date('Y-m-d H:i:s');
    $uid = $_POST['uid'];
    $startdate = $_POST['startdate'];
    // Dept mecha
    $sql = "SELECT department FROM tuser WHERE uname = '$uid'";
    $stm = $con->prepare($sql);
    $stm->execute();
    $rowdept = $stm->fetch();
    if ($stm->rowCount() == 1) { $dept = $rowdept['department']; }
    else { $dept = ''; }
    $title = $_POST['title'];
    $color = "#039BE5";
    $stime = $startdate . " " . $_POST['stime'];
    if (!isset($_POST['wholeday'])) { $color = '#000'; $etime = $startdate . " " . $_POST['etime']; }
    else { $color = '#000'; $etime = ''; }
    $description = $_POST['description'];
    // Status mecha 0 = NA 1 = A
    $status = 1;
    $sqlsched = "INSERT INTO schedule (title, color, status, requestby, dept, starttime, endtime, datesent, description) VALUES ('$title', '$color', '$status', '$uid', '$dept', '$stime', '$etime', '$datesent', '$description')";
    $stmsched = $con->prepare($sqlsched);
    $stmsched->execute();
    if ($stmsched->rowCount() == 1) { echo "Schedule Inserted. \n"; }
    else { echo "Error Occured."; }
?>