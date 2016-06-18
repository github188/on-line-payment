<?php

include 'connection.php';
include 'checkStringSafety.php';
include 'check_login.php';
if(check_login('2')){
$user_name = $_POST['new_uname'];
$user_password = $_POST['new_passwd'];
$user_id = $_POST['id'];
$user_balance = $_POST['new_balance'];
$user_type = $_POST['type'];

$modifyResult = 1;


if($user_type=='seller') {
    $myConn = connection::getConn();

    $sql = "select * from seller where s_id ='$user_id'";
    $result = mysqli_query($myConn, $sql);
    $rownum = mysqli_num_rows($result);

    if ($rownum == 0) {
        //echo '0';
        $modifyResult = 0;
    } else {
        if ($row = mysqli_fetch_assoc($result)) {
            //$origin_name = $row['username']; 
            //$origin_password = $row['password']; 
            $origin_balance = $row['balance'];
            $origin_name = $row['username'];
            $origin_password = $row['password'];
        }

        if ($user_name == 'null') {
            $user_name = $origin_name;
        }
        if ($user_password == 'null') {
            $user_password = $origin_password;
        }

        if ($user_balance == 'null') {
            $user_balance = $origin_balance;
        }

        $sql = "update seller set username = '$user_name', password ='$user_password',balance='$user_balance' where s_id = '$user_id' ";
        $update = mysqli_query($myConn, $sql);
        if (!$update) {
            //echo '0';
            $modifyResult = 0;
        }
    }
    connection::freeConn();
}

else if($user_type=='buyer') {
    $myConn = connection::getConn();

    $sql = "select * from buyer where b_id ='$user_id'";
    $result = mysqli_query($myConn, $sql);
    $rownum = mysqli_num_rows($result);

    if ($rownum == 0) {
        //echo '0';
        $modifyResult = 0;
    } else {
        if ($row = mysqli_fetch_assoc($result)) {
            //$origin_name = $row['username']; 
            //$origin_password = $row['password']; 
            $origin_balance = $row['balance'];
            $origin_name = $row['username'];
            $origin_password = $row['password'];
        }

        if ($user_name == 'null') {
            $user_name = $origin_name;
        }
        if ($user_password == 'null') {
            $user_password = $origin_password;
        }

        if ($user_balance == 'null') {
            $user_balance = $origin_balance;
        }

        $sql = "update buyer set username = '$user_name', password ='$user_password',balance='$user_balance' where b_id = '$user_id' ";
        $update = mysqli_query($myConn, $sql);
        if (!$update) {
            //echo '0';
            $modifyResult = 0;
        }
    }
    connection::freeConn();
}
else{
    $modifyResult=0;
}

if ($modifyResult == 1) {
    echo "ok";
}
else {
    echo "fail";
}
}else
    echo "you have no authorization";
?>