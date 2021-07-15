<?php
    require '../dbase/dbconfig.php';
    $sql = "SELECT * FROM level";
    $stm = $con->prepare($sql);
    $stm->execute();
    $results = $stm->fetchAll(PDO::FETCH_ASSOC);
    if ($stm->rowCount() >= 1) {
        foreach ($results as $row) {
            $id = $row['id'];
            $level = $row['level'];
            $name = ucwords(strtolower($row['name']));
            $auth = $row['auth'];
            $output['data'][] = array(
                "",
                "$level",
                "$name",
                "$auth"
            );
        }
    }
    else {
        $output['data'][] = array(
            "",
            "No Data",
            "",
            ""
            );
    }
    echo json_encode($output);
?>