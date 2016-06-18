<?php
include 'connection.php';
include 'checkStringSafety.php';
include 'check_login.php';

if(check_login('3')){

    $O_ID=$_GET["o_id"];
    $S_ID=$_GET["s_id"];
    $B_ID=$_GET["b_id"];
    $G_ID=$_GET["g_id"];


    if ($O_ID == 'null') {
        $O_ID = '';
    }
    if ($S_ID == 'null') {
        $S_ID = '';
    }
    if ($B_ID == 'null') {
        $B_ID = '';
    }
    if ($G_ID == 'null') {
        $G_ID = '';
    }

    $myConn = connection::getConn();
    $sql = "select * from `order` where g_id like '$G_ID%'and seller_id like '$S_ID%' and buyer_id like '$B_ID%' and o_id like '$O_ID%'";
    $result = mysqli_query($myConn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        //echo $row['seller_id'];
        $user_s_id = $row['seller_id'];
        $user_b_id = $row['buyer_id'];
        $user_g_id = $row['g_id'];
        $user_o_id = $row['o_id'];
        $user_state = $row['state'];
        $user_type = $row['type'];
        $user_gname = $row['g_name'];
        $user_price = $row['price'];
        $user_number = $row['num'];
        $user_begintime = $row['begintime'];
        $user_endtime = $row["endtime"];

        //echo $row['s_id'];

        echo "<tr>";
        echo "<td>$user_o_id</td>";
        echo "<td>$user_s_id</td>";
        echo "<td>$user_b_id</td>";
        echo "<td>$user_g_id</td>";
        echo "<td>$user_state</td>";
        echo "<td>$user_type</td>";
        echo "<td>$user_gname</td>";
        echo "<td>$user_price</td>";
        echo "<td>$user_number</td>";
        echo "<td>$user_begintime</td>";
        echo "<td>$user_endtime</td>";
        echo "</tr>";
    }

connection::freeConn();
}else
    echo "you have no authorization";

?>