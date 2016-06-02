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
    if ($_POST['action'] === 'show') {
        if ($_SESSION['userType'] === 'seller') {
            $sql = 'select username, sex, birthday, telephone, real_name, IDcardNum, status
                from seller WHERE s_id=' . $_SESSION['uid'];
        } else if ($_SESSION['userType'] === 'buyer') {
            $sql = 'select username, sex, birthday, telephone, real_name, IDcardNum, status 
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
    } elseif ($_POST['action'] === 'edit') {
        $username = mysqli_escape_string($conn, $_POST['username']);
        $sex = mysqli_escape_string($conn, $_POST['sex']);
        $birthday = mysqli_escape_string($conn, $_POST['birthday']);
        $telephone = mysqli_escape_string($conn, $_POST['telephone']);
        $real_name = isset($_POST['realName']) ? $_POST['realName'] : null;
        $IDnum = isset($_POST['IDcardNum']) ? $_POST['IDcardNum'] : null;
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

            if ($_SESSION['userType'] === 'buyer') {
                $sql = "update buyer set username=$username, sex=$sex, birthday=$birthday, telephone=$telephone";
            } elseif ($_SESSION['userType'] === 'seller') {
                $sql = "update seller set username=$username, sex=$sex, birthday=$birthday, telephone=$telephone";
            }
        }

        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo 'update success';
        } else {
            echo 'update fail';
        }
    }
}
