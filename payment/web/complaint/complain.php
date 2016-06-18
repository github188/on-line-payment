<?php
    header("Content-type:text/html;charset=utf-8");
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        require_once "../../common/config.php";

        function _post($str)
        {
            $val = !empty($_POST[$str]) ? $_POST[$str] : null;
            return $val;
        }
        $order=_post('order');
        $type=_post('type');
        $content=_post('content');
        $userid=123456;

        if($order==null) 
            echo '<script type="text/javascript"> alert("投诉失败：订单号不能为空。"); window.history.back(-1)</script>';
        if($type=="1")
            echo '<script type="text/javascript"> alert("投诉失败：投诉类型不能为空。"); window.history.back(-1)</script>';
        if($content==null)
            echo '<script type="text/javascript"> alert("投诉失败：投诉原因不能为空。"); window.history.back(-1)</script>';

        $con = mysqli_connect($DB_HOST.':'.$DB_PORT, $DB_USER, $DB_PASSWORD);
        mysqli_query($con,"SET NAMES utf8");
        if (!$con) //投诉成功返回首页，投诉失败返回投诉选项卡
            echo '<script type="text/javascript">
                    alert("投诉失败：数据库连接失败，请联系网站管理员。");
                    window.history.back(-1)
                </script>';
        else {
            mysqli_select_db($con, $DB_SCHEMA);
            $sql = "select * from `order` where o_id = '$order' and (s_id = '$userid' or b_id = '$userid')";
            $result = mysqli_query($con, $sql);
            if (!$result->num_rows) {
                echo '<script type="text/javascript"> 
                    alert("投诉失败：这不是你的订单。"); 
                    window.history.back(-1)
                </script>';
            }else{
                $sql = "REPLACE INTO `complaint` VALUES ('$order','$type','$content')";
                $result = mysqli_query($con, $sql);
                echo '<script type="text/javascript"> 
                        alert("投诉成功。"); 
                        window.location='.'\''.'../../index.html'.'\''.'
                    </script>';
            }
        }
        mysqli_close($con);
    }
?>