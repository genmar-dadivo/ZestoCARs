<?php
    date_default_timezone_set("Asia/Manila");
    $datetimemodi = date('Y-m-d h:s:i');
    require '../dbase/dbconfig.php';
    $sql = "SELECT * FROM settings LIMIT 1";
    $stm = $con->prepare($sql);
    $stm->execute();
    $row = $stm->fetch();
    $webimagedb = $row['webimage'];
    $target_dir = "../../assets/img/";
    $target_filedb = $target_dir . $webimagedb;
    $webname = $_POST['webname'];
    $sql = "UPDATE settings SET webtitle = '$webname', datemodi = '$datetimemodi' WHERE id = 1";
    $stm = $con->prepare($sql);
    $stm->execute();
    if ($stm->rowCount() == 1) {
        $webimages = $_FILES['webimages'];
        $temp = explode(".", $_FILES["webimages"]["name"]);
        $renamemecha = 'logo.' . end($temp);
        $webimages = $renamemecha;
        $target_file = $target_dir . $renamemecha;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["webimages"]["tmp_name"]);
        if ($check !== false) { $uploadOk = 1; }
        else { $uploadOk = 0; }
        if (file_exists($target_filedb)) { unlink($target_filedb); }
        if (file_exists($target_file)) { unlink($target_file); }
        if ($_FILES["webimages"]["size"] > 7000000) { $uploadOk = 0; }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) { $uploadOk = 0; }
        if ($uploadOk == 0) { echo "Sorry, your file was not uploaded."; }
        else {
            if (move_uploaded_file($_FILES["webimages"]["tmp_name"], $target_file)) {
                $sql = "UPDATE settings SET webimage = '$webimages' WHERE id = 1";
                $stm = $con->prepare($sql);
                $stm->execute();
                echo "Website updated.";
            }
            else { echo "Sorry, there was an error uploading your file."; }
        }
    }
    else { echo "Error occured."; }
?>