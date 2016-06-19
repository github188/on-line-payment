<?php
    require_once 'check_login.php';
    $begdate = $_GET['begdate'];
    $enddate = $_GET['enddate'];
    $begtime = $begdate.' 0:0:0';
    //echo $begdate.'<br>';
    $endtime = $enddate.' 0:0:0';
    //echo $enddate.'<br>';
    $begtime = strtotime($begtime);
    $endtime = strtotime($endtime);
    $i = 0;
    //echo '<table>';
    $zip=new ZipArchive;
    $temp = tmpfile();
    echo '1';
    $zipfile = "csv/$begdate-$enddate.zip";
    if ($zip->open($zipfile, ZIPARCHIVE::CREATE)!==TRUE) {
        echo '创建打包文件失败    ';
    }
    while ( $begtime < $endtime) {
        $date = date('Y-m-d', $begtime);
        $filename = "csv/" . $date . ".csv";
        if(file_exists($filename)) {
            //echo $filename.'<br>';
            $i++;
            $zip->addFile($filename);
        }
        $begtime += 24*60*60;
    }
    $zip->close();
    echo "共找到 $i 份 csv";
    if ($i != 0)
        echo "   <a href=$zipfile>打包下载</a>";
    //echo '</table>';
?>