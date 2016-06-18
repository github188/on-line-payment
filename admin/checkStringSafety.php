<?php
/**
 * Created by PhpStorm.
 * User: yingwen
 * Date: 16/6/11
 * Time: 下午5:07
 */
function checkStringSafety( $var )
{
    if (!get_magic_quotes_gpc())
        $var = addslashes($var );
    $var = str_replace("_", "\_", $var );
    $var = str_replace("%", "\%", $var );

    $var  = nl2br($var );
    $var  = htmlspecialchars($var );

    if( preg_match('/select|insert|and|or|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/i', $var))
    {
        $tips =array("code"=>"5","msg"=>"invalid character");
        $message=urldecode(json_encode(url_encode($tips)));
        echo $message;
        exit();
    }
    return $var ;
}




?>