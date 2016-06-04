<?php
/**
 * Created by PhpStorm.
 * User: Pro15
 * Date: 16/6/3
 * Time: 上午12:41
 */


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
        exit("激活失败！");
    }
}

$result = mysqli_query($conn,'SELECT * FROM '.$tableName.' WHERE '.$id.' = '.$uid);
$result_arr = mysqli_fetch_array($result,MYSQLI_ASSOC);

if (mysqli_errno()) {

    print_r(mysqli_error());
    exit("激活失败！");

} else{

    $activation = $result_arr['actived'];

    if ($activation == 1)
    {
        echo "该账号已被激活！";
    }
    else {
        $result = mysqli_query($conn, 'UPDATE ' . $tableName . ' SET actived=1 WHERE ' . $id . ' = ' . $uid);
        if (mysqli_errno()) {
            print_r(mysqli_error());
        } else {
            echo "激活成功！将在3秒后跳转至登录页面";
            sleep(3);
            header("Location:login.php");
        }
    }
}

?>