<?php

include 'connection.php';
include 'checkStringSafety.php';
include 'check_login.php';
if(check_login('1')){

$A_ID=$_POST["id"];
$A_NAME=$_POST["name"];
$A_PASSWD=$_POST["passwd1"];
$A_TYPE=$_POST["type"];

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

$myConn = connection::getConn();
$type = get_Num($A_TYPE);
if(checkStringSafety($A_ID)&&checkStringSafety($A_NAME)&&checkStringSafety($A_PASSWD)&&$type != 0){
    $sql = "insert into admin values('$A_ID', '$A_NAME', '$A_PASSWD', '$type')";
    $result = mysqli_query($myConn, $sql);

    if($result){
       echo "ok";
    }
    else {
        echo "fail";
    }
}
else {
    echo "fail";
}
}
else
    echo "you have no authorization";

?>