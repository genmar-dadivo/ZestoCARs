<?php
    require '../dbase/dbconfig.php';
    $euname = $_POST['euname'];
    $firstname = preg_replace('/[^a-zA-ZÑñ \']/', '', $_POST['firstname']);
    $middlename = preg_replace('/[^a-zA-ZÑñ \']/', '', $_POST['middlename']);
    $lastname = preg_replace('/[^a-zA-ZÑñ \']/', '', $_POST['lastname']);
    $namesuffix = preg_replace('/[^a-zA-ZÑñ \']/', '', $_POST['namesuffix']);
    $birthdate = $_POST['birthdate'];
    $sex = $_POST['sex'];
    $address = preg_replace('/[^a-zA-Z0-9#. \']/', '', $_POST['address']);
    $permaaddress = preg_replace('/[^a-zA-Z0-9#. \']/', '', $_POST['permaaddress']);
    $company = $_POST['company'];
    $phonenumber = $_POST['phonenumber'];
    $eidnumber = $_POST['eidnumber'];
    $prevdept = $_POST['prevdept'];
    $datehired = $_POST['datehired'];
    $dateregular = $_POST['dateregular'];
    $sss = $_POST['sss'];
    $pagibigmid = $_POST['pagibigmid'];
    $pagibigrtn = $_POST['pagibigrtn'];
    $tin = $_POST['tin'];
    $coco = $_POST['coco'];
    $ins = $_POST['ins'];
    $college = preg_replace('/[^a-zA-Z0-9., \']/', '', $_POST['college']);
    $hs = preg_replace('/[^a-zA-Z0-9., \']/', '', $_POST['hs']);
    $elem = preg_replace('/[^a-zA-Z0-9., \']/', '', $_POST['elem']);
    $workhist = preg_replace('/[^a-zA-Z0-9., \']/', '', $_POST['workhist']);
    $ephonenumber = $_POST['ephonenumber'];
    $contactpersonrelation = preg_replace('/[^a-zA-Z \']/', '', $_POST['contactpersonrelation']);
    $contactperson = preg_replace('/[^a-zA-Z \']/', '', $_POST['contactperson']);
    $eaddress = preg_replace('/[^a-zA-Z0-9#. \']/', '', $_POST['eaddress']);
    $department = $_POST['department'];
    $position = preg_replace('/[^a-zA-Z0-9 \']/', '', $_POST['position']);
    $sql = "SELECT * FROM edata WHERE uname = '$euname' ";
    $stm = $con->prepare($sql);
	$stm->execute();
    if ($stm->rowCount() == 0) {
        $sqledata = "INSERT INTO edata(`fname`, `mname`, `lname`, `ns`, `bdate`, `sex`, `address`, `permanentaddress`, `phonenumber`, `idnumber`, `company`, `region`, `department`, `position`, `prevdept`, `datehired`, `dateregular`, `sssno`, `pagibigrtn`, `pagibigmid`, `tin`, `cocolife`, `ccamount`, `college`, `hs`, `elem`, `workhistory`, `ephonenumb`, `econtactperson`, `econpersonrelation`, `eaddress`, `uname`) 
        VALUES ('$firstname', '$middlename', '$lastname', '$namesuffix', '$birthdate', '$sex', '$address', '$permaaddress', '$phonenumber', '$eidnumber', '$company', '$region', '$department', '$position', '$prevdept', '$datehired', '$dateregular', '$sss', '$pagibigrtn', '$pagibigmid', '$tin', '$coco', '$ins', '$college', '$hs', '$elem', '$workhist', '$ephonenumber', '$contactperson', '$contactpersonrelation', '$eaddress', '$euname')";
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