<?php

include 'connection.php';
include 'checkStringSafety.php';
include 'check_login.php';

if(check_login('2')){
$A_METHOD = $_GET['method'];

$verifyResult = 1;



if($A_METHOD==1){
    $myConn = connection::getConn();

    $sql = "select * from IDauthReq where processed='0'";


    $result = mysqli_query($myConn, $sql);
    $rownum = mysqli_num_rows($result);
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['u_id'];
        $type = $row['userType'];
        $real_name = $row['realName'];
        $card_id = $row['ID'];
        $process = $row['processed'];

        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$type</td>";
        echo "<td>$real_name</td>";
        echo "<td>$card_id</td>";
        echo "<td>$process</td>";
        echo "</tr >";
    }


    connection::freeConn();
}


else if($A_METHOD==2) {
    $myConn = connection::getConn();
    $A_ID = $_GET['u_id'];
    $A_TYPE = $_GET['u_type'];
    $A_ACTION = $_GET['action'];
    //echo $A_ID;
    //echo $A_TYPE;
    //echo $A_ACTION;
    if ($A_TYPE == "seller")
    {
        $sql = "select * from seller where s_id ='$A_ID'";
        $result = mysqli_query($myConn, $sql);
        $rownum = mysqli_num_rows($result);

        if ($rownum == 0)
            $verifyResult = 0;
        else {
            $sql = "update seller set status = '$A_ACTION' where s_id ='$A_ID'";
            $update = mysqli_query($myConn, $sql);
            if (!$update)
                $modifyResult = 0;

            $sql = "update IDauthReq set processed = '1' where u_id ='$A_ID'";
            $update = mysqli_query($myConn, $sql);
            if (!$update)
                $modifyResult = 0;
        }

    }
    else
    {
        $sql = "select * from buyer where b_id ='$A_ID'";
        $result = mysqli_query($myConn, $sql);
        $rownum = mysqli_num_rows($result);

        if ($rownum == 0)
            $verifyResult = 0;
        else {
            $sql = "update buyer set status = '$A_ACTION' where s_id ='$A_ID'";
            $update = mysqli_query($myConn, $sql);
            if (!$update)
                $modifyResult = 0;

            $sql = "update IDauthReq set processed = '1' where u_id ='$A_ID'";
            $update = mysqli_query($myConn, $sql);
            if (!$update)
                $modifyResult = 0;
        }
    }
    connection::freeConn();
    if ($verifyResult == 1)
        echo "ok";
    else
        echo "fail";
}
}else
    echo "you have no authorization";
?>