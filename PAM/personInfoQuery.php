<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-6-2
 * Time: 下午6:14
 */
require_once('common/db.php');
session_start();

if ($_SESSION['login'] === true) {

    $conn = db_connect();
    if ($_SESSION['userType'] === 'seller') {
        $sql = 'select username, sex, birthday, telephone, email, status, real_name, IDcardNum 
                from seller WHERE s_id=' . $_SESSION['uid'];
    } else if ($_SESSION['userType'] === 'buyer') {
        $sql = 'select username, sex, birthday, telephone, email, status, real_name, IDcardNum
                from buyer where b_id=' . $_SESSION['uid'];
    }
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $arr = mysqli_fetch_array($result);
        echo $arr;
        if ($arr) {
            echo json_encode($arr);
        }

    }
}