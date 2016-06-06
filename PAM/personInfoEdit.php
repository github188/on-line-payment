<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-6-2
 * Time: 下午6:50
 */

require_once('common/db.php');
session_start();

if ($_SESSION['login'] === true) {
    $conn = db_connect();
    $username = mysqli_escape_string($conn, $_POST['mod_username']);
    $sex = mysqli_escape_string($conn, $_POST['mod_sex']);
    $birthday = mysqli_escape_string($conn, $_POST['mod_birthday']);
    $telephone = mysqli_escape_string($conn, $_POST['mod_telephone']);
    $real_name = isset($_POST['realName']) ? $_POST['mod_realName'] : null;
    $IDnum = isset($_POST['mod_IDcardNum']) ? $_POST['mod_IDcardNum'] : null;
    if ($real_name !== null && $IDnum !== null && !get_verify_status()) {
        //身份验证未通过时更新真实姓名和身份证号码
        $IDnum = intval($IDnum);
        $real_name = mysqli_escape_string($conn, $real_name);

        if ($_SESSION['userType'] === 'buyer') {
            $sql = "update buyer set username=$username, sex=$sex, birthday=$birthday, telephone=$telephone, real_name=$real_name, IDcardNum=$IDnum";
        } elseif ($_SESSION['userType'] === 'seller') {
            $sql = "update seller set username=$username, sex=$sex, birthday=$birthday, telephone=$telephone, real_name=$real_name, IDcardNum=$IDnum";
        }
    } else {
        //身份验证通过时不更新真实姓名和身份证号码

        $user_id = $_SESSION['uid'];
        if ($_SESSION['userType'] === 'buyer') {
            $sql = "update buyer set username='$username', sex='$sex', birthday='$birthday', telephone='$telephone' WHERE b_id=$user_id";
        } elseif ($_SESSION['userType'] === 'seller') {
            $sql = "update seller set username='$username', sex='$sex', birthday='$birthday', telephone='$telephone' WHERE s_id=$user_id";
        }
    }
//    echo $sql;

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo 'update success';
    } else {
        echo 'update fail';
    }
}

function get_verify_status($conn, $userType) {
    $user_id = $_SESSION['uid'];
    if($userType === "seller") {
        $sql = "select status from seller WHERE s_id=$user_id";
    } elseif ( $userType === "buyer" ) {
        $sql = "select status from buyer WHERE b_id=$user_id";
    }
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    if($row['status'] === "认证成功" || $row['status'] === "待认证") {
        return true;
    }
    return false;
}
