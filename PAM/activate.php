<?php
/**
 * Created by PhpStorm.
 * User: Pro15
 * Date: 16/6/3
 * Time: 上午12:41
 */

header("Content-Type: text/plain;charset=utf-8");
require_once('common/db.php');
session_start();
//连接服务器
$conn = db_connect();

$token = $_GET['Token'];
$userType = $_GET['userType'];
$key_m = $_GET['test'];

$key = intval($key_m) ^ 1372;
$uid = intval($token) ^ $key;

if ($userType=='buyer')
{
    $tableName = 'buyer';
    $id = 'b_id';
}else {
    if ($userType=='seller') {
        $tableName = 'seller';
        $id = 's_id';
    }else{
        echo "<script> alert('激活失败！') </script>";
    }
}

$result = mysqli_query($conn,'SELECT * FROM '.$tableName.' WHERE '.$id.' = '.$uid);
$result_arr = mysqli_fetch_array($result,MYSQLI_ASSOC);

if (mysqli_errno($conn)) {
    echo "<script>alert('激活失败！'";
    print_r(mysqli_error($conn));
    echo ") </script>";
    exit();

} else{

    $activation = $result_arr['actived'];

    if ($activation == 1)
    {
        echo "<script> alert('该账号已被激活！') </script>";
    }
    else {
        $result = mysqli_query($conn, 'UPDATE ' . $tableName . ' SET actived=1 WHERE ' . $id . ' = ' . $uid);
        if (mysqli_errno($conn)) {
            print_r(mysqli_error($conn));
        } else {
            echo "<script>alert('激活成功！将在3秒后跳转至登录页面')</script>";
            header("Location:login.html");
        }
    }
}

?>