<?php
    header("Content-type:text/html;charset=utf-8");
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        $order=$_GET['c_order'];
        require_once "../common/config.php";
        $con = mysqli_connect($DB_HOST.':'.$DB_PORT, $DB_USER, $DB_PASSWORD);
        if (!$con) //投诉成功返回首页，投诉失败返回投诉选项卡
            echo '投诉情况查询失败。';
        else {
            mysqli_select_db($con, $DB_SCHEMA);
            $sql = "select * from complaint where o_id='$order'";
            $result = mysqli_query($con, $sql);
            if($result->num_rows) echo '已投诉';
            else echo '未投诉';
        }
        mysqli_close($con);
    }
?>