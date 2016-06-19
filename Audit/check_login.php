<?php
    header("Content-type: text/html; charset=utf-8");
    ini_set('display_errors','On');
    error_reporting(E_ALL);
    session_start();
    if( !isset($_SESSION['userType']) || $_SESSION['userType'] != "audit" ) {
        echo("<script>
                alert('该页面只有审计员才能登录!');
                location.href='../admin/m_login.html';
              </script>");
    }
?>