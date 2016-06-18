<?php
/**
 * Created by PhpStorm.
 * User: luxuhui
 * Date: 16/6/16
 * Time: 上午2:08
 */
include 'connection.php';
include 'checkStringSafety.php';
include 'check_login.php';
if(check_login('2')){
$A_ID=$_GET["u_id"];
$A_TYPE=$_GET["u_type"];

$myConn = connection::getConn();
$DeleteResult=1;

if($A_TYPE=="seller") {
    $sql = "select * from seller where s_id='$A_ID'";
    $result = mysqli_query($myConn, $sql);
    $row = mysqli_fetch_assoc($result);
    $sql = "delete from seller where s_id='$A_ID'";
    $result = mysqli_query($myConn, $sql);
    if($result)
        $DeleteResult=0;
    connection::freeConn();
}
else if($A_TYPE=="buyer"){
    $sql = "select * from buyer where b_id='$A_ID'";
    $result = mysqli_query($myConn, $sql);
    $row = mysqli_fetch_assoc($result);
    $sql = "delete from buyer where b_id='$A_ID'";
    $result = mysqli_query($myConn, $sql);
    if($result)
        $DeleteResult=0;
    connection::freeConn();
}
else
    $DeleteResult=0;


if($DeleteResult)
    echo 'delete fail';
else
    echo 'delete ok';
}else
    echo "you have no authorization";
?>