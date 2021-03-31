<?php
    require '../dbase/dbconfig.php';
    $email = preg_replace("/[^A-Za-z0-9\-\']/", '',$_POST['email']);
    $email = str_replace(['@', 'zesto', 'com', 'ph'], "", $email);
    $dept = $_POST['dept'];
    $fname = preg_replace('/[^A-Za-z \-]/', '', $_POST['fname']);
    $username = preg_replace('/[^A-Za-z0-9\-]/', '',$_POST['username']);
    $password = hash('md5', $_POST['password']);
    $sql = "SELECT * FROM tuser WHERE email = '$email' ";
    $stm = $con->prepare($sql);
	$stm->execute();
    if ($stm->rowCount() == 0) {
        $sql = "INSERT INTO tuser (uname, pword, fname, email, department) VALUES ('$username', '$password', '$fname', '$email', '$dept')";
        $stm = $con->prepare($sql);
        $stm->execute();
        echo "Account registered.";
    }
    else { echo "Email already exist."; }
?>