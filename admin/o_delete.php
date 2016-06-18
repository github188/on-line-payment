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
if(check_login('3')){
$DeleteResult=1;


$O_ID=$_GET["o_id"];
//$S_ID=$_GET["s_id"];
//$B_ID=$_GET["b_id"];
//$G_ID=$_GET["g_id"];


$myConn = connection::getConn();

$sql = "select * from `order` where o_id='$O_ID'";
$result = mysqli_query($myConn, $sql);
$rownum = mysqli_num_rows($result);
if($rownum==0){
    $DeleteResult=0;
}
else {
    $sql = "delete from `order` where o_id='$O_ID'";
    $result = mysqli_query($myConn, $sql);
    if (!$result)
        $DeleteResult = 0;
}
if($DeleteResult)
    echo 'delete order ok';
else
    echo 'delete order fail';
connection::freeConn();

}else
    echo "you have no authorization";
?>