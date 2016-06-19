<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-6-19
 * Time: 下午10:23
 */
$_SESSION = array();

setcookie("username", null, time() - 60 * 60, '/');
setcookie("auth", null, time() - 60 * 60, '/');
setcookie("PHPSESSID", null, time() - 60 * 60, '/');
header("Location: login.html");