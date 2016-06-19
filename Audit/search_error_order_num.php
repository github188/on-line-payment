<?php
    require_once 'check_login.php';
    require_once '../common/config.php';
    if (isset($_GET['begtime']))
        $begtime = $_GET['begtime'];
    if (isset($_GET['endtime']))
        $endtime = $_GET['endtime'];
    $con = mysqli_connect($DB_HOST.':'.$DB_PORT, $DB_USER, $DB_PASSWORD);
    if (!$con)
        echo 'Datebase connect error';
    else {
        mysqli_select_db($con, $DB_SCHEMA);
        if (isset($_GET['begtime']) && isset($_GET['endtime']))
            $result=mysqli_query($con, "select count(*) from `error_order` where UNIX_TIMESTAMP(begtime) >= UNIX_TIMESTAMP('$begtime') and UNIX_TIMESTAMP(begtime) <= UNIX_TIMESTAMP('$endtime')");
        else
            $result=mysqli_query($con, "select count(*) from `error_order`");
        if (!empty($result)) {
            $row = mysqli_fetch_array($result);
            $error_num = $row["count(*)"];
        }
        else
            $error_num = 0;
        echo "共发现 $error_num 条错误订单";
    }
?>
