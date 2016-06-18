<?php
/**
 * Created by PhpStorm.
 * User: yingwen
 * Date: 16/6/11
 * Time: 下午5:08
 */
class connection{
    private static $conn;
    private final function _construct()
    {
        $conn=mysqli_connect("127.0.0.1","root","wangjunhao7146","payment") or die("数据库服务器连接错误".mysqli_error());
    }
    private function _clone(){}
    public static function getConn()
    {
        if(!(connection::$conn instanceof self ))
        {
            $conn=mysqli_connect("127.0.0.1","root","wangjunhao7146","payment") or die("数据库服务器连接错误".mysqli_error());
        }
        return $conn;
    }

    public static function freeConn()
    {
        if(connection::$conn)
            mysqli_close(connection::$conn);
    }

}





?>



