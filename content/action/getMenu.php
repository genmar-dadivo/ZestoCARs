<?php
require '../dbase/dbconfig.php';
$sqlsection = "SELECT id, orderid, name FROM menu WHERE type = 0 AND TRIM(name) <> 'extra' ";
$stmsection = $con->prepare($sqlsection);
$stmsection->execute();
$resultssection = $stmsection->fetchAll(PDO::FETCH_ASSOC);
if ($stmsection->rowCount() >= 1) {
    foreach ($resultssection as $rowsection) {
        $idsection   = $rowsection['id'];
        $orderidsection   = $rowsection['orderid'];
        $namesection = ucwords($rowsection['name']);
        echo '<li class="header-menu">';
        echo '<span>' . $namesection . '</span>';
        echo '</li>';
        $sqlmain = "SELECT id, orderid, name FROM menu WHERE type = 1 AND rootid =  $idsection";
        $stmmain = $con->prepare($sqlmain);
        $stmmain->execute();
        $resultsmain = $stmmain->fetchAll(PDO::FETCH_ASSOC);
        if ($stmmain->rowCount() >= 1) {
            foreach ($resultsmain as $rowmain) {
                $idmain     = $rowmain['id'];
                $orderidmain     = $rowmain['orderid'];
                $namemain   = ucwords($rowmain['name']);
                $sqlchecker = "SELECT id FROM menu WHERE rootid =  $idmain";
                $stmchecker = $con->prepare($sqlchecker);
                $stmchecker->execute();
                if ($stmchecker->rowCount() >= 1) {
                    echo '<li class="sidebar-dropdown">';
                    echo '<a href="#">';
                    echo '<i class="fab fa-wpforms"></i>';
                    echo '<span>' . $namemain . '</span>';
                    echo '</a>';
                    echo '<div class="sidebar-submenu">';
                    echo '<ul>';
                    $sqlsub = "SELECT id, orderid, name FROM menu WHERE type = 2 AND rootid =  $idmain";
                    $stmsub = $con->prepare($sqlsub);
                    $stmsub->execute();
                    $resultssub = $stmsub->fetchAll(PDO::FETCH_ASSOC);
                    if ($stmsub->rowCount() >= 1) {
                        foreach ($resultssub as $rowsub) {
                            $idsub   = $rowsub['id'];
                            $orderidsub   = $rowsub['orderid'];
                            if ($orderidsub == 0) { $color = 'text-danger'; }
                            else { $color = ''; }
                            $namesub = ucwords($rowsub['name']);
                            echo '<li>';
                            echo '<a href="#" class="' . $color . '" onclick="contentloader(' . $orderidsub . ')">' . $namesub . '</a>';
                            echo '</li>';
                        }
                    }
                    echo '</ul>';
                    echo '</li>';
                } else {
                    echo '<li>';
                    echo '<a href="#">';
                    echo '<i class="fab fa-wpforms"></i>';
                    echo '<span>' . $namemain . '</span>';
                    echo '</a>';
                    echo '</li>';
                }
            }
        }
    }
}
else { echo "No Data."; }
$idsection   = 15;
$namesection = ucwords('extra');
echo '<li class="header-menu">';
echo '<span>' . $namesection . '</span>';
echo '</li>';
$sqlmain = "SELECT id, orderid, name FROM menu WHERE type = 1 AND rootid =  $idsection";
$stmmain = $con->prepare($sqlmain);
$stmmain->execute();
$resultsmain = $stmmain->fetchAll(PDO::FETCH_ASSOC);
if ($stmmain->rowCount() >= 1) {
    echo '<li class="sidebar-dropdown">';
    echo '<a href="#">';
    echo '<i class="fa fa-database"></i>';
    echo '<span>Data</span>';
    echo '</a>';
    echo '<div class="sidebar-submenu">';
    echo '<ul>';
    echo '<li class="customers-menu">';
    echo '<a href="#" onclick="contentloader(9)">Customers</a>';
    echo '</li>';
    echo '<li class="products-menu">';
    echo '<a href="#" onclick="contentloader(10)">Products</a>';
    echo '</li>';
    echo '<li class="users-menu">';
    echo '<a href="#" onclick="contentloader(13)">Users</a>';
    echo '</li>';
    echo '<li class="groups-menu">';
    echo '<a href="#" onclick="contentloader(14)">Groups</a>';
    echo '</li>';
    echo '<li class="web-menu">';
    echo '<a href="#" onclick="contentloader(15)">App Settings</a>';
    echo '</li>';
    echo '</ul>';
    echo '</div>';
    foreach ($resultsmain as $rowmain) {
        $idmain     = $rowmain['id'];
        $orderidmain     = $rowmain['orderid'];
        $namemain   = ucwords($rowmain['name']);
        $sqlchecker = "SELECT id FROM menu WHERE rootid =  $idmain";
        $stmchecker = $con->prepare($sqlchecker);
        $stmchecker->execute();
        if ($stmchecker->rowCount() >= 1) {
            echo '<li class="sidebar-dropdown">';
            echo '<a href="#">';
            echo '<i class="fab fa-wpforms"></i>';
            echo '<span>' . $namemain . '</span>';
            echo '</a>';
            echo '<div class="sidebar-submenu">';
            echo '<ul>';
            $sqlsub = "SELECT id, name FROM menu WHERE type = 2 AND rootid =  $idmain";
            $stmsub = $con->prepare($sqlsub);
            $stmsub->execute();
            $resultssub = $stmsub->fetchAll(PDO::FETCH_ASSOC);
            if ($stmsub->rowCount() >= 1) {
                foreach ($resultssub as $rowsub) {
                    $idsub   = $rowsub['id'];
                    $orderidsub   = $rowsub['orderid'];
                    $namesub = ucwords($rowsub['name']);
                    echo '<li>';
                    echo '<a href="#" onclick="contentloader(' . $orderidsub . ')">' . $namesub . '</a>';
                    echo '</li>';
                }
            }
            echo '</ul>';
            echo '</li>';
        } else {
            echo '<li>';
            echo '<a href="#" onclick="contentloader(' . $orderidmain . ')">';
            echo '<i class="fab fa-wpforms"></i>';
            echo '<span>' . $namemain . '</span>';
            echo '</a>';
            echo '</li>';
        }
    }
}
?>
<script>
    $("#close-sidebar").click(function() { $(".page-wrapper").removeClass("toggled");});
    $("#show-sidebar").click(function() { $(".page-wrapper").addClass("toggled"); });
    $("#page-content").click(function(e) {
        if (e.ctrlKey) {
            if ($(".page-wrapper").hasClass("toggled")) { $(".page-wrapper").removeClass("toggled"); }
            else { $(".page-wrapper").addClass("toggled"); }
        }
    });
    $(".sidebar-dropdown > a").click(function() {
        $(".sidebar-submenu").slideUp(200);
        if ($(this).parent().hasClass("active")) {
            $(".sidebar-dropdown").removeClass("active");
            $(this).parent().removeClass("active");
        }
        else {
            $(".sidebar-dropdown").removeClass("active");
            $(this).next(".sidebar-submenu").slideDown(200);
            $(this).parent().addClass("active");
        }
    });
</script>