<?php
    require_once 'check_login.php';
    require_once '../common/config.php';
    $o_id = $_GET['o_id'];
    $new_o_id = $_GET['new_o_id'];
    $begtime = $_GET['begtime'];
    $s_id = $_GET['s_id'];
    $b_id = $_GET['b_id'];
    $state = $_GET['state'];
    $type = $_GET['type'];
    $g_id = $_GET['g_id'];
    $price = $_GET['price'];
    $num = $_GET['num'];
    $endtime = $_GET['endtime'];
    $g_name = $_GET['g_name'];
    $con = mysqli_connect($DB_HOST.':'.$DB_PORT, $DB_USER, $DB_PASSWORD);
    if (!$con)
        echo 'Datebase connect error';
    else {
        mysqli_select_db($con, $DB_SCHEMA);
        $result = mysqli_query($con, "select * from `error_order` where o_id=$o_id");
        //echo "select * from `error_order` where o_id=$o_id <br>";
        if (empty(mysqli_fetch_array($result)))
            echo "请输入正确的订单ID";
        else {
            $sql1 = "";
            $sql2 = "";
            if (!empty($new_o_id)) {
                $sql1 .= "o_id=$new_o_id,";
                $sql2 .= "o_id=$new_o_id,";
            }
            if (!empty($begtime)) {
                $sql1 .= "begtime='$begtime',";
                $sql2 .= "begtime='$begtime',";
            }
            if (!empty($s_id))
                $sql2 .= "s_id=$s_id,";
            if (!empty($b_id))
                $sql2 .= "b_id=$b_id,";
            if (!empty($state))
                $sql2 .= "state=$state,";
            if (!empty($type))
                $sql2 .= "type=$type,";
            if (!empty($g_id))
                $sql2 .= "g_id=$g_id,";
            if (!empty($price))
                $sql2 .= "price=$price,";
            if (!empty($num))
                $sql2 .= "num=$num,";
            if (!empty($endtime))
                $sql2 .= "endtime='$endtime',";
            if (!empty($g_name))
                $sql2 .= "g_name=$g_name,";
            //echo $sql1.'<br>';
            if ( $sql1!="" )
                $sql1 = substr($sql2, 0, strlen($sql1)-1);
            if ( $sql2!="" )
                $sql2 = substr($sql2, 0, strlen($sql2)-1);
            // $sql1.'<br>';
            $sql1 .= " where o_id = $o_id ";
            $sql2 .= " where o_id = $o_id ";
            //echo $sql1.'<br>';
            $sql1 = 'update `error_order` set '.$sql1;
            $sql2 = 'update `order` set '.$sql2;
            //echo $sql1.'<br>';
            //echo $sql2.'<br>';
            $result1 = mysqli_query($con, $sql1);
            $result2 = mysqli_query($con, $sql2);
            if ( $result2 && $result2 )
                echo "修改成功!";
            else
                echo "修改失败!";
        }
    }
?>