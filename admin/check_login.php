<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>远途网在线预订系统管理</title>
    <meta name="description" content="远途网提供便捷快速的酒店机票服务">
    <meta name="keywords" content="酒店 机票 后台 管理">
    <meta name="author" content="软件工程基础2.3组">
</head>
</html>
<?php
function check_login($type)
{
session_start();
if(isset($_SESSION['id']))
{
    $id=$_SESSION['id'];
    $passwd=$_SESSION['pwd'];

    $myConn = connection::getConn();
    $sql = "select * from admin where a_id ='$id'";
    $result=mysqli_query($myConn,$sql);
    $row=mysqli_fetch_assoc($result);
    connection::freeConn();
    if($type!=$row['type'] || $passwd!=$row['password'])
        return 0;
    else
        return 1;
}
else{
    return 0;
}

}

?>
