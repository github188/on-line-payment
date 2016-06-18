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
if(check_login('1')){

$A_ID=$_GET["m_id"];

$myConn = connection::getConn();

$sql = "select * from admin where a_id='$A_ID'";
$result = mysqli_query($myConn, $sql);
$row = mysqli_fetch_assoc($result);

if($row['type']==1){
    connection::freeConn();
    echo "<p style='color: red'>delete fail</p>";
}
else
{
    $sql = "delete from admin where a_id='$A_ID'";
    $result = mysqli_query($myConn, $sql);
    connection::freeConn();
    echo "<p style='color: red'>delete ok</p>";
}
}else
    echo "you have no authorization";
?>