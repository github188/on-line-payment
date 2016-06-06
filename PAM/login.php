<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-5-28
 * Time: 下午1:50
 */
require_once('common/db.php');
require_once ('../common/config.php');

session_start();

$email = $_GET['email'];
$password = $_GET['password'];
$userType = $_GET['userType'];

$conn = db_connect();
if (!empty($email) && !empty($password) && !empty($userType)) {
    $email = mysqli_escape_string($conn, $email);
    $password = mysqli_escape_string($conn, $password);
//    $password = md5($password);
    $userType = mysqli_escape_string($conn, $userType);
    if ($userType === "seller") {
        $sql = 'select * from seller WHERE email = "' . $email . '"' . 'and password="' . $password . '"';
    } elseif ($userType === "buyer") {
        $sql = 'select * from buyer WHERE email = "' . $email . '"' . ' and password="' . $password . '"';
    }
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    if ($row) {
        //success jump to main page
        $_SESSION['userType'] = $userType;
        $_SESSION['email'] = $row['email'];
        $_SESSION['login'] = true;

        if ($userType === "seller") {
            $_SESSION['uid'] = $row['s_id'];
        } elseif ($userType === "buyer") {
            $_SESSION['uid'] = $row['b_id'];
        }
        setcookie("username", $row['username'], time() + 60 * 60 * 24 * 30, '/');

        if ($_GET['rememberme'] === "true") {
            //请记住我
            rememberme($userType, $salt);
        }

        echo "exist";
    } else {
        echo "notexist";
    }
}

function rememberme($userType)
{
    global $salt;
    $identifier = md5($salt . md5($_SESSION['email'] . $salt));
    $token = md5(uniqid(rand(), true));
    $timeout = time() + 60 * 60 * 24 * 7;
    $user_id = $_SESSION['uid'];
    if ($userType === 'seller') {
        $sql = "update seller set rememberMe_id='$identifier', token='$token', timeout=$timeout 
                WHERE s_id = $user_id";
    } elseif ($userType === 'buyer') {
        $sql = "update buyer set rememberMe_id='$identifier', token='$token', timeout=$timeout
                WHERE b_id = $user_id";
    }
    $conn = db_connect();
    $result = mysqli_query($conn, $sql);
    if($result) {
        $userType = base64_encode($userType);
        setcookie("auth", "$identifier:$token:$userType", $timeout, "/");
//        echo "成功插入ｔｏｋｅｎ";
    } else {
//        echo "插入ｔｏｋｅｎ失败";
    }

}