<?php
    require '../dbase/dbconfig.php';
    $sql = "SELECT * FROM pcv";
    $stm = $con->prepare($sql);
    $stm->execute();
    $results = $stm->fetchAll(PDO::FETCH_ASSOC);
    if ($stm->rowCount() >= 1) {
        foreach ($results as $row) {
            $output['data'][] = array(
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
            ""
            );
    }
    echo json_encode($output);
?>