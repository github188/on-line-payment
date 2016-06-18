<?php

include 'connection.php';
include 'checkStringSafety.php';
include 'check_login.php';
if(check_login('1')){

$origin_ID=$_POST["new_id"];
$A_NAME=$_POST["new_name"];
$A_PASSWD=$_POST["new_passwd"];
$A_TYPE=$_POST["new_type"];


//echo $origin_ID;
//echo $A_NAME;
//echo $A_PASSWD;
//echo $A_TYPE;


$modifyResult = 1;

function get_Num($type){
    switch($type){
        case 'user': $num=2;
            break;
        case 'order': $num=3;
            break;
        default:    $num=0;
            break;
    }
    return $num;
}

if(checkStringSafety($A_NAME)&&checkStringSafety($origin_ID)&&checkStringSafety($A_PASSWD)) {

    $myConn = connection::getConn();
    $num = get_Num($A_TYPE);

    $sql = "select * from admin where a_id ='$origin_ID'";
    $result = mysqli_query($myConn, $sql);
    $rownum = mysqli_num_rows($result);

    if($rownum == 0 || $num == 0){
        //echo '0';
        $modifyResult = 0;
    }
    else {
        if ($row = mysqli_fetch_assoc($result)) {
            $origin_name = $row['name'];
            $origin_pwd = $row['password'];
            $origin_type = $row['type'];
        }
        if ($A_NAME == 'null') {
            $A_NAME = $origin_name;
        }
        if($A_PASSWD == 'null'){
            $A_PASSWD = $origin_pwd;
        }
        $sql = "update admin set name = '$A_NAME', password ='$A_PASSWD', type = '$num' where a_id = '$origin_ID' ";
        $update = mysqli_query($myConn, $sql);
        if(!$update){
            //echo '0';
            $modifyResult = 0;
        }
    }
    connection::freeConn();
}
else {
    //echo '0';
    $modifyResult = 0;
}

if($modifyResult == 1){
    echo "ok";
}
else {
    echo "fail";
}
}else
    echo "you have no authorization";
?>