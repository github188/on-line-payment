<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-6-3
 * Time: 下午6:33
 */

require_once('common/db.php');
session_start();

if ($_SESSION['login'] === true) {
    $conn = db_connect();
    $oldPassIn = mysqli_escape_string($conn, $_POST['oldpassword']);
    $newPass = mysqli_escape_string($conn, $_POST['newpassword']);
    $newPassRe = mysqli_escape_string($conn, $_POST['renewpassword']);

    if (!empty($oldPassIn) && !empty($newPass) && !empty($newPassRe)) {
        if ($newPass !== $newPassRe) {
            die("两次新密码不一致");
        }
        if ($_SESSION['userType'] === 'seller') {
            $sql = "select password from seller WHERE s_id=" . $_SESSION['uid'];
        } elseif ($_SESSION['userType'] === 'buyer') {
            $sql = 'select password from buyer WHERE b_id=' . $_SESSION['uid'];
        }
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $row = mysqli_fetch_array($result);

            if ($row['password'] === $oldPassIn) {
                //旧密码相等
                $user_id = $_SESSION['uid'];
                if ($_SESSION['userType'] === 'seller') {
                    $sql = "update seller set password='$newPass' WHERE s_id=$user_id";
                } elseif ($_SESSION['userType'] === 'buyer') {
                    $sql = "update buyer set password='$newPass' WHERE b_id=$user_id";
                }
                $res = mysqli_query($conn, $sql);
                if ($res) {
                    echo "update success";
                } else {
                    echo "update fail";
                }
            } else {
                echo "旧密码不相等";
            }
        } else {
            echo "记录不存在";
        }
    }
}