<?php
    require '../dbase/dbconfig.php';
    $sql = "SELECT * FROM groups";
    $stm = $con->prepare($sql);
    $stm->execute();
    $results = $stm->fetchAll(PDO::FETCH_ASSOC);
    if ($stm->rowCount() >= 1) {
        foreach ($results as $row) {
            $id = $row['id'];
            $name = $row['name'];
            $type = $row['type'];
            if ($type == 0) { $type = 'Company'; }
            elseif ($type == 1) { $type = 'Department'; }
            $output['data'][] = array(
                "",
                "$name",
                "$type"
            );
        }
    }
    else {
        $output['data'][] = array(
            "",
            "No Data",
            ""
            );
    }
    echo json_encode($output);
?>