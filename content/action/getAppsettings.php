<?php
	require '../dbase/dbconfig.php';
    $sql = "SELECT * FROM settings LIMIT 1";
    $stm = $con->prepare($sql);
    $stm->execute();
    $row = $stm->fetch();
    $id = $row['id'];
    $webimage = $row['webimage'];
    $webtitle = $row['webtitle'];
    $datemodi = $row['datemodi'];
    echo "$webimage, $webtitle, $datemodi";
?>