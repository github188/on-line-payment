<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016/6/4
 * Time: 15:44
 */
header("Content-Type: text/plain;charset=utf-8");
require_once('common/db.php');
session_start();
$email =$_SESSION['email'];
$userType = $_SESSION['userType'];
$checkYear = $_POST['checkYear'];
$checkMonth = $_POST['checkMonth'];

$conn = db_connect();
$email = mysqli_escape_string($conn,$email);
$userType = mysqli_escape_string($conn,$userType);
if(!empty($checkYear) && empty($checkMonth) ){
    $checkYear = mysqli_escape_string($conn,$checkYear);
    $begtime = "$checkYear-01-01 00:00:00";
    $endtime = "$checkYear-12-31 23:59:59";
}
else if(!empty($checkYear) && !empty($checkMonth) ){
    $checkYear = mysqli_escape_string($conn,$checkYear);
    $checkMonth = mysqli_escape_string($conn,$checkMonth);
    $begtime = "$checkYear-$checkMonth-01 00:00:00";
    if(intval($checkMonth)<12){
        $nextMonth = strval(intval($checkMonth)+1);
    }
    else{
        $nextMonth=strval(1);
    }
    if(intval($checkMonth)<10){
        $endtime = "$checkYear-0$nextMonth-01 00:00:00";
    }
    else{
        $endtime = "$checkYear-$nextMonth-01 00:00:00";
    }
}
$select1 ="select * from `seller` natural join `order` where `begtime`>= '".$begtime."'and `endtime` <='".$endtime."'";
$set1 = mysqli_query($conn,$select1,MYSQLI_STORE_RESULT);
$result1=mysqli_fetch_array($set1,MYSQLI_ASSOC);
if($result1){
    $result=$mysqli->query($select1);
    if($result->num_rows>0){
        $i=0;
        while($row =$result->fetch_array() ){
            $row =$result->fetch_array();
            $array[$i]['sellername'] = $row['username'];
            $array[$i]['goodsname'] = $row['goodsname'];
            $array[$i]['price'] = $row['price'];
            $array[$i]['num'] = $row['num'];
            $array[$i]['total'] = $row['price']*$row['num'];
            $array[$i]['begtime'] = $row['begtime'];
            $array[$i]['endtime'] = $row['endtime'];
            ++$i;
        }
    }
    echo json_encode($array);
}
else {
    echo"no";
}
?>