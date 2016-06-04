<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016/6/4
 * Time: 15:44
 */
header("Content-Type: text/plain;charset=utf-8");
require_once('common/db.php');
require_once "../common/email.class.php";
session_start();
$email =$_SESSION['email'];
$userType = $_SESSION['userType'];
$checkYear = $_POST['checkYear'];
$checkMonth = $_POST['checkMonth'];
