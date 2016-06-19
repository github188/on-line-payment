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
    if(!isset($_COOKIE['auth'])) return false;

    global $salt;
    $conn = db_connect();
    list($identifier, $token, $userType) = explode(':', $_COOKIE['auth']);
    $userType = base64_decode($userType);
    if ($userType === 'seller') {
        $sql = "select * from seller WHERE rememberMe_id='$identifier'";
    } elseif ($userType === 'buyer') {
        $sql = "select * from buyer WHERE rememberMe_id='$identifier'";
    }
    $result = mysqli_query($conn, $sql);
    if($result) {
        $row = mysqli_fetch_array($result);

        if ($token !== $row['token']) {
            //ｃｏｏｋｉｅ认证失败
            return false;
//            die("token 不等");

        } elseif (time() > $row['timeout']) {
            return false;
//            die("ｃｏｏｋｉｅ已过期");

        } elseif (md5($salt . md5($row['email'] . $salt)) !== $identifier) {
            return false;
//            die("identifier 格式不对");

        } elseif ($token === $row['token']) {
            $_SESSION['login'] = true;
            $_SESSION['email'] = $row['email'];
            $_SESSION['uid'] = $userType === 'seller' ? $row['s_id'] : $row['b_id'];
            $_SESSION['userType'] = $userType;
            setcookie("username", $row['username'], time() + 60 * 60 * 24 * 30, '/');
            return true;
        }
    } else {
        echo "identifier not exist";
        return false;
    }
    return false;
}

session_start();
if(isset($_SESSION['login']) && $_SESSION['login'] === true) {
} else {
    if(!verify_cookie()) {
//        die("auth cookie error");
        header("Location: login.html");
    } 
}
