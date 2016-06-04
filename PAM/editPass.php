<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-6-3
 * Time: 下午6:33
 */

require_once ('common/db.php');
session_start();

if($_SESSION['login'] === true) {
    $conn = db_connect();
    $oldPassIn = $_POST['oldPass'];
    $newPass = $_POST['newPass'];
    $newPassRe = $_POST['newPassRe'];

    if(!empty($oldPassIn) && !empty($newPass) && !empty($newPassRe)) {
        if($_SESSION['userType'] === 'seller') {
            $sql = "select password from seller WHERE s_id='" . $_SESSION['uid'] . "'";
        } elseif ($_SESSION['userType'] === 'buyer') {
            $sql = 'select password from buyer WHERE b_id="' . $_SESSION['uid'] . '"';
        }
        mysqli_query($conn, )
    }
}