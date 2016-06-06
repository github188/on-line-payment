<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016/6/4
 * Time: 15:44
 */
//header("Content-Type: text/plain;charset=utf-8");
require_once('common/db.php');
//session_start();
//$email =$_SESSION['email'];
//$userType = $_SESSION['userType'];

$checkYear = $_POST["checkYear"];
$checkMonth = $_POST["checkMonth"];

//$conn = db_connect();
//$email = mysqli_escape_string($conn,$email);
//$userType = mysqli_escape_string($conn,$userType);
//if(!empty($checkYear) && empty($checkMonth) ){
//    $checkYear = mysqli_escape_string($conn,$checkYear);
//    $begtime = "$checkYear-01-01 00:00:00";
//    $endtime = "$checkYear-12-31 23:59:59";
//}
//else if(!empty($checkYear) && !empty($checkMonth) ){
//    $checkYear = mysqli_escape_string($conn,$checkYear);
//    $checkMonth = mysqli_escape_string($conn,$checkMonth);
//    $begtime = "$checkYear-$checkMonth-01 00:00:00";
//    if(intval($checkMonth)<12){
//        $nextMonth = strval(intval($checkMonth)+1);
//    }
//    else{
//        $nextMonth=strval(1);
//    }
//    if(intval($checkMonth)<10){
//        $endtime = "$checkYear-0$nextMonth-01 00:00:00";
//    }
//    else{
//        $endtime = "$checkYear-$nextMonth-01 00:00:00";
//    }
//}
////echo $begtime;
////echo $endtime;
////select * from  `order` natural join seller  where `begtime`>= '2016-01-01 00:00:00'and `endtime` <= "2016-06-01 00:00:00"
//$select1 ="select * from `seller` natural join `order` where `begtime`>= '".$begtime."'and `endtime` <='".$endtime."'";
////$select1 ="select * from `seller` natural join `order` where `begtime`>= '2016-01-01 00:00:00'and `endtime` <='2016-06-01 00:00:00'";
//$set1 = mysqli_query($conn,$select1,MYSQLI_STORE_RESULT);
//
//if($set1->num_rows>0){
//    $i=0;
//    while($row =$set1->fetch_array() ){
////        print_r($row);
////        $array[$i]['sellername'] = '1';
////        $array[$i]['goodsname'] = '1';
////        $array[$i]['price'] = 1;
////        $array[$i]['num'] = 1;
////        $array[$i]['total'] = 1;
////        $array[$i]['begtime'] = '1';
////        $array[$i]['endtime'] = '1';
//        $array[$i]['sellername'] = $row['username'];
//        $array[$i]['goodsname'] = $row['g_name'];
//        $array[$i]['price'] = $row['price'];
//        $array[$i]['num'] = $row['num'];
//        $array[$i]['total'] = $row['price']*$row['num'];
//        $array[$i]['begtime'] = $row['begtime'];
//        $array[$i]['endtime'] = $row['endtime'];
//        ++$i;
//    }
////    print_r($array);
////$i=0;
////        $array[$i]['sellername'] = '1';
////        $array[$i]['goodsname'] = '1';
////        $array[$i]['price'] = 1;
////        $array[$i]['num'] = 1;
////        $array[$i]['total'] = 1;
////        $array[$i]['begtime'] = '1';
////        $array[$i]['endtime'] = '1';
//    echo json_encode($array);
//}
//
////
//else {
//    echo"no";
//}
//?>