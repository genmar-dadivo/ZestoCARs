<?php
    require '../dbase/dbconfig.php';
    if (isset($_GET['men'])) {
        $men = $_GET['men'] - 1;
        $sql = "SELECT id, name FROM menu WHERE type = $men ORDER BY name ASC";
        $stm = $con->prepare($sql);
        $stm->execute();
        $results = $stm->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($results);
    }
    else {
        $mentype = $_POST['mentype'];
        if (isset($_POST['mainmenu'])) { 
            $mainmenu = $_POST['mainmenu'];
        }
        else { $mainmenu = 0; }
        $menname = $_POST['menname'];
        $sql = "SELECT TRIM(name) FROM menu WHERE TRIM(name) = '$menname' ";
        $stm = $con->prepare($sql);
        $stm->execute();
        if ($stm->rowCount() == 0) {
            $sqlinsert = "INSERT INTO menu (rootid, name, type, orderid) VALUES ('$mainmenu', '$menname', '$mentype', 0)";
            $stminsert = $con->prepare($sqlinsert);
            $stminsert->execute();
            if ($stminsert->rowCount() == 1) { echo "Menu Inserted."; }
            else { echo "Error Occured."; }
        }
        else { echo "Menu Already Exist."; }
    }
?>