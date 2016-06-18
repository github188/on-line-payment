<?php
    // 订单状态state
    define('STATE_MAX', 3);
    define('UNPAID', 1);
    define('PAID', 2);
    define('CANCLED', 3);
    
    // 订单类型type
    define('TYPE_MAX', 2);
    define('FLIGHT', 1);
    define('HOTEL', 2);
    // 数据库连接信息
    $DB_HOST = '115.159.36.21';
    $DB_PORT = 3306;
    $DB_USER = "payment";
    $DB_PASSWORD = 'payment123';
    $DB_SCHEMA = 'payment';
  // PHP is the best language!
  $salt = "PHPISTHEBESTLANG";
?>