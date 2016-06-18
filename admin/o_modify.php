<?php

include 'connection.php';
include 'checkStringSafety.php';
include 'check_login.php';
if(check_login('3')){
$new_price = $_POST['new_price'];
$o_id = $_POST['oid'];
$new_state = $_POST['new_state'];
$new_number = $_POST['new_number'];


$modifyResult = 1;

$myConn = connection::getConn();

$sql = "select * from `order` where o_id ='$o_id'";
$result = mysqli_query($myConn, $sql);
$rownum = mysqli_num_rows($result);

if ($rownum == 0) {
    //echo '0';
    $modifyResult = 0;
} else {
    if ($row = mysqli_fetch_assoc($result)) {
        //$origin_name = $row['username']; 
        //$origin_password = $row['password']; 
        $origin_state = $row['state'];
        $origin_price = $row['price'];
        $origin_number = $row['num'];
    }

    if ($new_state == 'null') {
        $user_state = $new_state;
    }
    if ($new_price == 'null') {
        $new_price = $new_price;
    }

    if ($new_number == 'null') {
        $new_number = $origin_number;
    }

    $sql = "update `order` set state = '$new_state', num ='$new_number',price='$new_price' where o_id = '$o_id' ";
    $update = mysqli_query($myConn, $sql);
    if (!$update) {
        //echo '0';
        $modifyResult = 0;
    }
}
connection::freeConn();

if ($modifyResult == 1) {
    echo "ok";
}
else {
    echo "fail";
}
}else
    echo "you have no authorization";
?>