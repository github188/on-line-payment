<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-5-28
 * Time: 下午1:50
 */
require_once('common/db.php');
$email = $_POST['email'];
$password = $_POST['password'];
$userType = $_POST['userType'];

$conn = db_connect();
if( !empty($email) && !empty($password) && !empty($userType) ) {
    $email = mysqli_escape_string($conn, $email);
    $password = mysqli_escape_string($conn, $password);
    $password = md5($password);
    $userType = mysqli_escape_string($conn, $userType);
    if( $userType === "seller") {
        $sql = 'select * from seller WHERE email = "' . $email . '"' . 'and password="' . $password . '"';
    }
    elseif ($userType === "buyer") {
        $sql = 'select * from buyer WHERE email = "' . $email . '"' . 'and password="' . $password . '"';
    }
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    if($row) {
        //success jump to main page
        session_start();
        $_SESSION['userType'] = $userType;
        $_SESSION['email'] = $row['email'];
        if($userType === "seller") {
            $_SESSION['uid'] = $row['s_id'];
        } elseif($userType === "buyer") {
            $_SESSION['uid'] = $row['b_id'];
        }
        header("Location: ../Booking/index.php");
    } else {
        header("Location: login.html");
    }
}