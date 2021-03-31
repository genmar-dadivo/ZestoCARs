<?php
    require '../dbase/dbconfig.php';
    $euname = $_POST['euname'];
    $fullname = preg_replace('/[^a-zA-Z \']/', '', $_POST['fullname']);
    $birthdate = $_POST['birthdate'];
    $address = preg_replace('/[^a-zA-Z0-9#. \']/', '', $_POST['address']);
    $phonenumber = $_POST['phonenumber'];
    $sss = $_POST['sss'];
    $pagibig = $_POST['pagibig'];
    $tin = $_POST['tin'];
    $college = preg_replace('/[^a-zA-Z0-9., \']/', '', $_POST['college']);
    $hs = preg_replace('/[^a-zA-Z0-9., \']/', '', $_POST['hs']);
    $elem = preg_replace('/[^a-zA-Z0-9., \']/', '', $_POST['elem']);
    $workhist = preg_replace('/[^a-zA-Z0-9., \']/', '', $_POST['workhist']);
    $ephonenumber = $_POST['ephonenumber'];
    $contactperson = preg_replace('/[^a-zA-Z \']/', '', $_POST['contactperson']);
    $eaddress = preg_replace('/[^a-zA-Z0-9#. \']/', '', $_POST['eaddress']);
    $department = $_POST['department'];
    $position = preg_replace('/[^a-zA-Z0-9 \']/', '', $_POST['position']);
    $sql = "SELECT * FROM edata WHERE uname = '$euname' ";
    $stm = $con->prepare($sql);
	$stm->execute();
    if ($stm->rowCount() == 0) {
        $sqledata = "INSERT INTO edata(`uname`, `fname`, `bdate`, `address`, `phoneno`, `sssno`, `pagibig`, `tin`, `college`, `highschool`, `elementary`, 
        `workhistory`, `ephoneno`, `contactper`, `eaddress`, `dept`, `pos`) 
        VALUES ('$euname', '$fullname', '$birthdate', '$address', '$phonenumber', '$sss', '$pagibig', 
        '$tin', '$college', '$hs', '$elem', '$workhist', '$ephonenumber', '$contactperson', '$eaddress', '$department', '$position')";
        $stmedata = $con->prepare($sqledata);
        $stmedata->execute();
        if ($stmedata->rowCount() == 1) { echo "Data Inserted. \n"; }
        else { echo "Error Occured."; }
    }
    else { echo "Error Occured."; }
    if (isset($_FILES['epicture'])) {
        $target_dir = "../../assets/img/eimg/";
        $temp = explode(".", $_FILES["epicture"]["name"]);
        $renamemecha = $euname . '.' . end($temp);
        $target_file = $target_dir . $renamemecha;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["epicture"]["tmp_name"]);
        if ($check !== false) { $uploadOk = 1; }
        else { $uploadOk = 0; }
        if (file_exists($target_file)) { unlink($target_file); }
        if ($_FILES["epicture"]["size"] > 1000000) { $uploadOk = 0; }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) { $uploadOk = 0; }
        if ($uploadOk == 0) { echo "Sorry, your file was not uploaded."; }
        else {
            if (move_uploaded_file($_FILES["epicture"]["tmp_name"], $target_file)) {
                //echo "Image Uploaded.";
            }
            else { echo "Sorry, there was an error uploading your file."; }
        }
    }
?>