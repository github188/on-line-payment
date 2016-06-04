<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-6-4
 * Time: 下午5:04
 */

require_once("../PAM/common/db.php");
require_once("config.php");

function verify_cookie()
{
    global $salt;
    $conn = db_connect();
    list($identifier, $token, $userType) = explode(':', $_COOKIE['auth']);
    $userType = base64_decode($userType);
    if ($userType === 'seller') {
        $sql = "select * from seller WHERE rememberMe_id=$identifier";
    } elseif ($userType === 'buyer') {
        $sql = "select * from buyer WHERE rememberMe_id=$identifier";
    }
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $email = $row['email'];
//        $id = md5($salt . md5($email . $salt));
    if ($token !== $row['token']) {
        //ｃｏｏｋｉｅ认证失败
        header("Location: ../PAM/login.html");

    } elseif (time() > $row['timeout']) {
        header("Location: ../PAM/login.html");

    } elseif (md5($salt . md5($row['email'], $salt)) !== $identifier) {
        header("Location: ../PAM/login.html");

    } elseif ($token === $row['token']) {
        $_SESSION['login'] = true;
        $_SESSION['email'] = $row['email'];
        $_SESSION['uid'] = $userType === 'seller' ? $row['s_id'] : $row['b_id'];
        $_SESSION['userType'] = $userType;
        setcookie("username", $row['username'], time() + 60 * 60 * 24 * 30, '/');
    }
}