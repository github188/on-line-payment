<?php
include 'connection.php';
include 'checkStringSafety.php';
include 'check_login.php';
if(check_login('1')){

$A_ID=$_GET["id"];
$A_NAME=$_GET["name"];
$A_TYPE=$_GET["type"];


function get_Type($num){
    switch($num){
        case 1: $type='admin';
                break;
        case 2: $type='user';
                break;
        case 3: $type='order';
                break;
        default: break;
    }

    return $type;
}

function get_Num($type){
    switch($type){
        case 'admin': $num=1;
            break;
        case 'user': $num=2;
            break;
        case 'order': $num=3;
            break;
        default:    $num=0;
            break;
    }

    return $num;
}


if(checkStringSafety($A_NAME)&&checkStringSafety($A_ID)) {

    $myConn = connection::getConn();

    $num = get_Num($A_TYPE);
    if ($A_NAME == 'null') {
        $A_NAME = '';
    }

    if ($A_ID == 'null') {
        $A_ID = '';
    }

    if ($num == 0) {
        $sql = "select * from admin where a_id like '$A_ID%' and name like '$A_NAME%'";
    } else {
        $sql = "select * from admin where a_id like '$A_ID%' and name like '$A_NAME%' and type = $num";
    }

    $result = mysqli_query($myConn, $sql);
    $rownum = mysqli_num_rows($result);

    $i = 1;

    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row['name'];
        $pwd = $row['password'];
        $type = get_Type($row['type']);
        $id=$row['a_id'];
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>$id</td>";
        echo "<td>$type</td>";
        echo "<td>$name</td>";
        echo "<td>$pwd</td>";
        echo "</tr >";
        $i++;
    }


    connection::freeConn();
}
}else
    echo "you have no authorization";
?>